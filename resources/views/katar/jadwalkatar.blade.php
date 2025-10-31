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
                        <li class="breadcrumb-item" aria-current="page">Jadwal Kegiatan Katar Anyelir</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Jadwal Kegiatan Katar Anyelir.</h2>
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
                                        data-bs-target="#AddjadwalModal">
                                        Tambah Jadwal Kegiatan
                                    </button>
                                </div>
                                <table id="basic-btn-rw" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kegiatan</th>
                                            <th>Kategori</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Lokasi</th>
                                            <th>Status</th>
                                            <th>Tanggal Tunda</th>
                                            <th>Catatan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwals as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_kegiatan }}</td>
                                                <td>{{ $item->kategori }}</td>
                                                <td>{{ $item->tanggal_mulai }}</td>
                                                <td>{{ $item->tanggal_selesai }}</td>
                                                <td>{{ $item->lokasi }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>{{ $item->tanggal_tunda }}</td>
                                                <td>{{ $item->catatan }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#UpdatejadwalModal-{{ $item->id }}">
                                                        Update
                                                    </button>
                                                    <button type="button" class="btn btn-danger me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#DeletejadwalModal-{{ $item->id }}">
                                                        Delete
                                                    </button>
                                                    <button type="button" class="btn btn-info me-3" data-bs-toggle="modal"
                                                        data-bs-target="#DetailjadwalModal-{{ $item->id }}">
                                                        Detail
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kegiatan</th>
                                            <th>Kategori</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Lokasi</th>
                                            <th>Status</th>
                                            <th>Tanggal Tunda</th>
                                            <th>Catatan</th>
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

    <!-- Modal Tambah Jadwal -->
    <div id="AddjadwalModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddjadwalModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Form Tambah Jadwal Karang Taruna RW 12</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <form action="{{ route('jadwalkatar.store_katar') }}" method="POST" enctype="multipart/form-data"
                            class="modal-content">
                            @csrf
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label class="form-label">Nama Kegiatan</label>
                                    <input type="text" class="form-control" name="nama_kegiatan"
                                        placeholder="Masukan Nama Kegiatan" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label">Kategori Kegiatan</label>
                                    <select class="form-select" name="kategori" id="select_kategori" required>
                                        <option value="">-- Pilih Kategori Kegiatan --</option>
                                        <option value="Rapat">Rapat</option>
                                        <option value="Pelatihan">Pelatihan</option>
                                        <option value="Sosialisasi">Sosialisasi</option>
                                        <option value="Lomba">Lomba</option>
                                        <option value="Kunjungan">Kunjungan</option>
                                        <option value="Keagamaan">Keagamaan</option>
                                        <option value="Lainnya">Lainnya (Isi Manual)</option>
                                    </select>
                                    <input type="text" class="form-control mt-2 d-none" id="input_kategori_lainnya"
                                        name="kategori_lainnya" placeholder="Masukkan kategori lainnya">
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label">Target Peserta Kegiatan</label>
                                    <select class="form-select" name="target_peserta" id="select_target" required>
                                        <option value="">-- Pilih Target Peserta Kegiatan --</option>
                                        <option value="Warga RW 12">Warga RW 12</option>
                                        <option value="katar">katar</option>
                                        <option value="Karang Taruna">Karang Taruna</option>
                                        <option value="Umum">Umum</option>
                                        <option value="Lainnya">Lainnya (Isi Manual)</option>
                                    </select>
                                    <input type="text" class="form-control mt-2 d-none" id="input_target_lainnya"
                                        name="target_lainnya" placeholder="Masukkan kategori lainnya">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Deskripsi Kegiatan</label>
                                    <textarea class="form-control" placeholder="Masukan Deskripsi Kegiatan" name="deskripsi" required></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Tanggal Mulai Kegiatan</label>
                                    <input type="datetime-local" name="tanggal_mulai" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Tanggal Selesai Kegiatan</label>
                                    <input type="datetime-local" name="tanggal_selesai" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Lokasi</label>
                                    <input type="text" class="form-control" name="lokasi"
                                        placeholder="Masukan Lokasi" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Penanggung Jawab</label>
                                    <input type="text" class="form-control" name="penanggung_jawab"
                                        placeholder="Masukan Penanggung Jawab" required>
                                </div>
                                <!-- Status -->
                                <div class="form-group mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control"
                                        onchange="togglePublishedAtCreate(this.value)" required>
                                        <option value="Terjadwal">Terjadwal</option>
                                        <option value="Berlangsung">Berlangsung</option>
                                        <option value="Selesai">Selesai</option>
                                        <option value="Dibatalkan">Dibatalkan</option>
                                        <option value="Ditunda">Ditunda</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3" id="publishedAtCreateGroup" style="display: none;">
                                    <label>Tanggal Penundaan</label>
                                    <input type="datetime-local" name="tanggal_tunda" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Catatan Kegiatan</label>
                                    <textarea class="form-control" placeholder="Masukan Catatan Kegiatan" name="catatan" required></textarea>
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

    <!-- Modal Update Jadwal -->
    @foreach ($jadwals as $item)
        <div id="UpdatejadwalModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="UpdatejadwalModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white"> {{-- Warna diubah jadi hijau untuk edit --}}
                        <h5 class="modal-title" id="UpdatejadwalModalTitle-{{ $item->id }}">
                            Form Edit Jadwal: {{ $item->nama_kegiatan }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <form action="{{ route('jadwalkatar.update_katar', $item->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="nama_kegiatan-{{ $item->id }}">Nama
                                            Kegiatan</label>
                                        <input type="text" class="form-control" name="nama_kegiatan"
                                            id="nama_kegiatan-{{ $item->id }}" value="{{ $item->nama_kegiatan }}"
                                            required>
                                    </div>
                                    @php
                                        $kategoriOptions = [
                                            'Rapat',
                                            'Pelatihan',
                                            'Sosialisasi',
                                            'Lomba',
                                            'Kunjungan',
                                            'Keagamaan',
                                        ];
                                        $isKategoriLainnya =
                                            !in_array($item->kategori, $kategoriOptions) && !empty($item->kategori);
                                    @endphp
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="select_kategori-{{ $item->id }}">Kategori
                                            Kegiatan</label>
                                        <select class="form-select" name="kategori"
                                            id="select_kategori-{{ $item->id }}" required>
                                            <option value="">-- Pilih Kategori Kegiatan --</option>
                                            @foreach ($kategoriOptions as $option)
                                                <option value="{{ $option }}"
                                                    @if ($item->kategori == $option) selected @endif>{{ $option }}
                                                </option>
                                            @endforeach
                                            <option value="Lainnya" @if ($isKategoriLainnya) selected @endif>
                                                Lainnya
                                                (Isi Manual)
                                            </option>
                                        </select>
                                        <input type="text"
                                            class="form-control mt-2 @if (!$isKategoriLainnya) d-none @endif"
                                            id="input_kategori_lainnya-{{ $item->id }}" name="kategori_lainnya"
                                            placeholder="Masukkan kategori lainnya"
                                            value="{{ $isKategoriLainnya ? $item->kategori : '' }}">
                                    </div>
                                    @php
                                        $targetOptions = ['Warga RW 12', 'katar', 'Karang Taruna', 'Umum'];
                                        $isTargetLainnya =
                                            !in_array($item->target_peserta, $targetOptions) &&
                                            !empty($item->target_peserta);
                                    @endphp
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="select_target-{{ $item->id }}">Target Peserta
                                            Kegiatan</label>
                                        <select class="form-select" name="target_peserta"
                                            id="select_target-{{ $item->id }}" required>
                                            <option value="">-- Pilih Target Peserta Kegiatan --</option>
                                            @foreach ($targetOptions as $option)
                                                <option value="{{ $option }}"
                                                    @if ($item->target_peserta == $option) selected @endif>{{ $option }}
                                                </option>
                                            @endforeach
                                            <option value="Lainnya" @if ($isTargetLainnya) selected @endif>
                                                Lainnya
                                                (Isi Manual)</option>
                                        </select>
                                        <input type="text"
                                            class="form-control mt-2 @if (!$isTargetLainnya) d-none @endif"
                                            id="input_target_lainnya-{{ $item->id }}" name="target_lainnya"
                                            placeholder="Masukkan target lainnya"
                                            value="{{ $isTargetLainnya ? $item->target_peserta : '' }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="deskripsi-{{ $item->id }}">Deskripsi
                                            Kegiatan</label>
                                        <textarea class="form-control" placeholder="Masukan Deskripsi Kegiatan" name="deskripsi"
                                            id="deskripsi-{{ $item->id }}" required>{{ $item->deskripsi }}</textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="tanggal_mulai-{{ $item->id }}">Tanggal Mulai
                                            Kegiatan</label>
                                        <input type="datetime-local" name="tanggal_mulai"
                                            id="tanggal_mulai-{{ $item->id }}" class="form-control"
                                            value="{{ $item->tanggal_mulai ? \Carbon\Carbon::parse($item->tanggal_mulai)->format('Y-m-d\TH:i') : '' }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="tanggal_selesai-{{ $item->id }}">Tanggal
                                            Selesai Kegiatan</label>
                                        <input type="datetime-local" name="tanggal_selesai"
                                            id="tanggal_selesai-{{ $item->id }}" class="form-control"
                                            value="{{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('Y-m-d\TH:i') : '' }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="lokasi-{{ $item->id }}">Lokasi</label>
                                        <input type="text" class="form-control" name="lokasi"
                                            id="lokasi-{{ $item->id }}" value="{{ $item->lokasi }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="penanggung_jawab-{{ $item->id }}">Penanggung
                                            Jawab</label>
                                        <input type="text" class="form-control" name="penanggung_jawab"
                                            id="penanggung_jawab-{{ $item->id }}"
                                            value="{{ $item->penanggung_jawab }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="status-{{ $item->id }}">Status</label>
                                        <select name="status" id="status-{{ $item->id }}" class="form-control"
                                            onchange="togglePublishedAtUpdate(this.value, '{{ $item->id }}')"
                                            required>
                                            <option value="Terjadwal" @if ($item->status == 'Terjadwal') selected @endif>
                                                Terjadwal</option>
                                            <option value="Berlangsung" @if ($item->status == 'Berlangsung') selected @endif>
                                                Berlangsung</option>
                                            <option value="Selesai" @if ($item->status == 'Selesai') selected @endif>
                                                Selesai</option>
                                            <option value="Dibatalkan" @if ($item->status == 'Dibatalkan') selected @endif>
                                                Dibatalkan</option>
                                            <option value="Ditunda" @if ($item->status == 'Ditunda') selected @endif>
                                                Ditunda</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3" id="publishedAtUpdateGroup-{{ $item->id }}"
                                        style="@if ($item->status != 'Ditunda') display: none; @endif">
                                        <label for="tanggal_tunda-{{ $item->id }}">Tanggal Penundaan</label>
                                        <input type="datetime-local" name="tanggal_tunda"
                                            id="tanggal_tunda-{{ $item->id }}" class="form-control"
                                            value="{{ $item->tanggal_tunda ? \Carbon\Carbon::parse($item->tanggal_tunda)->format('Y-m-d\TH:i') : '' }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="catatan-{{ $item->id }}">Catatan
                                            Kegiatan</label>
                                        <textarea class="form-control" placeholder="Masukan Catatan Kegiatan" name="catatan"
                                            id="catatan-{{ $item->id }}" required>{{ $item->catatan }}</textarea>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Update changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete Jadwal -->
    @foreach ($jadwals as $item)
        <div id="DeletejadwalModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="DeletejadwalModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="DeletejadwalModalTitle-{{ $item->id }}">Hapus Jadwal Kegiatan
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('jadwalkatar.destroy_katar', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <div class="p-3 text-center">
                                <i class="ti ti-alert-triangle" style="font-size: 4rem; color: #dc3545;"></i>
                                <h5 class="mt-3">
                                    Yakin ingin menghapus jadwal
                                    <br>
                                    <strong>"{{ $item->nama_kegiatan }}"</strong>?
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

    @foreach ($jadwals as $item)
        <div id="DetailjadwalModal-{{ $item->id }}" class="modal fade" tabindex="-1"
            aria-labelledby="DetailjadwalModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content shadow-lg border-0">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Detail Jadwal Kegiatan katar Anyelir RW 12</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Kegiatan</label>
                                    <input type="text" class="form-control bg-light"
                                        value="{{ $item->nama_kegiatan ?? '-' }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Kategori Kegiatan</label>
                                    <input type="text" class="form-control bg-light"
                                        value="{{ $item->kategori ?? '-' }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Target Peserta Kegiatan</label>
                                    <input type="text" class="form-control bg-light"
                                        value="{{ $item->target_peserta ?? '-' }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Deskripsi Kegiatan</label>
                                    <textarea class="form-control bg-light" rows="3" readonly>{{ $item->deskripsi ?? '-' }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border-start ps-3">
                                    <h6 class="fw-bold mb-3 text-primary">🗂️ Data Tanggal</h6>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Tanggal Mulai Kegiatan</label>
                                        {{-- Gabungkan format Carbon ke dalam 'value' input --}}
                                        <input type="text" class="form-control bg-light"
                                            value="{{ $item->tanggal_mulai ? \Carbon\Carbon::parse($item->tanggal_mulai)->isoFormat('dddd, D MMMM YYYY [pukul] HH:mm') : '-' }}"
                                            readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Tanggal Selesai Kegiatan</label>
                                        <input type="text" class="form-control bg-light"
                                            value="{{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->isoFormat('dddd, D MMMM YYYY [pukul] HH:mm') : '-' }}"
                                            readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Status Kegiatan</label>
                                        <input type="text" class="form-control bg-light"
                                            value="{{ $item->status ?? '-' }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Tanggal Tunda Kegiatan</label>
                                        <input type="text" class="form-control bg-light"
                                            value="{{ $item->tanggal_tunda ? \Carbon\Carbon::parse($item->tanggal_tunda)->isoFormat('dddd, D MMMM YYYY [pukul] HH:mm') : '-' }}"
                                            readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Catatan Kegiatan</label>
                                        <input type="text" class="form-control bg-light"
                                            value="{{ $item->catatan ?? '-' }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Tutup</button>
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

        // Pastikan kedua elemen ada
        if (!selectEl || !inputEl) {
            console.warn(`Elemen ${selectId} atau ${inputId} tidak ditemukan.`);
            return;
        }

        function toggleInput() {
            if (selectEl.value === 'Lainnya') {
                inputEl.classList.remove('d-none');
                inputEl.required = true;
            } else {
                inputEl.classList.add('d-none');
                inputEl.required = false;
                inputEl.value = ''; // Kosongkan nilainya
            }
        }
        selectEl.addEventListener('change', toggleInput);
        toggleInput();
    }

    function togglePublishedAtCreate(status) {
        const group = document.getElementById('publishedAtCreateGroup');
        if (group) {
            group.style.display = (status === 'Ditunda') ? 'block' : 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        setupLainnyaToggle('select_kategori', 'input_kategori_lainnya');
        setupLainnyaToggle('select_target', 'input_target_lainnya');

        const statusCreateSelect = document.querySelector('#AddjadwalModal select[name="status"]');
        if (statusCreateSelect) {
            togglePublishedAtCreate(statusCreateSelect.value);
            statusCreateSelect.addEventListener('change', function() {
                togglePublishedAtCreate(this.value);
            });
        }
    });

    function togglePublishedAt(status, id) {
        const group = document.getElementById('publishedAtGroup-' + id);
        if (group) {
            group.style.display = (status === 'Ditunda') ? 'block' : 'none';
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        @if (isset($jadwals)) // Cek jika variabel $jadwals ada (di halaman index)
            @foreach ($jadwals as $item)
                togglePublishedAt('{{ $item->status }}', {{ $item->id }});
            @endforeach
        @endif
    });

    function togglePublishedAtUpdate(statusValue, itemId) {
        // Cari grup input tanggal tunda yang spesifik untuk item ini
        const group = document.getElementById('publishedAtUpdateGroup-' + itemId);

        if (group) {
            if (statusValue === 'Ditunda') {
                group.style.display = 'block';
            } else {
                group.style.display = 'none';
            }
        }
    }
</script>


@extends('admin-temp.footer_katar')
