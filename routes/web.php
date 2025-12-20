<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlideshowController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\MenuController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/menu', function () {
    return view('menu');
});
Route::get('/admin', function () {
    return view('admin.admin');
});

Route::prefix('admin')->group(function () {
    // Admin panel
    Route::get('/slideshow', [SlideshowController::class, 'index'])->name('admin.slideshow');

    // Upload image
    Route::post('/slideshow/upload', [SlideshowController::class, 'upload'])->name('admin.slideshow.upload');

    // Get image for slot
    Route::get('/slideshow/image/{slot}', [SlideshowController::class, 'getImage'])->name('admin.slideshow.get');

    // Get all images
    Route::get('/slideshow/image', [SlideshowController::class, 'getAllImages'])->name('admin.slideshow.all');




});

Route::prefix('admin/carousel')->group(function () {
    Route::get('/images', [CarouselController::class, 'getAllImages'])->name('carousel.images.all');
    Route::get('/image/{slot}', [CarouselController::class, 'getImageForSlot'])->name('carousel.image.slot');
    Route::post('/upload', [CarouselController::class, 'upload'])->name('carousel.upload');
});

Route::prefix('admin/menu')->group(function () {
    Route::get('/{foodType}', [MenuController::class, 'getByFoodType']);
    Route::get('/{foodType}/{slot}', [MenuController::class, 'getMenuItem']);
    Route::post('/upload', [MenuController::class, 'upload']);
});

// In web.php or routes file
Route::get('/test-upload', function() {
    return view('test-upload');
});

Route::post('/test-upload', function(Request $request) {
    $file = $request->file('test_file');
    
    if ($file) {
        // Try different storage methods
        $disk = Storage::disk('public');
        
        // Method 1: Simple put
        $path1 = $disk->put('test', $file);
        
        // Method 2: Put with filename
        $path2 = $disk->putFileAs('test', $file, 'test-file.jpg');
        
        // Check both
        return response()->json([
            'method1_path' => $path1,
            'method1_exists' => $disk->exists($path1),
            'method2_path' => $path2,
            'method2_exists' => $disk->exists($path2),
            'physical_path' => $disk->path($path2),
            'file_exists' => file_exists($disk->path($path2))
        ]);
    }
    
    return 'No file';
});