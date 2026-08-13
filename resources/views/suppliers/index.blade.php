@extends('layouts.app')

@section('title', 'Manajemen Supplier / Vendor')

@section('content')
<div class="card card-custom">
    <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between gap-3 border-bottom">
        <div>
            <h5 class="fw-bold mb-0 text-dark">
                <i class="fa-solid fa-truck-field me-2 text-primary"></i>Daftar Supplier & Vendor
            </h5>
            <span class="text-muted small">Kelola penyedia / vendor pengadaan aset perusahaan</span>
        </div>
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary-custom btn-sm">
            <i class="fa-solid fa-plus me-1"></i>Tambah Supplier
        </a>
    </div>

    <div class="p-3 bg-light border-bottom">
        <form method="GET" action="{{ route('suppliers.index') }}" class="row g-2">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Cari nama, telepon, email, atau alamat..." value="{{ $search }}">
                    @if($search)
                        <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary" title="Reset Search">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    @endif
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-custom">
            <thead>
                <tr>
                    <th style="width: 60px;">#</th>
                    <th>Nama Supplier</th>
                    <th>No. Telepon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Total Aset Suplai</th>
                    <th class="text-center" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $index => $supplier)
                    <tr>
                        <td>{{ $suppliers->firstItem() + $index }}</td>
                        <td class="fw-bold text-dark">{{ $supplier->name }}</td>
                        <td>
                            @if($supplier->phone)
                                <i class="fa-solid fa-phone me-1 text-success small"></i> {{ $supplier->phone }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($supplier->email)
                                <i class="fa-solid fa-envelope me-1 text-primary small"></i> {{ $supplier->email }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td><small>{{ Str::limit($supplier->address, 40) ?: '-' }}</small></td>
                        <td>
                            <span class="badge bg-info bg-opacity-10 text-info fw-semibold px-2 py-1">
                                <i class="fa-solid fa-box me-1"></i> {{ $supplier->assets_count }} Aset
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-light border" title="Detail">
                                    <i class="fa-solid fa-eye text-primary"></i>
                                </a>
                                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-light border" title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-warning"></i>
                                </a>
                                <button type="button" class="btn btn-light border" title="Hapus" onclick="confirmDelete('delete-form-{{ $supplier->id }}', '{{ $supplier->name }}')">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </button>
                            </div>
                            <form id="delete-form-{{ $supplier->id }}" action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="fa-solid fa-truck-ramp-box fs-2 mb-2 d-block text-secondary opacity-50"></i>
                            Tidak ada data supplier ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($suppliers->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $suppliers->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
