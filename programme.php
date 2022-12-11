<?php require_once('header.php'); ?>

<!-- Dashboard -->
<div id="programme" class="tab-pane fade in active">
    <div class="header">
        <h4>Programme</h4>
    </div>
    <div class="content" id="programmelistcontent" style="margin-top:20px;">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProgrammeModal">
            Add Programme
        </button>

        <div class="container" style="margin-top:20px;background-color:white;width:100%;">
            <div class="row">
                <div class="col-xl-12 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="programmeListTable" class="table table-hover mb-0">
                                    <thead>
                                    <tr class="align-self-center">
                                        <th style="text-align: center;"><b>#</b></th>
                                        <th><b>Programme Name</b></th>
                                        <th><b>Programme Department</b></th>
                                        <th><b>Programme Duration</b></th>
                                        <th><b>Action</b></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $programmes = getAllProgrammes();

                                    if($programmes) {
                                        foreach ($programmes as $key => $programme) {
                                            ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $key +1; ?></td>
                                                <td><?php echo $programme["ProgrammeName"]; ?></td>
                                                <td><?php echo $programme["ProgrammeDepartment"]; ?></td>
                                                <td><?php echo $programme["ProgrammeDuration"]; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary editProgrammeBtn" value="<?php echo $programme['ProgrammeID']; ?>"><i class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger deleteProgrammeBtn" value="<?php echo $programme['ProgrammeID']; ?>" ><i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tr>

                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <p class="alert alert-warning">No Programme found."</p>
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

<!-- Add Programme Modal -->
<div class="modal" id="addProgrammeModal" tabindex="-1" role="dialog" aria-labelledby="addProgrammeModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="addProgrammeModalTitle">Add Programme</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="saveProgrammeForm">
                <div class="modal-body">
                    <div class="alert alert-warning hide" id="addProgrammeErrors"></div>
                    <div class="form-group">
                        <label for="programmeName">Programme Name</label>
                        <input type="text" class="form-control" name="programmeName" id="programmeName" placeholder="Programme Name" required>
                    </div>
                    <div class="form-group">
                        <label for="programmeDepartment">Programme Department</label>
                        <input type="text" class="form-control" name="programmeDepartment" id="programmeDepartment" placeholder="Programme Department" required>
                    </div>
                    <div class="form-group">
                        <label for="programmeDuration">Programme Duration</label>
                        <input type="text" class="form-control" name="programmeDuration" id="programmeDuration" placeholder="Programme Duration" required>
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

<!-- Edit Programme Modal -->
<div class="modal" id="editProgrammeModal" tabindex="-1" role="dialog" aria-labelledby="editProgrammeModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="editProgrammeModalTitle">Edit Programme</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editProgrammeForm">
                <div class="modal-body">
                    <div class="alert alert-warning hide" id="editProgrammeErrors"></div>
                    <input type="hidden" class="form-control" name="programmeUid" id="programmeUid">
                    <div class="form-group">
                        <label for="pName">Programme Name</label>
                        <input type="text" class="form-control" name="pName" id="pName" placeholder="Programme Name" required>
                    </div>
                    <div class="form-group">
                        <label for="pDepartment">Programme Department</label>
                        <input type="text" class="form-control" name="pDepartment" id="pDepartment" placeholder="Programme Department" required>
                    </div>
                    <div class="form-group">
                        <label for="pDuration">Programme Duration</label>
                        <input type="text" class="form-control" name="pDuration" id="pDuration" placeholder="Programme Duration" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update Programme</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Programme Modal -->
<div class="modal" id="deleteProgrammeModal" tabindex="-1" role="dialog" aria-labelledby="deleteProgrammeModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="deleteProgrammeModalTitle">Delete Programme</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Are you sure to delete this Programme ?</p>
                <p class="alert alert-warning hide" id="deleteProgrammeErrors"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="deleteProgrammeBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Register Programme
    $(document).on('submit', '#saveProgrammeForm', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("registerProgramme", true);

        $.ajax({
            type: 'POST',
            url: 'functions.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = $.parseJSON(response);
                if (res.status === 406) {
                    $('#addProgrammeErrors').removeClass('hide').text(res.message);
                }

                if (res.status === 200) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    $('#addProgrammeErrors').addClass('hide');
                    $('#saveProgrammeForm')[0].reset();
                    $('#addProgrammeModal').modal('hide');
                    $('#programmeListTable').load(location.href + " #programmeListTable");
                }
            }
        });
    });

    // Edit Programme
    $(document).on('click', '.editProgrammeBtn', function () {
        var programmeId = $(this).val();

        $.ajax({
            type: "GET",
            url: 'functions.php?programmeId=' + programmeId,
            success: function (response) {
                var res = $.parseJSON(response);

                if (res.status === 406) {
                    alert(res.message);
                }

                if (res.status === 200) {
                    $('#programmeUid').val(res.programme.ProgrammeID);
                    $('#pName').val(res.programme.ProgrammeName);
                    $('#pDepartment').val(res.programme.ProgrammeDepartment);
                    $('#pDuration').val(res.programme.ProgrammeDuration);
                    $('#editProgrammeModal').modal('show');
                }
            }
        });
    });

    // Update Programme
    $(document).on('submit', '#editProgrammeForm', function (e) {
        e.preventDefault();

        var updateFormData = new FormData(this);
        updateFormData.append("updateProgramme", true);

        $.ajax({
            type: 'POST',
            url: 'functions.php',
            data: updateFormData,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = $.parseJSON(response);
                if (res.status === 406) {
                    $('#editProgrammeErrors').removeClass('hide').text(res.message);
                }

                if (res.status === 200) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    $('#editProgrammeErrors').addClass('hide');
                    $('#editProgrammeModal').modal('hide');
                    $('#editProgrammeForm')[0].reset();
                    $('#programmeListTable').load(location.href + " #programmeListTable");
                }
            }
        });
    });

    // Confirm delete Programme
    $(document).on('click', '.deleteProgrammeBtn', function (e) {
        e.preventDefault();

        var programmeId = $(this).val();
        $('#deleteProgrammeBtn').attr('data-id', programmeId);
        $('#deleteProgrammeModal').modal('show');
    });

    // Delete Programme
    $(document).on('click', '#deleteProgrammeBtn', function (e) {
        e.preventDefault();

        var programmeId = $(this).attr('data-id');
        var type = 'programme';

        $.ajax({
            type: 'POST',
            url: 'functions.php',
            data: {
                'del': true,
                'id': programmeId,
                'type': type
            },
            success: function(response) {
                var res = $.parseJSON(response);

                if (res.status === 406) {
                    $('#deleteProgrammeErrors').removeClass('hide').text(res.message);
                }

                if (res.status === 200) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    $('#deleteProgrammeErrors').addClass('hide');
                    $('#deleteProgrammeModal').modal('hide');
                    $('#programmeListTable').load(location.href + " #programmeListTable");
                }
            }
        });
    });
</script>

<?php require_once('footer.html'); ?>