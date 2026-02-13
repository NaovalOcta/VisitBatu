<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trip;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Tambahkan ini untuk Slug otomatis

class TripController extends Controller
{
    // 1. TAMPILKAN DATA
    public function index()
    {
        $trips = Trip::latest()->paginate(10);
        // Perbaikan path view: admin.trips.index
        return view('admin.trips.index', compact('trips'));
    }

    // 2. FORM TAMBAH DATA
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('admin.trips.create', compact('categories'));
    }

    // 3. PROSES SIMPAN DATA
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'title'       => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            // Slug tidak perlu divalidasi dari input, kita buat otomatis
            'location'    => 'required',
            'price'       => 'required|numeric',
            'duration'    => 'required',
            'description' => 'required',
            'thumbnail'   => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Wajibkan ada gambar
            'map_iframe'  => 'nullable|string',
            'latitude'    => 'nullable|numeric',
            'longitude'   => 'nullable|numeric',
        ]);

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Trip::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $data = [
            'title'       => $request->title,
            'category_id' => $request->category_id,
            'slug'        => $slug,
            'location'    => $request->location,
            'price'       => $request->price,
            'duration'    => $request->duration,
            'description' => $request->description,
            'map_iframe'  => $request->map_iframe,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
        ];

        // Upload Gambar
        if ($request->hasFile('thumbnail')) {
            // Simpan ke folder: public/storage/trip-images
            $path = $request->file('thumbnail')->store('trip-images', 'public');
            $data['thumbnail'] = $path;
        }

        Trip::create($data);

        return redirect()->route('admin.trips.index')->with('success', 'Data wisata berhasil ditambahkan!');
    }

    // 4. FORM EDIT DATA
    public function edit(Trip $trip)
    {
        $categories = Category::all();
        return view('admin.trips.edit', compact('trip', 'categories'));
    }

    public function update(Request $request, Trip $trip)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'location'    => 'required',
            'price'       => 'required|numeric',
            'duration'    => 'required',
            'description' => 'required',
            'thumbnail'   => 'nullable|image|file|max:2048',
            'map_iframe'  => 'nullable|string',
            'latitude'    => 'nullable|numeric',
            'longitude'   => 'nullable|numeric',
        ]);

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Trip::where('slug', $slug)->where('id', '!=', $trip->id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $data = [
            'title'       => $request->title,
            'category_id' => $request->category_id,
            'slug'        => $slug,
            'location'    => $request->location,
            'price'       => $request->price,
            'duration'    => $request->duration,
            'description' => $request->description,
            'map_iframe'  => $request->map_iframe,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
        ];

        if ($request->hasFile('thumbnail')) {
            if ($trip->thumbnail && Storage::exists('public/' . $trip->thumbnail)) {
                Storage::delete('public/' . $trip->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('trip-images', 'public');
        }

        $trip->update($data);

        return redirect()->route('admin.trips.index')->with('success', 'Data wisata berhasil diperbarui!');
    }

    // 6. HAPUS DATA
    public function destroy(Trip $trip)
    {
        if ($trip->thumbnail && Storage::exists('public/' . $trip->thumbnail)) {
            Storage::delete('public/' . $trip->thumbnail);
        }

        $trip->delete();

        return redirect()->route('admin.trips.index')->with('success', 'Data wisata berhasil dihapus!');
    }
}
