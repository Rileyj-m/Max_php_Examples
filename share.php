<html>
    <head>
        <title>Sharing a Note</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@100;700&display=swap');
            h1 {
                font-family: 'Raleway', sans-serif;
            }
            h2 {
                font-family: 'Raleway', sans-serif;
                margin-left: 120px;
            }
            body {
                background-color: #EEEEEE;
            }
            h4 {
                font-family: 'Raleway', sans-serif;
                margin-left: 120px;
            }
            h6 {
                font-family: 'Raleway', sans-serif;
                margin-left: 120px;
            }
            a {
                font-family: 'Raleway', sans-serif;
                margin-left: 120px;
            }
            form {
                margin-left: 120px;
                font-family: 'Raleway', sans-serif;
            }
            p {
                margin-left: 120px;
                font-family: 'Raleway', sans-serif;
            }
        </style>
    </head>

    <body>
    <br>
        <hr>
        <h1>Sharing You Note:</h1>
        <hr>
        <br>
        <?php

        // get the emial, noteid, and email 2 from the form
        $email = $_POST['email'];
        $noteID = $_POST['noteID'];
        $email2 = $_POST['email2'];

        // connect to the database
        $db = mysqli_connect('localhost', 'UserName', 'Password', 'Username');
        
        // check connection
        if (mysqli_connect_errno()) {
            echo '<p>Error: Could not connect to database.<br/>
            Please try again later.</p>';
            exit;
        }
        echo "<p>connected </p>";

        // next, we check that email1 and email 2 are friends in the AREFRIENDS table

        // first, we check if email1 and email2 are friends
        $query = "SELECT * FROM AREFRIENDS WHERE FriendEmail1 = '$email' AND FriendEmail2 = '$email2'";
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }
        echo "<p>query successful </p>";

        // next check that the result is not empty
        if (mysqli_num_rows($result) == 0) {
            echo "<p>Error: You are not friends with this user.</p>";
            // go back to the previos page
            echo "<a href='FindNotes.php'>Go Back</a>";
            exit;
        }
        echo "<p><u>You are friends with this user.</u></p>";

        // next, we check if the noteID is in the NOTE table
        $query = "SELECT * FROM NOTE WHERE NoteID = '$noteID'";
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }
        echo "<p>query successful </p>";

        // next check that the result is not empty
        if (mysqli_num_rows($result) == 0) {
            echo "<p>Error: This note does not exist.</p>";
            // go back to the previos page
            echo "<a href='FindNotes.php'>Go Back</a>";
            exit;
        }
        echo "<p><u>The note exists.</u></p>";

        // next we add the note to the SHARESNOTES table with the email 1 and email 2

        // first, we check if the note is already shared with the email 1 and email 2
        $query = "SELECT * FROM SHARESNOTE WHERE ShareNID = '$noteID' AND userEmail1 = '$email' AND userEmail2 = '$email2'";
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }
        echo "<p>query successful </p>";

        // next check that the result is empty
        if (mysqli_num_rows($result) != 0) {
            echo "<p>Error: This note is already shared with this user.</p>";
            // go back to the previos page
            echo "<a href='simple.html'>Go Back</a>";
            exit;
        }
        echo "<p><u>Note is not shared with user yet.</u></p>";

        // next, we add the note to the SHARESNOTES table with the email 1 and email 2
        $query = "INSERT INTO SHARESNOTE (userEmail1, userEmail2, ShareNID) VALUES ('$email', '$email2', '$noteID')";
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }
        echo "<p>query successful </p>";

        // now we select every note that is shared with the email 1 and email 2 and display it from the SHARESNOTE table
        $query = "SELECT * FROM SHARESNOTE WHERE userEmail1 = '$email' AND userEmail2 = '$email2'";
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }

        // display the results
        echo "<p>Here is the list of notes that are shared with this user:</p>";
        echo "<br>";
        echo"<h1>Here are your Notes</h1>";
        echo '<table border="1">';
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
            foreach ($line as $col_value) {
                echo '<td>' . $col_value . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
        echo "<hr>";
        echo "<br>";
        echo "<br>";
        echo "<h4>Your note has been shared! Click below to go back.</h4>";
        echo "<a href='simple.html'>Simple Functions</a>";
        // close connection and free result
        mysqli_close($db);
        mysqli_free_result($result);
        ?>
    </body>
</html>