use Illuminate\Support\Facades\Route;

Route::get('/users', function () {
    return response()->json([
        'users' => ['Ali', 'Budi', 'Citra']
    ]);
});