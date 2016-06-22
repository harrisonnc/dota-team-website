<?php
session_start(); // must go right at the top of the page - to track login

$conn = oci_connect('harrisonnc', 'V00427658', 'localhost:20037/xe');
if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

$logins = array('vcuadmin' => 'vcupassword'); // your username and password
if(isset($_POST['Submit'])) { // check for form submit
    $user = $_POST['user']; 
    $pass = $_POST['pass']; 
    if (isset($logins[$user]) && ($logins[$user] == $pass)) { // check login and compare credentials
        $_SESSION['username'] = $user; // set the session
        header('Location: edittables.php'); // redirect to protected page
        } 
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
            <form name="loginform" method="post" action="index.php">
Username :<input type="text" name="user" />
Password :<input type="text" name="pass" />
<input type="submit" name="Submit" value="Submit" />
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
         <div class="container">
    <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#teamhome">Teams</a></li>
    <li><a data-toggle="tab" href="#teammenu1">Teams by Name</a></li>
    <li><a data-toggle="tab" href="#teammenu2">Teams by Region</a></li>       
	</ul>	
		
	<div class="tab-content">	
    <div id="teamhome" class="tab-pane fade in active">
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

<div id="teammenu1" class="tab-pane fade">
		<?php
// Prepare the statement
$stid = oci_parse($conn, 'SELECT * FROM teams ORDER BY team_name ASC');
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

<div id="teammenu2" class="tab-pane fade">
		<?php
// Prepare the statement
$stid = oci_parse($conn, 'SELECT * FROM teams ORDER BY team_region ASC');
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
           
		<div class="container">
    <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Players</a></li>
    <li><a data-toggle="tab" href="#menu1">Players by Name</a></li>
    <li><a data-toggle="tab" href="#menu2">Players by Team</a></li>
    <li><a data-toggle="tab" href="#menu3">Players by Country</a></li>
	<li><a data-toggle="tab" href="#menu4">Players by Role</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
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
    <div id="menu1" class="tab-pane fade">
		<?php
// Prepare the statement
$stid = oci_parse($conn, 'SELECT * FROM players ORDER BY player_name ASC');
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
    <div id="menu2" class="tab-pane fade">


		<?php




// Prepare the statement
$stid = oci_parse($conn, 'SELECT * FROM players ORDER BY team_name ASC');
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
    <div id="menu3" class="tab-pane fade">
      
	  <?php

// Prepare the statement
$stid = oci_parse($conn, 'SELECT * FROM players ORDER BY player_country ASC');
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
	<div id="menu4" class="tab-pane fade">
    
	
	
	<?php

// Prepare the statement
$stid = oci_parse($conn, 'SELECT * FROM players ORDER BY player_role ASC');
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


