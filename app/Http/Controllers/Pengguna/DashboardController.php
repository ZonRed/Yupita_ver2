<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Jual;
use App\Models\Laporan;
use App\Models\Promo;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pengguna.index');
    }

    public function kontak()
    {
        return view('pengguna.kontak.index');
    }

    public function jadwal(Request $request)
    {
        if ($request->ajax()) {
            $data = Jadwal::with('admin')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('pengguna.jadwal.index');
    }

    public function jual(Request $request)
    {
        if ($request->ajax()) {
            $data = Jual::with('admin')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('pengguna.jual.index');
    }

    public function promo(Request $request)
    {
        if ($request->ajax()) {
            $data = Promo::with('admin')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('pengguna.promo.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_laporan' => 'required',
            'email_laporan' => 'required',
            'pesan_laporan' => 'required',
        ]);

        Laporan::create([
            'nama_laporan' => $request->nama_laporan,
            'email_laporan' => $request->email_laporan,
            'pesan_laporan' => $request->pesan_laporan,
        ]);

        return redirect()->route('index', ['section' => 'laporan'])->with('success', 'Laporan Anda telah berhasil dikirim.');
    }
}
