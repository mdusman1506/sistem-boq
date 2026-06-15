@extends('layouts.app')

@section('title', 'Pengaturan Sistem - SIM BOQ Enterprise')

@push('styles')
<style>
    .settings-container {
        max-width: 900px;
        margin: 0 auto;
    }
    .settings-card {
        background: var(--bg-card);
        border-radius: 1.25rem;
        padding: 2.5rem;
        box-shadow: var(--card-shadow);
        border: 1px solid var(--border-color);
        margin-bottom: 2rem;
    }
    .settings-card h5 {
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
    }
    .settings-card h5 i {
        color: var(--primary);
        margin-right: 0.5rem;
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
    .logo-preview {
        width: 120px;
        height: 120px;
        border-radius: 1rem;
        border: 2px dashed var(--border-color);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background-color: var(--bg-body);
        transition: all 0.3s;
    }
    .logo-preview:hover {
        border-color: var(--primary);
    }
    .logo-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
    .btn-primary {
        background-color: var(--primary);
        border: none;
        padding: 0.8rem 2rem;
        font-weight: 600;
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
    .input-suffix {
        background-color: var(--hover-sidebar);
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        border-radius: 0 0.75rem 0.75rem 0;
        padding: 1rem 1.25rem;
        font-weight: 600;
    }
    .input-suffix + .form-control,
    .form-control + .input-suffix {
        border-radius: 0.75rem 0 0 0.75rem;
    }
</style>
@endpush

@section('content')

    <div class="mb-4">
        <h2 class="fw-bold text-main mb-1">Pengaturan Sistem</h2>
        <p class="text-muted-custom mb-0">Konfigurasikan identitas perusahaan, pajak, dan logo untuk seluruh laporan.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 bg-success bg-opacity-10 text-success shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i>
            <span class="align-middle fw-medium">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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

    <div class="settings-container">
        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Identitas Perusahaan --}}
            <div class="settings-card">
                <h5><i class="bi bi-building-gear"></i> Identitas Perusahaan</h5>
                <div class="row g-4">
                    <div class="col-md-8">
                        <div class="row g-4">
                            <div class="col-12">
                                <label for="nama_perusahaan" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan', $settings['nama_perusahaan']) }}" required>
                            </div>
                            <div class="col-12">
                                <label for="alamat_perusahaan" class="form-label">Alamat Perusahaan <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" rows="2" required>{{ old('alamat_perusahaan', $settings['alamat_perusahaan']) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <label class="form-label d-block">Logo Perusahaan</label>
                        <div class="logo-preview mx-auto mb-3" id="logoPreviewBox">
                            @if($settings['logo_path'])
                                <img src="{{ asset('storage/' . $settings['logo_path']) }}" alt="Logo" id="logoImg">
                            @else
                                <i class="bi bi-image text-muted-custom" style="font-size: 2.5rem;" id="logoPlaceholder"></i>
                            @endif
                        </div>
                        <label for="logo" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1" style="cursor: pointer;">
                            <i class="bi bi-cloud-arrow-up me-1"></i> Unggah Logo
                        </label>
                        <input type="file" id="logo" name="logo" accept="image/png,image/jpeg" class="d-none">
                        <div class="form-text text-muted-custom mt-2" style="font-size: 0.75rem;">PNG/JPG, Maks 2MB</div>
                    </div>
                </div>
                <div class="row g-4 mt-1">
                    <div class="col-md-6">
                        <label for="telepon_perusahaan" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="telepon_perusahaan" name="telepon_perusahaan" value="{{ old('telepon_perusahaan', $settings['telepon_perusahaan']) }}" placeholder="Cth: (021) 1234-5678">
                    </div>
                    <div class="col-md-6">
                        <label for="email_perusahaan" class="form-label">Email Perusahaan</label>
                        <input type="email" class="form-control" id="email_perusahaan" name="email_perusahaan" value="{{ old('email_perusahaan', $settings['email_perusahaan']) }}" placeholder="Cth: info@perusahaan.co.id">
                    </div>
                </div>
            </div>

            {{-- Pengaturan Finansial --}}
            <div class="settings-card">
                <h5><i class="bi bi-calculator"></i> Pengaturan Finansial</h5>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="pajak_persen" class="form-label">Tarif Pajak (PPN) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" step="0.1" min="0" max="100" class="form-control" id="pajak_persen" name="pajak_persen" value="{{ old('pajak_persen', $settings['pajak_persen']) }}" required style="border-radius: 0.75rem 0 0 0.75rem;">
                            <span class="input-group-text input-suffix">%</span>
                        </div>
                        <div class="form-text text-muted-custom mt-2"><i class="bi bi-info-circle me-1"></i> Tarif PPN saat ini: {{ $settings['pajak_persen'] }}%. Perubahan akan berlaku untuk seluruh kalkulasi baru.</div>
                    </div>
                </div>
            </div>

            {{-- Utilities / Tools --}}
            <div class="settings-card">
                <h5><i class="bi bi-tools"></i> Utilitas Sistem</h5>
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center justify-content-between border border-custom rounded-4 p-4" style="background-color: var(--bg-body);">
                            <div>
                                <h6 class="fw-bold text-main mb-1"><i class="bi bi-database-down text-primary me-2"></i>Backup Database Sistem</h6>
                                <p class="text-muted-custom mb-0" style="font-size: 0.9rem;">Unduh seluruh data aplikasi (.sql) untuk keperluan pemulihan (disaster recovery) dalam satu klik.</p>
                            </div>
                            <div>
                                <a href="{{ route('settings.backup') }}" class="btn btn-outline-primary rounded-pill px-4 fw-medium">
                                    <i class="bi bi-download me-2"></i>Generate Backup
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-3 mb-5">
                <button type="submit" class="btn btn-primary rounded-pill px-5">
                    <i class="bi bi-check2-circle me-2"></i>Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
<script>
    document.getElementById('logo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                const box = document.getElementById('logoPreviewBox');
                const placeholder = document.getElementById('logoPlaceholder');
                if (placeholder) placeholder.remove();
                
                let img = document.getElementById('logoImg');
                if (!img) {
                    img = document.createElement('img');
                    img.id = 'logoImg';
                    box.appendChild(img);
                }
                img.src = ev.target.result;
                img.alt = 'Logo Preview';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
