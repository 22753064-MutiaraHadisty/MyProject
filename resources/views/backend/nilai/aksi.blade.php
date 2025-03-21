<form action="{{ route('nilai.edit', $nilai->id) }}" method="GET" style="display:inline;">
    <button type="submit" class="btn btn-warning btn-sm">
        <i class="fas fa-edit"></i>
    </button>
</form>

<!-- Tombol Hapus -->
<form action="{{ route('nilai.destroy', $nilai->id) }}" method="POST" style="display:inline;"
    onsubmit="return confirmDelete(event);">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="fas fa-trash"></i>
    </button>
</form>