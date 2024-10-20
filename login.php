<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];  // Ambil nilai username dari form
    $password = $_POST['password'];  // Ambil nilai password dari form

    if ($username == 'admin' && $password == 'admin') {
        $_SESSION['loggedin'] = true;  // Perbaikan typo pada 'loggedin'
        $_SESSION['username'] = $username;
        header('Location: admin.php');  // Redirect ke halaman admin
        exit;
    } else {
        echo 'Username dan Password yang anda masukkan salah';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body{
            margin: 0;
            padding: 0;
            font-family: arial, sans-serif;
            background-color: rgb(212, 212, 212);
        }

        div{
            margin: 10% auto;
            width: 90%;
            max-width: 500px;
            background-color: #fff;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        div table{
            width: 100%;
        }

        div table td{
            padding: 10px;
            text-align: left;
        }

        table input[type="text"],
        input[type="password"]{
            padding: 5px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        
        table input[type="submit"]{
            border: none;
            color: white;
            background-color: #4CAF50;
            border-radius: 5px;
            cursor: pointer;
            padding: 5px;
        }

        table input[type="submit"]:hover{
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
<div class="container">
    <form method="POST">
        <table>
            <tr>
                <td>
                    <label for="username">Username</label>
                </td>
                <td>
                    <input type="text" name="username" required>
                </td>    
            </tr>
            <tr>
                <td>
                    <label for="password">Password</label>
                </td> 
                <td>
                    <input type="password" name="password" required>
                </td> 
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;">
                    <input type="submit" value="Login">
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
