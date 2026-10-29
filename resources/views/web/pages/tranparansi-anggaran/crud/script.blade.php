<script>
    function yearModal(){
        $('#yearModal').modal('show')
    }
    function dataModal(){
        $('#title').val('')
        $('#idData').val('create')
        $('#dataModal').modal('show')
    }
    function updateYearModal(id, year){
        $('#updateyear').val(year)
        $('#updateyearId').val(id)
        $('#yearUpdateModal').modal('show')
    }
    function updateDataModal(id, title, date_publish){
        $('#idData').val(id)
        $('#title').val(title)
        $('#date_publish').val(date_publish)
        $('#dataModal').modal('show')
    }

    function savedYear(){
        var year = $('#year').val()
        let _data = { year: year};
        $.ajax({
                type: 'POST',
                url: `{{ route('web.mall-informasi.transparansi-create') }}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                'dataType': 'json',
                'data': _data,
                success: function(data){
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "Menyimpan data berhasil!"
                    });

                    location.reload();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Menyimpan gagal!"
                    });
                }
            });

    }

    function updateYear(){
        var year = $('#updateyear').val()
        var id = $('#updateyearId').val()
        // alert(id)
        let _data = { year: year, id: id};
        $.ajax({
                type: 'POST',
                url: `{{ route('web.mall-informasi.transparansi-update') }}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                'dataType': 'json',
                'data': _data,
                success: function(data){
                    // Swal.fire({
                    //     icon: "success",
                    //     title: "Berhasil",
                    //     text: "Mengubah data berhasil!"
                    // });

                    location.reload();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Mengubah gagal!"
                    });
                }
        });

    }


    function addlampiran(id){
        $('#modalLampiran').modal('show')
        $('#lampiranDataId').val(id)
    }

    function addLampiranData() {
        var id = $('#lampiranDataId').val();
        var fileInput = document.getElementsByName('lampiran[]');
        var titleInput = document.getElementsByName('titleLamp[]');
        if (fileInput.length === 0) {
            Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "File harus di isi!"
                });
            return;
        }

        var formData = new FormData();
        formData.append('id', id); 

        for (let i = 0; i < titleInput.length; i++) {
        var title_ = titleInput[i].value;
        var file = fileInput[i].files[0];
        
        if (title_ && file) {
            formData.append('title[]', title_);
            formData.append('files[]', file);
        } else {
            alert('Semua input harus diisi!');
            return;
        }
    }

        $.ajax({
            type: 'POST',
            url: `{{ route('web.mall-informasi.lampiran-create') }}`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            processData: false, // Jangan memproses data
            contentType: false, // Jangan mengubah tipe konten
            dataType: 'json',
            success: function (data) {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: "Menyimpan data berhasil!"
                });

                location.reload(); // Memuat ulang halaman setelah berhasil
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Menyimpan gagal!"
                });
            }
        });
    }

    
</script>

<script>
    function viewsLampiran(id) {
        $('#viewLampiran').modal('show');

        const table = $('#data-tables').DataTable();
        table.clear().draw();  // Menghapus data lama dari DataTable
        const tableBody = document.getElementById('table-body');
        
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
                    var title = `${obj.title ?? '-'}`;
                    cell1.innerHTML = `${title}`;  // Data 'id'
                    row.appendChild(cell1);

                    const cell2 = document.createElement('td');
                    const obk = `${obj.file}`;
                    cell2.innerHTML = `<a href="{{url('/files')}}/${obk}">Lihat File Lampiran</a>`;  // Data 'id'
                    row.appendChild(cell2);

                    const cell3 = document.createElement('td');
                    cell3.innerHTML = `<a href="{{url('/mall-informasi/transparansi-data/delete-lampiran')}}/${obj.id}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="btn btn-sm btn-primary">Hapus</a>`;  // Data 'docs'
                    row.appendChild(cell3);

                    // Menambahkan baris ke dalam tabel
                    tableBody.appendChild(row);

                    // Menambahkan data ke DataTable
                    table.row.add(row).draw(); // Menambahkan baris ke DataTable
                });
            })
            .catch(error => {
                console.error('Error:', error);  // Menangani error jika fetch gagal
                tableBody.innerHTML = `<tr><td colspan="3" class="text-center text-danger">Gagal memuat data</td></tr>`;  // Menampilkan error
            });
    }
</script>
<script>
function tambahInput(){
    // Create a unique timestamp for each input set
    var timed = new Date().toISOString().replace(/[-T:.Z]/g, '').slice(2); // Create a unique timestamp
    
    // Append new input fields with a unique id for the container
    $('#new_inputs').append(`
        <div id="inputs${timed}">
            <div class="text-end">
                <button class="btn btn-sm btn-secondary mt-2" type="button" onclick="delInputs('inputs${timed}')">Hapus</button>
            </div>
            <div class="form-group mt-3">
                <label for="">Judul</label>
                <input type="text" class="form-control" name="titleLamp[]" id="titleLampiran">
            </div>
            <div class="form-group mt-3">
                <label for="">Lampiran</label>
                <input type="file" class="form-control" name="lampiran[]" id="fileLampiran">
            </div>
        </div>
    `);
}

function delInputs(a){
    // Remove the element with the given ID
    $(`#${a}`).remove();
}

</script>