<?php

// unisce insieme due paths
function join_paths($arr) {
    $paths = array();

    foreach ($arr as $arg) {
        if ($arg !== '') { $paths[] = $arg; }
    }

    return preg_replace('#/+#','/',join('/', $paths));
}

// dati delle icone
$b64_folder = "iVBORw0KGgoAAAANSUhEUgAAADAAAAAwBAMAAAClLOS0AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAElBMVEUAAACAgAAAAAD////AwMD//wBz4ZeQAAAAAXRSTlMAQObYZgAAAAFiS0dEAxEMTPIAAAAHdElNRQfiBhgXARMJeV+TAAAAXklEQVQ4y2NgwAMEwUAIQ5zRGAwMFdAlhF0hAF0Lo0kIBAQqYNeArgWuAV0LQgOaFpEQBAgUhAGgEmFjrECBQTgEKxBCsQPFulEdozoGuQ4RQaxAiEEJO8DIwoMcAADcB+HH47wdjQAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAxOC0wNi0yNFQyMzowMToxOS0wNDowMO2EXMYAAAAldEVYdGRhdGU6bW9kaWZ5ADIwMTgtMDYtMjRUMjM6MDE6MTktMDQ6MDCc2eR6AAAAAElFTkSuQmCC";
$b64_file = "iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAQAAADZc7J/AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAHdElNRQfiBhgXBwzSK/XgAAAAjElEQVRIx+2VQQrAIAwE1+K/oz9rX5ZeiopaTazFHronETMOIRCDK44hiDP5jY1H6pZ7gJEhNsm/iQHAjwBUIJSAEmF15aEBoRcqAwKDwdiTu8LAdxB5bP9JOwoDkgFeNKjD5xvc2wh7oLVRGNSR8w2+PImr54BGAP8cyLLeQL1YGgbHECDuWtF6LytPTdMhXzC2L6sAAAAldEVYdGRhdGU6Y3JlYXRlADIwMTgtMDYtMjRUMjM6MDc6MTItMDQ6MDDinXh7AAAAJXRFWHRkYXRlOm1vZGlmeQAyMDE4LTA2LTI0VDIzOjA3OjEyLTA0OjAwk8DAxwAAAABJRU5ErkJggg==";
$b64_misc = "iVBORw0KGgoAAAANSUhEUgAAADAAAAAwBAMAAAClLOS0AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAFVBMVEUAAACAgID///8AAADAwMCAgAD//wDIuPtlAAAAAXRSTlMAQObYZgAAAAFiS0dEAmYLfGQAAAAHdElNRQfiBhgXBwtMT2BDAAAA8klEQVQ4y73STW7DIBAFYKJeIHi4AD/xOsyI7As9QSz7ALZy/ysUt2UBA8vmyfLmmycEGiHERVa5ipKLqQIjkPcBKBjA9HkfgIMBmFJhUCoMSoXDX6W9IOX04Ex6M5AjY5GDld4hpg64SZKDDkSpfeRgSXmdG9gCxqQ15n8LHhyQdx4YYIwxYfKGaiBFyoVlAjtjBTpJGfElAV8MvHvcJthuLYCmcEy5QfUFCe0843nGeUj1unbN0/Q8VgbLfMZyCEfYd9qbM3K2sG42fx1YngetSwcwjwcOlkwet2g6y/Az3oOyDe/exH8G9dXmFz6IR4hv07SJyUhD+QUAAAAldEVYdGRhdGU6Y3JlYXRlADIwMTgtMDYtMjRUMjM6MDc6MTEtMDQ6MDDTdWLmAAAAJXRFWHRkYXRlOm1vZGlmeQAyMDE4LTA2LTI0VDIzOjA3OjExLTA0OjAwoijaWgAAAABJRU5ErkJggg==";

// crea un'icona dai dati
function icon($data)
{
    return "<img class='icon' src='data:image/png;base64, $data' />";
}

// file e cartelle da non mostrare/scaricare
$blacklist = Array('index.php', 'download.php', 'include.php', 'favicon.ico', '.', '..');

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