@extends('layouts.app')

@section('title', 'Manajemen Pengguna - SIM BOQ Enterprise')

@push('styles')
<style>
    .table-container {
        background: var(--bg-card);
        border-radius: 1.25rem;
        padding: 2rem;
        border: 1px solid var(--border-color);
        box-shadow: var(--card-shadow);
    }
    .table > :not(caption)>*>* {
        padding: 1rem 1.25rem;
        border-bottom-color: var(--border-color);
        color: var(--text-main);
    }
    .table thead th {
        background-color: var(--hover-sidebar);
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
        border-bottom: none;
    }
    
    .btn-primary {
        background-color: var(--primary);
        border: none;
        padding: 0.6rem 1.5rem;
        font-weight: 500;
        transition: all 0.2s;
        color: white;
    }
    .btn-primary:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        color: white;
    }
</style>
@endpush

@section('content')

    <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold text-main mb-2">Manajemen Pengguna</h2>
            <p class="text-muted-custom mb-0" style="font-size: 1.05rem;">Kelola akses akun Admin dan Site Manager.</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary rounded-pill shadow-sm">
            <i class="bi bi-person-plus-fill me-2"></i>Tambah Pengguna
        </a>
    </div>

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

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 datatable">
                <thead>
                    <tr>
                        <th scope="col" width="5%">No</th>
                        <th scope="col" width="25%">Nama Lengkap</th>
                        <th scope="col" width="20%">Username</th>
                        <th scope="col" width="15%">Role Akses</th>
                        <th scope="col" width="15%">Tanggal Dibuat</th>
                        <th scope="col" class="text-center" width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($users as $index => $u)
                    <tr>
                        <td class="text-muted-custom fw-medium">{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle d-flex justify-content-center align-items-center text-white fw-bold me-3" style="width: 40px; height: 40px; background-color: {{ $u->role === 'Admin' ? 'var(--primary)' : '#10b981' }}; font-family: 'Outfit';">
                                    {{ substr($u->nama_lengkap, 0, 1) }}
                                </div>
                                <div class="fw-bold text-main fs-6">{{ $u->nama_lengkap }}
                                    @if(Auth::id() === $u->id)
                                        <span class="badge bg-primary bg-opacity-10 text-primary ms-2 rounded-pill" style="font-size: 0.65rem;">(Anda)</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td><span class="text-muted-custom font-monospace">{{ $u->username }}</span></td>
                        <td>
                            @if($u->role === 'Admin')
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary px-3 py-2 rounded-pill"><i class="bi bi-shield-lock-fill me-1"></i> Admin</span>
                            @elseif($u->role === 'Site Manager')
                                <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-pill"><i class="bi bi-person-workspace me-1"></i> Site Manager</span>
                            @elseif($u->role === 'Direktur')
                                <span class="badge bg-info bg-opacity-10 text-info border border-info px-3 py-2 rounded-pill"><i class="bi bi-briefcase-fill me-1"></i> Direktur</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary px-3 py-2 rounded-pill"><i class="bi bi-building me-1"></i> Klien</span>
                            @endif
                        </td>
                        <td class="text-muted-custom">{{ $u->created_at->format('d M Y') }}</td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('users.edit', $u->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                @if(Auth::id() !== $u->id)
                                <form action="{{ route('users.destroy', $u->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Yakin ingin menghapus akun {{ $u->nama_lengkap }}?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            Belum ada data pengguna.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (document.querySelector('.datatable')) {
                new simpleDatatables.DataTable('.datatable', {
                    searchable: true,
                    fixedHeight: true,
                    labels: {
                        placeholder: "Cari Pengguna...",
                        perPage: "baris per halaman",
                        noRows: "Tidak ada pengguna ditemukan",
                        info: "Menampilkan {start} - {end} dari {rows} pengguna",
                    }
                });
            }
        });
    </script>
    @endpush
@endsection
