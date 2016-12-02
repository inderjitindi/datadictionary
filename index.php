<?php
    include("load.php");
    
    $tableFields = '';
    
    $ab = new load();
    $tableNames = $ab->loadTables();
    $tableNamesFields = explode(',', rtrim($tableNames[2], ","));
    foreach ($tableNamesFields as &$value) {
	$tableFields .= $ab->getFields($value);
    }
    
    $template = template();
    $template = str_replace("{tablename}", $tableNames[0], $template);
    $template = str_replace("{tableCount}", $tableNames[1], $template);
    $template = str_replace("{fields}", $tableFields, $template);
    echo $template;
    
    
    function template()
    {
	
	$template_n = "<!DOCTYPE html>
<html>
<head>
    <title>XXXXXX</title>
    <style>body {
    font-family: Verdana;
    font-size: 11px;
}
.comm td{
	width: 10px;
	word-break: break-all;
	word-wrap:normal;
		}
.nav {
    position: fixed;
    width: 100%;
    font-size: 19px;
    font-weight: bold;
}
#leftCol {
    position: fixed;
    width: 250px;
    background-color: #DDD;
    overflow-y: scroll;
    top: 60px;
    bottom: 0;
}
.heading {
    margin: 7px 0 0 6px !important;
    font-size: 14px;
    font-weight: bold;
}
.dated {
    font-size: 12px;
}
.dname {
    font-style: italic;
    font-size: 18px;
    color: brown;
}
.red {
    color: crimson;
}
#content {
    position: relative;
    margin-left: 255px;
    top: 60px;
}
#leftCol ul {
    margin-left: 28px;
    padding: 0;
}

table {
    border-collapse: collapse;
    border-spacing: 0;
}
td, th {
    padding: 0;
}
th {
    text-align: left;
}
.table {
    width: 100%;
    margin-bottom: 20px;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    padding: 8px;
    line-height: 1.428571429;
    vertical-align: top;
    border-top: 1px solid #ddd;
}
.table > thead > tr > th {
    vertical-align: bottom;
    border-bottom: 2px solid #ddd;
}
.table > caption + thead > tr:first-child > th,
.table > colgroup + thead > tr:first-child > th,
.table > thead:first-child > tr:first-child > th,
.table > caption + thead > tr:first-child > td,
.table > colgroup + thead > tr:first-child > td,
.table > thead:first-child > tr:first-child > td {
    border-top: 0;
}
.table > tbody + tbody {
    border-top: 2px solid #ddd;
}
.table .table {
    background-color: #fff;
}

.table-striped > tbody > tr:nth-child(odd) > td,
.table-striped > tbody > tr:nth-child(odd) > th {
    background-color: #f7f7f7;
}

.table-striped > tbody > tr:first-child > th {
    background-color: #f2ecd2;
}
.table-striped > tbody > tr:nth-child(2) > th {
    background-color: #f4f3ed;
}
.table-hover > tbody > tr:hover > td,
.table-hover > tbody > tr:hover > th {
    background-color: #f5f5f5;
}     

.table > thead > tr > th {
    border-bottom: 2px solid #ddd;
    vertical-align: bottom;
}
.trtop{
    background-color:#f0f8ff; !important;
}
.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 250px;
    background-color: black;
    color: #fff;
    text-align: left;
    border-radius: 6px;
    padding: 10px;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
}
.tooltipcolor { color: lightblue; }
    </style>
</head>
<body>
<div class=\"nav\">
    Data Dictionary <span class=\"dated\">- 20 Jan 2016</span>
    <br> Database : <span class=\"dname\">Vwalletin</span>
</div>

<div id=\"leftCol\">
    <div class=\"heading\">Index - <span class='red'>{tableCount} tables</span></div>
<ul>
    {tablename}
</ul>
</div>
<div id=\"content\">

{fields}
</table>
</div>
</body>
</html>";
	
	return $template_n;
    }
