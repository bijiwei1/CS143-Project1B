<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <style type="text/css">
        input[type="text"]{
            height: 30px;
            border: 1px solid grey;
            border-radius: 5px;
        }

        #movie {
            height: 30px;
            border: 1px solid grey;
            border-radius: 5px;
            width: 60%;
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
<h1>Add new Movie and Actor Relation</h1>

<form action="" method="POST">  
    Movie<br\>
    <select name="movie" id = "movie">
    <option movie_title=""></option>
    <?php 
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

        //Find all movies
        $query = "SELECT title FROM Movie ORDER BY title ASC";
        if (!$result = mysql_query($query)){
            echo "Failed to search in Movie";
            exit(1);
        }

        while ($row = mysql_fetch_row($result)) {
            $movie_title = $row[0];
            if (is_null($val)){
                $movie_title = "N/A";
            }
            echo '<option value="'. $movie_title .'</option>';
        }
    ?>
    </select>

    <br/><br/><br/><input type="submit" value="Add!"/>
</form> 

</div>



</body>
</html>