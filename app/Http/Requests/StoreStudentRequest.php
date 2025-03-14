<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan untuk membuat permintaan ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Dapatkan aturan validasi yang berlaku untuk permintaan ini.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:15',
            'class' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'status' => 'required|in:Active,Inactive',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Dapatkan pesan kesalahan kustom untuk aturan validasi.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan, silakan gunakan email lain.',

            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.string' => 'Nomor telepon harus berupa teks.',
            'phone.max' => 'Nomor telepon tidak boleh lebih dari 15 karakter.',

            'class.required' => 'Kelas wajib diisi.',
            'class.string' => 'Kelas harus berupa teks.',
            'class.max' => 'Kelas tidak boleh lebih dari 50 karakter.',

            'address.required' => 'Alamat wajib diisi.',
            'address.string' => 'Alamat harus berupa teks.',
            'address.max' => 'Alamat tidak boleh lebih dari 255 karakter.',

            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'gender.in' => 'Jenis kelamin harus Laki-Laki atau Perempuan.',

            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status harus Active atau Inactive.',

            'photo.image' => 'File foto harus berupa gambar.',
            'photo.mimes' => 'Format foto harus jpeg, png, jpg, atau gif.',
            'photo.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
        ];
    }
}
