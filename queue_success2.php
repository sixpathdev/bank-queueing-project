<!DOCTYPE html>
<html>

<head>
    <title>BankQUEUE - Check In Successful </title>
    <link rel="stylesheet" href="style.css" />
    <script src="main.js"></script>
</head>

<body>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once('sys.php');
    include("controls.php");

    $customer_name;
    $party_size;
    $phone_number;
    $seating_choice;

    if (isset($_POST['submit'])) {
        $customer_name = $_POST['customer_name'];
        $party_size = $_POST['party_size'];
        $phone_number = $_POST['phone_number'];
        $seating_choice = 'B';

        $query = "INSERT INTO customers (customer_name, party_size, phone_number, seating_choice, date, time) VALUES (?, ?, ?, ?, now(), now())";
        $stmt = $dbc->prepare($query);

        $stmt->bind_param(
            'ssss',
            $customer_name,
            $party_size,
            $phone_number,
            $seating_choice
        );
        if ($stmt->execute()) {
            $sql2 = "SELECT * FROM customers WHERE customer_name='$customer_name'";
            $result = mysqli_query($dbc, $sql2);
            $row = mysqli_fetch_assoc($result);
            // die(var_dump($row));
            echo strtoupper("<h1>Welcome " . $row['customer_name'] . "</h1>");
            echo ("Thank you. <br>");

            echo ("Your estimated waiting time is ");
            // echo calculateEstimatedWaitTime($dbc);
            echo " minutes. <br>";
            $get_id = $row['customer_id'];
            echo ("Your queue number is: $get_id <br>");
            // echo $return_id['customer_id'];

        } else {
            die("not inserted");
        }
    } else {
        die('Error');
    }
    ?>
    
    <input type="submit" name="return" onclick="changePage('index.php')" value="Return" />

</body>

<footer>
    <div class="copyright">
        Copyright. All Rights Reserved by Chika
    </div>
</footer>

</html>