<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Form</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: rgb(212, 212, 212);
            font-family: Arial, sans-serif;
        }

        .container-form {
            background-color: #fff;
            width: 90%; /* Default lebar untuk mobile */
            max-width: 500px; /* Batas maksimal lebar form */
            padding: 20px;
            margin: 5% auto; 
            border-radius: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .container-form table {
            width: 100%; /* Form mengikuti lebar container */
        }

        .container-form table td {
            padding: 10px;
            text-align: left;
        }

        .container-form input[type="text"],
        .container-form input[type="email"] {
            width: 100%; /* Input akan mengikuti lebar kolom */
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .container-form input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .container-form input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Media Queries untuk layar yang lebih besar */
        @media (min-width: 600px) {
            .container-form {
                width: 50%; /* Lebar form untuk tablet atau layar yang lebih besar */
            }
        }

        @media (min-width: 1024px) {
            .container-form {
                width: 30%; /* Lebar form untuk desktop */
            }
        }
    </style>
</head>
<body>
    <div class='container-form'>
        <form class='cont-form' action="connData.php" method="POST">
            <table>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="email" name='email' required></td>
                </tr>
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td><input type="text" name='nama' required></td>
                </tr>
                <tr>
                    <td><label for="institusi">Institusi</label></td>
                    <td><input type="text" name='institusi' required></td>
                </tr>
                <tr>
                    <td><label for="country">Country</label></td>
                    <td><input type="text" name='country' required></td>
                </tr>
                <tr>
                    <td><label for="address">Address</label></td>
                    <td><input type="text" name='address' required></td>
                </tr>
                <tr>
                    <td colspan='2' style='text-align:right'><input type="submit" value='Kirim'></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
