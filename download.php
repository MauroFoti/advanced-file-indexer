<?php
    //die();
    require "include.php";

    // file da scaricare (relativo a download.php)
    $file = remove_dangerous_filenames( join_paths(["./", $_GET['f']]) );

    // !!!!! puo scaricare file fuori dalla root

    if (isset($file) &&
        isset($_GET['who']) &&
        is_file($file) &&
        !in_array($file, $blacklist))
    {
        // percorso del file relativo alla root
        //$filename = join_paths([ ".", $file ]);

        // header
        header('Content-Type: application/octet-stream');
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: 0');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Content-Length: '.filesize($file));
        header('Pragma: public');

        //Clear system output buffer
        readfile($file);
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <body>
        <form action='download.php' method='GET'>
            <label for='email'>email:</label><input type="email" name="who" value="a@a.a" required><br>
            <label for='file'>file do download:</label><input type="text" name="f" value="<?php echo remove_dangerous_filenames($_GET['f']); ?>" required><br>
            <input type='submit'><br>
            <a href='<?php echo join_paths(["/", dirname($_GET['f'])]); ?>'>return to directory</a>
        </form>
    </body>
</html>
