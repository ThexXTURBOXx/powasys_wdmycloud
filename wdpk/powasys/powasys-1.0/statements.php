<?php

function getStmt($connection): mysqli_stmt
{
    return mysqli_prepare($connection, 'SELECT * FROM entries WHERE id = ? ORDER BY time;');
}

function getLast24hStmt($connection, $truncate): mysqli_stmt
{
    return mysqli_prepare($connection,
        'SELECT * FROM entries WHERE time > DATE_SUB(NOW(), INTERVAL 24 HOUR) '
        . ($truncate ? 'GROUP BY powadorId, DATE(time), HOUR(time), MINUTE(time) DIV ? ' : '')
        . 'ORDER BY time;');
}

function getLatestStatement($connection): mysqli_stmt
{
    return mysqli_prepare($connection,
        'SELECT * FROM entries WHERE (powadorId,time) IN (SELECT powadorId, MAX(time) 
                                                 FROM entries GROUP BY powadorId);');
}

function average24hStatement($connection): mysqli_stmt
{
    return mysqli_prepare($connection,
        'SELECT powadorId, 
       AVG(genVoltage) AS genVoltage, AVG(genCurrent) AS genCurrent, AVG(genPower) AS genPower, 
       AVG(netVoltage) AS netVoltage, AVG(netCurrent) AS netCurrent, AVG(netPower) AS netPower, 
       AVG(temperature) AS temperature FROM entries 
                                       WHERE time > DATE_SUB(NOW(), INTERVAL 24 HOUR) 
                                       GROUP BY powadorId;');
}

function max24hStatement($connection): mysqli_stmt
{
    return mysqli_prepare($connection,
        'SELECT powadorId, 
       MAX(genVoltage) AS genVoltage, MAX(genCurrent) AS genCurrent, MAX(genPower) AS genPower, 
       MAX(netVoltage) AS netVoltage, MAX(netCurrent) AS netCurrent, MAX(netPower) AS netPower, 
       MAX(temperature) AS temperature FROM entries 
                                       WHERE time > DATE_SUB(NOW(), INTERVAL 24 HOUR) 
                                       GROUP BY powadorId;');
}

function insertStmt($connection): mysqli_stmt
{
    return mysqli_prepare($connection,
        'INSERT INTO entries(
                    time,powadorId,state,genVoltage,genCurrent,genPower,netVoltage,netCurrent,netPower,temperature) 
                    VALUES(DATE_SUB(NOW(), INTERVAL ? DAY_SECOND),?,?,?,?,?,?,?,?,?);');
}
