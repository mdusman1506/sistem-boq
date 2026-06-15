@extends('layouts.app')

@section('title', 'Tambah Pengguna - SIM BOQ Enterprise')

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
        <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary rounded-circle me-3" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-color: var(--border-color); color: var(--text-main);">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h2 class="fw-bold text-main mb-1">Registrasi Pengguna Baru</h2>
            <p class="text-muted-custom mb-0">Tambahkan akun Admin atau Site Manager baru.</p>
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

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Cth: Budi Santoso" value="{{ old('nama_lengkap') }}" required autofocus>
                </div>
                
                <div class="col-md-6">
                    <label for="username" class="form-label">Username (ID Login) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control font-monospace" id="username" name="username" placeholder="Cth: budi123" value="{{ old('username') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Cth: budi@perusahaan.co.id" value="{{ old('email') }}">
                    <div class="form-text text-muted-custom mt-1"><i class="bi bi-info-circle me-1"></i> Untuk menerima notifikasi email otomatis.</div>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label">Kata Sandi <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 6 karakter" required style="padding-right: 2.5rem;">
                        <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent toggle-password" style="z-index: 10; color: var(--text-muted); padding-right: 1.25rem;">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <label for="role" class="form-label">Role / Hak Akses <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <select class="form-select" id="role" name="role" required style="appearance: none;" onchange="toggleKlienSelector()">
                            <option value="" disabled selected>-- Pilih Role --</option>
                            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin (Manajemen Penuh)</option>
                            <option value="Site Manager" {{ old('role') == 'Site Manager' ? 'selected' : '' }}>Site Manager (Fokus Lapangan)</option>
                            <option value="Direktur" {{ old('role') == 'Direktur' ? 'selected' : '' }}>Direktur (Executive Board)</option>
                            <option value="Klien" {{ old('role') == 'Klien' ? 'selected' : '' }}>Klien (Customer Portal)</option>
                        </select>
                        <i class="bi bi-chevron-down position-absolute top-50 end-0 translate-middle-y me-3 text-muted-custom pointer-events-none"></i>
                    </div>
                </div>

                <div class="col-md-6" id="klien_selector_container" style="display: {{ old('role') == 'Klien' ? 'block' : 'none' }};">
                    <label for="klien_id" class="form-label">Pilih Perusahaan Klien <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <select class="form-select" id="klien_id" name="klien_id" style="appearance: none;">
                            <option value="" disabled selected>-- Pilih Klien --</option>
                            @foreach($klienList as $k)
                                <option value="{{ $k->id }}" {{ old('klien_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_perusahaan }}</option>
                            @endforeach
                        </select>
                        <i class="bi bi-chevron-down position-absolute top-50 end-0 translate-middle-y me-3 text-muted-custom pointer-events-none"></i>
                    </div>
                </div>
            </div>

            <hr class="border-custom mb-4 mt-5">

            <div class="d-flex justify-content-end gap-3">
                <a href="{{ route('users.index') }}" class="btn btn-light rounded-pill px-4 py-2 fw-medium border-custom text-main" style="background-color: var(--bg-body);">Batal</a>
                <button type="submit" class="btn btn-primary">
                    Simpan Pengguna <i class="bi bi-arrow-right ms-2"></i>
                </button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
<script>
    function toggleKlienSelector() {
        const role = document.getElementById('role').value;
        const selector = document.getElementById('klien_selector_container');
        if (role === 'Klien') {
            selector.style.display = 'block';
            document.getElementById('klien_id').required = true;
        } else {
            selector.style.display = 'none';
            document.getElementById('klien_id').required = false;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Password toggle logic
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.getElementById('password');
        
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                const icon = this.querySelector('i');
                if (type === 'text') {
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        }
    });
</script>
@endpush
