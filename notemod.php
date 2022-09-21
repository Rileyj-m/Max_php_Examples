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
        $content = $_POST['content'];
        $type = $_POST['type'];
        $delete = $_POST['delete'];
        $color = $_POST['color'];
        $NOTETYPE = '';

        //make the first letter of type uppercase
        $type = ucfirst($type);

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

        // check that the delete checkbox is checked

        if ($delete == "on") {
            // delete the note
            $query = "DELETE FROM NOTE WHERE NoteID = '$noteID'";
            $result = mysqli_query($db, $query);

            // check query
            if (!$result) {
                echo '<p>Error: Could not delete note.<br/>
                Please try again later.</p>';
                exit;
            }
            echo "Note Has Been deleted";
            exit;
        }

        // if date is not empty, the we need to update the NOTENOTIFICATION table ExpirationDate

        if ($date != "") {
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

            // using that same query, we get the typeID of the note from the result and put it in a variable
            $NOTETYPE = $row['TypeID'];

            // now we add the noteID, the todaydate, and the date to the NOTENOTIFICATION table

            // first check if the noteID is already in the NOTENOTIFICATION table
            $query = "SELECT * FROM NOTENOTIFICATION WHERE NID = '$noteID'";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_array($result);

            // if the noteID is already in the NOTENOTIFICATION table, then we do not need to add it again
            if ($row) {
                // update the NOTENOTIFICATION table by setting the ExpirationDate to the date and the CreationDate to today's date
                $query = "UPDATE NOTENOTIFICATION SET ExpirationDate = '$date', CreationDate = '$todaydate' WHERE NID = '$noteID'";
                $result = mysqli_query($db, $query);

                // check query
                if (!$result) {
                    echo '<p>Error: Could not update note.<br/>
                    Please try again later.</p>';
                    exit;
                }
                echo "Note Has Been Updated";
            }
        }

        // check if content is not empty. Then update the content of the note in the NOTE table, and update the CreationDate in the NOTENOTIFICATION Table
        if ($content != "") {
            $query = "UPDATE NOTE SET Content = '$content' WHERE NoteID = '$noteID'";
            $result = mysqli_query($db, $query);

            // check query
            if (!$result) {
                echo '<p>Error: Could not update note.<br/>
                Please try again later.</p>';
                exit;
            }
            echo "Note Has Been Updated";

            // update the NOTENOTIFICATION table by setting  the CreationDate to today's date
            $query = "UPDATE NOTENOTIFICATION SET CreationDate = '$todaydate' WHERE NID = '$noteID'";
            $result = mysqli_query($db, $query);

            // check query
            if (!$result) {
                echo '<p>Error: Could not update note.<br/>
                Please try again later.</p>';
                exit;
            }
            echo "Note Has Been Updated";
        }
        if ($color != "") {
            $query = "UPDATE NOTE SET Color = '$color' WHERE NoteID = '$noteID'";
            $result = mysqli_query($db, $query);

            // check query
            if (!$result) {
                echo '<p>Error: Could not update note.<br/>
                Please try again later.</p>';
                exit;
            }
            echo "Note Has Been Updated";

            // update the NOTENOTIFICATION table by setting  the CreationDate to today's date
            $query = "UPDATE NOTENOTIFICATION SET CreationDate = '$todaydate' WHERE NID = '$noteID'";
            $result = mysqli_query($db, $query);

            // check query
            if (!$result) {
                echo '<p>Error: Could not update note.<br/>
                Please try again later.</p>';
                exit;
            }
            echo "Note Has Been Updated";
        }

        if ($type != "") {
            $query = "UPDATE NOTE SET TypeID = '$type' WHERE NoteID = '$noteID'";
            $result = mysqli_query($db, $query);

            // check query
            if (!$result) {
                echo '<p>Error: Could not update note.<br/>
                Please try again later.</p>';
                exit;
            }
            echo "Note Has Been Updated";

            // update the NOTENOTIFICATION table by setting  the CreationDate to today's date
            $query = "UPDATE NOTENOTIFICATION SET CreationDate = '$todaydate' WHERE NID = '$noteID'";
            $result = mysqli_query($db, $query);

            // check query
            if (!$result) {
                echo '<p>Error: Could not update note.<br/>
                Please try again later.</p>';
                exit;
            }
            echo "Note Has Been Updated";

            // now we take the NOTETYPE variable and make it all uppercase
            // add NID to the end of $type
            $type = $type . "NID";
            $NOTETYPE = strtoupper($NOTETYPE);

            // and we use that to delete the note from the $NOTETYPE table with the NoteID
            $query = "DELETE FROM $NOTETYPE WHERE '$type' = '$noteID'";
            $result = mysqli_query($db, $query);

            // check query
            if (!$result) {
                echo '<p>Error: Could not update note.<br/>
                Please try again later.</p>';
                exit;
            }
            echo "Note Has Been Removed from the $NOTETYPE Table";

            


        }


        // close the connection
        mysqli_close($db);
        // free result set
        mysqli_free_result($result);
        }
    ?>
</body>
</html>