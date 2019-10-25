<?php
$this->title = 'Customize View Data Tables';
?>

<?php
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "yii2-training";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Data Tables</title>

		<!-- นำเข้า  CSS จาก Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		
		<!-- นำเข้า  CSS จาก dataTables -->
		<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
		 
		<!-- นำเข้า  Javascript จาก  Jquery -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<!-- นำเข้า  Javascript  จาก   dataTables -->
		<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

		<script type="text/javascript">
			//คำสั่ง Jquery เริ่มทำงาน เมื่อ โหลดหน้า Page เสร็จ 
			$(function(){
				//กำหนดให้  Plug-in dataTable ทำงาน ใน ตาราง Html ที่มี id เท่ากับ example
				$('#example').dataTable();
			});
		</script>
  </head>
  <body>
  
<h1>Data Tables </h1>

<table class="table table-bordered" id="example">
    <thead>
            <tr class="info">
                    <th>hn</th>
                    <th>full_name</th>
                    <th>pttype_name</th>
                    <th>vstdate</th>
                    <th>dep</th>
                    <th>doc_name</th>
            </tr>
    </thead>
    <tbody>
       <?php
            $sql = "SELECT hn,full_name,pttype_name,vstdate,dep,doc_name FROM nodiagopd";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {

                    while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                                    echo "<td>" . $row["hn"]. "</td>";
                                    echo "<td>" . $row["full_name"]. "</td>";
                                    echo "<td>" . $row["pttype_name"]. "</td>";
                                    echo "<td>" . $row["vstdate"]. "</td>";
                                    echo "<td>" . $row["dep"]. "</td>";
                                    echo "<td>" . $row["doc_name"]. "</td>";
                            echo "</tr>";
                    }
            }
            $conn->close();
            ?> 
    </tbody>
        </table>
		
  </body>
</html>