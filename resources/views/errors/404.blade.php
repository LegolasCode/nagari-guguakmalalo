<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan - 404</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #003d4d;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .error-container {
            text-align: center;
            padding: 40px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 90%;
        }
        .error-code {
            font-size: 120px;
            font-weight: bold;
            color: #003d4d; 
            line-height: 1;
            margin-bottom: 20px;
        }
        .error-message {
            font-size: 24px;
            color: #343a40;
            margin-bottom: 15px;
        }
        .error-description {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 30px;
        }
        .home-button {
            background-color: #f0e68c; 
            color: black;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .home-button:hover {
            background-color: #e0d67c;
            color: black; 
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <h1 class="error-message">Not Found</h1>
        <p class="error-description">
            Maaf, halaman yang Anda cari tidak ada. Mungkin Anda salah mengetik alamat, atau halaman tersebut telah dipindahkan.
        </p>
        <a href="{{ url('/') }}" class="home-button">Kembali</a>
    </div>
</body>
</html>