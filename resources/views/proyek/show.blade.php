@extends('layouts.app')

@section('title', 'Detail Proyek - SIM BOQ Enterprise')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <style>
        @media (max-width: 991.98px) {
            .col-kode { min-width: 100px; }
            .col-desc { min-width: 250px; }
            .col-loc { min-width: 150px; }
            .col-harga { min-width: 150px; }
            .col-vol { min-width: 120px; }
            .col-selisih { min-width: 100px; }
            .col-aksi { min-width: 100px; }
        }

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
    
    /* Drag and Drop Area */
    .upload-area {
        border: 2px dashed var(--border-color);
        border-radius: 1rem;
        padding: 2.5rem 1.5rem;
        text-align: center;
        background-color: var(--bg-body);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        position: relative;
    }
    .upload-area:hover, .upload-area:focus-within {
        border-color: var(--primary);
        background-color: var(--primary-light);
        transform: translateY(-2px);
    }
    .upload-area input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
    }
    
    /* Table Styles */
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
    .currency-font {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.95rem;
    }
    
    .btn-primary {
        background-color: var(--primary);
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.2s;
        color: white;
    }
    .btn-primary:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        color: white;
    }

    /* Print Styles */
    @media print {
        body { background-color: #fff !important; color: #000 !important; }
        #sidebar, .top-header, .page-header, .btn, .upload-area, form { display: none !important; }
        .main-content { margin-left: 0 !important; width: 100% !important; }
        .card-custom { border: none !important; box-shadow: none !important; padding: 0 !important; margin: 0 !important; }
        .table-responsive { border: none !important; overflow: visible !important; }
        .table { width: 100% !important; border: 1px solid #ddd !important; }
        .table th, .table td { border: 1px solid #ddd !important; padding: 8px !important; color: #000 !important; }
        .badge { border: 1px solid #000 !important; color: #000 !important; background: transparent !important; }
        @page { size: landscape; margin: 1cm; }
    }
</style>
@endpush

@section('content')

    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('proyek.index') }}" class="btn btn-sm btn-outline-secondary rounded-circle me-3" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; border-color: var(--border-color); color: var(--text-main);">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div class="flex-grow-1">
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge {{ $proyek->status_proyek === 'Selesai' ? 'bg-primary border-primary' : 'bg-success border-success' }} bg-opacity-10 text-{{ $proyek->status_proyek === 'Selesai' ? 'primary' : 'success' }} border rounded-pill px-3">{{ $proyek->status_proyek }}</span>
                <span class="text-muted-custom fs-6"><i class="bi bi-clock-history me-1"></i> Didaftarkan {{ $proyek->created_at->format('d M Y') }}</span>
            </div>
            <h2 class="fw-bold mb-1 text-main" style="font-size: 2.2rem;">{{ $proyek->nama_proyek }}</h2>
            <p class="fs-5 text-muted-custom mb-0"><i class="bi bi-building me-2"></i>{{ $proyek->klien->nama_perusahaan }}</p>
        </div>
        
        @if($latestBoq && $latestBoq->status_approval === 'Approved')
        <div class="d-flex gap-2 flex-wrap">
            @if($proyek->status_proyek === 'Selesai')
            <a href="{{ route('proyek.bast', $proyek->id) }}" class="btn btn-danger rounded-pill px-4 text-white">
                <i class="bi bi-file-earmark-pdf me-2"></i>Cetak BAST (PDF)
            </a>
            @endif
            @if(Auth::user()->role === 'Admin' && $proyek->status_proyek !== 'Selesai')
            <form action="{{ route('proyek.complete', $proyek->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary rounded-pill px-4" onclick="return confirm('Apakah Anda yakin ingin menutup proyek ini? Data BOQ yang sudah diverifikasi akan dikunci sebagai final.')">
                    <i class="bi bi-flag-fill me-2"></i>Tandai Selesai
                </button>
            </form>
            @endif
            @if(Auth::user()->role === 'Klien' && !$latestBoq->is_client_approved)
            <form action="{{ route('boq.client-approve', $latestBoq->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm" onclick="return confirm('Dengan mengeklik ini, Anda menyetujui seluruh Rincian BOQ dan total tagihan secara digital. Lanjutkan?')">
                    <i class="bi bi-shield-check me-2"></i>Setujui BAST & Kunci
                </button>
            </form>
            @endif
        </div>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 bg-success bg-opacity-10 text-success shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i> 
            <span class="align-middle fw-medium">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 bg-danger bg-opacity-10 text-danger shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5 align-middle"></i> 
            <span class="align-middle fw-medium">{{ session('error') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-lg-4">
            <div class="d-flex flex-column gap-4 h-100">
                <!-- Info Proyek -->
                <div class="card-custom p-4 mb-0 {{ $proyek->status_proyek === 'Selesai' ? 'h-100' : '' }}">
                    <h5 class="fw-bold border-bottom border-custom pb-3 mb-4 text-main">Informasi Kontrak</h5>
                    
                    <div class="mb-4">
                        <div class="info-label">Perusahaan Klien</div>
                        <div class="info-value d-flex align-items-center mt-1">
                            <div class="rounded p-2 me-2" style="background-color: var(--hover-sidebar);"><i class="bi bi-building text-primary"></i></div>
                            {{ $proyek->klien->nama_perusahaan }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="info-label">PIC (Penanggung Jawab)</div>
                        <div class="info-value d-flex align-items-center mt-1">
                            <div class="rounded p-2 me-2" style="background-color: var(--hover-sidebar);"><i class="bi bi-person-badge text-primary"></i></div>
                            {{ $proyek->klien->pic }}
                        </div>
                    </div>
                    <div class="mb-0">
                        <div class="info-label">Lokasi / Alamat</div>
                        <div class="info-value mt-1 text-muted-custom fs-6">
                            {{ $proyek->klien->alamat }}
                        </div>
                    </div>
                </div>

                @if(Auth::user()->role === 'Admin' && $proyek->status_proyek !== 'Selesai')
                <!-- Form Upload BOQ -->
                <div class="card-custom p-4 mb-0">
                    <h5 class="fw-bold border-bottom border-custom pb-3 mb-4 text-main">Upload Master BOQ</h5>
                    
                    <form action="{{ route('proyek.upload-boq', $proyek->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="upload-area mb-4">
                            <div class="mb-3">
                                <i class="bi bi-file-earmark-spreadsheet text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h6 class="fw-bold text-main mb-1">Pilih File Excel</h6>
                            <p class="text-muted-custom small mb-0">Atau tarik dan lepas file di sini (.xlsx, .xls) Max 5MB</p>
                            <input type="file" id="file_excel" name="file_excel" accept=".xlsx, .xls" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-pill">
                                <i class="bi bi-cloud-arrow-up-fill me-2"></i>Proses & Simpan Draft
                            </button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>

        <div class="col-xl-9 col-lg-8">
            <!-- Navigasi Modul -->
            <ul class="nav nav-pills mb-4 gap-2" id="modulTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-pill px-4" id="boq-tab" data-bs-toggle="tab" data-bs-target="#boq-content" type="button" role="tab"><i class="bi bi-list-check me-2"></i>Detail BOQ</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-4" id="cco-tab" data-bs-toggle="tab" data-bs-target="#cco-content" type="button" role="tab">
                        <i class="bi bi-tools me-2"></i>Tambah/Kurang (CCO)
                        @if($changeRequests->where('status', 'Pending')->count() > 0)
                        <span class="badge bg-warning text-dark rounded-pill ms-2">{{ $changeRequests->where('status', 'Pending')->count() }}</span>
                        @endif
                    </button>
                </li>
                @if($proyek->status_proyek === 'Selesai')
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-4" id="tiket-tab" data-bs-toggle="tab" data-bs-target="#tiket-content" type="button" role="tab">
                        <i class="bi bi-ticket-detailed me-2"></i>Tiket Pemeliharaan
                        @if($tiketPemeliharaans->where('status', '!=', 'Resolved')->count() > 0)
                        <span class="badge bg-danger rounded-pill ms-2">{{ $tiketPemeliharaans->where('status', '!=', 'Resolved')->count() }}</span>
                        @endif
                    </button>
                </li>
                @endif
                @if(Auth::user()->role !== 'Klien')
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-4" id="laporan-tab" data-bs-toggle="tab" data-bs-target="#laporan-content" type="button" role="tab"><i class="bi bi-journal-text me-2"></i>Laporan Harian</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-4" id="kendala-tab" data-bs-toggle="tab" data-bs-target="#kendala-content" type="button" role="tab">
                        <i class="bi bi-exclamation-triangle me-2"></i>Kendala Lapangan
                        @if($proyek->kendalaLapangan->where('status', 'Open')->count() > 0)
                        <span class="badge bg-danger rounded-pill ms-2">{{ $proyek->kendalaLapangan->where('status', 'Open')->count() }}</span>
                        @endif
                    </button>
                </li>
                @endif
            </ul>

            <div class="tab-content" id="modulTabsContent">
                <!-- Modul BOQ -->
                <div class="tab-pane fade show active" id="boq-content" role="tabpanel" tabindex="0">
                    <div class="card-custom p-4 h-100">
                <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom border-custom pb-3 mb-4 gap-3">
                    <h5 class="fw-bold mb-0 text-main">Rincian Item Pekerjaan (BOQ)</h5>
                    @if($latestBoq)
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge text-main border border-custom px-3 py-2 fs-6" style="background-color: var(--bg-body);"><i class="bi bi-tag me-1"></i> {{ $latestBoq->versi_revisi }}</span>
                            <span class="badge {{ $latestBoq->status_approval == 'Draft' ? 'bg-secondary' : ($latestBoq->status_approval == 'Pending' ? 'bg-warning' : ($latestBoq->status_approval == 'Approved' ? 'bg-success' : 'bg-danger')) }} bg-opacity-10 text-{{ $latestBoq->status_approval == 'Draft' ? 'secondary' : ($latestBoq->status_approval == 'Pending' ? 'warning' : ($latestBoq->status_approval == 'Approved' ? 'success' : 'danger')) }} border border-{{ $latestBoq->status_approval == 'Draft' ? 'secondary' : ($latestBoq->status_approval == 'Pending' ? 'warning' : ($latestBoq->status_approval == 'Approved' ? 'success' : 'danger')) }} px-3 py-2 fs-6">
                                <i class="bi {{ $latestBoq->status_approval == 'Draft' ? 'bi-pencil-square' : ($latestBoq->status_approval == 'Pending' ? 'bi-hourglass-split' : ($latestBoq->status_approval == 'Approved' ? 'bi-check-circle' : 'bi-x-circle')) }} me-1"></i> {{ $latestBoq->status_approval }}
                            </span>
                            
                            @if(Auth::user()->role === 'Admin' && $latestBoq->status_approval === 'Draft')
                            <div class="d-flex align-items-center">
                                <form action="{{ route('boq.delete', $latestBoq->id) }}" method="POST" class="ms-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="return confirm('Apakah Anda yakin ingin menghapus draft ini secara permanen?')">
                                        <i class="bi bi-trash-fill me-1"></i> Hapus Draft
                                    </button>
                                </form>
                                <form action="{{ route('boq.submit', $latestBoq->id) }}" method="POST" class="ms-2">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm rounded-pill px-3" onclick="return confirm('Apakah Anda yakin dokumen ini sudah final dan siap dikirim ke Site Manager?')">
                                        <i class="bi bi-send-fill me-1"></i> Ajukan ke Site Manager
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    @endif
                </div>

                @if($proyek->boqHeaders->count() > 0)
                    <ul class="nav nav-tabs border-custom mb-4" id="boqTabs" role="tablist">
                        @foreach($proyek->boqHeaders as $index => $boq)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $index === 0 ? 'active fw-bold text-primary' : 'text-muted-custom' }}" id="tab-{{ $boq->id }}" data-bs-toggle="tab" data-bs-target="#content-{{ $boq->id }}" type="button" role="tab" aria-selected="{{ $index === 0 ? 'true' : 'false' }}" style="{{ $index === 0 ? 'background-color: transparent;' : '' }}">
                                {{ $boq->versi_revisi }}
                                @if($index === 0) <span class="badge bg-primary rounded-pill ms-1" style="font-size: 0.65rem;">Active</span> @endif
                                @if($boq->status_approval === 'Rejected') <i class="bi bi-x-circle text-danger ms-1"></i> @endif
                            </button>
                        </li>
                        @endforeach
                    </ul>

                    <div class="tab-content" id="boqTabsContent">
                        @foreach($proyek->boqHeaders as $index => $boq)
                        <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="content-{{ $boq->id }}" role="tabpanel" aria-labelledby="tab-{{ $boq->id }}">
                            
                            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                                <div class="d-flex align-items-center">
                                    <span class="badge {{ $boq->status_approval == 'Draft' ? 'bg-secondary' : ($boq->status_approval == 'Pending' ? 'bg-warning' : ($boq->status_approval == 'Approved' ? 'bg-success' : 'bg-danger')) }} bg-opacity-10 text-{{ $boq->status_approval == 'Draft' ? 'secondary' : ($boq->status_approval == 'Pending' ? 'warning' : ($boq->status_approval == 'Approved' ? 'success' : 'danger')) }} border border-{{ $boq->status_approval == 'Draft' ? 'secondary' : ($boq->status_approval == 'Pending' ? 'warning' : ($boq->status_approval == 'Approved' ? 'success' : 'danger')) }} px-3 py-2 fs-6">
                                        <i class="bi {{ $boq->status_approval == 'Draft' ? 'bi-pencil-square' : ($boq->status_approval == 'Pending' ? 'bi-hourglass-split' : ($boq->status_approval == 'Approved' ? 'bi-check-circle' : 'bi-x-circle')) }} me-1"></i> Status: {{ $boq->status_approval }}
                                    </span>
                                    @if($boq->is_client_approved)
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary px-3 py-2 fs-6 ms-2" title="Disetujui oleh Klien pada {{ \Carbon\Carbon::parse($boq->client_approved_at)->format('d M Y') }}">
                                        <i class="bi bi-check-circle-fill me-1"></i>Digital Signed
                                    </span>
                                    @endif
                                    <span class="text-muted-custom ms-3 fs-6"><i class="bi bi-clock me-1"></i> Diunggah: {{ $boq->created_at->format('d M Y H:i') }}</span>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    @if(Auth::user()->role === 'Admin' && $boq->status_approval === 'Draft')
                                        <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#addBoqDetailModal" data-boq-id="{{ $boq->id }}">
                                            <i class="bi bi-plus-lg me-1"></i> Tambah Pekerjaan
                                        </button>
                                    @endif
                                    
                                    @if($boq->status_approval === 'Approved' && Auth::user()->role !== 'Site Manager')
                                        <a href="{{ route('boq.export-pdf', $boq->id) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                            <i class="bi bi-printer me-1"></i>Cetak Laporan PDF
                                        </a>
                                    @endif
                                </div>
                            </div>

                            @if($boq->boqDetails->count() > 0)
                            <div class="table-responsive mb-4">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width:8%;" class="col-kode">Kode Item</th>
                                            <th style="width:18%;" class="col-desc">Deskripsi Pekerjaan</th>
                                            <th style="width:12%;" class="col-loc">Lokasi/Zona</th>
                                            @if(Auth::user()->role !== 'Site Manager')
                                            <th style="width:14%;" class="text-end col-harga">Harga Satuan (Rp)</th>
                                            @endif
                                            <th style="width:10%;" class="text-center col-vol">Vol. Kontrak</th>
                                            @if($boq->status_approval === 'Approved' || $boq->status_approval === 'Rejected')
                                                <th style="width:10%;" class="text-center col-vol">Vol. Aktual</th>
                                                <th style="width:10%;" class="text-end col-selisih">Selisih</th>
                                                @if(Auth::user()->role !== 'Site Manager')
                                                <th style="width:14%;" class="text-end col-harga">Total Aktual (Rp)</th>
                                                @endif
                                            @endif
                                            @if(Auth::user()->role === 'Admin' && $boq->status_approval === 'Draft')
                                                <th style="width:8%;" class="text-center col-aksi">Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($boq->boqDetails as $detail)
                                            @php 
                                                $harga_satuan = $detail->harga_material_satuan + $detail->harga_jasa_satuan; 
                                                $total_aktual = $harga_satuan * ($detail->qty_aktual ?? 0);
                                                $selisih_qty = ($detail->qty_aktual ?? 0) - $detail->qty_kontrak;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <span class="badge text-muted-custom border border-custom font-monospace" style="background-color: var(--bg-body);">{{ $detail->barangJasa->kode_barang }}</span>
                                                </td>
                                                <td class="fw-medium text-main text-wrap">{{ $detail->barangJasa->nama_barang }}</td>
                                                <td>
                                                    <div class="text-muted-custom" style="font-size: 0.9rem;">
                                                        <i class="bi bi-geo-alt me-1"></i>
                                                        {{ $detail->lokasi_lantai ?? '-' }} / {{ $detail->lokasi_zona ?? '-' }}
                                                    </div>
                                                </td>
                                                @if(Auth::user()->role !== 'Site Manager')
                                                <td class="text-end currency-font text-main">
                                                    <div>{{ number_format($harga_satuan, 0, ',', '.') }}</div>
                                                    <small class="text-muted-custom" style="font-size: 0.7rem;">M: {{ number_format($detail->harga_material_satuan, 0, ',', '.') }} | J: {{ number_format($detail->harga_jasa_satuan, 0, ',', '.') }}</small>
                                                </td>
                                                @endif
                                                <td class="text-center">
                                                    <div class="fw-bold text-primary">
                                                        {{ rtrim(rtrim(number_format($detail->qty_kontrak, 2, ',', '.'), '0'), ',') }}
                                                        <span class="ms-1 fw-normal opacity-75 small">{{ $detail->barangJasa->satuan }}</span>
                                                    </div>
                                                </td>
                                                @if($boq->status_approval === 'Approved' || $boq->status_approval === 'Rejected')
                                                    <td class="text-center">
                                                        <div class="fw-bold text-success">
                                                            {{ rtrim(rtrim(number_format($detail->qty_aktual, 2, ',', '.'), '0'), ',') }}
                                                            <span class="ms-1 fw-normal opacity-75 small">{{ $detail->barangJasa->satuan }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-end font-monospace {{ $selisih_qty > 0 ? 'text-danger' : ($selisih_qty < 0 ? 'text-success' : 'text-muted-custom') }}">
                                                        {{ $selisih_qty > 0 ? '+' : '' }}{{ rtrim(rtrim(number_format($selisih_qty, 2, ',', '.'), '0'), ',') }}
                                                    </td>
                                                    @if(Auth::user()->role !== 'Site Manager')
                                                    <td class="text-end currency-font fw-bold text-main">
                                                        {{ number_format($total_aktual, 0, ',', '.') }}
                                                    </td>
                                                    @endif
                                                @endif
                                                @if(Auth::user()->role === 'Admin' && $boq->status_approval === 'Draft')
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#editBoqDetailModal" 
                                                            data-id="{{ $detail->id }}" 
                                                            data-kode="{{ $detail->barangJasa->kode_barang }}" 
                                                            data-nama="{{ $detail->barangJasa->nama_barang }}" 
                                                            data-lantai="{{ $detail->lokasi_lantai }}" 
                                                            data-zona="{{ $detail->lokasi_zona }}" 
                                                            data-qty="{{ (float)$detail->qty_kontrak }}">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            @if($index === 0 && $boq->status_approval === 'Approved')
                            @if(Auth::user()->role !== 'Site Manager')
                            <!-- Executive Financial Summary (Only on latest approved) -->
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <div class="p-3 border border-custom rounded-4" style="background-color: var(--bg-body);">
                                        <div class="text-muted-custom text-uppercase fw-bold mb-1" style="font-size: 0.75rem;">Total Nilai Kontrak (RAB)</div>
                                        <div class="fs-4 fw-bold text-main currency-font">Rp {{ number_format($finansial['total_kontrak'], 0, ',', '.') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 border border-custom rounded-4" style="background-color: var(--bg-body);">
                                        <div class="text-muted-custom text-uppercase fw-bold mb-1" style="font-size: 0.75rem;">Total Realisasi Aktual</div>
                                        <div class="fs-4 fw-bold text-success currency-font">Rp {{ number_format($finansial['total_aktual'], 0, ',', '.') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 border {{ $finansial['deviasi'] > 0 ? 'border-danger bg-danger bg-opacity-10' : ($finansial['deviasi'] < 0 ? 'border-success bg-success bg-opacity-10' : 'border-custom') }} rounded-4 h-100">
                                        <div class="text-uppercase fw-bold mb-1 {{ $finansial['deviasi'] > 0 ? 'text-danger' : ($finansial['deviasi'] < 0 ? 'text-success' : 'text-muted-custom') }}" style="font-size: 0.75rem;">Deviasi (Selisih Biaya)</div>
                                        <div class="fs-4 fw-bold currency-font {{ $finansial['deviasi'] > 0 ? 'text-danger' : ($finansial['deviasi'] < 0 ? 'text-success' : 'text-muted-custom') }}">
                                            {{ $finansial['deviasi'] > 0 ? '+' : '' }}Rp {{ number_format($finansial['deviasi'], 0, ',', '.') }}
                                        </div>
                                        <div class="small {{ $finansial['deviasi'] > 0 ? 'text-danger' : ($finansial['deviasi'] < 0 ? 'text-success' : 'text-muted-custom') }} fw-medium mt-1">
                                            <i class="bi {{ $finansial['deviasi'] > 0 ? 'bi-arrow-up-right' : ($finansial['deviasi'] < 0 ? 'bi-arrow-down-right' : 'bi-dash') }}"></i> {{ number_format(abs($finansial['persentase']), 2, ',', '.') }}% dari nilai kontrak
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Laporan & Bukti Fisik Lapangan -->
                            <div class="p-4 border border-custom rounded-4" style="background-color: var(--bg-body);">
                                <h6 class="fw-bold text-main mb-3"><i class="bi bi-camera me-2 text-primary"></i>Laporan Bukti Fisik Lapangan</h6>
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="text-muted-custom fw-bold text-uppercase mb-2" style="font-size: 0.75rem;">File Bukti (Foto/PDF)</div>
                                        @if($boq->file_bukti_lapangan)
                                            <a href="{{ Storage::url($boq->file_bukti_lapangan) }}" target="_blank" class="btn btn-outline-primary rounded-pill px-4 btn-sm">
                                                <i class="bi bi-download me-2"></i>Unduh Bukti Verifikasi
                                            </a>
                                        @else
                                            <span class="text-muted-custom fst-italic fs-6">Tidak ada file bukti terlampir.</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-muted-custom fw-bold text-uppercase mb-2" style="font-size: 0.75rem;">Catatan Site Manager</div>
                                        <div class="p-3 border border-custom rounded-3 text-main" style="background-color: var(--bg-body); font-size: 0.9rem;">
                                            {{ $boq->catatan_sitemanager ?: 'Tidak ada catatan tambahan.' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>

                @else
                    <div class="text-center py-5 my-4">
                        <div class="d-inline-flex justify-content-center align-items-center rounded-circle mb-4" style="width: 100px; height: 100px; background-color: var(--hover-sidebar);">
                            <i class="bi bi-file-earmark-x fs-1 text-muted-custom"></i>
                        </div>
                        <h4 class="fw-bold text-main mb-2">Belum Ada Data BOQ</h4>
                        <p class="text-muted-custom w-75 mx-auto mb-0">Silakan unggah dokumen Bill of Quantities (BOQ) dalam format Excel (.xlsx) untuk melihat dan mengelola rincian item pekerjaan pada proyek ini.</p>
                    </div>
                @endif
                    </div>
                </div>

                <!-- Modul Pekerjaan Tambah Kurang (CCO) -->
                <div class="tab-pane fade" id="cco-content" role="tabpanel" tabindex="0">
                    <div class="card-custom p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center border-bottom border-custom pb-3 mb-4">
                            <h5 class="fw-bold text-main mb-0"><i class="bi bi-tools me-2 text-primary"></i>Pekerjaan Tambah/Kurang (CCO)</h5>
                            @if(Auth::user()->role === 'Klien' && $proyek->status_proyek !== 'Selesai')
                            <button class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahCcoModal">
                                <i class="bi bi-plus-lg me-2"></i>Ajukan CCO Baru
                            </button>
                            @endif
                        </div>

                        @if($changeRequests->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless align-middle custom-table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="py-3 px-4 rounded-start">Subjek</th>
                                            <th class="py-3 px-4">Tanggal Pengajuan</th>
                                            <th class="py-3 px-4">Lampiran</th>
                                            <th class="py-3 px-4 rounded-end">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($changeRequests as $cco)
                                        <tr class="border-bottom border-custom">
                                            <td class="px-4">
                                                <div class="fw-bold text-main">{{ $cco->subjek }}</div>
                                                <div class="text-muted-custom small text-wrap" style="max-width: 300px;">{{ Str::limit($cco->deskripsi_perubahan, 100) }}</div>
                                            </td>
                                            <td class="px-4 text-muted-custom">{{ $cco->created_at->format('d M Y H:i') }}</td>
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
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-tools fs-1 text-primary opacity-50 mb-3"></i>
                                <h5 class="text-main">Belum ada pengajuan CCO</h5>
                                <p class="text-muted-custom">Jika ada perubahan desain atau penambahan/pengurangan item, Klien dapat mengajukannya di sini.</p>
                            </div>
                        @endif
                    </div>
                </div>

                @if($proyek->status_proyek === 'Selesai')
                <!-- Modul Tiket Pemeliharaan -->
                <div class="tab-pane fade" id="tiket-content" role="tabpanel" tabindex="0">
                    <div class="card-custom p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center border-bottom border-custom pb-3 mb-4">
                            <h5 class="fw-bold text-main mb-0"><i class="bi bi-ticket-detailed me-2 text-danger"></i>Tiket Pemeliharaan (Masa Retensi)</h5>
                            @if(Auth::user()->role === 'Klien')
                            <button class="btn btn-danger rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahTiketModal">
                                <i class="bi bi-exclamation-triangle me-2"></i>Buat Tiket Komplain
                            </button>
                            @endif
                        </div>

                        @if($tiketPemeliharaans->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless align-middle custom-table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="py-3 px-4 rounded-start">Subjek & Deskripsi Masalah</th>
                                            <th class="py-3 px-4">Lampiran Foto</th>
                                            <th class="py-3 px-4 rounded-end">Status & Bukti Penyelesaian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tiketPemeliharaans as $tiket)
                                        <tr class="border-bottom border-custom">
                                            <td class="px-4">
                                                <div class="fw-bold text-main text-danger">{{ $tiket->subjek }}</div>
                                                <div class="text-muted-custom small text-wrap mt-1" style="max-width: 300px;">{{ $tiket->deskripsi }}</div>
                                                <div class="text-muted-custom small mt-2"><i class="bi bi-clock me-1"></i>Dilaporkan: {{ $tiket->created_at->format('d M Y H:i') }}</div>
                                            </td>
                                            <td class="px-4">
                                                @if($tiket->foto_kerusakan)
                                                    <a href="{{ Storage::url($tiket->foto_kerusakan) }}" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill"><i class="bi bi-image me-1"></i>Lihat Kerusakan</a>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="px-4">
                                                <span class="badge {{ $tiket->status == 'Open' ? 'bg-danger' : ($tiket->status == 'On Progress' ? 'bg-warning text-dark' : 'bg-success') }} px-3 py-2 rounded-pill mb-2 d-inline-block">
                                                    {{ $tiket->status }}
                                                </span>
                                                @if($tiket->status === 'Resolved')
                                                    <div class="small text-success fw-bold"><i class="bi bi-camera me-1"></i>Bukti Selesai:</div>
                                                    <a href="{{ Storage::url($tiket->foto_perbaikan) }}" target="_blank" class="text-primary small d-block">Lihat Foto Perbaikan</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-shield-check fs-1 text-success opacity-50 mb-3"></i>
                                <h5 class="text-main">Belum ada Tiket Komplain</h5>
                                <p class="text-muted-custom">Jika ada kerusakan atau keluhan selama masa retensi, Klien dapat melaporkannya di sini.</p>
                            </div>
                        @endif
                    </div>
                </div>
                @endif

                @if(Auth::user()->role !== 'Klien')
                <!-- Modul Laporan Harian -->
                <div class="tab-pane fade" id="laporan-content" role="tabpanel" tabindex="0">
                    <div class="card-custom p-4 h-100">
                        <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom border-custom pb-3 mb-4 gap-3">
                            <h5 class="fw-bold mb-0 text-main">Laporan Harian (Daily Log)</h5>
                            @if(Auth::user()->role === 'Site Manager' && $proyek->status_proyek !== 'Selesai')
                            <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#laporanHarianModal">
                                <i class="bi bi-plus-lg me-2"></i>Buat Laporan Hari Ini
                            </button>
                            @endif
                        </div>
                        
                        @if($proyek->laporanHarian->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Pelapor</th>
                                            <th>Cuaca</th>
                                            <th>Jml Pekerja</th>
                                            <th>Kegiatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($proyek->laporanHarian as $laporan)
                                        <tr>
                                            <td class="fw-medium">{{ \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') }}</td>
                                            <td>{{ $laporan->user->name }}</td>
                                            <td>
                                                <span class="badge {{ $laporan->cuaca == 'Cerah' ? 'bg-success' : ($laporan->cuaca == 'Berawan' ? 'bg-secondary' : ($laporan->cuaca == 'Gerimis' ? 'bg-warning' : 'bg-danger')) }}">
                                                    {{ $laporan->cuaca }}
                                                </span>
                                            </td>
                                            <td>{{ $laporan->jumlah_pekerja }} Orang</td>
                                            <td>{{ Str::limit($laporan->kegiatan, 50) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-journal-x fs-1 text-muted-custom mb-3"></i>
                                <h5 class="text-main">Belum Ada Laporan Harian</h5>
                                <p class="text-muted-custom">Site Manager belum membuat laporan harian untuk proyek ini.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Modul Kendala Lapangan -->
                <div class="tab-pane fade" id="kendala-content" role="tabpanel" tabindex="0">
                    <div class="card-custom p-4 h-100">
                        <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom border-custom pb-3 mb-4 gap-3">
                            <h5 class="fw-bold mb-0 text-main">Kendala Lapangan (Issue Tracker)</h5>
                            @if(Auth::user()->role === 'Site Manager' && $proyek->status_proyek !== 'Selesai')
                            <button type="button" class="btn btn-danger rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#kendalaLapanganModal">
                                <i class="bi bi-exclamation-triangle me-2"></i>Lapor Kendala
                            </button>
                            @endif
                        </div>
                        
                        @if($proyek->kendalaLapangan->count() > 0)
                            <div class="row g-4">
                                @foreach($proyek->kendalaLapangan as $kendala)
                                <div class="col-md-6">
                                    <div class="card border border-custom shadow-sm h-100 {{ $kendala->status == 'Open' ? 'border-danger' : 'border-success' }}">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <h6 class="fw-bold text-main mb-0">{{ $kendala->judul_kendala }}</h6>
                                                <span class="badge {{ $kendala->status == 'Open' ? 'bg-danger' : 'bg-success' }}">{{ $kendala->status }}</span>
                                            </div>
                                            <p class="text-muted-custom small mb-3"><i class="bi bi-person me-1"></i> {{ $kendala->user->name }} &bull; {{ $kendala->created_at->format('d M Y H:i') }}</p>
                                            <p class="text-main">{{ $kendala->deskripsi }}</p>
                                            
                                            @if($kendala->foto_kendala)
                                            <div class="mb-3">
                                                <a href="{{ Storage::url($kendala->foto_kendala) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                    <i class="bi bi-image me-1"></i> Lihat Foto Bukti
                                                </a>
                                            </div>
                                            @endif
                                            
                                            @if(Auth::user()->role === 'Admin' && $kendala->status == 'Open')
                                            <form action="{{ route('kendala.resolve', $kendala->id) }}" method="POST" class="mt-3 border-top pt-3">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm w-100" onclick="return confirm('Tandai kendala ini sudah diselesaikan?')">
                                                    <i class="bi bi-check2-circle me-1"></i> Tandai Selesai (Resolved)
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-shield-check fs-1 text-success mb-3"></i>
                                <h5 class="text-main">Tidak Ada Kendala</h5>
                                <p class="text-muted-custom">Belum ada kendala lapangan yang dilaporkan.</p>
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Edit BOQ Detail -->
    <div class="modal fade" id="editBoqDetailModal" tabindex="-1" aria-labelledby="editBoqDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-bottom border-custom pb-3">
                    <h5 class="modal-title fw-bold text-main" id="editBoqDetailModalLabel">Edit Rincian BOQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editBoqDetailForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label text-muted-custom fw-bold" style="font-size: 0.85rem;">Item Pekerjaan</label>
                            <div class="p-3 bg-light rounded-3 border border-custom">
                                <span class="badge bg-secondary mb-1" id="editKodeItem">KODE</span>
                                <div class="fw-bold text-main" id="editNamaItem">Nama Item</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="qty_kontrak" class="form-label text-main fw-medium">Volume Kontrak (Qty) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control rounded-3" id="qty_kontrak" name="qty_kontrak" step="0.01" min="0" required>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="lokasi_lantai" class="form-label text-main fw-medium">Lokasi Lantai</label>
                                <input type="text" class="form-control rounded-3" id="lokasi_lantai" name="lokasi_lantai" placeholder="Contoh: Lantai 1">
                            </div>
                            <div class="col-md-6">
                                <label for="lokasi_zona" class="form-label text-main fw-medium">Lokasi Zona</label>
                                <input type="text" class="form-control rounded-3" id="lokasi_zona" name="lokasi_zona" placeholder="Contoh: Ruang Server">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top border-custom pt-3">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah BOQ Detail -->
    <div class="modal fade" id="addBoqDetailModal" tabindex="-1" aria-labelledby="addBoqDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4" style="background-color: var(--bg-card);">
                <div class="modal-header border-bottom border-custom pb-3">
                    <h5 class="modal-title fw-bold text-main" id="addBoqDetailModalLabel">
                        <i class="bi bi-plus-circle text-primary me-2"></i>Tambah Item Pekerjaan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addBoqDetailForm" method="POST" action="{{ route('boq.detail.store') }}">
                    @csrf
                    <input type="hidden" name="boq_header_id" id="add_boq_header_id">
                    
                    <div class="modal-body py-4">
                        <div class="mb-3">
                            <label for="add_barang_jasa_id" class="form-label text-main fw-medium">Pilih Master Barang/Jasa</label>
                            <select class="form-select rounded-3" id="add_barang_jasa_id" name="barang_jasa_id" required>
                                <option value="" disabled selected>-- Cari dan Pilih Item --</option>
                                @foreach($masterData as $item)
                                    <option value="{{ $item->id }}">[{{ $item->kode_barang }}] {{ $item->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-12">
                                <label for="add_qty_kontrak" class="form-label text-main fw-medium">Volume (Qty)</label>
                                <input type="number" class="form-control rounded-3" id="add_qty_kontrak" name="qty_kontrak" step="0.01" min="0" required>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="add_lokasi_lantai" class="form-label text-main fw-medium">Lokasi Lantai</label>
                                <input type="text" class="form-control rounded-3" id="add_lokasi_lantai" name="lokasi_lantai" placeholder="Contoh: Lantai 1">
                            </div>
                            <div class="col-md-6">
                                <label for="add_lokasi_zona" class="form-label text-main fw-medium">Lokasi Zona/Area</label>
                                <input type="text" class="form-control rounded-3" id="add_lokasi_zona" name="lokasi_zona" placeholder="Contoh: Ruang Rapat">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top border-custom pt-3">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal" style="background-color: var(--bg-body); color: var(--text-main); border: 1px solid var(--border-color);">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Simpan Item Baru</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah CCO -->
    @if(Auth::user()->role === 'Klien')
    <div class="modal fade" id="tambahCcoModal" tabindex="-1" aria-labelledby="tambahCcoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-bottom border-custom pb-3">
                    <h5 class="modal-title fw-bold text-main" id="tambahCcoModalLabel">Ajukan Perubahan (CCO)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('cco.store', $proyek->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label for="subjek" class="form-label text-muted-custom fw-bold">Subjek Perubahan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-3 border-custom" id="subjek" name="subjek" required placeholder="Misal: Penambahan 2 Unit AC Daikin di Lantai 3">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_perubahan" class="form-label text-muted-custom fw-bold">Deskripsi Detail <span class="text-danger">*</span></label>
                            <textarea class="form-control rounded-3 border-custom" id="deskripsi_perubahan" name="deskripsi_perubahan" rows="4" required placeholder="Jelaskan secara rinci alasan perubahan atau detail yang Anda inginkan..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="lampiran" class="form-label text-muted-custom fw-bold">Lampiran Foto/Sketsa (Opsional)</label>
                            <input class="form-control rounded-3 border-custom" type="file" id="lampiran" name="lampiran" accept="image/jpeg,image/png">
                            <div class="form-text mt-2"><i class="bi bi-info-circle me-1"></i>Format JPG/PNG. Maksimal 5MB.</div>
                        </div>
                    </div>
                    <div class="modal-footer border-top border-custom pt-3">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="bi bi-send me-2"></i>Kirim Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal Tambah Tiket -->
    @if(Auth::user()->role === 'Klien' && $proyek->status_proyek === 'Selesai')
    <div class="modal fade" id="tambahTiketModal" tabindex="-1" aria-labelledby="tambahTiketModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-bottom border-custom pb-3">
                    <h5 class="modal-title fw-bold text-danger" id="tambahTiketModalLabel"><i class="bi bi-exclamation-triangle me-2"></i>Buat Tiket Komplain Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('tiket.store', $proyek->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="alert alert-warning rounded-3 border-0 bg-warning bg-opacity-10 text-dark p-3 mb-4">
                            <i class="bi bi-info-circle me-2"></i>Tiket ini akan langsung dikirim ke Site Manager dan Admin untuk segera ditindaklanjuti.
                        </div>
                        <div class="mb-3">
                            <label for="subjek" class="form-label text-muted-custom fw-bold">Subjek Kerusakan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-3 border-custom" name="subjek" required placeholder="Misal: AC Bocor di Lantai 1">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label text-muted-custom fw-bold">Deskripsi Detail Masalah <span class="text-danger">*</span></label>
                            <textarea class="form-control rounded-3 border-custom" name="deskripsi" rows="4" required placeholder="Jelaskan secara rinci kendala/kerusakan yang terjadi..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="foto_kerusakan" class="form-label text-muted-custom fw-bold">Foto Kerusakan (Opsional)</label>
                            <input class="form-control rounded-3 border-custom" type="file" name="foto_kerusakan" accept="image/jpeg,image/png">
                            <div class="form-text mt-2"><i class="bi bi-image me-1"></i>Format JPG/PNG. Maksimal 5MB. Sangat membantu teknisi untuk analisa awal.</div>
                        </div>
                    </div>
                    <div class="modal-footer border-top border-custom pt-3">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-4"><i class="bi bi-send-exclamation me-2"></i>Kirim Komplain</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        if ($('#add_barang_jasa_id').length) {
            $('#add_barang_jasa_id').select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#addBoqDetailModal'),
                width: '100%',
                placeholder: '-- Cari dan Pilih Item --'
            });
        }
    });
</script>
@endpush

<!-- Modal Laporan Harian -->
<div class="modal fade" id="laporanHarianModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom border-custom pb-3">
                <h5 class="modal-title fw-bold text-main">Buat Laporan Harian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('laporan.store') }}" method="POST">
                @csrf
                <input type="hidden" name="proyek_id" value="{{ $proyek->id }}">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label text-main fw-medium">Tanggal</label>
                        <input type="date" class="form-control rounded-3" name="tanggal" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-main fw-medium">Kondisi Cuaca</label>
                        <select class="form-select rounded-3" name="cuaca" required>
                            <option value="Cerah">Cerah</option>
                            <option value="Berawan">Berawan</option>
                            <option value="Gerimis">Gerimis</option>
                            <option value="Hujan Lebat">Hujan Lebat</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-main fw-medium">Jumlah Pekerja di Lapangan</label>
                        <input type="number" class="form-control rounded-3" name="jumlah_pekerja" min="1" required placeholder="Contoh: 5">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-main fw-medium">Kegiatan / Pekerjaan Hari Ini</label>
                        <textarea class="form-control rounded-3" name="kegiatan" rows="4" required placeholder="Tulis rincian area dan pekerjaan yang dilakukan hari ini..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top border-custom pt-3">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Laporan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Kendala Lapangan -->
<div class="modal fade" id="kendalaLapanganModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom border-custom pb-3">
                <h5 class="modal-title fw-bold text-danger"><i class="bi bi-exclamation-triangle me-2"></i>Lapor Kendala Lapangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kendala.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="proyek_id" value="{{ $proyek->id }}">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label text-main fw-medium">Judul Kendala</label>
                        <input type="text" class="form-control rounded-3" name="judul_kendala" required placeholder="Contoh: Akses ruang server dikunci">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-main fw-medium">Deskripsi Lengkap</label>
                        <textarea class="form-control rounded-3" name="deskripsi" rows="4" required placeholder="Ceritakan detail kendala yang menghambat progres..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-main fw-medium">Foto Bukti Kendala (Opsional)</label>
                        <input type="file" class="form-control rounded-3" name="foto_kendala" accept="image/*">
                        <div class="form-text text-muted-custom">Format: JPG/PNG, Max 2MB. Sangat disarankan melampirkan foto.</div>
                    </div>
                </div>
                <div class="modal-footer border-top border-custom pt-3 bg-light">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4">Kirim Laporan Kendala</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        if ($('#add_barang_jasa_id').length) {
            $('#add_barang_jasa_id').select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#addBoqDetailModal'),
                width: '100%',
                placeholder: '-- Cari dan Pilih Item --'
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('file_excel');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name;
                if (fileName) {
                    const area = this.closest('.upload-area');
                    const title = area.querySelector('h6');
                    const desc = area.querySelector('p');
                    const icon = area.querySelector('.bi-file-earmark-spreadsheet');
                    
                    title.innerHTML = fileName;
                    title.classList.remove('text-main');
                    title.classList.add('text-success');
                    
                    desc.innerHTML = 'File siap untuk diproses';
                    desc.classList.remove('text-muted-custom');
                    desc.classList.add('text-success');
                    
                    if(icon) {
                        icon.classList.remove('bi-file-earmark-spreadsheet', 'text-primary');
                        icon.classList.add('bi-file-earmark-check-fill', 'text-success');
                    }
                    
                    area.style.borderColor = 'var(--bs-success)';
                    area.style.backgroundColor = 'rgba(34, 197, 94, 0.05)';
                }
            });
        }

        const editBoqDetailModal = document.getElementById('editBoqDetailModal');
        if (editBoqDetailModal) {
            editBoqDetailModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');
                const kode = button.getAttribute('data-kode');
                const nama = button.getAttribute('data-nama');
                const lantai = button.getAttribute('data-lantai');
                const zona = button.getAttribute('data-zona');
                const qty = button.getAttribute('data-qty');
                
                const form = document.getElementById('editBoqDetailForm');
                form.action = `/boq-detail/${id}`;
                
                document.getElementById('editKodeItem').textContent = kode;
                document.getElementById('editNamaItem').textContent = nama;
                document.getElementById('lokasi_lantai').value = lantai;
                document.getElementById('lokasi_zona').value = zona;
                document.getElementById('qty_kontrak').value = qty;
            });
        }
        
        const addBoqDetailModal = document.getElementById('addBoqDetailModal');
        if (addBoqDetailModal) {
            addBoqDetailModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const boqId = button.getAttribute('data-boq-id');
                document.getElementById('add_boq_header_id').value = boqId;
            });
        }
    });
</script>
@endpush
