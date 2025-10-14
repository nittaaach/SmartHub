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
                        <li class="breadcrumb-item" aria-current="page">Penduduk</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Penduduk.</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="ktp-rw12-tab" data-bs-toggle="pill" href="#ktp-rw12" role="tab"
                aria-controls="ktp-rw12" aria-selected="true">KTP RW 12</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="non-ktp-tab" data-bs-toggle="pill" href="#non-ktp" role="tab"
                aria-controls="non-ktp" aria-selected="false">Non KTP RW 12</a>
        </li>
    </ul>
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
                                <h5 class="mb-3">KTP RW 12</h5>
                                <table id="basic-btn-ktprw" class="table table-striped table-bordered nowrap">
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
                                        @foreach ($data_ktp as $item)
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
                                                        data-bs-target="#UpdatektpModal-{{ $item->id }}">
                                                        Update
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            {{-- <th>No</th> --}}
                                            <th colspan="2">Total</th>
                                            <th>{{ $data_ktp->sum('laki_laki') }}</th>
                                            <th>{{ $data_ktp->sum('perempuan') }}</th>
                                            <th>{{ $data_ktp->sum('jumlah') }}</th>
                                            <th>{{ $data_ktp->sum('jumlah_kk') }}</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="non-ktp" role="tabpanel" aria-labelledby="non-ktp-tab">
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
                </div>
            </div>
        </div>
    </div>
    <!-- Alternative Pagination table end -->

    <!-- Modal Update KTP -->
    @foreach ($data_ktp as $item)
        <div id="UpdatektpModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="UpdatektpModalTitlem-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="UpdatektpModalTitle">Form Update Kependudukan RW 12</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">

                            <form action="{{ route('statispend.update_ktp', $item->id) }}" method="POST"
                                enctype="multipart/form-data" class="modal-content">

                                @csrf
                                @method('PUT')
                                <div class="card-body">

                                    <div class="form-group">
                                        <label class="form-label" for="select rt">Select RT</label>
                                        <select class="form-select" id="select_rt" name="rt" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            <option value="1" {{ $item->rt == '1' ? 'selected' : '' }}>Rukun Warga 01
                                            </option>
                                            <option value="2" {{ $item->rt == '2' ? 'selected' : '' }}>Rukun Warga 02
                                            </option>
                                            <option value="3" {{ $item->rt == '3' ? 'selected' : '' }}>Rukun Warga 03
                                            </option>
                                            <option value="4" {{ $item->rt == '4' ? 'selected' : '' }}>Rukun Warga 04
                                            </option>
                                            <option value="5" {{ $item->rt == '5' ? 'selected' : '' }}>Rukun Warga 05
                                            </option>
                                            <option value="6" {{ $item->rt == '6' ? 'selected' : '' }}>Rukun Warga 06
                                            </option>
                                            <option value="7" {{ $item->rt == '7' ? 'selected' : '' }}>Rukun Warga 07
                                            </option>
                                            <option value="8" {{ $item->rt == '8' ? 'selected' : '' }}>Rukun Warga 08
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Laki-Laki</label>
                                        <input type="number" class="form-control form-control"
                                            placeholder="Masukan Jumlah Penduduk Laki-Laki"
                                            value="{{ $item->laki_laki }}" name="laki_laki" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Perempuan</label>
                                        <input type="number" class="form-control form-control"
                                            placeholder="Masukan Jumlah Penduduk Perempuan"
                                            value="{{ $item->perempuan }}" name="perempuan" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Total Kartu Keluarga</label>
                                        <input type="number" class="form-control form-control"
                                            placeholder="Masukan Jumlah Kartu Keluarga" value="{{ $item->jumlah_kk }}"
                                            name="jumlah_kk" required>
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

    <!-- Modal Update Non KTP -->
    @foreach ($data_nonktp as $item)
        <div id="UpdatenonModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="UpdatenonModalTitlem-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="DeletelayananModalTitle-{{ $item->id }}">Hapus Layanan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">

                            <form action="{{ route('statispend.update_nonktp', $item->id) }}" method="POST"
                                enctype="multipart/form-data" class="modal-content">

                                @csrf
                                @method('PUT')
                                <div class="card-body">

                                    <div class="form-group">
                                        <label class="form-label" for="select rt">Select RT</label>
                                        <select class="form-select" id="select_rt" name="rt" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            <option value="1" {{ $item->rt == '1' ? 'selected' : '' }}>Rukun Warga 01
                                            </option>
                                            <option value="2" {{ $item->rt == '2' ? 'selected' : '' }}>Rukun Warga 02
                                            </option>
                                            <option value="3" {{ $item->rt == '3' ? 'selected' : '' }}>Rukun Warga 03
                                            </option>
                                            <option value="4" {{ $item->rt == '4' ? 'selected' : '' }}>Rukun Warga 04
                                            </option>
                                            <option value="5" {{ $item->rt == '5' ? 'selected' : '' }}>Rukun Warga 05
                                            </option>
                                            <option value="6" {{ $item->rt == '6' ? 'selected' : '' }}>Rukun Warga 06
                                            </option>
                                            <option value="7" {{ $item->rt == '7' ? 'selected' : '' }}>Rukun Warga 07
                                            </option>
                                            <option value="8" {{ $item->rt == '8' ? 'selected' : '' }}>Rukun Warga 08
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Laki-Laki</label>
                                        <input type="number" class="form-control form-control"
                                            placeholder="Masukan Jumlah Penduduk Laki-Laki"
                                            value="{{ $item->laki_laki }}" name="laki_laki" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Perempuan</label>
                                        <input type="number" class="form-control form-control"
                                            placeholder="Masukan Jumlah Penduduk Perempuan"
                                            value="{{ $item->perempuan }}" name="perempuan" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Total Kartu Keluarga</label>
                                        <input type="number" class="form-control form-control"
                                            placeholder="Masukan Jumlah Kartu Keluarga" value="{{ $item->jumlah_kk }}"
                                            name="jumlah_kk" required>
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
@endsection
@extends('admin-temp.footer_rw')
