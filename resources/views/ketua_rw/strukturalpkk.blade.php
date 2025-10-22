@extends('admin-temp.head')
@section('content_admin')
    <!-- Alternative Pagination table start -->

    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Pages</a></li>
                        <li class="breadcrumb-item" aria-current="page">Struktural PKK Anyelir</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Struktural PKK Anyelir.</h2>
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
                                {{-- <h5 class="mb-3">KTP RW 12</h5> --}}
                                <div class="py-3">
                                    <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal"
                                        data-bs-target="#AddpenggunaModal">
                                        Tambah Pengguna
                                    </button>
                                </div>
                                <table id="basic-btn-rw" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Petugas</th>
                                            <th>Email</th>
                                            <th>Jabatan</th>
                                            <th>Tingkatan</th>
                                            <th>No. Telp</th>
                                            <th>Alamat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($strukturalpkk as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($item->gambar)
                                                        <img src="{{ asset('storage/' . $item->gambar) }}" width="60">
                                                    @endif
                                                </td>
                                                <td>{{ $item->datadiri->name }}</td>
                                                <td>{{ $item->datadiri->email }}</td>
                                                <td>{{ $item->jabatan }}</td>
                                                <td>{{ $item->tingkatan }}</td>
                                                <td>{{ $item->datadiri->notelp }}</td>
                                                <td>{{ $item->datadiri->alamat }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#UpdatepenggunaModal-{{ $item->id }}">
                                                        Update
                                                    </button>
                                                    <button type="button" class="btn btn-danger me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#DeletepenggunaModal-{{ $item->id }}">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Petugas</th>
                                            <th>Email</th>
                                            <th>Jabatan</th>
                                            <th>Tingkatan</th>
                                            <th>No. Telp</th>
                                            <th>Alamat</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="tab-pane fade" id="non-ktp" role="tabpanel" aria-labelledby="non-ktp-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <h5 class="mb-3">Non KTP RW 12</h5>
                                <table id="basic-btn-nonktp" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Rukun Tetangga</th>
                                            <th>laki-laki</th>
                                            <th>Perempuan</th>
                                            <th>Jumlah</th>
                                            <th>Jumlah Kartu Keluarga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_nonktp as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->rt }}</td>
                                                <td>{{ $item->laki_laki }}</td>
                                                <td>{{ $item->perempuan }}</td>
                                                <td>{{ $item->jumlah }}</td>
                                                <td>{{ $item->jumlah_kk }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#UpdatenonModal-{{ $item->id }}">
                                                        Update
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2">Total</th>
                                            <th>{{ $data_nonktp->sum('laki_laki') }}</th>
                                            <th>{{ $data_nonktp->sum('perempuan') }}</th>
                                            <th>{{ $data_nonktp->sum('jumlah') }}</th>
                                            <th>{{ $data_nonktp->sum('jumlah_kk') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Alternative Pagination table end -->

    <!-- Modal Tambah Struktural -->
    <div id="AddpenggunaModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddpenggunaModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Form Tambah Struktural RW 12</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <form action="{{ route('struktural.store_rw') }}" method="POST" enctype="multipart/form-data"
                            class="modal-content">
                            @csrf
                            <div class="card-body">

                                {{-- Pilih Data Diri --}}
                                <div class="form-group mb-3">
                                    <label class="form-label">Pilih Nama Petugas</label>
                                    <select name="id_datadiri" class="form-select" required>
                                        <option value="">-- Pilih Nama --</option>
                                        @foreach ($datadiri as $diri)
                                            <option value="{{ $diri->id }}">{{ $diri->name }} ({{ $diri->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Jabatan --}}
                                <div class="form-group mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan" placeholder="Masukan Jabatan"
                                        required>
                                </div>

                                {{-- Tingkatan --}}
                                <div class="form-group mb-3">
                                    <label class="form-label">Tingkatan</label>
                                    <select class="form-select" id="tingkatan" name="tingkatan" required>
                                        <option value="">-- Pilih Kategori Tingkatan --</option>
                                        <option value="RT">Rukun Tetangga (RT)
                                        </option>
                                        <option value="RW">Rukun Tetangga (RW)
                                        </option>
                                        <option value="PKK">PKK Anyelir (PKK)
                                        </option>
                                        <option value="KATAR">Karang Taruna (KATAR)
                                        </option>
                                    </select>
                                </div>

                                {{-- Upload Gambar --}}
                                <div class="form-group mb-4">
                                    <label class="form-label">Gambar</label>
                                    <input type="file" name="gambar" class="form-control" accept="image/*" required>
                                    <small class="text-muted">Format: .jpg, .jpeg, .png (max 2048)</small>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update KTP -->
    @foreach ($strukturalpkk as $item)
        <div id="UpdatepenggunaModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="UpdatepenggunaModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Form Update Struktural RW 12</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <form action="{{ route('struktural.update_rw', $item->id) }}" method="POST"
                                enctype="multipart/form-data" class="modal-content">

                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Nama Petugas</label>
                                        <select name="id_datadiri" class="form-select" required>
                                            {{-- Opsi default: tampilkan nama petugas yang sedang dipilih --}}
                                            <option value="{{ $item->id_datadiri }}" selected>
                                                {{ $item->datadiri->name ?? 'Nama tidak ditemukan' }}
                                                ({{ $item->datadiri->email ?? '-' }})
                                            </option>

                                            {{-- Garis pembatas opsional agar terlihat lebih rapi --}}
                                            <option disabled>──────────────────────────────────────</option>

                                            {{-- Daftar petugas lain untuk diganti --}}
                                            @foreach ($datadiri as $diri)
                                                {{-- Jangan tampilkan lagi jika sama dengan yang terpilih --}}
                                                @if ($diri->id != $item->id_datadiri)
                                                    <option value="{{ $diri->id }}">
                                                        {{ $diri->name }} ({{ $diri->email }})
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label class="form-label">Jabatan</label>
                                        <input type="text" class="form-control" placeholder="Masukan Jabatan"
                                            name="jabatan" value="{{ $item->jabatan }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Tingkatan</label>
                                        <select class="form-select" id="tingkatan" name="tingkatan" required>
                                            <option value="">-- Pilih Kategori Tingkatan --</option>
                                            <option value="RT" {{ $item->tingkatan == 'RT' ? 'selected' : '' }}>Rukun
                                                Tetangga (RT)
                                            </option>
                                            <option value="RW" {{ $item->tingkatan == 'RW' ? 'selected' : '' }}>Rukun
                                                Warga (RW)
                                            </option>
                                            <option value="PKK" {{ $item->tingkatan == 'PKK' ? 'selected' : '' }}>PKK
                                                Anyelir (PKK)
                                            </option>
                                            <option value="KATAR" {{ $item->tingkatan == 'KATAR' ? 'selected' : '' }}>
                                                Karang Taruna (KATAR)
                                            </option>(RW)
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Gambar (biarkan kosong jika tidak diganti)</label>
                                        <input type="file" name="gambar" class="form-control" accept="image/*">
                                        <small class="text-muted">Format: .jpg, .jpeg, .png (max 2048)</small>
                                        {{-- Jika ada gambar lama, tampilkan preview --}}
                                        @if ($item->gambar)
                                            <div class="mt-2 text-center">
                                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar lama"
                                                    width="150" class="img-thumbnail">
                                                <p class="text-muted mt-1">Gambar saat ini</p>
                                            </div>
                                        @endif

                                        {{-- Tampilkan error jika validasi gagal --}}
                                        @error('gambar')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete struktural -->
    @foreach ($strukturalpkk as $item)
        <div id="DeletepenggunaModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="DeletepenggunaModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="DeletelayananModalTitle-{{ $item->id }}">Hapus Layanan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('struktural.destroy_rw', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-3">
                                <div class="form-group">
                                    <label class="form-label">Gambar Petugas</label>
                                    {{-- Jika ada gambar lama, tampilkan preview --}}
                                    @if ($item->gambar)
                                        <div class="mt-2 text-center">
                                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar lama"
                                                width="150" class="img-thumbnail">
                                            <p class="text-muted mt-1">Gambar saat ini</p>
                                        </div>
                                    @endif

                                    {{-- Tampilkan error jika validasi gagal --}}
                                    @error('gambar')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <h5>Yakin ingin menghapus struktural
                                    <strong>{{ $item->datadiri?->name }}</strong>?
                                </h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-danger">
                                    <i class="ti ti-trash"></i> Hapus
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@extends('admin-temp.footer_rw')
