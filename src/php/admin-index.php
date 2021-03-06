<?php
   session_start();

   // receive form
   if((isset($_POST['aid'])) && ($_POST['aid'] != "")) 
   	$aid = $_POST['aid'];
   else 
   	$aid = "";

   if((isset($_POST['pswd'])) && ($_POST['pswd'] != "")) 
   	$pswd = $_POST['pswd'];
   else 
   	$pswd = "";
   
?>

<!DOCTYPE HTML>

<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="colorlib">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>LUNAR</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
		
		<!-- CSS -->
		<link rel="stylesheet" href="css/linearicons.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/magnific-popup.css">
		<link rel="stylesheet" href="css/jquery-ui.css">				
		<link rel="stylesheet" href="css/nice-select.css">							
		<link rel="stylesheet" href="css/animate.min.css">
		<link rel="stylesheet" href="css/owl.carousel.css">				
		<link rel="stylesheet" href="css/main.css">
	</head>

	<body>	
	  	<header id="header">
	    	<div class="container main-menu">
	    		<div class="row align-items-center justify-content-between d-flex">
		      	
			      	<div id="logo">
				      	<a href="index.html"><img src="img/logo_stacked_hori.jpg" alt="" title="" /></a>
				    </div>
				      
				    <nav id="nav-menu-container">
				        <ul class="nav-menu">
				          	<li><a href="index.html">Home</a></li>
				          	<li class="menu-has-children"><a href="">Add</a>
						        <ul>
						            <li><a href="admin-add-student.php">Student</a></li>
						            <li><a href="admin-add-professor.php">Professor</a></li>
						          	<li><a href="admin-add-course.php">Course</a></li>
						        </ul>
				      		</li>
				          	<li class="menu-has-children"><a href="">Edit</a>
					            <ul>
					              	<li><a href="admin-edit-course.php">Course</a></li>
					              	<li><a href="admin-edit-student.php">Student</a></li>
					            </ul>
				          	</li>
	                    	<li><a href="admin-record.php">Record</a></li>
				        </ul>
				    </nav><!-- #nav-menu-container -->		    		
		    	
		    	</div>
		    </div>
		</header><!-- #header -->

		<!-- start banner Area -->
		<section class="about-banner">
			<div class="container">				
				<div class="row d-flex align-items-center justify-content-center">
					<div class="about-content col-lg-12">
						<h1 class="text-white"> ADMIN LOGIN	</h1>	
					</div>	
				</div>
			</div>
		</section>
		<!-- End banner Area -->
            
    	<!-- start login area -->
      	<div class="banner-content-text">
         	<div class="wrapper">
            	<form method="post" action="admin-index.php">
	            	<label for='aid' class='psloginlabel'> ID#</label>
	    			<input id="aid" name="aid" type="text" class="pslogineditbox" value="<?php echo $aid; ?>" size="12" tabindex="1" required>
                    
	    			<label for='password' class='psloginlabel'>Password</label>
	    			<input type="password" id="password" name="pswd" class="pslogineditbox" size="12" tabindex="2" required>
                    
    				<input name="Submit" type="submit" class="psloginbutton" tabindex="3" value="Log In">

               		<div class="hide-test password-help">
                  	<a href="https://adam.cc.sunysb.edu/solarpwd.html">Account & Password Help</a>
               		</div>
            	</form>

		        <div class="container">
		         	<?php
						//@ini_set('memory_limit', '512M');
						$host = 'localhost';
						$user = 'lunar';
						$pw = 'lunar';
						$dbName = 'lunar';
						$mysqli = new mysqli($host, $user, $pw, $dbName);

						if ($mysqli->connect_error) die($mysqli->connect_error);

						$sql = "SELECT * FROM AdminAccounts WHERE aid = '$aid' AND pswd = '$pswd'";
						//echo "<h1>id $aid, password $pswd</h1>";

						$result = $mysqli->query($sql);
						$row = mysqli_fetch_array($result);
				        $numrows = $result->num_rows;

						if ($numrows == 0 ) {
						    //echo "<h1>Login failed!</h1>";
						    //echo "<p>Try again.</p>";
						}
						else {
						    // Create a user session
						   $_SESSION['login'] = true;
						   $_SESSION['aid'] = $aid;
						    
						    // Then direct to the welcome page
						   header("Location: admin-welcome.php");
						}
					?>

		        </div>
        	</div>
    	</div>
      	<!-- end login area -->

      	<!-- start footer Area -->
      	<footer class="footer-area section-gap">
         	<div class="container">
            	<div class="row">
               		<div class="col-lg-5 col-md-6 col-sm-6">
                  		<div class="single-footer-widget">
                     		<h4>About Us</h4>
                     		<p>
	                        CSE305 Final Project <br><br>
	                        HanBin Baik - hanbin.baik@stonybrook.edu <br>
	                        Hanna Jung - hanna.jung@stonybrook.edu <br>
	                        Hyejun Jeong - hye-jun.jeong@stonybrook.edu <br>
	                     	</p>                                
                  		</div>
               		</div>
            	</div>
         	</div>
      	</footer>
      	<!-- End footer Area -->		

		<script src="js/vendor/jquery-2.2.4.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/vendor/bootstrap.min.js"></script>			
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>			
  		<script src="js/easing.min.js"></script>			
		<script src="js/hoverIntent.js"></script>
		<script src="js/superfish.min.js"></script>	
		<script src="js/jquery.ajaxchimp.min.js"></script>
		<script src="js/jquery.magnific-popup.min.js"></script>	
    	<script src="js/jquery.tabs.min.js"></script>						
		<script src="js/jquery.nice-select.min.js"></script>	
      	<script src="js/isotope.pkgd.min.js"></script>			
		<script src="js/waypoints.min.js"></script>
		<script src="js/jquery.counterup.min.js"></script>
		<script src="js/simple-skillbar.js"></script>							
		<script src="js/owl.carousel.min.js"></script>							
		<script src="js/mail-script.js"></script>	
		<script src="js/main.js"></script>	
	</body>
</html>
