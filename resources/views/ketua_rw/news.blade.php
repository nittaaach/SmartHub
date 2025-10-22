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
                        <li class="breadcrumb-item" aria-current="page">News Rukun Warga</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">News Rukun Warga.</h2>
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
                                        data-bs-target="#AddnewsModal">
                                        Tambah News
                                    </button>
                                </div>
                                <table id="basic-btn-ktprw" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Judul</th>
                                            <th>Link</th>
                                            <th>Content</th>
                                            <th>Thumnail</th>
                                            <th>Status</th>
                                            <th>Published</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($news as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @forelse ($item->kategori as $kategori)
                                                        {{ $kategori->kategori_news }}{{ !$loop->last ? ', ' : '' }}
                                                    @empty
                                                        <span class="text-danger">N/A</span>
                                                    @endforelse
                                                </td>
                                                <td>{{ $item->title }}</td>
                                                <td style="max-width: 200px; word-wrap: break-word; white-space: normal;">
                                                    @php
                                                        // cek apakah slug mengandung http atau https
                                                        $isExternal = Str::startsWith($item->slug, [
                                                            'http://',
                                                            'https://',
                                                        ]);
                                                        $url = $isExternal ? $item->slug : url('/news/' . $item->slug);
                                                    @endphp <a href="{{ $url }}" target="_blank">
                                                        {{ Str::limit($url, 50) }}
                                                    </a>
                                                </td>
                                                <td>{{ $item->content }}</td>
                                                <td>
                                                    @if ($item->gambar)
                                                        <img src="{{ asset('storage/' . $item->gambar) }}"
                                                            alt="{{ $item->title }}" width="100">
                                                    @else
                                                        <p><i>Tidak ada gambar</i></p>
                                                    @endif
                                                </td>
                                                <td>{{ $item->status }}</td>
                                                <td>{{ $item->published_at }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#UpdatenewsModal-{{ $item->id }}">
                                                        Update
                                                    </button>
                                                    <button type="button" class="btn btn-danger me-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#DeletenewsModal-{{ $item->id }}">
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
                                            <th>Link</th>
                                            <th>Content</th>
                                            <th>Thumnail</th>
                                            <th>Status</th>
                                            <th>Published</th>
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

    <!-- Modal Tambah news -->
    <div id="AddnewsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddnewsModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Form Tambah News RW 12</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <form action="{{ route('news.store_rw') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-4">
                                <label class="form-label">Kategori Berita</label>
                                <select class="form-control" name="id_knews" id="choices-multiple-remove-button" multiple
                                    required>
                                    <option value="">-- Pilih Kategori Berita --</option>
                                    @foreach ($k_news as $kategori)
                                        <option value="{{ $kategori->id }}">
                                            {{ $kategori->kategori_news }} - {{ $kategori->slug }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="text-end">
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#AddkategoriModal">
                                    + Tambah Kategori Berita Baru
                                </button>
                            </div>

                            <!-- Judul -->
                            <div class="form-group mb-3">
                                <label>Judul Berita</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>

                            <!-- Slug -->
                            <div class="form-group mb-3">
                                <label>Slug / Link Berita</label>
                                <input type="text" name="slug" class="form-control" required>
                                <small class="text-muted">
                                    Bisa isi slug biasa (contoh: <b>kegiatan-rw12</b>) atau link eksternal (contoh:
                                    <b>https://cnn.com/...</b>)
                                </small>
                            </div>

                            <!-- Isi -->
                            <div class="form-group mb-3">
                                <label>Isi Berita</label>
                                <textarea name="content" class="form-control" rows="4" required></textarea>
                            </div>

                            <!-- Status -->
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control" onchange="togglePublishedAtCreate(this.value)"
                                    required>
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                    <option value="archived">Archived</option>
                                </select>
                            </div>

                            <!-- Tanggal Posting -->
                            <div class="form-group mb-3" id="publishedAtCreateGroup" style="display: none;">
                                <label>Tanggal Posting</label>
                                <input type="datetime-local" name="published_at" class="form-control">
                            </div>

                            <!-- Gambar -->
                            <div class="form-group mb-3">
                                <label>Gambar</label>
                                <input type="file" name="gambar" class="form-control" accept="image/*">
                                @error('gambar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="AddkategoriModal" class="modal fade" tabindex="-1" aria-labelledby="AddTemplateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('news.store_kt') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="AddTemplateModalLabel">Tambah Kategori Berita Baru
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label>Kategori Berita</label>
                            <input type="text" class="form-control" name="kategori_news" required>
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

    <!-- Modal Update news -->
    @foreach ($news as $item)
        <div id="UpdatenewsModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="UpdatenewsModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="UpdatenewsModalTitle-{{ $item->id }}">Form Update Berita RW 12
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('news.update_rw', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label>Judul Berita</label>
                                <input type="text" name="title" class="form-control" value="{{ $item->title }}"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Slug / Link Berita</label>
                                <input type="text" name="slug" class="form-control" value="{{ $item->slug }}"
                                    required>
                                <small class="text-muted">
                                    Bisa isi slug biasa (contoh: <b>kegiatan-rw12</b>) atau link eksternal (contoh:
                                    <b>https://cnn.com/...</b>)
                                </small>
                            </div>

                            <div class="form-group mb-3">
                                <label>Isi Berita</label>
                                <textarea name="content" class="form-control" rows="4" required>{{ $item->content }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control"
                                    onchange="togglePublishedAt(this.value, {{ $item->id }})" required>
                                    <option value="draft" {{ $item->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ $item->status == 'published' ? 'selected' : '' }}>
                                        Published</option>
                                    <option value="archived" {{ $item->status == 'archived' ? 'selected' : '' }}>Archived
                                    </option>
                                </select>
                            </div>

                            <div class="form-group mb-3" id="publishedAtGroup-{{ $item->id }}">
                                <label>Tanggal Posting</label>
                                <input type="datetime-local" name="published_at" class="form-control"
                                    value="{{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('Y-m-d\TH:i') : '' }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Gambar (biarkan kosong jika tidak diganti)</label>
                                <input type="file" name="gambar" class="form-control" accept="image/*">
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
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete news -->
    @foreach ($news as $item)
        <div id="DeletenewsModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="DeletenewsModalTitle-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="DeletenewsModalTitle-{{ $item->id }}">Hapus Berita</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('news.destroy_rw', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="p-3 text-center">

                                <div class="form-group mb-3">
                                    <label class="form-label d-block">Thumbnail Berita</label>
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar berita"
                                            width="150" class="img-thumbnail mb-2">
                                        <p class="text-muted">Gambar saat ini</p>
                                    @else
                                        <p class="text-muted fst-italic">Tidak ada gambar</p>
                                    @endif
                                </div>

                                <h5>
                                    Yakin ingin menghapus berita ini? <br>
                                    <strong>"{{ $item->title }}"</strong>
                                </h5>
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

    <script>
        function togglePublishedAt(status, id) {
            const group = document.getElementById('publishedAtGroup-' + id);
            if (group) {
                group.style.display = (status === 'published') ? 'block' : 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($news as $item)
                togglePublishedAt('{{ $item->status }}', {{ $item->id }});
            @endforeach
        });

        function togglePublishedAtCreate(status) {
            const group = document.getElementById('publishedAtCreateGroup');
            if (group) {
                group.style.display = (status === 'published') ? 'block' : 'none';
            }
        }

        // Inisialisasi default saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            togglePublishedAtCreate(document.querySelector('select[name="status"]').value);
        });
    </script>
@endsection
@extends('admin-temp.footer_rw')
