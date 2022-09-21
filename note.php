<html>
<head>
  <title>Find Notes</title>
  <style>
            @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@100;700&display=swap');
            h1 {
                font-family: 'Raleway', sans-serif;
            }
            body {
                background-color: #EEEEEE;
            }
            h4 {
                font-family: 'Raleway', sans-serif;
                margin-left: 120px;
            }
            a {
                margin-left: 120px;
            }
            p {
                font-family: 'Raleway', sans-serif;
            }
            h6 {
                font-family: 'Raleway', sans-serif;
            }
        </style>
</head>
<body>
        <br>
        <hr>
        <h1>Create a Note Notification:</h1>
        <hr>
        <br>
        <br>
        <br>
    <?php

        // get the noteID from post and the data from post
        $noteID = $_POST['noteID'];
        $date = $_POST['date'];

        // connect to the database
        $db = mysqli_connect('localhost', 'UserName', 'Password', 'Username');
        
        // check connection
        if (mysqli_connect_errno()) {
            echo '<p>Error: Could not connect to database.<br/>
            Please try again later.</p>';
            exit;
        }
        echo "connected";

        // get the current date right now and put it into a variable
        $todaydate = date("Y-m-d");

        // if the $date is empty, make is NULL
        if ($date == "") {
            $date = NULL;
        }

        // check that the noteID is in the NOTE table
        $query = "SELECT * FROM NOTE WHERE NoteID = '$noteID'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_array($result);

        // if the noteID is not in the NOTE table, then the noteID is not valid
        if (!$row) {
            echo "<p>Error: The noteID is not valid.</p>";
            exit;
        }
        echo "<p>NoteID is valid</p>";

        // now we add the noteID, the todaydate, and the date to the NOTENOTIFICATION table

        // first check if the noteID is already in the NOTENOTIFICATION table
        $query = "SELECT * FROM NOTENOTIFICATION WHERE NID = '$noteID'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_array($result);

        // if the noteID is already in the NOTENOTIFICATION table, then we do not need to add it again
        if ($row) {
            echo "<p>NoteID is already in the NOTENOTIFICATION table, please create a new note and try again</p>";
            echo "<a href='Complex.html'>Complex Functions</a>";
        }
        else {
            // if the noteID is not in the NOTENOTIFICATION table, then we add it
            $query = "INSERT INTO NOTENOTIFICATION (CreationDate, NID, ExpirationDate) VALUES ('$todaydate', '$noteID', '$date')";
            $result = mysqli_query($db, $query);
            echo "<p>Added to Note Notifications</p>";

        }

        if ($date != NULL) {
            // grab the users email from the NOTE table that matches the noteID
            $query = "SELECT UserEmail FROM NOTE WHERE NoteID = '$noteID'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_array($result);
            $email = $row['UserEmail'];

            // add the $date, $email to the NOTIFIESUSER table
            $query = "INSERT INTO NOTIFIESUSER(cDate, NotifyEmail, isNotified) VALUES ('$todaydate', '$email', '1')";
            $result = mysqli_query($db, $query);
        }

        // now we can select everything from the NOTENOTIFICATION table that matches the $email and display it
        $query = "SELECT * FROM NOTENOTIFICATION";
        $result = mysqli_query($db, $query);

        echo "<br>";
        echo "<hr>";
        echo "<br>";
        echo"<h1>All Note Notifications After Update.</h1>";

        echo "\t<tr>\n";
        while ($fieldinfo = $result -> fetch_field()){
            echo "\t\t<td>$fieldinfo->name</td>\n";
        }
        echo "\t</tr>\n";
        echo '<table border="1">';
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
            foreach ($line as $col_value) {
                echo '<td>' . $col_value . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';

        // select everything from the NOTIFIESUSER table
        $query = "SELECT * FROM NOTIFIESUSER";
        $result = mysqli_query($db, $query);

        echo "<br>";
        echo "<hr>";
        echo "<br>";
        echo"<h1>All Notifications for user after update.</h1>";
        echo "\t<tr>\n";
        while ($fieldinfo = $result -> fetch_field()){
            echo "\t\t<td>$fieldinfo->name</td>\n";
        }
        echo "\t</tr>\n";
        echo '<table border="1">';
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
            foreach ($line as $col_value) {
                echo '<td>' . $col_value . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';



        // close the connection
        mysqli_close($db);
    ?>
</body>