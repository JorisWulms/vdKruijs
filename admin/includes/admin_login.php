<?php 
	$msg =	"";
	if (isset($_POST['login'])) {
		
		if (isset($_SESSION['user_id'])) {
			$msg = "You have already logged in.";
			error();
			session_unset();
			session_destroy();
		} else {
			if (isset($_POST['login'])) {
				// Inloggen
				$sql = "SELECT id,naam,wachtwoord,salt,status,actief,email FROM gebruikers WHERE naam='" . realescape($_POST['username']) . "'";
				$query = mysqli_query($res1, $sql);
				$rij = mysqli_fetch_object($query);
				$userid = $rij->id;
				$salt = $rij->salt;
				$userstatus = (int)$rij->status;
				$useractief = (int)$rij->actief;
				$email = htmlspecialchars($rij->email);
				$passwd = trim($_POST['pwd']);
				$ipadres = $_SERVER['REMOTE_ADDR'];
				
				$cryptpass = hash('sha256', $passwd.$salt);
				
				
				if ($rij->wachtwoord == $cryptpass) {

					if ($useractief == 1) {
						$_SESSION['user_id'] = $userid;
						$_SESSION['user_status'] = $userstatus;
						$_SESSION['username'] = $_POST['username'];
						$_SESSION['email'] = $email;
						
						$sql = "UPDATE gebruikers SET lastactive=NOW(),ip='" . realescape($ipadres). "' WHERE id='". (int)$_SESSION['user_id']."'";
						mysqli_query($res1 ,$sql);

						$msg = "You are logged.";

						reloadajax();
						header("Location: index.php");
					} else {
						$msg = "Je account is niet geactiveerd. Activeer deze, door op de link in de verzonden e-mail te klikken.";
						error();
					}
				} else {
					$msg="<span style='text-transform:uppercase;'>Inloggen mislukt</span><br/> Wachtwoord en gebruikersnaam komen niet overeen";
					error();
				}
			} else {
				
			}
		}
	}

?>
<div class="loginContainer">
  <div class="container">
	<div class="loginBlock">	
		<form action="" method="post" enctype="multipart/form-data" id="admin_login">	
			<input type="hidden" name="login" value="true">
			<h1>Inloggen</h1>
			<strong>Gebruikersnaam:</strong>
			<input type="text" name="username" value="" />

			<strong>Wachtwoord:</strong>
			<input type="password" name="pwd" value="" />

			<input type="submit" class="green_btn" value="Inloggen" />
		</form>
	</div>
	<?php
		if($msg!=""){
	?>
    <center>
		<div id="admin_login_error">
			<?=$msg?>
		</div>
	</center>
	<?php
		}
	?>
    <script type="text/javascript">
	$('#admin_login input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#admin_login').submit();
		}
	});
	</script> 
  </div>
</div>