@extends('layouts.app')

@section('title', 'Tiket Pemeliharaan - SIM BOQ Enterprise')

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
            <h2 class="fw-bold text-main mb-1">Tiket Pemeliharaan</h2>
            <p class="text-muted-custom mb-0">Kelola komplain pemeliharaan (masa retensi) dari Klien.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 bg-success bg-opacity-10 text-success shadow-sm mb-4">
            <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i> 
            <span class="align-middle fw-medium">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-container">
        <table class="table table-hover align-middle custom-table" id="tiketTable">
            <thead class="bg-light">
                <tr>
                    <th class="py-3 px-4 rounded-start">Klien & Proyek</th>
                    <th class="py-3 px-4">Subjek & Masalah</th>
                    <th class="py-3 px-4">Lampiran Komplain</th>
                    <th class="py-3 px-4">Status & Bukti</th>
                    <th class="py-3 px-4 rounded-end text-center">Aksi (Update)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tikets as $tiket)
                <tr class="border-bottom border-custom">
                    <td class="px-4">
                        <div class="fw-bold text-main">{{ $tiket->proyek->klien->nama_perusahaan ?? 'Tanpa Klien' }}</div>
                        <div class="text-muted-custom small">{{ $tiket->proyek->nama_proyek }}</div>
                        <div class="text-muted-custom small mt-1"><i class="bi bi-clock me-1"></i>{{ $tiket->created_at->format('d M Y H:i') }}</div>
                    </td>
                    <td class="px-4">
                        <div class="fw-bold text-main text-danger">{{ $tiket->subjek }}</div>
                        <div class="text-muted-custom small text-wrap" style="max-width: 250px;">{{ Str::limit($tiket->deskripsi, 100) }}</div>
                    </td>
                    <td class="px-4">
                        @if($tiket->foto_kerusakan)
                            <a href="{{ Storage::url($tiket->foto_kerusakan) }}" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill"><i class="bi bi-image me-1"></i>Foto Masalah</a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="px-4">
                        <span class="badge {{ $tiket->status == 'Open' ? 'bg-danger' : ($tiket->status == 'On Progress' ? 'bg-warning text-dark' : 'bg-success') }} px-3 py-2 rounded-pill mb-2 d-inline-block">
                            <i class="bi {{ $tiket->status == 'Open' ? 'bi-exclamation-circle' : ($tiket->status == 'On Progress' ? 'bi-tools' : 'bi-check-circle') }} me-1"></i>
                            {{ $tiket->status }}
                        </span>
                        @if($tiket->status === 'Resolved')
                            <div class="small text-success fw-bold"><i class="bi bi-camera me-1"></i>Bukti Selesai:</div>
                            <a href="{{ Storage::url($tiket->foto_perbaikan) }}" target="_blank" class="text-primary small d-block">Lihat Foto Perbaikan</a>
                        @endif
                    </td>
                    <td class="px-4 text-center">
                        @if($tiket->status === 'Open' && Auth::user()->role === 'Site Manager')
                        <form action="{{ route('tiket.progress', $tiket->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning rounded-pill px-3 shadow-sm" onclick="return confirm('Tandai tiket ini sedang dikerjakan/menuju lokasi?')">
                                <i class="bi bi-tools me-1"></i> Kerjakan
                            </button>
                        </form>
                        @elseif($tiket->status === 'On Progress' && Auth::user()->role === 'Site Manager')
                        <button class="btn btn-sm btn-success rounded-pill px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#resolveModal{{ $tiket->id }}">
                            <i class="bi bi-check-circle me-1"></i> Selesaikan
                        </button>

                        <!-- Modal Selesai -->
                        <div class="modal fade" id="resolveModal{{ $tiket->id }}" tabindex="-1" aria-labelledby="resolveModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered text-start">
                                <div class="modal-content rounded-4 border-0 shadow">
                                    <div class="modal-header border-bottom border-custom pb-3">
                                        <h5 class="modal-title fw-bold text-main">Selesaikan Perbaikan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('tiket.resolve', $tiket->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body p-4">
                                            <div class="mb-3">
                                                <label class="form-label text-muted-custom fw-bold">Upload Foto Bukti Selesai <span class="text-danger">*</span></label>
                                                <input class="form-control rounded-3 border-custom" type="file" name="foto_perbaikan" accept="image/jpeg,image/png" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top border-custom pt-3">
                                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-success rounded-pill px-4"><i class="bi bi-check2-all me-2"></i>Tandai Selesai</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @else
                        <span class="text-muted"><i class="bi bi-lock"></i> Locked</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($tikets->count() === 0)
        <div class="text-center py-5">
            <i class="bi bi-ticket-detailed fs-1 text-muted opacity-50 mb-3"></i>
            <h5 class="text-main">Belum Ada Tiket Komplain</h5>
            <p class="text-muted-custom">Semua pemeliharaan aman terkendali.</p>
        </div>
        @endif
    </div>
</div>
@endsection
