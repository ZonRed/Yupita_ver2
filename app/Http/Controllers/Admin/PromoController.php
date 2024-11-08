<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Promo::with('admin')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.promo.index');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'tanggal_mulai_promo' => 'required|date',
                'tanggal_akhir_promo' => 'required|date',
                'type_promo' => 'required|string|unique:promos',
                'info_promo' => 'required|string',
                'harga_promo' => 'required|numeric',
            ]);

            $data = $request->all();
            $data['users_id'] = Auth::id();

            Promo::create($data);

            return response()->json(['success' => 'Promo created successfully.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while creating Promo.', 'message' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        try {
            $promo = Promo::findOrFail($id);
            return response()->json($promo);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching Promo.', 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'tanggal_mulai_promo' => 'required|date',
                'tanggal_akhir_promo' => 'required|date',
                'type_promo' => 'required|string|unique:promos,type_promo,' . $id,
                'info_promo' => 'required|string',
                'harga_promo' => 'required|numeric',
            ]);

            $promo = Promo::findOrFail($id);
            $promo->update($request->only(['tanggal_mulai_promo', 'tanggal_akhir_promo', 'type_promo', 'info_promo', 'harga_promo']));

            return response()->json(['success' => 'Promo updated successfully.']);
        } catch (Exception $e) {
            Log::error('Error updating Promo: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating Promo.', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $promo = Promo::findOrFail($id);
            if ($promo) {
                $promo->delete();
                return response()->json(['status' => 200, 'message' => 'Promo deleted successfully']);
            } else {
                return response()->json(['status' => 404, 'message' => 'Data not found']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting Promo.', 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteAll()
    {
        try {
            $count = Promo::count();

            if ($count > 0) {
                Promo::truncate();
                return response()->json(['status' => 200, 'message' => 'All Promo deleted successfully']);
            } else {
                return response()->json(['status' => 404, 'message' => 'No data found to delete']);
            }
        } catch (Exception $e) {
            Log::error('Error deleting all Promo: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting all Promo.', 'message' => $e->getMessage()], 500);
        }
    }
}
