<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Image Cropper Example -- Sourav Mondal</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/style.css">
    </head>
    <body>
        <div class="panel panel-primary dragzone">
            <div class="panel-heading">
                Upload and Crop Photo with Drag and Drop -- By Sourav Mondal
            </div>
            <div class="panel-body profileimagesection">
                <div class="hide" id="uploadprogress"><i class="fa fa-spinner fa-4x fa-spin"></i>Uploading...Please wait</div>
                <input type="file" name="profileImage" id="profileImage" accept="image/gif, image/jpeg"/><br/>
                <label id="draglabel">Or Drag and Drop Image here</label>
                <canvas id="panel"></canvas><br/>
                <div id="results">
                    <img id="crop_result" />
                </div><br/>
                <input type="hidden" value="" name="imageurl" id="imageurl"/>
                <div class="contr">
                    <a href="javascript:void(0)" onclick="getResults()" class="btn btn-info hidden" id="cropimage">Crop And Upload</a>
                </div>
            </div>
        </div>
        <script src="assets/jquery-1.10.2.js"></script>
        <script src="assets/croppic.js?<?php echo time(); ?>"></script>
        <script src="assets/application.js?<?php echo time(); ?>"></script>
    </body>
</html>
