

<?php

session_start(); // must go right at the top of the page - to track login

$conn = oci_connect('harrisonnc', 'V00427658', 'localhost:20037/xe');
if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

if ($_SESSION['username']) { // check that session 
    if (isset($_POST['Logout'])) { // check for form submit
        session_destroy(); // destroy the session to logout
        header('Location: index.php'); // redirect back to login page
    }
?>

<!-- START - put all your content to be protected here -->



<!-- END - put all your content to be protected here -->

<?php
} else {
    echo "Access Denied";
    header('Location: index.php'); // redirect back to login page
}
?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dota-Base</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/1-col-portfolio.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Dota-Base</a>
            </div>
            
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
       
     

        <div class="row">
        <form name="logout" method="post" action="edittables.php">
		<input type="Submit" name="Logout" value="Logout" />
		</form>
        

        <div class="col-lg-12">
                <h1 class="page-header"> Teams
                    <small>These are the current teams attending the DOTA 2 Manila Major</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        
        
        
        <!-- Project One -->
        <div class="row">
       
        
        <!-- Modal for Add Team-->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Team</button>
        <div id="myModal" class="modal fade" role="dialog">
          
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Team</h4>
					
              </div>
              <div class="modal-body">
                <form method="post" action="addteam.php">
				Team Name :<input type="text" name="user" />
                
                <?php

				$stid = oci_parse($conn, 'SELECT team_location FROM teamregion');

				oci_execute($stid);
				echo "Select Region<select class='form-control' name='user2'>\n ";

				while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
					
					echo "<option value='".$row['TEAM_LOCATION']."'>" . $row['TEAM_LOCATION'] . "</option>";
				}

				oci_free_statement($stid);

				echo "</select>\n";


				?>
             
              </div>
              <div class="modal-footer">
                <button type="submit" value="Submit" class="btn btn-default" >Save Changes</button>
              </div>
            </form>
			</div>

          </div>
       
        </div>
        
      
	  
	  
	  
	  
	  
	  
	  
	  
	  <!-- Modal for Alter Team-->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#updateteam">Update Team</button>
        <div id="updateteam" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Team</h4>
              
              </div>
              <div class="modal-body">
              <form method="post" action="updateteam.php">         
                <?php

				$stid = oci_parse($conn, 'SELECT team_name FROM teams');

				oci_execute($stid);
				echo "Select Team<select class='form-control' name='updateteamname'>\n ";

				while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
					
					echo "<option value='".$row['TEAM_NAME']."'>" . $row['TEAM_NAME'] . "</option>";
				}

				oci_free_statement($stid);

				echo "</select>\n";


				$stid = oci_parse($conn, 'SELECT team_location FROM teamregion');

				oci_execute($stid);
				echo "Select Region<select class='form-control' name='updateregion'>\n ";

				while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
					
					echo "<option value='".$row['TEAM_LOCATION']."'>" . $row['TEAM_LOCATION'] . "</option>";
				}

				oci_free_statement($stid);

				echo "</select>\n";
				
							
				?>
             
              </div>
              <div class="modal-footer">
                <button type="submit" value="Submit" class="btn btn-default" >Save Changes</button>
              </div>
            </form>
			</div>

          </div>
        </form>
        </div>
	  
	  
	  
	  
	  
	  
	  <!-- Modal for Delete Team-->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalteam">Delete Team</button>
        <div id="myModalteam" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Team</h4>
              
              </div>
              <div class="modal-body">
              <form method="post" action="deleteteam.php">         
                <?php

				$stid = oci_parse($conn, 'SELECT team_name FROM teams');

				oci_execute($stid);
				echo "Select Team<select class='form-control' name='deleteteam'>\n ";

				while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
					
					echo "<option value='".$row['TEAM_NAME']."'>" . $row['TEAM_NAME'] . "</option>";
				}

				oci_free_statement($stid);

				echo "</select>\n";


				?>
             
              </div>
              <div class="modal-footer">
                <button type="submit" value="Submit" class="btn btn-default" >Save Changes</button>
              </div>
            </form>
			</div>

          </div>
        </form>
        </div>
        
 
     
	  
	  
	  
	  
	  <?php

	  	  
// Prepare the statement
$stid = oci_parse($conn, 'SELECT * FROM teams');
if (!$stid) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r = oci_execute($stid);
if (!$r) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


// Fetch the results of the query
print "<table class='table' border='1'>\n";
$ncols = oci_num_fields($stid);
echo "<tr>\n";
for ($i = 1; $i <= $ncols; ++$i) {
    $colname = oci_field_name($stid, $i);
    echo "  <th><b>" . htmlentities($colname, ENT_QUOTES) . "</b></th>\n";
}
echo "</tr>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    print "<tr>\n";
    foreach ($row as $item) {
        print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    print "</tr>\n";
}
print "</table>\n";

oci_free_statement($stid);

?>





</div>

 

        <!-- /.row -->

        <hr>

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Players
                    <small>Players participating in the Manila Major</small>
                </h1>
            </div>
        </div>
        <!-- Project Two -->
        <div class="row">
           
        
        
        <!-- Modal for Add Player-->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModaladdplayer">Add Player</button>
        <div id="myModaladdplayer" class="modal fade" role="dialog">
          <form name="addplayer" method="post" action="addplayer.php">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Player</h4>
              
              </div>
              <div class="modal-body">
                Player Tag :<input type="text" name="user" >
                Player Name :<input type="text" name="user2" >
                
                <?php

				$stid = oci_parse($conn, 'SELECT team_name FROM teams');

				oci_execute($stid);
				echo "Select Team<select class='form-control' name='user3'>\n ";

				while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
					
					echo "<option value='".$row['TEAM_NAME']."'>" . $row['TEAM_NAME'] . "</option>";
					var_dump($row);
				}

				oci_free_statement($stid);
				echo "</select>\n";

				$stid = oci_parse($conn, 'SELECT player_nationality FROM nationality');

				oci_execute($stid);
				echo "Select Nationality<select class='form-control' name='user4'>\n ";

				while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
					
					echo "<option value='".$row['PLAYER_NATIONALITY']."'>" . $row['PLAYER_NATIONALITY'] . "</option>";
					var_dump($row);
				}

				oci_free_statement($stid);
				echo "</select>\n";


				$stid = oci_parse($conn, 'SELECT player_role FROM playerrole');

				oci_execute($stid);
				echo "Select Role<select class='form-control' name='user5'>\n ";

				while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
					
					echo "<option value='".$row['PLAYER_ROLE']."'>" . $row['PLAYER_ROLE'] . "</option>";
					var_dump($row);
				}

				oci_free_statement($stid);
				echo "</select>\n";


				?>
             
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-default" >Save Changes</button>
              </div>
            </div>

          </div>
        </form>
        </div>
        
		
		
		<!-- Modal for Update Player-->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalupdateplayer">Update Player</button>
        <div id="myModalupdateplayer" class="modal fade" role="dialog">
          <form name="updateplayer" method="post" action="updateplayer.php">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Player</h4>
              
              </div>
              <div class="modal-body">
                
				   <?php

				$stid = oci_parse($conn, 'SELECT PLAYER_TAG FROM PLAYERS');

				oci_execute($stid);
				echo "Select Player<select class='form-control' name='user'>\n ";

				while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
					
					echo "<option value='".$row['PLAYER_TAG']."'>" . $row['PLAYER_TAG'] . "</option>";
					var_dump($row);
				}

				oci_free_statement($stid);
				echo "</select>\n";

				?>
				
				Player Name :<input type="text" name="user2" >
                
                <?php

				$stid = oci_parse($conn, 'SELECT team_name FROM teams');

				oci_execute($stid);
				echo "Select Team<select class='form-control' name='user3'>\n ";

				while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
					
					echo "<option value='".$row['TEAM_NAME']."'>" . $row['TEAM_NAME'] . "</option>";
					var_dump($row);
				}

				oci_free_statement($stid);
				echo "</select>\n";

				$stid = oci_parse($conn, 'SELECT player_nationality FROM nationality');

				oci_execute($stid);
				echo "Select Nationality<select class='form-control' name='user4'>\n ";

				while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
					
					echo "<option value='".$row['PLAYER_NATIONALITY']."'>" . $row['PLAYER_NATIONALITY'] . "</option>";
					var_dump($row);
				}

				oci_free_statement($stid);
				echo "</select>\n";


				$stid = oci_parse($conn, 'SELECT player_role FROM playerrole');

				oci_execute($stid);
				echo "Select Role<select class='form-control' name='user5'>\n ";

				while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
					
					echo "<option value='".$row['PLAYER_ROLE']."'>" . $row['PLAYER_ROLE'] . "</option>";
					var_dump($row);
				}

				oci_free_statement($stid);
				echo "</select>\n";


				?>
             
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-default" >Save Changes</button>
              </div>
            </div>

          </div>
        </form>
        </div>
		
		
		
		<!-- Modal for Delete Player-->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModaldeleteplayer">Delete Player</button>
        <div id="myModaldeleteplayer" class="modal fade" role="dialog">
          <form name="deleteplayer" method="post" action="deleteplayer.php">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Player</h4>
              
              </div>
              <div class="modal-body">
                
				<?php

				$stid = oci_parse($conn, 'SELECT PLAYER_TAG FROM PLAYERS');

				oci_execute($stid);
				echo "Select Player<select class='form-control' name='user'>\n ";

				while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
					
					echo "<option value='".$row['PLAYER_TAG']."'>" . $row['PLAYER_TAG'] . "</option>";
					var_dump($row);
				}

				oci_free_statement($stid);
				echo "</select>\n";

				?>
				
				             
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-default" >Save Changes</button>
              </div>
            </div>

          </div>
        </form>
        </div>
		
		
		
        
        
        <div class="container">
    

    
      <?php
// Prepare the statement
$stid = oci_parse($conn, 'SELECT * FROM players');
if (!$stid) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r = oci_execute($stid);
if (!$r) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}




// Fetch the results of the query
print "<table class='table' border='1'>\n";
$ncols = oci_num_fields($stid);
echo "<tr>\n";
for ($i = 1; $i <= $ncols; ++$i) {
    $colname = oci_field_name($stid, $i);
    echo "  <th><b>" . htmlentities($colname, ENT_QUOTES) . "</b></th>\n";
}
echo "</tr>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    print "<tr>\n";
    foreach ($row as $item) {
        print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    print "</tr>\n";
}
print "</table>\n";

oci_free_statement($stid);


?>
     
      
      
    

    
    </div>
</div>

        <!-- /.row -->

        <hr>

        

        <hr>



        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Dota-Base 2016</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
