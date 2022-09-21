<html>
<body>
    <?php

        // get the email from the form

        $email = $_POST['email'];

        // connect to the database
        $db = mysqli_connect('localhost', 'UserName', 'Password', 'Username');
        
        // check connection
        if (mysqli_connect_errno()) {
            echo '<p>Error: Could not connect to database.<br/>
            Please try again later.</p>';
            exit;
        }
        echo "connected";

        // nect, using the email i want to grab every noteID and Conect of that NOTEid and display it 

        $query = "SELECT NoteID, Content FROM NOTE WHERE UserEmail = '$email'";
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }
        echo "query successful";

        // check if the resulting set is empty
        if (mysqli_num_rows($result) == 0) {
            echo '<p>You do not have any notes.</p>';
            exit;
        }

        // display the data
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
    ?>
    <!-- add another form to use this information to share a note with another user -->

    <form action="share.php" method="post">
        <p>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" />
        </p>
        <p>
            <label for="noteID">NoteID:</label>
            <input type="text" name="noteID" id="noteID" />
        </p>
        <p>
            <label for="email2">Email2:</label>
            <input type="text" name="email2" id="email2" />
        </p>
        <p>
            <input type="submit" name="submit" value="Submit" />
        </p>
</body>