<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; 
class CarouselImage extends Model
{
    protected $fillable = [
        'slot',
        'image_name',
        'original_name',
        'image_path',
        'mime_type',
        'file_size'
    ];

    public function getImageUrlAttribute()
    {
        if (str_starts_with($this->image_path, 'public/')) {
            // Remove 'public/' prefix if present
            $path = str_replace('public/', '', $this->image_path);
            return Storage::url($path);
        }
        return asset('storage/image/carousel/' . $this->image_name);
    }
    
    // Accessor to get storage path
    public function getStoragePathAttribute()
    {
        return 'storage/image/carousel/' . $this->image_name;
    }
}