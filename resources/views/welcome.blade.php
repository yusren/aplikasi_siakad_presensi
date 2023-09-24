<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Siakad STKIP Pacitan</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        body,
        html {
            height: 100%;
            justify-content: center;
            align-items: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url('{{ asset(' img/ils.jpg') }}');
            position: relative;
            /* Tambahkan ini untuk memungkinkan overlay */
        }

        body::before {
            content: "";
            background: rgba(0, 0, 0, 0.3);
            /* Warna gelap (hitam) dengan opacity 0.3 */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .btn-container {
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .login-btn {
            margin: 10px;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="btn-container">
        <h2 style="color: white;">SIAKAD STKIP PGRI PACITAN</h2>
        @auth
        <a href="/dashboard" class="btn btn-primary login-btn">Dashboard</a>
        @else
        <a href="/login-mhs" class="btn btn-primary login-btn">Login Mahasiswa</a>
        <a href="/login" class="btn btn-secondary login-btn">Login Dosen & Karyawan</a>
        @endauth
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>
