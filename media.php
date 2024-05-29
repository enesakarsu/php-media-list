<?php

date_default_timezone_set('Europe/Istanbul');

function scan_dir($dir) {
    $ignored = array('.', '..', '.svn', '.htaccess');
    $files = array();
    
    foreach (scandir($dir) as $file) {
        if (in_array($file, $ignored)) {
            continue;
        }
        $filemtime = filemtime($dir . '/' . $file);
        $files[$file] = $filemtime;
    }

    arsort($files);
    $files = array_keys($files);

    return ($files) ? $files : false;
}

if (isset($_GET["silinecek_resim"])) {
    $resim = $_GET["silinecek_resim"];
    unlink("upload/" . $resim);
    header("Location: ortam.php");
    die();
}

?>
<!DOCTYPE HTML>
<html lang="tr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Ortam Kütüphanesi</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    
    <style>
        .custom-file-label:lang(tr)::after { content: "Gözat" !important; }
        
        .custom-file-input.selected:lang(tr)::after {
            content: "" !important;
        }
        
        .custom-file {
            overflow: hidden;
        }
        
        .custom-file-input {
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <h2 class="my-4">Ortam Kütüphanesi</h2>
        <div class="row">
            <?php
            $src_folder = 'upload';
            $files = scan_dir($src_folder);
            
            foreach ($files as $file) {
                ?>
                <div class="col-md-6">
                    <img src="upload/<?php echo $file; ?>" style="height: 300px; width: 100%;" class="mb-1" /><br/>
                    <a href="ortam.php?silinecek_resim=<?php echo $file; ?>" class="btn btn-danger mb-2">Resmi Sil</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>
