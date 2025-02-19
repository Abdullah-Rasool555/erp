<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    // Show all images
    public function index()
    {
        $images = Image::all();
        return view('images.index', compact('images'));
    }

    // Show form to upload image
    public function create()
    {
        return view('images.create');
    }

    // Store image
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imagePath = 'img/image.jpg'; // Default path
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img', 'public');
        }

        Image::create([
            'title' => $request->title,
            'image_path' => $imagePath
        ]);

        return redirect()->route('images.index')->with('success', 'Image uploaded successfully.');
    }

    // Show edit form
    public function edit(Image $image)
    {
        return view('images.edit', compact('image'));
    }

    // Update image
    public function update(Request $request, Image $image)
    {
        $request->validate(['title' => 'required']);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $image->image_path);
            $imagePath = $request->file('image')->store('img', 'public');
            $image->update(['image_path' => $imagePath]);
        }

        $image->update(['title' => $request->title]);

        return redirect()->route('images.index')->with('success', 'Image updated successfully.');
    }

    // Delete image
    public function destroy(Image $image)
    {
        Storage::delete('public/' . $image->image_path);
        $image->delete();
        return redirect()->route('images.index')->with('success', 'Image deleted successfully.');
    }
}
