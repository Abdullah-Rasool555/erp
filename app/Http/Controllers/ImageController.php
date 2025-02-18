<?php
namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('images.index', compact('images'));
    }

    public function create()
    {
        return view('images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('image')->store('images', 'public');

        Image::create([
            'title' => $request->title,
            'image_path' => $path,
        ]);

        return redirect()->route('images.index')->with('success', 'Image uploaded successfully');
    }

    public function edit(Image $image)
    {
        return view('images.edit', compact('image'));
    }

    public function update(Request $request, Image $image)
    {
        $request->validate(['title' => 'required']);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $image->image_path);
            $path = $request->file('image')->store('images', 'public');
            $image->update(['image_path' => $path]);
        }

        $image->update(['title' => $request->title]);

        return redirect()->route('images.index')->with('success', 'Image updated successfully');
    }

    public function destroy(Image $image)
    {
        Storage::delete('public/' . $image->image_path);
        $image->delete();
        return redirect()->route('images.index')->with('success', 'Image deleted successfully');
    }
}

