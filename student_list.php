<?php require_once('header.php'); ?>

<!-- Dashboard -->
<div id="student" class="tab-pane fade in active">
            <div class="header">
                <h4>Student</h4>
            </div>
            <div class="content" id="studentlistContent" style="margin-top:20px;">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">
                    Add student
                </button>

                <div class="container" style="margin-top:20px;background-color:white;width:100%;">
                    <div class="row">
                        <div class="col-xl-12 ">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="studentListTable" class="table table-hover mb-0">
                                            <thead>
                                                <tr class="align-self-center">
                                                    <th style="text-align: center;"><b>#</b></th>
                                                    <th><b>Full Name</b></th>
                                                    <th><b>Date of Birth</b></th>
                                                    <th><b>Gender</b></th>
                                                    <th><b>Address</b></th>
                                                    <th><b>Phone Number</b></th>
                                                    <th><b>Email Address</b></th>
                                                    <th><b>Cohort</b></th>
                                                    <th><b>Programme</b></th>
                                                    <th><b>Action</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $students = getAllStudents('ASC');

                                            if($students) {
                                                foreach ($students as $key => $student) {
                                                    ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $key +1; ?></td>
                                                        <td><?php echo $student["SFullName"]; ?></td>
                                                        <td><?php echo $student["DOB"]; ?></td>
                                                        <td><?php echo $student["SGender"]; ?></td>
                                                        <td><?php echo $student["SAddress"]; ?></td>
                                                        <td><?php echo $student["SPhoneNumber"]; ?></td>
                                                        <td><?php echo $student["SEmailAddress"]; ?></td>
                                                        <td class="cohort"><?php echo $student["CohortName"]; ?></td>
                                                        <td class="programme"><?php echo $student["ProgrammeName"]; ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary editStudentBtn" value="<?php echo $student['StudentID']; ?>"><i class="fa fa-edit"></i></button>
                                                            <button type="button" class="btn btn-danger deleteStudentBtn" value="<?php echo $student['StudentID']; ?>" ><i class="fa fa-trash-o"></i></button>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <p class="alert alert-warning">No student found."</p>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end table-responsive-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Add student Modal -->
<div class="modal" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="addStudentModalTitle">Add student</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="saveStudentForm">
                <div class="modal-body">
                    <div class="alert alert-warning hide" id="addStudentErrors"></div>
                    <div class="form-group">
                        <label for="studentFullname">Fullname</label>
                        <input type="text" class="form-control" name="studentFullname" id="studentFullname" placeholder="Full name" required>
                    </div>
                    <div class="form-group">
                        <label for="studentEmail">Email address</label>
                        <input type="email" class="form-control" name="studentEmail" id="studentEmail" placeholder="name@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="studentPhone">Phone number</label>
                        <input type="text" class="form-control" name="studentPhone" id="studentPhone" placeholder="Phone" required>
                    </div>
                    <div class="form-group">
                        <label for="studentDob">Date of birth</label>
                        <input type="date" class="form-control" name="studentDob" id="studentDob" placeholder="DOB" required>
                    </div>
                    <div class="form-group">
                        <label for="studentAddress">Address</label>
                        <input type="text" class="form-control" name="studentAddress" id="studentAddress" placeholder="Enter address" required>
                    </div>
                    <div class="form-group">
                        <label for="studentGender">Gender</label><br>
                        <input type="radio" name="studentGender" id="maleStudent" value="male">
                        <label for="maleStudent">Male</label>
                        <span>&nbsp &nbsp </span>
                        <input type="radio" name="studentGender" id="femaleStudent" value="female">
                        <label for="femaleStudent">Female</label><br>
                    </div>
                    <div class="form-group">
                        <label for="studentProgramme">Programme</label>
                        <select class="form-control" name="studentProgramme" id="studentProgramme">
                            <?php
                            $programmes = getAllProgrammes();
                            foreach ($programmes as $programme) {
                                ?>
                                <option value="<?php echo $programme['ProgrammeID'];?>"><?php echo $programme['ProgrammeName'];?></option>

                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="studentCohort">Cohort</label>
                        <select class="form-control" name="studentCohort" id="studentCohort">
                            <?php
                            $cohorts = getAllCohorts();

                            foreach ($cohorts as $cohort) {
                                ?>
                                <option value="<?php echo $cohort['CohortID']; ?>"><?php echo $cohort['CohortName']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit student Modal -->
<div class="modal" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="editStudentModalTitle">Edit student</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editStudentForm">
                <div class="modal-body">
                    <div class="alert alert-warning hide" id="editStudentErrors"></div>
                    <input type="hidden" class="form-control" name="sId" id="sId">
                    <div class="form-group">
                        <label for="sFullname">Fullname</label>
                        <input type="text" class="form-control" name="sFullname" id="sFullname" placeholder="Full name" required>
                    </div>
                    <div class="form-group">
                        <label for="sEmail">Email address</label>
                        <input type="email" class="form-control" name="sEmail" id="sEmail" placeholder="name@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="sPhone">Phone number</label>
                        <input type="text" class="form-control" name="sPhone" id="sPhone" placeholder="Phone" required>
                    </div>
                    <div class="form-group">
                        <label for="sDob">Date of birth</label>
                        <input type="date" class="form-control" name="sDob" id="sDob" placeholder="DOB" required>
                    </div>
                    <div class="form-group">
                        <label for="sAddress">Address</label>
                        <input type="text" class="form-control" name="sAddress" id="sAddress" placeholder="Enter address" required>
                    </div>
                    <div class="form-group">
                        <label for="sGender">Gender</label><br>
                        <input type="radio" name="sGender" id="sMale" value="male">
                        <label for="sMale">Male</label>
                        <span>&nbsp &nbsp </span>
                        <input type="radio" name="sGender" id="sFemale" value="female">
                        <label for="sFemale">Female</label><br>
                    </div>
                    <div class="form-group">
                        <label for="sProgramme">Programme</label>
                        <select class="form-control" name="sProgramme" id="sProgramme">
                            <?php
                            $programmes = getAllProgrammes();
                            foreach ($programmes as $programme) {
                                ?>
                                <option value="<?php echo $programme['ProgrammeID'];?>"><?php echo $programme['ProgrammeName'];?></option>

                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sCohort">Cohort</label>
                        <select class="form-control" name="sCohort" id="sCohort">
                            <?php
                            $cohorts = getAllCohorts();

                            foreach ($cohorts as $cohort) {
                                ?>
                                <option value="<?php echo $cohort['CohortID']; ?>"><?php echo $cohort['CohortName']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update student</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete student Modal -->
<div class="modal" id="deleteStudentModal" tabindex="-1" role="dialog" aria-labelledby="deleteStudentModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="deleteStudentModalTitle">Delete student</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Are you sure to delete this student ?</p>
                <p class="alert alert-warning hide" id="deleteStudentErrors"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="deleteStudentBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Register student
    $(document).on('submit', '#saveStudentForm', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("registerStudent", true);

        $.ajax({
            type: 'POST',
            url: 'functions.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = $.parseJSON(response);
                if (res.status === 406) {
                    $('#addStudentErrors').removeClass('hide').text(res.message);
                }

                if (res.status === 200) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    $('#addStudentErrors').addClass('hide');
                    $('#addStudentModal').modal('hide');
                    $('#saveStudentForm')[0].reset();
                    $('#studentListTable').load(location.href + " #studentListTable");
                }
            }
        });
    });

    // Edit student
    $(document).on('click', '.editStudentBtn', function () {
        var studentId = $(this).val();

        $.ajax({
            type: "GET",
            url: 'functions.php?studentId=' + studentId,
            success: function (response) {
                var res = $.parseJSON(response);

                if (res.status === 406) {
                    alert(res.message);
                }

                if (res.status === 200) {
                    $('#sId').val(res.student.StudentID);
                    $('#sFullname').val(res.student.SFullName);
                    $('#sEmail').val(res.student.SEmailAddress);
                    $('#sPhone').val(res.student.SPhoneNumber);
                    $('#sDob').val(res.student.DOB);
                    $('#sAddress').val(res.student.SAddress);
                    $('#sProgramme').val(res.student.ProgrammeId);
                    $('#sCohort').val(res.student.CohortId);

                    // Select gender
                    if (res.student.SGender === 'male') {
                        $('#sMale').attr('checked', true);
                        $('#sFemale').attr('checked', false);
                    } else {
                        $('#sMale').attr('checked', false);
                        $('#sFemale').attr('checked', true);
                    }

                    $('#editStudentModal').modal('show');
                }
            }
        });
    });

    // Update student
    $(document).on('submit', '#editStudentForm', function (e) {
        e.preventDefault();

        var updateFormData = new FormData(this);
        updateFormData.append("updateStudent", true);

        $.ajax({
            type: 'POST',
            url: 'functions.php',
            data: updateFormData,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = $.parseJSON(response);
                if (res.status === 406) {
                    $('#editStudentErrors').removeClass('hide').text(res.message);
                }

                if (res.status === 200) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    $('#editStudentErrors').addClass('hide');
                    $('#editStudentModal').modal('hide');
                    $('#editStudentForm')[0].reset();
                    $('#studentListTable').load(location.href + " #studentListTable");
                }
            }
        });
    });

    // Confirm delete student
    $(document).on('click', '.deleteStudentBtn', function (e) {
        e.preventDefault();

        var studentId = $(this).val();

        $('#deleteStudentBtn').attr('data-id', studentId);
        $('#deleteStudentModal').modal('show');
    });

    // Delete student
    $(document).on('click', '#deleteStudentBtn', function (e) {
        e.preventDefault();

        var studentId = $(this).attr('data-id');
        var type = 'student';

        $.ajax({
            type: 'POST',
            url: 'functions.php',
            data: {
                'del': true,
                'id': studentId,
                'type': type
            },
            success: function(response) {
                var res = $.parseJSON(response);

                if (res.status === 406) {
                    $('#deleteStudentErrors').removeClass('hide').text(res.message);
                }

                if (res.status === 200) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    $('#deleteStudentErrors').addClass('hide');
                    $('#deleteStudentModal').modal('hide');
                    $('#studentListTable').load(location.href + " #studentListTable");
                }
            }
        });
    });
</script>

<?php require_once('footer.html'); ?>