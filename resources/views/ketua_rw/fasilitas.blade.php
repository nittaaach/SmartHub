@extends('admin-temp.layout_rw')
@section('content_admin')
    <!-- Alternative Pagination table start -->
    @php use Illuminate\Support\Str; @endphp

    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Pages</a></li>
                        <li class="breadcrumb-item" aria-current="page">fasilitas Rukun Warga</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Fasilitas Rukun Warga.</h2>
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
                                        data-bs-target="#AddfasilitasModal">
                                        Tambah Fasilitas
                                    </button>
                                </div>
                                <table id="basic-btn-ktprw" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Bangunan</th>
                                            <th>Kategori</th>
                                            <th>Lokasi RT</th>
                                            <th>Kondisi</th>
                                            <th>Alamat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fasilitas as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($item->gambar)
                                                        <img src="{{ asset('storage/' . $item->gambar) }}"
                                                            alt="{{ $item->name }}" width="100">
                                                    @else
                                                        <p><i>Tidak ada gambar</i></p>
                                                    @endif
                                                </td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->kategori }}</td>
                                                <td>{{ $item->lokasi_rt }}</td>
                                                <td>{{ $item->condition }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#UpdatefasilitasModal-{{ $item->id }}">
                                                        Update
                                                    </button>
                                                    <button type="button" class="btn btn-danger me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#DeletefasilitasModal-{{ $item->id }}">
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
                                            <th>Nama Bangunan</th>
                                            <th>Kategori</th>
                                            <th>Lokasi RT</th>
                                            <th>Kondisi</th>
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

    <!-- Modal Tambah Fasilitas -->
    <div id="AddfasilitasModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddfasilitasModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Form Tambah Fasilitas RW 12</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card">

                        <form action="{{ route('fasilitas.store_rw') }}" method="POST" enctype="multipart/form-data"
                            class="modal-content">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label class="form-label">Gambar</label>
                                    <input type="file" name="gambar" class="form-control"
                                        placeholder="Masukan Gambar Fasilitas" required>
                                    <small class="text-muted">Format: .jpg, .jpeg, .png (max 2048)</small>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Nama Bangunan</label>
                                    <input type="text" class="form-control" placeholder="Masukan name Fasilitas"
                                        name="name" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="select rt">Lokasi RT</label>
                                    <select class="form-select" id="lokasi_rt" name="lokasi_rt" required>
                                        <option value="">-- Pilih Kategori RT --</option>
                                        <option value="RT 001">Rukun Tetangga (RT) 001
                                        </option>
                                        <option value="RT 002">Rukun Tetangga (RT) 002
                                        </option>
                                        <option value="RT 003">Rukun Tetangga (RT) 003
                                        </option>
                                        <option value="RT 004">Rukun Tetangga (RT) 004
                                        </option>
                                        <option value="RT 005">Rukun Tetangga (RT) 005
                                        </option>
                                        <option value="RT 006">Rukun Tetangga (RT) 006
                                        </option>
                                        <option value="RT 007">Rukun Tetangga (RT) 007
                                        </option>
                                        <option value="RT 008">Rukun Tetangga (RT) 008
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" placeholder="Masukan Alamat" name="alamat" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="kategori">Kategori Bangunan</label>
                                    <select class="form-select" id="kategori" name="kategori" required>
                                        <option value="">-- Pilih Kategori Bangunan --</option>
                                        <option value="Musholla">Mushola
                                        </option>
                                        <option value="Masjid">Masjid
                                        </option>
                                        <option value="Sekolah">Sekolah
                                        </option>
                                        <option value="Balai RW">Balai RW
                                        </option>
                                        <option value="Balai RT">Balai RT
                                        </option>
                                        <option value="Lapangan">Lapangan
                                        </option>
                                        <option value="Posyandu">Posyandu
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="condition">Kondisi Bangunan</label>
                                    <select class="form-select" id="condition" name="condition" required>
                                        <option value="">-- Pilih Kondisi Bangunan --</option>
                                        <option value="Baik">Baik
                                        </option>
                                        <option value="Rusak Ringan">Rusak Ringan
                                        </option>
                                        <option value="Perlu Perbaikan">Perlu Perbaikan
                                        </option>
                                        <option value="Terbengkalai">Terbengkalai
                                        </option>
                                    </select>
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

    <!-- Modal Update fasilitas -->
    @foreach ($fasilitas as $item)
        <div id="UpdatefasilitasModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="UpdatefasilitasModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Form Update Fasilitas RW 12</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <form action="{{ route('fasilitas.update_rw', $item->id) }}" method="POST"
                                enctype="multipart/form-data" class="modal-content">

                                @csrf
                                @method('PUT')
                                <div class="card-body">
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

                                    <div class="form-group">
                                        <label class="form-label">Nama Bangunan</label>
                                        <input type="text" class="form-control" placeholder="Masukan name Fasilitas"
                                            value="{{ $item->name }}" name="name" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="lokasi rt">Select RT</label>
                                        <select class="form-select" id="lokasi_rt" name="lokasi_rt" required>
                                            <option value="">-- Pilih Lokasi RT --</option>
                                            <option value="RT 001" {{ $item->lokasi_rt == 'RT 001' ? 'selected' : '' }}>
                                                Rukun Warga 001
                                            </option>
                                            <option value="RT 002" {{ $item->lokasi_rt == 'RT 002' ? 'selected' : '' }}>
                                                Rukun Warga 002
                                            </option>
                                            <option value="RT 003" {{ $item->lokasi_rt == 'RT 003' ? 'selected' : '' }}>
                                                Rukun Warga 003
                                            </option>
                                            <option value="RT 004" {{ $item->lokasi_rt == 'RT 004' ? 'selected' : '' }}>
                                                Rukun Warga 004
                                            </option>
                                            <option value="RT 005" {{ $item->lokasi_rt == 'RT 005' ? 'selected' : '' }}>
                                                Rukun Warga 005
                                            </option>
                                            <option value="RT 006" {{ $item->lokasi_rt == 'RT 006' ? 'selected' : '' }}>
                                                Rukun Warga 006
                                            </option>
                                            <option value="RT 007" {{ $item->lokasi_rt == 'RT 007' ? 'selected' : '' }}>
                                                Rukun Warga 007
                                            </option>
                                            <option value="RT 008" {{ $item->lokasi_rt == 'RT 008' ? 'selected' : '' }}>
                                                Rukun Warga 008
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Alamat</label>
                                        <textarea class="form-control" name="alamat" required>{{ $item->alamat }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="kategori">Kategori Bangunan</label>
                                        <select class="form-select" id="kategori" name="kategori" required>
                                            <option value="">-- Pilih Kategori Bangunan --</option>
                                            <option value="Musholla"
                                                {{ $item->kategori == 'Musholle' ? 'selected' : '' }}>
                                                Musholla
                                            </option>
                                            <option value="Masjid" {{ $item->kategori == 'Masjid' ? 'selected' : '' }}>
                                                Masjid
                                            </option>
                                            <option value="Sekolah" {{ $item->kategori == 'Sekolah' ? 'selected' : '' }}>
                                                Sekolah
                                            </option>
                                            <option value="Balai RW"
                                                {{ $item->kategori == 'Balai RW' ? 'selected' : '' }}>
                                                Balai Rukun Warga
                                            </option>
                                            <option value="Balai RT"
                                                {{ $item->kategori == 'Balai RT' ? 'selected' : '' }}>
                                                Balai Rukun Tetangga
                                            </option>
                                            <option value="Lapangan"
                                                {{ $item->kategori == 'Lapangan' ? 'selected' : '' }}>
                                                Lapangan
                                            </option>
                                            <option value="Posyandu"
                                                {{ $item->kategori == 'Posyandu' ? 'selected' : '' }}>
                                                Posyandu
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="condition">Kondisi Bangunan</label>
                                        <select class="form-select" id="condition" name="condition" required>
                                            <option value="">-- Pilih Kondisi Bangunan --</option>
                                            <option value="Baik" {{ $item->condition == 'Baik' ? 'selected' : '' }}>Baik
                                            </option>
                                            <option value="Rusak Ringan"
                                                {{ $item->condition == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan
                                            </option>
                                            <option value="Perlu Perbaikan"
                                                {{ $item->condition == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu
                                                Perbaikan
                                            </option>
                                            <option value="Terbengkalai"
                                                {{ $item->condition == 'Terbengkalai' ? 'selected' : '' }}>Terbengkalai
                                            </option>
                                        </select>
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

    <!-- Modal Delete fasilitas -->
    @foreach ($fasilitas as $item)
        <div id="DeletefasilitasModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="DeletefasilitasModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="DeletelayananModalTitle-{{ $item->id }}">Hapus Layanan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('fasilitas.destroy_rw', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-3">
                                <div class="form-group text-center">
                                    <label class="form-label d-block">Gambar Petugas</label>

                                    {{-- Preview gambar jika ada --}}
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar petugas"
                                            width="150" class="img-thumbnail mb-2">
                                        <p class="text-muted">Gambar saat ini</p>
                                    @else
                                        <p class="text-muted fst-italic">Tidak ada gambar</p>
                                    @endif
                                </div>

                                <h5 class="text-center">
                                    Yakin ingin menghapus fasilitas <br>
                                    <strong>{{ $item->datadiri->name ?? 'Nama tidak ditemukan' }}</strong>?
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
