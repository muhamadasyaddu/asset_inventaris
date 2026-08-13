@extends('layouts.app')

@section('title', 'Dashboard Overview')

@section('content')
<div class="row g-3 mb-4">
    <!-- Total Assets Widget -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card shadow-sm">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted fw-semibold small">TOTAL ASET</span>
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="fa-solid fa-box-archive"></i>
                </div>
            </div>
            <h3 class="fw-bold mb-1 text-dark">{{ number_format($totalAssets) }}</h3>
            <span class="text-muted small">Unit terdaftar dalam sistem</span>
        </div>
    </div>

    <!-- Total Asset Value Widget -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card shadow-sm">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted fw-semibold small">TOTAL NILAI ASET</span>
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>
            </div>
            <h3 class="fw-bold mb-1 text-dark">Rp {{ number_format($totalValue, 0, ',', '.') }}</h3>
            <span class="text-muted small">Akumulasi estimasi pembelian</span>
        </div>
    </div>

    <!-- Condition Summary Widget -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card shadow-sm">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted fw-semibold small">KONDISI ASET</span>
                <div class="stat-icon bg-info bg-opacity-10 text-info">
                    <i class="fa-solid fa-heart-pulse"></i>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div>
                    <span class="badge badge-soft-success me-1"><i class="fa-solid fa-check me-1"></i> {{ $conditionBaikCount }} Baik</span>
                </div>
                <div>
                    <span class="badge badge-soft-danger me-1"><i class="fa-solid fa-triangle-exclamation me-1"></i> {{ $conditionRusakCount }} Rusak</span>
                </div>
            </div>
            <span class="text-muted small mt-2 d-block">Status kelaikan operasional</span>
        </div>
    </div>

    <!-- Status Usage Widget -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card shadow-sm">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted fw-semibold small">STATUS PENGGUNAAN</span>
                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                    <i class="fa-solid fa-arrows-spin"></i>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div>
                    <span class="badge badge-soft-info me-1"><i class="fa-solid fa-circle-check me-1"></i> {{ $statusTersediaCount }} Tersedia</span>
                </div>
                <div>
                    <span class="badge badge-soft-warning me-1"><i class="fa-solid fa-user-check me-1"></i> {{ $statusDipakaiCount }} Dipakai</span>
                </div>
            </div>
            <span class="text-muted small mt-2 d-block">Ketersediaan unit inventaris</span>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <!-- Master Data Cards -->
    <div class="col-12 col-md-4">
        <div class="card card-custom p-3 d-flex flex-row align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <div class="p-3 bg-secondary bg-opacity-10 rounded-3 text-secondary">
                    <i class="fa-solid fa-tags fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0">Kategori Aset</h6>
                    <span class="text-muted small">{{ $totalCategories }} Jenis Kategori</span>
                </div>
            </div>
            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
                Kelola <i class="fa-solid fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card card-custom p-3 d-flex flex-row align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <div class="p-3 bg-secondary bg-opacity-10 rounded-3 text-secondary">
                    <i class="fa-solid fa-truck-field fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0">Supplier / Vendor</h6>
                    <span class="text-muted small">{{ $totalSuppliers }} Mitras Terdaftar</span>
                </div>
            </div>
            <a href="{{ route('suppliers.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
                Kelola <i class="fa-solid fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card card-custom p-3 d-flex flex-row align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <div class="p-3 bg-secondary bg-opacity-10 rounded-3 text-secondary">
                    <i class="fa-solid fa-location-dot fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-0">Lokasi Penempatan</h6>
                    <span class="text-muted small">{{ $totalLocations }} Ruang / Gedung</span>
                </div>
            </div>
            <a href="{{ route('locations.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
                Kelola <i class="fa-solid fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>

<!-- Recent Assets Table -->
<div class="card card-custom mb-4">
    <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between border-bottom">
        <h5 class="fw-bold mb-0 text-dark">
            <i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>Aset Terbaru Ditambahkan
        </h5>
        <a href="{{ route('assets.create') }}" class="btn btn-primary-custom btn-sm">
            <i class="fa-solid fa-plus me-1"></i>Tambah Aset Baru
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-custom">
            <thead>
                <tr>
                    <th>Kode Aset</th>
                    <th>Nama Aset</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Harga Pembelian</th>
                    <th>Kondisi</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentAssets as $asset)
                    <tr>
                        <td><span class="badge bg-dark font-monospace fs-7">{{ $asset->asset_code }}</span></td>
                        <td class="fw-semibold">{{ $asset->asset_name }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $asset->category->name ?? '-' }}</span></td>
                        <td><i class="fa-solid fa-location-dot text-danger me-1"></i> {{ $asset->location->name ?? '-' }}</td>
                        <td class="fw-bold text-dark">
                            {{ $asset->purchase_price ? 'Rp ' . number_format($asset->purchase_price, 0, ',', '.') : '-' }}
                        </td>
                        <td>
                            @if($asset->condition == 'Baik')
                                <span class="badge badge-soft-success"><i class="fa-solid fa-check-circle me-1"></i> Baik</span>
                            @else
                                <span class="badge badge-soft-danger"><i class="fa-solid fa-circle-exclamation me-1"></i> Rusak</span>
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
                            <a href="{{ route('assets.show', $asset->id) }}" class="btn btn-sm btn-light border" title="Lihat Detail">
                                <i class="fa-solid fa-eye text-primary"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            <i class="fa-solid fa-box-open fs-2 mb-2 d-block text-secondary opacity-50"></i>
                            Belum ada data aset terdaftar. <a href="{{ route('assets.create') }}">Tambah Aset Pertama</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
