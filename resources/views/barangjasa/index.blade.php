@extends('layouts.app')

@section('title', 'Master Barang & Jasa - SIM BOQ Enterprise')

@push('styles')
<style>
    .table-container {
        background: var(--bg-card);
        border-radius: 1.25rem;
        padding: 2rem;
        border: 1px solid var(--border-color);
        box-shadow: var(--card-shadow);
    }
    .table > :not(caption)>*>* {
        padding: 1rem 1.25rem;
        border-bottom-color: var(--border-color);
        color: var(--text-main);
    }
    .table thead th {
        background-color: var(--hover-sidebar);
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
        border-bottom: none;
    }
    
    .btn-primary {
        background-color: var(--primary);
        border: none;
        padding: 0.6rem 1.5rem;
        font-weight: 500;
        transition: all 0.2s;
        color: white;
    }
    .btn-primary:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        color: white;
    }
</style>
@endpush

@section('content')

    <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold text-main mb-2">Master Barang & Jasa</h2>
            <p class="text-muted-custom mb-0" style="font-size: 1.05rem;">Kelola referensi material dan servis untuk keperluan BOQ.</p>
        </div>
        <div class="d-flex gap-2">
            @if(request()->has('trashed'))
                <a href="{{ route('barangjasa.index') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            @else
                <a href="{{ route('barangjasa.index', ['trashed' => 1]) }}" class="btn btn-outline-danger rounded-pill shadow-sm">
                    <i class="bi bi-trash ms-1 me-2"></i>Lihat Data Terhapus
                </a>
                <button type="button" class="btn btn-success rounded-pill shadow-sm text-white" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="bi bi-file-earmark-excel-fill me-2"></i>Import Excel
                </button>
                <button type="button" class="btn btn-primary rounded-pill shadow-sm" onclick="openCreateModal()">
                    <i class="bi bi-plus-circle-fill me-2"></i>Tambah Item
                </button>
            @endif
        </div>
    </div>

    <!-- Modal Import Excel -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: var(--bg-card); border-color: var(--border-color);">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold text-main" id="importModalLabel">Import Master Data (Excel)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('barangjasa.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body py-0">
                        <div class="alert alert-info border-0 rounded-3 mb-4" style="background-color: var(--hover-sidebar); color: var(--text-main);">
                            <i class="bi bi-info-circle-fill me-2 text-primary"></i>
                            Format kolom: <strong>Kode | Nama | Tipe | Satuan | Harga Material | Harga Jasa</strong>. <br>
                            Baris pertama (header) akan diabaikan.
                        </div>
                        <div class="mb-3">
                            <label for="file_excel" class="form-label text-main fw-medium">Pilih File Excel (.xlsx / .xls)</label>
                            <input class="form-control bg-transparent text-main" type="file" id="file_excel" name="file_excel" accept=".xlsx, .xls" required style="border-color: var(--border-color);">
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 mt-3">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-cloud-arrow-up-fill me-2"></i>Mulai Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 bg-success bg-opacity-10 text-success border border-success mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i> 
            <span class="align-middle fw-medium">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 bg-danger bg-opacity-10 text-danger border border-danger mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5 align-middle"></i> 
            <span class="align-middle fw-medium">{{ session('error') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 datatable">
                <thead>
                    <tr>
                        <th scope="col" width="15%">Kode Item</th>
                        <th scope="col" width="35%">Nama Barang / Jasa</th>
                        <th scope="col" width="15%">Tipe</th>
                        <th scope="col" width="15%" class="text-center">Satuan</th>
                        <th scope="col" class="text-center" width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse ($barangJasa as $item)
                    <tr id="row-{{ $item->id }}">
                        <td>
                            <span class="badge text-muted-custom border border-custom font-monospace fs-6 px-2 py-1" style="background-color: var(--bg-body);">{{ $item->kode_barang }}</span>
                        </td>
                        <td>
                            <div class="fw-medium text-main text-truncate" style="max-width: 350px;" title="{{ $item->nama_barang }}">{{ $item->nama_barang }}</div>
                        </td>
                        <td>
                            @if($item->tipe === 'Material')
                                <span class="badge bg-info bg-opacity-10 text-info border border-info rounded-pill px-3 py-1"><i class="bi bi-box me-1"></i> Material</span>
                            @else
                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning rounded-pill px-3 py-1"><i class="bi bi-tools me-1"></i> Jasa</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="text-muted-custom">{{ $item->satuan }}</span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                @if(request()->has('trashed'))
                                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3" onclick="ajaxAction({{ $item->id }}, '{{ route('barangjasa.restore', $item->id) }}', 'POST', 'Yakin ingin memulihkan item ini?')">
                                        <i class="bi bi-arrow-counterclockwise"></i> Pulihkan
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger rounded-pill px-3" onclick="ajaxAction({{ $item->id }}, '{{ route('barangjasa.force-delete', $item->id) }}', 'DELETE', 'Yakin ingin menghapus item ini PERMANEN?')">
                                        <i class="bi bi-trash"></i> Hapus Permanen
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" 
                                        data-id="{{ $item->id }}"
                                        data-kode="{{ $item->kode_barang }}"
                                        data-nama="{{ $item->nama_barang }}"
                                        data-tipe="{{ $item->tipe }}"
                                        data-satuan="{{ $item->satuan }}"
                                        data-hargamat="{{ $item->harga_material }}"
                                        data-hargajasa="{{ $item->harga_jasa }}"
                                        onclick="openEditModal(this)">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="ajaxAction({{ $item->id }}, '{{ route('barangjasa.destroy', $item->id) }}', 'DELETE', 'Yakin ingin menghapus item ini ke tong sampah?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted-custom">
                            Belum ada master data barang & jasa.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    <!-- Modal CRUD (Create & Edit) -->
    <div class="modal fade" id="crudModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="background-color: var(--bg-card); border-color: var(--border-color);">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold text-main" id="crudModalTitle">Tambah Item Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="crudForm" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="crudMethod" value="POST">
                    <div class="modal-body py-0">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-main fw-medium">Kode Item <span class="text-danger">*</span></label>
                                <input type="text" class="form-control bg-transparent text-main" id="kode_barang" name="kode_barang" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-main fw-medium">Tipe Item <span class="text-danger">*</span></label>
                                <select class="form-select bg-transparent text-main" id="tipe" name="tipe" required>
                                    <option value="Material">Material</option>
                                    <option value="Jasa">Jasa</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-main fw-medium">Nama Barang / Jasa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control bg-transparent text-main" id="nama_barang" name="nama_barang" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-main fw-medium">Satuan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control bg-transparent text-main" id="satuan" name="satuan" placeholder="Ls, m2, unit" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-main fw-medium">Harga Material</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent text-main border-end-0">Rp</span>
                                    <input type="number" class="form-control bg-transparent text-main border-start-0" id="harga_material" name="harga_material" value="0" min="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-main fw-medium">Harga Jasa</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent text-main border-end-0">Rp</span>
                                    <input type="number" class="form-control bg-transparent text-main border-start-0" id="harga_jasa" name="harga_jasa" value="0" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 mt-4">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4" id="btnSave">
                            <i class="bi bi-save me-2"></i>Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let crudModal;
        let myDataTable;

        function initDataTable() {
            if (document.querySelector('.datatable')) {
                myDataTable = new simpleDatatables.DataTable('.datatable', {
                    searchable: true,
                    fixedHeight: true,
                    labels: {
                        placeholder: "Cari item...",
                        perPage: "Data per halaman",
                        noRows: "Tidak ada data yang ditemukan",
                        info: "Menampilkan {start} - {end} dari {rows} data"
                    }
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            initDataTable();
            crudModal = new bootstrap.Modal(document.getElementById('crudModal'));
        });

        function openCreateModal() {
            document.getElementById('crudForm').reset();
            document.getElementById('crudModalTitle').innerText = 'Tambah Item Baru';
            document.getElementById('crudMethod').value = 'POST';
            document.getElementById('crudForm').action = "{{ route('barangjasa.store') }}";
            crudModal.show();
        }

        function openEditModal(btn) {
            let id = btn.getAttribute('data-id');
            document.getElementById('crudModalTitle').innerText = 'Edit Item';
            document.getElementById('crudMethod').value = 'PUT';
            document.getElementById('crudForm').action = `/barangjasa/${id}`;
            
            document.getElementById('kode_barang').value = btn.getAttribute('data-kode');
            document.getElementById('nama_barang').value = btn.getAttribute('data-nama');
            document.getElementById('tipe').value = btn.getAttribute('data-tipe');
            document.getElementById('satuan').value = btn.getAttribute('data-satuan');
            document.getElementById('harga_material').value = btn.getAttribute('data-hargamat');
            document.getElementById('harga_jasa').value = btn.getAttribute('data-hargajasa');
            
            crudModal.show();
        }

        // Handle form submit via AJAX
        document.getElementById('crudForm').addEventListener('submit', function(e) {
            e.preventDefault();
            let btn = document.getElementById('btnSave');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';

            fetch(this.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                body: new FormData(this)
            })
            .then(async response => {
                const isJson = response.headers.get('content-type')?.includes('application/json');
                const data = isJson ? await response.json() : null;

                if (!response.ok) {
                    // Cek jika error validasi dari Laravel (HTTP 422)
                    if (response.status === 422 && data && data.errors) {
                        let errorMessages = [];
                        for (const key in data.errors) {
                            errorMessages.push(data.errors[key][0]);
                        }
                        throw new Error(errorMessages.join('\n'));
                    }
                    throw new Error((data && data.message) || 'Terjadi kesalahan pada server.');
                }
                return data;
            })
            .then(data => {
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-save me-2"></i>Simpan Data';
                
                if (data && data.success) {
                    crudModal.hide();
                    window.location.reload();
                } else {
                    alert((data && data.message) || 'Terjadi kesalahan yang tidak diketahui.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-save me-2"></i>Simpan Data';
                alert(error.message || 'Gagal terhubung ke server.');
            });
        });

        function ajaxAction(id, url, method, message) {
            if (confirm(message)) {
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        _method: method
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data && data.success) {
                        let row = document.getElementById('row-' + id);
                        if (row) {
                            row.style.transition = "all 0.3s ease";
                            row.style.opacity = "0.3";
                            row.style.transform = "scale(0.95)";
                        }

                        // Simpan halaman saat ini
                        let currentPage = myDataTable ? myDataTable.currentPage : 1;

                        // Ambil ulang tabel dari server secara AJAX agar sinkron 100% tanpa merusak DOM reusable
                        fetch(window.location.href)
                        .then(res => res.text())
                        .then(html => {
                            let doc = new DOMParser().parseFromString(html, 'text/html');
                            let newTable = doc.querySelector('.datatable');
                            let wrapper = document.querySelector('.dataTable-wrapper');
                            
                            if (wrapper && newTable) {
                                // Ganti wrapper lama dengan tabel fresh dari server
                                wrapper.parentNode.replaceChild(newTable, wrapper);
                                // Inisialisasi ulang
                                initDataTable();
                                // Kembali ke halaman sebelumnya
                                if (myDataTable && typeof myDataTable.page === 'function') {
                                    // simple-datatables page() method is 1-indexed
                                    myDataTable.page(currentPage);
                                }
                            } else {
                                window.location.reload();
                            }
                        })
                        .catch(() => window.location.reload());

                    } else {
                        alert((data && data.message) || 'Terjadi kesalahan.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal terhubung ke server.');
                });
            }
        }
    </script>
    @endpush
@endsection
