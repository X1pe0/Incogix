<?php
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
    if (filter_var($_POST['rit'], FILTER_VALIDATE_IP)) {

        shell_exec('sudo python3 IOT_Scanner.py '. $_POST['rit']);
        
        header('Location: /');


    }else{
        header('Location: /');
    }
}else{

    header('Location: /');
}
?>