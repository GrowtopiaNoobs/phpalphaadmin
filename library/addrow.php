<?php
	if(!isset($aAdminUser)){
		die();
	}

	if(!isset($aAdminPass)){
		die();
	}

	if($cUser === $aAdminUser){
		if($cPass === $aAdminPass){
			if($ipauth === true){
				if($aAdminIP === $_SERVER['REMOTE_ADDR']){
					
				} else {
					die();
				}
			} else {
				
			}
		} else {
			die();
		}
	} else {
		die();
	}

	if(!isset($cfield) || $cfield === 0){
		if(!isset($_GET['srows']) || $_GET['srows'] === 0){
			echo '<form method="post">';
			echo 'Enter How Many Rows: <input type="text" class="alphainput" style="width: 39px;" name="srows" pattern="[1-9]{1,2}" title="Only 2 Letters And Only Numbers">';
			echo '</form>';
			if($_POST){
				header('Location: control.php?p=addrow&db='.$_GET["db"].'&srows='.$_POST["srows"]);
				die();
			}
		}
		if(!isset($_GET['srows']))
		{
			die();
		}
		if(isset($_POST['enc']) && ($_POST['enc']=="on" || $_POST['enc']==="off")){
			$toDBWrite = 'id='.en(md5(mktime())).' ';
			for($i=0; $i<count($_POST['column']); $i++)
			{
				$toDBWrite .= $_POST['column'][$i].'='.($_POST['enc'] === "on") ? en($_POST['row'][$i]) : $_POST['row'][$i];
			}
			db_write($_GET['db'], $toDBWrite);
			echo 'Write Successful! Going To Database In 3 Seconds';
			?> <meta http-equiv="refresh" content="3; url=control.php?db=<?php echo $_GET['db'];?>"> <?php
		}
		echo '
		<form method="post">
		<table>
			<tr>
				<th>Column Name</th>
				<th>Column Text</th>
			</tr>
			';
		for($i=0; $i<count($_POST['column']); $i++)
		{
			echp '
			<tr>
				<td><input name="column' . $i . '" class="alphainput" type="text"> = </td>
				<td><input name="row' . $i . '" class="alphainput" type="text"></td>
			</tr>
			';
		}
		echo '
		</table>
		Encryption? 
		<input type="radio" name="enc" value="on" checked> On
		<input type="radio" name="enc" value="off"> On<br><br>
		<input type="submit" name="add" class="alphabutton">
		</form>
		';
	}
?>
