<?php
    // prendi il percorso se facciamo il listing
    $path = remove_dangerous_filenames($_SERVER['PATH_INFO']);

    // prendi il file se devi scaricare
    $file = remove_dangerous_filenames( join_paths(["./", $_GET['f']]) );

    $dirs = array();
    $files = array();
    $misc = array();
?>