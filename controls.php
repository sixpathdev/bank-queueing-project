<?php

include "sys.php";

function calculateEstimatedWaitTime($dbc){
    $customers_result = query($dbc, "SELECT COUNT(customer_name) as total FROM customers");
    $tables_result = query($dbc, "SELECT COUNT(table_num) as total FROM tables WHERE available='Y'");
    $customers_total = mysqli_fetch_assoc($customers_result);
    $tables_total = mysqli_fetch_assoc($customers_result);

    if($customers_total['total'] == 0 || $customers_total['total'] < $tables_total['total']){
        return 0;
    }
    
    return ($customers_total['total'] * 5) - ($tables_total['total'] * 5);
}

function executeSortRequest($table, $request){    
    if($request == null || empty($request)){
        return "Select * FROM $table";
    }

    $statement = "SELECT * FROM $table ORDER BY ";
    
    for($i = 0; $i < count($request); ++$i){
           $statement .= $request[$i] . " " . $request[++$i];
           if($i >= 1 && $i < count($request) - 1){
               $statement .= ", ";
           }
    }
    return $statement;
}

function query($dbc, $string){
    return mysqli_query($dbc, $string);
}

function populateCustomerOptions($dbc){
    $response = query($dbc, "SELECT * FROM customers");
    while($row = mysqli_fetch_assoc($response)){
        echo '<option value="' . $row['customer_name'] . '">' . $row['customer_name'] . ' #' . $row['customer_id'] . '</option>';
    }
}

function populateStaffOptions($dbc){
    $response = query($dbc, "SELECT * FROM staff");
    while($row = mysqli_fetch_assoc($response)){
        echo '<option value="' . $row['first_name'] . '">' . $row['first_name'] . '</option>';
    }
}

function populateAvailableTableOptions($dbc){
    $response = query($dbc, "SELECT * FROM tables WHERE available='Y'");
    while($row = mysqli_fetch_assoc($response)){
        echo '<option value="' . $row['table_num'] . '">#' . $row['table_num'] . ' for ' . $row['table_size'] . ' people </option>';
    }
}

function populateUnassignedTableOptions($dbc){
    $response = query($dbc, "SELECT * FROM tables WHERE assigned_server=null");
    while($row = mysqli_fetch_assoc($response)){
        echo '<option value="' . $row['table_num'] . '">#' . $row['table_num'] . '</option>';
    }
}

function getTableSize($dbc, $table){
    $sql = "SELECT Count(*) FROM $table";
    if ($result = mysqli_query($dbc,$sql)){
        return mysqli_num_rows($result);
    }
}

function printQueueTable($dbc, $query){
    $response = query($dbc, $query);
    while($row = mysqli_fetch_assoc($response)){
        echo "<tr>";
        echo "<td>" . $row['customer_id'] . "</td>";
        echo "<td>" . $row['customer_name'] . "</td>";
        echo "<td>" . $row['party_size'] . "</td>";
        echo "<td>" . $row['phone_number'] . "</td>";
        echo "<td>" . $row['seating_choice'] . "</td>";
        echo "<td>" . $row['time'] . "</td>";
        echo "</tr>";
    }
}

function printTablesTable($dbc, $query){
    $response = query($dbc, $query);
    while($row = mysqli_fetch_assoc($response)){
        echo "<tr>";
        echo "<td>" . $row['table_num'] . "</td>";
        echo "<td>" . $row['table_size'] . "</td>";
        echo "<td>" . $row['available'] . "</td>";
        echo "<td>" . $row['assigned_server'] . "</td>";
        echo "<td>" . $row['reserved'] . "</td>";
        echo "</tr>";
    }
}

function printStaffTable($dbc, $query){
    $response = mysqli_query($dbc, $query);
    while($row = mysqli_fetch_assoc($response)){
        echo "<tr>";
        echo "<td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row['staff_id'] . "</td>";
        echo "<td>" . $row['job_id'] . "</td>";
        echo "<td>" . $row['on_shift'] . "</td>";
        echo "</tr>";
    }
}

function assignTable($dbc, $table_num){
    query($dbc, "UPDATE tables SET available='N' WHERE table_num='$table_num'");
}

function removeCustomer($dbc, $name){
    query($dbc, "DELETE FROM customers WHERE customer_name='$name'");
}

function clearQueue($dbc){
    query($dbc, "truncate customers");
}


?>