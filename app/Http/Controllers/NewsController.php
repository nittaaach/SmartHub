<?php

namespace App\Http\Controllers;

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
        $news = NewsModels::with('k_news')->get();

        // Ambil semua kategori berita untuk dropdown
        $k_news = K_NewsModels::all();

        // Kirim ke view
        return view('ketua_rw.news', compact('news', 'k_news'));
    }

    public function store_rw(Request $request)
    {
        $request->validate([
            'id_knews' => 'required|exists:k_news,id', // pastikan kategori valid
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news,slug',
            'content' => 'required|string',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:draft,published,archived',
        ]);

        // Cek apakah slug diawali http:// atau https://
        $slugInput = trim($request->slug);
        if (Str::startsWith($slugInput, ['http://', 'https://'])) {
            $slug = $slugInput; // biarkan tetap jadi URL penuh
        } else {
            $slug = Str::slug($slugInput); // kalau bukan URL, baru di-slug-kan
        }

        // Simpan gambar ke storage
        $gambarPath = $request->file('gambar')->store('news', 'public');

        // Simpan data ke tabel news
        NewsModels::create([
            'id_users' => Auth::id(), // user login
            'id_knews' => $request->id_knews,
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'content' => $request->content,
            'gambar' => $gambarPath,
            'status' => $request->status,
            'published_at' => $request->status === 'published' ? now() : null,
        ]);

        return redirect()->back()->with('success', 'Berita berhasil ditambahkan!');
    }

    public function store_kt(Request $request)
    {
        $request->validate([
            'kategori_news' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:k_news,slug',
        ]);

        K_NewsModels::create([
            'kategori_news' => $request->kategori_news,
            'slug' => Str::slug($request->slug),
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
        ]);

        // Cek apakah slug URL eksternal atau slug lokal
        $slugInput = trim($request->slug);
        if (Str::startsWith($slugInput, ['http://', 'https://'])) {
            $slug = $slugInput; // biarkan tetap URL penuh
        } else {
            $slug = Str::slug($slugInput); // ubah jadi slug lokal
        }

        // Update gambar kalau diupload baru
        if ($request->hasFile('gambar')) {
            // hapus gambar lama kalau ada
            if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
                Storage::disk('public')->delete($news->gambar);
            }
            $gambarPath = $request->file('gambar')->store('news', 'public');
        } else {
            $gambarPath = $news->gambar;
        }

        // Simpan update ke database
        $news->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'gambar' => $gambarPath,
            'status' => $request->status,
            'published_at' => $request->status === 'published' ? now() : $news->published_at,
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
}
