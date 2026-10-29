<div class="modal fade" id="yearModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" tabindex="-1">
        <div class="modal-content background-modal modal-login-pub">
            <div class="modal-body">
                <!-- First Section -->
                <div class="row">
                    <!-- Second Section -->
                    <div class="col-md-12 col-lg-12">
                        <center>
                            <img src="/assets/icons/logo-red-1.png" width="300px" alt="Nunukan Satu" class="mx-auto logo-pub-modal mt-5" id="logo">
                        </center>
                        <hr>
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <input type="text" class="form-control" name="" id="year">
                        </div>
                        <hr>
                        <button onclick="savedYear()" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="dataModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" tabindex="-1">
        <div class="modal-content background-modal modal-login-pub">
            <div class="modal-body">
                <!-- First Section -->
                <div class="row">
                    <!-- Second Section -->
                    <div class="col-md-12 col-lg-12">
                        <center>
                            <img src="/assets/icons/logo-red-1.png" width="300px" alt="Nunukan Satu" class="mx-auto logo-pub-modal mt-5" id="logo">
                        </center>
                        <hr>
                        <form action="{{route('web.mall-informasi.transparansi-createData')}}?id={{$id ?? null}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Judul</label>
                                <input type="text" class="form-control" name="title" id="title">
                                <input type="hidden" class="form-control" name="id" id="idData">
                                <input type="hidden" class="form-control" name="transparansi_year_id" value="{{$id ?? null}}">
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Publish</label>
                                <input type="date" class="form-control" name="date_publish" id="date_publish">
                            </div>
                            <div class="form-group">
                                <label for="">Dokumen</label>
                                <input type="file" class="form-control" name="docs" id="docs">
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="yearUpdateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" tabindex="-1">
        <div class="modal-content background-modal modal-login-pub">
            <div class="modal-body">
                <!-- First Section -->
                <div class="row">
                    <!-- Second Section -->
                    <div class="col-md-12 col-lg-12">
                        <center>
                            <img src="/assets/icons/logo-red-1.png" width="300px" alt="Nunukan Satu" class="mx-auto logo-pub-modal mt-5" id="logo">
                        </center>
                        <hr>
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <input type="text" class="form-control" name="" id="updateyear">
                            <input type="hidden" class="form-control" name="" id="updateyearId">
                        </div>
                        <hr>
                        <button onclick="updateYear()" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalLampiran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" tabindex="-1">
        <div class="modal-content background-modal modal-login-pub">
            <div class="modal-body">
                <!-- First Section -->
                <div class="row">
                    <!-- Second Section -->
                    <div class="col-md-12 col-lg-12">
                        <center>
                            <img src="/assets/icons/logo-red-1.png" width="300px" alt="Nunukan Satu" class="mx-auto logo-pub-modal mt-5" id="logo">
                        </center>
                        <hr>
                        <button type="button" onclick="tambahInput()" class="btn btn-sm btn-primary">Tambah Input</button>
                        <input type="hidden" class="form-control" name="" id="lampiranDataId">
                        <div class="form-group mt-3">
                            <label for="">Judul</label>
                            <input type="text" class="form-control" name="titleLamp[]" id="titleLampiran">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Lampiran</label>
                            <input type="file" class="form-control" name="lampiran[]" id="fileLampiran">
                        </div>
                        <div id="new_inputs"></div>
                        <hr>
                        <button type="button" onclick="addLampiranData()" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewLampiran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" tabindex="-1">
        <div class="modal-content background-modal modal-login-pub">
            <div class="modal-body">
                <!-- First Section -->
                <div class="row">
                    <!-- Second Section -->
                    <div class="col-md-12 col-lg-12">
                        {{-- <center>
                            <img src="/assets/icons/logo-red-1.png" width="300px" alt="Nunukan Satu" class="mx-auto logo-pub-modal mt-5" id="logo">
                        </center>
                        <hr> --}}
                        <table class="table table-striped" id="data-tables">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Lampiran</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="table-body"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>