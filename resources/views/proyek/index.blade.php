@extends('layouts.app')

@section('title', 'Daftar Proyek - SIM BOQ Enterprise')

@push('styles')
<style>
    .page-header {
        margin-bottom: 2rem;
    }
    
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
    .table tbody tr {
        transition: all 0.2s ease;
    }
    .table tbody tr:hover {
        background-color: var(--hover-sidebar);
        transform: scale(1.002);
        box-shadow: inset 2px 0 0 var(--primary);
    }
    
    .status-badge {
        padding: 0.4rem 1rem;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        width: max-content;
    }
    .status-berjalan { background-color: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); }
    .status-selesai { background-color: var(--hover-sidebar); color: var(--text-muted); border: 1px solid var(--border-color); }
    
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
    
    .btn-outline-primary {
        color: var(--primary);
        border-color: var(--border-color);
        font-weight: 500;
    }
    .btn-outline-primary:hover {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary);
    }
</style>
@endpush

@section('content')

    <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h2 class="fw-bold text-main mb-2">Manajemen Proyek</h2>
            <p class="text-muted-custom mb-0" style="font-size: 1.05rem;">Kelola data proyek perusahaan dan unggah dokumen BOQ.</p>
        </div>
        @if (Auth::user()->role === 'Admin')
            <a href="{{ route('proyek.create') }}" class="btn btn-primary rounded-pill shadow-sm">
                <i class="bi bi-plus-lg me-2"></i>Tambah Proyek Baru
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 bg-success bg-opacity-10 text-success border border-success mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i> 
            <span class="align-middle fw-medium">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-container">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" width="5%">No</th>
                        <th scope="col" width="30%">Nama Proyek</th>
                        <th scope="col" width="20%">Perusahaan Klien</th>
                        <th scope="col" width="15%">Site Manager</th>
                        <th scope="col" width="15%">Status</th>
                        <th scope="col" width="15%">Tanggal Dibuat</th>
                        <th scope="col" class="text-center" width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($proyek as $index => $item)
                    <tr>
                        <td class="text-muted-custom fw-medium">{{ $index + 1 }}</td>
                        <td>
                            <div class="fw-bold text-main fs-6">{{ $item->nama_proyek }}</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="rounded p-2 me-3 text-primary" style="background-color: var(--primary-light);">
                                    <i class="bi bi-building"></i>
                                </div>
                                <span class="fw-medium text-main">{{ $item->klien->nama_perusahaan ?? '-' }}</span>
                            </div>
                        </td>
                        <td>
                            @if(Auth::user()->role === 'Admin')
                                <div class="text-main fw-medium"><i class="bi bi-person-badge text-muted-custom me-1"></i> {{ $item->siteManager->nama_lengkap ?? 'Belum Ditugaskan' }}</div>
                            @else
                                <div class="text-main fw-medium"><i class="bi bi-person-badge text-muted-custom me-1"></i> {{ $item->siteManager->nama_lengkap ?? '-' }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="status-badge {{ $item->status_proyek === 'Berjalan' ? 'status-berjalan' : 'status-selesai' }}">
                                <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem; vertical-align: middle;"></i>
                                {{ $item->status_proyek }}
                            </span>
                        </td>
                        <td class="text-muted-custom">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('proyek.show', $item->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="d-inline-flex justify-content-center align-items-center rounded-circle mb-3" style="width: 80px; height: 80px; background-color: var(--hover-sidebar);">
                                <i class="bi bi-folder-x fs-1 text-muted-custom"></i>
                            </div>
                            <h5 class="fw-bold text-main mb-1">Data Proyek Kosong</h5>
                            <p class="text-muted-custom">Belum ada data proyek yang didaftarkan ke sistem.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
