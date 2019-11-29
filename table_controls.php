<?php
header("Refresh: 40");
    session_start();
    include "controls.php";
    include "sys.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>BankQUEUE - Table Controls</title>
    <link rel="stylesheet" href="style.css"/>
    
</head>
<body>
    <div id="container">
        <h2>Bankqueue Table Controls</h2>
        <hr/>
        <div id="nav_container">
            <ul id="admin_nav_menu">
                <li><a href=""><span>Home</span></a></li>
                <li><a href="admin_controls.php"><span>Show Queue</span></a></li>
                <li><a href="table_controls.php" class="active"><span>Show Tables</span></a></li>
                <li><a href="staff_controls.php"><span>Staff</span></a></li>
                <li><a action="onClickForRestartDay()"><span>Restart Day</span></a></li>
                <li><a href="index.php"><span>Log Out</span></a></li>
            </ul>
        </div> <!-- end of nav container -->
        <div id="workspace_container">
            <div id="input_container">
                <p class="controls_title"> Table Controls </p>
                <div id="actions_container">
                    <div id="actions_menu_container">
                        <ul id="actions_menu">
                            <li> <button id="assign_server" class="action"> Assign Server To Table </button> </li>
                            <li> <button id="free_table" class="action"> Free Table </button> </li> 
                            <li> <button id="reset_tables" class="action"> Reset Tables </button> </li>
                        </ul>
                    </div> <!-- end of actions menu container -->
                    <div id="options_container">
                        <div id="assign_container">
                            <div id="assign_inputs_container">
                            <form method="post" action="">
                                    <label class="script_small"> Assign Server </label>
                                    <select name="server_assign" class="options">
                                        <option value=""></option>
                                        <?php populateStaffOptions($dbc) ?>
                                    </select>
                                    <label class="script_small"> to Table </label>
                                    <select name="table_assign" class="options">
                                        <?php populateUnassignedTableOptions($dbc) ?>
                                    </select>
                                </div>
                            <input type="submit" class="options" value="Assign"/>
                            </form>
                        </div> <!-- end of customers assign container -->
                        <div id="remove_container">
                            <form method="post" name="remove_customer" action="table_controls.php">
                            <label class="script_small"> Remove Customer from Queue</label>
                            <label class="script_smaller"> for failure to show, cancellation, or etc. </label>
                                <select name="remove_selection" class="options">
                                    <option value=""></option>
                                    <?php populateCustomerOptions($dbc) ?>
                                </select>
                            <input type="submit" class="options" value="Remove"/>
                            </form>
                        </div> <!-- end of customers remove container -->
                        <div id="alter_container">
                           
                        </div> <!-- end of customers alter container -->
                    </div> <!-- end of options container --> 
                    <div id="actions_sort_container">
                        <label class="script"> Sort By </label>
                        <form method="post" action="table_controls.php">
                        <label id="sort_type"> Table Number </label>
                        <select name="sort_table_number" class="actions_sort">
                            <option value="" ></option>
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                        <label id="sort_type"> Seat Capacity </label>
                        <select name="sort_table_size" class="actions_sort">
                            <option value=""></option>
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                        <label id="sort_type"> Available </label>
                        <select name="sort_available" class="actions_sort">
                            <option value=""></option>
                            <option value="desc">Y first</option>
                            <option value="asc">N first</option>  
                        </select>
                        <input class="actions_sort" type="submit" value="Sort"/>
                        </form>
                    </div> <!-- end of actions container -->
            </div>  <!-- end of actions container -->    
            </div> <!-- end of input container -->
            <div id="display_container">
                <div id="display_header_container">
                    <table id="queue_table">
                        <tr>
                            <th>Table Number</th>
                            <th>Seat Capacity</th>
                            <th>Available</th>
                            <th>Assigned Server</th>
                            <th>Reserved</th>
                        </tr>
                    </div>
                <div id="display_content_container">

            <?php
                require_once('sys.php');

                $sortRequestStack = array();

                if(isset($_POST['sort_table_num']) && $_POST['sort_table_num'] != ""){
                    array_push($sortRequestStack, 'table_num', $_POST['sort_table_num']);
                } 

                if(isset($_POST['sort_table_size']) && $_POST['sort_table_size'] != ""){
                    array_push($sortRequestStack, 'table_size', $_POST['sort_table_size']);
                } 

                if(isset($_POST['sort_available']) && $_POST['sort_available'] != ""){
                    array_push($sortRequestStack, 'available', $_POST['sort_available']);
                
                } 

                printTablesTable($dbc, executeSortRequest('tables', $sortRequestStack));
            ?>
            </table>
                </div>
            </div> <!-- end of display container -->
        </div> <!-- end of workspace container --> 

    </div>

    <script src="main.js"></script>
    </body>
</html>