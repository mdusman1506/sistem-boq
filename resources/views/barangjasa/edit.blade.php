@extends('layouts.app')

@section('title', 'Edit Barang/Jasa - SIM BOQ Enterprise')

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
    select option { background-color: var(--bg-card); color: var(--text-main); }
    
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
        <a href="{{ route('barangjasa.index') }}" class="btn btn-sm btn-outline-secondary rounded-circle me-3" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-color: var(--border-color); color: var(--text-main);">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h2 class="fw-bold text-main mb-1">Edit Item: {{ $barangJasa->kode_barang }}</h2>
            <p class="text-muted-custom mb-0">Perbarui master data material atau jasa.</p>
        </div>
    </div>

    <div class="form-container mb-5">
        @if(session('error'))
            <div class="alert alert-danger rounded-4 bg-danger bg-opacity-10 text-danger border border-danger mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-5 align-middle"></i> 
                <span class="align-middle fw-medium">{{ session('error') }}</span>
            </div>
        @endif

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

        <form action="{{ route('barangjasa.update', $barangJasa->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <label for="kode_barang" class="form-label">Kode Item <span class="text-danger">*</span></label>
                    <input type="text" class="form-control font-monospace text-uppercase" id="kode_barang" name="kode_barang" value="{{ old('kode_barang', $barangJasa->kode_barang) }}" required>
                </div>
                
                <div class="col-md-8">
                    <label for="nama_barang" class="form-label">Nama Barang / Jasa <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barangJasa->nama_barang) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="satuan" name="satuan" value="{{ old('satuan', $barangJasa->satuan) }}" required>
                </div>
                
                <div class="col-md-6">
                    <label for="tipe" class="form-label">Tipe Item <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <select class="form-select" id="tipe" name="tipe" required style="appearance: none;">
                            <option value="Material" {{ (old('tipe', $barangJasa->tipe ?? 'Material') == 'Material') ? 'selected' : '' }}>Barang / Material Fisik</option>
                            <option value="Jasa" {{ (old('tipe', $barangJasa->tipe ?? 'Material') == 'Jasa') ? 'selected' : '' }}>Servis / Jasa Pengerjaan</option>
                        </select>
                        <i class="bi bi-chevron-down position-absolute top-50 end-0 translate-middle-y me-3 text-muted-custom pointer-events-none"></i>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="harga_material" class="form-label">Harga Modal Material (Rp)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-body border-custom text-muted-custom">Rp</span>
                        <input type="number" class="form-control" id="harga_material" name="harga_material" value="{{ old('harga_material', $barangJasa->harga_material) }}" min="0" step="1">
                    </div>
                    <small class="text-muted-custom" style="font-size: 0.75rem;">Kosongkan atau isi 0 jika tidak ada modal material.</small>
                </div>

                <div class="col-md-6">
                    <label for="harga_jasa" class="form-label">Harga Modal Jasa (Rp)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-body border-custom text-muted-custom">Rp</span>
                        <input type="number" class="form-control" id="harga_jasa" name="harga_jasa" value="{{ old('harga_jasa', $barangJasa->harga_jasa) }}" min="0" step="1">
                    </div>
                    <small class="text-muted-custom" style="font-size: 0.75rem;">Kosongkan atau isi 0 jika tidak ada komponen jasa.</small>
                </div>
            </div>

            <hr class="border-custom mb-4 mt-5">

            <div class="d-flex justify-content-end gap-3">
                <a href="{{ route('barangjasa.index') }}" class="btn btn-light rounded-pill px-4 py-2 fw-medium border-custom text-main" style="background-color: var(--bg-body);">Batal</a>
                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan <i class="bi bi-check2-circle ms-2"></i>
                </button>
            </div>
        </form>
    </div>

@endsection
