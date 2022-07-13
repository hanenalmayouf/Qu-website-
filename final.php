<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <style>
        .logo img {
            margin: auto;
            display: block;
        }

        .header h1 {
            background-color: skyblue;
            text-align: center;
            font-style: italic;

        }

        .content {

            font-style: italic;
        }

        #name {
            color: red;
        }

        #title span {
            font-weight: bold;
        }
    </style>
</head>

<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "contacts";
$conn = new mysqli($servername, $username, $password);
$sql = "CREATE DATABASE IF NOT EXISTS contacts";
$result = $conn->query($sql);
$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = "SELECT ID FROM contactInfo";
$result = mysqli_query($conn, $query);
if (empty($result)) {
    $query = "CREATE TABLE contactInfo (
                          ID int(11) AUTO_INCREMENT,
                          name varchar(255) NOT NULL,
                          phone varchar(255) NOT NULL,
                          PRIMARY KEY  (ID)
                          )";
    $result = mysqli_query($conn, $query);
    $sql = "INSERT INTO contactInfo (name, phone)
    VALUES ('Asmaa', '56123799'),
    ('Rana', '57986321'),
    ('Reem', '56489712'),
    ('Sara', '57963148')";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM contactInfo";
$results = $conn->query($sql);
?>

    <div class="logo">
        <img src="image.jpg" height="150px" width="200px">
    </div>

    <div class="header">
        <h1> Web Application Lab Assignment </h1>
    </div>

    <div class="content">

        <h3 id="name"></h3>
        <script>
            window.onload = function myFunction() {
                var person = prompt("Please enter your name", "");
                var date = new Date();
                var h = date.getHours();
                var greeting = '';
                if (h < 10) {
                    greeting = "Good Morning";
                } else if (h < 20) {
                    greeting = "Good Day";
                } else {
                    greeting = "Good Evening";
                }

                if (person != null) {
                    document.getElementById("name").innerHTML = greeting + " " + person;
                }
            }
        </script>
        <h2> Contacts </h2>
        <div id="title"> <span> Name </span> ......... <span> Phone </span> </div>
        <br>
        <?php
        foreach ($results as $r) {
            echo '<div> <span> ' . $r["name"] . ' </span> ......... <span>' . $r["phone"] . ' </span> </div>';
        }
      $res = mysqli_query($conn, " UPDATE contactInfo SET phone='57986321' WHERE name='Rana'")
      or die (mysqli_connect_error);

      $res = mysqli_query($conn, " UPDATE contactInfo SET phone='56489712' WHERE name='Reem'")
      or die (mysqli_connect_error);
        ?>

    </div>
</body>
</html>