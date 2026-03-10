import re

with open('routes/web.php', 'r') as f:
    content = f.read()

# 1. Provide a better structure for the auth groups
# We will find the `Route::middleware(['auth', 'role...` lines and remove them since we'll group them.
# We'll also remove the main `Route::middleware(['auth'])->group(function () {` and closing `});`.

# Here is the completely refactored auth routing section:
new_routes = """
//================ Auth Group: Ketua RW ================
Route::middleware(['auth:rw', 'role:Ketua_RW'])->group(function () {
    Route::get('/ketua_rw/dashboard', [DashboardController::class, 'index'])->name('Ketua_RW.dashboard');
    Route::get('/ketua_rw/activity', [ActivityController::class, 'activity_RW'])->name('Ketua_RW.activity');
    Route::get('/ketua_rw/statispend', [StatistikController::class, 'index'])->name('Ketua_RW.statispend');
    Route::get('/ketua_rw/management_pengguna', [ManagementPenggunaController::class, 'index'])->name('Ketua_RW.management_pengguna');
    Route::get('/ketua_rw/struktural', [StrukturalController::class, 'index'])->name('Ketua_RW.struktural');
    Route::get('/ketua_rw/strukturalrt', [StrukturalController::class, 'indexrt'])->name('Ketua_RW.strukturalrt');
    Route::get('/ketua_rw/strukturalpkk', [StrukturalController::class, 'indexpkk'])->name('Ketua_RW.strukturalpkk');
    Route::get('/ketua_rw/strukturalkatar', [StrukturalController::class, 'indexkatar'])->name('Ketua_RW.strukturalkatar');
    Route::get('/ketua_rw/fasilitas', [FasilitasController::class, 'index'])->name('Ketua_RW.fasilitas');
    Route::get('/ketua_rw/layanan', [LayananController::class, 'index'])->name('Ketua_RW.layanan');
    Route::get('/ketua_rw/berkas', [BerkasController::class, 'index'])->name('Ketua_RW.berkas');
    Route::get('/ketua_rw/news', [NewsController::class, 'index'])->name('Ketua_RW.news');
    Route::get('/ketua_rw/bagan', [StrukturalController::class, 'indexbagan'])->name('Ketua_RW.bagan');

    // statistika (rw) crud
    Route::post('/ketua_rw/statispend/ktp', [StatistikController::class, 'store_ktp'])->name('statispend.store_ktp');
    Route::put('/ketua_rw/statispend/ktp/{id}', [StatistikController::class, 'update_ktp'])->name('statispend.update_ktp');
    Route::post('/ketua_rw/statispend/nonktp', [StatistikController::class, 'store_nonktp'])->name('statispend.store_nonktp');
    Route::put('/ketua_rw/statispend/nonktp/{id}', [StatistikController::class, 'update_nonktp'])->name('statispend.update_nonktp');

    // menagement pengguna (rw) crud
    Route::post('/ketua_rw/management_pengguna/', [ManagementPenggunaController::class, 'store_rw'])->name('management_pengguna.store_rw');
    Route::put('/ketua_rw/management_pengguna/{id}', [ManagementPenggunaController::class, 'update_rw'])->name('management_pengguna.update_rw');
    Route::delete('/ketua_rw/management_pengguna/{id}', [ManagementPenggunaController::class, 'destroy_rw'])->name('management_pengguna.destroy_rw');

    // fasilitas (rw) crud
    Route::post('/ketua_rw/fasilitas/', [FasilitasController::class, 'store_rw'])->name('fasilitas.store_rw');
    Route::put('/ketua_rw/fasilitas/{id}', [FasilitasController::class, 'update_rw'])->name('fasilitas.update_rw');
    Route::delete('/ketua_rw/fasilitas/{id}', [FasilitasController::class, 'destroy_rw'])->name('fasilitas.destroy_rw');

    // struktural (rw) crud
    Route::post('/ketua_rw/struktural', [StrukturalController::class, 'store_rw'])->name('struktural.store_rw');
    Route::put('/ketua_rw/struktural/{id}', [StrukturalController::class, 'update_rw'])->name('struktural.update_rw');
    Route::delete('/ketua_rw/struktural/{id}', [StrukturalController::class, 'destroy_rw'])->name('struktural.destroy_rw');
    Route::post('/ketua_rw/bagan', [StrukturalController::class, 'store_bagan'])->name('bagan.store_bagan');
    Route::put('/ketua_rw/bagan/{id}', [StrukturalController::class, 'update_bagan'])->name('bagan.update_bagan');
    Route::delete('/ketua_rw/bagan/{id}', [StrukturalController::class, 'destroy_bagan'])->name('bagan.destroy_bagan');

    // layanan (rw) crud
    Route::post('/ketua_rw/layanan/store', [LayananController::class, 'store_rw'])->name('layanan.store_rw');
    Route::post('/ketua_rw/layanan/st', [LayananController::class, 'store_st'])->name('layanan.store_st');
    Route::put('/ketua_rw/layanan/{id}', [LayananController::class, 'update_rw'])->name('layanan.update_rw');
    Route::delete('/ketua_rw/layanan/{id}', [LayananController::class, 'destroy_rw'])->name('layanan.destroy_rw');

    // berkas syarat (rw) crud
    Route::post('/ketua_rw/berkas', [BerkasController::class, 'store_rw'])->name('berkas.store_rw');
    Route::put('/ketua_rw/berkas/{id}', [BerkasController::class, 'update_rw'])->name('berkas.update_rw');
    Route::delete('/ketua_rw/berkas/{id}', [BerkasController::class, 'destroy_rw'])->name('berkas.destroy_rw');

    // route news (rw)
    Route::post('/ketua_rw/news', [NewsController::class, 'store_rw'])->name('news.store_rw');
    Route::post('/ketua_rw/news/kt', [NewsController::class, 'store_kt'])->name('news.store_kt');
    Route::put('/ketua_rw/news/{id}', [NewsController::class, 'update_rw'])->name('news.update_rw');
    Route::delete('/ketua_rw/news/{id}', [NewsController::class, 'destroy_rw'])->name('news.destroy_rw');
});

//================ Auth Group: PKK ================
Route::middleware(['auth:pkk', 'role:Ketua_PKK'])->group(function () {
    Route::get('/pkk/dashboard', [DashboardController::class, 'index'])->name('Ketua_PKK.dashboard');
    Route::get('/pkk/struktural', [StrukturalController::class, 'strukturpkk'])->name('Ketua_PKK.struktural');
    Route::get('/pkk/katalog', [KatalogController::class, 'index'])->name('Ketua_PKK.katalog');
    Route::get('/pkk/activitypkk', [ActivityController::class, 'index'])->name('Ketua_PKK.activitypkk');
    Route::get('/pkk/dokumentasipkk', [DokumentasiController::class, 'indexpkk'])->name('Ketua_PKK.dokumentasipkk');
    Route::get('/pkk/jadwalpkk', [JadwalController::class, 'indexpkk'])->name('Ketua_PKK.jadwalpkk');

    // katalog
    Route::post('/pkk/katalog', [KatalogController::class, 'store_pkk'])->name('katalog.store_pkk');
    Route::put('/pkk/katalog/{id}', [KatalogController::class, 'update_pkk'])->name('katalog.update_pkk');
    Route::delete('/pkk/katalog/{id}', [KatalogController::class, 'destroy_pkk'])->name('katalog.destroy_pkk');

    // activity
    Route::post('/pkk/activitypkk', [ActivityController::class, 'store_pkk'])->name('activitypkk.store_pkk');
    Route::post('/pkk/activitypkk/ft', [ActivityController::class, 'store_ft'])->name('activitypkk.store_ft');
    Route::put('/pkk/activitypkk/{id}', [ActivityController::class, 'update_pkk'])->name('activitypkk.update_pkk');
    Route::delete('/pkk/activitypkk/{id}', [ActivityController::class, 'destroy_pkk'])->name('activitypkk.destroy_pkk');

    // dokumentasi
    Route::post('/pkk/dokumentasipkk', [DokumentasiController::class, 'store_pkk'])->name('dokumentasipkk.store_pkk');
    Route::put('/pkk/dokumentasipkk/{id}', [DokumentasiController::class, 'update_pkk'])->name('dokumentasipkk.update_pkk');
    Route::delete('/pkk/dokumentasipkk/{id}', [DokumentasiController::class, 'destroy_pkk'])->name('dokumentasipkk.destroy_pkk');

    // jadwal
    Route::post('/pkk/jadwalpkk', [JadwalController::class, 'store_pkk'])->name('jadwalpkk.store_pkk');
    Route::put('/pkk/jadwalpkk/{id}', [JadwalController::class, 'update_pkk'])->name('jadwalpkk.update_pkk');
    Route::delete('/pkk/jadwalpkk/{id}', [JadwalController::class, 'destroy_pkk'])->name('jadwalpkk.destroy_pkk');
});

//================ Auth Group: Katar ================
Route::middleware(['auth:katar', 'role:Ketua_Katar'])->group(function () {
    Route::get('/katar/dashboard', [DashboardController::class, 'index'])->name('Ketua_Katar.dashboard');
    Route::get('/katar/struktural', [StrukturalController::class, 'strukturkatar'])->name('Ketua_Katar.struktural');
    Route::get('/katar/inventaris', [InventarisController::class, 'index'])->name('Ketua_Katar.inventaris');
    Route::get('/katar/activitykatar', [ActivityController::class, 'indexkatar'])->name('Ketua_Katar.activitykatar');
    Route::get('/katar/dokumentasikatar', [DokumentasiController::class, 'indexkatar'])->name('Ketua_Katar.dokumentasikatar');
    Route::get('/katar/jadwalkatar', [JadwalController::class, 'indexkatar'])->name('Ketua_Katar.jadwalkatar');

    // inventaris
    Route::post('/katar/inventaris', [InventarisController::class, 'store_ktrinven'])->name('inventaris.store_ktrinven');
    Route::post('/katar/inventaris/ktriwaya', [InventarisController::class, 'store_ktriwaya'])->name('inventaris.store_ktriwaya');
    Route::put('/katar/inventaris/{id}', [InventarisController::class, 'update_katar'])->name('inventaris.update_katar');
    Route::delete('/katar/inventaris/{id}', [InventarisController::class, 'destroy_katar'])->name('inventaris.destroy_katar');

    // activity
    Route::post('/katar/activitykatar', [ActivityController::class, 'store_katar'])->name('activitykatar.store_katar');
    Route::post('/katar/activitykatar/kft', [ActivityController::class, 'store_kft'])->name('activitykatar.store_kft');
    Route::put('/katar/activitykatar/{id}', [ActivityController::class, 'update_katar'])->name('activitykatar.update_katar');
    Route::delete('/katar/activitykatar/{id}', [ActivityController::class, 'destroy_katar'])->name('activitykatar.destroy_katar');

    // dokumentasi
    Route::post('/katar/dokumentasikatar', [DokumentasiController::class, 'store_katar'])->name('dokumentasikatar.store_katar');
    Route::put('/katar/dokumentasikatar/{id}', [DokumentasiController::class, 'update_katar'])->name('dokumentasikatar.update_katar');
    Route::delete('/katar/dokumentasikatar/{id}', [DokumentasiController::class, 'destroy_katar'])->name('dokumentasikatar.destroy_katar');

    // jadwal
    Route::post('/katar/jadwalkatar', [JadwalController::class, 'store_katar'])->name('jadwalkatar.store_katar');
    Route::put('/katar/jadwalkatar/{id}', [JadwalController::class, 'update_katar'])->name('jadwalkatar.update_katar');
    Route::delete('/katar/jadwalkatar/{id}', [JadwalController::class, 'destroy_katar'])->name('jadwalkatar.destroy_katar');
});

//================ Auth Group: RT ================
Route::middleware(['auth:rt', 'role:Ketua_RT'])->group(function () {
    Route::get('/rt/dashboard', [DashboardController::class, 'index'])->name('ketua_rt.dashboard');
});
"""

# Find the start of the old auth routes:
start_idx = content.find("Route::middleware(['auth', 'role:Ketua_RW'])->group(function () {")
# Find the end of the old auth routes:
end_idx = content.find("});\n\n\n//route for home")
if end_idx == -1:
    end_idx = content.find("//route for home")

if start_idx != -1 and end_idx != -1:
    # also remove any trailing }); from the big auth block before route for home
    new_content = content[:start_idx] + new_routes + "\n\n" + content[end_idx:]
    with open('routes/web.php', 'w') as f:
        f.write(new_content)
    print("Routes successfully rewritten!")
else:
    print("Could not find replacement indices.")
