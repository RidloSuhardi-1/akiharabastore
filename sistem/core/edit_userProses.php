<?php

    session_start();

    include "conn.php";

    if (!isset($_SESSION['username-user']))
    {
        header("location: ../../views/login.php?message=please_login");
    }

    // mulai terima data
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];
    $profil = $_POST['profil_pic'];
    $check = $_POST['del_profil'];

    // image validation
    $allowedFormat = array('png','jpg','jpeg');
    $fileName = $_FILES['profil_pic']['name'];
    $x = explode(".", $fileName);
    $format = strtolower(end($x));
    $fileSize =  $_FILES['profil_pic']['size'];
    $fileTmp = $_FILES['profil_pic']['tmp_name'];

    $getID = $_SESSION['id_user'];
    $generateImageName = "USERPROFILE-".$getID.$fileName;

    // eksekusi
    if (empty($fileName)) {
        if (empty($check))
        {
            $changeName = strtoupper($nama);
            $sql = mysqli_query($connect, "UPDATE user SET nama = '".$nama."', email = '".$email."', telp = '".$telp."' WHERE id_user = '".$_GET['id_user']."' ");
    
            if ($sql) {
                header("location: ../../views/user/user/accountDash.php");
                echo "<script>alert('Data berhasil diperbarui');</script>";
            } else {
                header("location: ../../views/user/user/accountDash.php");
                echo "<script>alert('Data gagal diperbarui');</script>";
            }
        }
        else
        {
            $changeName = strtoupper($nama);
            $sql = mysqli_query($connect, "UPDATE user SET nama = '".$nama."', email = '".$email."', telp = '".$telp."', profil_pic = 'not-set' WHERE id_user = '".$_GET['id_user']."' ");
    
            if ($sql) {
                header("location: ../../views/user/user/accountDash.php");
                echo "<script>alert('Data berhasil diperbarui');</script>";
            } else {
                header("location: ../../views/user/user/accountDash.php");
                echo "<script>alert('Data gagal diperbarui');</script>";
            }
        }


    } else {
        // jika gambar tidak kosong
        if (in_array($format, $allowedFormat) === true) {
            if ($fileSize < 2044070) {
                move_uploaded_file($fileTmp, "../upload-data/profile-pic/".$generateImageName);
                
                // mulai simpan data jika memenuhi
                
                $changeName = strtoupper($nama);
                $sql = mysqli_query($connect, "UPDATE user SET nama = '".$nama."', email = '".$email."', telp = '".$telp."', profil_pic = '".$generateImageName."' WHERE id_user = '".$_GET['id_user']."' ");
    
                if ($sql) {
                    header("location: ../../views/user/user/accountDash.php");
                } else {
                    header("location: ../../views/user/user/accountDash.php");
                }
            
            // jika gambar terlalu besar
            } else {
                header("location: ../../views/user/user/accountDash.php");
            }
    
        // jika format salah
        } else {
            header("location: ../../views/user/user/accountDash.php");
        }
    }

        
    // eksekusi
    
?>