<?php

namespace App\Http\Controllers;

use App\Models\CarouselImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    // Show the admin panel
    public function index()
    {
        // Get all carousel images grouped by slot
        $carouselImages = CarouselImage::orderBy('slot')->get()->keyBy('slot');

        return view('admin.admin', compact('carouselImages'));
    }

    // Get all carousel images
    public function getAllImages()
    {
        $images = CarouselImage::orderBy('slot')->get()->keyBy('slot');
        $imageUrls = [];

        foreach ($images as $slot => $image) {
            $imageUrls[$slot] = $image->image_url;
        }

        return response()->json($imageUrls);
    }

    // Get specific carousel image for a slot
    public function getImageForSlot($slot)
    {
        $image = CarouselImage::where('slot', $slot)->first();

        if ($image) {
            return response()->json([
                'exists' => true,
                'image_url' => $image->image_url
            ]);
        }

        return response()->json([
            'exists' => false
        ]);
    }

    // Handle image upload
    public function upload(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'food_type' => 'required|in:wings,rabokki,toppoki,fries,rice',
                'slot' => 'required|integer|min:1|max:5',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|max:5120' // 5MB max
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

                // Generate filename - similar to carousel format
                $filename = 'menu-' . $foodType . '-slot' . $slot . '.' . $file->getClientOriginalExtension();

                // Use same folder structure as carousel
                $folder = 'image/menu';

                // Use 'public' disk
                $disk = Storage::disk('public');

                // Ensure folder exists - create if not
                if (!$disk->exists($folder)) {
                    $disk->makeDirectory($folder, 0755, true);
                    Log::info('Created directory: ' . $folder);
                }

                // Delete old image if exists
                if ($menuItem && $menuItem->image_path) {
                    $oldPath = $menuItem->image_path;
                    if ($disk->exists($oldPath)) {
                        $disk->delete($oldPath);
                        Log::info('Deleted old menu file: ' . $oldPath);
                    }
                }

                // Store new image - use putFileAs to keep original filename
                $path = $disk->putFileAs($folder, $file, $filename);

                Log::info('Menu file stored at: ' . $path);

                $imageData = [
                    'image_name' => $filename,
                    'image_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                ];
            }

            // Prepare data for update/insert
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

            // Get image URL if exists
            $imageUrl = $menuItem->image_url;

            if ($imageUrl) {
                Log::info('Menu Image URL: ' . $imageUrl);
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
                    'image_url' => $imageUrl
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