<?php
	//kõik andmebaasiga seonduv
	
	
	//ühenduse loomiseks kasuta
	require_once("../configglobal.php");
	$database = "if15_jarmhab";
	
	//paneme sessiooni käima, saame kasutada $
	session_start();
	
	
	//paneme ühenduse kinni
	
	
	
	//lisame kasutaja andmebaasi
	function createUser($create_email, $password_hash){
		// globals on muutuja kõigist php failidest mis on ühendatud
		
	$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		$stmt->bind_param("ss", $create_email, $password_hash);
		$stmt->execute();
		$stmt->close();
		
		$mysqli->close($create_email, $password_hash);		
	}
	
	//logime sisse
	function loginUser($email, $password_hash){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
				$stmt->bind_param("ss", $email, $password_hash);
				
				//paneme vastused muutujatesse
				$stmt->bind_result($id_from_db, $email_from_db);
				$stmt->execute();
				
				if($stmt->fetch()){
					//leidis
					echo "kasutaja id=".$id_from_db;
					
					$_SESSION["id_from_db"] = $id_from_db;
					$_SESSION["user_email"] = $email_from_db;
					
					header("Location: data.php");
										
				}else{
					//tyhi ei leidnud
					echo "wrong password or email id";
				}
					$stmt->close();
		
					$mysqli->close();
	}
				
			
		 // login if end
	
?> 