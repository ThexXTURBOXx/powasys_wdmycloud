<?php

require_once('../config.php');
require_once('../statements.php');

class DataEntries
{
    public $latest;
    public $averages;
    public $max;
    public $data;

    function __construct($latest, $averages, $max, $data)
    {
        $this->latest = $latest;
        $this->averages = $averages;
        $this->max = $max;
        $this->data = $data;
    }
}

$connection = mysqli_connect($mysqlHost, $mysqlName, $mysqlPass, $mysqlData);

// Get latest
$stmt = getLatestStatement($connection);
mysqli_stmt_execute($stmt) or die("Error when selecting: " . mysqli_error($connection));
$result = mysqli_stmt_get_result($stmt);
$latest = array();
while ($row = mysqli_fetch_assoc($result)) {
    $latest[] = $row;
}

// Get averages
$stmt = average24hStatement($connection);
mysqli_stmt_execute($stmt) or die("Error when selecting: " . mysqli_error($connection));
$result = mysqli_stmt_get_result($stmt);
$averages = array();
while ($row = mysqli_fetch_assoc($result)) {
    $averages[] = $row;
}

// Get max
$stmt = max24hStatement($connection);
mysqli_stmt_execute($stmt) or die("Error when selecting: " . mysqli_error($connection));
$result = mysqli_stmt_get_result($stmt);
$max = array();
while ($row = mysqli_fetch_assoc($result)) {
    $max[] = $row;
}

// Get data
$minDiv = $_GET["minDiv"] ?? 0;
$truncate = $minDiv > 0;

$stmt = getLast24hStmt($connection, $truncate);
if ($truncate) {
    mysqli_stmt_bind_param($stmt, "d", $minDiv) or die("Error when binding parameter: " . mysqli_error($connection));
}

mysqli_stmt_execute($stmt) or die("Error when selecting: " . mysqli_error($connection));
$result = mysqli_stmt_get_result($stmt);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Echo everything
echo json_encode(new DataEntries($latest, $averages, $max, $data));

mysqli_close($connection);
