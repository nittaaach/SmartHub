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
                        <li class="breadcrumb-item" aria-current="page">Berkas Rukun Warga</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Berkas Rukun Warga.</h2>
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
                                        data-bs-target="#AddberkasModal">
                                        Tambah Berkas
                                    </button>
                                </div>
                                <table id="basic-btn-rw" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Berkas</th>
                                            <th>Lembaran</th>
                                            <th>Jenis Berkas</th>
                                            <th>Status Berkas</th>
                                            <th>Nama Template File</th>
                                            <th>Template File</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($syarat_layanan as $item)
                                            @php
                                                // Ambil HANYA template PERTAMA yang terhubung, atau null jika tidak ada
                                                $template = $item->template_surat->first();
                                            @endphp

                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_dokumen }}</td>
                                                <td>{{ $item->lembaran }}</td>
                                                <td>{{ $item->jenis_berkas == 1 ? 'Asli' : 'Foto Copy' }}</td>
                                                <td>{{ $item->status == 1 ? 'Wajib' : 'Optional' }}</td>
                                                <td>
                                                    {{ $template?->nama_template ?? '-' }}
                                                </td>
                                                <td>
                                                    @if ($template?->file)
                                                        <a href="{{ asset('storage/' . $template->file) }}"
                                                            target="_blank">Lihat File</a>
                                                    @else
                                                        <span class="text-muted">Tidak ada file</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $template?->keterangan ?? '-' }}
                                                </td>
                                                <td>
                                                     <button type="button" class="btn btn-primary me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#UpdateberkasModal-{{ $item->id }}">Update</button>
                                                     <button type="button" class="btn btn-danger me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#DeleteberkasModal-{{ $item->id }}">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Berkas</th>
                                            <th>Lembaran</th>
                                            <th>Jenis Berkas</th>
                                            <th>Status Berkas</th>
                                            <th>Nama Template File</th>
                                            <th>Template File</th>
                                            <th>Keterangan</th>
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

    <!-- Modal Tambah berkas -->
    <div id="AddberkasModal" class="modal fade" tabindex="-1" aria-labelledby="AddberkasModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Berkas & Template Surat</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('berkas.store_rw') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="modal-body">

                        {{-- Data syarat_layanan --}}
                        <h6 class="fw-bold text-primary">Data Syarat Layanan</h6>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Dokumen</label>
                                <input type="text" name="nama_dokumen" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lembaran</label>
                                <input type="text" name="lembaran" class="form-control">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Jenis Berkas</label>
                            <select name="jenis_berkas" class="form-select" required>
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

                        <div class="mb-3">
                            <label class="form-label">Nama Template Surat</label>
                            <input type="text" name="nama_template" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload File</label>
                            <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx">
                            <small class="text-muted">Format: .pdf, .doc, .docx</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Update Berkas -->
    @foreach ($syarat_layanan as $item)
        <div id="UpdateberkasModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="UpdateberkasModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    {{-- Header Modal --}}
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Update Berkas & Template Surat</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    {{-- Form Update --}}
                    <form action="{{ route('berkas.update_rw', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <div class="card-body">

                                {{-- ===================== BAGIAN SYARAT LAYANAN ===================== --}}
                                <h6 class="fw-bold text-primary">Data Syarat Layanan</h6>

                                <div class="form-group mb-3">
                                    <label class="form-label">Nama Dokumen/Berkas</label>
                                    <input type="text" class="form-control" name="nama_dokumen"
                                        value="{{ $item->nama_dokumen }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Lembaran</label>
                                    <input type="text" class="form-control" name="lembaran"
                                        value="{{ $item->lembaran }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Jenis Berkas</label>
                                    <select class="form-select" name="jenis_berkas" required>
                                        <option value="1" {{ $item->jenis_berkas == 1 ? 'selected' : '' }}>Asli
                                        </option>
                                        <option value="0" {{ $item->jenis_berkas == 0 ? 'selected' : '' }}>Foto Copy
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Status Berkas</label>
                                    <select class="form-select" name="status" required>
                                        <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Wajib</option>
                                        <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Optional
                                        </option>
                                    </select>
                                </div>

                                {{-- ===================== BAGIAN TEMPLATE SURAT ===================== --}}
                                @php
                                    $template = $item->template_surat->first(); // ambil template pertama
                                @endphp

                                <hr>
                                <h6 class="fw-bold text-primary">Data Template Surat</h6>

                                <div class="form-group mb-3">
                                    <label class="form-label">Nama Template Surat</label>
                                    <input type="text" class="form-control" name="nama_template"
                                        value="{{ $template?->nama_template }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">File Template (kosongkan jika tidak diubah)</label>
                                    <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx">
                                    <small class="text-muted">Format: .pdf, .doc, .docx</small>
                                    @if ($template?->file)
                                        <div class="mt-2">
                                            <span>File saat ini:
                                                <a href="{{ asset('storage/' . $template->file) }}" target="_blank"
                                                    class="text-primary">Lihat File</a>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" required>{{ $template?->keterangan }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Footer --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete berkas -->
    @foreach ($syarat_layanan as $item)
        <div id="DeleteberkasModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="DeleteberkasModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="DeleteberkasModalTitle-{{ $item->id }}">Hapus berkas</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('berkas.destroy_rw', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <div class="p-3 text-center">
                                <p>Apakah kamu yakin ingin menghapus berkas berikut?</p>
                                <h5 class="fw-bold text-danger">{{ $item->nama_dokumen }}</h5>

                                <p class="text-muted mt-2">
                                    Data berkas ini akan dihapus dari sistem, namun dokumen atau template terkait tetap
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
