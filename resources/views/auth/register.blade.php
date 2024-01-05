<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    
    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif

    <form id="registerForm" action="{{ url('/api/register') }}" method="post">
        @csrf

        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" required>

        <button type="button" onclick="register()">Register</button>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function register() {
            $.ajax({
                url: $('#registerForm').attr('action'),
                type: 'POST',
                data: $('#registerForm').serialize(),
                success: function(response) {
                    // Tampilkan pesan sukses atau lakukan aksi lain yang diinginkan
                    alert(response.message);
                    // Redirect atau lakukan aksi lain setelah login sukses
                    window.location.href = "/login";
                },
                error: function(error) {
                    console.error('Error:', error);
                    alert(response.message);
                }
            });
        }
    </script>
</body>
</html>
