<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\NewsModels;
use Illuminate\Support\Str;
use App\Models\K_NewsModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    //for show news
    public function userView()
    {
        return view('/news');
    }

    public function newsDetail()
    {
        return view('/news_detail');
    }


    public function index()
    {
        // Ambil semua data berita
        $news = NewsModels::with('kategori')->get();

        // Ambil semua kategori berita untuk dropdown
        $k_news = K_NewsModels::all();

        // Kirim ke view
        return view('ketua_rw.news', compact('news', 'k_news'));
    }

    public function store_rw(Request $request)
    {
        $request->validate([
            'id_knews' => 'required|array',
            'id_knews.*' => 'exists:k_news,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news,slug',
            'content' => 'required|string',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ]);

        // Slug: biarkan jika URL penuh
        $slugInput = trim($request->slug);
        $slug = Str::startsWith($slugInput, ['http://', 'https://'])
            ? $slugInput
            : Str::slug($slugInput);

        // Upload gambar
        $gambarPath = $request->file('gambar')->store('news', 'public');

        // Tanggal posting
        $publishedAt = null;
        if ($request->status === 'published') {
            $publishedAt = $request->filled('published_at')
                ? Carbon::parse($request->published_at)->format('Y-m-d H:i:s')
                : now();
        }

        // Simpan berita
        $news = NewsModels::create([
            'id_users' => Auth::id(),
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'gambar' => $gambarPath,
            'status' => $request->status,
            'published_at' => $publishedAt,
        ]);

        // Simpan relasi kategori (many-to-many)
        $news->kategori()->attach($request->id_knews);

        return redirect()->back()->with('success', 'Berita berhasil ditambahkan!');
    }

    public function store_kt(Request $request)
    {
        $request->validate([
            'kategori_news' => 'required|string|max:255',
            // 'slug' => 'required|string|max:255|unique:k_news,slug',
        ]);

        K_NewsModels::create([
            'kategori_news' => $request->kategori_news,
            // 'slug' => Str::slug($request->slug),
        ]);

        return redirect()->back()->with('success', 'Kategori berita baru berhasil ditambahkan!');
    }

    public function update_rw(Request $request, $id)
    {
        $news = NewsModels::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news,slug,' . $id,
            'content' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:draft,published,archived',
            'published_at' => $request->status === 'published' ? 'nullable|date' : 'nullable',
        ]);

        // Cek apakah slug URL eksternal atau slug lokal
        $slugInput = trim($request->slug);
        $slug = Str::startsWith($slugInput, ['http://', 'https://'])
            ? $slugInput
            : Str::slug($slugInput);

        // Update gambar kalau diupload baru
        if ($request->hasFile('gambar')) {
            if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
                Storage::disk('public')->delete($news->gambar);
            }
            $gambarPath = $request->file('gambar')->store('news', 'public');
        } else {
            $gambarPath = $news->gambar;
        }

        // Tentukan nilai published_at
        $publishedAt = null;
        if ($request->status === 'published') {
            $publishedAt = $request->published_at ?? now();
        }

        // Simpan update ke database
        $news->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'gambar' => $gambarPath,
            'status' => $request->status,
            'published_at' => $publishedAt,
        ]);

        return redirect()->back()->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy_rw($id)
    {
        $news = NewsModels::findOrFail($id);

        if ($news->gambar && file_exists(storage_path('app/public/' . $news->gambar))) {
            unlink(storage_path('app/public/' . $news->gambar));
        }
        $news->delete();
        return redirect()->back()->with('success', 'Berita berhasil dihapus.');
    }

    public function news()
    {
        // Ambil semua data berita
        $news = NewsModels::with('kategori')->get();

        // Ambil semua kategori berita untuk dropdown
        $k_news = K_NewsModels::all();

        // Kirim ke view
        return view('/news', compact('news', 'k_news'));
    }

    public function pengumuman()
    {
        return view('/pengumuman');
    }

    public function aktivitas()
    {
        return view('/aktivitas');
    }
}