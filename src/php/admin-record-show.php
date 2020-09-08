<?php
// Initialize the session
    session_start();
    if((isset($_POST['sid'])) && ($_POST['sid'] != "")) 
        $sid = $_POST['sid'];
    else 
        $sid = "";

?>

<!DOCTYPE html>
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
		<title>LUNAR: Student Record</title>

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
						<h1 class="text-white">
							STUDENT RECORD				
						</h1>	
					</div>	
				</div>
			</div>
		</section>
		<!-- End banner Area -->	
            
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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

                $sql = "SELECT Cl.semester, Cr.subject, Cr.crs, 
                                Cr.title, Cl.credits, Ct.grade  
                        FROM Courses Cr, Classes Cl, Takes T, Record R,
                            Contains Ct
                        WHERE Cr.cid=Cl.cid AND T.sid=$sid
                                AND R.rid=Ct.rid AND Ct.classid=Cl.classid;";


                $result = $mysqli->query($sql);
                $row = mysqli_fetch_array($result);

                $numrows = $result->num_rows;

                if($numrows != 0) {
                    echo "<table class='table table-sm'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th scope='col'>SEMESTER</th>";
                                echo "<th scope='col'>SUB</th>";
                                echo "<th scope='col'>NUM</th>";
                                echo "<th scope='col'>TITLE</th>";
                                echo "<th scope='col'>CREDIT</th>";
                                echo "<th scope='col'>GRADE</th>";
                            echo "</tr>";
                        echo "</thead>";
                }

                if($numrows > 0) {
                    echo "<tbody>";
                    $counter = 1;
                    $sumcredit = 0;
                    $sumgp=0;
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                                    $semester = $row['semester'];
                                    $subject = $row['subject'];
                                    $crs = $row['crs'];
                                    $title = $row['title'];
                                    $credits = $row['credits'];
                                    $grade = $row['grade'];
                    switch ($grade) {
                        case 'A':
                            $sumgp+=4*$credits;
                            break;
                        case 'A-':
                            $sumgp+=3.67*$credits;
                            break;
                        case 'B+':
                            $sumgp+=3.33*$credits;
                            break;
                        case 'B':
                            $sumgp+=3*$credits;
                            break;
                        case 'B-':
                            $sumgp+=2.67*$credits;
                            break;
                        case 'C+':
                            $sumgp+=2.33*$credits;
                            break;
                        case 'C-':
                            $sumgp+=1.67*$credits;
                            break;
                        case 'D+':
                            $sumgp+=1.33*$credits;
                            break;
                        case 'D':
                            $sumgp+=1*$credits;
                            break;
                        case 'F':
                            $sumgp+=0*$credits;
                            break;
                    }

                            echo "<td>";
                                echo $semester;
                            echo "</td>";
                            echo "<td>";
                                echo $subject;
                            echo "</td>";
                            echo "<td>";
                                echo $crs;
                            echo "</td>";
                            echo "<td>";
                                echo $title;
                            echo "</td>";
                            echo "<td>";
                                echo $credits;
                            echo "</td>";
                            echo "<td>";
                                echo $grade;
                            echo "</td>";
                        echo "</tr>";
                        $sumcredit = $sumcredit + $credits;
                        $counter++;
                    }
                }
                echo "</tbody>";
                echo "</table>";
            $mysqli->close();
            ?>
        </div>
        
        <table class="table table-borderless-small">
            <tbody>
                <tr>
                    <td>CREDIT EARNED</td>
                    <td><?php echo $sumcredit; ?></td>
                </tr>
                <tr>
                    <td>GPA</td>
                    <td><?php echo $sumgp/$sumcredit; ?></td>
                </tr>

        </table>
        <br><br>

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