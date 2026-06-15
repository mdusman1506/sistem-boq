@extends('layouts.app')

@section('title', 'Perusahaan Klien - SIM BOQ Enterprise')

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

@section('header-title')
    <h2 class="fw-bold text-main mb-0" style="font-size: 1.25rem;">Perusahaan Klien</h2>
    <p class="text-muted-custom mb-0" style="font-size: 0.85rem;">Kelola master data perusahaan klien/vendor.</p>
@endsection

@section('content')

    <div class="page-header d-flex flex-column flex-md-row justify-content-end align-items-md-center gap-3 mb-4">
        <div class="d-flex gap-2">
            @if(request()->has('trashed'))
                <a href="{{ route('klien.index') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            @else
                <a href="{{ route('klien.index', ['trashed' => 1]) }}" class="btn btn-outline-danger rounded-pill shadow-sm">
                    <i class="bi bi-trash ms-1 me-2"></i>Lihat Data Terhapus
                </a>
                <a href="{{ route('klien.create') }}" class="btn btn-primary rounded-pill shadow-sm">
                    <i class="bi bi-plus-circle-fill me-2"></i>Tambah Klien
                </a>
            @endif
        </div>
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
                        <th scope="col" width="25%">Nama Perusahaan</th>
                        <th scope="col" width="25%">Alamat</th>
                        <th scope="col" width="15%">Kontak Person</th>
                        <th scope="col" width="15%">Telepon</th>
                        <th scope="col" class="text-center" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($klien as $index => $k)
                    <tr>
                        <td class="text-muted-custom fw-medium">{{ $index + 1 }}</td>
                        <td>
                            <div class="fw-bold text-main fs-6"><i class="bi bi-buildings text-muted-custom me-2"></i>{{ $k->nama_perusahaan }}</div>
                        </td>
                        <td class="text-muted-custom text-truncate" style="max-width: 250px;">
                            {{ $k->alamat ?? '-' }}
                        </td>
                        <td class="text-muted-custom">{{ $k->kontak_person ?? '-' }}</td>
                        <td class="text-muted-custom">{{ $k->telepon ?? '-' }}</td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                @if(request()->has('trashed'))
                                    <form action="{{ route('klien.restore', $k->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                            <i class="bi bi-arrow-counterclockwise"></i> Pulihkan
                                        </button>
                                    </form>
                                    <form action="{{ route('klien.force-delete', $k->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3" onclick="return confirm('Yakin ingin menghapus klien ini PERMANEN?')">
                                            <i class="bi bi-trash"></i> Hapus Permanen
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('klien.edit', $k->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('klien.destroy', $k->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Yakin ingin menghapus klien ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted-custom">
                            Belum ada data klien.
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
                        placeholder: "Cari Klien...",
                        perPage: "baris per halaman",
                        noRows: "Tidak ada klien ditemukan",
                        info: "Menampilkan {start} - {end} dari {rows} klien",
                    }
                });
            }
        });
    </script>
    @endpush
@endsection
