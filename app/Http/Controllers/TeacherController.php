<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
   public function index(Request $request)
{
    $search = $request->input('search');

    $teachers = Teacher::query()
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('address', 'like', "%$search%"); // Tambahkan pencarian berdasarkan alamat
        })
        ->orderBy('created_at', 'asc')
        ->paginate(5);

    return view('backend.teacher.index', compact('teachers', 'search'));
}

    public function create()
    {
        return view('backend.teacher.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:teacher,email',
            'phone'   => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'gender'  => 'required|in:Laki-Laki,Perempuan',
            'status'  => 'required|in:Aktif,Tidak Aktif',
            'photo'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $teacher = new Teacher($validator->validated());

        if ($request->hasFile('photo')) {
            $teacher->photo = $this->uploadPhoto($request->file('photo'));
        }

        $teacher->save();

        session()->flash('success', 'Data guru berhasil ditambahkan!');
        return redirect()->route('teacher');
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('backend.teacher.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:teacher,email,' . $id,
            'phone'   => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'gender'  => 'required|in:Laki-Laki,Perempuan',
            'status'  => 'required|in:Aktif,Tidak Aktif',
            'photo'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        if ($request->hasFile('photo')) {
            if ($teacher->photo) {
                $this->deleteOldPhoto($teacher->photo);
            }
            $validatedData['photo'] = $this->uploadPhoto($request->file('photo'));
        }

        $teacher->update($validatedData);

        session()->flash('success', 'Data guru berhasil diperbarui!');
        return redirect()->route('teacher');
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);

        if ($teacher->photo) {
            $this->deleteOldPhoto($teacher->photo);
        }

        $teacher->delete();

        session()->flash('success', 'Data guru berhasil dihapus!');
        return redirect()->route('teacher');
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