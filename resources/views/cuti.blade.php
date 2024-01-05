    @extends('layouts.app')
    @section('content')
    <h2>Form Tambah Cuti</h2>

    <!-- Form untuk menambahkan karyawan -->
    <form class="col-md-6" id="formTambahCuti" action="{{ url('/api/cuti') }}" method="post">
        @csrf
        <label class="form-label" for="nama">Karyawan:</label>
        <select class="form-control" name="id_karyawan" id="selectKaryawan" required>
            <option value="">Pilih Karyawan</option>
        </select>
        <br>
        <label  class="form-label" for="tgl_cuti">Tanggal Cuti:</label>
        <input class="form-control" type="date" id="tgl_cuti" name="tgl_cuti" required>
        <br>
        <label  class="form-label" for="lama_cuti">Lama Cuti:</label>
        <input class="form-control" type="number" id="lama_cuti" name="lama_cuti" required>
        <br>
        <label  class="form-label" for="keterangan">Keterangan:</label>
        <input class="form-control" type="textarea" id="keterangan" name="keterangan" required>
        <br>
        <button class="btn btn-success" type="submit">Tambah data cuti</button>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/api/karyawan', // Ganti dengan endpoint yang benar
                method: 'GET',
                success: function(response) {
                    // Handle the response and display data using DataTables
                    var karyawanData = response.data;

                    // Populate select options
                    var select = $('#selectKaryawan'); // Ganti dengan ID select Anda
                    select.empty(); // Clear existing options

                    // Loop through karyawanData and append options to select
                    karyawanData.forEach(function(karyawan) {
                        var option = $('<option>')
                            .val(karyawan.id) // Ganti dengan nilai yang sesuai
                            .text(karyawan.nama); // Ganti dengan properti yang sesuai
                        select.append(option);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>

        <!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

<!-- SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

<!-- Skrip Anda -->
<script>
    // Fungsi untuk mengirim data pembaruan menggunakan Ajax
    $('#formTambahCuti').submit(function(event) {
        // Cegah formulir dari pengiriman standar
        event.preventDefault();

        $.ajax({
            url: $('#formTambahCuti').attr('action'),
            type: 'POST',
            data: $('#formTambahCuti').serialize(),
            success: function(response) {
                // Tampilkan SweetAlert dengan pesan sukses
                Swal.fire("Sukses!", "Data berhasil ditambahkan!", "success").then(() => {
                    window.location.href = "/showcuti";
                });
            },
            error: function(error) {
                // Tampilkan SweetAlert dengan pesan kesalahan
                Swal.fire("Error!", "Kuota cuti tidak mencukupi.", "error").then(() => {
                    console.error('Error:', error);
                    window.location.href = "/showcuti";
                });
            }
        });
    });
</script>
   @endsection
