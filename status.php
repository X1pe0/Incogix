<?php 
    // integer starts at 0 before counting
    $i = 0; 
    $dir = '/var/www/html/scan/raw';
    if ($handle = opendir($dir)) {
        while (($file = readdir($handle)) !== false){
            if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) 
                $i++;
        }
    }
    // prints out how many were in the directory
    echo "<font style=color:lightgray>IP's Scanned: <b> $i </font></b><br>";
?>
