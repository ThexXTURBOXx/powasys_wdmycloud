<?php

require_once('../config.php');
require_once('../statements.php');

$connection = mysqli_connect($mysqlHost, $mysqlName, $mysqlPass, $mysqlData);

// Get data
$startDate = $_GET["start"] ?? "0";
$endDate = $_GET["end"] ?? "0";
$minDiv = $_GET["minDiv"] ?? 0;
$truncate = $minDiv > 0;

$stmt = getIntervalStmt($connection, $truncate);
if ($truncate) {
    mysqli_stmt_bind_param($stmt, "ssd", $startDate, $endDate, $minDiv) or die("Error when binding parameter: " . mysqli_error($connection));
} else {
    mysqli_stmt_bind_param($stmt, "ss", $startDate, $endDate) or die("Error when binding parameter: " . mysqli_error($connection));
}

mysqli_stmt_execute($stmt) or die("Error when selecting: " . mysqli_error($connection));
$result = mysqli_stmt_get_result($stmt);

// Echo everything
echo "[";
$first = true;
while ($row = mysqli_fetch_assoc($result)) {
	if ($first) {
		$first = false;
	} else {
		echo ",";
	}
    echo json_encode($row);
}
echo "]";

mysqli_close($connection);
