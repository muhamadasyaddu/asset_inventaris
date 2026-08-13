@extends('layouts.app')

@section('title', 'Edit Data Aset')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-10">
        <div class="card card-custom">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between border-bottom">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="fa-solid fa-pen-to-square me-2 text-warning"></i>Edit Data Aset: {{ $asset->asset_name }}
                </h5>
                <a href="{{ route('assets.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa-solid fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('assets.update', $asset->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3 mb-3">
                        <!-- Kode Aset Unik -->
                        <div class="col-12 col-md-4">
                            <label for="asset_code" class="form-label fw-semibold">Kode Aset Unik <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa-solid fa-barcode"></i></span>
                                <input type="text" name="asset_code" id="asset_code" class="form-control @error('asset_code') is-invalid @enderror font-monospace fw-bold" value="{{ old('asset_code', $asset->asset_code) }}" required>
                            </div>
                            @error('asset_code')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Aset -->
                        <div class="col-12 col-md-8">
                            <label for="asset_name" class="form-label fw-semibold">Nama Barang / Aset <span class="text-danger">*</span></label>
                            <input type="text" name="asset_name" id="asset_name" class="form-control @error('asset_name') is-invalid @enderror" value="{{ old('asset_name', $asset->asset_name) }}" required>
                            @error('asset_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <!-- Kategori -->
                        <div class="col-12 col-md-4">
                            <label for="category_id" class="form-label fw-semibold">Kategori Aset <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $asset->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Supplier -->
                        <div class="col-12 col-md-4">
                            <label for="supplier_id" class="form-label fw-semibold">Supplier / Vendor <span class="text-danger">*</span></label>
                            <select name="supplier_id" id="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Supplier --</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id', $asset->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div class="col-12 col-md-4">
                            <label for="location_id" class="form-label fw-semibold">Lokasi Penempatan <span class="text-danger">*</span></label>
                            <select name="location_id" id="location_id" class="form-select @error('location_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Lokasi --</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ old('location_id', $asset->location_id) == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('location_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <!-- Tanggal Pembelian -->
                        <div class="col-12 col-md-3">
                            <label for="purchase_date" class="form-label fw-semibold">Tanggal Pembelian</label>
                            <input type="date" name="purchase_date" id="purchase_date" class="form-control @error('purchase_date') is-invalid @enderror" value="{{ old('purchase_date', $asset->purchase_date ? $asset->purchase_date->format('Y-m-d') : '') }}">
                            @error('purchase_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Harga Pembelian -->
                        <div class="col-12 col-md-3">
                            <label for="purchase_price" class="form-label fw-semibold">Harga Pembelian (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="number" step="0.01" name="purchase_price" id="purchase_price" class="form-control @error('purchase_price') is-invalid @enderror" value="{{ old('purchase_price', $asset->purchase_price) }}">
                            </div>
                            @error('purchase_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kondisi -->
                        <div class="col-12 col-md-3">
                            <label for="condition" class="form-label fw-semibold">Kondisi Aset <span class="text-danger">*</span></label>
                            <select name="condition" id="condition" class="form-select @error('condition') is-invalid @enderror" required>
                                <option value="Baik" {{ old('condition', $asset->condition) == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Rusak" {{ old('condition', $asset->condition) == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                            </select>
                            @error('condition')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status Penggunaan -->
                        <div class="col-12 col-md-3">
                            <label for="status" class="form-label fw-semibold">Status Penggunaan <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="Tersedia" {{ old('status', $asset->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="Dipakai" {{ old('status', $asset->status) == 'Dipakai' ? 'selected' : '' }}>Dipakai</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-3 mt-4">
                        <a href="{{ route('assets.index') }}" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="fa-solid fa-floppy-disk me-1"></i>Perbarui Data Aset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
