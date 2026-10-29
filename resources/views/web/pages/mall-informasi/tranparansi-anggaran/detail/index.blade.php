@extends ('layouts.mall-informasi-layouts.dashboard')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-body">
                <div class="inner mt-4">
                    <header class="special text-center">
                        <h2>TRANSPARANSI PENGELOLAAN ANGGARAN {{$data->year}}</h2>
                        <p></p>
                    </header>
                    <div class="highlights row">
                        @foreach ($dataTransparan as $item)
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <h3><b>{{$loop->iteration}}. {{$item->title}}</b></h3>
                                    <a href="{{asset('files/'.$item->docs)}}">Download</a>
                                </header>
                            </div>
                        </section>
                        @endforeach
                        {{-- <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <h3><b>1. Ringkasan RKA SKPD</b></h3>
                                    <a href="https://drive.google.com/open?id=132IR6uJx_vln3DbIkGXTw0jr6I0abaRK">Download</a>
                                </header>
                            </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <h3><b>2. Ringkasan RKA Pejabat Pengelola Keuangan Daerah</b></h3>
                                    <a href=" ">Download</a>
                                </header>
                            </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <h3><b>3. Rancangan Peraturan Daerah (Raperda) APBD</b></h3>
                                    <a href="https://drive.google.com/open?id=1MKi83NkknoFvLRkXTgkW8yoWvEQN4pTX">Download</a>
                                </header>
                            </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <h3><b>4. Rancangan Peraturan Dareah (Raperda) Perubahan</b></h3>
                                    <a href=" ">Download</a>
                                </header>
                            </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <h3><b>5. Peraturan Daerah (PERDA) APBD</b></h3>
                                    <a href="https://drive.google.com/open?id=1CmH8BYU2DXzhg32WXTjhmN_kamuc9NXz">Download</a>
                                </header>
                            </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <h3><b>6. Peraturan Daerah (PERDA)Perubahan APBD</b></h3>
                                    <a href=" ">Download</a>
                                </header>
                            </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <h3><b>7. Ringkasan DPA SKPD</b></h3>
                                    <a href="https://drive.google.com/open?id=1TZfH1RNCOHtvaAfOTz0NFE5f9OzBaXFR">Download</a>
                                </header>
                            </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <h3><b>8. Ringkasan DPA Pejabat Pengelola Keuangan Daerah</b></h3>
                                    <a href="https://drive.google.com/open?id=1XQlmNYyM7dKJ7Q5EmOvkK9_Ou2J6VMSc">Download</a>
                                </header>
                            </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <h3><b>9. Laporan Realisasi Anggaran Pejabat Pengelola Keuangan Daerah</b></h3>
                                    <a href="https://drive.google.com/open?id=1x7zeU2pyI_IJmFf0_UdmtXuUTvJotke8">Download</a>
                                </header>
                            </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <h3><b>10. Laporan Realisasi Anggaran SKPD</b></h3>
                                    <a href="https://drive.google.com/open?id=1hQQgdUenXm5D3AHJRLM9IMtxK5KnP1Zp">Download</a>
                                </header>
                            </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <h3><b>11. Laporan Keuangan Pemerintah Daerah (LKPD) yang Sudah diaudit</b></h3>
                                    <a href="https://drive.google.com/open?id=1HzDFqBIm5AthxA4HLixnlF1qlzuC0xxX">Download</a>
                                </header>
                            </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <h3><b>12. Opini Atas Laporan Keuangan Pemerintah Daerah (LKPD)</b></h3>
                                    <a href="https://drive.google.com/open?id=1hsq2qKSBQi91_Xx6fL6-u0djJgGjvDZU">Download</a>
                                </header>
                            </div>
                        </section> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection