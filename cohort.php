<?php require_once('header.php'); ?>

<!-- Dashboard -->
<div id="cohort" class="tab-pane fade in active">
    <div class="header">
        <h4>Cohort</h4>
    </div>
    <div class="content" id="cohortlistcontent" style="margin-top:20px;">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCohortModal">
            Add cohort
        </button>

        <div class="container" style="margin-top:20px;background-color:white;width:100%;">
            <div class="row">
                <div class="col-xl-12 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="cohortListTable" class="table table-hover mb-0">
                                    <thead>
                                    <tr class="align-self-center">
                                        <th style="text-align: center;"><b>#</b></th>
                                        <th><b>Cohort Name</b></th>
                                        <th><b>Action</b></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $cohorts = getAllCohorts();

                                    if($cohorts) {
                                        foreach ($cohorts as $key => $cohort) {
                                            ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $key +1; ?></td>
                                                <td><?php echo $cohort["CohortName"]; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary editCohortBtn" value="<?php echo $cohort['CohortID']; ?>"><i class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger deleteCohortBtn" value="<?php echo $cohort['CohortID']; ?>" ><i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tr>

                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <p class="alert alert-warning">No cohort found."</p>
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

<!-- Add cohort Modal -->
<div class="modal" id="addCohortModal" tabindex="-1" role="dialog" aria-labelledby="addCohortModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="addCohortModalTitle">Add cohort</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="saveCohortForm">
                <div class="modal-body">
                    <div class="alert alert-warning hide" id="addCohortErrors"></div>
                    <div class="form-group">
                        <label for="cohortName">Cohort Name</label>
                        <input type="text" class="form-control" name="cohortName" id="cohortName" placeholder="Cohort Name" required>
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

<!-- Edit cohort Modal -->
<div class="modal" id="editCohortModal" tabindex="-1" role="dialog" aria-labelledby="editCohortModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="editCohortModalTitle">Edit cohort</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editCohortForm">
                <div class="modal-body">
                    <div class="alert alert-warning hide" id="editCohortErrors"></div>
                    <input type="hidden" class="form-control" name="cohortUid" id="cohortUid">
                    <div class="form-group">
                        <label for="cName">Cohort Name</label>
                        <input type="text" class="form-control" name="cName" id="cName" placeholder="Cohort Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update cohort</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete cohort Modal -->
<div class="modal" id="deleteCohortModal" tabindex="-1" role="dialog" aria-labelledby="deleteCohortModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="deleteCohortModalTitle">Delete cohort</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Are you sure to delete this cohort ?</p>
                <p class="alert alert-warning hide" id="deleteCohortErrors"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="deleteCohortBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Register cohort
    $(document).on('submit', '#saveCohortForm', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("registerCohort", true);

        $.ajax({
            type: 'POST',
            url: 'functions.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = $.parseJSON(response);
                if (res.status === 406) {
                    $('#addCohortErrors').removeClass('hide').text(res.message);
                }

                if (res.status === 200) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    $('#addCohortErrors').addClass('hide');
                    $('#addCohortModal').modal('hide');
                    $('#saveCohortForm')[0].reset();
                    $('#cohortListTable').load(location.href + " #cohortListTable");
                }
            }
        });
    });

    // Edit cohort
    $(document).on('click', '.editCohortBtn', function () {
        var cohortId = $(this).val();

        $.ajax({
            type: "GET",
            url: 'functions.php?cohortId=' + cohortId,
            success: function (response) {
                var res = $.parseJSON(response);

                if (res.status === 406) {
                    alert(res.message);
                }

                if (res.status === 200) {
                    $('#cohortUid').val(res.cohort.CohortID);
                    $('#cName').val(res.cohort.CohortName);
                    $('#editCohortModal').modal('show');
                }
            }
        });
    });

    // Update cohort
    $(document).on('submit', '#editCohortForm', function (e) {
        e.preventDefault();

        var updateFormData = new FormData(this);
        updateFormData.append("updateCohort", true);

        $.ajax({
            type: 'POST',
            url: 'functions.php',
            data: updateFormData,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = $.parseJSON(response);
                if (res.status === 406) {
                    $('#editCohortErrors').removeClass('hide').text(res.message);
                }

                if (res.status === 200) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    $('#editCohortErrors').addClass('hide');
                    $('#editCohortModal').modal('hide');
                    $('#editCohortForm')[0].reset();
                    $('#cohortListTable').load(location.href + " #cohortListTable");
                }
            }
        });
    });

    // Confirm delete cohort
    $(document).on('click', '.deleteCohortBtn', function (e) {
        e.preventDefault();

        var cohortId = $(this).val();
        $('#deleteCohortBtn').attr('data-id', cohortId);
        $('#deleteCohortModal').modal('show');
    });

    // Delete cohort
    $(document).on('click', '#deleteCohortBtn', function (e) {
        e.preventDefault();

        var cohortId = $(this).attr('data-id');
        var type = 'cohort';

        $.ajax({
            type: 'POST',
            url: 'functions.php',
            data: {
                'del': true,
                'id': cohortId,
                'type': type
            },
            success: function(response) {
                var res = $.parseJSON(response);

                if (res.status === 406) {
                    $('#deleteCohortErrors').removeClass('hide').text(res.message);
                }

                if (res.status === 200) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    $('#deleteCohortErrors').addClass('hide');
                    $('#deleteCohortModal').modal('hide');
                    $('#cohortListTable').load(location.href + " #cohortListTable");
                }
            }
        });
    });
</script>

<?php require_once('footer.html'); ?>