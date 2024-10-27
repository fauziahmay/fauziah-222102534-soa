<?php
// Koneksi ke database PostgreSQL
$host = 'aws-0-ap-southeast-1.pooler.supabase.com';
$dbname = 'postgres';
$username = 'jmjmrwhybxneqratrigj';
$password = 'N0vianputRi';
$port = '6543';

// Mencoba untuk membuat koneksi menggunakan PDO
try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    // Set error mode PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query untuk mengambil data dari tabel 'products'
    $query = "SELECT * FROM products";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Menampilkan data dalam bentuk tabel HTML
    echo "<!DOCTYPE html>
    <html lang='id'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Data Products</title>
        <!-- Link Font Awesome untuk menggunakan ikon -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                color: #333;
                padding: 20px;
            }
            table {
                border-collapse: collapse;
                width: 100%;
                margin: 20px 0;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #d17070;
                color: white;
            }
            .action-buttons {
                display: flex;
                gap: 10px;
            }
            .action-buttons a {
                padding: 5px;
                text-decoration: none;
                color: white;
                border-radius: 5px;
                display: inline-block;
                width: 30px;
                height: 30px;
                text-align: center;
                line-height: 30px;
            }
            .action-buttons .edit {
                background-color: #4CAF50; /* Hijau untuk edit */
            }
            .action-buttons .delete {
                background-color: #f44336; /* Merah untuk hapus */
            }
            .back-button {
                background-color: #d17070;
                color: white;
                padding: 10px 15px;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 20px;
                display: inline-block;
            }
            .back-button:hover {
                background-color: #b05f5f;
            }
        </style>
    </head>
    <body>
        <h1>Data Products</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category ID</th>
                <th>Action</th>
            </tr>";

    // Mengambil hasil query dan menampilkannya
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
        echo "<td>" . htmlspecialchars($row['price']) . "</td>";
        echo "<td>" . htmlspecialchars($row['categori']) . "</td>";
        echo "<td>
                <div class='action-buttons'>
                    <a href='edit_product.php?id=" . $row['id'] . "' class='edit'>
                        <i class='fas fa-pencil-alt'></i>
                    </a>
                    <a class='delete' href='delete_product.php?id=" . $row['id'] . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus produk ini?');\">
                        <i class='fas fa-trash'></i>
                    </a>
                </div>
              </td>";
        echo "</tr>";
    }

    echo "</table>
        <a class='back-button' href='index.html'>Kembali</a>
    </body>
    </html>";

} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}

// Menutup koneksi
$conn = null;
?>
