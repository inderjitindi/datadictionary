<?php
    include('config.php');
    
    class Load {
	
	function loadTables()
	{
	    
	    $tableNames = '';
	    $tablegetFields = '';
	    $db = new db();
	    $connection = $db->connect();
	    $result = mysqli_query($connection, "show tables from vwalletin");
	    while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
	    {
		$tablegetFields .= $row[0] . ',';
		$tableNames .= "<li><a href='#$row[0]'>" . $row[0] . '</a></li>';
	    }
	    $numRowsTable = $result->num_rows;
	    mysqli_free_result($result);
	    
	    return array($tableNames, $numRowsTable, $tablegetFields);
	}
	
	
	function getFields($tableName)
	{
	    $num = 1;
	    $rowHead = '';
	    $rows = "";
	    $db = new db();
	    $connection = $db->connect();
	    $result = mysqli_query($connection, "SHOW FULL COLUMNS FROM $tableName") or die(mysqli_error($connection));
	    $roww = $this->getTableStatus($tableName);
	    //print_r($roww[1]);
	    //exit();
	    $rowHead = "<table class='table table-striped'><tr><th colspan='10'> <div class=\"tooltip\">Status
<span class=\"tooltiptext\">
<span class='tooltipcolor'>Engine:</span> " . $roww['Engine'] . "<br>
<span class='tooltipcolor'>Avg row length:</span> " . $roww['Avg_row_length'] . "<br>
<span class='tooltipcolor'>Data length:</span> " . $roww['Data_length'] . "<br>
<span class='tooltipcolor'>Max data length:</span> " . $roww['Max_data_length'] . "<br>
<span class='tooltipcolor'>Index length:</span> " . $roww['Index_length'] . "<br>
<span class='tooltipcolor'>Auto increment:</span> " . $roww['Auto_increment'] . "<br>
<span class='tooltipcolor'>Create time:</span> " . $roww['Create_time'] . "<br>
<span class='tooltipcolor'>Update time:</span> " . $roww['Update_time'] . "<br>
<span class='tooltipcolor'>Check time:</span> " . $roww['Check_time'] . "<br>
<span class='tooltipcolor'>Collation:</span> " . $roww['Collation'] . "<br>
<span class='tooltipcolor'>Create options:</span> " . $roww['Create_options'] . "
</span>
</div> $tableName  - ". $roww['Rows'] ." Rows - ". round(($roww['Data_length'] + $roww['Index_length']) / 1024, 2) ." Kbs <br> Comment: " . $roww['Comment'] . "</th></tr>";
	    while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
	    {
		if($row[6]) { $auto_i =  " - ".$row[6];  } else  {$auto_i = ''; };
		$rows .= '<tr><td>' . $num++ . '</td><td>' . $row[0] . $auto_i . '</td><td>' . $row[1] . '</td><td>' . $row[2] . '</td><td>' . $row[3] . '</td><td>' . $row[4] . '</td><td>' . $row[5] . '</td><td class="comm">' . $row[8] . '</td></tr>';
	    }
	    $rowHead .= "<tr><th>No.</th><th>Field</th><th>Type</th><th>Collation</th><th>Null</th><th>Key</th><th>Default</th><th>Comment</th></th>";
	    mysqli_free_result($result);
	    
	    return $rowHead . $rows . '</table>';
	    
	}
	
	function getTableStatus($table)
	{
	    
	    $db = new db();
	    $connection = $db->connect();
	    $result = mysqli_query($connection, "show table status where name='$table'") or die(mysqli_error($connection));
	    $row = mysqli_fetch_array($result);
	    mysqli_free_result($result);
	    
	    return $row;
	    
	}
	
    }