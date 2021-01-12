<div id="hideme_stats">
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
    echo '<h3 data-v-a0a32cba="" style="color: rgb(255, 255, 255);"> &lt;<span data-v-a0a32cba="" style="color: red;">' .$i. ' / Scanned</span>&gt;</h3>';
?>
</div>
