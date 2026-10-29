<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MallInformasiController extends Controller
{
    public function index()
    {
        return view('web.pages.mall-informasi.dashboard');
    }

    public function masterPage()
    {
        return view('web.pages.mall-informasi.dashboard');
    }
    public function newsPage()
    {
        return view('web.pages.mall-informasi.news');
    }

    /**
     * Informasi Publik 
     */

    // Informasi Pengaduan
    public function complaintInformation()
    {
        return view('web.pages.mall-informasi.public-info.complaint');
    }

    // Informasi Hukum
    public function lawInformation()
    {
        return view('web.pages.mall-informasi.public-info.law');
    }

    // Informasi Sektor Pendidikan
    public function educationInformation()
    {
        return view('web.pages.mall-informasi.public-info.education');
    }

    // Informasi Geospasial
    public function geospatialInformation()
    {
        return view('web.pages.mall-informasi.public-info.geospatial');
    }

    // Informasi Dokumen
    public function documentationInformation()
    {
        return view('web.pages.mall-informasi.public-info.documentation');
    }

    // Informasi Kependudukan
    public function residenceInformation()
    {
        return view('web.pages.mall-informasi.public-info.residence');
    }

    // Informasi Pajak Retribusi
    public function taxRetributionInformation()
    {
        return view('web.pages.mall-informasi.public-info.tax-retribution');
    }

    // Informasi Berusaha
    public function businessInformation()
    {
        return view('web.pages.mall-informasi.public-info.business');
    }
}

