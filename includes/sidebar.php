<?php

include('includes/dbconnection.php');
?>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-userpic">
              <?php  
                $uid=$_SESSION['detsuid'];
                $query = "CALL simage('$uid')";  
                $result = mysqli_query($con, $query);  
                while($row = mysqli_fetch_array($result))  
                {    
                           
                    echo '<img src="images/'.$row['Images'].'" alt="" /> ';    
                }  
                mysqli_next_result($con);
                ?> 
            </div>
            <div class="profile-usertitle">
                <?php
                    $uid=$_SESSION['detsuid'];
                    $ret=mysqli_query($con,"CALL sfullname('$uid')");
                    $row=mysqli_fetch_array($ret);
                    $name=$row['FullName'];
                    mysqli_next_result($con);
                ?>

                <div class="profile-usertitle-name"><?php echo $name; ?></div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>
        
        <ul class="nav menu">
            <li><a href="dashboard.php"><em class="fas fa-columns">&nbsp;</em> Dashboard</a></li>
            
            
           
            <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-navicon">&nbsp;</em><i class="fas fa-money-bill-wave"></i> Transactions <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-1">
                    <li><a class="" href="add-expense.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Add Expenses
                    </a></li>
                    <li><a class="" href="add-income.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Add Income
                    </a></li>
                    <li><a class="" href="manage-expense.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Manage Expenses
                    </a></li>
                    
                </ul>

            </li>
           
            <li class="parent "><a data-toggle="collapse" href="#sub-item-2">
                <em class="fa fa-navicon">&nbsp;</em><i class="fas fa-book"></i> Expense Report <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-2">
                    <li><a class="" href="expense-datewise-reports.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Daywise Expenses
                    </a></li>
                    <li><a class="" href="expense-monthwise-reports.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Monthwise Expenses
                    </a></li>
                    <li><a class="" href="expense-yearwise-reports.php">
                        <span class="fa fa-arrow-right">&nbsp;</span> Yearwise Expenses
                    </a></li>
                    
                </ul>
            </li>
      




            <li><a href="add-fix.php"><em class="fab fa-autoprefixer">&nbsp;</em> Add Fix Transaction</a></li>
            <li><a href="Overview.php"><em class="fas fa-chart-pie">&nbsp;</em> Overview</a></li>
            <li><a href="user-profile.php"><em class="fa fa-user">&nbsp;</em> Profile</a></li>
             <li><a href="change-password.php"><em class="fa fa-clone">&nbsp;</em> Change Password</a></li>
<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>

        </ul>
    </div>



