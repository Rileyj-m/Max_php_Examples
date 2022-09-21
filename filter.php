<html>
<head>
  <title>Modify Notes</title>
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
                margin-left: 120px;
            }
            h6 {
                font-family: 'Raleway', sans-serif;
            }
        </style>
</head>
<body>
        <br>
        <hr>
        <h1>Modify Your Notes:</h1>
        <hr>
        <br>
        <br>
        <br>
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
        echo "connected ";

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
            echo '<p>You do not have any notes or an account.</p>';
            exit;
        }

        // display the data
        echo "<br>";
        echo"<h1>Here are your Notes</h1>";
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
    ?>
    <!-- add another form to use this information to share a note with another user -->

    <br>
    <hr>
        <h1>Select a Note That You Want to Modify:</h1>
        <h6>A New Creation Date Will be Set if Note is Updated</h6>
        <hr>
        <br>
    <form action="notemod.php" method="post">
        <p>
        <b>Enter The NoteID of The Note You Would Like to Modify:</b>
        <br>
        <br>
            <label for="noteID">NoteID:</label>
            <input type="text" name="noteID" id="noteID" />
        </p>
        <br>
        <p>
            <input type="checkbox" id="delete" name="deletenote" value="delete">
            <label for="deletenote"> Delete This Note (If Selected, Note Will Be Delete and No Other Changes Will Take Effect):</label><br>
        </p>
        <br>
        <p>
            <b>Enter in new Content if You Would Like To Update The Content Of Your Note:</b>
                <br>
                <br>
            <label for="content">Content:</label>
            <input type="text" name="content" id="content" />
        </p>
        <br>
        <p>
            <!-- add an option to change the color, or the type of note -->
            <b>Enter in new Color if You Would Like To Update The Color Of Your Note:</b>
                <br>
                <br>
            <label for="color">Color:</label>
            <input type="text" name="color" id="color" />
        </p>
        <br>
        <p>
        <b>Enter in new Type if You Would Like To Update The Type Of Your Note</b>
        <br>
        <br>
            <label for="type">Type:</label>
            <input type="text" name="type" id="type" />
        </p>
        <br>
        <p>
            <b>Enter in new Due Date of Note (If left Blank Note Will Keep Original Due-Date):</b>
            <br>
            <br>
            <label for="email2">Due Date: (YYYY-MM-DD)</label>
            <input type="text" name="date" id="date" />
        </p>
        <p>
            <input type="submit" name="submit" value="Submit" />
        </p>
    </form>
</body>