<?php
	date_default_timezone_set("Asia/Bangkok");
	
	$servername = "localhost";	
	$username = "root";
	$password = "";

	// Create connection
	$conn = new mysqli($servername, $username, $password, "ta");

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM t_data WHERE (status='Terbuka' AND status_request='Accepted') ORDER BY 'end_time' ASC LIMIT 1 ";
	$result = $conn->query($sql);
	
	if($result){
		while ($row=mysqli_fetch_row($result))
		{
			$dateTimeSet = $row[2];
			$data_id = $row[0];
			$ruangan_id = $row[3];
			//Proses Close
			$dateTimeNow =  date("Y-m-d H:i:s");	
			$dateTimeSetAddTwoMinutes = date("Y-m-d H:i:s",strtotime($dateTimeSet." +2 minutes"));

			echo $dateTimeNow.'<br>'.$dateTimeSet.'<br>';
			echo $dateTimeSetAddTwoMinutes;
			
			if($dateTimeNow >= $dateTimeSet && $dateTimeNow <= $dateTimeSetAddTwoMinutes ){
				echo "Masuk";
				$sqlUpdate = "UPDATE t_data SET status='Tertutup' WHERE data_id=$data_id";
				$sqlUpdateRuangan = "UPDATE t_daftarruangan SET status='Tertutup' WHERE ruangan_id=$ruangan_id";
				
				$resultUpdate = $conn->query($sqlUpdate);
				$resultUpdateRuangan = $conn->query($sqlUpdateRuangan);
				if($resultUpdate){
					$ch1 = curl_init();
					$ch2 = curl_init();
					$ch3 = curl_init();

					// set URL and other appropriate options
					curl_setopt($ch1, CURLOPT_URL, "http://192.168.43.46/3/off");
					curl_setopt($ch1, CURLOPT_HEADER, 0);
					curl_setopt($ch2, CURLOPT_URL, "http://192.168.43.117/4/off");
					curl_setopt($ch2, CURLOPT_HEADER, 0);
					curl_setopt($ch3, CURLOPT_URL, "http://192.168.43.234/5/off");
					curl_setopt($ch3, CURLOPT_HEADER, 0);

					//create the multiple cURL handle
					$mh = curl_multi_init();

					//add the two handles
					curl_multi_add_handle($mh,$ch1);
					curl_multi_add_handle($mh,$ch2);
					curl_multi_add_handle($mh,$ch3);

					$active = null;
					//execute the handles
					do {
						$mrc = curl_multi_exec($mh, $active);
					} while ($mrc == CURLM_CALL_MULTI_PERFORM);

					while ($active && $mrc == CURLM_OK) {
						if (curl_multi_select($mh) != -1) {
							do {
								$mrc = curl_multi_exec($mh, $active);
							} while ($mrc == CURLM_CALL_MULTI_PERFORM);
						}
					}

					//close the handles
					curl_multi_remove_handle($mh, $ch1);
					curl_multi_remove_handle($mh, $ch2);
					curl_multi_remove_handle($mh, $ch3);
					curl_multi_close($mh);
				}else{
					echo "GAGAL UPDATE STATUS";
				}
				
			}
		}
	}
	
	

	
	
	
	
	$conn->close();
?>