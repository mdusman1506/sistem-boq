<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Eksekutif Kinerja Proyek</title>
    <style>
        @page {
            margin: 40px 40px;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .digital-stamp {
            position: absolute;
            top: 15px;
            right: 15px;
            text-align: center;
            width: 80px;
        }
        .digital-stamp img {
            width: 50px;
            height: 50px;
            margin-bottom: 2px;
        }
        .digital-stamp-desc {
            font-size: 6pt;
            color: #555;
            font-family: 'Courier New', Courier, monospace;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #0056b3;
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #666;
        }
        .section-title {
            background-color: #0056b3;
            color: white;
            padding: 8px 15px;
            font-size: 16px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .summary-box {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }
        .summary-box td {
            width: 33.33%;
            text-align: center;
            padding: 15px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
        }
        .summary-title {
            font-size: 12px;
            text-transform: uppercase;
            color: #666;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .summary-value {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
        .summary-value.profit {
            color: #28a745;
        }
        .summary-value.loss {
            color: #dc3545;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }
        table.data-table th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }
        table.data-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .page-number:before {
            content: counter(page);
        }
        .status-badge {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
        }
        .status-berjalan {
            background-color: #e0f2fe;
            color: #0284c7;
        }
        .status-selesai {
            background-color: #dcfce7;
            color: #16a34a;
        }
    </style>
</head>
<body>

    <div class="digital-stamp">
        @if(isset($qrBase64) && $qrBase64)
            <img src="{{ $qrBase64 }}" alt="QR Code">
        @endif
        <div class="digital-stamp-desc">
            SIM BOQ v1.0<br>
            {{ isset($latestBoq) ? substr(md5($latestBoq->id . $tanggalCetak), 0, 8) : '00000000' }}<br>
            @if(isset($latestBoq) && $latestBoq->is_client_approved)
            <span style="color: green; font-weight: bold;">(E-Signed)</span>
            @endif
        </div>
    </div>

    <div class="footer">
        Dicetak oleh: {{ Auth::user()->nama_lengkap }} ({{ Auth::user()->role }}) | Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }} | Halaman <span class="page-number"></span>
    </div>

    <div class="header">
        <h1>Laporan Eksekutif Kinerja Proyek</h1>
        <p>SIM BOQ Enterprise | Rekapitulasi Finansial & Operasional Global</p>
    </div>

    <div class="section-title">RINGKASAN EKSEKUTIF (EXECUTIVE SUMMARY)</div>

    <table class="summary-box">
        <tr>
            <td>
                <div class="summary-title">Total Potensi Pendapatan (RAB)</div>
                <div class="summary-value">Rp {{ number_format($totKontrakGlobal, 0, ',', '.') }}</div>
            </td>
            <td>
                <div class="summary-title">Total Realisasi Pengeluaran</div>
                <div class="summary-value">Rp {{ number_format($totAktualGlobal, 0, ',', '.') }}</div>
            </td>
            <td>
                <div class="summary-title">Total Deviasi (Margin/Laba)</div>
                <div class="summary-value {{ $deviasiGlobal < 0 ? 'profit' : 'loss' }}">
                    Rp {{ number_format(abs($deviasiGlobal), 0, ',', '.') }}
                    @if($deviasiGlobal < 0)
                        <span style="font-size: 12px;">(Surplus)</span>
                    @elseif($deviasiGlobal > 0)
                        <span style="font-size: 12px;">(Defisit)</span>
                    @endif
                </div>
            </td>
        </tr>
    </table>

    <p style="font-size: 13px; text-align: justify; margin-bottom: 30px;">
        Dokumen ini menyajikan ringkasan kinerja dari <strong>{{ $proyeks->count() }}</strong> proyek yang terdaftar di dalam sistem hingga saat ini. Total nilai kontrak dari seluruh proyek tersebut mencapai <strong>Rp {{ number_format($totKontrakGlobal, 0, ',', '.') }}</strong> dengan total realisasi aktual tercatat sebesar <strong>Rp {{ number_format($totAktualGlobal, 0, ',', '.') }}</strong>. Perusahaan mencatatkan tingkat deviasi anggaran sebesar <strong>Rp {{ number_format($deviasiGlobal, 0, ',', '.') }}</strong> secara keseluruhan.
    </p>

    <div class="section-title">RINCIAN PORTOFOLIO PROYEK</div>

    <table class="data-table">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="25%">Nama Proyek</th>
                <th width="20%">Klien</th>
                <th width="15%" class="text-right">Nilai RAB (Rp)</th>
                <th width="15%" class="text-right">Realisasi (Rp)</th>
                <th width="10%" class="text-center">Status</th>
                <th width="10%" class="text-right">Deviasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proyeks as $index => $p)
                @php
                    $latestBoq = $p->boqHeaders->first();
                    $totK = 0;
                    $totA = 0;
                    if ($latestBoq) {
                        foreach ($latestBoq->boqDetails as $detail) {
                            $h = $detail->harga_material_satuan + $detail->harga_jasa_satuan;
                            $totK += $h * $detail->qty_kontrak;
                            $totA += $h * ($detail->qty_aktual ?? 0);
                        }
                    }
                    $dev = $totA - $totK;
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td><strong>{{ $p->nama_proyek }}</strong></td>
                    <td>{{ $p->klien->nama_perusahaan }}</td>
                    <td class="text-right">{{ number_format($totK, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($totA, 0, ',', '.') }}</td>
                    <td class="text-center">
                        <span class="status-badge {{ $p->status_proyek == 'Berjalan' ? 'status-berjalan' : 'status-selesai' }}">
                            {{ strtoupper($p->status_proyek) }}
                        </span>
                    </td>
                    <td class="text-right" style="color: {{ $dev < 0 ? '#16a34a' : ($dev > 0 ? '#dc2626' : '#333') }}; font-weight: bold;">
                        {{ number_format($dev, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
            @if($proyeks->count() === 0)
                <tr>
                    <td colspan="7" class="text-center">Belum ada data proyek.</td>
                </tr>
            @endif
        </tbody>
    </table>

</body>
</html>
