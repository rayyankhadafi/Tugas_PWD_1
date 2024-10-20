<?php
    session_start();
    include 'koneksi.php';

    if (!isset($_SESSION["loggedin"])) {
        header('Location: login.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $nama = $_POST['nama'];
        $institusi = $_POST['institusi'];
        $country = $_POST['country'];
        $address = $_POST['address'];

        if (!empty($email) && !empty($nama) && !empty($institusi) && !empty($country) && !empty($address)) {
            $query = $conn->prepare("SELECT email FROM registration WHERE email = ?");
            $query->bind_param('s', $email);
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows > 0) {
                echo 'Email sudah terdaftar, silahkan menggunakan email yang lain.';
            } else {
                $stmt = $conn->prepare("INSERT INTO registration (email, nama, institusi, country, address) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param('sssss', $email, $nama, $institusi, $country, $address);

                if ($stmt->execute()) {
                    echo 'Data berhasil ditambah';
                } else {
                    echo 'Error: ' . $stmt->error;
                }
                $stmt->close();
            }
            $query->close();
        } else {
            echo 'Mohon untuk mengisi data terlebih dahulu';
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tambah Peserta</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            font-family: arial, sans-serif;
            background-color: rgb(212, 212, 212);
        }
        
        div{
            background-color: #fff;
            margin: 10% auto;
            border-radius: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            padding: 20px;
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
        }

        div table{
            width: 100%;
        }

        div table td{
            padding: 10px;
            text-align: left;
        }

        div input[type="text"],
        input[type="email"]{
            width: 100%;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        div input[type="submit"]{
            border: none;
            color: white;
            background-color: #4CAF50;
            cursor: pointer;
            border-radius: 5px;
            padding: 5px;
        }

        div input[type="submit"]:hover{
            background-color: #45a049;
        }

        @media(min-width:600px){
            div{
                width: 50%;
            }
        }

        @media(min-width:1024px){
            div{
                width: 30%;
            }
        }
    </style>
</head>
<body>
     <div>
    <form method="POST">
        <table>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="email" name="email" required></td>
            </tr>
            <tr>
                <td><label for="nama">Nama</label></td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td><label for="institusi">Institusi</label></td>
                <td><input type="text" name="institusi" required></td>
            </tr>
            <tr>
                <td><label for="country">Country</label></td>
                <td><input type="text" name="country" required></td>
            </tr>
            <tr>
                <td><label for="address">Address</label></td>
                <td><input type="text" name="address" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right"><input type="submit" value="Tambah"></td>
            </tr>
        </table>
    </form>
    </div>
</body>
</html>
