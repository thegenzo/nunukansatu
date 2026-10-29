<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebController;
use App\Http\Controllers\MallInformasiController;
use App\Http\Controllers\TransaparansiController;
use App\Http\Controllers\StrategisDaerahController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\AnnouncementAuthController;
use App\Http\Middleware\EnsureAnnouncementAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('files/{filename}', function ($filename) {
    $path = public_path('files/' . $filename);

    if (file_exists($path)) {
        return response()->file($path);
    }

    return abort(404);
});

// Serve search data (JSON) - more reliable than static file serving
Route::get('api/search-data', function () {
    $path = public_path('web-assets/search.json');
    if (!file_exists($path)) {
        return response()->json(['error' => 'Search data not found'], 404);
    }
    $data = json_decode(file_get_contents($path), true);
    return response()->json($data)->header('Cache-Control', 'public, max-age=3600');
})->name('api.search-data');

Route::any('/', [WebController::class, 'index'])->name('web.home');
Route::get('/pengumuman/{announcement}', [AnnouncementController::class, 'show'])->name('web.announcements.show');
Route::get('/pengumuman/{announcement}/pdf', [AnnouncementController::class, 'pdf'])->name('web.announcements.pdf');
Route::get('/pengumuman/{announcement}/qr', [AnnouncementController::class, 'qr'])->name('web.announcements.qr');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AnnouncementAuthController::class, 'create'])->name('login');
    Route::post('/login', [AnnouncementAuthController::class, 'store'])->middleware('throttle:10,1')->name('login.store');
    Route::middleware(EnsureAnnouncementAdmin::class)->group(function () {
        Route::redirect('/', '/admin/pengumuman');
        Route::post('/logout', [AnnouncementAuthController::class, 'destroy'])->name('logout');
        Route::get('/pengumuman/{announcement}/preview', [AdminAnnouncementController::class, 'preview'])->name('announcements.preview');
        Route::get('/pengumuman/{announcement}/pdf', [AdminAnnouncementController::class, 'pdf'])->name('announcements.pdf');
        Route::get('/pengumuman/{announcement}/qr', [AdminAnnouncementController::class, 'qr'])->name('announcements.qr');
        Route::resource('pengumuman', AdminAnnouncementController::class)
            ->parameters(['pengumuman' => 'announcement'])
            ->names('announcements')->except('show');
    });
});
Route::get('/layanan-publik', [WebController::class, 'public_services'])->name('web.public-services');
Route::get('/layanan-adm-pemerintah', [WebController::class, 'administration_services'])->name('web.adm-services');
Route::get('/mall-data-informasi', [WebController::class, 'mall_data_informasi'])->name('web.mall-data-informasi');
Route::get('/layanan-fase-kehidupan', [WebController::class, 'layanan_fase_kehidupan'])->name('web.layanan-fase-kehidupan');

Route::get('/sso/login', [WebController::class, 'sso_login'])->name('web.sso-login');
Route::get('/sso/logout', [WebController::class, 'sso_logout'])->name('web.sso-logout');
Route::get('/sso/callback', [WebController::class, 'sso_callback'])->name('web.sso-callback');
Route::post('/sso-siasn', [WebController::class, 'sso_siasn'])->name('web.sso-siasn');
Route::post('/sso-pub', [WebController::class, 'sso_pub'])->name('web.sso-pub');
Route::post('/daftar-pub', [WebController::class, 'daftar_pub'])->name('web.daftar-pub');
Route::get('/activate/{id}', [WebController::class, 'activate'])->name('web.activate');

Route::controller(MallInformasiController::class)->group(function () {
    Route::prefix('/mall-informasi')->group(function () {
        Route::prefix('/informasi-publik')->group(function () {
            Route::get('/informasi-pengaduan', 'complaintInformation')->name('web.mall-informasi.public-info.complaint');
            Route::get('/informasi-hukum', 'lawInformation')->name('web.mall-informasi.public-info.law');
            Route::get('/informasi-pendidikan', 'educationInformation')->name('web.mall-informasi.public-info.education');
            Route::get('/informasi-geospasial', 'geospatialInformation')->name('web.mall-informasi.public-info.geospatial');
            Route::get('/informasi-dokumentasi', 'documentationInformation')->name('web.mall-informasi.public-info.documentation');
            Route::get('/informasi-kependudukan', 'residenceInformation')->name('web.mall-informasi.public-info.residence');
            Route::get('/informasi-retribusi-pajak', 'taxRetributionInformation')->name('web.mall-informasi.public-info.tax-retribution');
            Route::get('/informasi-berusaha', 'businessInformation')->name('web.mall-informasi.public-info.business-retribution');
        });
    });
});


//crud StrategisDaerahController
Route::get('/mall-informasi/strategis-daerah', [StrategisDaerahController::class, 'index'])->name('web.mall-informasi.strategis-index');
Route::post('/mall-informasi/strategis-daerah/create', [StrategisDaerahController::class, 'create'])->name('web.mall-informasi.strategis-create');
Route::post('/mall-informasi/strategis-daerah/update', [StrategisDaerahController::class, 'update'])->name('web.mall-informasi.strategis-update');
Route::get('/mall-informasi/strategis-daerah/delete/{id}', [StrategisDaerahController::class, 'destroy'])->name('web.mall-informasi.strategis-delete');
Route::get('/mall-informasi/strategis-daerah/delete-lampiran/{id}', [StrategisDaerahController::class, 'deleteLampiran'])->name('web.mall-informasi.strategis-delete-lampiran');
Route::get('/mall-informasi/strategis-daerah/data-del/{id}', [StrategisDaerahController::class, 'destroyData'])->name('web.mall-informasi.strategis-daerah-del');
Route::get('/mall-informasi/strategis-daerah/detail', [StrategisDaerahController::class, 'detail'])->name('web.mall-informasi.strategis-detail');
Route::post('/mall-informasi/strategis-daerah/createData', [StrategisDaerahController::class, 'createData'])->name('web.mall-informasi.strategis-createData');

Route::get('/mall-informasi/strategis', [StrategisDaerahController::class, 'viewTrans']);
Route::get('/mall-informasi/strategis-year/{id}', [StrategisDaerahController::class, 'viewYear']);
Route::get('/mall-informasi/strategis/get-data/{id}', [StrategisDaerahController::class, 'getData']);

//crud transparansi
Route::get('/mall-informasi/transparansi-data', [TransaparansiController::class, 'index'])->name('web.mall-informasi.transparansi-index');
Route::post('/mall-informasi/transparansi-data/create', [TransaparansiController::class, 'create'])->name('web.mall-informasi.transparansi-create');
Route::post('/mall-informasi/transparansi-data/update', [TransaparansiController::class, 'update'])->name('web.mall-informasi.transparansi-update');
Route::get('/mall-informasi/transparansi-data/delete/{id}', [TransaparansiController::class, 'destroy'])->name('web.mall-informasi.transparansi-delete');
Route::get('/mall-informasi/transparansi-data/delete-lampiran/{id}', [TransaparansiController::class, 'deleteLampiran'])->name('web.mall-informasi.transparansi-delete-lampiran');
Route::get('/mall-informasi/transparansi-data/data-del/{id}', [TransaparansiController::class, 'destroyData'])->name('web.mall-informasi.transparansi-data-del');
Route::get('/mall-informasi/transparansi-data/detail', [TransaparansiController::class, 'detail'])->name('web.mall-informasi.transparansi-detail');
Route::post('/mall-informasi/transparansi-data/createData', [TransaparansiController::class, 'createData'])->name('web.mall-informasi.transparansi-createData');
Route::post('/mall-informasi/transparansi-data/lampiran-create', [TransaparansiController::class, 'lampiranCreate'])->name('web.mall-informasi.lampiran-create');

Route::get('/mall-informasi/transparansi', [TransaparansiController::class, 'viewTrans']);
Route::get('/mall-informasi/transparansi-year/{id}', [TransaparansiController::class, 'viewYear']);
Route::get('/mall-informasi/transparansi/get-data/{id}', [TransaparansiController::class, 'getData']);
Route::get('/mall-informasi/transparansi/get-lampiran/{id}', [TransaparansiController::class, 'getLampiran']);

// mall informasi dahsboard
Route::get('/mall-informasi/dashboard', [MallInformasiController::class, 'index'])->name('web.mall-informasi.dashboard');
Route::get('/mall-informasi/masterPage', [MallInformasiController::class, 'masterPage'])->name('web.mall-informasi.masterPage');
Route::get('/mall-informasi/berita', [MallInformasiController::class, 'newsPage'])->name('web.mall-informasi.news');
Route::get('/mall-informasi/transparansi/2018', function () {return view('web.pages.mall-informasi.tranparansi-anggaran.detail.2018');});
Route::get('/mall-informasi/transparansi/2019', function () {return view('web.pages.mall-informasi.tranparansi-anggaran.detail.2019');});
Route::get('/mall-informasi/transparansi/2020', function () {return view('web.pages.mall-informasi.tranparansi-anggaran.detail.2020');});
Route::get('/mall-informasi/transparansi/2021', function () {return view('web.pages.mall-informasi.tranparansi-anggaran.detail.2021');});
Route::get('/mall-informasi/transparansi/2022', function () {return view('web.pages.mall-informasi.tranparansi-anggaran.detail.2022');});
Route::get('/mall-informasi/transparansi/2023', function () {return view('web.pages.mall-informasi.tranparansi-anggaran.detail.2023');});
Route::get('/mall-informasi/transparansi/2024', function () {return view('web.pages.mall-informasi.tranparansi-anggaran.detail.2024');});

// mall data
Route::get('/mall-data/beranda', function () {return view('web.pages.mall-data.landing-page');});
Route::get('/mall-data/detail', function () {return view('web.pages.mall-data.detail-page');});
Route::get('/mall-data/urusan', function () {return view('web.pages.mall-data.urusan-page');});
Route::get('/mall-data/opd', function () {return view('web.pages.mall-data.opd-page');});



