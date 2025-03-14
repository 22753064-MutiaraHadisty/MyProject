<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreStudentRequest;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = Student::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('address', 'like', "%$search%");
            })
            ->orderBy('created_at', 'asc')
            ->paginate(5);
        return view('backend.student.index', compact('students'));
    }

    public function create()
    {
        return view('backend.student.create');
    }

    public function store(StoreStudentRequest $request)
    {
        $validatedData = $request->all();

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $this->uploadPhoto($request->file('photo'));
        }

        Student::create($validatedData);

        session()->flash('success', 'Data siswa berhasil ditambahkan!');
        return redirect()->route('students');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('backend.student.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'required|string|max:15',
            'class' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'status' => 'required|in:Active,Inactive',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        if ($request->hasFile('photo')) {
            if ($student->photo) {
                $this->deleteOldPhoto($student->photo);
            }
            $validatedData['photo'] = $this->uploadPhoto($request->file('photo'));
        }

        $student->update($validatedData);

        session()->flash('success', 'Data siswa berhasil diperbarui!');
        return redirect()->route('students');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        if ($student->photo) {
            $this->deleteOldPhoto($student->photo);
        }

        $student->delete();

        session()->flash('success', 'Data siswa berhasil dihapus!');
        return redirect()->route('students');
    }

    private function uploadPhoto($file)
    {
        $folderPath = public_path('backend/images');

        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0777, true, true);
        }

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($folderPath, $fileName);

        return $fileName;
    }

    private function deleteOldPhoto($fileName)
    {
        $filePath = public_path('backend/images/' . $fileName);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    }
}
