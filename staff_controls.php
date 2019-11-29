<?php
header("Refresh: 40");
    session_start();
    include "controls.php";
    include "sys.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>BankQUEUE - Admin Controls</title>
    <link rel="stylesheet" href="style.css"/>
    
</head>
<body>
    <div id="container">
        <h2>Bankqueue Admin Controls</h2>
        <hr/>
        <div id="nav_container">
            <ul id="admin_nav_menu">
                <li><a href=""><span>Home</span></a></li>
                <li><a href="admin_controls.php"><span>Show Queue</span></a></li>
                <li><a href="table_controls.php"><span>Show Tables</span></a></li>
                <li><a href="staff_controls.php" class="active"><span>Staff</span></a></li>
                <li><a action="onClickForRestartDat()"><span>Restart Day</span></a></li>
                <li><a href="index.php"><span>Log Out</span></a></li>
            </ul>
        </div> <!-- end of nav container -->
        <div id="workspace_container">
            <div id="input_container">
                <p class="controls_title"> Staff Controls </p>
                <div id="actions_container">
                    <div id="actions_menu_container">
                        <ul id="actions_menu">
                            <li> <button id="assign_customer" class="action"> </button> </li>
                        </ul>
                    </div> <!-- end of actions menu container -->
                    <div id="options_container">
                        <!--
                        <div id="assign_container">
                            <div id="assign_inputs_container">
                            <form method="post" action="">
                                    <label class="script_small"> Assign Customer </label>
                                    <select name="customers_assign" class="options">
                                        <option value=""></option>
                                    </select>
                                    <label class="script_small"> to Table </label>
                                    <select name="table_assign" class="options">
                                    </select>
                                </div>
                            <input type="submit" class="options" value="Assign"/>
                            </form> 
                        </div> --> <!-- end of customers assign container -->

                        <!--
                        <div id="remove_container">
                            <form method="post" name="remove_customer" action="admin_controls.php">
                            <label class="script_small"> Remove Customer from Queue</label>
                            <label class="script_smaller"> for failure to show, cancellation, or etc. </label>
                                <select name="remove_selection" class="options">
                                    <option value=""></option>
                                </select>
                            <input type="submit" class="options" value="Remove"/>
                            </form>
                        </div> --> <!-- end of customers remove container -->

                        <!-- <div id="alter_container">
                            <form method="post" action="admin_controls.php">
                            <label class="script_small"> Alter Customer Information </label>
                                <select name="customers_assign" class="options">
                                    <option value=""></option>
                                </select> 
                                <input type="radio" name="seating_preference" value='T' class="options"/>
                                Table
                                <input type="radio" name="seating_preference" value='B' class="options"/>
                                Bar 
                                <input type="radio" name="seating_preference" value='E' class="options"/>
                                Either
                            <input type="submit" class="options" value="Alter"/>
                            </form>
                        </div> <!-- end of customers alter container -->
                    </div> <!-- end of options container --> 
                    <div id="actions_sort_container">
                        <label class="script"> Sort By </label>
                        <form method="post" action="staff_controls.php">
                        <label id="sort_type"> First Name </label>
                        <select name="sort_first_name" class="actions_sort">
                            <option value="" ></option>
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                        <label id="sort_type"> Last Name </label>
                        <select name="sort_last_name" class="actions_sort">
                            <option value=""></option>
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                        <label id="sort_type"> On Shift </label>
                        <select name="sort_on_shift" class="actions_sort">
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
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Staff Id</th>
                            <th>Job Id</th>
                            <th>On Shift</th>
                        </tr>
                    </div>
                <div id="display_content_container">

            <?php
                require_once('sys.php');

                $sortRequestStack = array();

                if(isset($_POST['sort_customer_name']) && $_POST['sort_customer_name'] != ""){
                    array_push($sortRequestStack, 'customer_name', $_POST['sort_customer_name']);
                } 

                if(isset($_POST['sort_party_size']) && $_POST['sort_party_size'] != ""){
                    array_push($sortRequestStack, 'party_size', $_POST['sort_party_size']);
                } 

                if(isset($_POST['sort_customer_id']) && $_POST['sort_customer_id'] != ""){
                    array_push($sortRequestStack, 'customer_id', $_POST['sort_customer_id']);
                
                } 

                if(isset($_POST['remove_selection'])){
                }
            
                if(isset($_GET['action'])){
                    if($_GET['action'] == "clear_queue"){
                        clearQueue($dbc);
                   
                    }
                }

                if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
                    clearQueue($dbc);
                }

                printStaffTable($dbc, executeSortRequest('staff', $sortRequestStack));

            ?>
            </table>
                </div>
            </div> <!-- end of display container -->
        </div> <!-- end of workspace container --> 

</div>

    <script src="main.js"></script>
    </body>

</html>