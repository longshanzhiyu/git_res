<?php

class User{
	public $id;
	public $name;
	public $age;
	public $gender;

	function __construct($param){ //初始化对象，将初始化值放在括号内
		$this->id=$param[id];
		$this->name=$param[name];
		$this->age=$param[age];
		$this->gender=$param[gender];
 }
}

		header("Content-Type: text/html;charset=utf-8");
		$stmt = null;
		try {
			$dbh = new PDO('mysql:host=127.0.0.1;port=3306;dbname=users_test;charset=utf8', 'root', '123456');
			//    $dbh = new PDO('mysql:host=172.0.0.1;dbname=users', 'root', 'Njw8910250o0!');
			// $arr = array();
			// foreach($dbh->query('SELECT * from users') as $row) {
			// 		print_r($row);
			// 		$s=new User();
			// 		$s->id=$row[id];
    	// 		$s->name=$row[name];
    	// 		$s->age=$row[age];
			// 		$s->gender=$row[gender];
    	// 		//填充数组
    	// 		$arr[]=$s;
			// }
			// echo json_encode(array('users'=>$arr));
			$a = $_POST['page'];
			if ($a <= 0) {
					echo "参数有误";
					return;
			}

			$strat = ($a - 1) * 10;
			$sql = "SELECT * FROM users limit {$strat},10";
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);

			$arr = array();
			while ($row = $stmt->fetch()) //如果表里没有记录，这句会报错
			{
					$s=new User($row);
					//填充数组
		    	$arr[]=$s;
			}
			echo json_encode(array('users'=>$arr));

			$dbh = null;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
?>
