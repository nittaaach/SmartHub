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
                        <li class="breadcrumb-item" aria-current="page">Management Pengguna</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Management Pengguna.</h2>
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
                                <table id="basic-btn-ktprw" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($management as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->displayed_role }}</td>
                                                <td>{{ $item->created_at }}</td>
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
                                                    <button type="button" class="btn btn-info me-3" data-bs-toggle="modal"
                                                        data-bs-target="#DetailpenggunaModal-{{ $item->id }}">
                                                        Detail
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Created At</th>
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

    <!-- Modal Tambah Pengguna -->
    <div id="AddpenggunaModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddpenggunaModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Form Tambah Pengguna RW 12</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card">

                        <form action="{{ route('management_pengguna.store_rw') }}" method="POST"
                            enctype="multipart/form-data" class="modal-content">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" placeholder="Masukan name Pengguna"
                                        name="name" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" placeholder="Masukan Email Pengguna"
                                        name="email" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">No. Telepon</label>
                                    <input type="text" class="form-control" placeholder="Masukan Nomor Telepon"
                                        name="notelp" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" placeholder="Masukan Alamat" name="alamat" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" placeholder="Masukan Password"
                                        name="password" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="role">Role (Opsional)</label>
                                    <select class="form-select" id="role" name="role">
                                        <option value="">-- Pilih Role (boleh dikosongkan) --</option>
                                        @foreach ($drole as $item)
                                            <option value="{{ $item->id }}">{{ ucfirst($item->role) }}</option>
                                        @endforeach
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

    <!-- Modal Update Pengguna -->
    @foreach ($management as $item)
        <div id="UpdatepenggunaModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="UpdatepenggunaModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Form Update Pengguna RW 12</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <form action="{{ route('management_pengguna.update_rw', $item->id) }}" method="POST"
                                enctype="multipart/form-data" class="modal-content">

                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $item->name }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $item->email }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">No. Telepon</label>
                                        <input type="text" class="form-control" name="notelp"
                                            value="{{ $item->datadiri?->notelp }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Alamat</label>
                                        <textarea class="form-control" name="alamat" required>{{ $item->datadiri?->alamat }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Password (opsional)</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Kosongkan jika tidak ingin mengubah password">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="role">Role</label>
                                        <select class="form-select" id="role" name="role" required>
                                            <option value="">-- Pilih Role --</option>
                                            @foreach ($drole as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $role->id == ($item->drole->role ?? null) ? 'selected' : '' }}>
                                                    {{ ucfirst($role->role) }}
                                                </option>
                                            @endforeach
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

    <!-- Modal Delete Pengguna -->
    @foreach ($management as $item)
        <div id="DeletepenggunaModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="DeletepenggunaModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="DeletepenggunaModalTitle-{{ $item->id }}">Hapus Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('management_pengguna.destroy_rw', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-3">
                                <h5>Yakin ingin menghapus pengguna
                                    <strong>{{ $item->name }}</strong>?
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

    <!-- Modal Detail Pengguna -->
    @foreach ($management as $item)
        <div id="DetailpenggunaModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="DetailpenggunaModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="DeletelayananModalTitle-{{ $item->id }}">Detail Pengguna</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">

                                <div class="form-group mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" value="{{ $item->name ?? '-' }}"
                                        readonly>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="{{ $item->email ?? '-' }}"
                                        readonly>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">No. Telepon</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->datadiri?->notelp ?? '-' }}" readonly>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" readonly>{{ $item->datadiri?->alamat ?? '-' }}</textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Role</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->userRolePivot?->drole['role'] ?? '-' }}" readonly>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
