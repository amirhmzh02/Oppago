<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SlideshowImage extends Model
{
    protected $fillable = [
        'slot',
        'image_name',
        'original_name',
        'image_path',
        'mime_type',
        'file_size'
    ];

    // Accessor to get full URL
    public function getImageUrlAttribute()
    {
        if (str_starts_with($this->image_path, 'public/')) {
            // Remove 'public/' prefix if present
            $path = str_replace('public/', '', $this->image_path);
            return Storage::url($path);
        }
        return asset('storage/image/slideshow/' . $this->image_name);
    }

    // Accessor to get storage path
    public function getStoragePathAttribute()
    {
        return 'storage/image/slideshow/' . $this->image_name;
    }

    // Method to delete file from storage
    public function deleteImageFile()
    {
        if (Storage::exists($this->getStoragePathAttribute())) {
            Storage::delete($this->getStoragePathAttribute());
        }
    }
}