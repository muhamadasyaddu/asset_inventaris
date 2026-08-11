@extends('layouts.app')

@section('title', 'Manajemen Data Aset')

@section('content')
<div class="card card-custom">
    <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between gap-3 border-bottom">
        <div>
            <h5 class="fw-bold mb-0 text-dark">
                <i class="fa-solid fa-box-archive me-2 text-primary"></i>Daftar Master Aset Inventaris
            </h5>
            <span class="text-muted small">Kelola seluruh barang, peralatan, dan aset inventaris perusahaan</span>
        </div>
        <a href="{{ route('assets.create') }}" class="btn btn-primary-custom btn-sm">
            <i class="fa-solid fa-plus me-1"></i>Tambah Aset Baru
        </a>
    </div>

    <!-- Multi-Filter & Search Area -->
    <div class="p-3 bg-light border-bottom">
        <form method="GET" action="{{ route('assets.index') }}" class="row g-2">
            <div class="col-12 col-md-3">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari Kode atau Nama Aset..." value="{{ $search }}">
            </div>

            <div class="col-6 col-md-2">
                <select name="category_id" class="form-select form-select-sm">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6 col-md-2">
                <select name="supplier_id" class="form-select form-select-sm">
                    <option value="">-- Semua Supplier --</option>
                    @foreach($suppliers as $sup)
                        <option value="{{ $sup->id }}" {{ $supplierId == $sup->id ? 'selected' : '' }}>{{ $sup->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6 col-md-2">
                <select name="location_id" class="form-select form-select-sm">
                    <option value="">-- Semua Lokasi --</option>
                    @foreach($locations as $loc)
                        <option value="{{ $loc->id }}" {{ $locationId == $loc->id ? 'selected' : '' }}>{{ $loc->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6 col-md-1">
                <select name="condition" class="form-select form-select-sm">
                    <option value="">-- Kondisi --</option>
                    <option value="Baik" {{ $condition == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Rusak" {{ $condition == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                </select>
            </div>

            <div class="col-6 col-md-1">
                <select name="status" class="form-select form-select-sm">
                    <option value="">-- Status --</option>
                    <option value="Tersedia" {{ $status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Dipakai" {{ $status == 'Dipakai' ? 'selected' : '' }}>Dipakai</option>
                </select>
            </div>

            <div class="col-12 col-md-1 d-flex gap-1">
                <button type="submit" class="btn btn-primary btn-sm flex-fill" title="Terapkan Filter">
                    <i class="fa-solid fa-filter"></i>
                </button>
                @if($search || $categoryId || $supplierId || $locationId || $condition || $status)
                    <a href="{{ route('assets.index') }}" class="btn btn-outline-secondary btn-sm" title="Reset Filter">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <div class="table-responsive">
        <table class="table table-custom">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Kode Aset</th>
                    <th>Nama Aset</th>
                    <th>Kategori</th>
                    <th>Supplier</th>
                    <th>Lokasi</th>
                    <th>Harga Beli</th>
                    <th>Kondisi</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($assets as $index => $asset)
                    <tr>
                        <td>{{ $assets->firstItem() + $index }}</td>
                        <td><span class="badge bg-dark font-monospace fs-7">{{ $asset->asset_code }}</span></td>
                        <td class="fw-semibold text-dark">{{ $asset->asset_name }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $asset->category->name ?? '-' }}</span></td>
                        <td><small>{{ $asset->supplier->name ?? '-' }}</small></td>
                        <td><small><i class="fa-solid fa-location-dot text-danger me-1"></i>{{ $asset->location->name ?? '-' }}</small></td>
                        <td class="fw-bold text-dark">
                            {{ $asset->purchase_price ? 'Rp ' . number_format($asset->purchase_price, 0, ',', '.') : '-' }}
                        </td>
                        <td>
                            @if($asset->condition == 'Baik')
                                <span class="badge badge-soft-success"><i class="fa-solid fa-check me-1"></i> Baik</span>
                            @else
                                <span class="badge badge-soft-danger"><i class="fa-solid fa-triangle-exclamation me-1"></i> Rusak</span>
                            @endif
                        </td>
                        <td>
                            @if($asset->status == 'Tersedia')
                                <span class="badge badge-soft-info"><i class="fa-solid fa-box me-1"></i> Tersedia</span>
                            @else
                                <span class="badge badge-soft-warning"><i class="fa-solid fa-user me-1"></i> Dipakai</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('assets.show', $asset->id) }}" class="btn btn-light border" title="Detail">
                                    <i class="fa-solid fa-eye text-primary"></i>
                                </a>
                                <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-light border" title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-warning"></i>
                                </a>
                                <button type="button" class="btn btn-light border" title="Hapus" onclick="confirmDelete('delete-form-{{ $asset->id }}', '{{ $asset->asset_name }} ({{ $asset->asset_code }})')">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </button>
                            </div>
                            <form id="delete-form-{{ $asset->id }}" action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center py-4 text-muted">
                            <i class="fa-solid fa-box-open fs-2 mb-2 d-block text-secondary opacity-50"></i>
                            Tidak ada data aset ditemukan sesuai kriteria filter.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($assets->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $assets->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
