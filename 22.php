<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "random";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

mysqli_set_charset($conn,"utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM customer";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
    while($row = $result->fetch_assoc()) {
		
		//รับ ค่า id มาใส่ไว้ในตัวแปร random ซึ่งเป็นตัวแปรประเภท array
		$random[] = $row["id"];
		
		//กำหนดตัวแปร $data ให้เป็น  Associative Array โดยกำหนด key เท่ากับ ค่า id
		$data[$row["id"]] =  array(
				'id' => $row['id'],
				'first_name' => $row['first_name'],
				'last_name' => $row['last_name'],
				'phone' => $row['phone'],
				'email' => $row['email'],
		);	
    }
	
} else {
	
    echo "0 results";
}

//จำนวนที่ต้องการ สุ่ม
$number = 10;

//ใช้ function array_rand สุ่ม ค่า จาก ตัวแปร $random โดย มีจำนวนเท่ากับตัวแปร $number
$random_keys= array_rand($random,$number);

echo "<table>";
	
	//วนลูป เพื่อ แสดง รายชื่อผู้โชคดี
	for($i = 0; $i< $number; $i++){
		
		//รับค่าที่ สุ่มได้ มาใส่ไว้ในตัวแปร $id
		$id = $random[$random_keys[$i]];
		
		//แสดงข้อมูล จากตัวแปร $data ที่มี Key เท่ากับ $id
		echo"<tr>";
			echo "<td>".$data[$id]['id']."</td>";
			echo "<td>".$data[$id]['first_name']."</td>";
			echo "<td>".$data[$id]['last_name']."</td>";
			echo "<td>".$data[$id]['phone']."</td>";
			echo "<td>".$data[$id]['email']."</td>";
		echo"</tr>";
	}

echo"</table>";



?>


<?php
$a=array("red","green","blue","yellow","brown");
$random_keys=array_rand($a,3);
echo $a[$random_keys[0]]."<br>";
echo $a[$random_keys[1]]."<br>";
echo $a[$random_keys[2]];
?>