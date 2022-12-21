<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) {
        //instantiates username, password, and email
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        //talks to the server to connect with the hostname being part of the local machine
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "test";
//attempts a connection to the mysql databse
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
//error if unable to connect, and if able to, move to grant access to input
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM register WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO register(username, password, email) values(?, ?, ?)";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();
//requirements for input
                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("ssssii",$username, $password, $email);
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registers using this email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>
