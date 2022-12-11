<?php include('functions.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/SAlogin.css">
    <link rel="icon" type="image/x-icon" href="images/logo.jpg">
</head>
<body>
    <div class="session">
    <div class="left">
            <div style="margin: 25px 25px 25px 25px; ">            
                <a href="optionspage.php"><i class="fa fa-arrow-circle-left" style="font-size:48px;color:rgb(255, 255, 255)"></i></a>
            </div>            
        </div>
        <form method="post" action="SAlogin.php" class="log-in" autocomplete="off">
            <h4>STUDENT <span>AFFAIRS</span></h4>        
            <p>Welcome back! Enter your email and password to continue:</p>
            <?php echo display_error(); ?>
            <div class="floating-label">
                <input placeholder="Email" type="email" name="email" id="email" autocomplete="off">
                <label for="email">Email:</label>
            </div>
            <div class="floating-label">
                <input placeholder="Password" type="password" name="password" id="password" autocomplete="off">
                <label for="password">Password:</label>
            </div>
            <button type="submit" name="SAlogin_btn">Login</button>
        </form>
    </div>
</body>
</html>