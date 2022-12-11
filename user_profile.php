<?php require_once('header.php'); ?>

<!-- User Profile -->
<div id="user-profile" class="tab-pane fade in active">
    <div class="header">
        <h4>User profile</h4>
    </div>
    <div class="content">
    <div class="container">
    <?php
        $userID = (int) trim($_SESSION['UserID']);
        $user = getUserById($userID);
    ?>
      <div class="main-body">
            <div class="row gutters-sm">
              <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                      <img src="images/neutral_user_icon.png" alt="<?php echo $user['Username']; ?>" class="rounded-circle" width="125">
                      <div class="mt-3">
                        <h4><?php echo $user['Username']; ?></h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Username</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                      <?php echo $user['Username']; ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                      <?php echo $user['EmailAddress']; ?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Type</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                      <?php echo $user['UserType']; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>

<?php require_once('footer.html'); ?>