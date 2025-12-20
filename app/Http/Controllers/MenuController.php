<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    // Get all menu items for a specific food type
    public function getByFoodType($foodType)
    {
        try {
            $menuItems = MenuItem::byFoodType($foodType)->get()->keyBy('slot');

            $formattedItems = [];
            foreach ($menuItems as $slot => $item) {
                $formattedItems[$slot] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'food_type' => $item->food_type,
                    'slot' => $item->slot,
                    'image_url' => $item->image_url
                ];
            }

            return response()->json($formattedItems);
        } catch (\Exception $e) {
            Log::error('Error getting menu items: ' . $e->getMessage());
            return response()->json([], 500);
        }
    }

    // Get specific menu item for a food type and slot
    public function getMenuItem($foodType, $slot)
    {
        try {
            $menuItem = MenuItem::byTypeAndSlot($foodType, $slot)->first();

            if ($menuItem) {
                return response()->json([
                    'exists' => true,
                    'item' => [
                        'id' => $menuItem->id,
                        'name' => $menuItem->name,
                        'description' => $menuItem->description,
                        'food_type' => $menuItem->food_type,
                        'slot' => $menuItem->slot,
                        'image_url' => $menuItem->image_url
                    ]
                ]);
            }

            return response()->json([
                'exists' => false
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting menu item: ' . $e->getMessage());
            return response()->json(['exists' => false], 500);
        }
    }

    // Handle menu item upload/update
    public function upload(Request $request)
    {
        try {
            $request->validate([
                'food_type' => 'required|in:wings,rabokki,toppoki,fries,rice',
                'slot' => 'required|integer|min:1|max:5',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|max:5120'
            ]);

            $foodType = $request->food_type;
            $slot = $request->slot;
            $name = $request->name;
            $description = $request->description;

            // Check if menu item already exists
            $menuItem = MenuItem::byTypeAndSlot($foodType, $slot)->first();

            // Handle image upload if provided
            $imageData = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                // Generate filename (Windows-safe)
                $filename = 'menu-' . $foodType . '-slot' . $slot . '.' . $file->getClientOriginalExtension();
                $folder = 'image/menu';

                // Use 'public' disk
                $disk = Storage::disk('public');

                // Ensure folder exists (Windows compatible)
                if (!$disk->exists($folder)) {
                    $disk->makeDirectory($folder, 0775, true); // Changed to 0775 for Windows
                }

                // Delete old image if exists
                if ($menuItem && $menuItem->image_path) {
                    $oldPath = str_replace('\\', '/', $menuItem->image_path); // Normalize path for Windows
                    if ($disk->exists($oldPath)) {
                        $disk->delete($oldPath);
                    }
                }

                // Store new image
                $path = $disk->putFileAs($folder, $file, $filename);

                // Normalize path for Windows (replace backslashes with forward slashes)
                $path = str_replace('\\', '/', $path);

                // DEBUG for Windows
                Log::info('=== WINDOWS MENU UPLOAD DEBUG ===');
                Log::info('Request file: ' . $file->getClientOriginalName());
                Log::info('Target folder: ' . $folder);
                Log::info('Target filename: ' . $filename);
                Log::info('Stored path: ' . $path);
                Log::info('Storage disk: public');

                // Check physical path
                $physicalPath = $disk->path($path);
                Log::info('Physical path: ' . $physicalPath);

                // Check if file exists
                $fileExists = file_exists($physicalPath);
                Log::info('File exists physically: ' . ($fileExists ? 'YES' : 'NO'));

                if ($fileExists) {
                    Log::info('File size: ' . filesize($physicalPath) . ' bytes');
                }

                $imageData = [
                    'image_name' => $filename,
                    'image_path' => $path, // This is stored in DB
                    'original_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                ];
            }

            // Prepare data
            $data = [
                'name' => $name,
                'description' => $description,
                'food_type' => $foodType,
                'slot' => $slot,
            ];

            // Add image data if provided
            if ($imageData) {
                $data = array_merge($data, $imageData);
            }

            // Update or create menu item
            if ($menuItem) {
                $menuItem->update($data);
            } else {
                $menuItem = MenuItem::create($data);
            }

            // Get image URL - force refresh
            $menuItem->refresh();
            $imageUrl = $menuItem->image_url;

            // Alternative URL generation for debugging
            $debugUrl = null;
            if ($menuItem->image_path) {
                $debugUrl = asset('storage/' . ltrim($menuItem->image_path, 'public/'));
            }

            return response()->json([
                'success' => true,
                'message' => 'Menu item saved successfully!',
                'item' => [
                    'id' => $menuItem->id,
                    'name' => $menuItem->name,
                    'description' => $menuItem->description,
                    'food_type' => $menuItem->food_type,
                    'slot' => $menuItem->slot,
                    'image_url' => $imageUrl,
                    'image_url_debug' => $debugUrl, // For debugging
                    'image_path' => $menuItem->image_path // For debugging
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('MENU UPLOAD ERROR: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Operation failed: ' . $e->getMessage()
            ], 500);
        }
    }
}