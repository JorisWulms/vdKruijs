<script type="text/javascript">
function toggle(source) {
  checkboxes = document.getElementsByName('module[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
<div class="heading">
	<h1 style="background-image: url('images/user.png');">Nieuw gebruiker</h1>
	<div class="buttons"><a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a><a onclick="location = 'index.php?action=user&clear=true'" class="gray_btn"><span>Annuleren</span></a></div>
</div>
<div class="content">
	<form method="post" action="index.php?action=user" name="formulier" id="form">
		<input type="hidden" name="adduser" value="true">
		<table class="form">
			<tr>
				<td>Naam:</td>
				<td><input type="text" name="user" value="" maxlength="50"/></td>
			</tr>
			<tr>
				<td>Wachtwoord:</td>
				<td><input type="password" name="pass1" /></td>
			</tr>
			<tr>
				<td>Herhaal:</td>
				<td><input type="password" name="pass2" /></td>
			</tr>
			<tr>
				<td>E-mailadres:</td>
				<td><input type="text" name="email" value=""/></td>
			</tr>
			<tr>
				<td>Actief:</td>
				<td><select name="actief"><option value="0">Nee</option><option value="1" selected>Ja</option></select></td>
			</tr>
			<tr>
				<td>Status:</td>
				<td>
				<select name="status">
				<option value="4">Klant</option>
				<option value="5">Administrator</option>
				<?php if ($_SESSION['user_status'] == 9) {?>
				<option value="9">Super Administrator</option>
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
				<label><input type="checkbox" onclick="toggle(this)" /> Selecteer alles</label>
			</td></tr>
			<tr>
				<?php 
					
					$userdata = mysqli_query($res1 ,"SELECT *  
																FROM module 
																WHERE parent=0");
						while($usertable = mysqli_fetch_assoc($userdata)){
							
							echo'<tr><td style="padding:8px 5px;"><input type="checkbox" name="module[]" value="'.$usertable["id"].'"';
							echo '>'.$usertable["title"].'</td><td valign="top">';
								$userrow = mysqli_query($res1 ,"SELECT *
																			FROM module
																			WHERE parent='".$usertable["id"]."'");
								$rowcount = mysqli_num_rows($userrow);
								if($rowcount != 0){
									echo'<ul style="list-style:none;">';
										while($usertableline = mysqli_fetch_assoc($userrow)){
											echo'<li style="margin:2px 0;"><label style="cursor:pointer;"><input type=checkbox name="module[]" value="'.$usertableline["id"].'"  ';						
											echo'>'.$usertableline["title"].'</li>';						
										}
									echo'</ul>';
								}
							echo '</td></tr>';
						}
					
				?>
			</tr>
		</table>

	</form>
</div>
