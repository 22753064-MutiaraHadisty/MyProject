<!-- resources/views/backend/nilai/aksi.blade.php -->
<a href="{{ route('nilai.edit', $nilai->id) }}" class="btn btn-warning btn-sm">
    <i class="fas fa-edit"></i> Edit
</a>

<form action="{{ route('nilai.destroy', $nilai->id) }}" method="POST" style="display:inline;"
    onsubmit="return confirmDelete(event);">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="fas fa-trash"></i> Hapus
    </button>
</form>