<?php

require_once('header.php');

if (!isAdmin()) {
    header('location: SAdashboard.php');
}
?>

<!-- Dashboard -->
<div id="staff" class="tab-pane fade in active">
    <div class="header">
        <h4>Staff</h4>
    </div>
    <div class="content" id="stafflistcontent" style="margin-top:20px;">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStaffModal">
            Add Staff
        </button>

        <div class="container" style="margin-top:20px;background-color:white;width:100%;">
            <div class="row">
                <div class="col-xl-12 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="staffListTable" class="table table-hover mb-0">
                                    <thead>
                                    <tr class="align-self-center">
                                        <th style="text-align: center;"><b>#</b></th>
                                        <th><b>Username</b></th>
                                        <th><b>Email</b></th>
                                        <th><b>User type</b></th>
                                        <th><b>Action</b></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $staffs = getAllStaffs('ASC');

                                    if($staffs) {
                                        foreach ($staffs as $key => $staff) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $key +1; ?></td>
                                        <td><?php echo $staff["Username"]; ?></td>
                                        <td><?php echo $staff["EmailAddress"]; ?></td>
                                        <td><?php echo $staff["UserType"]; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary editStaffBtn" value="<?php echo $staff['UserID']; ?>"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger deleteStaffBtn" value="<?php echo $staff['UserID']; ?>" ><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>

                                    <?php
                                        }
                                    } else {
                                    ?>
                                    <p class="alert alert-warning">No staff found."</p>
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

<!-- Add Staff Modal -->
<div class="modal" id="addStaffModal" tabindex="-1" role="dialog" aria-labelledby="addStaffModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="addStaffModalTitle">Add Staff</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="saveStaffForm">
                <div class="modal-body">
                    <div class="alert alert-warning hide" id="addStaffErrors"></div>
                    <div class="form-group">
                        <label for="susername">Username</label>
                        <input type="text" class="form-control" name="susername" id="susername" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="semailaddress">Email address</label>
                        <input type="email" class="form-control" name="semailaddress" id="semailaddress" placeholder="name@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="spassword">Password</label>
                        <input type="password" class="form-control" name="spassword" id="spassword" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="susertype">User Type</label>
                        <select class="form-control" name="susertype" id="susertype" required>
                            <option selected value="staff">Staff</option>
                            <option value="admin">Admin</option>
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

<!-- Edit Staff Modal -->
<div class="modal" id="editStaffModal" tabindex="-1" role="dialog" aria-labelledby="editStaffModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="editStaffModalTitle">Edit Staff</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editStaffForm">
                <div class="modal-body">
                    <div class="alert alert-warning hide" id="editStaffErrors"></div>
                    <input type="hidden" class="form-control" name="staffUid" id="staffUid">
                    <div class="form-group">
                        <label for="staffUname">Username</label>
                        <input type="text" class="form-control" name="staffUname" id="staffUname" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="staffEmail">Email address</label>
                        <input type="email" class="form-control" name="staffEmail" id="staffEmail" placeholder="name@example.com">
                    </div>
                    <div class="form-group">
                        <label for="staffPassword">Password</label>
                        <input type="password" class="form-control" name="staffPassword" id="staffPassword" placeholder="Leave empty to use same password">
                    </div>
                    <div class="form-group">
                        <label for="staffUsertype">User Type</label>
                        <select class="form-control" name="staffUsertype" id="staffUsertype">
                            <option selected value="staff">Staff</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update staff</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Staff Modal -->
<div class="modal" id="deleteStaffModal" tabindex="-1" role="dialog" aria-labelledby="deleteStaffModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="deleteStaffModalTitle">Delete Staff</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Are you sure to delete this staff ?</p>
                <p class="alert alert-warning hide" id="deleteStaffErrors"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="deleteStaffBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Register staff
    $(document).on('submit', '#saveStaffForm', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("registerStaff", true);

        $.ajax({
            type: 'POST',
            url: 'functions.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = $.parseJSON(response);
                if (res.status === 406) {
                    $('#addStaffErrors').removeClass('hide').text(res.message);
                }

                if (res.status === 200) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    $('#addStaffErrors').addClass('hide');
                    $('#addStaffModal').modal('hide');
                    $('#saveStaffForm')[0].reset();
                    $('#staffListTable').load(location.href + " #staffListTable");
                }
            }
        });
    });

    // Edit staff
    $(document).on('click', '.editStaffBtn', function () {
        var staffId = $(this).val();

        $.ajax({
            type: "GET",
            url: 'functions.php?staffId=' + staffId,
            success: function (response) {
                var res = $.parseJSON(response);

                if (res.status === 406) {
                    alert(res.message);
                }

                if (res.status === 200) {
                    $('#staffUid').val(res.user.UserID);
                    $('#staffUname').val(res.user.Username);
                    $('#staffEmail').val(res.user.EmailAddress);
                    $('#staffUsertype').val(res.user.UserType);
                    $('#editStaffModal').modal('show');
                }
            }
        });
    });

    // Update staff
    $(document).on('submit', '#editStaffForm', function (e) {
        e.preventDefault();

        var updateFormData = new FormData(this);
        updateFormData.append("updateStaff", true);

        $.ajax({
            type: 'POST',
            url: 'functions.php',
            data: updateFormData,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = $.parseJSON(response);
                if (res.status === 406) {
                    $('#editStaffErrors').removeClass('hide').text(res.message);
                }

                if (res.status === 200) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    $('#editStaffErrors').addClass('hide');
                    $('#editStaffModal').modal('hide');
                    $('#editStaffForm')[0].reset();
                    $('#staffListTable').load(location.href + " #staffListTable");
                }
            }
        });
    });

    // Confirm delete staff
    $(document).on('click', '.deleteStaffBtn', function (e) {
        e.preventDefault();

        var staffId = $(this).val();
        var type = 'staff';

        $('#deleteStaffBtn').attr('data-id', staffId);
        $('#deleteStaffModal').modal('show');
    });

    // Delete staff
    $(document).on('click', '#deleteStaffBtn', function (e) {
        e.preventDefault();

        var staffId = $(this).attr('data-id');
        var type = 'staff';

        $.ajax({
            type: 'POST',
            url: 'functions.php',
            data: {
                'del': true,
                'id': staffId,
                'type': type
            },
            success: function(response) {
                var res = $.parseJSON(response);

                if (res.status === 406) {
                    $('#deleteStaffErrors').removeClass('hide').text(res.message);
                }

                if (res.status === 200) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    $('#deleteStaffErrors').addClass('hide');
                    $('#deleteStaffModal').modal('hide');
                    $('#staffListTable').load(location.href + " #staffListTable");
                }
            }
        });
    });
</script>

<?php require_once('footer.html'); ?>

