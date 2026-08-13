@extends('layouts.app')

@section('title', 'Detail Kategori: ' . $category->name)

@section('content')
<div class="row g-4">
    <div class="col-12 col-md-4">
        <div class="card card-custom">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="fa-solid fa-folder-open me-2 text-primary"></i>Informasi Kategori
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <span class="text-muted small d-block">Nama Kategori:</span>
                    <h5 class="fw-bold text-dark mb-0">{{ $category->name }}</h5>
                </div>

                <div class="mb-3">
                    <span class="text-muted small d-block">Deskripsi:</span>
                    <p class="text-secondary mb-0">{{ $category->description ?: 'Tidak ada deskripsi.' }}</p>
                </div>

                <div class="mb-3">
                    <span class="text-muted small d-block">Total Aset Terikat:</span>
                    <span class="badge bg-primary fs-6 fw-semibold mt-1">
                        <i class="fa-solid fa-boxes-stacked me-1"></i> {{ $category->assets->count() }} Unit
                    </span>
                </div>

                <div class="border-top pt-3 mt-3 d-flex gap-2">
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm text-dark fw-semibold">
                        <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                    </a>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-sm">
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
                    <i class="fa-solid fa-list-check me-2 text-primary"></i>Aset Dalam Kategori Ini
                </h5>
            </div>
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th>Kode Aset</th>
                            <th>Nama Aset</th>
                            <th>Supplier</th>
                            <th>Lokasi</th>
                            <th>Kondisi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($category->assets as $asset)
                            <tr>
                                <td><span class="badge bg-dark font-monospace">{{ $asset->asset_code }}</span></td>
                                <td class="fw-semibold">{{ $asset->asset_name }}</td>
                                <td>{{ $asset->supplier->name ?? '-' }}</td>
                                <td>{{ $asset->location->name ?? '-' }}</td>
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
                                    Belum ada aset dalam kategori ini.
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
