<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;


class PendaftaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['create', 'store', 'search']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pendaftaran::select(['id', 'nama', 'nisn', 'asal_sekolah', 'email', 'status'])->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($pendaftaran) {
                    $badgeClass = match ($pendaftaran->status) {
                        'diterima' => 'bg-success',
                        'ditolak' => 'bg-danger',
                        default => 'bg-warning',
                    };
                    return "<span class='badge {$badgeClass}'>" . ucfirst($pendaftaran->status) . "</span>";
                })
                ->addColumn('action', function ($pendaftaran) {
                    return view('backend.pendaftaran.aksi', compact('pendaftaran'));
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.pendaftaran.index');
    }

    public function create()
    {
        return view('auth.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|unique:pendaftaran,nisn',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'asal_sekolah' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15|regex:/^[0-9]+$/',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'email' => 'required|email|unique:pendaftaran,email',
        ]);

        Pendaftaran::create(array_merge($validatedData, ['status' => 'pending']));

        return redirect('/')->with('success', 'Pendaftaran berhasil dikirim.');
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return response()->json($pendaftaran);
    }

    public function edit($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('backend.pendaftaran.edit', compact('pendaftaran'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|unique:pendaftaran,nisn,' . $id,
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'asal_sekolah' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15|regex:/^[0-9]+$/',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'email' => 'required|email|unique:pendaftaran,email,' . $id,
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update($validatedData);

        return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return response()->json(['success' => true, 'message' => 'Data pendaftaran berhasil dihapus.']);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:diterima,ditolak']);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update(['status' => $request->status]);

        return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui.']);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json(['success' => false, 'message' => 'Masukkan NISN atau Nama yang ingin dicari']);
        }

        $pendaftaran = Pendaftaran::where('nisn', 'LIKE', "%{$query}%")
            ->orWhere('nama', 'LIKE', "%{$query}%")
            ->select('nama', 'nisn', 'status')
            ->first();

        return view('auth.search', compact('pendaftaran'));
    }
    public function exportPdf($id, Request $request)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Cek jika status bukan 'diterima', tolak akses
        if ($pendaftaran->status !== 'diterima') {
            return abort(403, 'Akses ditolak! Hanya yang diterima bisa mengunduh PDF.');
        }

        $pdf = Pdf::loadView('backend.pendaftaran.pdf', compact('pendaftaran'));

        if ($request->has('preview')) {
            return $pdf->stream("Pendaftaran_{$pendaftaran->nama}.pdf"); // Tampilkan di modal
        }

        return $pdf->download("Pendaftaran_{$pendaftaran->nama}.pdf"); // Unduh langsung
    }
}
