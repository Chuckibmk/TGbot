<?php

if(isset($_POST['load'])){
    $_SESSION['loaded_user'] = $_POST['id'];
    exit(header("Location: index.php"));
}elseif(isset($_POST['deleteUser'])){
    $user->deleteUser($_POST['id']);
    exit(header("location: index.php"));
}

$users = $user->allUsers();
$admins = $user->allAdmins();
$pDeposits = $user->pendingDeposit();
$paDeposits = $user->paidpendingDeposit();
$aDeposits = $user->approvedDeposit();
// $pWithdrawals = $user->pendingWithdrawal();
// $aWithdrawals = $user->approvedWithdrawal();

$product = $user->allproducts();

if(isset($_POST['adminame'])){
    $adinmae = $_POST["adminame"];
    $pwd = $_POST["pwd"];
    $user->createadmin($adinmae,$pwd);

    header("Location: index.php");
}
if(isset($_POST['removeAdmin'])){
    $id = $_POST["id"];
    $user->deladmin($id);

    header("Location: index.php");
}


//////////////////products

if(isset($_POST['proname'])){
    $proname = $_POST["proname"];
    $protext = $_POST["protext"];
    $prourl = $_POST["prourl"];
    
    
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["upload"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        header("Location: index.php");
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            header('Location: index.php');
            
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    
    $user->addProd($proname,$protext,$target_file,$prourl);

    header("Location: index.php");
}

if(isset($_POST['dpid'])){
    $dpid = $_POST["dpid"];
    $user->delProd($dpid);

    header("Location: index.php");
}

if(isset($_POST['editname'])){
    $name = $_POST["editname"];
    $text = $_POST["edittext"];
    $url = $_POST["editurl"];
    $eid = $_POST["editid"];
    
    if($_FILES["editimg"]["error"] == 4){
        $target_file = $_POST["hidimg"];
    }else{
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["editimg"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        // Check if image file is a actual image or fake image
        if(isset($_POST["upload"])) {
            $check = getimagesize($_FILES["editimg"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        
        // Check file size
        if ($_FILES["editimg"]["size"] > 50000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            header("Location: index.php");
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["editimg"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["editimg"]["name"])). " has been uploaded.";
                header('Location: index.php');
                
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    
    $user->upProd($eid,$name,$text,$target_file,$url);

    header("Location: index.php");
}
