<?php

	header('Content-Type: application/json');
	
	if($_POST['type']=="readlist"){
		$list = "";

		if ($handle = opendir('history')) {
		    while (false !== ($file = readdir($handle)))
		    {
		        if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'json')
		        {
		            $list .= '<tr><td><button class="btn">'.$file.'</button></td></tr>';
		        }
		    }
		    closedir($handle);
		}

		echo $list;
	}else if($_POST['type']=="loadF"){

		$str = file_get_contents("history/".$_POST["filename"]);
		echo $str;

	}else if($_POST['type']=="delete"){

		if(unlink("history/".$_POST['filename'])){
			echo "y";
		}else{
			echo "n";
		}
		
	}else if($_POST['type']=="html"){

		$newName = substr($_POST["filename"], 0, strpos($_POST["filename"],"."));
		$str = file_get_contents("history/html_".$newName.".txt");
		echo $str;
		
	}

?>