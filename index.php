
<html>
<title id="title">Incogix</title>
<body bgcolor="#EBEDEF">
<center>
<br><br>
<font stryle="color:white">







<img src="https://nabyte.com/upload/5cb4b1285e1779b0608bcaaa4e8c44c208cc25eflogo_1.png">
            <form name="form" method="post">
            <input type="search" maxlength="2000" class="textInput" name="text_box" size="45"/>
            <input class="button" type="submit" id="search-submit" value="&lt;Search&gt;" /></br>

        </form>
        
<style>
fieldset
{
    border:0px dotted white;
    -moz-border-radius:5px;
    -webkit-border-radius:1px;	
    border-radius:0px;	
    height: 120px;
    width: 950px;
    margin: auto;

}
text_box {
    background-color: #000;
    border: 1px solid #000;
    color: #00ff00;
    padding: 8px;
    font-family: courier new;
}

.textInput
{
border: 0px solid #D5D5D5;
background: #555555;
color: #;
font-size: 1.1em;
}
.button {
    background-color: black;
    border: none;
    color: #74FFEF;
    padding: 2px 10px;
    text-align: center;
    text-decoration: bold;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    
}

* {
  box-sizing: border-box;
}

@import url(https://fonts.googleapis.com/css?family=Roboto:400,100,300);
 #p {
   position:absolute;
   top:10;
   right:10;
  }

body{
  background-color:black;
  font-family:"Lucida Console";
  color: #fff;
}

h1{
  margin-top:115px;
}
ul{
  padding:0;
  list-style:none;
  font-size:14px;
}
li{
  padding:7px 10px;
}
a{
  text-decoration:none;
  padding:10px 15px;
  color:#fff;
  font-family:"Roboto";
  font-size: 18px;
  font-weight: 300;
}
a:hover{
  text-decoration: line-through;
}

</style>
<script type="text/javascript">
        setTimeout(function() {Ajax();}, 1000);
</script>
   <script type="text/javascript">

        function Ajax()
        {
            var
                $http,
                $self = arguments.callee;

            if (window.XMLHttpRequest) {
                $http = new XMLHttpRequest();
            } else if (window.ActiveXObject) {
                try {
                    $http = new ActiveXObject('Msxml2.XMLHTTP');
                } catch(e) {
                    $http = new ActiveXObject('Microsoft.XMLHTTP');
                }
            }

            if ($http) {
                $http.onreadystatechange = function()
                {
                    if (/4|^complete$/.test($http.readyState)) {
                        document.getElementById('ReloadThis').innerHTML = $http.responseText;
                        setTimeout(function(){$self();}, 3000);
                    }
                };
        
                $http.open('GET', 'status.php');
        
                $http.send(null);
            }

        }

    </script>
<div id="ReloadThis">Loading...</div>
<br>
</center>
    </body>
</html>
<?php
$i = 0;
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
    $filename = "/var/www/html/scan/".$_POST['text_box'].'.html';
    if (file_exists($filename)){
        if (filter_var($_POST['text_box'], FILTER_VALIDATE_IP)) {
            header('Location: /scan/'.$_POST['text_box'].'.html');
        } 
    }

    $path = '/var/www/html/scan/';
    $findThisString = $_POST['text_box'];

    $dir = dir($path);

    // Get next file/dir name in directory
    while (false !== ($file = $dir->read()))
    {   
      if ($file != '.' && $file != '..')
    {
         // Is this entry a file or directory?
         if (is_file($path . '/' . $file))
            
            
         
           
         {
               // Its a file, yay! Lets get the file's contents
            

               if ($file == "IOT_Scanner.py" OR $file == "scan.log"){
                
            }else{

           
             $data = file_get_contents($path . '/' . $file);
             $main_data_search = file_get_contents($path . '/' . $file);


               // Is the str in the data (case-insensitive search)
             if (stripos($data, $findThisString) !== false)
                {
		
		
                // sw00t! we have a match
                ob_flush(); 
                flush(); 
                usleep(10000); 

            
                echo '<fieldset><div style="width:1000px; margin:0 auto;"><font style="color:#B365FF; font-family:"Lucida Console"><b>&rdsh;&lt;Found Match&gt;</b> --&gt <a target="_blank" href="/scan/'. $file .'">'. htmlspecialchars($file) .'</a><br><font style="color:lime">';
        echo substr (htmlspecialchars($data), 5236, 50).'</font></br><font style="color:white"><UL>';
        $ssh = shell_exec('cat ./scan/'. $file . '| grep "ssh"');
        $http = shell_exec('cat ./scan/'. $file . '| grep "http"');
        $CVE = shell_exec('cat ./scan/'. $file . '| grep "VULN"');
        $CVE_Search = shell_exec('cat ./scan/'. $file . '| grep "CVE"');
        echo substr ('<LI><font size="1"><p>' . strip_tags($ssh), 0, 100) . '</p></font>';
        echo substr ('<font size="1"><p>' . strip_tags($http), 0, 100) . '</p></font>';
        echo substr ('<font size="1"><p>' . strip_tags($CVE_Search), 0, 150) . '</p></font>';
        echo substr ('<p><font size="1" style="color:red">' . strip_tags($CVE), 0, 100) . '</UL></p></font></div></fieldset><br><center><font style="color:#111111">&lt;---------------------------------------------------------------------------------------------------&gt;</font></center>';
		$i++;
                }
            }
        }
    }
}
}


$dir->close();
?>