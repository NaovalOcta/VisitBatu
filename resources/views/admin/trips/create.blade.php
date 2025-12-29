@extends('admin.layout')

@section('admin_content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 text-black mb-0">Tambah Wisata Baru</h2>
        <a href="{{ route('admin.trips.index') }}" class="btn btn-secondary rounded-pill btn-sm">
            &larr; Kembali
        </a>
    </div>

    {{-- Tampilkan Error Validasi (PENTING UNTUK DEBUGGING) --}}
    @if ($errors->any())
        <div class="alert alert-danger rounded-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.trips.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="form-label fw-bold">Nama Wisata (Title)</label>
                    <input type="text" name="title" class="form-control form-control-lg bg-light border-0"
                        value="{{ old('title') }}" placeholder="Contoh: Jatim Park 1" required>
                </div>

                <div class="row">
                    {{-- Input Slug DIHAPUS, diganti otomatis di Controller --}}

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">Lokasi</label>
                        <input type="text" name="location" class="form-control bg-light border-0"
                            value="{{ old('location') }}" placeholder="Alamat lengkap" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">Durasi</label>
                        <input type="text" name="duration" class="form-control bg-light border-0"
                            placeholder="Contoh: 1 Hari / 3 Jam" value="{{ old('duration') }}" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Harga Tiket (Rp)</label>
                    <input type="number" name="price" class="form-control bg-light border-0" value="{{ old('price') }}"
                        placeholder="0" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea name="description" class="form-control bg-light border-0" rows="5" required>{{ old('description') }}</textarea>
                </div>

                <div class="mb-5">
                    <label class="form-label fw-bold">Foto Utama (Thumbnail)</label>
                    <input type="file" name="thumbnail" class="form-control" accept="image/*" required>
                    <small class="text-muted">Format: JPG, PNG. Maks 2MB.</small>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                        Simpan Data Wisata
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
