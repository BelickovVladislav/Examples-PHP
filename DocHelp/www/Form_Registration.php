<!DOCTYPE html>
<html>
    <head>
        <title> Регистрация </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../styles/main.css">
    </head>
    <body>
    <div id="page_align" class="b3radius">
 		<div id="Header">
 			<div id="Logo">
 				<img src="images/Logo.jpg" height="65px" width="65px">
 			</div>
 			<h1><span style="color: #33a137">Doc</span>Help</h1>
 			<h4> cервис онлайн-заказа талонов </h4>
 		</div>
 		<div class="Registration" align="center">
 			<form method="get">
		<?php 
			include_once("db.php");
			
			$db = new DataBase();
			function showSelect($selectName, $dbName, $db,$selectIndex,$where = "1"){
				$form = "<select name = ".$selectName.">";
				$db->setTable($dbName);
				$arr = $db->select($where);
				foreach($arr as $item){
					$selectIndex != $item["id"] ? $form .= "<option value = ".$item["id"].">":$form .= "<option value = ".$item["id"]." selected>";
					switch($selectName){
						case "selectSpetional":
							$form.= $item["name"];
							break;
						case "doctor":
							$form .= $item["First Name"]." ".$item["Middle Name"]." ".$item["Name"];
							break;
						default: 
							break;					
					}
					
					$form .= "</option>";
				} 
				$form .= "</select>";
				return $form;
			}
			$db->connect("orderticket");
			$db->setTable("spetional");
			if($_GET == NULL)
			{

				echo "Выберите специальность: ".showSelect("selectSpetional","spetional",$db,0);
				echo "<br><input type = 'submit'>";
				echo "</form>";
			}
			else
				if(!empty($_GET["selectSpetional"])){
				
				echo "Выберите специальность: ".showSelect("selectSpetional","spetional",$db,$_GET["selectSpetional"]);
				echo "<br>";
				
				if(!empty($_GET["doctor"])){
					echo "Выберите врача: ".showSelect("doctor","doctors",$db,$_GET["doctor"],"id_spetional = ".$_GET["selectSpetional"]);
					echo "<br>";
					if(!empty($_GET["timeH"]) && !empty($_GET["timeH"]) && !empty($_GET["calendar"]))
					{
						echo "Выберете дату: <input type='date' name='calendar' value = ".$_GET["calendar"]."></br>";
						echo "Выберите вермя : <select name='timeH'>";
						for($i = 8; $i<=20;$i++)
							echo $_GET["timeH"] == $i ?"<option value = $i selected>$i</option>" :"<option value = $i >$i</option>";
						echo "</select><select name = 'timeM'>";
						for($i = 0; $i<6; $i++)
							echo $_GET["timeH"] == $i*10? "<option value = '".(strlen($i*10)<2?"0".$i*10:$i*10)."' selected>".(strlen($i*10)<2?"0".$i*10:$i*10)."</option>":"<option value = '".(strlen($i*10)<2?"0".$i*10:$i*10)."'>".(strlen($i*10)<2?"0".$i*10:$i*10)."</option>";
						echo "</select>";
						$db->setTable("ticket");
						if(isset($_GET["orederTicket"]))
						{
							$result = $db->select("date = \"".$_GET["calendar"]."\" AND time = \"".$_GET["timeH"].":".$_GET["timeM"].":"."00"."\" AND "."id_doctor = ".$_GET["doctor"]);
							if(count($result) == 0)	
							{
								if(!empty($_GET["name"]) && !empty($_GET["surname"]) && !empty($_GET["fathername"]) &&!empty($_GET["bday"]) && !empty($_GET["address"]))
								{
									$db->insert("`id_doctor`, `date`, `time`, `Last Name`, `Name`, `Middle Name`, `bday`, `address`",
								array($_GET["doctor"].',"'.$_GET["calendar"].'","'.$_GET["timeH"].":".$_GET["timeM"].'", "'.$_GET["name"].'", "'.$_GET["surname"].'", "'.$_GET["fathername"].'","'.$_GET["bday"].'", "'.$_GET["address"].'"'));
								echo "<script>  location.href = 'Form_Choose.php' </script>";
								}else
									echo "<script>alert('Введены не все поля формы!');</script>";
							}
							else
								echo "<script>alert('Данное время занято, пожалуйста выберите другое');</script>";
						}
					}
					else{
						echo "Выберете дату и время: <input type='date' name='calendar'></br>";
						echo "<select name='timeH'>";
						for($i = 8; $i<=20;$i++)
							echo "<option value = $i >$i</option>";
						echo "</select><select name = 'timeM'>";
						for($i = 0; $i<6; $i++)
							echo "<option value = '".(strlen($i*10)<2?"0".$i*10:$i*10)."'>".(strlen($i*10)<2?"0".$i*10:$i*10)."</option>";
						echo "</select>";
					}
						
				}else
					echo showSelect("doctor","doctors",$db,0,"id_spetional = ".$_GET["selectSpetional"]);
				echo "<br><input type = 'submit'>";
				}
			?>
 			<div id="Container" class="clr">
 				<h5>Заполните регистрационную форму:</h5>
 			    <input type="text" placeholder="Ваше фамилия:" name="name" value = <?php echo isset($_GET["name"])? $_GET["name"]: "" ?>> <br>
 				<input type="text" placeholder="Ваше имя:" name="surname" value = <?php echo isset($_GET["surname"])? $_GET["surname"]: "" ?>> <br>
 				<input type="text" placeholder="Ваше отчество:" name="fathername" value = <?php echo isset($_GET["fathername"])? $_GET["fathername"]: "" ?>> <br>
 				<font color="#FFF" size="5px">Введите дату рождения:</font>
 				<input type="date" name="bday" value = <?php echo isset($_GET["bday"])? $_GET["bday"]: "" ?>> <br>
 				<input type="text" placeholder="Адрес проживания:" name="address" value = <?php echo isset($_GET["address"])? $_GET["address"]: "" ?>> <br>
 			</div>
 				<input type="submit" value="Заказать талон" name="orederTicket">
 			</form>
 		</div>
 		<div class="clr">
 		</div>
    </div>
    </body>
</html>