<?php
    require_once('header.php');

    if (!isAdmin()) {
        header('location: SAdashboard.php');
    }

    $details = getReportDetails();
?>

    <!-- Dashboard -->
    <div id="analytics" class="tab-pane fade in active">
        <div class="header">
            <h4>Dashboard</h4>
        </div>
        <div class="content">
            <div class="row total-stats">
                <div class="col-sm-3">
                    <div class="stats-card">
                        <span class="orange-chart">
                            <i class="fa fa-users fa-lg"></i>
                        </span>
                        <h3>STAFFS<br>
                            <small><?php echo $details['totalStaffs'];?></small>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="stats-card">
                        <span class="purple-chart">
                            <i class="fa fa-tags fa-lg"></i>
                        </span>
                        <h3>COHORTS<br>
                            <small><?php echo $details['totalCohorts'];?></small>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="stats-card">
                        <span class="red-chart">
                            <i class="fa fa-table fa-lg"></i>
                        </span>
                        <h3>PROGRAMMES<br>
                            <small><?php echo $details['totalProgrammes'];?></small>
                        </h3>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="stats-card">
                        <span class="green-chart">
                            <i class="fa fa-graduation-cap fa-lg"></i>
                        </span>
                        <h3>STUDENTS<br>
                            <small><?php echo $details['totalStudents'];?></small>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="income-customers">
                        <div class="table-responsive">
                            <h4>Last 3 staffs registered<small class="pull-right"><a href="staffs_list.php">View All</a></small>
                            </h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Username</td>
                                        <td>Email</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach (getAllStaffs() as $key => $staff) {
                                    if ($key >= 3) {
                                        continue;
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $staff['Username'];?></td>
                                        <td><?php echo $staff['EmailAddress'];?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="income-customers">
                        <div class="table-responsive">
                            <h4>Last 3 students registered<small class="pull-right"><a href="student_list.php">View All</a></small>
                            </h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Fullname</td>
                                        <td>DOB</td>
                                        <td>Gender</td>
                                        <td>Phone</td>
                                        <td>Email</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach (getAllStudents() as $key => $student) {
                                    if ($key >= 3) {
                                        continue;
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $student['SFullName'];?></td>
                                        <td><?php echo $student['DOB'];?></td>
                                        <td><?php echo $student['SGender'];?></td>
                                        <td><?php echo $student['SPhoneNumber'];?></td>
                                        <td><?php echo $student['SEmailAddress'];?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="report">
            <div class="content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-3">
                            <h3><small>TOTAL STUDENTS</small>
                                <span class="pull-right"><i class="fa fa-graduation-cap fa-2x"></i></span>
                                <br><?php echo $details['totalStudents'];?>
                            </h3>
                            <hr>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-3">
                            <h3><small>TOTAL MALE STUDENTS</small>
                                <span class="pull-right"><i class="fa fa-male fa-2x"></i></span>
                                <br><?php echo $details['totalMaleStudents'];?>
                            </h3>
                            <hr>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-3">
                            <h3><small>TOTAL FEMALE STUDENTS</small>
                                <span class="pull-right"><i class="fa fa-female fa-2x"></i></span>
                                <br><?php echo $details['totalFemaleStudents'];?>
                            </h3>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="responsive-table">
                        <h3>STUDENTS FOR <?php echo $details['totalCohorts'];?> COHORTS</h3>
                        <?php
                        if ($details['studentsByCohort']) {
                            ?>

                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>Cohort ID</th>
                                    <th>Cohort Name</th>
                                    <th>Total Students</th>
                                    <th>Total Male Students</th>
                                    <th>Total Female Students</th>
                                </tr>
                                <?php
                                foreach ($details['studentsByCohort'] as $cohortDetails) {
                                    echo '<tr>';

                                    foreach ($cohortDetails as $data) {
                                        $value = !is_null($data) ? $data : 0;
                                        echo "<td>$value</td>";
                                    }

                                    echo '</tr>';
                                }
                                ?>
                                </tbody>
                            </table>

                            <?php

                        } else {
                            echo 'No records found';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('footer.html'); ?>