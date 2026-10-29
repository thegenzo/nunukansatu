<script>
    var nikAdmins_ = `${JSON.parse(localStorage.getItem('userData'))?.nik}`;
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
    function updateDataModal(id, nama, opd, pagu, metode, rencana_pelaksanaan, sumber_dana){
        $('#idData').val(id)
        $('#nama').val(nama)
        $('#opd-selector').val(opd)
        $('#pagu').val(pagu)
        $('#metode').val(metode)
        $('#rencana_pelaksanaan').val(rencana_pelaksanaan)
        $('#sumber_dana').val(sumber_dana)
        $('#dataModal').modal('show')
    }

    function savedYear() {
        var year = $('#year').val();
        var file = $('#inputfiles')[0].files[0]; // Get the selected file

        // Check if the year and file are provided
        if (!year || !file) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Tahun dan file harus diisi!'
            });
            return; // Stop execution if required fields are missing
        }

        var formData = new FormData(); // Use FormData to handle file uploads
        formData.append('year', year); // Append the year data
        formData.append('file', file); // Append the file data

        // Perform the AJAX request to submit the data
        $.ajax({
            type: 'POST',
            url: '{{ route('web.mall-informasi.strategis-create') }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            processData: false, // Don't process the data (necessary for file uploads)
            contentType: false, // Don't set content type, FormData will handle it
            dataType: 'json',
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Menyimpan data berhasil!'
                });
                $('#year').val(''); // Clear input after successful submission
                $('#file').val(''); // Clear the file input after submission
                location.reload(); // Reload the page
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Menyimpan gagal! Periksa koneksi atau coba lagi.'
                });
            }
        });
    }


    function updateYear() {
        var year = $('#updateyear').val();
        var id = $('#updateyearId').val();
        var file = $('#updatefiles')[0].files[0]; // Get the file input

        // Validate the inputs to ensure that both year, id, and file are provided
        if (!year || !id) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Tahun, ID'
            });
            return; // Stop execution if required fields are missing
        }

        var formData = new FormData(); // Use FormData to handle the file upload
        formData.append('year', year); // Append the year to the form data
        formData.append('id', id); // Append the id to the form data
        formData.append('file', file); // Append the file to the form data

        // Perform the AJAX request to update the year
        $.ajax({
            type: 'POST',
            url: '{{ route('web.mall-informasi.strategis-update') }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            processData: false, // Don't process the data, necessary for file uploads
            contentType: false, // Don't set content type, FormData will handle it
            dataType: 'json',
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Mengubah data berhasil!'
                });

                $('#yearUpdateModal').modal('hide')
                // Optionally, clear the input fields after successful update
                $('#updateyear').val('');
                $('#updateyearId').val('');
                $('#updatefile').val(''); // Clear the file input after submission

                location.reload(); // Reload the page to reflect the changes
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Mengubah data gagal! Periksa koneksi atau coba lagi.'
                });
            }
        });
    }


    
</script>

<script>
    async function loadOPD() {
        // try {
            const response = await fetch('https://profil.nunukankab.go.id/api/opd', {
                method: 'GET', // or 'POST', 'PUT', etc.
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            const data = await response.json();

            const opdSelect = document.getElementById('opd-selector');
            opdSelect.innerHTML = '<option value="">-- Pilih OPD --</option>';

            data.data.forEach(opd => {
            const option = document.createElement('option');
            option.value = opd.nama_organisasi;
            option.textContent = opd.nama_organisasi;
            opdSelect.appendChild(option);
            });
        
    }

    // Call the function when the page loads
    document.addEventListener('DOMContentLoaded', loadOPD);
</script>
