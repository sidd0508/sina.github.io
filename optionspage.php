<html>
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="style/optionspage.css">
    <link rel="icon" type="image/x-icon" href="images/logo.jpg">
    </head>
    <body>
        <section class="forms-section" style="margin-top: 125px">
            <div class="forms">            
              <div class="form-wrapper is-active">              
                <form class="form form-login switcher switcher-login" action="SAlogin.php" method="get">                  
                    <img src="images/Student_Affairs.png" alt="student_affairs" width="400" height="375">
                  <button type="submit" class="btn-login">Access</button>
                  <a href="index.php"><i class="fa fa-arrow-circle-left" style="font-size:48px;color:#53baee"></i></a>
				        </form>
            </div>
              <div class="form-wrapper">
                <form class="form form-signup switcher switcher-signup" action="adminlogin.php" method="get"> 
                    <img src="images/admin.png" alt="admin" width="400" height="375">
                  <button type="submit" class="btn-signup">Access</button>
                  <a href="index.php"><i class="fa fa-arrow-circle-left" style="font-size:48px;color:#53baee"></i></a>                
                </form>
              </div>
            </div>
          </section>
    </body>
    <script>
        const switchers = [...document.querySelectorAll('.switcher')]

        switchers.forEach(item => {
            item.addEventListener('click', function() {
                switchers.forEach(item => item.parentElement.classList.remove('is-active'))
                this.parentElement.classList.add('is-active')
            })
        })
    </script>
</html>


