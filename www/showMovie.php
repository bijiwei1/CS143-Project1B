<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css"/>
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
    <a href="showActor.php?aid=47801"> Show Actor information</a>
    <a href="showMovie.php?id=106"> Show Movie information</a>
    </ul>
    <h3>Search Actor/Movie</h3>
    <a href="search.php"> Search Actor/Movie</a>
    <br />
</div>

<div class="target">
    <h1>Show Movie Information<h1>
    <form action="search.php" method="GET">
        Search:<br/>
        <input type="text" name="keyword" value="Search..." /><br/><br/>
        <input type="submit" value="Click Me!" />
    </form>

    <?php
    if (!isset($_GET["id"]) || $_GET["id"] === ""){
        echo "Please enter keyword";
        exit(1);
    }

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


    $id = (int) $_GET["id"];

    // Find actor info
    $query = "SELECT * FROM Movie WHERE id=" . $id . ";";
    if (!$result = mysql_query($query)){
         echo "Connection failed for given query " ;
        exit(1);
    }

    if (mysql_num_rows($result) != 1){
        echo "Failed to find actor by given id";
        exit(1);
    }

    //print actor info
    echo "Movie Information is : \n";
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

    //Find Actor's Movies and Role info
    $query = "SELECT a.first, a.last, ma.role, a.id FROM MovieActor as ma, Actor as a  WHERE ma.mid=" . $id . " AND ma.aid = a.id;";
    if (!$result = mysql_query($query)){
         echo "Connection failed for given query ";
        exit(1);
    }
    //print actor's movie and row
    echo "Actors in this Movie : \n";

    echo "<table>\n";
        echo "<tr>";
            echo "<td>" . "Name" . "</td>";
            echo "<td>" . "Role" . "</td>";
        echo"</tr>";

        while ($row = mysql_fetch_assoc($result)) {
            $name = $row["first"] . " " . $row["last"]; 
            $role = $row["role"];
            $aid = $row["id"];
            echo "<tr>";
                echo "<td>" . $role . "</td>";
                echo "<td>" . "<a href=\"./showActor.php?aid=$aid\">$name</a>" . "</td>";
            echo "</tr>\n";
        }    
    echo "</table>\n";

    //Show comment
    $query = "SELECT * FROM Review  WHERE mid=" . $id .";";
    while ($row = mysql_fetch_assoc($result)) {
            $name = $row["name"] . " " . $row["last"]; 
            $time = $row["time"];
            $rating = $row["rating"];
            $comment = $row["comment"];
            echo = $name . "rates the this movie with score " . $rating . " and left a review at " .$time;
            echo = "comment: " . $comment;
    }  

    mysql_free_result($result);
    mysql_close($db_connection);
    ?>
</div>

</body>
</html>