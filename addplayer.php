<?php

				$conn = oci_connect('harrisonnc', 'V00427658', 'localhost:20037/xe');
				if (!$conn) {
					$m = oci_error();
					echo $m['message'], "\n";
					exit;
				}
				
				$playertag=$_POST['user'];
				$playername=$_POST['user2'];
				$playerteam=$_POST['user3'];
				$playernationality=$_POST['user4'];
				$playerrole=$_POST['user5'];
				
				$sql = "INSERT INTO players (player_tag, player_name, team_name, player_country, player_role) VALUES ('".$playertag."', '".$playername."','".$playerteam."','".$playernationality."','".$playerrole."')";
				
				//oci_bind_by_name($compiled, ':names', $teamname);
				//oci_bind_by_name($compiled, ':regions', $region);
				
				
				$stmt = oci_parse($conn, $sql);
				oci_execute($stmt);
				oci_commit($conn);
				
				
				header('Location: edittables.php');
				
				oci_close($conn);

?>