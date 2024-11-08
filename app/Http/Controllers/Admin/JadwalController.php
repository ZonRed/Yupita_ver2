<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Jadwal::with('admin')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.jadwal.index');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'hari_jadwal' => 'required|string|unique:jadwal',
                'buka_jadwal' => 'required|date_format:H:i',
                'tutup_jadwal' => 'required|date_format:H:i',
            ]);

            $data = $request->all();
            $data['users_id'] = Auth::id();

            Jadwal::create($data);

            return response()->json(['success' => 'Jadwal created successfully.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while creating Jadwal.', 'message' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $jadwal = Jadwal::find($id);
        return response()->json($jadwal);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'hari_jadwal' => 'required|string|unique:jadwal,hari_jadwal,' . $id,
                'buka_jadwal' => 'required|date_format:H:i',
                'tutup_jadwal' => 'required|date_format:H:i',
            ]);
            $jadwal = Jadwal::find($id);
            $jadwal->update($request->only(['hari_jadwal', 'buka_jadwal', 'tutup_jadwal']));
            return response()->json(['success' => 'Jadwal updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while updating Jadwal.', 'message' => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $jadwal = Jadwal::find($id);
            if ($jadwal) {
                $jadwal->delete();
                return response()->json(['status' => 200, 'message' => 'Jadwal deleted successfully']);
            } else {
                return response()->json(['status' => 404, 'message' => 'Data not found']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting Jadwal.', 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteAll()
    {
        try {
            $count = Jadwal::count();

            if ($count > 0) {
                Jadwal::truncate();
                return response()->json(['status' => 200, 'message' => 'All Jadwal deleted successfully']);
            } else {
                return response()->json(['status' => 404, 'message' => 'No data found to delete']);
            }
        } catch (Exception $e) {
            Log::error('Error deleting all Jadwal: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting all Jadwal.', 'message' => $e->getMessage()], 500);
        }
    }
}
