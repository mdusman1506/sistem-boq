@extends('layouts.app')

@section('title', 'Edit Pengguna - SIM BOQ Enterprise')

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
            <h2 class="fw-bold text-main mb-1">Edit Pengguna: {{ $editUser->nama_lengkap }}</h2>
            <p class="text-muted-custom mb-0">Perbarui profil atau atur ulang kata sandi.</p>
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

        <form action="{{ route('users.update', $editUser->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $editUser->nama_lengkap) }}" required>
                </div>
                
                <div class="col-md-6">
                    <label for="username" class="form-label">Username (ID Login) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control font-monospace" id="username" name="username" value="{{ old('username', $editUser->username) }}" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Cth: budi@perusahaan.co.id" value="{{ old('email', $editUser->email) }}">
                    <div class="form-text text-muted-custom mt-1"><i class="bi bi-info-circle me-1"></i> Untuk notifikasi email otomatis.</div>
                </div>

                <div class="col-md-6">
                    <label for="role" class="form-label">Role / Hak Akses <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <select class="form-select" id="role" name="role" required style="appearance: none;" onchange="toggleKlienSelector()" {{ Auth::id() === $editUser->id ? 'disabled' : '' }}>
                            <option value="Admin" {{ (old('role', $editUser->role) == 'Admin') ? 'selected' : '' }}>Admin (Manajemen Penuh)</option>
                            <option value="Site Manager" {{ (old('role', $editUser->role) == 'Site Manager') ? 'selected' : '' }}>Site Manager (Fokus Lapangan)</option>
                            <option value="Direktur" {{ (old('role', $editUser->role) == 'Direktur') ? 'selected' : '' }}>Direktur (Executive Board)</option>
                            <option value="Klien" {{ (old('role', $editUser->role) == 'Klien') ? 'selected' : '' }}>Klien (Customer Portal)</option>
                        </select>
                        <i class="bi bi-chevron-down position-absolute top-50 end-0 translate-middle-y me-3 text-muted-custom pointer-events-none"></i>
                        @if(Auth::id() === $editUser->id)
                            <input type="hidden" name="role" value="{{ $editUser->role }}" id="hidden_role">
                            <div class="form-text text-muted-custom mt-2"><i class="bi bi-shield-lock me-1"></i> Anda tidak bisa mengubah role Anda sendiri.</div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6" id="klien_selector_container" style="display: {{ old('role', $editUser->role) == 'Klien' ? 'block' : 'none' }};">
                    <label for="klien_id" class="form-label">Pilih Perusahaan Klien <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <select class="form-select" id="klien_id" name="klien_id" style="appearance: none;">
                            <option value="" disabled selected>-- Pilih Klien --</option>
                            @foreach($klienList as $k)
                                <option value="{{ $k->id }}" {{ old('klien_id', $editUser->klien_id) == $k->id ? 'selected' : '' }}>{{ $k->nama_perusahaan }}</option>
                            @endforeach
                        </select>
                        <i class="bi bi-chevron-down position-absolute top-50 end-0 translate-middle-y me-3 text-muted-custom pointer-events-none"></i>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label">Kata Sandi Baru</label>
                    <div class="position-relative">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak diubah" style="padding-right: 2.5rem;">
                        <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent toggle-password" style="z-index: 10; color: var(--text-muted); padding-right: 1.25rem;">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    <div class="form-text text-muted-custom mt-2"><i class="bi bi-info-circle me-1"></i> Isi hanya jika ingin mereset sandi.</div>
                </div>
            </div>

            <hr class="border-custom mb-4 mt-5">

            <div class="d-flex justify-content-end gap-3">
                <a href="{{ route('users.index') }}" class="btn btn-light rounded-pill px-4 py-2 fw-medium border-custom text-main" style="background-color: var(--bg-body);">Batal</a>
                <button type="submit" class="btn btn-primary">
                    Perbarui Profil <i class="bi bi-check2-circle ms-2"></i>
                </button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
<script>
    function toggleKlienSelector() {
        const roleSelect = document.getElementById('role');
        const hiddenRole = document.getElementById('hidden_role');
        
        let role = roleSelect ? roleSelect.value : null;
        if (roleSelect && roleSelect.disabled && hiddenRole) {
            role = hiddenRole.value;
        }

        const selector = document.getElementById('klien_selector_container');
        if (role === 'Klien') {
            selector.style.display = 'block';
            document.getElementById('klien_id').required = true;
        } else {
            selector.style.display = 'none';
            document.getElementById('klien_id').required = false;
        }
    }
    
    // Run on load
    document.addEventListener('DOMContentLoaded', function() {
        toggleKlienSelector();

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
