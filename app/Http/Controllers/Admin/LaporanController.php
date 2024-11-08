<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Laporan::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<button class="btn btn-danger btn-sm deleteLaporan" data-id="'.$row->id.'">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.laporan.index');
    }

    public function destroy($id)
    {
        try {
            $laporan = Laporan::find($id);
            if ($laporan) {
                $laporan->delete();
                return response()->json(['status' => 200, 'message' => 'Laporan deleted successfully']);
            } else {
                return response()->json(['status' => 404, 'message' => 'Data not found']);
            }
        } catch (Exception $e) {
            Log::error('Error deleting Laporan: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting Laporan.', 'message' => $e->getMessage()], 500);
        }
    }
    
    public function deleteAll()
    {
        try {
            // Cek apakah ada data yang tersisa di tabel
            $count = Laporan::count();
    
            if ($count > 0) {
                // Jika ada data, hapus semua data
                Laporan::truncate();
                return response()->json(['status' => 200, 'message' => 'All Laporan deleted successfully']);
            } else {
                // Jika tidak ada data, kembalikan status 404
                return response()->json(['status' => 404, 'message' => 'No data found to delete']);
            }
        } catch (Exception $e) {
            Log::error('Error deleting all Laporan: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting all Laporan.', 'message' => $e->getMessage()], 500);
        }
    }
    
}
