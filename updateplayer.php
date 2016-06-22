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
				
				$sql = "UPDATE players SET player_name= '".$playername."', team_name='".$playerteam."',player_country='".$playernationality."', player_role='".$playerrole."'  WHERE player_tag='".$playertag."'";
				
								
				
				$stmt = oci_parse($conn, $sql);
				oci_execute($stmt);
				oci_commit($conn);
				
				
				header('Location: edittables.php');
				
				oci_close($conn);

?>