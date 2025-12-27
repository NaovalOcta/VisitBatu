<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Penting untuk hapus gambar

class TripController extends Controller
{
    // 1. TAMPILKAN DATA (INDEX)
    public function index()
    {
        $trips = Trip::latest()->paginate(10);
        return view('trips_page', compact('trips'));
    }

    // 2. FORM TAMBAH DATA (CREATE)
    public function create()
    {
        return view('trips.create');
    }

    // 3. PROSES SIMPAN DATA (STORE)
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'title'       => 'required|max:255',
            'slug'        => 'required|unique:trips',
            'location'    => 'required',
            'price'       => 'required|numeric',
            'duration'    => 'required',
            'description' => 'required',
            'thumbnail'   => 'image|file|max:2048'
        ]);

        // Upload Gambar
        if ($request->file('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('trip-images', 'public');
        }

        Trip::create($validated);

        return redirect()->route('trips.index')->with('success', 'Data wisata berhasil ditambahkan!');
    }

    // 4. DETAIL DATA (SHOW)
    public function show(Trip $trip)
    {
        return view('trips.show', compact('trip'));
    }

    // 5. FORM EDIT DATA (EDIT)
    public function edit(Trip $trip)
    {
        return view('trips.edit', compact('trip'));
    }

    // 6. PROSES UPDATE DATA (UPDATE)
    public function update(Request $request, Trip $trip)
    {
        $rules = [
            'title'       => 'required|max:255',
            'slug'        => 'required|unique:trips,slug,' . $trip->id, // Pengecualian unique untuk ID ini
            'location'    => 'required',
            'price'       => 'required|numeric',
            'duration'    => 'required',
            'description' => 'required',
            'thumbnail'   => 'image|file|max:2048'
        ];

        $validated = $request->validate($rules);

        // Cek jika ada gambar baru
        if ($request->file('thumbnail')) {
            // Hapus gambar lama
            if ($trip->thumbnail) {
                Storage::delete('public/' . $trip->thumbnail);
            }
            // Simpan gambar baru
            $validated['thumbnail'] = $request->file('thumbnail')->store('trip-images', 'public');
        }

        $trip->update($validated);

        return redirect()->route('trips.index')->with('success', 'Data wisata berhasil diperbarui!');
    }

    // 7. HAPUS DATA (DESTROY)
    public function destroy(Trip $trip)
    {
        // Hapus gambar dari storage
        if ($trip->thumbnail) {
            Storage::delete('public/' . $trip->thumbnail);
        }

        $trip->delete();

        return redirect()->route('trips.index')->with('success', 'Data wisata berhasil dihapus!');
    }
}
