@extends('layouts.app')

@section('title', 'Detail Aset: ' . $asset->asset_name)

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card card-custom">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-dark font-monospace fs-6">{{ $asset->asset_code }}</span>
                    <h5 class="fw-bold mb-0 text-dark">{{ $asset->asset_name }}</h5>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-warning btn-sm text-dark fw-semibold">
                        <i class="fa-solid fa-pen-to-square me-1"></i>Edit
                    </a>
                    <a href="{{ route('assets.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa-solid fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-12 col-md-6 border-end">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3">Informasi Utama</h6>

                        <div class="mb-3">
                            <span class="text-muted small d-block">Kode Aset:</span>
                            <span class="fw-bold font-monospace fs-6 text-dark">{{ $asset->asset_code }}</span>
                        </div>

                        <div class="mb-3">
                            <span class="text-muted small d-block">Nama Aset:</span>
                            <span class="fw-bold text-dark fs-5">{{ $asset->asset_name }}</span>
                        </div>

                        <div class="mb-3">
                            <span class="text-muted small d-block">Kategori Aset:</span>
                            <span class="badge bg-primary bg-opacity-10 text-primary fs-7 fw-semibold">
                                <i class="fa-solid fa-tag me-1"></i>{{ $asset->category->name ?? '-' }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <span class="text-muted small d-block">Kondisi Saat Ini:</span>
                            @if($asset->condition == 'Baik')
                                <span class="badge badge-soft-success fs-7"><i class="fa-solid fa-circle-check me-1"></i> Baik / Layak Pakai</span>
                            @else
                                <span class="badge badge-soft-danger fs-7"><i class="fa-solid fa-triangle-exclamation me-1"></i> Rusak / Perlu Perbaikan</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <span class="text-muted small d-block">Status Penggunaan:</span>
                            @if($asset->status == 'Tersedia')
                                <span class="badge badge-soft-info fs-7"><i class="fa-solid fa-box me-1"></i> Tersedia di Gudang / Lokasi</span>
                            @else
                                <span class="badge badge-soft-warning fs-7"><i class="fa-solid fa-user-check me-1"></i> Sedang Dipakai</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <h6 class="fw-bold text-uppercase text-muted small mb-3">Pengadaan & Penempatan</h6>

                        <div class="mb-3">
                            <span class="text-muted small d-block">Supplier / Vendor:</span>
                            <span class="fw-semibold text-dark"><i class="fa-solid fa-truck-field me-2 text-secondary"></i>{{ $asset->supplier->name ?? '-' }}</span>
                            @if($asset->supplier && $asset->supplier->phone)
                                <small class="d-block text-muted">Telp: {{ $asset->supplier->phone }}</small>
                            @endif
                        </div>

                        <div class="mb-3">
                            <span class="text-muted small d-block">Lokasi Penempatan:</span>
                            <span class="fw-semibold text-dark"><i class="fa-solid fa-location-dot me-2 text-danger"></i>{{ $asset->location->name ?? '-' }}</span>
                        </div>

                        <div class="mb-3">
                            <span class="text-muted small d-block">Tanggal Pembelian:</span>
                            <span class="fw-semibold text-dark">
                                <i class="fa-regular fa-calendar me-2 text-primary"></i>
                                {{ $asset->purchase_date ? $asset->purchase_date->format('d M Y') : 'Tidak tercatat' }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <span class="text-muted small d-block">Harga Pembelian / Nilai Aset:</span>
                            <span class="fw-bold text-success fs-5">
                                {{ $asset->purchase_price ? 'Rp ' . number_format($asset->purchase_price, 0, ',', '.') : 'Rp 0' }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <span class="text-muted small d-block">Tanggal Terdaftar Sistem:</span>
                            <small class="text-muted">{{ $asset->created_at ? $asset->created_at->format('d M Y H:i:s') : '-' }}</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light py-3 d-flex justify-content-between align-items-center">
                <small class="text-muted">Terakhir diperbarui: {{ $asset->updated_at ? $asset->updated_at->diffForHumans() : '-' }}</small>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete('delete-form-detail', '{{ $asset->asset_name }}')">
                    <i class="fa-solid fa-trash me-1"></i>Hapus Aset Ini
                </button>
                <form id="delete-form-detail" action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
