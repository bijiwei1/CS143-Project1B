<html>
<head>
    <style  type="text/css">
    table, td, th {
        border: 1px grey;
    }
    input[type="text"]{
			height: 30px;
			border: 1px solid grey;
    		border-radius: 5px;
    		width: 30%;
		}
    </style>
</head>

<body>
<div class="nav_bar">
<h1>Searching Page:</h1>
<form action="" method="GET">
    Search:<br/>
    <input type="text" name="Search..." /><br/><br/>
    <input type="submit" value="Click Me!" />
</form>

<?php
	if (!isset($_GET["keyword"]) || $_GET["keyword"] === ""){
		echo "Please enter keyword";
        exit(1);
	}
    $keyword = $_GET[keyword];

    $db_connection = mysql_connect("localhost", "cs143", "");

    if (!$db_connection){
        echo "Connection failed: " . mysql_error($db_connection) . "\n";
        exit(1);
    }

    $db_selected = mysql_select_db("CS143", $db_connection);
    if (!$db_selected){
        echo "Connection failed: " . mysql_error($db_selected) . "\n";
        exit(1);
    }

	if (!isset($_GET["mid"]) || $_GET["mid"] === ""){
		echo "No movie founded";
        exit(1);
	}

	

	// Search Actor
    $query = "SELECT * FROM Actor WHERE";


       

?>
</div>	

</body>
</html>