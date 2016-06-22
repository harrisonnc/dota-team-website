<?php

				$conn = oci_connect('harrisonnc', 'V00427658', 'localhost:20037/xe');
				if (!$conn) {
					$m = oci_error();
					echo $m['message'], "\n";
					exit;
				}
				
				$teamname=$_POST['deleteteam'];
				
				
				$sql2 ="DELETE FROM PLAYERS WHERE TEAM_NAME='".$teamname."'";
				$sql = "DELETE FROM TEAMS WHERE TEAM_NAME='".$teamname."'";
				
				
				//oci_bind_by_name($compiled, ':names', $teamname);
				//oci_bind_by_name($compiled, ':regions', $region);
				
				$stmt2 = oci_parse($conn, $sql2);
				$stmt = oci_parse($conn, $sql);
				oci_execute($stmt2);
				oci_execute($stmt);
				oci_commit($conn);
				
				
				header('Location: edittables.php');
				
				oci_close($conn);

?>