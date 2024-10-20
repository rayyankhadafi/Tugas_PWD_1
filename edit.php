
<?php
session_start();
include 'koneksi.php';

// Mengecek apakah user sudah login atau belum
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

// Mendapatkan data berdasarkan id
if (!isset($_GET['id'])) {
    // Jika tidak ada, redirect ke halaman admin atau tampilkan pesan error
    header('Location: admin.php');
    exit;
}
$id = $_GET['id'];
$sql = "SELECT * FROM registration WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Memproses data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $institusi = $_POST['institusi'];
    $country = $_POST['country'];
    $address = $_POST['address'];

    // Menggunakan prepared statement untuk update data
    $sql = "UPDATE registration SET email = ?, nama = ?, institusi = ?, country = ?, address = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssi', $email, $nama, $institusi, $country, $address, $id);

    if ($stmt->execute()) {
        header('Location: admin.php');
        exit;
    } else {
        echo 'Error: ' . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: rgb(212, 212, 212);
        }

        div {
            padding: 20px;
            margin: 10% auto;
            background-color: #fff;
            width: 90%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            padding: 10px;
            text-align: left;
        }

        /* table td label {
            display: inline-block;
            width: 120px;
            text-align: left;
        } */

        table input[type="text"], 
        table input[type="email"] {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px:
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        @media(min-width: 600px){
            div{
                width: 50%;
            }
        }
        @media(min-width: 1024px){
            div{
                width: 30%;
            }
        }
    </style>
</head>
<body>
    <!-- Form untuk Update Data -->
    <div>
        <form method="POST">
            <table>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required></td>
                </tr>
                <tr>
                    <td><label for="nama">Nama:</label></td>
                    <td><input type="text" name="nama" value="<?= htmlspecialchars($row['nama']) ?>" required></td>
                </tr>
                <tr>
                    <td><label for="institusi">Institusi:</label></td>
                    <td><input type="text" name="institusi" value="<?= htmlspecialchars($row['institusi']) ?>" required></td>
                </tr>
                <tr>
                    <td><label for="country">Country:</label></td>
                    <td><input type="text" name="country" value="<?= htmlspecialchars($row['country']) ?>" required></td>
                </tr>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><input type="text" name="address" value="<?= htmlspecialchars($row['address']) ?>" required></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;">
                        <input type="submit" value="Update">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
