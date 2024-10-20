<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Table</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: rgb(212, 212, 212);
        }

        div {
            position: relative;
            border-radius: 10px;
            background-color: #fff;
            width: 90%;
            padding: 20px;
            margin: auto;
            margin-top: 10%;
            max-width: 1200px; /* Batasi lebar maksimum */
            box-sizing: border-box;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto; /* Membuat tabel mengikuti konten */
        }

        th, td {
            padding: 10px;
            border: 1px solid black;
            text-align: left;
            box-sizing: border-box;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2; /* Warna latar belakang header */
        }
        .t-logout{
            top: 10px; 
            position: relative;
        }
        .t-logout, .t-edit, .t-delete, .t-tambah{
            text-decoration: none;
            padding: 4px;
            background-color: #4CAF50;
            border-radius: 4px;
            color: white;
            font-size: 12px;
        }
        
        .t-logout:hover, .t-edit:hover, .t-delete:hover, .t-tambah:hover{
            background-color: #45a049;
        }

        @media (max-width: 768px) {
            td, th, .t-logout, .t-logout, .t-edit, .t-delete, .t-tambah{
                padding: 2px;
                font-size: 10px; /* Kurangi ukuran font di layar kecil */
            }

            a {
                font-size: 10px; /* Ukuran font untuk tautan di layar kecil */
                padding: 1px; /* Padding untuk tautan di layar kecil */
            }
        }

        @media (max-width: 480px) {
            table, th, td, .t-logout, .t-edit, .t-delete, .t-tambah {
                display: block;
                width: 100%;
            }

            th, td, .t-logout, .t-edit, .t-delete, .t-tambah{
                padding: 10px;
                display: block;
                text-align: right;
                position: relative;
            }

            th::before, td::before {
                content: attr(data-label); /* Menambahkan label di depan setiap kolom pada layar kecil */
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }
        }
    </style>
</head>
<body>
    <?php
    session_start();
    include 'koneksi.php';

    if (!isset($_SESSION['loggedin'])) {
        header('Location: login.php');
        exit;
    }

    $sql = 'SELECT * FROM registration WHERE is_deleted = 0';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<div>';
        echo '<table>
        <tr>
        <th>Email</th>
        <th>Nama</th>
        <th>Institusi</th>
        <th>Country</th>
        <th>Address</th>
        <th>Actions</th>
        </tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
            <td data-label="Email">' . $row['email'] . '</td>
            <td data-label="Nama">' . $row['nama'] . '</td>
            <td data-label="Institusi">' . $row['institusi'] . '</td>
            <td data-label="Country">' . $row['country'] . '</td>
            <td data-label="Address">' . $row['address'] . '</td>
            <td data-label="Actions">
            <a class="t-edit" href="edit.php?id=' . $row['id'] . '">Edit</a> | 
            <a class="t-delete" href="delete.php?id=' . $row['id'] . '">Delete</a> |
            <a class="t-tambah" href="addData.php?id=' . $row['id'] . '">Tambah peserta</a>
            </td>
            </tr>';
        }
        echo '</table>';
    } else {
        echo 'Data tidak ada';
    }
    echo "<a class='t-logout' href='logout.php'>Logout</a>";
    echo '</div>';
    $conn->close();
    ?>
</body>
</html>
