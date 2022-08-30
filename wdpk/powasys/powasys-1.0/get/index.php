<?php
//open connection to mysql db
$connection = mysqli_connect("192.168.178.21", "powasys", "k;p%,SnSc+v@`$+$\&cy/;faiqjM+`I%", "powasys") or die("Error " . mysqli_error($connection));

//fetch table rows from mysql db
$sql = "SELECT * FROM entries WHERE time > DATE_SUB(NOW(), INTERVAL 24 HOUR) GROUP BY powadorId, DATE(time), HOUR(time), MINUTE(time) DIV 10 ORDER BY time;";
$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

//create an array
$arr = array();
while ($row = mysqli_fetch_assoc($result)) {
    $arr[] = $row;
}
echo json_encode($arr);

//close the db connection
mysqli_close($connection);
