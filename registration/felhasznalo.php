<meta charset="utf-8">
<form method="POST">
	Add meg az email cimet: :<br />
	<input type="email" name="input_felh_email"><br />
	Add meg a jelszavat:<br />
	<input type="password" name="input_felh_pwd" maxlength="10" minlength="6"><br />	
	Add meg felhasználó jogosultságát:<br />
	<select name="input_felh_perm">
		<option value="user" selected>Felhasznalo</option>
		<option value="admin">Admin</option>
		<option value="moderator">Moderátor</option>
	</select>
	<br />	
	Add meg felhasználó aktivitását:<br />
	<select name="input_felh_activity">
		<option value="active" selected>Aktív</option>
		<option value="inactive">Inaktív</option>
	</select>	
	<br />	
	<input type="hidden" name="action" value="cmd_insert_felhasznalo">
	<input type="submit" value="Felhasználó felvétele">
</form>



<?php
if(isset($_POST["action"]) and $_POST["action"]=="cmd_insert_felhasznalo"){
	if( isset($_POST["input_felh_email"]) and
		!empty($_POST["input_felh_email"]) and
		isset($_POST["input_felh_pwd"]) and
		!empty($_POST["input_felh_pwd"]) and
		isset($_POST["input_felh_perm"]) and
		!empty($_POST["input_felh_perm"]) and
		isset($_POST["input_felh_activity"]) and
		!empty($_POST["input_felh_activity"])
		){
		$insert_user = new felhasznalok();
		echo $insert_user->cmd_insert_felhasznalo($_POST["input_felh_email"],
												sha1(md5($_POST["input_felh_pwd"])),
												$_POST["input_felh_perm"],
												$_POST["input_felh_activity"]
												);
												
	} else {
		echo "Hiányos adatokkal nem tudok dolgozni!";
	}
}
if(isset($_POST["action"]) and $_POST["action"]=="cmd_delete_felhasznalo"){
		if( isset($_POST["input_id"]) and
			!empty($_POST["input_id"])){
				$delete_user = new felhasznalok();
				echo $delete_user->cmd_delete_felhasznalo($_POST["input_id"]);						
		} else {
			echo "Nem tudom végrehajta a műveletet, hiba történt!";
		}
	}
	if(isset($_POST["action"]) and $_POST["action"]=="cmd_aktival_felhasznalo"){
		if( isset($_POST["input_id"]) and
			!empty($_POST["input_id"])){
				$active_user = new felhasznalok();
				echo $active_user->cmd_aktival_felhasznalo($_POST["input_id"]);						
		} else {
			echo "Nem tudom végrehajta a műveletet, hiba történt!";
		}
	}
	if(isset($_POST["action"]) and $_POST["action"]=="cmd_deaktival_felhasznalo"){
		if( isset($_POST["input_id"]) and
			!empty($_POST["input_id"])){
				$deactive_user = new felhasznalok();
				echo $deactive_user->cmd_deaktival_felhasznalo($_POST["input_id"]);						
		} else {
			echo "Nem tudom végrehajta a műveletet, hiba történt!";
		}
	}
	if(isset($_POST["action"]) and $_POST["action"]=="cmd_user_felhasznalo"){
		if( isset($_POST["input_id"]) and
			!empty($_POST["input_id"])){
				$user_user = new felhasznalok();
				echo $user_user->cmd_user_felhasznalo($_POST["input_id"]);						
		} else {
			echo "Nem tudom végrehajta a műveletet, hiba történt!";
		}
	}

if(isset($_POST["action"]) and $_POST["action"]=="cmd_moderator_felhasznalo"){
		if( isset($_POST["input_id"]) and
			!empty($_POST["input_id"])){
				$moderator_user = new felhasznalok();
				echo $moderator_user->cmd_moderator_felhasznalo($_POST["input_id"]);						
		} else {
			echo "Nem tudom végrehajta a műveletet, hiba történt!";
		}
	}

if(isset($_POST["action"]) and $_POST["action"]=="cmd_admin_felhasznalo"){
		if( isset($_POST["input_id"]) and
			!empty($_POST["input_id"])){
				$admin_user = new felhasznalok();
				echo $admin_user->cmd_admin_felhasznalo($_POST["input_id"]);						
		} else {
			echo "Nem tudom végrehajta a műveletet, hiba történt!";
		}
	}

$felhasznalo = new felhasznalok();

foreach($felhasznalo->get_osszes_felhasznalo() as $record){
	echo "<h3>" . $record["felh_id"] . "</h3>";
	echo "<p>email:" . $record["felh_email"] . "</p>";
	echo "<p>jelszó: " . $record["felh_pwd"] . "</p>";
	echo "<p>jog: " . $record["felh_perm"] . "</p>";
	echo "<p>aktivitás: " . $record["felh_activity"] . "</p>";
		echo "<form method='POST'>";
		echo "<input type='hidden' name='input_id' value='".$record["felh_id"]."'>";
		echo "<input type='hidden' name='action' value='cmd_delete_felhasznalo'>";
		echo "<input type='submit' value='törlés'>";
		echo "</form>";
		echo "<form method='POST'>";
		if ($record["felh_activity"]=="active") {
			echo "<input type='hidden' name='input_id' value='".$record["felh_id"]."'>";
			echo "<input type='hidden' name='action' value='cmd_deaktival_felhasznalo'>";
			echo "<input type='submit' value='Deaktivál'>";
		}
		else{
			echo "<input type='hidden' name='input_id' value='".$record["felh_id"]."'>";
			echo "<input type='hidden' name='action' value='cmd_aktival_felhasznalo'>";
			echo "<input type='submit' value='Aktivál'>";};
	echo "</form>";
	echo "<form method='POST'>";
		echo "<input type='hidden' name='input_id' value='".$record["felh_id"]."'>";
		echo "<input type='hidden' name='action' value='cmd_user_felhasznalo'>";
		echo "<input type='submit' value='User'>";
	echo "</form>";

	echo "<form method='POST'>";
		echo "<input type='hidden' name='input_id' value='".$record["felh_id"]."'>";
		echo "<input type='hidden' name='action' value='cmd_moderator_felhasznalo'>";
		echo "<input type='submit' value='Moderátor'>";
	echo "</form>";

	echo "<form method='POST'>";
		echo "<input type='hidden' name='input_id' value='".$record["felh_id"]."'>";
		echo "<input type='hidden' name='action' value='cmd_admin_felhasznalo'>";
		echo "<input type='submit' value='Admin'>";
	echo "</form>";
}

class felhasznalok{
	
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $dbname = "oraimunka";
	private $conn = NULL;
	private $sql = NULL;
	private $result = NULL;
	private $row = NULL;
	
	public function kapcsolodas() {
		$this->conn = new mysqli($this->servername, 
						   $this->username, 
						   $this->password, 
						   $this->dbname);
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		} 
	}
	
	public function kapcsolatbontas(){
		$this->conn->close();		
	}
	
	public function __construct() { $this->kapcsolodas(); }
	public function __destruct() { $this->kapcsolatbontas(); }
	
	public function get_osszes_felhasznalo(){
		$this->sql = "SELECT * FROM felhasznalok;";
		$this->result = $this->conn->query($this->sql);
		if ($this->result->num_rows > 0) {
			while($this->row = $this->result->fetch_assoc()) {
				$this->content[] = $this->row;
			}
		} else {
			$this->content[] = NULL;
		}
		return $this->content;
	}
	
	public function cmd_insert_felhasznalo($input_felh_email,
										   $input_felh_pwd,
										   $input_felh_perm,
										   $input_felh_activity){
		$this->sql = "INSERT INTO 
							`oraimunka`.`felhasznalok` 
								(
								`felh_email`, 
								`felh_pwd`, 
								`felh_perm`, 
								`felh_activity`
								) 
							VALUES 
								(
								'".$input_felh_email."', 
								'".$input_felh_pwd."', 
								'".$input_felh_perm."', 
								'".$input_felh_activity."'
								)
					 ;";
		if($this->conn->query($this->sql)){
			return "sikeres felhasználófelvétel";
		} else {
			return "sikertelen felhasználófelvétel";
		}
	}
public function cmd_delete_felhasznalo($input_id){
		$this->sql = "DELETE FROM 
						`oraimunka`.`felhasznalok` 
					  WHERE
						`felh_id` = '".$input_id."'
					 ;";
		if($this->conn->query($this->sql)){
			return "sikeres felhasználótörlés";
		} else {
			return "sikertelen felhasználótörlés";
		}
	}
	public function cmd_aktival_felhasznalo($input_id){		
			$this->sql ="UPDATE felhasznalok
						SET felh_activity='active'
						WHERE felh_id='".$input_id."';";						
			if($this->conn->query($this->sql)){
				return "sikeres felhasználóaktiválás";
			} else {
				return "sikertelen felhasználóaktiválás";
			}
		}
	public function cmd_deaktival_felhasznalo($input_id){		
			$this->sql ="UPDATE felhasznalok
						SET felh_activity='inactive'
						WHERE felh_id='".$input_id."';";						
			if($this->conn->query($this->sql)){
				return "sikeres felhasználóaktiválás";
			} else {
				return "sikertelen felhasználóaktiválás";
			}
		}		
	
	public function cmd_user_felhasznalo($input_id){		
			$this->sql ="UPDATE felhasznalok
						SET felh_perm='user'
						WHERE felh_id='".$input_id."';";						
			if($this->conn->query($this->sql)){
				return "sikeres felhasznaló perm állitás";
			} else {
				return "sikertelen felhasznaló perm állitás";
			}
		}		
	
	public function cmd_moderator_felhasznalo($input_id){		
			$this->sql ="UPDATE felhasznalok
						SET felh_perm='moderator'
						WHERE felh_id='".$input_id."';";						
			if($this->conn->query($this->sql)){
				return "sikeres felhasznaló perm állitás";
			} else {
				return "sikertelen felhasznaló perm állitás";
			}
		}		
	
	public function cmd_admin_felhasznalo($input_id){		
			$this->sql ="UPDATE felhasznalok
						SET felh_perm='admin'
						WHERE felh_id='".$input_id."';";						
			if($this->conn->query($this->sql)){
				return "sikeres felhasznaló perm állitás";
			} else {
				return "sikertelen felhasznaló perm állitás";
			}
		}		
	}

?>
