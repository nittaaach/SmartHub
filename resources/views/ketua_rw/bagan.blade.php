@extends('admin-temp.layout_rw')
@section('content_admin')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0)">Pages</a></li>
                        <li class="breadcrumb-item" aria-current="page">Bagan Rukun Warga</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Bagan Rukun Warga.</h2>
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
                                        data-bs-target="#AddbaganModal">
                                        Tambah Bagan
                                    </button>
                                </div>
                                <table id="basic-btn-rw" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto Struktural</th>
                                            <th>Tingkatan</th>
                                            <th>Deskripsi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($bagan as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($item->fotobagan)
                                                        <img src="{{ asset('storage/' . $item->fotobagan) }}" width="200"
                                                            class="img-thumbnail" style="cursor: pointer;"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#PreviewFotoModal-{{ $item->id }}">
                                                    @endif
                                                </td>
                                                <td>{{ $item->tingkatan }}</td>
                                                <td>{{ $item->deskripsi }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#UpdatebaganModal-{{ $item->id }}">
                                                        Update
                                                    </button>
                                                    <button type="button" class="btn btn-danger me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#DeletebaganModal-{{ $item->id }}">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto Struktural</th>
                                            <th>Deskripsi</th>
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
    @foreach ($bagan as $item)
        <!-- Modal Preview Foto -->
        <div class="modal fade" id="PreviewFotoModal-{{ $item->id }}" tabindex="-1"
            aria-labelledby="PreviewFotoLabel-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="PreviewFotoLabel-{{ $item->id }}">Preview Foto bagan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('storage/' . $item->fotobagan) }}" class="img-fluid rounded" alt="Foto bagan">
                        <p class="mt-3 text-muted">{{ $item->tingkatan }}-{{ $item->deskripsi }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Tambah bagan -->
    <div id="AddbaganModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddbaganModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Form Tambah bagan RW 12</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <form action="{{ route('bagan.store_bagan') }}" method="POST" enctype="multipart/form-data"
                            class="modal-content">
                            @csrf
                            <div class="card-body">

                                <div class="form-group mb-4">
                                    <label class="form-label">Foto Kegiatan</label>
                                    <input type="file" name="fotobagan" class="form-control" accept="image/*" required>
                                    <small class="text-muted">Format: .jpg, .jpeg, .png (max 2048)</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Tingkatan</label>
                                    <select class="form-control" id="tingkatan_add" name="tingkatan" required>
                                        <option value="">-- Pilih Kategori Tingkatan --</option>
                                        <option value="Rukun Tetangga">Rukun Tetangga (RT)</option>
                                        <option value="Rukun Warga">Rukun Warga (RW)</option>
                                        <option value="PKK Anyelir">PKK Anyelir (PKK)</option>
                                        <option value="Karang Taruna">Karang Taruna (KATAR)</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    {{-- <input type="text" class="form-control" name="deskripsi"
                                        placeholder="Masukan deskripsi"> --}}
                                    <textarea class="form-control" placeholder="Masukan Deskripsi" id="deskripsi_input" name="deskripsi"></textarea>
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

    <!-- Modal Update bagan -->
    @foreach ($bagan as $item)
        <div id="UpdatebaganModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="UpdatebaganModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Form Update bagan RW 12</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <form action="{{ route('bagan.update_bagan', $item->id) }}" method="POST"
                                enctype="multipart/form-data" class="modal-content">

                                @csrf
                                @method('PUT')
                                <div class="card-body">

                                    <div class="form-group">
                                        <label class="form-label">Foto Kegiatan (biarkan kosong jika tidak diganti)</label>
                                        <input type="file" name="fotobagan" class="form-control" accept="image/*">
                                        <small class="text-muted">Format: .jpg, .jpeg, .png (max 2048)</small>
                                        @if ($item->fotobagan)
                                            <div class="mt-2 text-center">
                                                <img src="{{ asset('storage/' . $item->fotobagan) }}" alt="Foto Lama"
                                                    width="150" class="img-thumbnail">
                                                <p class="text-muted mt-1">Foto Saat Ini</p>
                                            </div>
                                        @endif
                                        @error('fotobagan')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Tingkatan</label>
                                        {{-- FIX: Ganti class="form-select" jadi "form-control" --}}
                                        <select class="form-control" id="tingkatan_update-{{ $item->id }}"
                                            name="tingkatan" required> {{ $item->tingkatan }}
                                            <option value="">-- Pilih Kategori Tingkatan --</option>
                                            <option value="Rukun Tetangga (RT)"
                                                {{ $item->tingkatan == 'Rukun Tetangga' ? 'selected' : '' }}>Rukun
                                                Tetangga (RT)</option>
                                            <option value="Rukun Warga (RW)"
                                                {{ $item->tingkatan == 'Rukun Warga' ? 'selected' : '' }}>Rukun
                                                Warga (RW)</option>
                                            <option value="PKK Anyelir"
                                                {{ $item->tingkatan == 'PKK Anyelir' ? 'selected' : '' }}>PKK
                                                Anyelir (PKK)</option>
                                            <option value="Karang Taruna (KATAR)"
                                                {{ $item->tingkatan == 'Karang Taruna' ? 'selected' : '' }}>
                                                Karang Taruna (KATAR)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Deskripsi</label>
                                        {{-- <input type="text" class="form-control" placeholder="Masukan deskripsi"
                                            name="deskripsi" value="{{ $item->deskripsi }}"> --}}
                                        <textarea class="form-control" placeholder="Masukan Deskripsi" name="deskripsi">{{ $item->deskripsi }}</textarea>
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

    <!-- Modal Delete bagan -->
    @foreach ($bagan as $item)
        <div id="DeletebaganModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="DeletebaganModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="DeletelayananModalTitle-{{ $item->id }}">Hapus Foto Kegiatan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('bagan.destroy_bagan', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-3">
                                <div class="form-group">
                                    <label class="form-label">Foto Kegiatan</label>
                                    @if ($item->fotobagan)
                                        <div class="mt-2 text-center">
                                            <img src="{{ asset('storage/' . $item->fotobagan) }}" alt="Foto Lama"
                                                width="150" class="img-thumbnail">
                                            <p class="text-muted mt-1">Foto Saat Ini</p>
                                        </div>
                                    @endif

                                    @error('fotobagan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <h5>Yakin ingin menghapus Bagan
                                    <strong>{{ $item->tingkatan }}</strong>?
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
