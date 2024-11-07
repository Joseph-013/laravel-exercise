<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function show($filename)
    {
        // Path to the image in the storage directory
        $path = storage_path('app/public' . $filename);

        // Check if the file exists
        if (!file_exists($path)) {
            abort(404);
        }

        // Get the image content and return it
        $fileContent = file_get_contents($path);

        return response($fileContent)
            ->header('Content-Type', mime_content_type($path));
    }
}
