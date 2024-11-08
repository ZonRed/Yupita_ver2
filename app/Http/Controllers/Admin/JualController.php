<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jual;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JualController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Jual::with('admin')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.jual.index');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'tanggal_jual' => 'required|date',
                'type_jual' => 'required|string|unique:jual',
                'harga_jual' => 'required|numeric',
                'stock_jual' => 'required|string',
                'jumlah_jual' => 'required|integer',
            ]);

            $data = $request->all();
            $data['users_id'] = Auth::id();

            Log::info('Data yang diterima untuk disimpan:', $data);

            Jual::create($data);

            return response()->json(['success' => 'Jual created successfully.']);
        } catch (Exception $e) {
            Log::error('Error creating Jual: ' . $e->getMessage());

            return response()->json(['error' => 'An error occurred while creating Jual.', 'message' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $jual = Jual::find($id);
        return response()->json($jual);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'tanggal_jual' => 'required|date',
                'type_jual' => 'required|string|unique:jual,type_jual,' . $id,
                'harga_jual' => 'required|numeric',
                'stock_jual' => 'required|string',
                'jumlah_jual' => 'required|integer',
            ]);

            $jual = Jual::find($id);
            $jual->update($request->only(['tanggal_jual', 'type_jual', 'harga_jual', 'stock_jual', 'jumlah_jual']));

            return response()->json(['success' => 'Jual updated successfully.']);
        } catch (Exception $e) {
            Log::error('Error updating Jual: ' . $e->getMessage());

            return response()->json(['error' => 'An error occurred while updating Jual.', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $jual = Jual::find($id);
            if ($jual) {
                $jual->delete();
                return response()->json(['status' => 200, 'message' => 'Jual deleted successfully']);
            } else {
                return response()->json(['status' => 404, 'message' => 'Data not found']);
            }
        } catch (Exception $e) {
            Log::error('Error deleting Jual: ' . $e->getMessage());

            return response()->json(['error' => 'An error occurred while deleting Jual.', 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteAll()
    {
        try {
            $count = Jual::count();

            if ($count > 0) {
                Jual::truncate();
                return response()->json(['status' => 200, 'message' => 'All Jual deleted successfully']);
            } else {
                return response()->json(['status' => 404, 'message' => 'No data found to delete']);
            }
        } catch (Exception $e) {
            Log::error('Error deleting all Jual: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting all Jual.', 'message' => $e->getMessage()], 500);
        }
    }
}
