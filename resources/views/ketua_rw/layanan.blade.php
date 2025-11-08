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
                        <li class="breadcrumb-item" aria-current="page">Layanan Rukun Warga</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Layanan Rukun Warga.</h2>
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
                                        data-bs-target="#AddlayananModal">
                                        Tambah Layanan
                                    </button>
                                </div>
                                <table id="basic-btn-rw" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Layanan</th>
                                            <th>Deskripsi</th>
                                            <th>Status Aktif</th>
                                            <th>Nama Dokumen</th>
                                            <th>Lembaran</th>
                                            <th>Jenis Berkas</th>
                                            <th>Status Berkas</th>
                                            <th>Nama Template File</th>
                                            <th>Template File</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($layanan as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_layanan }}</td>
                                                <td>{{ $item->deskripsi }}</td>
                                                <td>
                                                    @if ($item->status_aktif == 1)
                                                        <span class="badge bg-success">Aktif</span>
                                                    @else
                                                        <span class="badge bg-secondary">Nonaktif</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($item->syaratLayanans as $syarat)
                                                            <li>{{ $syarat->nama_dokumen }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($item->syaratLayanans as $syarat)
                                                            <li>{{ $syarat->lembaran ?? '-' }} lembar</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($item->syaratLayanans as $syarat)
                                                            <li>{{ $syarat->jenis_berkas == 1 ? 'Asli' : 'Foto Copy' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($item->syaratLayanans as $syarat)
                                                            <li>{{ $syarat->status == 1 ? 'Wajib' : 'Optional' }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($item->syaratLayanans as $syarat)
                                                            @foreach ($syarat->template_surat as $template)
                                                                <li>{{ $template->nama_template }}</li>
                                                            @endforeach
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($item->syaratLayanans as $syarat)
                                                            @foreach ($syarat->template_surat as $template)
                                                                <li>
                                                                    @if ($template->file)
                                                                        <a href="{{ asset('storage/' . $template->file) }}"
                                                                            target="_blank" class="text-primary">
                                                                            Lihat File
                                                                        </a>
                                                                    @else
                                                                        <div class="text-muted">Tidak ada file</div>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#UpdatelayananModal-{{ $item->id }}">
                                                        Update
                                                    </button>
                                                    <button type="button" class="btn btn-danger me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#DeletelayananModal-{{ $item->id }}">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Layanan</th>
                                            <th>Deskripsi</th>
                                            <th>Status Aktif</th>
                                            <th>Nama Dokumen</th>
                                            <th>Lembaran</th>
                                            <th>Jenis Berkas</th>
                                            <th>Status Berkas</th>
                                            <th>Nama Template File</th>
                                            <th>Template File</th>
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

    <!-- Modal Tambah Layanan -->
    <div id="AddlayananModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddlayananModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Form Tambah Layanan RW 12</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('layanan.store_rw') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Layanan</label>
                                <input type="text" class="form-control" name="nama_layanan"
                                    placeholder="Masukan Nama Layanan" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Deskripsi Layanan</label>
                                <textarea class="form-control" placeholder="Masukan Deskripsi Layanan" name="deskripsi" required></textarea>
                            </div>
                            <div class="form-group mb-4">
                                <label class="form-label">Status Layanan</label>
                                <select class="form-select" name="status_aktif" required>
                                    <option value="">-- Pilih Status Aktif Layanan --</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>

                            <hr>
                            <h6 class="fw-bold mb-3">🗂️ Pilih Syarat Layanan</h6>
                            <div class="form-group mb-4">
                                <label class="form-label">Syarat Dokumen/Berkas</label>
                                <select class="form-control choices-multiple-remove-button" name="id_syarat[]" multiple
                                    required>
                                    @foreach ($syarat_layanan as $syarat)
                                        <option value="{{ $syarat->id }}">
                                            {{ $syarat->nama_dokumen }}
                                            - {{ $syarat->lembaran }} lembar
                                            ({{ $syarat->jenis_berkas == 1 ? 'Asli' : 'Fotokopi' }})
                                            - ({{ $syarat->status == 1 ? 'Wajib' : 'Optional' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="text-end">
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#AddTemplateSyaratModal">
                                    + Tambah Syarat Layanan & Template Baru
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Layanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Syarat dan Template Surat -->
    <div id="AddTemplateSyaratModal" class="modal fade" tabindex="-1" aria-labelledby="AddTemplateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('layanan.store_st') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="AddTemplateModalLabel">Tambah Syarat Layanan dan Template Surat Baru
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        {{-- Data syarat_layanan (INI WAJIB DIISI) --}}
                        <h6 class="fw-bold text-primary">Data Syarat Layanan</h6>

                        <div class="form-group mb-3">
                            <label>Nama Dokumen/Berkas</label>
                            <input type="text" class="form-control" name="nama_dokumen" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Banyak Lembaran</label>
                            {{-- 'required' DIHAPUS agar fleksibel --}}
                            <input type="text" class="form-control" name="lembaran" placeholder="Contoh: 1">
                        </div>
                        <div class="form-group mb-3">
                            <label>Jenis Berkas</label>
                            <select class="form-select" name="jenis_berkas" required>
                                <option value="">-- Pilih Jenis Berkas --</option>
                                <option value="1">Asli</option>
                                <option value="0">Fotokopi</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Status Berkas</label>
                            <select name="status" class="form-select" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="1">Wajib</option>
                                <option value="0">Optional</option>
                            </select>
                        </div>

                        {{-- Data template_surat (INI OPSIONAL) --}}
                        <hr>
                        <h6 class="fw-bold text-primary">Data Template Surat (Opsional)</h6>

                        <div class="form-group mb-3">
                            <label>Nama Template</label>
                            {{-- 'required' DIHAPUS --}}
                            <input type="text" class="form-control" name="nama_template"
                                placeholder="Kosongkan jika tidak ada template">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload File</label>
                            <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx">
                            <small class="text-muted">Format: .pdf, .doc, .docx</small>
                        </div>
                        <div class="form-group mb-3">
                            <label>Keterangan</label>
                            {{-- 'required' DIHAPUS --}}
                            <textarea class="form-control" name="keterangan" placeholder="Masukkan Keterangan Template"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Update layanan -->
    @foreach ($layanan as $item)
        <div id="UpdatelayananModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="UpdatelayananModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Form Update Layanan RW 12</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('layanan.update_rw', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label class="form-label">Nama Layanan</label>
                                    <input type="text" class="form-control" name="nama_layanan"
                                        value="{{ $item->nama_layanan }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Deskripsi Layanan</label>
                                    <textarea class="form-control" name="deskripsi" required>{{ $item->deskripsi }}</textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Status Layanan</label>
                                    <select class="form-select" name="status_aktif" required>
                                        <option value="1" {{ $item->status_aktif == 1 ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="0" {{ $item->status_aktif == 0 ? 'selected' : '' }}>Tidak
                                            Aktif</option>
                                    </select>
                                </div>

                                <hr>
                                <h6 class="fw-bold mb-3">🗂️ Pilih Syarat Layanan</h6>

                                @php
                                    $attachedSyaratIds = $item->syaratLayanans->pluck('id');
                                @endphp

                                <div class="form-group mb-4">
                                    <label class="form-label">Syarat Dokumen/Berkas</label>
                                    <select class="form-control choices-multiple-remove-button" name="id_syarat[]"
                                        multiple required>
                                        @foreach ($syarat_layanan as $syarat)
                                            <option value="{{ $syarat->id }}"
                                                @if ($attachedSyaratIds->contains($syarat->id)) selected @endif>
                                                {{ $syarat->nama_dokumen }}
                                                - {{ $syarat->lembaran }} lembar
                                                ({{ $syarat->jenis_berkas == 1 ? 'Asli' : 'Fotokopi' }})
                                                - ({{ $syarat->status == 1 ? 'Wajib' : 'Optional' }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete layanan -->
    @foreach ($layanan as $item)
        <div id="DeletelayananModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="DeletelayananModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="DeletelayananModalTitle-{{ $item->id }}">Hapus Layanan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('layanan.destroy_rw', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <div class="p-3 text-center">
                                <p>Apakah kamu yakin ingin menghapus layanan berikut?</p>
                                <h5 class="fw-bold text-danger">{{ $item->nama_layanan }}</h5>

                                <p class="text-muted mt-2">
                                    Data layanan ini akan dihapus dari sistem, namun dokumen atau template terkait tetap
                                    tersimpan.
                                </p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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
