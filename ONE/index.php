
<!DOCTYPE html>
<html>
<head>
    <!-- Start of Disable Cache Statement -->
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <meta http-equiv="Expires" content="0"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <!--  End of Disable Cache Statement  -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <header id="header">
        <h3 id="sessiontext"><?php 
            session_start(); 

            if( isset( $_SESSION['UID'])){
                $sessionUserId = "Hello ".$_SESSION['UID'];  
                echo( $sessionUserId ); 
            }
            
        ?></h3>
        <button id="logoutbtn" <?php 
            if( isset( $_SESSION['UID'])){
                echo("style='display:visible;'");
            }else{
                echo("style='display:none;'");
            }
        ?>>
        </button>
    </header>
    <div id="loginsubbody">
        <form id="loginform">
            <input type="text" id="idboxform" class="textfield" placeholder="User Email"/><br>
            <input type="password" id="pwboxform" class="textfield" placeholder="Password"/>
            <button id="loginbtn" class="userbutton">Log In</button>
            <button id="regbtn" class="userbutton">Register</button>
        </form>
    </div>
    <div id="regsubbody">
        <form id="registerform">
            <input type="text" id="regidform" class="textfield" placeholder="New Your ID"/><br>
            <input type="password" id="regpwform" class="textfield" placeholder="New Password"/><br>
            <input type="text" id="regmailform" class="textfield" placeholder="E-Mail"/>
            <!-- For Using Placeholder on Date, Switching Text and Data when mouse overed or not -->
            <input type="text" id="birthdayform" class="textfield" placeholder="Your BirthDay" onmouseover="(this.type='date')" onmouseleave="(this.type='text')">
            <!-- User Gender Select Form -->
            <fieldset class="groupbox">
                <legend>Gender</legend> 
                <input type="radio" name="gender" value="Boy"/>Boy
                <input type="radio" name="gender" value="Girl"/>Girl
            </fieldset>
            <button id="regformbtn" class="userbutton">Register</button>
            <button id="cancelformbtn" class="userbutton">Cancel</button>
        </form> 
    </div>
</body>
</html>