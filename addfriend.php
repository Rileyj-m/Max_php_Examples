<html>
<head>
  <title>User Create account</title>
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
        </style>
</head>
<body>
<br>
        <hr>
        <h1>Add Friend</h1>
        <hr>
        <br>
        <br>
        <br>
<?php
    // get the email, pass, name, and age from post and assign them to variables
    $email = $_POST['email'];
    $email2 = $_POST['friendemail'];
    

    // check that age > 10 and password length >= 8
    if ($email == $email2) {
        echo '<p>Error: The emails cannot be the same.</p>';
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

    // we need to check that email1 and email2  are in the USER table
    $query = "SELECT * FROM USER WHERE Email = '$email'";
    $result = mysqli_query($db, $query);

    // print out the result
    empty($result);

    // chcek if the result is empty, if it is throw an error
    if (!$result) {
        echo '<p>Error: One of the accounts does not excist. Please create an account and try again.</p>';
        exit;
    }

    $query = "SELECT * FROM USER WHERE Email = '$email2'";
    $result = mysqli_query($db, $query);

    // chcek if the result is empty, if it is throw an error
    if (!$result) {
        echo '<p>Error: One of the accounts does not excist. Please create an account and try again.</p>';
        exit;
    }

    // now we need to check if the two emails are already friends in the AREFRIENDS table
    $query = "SELECT * FROM AREFRIENDS WHERE FriendEmail1 = '$email' AND FriendEmail2 = '$email2'";
    $result = mysqli_query($db, $query);

    // check if the query is empty, if it is, then the two emails are not friends and we can add them
    if (mysqli_num_rows($result) == 0) {
        // now we need to add the user to the database
        $query = "INSERT INTO AREFRIENDS (FriendEmail1, FriendEmail2) VALUES ('$email', '$email2')";
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }
        echo "friend added";

        // now we display the AREFRIENDS table
        $query = "SELECT * FROM AREFRIENDS";
        $result = mysqli_query($db, $query);

        // check query
        if (!$result) {
            echo '<p>Error: Could not retrieve data from database.<br/>
            Please try again later.</p>';
            exit;
        }
        echo "query successful";

        // now we display the table
        echo "<table>";
        echo "<tr><th>FriendEmail1</th><th>FriendEmail2</th></tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr><td>";
            echo $row['FriendEmail1'];
            echo "</td><td>";
            echo $row['FriendEmail2'];
            echo "</td></tr>";
        }
        echo "</table>";
    }
    else {
        echo '<p>Error: The two emails are already friends.</p>';
        exit;
    }

    // close the database connection and free the result set

    mysqli_close($db);
    mysqli_free_result($result);

?>

</body>
</html>