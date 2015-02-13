<?php
require_once './Resize.php';
if (!isset($_POST['imgbs64'])) {
    if (isset($_FILES)) {
        foreach ($_FILES as $file) {
            $allowedExts = array("gif", "jpeg", "jpg", "png");
            $temp = explode(".", $file["name"]);
            $fileextnsn = strtolower(end($temp));
            if (!in_array($fileextnsn, $allowedExts)) {
                $response = array(
                    "status" => 'error',
                    "message" => 'Unsupported File type...',
                );
                echo json_encode($response);
                die();
            }
            $filename = rand() . "." . $fileextnsn;
            move_uploaded_file($file['tmp_name'], 'uploads/' . $filename);
            $source = 'uploads/' . $filename;
            chmod($source, 0777);
            $resizeObj = new Resize($source);
            $newDimention = $resizeObj->resizeImage(300, 300, 'auto');
            $resizeObj->saveImage($source, 100);
            $cropedimageurl = 'uploads/' . $filename;
            $response = array(
                "status" => 'success',
                "url" => $cropedimageurl,
                "newDimention" => $newDimention
            );
        }
    } else {
        $response = array(
            "status" => 'error',
            "message" => 'something went wrong',
        );
    }
    echo json_encode($response);
    die();
} else {
    $temp1 = explode(',', $_POST['imgbs64']);
    $temp2 = explode(".", $_POST['imgurl']);
    $base64_string = end($temp1);
    $base64_string = base64_decode($base64_string);
    $imgname = time() . rand() . "." . end($temp2);
    $source = imagecreatefromstring($base64_string);
    $uploadFilePath = 'uploads/' . $imgname;
    if (file_exists($uploadFilePath)) {
        unlink($uploadFilePath);
    }
    $imageSave = imagejpeg($source, $uploadFilePath, 100);
    chmod($uploadFilePath, 0777);
    imagedestroy($source);
    $uploadFileUrl = 'uploads/' . $imgname;
    echo json_encode($uploadFileUrl);
    die();
}
