<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProyekController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/download-template', function () {
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $headers = ['NO', 'KODE BARANG', 'NAMA BARANG (Abaikan)', 'SATUAN', 'HARGA MAT', 'HARGA JASA', 'QTY KONTRAK', 'LOKASI LANTAI', 'LOKASI ZONA'];
    $col = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($col . '1', $header);
        $col++;
    }

    $sheet->setCellValue('A2', 1);
    $sheet->setCellValue('B2', 'BRG-01');
    $sheet->setCellValue('C2', 'Kabel UTP'); 
    $sheet->setCellValue('D2', 'Roll');
    $sheet->setCellValue('E2', 1000);
    $sheet->setCellValue('F2', 0);
    $sheet->setCellValue('G2', 15);
    $sheet->setCellValue('H2', 'Lantai 1');
    $sheet->setCellValue('I2', 'Ruang Server');

    $sheet->setCellValue('A3', 2);
    $sheet->setCellValue('B3', 'JSA-01');
    $sheet->setCellValue('C3', 'Jasa Instalasi'); 
    $sheet->setCellValue('D3', 'Titik');
    $sheet->setCellValue('E3', 0);
    $sheet->setCellValue('F3', 50000);
    $sheet->setCellValue('G3', 10);
    $sheet->setCellValue('H3', 'Lantai 2');
    $sheet->setCellValue('I3', 'Ruang Meeting');

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Template_BOQ_SIMBOQ.xlsx"');
    $writer->save('php://output');
    exit;
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/export-global', [DashboardController::class, 'exportGlobal'])->name('dashboard.export-global');
    Route::get('/dashboard/export-eksekutif-pdf', [DashboardController::class, 'exportEksekutifPdf'])->name('dashboard.export-eksekutif');
    
    // Settings (Admin & Direktur)
    Route::middleware(['role:Admin,Direktur'])->group(function () {
        Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
        Route::put('/settings', [App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');
        Route::get('/settings/backup', [App\Http\Controllers\SettingController::class, 'backupDatabase'])->name('settings.backup');
    });

    // BAST PDF (All authenticated users can print for their accessible projects)
    Route::get('/proyek/{id}/bast', [App\Http\Controllers\BastController::class, 'cetak'])->name('proyek.bast');

    // Admin Only Routes
    Route::middleware(['role:Admin'])->group(function () {
        // Recycle Bin Routes
        Route::post('/klien/{id}/restore', [\App\Http\Controllers\KlienController::class, 'restore'])->name('klien.restore');
        Route::delete('/klien/{id}/force-delete', [\App\Http\Controllers\KlienController::class, 'forceDelete'])->name('klien.force-delete');
        Route::post('/barangjasa/{id}/restore', [\App\Http\Controllers\MasterBarangJasaController::class, 'restore'])->name('barangjasa.restore');
        Route::delete('/barangjasa/{id}/force-delete', [\App\Http\Controllers\MasterBarangJasaController::class, 'forceDelete'])->name('barangjasa.force-delete');

        Route::resource('users', \App\Http\Controllers\UserController::class);
        Route::resource('klien', \App\Http\Controllers\KlienController::class);
        Route::post('/barangjasa/import', [\App\Http\Controllers\MasterBarangJasaController::class, 'importExcel'])->name('barangjasa.import');
        Route::resource('barangjasa', \App\Http\Controllers\MasterBarangJasaController::class);
        
        Route::post('/boq/{id}/submit-to-sm', [ProyekController::class, 'submitToSiteManager'])->name('boq.submit');
        Route::delete('/boq/{id}/delete', [ProyekController::class, 'deleteBoq'])->name('boq.delete');
        Route::post('/boq-detail', [ProyekController::class, 'storeBoqDetail'])->name('boq.detail.store');
        Route::put('/boq-detail/{id}', [ProyekController::class, 'updateBoqDetail'])->name('boq.detail.update');
        Route::post('/proyek/{id}/complete', [ProyekController::class, 'markAsCompleted'])->name('proyek.complete');

        // Laporan Harian & Kendala Lapangan
        Route::patch('/kendala-lapangan/{id}/resolve', [App\Http\Controllers\KendalaLapanganController::class, 'resolve'])->name('kendala.resolve');
        Route::post('/proyek/{id}/upload-boq', [ProyekController::class, 'uploadBoq'])->name('proyek.upload-boq');
    });

    // Klien Only Routes
    Route::middleware(['role:Klien'])->group(function () {
        Route::post('/boq/{id}/client-approve', [ProyekController::class, 'approveByClient'])->name('boq.client-approve');
        Route::post('/proyek/{id}/cco', [ProyekController::class, 'submitCCO'])->name('cco.store');
        Route::post('/proyek/{id}/tiket', [ProyekController::class, 'submitTiket'])->name('tiket.store');
    });

    // Proyek (General Access depending on internal logic)
    Route::resource('proyek', ProyekController::class)->except(['destroy', 'edit', 'update']);
    Route::get('/boq/{id}/export-pdf', [ProyekController::class, 'exportPdf'])->name('boq.export-pdf');
    
    // Site Manager Actions
    Route::middleware(['role:Site Manager'])->group(function () {
        Route::get('/sitemanager/verify/{id}', [\App\Http\Controllers\SiteManagerController::class, 'verify'])->name('sitemanager.verify');
        Route::post('/sitemanager/verify/{id}/submit', [\App\Http\Controllers\SiteManagerController::class, 'submitVerification'])->name('sitemanager.submit');
        
        // SM Laporan Harian & Kendala
        Route::post('/laporan-harian', [App\Http\Controllers\LaporanHarianController::class, 'store'])->name('laporan.store');
        Route::post('/kendala-lapangan', [App\Http\Controllers\KendalaLapanganController::class, 'store'])->name('kendala.store');
    });

    // Admin & Direktur Routes
    Route::middleware(['role:Admin,Direktur'])->group(function () {
        Route::get('/cco', [App\Http\Controllers\ChangeRequestController::class, 'index'])->name('cco.index');
        Route::post('/cco/{id}/process', [App\Http\Controllers\ChangeRequestController::class, 'process'])->name('cco.process');
        
        Route::get('/audit-log', [App\Http\Controllers\AuditLogController::class, 'index'])->name('audit.index');
    });

    // Admin, Direktur, & Site Manager Routes for Tickets
    Route::middleware(['role:Admin,Direktur,Site Manager'])->group(function () {
        Route::get('/tiket', [App\Http\Controllers\TiketPemeliharaanController::class, 'index'])->name('tiket.index');
        Route::post('/tiket/{id}/progress', [App\Http\Controllers\TiketPemeliharaanController::class, 'progress'])->name('tiket.progress');
        Route::post('/tiket/{id}/resolve', [App\Http\Controllers\TiketPemeliharaanController::class, 'resolve'])->name('tiket.resolve');
    });

    // Notifications API & Actions
    Route::get('/notifications/unread', [App\Http\Controllers\NotificationController::class, 'getUnread'])->name('notifications.unread');
    Route::get('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
    Route::post('/notifications/read-all', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
});
