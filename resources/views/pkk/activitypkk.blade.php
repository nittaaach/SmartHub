@extends('admin-temp.head')
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
                        <li class="breadcrumb-item" aria-current="page">Publikasi activities PKK Anyelir</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-judul">
                        <h2 class="mb-0">Publikasi activities PKK Anyelir</h2>
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
                                        data-bs-target="#AddactivitypkkModal">
                                        Tambah Publikasi
                                    </button>
                                </div>
                                <table id="basic-btn-ktprw" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Judul</th>
                                            <th>Tanggal</th>
                                            <th>Penyelenggara</th>
                                            <th>Lokasi</th>
                                            <th>Status</th>
                                            <th>Foto</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($activities as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->kategori }}</td>
                                                <td>{{ $item->judul }}</td>
                                                <td>{{ $item->tanggal_acara }}</td>
                                                <td>{{ $item->penyelenggara }}</td>
                                                <td>{{ $item->lokasi }}</td>
                                                <td>{{ $item->status }}</td>
                                                {{-- <td>{{ $item->deskripsi }}</td> --}}
                                                <td>
                                                    @if ($item->dokumentasi && $item->dokumentasi->isNotEmpty())
                                                        @foreach ($item->dokumentasi as $foto)
                                                            <img src="{{ asset('storage/' . $foto->fotopkk) }}"
                                                                alt="{{ $foto->caption ?? $item->judul }}"
                                                                style="width: 80px; height: 80px; object-fit: cover; margin-right: 5px;">
                                                        @endforeach
                                                    @else
                                                        <span class="text-muted small">Tidak ada foto</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#UpdateactivitypkkModal-{{ $item->id }}">
                                                        Update
                                                    </button>
                                                    <button type="button" class="btn btn-danger me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#DeleteactivitypkkModal-{{ $item->id }}">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Judul</th>
                                            <th>Tanggal</th>
                                            <th>Penyelenggara</th>
                                            <th>Lokasi</th>
                                            <th>Status</th>
                                            <th>Foto</th>
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

    <!-- Modal Tambah activitypkk -->
    <div id="AddactivitypkkModal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="AddactivitypkkModaljudul" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-judul">Form Tambah Publikasi PKK RW 12</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <form action="{{ route('activitypkk.store_pkk') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- 📸 Pilih & Upload Foto Dokumentasi -->
                            <div class="form-group mb-3">
                                <label class="form-label d-block">Foto Dokumentasi</label>

                                <div class="d-flex justify-content-between gap-2 flex-wrap">
                                    <!-- Tombol Pilih Foto -->
                                    <button type="button" class="btn btn-outline-success flex-fill" data-bs-toggle="modal"
                                        data-bs-target="#FotoPickerModal">
                                        Pilih Foto Dokumentasi
                                    </button>

                                    <!-- Tombol Upload Foto -->
                                    <button type="button" class="btn btn-outline-primary flex-fill" data-bs-toggle="modal"
                                        data-bs-target="#AddfotoModal">
                                        + Upload Foto Baru
                                    </button>
                                </div>

                                <small class="text-muted d-block mt-2">Klik untuk memilih dari galeri atau upload foto
                                    baru</small>
                            </div>

                            <!-- 📦 Container untuk dropdown tambahan -->
                            <div id="fotoList" class="d-flex flex-column gap-3"></div>


                            <!-- 📝 Input Data Aktivitas -->
                            <div class="form-group mb-3">
                                <label for="judul">Judul Kegiatan</label>
                                <input type="text" name="judul" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="kategori">Kategori</label>
                                <select class="form-select" name="kategori" id="kategoriSelect" required>
                                    <option value="">-- Pilih Kategori Produk --</option>
                                    <option value="Pelatihan">Pelatihan</option>
                                    <option value="Posyandu">Posyandu</option>
                                    <option value="Bazar">Bazar</option>
                                    <option value="Lainnya">Lainnya (Isi Manual)</option>
                                </select>

                                <!-- Input tambahan kalau pilih "Lainnya" -->
                                <input type="text" class="form-control mt-2 d-none" id="kategoriLainnya"
                                    name="kategori_lainnya" placeholder="Masukkan kategori lainnya">
                            </div>

                            <div class="form-group mb-3">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="penyelenggara">Penyelenggara</label>
                                <input type="text" name="penyelenggara" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="lokasi">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control">
                            </div>

                            <!-- Status -->
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control"
                                    onchange="togglePublishedAtCreate(this.value)" required>
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                    <option value="archived">Archived</option>
                                </select>
                            </div>

                            <!-- Tanggal Posting -->
                            <div class="form-group mb-3" id="publishedAtCreateGroup" style="display: none;">
                                <label>Tanggal Posting</label>
                                <input type="datetime-local" name="tanggal_acara" class="form-control">
                            </div>

                            <!-- ✅ Submit -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Simpan Aktivitas</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="FotoPickerModal" tabindex="-1" aria-labelledby="FotoPickerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-judul" id="FotoPickerModalLabel">Pilih Foto Dokumentasi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- 🔍 Pencarian Caption -->
                    <input type="text" id="fotoSearch" class="form-control mb-3" placeholder="Cari caption foto...">

                    <!-- 📸 Galeri Foto -->
                    <div class="row" id="fotoGallery">
                        @foreach ($fotoList as $foto)
                            <div class="col-md-3 col-sm-4 mb-3 foto-item"
                                data-caption="{{ strtolower($foto->caption ?? '') }}">
                                <label class="d-block border rounded p-2 text-center">
                                    <input type="checkbox" name="fotopkk[]" value="{{ $foto->id }}"
                                        class="form-check-input mb-2">
                                    <img src="{{ asset('storage/' . $foto->fotopkk) }}" class="img-fluid rounded mb-1"
                                        alt="Foto">
                                    <div class="small text-muted">{{ $foto->caption ?? 'Foto #' . $foto->id }}</div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Selesai Pilih</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AddfotoModal" tabindex="-1" aria-labelledby="AddFotoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('activitypkk.store_ft') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-judul" id="AddFotoModalLabel">Upload Foto Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="fotopkk">Pilih Foto</label>
                            <input type="file" name="fotopkk" class="form-control" accept="image/*" required>
                            <small class="text-muted">Format: .jpg, .jpeg, .png (max 2048)</small>
                            <small class="text-muted">Bisa pilih lebih dari satu foto</small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="caption">Caption</label>
                            <input type="text" name="caption" class="form-control"
                                placeholder="Caption untuk semua foto">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Update activitypkk -->
    @foreach ($activities as $item)
        <div id="UpdateactivitypkkModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="UpdateactivitypkkModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="UpdateactivitypkkModalTitle-{{ $item->id }}">
                            Form Edit: {{ $item->judul }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <form action="{{ route('activitypkk.update_pkk', $item->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group mb-3">
                                    <label class="form-label d-block">Foto Dokumentasi</label>

                                    <div class="mb-2">
                                        <small class="text-muted d-block mb-1">Foto saat ini:</small>
                                        <div class="d-flex flex-wrap gap-2 justify-content-center"
                                            id="currentPhotos-{{ $item->id }}">
                                            @forelse ($item->dokumentasi as $foto)
                                                <img src="{{ asset('storage/' . $foto->fotopkk) }}"
                                                    alt="{{ $foto->caption ?? 'Foto' }}"
                                                    title="{{ $foto->caption ?? 'Foto' }}"
                                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                                            @empty
                                                <span class="text-muted small">Belum ada foto.</span>
                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between gap-2 flex-wrap">
                                        <button type="button" class="btn btn-outline-success flex-fill"
                                            data-bs-target="#FotoPickerModal-{{ $item->id }}"
                                            id="openPickerButton-{{ $item->id }}">
                                            Pilih / Ubah Foto
                                        </button>

                                        <button type="button" class="btn btn-outline-primary flex-fill"
                                            data-bs-target="#AddfotoModal" id="openUploadButton-{{ $item->id }}">
                                            + Upload Foto Baru
                                        </button>
                                    </div>
                                </div>

                                <div id="fotoList-{{ $item->id }}" class="d-flex flex-column gap-3">
                                    @foreach ($item->dokumentasi as $foto)
                                        <input type="hidden" name="fotopkk[]" value="{{ $foto->id }}">
                                    @endforeach
                                </div>

                                <div class="form-group mb-3">
                                    <label for="judul-{{ $item->id }}">Judul Kegiatan</label>
                                    <input type="text" name="judul" id="judul-{{ $item->id }}"
                                        class="form-control" value="{{ $item->judul }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="kategoriSelect-{{ $item->id }}">Kategori</label>
                                    <select class="form-select" name="kategori" id="kategoriSelect-{{ $item->id }}"
                                        data-kategori-asli="{{ $item->kategori }}" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="Pelatihan">Pelatihan</option>
                                        <option value="Posyandu">Posyandu</option>
                                        <option value="Bazar">Bazar</option>
                                        <option value="Lainnya">Lainnya (Isi Manual)</option>
                                    </select>
                                    <input type="text" class="form-control mt-2 d-none"
                                        id="kategoriLainnya-{{ $item->id }}" name="kategori_lainnya"
                                        placeholder="Masukkan kategori lainnya">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="deskripsi-{{ $item->id }}">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi-{{ $item->id }}" class="form-control" rows="4">{{ $item->deskripsi }}</textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="penyelenggara-{{ $item->id }}">Penyelenggara</label>
                                    <input type="text" name="penyelenggara" id="penyelenggara-{{ $item->id }}"
                                        class="form-control" value="{{ $item->penyelenggara }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="lokasi-{{ $item->id }}">Lokasi</label>
                                    <input type="text" name="lokasi" id="lokasi-{{ $item->id }}"
                                        class="form-control" value="{{ $item->lokasi }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control"
                                        onchange="togglePublishedAtUpdate(this.value, '{{ $item->id }}')" required>
                                        <option value="draft" @if ($item->status == 'draft') selected @endif>Draft
                                        </option>
                                        <option value="published" @if ($item->status == 'published') selected @endif>
                                            Published
                                        </option>
                                        <option value="archived" @if ($item->status == 'archived') selected @endif>Archived
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group mb-3" id="publishedAtUpdateGroup-{{ $item->id }}"
                                    style="display: none;">
                                    <label>Tanggal Acara</label>
                                    <input type="datetime-local" name="tanggal_acara" class="form-control"
                                        value="{{ $item->tanggal_acara ? \Carbon\Carbon::parse($item->tanggal_acara)->format('Y-m-d\TH:i') : '' }}">
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Update Aktivitas</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="FotoPickerModal-{{ $item->id }}" tabindex="-1"
            aria-labelledby="FotoPickerModalLabel-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-secondary text-white">
                        <h5 class="modal-title" id="FotoPickerModalLabel-{{ $item->id }}">Pilih Foto Dokumentasi</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="fotoSearch-{{ $item->id }}" class="form-control mb-3"
                            placeholder="Cari caption foto...">
                        <div class="row" id="fotoGallery-{{ $item->id }}">
                            @php
                                // Ambil ID foto yang sudah terpasang
                                $attachedFotoIds = $item->dokumentasi->pluck('id');
                            @endphp
                            @foreach ($fotoList as $foto)
                                <div class="col-md-3 col-sm-4 mb-3 foto-item"
                                    data-caption="{{ strtolower($foto->caption ?? '') }}">
                                    <label class="d-block border rounded p-2 text-center">
                                        <input type="checkbox" name="fotopkk-{{ $item->id }}[]"
                                            value="{{ $foto->id }}" class="form-check-input mb-2"
                                            @if ($attachedFotoIds->contains($foto->id)) checked @endif>
                                        <img src="{{ asset('storage/' . $foto->fotopkk) }}"
                                            class="img-fluid rounded mb-1" alt="Foto">
                                        <div class="small text-muted">{{ $foto->caption ?? 'Foto #' . $foto->id }}</div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                            id="selectFotoButton-{{ $item->id }}">Selesai Pilih</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($activities as $item)
        <div id="DeleteactivitypkkModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="DeleteactivitypkkModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="DeleteactivitypkkModalTitle-{{ $item->id }}">Hapus Publikasi</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('activitypkk.destroy_pkk', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-3 text-center">

                                <div class="form-group mb-3">
                                    <label class="form-label d-block">Foto Utama</label>

                                    @if ($item->dokumentasi->isNotEmpty())
                                        <img src="{{ asset('storage/' . $item->dokumentasi->first()->fotopkk) }}"
                                            alt="Foto utama" width="150" class="img-thumbnail mb-2">
                                    @else
                                        <p class="text-muted fst-italic">Tidak ada foto</p>
                                    @endif
                                </div>

                                <h5>
                                    Yakin ingin menghapus publikasi ini? <br>
                                    <strong>"{{ $item->judul }}"</strong>
                                </h5>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        // --- FUNGSI GLOBAL (bisa dipanggil dari HTML) ---
        window.togglePublishedAtCreate = function(status) {
            const publishedAtGroup = document.getElementById('publishedAtCreateGroup');
            if (publishedAtGroup) {
                if (status === 'published') {
                    publishedAtGroup.style.display = 'block';
                    const inputDate = publishedAtGroup.querySelector('input[name="tanggal_acara"]');
                    if (!inputDate.value) {
                        const now = new Date();
                        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
                        inputDate.value = now.toISOString().slice(0, 16);
                    }
                } else {
                    publishedAtGroup.style.display = 'none';
                }
            }
        }
        window.togglePublishedAtUpdate = function(status, id) {
            const publishedAtGroup = document.getElementById('publishedAtUpdateGroup-' + id);
            if (publishedAtGroup) {
                publishedAtGroup.style.display = (status === 'published') ? 'block' : 'none';
            }
        }
        window.clearFotoSelectionCreate = function() {
            const fotoListContainer = document.getElementById('fotoList');
            if (fotoListContainer) {
                fotoListContainer.innerHTML = '';
            }
            const checkedInputs = document.querySelectorAll('#FotoPickerModal input[name="fotopkk[]"]:checked');
            checkedInputs.forEach(input => input.checked = false);
        }
        window.clearFotoSelectionUpdate = function(id) {
            const fotoListContainer = document.getElementById('fotoList-' + id);
            if (fotoListContainer) {
                fotoListContainer.innerHTML = ''; // Kosongkan
                // Hapus juga alert info jika ada
                const alertInfo = fotoListContainer.querySelector('.alert');
                if (alertInfo) alertInfo.remove();
            }
            // Hapus juga foto asli yang ditampilkan
            const currentPhotos = document.getElementById('currentPhotos-' + id);
            if (currentPhotos) currentPhotos.innerHTML =
                '<span class="text-muted small">Pilihan foto dikosongkan.</span>';

            const checkedInputs = document.querySelectorAll('#FotoPickerModal-' + id + ' input:checked');
            checkedInputs.forEach(input => input.checked = false);
        }

        // --- FUNGSI INISIALISASI (dijalankan saat halaman siap) ---
        document.addEventListener('DOMContentLoaded', function() {

            // ==================================================
            // --- 1. LOGIKA UNTUK MODAL CREATE (ADD) ---
            // ==================================================
            const createModal = document.getElementById('AddactivitypkkModal');
            if (createModal) {
                // ... (Semua logika create Anda tetap sama seperti sebelumnya) ...
                const createStatusSelect = createModal.querySelector('select[name="status"]');
                if (createStatusSelect) {
                    togglePublishedAtCreate(createStatusSelect.value);
                }
                const createKategoriSelect = document.getElementById('kategoriSelect');
                const createKategoriLainnya = document.getElementById('kategoriLainnya');
                if (createKategoriSelect) {
                    createKategoriSelect.addEventListener('change', function() {
                        if (this.value === 'Lainnya') {
                            createKategoriLainnya.classList.remove('d-none');
                            createKategoriLainnya.setAttribute('required', 'required');
                        } else {
                            createKategoriLainnya.classList.add('d-none');
                            createKategoriLainnya.removeAttribute('required');
                            createKategoriLainnya.value = '';
                        }
                    });
                }
                const createSelectFotoBtn = document.querySelector('#FotoPickerModal .modal-footer button');
                const createFotoList = document.getElementById('fotoList');
                if (createSelectFotoBtn) {
                    createSelectFotoBtn.addEventListener('click', function() {
                        createFotoList.innerHTML = ''; // Kosongkan
                        const checkedInputs = document.querySelectorAll(
                            '#FotoPickerModal input[name="fotopkk[]"]:checked');
                        checkedInputs.forEach(input => {
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = 'fotopkk[]';
                            hiddenInput.value = input.value;
                            createFotoList.appendChild(hiddenInput);
                        });
                        if (checkedInputs.length > 0) {
                            const info = document.createElement('div');
                            info.className = 'alert alert-info py-2 px-3';
                            info.innerHTML = `${checkedInputs.length} foto telah dipilih. 
                        <button type="button" class="btn-close btn-sm float-end" 
                                onclick="this.parentElement.remove(); clearFotoSelectionCreate();" 
                                aria-label="Close"></button>`;
                            createFotoList.appendChild(info);
                        }
                    });
                }
                const createFotoSearch = document.getElementById('fotoSearch');
                const createFotoItems = document.querySelectorAll('#fotoGallery .foto-item');
                if (createFotoSearch) {
                    createFotoSearch.addEventListener('input', function() {
                        const filter = this.value.toLowerCase();
                        createFotoItems.forEach(item => {
                            const caption = item.dataset.caption.toLowerCase();
                            item.style.display = caption.includes(filter) ? '' : 'none';
                        });
                    });
                }
            }

            // ==================================================
            // --- 2. LOGIKA UNTUK SEMUA MODAL UPDATE ---
            // ==================================================
            document.querySelectorAll('.modal[id^="UpdateactivitypkkModal-"]').forEach(modal => {
                const itemId = modal.id.split('-')[1];

                // --- Logika MODAL PICKER (Bertumpuk) ---
                const openPickerBtn = document.getElementById(`openPickerButton-${itemId}`);
                const pickerModalEl = document.getElementById(`FotoPickerModal-${itemId}`);
                if (openPickerBtn && pickerModalEl) {
                    const updateModalInstance = bootstrap.Modal.getOrCreateInstance(modal);
                    const pickerModalInstance = bootstrap.Modal.getOrCreateInstance(pickerModalEl);
                    openPickerBtn.addEventListener('click', function() {
                        updateModalInstance.hide();
                        pickerModalInstance.show();
                    });
                    pickerModalEl.addEventListener('hidden.bs.modal', function() {
                        updateModalInstance.show();
                    });
                }

                // --- ⭐️ BARU: LOGIKA MODAL UPLOAD (BERTUMPUK) ⭐️ ---
                const openUploadBtn = document.getElementById(`openUploadButton-${itemId}`);
                const addFotoModalEl = document.getElementById('AddfotoModal'); // Ini modal global

                if (openUploadBtn && addFotoModalEl) {
                    const updateModalInstance = bootstrap.Modal.getOrCreateInstance(modal);
                    const addFotoModalInstance = bootstrap.Modal.getOrCreateInstance(addFotoModalEl);

                    // Saat tombol "+ Upload Foto Baru" diklik:
                    openUploadBtn.addEventListener('click', function() {
                        updateModalInstance.hide(); // Sembunyikan modal Update
                        addFotoModalInstance.show(); // Tampilkan modal Upload

                        // Tambahkan listener SEMENTARA ke modal upload
                        // Ini akan menjalankan 'updateModalInstance.show()' HANYA SATU KALI
                        // saat modal upload ditutup.
                        addFotoModalEl.addEventListener('hidden.bs.modal', function() {
                            updateModalInstance.show();
                        }, {
                            once: true
                        }); // '{ once: true }' adalah kuncinya!
                    });
                }
                // --- ⭐️ AKHIR LOGIKA BARU ⭐️ ---


                // --- Inisialisasi Kategori (Update) ---
                const updateKategoriSelect = document.getElementById('kategoriSelect-' + itemId);
                const updateKategoriLainnya = document.getElementById('kategoriLainnya-' + itemId);
                if (updateKategoriSelect) {
                    const kategoriAsli = updateKategoriSelect.dataset.kategoriAsli;
                    const options = Array.from(updateKategoriSelect.options).map(opt => opt.value);
                    if (!options.includes(kategoriAsli) && kategoriAsli) {
                        updateKategoriSelect.value = 'Lainnya';
                        updateKategoriLainnya.value = kategoriAsli;
                        updateKategoriLainnya.classList.remove('d-none');
                        updateKategoriLainnya.setAttribute('required', 'required');
                    } else if (kategoriAsli) {
                        updateKategoriSelect.value = kategoriAsli;
                    }
                    updateKategoriSelect.addEventListener('change', function() {
                        if (this.value === 'Lainnya') {
                            updateKategoriLainnya.classList.remove('d-none');
                            updateKategoriLainnya.setAttribute('required', 'required');
                        } else {
                            updateKategoriLainnya.classList.add('d-none');
                            updateKategoriLainnya.removeAttribute('required');
                            updateKategoriLainnya.value = '';
                        }
                    });
                }

                // --- Inisialisasi Tanggal (Update) ---
                const updateStatusSelect = modal.querySelector('select[name="status"]');
                if (updateStatusSelect) {
                    togglePublishedAtUpdate(updateStatusSelect.value, itemId);
                }

                // --- Logika Picker Foto (Update) ---
                const updateSelectFotoBtn = document.getElementById('selectFotoButton-' + itemId);
                const updateFotoList = document.getElementById('fotoList-' + itemId);
                if (updateSelectFotoBtn) {
                    updateSelectFotoBtn.addEventListener('click', function() {
                        updateFotoList.innerHTML = ''; // Kosongkan
                        const checkedInputs = document.querySelectorAll('#FotoPickerModal-' +
                            itemId + ' input:checked');

                        // Sembunyikan foto asli
                        const currentPhotos = document.getElementById('currentPhotos-' + itemId);
                        if (currentPhotos) currentPhotos.style.display = 'none';

                        checkedInputs.forEach(input => {
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = 'fotopkk[]';
                            hiddenInput.value = input.value;
                            updateFotoList.appendChild(hiddenInput);
                        });
                        if (checkedInputs.length > 0) {
                            const info = document.createElement('div');
                            info.className = 'alert alert-info py-2 px-3';
                            info.innerHTML = `${checkedInputs.length} foto telah dipilih. 
                        <button type="button" class="btn-close btn-sm float-end" 
                                onclick="this.parentElement.remove(); clearFotoSelectionUpdate(${itemId});" 
                                aria-label="Close"></button>`;
                            updateFotoList.appendChild(info);
                        }
                    });
                }

                // --- Logika Search Foto (Update) ---
                const updateFotoSearch = document.getElementById('fotoSearch-' + itemId);
                const updateFotoItems = document.querySelectorAll('#fotoGallery-' + itemId + ' .foto-item');
                if (updateFotoSearch) {
                    updateFotoSearch.addEventListener('input', function() {
                        const filter = this.value.toLowerCase();
                        updateFotoItems.forEach(item => {
                            const caption = item.dataset.caption.toLowerCase();
                            item.style.display = caption.includes(filter) ? '' : 'none';
                        });
                    });
                }
            });
        });
    </script>
@endsection
@extends('admin-temp.footer_pkk')
