@extends ('layouts.mall-informasi-layouts.dashboard')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-body">
                <div class="inner mt-4">
                    <header class="special text-center">
                        <h2></h2>
                        <p></p>
                    </header>
                    <div class="highlights row">
                        @foreach ($dataTransparan as $item)
                        <section class="col-lg-3 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <a href="#" class="icon fa fa-file-alt d-block mb-2"><img src="{{ asset('assets/Logo Pemkab Nunukan.png')}}" class="label" alt="Icon" style="width: 120px; heigth: 120px;"></a>
                                    <h3><b>
                                        Transparansi Pengelolaan Anggaran
                                         {{$item->year}}</b></h3>
                                </header>
                                {{-- <p class="text-center">.</p> --}}
                                <center>
                                    <button type="button" onclick="modalGet('{{$item->id}}')" class="btn btn-primary">Lihat Data</button>
                                </center>
                            </div>
                        </section>
                        @endforeach

                        {{-- <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <a href="/mall-informasi/transparansi/2024" class="icon fa fa-file-alt d-block mb-2"><img src="{{ asset('assets/document.png')}}" class="label" alt="Icon" style="width: 120px; heigth: 120px;"></a>
                                    <h3><b>Transparansi Pengelolaan Anggaran 2024</b></h3>
                                </header>
                                <p class="text-center">.</p>
                            </div>
                        </section> --}}
                        {{-- <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <a href="/mall-informasi/transparansi/2023" class="icon fa fa-file-alt d-block mb-2"><img src="{{ asset('assets/document.png')}}" class="label" alt="Icon" style="width: 120px; heigth: 120px;"></a>
                                    <h3><b>Transparansi Pengelolaan Anggaran 2023</b></h3>
                                </header>
                                <p class="text-center">.</p>
                            </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <a href="/mall-informasi/transparansi/2022" class="icon fa fa-file-alt d-block mb-2"><img src="{{ asset('assets/document.png')}}" class="label" alt="Icon" style="width: 120px; heigth: 120px;"></a>
                                    <h3><b>Transparansi Pengelolaan Anggaran 2022</b></h3>
                                </header>
                                <p class="text-center">.</p>
                            </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <a href="/mall-informasi/transparansi/2021" class="icon fa fa-file-alt d-block mb-2"><img src="{{ asset('assets/document.png')}}" class="label" alt="Icon" style="width: 120px; heigth: 120px;"></a>
                                    <h3><b>Transparansi Pengelolaan Anggaran 2021</b></h3>
                                </header>
                                <p class="text-center">.</p>
                            </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <a href="/mall-informasi/transparansi/2020" class="icon fa fa-file-alt d-block mb-2"><img src="{{ asset('assets/document.png')}}" class="label" alt="Icon" style="width: 120px; heigth: 120px;"></a>
                                    <h3><b>Transparansi Pengelolaan Anggaran 2020</b></h3>
                                </header>
                                <p class="text-center">.</p>
                            </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <a href="/mall-informasi/transparansi/2019" class="icon fa fa-file-alt d-block mb-2"><img src="{{ asset('assets/document.png')}}" class="label" alt="Icon" style="width: 120px; heigth: 120px;"></a>
                                    <h3><b>Transparansi Pengelolaan Anggaran 2019</b></h3>
                                </header>
                                <p class="text-center">.</p>
                            </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <a href="/mall-informasi/transparansi/2018" class="icon fa fa-file-alt d-block mb-2"><img src="{{ asset('assets/document.png')}}" class="label" alt="Icon" style="width: 120px; heigth: 120px;"></a>
                                    <h3><b>Transparansi Pengelolaan Anggaran 2018</b></h3>
                                </header>
                                <p class="text-center">.</p>
                            </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-4">
                            <div class="content p-3 border rounded">
                                <header class="text-center">
                                    <a href="/mall-informasi/transparansi/2017" class="icon fa fa-file-alt d-block mb-2"><img src="{{ asset('assets/document.png')}}" class="label" alt="Icon" style="width: 120px; heigth: 120px;"></a>
                                    <h3><b>Transparansi Pengelolaan Anggaran 2017</b></h3>
                                </header>
                                <p class="text-center">.</p>
                            </div>
                        </section> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="transparanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h1 class="modal-title fs-5" id="exampleModalLabel">Data Transparansi</h1>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body text-black">
        <div class="table-responsive">
            <table class="table table-striped" id="data-tables">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Tgl. Publish</th>
                    <th>Lampiran</th>
                    <th>Dokumen</th>
                  </tr>
                </thead>
                <tbody id="table-body">
                  <!-- Data akan ditambahkan di sini -->
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
        Tutup
      </button>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="viewLampiran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      {{-- <h1 class="modal-title fs-5" id="exampleModalLabel">Data Transparansi</h1> --}}
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body text-black">
        <table class="table table-striped" id="data-tables-lampiran">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Lampiran</th>
                </tr>
            </thead>
            <tbody id="table-body-lampiran"></tbody>
        </table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
        Tutup
      </button>
    </div>
  </div>
</div>
</div>


<script>
function modalGet(id) {
    $('#transparanModal').modal('show');

    // Ambil instance DataTable yang sudah ada
    const table = $('#data-tables').DataTable();

    // Clear DataTable lama
    table.clear().draw();  // Menghapus data lama dari DataTable
    const tableBody = document.getElementById('table-body');
    
    // Menampilkan status loading di tabel body
    tableBody.innerHTML = `<tr><td colspan="5" class="text-center">Loading...</td></tr>`;

    // Fetch data dari server
    fetch(`{{url('/mall-informasi/transparansi/get-data')}}/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Gagal mengambil data');
            }
            return response.json(); // Mengonversi data yang diterima ke format JSON
        })
        .then(data => {
            const dataIni = data.data;
            tableBody.innerHTML = '';  // Clear body tabel setelah fetch data

            // Menambahkan data ke dalam tabel (sebelum di-update DataTable)
            dataIni.forEach((obj, index) => {
                const row = document.createElement('tr');  // Membuat baris baru

                // Membuat cell untuk setiap kolom
                const cell1 = document.createElement('td');
                cell1.textContent = index + 1;  // Nomor urut
                row.appendChild(cell1);

                const cell2 = document.createElement('td');
                cell2.textContent = obj.title;
                row.appendChild(cell2);

                const cell3 = document.createElement('td');
                cell3.textContent = obj.date_publish;
                row.appendChild(cell3);

                const cell4 = document.createElement('td');
                cell4.innerHTML = `<button type="button" onclick="viewsLampiran('${obj.id}')" class="btn btn-sm btn-secondary">Lampiran</button>`; 
                row.appendChild(cell4);

                const cell5 = document.createElement('td');
                if(obj.docs == null || obj.docs == undefined){
                    var obk = `href="javascript:void(0);" onclick="return alert('Data tidak ditemukan!')"`;
                }else{
                    var obk = `href="{{url('/files')}}/${obj.docs}" target="_blank"`;
                }
                cell5.innerHTML = `<a ${obk} class="btn btn-sm btn-primary">Lihat</a>`; 
                row.appendChild(cell5);

                // Menambahkan baris ke dalam tabel
                tableBody.appendChild(row);

                // Menambahkan data ke DataTable
                table.row.add(row).draw(); // Menambahkan baris ke DataTable
            });
        })
        .catch(error => {
            console.error('Error:', error);  // Menangani error jika fetch gagal
            tableBody.innerHTML = `<tr><td colspan="5" class="text-center text-danger">Gagal memuat data</td></tr>`;  // Menampilkan error
        });
}

</script>

<script>
    function viewsLampiran(id) {
        // $('#transparanModal').modal('hide');
        $('#viewLampiran').modal('show');

        const table = $('#data-tables-lampiran').DataTable();
        table.clear().draw();  // Menghapus data lama dari DataTable
        const tableBody = document.getElementById('table-body-lampiran');
        
        // Menampilkan status loading di tabel body
        tableBody.innerHTML = `<tr><td colspan="3" class="text-center">Loading...</td></tr>`;

        // Fetch data dari server
        fetch(`{{url('/mall-informasi/transparansi/get-lampiran')}}/${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengambil data');
                }
                return response.json(); // Mengonversi data yang diterima ke format JSON
            })
            .then(data => {
                const dataIni = data.data;
                tableBody.innerHTML = '';  // Clear body tabel setelah fetch data

                // Menambahkan data ke dalam tabel (sebelum di-update DataTable)
                dataIni.forEach((obj, index) => {
                    const row = document.createElement('tr');

                    const cell1 = document.createElement('td');
                    cell1.textContent = index + 1;  // Nomor urut
                    row.appendChild(cell1);

                    const cell2 = document.createElement('td');
                    cell2.textContent = `${obj.title ?? '-'}`;  // Nomor urut
                    row.appendChild(cell2);

                    const cell3 = document.createElement('td');
                    const obk = `${obj.file}`;
                    cell3.innerHTML = `<a href="{{url('/files')}}/${obk}">Lihat File Lampiran</a>`;  // Data 'id'
                    row.appendChild(cell3);


                    // Menambahkan baris ke dalam tabel
                    tableBody.appendChild(row);

                    // Menambahkan data ke DataTable
                    table.row.add(row).draw(); // Menambahkan baris ke DataTable
                });

                if (!dataIni || dataIni.length === 0) {
                    tableBody.innerHTML = `<tr><td colspan="3" class="text-center">Data tidak ditemukan...</td></tr>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);  // Menangani error jika fetch gagal
                tableBody.innerHTML = `<tr><td colspan="3" class="text-center text-danger">Gagal memuat data</td></tr>`;  // Menampilkan error
            });
    }
</script>
@endsection