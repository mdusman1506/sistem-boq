@extends('layouts.app')

@section('title', 'Daftar Request CCO - SIM BOQ Enterprise')

@push('styles')
<style>
    .table-container {
        background: var(--bg-card);
        border-radius: 1.25rem;
        padding: 2rem;
        border: 1px solid var(--border-color);
        box-shadow: var(--card-shadow);
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-main mb-1">Pekerjaan Tambah/Kurang (CCO)</h2>
            <p class="text-muted-custom mb-0">Kelola permintaan perubahan desain atau kuantitas dari Klien.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 bg-success bg-opacity-10 text-success shadow-sm mb-4">
            <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i> 
            <span class="align-middle fw-medium">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 bg-danger bg-opacity-10 text-danger shadow-sm mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5 align-middle"></i> 
            <span class="align-middle fw-medium">{{ session('error') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-container">
        <table class="table table-hover align-middle custom-table" id="ccoTable">
            <thead class="bg-light">
                <tr>
                    <th class="py-3 px-4 rounded-start">Klien & Proyek</th>
                    <th class="py-3 px-4">Subjek CCO</th>
                    <th class="py-3 px-4">Lampiran</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4 rounded-end text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $cco)
                <tr class="border-bottom border-custom">
                    <td class="px-4">
                        <div class="fw-bold text-main">{{ $cco->klien->nama_perusahaan }}</div>
                        <div class="text-muted-custom small">{{ $cco->proyek->nama_proyek }}</div>
                        <div class="text-muted-custom small mt-1"><i class="bi bi-clock me-1"></i>{{ $cco->created_at->format('d M Y H:i') }}</div>
                    </td>
                    <td class="px-4">
                        <div class="fw-bold text-main">{{ $cco->subjek }}</div>
                        <div class="text-muted-custom small text-wrap" style="max-width: 300px;">{{ Str::limit($cco->deskripsi_perubahan, 100) }}</div>
                    </td>
                    <td class="px-4">
                        @if($cco->lampiran)
                            <a href="{{ Storage::url($cco->lampiran) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill"><i class="bi bi-image me-1"></i>Lihat Foto</a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="px-4">
                        <span class="badge {{ $cco->status == 'Pending' ? 'bg-warning text-dark' : ($cco->status == 'Diproses' ? 'bg-info' : ($cco->status == 'Selesai' ? 'bg-success' : 'bg-danger')) }} px-3 py-2 rounded-pill">
                            {{ $cco->status }}
                        </span>
                    </td>
                    <td class="px-4 text-center">
                        <a href="{{ route('proyek.show', $cco->proyek_id) }}" class="btn btn-sm btn-outline-secondary rounded-pill me-1" title="Lihat Proyek">
                            <i class="bi bi-eye"></i>
                        </a>
                        
                        @if($cco->status === 'Pending' && Auth::user()->role === 'Admin')
                        <form action="{{ route('cco.process', $cco->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary rounded-pill" onclick="return confirm('Proses CCO ini? Sistem akan membuat salinan BOQ baru (Revisi) untuk Anda edit.')">
                                <i class="bi bi-gear-fill me-1"></i> Proses (Buat Revisi)
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($requests->count() === 0)
        <div class="text-center py-5">
            <i class="bi bi-tools fs-1 text-muted opacity-50 mb-3"></i>
            <h5 class="text-main">Belum Ada Request CCO</h5>
            <p class="text-muted-custom">Belum ada Klien yang mengajukan Pekerjaan Tambah/Kurang.</p>
        </div>
        @endif
    </div>
</div>
@endsection
