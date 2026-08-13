@extends('layouts.app')

@section('title', 'Detail Lokasi: ' . $location->name)

@section('content')
<div class="row g-4">
    <div class="col-12 col-md-4">
        <div class="card card-custom">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="fa-solid fa-map-location-dot me-2 text-primary"></i>Informasi Lokasi
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <span class="text-muted small d-block">Nama Lokasi / Ruangan:</span>
                    <h5 class="fw-bold text-dark mb-0">{{ $location->name }}</h5>
                </div>

                <div class="mb-3">
                    <span class="text-muted small d-block">Deskripsi / Detail Posisi:</span>
                    <p class="text-secondary mb-0">{{ $location->description ?: 'Tidak ada deskripsi.' }}</p>
                </div>

                <div class="mb-3">
                    <span class="text-muted small d-block">Total Aset Ditempatkan:</span>
                    <span class="badge bg-success fs-6 fw-semibold mt-1">
                        <i class="fa-solid fa-box-open me-1"></i> {{ $location->assets->count() }} Unit
                    </span>
                </div>

                <div class="border-top pt-3 mt-3 d-flex gap-2">
                    <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-warning btn-sm text-dark fw-semibold">
                        <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                    </a>
                    <a href="{{ route('locations.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa-solid fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-8">
        <div class="card card-custom">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="fa-solid fa-boxes-stacked me-2 text-primary"></i>Daftar Aset Di Ruangan Ini
                </h5>
            </div>
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th>Kode Aset</th>
                            <th>Nama Aset</th>
                            <th>Kategori</th>
                            <th>Supplier</th>
                            <th>Kondisi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($location->assets as $asset)
                            <tr>
                                <td><span class="badge bg-dark font-monospace">{{ $asset->asset_code }}</span></td>
                                <td class="fw-semibold">{{ $asset->asset_name }}</td>
                                <td>{{ $asset->category->name ?? '-' }}</td>
                                <td>{{ $asset->supplier->name ?? '-' }}</td>
                                <td>
                                    @if($asset->condition == 'Baik')
                                        <span class="badge badge-soft-success">Baik</span>
                                    @else
                                        <span class="badge badge-soft-danger">Rusak</span>
                                    @endif
                                </td>
                                <td>
                                    @if($asset->status == 'Tersedia')
                                        <span class="badge badge-soft-info">Tersedia</span>
                                    @else
                                        <span class="badge badge-soft-warning">Dipakai</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Belum ada aset ditempatkan di lokasi ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
