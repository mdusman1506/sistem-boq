@extends('layouts.app')

@section('title', 'Tambah Klien - SIM BOQ Enterprise')

@push('styles')
<style>
    .form-container {
        background: var(--bg-card);
        border-radius: 1.25rem;
        padding: 3rem;
        box-shadow: var(--card-shadow);
        border: 1px solid var(--border-color);
        max-width: 800px;
        margin: 0 auto;
    }
    
    .form-label { font-weight: 600; color: var(--text-main); margin-bottom: 0.5rem; }
    .form-control {
        border-radius: 0.75rem;
        padding: 1rem 1.25rem;
        border: 1px solid var(--border-color);
        background-color: var(--bg-body);
        color: var(--text-main);
        transition: all 0.2s ease;
    }
    .form-control:focus {
        background-color: var(--bg-card);
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15);
        color: var(--text-main);
    }
    
    .btn-primary {
        background-color: var(--primary);
        border: none;
        padding: 0.8rem 2rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        border-radius: 0.75rem;
        transition: all 0.3s;
        color: white;
    }
    .btn-primary:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(79, 70, 229, 0.3);
        color: white;
    }
</style>
@endpush

@section('content')

    <div class="mb-4 d-flex align-items-center">
        <a href="{{ route('klien.index') }}" class="btn btn-sm btn-outline-secondary rounded-circle me-3" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-color: var(--border-color); color: var(--text-main);">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h2 class="fw-bold text-main mb-1">Tambah Perusahaan Klien</h2>
            <p class="text-muted-custom mb-0">Tambahkan data klien / vendor baru.</p>
        </div>
    </div>

    <div class="form-container mb-5">
        @if($errors->any())
            <div class="alert alert-danger rounded-4 bg-danger bg-opacity-10 text-danger border border-danger mb-4">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
                    <h6 class="mb-0 fw-bold">Terdapat kesalahan input:</h6>
                </div>
                <ul class="mb-0 ps-4">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('klien.store') }}" method="POST">
            @csrf
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Cth: PT Telekomunikasi Indonesia Tbk" value="{{ old('nama_perusahaan') }}" required autofocus>
                </div>
                
                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat kantor perusahaan">{{ old('alamat') }}</textarea>
                </div>

                <div class="col-md-6">
                    <label for="kontak_person" class="form-label">Kontak Person (PIC)</label>
                    <input type="text" class="form-control" id="kontak_person" name="kontak_person" placeholder="Nama perwakilan" value="{{ old('kontak_person') }}">
                </div>
                
                <div class="col-md-6">
                    <label for="telepon" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Cth: 0812-3456-7890" value="{{ old('telepon') }}">
                </div>
            </div>

            <hr class="border-custom mb-4 mt-5">

            <div class="d-flex justify-content-end gap-3">
                <a href="{{ route('klien.index') }}" class="btn btn-light rounded-pill px-4 py-2 fw-medium border-custom text-main" style="background-color: var(--bg-body);">Batal</a>
                <button type="submit" class="btn btn-primary">
                    Simpan Data <i class="bi bi-arrow-right ms-2"></i>
                </button>
            </div>
        </form>
    </div>

@endsection
