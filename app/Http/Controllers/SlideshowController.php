<?php

namespace App\Http\Controllers;

use App\Models\SlideshowImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SlideshowController extends Controller
{
    // Show the admin panel
    public function index()
    {
        // Get all slideshow images
        $slideshowImages = SlideshowImage::orderBy('slot')->get();

        return view('admin.admin', compact('slideshowImages'));
    }

    // Handle image upload
    public function upload(Request $request)
    {
        try {
            // Validate
            $request->validate([
                'slot' => 'required|integer|min:1|max:5',
                'image' => 'required|image|max:5120'
            ]);

            $slot = $request->slot;
            $file = $request->file('image');

            // Generate filename
            $filename = 'slot' . $slot . '-slideshow.' . $file->getClientOriginalExtension();

            // IMPORTANT: Use 'public' disk explicitly
            // Folder path relative to disk root: 'image/slideshow/'
            $folder = 'image/slideshow';

            \Log::info('Uploading to folder: ' . $folder);
            \Log::info('Using disk: public');

            // Use the 'public' disk
            $disk = Storage::disk('public');

            // Ensure folder exists
            if (!$disk->exists($folder)) {
                $disk->makeDirectory($folder, 0755, true);
                \Log::info('Created directory: ' . $folder);
            }

            // Delete old file if exists
            $oldImage = SlideshowImage::where('slot', $slot)->first();
            if ($oldImage) {
                if ($disk->exists($oldImage->image_path)) {
                    $disk->delete($oldImage->image_path);
                    \Log::info('Deleted old file: ' . $oldImage->image_path);
                }
                $oldImage->delete();
            }

            // Store file using the 'public' disk
            $path = $disk->putFileAs($folder, $file, $filename);

            \Log::info('File stored at: ' . $path);
            \Log::info('Full disk path: ' . $disk->path($path));
            \Log::info('File exists? ' . ($disk->exists($path) ? 'Yes' : 'No'));

            // Save to database - store relative path
            $slideshowImage = SlideshowImage::create([
                'slot' => $slot,
                'image_name' => $filename,
                'image_path' => $path,  // This should be 'image/slideshow/filename.jpg'
                'original_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ]);

            // Get URL using the 'public' disk
            $imageUrl = $disk->url($path);
            \Log::info('Image URL: ' . $imageUrl);

            // Verify the file is accessible
            $fullPath = $disk->path($path);
            $fileExistsOnDisk = file_exists($fullPath);
            \Log::info('File exists on disk? ' . ($fileExistsOnDisk ? 'Yes' : 'No'));
            \Log::info('Full path: ' . $fullPath);

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully!',
                'image_url' => $imageUrl,
                'slot' => $slot,
                'debug' => [
                    'stored_path' => $path,
                    'full_disk_path' => $fullPath,
                    'url' => $imageUrl,
                    'file_exists' => $fileExistsOnDisk,
                    'folder' => $folder,
                    'disk' => 'public'
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('UPLOAD ERROR: ' . $e->getMessage());
            \Log::error('Trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    // Optional: Optimize image size
    private function optimizeImage($path)
    {
        // try {
        //     $image = Image::make(storage_path('app/' . $path));

        //     // Resize to max 1920x1080 while maintaining aspect ratio
        //     $image->resize(1920, 1080, function ($constraint) {
        //         $constraint->aspectRatio();
        //         $constraint->upsize();
        //     });

        //     // Save with 85% quality
        //     $image->save(storage_path('app/' . $path), 85);
        // } catch (\Exception $e) {
        //     // If Intervention Image fails, continue with original
        //     \Log::error('Image optimization failed: ' . $e->getMessage());
        // }
        return;
    }

    // Get image for specific slot (for displaying existing images)
    public function getImage($slot)
    {
        $image = SlideshowImage::where('slot', $slot)->first();

        if ($image) {
            return response()->json([
                'exists' => true,
                'image_url' => $image->image_url,
                'slot' => $slot
            ]);
        }

        return response()->json([
            'exists' => false,
            'slot' => $slot
        ]);
    }

    // Get all slideshow images
    public function getAllImages()
    {
        $images = SlideshowImage::orderBy('slot')->get();

        $result = [];
        foreach ($images as $image) {
            $result[$image->slot] = $image->image_url;
        }

        return response()->json($result);
    }
}