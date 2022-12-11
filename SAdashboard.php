<?php
require_once('header.php');

$details = getReportDetails();

?>

    <div id="report" class="tab-pane fade in active">
        <div class="header">
            <h4>Dashboard</h4>
        </div>
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

<?php require_once('footer.html'); ?>