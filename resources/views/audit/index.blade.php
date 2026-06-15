@extends('layouts.app')

@section('title', 'Jejak Audit Sistem')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-main mb-1">Jejak Audit Sistem (History Log)</h4>
            <p class="text-muted-custom mb-0">Pantau seluruh aktivitas pengguna dan perubahan data di dalam sistem secara real-time.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">Kembali</a>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="card-custom p-4 mb-4">
        <form action="{{ route('audit.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="form-label small text-muted fw-bold">Filter berdasarkan Role</label>
                <select name="role" class="form-select border-custom rounded-3">
                    <option value="">Semua Role</option>
                    <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Site Manager" {{ request('role') == 'Site Manager' ? 'selected' : '' }}>Site Manager</option>
                    <option value="Klien" {{ request('role') == 'Klien' ? 'selected' : '' }}>Klien</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label small text-muted fw-bold">Pencarian Aksi</label>
                <input type="text" name="action_type" class="form-control border-custom rounded-3" placeholder="Contoh: Login, BOQ, CCO..." value="{{ request('action_type') }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary rounded-pill w-100"><i class="bi bi-filter"></i> Terapkan Filter</button>
            </div>
        </form>
    </div>

    <!-- Data Log -->
    <div class="card-custom p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 text-muted-custom small fw-bold">WAKTU AKTIVITAS</th>
                        <th class="px-4 py-3 text-muted-custom small fw-bold">PENGGUNA</th>
                        <th class="px-4 py-3 text-muted-custom small fw-bold">TIPE AKSI</th>
                        <th class="px-4 py-3 text-muted-custom small fw-bold">DESKRIPSI DETAIL</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr class="border-bottom border-custom">
                        <td class="px-4 py-3">
                            <div class="fw-bold text-main">{{ $log->created_at->format('d M Y') }}</div>
                            <div class="text-muted-custom small"><i class="bi bi-clock me-1"></i>{{ $log->created_at->format('H:i:s') }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm rounded-circle text-white d-flex align-items-center justify-content-center bg-primary bg-gradient me-3 fw-bold" style="width: 35px; height: 35px;">
                                    {{ substr($log->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-main">{{ $log->user->name }}</div>
                                    <span class="badge bg-light text-dark border border-custom mt-1" style="font-size: 0.7rem;">{{ $log->user->role }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $badgeColor = 'bg-secondary';
                                if (str_contains(strtolower($log->action), 'login')) $badgeColor = 'bg-info';
                                if (str_contains(strtolower($log->action), 'approve') || str_contains(strtolower($log->action), 'verifikasi')) $badgeColor = 'bg-success';
                                if (str_contains(strtolower($log->action), 'cco') || str_contains(strtolower($log->action), 'tambah')) $badgeColor = 'bg-warning text-dark';
                                if (str_contains(strtolower($log->action), 'tiket') || str_contains(strtolower($log->action), 'komplain')) $badgeColor = 'bg-danger';
                                if (str_contains(strtolower($log->action), 'bast')) $badgeColor = 'bg-primary';
                            @endphp
                            <span class="badge {{ $badgeColor }} rounded-pill px-3 py-2"><i class="bi bi-activity me-1"></i>{{ $log->action }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-muted-custom small text-wrap" style="max-width: 400px; line-height: 1.5;">{{ $log->description }}</div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="text-muted-custom">
                                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                Belum ada aktivitas yang terekam.
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-top border-custom d-flex justify-content-end">
            {{ $logs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
