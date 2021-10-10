<?php
    // crea percorso delle directory selezionabile
    echo "<div class='path'>";
    echo "Directory listing of ";
    echo "<span class='path-dir'><a href='/'>\$root</a></span>";
    $current_path = "";

    foreach (explode('/', $path) as $dir)
    {
        if ($dir !== "")
        {
            $current_path = join_paths([$current_path, $dir]);
            echo "/<span class='path-dir'><a href='/$current_path'>$dir</a></span>";
        }
    }
        
    echo "</div>";

    // crea lista di cartelle e file
    if ( $ll = scandir(join_paths(["./", $path])) ) // scandir ritorna falso se c'è un errore
    {
        foreach ($ll as $file)
        {
            // percorso relativo alla root
            $full_path = join_paths([$path, $file]);

            // accetta il file solo se non in blacklist
            if (!in_array($file, $blacklist))
            {
                if (is_dir($full_path)) // una cartella, da aprire
                    array_push($dirs, $file);
                else if (is_file($full_path))   // un file, da scaricare
                    array_push($files, $file);
                else
                    array_push($misc, $file);
            }
        }
    }

    if (count($dirs) === 0 && count($files) === 0 && count($misc) === 0)
        echo "<p class='message'>No files here</p>";
    else
    {
        // stampa lista di cartelle e file
        echo "<table>";
        echo "<tr> <th></th> <th>File name</th> <th>Size</th> <th>Last modified</th> </tr>";
        foreach ($dirs as $d)
        {
            $dirname = $d;
            $dirpath = join_paths([$path, $d]);
            echo "<tr>
                    <td>".icon($b64_folder)."</td>
                    <td><a class='folder' href='/".$dirpath."'>$dirname</a></td>
                    <td>".strval(count(array_diff( scandir($dirpath), $blacklist )))." items </td>
                    <td>".date ("F d Y H:i:s", filemtime($dirpath))."</td>
                   </tr>";
        }
        foreach ($files as $f)
        {
            $filename = $f;
            $filepath = join_paths([$path, $f]);
            echo "<tr>
                    <td>".icon($b64_file)."</td>
                    <td><a class='file' href='/?f=".$filepath."'>$filename</a></td>
                    <td>".pretty_filesize($filepath)."</td>
                    <td>".date ("F d Y H:i:s", filemtime($filepath))."</td>
                  </tr>";
        }
        foreach ($misc as $m)
        {
            $miscname = $m;
            $miscpath = join_paths([$path, $m]);
            echo "<tr>
                    <td>".icon($b64_misc)."</td>
                    <td><a class='misc' href='#'>$miscname</a></td>
                    <td>".pretty_filesize($filepath)."</td>
                    <td>".date ("F d Y H:i:s", filemtime($filepath))."</td>
                  </tr>";
        }
        echo "</table>";
    }
?>