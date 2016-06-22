<?php

				$conn = oci_connect('harrisonnc', 'V00427658', 'localhost:20037/xe');
				if (!$conn) {
					$m = oci_error();
					echo $m['message'], "\n";
					exit;
				}
				
				$teamname=$_POST['user'];
				$region=$_POST['user2'];
				
				$sql = "INSERT INTO teams (team_name, TEAM_REGION) VALUES ('".$teamname."', '".$region."')";
				
				//oci_bind_by_name($compiled, ':names', $teamname);
				//oci_bind_by_name($compiled, ':regions', $region);
				
				
				$stmt = oci_parse($conn, $sql);
				oci_execute($stmt);
				oci_commit($conn);
				
				
				header('Location: edittables.php');
				
				oci_close($conn);

?>