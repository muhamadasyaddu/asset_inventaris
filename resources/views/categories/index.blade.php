@extends('layouts.app')

@section('title', 'Manajemen Kategori Aset')

@section('content')
<div class="card card-custom">
    <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between gap-3 border-bottom">
        <div>
            <h5 class="fw-bold mb-0 text-dark">
                <i class="fa-solid fa-tags me-2 text-primary"></i>Daftar Kategori Aset
            </h5>
            <span class="text-muted small">Kelola pengelompokan jenis inventaris aset Anda</span>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary-custom btn-sm">
            <i class="fa-solid fa-plus me-1"></i>Tambah Kategori
        </a>
    </div>

    <div class="p-3 bg-light border-bottom">
        <form method="GET" action="{{ route('categories.index') }}" class="row g-2">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau deskripsi kategori..." value="{{ $search }}">
                    @if($search)
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary" title="Reset Search">
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
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Aset Terikat</th>
                    <th>Tanggal Dibuat</th>
                    <th class="text-center" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $category)
                    <tr>
                        <td>{{ $categories->firstItem() + $index }}</td>
                        <td class="fw-bold text-dark">{{ $category->name }}</td>
                        <td>{{ $category->description ?? '-' }}</td>
                        <td>
                            <span class="badge bg-primary bg-opacity-10 text-primary fw-semibold px-2 py-1">
                                <i class="fa-solid fa-boxes-stacked me-1"></i> {{ $category->assets_count }} Unit Aset
                            </span>
                        </td>
                        <td><small class="text-muted">{{ $category->created_at ? $category->created_at->format('d M Y H:i') : '-' }}</small></td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-light border" title="Detail">
                                    <i class="fa-solid fa-eye text-primary"></i>
                                </a>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-light border" title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-warning"></i>
                                </a>
                                <button type="button" class="btn btn-light border" title="Hapus" onclick="confirmDelete('delete-form-{{ $category->id }}', '{{ $category->name }}')">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </button>
                            </div>
                            <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="fa-solid fa-folder-open fs-2 mb-2 d-block text-secondary opacity-50"></i>
                            Tidak ada data kategori ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($categories->hasPages())
        <div class="card-footer bg-white py-3">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
