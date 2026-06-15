@extends('layouts.app')

@section('title', 'Verifikasi BOQ Lapangan - SIM BOQ Enterprise')

@push('styles')
<style>
    .info-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.75px;
        margin-bottom: 0.35rem;
    }
    .info-value {
        font-size: 1.05rem;
        font-weight: 500;
        color: var(--text-main);
    }
    
    .table-responsive {
        border-radius: 0.75rem;
        border: 1px solid var(--border-color);
    }
    .table > :not(caption)>*>* {
        padding: 1rem;
        border-bottom-color: var(--border-color);
        color: var(--text-main);
    }
    .table thead th {
        background-color: var(--hover-sidebar);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-muted);
        border-bottom: none;
    }
    
    .qty-input {
        width: 100px;
        text-align: center;
        background-color: var(--bg-body);
        color: var(--text-main);
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        padding: 0.5rem;
        font-weight: 600;
    }
    .qty-input:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
    }
</style>
@endpush

@section('content')

    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-secondary rounded-circle me-3" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-color: var(--border-color); color: var(--text-main);">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div class="flex-grow-1">
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning rounded-pill px-3"><i class="bi bi-hourglass-split me-1"></i> Menunggu Verifikasi Anda</span>
            </div>
            <h2 class="fw-bold mb-1 text-main" style="font-size: 2.2rem;">Verifikasi BOQ: {{ $boq->nomor_surat }}</h2>
            <p class="fs-5 text-muted-custom mb-0"><i class="bi bi-building me-2"></i>{{ $boq->proyek->nama_proyek }}</p>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 bg-danger bg-opacity-10 text-danger shadow-sm mb-4" role="alert">
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

    <form action="{{ route('sitemanager.submit', $boq->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-custom p-4 mb-4">
            <div class="d-flex align-items-center mb-4">
                <h5 class="fw-bold mb-0 text-main">Rincian Fisik Pekerjaan (Laporkan Kuantitas Aktual)</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="15%">Kode Item</th>
                            <th width="35%">Deskripsi Pekerjaan</th>
                            <th width="20%">Lokasi / Zona</th>
                            <th width="15%" class="text-center">Qty Kontrak</th>
                            <th width="15%" class="text-center">Qty Aktual (Lapangan) <span class="text-danger">*</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($boq->boqDetails as $detail)
                            <tr>
                                <td>
                                    <span class="badge text-muted-custom border border-custom font-monospace" style="background-color: var(--bg-body);">{{ $detail->barangJasa->kode_barang }}</span>
                                </td>
                                <td class="fw-medium text-main">{{ $detail->barangJasa->nama_barang }}</td>
                                <td>
                                    <div class="text-muted-custom" style="font-size: 0.9rem;">
                                        <i class="bi bi-geo-alt me-1"></i>
                                        {{ $detail->lokasi_lantai ?? '-' }} / {{ $detail->lokasi_zona ?? '-' }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex align-items-center bg-primary bg-opacity-10 text-primary fw-bold px-3 py-1 rounded-pill">
                                        {{ rtrim(rtrim(number_format($detail->qty_kontrak, 2, ',', '.'), '0'), ',') }}
                                        <span class="ms-1 fw-normal opacity-75 small">{{ $detail->barangJasa->satuan }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <input type="number" step="0.01" min="0" 
                                            name="qty_aktual[{{ $detail->id }}]" 
                                            class="qty-input" 
                                            value="{{ old('qty_aktual.'.$detail->id, $detail->qty_aktual ?? rtrim(rtrim(number_format($detail->qty_kontrak, 2, '.', ''), '0'), '.')) }}" 
                                            required>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-custom p-4 mb-4">
            <h5 class="fw-bold mb-3 text-main">Bukti Lapangan & Catatan</h5>
            <div class="row g-4">
                <div class="col-md-6">
                    <label for="file_bukti_lapangan" class="form-label fw-bold">Unggah Bukti Lapangan (Foto/PDF) <span class="text-danger">*</span></label>
                    <input class="form-control" type="file" id="file_bukti_lapangan" name="file_bukti_lapangan" accept=".jpg,.jpeg,.png,.pdf" required style="border-radius: 0.75rem; padding: 0.75rem;">
                    <div class="form-text text-muted-custom mt-2"><i class="bi bi-info-circle me-1"></i> Format: JPG, PNG, PDF. Maksimal 5MB. Wajib diisi untuk proses verifikasi.</div>
                </div>
                <div class="col-md-6">
                    <label for="catatan_sitemanager" class="form-label fw-bold">Catatan Tambahan</label>
                    <textarea class="form-control" id="catatan_sitemanager" name="catatan_sitemanager" rows="3" placeholder="Misal: Terdapat perbedaan kondisi tanah sehingga perlu pengerukan tambahan..." style="border-radius: 0.75rem;"></textarea>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-end gap-3 mb-5">
            <button type="submit" name="action" value="reject" class="btn btn-outline-danger rounded-pill px-4 py-2 fw-medium" onclick="return confirm('Apakah Anda yakin ingin menolak dokumen BOQ ini?')">
                <i class="bi bi-x-circle me-1"></i> Tolak (Reject)
            </button>
            <button type="submit" name="action" value="approve" class="btn btn-success rounded-pill px-4 py-2 fw-medium text-white shadow-sm" onclick="return confirm('Apakah Anda yakin data kuantitas aktual sudah benar dan ingin menyetujui dokumen ini?')">
                <i class="bi bi-check2-circle me-1"></i> Setujui & Simpan
            </button>
        </div>
    </form>

@endsection
