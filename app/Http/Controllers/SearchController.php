<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Inisialisasi variabel kosong untuk menghindari error jika query kosong
        $users = collect();
        $students = collect();
        $teachers = collect();

        // Jika ada query, lakukan pencarian
        if ($query) {
            $users = DB::table('users')
                ->where('name', 'LIKE', "%{$query}%")
                ->orWhere('id', $query)
                ->get();

            $students = DB::table('students')
                ->where('name', 'LIKE', "%{$query}%")
                ->orWhere('id', $query)
                ->orWhere('address', 'LIKE', "%{$query}%")
                ->get();

            $teachers = DB::table('teacher') // Perbaikan nama tabel
                ->where('name', 'LIKE', "%{$query}%")
                ->orWhere('id', $query)
                ->orWhere('address', 'LIKE', "%{$query}%")
                ->get();
        }

        return view('backend.search', compact('users', 'students', 'teachers', 'query'));
    }
}