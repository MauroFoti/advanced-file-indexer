<?php
    // unisce insieme due paths
    // thanks to Riccardo Galli (https://stackoverflow.com/a/15575293)
    function join_paths($arr) {
        $paths = array();

        foreach ($arr as $arg) {
            if ($arg !== '') { $paths[] = $arg; }
        }

        return preg_replace('#/+#','/',join('/', $paths));
    }

    // crea un'icona dai dati
    function icon($data)
    {
        return "<img class='icon' src='data:image/png;base64, $data' />";
    }

    // file e cartelle da non mostrare/scaricare
    $blacklist = Array('index.php', '.', '..');

    function remove_dangerous_filenames($path)
    {
        global $blacklist;
        $safe_path = $path;

        // rimuovi file e cartelle bloccati
        foreach ($blacklist as $forbidden_name)
            $safe_path = str_replace("/$forbidden_name", '', $safe_path);

        // rimuovi '/' alla fine
        return ltrim(rtrim($safe_path, '/'), '/');
    }

    function pretty_filesize($file)
    {
        $size = intval(filesize($file));

        if ($size > 1024**3)
            return strval(round($size/1024,1))." GiB";
        else if ($size > 1024**2)
            return strval(round($size/1024,1))." MiB";
        else if ($size > 1024**1)
            return strval(round($size/1024,1))." KiB";
        else
            return strval($size)." B";
    }
?>