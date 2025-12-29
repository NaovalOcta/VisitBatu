@extends('admin.layout')

@section('admin_content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 text-black mb-0">Edit Destinasi Wisata</h2>
        <a href="{{ route('admin.trips.index') }}" class="btn btn-secondary btn-sm rounded-pill px-3">Kembali</a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            {{-- Form harus menggunakan POST dan @method('PUT') --}}
            <form action="{{ route('admin.trips.update', $trip->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="form-label fw-bold">Nama Wisata</label>
                    <input type="text" name="title" class="form-control bg-light border-0"
                        value="{{ old('title', $trip->title) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">Lokasi</label>
                        <input type="text" name="location" class="form-control bg-light border-0"
                            value="{{ old('location', $trip->location) }}" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">Durasi</label>
                        <input type="text" name="duration" class="form-control bg-light border-0"
                            value="{{ old('duration', $trip->duration) }}" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Harga Tiket (Rp)</label>
                    <input type="number" name="price" class="form-control bg-light border-0"
                        value="{{ old('price', $trip->price) }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea name="description" class="form-control bg-light border-0" rows="5" required>{{ old('description', $trip->description) }}</textarea>
                </div>

                <div class="mb-5">
                    <label class="form-label fw-bold">Foto Wisata</label>
                    <div class="d-flex align-items-center mb-3">
                        @if ($trip->thumbnail)
                            <img src="{{ asset('storage/' . $trip->thumbnail) }}" class="rounded shadow-sm me-3"
                                style="width: 100px; height: 100px; object-fit: cover;">
                        @endif
                        <input type="file" name="thumbnail" class="form-control">
                    </div>
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">Perbarui Data
                        Wisata</button>
                </div>
            </form>
        </div>
    </div>
@endsection
