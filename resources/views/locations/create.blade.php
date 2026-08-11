@extends('layouts.app')

@section('title', 'Tambah Lokasi Penempatan')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
        <div class="card card-custom">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between border-bottom">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="fa-solid fa-plus-circle me-2 text-primary"></i>Tambah Lokasi Penempatan Baru
                </h5>
                <a href="{{ route('locations.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa-solid fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('locations.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Lokasi / Ruangan <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Ruang IT Lt. 2, Gudang Utama, Lab Komputer 1" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Deskripsi / Detail Posisi</label>
                        <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Keterangan gedung, blok, atau penanggung jawab ruangan...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-3">
                        <a href="{{ route('locations.index') }}" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="fa-solid fa-floppy-disk me-1"></i>Simpan Lokasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
