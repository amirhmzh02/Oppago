<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MenuItem extends Model
{
    protected $fillable = [
        'name',
        'description',
        'food_type',
        'slot',
        'image_name',
        'original_name',
        'image_path',
        'mime_type',
        'file_size'
    ];

    protected $casts = [
        'slot' => 'integer'
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return null;
        }

        // Windows-compatible URL generation
        return Storage::url($this->image_path);
    }

    // Accessor to get storage path
    public function getStoragePathAttribute()
    {
        return $this->image_path;
    }

    // Scope to get items by food type and slot
    public function scopeByTypeAndSlot($query, $foodType, $slot)
    {
        return $query->where('food_type', $foodType)->where('slot', $slot);
    }

    // Scope to get items by food type
    public function scopeByFoodType($query, $foodType)
    {
        return $query->where('food_type', $foodType)->orderBy('slot');
    }
}