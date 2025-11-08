@extends('admin-temp.layout_rw')
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
                        <li class="breadcrumb-item" aria-current="page">Struktural Karang Taruna</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Struktural Karang Taruna.</h2>
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
                                        @foreach ($strukturalkatar as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($item->gambar)
                                                        <img src="{{ asset('storage/' . $item->gambar) }}" width="100">
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
                    <h5 class="modal-title">Form Tambah Petugas Karang Taruna RW 12</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('struktural.store_rw') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card" style="border: none; box-shadow: none;">
                            <div class="card-body p-0">
                                {{-- @if ($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Gagal menyimpan! Periksa input Anda:</strong>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endi
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif --}}
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="is-new-user-checkbox"
                                        name="is_new_user" value="1">
                                    <label class="form-check-label" for="is-new-user-checkbox">
                                        Tambah Petugas Baru? (Centang jika nama tidak ada di daftar)
                                    </label>
                                </div>
                                <div id="pilih-petugas-group">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Pilih Nama Petugas</label>
                                        <select name="id_datadiri" id="id_datadiri_select" class="form-control" required>
                                            <option value="">-- Pilih Nama --</option>
                                            @foreach ($datadiri as $diri)
                                                <option value="{{ $diri->id }}">{{ $diri->name }}
                                                    ({{ $diri->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div id="manual-input-fields" style="display: none;">
                                    <div class="form-group">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" placeholder="Masukan name Pengguna"
                                            id="name_input" name="name">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" class="form-control" placeholder="Masukan Email Pengguna"
                                            id="email_input" name="email">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="form-label">No. Telepon</label>
                                        <input type="text" class="form-control" placeholder="Masukan Nomor Telepon"
                                            id="notelp_input" name="notelp">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea class="form-control" placeholder="Masukan Alamat" id="alamat_input" name="alamat"></textarea>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan"
                                        placeholder="Masukan Jabatan" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Tingkatan</label>
                                    <select class="form-control" id="tingkatan_add" name="tingkatan" required>
                                        <option value="">-- Pilih Kategori Tingkatan --</option>
                                        <option value="RT">Rukun Tetangga (RT)</option>
                                        <option value="RW">Rukun Warga (RW)</option>
                                        <option value="PKK">PKK Anyelir (PKK)</option>
                                        <option value="KATAR">Karang Taruna (KATAR)</option>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label">Gambar</label>
                                    <input type="file" name="gambar" class="form-control" accept="image/*" required>
                                    <small class="text-muted">Format: .jpg, .jpeg, .png (max 2048)</small>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Update KTP -->
    @foreach ($strukturalkatar as $item)
        <div id="UpdatepenggunaModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="UpdatepenggunaModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Form Update Petugas Karang Taruna RW 12</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('struktural.update_rw', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <div class="card" style="border: none; box-shadow: none;">
                                <div class="card-body p-0">
                                    {{-- @if ($errors->any())
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Gagal menyimpan! Periksa input Anda:</strong>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif --}}
                                    <div class="form-group mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" placeholder="Masukan nama"
                                            name="name" value="{{ optional($item->datadiri)->name }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" class="form-control" placeholder="Masukan email"
                                            name="email" value="{{ optional($item->datadiri)->email }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">No. Telepon</label>
                                        <input type="text" class="form-control" placeholder="Masukan nomor telepon"
                                            name="notelp" value="{{ optional($item->datadiri)->notelp }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea class="form-control" placeholder="Masukan alamat" name="alamat" required>{{ optional($item->datadiri)->alamat }}</textarea>
                                    </div>

                                    <hr class="my-4">

                                    <div class="form-group mb-3">
                                        <label class="form-label">Jabatan</label>
                                        <input type="text" class="form-control" name="jabatan"
                                            placeholder="Masukan Jabatan" value="{{ $item->jabatan }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Tingkatan</label>
                                        {{-- FIX: Ganti class="form-select" jadi "form-control" --}}
                                        <select class="form-control" id="tingkatan_update-{{ $item->id }}"
                                            name="tingkatan" required>
                                            <option value="">-- Pilih Kategori Tingkatan --</option>
                                            <option value="RT" {{ $item->tingkatan == 'RT' ? 'selected' : '' }}>Rukun
                                                Tetangga (RT)</option>
                                            <option value="RW" {{ $item->tingkatan == 'RW' ? 'selected' : '' }}>Rukun
                                                Warga (RW)</option>
                                            <option value="PKK" {{ $item->tingkatan == 'PKK' ? 'selected' : '' }}>PKK
                                                Anyelir (PKK)</option>
                                            <option value="KATAR" {{ $item->tingkatan == 'KATAR' ? 'selected' : '' }}>
                                                Karang Taruna (KATAR)</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="form-label">Gambar (biarkan kosong jika tidak diganti)</label>
                                        <input type="file" name="gambar" class="form-control" accept="image/*">
                                        @if ($item->gambar)
                                            <div class="mt-2 text-center">
                                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar lama"
                                                    width="150" class="img-thumbnail">
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete struktural -->
    @foreach ($strukturalkatar as $item)
        <div id="DeletepenggunaModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="DeletepenggunaModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="DeletelayananModalTitle-{{ $item->id }}">Hapus Data</h5>
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
                                <h5>Yakin ingin menghapus petugas karang taruna?
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('AddpenggunaModal');
            if (!modal) {
                return;
            }

            const checkbox = modal.querySelector('#is-new-user-checkbox');
            const pilihPetugasGroup = modal.querySelector('#pilih-petugas-group');
            const manualInputFields = modal.querySelector('#manual-input-fields');
            const idDiriSelect = modal.querySelector('#id_datadiri_select');
            const nameInput = modal.querySelector('#name_input');
            const emailInput = modal.querySelector('#email_input');
            const notelpInput = modal.querySelector('#notelp_input');
            const alamatInput = modal.querySelector('#alamat_input');

            function toggleFormMode() {
                if (checkbox.checked) {
                    manualInputFields.style.display = 'block';
                    idDiriSelect.required = false;
                    nameInput.required = true;
                    emailInput.required = true;
                    notelpInput.required = true;
                    alamatInput.required = true;

                } else {
                    pilihPetugasGroup.style.display = 'block';
                    manualInputFields.style.display = 'none';
                    idDiriSelect.required = true;
                    nameInput.required = false;
                    emailInput.required = false;
                    notelpInput.required = false;
                    alamatInput.required = false;
                }
            }
            checkbox.addEventListener('change', toggleFormMode);
            modal.addEventListener('show.bs.modal', function() {
                checkbox.checked = false;
                nameInput.value = '';
                emailInput.value = '';
                notelpInput.value = '';
                alamatInput.value = '';
                idDiriSelect.selectedIndex = 0;
                toggleFormMode();
            });
            toggleFormMode();
        });
    </script>
@endsection
