<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Resep Masakan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            color: #A86809;
        }
        .card {
            display: flex;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .card img {
            width: 150px;
            height: 100px;
            object-fit: cover;
        }
        .card-content {
            padding: 10px;
            flex: 1;
        }
        .card-content h3 {
            margin: 0;
            color: #333;
        }
        .card-content p {
            margin: 5px 0;
            color: #666;
        }
        .card-content a {
            text-decoration: none;
            color: #fff;
            background-color: #A86809;
            padding: 8px 12px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 10px;
        }
        .card-content a:hover {
            background-color: #874C07;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Resep Masakan</h1>

        <?php
        // Contoh data resep masakan
        $resepMasakan = [
            [
                "judul" => "Ayam Goreng Kremes",
                "deskripsi" => "Ayam goreng dengan kremes renyah.",
                "gambar" => "ayam-goreng-kremes.jpg",
                "link" => "#"
            ],
            [
                "judul" => "Soto Ayam Lamongan",
                "deskripsi" => "Soto khas Lamongan dengan koya gurih.",
                "gambar" => "soto-ayam-lamongan.jpg",
                "link" => "#"
            ],
            [
                "judul" => "Nasi Goreng Spesial",
                "deskripsi" => "Nasi goreng lengkap dengan telur dan sosis.",
                "gambar" => "nasi-goreng-spesial.jpg",
                "link" => "#"
            ]
        ];

        // Looping untuk menampilkan data resep
        foreach ($resepMasakan as $resep) {
            echo '
            <div class="card">
                <img src="' . $resep["gambar"] . '" alt="' . $resep["judul"] . '">
                <div class="card-content">
                    <h3>' . $resep["judul"] . '</h3>
                    <p>' . $resep["deskripsi"] . '</p>
                    <a href="' . $resep["link"] . '">Lihat Resep</a>
                </div>
            </div>';
        }
        ?>
    </div>
</body>
</html>
