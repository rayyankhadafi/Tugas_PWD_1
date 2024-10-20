<?php
include 'koneksi.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $institusi = $_POST['institusi'];
    $country = $_POST['country'];
    $address = $_POST['address'];

    if(!empty($email) && !empty($nama) && !empty($institusi) && !empty($country) && !empty($address)){
        $query = $conn->prepare('SELECT email FROM registration WHERE email = ?');
        $query->bind_param('s', $email);
        $query->execute();
        $result = $query->get_result();

        if($result->num_rows > 0){
            echo 'Email sudah terdaftar, silahkan menggunakan email yang lain.';
        }else{
            $stmt = $conn->prepare("INSERT INTO registration (email, nama, institusi, country, address) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('sssss', $email, $nama, $institusi, $country, $address);

            if($stmt->execute()){
                echo 'Data berhasil ditambah';
            }else{
                echo 'Error: ' . $stmt->error;
            }
            $stmt->close();
        }
        $query->close();
        }else{
            echo "Mohon untuk mengisi data terlebih dahulu";
        }

}

$conn->close();
?>