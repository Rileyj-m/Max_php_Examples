<html>
<body>
    <?php
        // connect to the database
        $db = mysqli_connect('localhost', 'UserName', 'Password', 'Username');
        
        // check connection
        if (mysqli_connect_errno()) {
            echo '<p>Error: Could not connect to database.<br/>
            Please try again later.</p>';
            exit;
        }

        // next, I want to display all the tables in the database and their contents
        $query = 'SELECT * FROM USER';
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }

        // display the data
        echo "<h1>Data Before Reset</h1>";
        echo "<br>";
        echo"<h1>USER Table</h1>";
        echo '<table border="1">';
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
            foreach ($line as $col_value) {
                echo '<td>' . $col_value . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';

        // now do the same thing with the NOTE table
        $query = 'SELECT * FROM NOTE';
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }

        // display the data
        echo "<br>";
        echo"<h1>NOTE Table</h1>";
        echo '<table border="1">';
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
            foreach ($line as $col_value) {
                echo '<td>' . $col_value . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';

        $query = 'SELECT * FROM NOTENOTIFICATION';
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }

        // display the data
        echo "<br>";
        echo"<h1>NOTENOTIFICATION Table</h1>";
        echo '<table border="1">';
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
            foreach ($line as $col_value) {
                echo '<td>' . $col_value . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';

        $query = 'SELECT * FROM WORK';
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }

        // display the data
        echo "<br>";
        echo"<h1>WORK Table</h1>";
        echo '<table border="1">';
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
            foreach ($line as $col_value) {
                echo '<td>' . $col_value . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';

        $query = 'SELECT * FROM SCHOOL';
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }

        // display the data
        echo "<br>";
        echo"<h1>SCHOOL Table</h1>";
        echo '<table border="1">';
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
            foreach ($line as $col_value) {
                echo '<td>' . $col_value . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';

        $query = 'SELECT * FROM TODO';
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }

        // display the data
        echo "<br>";
        echo"<h1>TODO Table</h1>";
        echo '<table border="1">';
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
            foreach ($line as $col_value) {
                echo '<td>' . $col_value . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';

        $query = 'SELECT * FROM FAMILY';
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }

        // display the data
        echo "<br>";
        echo"<h1>FAMILY Table</h1>";
        echo '<table border="1">';
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
            foreach ($line as $col_value) {
                echo '<td>' . $col_value . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';

        $query = 'SELECT * FROM IMPORTANT';
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }

        // display the data
        echo "<br>";
        echo"<h1>IMPORTANT Table</h1>";
        echo '<table border="1">';
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
            foreach ($line as $col_value) {
                echo '<td>' . $col_value . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';

        $query = 'SELECT * FROM SHARESNOTE';
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }

        // display the data
        echo "<br>";
        echo"<h1>SHARESNOTE Table</h1>";
        echo '<table border="1">';
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
            foreach ($line as $col_value) {
                echo '<td>' . $col_value . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';

        $query = 'SELECT * FROM AREFRIENDS';
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }

        // display the data
        echo "<br>";
        echo"<h1>AREFRIENDS Table</h1>";
        echo '<table border="1">';
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
            foreach ($line as $col_value) {
                echo '<td>' . $col_value . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';

        $query = 'SELECT * FROM NOTIFIESUSER';
        $result = mysqli_query($db, $query);

        //select all records from USER table
        $query = 'SELECT * FROM USER';
        $result = mysqli_query($db, $query);

        // now display all the results
        echo "<br>";
        echo"<h1>USER Table</h1>";
        echo '<table border="1">';
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>';
            foreach ($line as $col_value) {
                echo '<td>' . $col_value . '</td>';
            }
            echo '</tr>';
        }

        // automatically redirect to another php page
        header("Location: index.php");

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }

        // display the data
        echo "<br>";
        echo"<h1>NOTIFIESUSER Table</h1>";
        echo '<table border="1">';
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            // get the length of the array

            echo '<tr>';
            foreach ($line as $col_value) {
                echo '<td>' . $col_value . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';


        // now we need to delete all the tables in one go
        $query = 'DROP TABLE USER, SCHOOL, TODO, FAMILY, IMPORTANT, SHARESNOTE, AREFRIENDS, NOTIFIESUSER, NOTE, NOTENOTIFICATION, WORK';
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not delete data from database.<br/>
            Please try again later.</p>';
            exit;
        }

        $sql= file_get_contents('FILEPATH');
        mysqli_multi_query($link,$sql)
            or die("Reset failed ");
        echo "reset ok ";

        // insert data into the USER table
        $query = 'INSERT INTO USER (user_id, user_name, user_password, user_email, user_type) VALUES
        (1, "admin", "admin")';
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not insert data into database.<br/>
            Please try again later.</p>';
            exit;
        }



        // close the database connection and free the result set
        mysqli_free_result($result);
        mysqli_close($db);
    ?>
</body>