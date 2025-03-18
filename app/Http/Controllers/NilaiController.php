<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Mapel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Nilai::with(['student', 'teacher', 'mapel'])->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('student_name', function ($nilai) {
                    return $nilai->student->name ?? '-';
                })
                ->addColumn('teacher_name', function ($nilai) {
                    return $nilai->teacher->name ?? '-';
                })
                ->addColumn('mapel_name', function ($nilai) {
                    return $nilai->mapel->name ?? '-';
                })
                ->addColumn('nilai', function ($nilai) {
                    return $nilai->nilai;
                })
                ->addColumn('action', function ($nilai) {
                    return view('backend.nilai.aksi', compact('nilai'));
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.nilai.index');
    } 

    public function create()
    {
        $students = Student::all();
        $teachers = Teacher::all();
        $mapels = Mapel::all();
        return view('backend.nilai.create', compact('students', 'teachers', 'mapels'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teacher,id',
            'mapel_id' => 'required|exists:mapel,id',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Nilai::create([
            'student_id' => $request->student_id,
            'teacher_id' => $request->teacher_id,
            'mapel_id' => $request->mapel_id,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('nilai')->with('success', 'Nilai berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);
        $students = Student::all();
        $teachers = Teacher::all();
        $mapels = Mapel::all();
        return view('backend.nilai.edit', compact('nilai', 'students', 'teachers', 'mapels'));
    }

    public function update(Request $request, $id)
    {
        $nilai = Nilai::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:teacher,id',
            'mapel_id' => 'required|exists:mapel,id',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $nilai->update([
            'student_id' => $request->student_id,
            'teacher_id' => $request->teacher_id,
            'mapel_id' => $request->mapel_id,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('nilai')->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->route('nilai')->with('success', 'Nilai berhasil dihapus.');
    }
    public function exportPDF()
    {
        $nilai = Nilai::with(['student', 'teacher', 'mapel'])->get();

        $pdf = Pdf::loadView('backend.nilai.pdf', compact('nilai'));

        return $pdf->download('data_nilai.pdf');
    }
}
