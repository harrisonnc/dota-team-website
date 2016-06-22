<?php

				$conn = oci_connect('harrisonnc', 'V00427658', 'localhost:20037/xe');
				if (!$conn) {
					$m = oci_error();
					echo $m['message'], "\n";
					exit;
				}
				
				$teamname=$_POST['updateteamname'];
				$region=$_POST['updateregion'];
				
				$sql = "UPDATE teams SET team_region= '".$region."' WHERE team_name='".$teamname."'";
				
				//oci_bind_by_name($compiled, ':names', $teamname);
				//oci_bind_by_name($compiled, ':regions', $region);
				
				
				$stmt = oci_parse($conn, $sql);
				oci_execute($stmt);
				oci_commit($conn);
				
				
				header('Location: edittables.php');
				
				oci_close($conn);

?>