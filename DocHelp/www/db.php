<?
class DataBase
{
//-----------------------------------ДЛЯ ВХОДА В БД-------------------------------------------------------
	var $dbHost;
	var $dbName;
	var $dbUserName;
	var $dbPass;
	var $dbConnect;
	
	
	
	/*
		dbHost - Имя хоста(или IP)
		dbName - Название БД
		dbUserName - Имя пользователя БД
		dbPass - пароль к БД
		
		dbConnect - переменная для хранения информации о подключениии
	*/
	
	
//--------------------------------------------------------------------------------------------------------

//-----------------------------------------Для работы с таблицой------------------------------------------
    var $dbTable;
	var $keys;
	/*
		dbTable - Таблица с которой происходит работа
		keys - Поля таблицы
	*/	
//--------------------------------------------------------------------------------------------------------	 

	/*
		Подключение к БД
		dbName - обязательный параметр
		Остальные параметры можно переопределить
	*/
	function connect($dbName, $dbHost = 'localhost', $dbUserName = 'root', $dbPass = ''){
		
		$this->dbHost = $dbHost;
		$this->dbName = $dbName;
		$this->dbUserName = $dbUserName;
		$this->dbPass = $dbPass;
		
		
		$this->dbConnect = @mysql_connect($this->dbHost,$this->dbUserName,$this->dbPass);
		
		if (!$this->dbConnect) 
			echo ("Нет подключения"); 
		
		if(!@mysql_select_db($this->dbName))
			echo ("Ошибка подключения к базе!");
			
	}
	/*
		Закрываем подключение к БД.
	*/
	function disconnect(){
		mysql_close($this->dbConnect);
	}
	
	/*
		При удалении объекта закрываем соединение с БД.
	*/
	function __destruct(){
		$this->disconnect();
	}
	
	
//--------------------------------------------------------Методы для запросов-----------------------------
	
	/*
		Задаем таблицу для работы.
		Так же в этом методе получаем поля таблицы.
	*/
	function setTable($dbTable){
		
		$this->dbTable = $dbTable;
		
		$query = mysql_query('SHOW COLUMNS FROM `'.$this->dbTable.'`');
		if(!$query)
			echo "Ошибка подключения к таблице ".$this->dbTable."!";
		else{	
			//Получаем поля
			$i = 0;
			while($arr = mysql_fetch_assoc($query)){
				$keys[$i] = $arr["Field"];
				$i++;
			}
			$this->keys = $keys;				
		}
		
	}
	
	/*
		Возвращает поля
	*/
	function getKeys(){
		return $this->keys;
	}
	
	
	/*
		Метод для запроса выбора(SELECT).
		$query - условие выбора.
	*/
	function select($query = '1'){
		$queryText = 'SELECT * FROM `'.$this->dbTable.'` WHERE '.$query;
		$resultQuery = mysql_query($queryText);
		if(!$resultQuery){
			echo "Ошиба при выполнении запроса: ".mysql_error().' '.$queryText;
			exit;
		}
		$result;
		while($arr = mysql_fetch_array($resultQuery, MYSQL_ASSOC)){
			$result[] = $arr;
		}
		return $result;		
	}
	
	
	/*
		Метод для запроса вставки(INSERT INTO).
		keys - поля по которым мы вставляем(если не строковый тип данных, то будут использованы поля которые были получены в методе setTable)
		
	*/
	function insert($keys,array $values){
		$key = $keys;
		if(gettype($keys) != 'string'){
			$keys = $this->keys;
			$key = "";
			foreach($keys as $value)
				$key .= $value.', ';			
			$key = substr($key,0,-2);
		}
		$value = '';
		for($i = 0; $i < count($values);$i++)
			$value.= '('.$values[$i].'),';
		$value = substr($value,0,-1);
		$queryText = 'INSERT INTO `'.$this->dbTable.'`('.$key.') VALUES'.$value;
		$queryResult = mysql_query($queryText);
		if(!$queryResult)
			echo "Ошибка запроса на добавление: ".mysql_error().' '.$queryText;		
	}
	
	/*
		Метод для обновления данных.
		set - данные которые мы обновляем(имеет вид id = 1)
		query - условие обновления(аналогично с методом select)
	*/
	function update($set, $query){
		$queryText = 'UPDATE `'.$this->dbTable.'` SET '.$set.' WHERE '.$query;
		$queryResult = mysql_query($queryText);
		
		if(!$queryResult)
			echo "Ошибка запроса на обновление: ".mysql_error().' '.$queryText;
	}
	
	/*
		Метод на удаление
		query - условие удаления(аналогично с методом select)
	*/
	function del($query = '1'){
		$queryText = 'DELETE FROM `'.$this->dbTable.'` WHERE '.$query;
		$resultQuery = mysql_query($queryText);
		if(!$resultQuery){
			echo "Ошиба при выполнении запроса на удаление: ".mysql_error().' '.$queryText;
			exit;
		}
	}
//--------------------------------------------------------------------------------------------------------	
}






?>