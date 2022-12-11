<?php

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: optionspage.php');
}

$dashboardLink = 'SAdashboard.php';
$logoutLink = 'logout.php';

if (isAdmin()) {
    $dashboardLink = 'admindashboard.php';
    $logoutLink = 'adminlogout.php';
}

?>

<div class="left">
    <ul>
        <li class="menu-heading"><img src="images/Dashboard_logo.png" alt="Dashboard_logo" width="120" height="50"></li>
        <li class="active"><a href="<?php echo $dashboardLink;?>"><i class="fa fa-home fa-lg"></i> Dashboard</a></li>

        <?php
            if (isAdmin()) {
        ?>
            <li><a href="staffs_list.php"><i class="fa fa-users fa-lg"></i> Staffs</a></li>
        <?php
            }
        ?>
        <li><a href="student_list.php"><i class="fa fa-graduation-cap fa-lg"></i> Student</a></li>
        <li><a href="programme.php"><i class="fa fa-table fa-lg"></i> Programme</a></li>
        <li><a href="cohort.php"><i class="fa fa-tags fa-lg"></i> Cohort</a></li>
        <li><a href="user_profile.php"><i class="fa fa-user fa-lg"></i> User Profile</a></li>
        <li><a  href="<?php echo $logoutLink;?>"><i class="fa fa-sign-out fa-lg"></i> Log Out</a></li>
    </ul>
</div>