@extends('layouts.app')

@section('title', 'Profil Saya - SIM BOQ Enterprise')

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
        <div>
            <h2 class="fw-bold text-main mb-1">Pengaturan Profil</h2>
            <p class="text-muted-custom mb-0">Perbarui informasi profil dan kata sandi Anda.</p>
        </div>
    </div>

    <div class="form-container mb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 bg-success bg-opacity-10 text-success border border-success mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i> 
                <span class="align-middle fw-medium">{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 bg-danger bg-opacity-10 text-danger border border-danger mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-5 align-middle"></i> 
                <span class="align-middle fw-medium">{{ session('error') }}</span>
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

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <label for="username" class="form-label">Username (ID Login)</label>
                    <input type="text" class="form-control font-monospace bg-light" id="username" value="{{ $user->username }}" readonly disabled>
                    <div class="form-text text-muted-custom mt-2"><i class="bi bi-shield-lock me-1"></i> Username tidak dapat diubah.</div>
                </div>
                
                <div class="col-md-6">
                    <label for="role" class="form-label">Hak Akses</label>
                    <input type="text" class="form-control bg-light" id="role" value="{{ $user->role }}" readonly disabled>
                </div>

                <div class="col-md-12">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
                </div>

                <div class="col-12 mt-4">
                    <h5 class="fw-bold text-main border-bottom pb-2 mb-3">Ubah Kata Sandi</h5>
                    <p class="text-muted-custom" style="font-size: 0.9rem;">Biarkan kosong jika Anda tidak ingin mengubah kata sandi.</p>
                </div>

                <div class="col-md-12">
                    <label for="password_lama" class="form-label">Kata Sandi Saat Ini</label>
                    <div class="position-relative">
                        <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Masukkan sandi saat ini" style="padding-right: 2.5rem;">
                        <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent toggle-password" data-target="password_lama" style="z-index: 10; color: var(--text-muted); padding-right: 1.25rem;">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label">Kata Sandi Baru</label>
                    <div class="position-relative">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 6 karakter" style="padding-right: 2.5rem;">
                        <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent toggle-password" data-target="password" style="z-index: 10; color: var(--text-muted); padding-right: 1.25rem;">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                    <div class="position-relative">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi sandi baru" style="padding-right: 2.5rem;">
                        <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent toggle-password" data-target="password_confirmation" style="z-index: 10; color: var(--text-muted); padding-right: 1.25rem;">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <hr class="border-custom mb-4 mt-5">

            <div class="d-flex justify-content-end gap-3">
                <a href="{{ route('dashboard') }}" class="btn btn-light rounded-pill px-4 py-2 fw-medium border-custom text-main" style="background-color: var(--bg-body);">Batal</a>
                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan <i class="bi bi-check2-circle ms-2"></i>
                </button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-password');
        
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const icon = this.querySelector('i');
                
                if (passwordInput.getAttribute('type') === 'password') {
                    passwordInput.setAttribute('type', 'text');
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    passwordInput.setAttribute('type', 'password');
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        });
    });
</script>
@endpush
