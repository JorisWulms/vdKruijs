<?php 
$res= mysqli_query($res1 ,"SELECT * from gebruikers WHERE id=".$_GET['id']."");
$row = mysqli_fetch_object($res);
?>
<script type="text/javascript">
function toggle(source) {
  checkboxes = document.getElementsByName('module[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
<div class="heading">
	<h1 style="background-image: url('images/user.png');">Wijzig gebruiker</h1>
	<div class="buttons"><a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=user&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>
<div class="content">
	<form method="post" action="index.php?action=user" name="formulier" id="form">
		<input type="hidden" name="edituser" value="true" />
		<input type="hidden" name="id" value="<?=$row->id?>" />
		<table class="form">
			<tr>
				<td>Naam:</td>
				<td><input type="text" name="naam" value="<?=$row->naam?>" maxlength="50"/></td>
			</tr>
			<tr>
				<td>Nieuw wachtwoord:</td>
				<td><input type="password" name="pass1" /> <small>(leeglaten voor huidige)</small></td>
			</tr>
			<tr>
				<td>Herhaal:</td>
				<td><input type="password" name="pass2" /></td>
			</tr>
			<tr>
				<td>E-mailadres:</td>
				<td><input type="text" name="email" value="<?=$row->email?>"/></td>
			</tr>
			<tr>
				<td>Actief:</td>
				<td><select name="actief"><option value="0" <?=($row->actief==0)? 'selected="selected"' : ''?>>Nee</option><option value="1" <?=($row->actief==1)? 'selected="selected"' : ''?>>Ja</option></select></td>
			</tr>
			<tr>
				<td>Status:</td>
				<td>
					<select name="status">
					<option value="4" <?php if ($row->status == 4) {echo 'selected';}?>>Klant</option>
					<option value="5" <?php if ($row->status == 5) {echo 'selected';}?>>Administrator</option>
					<?php if ($_SESSION['user_status'] == 9) {?>
					<option value="9" <?php if ($row->status == 9) {echo 'selected';}?>>Super Administrator</option>
					<?php }?>
					</select>
				</td>
			</tr>
		</table>

		<table class="list">
			<thead>
				<tr><td class="left" style="text-align:center;" colspan="4">Selecteer de bevoegdheden voor deze gebruiker</td></tr>
			</thead>
			<tr><td colspan="4" width="1" style="padding:8px 5px;">
				<label><input type="checkbox" onclick="toggle(this)" /> Selecteer alles / niks</label>
			</td></tr>
			<?php
				$usertabel = mysqli_query($res1 ,"SELECT * 
												  FROM module
												  WHERE parent=0");
				while($userrow = mysqli_fetch_assoc($usertabel)){
					echo '<tr class="even_row"><td style="padding:8px 5px;"><label style="cursor:pointer;"><input type="checkbox" name="module[]" value="'.$userrow['id'].'"';
					
					$fetchrights = mysqli_query($res1 ,"SELECT moduleID, userID 
														FROM module_koppel
														WHERE userID=".$_GET['id']."");
														
					while($rights = mysqli_fetch_assoc($fetchrights)){
						if($userrow["id"]==$rights["moduleID"]){
							echo 'checked="checked"';								
						}
					}
					
					echo 'id="checkme'.$userrow["id"].'"></label>'.$userrow["title"].'</td><td style="padding:8px 5px;" valign="top">';
					$userrowitem = mysqli_query($res1 ,"SELECT *
														FROM module
														WHERE parent='".$userrow["id"]."'");
					$modulecount = mysqli_num_rows($userrowitem);
					
				if ($modulecount != 0){
					echo '<ul style="list-style:none;">';
					while ($usertabelline = mysqli_fetch_assoc($userrowitem)){
					
						echo'<li style="margin:2px 0;"><label style="cursor:pointer;"><input type="checkbox" name="module[]" value="'.$usertabelline['id'].'"';
						$fetchusedrights = mysqli_query($res1 ,"SELECT moduleID, userID  
																FROM module_koppel
																WHERE userID=".$_GET['id']."");					
						while($fetchresult = mysqli_fetch_assoc($fetchusedrights)){
							if ($usertabelline["id"]==$fetchresult["moduleID"]){
								echo 'checked="checked"';	
							}
						}
						echo ' id="checkme101">'.$usertabelline["title"].'</label></li>';
					}
					echo '</ul>';
				}
				echo '</td></tr>';
			}
			?>
		</table>
	</form>
</div>
