<?php
	if(isset($_POST['pass1'])){
		$salt = mosMakePassword(16);
		$pass = hash( 'sha256' , $_POST['pass1'].$salt);
	}
	
	if(isset($_POST['edituser'])) {
		/*print_r($_POST);
		die();*/
		if ($_POST['pass1'] == $_POST['pass2'] || $_POST['pass2'] =="" ) {
			$gebruikerid = $_POST['id'];
			mysqli_query($res1 ,"START TRANSACTION");
			
			$updatecurrent = "	UPDATE gebruikers 
								SET naam = '" . realescape($_POST['naam']) . "', 
								email = '" .realescape( $_POST['email']) . "', 
								actief ='" . realescape($_POST['actief']) . "', 
								status =' " . (int)$_POST['status']. "' 
								WHERE  id ='". (int)$gebruikerid ."' ";
			mysqli_query($res1 ,$updatecurrent);
			
			// Check if pass has to be changed
			if($_POST['pass1'] != "" && $_POST['pass2']!=""){
				$updatepass = "	UPDATE gebruikers 
								SET wachtwoord = '" .realescape($pass) . "',
								salt = '" .realescape($salt) . "'
								WHERE id ='". (int)$gebruikerid ."' ";
				mysqli_query($res1 ,$updatepass);
			}
			
			// Remove all modules, to add the right ones after
			$deletecurrent = '	DELETE FROM module_koppel
								WHERE userID = "' . (int)$gebruikerid . '" ';							
			mysqli_query($res1 ,$deletecurrent);
			
			// Add modules for this user
			if(isset($_POST['module'])){
				foreach($_POST['module'] as $module){	
					$query = "	INSERT INTO `module_koppel`(`moduleID`, `userID`) 
								VALUES (". (int)$module . "," . (int)$gebruikerid . ")";
					mysqli_query($res1 ,$query);
				}
			}
			mysqli_query($res1 ,"COMMIT");
			if ($updatecurrent == true) {
				$_SESSION['success'] = 'Gebruiker is succesvol gewijzigd';
			}
			else {
				$_SESSION['error_warning'] = 'Er is een fout opgetreden tijdens het wijzigen van gebruiker.';
			}
		}else{
			$_SESSION['error_warning'] = 'De door jouw opgegeven wachtwoorden komen niet overeen..';
        }
	}
	  
  
  if (isset($_POST['adduser'])) {
      $sql = "SELECT id FROM gebruikers WHERE naam='" . $_POST['user'] . "'";
      $query = mysqli_query($res1 ,$sql);
      $tellen = mysqli_num_rows($query);				  

      if ($tellen == 0) {
          if (preg_match("/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$/i", $_POST['email'])) {
              if ($_POST['pass1'] == $_POST['pass2']) {
				
                  $sql = "INSERT INTO gebruikers (naam,wachtwoord,status,salt,email,actief) VALUES ('" . realescape($_POST['user']) . "','" . realescape($pass) . "'," . (int)$_POST['status'] . ",'". realescape($salt) ."','" . realescape($_POST['email']) . "','" . realescape($_POST['actief']) . "')";
                  $query = mysqli_query($res1 ,$sql);
				  $userId = mysqli_insert_id($res1);
				  
				  if(isset($_POST['module'])){
					  foreach( $_POST["module"] as $moduleID)  {
							$q = "INSERT INTO `module_koppel`(`moduleID`, `userID`) VALUES (". (int)$moduleID . ",". (int)$userId . ")";
							mysqli_query($res1 ,$q);
					  } 
				  } 
			
				  
                  if ($query == true) {
					$_SESSION['success'] = 'Gebruikersnaam is met succes toegevoegd';
                  }
                  else {
					$_SESSION['error_warning'] = 'Er is een fout opgetreden tijdens het toevoegen van account.';
                  }
              }
              else {
					$_SESSION['error_warning'] = 'De door jou opgegeven wachtwoorden komen niet overeen..';
              }
          }
          else {
					$_SESSION['error_warning'] = 'Het e-mailadres dat jij opgaf, komt niet overeen met hoe een e-mailadres eruit zou moeten zien (gebruiker@domain.ext)';
          }
      }
      else {
					$_SESSION['error_warning'] = 'De gebruikersnaam ' . $_POST['user'] . ' is reeds in gebruik. Probeer een andere gebruikersnaam';
      }
	  
	  			
  }

if (isset($_GET['route'])){

	switch ($_GET['route']) {

		case "delete":
			if (isset($_POST['selected'])){
				foreach($_POST['selected'] as $key => $value){
					mysqli_query($res1 ,"DELETE FROM gebruikers WHERE id='".$value."'");
				}
				if (count($query!=0)){
					$_SESSION['success'] = 'De gebruiker is met succes verwijderd.';
					header('Location: index.php?action=user'); 
				}
			}
		break;	
	}	
}

$res = mysqli_query($res1 ,"SELECT * FROM gebruikers ");
?>
<div class="heading">
<h1 style="background-image: url('images/user.png');">Gebruikers</h1>
<div class="buttons"><a onclick="location = 'index.php?action=user_add&clear=true'" class="green_btn"><span>Nieuwe gebruiker</span></a><a onclick="$('#form').submit();" class="red_btn"><span>Verwijder</span></a></div>
</div>
<div class="content">
<form method="post" action="index.php?action=user&route=delete" id="form">
<table class="list">
	<thead>
		<tr>
			<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
			<td class="left"><b>Gebruikersnaam</b></td>
			<td class="left"><b>Email</b></td>
			<td class="left"><b>Status</b></td>
			<td class="left"><b>Zichtbaar</b></td>
			<td class="left"><b>Rechten</b></td>
			<td class="right">Actie</td>
		</tr>
	</thead>
	<tbody>
	<?php 
	while ($row = mysqli_fetch_assoc($res)){
	?>
		<tr>
            <td style="text-align: center;"><input type="checkbox" name="selected[]" value="<?php echo $row['id']; ?>" /></td>
			<td valign="top" class="left"><?=$row['naam']?></td>
			<td valign="top" class="left"><?=$row['email']?></td>
			<td class="left"><?php if ($row['status']==9){echo "Super administrator";}elseif ($row['status']==5){echo "Administrator";}elseif ($row['status']==4){echo "Klant";}?></td>
			<td class="left"><?=($row['actief']==0)? '<font color="red">Niet actief</font>' : '<font color="green">Actief</font>'?></td>
			<td class="left">
				<ul style="height: 105px;overflow:auto;list-style:none;float:left;width:100%;padding:0;margin:0;">
				<?php 	
					$userdata = mysqli_query($res1 ,"SELECT *, module.id AS id 
													 FROM module
													 LEFT JOIN module_koppel ON module.id = module_koppel.moduleID
													 LEFT JOIN gebruikers ON module_koppel.userID = gebruikers.id
													 WHERE gebruikers.id = ".$row['id']."
													 AND module.parent = 0
													 ORDER BY ordening");
					while($resUserdata = mysqli_fetch_assoc($userdata)){
						echo '<li>'.$resUserdata['title'].'</li>';
						
						$userrow = mysqli_query($res1 ,"SELECT *
														FROM module
														WHERE parent='".$resUserdata["id"]."'");
						$rowcount = mysqli_num_rows($userrow);
						if($rowcount != 0){
							while($usertableline = mysqli_fetch_assoc($userrow)){
								echo'<li>-->'.$usertableline["title"].'</li>';						
							}
						}
					}
				?>
				</ul>
			</td>
			<td width="10%" class="right"><a class="gray_btn" href="index.php?action=user_edit&clear=true&id=<?=$row['id']?>">Wijzigen</a></td>
		</tr>
	<?php 
	}
	?>
	</tbody>
</table>
</form>
</div>