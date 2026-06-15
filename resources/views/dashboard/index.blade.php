@extends('layouts.app')

@section('title', 'Dashboard - SIM BOQ Enterprise')

@push('styles')
<style>
    /* Dashboard Specific Styles (Sudah dibungkus app layout) */
    .dashboard-header {
        margin: -3rem -3rem 2rem -3rem; /* Compensate for padding in main-content */
        padding: 3rem 3rem 4rem;
        background: linear-gradient(135deg, var(--primary) 0%, #3b82f6 100%);
        position: relative;
        overflow: hidden;
        border-radius: 0 0 2rem 2rem;
    }
    
    [data-theme="dark"] .dashboard-header {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-bottom: 1px solid var(--border-color);
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -50%; right: -10%;
        width: 50%; height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        z-index: 1;
    }

    .dashboard-header-content {
        position: relative;
        z-index: 2;
        color: white;
    }

    .stat-card {
        padding: 1.75rem;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: block;
        text-decoration: none;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 25px -5px rgba(0, 0, 0, 0.1);
        border-color: var(--primary);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .icon-blue { background-color: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .icon-purple { background-color: rgba(168, 85, 247, 0.1); color: #a855f7; }
    .icon-green { background-color: rgba(34, 197, 94, 0.1); color: #22c55e; }
    .icon-orange { background-color: rgba(249, 115, 22, 0.1); color: #f97316; }

    .stat-value {
        font-family: 'Outfit', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: var(--text-main);
    }
    
    .timeline-item {
        position: relative;
        padding-left: 2.5rem;
        padding-bottom: 1.5rem;
        border-left: 2px solid var(--border-color);
        margin-left: 1rem;
    }
    .timeline-item:last-child {
        border-left-color: transparent;
        padding-bottom: 0;
    }
    .timeline-icon {
        position: absolute;
        left: -11px;
        top: 0;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: var(--primary);
        border: 4px solid var(--bg-card);
    }

    /* Penyesuaian agar tidak terpotong padding */
    @media (max-width: 767.98px) {
        .dashboard-header {
            margin: -1.5rem -1.5rem 2rem -1.5rem;
            padding: 2rem 1.5rem 3rem;
            border-radius: 0 0 1rem 1rem;
        }
    }
</style>
@endpush

@section('content')

    <div class="dashboard-header">
        <div class="dashboard-header-content container-fluid px-0 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                @if (Auth::user()->role === 'Site Manager')
                    <span class="badge rounded-pill mb-2 px-3 py-2 fw-semibold border border-custom text-main" style="background-color: var(--bg-card);">Workspace Personal</span>
                    <h1 class="fw-bold mb-2">Semangat bekerja, {{ Auth::user()->nama_lengkap }}!</h1>
                    <p class="fs-6 opacity-75 mb-0 fw-light">Selesaikan verifikasi BOQ lapangan untuk kelancaran operasional proyek.</p>
                @elseif (Auth::user()->role === 'Direktur')
                    <span class="badge rounded-pill mb-2 px-3 py-2 fw-semibold border border-custom text-main" style="background-color: var(--bg-card); color: var(--primary);">Executive Board</span>
                    <h1 class="fw-bold mb-2">Selamat datang, Direktur!</h1>
                    <p class="fs-6 opacity-75 mb-0 fw-light">Pantau analitik proyek, kesehatan finansial, dan log aktivitas operasional perusahaan.</p>
                @elseif (Auth::user()->role === 'Klien')
                    <span class="badge rounded-pill mb-2 px-3 py-2 fw-semibold border border-custom text-main" style="background-color: var(--bg-card); color: var(--primary);">Client Portal</span>
                    <h1 class="fw-bold mb-2">Selamat datang, {{ Auth::user()->klien->nama_perusahaan ?? 'Klien' }}</h1>
                    <p class="fs-6 opacity-75 mb-0 fw-light">Pantau perkembangan dan laporan persetujuan proyek Anda di sini.</p>
                @else
                    <span class="badge rounded-pill mb-2 px-3 py-2 fw-semibold border border-custom" style="background-color: var(--bg-card); color: var(--primary);">Control Center</span>
                    <h1 class="fw-bold mb-2">Dashboard Administratif</h1>
                    <p class="fs-6 opacity-75 mb-0 fw-light">Ringkasan analitik dan manajemen operasional Bill of Quantities.</p>
                @endif
            </div>
            
            @if(in_array(Auth::user()->role, ['Admin', 'Direktur']))
            <div>
                <a href="{{ route('dashboard.export-eksekutif') }}" target="_blank" class="btn btn-danger rounded-pill px-4 py-2 shadow-sm fw-bold border-0" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                    <i class="bi bi-file-earmark-pdf-fill me-2"></i>Cetak Laporan Eksekutif
                </a>
            </div>
            @endif
        </div>
    </div>

    @if (in_array(Auth::user()->role, ['Admin', 'Direktur', 'Klien']))
        <div class="row g-4 mb-4">
            <!-- KPIs -->
            <div class="col-md-6 col-xl-3">
                <a href="{{ route('proyek.index') }}" class="card-custom stat-card text-center text-decoration-none d-block">
                    <div class="stat-icon icon-blue mx-auto mb-3"><i class="bi bi-buildings"></i></div>
                    <div class="stat-value">{{ $totalProyek }}</div>
                    <div class="text-muted-custom" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Proyek Aktif</div>
                    <div class="mt-3 text-success" style="font-size: 0.8rem; font-weight: 500;">
                        Seluruh proyek yang sedang berjalan
                    </div>
                </a>
            </div>
            
            <div class="col-md-6 col-xl-3">
                <div class="card-custom stat-card text-center">
                    <div class="stat-icon icon-orange mx-auto mb-3"><i class="bi bi-hourglass-split"></i></div>
                    <div class="stat-value">{{ $boqPending }}</div>
                    <div class="text-muted-custom" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">BOQ Menunggu</div>
                    <div class="mt-3 text-warning" style="font-size: 0.8rem; font-weight: 500;">
                        <i class="bi bi-exclamation-circle me-1"></i> Perlu direview Site Manager
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card-custom stat-card text-center">
                    <div class="stat-icon icon-green mx-auto mb-3"><i class="bi bi-check2-circle"></i></div>
                    <div class="stat-value">{{ $boqApproved }}</div>
                    <div class="text-muted-custom" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">BOQ Approved</div>
                    <div class="mt-3 text-muted-custom" style="font-size: 0.8rem; font-weight: 500;">
                        Telah selesai proses final
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-xl-3">
                <div class="card-custom stat-card text-center" style="opacity: 0.7; cursor: not-allowed;">
                    <div class="stat-icon icon-purple mx-auto mb-3"><i class="bi bi-box"></i></div>
                    <div class="stat-value">{{ $totalMaster }}</div>
                    <div class="text-muted-custom" style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Master Data</div>
                    <div class="mt-3 text-muted-custom" style="font-size: 0.8rem; font-weight: 500;">
                        @if(Auth::user()->role === 'Klien') Data tidak relevan @else Total Barang & Jasa di DB @endif
                    </div>
                </div>
            </div>
        </div>
        
        @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Direktur')
        <div class="row g-4 mb-4">
            <div class="col-lg-4">
                <div class="card-custom p-4 h-100">
                    <h5 class="fw-bold mb-4 text-main">Status Proyek</h5>
                    <div style="position: relative; height:250px; width:100%">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card-custom p-4 h-100">
                    <h5 class="fw-bold mb-4 text-main">Tren Finansial (Kontrak vs Aktual)</h5>
                    <div style="position: relative; height:250px; width:100%">
                        <canvas id="finansialChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <div class="row g-4">
            <div class="col-lg-8">
                <!-- Log Aktivitas Audit -->
                <div class="card-custom p-4 h-100">
                    <h5 class="fw-bold mb-4 text-main">Aktivitas Sistem & Jejak Audit</h5>
                    <div class="timeline">
                        @forelse($recentActivities as $log)
                            <div class="timeline-item">
                                <div class="timeline-icon {{ str_contains($log->action, 'Selesai') ? 'bg-primary' : (str_contains($log->action, 'Approved') ? 'bg-success' : 'bg-info') }}"></div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div class="fw-bold text-main" style="font-size: 0.95rem;">{{ $log->user->nama_lengkap ?? 'System' }} ({{ $log->user->role ?? 'Sistem' }})</div>
                                    <span class="text-muted-custom" style="font-size: 0.75rem;">{{ $log->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="text-muted-custom mt-1" style="font-size: 0.85rem;">{{ $log->action }}</div>
                                @if($log->description)
                                <div class="text-muted-custom mt-1 fst-italic" style="font-size: 0.8rem;">{{ $log->description }}</div>
                                @endif
                            </div>
                        @empty
                            <div class="timeline-item">
                                <div class="timeline-icon bg-success"></div>
                                <div class="fw-bold text-main" style="font-size: 0.95rem;">Sistem Online</div>
                                <div class="text-muted-custom mt-1" style="font-size: 0.85rem;">Sistem SIM BOQ Enterprise siap digunakan.</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card-custom p-4 h-100 text-center d-flex flex-column justify-content-center align-items-center">
                    <div class="mb-4 text-primary bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="bi bi-shield-check" style="font-size: 2.5rem;"></i>
                    </div>
                    <h5 class="fw-bold text-main">Sistem Keamanan Aktif</h5>
                    <p class="text-muted-custom mb-0" style="font-size: 0.9rem;">Seluruh data operasi diamankan dengan sistem SoftDeletes dan aktivitas diawasi melalui Audit Trail secara waktu-nyata.</p>
                </div>
            </div>
        </div>

    @else
        <!-- View untuk Site Manager -->
        <div class="row g-4 mb-5">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-end mb-3">
                    <h5 class="fw-bold text-main mb-0">Ringkasan Aktivitas</h5>
                </div>
            </div>
            
            <div class="col-md-3">
                <a href="#verifikasi" class="metric-card card-custom p-4 text-center text-decoration-none d-block h-100" style="border: 2px solid var(--warning); background-color: var(--warning-light); transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 10px 25px -5px rgba(245, 158, 11, 0.15);">
                    <div class="metric-icon text-warning bg-white shadow-sm mx-auto mb-3" style="width: 64px; height: 64px; font-size: 1.8rem; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <h2 class="fw-bold text-warning mb-1" style="font-size: 2.5rem;">{{ $tugasVerifikasi->count() }}</h2>
                    <span class="text-muted-custom small fw-bold text-uppercase" style="letter-spacing: 1px;">Perlu Verifikasi</span>
                </a>
            </div>
            <div class="col-md-3">
                <div class="metric-card card-custom p-4 text-center h-100" style="transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                    <div class="metric-icon text-success bg-success bg-opacity-10 mx-auto mb-3" style="width: 64px; height: 64px; font-size: 1.8rem; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                        <i class="bi bi-check2-all"></i>
                    </div>
                    <h2 class="fw-bold mb-1" style="font-size: 2.5rem; color: var(--text-main);">{{ $boqDiverifikasi }}</h2>
                    <span class="text-muted-custom small fw-bold text-uppercase" style="letter-spacing: 1px;">Selesai Proses</span>
                </div>
            </div>
            <div class="col-md-3">
                <a href="{{ route('proyek.index') }}" class="metric-card card-custom p-4 text-center text-decoration-none d-block h-100" style="transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                    <div class="metric-icon text-primary bg-primary bg-opacity-10 mx-auto mb-3" style="width: 64px; height: 64px; font-size: 1.8rem; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                        <i class="bi bi-building"></i>
                    </div>
                    <h2 class="fw-bold mb-1" style="font-size: 2.5rem; color: var(--text-main);">{{ $proyekBerjalan }}</h2>
                    <span class="text-muted-custom small fw-bold text-uppercase" style="letter-spacing: 1px;">Proyek Berjalan</span>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('tiket.index') }}" class="metric-card card-custom p-4 text-center text-decoration-none d-block h-100" style="transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                    <div class="metric-icon text-danger bg-danger bg-opacity-10 mx-auto mb-3" style="width: 64px; height: 64px; font-size: 1.8rem; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                        <i class="bi bi-tools"></i>
                    </div>
                    <h2 class="fw-bold mb-1" style="font-size: 2.5rem; color: var(--text-main);">{{ $tiketOpen }}</h2>
                    <span class="text-muted-custom small fw-bold text-uppercase" style="letter-spacing: 1px;">Tiket Pemeliharaan</span>
                </a>
            </div>
        </div>

        <!-- Menunggu Verifikasi List -->
        <div class="row g-4 mb-5" id="verifikasi">
            <div class="col-12">
                <h5 class="fw-bold text-main mb-4"><i class="bi bi-list-task text-primary me-2"></i>Daftar BOQ Lapangan Menunggu Verifikasi</h5>
                @if($tugasVerifikasi->count() > 0)
                    <div class="row g-4">
                        @foreach($tugasVerifikasi as $boq)
                        <div class="col-md-6 col-lg-4">
                            <div class="card-custom h-100 d-flex flex-column border {{ $boq->status_approval == 'Pending' ? 'border-warning' : 'border-custom' }}" style="transition: transform 0.2s; box-shadow: var(--card-shadow);">
                                <div class="p-4 flex-grow-1">
                                    <div class="d-flex justify-content-between mb-3 align-items-center">
                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2 fw-semibold"><i class="bi bi-clock-history me-1"></i> {{ $boq->status_approval }}</span>
                                        <span class="text-muted small fw-medium">{{ $boq->created_at->diffForHumans() }}</span>
                                    </div>
                                    <h5 class="fw-bold text-main mb-2">{{ $boq->no_referensi }}</h5>
                                    <div class="text-muted-custom small mb-0 d-flex align-items-start gap-2">
                                        <i class="bi bi-geo-alt-fill text-danger mt-1"></i> 
                                        <span>{{ $boq->proyek->nama_proyek ?? '-' }}</span>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mt-auto p-4 pt-3 border-top border-custom" style="background-color: var(--bg-body); border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem;">
                                    <span class="small text-muted fw-bold d-flex align-items-center"><i class="bi bi-buildings text-primary me-2"></i> {{ $boq->proyek->klien->nama_perusahaan ?? '-' }}</span>
                                    <a href="{{ route('sitemanager.verify', $boq->id) }}" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm fw-bold">Review <i class="bi bi-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="card-custom border-0 bg-success bg-opacity-10 p-5 text-center shadow-sm" style="border-radius: 1.5rem;">
                        <div class="mx-auto bg-success text-white d-flex align-items-center justify-content-center mb-4 rounded-circle shadow" style="width: 80px; height: 80px;">
                            <i class="bi bi-check-lg fs-1"></i>
                        </div>
                        <h4 class="fw-bold text-success mb-2">Kerja Bagus! Semua Tugas Tuntas.</h4>
                        <p class="text-success opacity-75 mb-0" style="font-size: 1.1rem;">Saat ini tidak ada daftar Bill of Quantities yang menunggu untuk diverifikasi aktualisasinya.</p>
                    </div>
                @endif
            </div>
        </div>
    @endif

@endsection

@if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Direktur')
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const theme = document.documentElement.getAttribute('data-theme');
        const textColor = theme === 'dark' ? '#f1f5f9' : '#1e293b';
        const gridColor = theme === 'dark' ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.1)';

        // Chart 1: Status Proyek (Doughnut)
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Berjalan', 'Selesai'],
                datasets: [{
                    data: {!! json_encode($chartStatus ?? [0,0]) !!},
                    backgroundColor: ['#3b82f6', '#22c55e'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: textColor, font: { family: "'Inter', sans-serif" } }
                    }
                },
                cutout: '70%'
            }
        });

        // Chart 2: Finansial (Bar)
        const ctxFinansial = document.getElementById('finansialChart').getContext('2d');
        const labels = {!! json_encode($chartKeuangan['labels'] ?? []) !!};
        const dataKontrak = {!! json_encode($chartKeuangan['kontrak'] ?? []) !!};
        const dataAktual = {!! json_encode($chartKeuangan['aktual'] ?? []) !!};

        new Chart(ctxFinansial, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Total Kontrak (Rp)',
                        data: dataKontrak,
                        backgroundColor: 'rgba(59, 130, 246, 0.8)',
                        borderRadius: 4
                    },
                    {
                        label: 'Total Aktual (Rp)',
                        data: dataAktual,
                        backgroundColor: 'rgba(249, 115, 22, 0.8)',
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: textColor,
                            callback: function(value) {
                                if (value === 0) return 0;
                                // Format to Millions/Billions for cleaner y-axis
                                if(value >= 1000000000) return (value / 1000000000).toFixed(1) + 'Miliar';
                                if(value >= 1000000) return (value / 1000000).toFixed(0) + 'Jt';
                                return value;
                            }
                        },
                        grid: { color: gridColor }
                    },
                    x: {
                        ticks: { color: textColor },
                        grid: { display: false }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { color: textColor, font: { family: "'Inter', sans-serif" } }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) label += ': ';
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
@endif
