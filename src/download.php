<?php
    if (isset($file) &&
        isset($_GET['who']) &&
        is_file($file) &&
        !in_array($file, $blacklist))
    {
        // header
        header('Content-Type: application/octet-stream');
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: 0');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Content-Length: '.filesize($file));
        header('Pragma: public');

        // letti e muori
        readfile($file);
        die();
    }
?>