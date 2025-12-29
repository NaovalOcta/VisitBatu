@extends('admin.layout')

@section('admin_content')
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold text-dark">Kelola Wisata</h2>
            <p class="text-muted mb-0">Daftar semua destinasi wisata di Kota Batu.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('admin.trips.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="icon-plus me-2"></i> Tambah Wisata
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
            <i class="icon-check_circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 text-secondary small text-uppercase fw-bold">Wisata</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold">Lokasi</th>
                            <th class="py-3 text-secondary small text-uppercase fw-bold">Harga Tiket</th>
                            <th class="px-4 py-3 text-secondary small text-uppercase fw-bold text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($trips as $trip)
                            <tr>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $trip->thumbnail) }}" alt="{{ $trip->title }}"
                                            class="rounded-3 object-fit-cover shadow-sm me-3"
                                            style="width: 60px; height: 60px;">
                                        <div>
                                            <h6 class="fw-bold mb-0 text-dark">{{ $trip->title }}</h6>
                                            <small class="text-muted">Slug: {{ $trip->slug }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-muted"><i class="icon-map-marker me-1 text-danger"></i>
                                    {{ $trip->location }}</td>
                                <td class="fw-bold text-success">Rp {{ number_format($trip->price, 0, ',', '.') }}</td>
                                <td class="px-4 text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.trips.edit', $trip->id) }}"
                                            class="btn btn-sm btn-outline-primary rounded-start-pill px-3">
                                            <i class="icon-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.trips.destroy', $trip->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus wisata ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-danger rounded-end-pill px-3">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="text-muted d-flex flex-column align-items-center">
                                        <i class="icon-image display-4 mb-3 opacity-25"></i>
                                        <span class="fw-medium">Belum ada data wisata yang ditambahkan.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($trips->hasPages())
            <div class="card-footer bg-white border-0 py-3 px-4">
                {{ $trips->links() }}
            </div>
        @endif
    </div>
@endsection
