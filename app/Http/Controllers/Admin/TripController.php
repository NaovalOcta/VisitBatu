<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Tambahkan ini untuk Slug otomatis
use Illuminate\Support\Facades\Storage;

class TripController extends Controller
{
    // 1. TAMPILKAN DATA
    public function index(Request $request)
    {
        // 1. Inisialisasi Query
        $query = Trip::query();

        // 2. Filter: Pencarian (Search)
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // 3. Filter: Kategori (Checkbox array)
        if ($request->has('categories')) {
            $query->whereIn('category', $request->categories);
        }

        // 4. Filter: Range Harga (Maksimal Harga)
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // 5. Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default: // 'rekomendasi'
                    $query->inRandomOrder(); // Atau logika rekomendasi lainnya
                    break;
            }
        } else {
            $query->latest(); // Default sort jika tidak ada pilihan
        }

        // 6. Pagination & Query String Preservation
        // withQueryString() PENTING agar filter tidak hilang saat pindah halaman (page 1 ke 2)
        $trips = $query->paginate(8)->withQueryString();

        return view('trips_page', compact('trips'));
    }

    // 2. FORM TAMBAH DATA
    public function create()
    {
        // Perbaikan path view: admin.trips.create
        return view('admin.trips.create');
    }

    // 3. PROSES SIMPAN DATA
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'title'       => 'required|max:255',
            // Slug tidak perlu divalidasi dari input, kita buat otomatis
            'location'    => 'required',
            'price'       => 'required|numeric',
            'duration'    => 'required',
            'description' => 'required',
            'thumbnail'   => 'required|image|mimes:jpeg,png,jpg,webp|max:2048' // Wajibkan ada gambar
        ]);

        $data = [
            'title'       => $request->title,
            'slug'        => Str::slug($request->title), // Auto-generate slug dari title
            'location'    => $request->location,
            'price'       => $request->price,
            'duration'    => $request->duration,
            'description' => $request->description,
        ];

        // Upload Gambar
        if ($request->hasFile('thumbnail')) {
            // Simpan ke folder: public/storage/trip-images
            $path = $request->file('thumbnail')->store('trip-images', 'public');
            $data['thumbnail'] = $path;
        }

        Trip::create($data);

        // Perbaikan route redirect: admin.trips.index
        return redirect()->route('admin.trips.index')->with('success', 'Data wisata berhasil ditambahkan!');
    }

    // 4. FORM EDIT DATA
    public function edit(Trip $trip)
    {
        // Pastikan path view sesuai folder: resources/views/admin/trips/edit.blade.php
        return view('admin.trips.edit', compact('trip'));
    }

    public function update(Request $request, Trip $trip)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'location'    => 'required',
            'price'       => 'required|numeric',
            'duration'    => 'required',
            'description' => 'required',
            'thumbnail'   => 'nullable|image|file|max:2048' // Nullable karena tidak wajib ganti gambar
        ]);

        $data = [
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'location'    => $request->location,
            'price'       => $request->price,
            'duration'    => $request->duration,
            'description' => $request->description,
        ];

        // Logika Penggantian Gambar
        if ($request->hasFile('thumbnail')) {
            // Hapus gambar lama jika ada di storage
            if ($trip->thumbnail && Storage::exists('public/' . $trip->thumbnail)) {
                Storage::delete('public/' . $trip->thumbnail);
            }
            // Simpan gambar baru
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
