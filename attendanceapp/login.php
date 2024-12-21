<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/loader.css">
    <title>LoginPage</title>
</head>
<body>
    <div class="background">
        <div class="scrolling_text">
            Welcome to NACOS UNN Attendance Management System. Login to track your students' attendance!
        </div>
    </div>
    <div class="loginform">
        <div class="login_header">
        <img src="nacos.png" class="logo">
        <div class="text_wrapper">
        <h1>Welcome Back!</h1>
        <p><button>NACOS UNN Attendance Portal</button></p>
        </div>
        </div>
        
        <div class="welcome">
        

        </div>
       
        <div class="inputgroup">
            <input type="text" id="txtUsername" required>
            <label for="txtusername" id="lblUsername">Username</label>
        </div>

        <div class="inputgroup topmarginlarge">
            <input type="password" id="txtPassword" required>
            <label for="txtpassword" id="lblPassword">Password</label>
        </div>

        <div class="divcallforaction topmarginlarge">
            <button class="btnlogin inactivecolor" id="btnLogin">Login</button>
        </div>

        <div class="diverror" id="diverror">
            <label class="errormessage" id="errormessage">ERROR GOES HERE</label>
        </div>
    </div>
    <div class="lockscreen" id="lockscreen">
     <div class="spinner" id="spinner"></div>
    <label class="lblwait topmargin" id="lblwait">Verifying. Please Wait...</label>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/login.js"></script>
</body>
</html>