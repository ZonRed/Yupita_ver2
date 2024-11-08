<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class KasirController extends Controller
{
    // Show the index view
    public function index()
    {
        $transactions = Transaction::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.kasir.index', compact('transactions'));
    }

    // Store a new transaction
    public function store(Request $request)
    {
        $total = 0;
        $items = [];

        // Loop through items to calculate total and prepare data
        foreach ($request->items as $item => $jumlah) {
            if ($jumlah > 0) {
                $price = $request->prices[$item];
                $total += $price * $jumlah;
                $items[] = [
                    'item' => $item,
                    'jumlah' => $jumlah,
                    'harga' => $price
                ];
            }
        }

        // Cek pembayaran kasir
        $pembayaran = $request->pembayaran; // Ambil jumlah pembayaran dari request
        $kembalian = 0;
        if ($pembayaran >= $total) {
            $kembalian = $pembayaran - $total; // Hitung kembalian jika pembayaran cukup
        }

        // Jika pembayaran kurang dari total
        if ($pembayaran < $total) {
            return response()->json([
                'error' => 'Pembayaran kurang dari total harga!'
            ], 400);
        }

        // Simpan transaksi ke database
        $transaction = Transaction::create([
            'item_kasir' => json_encode($items),
            'jumlah_kasir' => array_sum(array_column($items, 'jumlah')),
            'total_kasir' => $total,
            'pembayaran_kasir' => $pembayaran,
            'kembalian_kasir' => $kembalian,
            'user_id' => Auth::id(),
        ]);

        // Kembalikan response sukses dengan informasi transaksi
        return response()->json([
            'success' => 'Checkout berhasil',
            'transaction' => $transaction
        ]);
    }

    // Show a specific transaction (if needed)
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        return response()->json($transaction);
    }

    // Update a specific transaction (if needed)
    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        // Update the transaction with new data (if necessary)
        $transaction->update($request->all());

        return response()->json(['success' => 'Transaction updated successfully.']);
    }

    // Delete a specific transaction (if needed)
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return response()->json(['success' => 'Transaction deleted successfully.']);
    }

    public function getHistory() {
        $transactions = Transaction::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json($transactions);
    }

    public function getMonthlyEarnings()
    {
        $monthlyEarnings = Transaction::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(total_kasir) as total')
            ->groupBy('month', 'year')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return response()->json($monthlyEarnings);
    }


    // Optionally, add a method to print the transaction (if necessary)
    public function print($id)
    {
        $transaction = Transaction::findOrFail($id);
        // Code for generating a printable view or PDF can go here

        return view('admin.kasir.print', compact('transaction'));
    }
}
