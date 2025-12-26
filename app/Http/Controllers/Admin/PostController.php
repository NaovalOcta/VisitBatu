<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TripController extends Controller
{
    /**
     * Menampilkan daftar semua trip (Read).
     */
    public function index()
    {
        // Mengambil data terbaru dengan paginasi (misal 10 per halaman)
        $trips = Trip::latest()->paginate(10);

        return view('trips.index', compact('trips'));
    }

    /**
     * Menampilkan form untuk membuat trip baru (Create).
     */
    public function create()
    {
        return view('trips.create');
    }

    /**
     * Menyimpan data trip baru ke database (Store).
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|unique:trips,slug',
            'location'    => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'duration'    => 'required|string|max:100', // misal: "3 Hari 2 Malam"
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi Gambar
        ]);

        // 2. Handle Upload Gambar (Jika ada)
        if ($request->hasFile('thumbnail')) {
            // Simpan ke folder 'public/trips' dan ambil path-nya
            $imagePath = $request->file('thumbnail')->store('trips', 'public');
            $validatedData['thumbnail'] = $imagePath;
        }

        // 3. Simpan ke Database
        Trip::create($validatedData);

        // 4. Redirect dengan pesan sukses
        return redirect()->route('trips.index')->with('success', 'Trip berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail trip spesifik (Show).
     */
    public function show(Trip $trip)
    {
        return view('trips.show', compact('trip'));
    }

    /**
     * Menampilkan form untuk mengedit trip (Edit).
     */
    public function edit(Trip $trip)
    {
        return view('trips.edit', compact('trip'));
    }

    /**
     * Memperbarui data trip di database (Update).
     */
    public function update(Request $request, Trip $trip)
    {
        // 1. Validasi Input
        $rules = [
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|unique:trips,slug,' . $trip->id, // Abaikan unique untuk ID ini
            'location'    => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'duration'    => 'required|string|max:100',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $validatedData = $request->validate($rules);

        // 2. Handle Upload Gambar Baru (Jika ada)
        if ($request->hasFile('thumbnail')) {
            // Hapus gambar lama jika ada
            if ($trip->thumbnail && Storage::disk('public')->exists($trip->thumbnail)) {
                Storage::disk('public')->delete($trip->thumbnail);
            }

            // Upload gambar baru
            $imagePath = $request->file('thumbnail')->store('trips', 'public');
            $validatedData['thumbnail'] = $imagePath;
        }

        // 3. Update Database
        $trip->update($validatedData);

        // 4. Redirect
        return redirect()->route('trips.index')->with('success', 'Trip berhasil diperbarui!');
    }

    /**
     * Menghapus trip dari database (Delete).
     */
    public function destroy(Trip $trip)
    {
        // 1. Hapus gambar fisik dari storage jika ada
        if ($trip->thumbnail && Storage::disk('public')->exists($trip->thumbnail)) {
            Storage::disk('public')->delete($trip->thumbnail);
        }

        // 2. Hapus record dari database
        $trip->delete();

        // 3. Redirect
        return redirect()->route('trips.index')->with('success', 'Trip berhasil dihapus!');
    }
}
