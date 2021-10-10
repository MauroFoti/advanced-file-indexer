define( `php_include2', `patsubst(patsubst(`include($1)', `<\?php', `'), `\?>',`')dnl')dnl
define( `php_include', `esyscmd(cat "$1" | sed -e "s/<?php//g" -e "s/?>//g")')dnl
define( `base64_file', `esyscmd(cat "$1" | base64 | tr -d \\n)')dnl
<?php
    // dati delle icone
    $b64_folder   = "base64_file(src/directory_closed-5.png)";
    $b64_file     = "base64_file(src/file_lines-0.png)";
    $b64_misc     = "base64_file(src/file_gears-2.png)";
    $b64_index    = "base64_file(src/directory_explorer-0.png)";
    $b64_download = "base64_file(src/server_to_desktop.png)";

    php_include(src/utils.php)
    php_include(src/setup.php)
    php_include(src/download.php)
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            if (isset($_GET['f']))
            {
                echo "<title>File download form</title>";
                echo "<link rel='icon' type='image/png' href='data:image/png;base64, $b64_download'>";
            }
            else
            {
                echo "<title>Index of ".join_paths(["/", $path])."</title>";
                echo "<link rel='icon' type='image/png' href='data:image/png;base64, $b64_index'>";
            }
        ?>
        <style>
            include(src/style.css)
        </style>
    </head>
    <body>
    <?php
        if (isset($_GET['f']))
        {
            $file_path = remove_dangerous_filenames($_GET['f']);
            $parent_dir = join_paths(["/", dirname($_GET['f'])]);
            echo "patsubst(include(src/download-form.php), `"', `\\"')";
        }
        else
        {
            php_include(src/index.php)
        }
    ?>
    </body>
</html>