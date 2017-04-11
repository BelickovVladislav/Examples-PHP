<?php
error_reporting(0);
$dbhost = "localhost"; // Имя хоста БД
$dbusername = "root"; // Пользователь БД
$dbpass = ""; // Пароль к базе
$dbname = "sveta";


$dbconnect = @mysql_connect ($dbhost, $dbusername, $dbpass);
if (!$dbconnect) { echo ("Не могу найти Свету!"); }
if(@mysql_select_db($dbname)) { /*echo "Подключение к Свете есть!";*/}
else die ("Не могу в Светю!");
?>

<?php

if(isset($_GET['id']))
{	
	$amount = 0;
	$book_count = 0;
	
	$sql = "SELECT * FROM  `books` WHERE `id` = ". $_GET['id'];
	$rw = mysql_query($sql);
	$row = mysql_fetch_array($rw);
	
	$book_count = $row['book_count'];
	$amount = $row['amount'];
	
	if($amount-$book_count<=0 ){
		echo '<script>
			alert("Больше нет едениц данного товара!");
		</script>';
	}
	else
	{
	   mysql_query("UPDATE `books` SET `book_count` = `book_count` + 1 WHERE `id` = ". $_GET['id']);
	echo "<script>location.href = 'index.php'</script>";}
	}	   
if(isset($_GET['exit']))
{
		   mysql_query("UPDATE `books` SET `book_count` = 0 WHERE 1");
			echo "<script>location.href = 'index.php'</script>";
	
}

?>

<html>
	<head>
		<meta charset="utf-8">
		<title>B-Book</title>

		<link rel="stylesheet" href="style.css">
			<meta name="keywords" content="Книги, Литература, Научная, Художественная">
	        <meta name="description"  content="Продажа книг">
	        <meta name="author" lang="ru" content="Ганс Зельдман">
	        <meta charset="utf-8">
		  <link rel="shortcut icon" href="http://cdns2.freepik.com/free-photo/open-book_318-9298.jpg" type="image/png">
	</head>
	
	<body>
	
	
	
	
	<div id="basket"> 
	   <?php
	   $sql = 'SELECT * FROM `books` WHERE 1';
	   $rw = mysql_query($sql);
	   $count = 0;
	   while($row = mysql_fetch_array($rw, MYSQL_ASSOC))
	   {
		   $count += $row['book_count'];
	   }
	   $image = "";
	   if($count > 0)
		   $image = "cart2";
	   else
		   $image = "cart";
	   if($count > 0)
   echo  '<a href="/basket"><img src="img/'.$image.'.png" width="80%" alt="корзина"></a>';
else
   echo  '<a href="#"><img src="img/'.$image.'.png" width="80%" alt="корзина"></a>';
   mysql_close($dbconnection);
   
	?>
	</div>
	
	
	
	
	
	
	<div id="content">
	
		<header>
            <p align="center"  > <a href = "http://bbook" style="text-decoration: none; color :white;">" B-Book " </a></p>
		</header>
		
		<article>
        
        <div class="unit">
		    <div id="science" >
         <p class="Chichi"  align="center" > " Научно-популярная литература " </p>
		    </div>
		    
		    
		    <div class="Chibi"  align="center"><br> <h1>Слепой часовщик</h1> <br><img src="img/Снимок.PNG" alt=""><br> <br> <a href="?id=1" class="buy"> Положить в корзину </a></div>
		    <div class="Chibi"  align="center"><br> <h1>Высший замысел</h1> <br><img src="img/Снимок1.PNG" alt=""><br> <br> <a href="?id=2" class="buy"> Положить в корзину </a></div>
		    
		</div>
		    
		   
		    <div class="unit">
		    <div id="art">
       <p class="Chichi" align="center"  > " Художественная литература " </p>
		    </div>
		    
		    
		    <div class="Chibi" align="center"><br> <h1>1984</h1> <br><img src="img/Снимок2.PNG" alt=""><br> <br> <a href="?id=3" class="buy"> Положить в корзину </a></div>
		    <div class="Chibi" align="center"><br> <h1>О дивный новый мир</h1> <br><img src="img/Снимок3.PNG" alt=""><br> <br> <a href="?id=4" class="buy"> Положить в корзину </a></div>
		    
		</div>
       
       
       
        <div class="unit" >
		    <div id="history" >
      <p class="Chichi" align="center"  > " Историческая литература " </p>
		    </div>
		    
		    
		    <div class="Chibi"  align="center"><br> <h1>Вторая мировая война</h1> <br><img src="img/Снимок4.PNG" alt=""><br> <br> <a href="?id=5" class="buy"> Положить в корзину </a></div>
		    <div class="Chibi"  align="center"><br> <h1>Первая мировая война</h1> <br><img src="img/Снимок5.PNG" alt=""><br> <br> <a href="?id=6" class="buy"> Положить в корзину </a></div>
		    
		</div>
		   
		   
		   
		</article>
		
		
		
		<footer>
		    
		</footer>
		
    </div>
	</body> 
	
</html>