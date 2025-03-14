<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use DB;

class MapelController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('mapel')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($mapel) {
                    return view('backend.mapel.aksi', compact('mapel'));
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // $search = $request->input('search');

        // $mapel = Mapel::when($search, function ($query) use ($search) {
        //     $query->where('name', 'like', "%$search%");
        // })
        // ->orderBy('created_at', 'asc')
        // ->paginate(5)
        // ->appends(['search' => $search]); // Menyimpan keyword pencarian di pagination

        return view('backend.mapel.index');
    }

    public function create()
    {
        return view('backend.mapel.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:mapel',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Mapel::create([
            'name' => $request->name,
        ]);

        return redirect()->route('mapel')->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mapel = Mapel::findOrFail($id);
        return view('backend.mapel.edit', compact('mapel'));
    }

    public function update(Request $request, $id)
    {
        $mapel = Mapel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:mapel,name,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mapel->update([
            'name' => $request->name,
        ]);

        return redirect()->route('mapel')->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();

        return redirect()->route('mapel')->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
