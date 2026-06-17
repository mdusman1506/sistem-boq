<?php

namespace App\Http\Controllers;

use App\Models\MasterBarangJasa;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MasterBarangJasaController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan data aktif dan data di recycle bin (soft deleted)
        $items = MasterBarangJasa::withTrashed()->latest()->get();
        return view('barangjasa.index', compact('items'));
    }

    public function create()
    {
        return view('barangjasa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:tb_master_barang_jasa,kode_barang',
            'nama_barang' => 'required',
            'satuan' => 'required',
            'tipe' => 'required|in:Material,Jasa',
            'harga_material' => 'required|numeric|min:0',
            'harga_jasa' => 'required|numeric|min:0',
        ]);

        $barang = MasterBarangJasa::create($request->all());

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Tambah Data',
            'description' => 'Menambahkan data barang/jasa: ' . $barang->nama_barang
        ]);

        return redirect()->route('barangjasa.index')->with('success', 'Data Barang & Jasa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $barang = MasterBarangJasa::findOrFail($id);
        return view('barangjasa.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => 'required|unique:tb_master_barang_jasa,kode_barang,'.$id,
            'nama_barang' => 'required',
            'satuan' => 'required',
            'tipe' => 'required|in:Material,Jasa',
            'harga_material' => 'required|numeric|min:0',
            'harga_jasa' => 'required|numeric|min:0',
        ]);

        $barang = MasterBarangJasa::findOrFail($id);
        $barang->update($request->all());

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Update Data',
            'description' => 'Mengubah data barang/jasa: ' . $barang->nama_barang
        ]);

        return redirect()->route('barangjasa.index')->with('success', 'Data Barang & Jasa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = MasterBarangJasa::findOrFail($id);
        $nama = $barang->nama_barang;
        $barang->delete(); // Masuk Recycle Bin (Soft Delete)

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Hapus Data',
            'description' => 'Memasukkan barang/jasa ke Recycle Bin: ' . $nama
        ]);

        return back()->with('success', 'Data dipindahkan ke Recycle Bin.');
    }

    public function restore($id)
    {
        $barang = MasterBarangJasa::withTrashed()->findOrFail($id);
        $barang->restore();

        return back()->with('success', 'Data berhasil dikembalikan dari Recycle Bin.');
    }

    public function forceDelete($id)
    {
        $barang = MasterBarangJasa::withTrashed()->findOrFail($id);
        $barang->forceDelete();

        return back()->with('success', 'Data dihapus secara permanen dari sistem.');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file_excel');
        
        try {
            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();
            
            $imported = 0;
            
            // Asumsi baris 1 adalah header, mulai baca dari baris 2
            foreach ($rows as $index => $row) {
                if ($index === 0) continue; 
                
                // Urutan kolom: Kode | Nama | Satuan | Tipe | Harga Mat | Harga Jasa
                if (empty($row[0]) || empty($row[1])) continue;
                
                MasterBarangJasa::updateOrCreate(
                    ['kode_barang' => $row[0]],
                    [
                        'nama_barang' => $row[1],
                        'satuan' => $row[2] ?? 'Pcs',
                        'tipe' => $row[3] ?? 'Material',
                        'harga_material' => isset($row[4]) ? (int)$row[4] : 0,
                        'harga_jasa' => isset($row[5]) ? (int)$row[5] : 0,
                    ]
                );
                $imported++;
            }
            
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Import Excel',
                'description' => 'Berhasil mengimport ' . $imported . ' data Barang & Jasa'
            ]);

            return back()->with('success', "Import berhasil! {$imported} data ditambahkan/diperbarui.");
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengimport file: ' . $e->getMessage());
        }
    }
}
