@echo off
echo ====================================================
echo   SISTEM AUTO-UPDATE GITHUB SIM BOQ
echo ====================================================
echo.
echo Mengupdate file yang berubah ke GitHub...
"C:\Users\usman\AppData\Local\GitHubDesktop\app-3.5.8\resources\app\git\cmd\git.exe" add .
"C:\Users\usman\AppData\Local\GitHubDesktop\app-3.5.8\resources\app\git\cmd\git.exe" commit -m "Fix: update controller, perbaikan bug CCO, bersihkan laporan"
"C:\Users\usman\AppData\Local\GitHubDesktop\app-3.5.8\resources\app\git\cmd\git.exe" push origin main
echo.
echo ====================================================
echo PROSES SELESAI! Silakan cek tulisan di atas.
echo Jika berhasil, kode Anda sudah masuk ke GitHub.
echo ====================================================
pause
