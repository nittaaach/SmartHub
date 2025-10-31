@extends('admin-temp.head')
@section('content_admin')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Pages</a></li>
                        <li class="breadcrumb-item" aria-current="page">Inventaris Katar Anyelir</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Inventaris Katar Anyelir.</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="ktp-rw12" role="tabpanel" aria-labelledby="ktp-rw12-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <div class="py-3">
                                    <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal"
                                        data-bs-target="#AddinventarisModal">
                                        Tambah Inventaris Katar
                                    </button>
                                    <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal"
                                        data-bs-target="#AddRiwayatInventarisModal">
                                        Catat Transaksi (Masuk/Keluar)
                                    </button>
                                </div>
                                <table id="basic-btn-rw" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Barang</th>
                                            <th>Kategori Barang</th>
                                            <th>Kode Barang</th>
                                            <th>Kondisi Barang</th>
                                            <th>Stok Saat Ini</th>
                                            <th>Aktivitas Terakhir</th>
                                            <th>Penanggung Jawab (PJ)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inventaris as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($item->gambar)
                                                        <img src="{{ asset('storage/' . $item->gambar) }}" width="60">
                                                    @endif
                                                </td>
                                                <td>{{ $item->nama_barang }}</td>
                                                <td>{{ $item->kategori }}</td>
                                                <td>{{ $item->kode_barang }}</td>
                                                <td>{{ $item->kondisi }}</td>
                                                <td>
                                                    <strong>{{ $item->stok_akhir }}</strong> {{ $item->satuan }}
                                                </td>

                                                <td>
                                                    @if ($item->riwayatTerakhir)
                                                        @if ($item->riwayatTerakhir->tipe_transaksi == 'Masuk')
                                                            <span style="color: green;">Masuk
                                                                ({{ $item->riwayatTerakhir->jumlah }})
                                                            </span>
                                                        @else
                                                            <span style="color: red;">Keluar
                                                                ({{ $item->riwayatTerakhir->jumlah }})</span>
                                                        @endif
                                                        <br>
                                                        <small>{{ $item->riwayatTerakhir->keterangan }}</small>
                                                    @else
                                                        <small><i>Belum ada riwayat</i></small>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $item->riwayatTerakhir?->penanggung_jawab ?? '-' }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#UpdateInventarisModal-{{ $item->id }}">
                                                        Update
                                                    </button>
                                                    <button type="button" class="btn btn-danger me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#DeleteinventarisModal-{{ $item->id }}">
                                                        Delete
                                                    </button>
                                                    <button type="button" class="btn btn-info me-3" data-bs-toggle="modal"
                                                        data-bs-target="#DetailInventarisModal-{{ $item->id }}">
                                                        Detail
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Barang</th>
                                            <th>Kategori Barang</th>
                                            <th>Kode Barang</th>
                                            <th>Kondisi Barang</th>
                                            <th>Stok Saat Ini</th>
                                            <th>Aktivitas Terakhir</th>
                                            <th>Penanggung Jawab (PJ)</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add inventaris -->
    <div id="AddinventarisModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddinventarisModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Form Tambah Inventaris Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('inventaris.store_ktrinven') }}" method="POST" enctype="multipart/form-data"
                        id="formTambahInventaris">
                        @csrf
                        <div class="card-body">

                            <h5>Data Master Barang</h5>
                            <hr class="mt-0">

                            <div class="form-group mb-3">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang"
                                    placeholder="Masukan Nama Barang" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Kode Barang</label>
                                <input type="text" class="form-control" name="kode_barang"
                                    placeholder="Masukan Kode Barang" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Kategori Barang</label>
                                <select class="form-select" name="kategori" id="select_kategori" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Perlengkapan Rapat">Perlengkapan Rapat</option>
                                    <option value="Elektronik">Elektronik</option>
                                    <option value="Olahraga">Olahraga</option>
                                    <option value="Perlengkapan Tenda">Perlengkapan Tenda</option>
                                    <option value="ATK (Alat Tulis Kantor)">ATK (Alat Tulis Kantor)</option>
                                    <option value="Lainnya">Lainnya (Isi Manual)</option>
                                </select>
                                <input type="text" class="form-control mt-2 d-none" id="input_kategori_lainnya"
                                    name="kategori_lainnya" placeholder="Masukkan kategori lainnya">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Satuan Barang</label>
                                <select class="form-select" name="satuan" id="select_satuan" required>
                                    <option value="">-- Pilih Satuan Barang --</option>
                                    <option value="Buah">Buah</option>
                                    <option value="Unit">Unit</option>
                                    <option value="Set">Set</option>
                                    <option value="Kodi">Kodi</option>
                                    <option value="Lusin">Lusin</option>
                                    <option value="Lainnya">Lainnya (Isi Manual)</option>
                                </select>
                                <input type="text" class="form-control mt-2 d-none" id="input_satuan_lainnya"
                                    name="satuan_lainnya" placeholder="Masukkan satuan lainnya">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Kondisi Barang</label>
                                <select class="form-select" name="kondisi" id="select_kondisi" required>
                                    <option value="">-- Pilih Kondisi Barang --</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak Ringan">Rusak Ringan</option>
                                    <option value="Rusak Berat">Rusak Berat</option>
                                    <option value="Hilang">Hilang</option>
                                    <option value="Lainnya">Lainnya (Isi Manual)</option>
                                </select>
                                <input type="text" class="form-control mt-2 d-none" id="input_kondisi_lainnya"
                                    name="kondisi_lainnya" placeholder="Masukkan Kondisi lainnya">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Lokasi Penyimpanan</label>
                                <input type="text" class="form-control" name="lokasi_penyimpanan"
                                    placeholder="Masukan Lokasi (Cth: Sekretariat)" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" name="gambar" class="form-control" accept="image/*">
                                <small class="text-muted">Format: .jpg, .jpeg, .png (max 2MB)</small>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Tanggal Perolehan Barang</label>
                                <input type="date" name="tanggal_perolehan" class="form-control">
                            </div>

                            <h5 class="mt-4">Stok Awal</h5>
                            <hr class="mt-0">

                            <div class="form-group mb-3">
                                <label class="form-label">Jumlah Stok Awal</label>
                                <input type="number" class="form-control" name="jumlah_awal"
                                    placeholder="Masukan jumlah stok saat ini" min="0" required>
                                <small class="text-muted">Akan dicatat sebagai riwayat 'Masuk' pertama.</small>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Barang Baru</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- riwayat inventaris --}}
    <div id="AddRiwayatInventarisModal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="AddRiwayatInventarisModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Form Catat Transaksi Stok</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('inventaris.store_ktriwaya') }}" method="POST" id="formTambahRiwayat">
                        @csrf
                        <div class="card-body">

                            <div class="form-group mb-3">
                                <label class="form-label">Pilih Barang</label>
                                <select class="form-select" name="inventaris_id" required>
                                    <option value="">-- Pilih Barang yang Sudah Terdaftar --</option>
                                    @if (isset($inventaris))
                                        @foreach ($inventaris as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_barang }} (Stok:
                                                {{ $item->stok_akhir }})</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small class="text-muted">Jika barang belum ada, tambahkan dulu dari 'Tambah Inventaris
                                    Katar'.</small>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Tipe Transaksi</label>
                                <select class="form-select" name="tipe_transaksi" id="select_tipe_transaksi" required>
                                    <option value="">-- Pilih Tipe Transaksi --</option>
                                    <option value="Masuk">Masuk (Beli baru, Pengembalian)</option>
                                    <option value="Keluar">Keluar (Dipinjam, Rusak, Hilang)</option>
                                    <option value="Penyesuaian">Penyesuaian (Stok Opname)</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Jumlah Barang</label>
                                <input type="number" class="form-control" name="jumlah"
                                    placeholder="Masukan Jumlah Barang" min="1" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Keterangan Transaksi</label>
                                <textarea class="form-control" placeholder="Cth: Dipinjam oleh Budi untuk Rapat" name="keterangan" required></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Penanggung Jawab</label>
                                <input type="text" class="form-control" name="penanggung_jawab"
                                    placeholder="Masukan Nama Penanggung Jawab" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Tanggal Transaksi</label>
                                <input type="datetime-local" name="tanggal_transaksi" class="form-control">
                                <small>Kosongkan untuk memakai waktu sekarang.</small>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update inventaris -->
    @foreach ($inventaris as $item)
        <div id="UpdateInventarisModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="UpdateInventarisModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title" id="UpdateInventarisModalTitle-{{ $item->id }}">Edit:
                            {{ $item->nama_barang }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('inventaris.update_katar', $item->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <div class="card-body">
                                <h5>Data Master Barang</h5>
                                <hr class="mt-0">

                                <div class="form-group mb-3">
                                    <label class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" name="nama_barang"
                                        value="{{ $item->nama_barang }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Kode Barang</label>
                                    <input type="text" class="form-control" name="kode_barang"
                                        value="{{ $item->kode_barang }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Kategori Barang</label>
                                    <select class="form-select" name="kategori" id="select_kategori_{{ $item->id }}"
                                        required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="Perlengkapan Rapat"
                                            {{ $item->kategori == 'Perlengkapan Rapat' ? 'selected' : '' }}>Perlengkapan
                                            Rapat</option>
                                        <option value="Elektronik"
                                            {{ $item->kategori == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                                        <option value="Olahraga" {{ $item->kategori == 'Olahraga' ? 'selected' : '' }}>
                                            Olahraga</option>
                                        <option value="Perlengkapan Tenda"
                                            {{ $item->kategori == 'Perlengkapan Tenda' ? 'selected' : '' }}>Perlengkapan
                                            Tenda</option>
                                        <option value="ATK (Alat Tulis Kantor)"
                                            {{ $item->kategori == 'ATK (Alat Tulis Kantor)' ? 'selected' : '' }}>ATK
                                        </option>
                                        <option value="Lainnya"
                                            {{ !in_array($item->kategori, ['Perlengkapan Rapat', 'Elektronik', 'Olahraga', 'Perlengkapan Tenda', 'ATK (Alat Tulis Kantor)']) ? 'selected' : '' }}>
                                            Lainnya (Isi Manual)
                                        </option>
                                    </select>
                                    <input type="text" class="form-control mt-2 d-none"
                                        id="input_kategori_lainnya_{{ $item->id }}" name="kategori_lainnya"
                                        placeholder="Masukkan kategori lainnya"
                                        value="{{ !in_array($item->kategori, ['Perlengkapan Rapat', 'Elektronik', 'Olahraga', 'Perlengkapan Tenda', 'ATK (Alat Tulis Kantor)']) ? $item->kategori : '' }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Satuan Barang</label>
                                    <select class="form-select" name="satuan" id="select_satuan_{{ $item->id }}"
                                        required>
                                        <option value="">-- Pilih Satuan --</option>
                                        <option value="Buah" {{ $item->satuan == 'Buah' ? 'selected' : '' }}>Buah
                                        </option>
                                        <option value="Unit" {{ $item->satuan == 'Unit' ? 'selected' : '' }}>Unit
                                        </option>
                                        <option value="Set" {{ $item->satuan == 'Set' ? 'selected' : '' }}>Set</option>
                                        <option value="Kodi" {{ $item->satuan == 'Kodi' ? 'selected' : '' }}>Kodi
                                        </option>
                                        <option value="Lusin" {{ $item->satuan == 'Lusin' ? 'selected' : '' }}>Lusin
                                        </option>
                                        <option value="Lainnya"
                                            {{ !in_array($item->satuan, ['Buah', 'Unit', 'Set', 'Kodi', 'Lusin']) ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    <input type="text" class="form-control mt-2 d-none"
                                        id="input_satuan_lainnya_{{ $item->id }}" name="satuan_lainnya"
                                        placeholder="Masukkan satuan lainnya"
                                        value="{{ !in_array($item->satuan, ['Buah', 'Unit', 'Set', 'Kodi', 'Lusin']) ? $item->satuan : '' }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Kondisi Barang</label>
                                    <select class="form-select" name="kondisi" id="select_kondisi_{{ $item->id }}"
                                        required>
                                        <option value="">-- Pilih Kondisi --</option>
                                        <option value="Baik" {{ $item->kondisi == 'Baik' ? 'selected' : '' }}>Baik
                                        </option>
                                        <option value="Rusak Ringan"
                                            {{ $item->kondisi == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                        <option value="Rusak Berat"
                                            {{ $item->kondisi == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                        <option value="Hilang" {{ $item->kondisi == 'Hilang' ? 'selected' : '' }}>Hilang
                                        </option>
                                        <option value="Lainnya"
                                            {{ !in_array($item->kondisi, ['Baik', 'Rusak Ringan', 'Rusak Berat', 'Hilang']) ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    <input type="text" class="form-control mt-2 d-none"
                                        id="input_kondisi_lainnya_{{ $item->id }}" name="kondisi_lainnya"
                                        placeholder="Masukkan Kondisi lainnya"
                                        value="{{ !in_array($item->kondisi, ['Baik', 'Rusak Ringan', 'Rusak Berat', 'Hilang']) ? $item->kondisi : '' }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Lokasi Penyimpanan</label>
                                    <input type="text" class="form-control" name="lokasi_penyimpanan"
                                        value="{{ $item->lokasi_penyimpanan }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Gambar (Opsional: Ganti)</label>
                                    <input type="file" name="gambar" class="form-control" accept="image/*">
                                    @if ($item->gambar)
                                        <small>Gambar saat ini: <a href="{{ asset('storage/' . $item->gambar) }}"
                                                target="_blank">Lihat</a></small>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Tanggal Perolehan Barang</label>
                                    <input type="date" name="tanggal_perolehan" class="form-control"
                                        value="{{ $item->tanggal_perolehan }}">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete inventaris -->
    @foreach ($inventaris as $item)
        <div id="DeleteinventarisModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="DeleteinventarisModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="DeleteinventarisModalTitle-{{ $item->id }}">Hapus inventaris
                            Kegiatan
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('inventaris.destroy_katar', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <div class="p-3 text-center">
                                <div class="form-group">
                                    <label class="form-label">Gambar Petugas</label>
                                    @if ($item->gambar)
                                        <div class="mt-2 text-center">
                                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar lama"
                                                width="150" class="img-thumbnail">
                                            <p class="text-muted mt-1">Gambar saat ini</p>
                                        </div>
                                    @endif

                                    @error('gambar')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <i class="ti ti-alert-triangle" style="font-size: 4rem; color: #dc3545;"></i>
                                <h5 class="mt-3">
                                    Yakin ingin menghapus inventaris
                                    <br>
                                    <strong>"{{ $item->nama_barang }}"</strong>?
                                </h5>
                                <p class="text-muted mt-2">
                                    Data yang sudah dihapus tidak dapat dikembalikan lagi.
                                </p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">
                                    <i class="ti ti-trash"></i> Ya, Hapus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($inventaris as $item)
        <div id="DetailInventarisModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="DetailInventarisModalTitle-{{ $item->id }}" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="DetailInventarisModalTitle-{{ $item->id }}">Detail:
                            {{ $item->nama_barang }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar Barang"
                                            class="img-fluid rounded mb-3">
                                    @else
                                        <div class="border rounded bg-light text-center p-5 mb-3">
                                            <span class="text-muted">Tidak Ada Gambar</span>
                                        </div>
                                    @endif

                                    <h5 class="text-center">Stok Saat Ini</h5>
                                    <h1 class="text-center display-4 fw-bold">{{ $item->stok_akhir }}</h1>
                                    <p class="text-center text-muted fs-4">{{ $item->satuan }}</p>

                                    <hr>
                                    <strong>Kondisi:</strong>
                                    <p>{{ $item->kondisi }}</p>
                                </div>

                                <div class="col-md-8">
                                    <h5>Data Master Barang</h5>
                                    <dl class="row">
                                        <dt class="col-sm-4">Kode Barang</dt>
                                        <dd class="col-sm-8">{{ $item->kode_barang }}</dd>

                                        <dt class="col-sm-4">Kategori</dt>
                                        <dd class="col-sm-8">{{ $item->kategori }}</dd>

                                        <dt class="col-sm-4">Lokasi</dt>
                                        <dd class="col-sm-8">{{ $item->lokasi_penyimpanan }}</dd>

                                        <dt class="col-sm-4">Tgl. Perolehan</dt>
                                        <dd class="col-sm-8">
                                            {{ \Carbon\Carbon::parse($item->tanggal_perolehan)->format('d M Y') }}</dd>

                                        <dt class="col-sm-4">Deskripsi</dt>
                                        <dd class="col-sm-8">
                                            <p>{{ $item->deskripsi ?? '-' }}</p>
                                        </dd>
                                    </dl>

                                    <hr>

                                    <h5>Riwayat Transaksi</h5>
                                    <div style="max-height: 300px; overflow-y: auto;">
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Tipe</th>
                                                    <th>Jumlah</th>
                                                    <th>Keterangan</th>
                                                    <th>PJ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($item->riwayat as $riwayat)
                                                    <tr>
                                                        <td>{{ $riwayat->tanggal_transaksi->format('d/m/y H:i') }}</td>
                                                        <td>
                                                            @if ($riwayat->tipe_transaksi == 'Masuk')
                                                                <span class_ ="badge bg-success">Masuk</span>
                                                            @else
                                                                <span class="badge bg-danger">Keluar</span>
                                                            @endif
                                                        </td>
                                                        <td><strong>{{ $riwayat->jumlah }}</strong></td>
                                                        <td>{{ $riwayat->keterangan }}</td>
                                                        <td>{{ $riwayat->penanggung_jawab }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">Belum ada riwayat
                                                            transaksi.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

<script>
    function setupLainnyaToggle(selectId, inputId) {
        const selectEl = document.getElementById(selectId);
        const inputEl = document.getElementById(inputId);

        if (!selectEl || !inputEl) {
            return;
        }

        function toggleInput() {
            if (selectEl.value === 'Lainnya') {
                inputEl.classList.remove('d-none');
                inputEl.required = true;
            } else {
                inputEl.classList.add('d-none');
                inputEl.required = false;
            }
        }

        selectEl.addEventListener('change', () => {
            if (selectEl.value !== 'Lainnya') {
                inputEl.value = '';
            }
            toggleInput();
        });
        toggleInput();
    }

    function setupFormSubmitGuard(form) {
        if (form) {
            form.addEventListener('submit', function() {
                const submitButton = form.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.innerHTML = 'Menyimpan...';
                }
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {

        setupLainnyaToggle('select_kategori', 'input_kategori_lainnya');
        setupLainnyaToggle('select_satuan', 'input_satuan_lainnya');
        setupLainnyaToggle('select_kondisi', 'input_kondisi_lainnya');

        const formInventaris = document.getElementById('AddinventarisModal')?.querySelector('form');
        setupFormSubmitGuard(formInventaris);

        const formRiwayat = document.getElementById('AddRiwayatInventarisModal')?.querySelector('form');
        setupFormSubmitGuard(formRiwayat);

        @if (isset($inventaris))
            @foreach ($inventaris as $item)
                setupLainnyaToggle('select_kategori_{{ $item->id }}',
                    'input_kategori_lainnya_{{ $item->id }}');
                setupLainnyaToggle('select_satuan_{{ $item->id }}',
                    'input_satuan_lainnya_{{ $item->id }}');
                setupLainnyaToggle('select_kondisi_{{ $item->id }}',
                    'input_kondisi_lainnya_{{ $item->id }}');
                const formEdit = document.getElementById('UpdateInventarisModal-{{ $item->id }}')
                    ?.querySelector('form');
                setupFormSubmitGuard(formEdit);
            @endforeach
        @endif
    });
</script>

@extends('admin-temp.footer_katar')
