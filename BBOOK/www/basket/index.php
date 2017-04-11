<?php
error_reporting(0);
$dbhost = "localhost"; // ��� ����� ��
$dbusername = "root"; // ������������ ��
$dbpass = ""; // ������ � ����
$dbname = "sveta";


$dbconnect = @mysql_connect ($dbhost, $dbusername, $dbpass);
if (!$dbconnect) { echo ("�� ���� ����� �����!"); }
if(@mysql_select_db($dbname)) { /*echo "����������� � ����� ����!";*/}
else die ("�� ���� � �����!");
if(!empty($_GET['name'])&&!empty($_GET['email'])&&!empty($_GET['tel']))
	header("location:http://bbook/?exit");
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>B-Basket</title>

		<link rel="stylesheet" href="../style.css">
		
		  <link rel="shortcut icon" href="http://cdns2.freepik.com/free-photo/open-book_318-9298.jpg" type="image/png">
			<meta name="keywords" content="Книги, Литература, Научная, Художественная">
	        <meta name="description"  content="Продажа книг">
	        <meta name="author" lang="ru" content="Ганс Зельдман">
	        <meta charset="utf-8">
			<script>
       function val_Form() {
           valid = true;
           if (document.form1.name.value == "" || document.form1.email.value == "" || document.form1.tel.value == "")
           {
               alert("Введите данные!");
               valid = false;
           }

           return valid;
	   }
		function goToPage()
		{if(val_Form()) {
			alert('Ваша форма отправленна! Спасибо за покупку'); 
			return location.href ='?exit';
			}
		}
	
    </script>
			<style>
			img
			{
				width: 100%;
				height: 150px;
				border-radius: 10px;
				
			}
			table
			{
				width: 90%;
				border-radius: 10px;
				text-align: center;
			}
			td
			{
				border-radius: 10px;	
				
			}
			td.image
			{
				width:100px;
			}
			fieldset
			{
				border: 3px;
			}
			
			</style>
	       
	</head>

	<body>
	<div style="z-index: 20; float: right; position: fixed; padding-top: 20%;">
	<form method="GET" name="form1">
	<fieldset>
	<legend>Форма отправки </legend>
	<label for="name">Ваше имя: </label><br>
	<input type="text" name="name" id = "name"><br>
	<label for="email">Ваш E-mail: </label><br>
	<input type="email" name="email" id = "email"><br>
	<label for="tel"> Ваш телефон: </label><br>
	<input type="tel" name="tel" id="tel" pattern="375[\\(][0-9]{2}[\\)][0-9]{7}"><br>
	<input type = "submit" value="Заказать" onclick="goToPage()"><input type="button" value="Очистить корзину" onclick="location.href = 'http://bbook/?exit'">
	</fieldset>
	</form>
	</div>
	<div id="content">
	
		<header>
            <p align="center"  > <a href = "http://bbook" style="text-decoration: none; color :white;">" B-Book "</a> </p>
		</header>
		
		
		<table border="1" align = "center">
		<?php
		$sql = "SELECT * 
FROM  `books` 
WHERE book_count >0";
		$rw = mysql_query($sql);
		$buy = 0;
		while($row = mysql_fetch_array($rw))
		{
			
			$image = "";
			switch($row['id']){
				case 1:
					$image = '<img src="../img/СНИМОК.png"/>';
					break;
				case 2:
					$image = '<img src="../img/СНИМОК1.png"/>';
					break;
				case 3:
					$image = '<img src="../img/СНИМОК2.png"/>';
					break;
				case 4:
					$image = '<img src="../img/СНИМОК3.png"/>';
					break;
				case 5:
					$image = '<img src="../img/СНИМОК4.png"/>';
					break;
				case 6:
					$image = '<img src="../img/СНИМОК5.png"/>';
					break;
				default: break;
			}
			$buy += $row['book_price']*$row['book_count'];
			echo '<tr><td class="image">'.$image.'</td><td>'.$row['book_name'].'</td><td>'.$row['book_price'].' бел. руб.</td><td>'.$row['book_count'].'</td></tr>';
			
		}	
			echo '<tr><td>Итого: </td> <td colspan="3">'.$buy.' бел. руб.</td></tr>'
		?>
		</table>
		
	</div>
	
	</body>
	
</html>