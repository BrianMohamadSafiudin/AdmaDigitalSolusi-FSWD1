<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Menggunakan CDN -->

</head>
<body>
    <h2>Login</h2>
    
    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif

    <form id="loginForm" method="POST" action="{{ url('/api/login') }}">
        @csrf

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="button" onclick="login()">Login</button>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Fungsi untuk mengirim data login menggunakan Ajax
        function login() {
            $.ajax({
                url: $('#loginForm').attr('action'),
                type: 'POST',
                data: $('#loginForm').serialize(),
                success: function(response) {
                    // Tampilkan pesan sukses atau lakukan aksi lain yang diinginkan
                    alert(response.message);

                    // Redirect atau lakukan aksi lain setelah login sukses
                    window.location.href = "/showkaryawan";
                },
                error: function(error) {
                    // Tangani kesalahan jika terjadi
                    console.error('Error:', error);
                }
            });
        }
    </script>
</body>
</html>
