@extends('layouts.app')

@section('title', 'Tambah Proyek - SIM BOQ Enterprise')

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
    .form-control, .form-select {
        border-radius: 0.75rem;
        padding: 1rem 1.25rem;
        border: 1px solid var(--border-color);
        background-color: var(--bg-body);
        color: var(--text-main);
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        background-color: var(--bg-card);
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15);
        color: var(--text-main);
    }
    /* Mengatasi text color dropdown select di dark mode */
    select option {
        background-color: var(--bg-card);
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
        <a href="{{ route('proyek.index') }}" class="btn btn-sm btn-outline-secondary rounded-circle me-3" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-color: var(--border-color); color: var(--text-main);">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h2 class="fw-bold text-main mb-1">Registrasi Proyek Baru</h2>
            <p class="text-muted-custom mb-0">Masukkan informasi detail untuk manajemen lapangan.</p>
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

        <form action="{{ route('proyek.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama_proyek" class="form-label">Nama Proyek Kontrak <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" placeholder="Cth: Pembangunan Infrastruktur Jaringan Tower A" value="{{ old('nama_proyek') }}" required autofocus>
                <div class="form-text text-muted-custom mt-2"><i class="bi bi-info-circle me-1"></i> Gunakan nama resmi sesuai dokumen kontrak kerja.</div>
            </div>
            
            <div class="mb-5">
                <label for="klien_id" class="form-label">Perusahaan Klien <span class="text-danger">*</span></label>
                <div class="position-relative">
                    <select class="form-select" id="klien_id" name="klien_id" required style="appearance: none;">
                        <option value="" disabled selected>-- Pilih Perusahaan Klien dari Master Data --</option>
                        @foreach($klien as $k)
                            <option value="{{ $k->id }}" {{ old('klien_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_perusahaan }} (PIC: {{ $k->kontak_person ?? $k->pic }})
                            </option>
                        @endforeach
                    </select>
                    <i class="bi bi-chevron-down position-absolute top-50 end-0 translate-middle-y me-3 text-muted-custom pe-none"></i>
                </div>
            </div>

            <div class="mb-5">
                <label for="site_manager_id" class="form-label">Penanggung Jawab (Site Manager) <span class="text-danger">*</span></label>
                <div class="position-relative">
                    <select class="form-select" id="site_manager_id" name="site_manager_id" required style="appearance: none;">
                        <option value="" disabled selected>-- Pilih Site Manager yang Bertugas --</option>
                        @foreach($siteManagers as $sm)
                            <option value="{{ $sm->id }}" {{ old('site_manager_id') == $sm->id ? 'selected' : '' }}>
                                {{ $sm->nama_lengkap }} ({{ $sm->username }})
                            </option>
                        @endforeach
                    </select>
                    <i class="bi bi-chevron-down position-absolute top-50 end-0 translate-middle-y me-3 text-muted-custom pe-none"></i>
                </div>
            </div>

            <hr class="border-custom mb-4">

            <div class="d-flex justify-content-end gap-3">
                <a href="{{ route('proyek.index') }}" class="btn btn-outline-secondary" style="border-radius: 0.75rem; padding: 0.8rem 1.5rem; font-weight: 500;">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-2"></i>Daftarkan Proyek
                </button>
            </div>
        </form>
    </div>

@endsection
