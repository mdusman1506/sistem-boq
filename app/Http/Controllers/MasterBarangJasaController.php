<?php

namespace App\Http\Controllers;

use App\Models\MasterBarangJasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterBarangJasaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('trashed')) {
            $barangJasa = MasterBarangJasa::onlyTrashed()->get();
        } else {
            $barangJasa = MasterBarangJasa::all();
        }
        
        return view('barangjasa.index', compact('barangJasa'));
    }

    public function create()
    {
        return view('barangjasa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string|max:50|unique:tb_master_barang_jasa',
            'nama_barang' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'tipe' => 'required|in:Material,Jasa',
            'harga_material' => 'nullable|numeric|min:0',
            'harga_jasa' => 'nullable|numeric|min:0',
        ]);

        $data = $request->all();
        $data['harga_material'] = $request->harga_material ?? 0;
        $data['harga_jasa'] = $request->harga_jasa ?? 0;

        $item = MasterBarangJasa::create($data);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true, 
                'message' => 'Data berhasil ditambahkan.',
                'data' => $item
            ]);
        }
        return redirect()->route('barangjasa.index')->with('success', 'Data Barang/Jasa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $barangJasa = MasterBarangJasa::findOrFail($id);
        return view('barangjasa.edit', compact('barangJasa'));
    }

    public function update(Request $request, $id)
    {
        $barangJasa = MasterBarangJasa::findOrFail($id);
        
        $request->validate([
            'kode_barang' => 'required|string|max:50|unique:tb_master_barang_jasa,kode_barang,' . $id,
            'nama_barang' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'tipe' => 'required|in:Material,Jasa',
            'harga_material' => 'nullable|numeric|min:0',
            'harga_jasa' => 'nullable|numeric|min:0',
        ]);

        $data = $request->all();
        $data['harga_material'] = $request->harga_material ?? 0;
        $data['harga_jasa'] = $request->harga_jasa ?? 0;

        $barangJasa->update($data);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true, 
                'message' => 'Data berhasil diperbarui.',
                'data' => $barangJasa
            ]);
        }
        return redirect()->route('barangjasa.index')->with('success', 'Data Barang/Jasa berhasil diperbarui.');
    }

    public function destroy(Request $request, $id)
    {
        $barangJasa = MasterBarangJasa::findOrFail($id);
        
        // Cek apakah barang sedang dipakai di BoqDetail
        if ($barangJasa->boqDetails()->count() > 0) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Gagal dihapus! Item ini sudah digunakan di dalam BOQ Proyek.']);
            }
            return back()->with('error', 'Gagal dihapus! Item ini sudah digunakan di dalam BOQ Proyek.');
        }

        $barangJasa->delete();
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus sementara.']);
        }
        return redirect()->route('barangjasa.index')->with('success', 'Data Barang/Jasa berhasil dihapus sementara (Soft Delete).');
    }

    public function restore(Request $request, $id)
    {
        $barangJasa = MasterBarangJasa::onlyTrashed()->findOrFail($id);
        $barangJasa->restore();
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Data berhasil dipulihkan.']);
        }
        return back()->with('success', 'Data Barang/Jasa berhasil dipulihkan.');
    }

    public function forceDelete(Request $request, $id)
    {
        $barangJasa = MasterBarangJasa::onlyTrashed()->findOrFail($id);
        $barangJasa->forceDelete();
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus permanen.']);
        }
        return back()->with('success', 'Data Barang/Jasa berhasil dihapus permanen.');
    }

    public function importExcel(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'file_excel' => 'required|file|mimes:xlsx,xls|max:5120',
        ]);

        $file = $request->file('file_excel');
        
        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getRealPath());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            $importedCount = 0;
            $updatedCount = 0;

            foreach ($rows as $index => $row) {
                if ($index === 0) continue; // Abaikan header

                $kode_barang = isset($row[0]) ? trim($row[0]) : '';
                $nama_barang = isset($row[1]) ? trim($row[1]) : '';
                $tipe = isset($row[2]) ? trim($row[2]) : 'Material';
                $satuan = isset($row[3]) ? trim($row[3]) : 'Ls';
                $harga_material = isset($row[4]) ? (float) $row[4] : 0;
                $harga_jasa = isset($row[5]) ? (float) $row[5] : 0;

                if (empty($kode_barang) || empty($nama_barang)) continue;

                $existing = MasterBarangJasa::where('kode_barang', $kode_barang)->first();
                if ($existing) {
                    $existing->update([
                        'nama_barang' => $nama_barang,
                        'tipe' => $tipe,
                        'satuan' => $satuan,
                        'harga_material' => $harga_material,
                        'harga_jasa' => $harga_jasa
                    ]);
                    $updatedCount++;
                } else {
                    MasterBarangJasa::create([
                        'kode_barang' => $kode_barang,
                        'nama_barang' => $nama_barang,
                        'tipe' => $tipe,
                        'satuan' => $satuan,
                        'harga_material' => $harga_material,
                        'harga_jasa' => $harga_jasa
                    ]);
                    $importedCount++;
                }
            }

            return back()->with('success', "Import berhasil! $importedCount data baru ditambahkan, $updatedCount data diupdate.");

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem saat memproses file: ' . $e->getMessage());
        }
    }
}
