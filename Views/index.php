<!DOCTYPE html>
<html>
<head>
    <title>File Manager</title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <form action="/file/upload" method="post" enctype="multipart/form-data" class="mt-5">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Upload Files</label>
                <input type="file" class="form-control" name="images[]" multiple>
                <span class="text-danger"><?= \FileManager\Helper::printErrors('images') ?></span>
            </div>
            <button type="submit" class="btn btn-primary" >Upload</button>
        </form>

        <div class="files-list row mt-5">
            <?php foreach($files as $key => $file){?>
                <?php include 'image-card.php'?>
            <?php }?>
        </div>
    </div>

<script src="../Assets/js/bootstrap.min.js"></script>
</body>
</html>


