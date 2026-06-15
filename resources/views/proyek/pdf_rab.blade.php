<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan RAB - {{ $proyek->nama_proyek }}</title>
    <style>
        @page { margin: 2.5cm 1.5cm 2cm 1.5cm; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 9pt;
            color: #1a1a2e;
            line-height: 1.4;
        }

        /* KOP SURAT */
        .kop-surat {
            border-bottom: 3px double #1a1a2e;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }
        .kop-table { width: 100%; }
        .kop-logo { width: 80px; vertical-align: middle; }
        .kop-logo img { max-width: 70px; max-height: 70px; }
        .kop-text { vertical-align: middle; padding-left: 12px; }
        .kop-nama { font-size: 16pt; font-weight: bold; color: #1a1a2e; letter-spacing: 1px; }
        .kop-alamat { font-size: 8.5pt; color: #555; margin-top: 3px; }

        /* JUDUL DOKUMEN */
        .doc-title {
            text-align: center;
            margin: 5px 0;
            padding: 5px 0;
        }
        .doc-title h2 {
            font-size: 14pt;
            text-decoration: underline;
            letter-spacing: 2px;
            margin-bottom: 4px;
        }
        .doc-title .nomor {
            font-size: 9pt;
            color: #555;
        }

        /* INFO BOX */
        .info-section {
            margin-bottom: 16px;
        }
        .info-table {
            width: 100%;
            font-size: 9.5pt;
        }
        .info-table td {
            padding: 3px 0;
            vertical-align: top;
        }
        .info-label {
            width: 200px;
            font-weight: bold;
            color: #333;
        }
        .info-colon { width: 15px; text-align: center; }

        /* PARAGRAF */
        .paragraph {
            text-align: justify;
            margin-bottom: 14px;
            font-size: 9.5pt;
            text-indent: 2em;
        }

        /* TABEL BOQ */
        .boq-table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0;
            font-size: 7.5pt;
        }
        .boq-table th {
            background-color: #1a1a2e;
            color: #fff;
            padding: 7px 6px;
            text-align: center;
            font-weight: 600;
            font-size: 8pt;
            text-transform: uppercase;
        }
        .boq-table td {
            padding: 5px 6px;
            border: 1px solid #ccc;
        }
        .boq-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .boq-table .text-right { text-align: right; }
        .boq-table .text-center { text-align: center; }
        .boq-table .fw-bold { font-weight: bold; }

        /* SUMMARY BOX */
        .summary-box {
            width: 60%;
            margin-left: auto;
            border: 1px solid #1a1a2e;
            border-radius: 4px;
            margin-top: 5px;
            margin-bottom: 5px;
        }
        .summary-box table { width: 100%; border-collapse: collapse; font-size: 9pt; }
        .summary-box td { padding: 5px 10px; border-bottom: 1px solid #e0e0e0; }
        .summary-box tr:last-child td { border-bottom: none; }
        .summary-box .label { font-weight: bold; width: 65%; }
        .summary-box .value { text-align: right; font-family: 'DejaVu Sans Mono', monospace; }
        .summary-box .highlight { background-color: #1a1a2e; color: #fff; font-weight: bold; }
        .summary-box .deviasi-positif { color: #dc3545; }
        .summary-box .deviasi-negatif { color: #198754; }

        /* TTD */
        .ttd-section { margin-top: 15px; }
        .ttd-table { width: 100%; }
        .ttd-table td {
            width: 33.33%;
            text-align: center;
            vertical-align: top;
            padding: 0 10px;
        }
        .ttd-role { font-weight: bold; font-size: 9.5pt; margin-bottom: 4px; }
        .ttd-line { margin-top: 50px; border-bottom: 1px solid #333; width: 80%; margin-left: auto; margin-right: auto; }
        .ttd-name { font-size: 9pt; margin-top: 4px; font-weight: bold; text-decoration: underline; }
        .ttd-jabatan { font-size: 8pt; color: #555; }

        /* FOOTER & DIGITAL STAMP */
        footer {
            position: fixed; 
            bottom: -30px; 
            left: 0px; 
            right: 0px;
            height: 30px; 
            border-top: 1px solid #ccc;
            font-size: 7.5pt;
            color: #999;
            text-align: center;
            padding-top: 5px;
        }
        .digital-stamp {
            position: fixed;
            top: -80px;
            right: 0px;
            text-align: right;
            width: 100px;
        }
        .digital-stamp img {
            width: 50px;
            height: 50px;
            margin-bottom: 2px;
        }
        .digital-stamp-desc {
            font-size: 6pt;
            color: #555;
            font-family: 'DejaVu Sans Mono', monospace;
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
            {{ substr(md5($latestBoq->id . $tanggalCetak), 0, 8) }}<br>
            @if($latestBoq->is_client_approved)
            <span style="color: green; font-weight: bold;">(E-Signed)</span>
            @endif
        </div>
    </div>

    <footer>
        Dokumen ini dicetak secara otomatis oleh SIM BOQ Enterprise pada {{ $tanggalCetak }}.
        {{ $namaPerusahaan }} &mdash; {{ $alamatPerusahaan }}
    </footer>

    {{-- KOP SURAT --}}
    <div class="kop-surat">
        <table class="kop-table">
            <tr>
                @if($logoPath)
                <td class="kop-logo">
                    <img src="{{ public_path('storage/' . $logoPath) }}" alt="Logo">
                </td>
                @endif
                <td class="kop-text">
                    <div class="kop-nama">{{ strtoupper($namaPerusahaan) }}</div>
                    <div class="kop-alamat">
                        {{ $alamatPerusahaan }}<br>
                        Telp: {{ $teleponPerusahaan }} | Email: {{ $emailPerusahaan }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    {{-- JUDUL DOKUMEN --}}
    <div class="doc-title">
        <h2>LAPORAN BILL OF QUANTITIES (RAB)</h2>
        <div class="nomor">No: {{ $latestBoq->nomor_surat }}</div>
    </div>

    {{-- INFO PROYEK --}}
    <div class="info-section">
        <table class="info-table">
            <tr>
                <td class="info-label">Nama Proyek</td>
                <td class="info-colon">:</td>
                <td>{{ $proyek->nama_proyek }}</td>
            </tr>
            <tr>
                <td class="info-label">Klien / Pemilik</td>
                <td class="info-colon">:</td>
                <td>{{ $proyek->klien->nama_perusahaan }}</td>
            </tr>
            <tr>
                <td class="info-label">PIC (Penanggung Jawab)</td>
                <td class="info-colon">:</td>
                <td>{{ $proyek->klien->pic ?? $proyek->klien->kontak_person ?? '-' }}</td>
            </tr>
            <tr>
                <td class="info-label">Tanggal Cetak</td>
                <td class="info-colon">:</td>
                <td>{{ $tanggalCetak }}</td>
            </tr>
            <tr>
                <td class="info-label">Versi Dokumen BOQ</td>
                <td class="info-colon">:</td>
                <td>{{ $latestBoq->versi_revisi }} ({{ $latestBoq->status_approval }})</td>
            </tr>
        </table>
    </div>



    <div style="page-break-inside: avoid;">
        {{-- RANGKUMAN FINANSIAL --}}
        <div class="summary-box">
        <table>
            <tr>
                <td class="label">Total Nilai Kontrak (RAB)</td>
                <td class="value">Rp {{ number_format($totalKontrak, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Total Realisasi Aktual</td>
                <td class="value">Rp {{ number_format($totalAktual, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">PPN ({{ $pajak }}%)</td>
                <td class="value">Rp {{ number_format($ppnAktual, 0, ',', '.') }}</td>
            </tr>
            <tr class="highlight">
                <td class="label" style="color: #fff;">Grand Total Keseluruhan (Incl. PPN)</td>
                <td class="value" style="color: #fff;">Rp {{ number_format($grandAktual, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Deviasi (Selisih)</td>
                <td class="value {{ $deviasi > 0 ? 'deviasi-positif' : 'deviasi-negatif' }}">
                    {{ $deviasi > 0 ? '+' : '' }}Rp {{ number_format($deviasi, 0, ',', '.') }}
                </td>
            </tr>
        </table>
    </div>

    {{-- TANDA TANGAN (DIBUAT & DIKETAHUI) --}}
    <div class="ttd-section" style="margin-top: 20px;">
        <table style="width: 100%; border: none; margin-top: 50px;">
            <tr>
                <td style="width: 33%; text-align: center; border: none; padding: 0;">
                    <p style="margin-bottom: 70px;">Dibuat Oleh,</p>
                    <p><strong>{{ $proyek->siteManager->nama_lengkap ?? 'Site Manager' }}</strong><br>Site Manager</p>
                </td>
                <td style="width: 33%; text-align: center; border: none; padding: 0;">
                    <p style="margin-bottom: 70px;">Diketahui Oleh,</p>
                    <p><strong>Admin / Direktur</strong><br>{{ $namaPerusahaan }}</p>
                </td>
                <td style="width: 33%; text-align: center; border: none; padding: 0;">
                    <p style="margin-bottom: 70px;">Disetujui Oleh,</p>
                    @if($latestBoq->is_client_approved)
                    <p style="color: green; font-weight: bold; margin-bottom: 5px;">[ TELAH DISETUJUI DIGITAL ]<br><span style="font-size: 8pt; font-weight: normal; color: #555;">{{ \Carbon\Carbon::parse($latestBoq->client_approved_at)->format('d/m/Y H:i') }}</span></p>
                    @endif
                    <p><strong>{{ $proyek->klien->pic ?? $proyek->klien->nama_perusahaan }}</strong><br>Pihak Klien</p>
                </td>
            </tr>
        </table>
    </div>

    </div>

    {{-- ================================================= --}}
    {{-- PAGE BREAK UNTUK LAMPIRAN BOQ --}}
    {{-- ================================================= --}}
    <div style="page-break-before: always;"></div>

    <div class="doc-title" style="margin-top: 0;">
        <h2 style="font-size: 12pt;">LAMPIRAN: DETAIL BILL OF QUANTITIES (RAB)</h2>
        <div class="nomor">Proyek: {{ $proyek->nama_proyek }} | Versi: {{ $latestBoq->versi_revisi }}</div>
    </div>

    {{-- TABEL BOQ --}}
    <table class="boq-table">
        <thead>
            <tr>
                <th style="width:5%">No</th>
                <th style="width:10%">Kode</th>
                <th style="width:22%">Uraian Pekerjaan</th>
                <th style="width:7%">Sat.</th>
                <th style="width:12%">Harga Satuan</th>
                <th style="width:8%">Vol. Kontrak</th>
                <th style="width:8%">Vol. Aktual</th>
                <th style="width:14%">Subtotal Kontrak</th>
                <th style="width:14%">Subtotal Aktual</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $i => $item)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center" style="font-family: 'DejaVu Sans Mono', monospace; font-size: 7.5pt;">{{ $item['kode'] }}</td>
                <td>{{ $item['nama'] }}</td>
                <td class="text-center">{{ $item['satuan'] }}</td>
                <td class="text-right">{{ number_format($item['harga_satuan'], 0, ',', '.') }}</td>
                <td class="text-center">{{ rtrim(rtrim(number_format($item['qty_kontrak'], 2, ',', '.'), '0'), ',') }}</td>
                <td class="text-center">{{ rtrim(rtrim(number_format($item['qty_aktual'], 2, ',', '.'), '0'), ',') }}</td>
                <td class="text-right">{{ number_format($item['subtotal_kontrak'], 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($item['subtotal_aktual'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
