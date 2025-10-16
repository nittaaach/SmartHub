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
                                                    {{ $item->syarat_layanan->nama_dokumen ?? '-' }}
                                                </td>
                                                <td>
                                                    {{ $item->syarat_layanan->lembaran ?? '-' }}
                                                    {{-- @foreach ($item->syarat_layanan as $syarat)
                                                        <div>{{ $syarat->lembaran }}</div>
                                                    @endforeach --}}
                                                </td>
                                                <td>
                                                    {{ $item->syarat_layanan->jenis_berkas == 1 ? 'Asli' : 'Foto Copy' ?? '-' }}
                                                    {{-- @foreach ($item->syarat_layanan as $syarat)
                                                        <div>
                                                            {{ $syarat->jenis_berkas == 1 ? 'Asli' : 'Foto Copy' }}
                                                        </div>
                                                    @endforeach --}}
                                                </td>
                                                <td>
                                                    {{ $item->syarat_layanan->status == 1 ? 'Wajib' : 'Optional' ?? '-' }}
                                                    {{-- @foreach ($item->syarat_layanan as $syarat)
                                                        <div>
                                                            {{ $syarat->status == 1 ? 'Wajib' : 'Optional' }}
                                                        </div>
                                                    @endforeach --}}
                                                </td>
                                                <td>
                                                    {{ $item->template_surat->nama_template ?? '-' }}
                                                    {{-- @foreach ($item->template_surat as $template)
                                                        <div>{{ $template->nama_template }}</div>
                                                    @endforeach --}}
                                                </td>
                                                <td>
                                                    @php
                                                        $filePath = $item->template_surat->file ?? null;
                                                        $fileName = $filePath ? basename($filePath) : '-';
                                                        // Potong nama file jadi max 30 karakter
                                                        $shortName =
                                                            strlen($fileName) > 30
                                                                ? substr($fileName, 0, 30) . '...'
                                                                : $fileName;
                                                    @endphp

                                                    @if ($filePath)
                                                        <span title="{{ $fileName }}">{{ $shortName }}</span>
                                                        <div>
                                                            <a href="{{ asset('storage/' . $filePath) }}" target="_blank"
                                                                class="text-primary">
                                                                Lihat File
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="text-muted">Tidak ada file</div>
                                                    @endif

                                                    {{-- @foreach ($item->template_surat as $template)
                                                        @if ($template->file)
                                                            <div>
                                                                <a href="{{ asset('storage/' . $template->file) }}"
                                                                    target="_blank">
                                                                    Lihat File
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div>Tidak ada file</div>
                                                        @endif
                                                    @endforeach --}}
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

                            {{-- NAMA LAYANAN --}}
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Layanan</label>
                                <input type="text" class="form-control" name="nama_layanan"
                                    placeholder="Masukan Nama Layanan" required>
                            </div>

                            {{-- DESKRIPSI LAYANAN --}}
                            <div class="form-group mb-3">
                                <label class="form-label">Deskripsi Layanan</label>
                                <textarea class="form-control" placeholder="Masukan Deskripsi Layanan" name="deskripsi" required></textarea>
                            </div>

                            {{-- STATUS LAYANAN --}}
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

                            {{-- DROPDOWN SYARAT LAYANAN --}}
                            <div class="form-group mb-4">
                                <label class="form-label">Syarat Dokumen/Berkas</label>
                                <select class="form-select" name="id_syarat" required>
                                    <option value="">-- Pilih Syarat Layanan --</option>
                                    @foreach ($syarat_layanan as $syarat)
                                        <option value="{{ $syarat->id }}">
                                            {{ $syarat->nama_dokumen }}
                                            - {{ $syarat->lembaran }} lembar
                                            ({{ $syarat->jenis_berkas == 1 ? 'Asli' : 'Fotokopi' }})
                                            -
                                            ({{ $syarat->status == 1 ? 'Wajib' : 'Optional' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <hr>
                            <h6 class="fw-bold mb-3">📄 Pilih Template Surat</h6>

                            {{-- DROPDOWN TEMPLATE SURAT --}}
                            <div class="form-group mb-4">
                                <label class="form-label">Template Surat</label>
                                <select class="form-select" name="id_template" required>
                                    <option value="">-- Pilih Template Surat --</option>
                                    @foreach ($template_surat as $template)
                                        <option value="{{ $template->id }}">
                                            {{ $template->nama_template }} - {{ $template->keterangan }}
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

                        {{-- Data syarat_layanan --}}
                        <h6 class="fw-bold text-primary">Data Syarat Layanan</h6>

                        <div class="form-group mb-3">
                            <label>Nama Dokumen/Berkas</label>
                            <input type="text" class="form-control" name="nama_dokumen" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Banyak Lembaran</label>
                            <input type="text" class="form-control" name="lembaran" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Jenis Berkas</label>
                            <select class="form-select" name="jenis_berkas" required>
                                <option value="">-- Pilih Jenis Berkas --</option>
                                <option value="1">Asli</option>
                                <option value="0">Fotocopy</option>
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

                        {{-- Data template_surat --}}
                        <hr>
                        <h6 class="fw-bold text-primary">Data Template Surat</h6>

                        <div class="form-group mb-3">
                            <label>Nama Template</label>
                            <input type="text" class="form-control" name="nama_template" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload File</label>
                            <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx">
                            <small class="text-muted">Format: .pdf, .doc, .docx</small>
                        </div>
                        <div class="form-group mb-3">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan" placeholder="Masukkan Keterangan Template" required></textarea>
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

    <!-- Modal Update KTP -->
    @foreach ($layanan as $item)
        <div id="UpdatelayananModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="UpdatelayananModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
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

                                {{-- === Data Layanan === --}}
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

                                {{-- === Data Persyaratan === --}}
                                @php
                                    $syarat = $item->syarat_layanan->first();
                                @endphp

                                <div class="form-group mb-3">
                                    <label class="form-label">Nama Dokumen/Berkas</label>
                                    <input type="text" class="form-control" name="nama_dokumen"
                                        value="{{ $syarat?->nama_dokumen }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Lembaran</label>
                                    <input type="text" class="form-control" name="lembaran"
                                        value="{{ $syarat?->lembaran }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Jenis Berkas</label>
                                    <select class="form-select" name="jenis_berkas" required>
                                        <option value="1" {{ $syarat?->jenis_berkas == 1 ? 'selected' : '' }}>Asli
                                        </option>
                                        <option value="2" {{ $syarat?->jenis_berkas == 2 ? 'selected' : '' }}>
                                            Foto Copy</option>
                                    </select>
                                </div>

                                {{-- === Template Surat === --}}
                                @php
                                    $template = $item->template_surat->first();
                                @endphp

                                <div class="form-group mb-3">
                                    <label class="form-label">Nama Template Surat</label>
                                    <input type="text" class="form-control" name="nama_template"
                                        value="{{ $template?->nama_template }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">File Template (kosongkan jika tidak diubah)</label>
                                    <input type="file" name="file" class="form-control">
                                    @if ($template?->file)
                                        <span>File saat ini: <a href="{{ asset('storage/' . $template->file) }}"
                                                target="_blank">Lihat</a></span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" required>{{ $template?->keterangan }}</textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Status Aktif Template</label>
                                    <select class="form-select" name="status_aktif_template" required>
                                        <option value="1" {{ $template?->status_aktif == 1 ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="0" {{ $template?->status_aktif == 0 ? 'selected' : '' }}>Tidak
                                            Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
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
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@extends('admin-temp.footer_rw')
