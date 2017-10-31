<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <style  type="text/css">
    table, th, td {
        border: 1px solid blue;
        
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
    <h3>Add new content</h3>
    <a href="addMovie.php"> Add Movie</a>
    <a href="addActorDir.php"> Add Actor/Director</a>  
    <a href="addReview.php"> Add Review</a>
    <a href="addMARelation.php"> Add Movie/Actor Relation</a>
    <a href="addMDRelation.php"> Add Movie/Director Relation</a>
    <h3>Browsering Content</h3>
    <a href="showActor.php"> Show Actor information</a>
    <a href="showMovie.php"> Show Movie information</a>
    </ul>
    <h3>Search Actor/Movie</h3>
    <a href="search.php"> Search Actor/Movie</a>
    <br />
</div>

<div class="target">
    <h1>Searching Page</h1>
    <form action="search.php" method="GET">
        Search:<br/>
        <input type="text" name="keyword" value="Search..." /><br/><br/>
        <input type="submit" value="Click Me!" />
    </form>

    <?php
	if (!isset($_GET["keyword"]) || $_GET["keyword"] === ""){
		echo "Please enter keyword";
        exit(1);
	}
    //store keywords 
    $keywords = explode(" ", $_GET["keyword"]);
    echo "Keywords are" . $keywords . "\n" . "size is " . count($keywords);

    //Search for Movie
    for ($i = 0; $i < (count($keywords) - 1); $i++){
        $condition .= "title LIKE '%" . $keywords[$i] . "%' AND ";
    }
    $last_id = count($keywords) - 1;
    $condition .= "title LIKE '%" .$keywords[$last_id] . "%'";
    $query = "select title, year from Movie where " . $condition . ";";
    echo $query;

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

    if (!$result = mysql_query($query)){
            echo "Failed to search in Movie";
            exit(1);
    }

    if (mysql_num_rows($result) === 0)
        echo "No matching movies found.\n";
    else
        echo "Found movies:\n";

    // Print table with results
    echo "Showing Results\n";
    echo "<table>\n";
    echo "<tr>";
    for ($i = 0; $i < mysql_num_fields($result); $i++) {
        $field = mysql_fetch_field($result, $i);
        echo "<td>" . $field->name . "</td>";
    }
    echo "</tr>\n";
    while ($row = mysql_fetch_row($result)) {
        echo "<tr>";
        for ($i = 0; $i < mysql_num_fields($result); $i++) {
            $val = $row[$i];
            if (is_null($val)){
                $val = "N/A";
            }
            echo "<td>" . $val . "</td>";
        }
        echo "</tr>\n";
    }    
    echo "</table>\n";

    //Search for Actor
    $condition = ""; 
    for ($i = 0; $i < (count($keywords) - 1); $i++){
        $condition .= "(last LIKE '%" . $keywords[$i] . "%' Or first LIKE '%" . $keywords[$i] . "%') AND" ;
    }
    $last_id = count($keywords) - 1;
    $condition .= "(last LIKE '%" . $keywords[$last_id] . "%' Or first LIKE '%" .               $keywords[$last_id] . "%')";
    $query = "select * from Actor where " . $condition . "ORDER BY dob;";
    echo $query;

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

    if (!$result = mysql_query($query)){
            echo "Failed to search in Movie";
            exit(1);
    }

    if (mysql_num_rows($result) === 0)
        echo "No matching Actor found.\n";
    else
        echo "Found Actor:\n";

    // Print table with results
    echo "Actor Information is : \n";
    echo "<table>\n";
    echo "<tr>";
        echo "<td>ID</td>";
        echo "<td>Name</td>";
        echo "<td>Date of Birth</td>";
    echo "</tr>\n";

    while ($row = mysql_fetch_assoc($result)) {
        echo "<tr>";
            $name = "$row[first] $row[last]";
            $aid = $row["id"];
            $dob = $row["dob"];
            echo "<td>" . $aid . "</td>";
            echo "<td>" . "<a href=\"./show_actor_info.php?aid=$aid\">$name</a>" . "</td>";
            echo "<td>" . $dob . "</td>";
        echo "</tr>\n";
    }    
    echo "</table>\n";

    mysql_free_result($result);
    mysql_close($db_connection);

    ?>
    </div>  
</body>
</html>