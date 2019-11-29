<?php

include('add_party.php');


function buildCustomerTable(){
    $create = mysqli_query(
        "CREATE TABLE IF NOT EXISTS customers(
            customer_name VARCHAR(30) NOT NULL,
            party_size TINYINT NOT NULL,
            phone_number VARCHAR(10) NOT NULL,
            seating_choice ENUM('W','D','B') DEFAULT 'B',
            date date;
            time time;
            customer_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY"
        );

    return mysqli_query($dbc, $create);
}


?>