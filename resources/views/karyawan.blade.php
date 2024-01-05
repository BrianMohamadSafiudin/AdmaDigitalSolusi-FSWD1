    @extends('layouts.app')
    @section('content')
    <h2>Form Tambah Karyawan</h2>

    <!-- Form untuk menambahkan karyawan -->
    <form class="col-md-6" id="formTambahKaryawan" action="{{ url('/api/karyawan') }}" method="post">
        @csrf
        <label class="form-label" for="nama">Nama:</label>
        <input class="form-control" type="text" id="nama" name="nama" required>
        <br>
        <label class="form-label" for="alamat">Alamat:</label>
        <input class="form-control" type="text" id="alamat" name="alamat" required>
        <br>
        <label class="form-label" for="tgl_lahir">Tanggal Lahir:</label>
        <input class="form-control" type="date" id="tgl_lahir" name="tgl_lahir" required>
        <br>
        <label class="form-label" for="tgl_bergabung">Tanggal Bergabung:</label>
        <input class="form-control" type="date" id="tgl_bergabung" name="tgl_bergabung" required>
        <br>
        <button class="btn btn-success" type="submit">Tambah Karyawan</button>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

<!-- SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

<!-- Skrip Anda -->
<script>
    // Fungsi untuk mengirim data pembaruan menggunakan Ajax
    $('#formTambahKaryawan').submit(function(event) {
        // Cegah formulir dari pengiriman standar
        event.preventDefault();

        $.ajax({
            url: $('#formTambahKaryawan').attr('action'),
            type: 'POST',
            data: $('#formTambahKaryawan').serialize(),
            success: function(response) {
                // Tampilkan SweetAlert dengan pesan sukses
                Swal.fire("Sukses!", "Data berhasil ditambahkan!", "success").then(() => {
                    window.location.href = "/showkaryawan";
                });
            },
            error: function(error) {
                // Tampilkan SweetAlert dengan pesan kesalahan
                Swal.fire("Error!", "Terjadi kesalahan saat menambahkan data.", "error").then(() => {
                    console.error('Error:', error);
                    window.location.href = "/showkaryawan";
                });
            }
        });
    });
</script>

@endsection
