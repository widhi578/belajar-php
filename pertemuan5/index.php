<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Pencarian Film</title>
</head>
<body>
    <form action="" method="GET">
        <input type="text" name="judul" placeholder="Cari film...Z">
        <button type="submit">Cari</button>
    </form>

    <?php
    // ambil input dari form
    if (isset($_GET['judul'])) {

        $keyword = rawurlencode($_GET['judul']);

        cariFilm($keyword);
    }
    ?>

    <?php
    function cariFilm($keyword) {
        // Contoh menggunakan OMDb API (kamu butuh API Key dari omdbapi.com)
        $apiKey = "2901a77e"; 
        $endpoint = "http://www.omdbapi.com/?i=tt3896198&apikey=2901a77e";

        // 1. Inisiasi cURL
        $ch = curl_init();

        // 2. Set opsi cURL
        curl_setopt($ch, CURLOPT_URL, $endpoint);   

        // Mengembalikan hasil sebagai string, bukan langsung dicetak ke layar
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

        // 3. Eksekusi cURL dan simpan responnya
        $response = curl_exec($ch);

        // 4. Tutup koneksi cURL untuk menghemat memori
        curl_close($ch);

        // 5. Olah data (lihat langkah selanjutnya)
        olahDataJSON($response);
    }
    ?>

    <?php
    function olahDataJSON($response) {
        // Parameter 'true' mengubah JSON object menjadi array PHP
        $data = json_decode($response, true);

        // Cek apakah API merespon dengan sukses
        if ($data['Response'] == "True") {
            echo "<h2>Hasil Pencarian:</h2>";
            echo "<div class='container-film'>";
            
            // Looping array 'Search' bawaan OMDb
            foreach ($data['Search'] as $film) {
                $judul = $film['Title'];
                $tahun = $film['Year'];
                $poster = $film['Poster'];

                // Tampilkan ke dalam layout HTML
                echo "<div class='card-film'>";
                if ($poster != "N/A") {
                    echo "<img src='$poster' alt='Poster $judul'>";
                }
                echo "<h3>$judul ($tahun)</h3>";
                echo "</div>";
            }
            
            echo "</div>";
        } else {
            // Menangani error jika film tidak ditemukan
            echo "<p>Film tidak ditemukan: " . $data['Error'] . "</p>";
        }
    }
?>
</body>
</html>