<html>
<head>
  <title>User Create account</title>
</head>
<body>
<h1>User Account Creation</h1>
<?php
    // get the email, pass, name, and age from post and assign them to variables
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];
    $age = $_POST['age'];

    // now we trim
    $email = trim($email);
    $pass = trim($pass);
    $name = trim($name);
    $age = trim($age);

    // check that age > 10 and password length >= 8
    if ($age < 10 || strlen($pass) < 8) {
        echo '<p>Error: Age must be greater than 10 and password must be at least 8 characters long.</p>';
        exit;
    }

    // connect to the database
    $db = mysqli_connect('localhost', 'UserName', 'Password', 'Username');
    
    // check connection
    if (mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database.<br/>
        Please try again later.</p>';
        exit;
    }
    echo "connected to database";

    // now we need to check if the user exists by seeing if the email is in the database
    $query = "SELECT * FROM USER WHERE email = '$email'";
    $result = mysqli_query($db, $query);

    // check query, if the email is in the database, then the user excists and we cannot add the user
    if (!$result) {
        echo '<p>Error: Could not retrieve data from database.<br/>
        Please try again later.</p>';
        exit;
    }

    // if the email is not in the database, then we can add the user
    if (mysqli_num_rows($result) == 0) {
        // now we need to add the user to the database
        $query = "INSERT INTO USER (email, pass, name, age) VALUES ('$email', '$pass', '$name', '$age')";
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }
        echo "user added";
    } else {
        echo "<h4>user already exists, you need to select a different email address</h4>";
        // give them a button to go back to the form
        echo "<form action='simple.html' method='post'>";
    }

    // now we need to display the user table if the user was added
    $query = 'SELECT * FROM USER';
    $result = mysqli_query($db, $query);

    // check query
    if (!$result) {
        echo '<p>Error: Could not retrieve data from database.<br/>
        Please try again later.</p>';
        exit;
    }
    echo "query successful";

    // display the data
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

    // close the database connection and free the result
    mysqli_close($db);
    mysqli_free_result($result);
?>

</body>
</html>