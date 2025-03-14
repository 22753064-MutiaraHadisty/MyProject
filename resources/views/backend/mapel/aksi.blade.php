<!-- resources/views/backend/mapel/aksi.blade.php -->
<a href="{{ route('mapel.edit', $mapel->id) }}" class="btn btn-warning btn-sm">
    <i class="fas fa-edit"></i> Edit
</a>

<form action="{{ route('mapel.destroy', $mapel->id) }}" method="POST" style="display:inline;"
    onsubmit="return confirmDelete(event);">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="fas fa-trash"></i> Hapus
    </button>
</form>