<?php
   include($_SERVER['DOCUMENT_ROOT'].'/FlashCard/Config.php');
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = md5(mysqli_real_escape_string($db,$_POST['password'])); 
      
      $sql = "SELECT * FROM USER WHERE EMAIL = '$myusername' and PASSWORD = '$mypassword'";
      
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['NAME'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        // session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
   </head>
   
   <body >
	<div class="container">

	<div class="Welcome">
	<div class="login-body">
    <article class="container-login center-block">
		<section>
			<ul id="top-bar" class="nav nav-tabs nav-justified">
				<li class="active"><a href="#login-access">Login</a></li>
				<li><a href="register.php">Register</a></li>
			</ul>
			<div class="tab-content tabs-login col-lg-12 col-md-12 col-sm-12 cols-xs-12">
				<div id="login-access" class="tab-pane fade active in">
					<img src="http://eliecervera.com/FlashCard/img/logo.png">					
					<form method="post" action="" accept-charset="utf-8" autocomplete="off" role="form" class="form-horizontal">
						<div class="form-group ">
							<label for="login" class="sr-only">Email</label>
								<input type="text" class="form-control" name="username" id="login_value" 
									placeholder="Email" tabindex="1" value="" />
						</div>
						<div class="form-group ">
							<label for="password" class="sr-only">Password</label>
								<input type="password" class="form-control" name="password" id="password"
									placeholder="Password" value="" tabindex="2" />
						</div>
						<div class="checkbox">
						</div>
						<br/>
						<div class="form-group ">				
								<button type="submit" name="log-me-in" id="submit" tabindex="5" class="btn btn-lg btn-primary">Entra</button>
						</div>
					</form>			
				</div>
			</div>
		</section>
	</article>
</div>
      <!--<div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
                  <td><a href="register.php">Sign In Here</a></td>
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>-->
     </div>
    </div>
    <!-- Scripts -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
   </body>
</html>