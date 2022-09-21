<html>
    <head>
        <title>Creating a Note</title>
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
        <h1>Creating a Note:</h1>
        <hr>
        <br>
        <?php

        // get the emial, content, color, TypeID, Category, and label from the form
        $email = $_POST['email'];
        $content = $_POST['content'];
        $color = $_POST['color'];
        $TypeID = $_POST['TypeID'];
        $Category = $_POST['Category'];
        $label = $_POST['label'];

        // make sure that the first letter of category is capitalized
        $Category = ucfirst($Category);
        $TypeIDfix = strtolower($TypeID);
        $TypeIDfix = ucfirst($TypeIDfix);
        $TypeID = str_replace(' ', '', $TypeID);

        // connect to the database
        $db = mysqli_connect('localhost', 'UserName', 'Password', 'Username');
        
        // check connection
        if (mysqli_connect_errno()) {
            echo '<p>Error: Could not connect to database.<br/>
            Please try again later.</p>';
            exit;
        }
        echo "<p>connected </p>";

        // next we check that the email is of a user in the USER table, if it is not we throw an error
        $query = "SELECT * FROM USER WHERE Email = '$email'";
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo "<p>Error: The email you entered is not in the database. Please try again.</p>";
            // redirect to Complex.html
            echo "<p>Redirecting to Complex.html...</p>";
            header("refresh:3;url=Complex.html");
            exit;
        }
        echo "<p>email is in the database</p>";

        // now we insert the note into the NOTE table
        $query = "INSERT INTO NOTE(UserEmail, Content, Color, TypeID) VALUES ('$email', '$content', '$color', '$TypeID')";
        $result = mysqli_query($db, $query);

        // check query, if it fails display the error from the database
        if (!$result) {
            echo "<p>Error: The note you entered could not be added to the database. Please try again.</p>";
            exit;
        }
        echo "<p>note added to the database</p>";

        // grab the notID from the new note we just inserted
        $query = "SELECT NoteID FROM NOTE WHERE UserEmail = '$email' AND Content = '$content' AND Color = '$color' AND TypeID = '$TypeID'";
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo "<p>Error: The note you entered could not be added to the database. Please try again.</p>";
            exit;
        }
        echo "<p>noteID grabbed from the database</p>";

        // now put the result into a variable
        $row = mysqli_fetch_assoc($result);
        $inoteID = $row['NoteID'];
        echo "$TypeID \n";

        $grabcat = $TypeIDfix . "NID";
        echo "$grabcat \n";
        echo "$Category \n";
        echo "$label \n";
        echo "$inoteID \n";

        if ($TypeID == 'WORK') {
            if ($label == "Projects"){
                $query = "INSERT INTO WORK(WorkNID, Projects) Values ($inoteID, '$label')";
                $result = mysqli_query($db, $query)
                or die("Query failed: " . mysqli_error($db));

            }
            else {
                $query = "INSERT INTO WORK(WorkNID, Deadlines) Values ($inoteID, '$label')";
                $result = mysqli_query($db, $query)
                or die("Query failed: " . mysqli_error($db));

            }

        }
        if ($TypeID == 'SCHOOL') {
            if ($label == "HomeWork"){
                $query = "INSERT INTO SCHOOL(SchoolNID, HomeWork) Values ($inoteID, '$label')";
                $result = mysqli_query($db, $query)
                or die("Query failed: " . mysqli_error($db));

            }
            else {
                $query = "INSERT INTO SCHOOL(SchoolNID, TestDate) Values ($inoteID, '$label')";
                $result = mysqli_query($db, $query)
                or die("Query failed: " . mysqli_error($db));
            }
            
        }
        if ($TypeID == 'TODO') {
            if ($label == "Grocery"){
                $query = "INSERT INTO TODO(TodoNID, Grocery) Values ($inoteID, '$label')";
                $result = mysqli_query($db, $query)
                or die("Query failed: " . mysqli_error($db));

            }
            else {
                $query = "INSERT INTO TODO(TodoNID, Errand) Values ($inoteID, '$label')";
                $result = mysqli_query($db, $query)
                or die("Query failed: " . mysqli_error($db));
            }
            
        }
        if ($TypeID == 'FAMILY') {
            if ($label == "Birthdays"){
                $query = "INSERT INTO FAMILY(TodoNID, Birthdays) Values ($inoteID, '$label')";
                $result = mysqli_query($db, $query)
                or die("Query failed: " . mysqli_error($db));

            }
            else {
                $query = "INSERT INTO FAMILY(TodoNID, Holiday) Values ($inoteID, '$label')";
                $result = mysqli_query($db, $query)
                or die("Query failed: " . mysqli_error($db));
            }
        }
        if ($TypeID == 'IMPORTANT') {
            if ($label == "Passwords"){
                $query = "INSERT INTO IMPORTANT(TodoNID, Passwords) Values ($inoteID, '$label')";
                $result = mysqli_query($db, $query)
                or die("Query failed: " . mysqli_error($db));

            }
            else {
                $query = "INSERT INTO IMPORTANT(TodoNID, SSN) Values ($inoteID, '$label')";
                $result = mysqli_query($db, $query)
                or die("Query failed: " . mysqli_error($db));
            }
            
        }
        // check query error
        if (!$result) {
            echo "<p>Error: The note you entered could not be added to the database. Please try again.</p>";
            exit;
        }
        echo "<p>note added to the database</p>";
        echo "<hr>";
        echo "<br>";
        echo "<br>";
        echo "<p>Here are your results:</p>";

        // select the row from the NOTE table using the noteID inoteID

        $query = "SELECT * FROM NOTE WHERE NoteID = '$inoteID'";
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo "<p>Error: The note you entered could not be added to the database. Please try again.</p>";
            exit;
        }
        echo "query successful";

        // now display the results with a while loop
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p>";
            echo "NoteID: " . $row['NoteID'] . "<br>";
            echo "UserEmail: " . $row['UserEmail'] . "<br>";
            echo "Content: " . $row['Content'] . "<br>";
            echo "Color: " . $row['Color'] . "<br>";
            echo "TypeID: " . $row['TypeID'] . "<br>";
            echo "</p>";
        }
        echo "<hr>";

        // now we select the note from the table using the inoteID and the TypeID
        $query = "SELECT * FROM $TypeID WHERE $grabcat = '$inoteID'";
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo "<p>Error: The note you entered could not be added to the database. Please try again.</p>";
            exit;
        }
        echo "query successful";

        // now display the results with a while loop
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p>";
            echo "$TypeID: " . $row['$TypeID'] . "<br>";
            echo "$grabcat: " . $row['$grabcat'] . "<br>";
            echo "</p>";
        }
        echo "<hr>";
        

        

        // close the database
        mysqli_close($db);

        // free result
        mysqli_free_result($result);
        ?>
    </body>
</html>