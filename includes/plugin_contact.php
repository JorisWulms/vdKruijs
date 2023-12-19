<?php
function generateSettingsOverview() {
	GLOBAL $res1;
	
	//Get all data
	$output = '';
	$getFields = mysqli_query($res1 ,"SELECT *
									  FROM contactform
									  WHERE visible = 1 AND parent = 0
									  ORDER BY ordening");
									  
	while($resFields = mysqli_fetch_assoc($getFields)){
		// Text input	
		if($resFields['type']=="text"){
			$output .= '<input type="'.$resFields['type'].'" name="'.$resFields['title'].'" placeholder="'.$resFields['placeholder'].'" />';
		// Submit input	
		}elseif($resFields['type']=="submit"){
			
						$output .= '<label>
                            Ik ben geen robot & Ik ben op de hoogte van en ga akkoord met het 
                            <a target="_blank"  href="privacy.html" style="width: auto;float: none;color: #000;text-decoration: underline;">privacy beleid</a>
                        </label>';
			$output .= '<div style="float: left;"><div data-theme="light" class="g-recaptcha" data-sitekey="6LdNG38UAAAAAK9uFY-JBdog_RDPl0nigC-QPd0F"></div></div>';

			$output .= '<input type="'.$resFields['type'].'" name="submit" value="'.$resFields['placeholder'].'" />';
		// Textarea input
		}elseif($resFields['type']=="textarea"){
			$output .= '<textarea name="'.$resFields['title'].'" placeholder="'.$resFields['placeholder'].'"></textarea>';
		}
		// Select field
		elseif($resFields['type']=="select"){
			$selectId = $resFields['id'];
				// Get all options
				$option = "SELECT *
						FROM contactform
						WHERE visible = 1 AND parent = ".(int)$selectId."
						ORDER BY ordening";
						
				$output .= '<span style="float:left;width:100%;">'.$resFields['placeholder'].'</span>';										
				$output .= '<select name="'.$resFields['title'].'">';
				
				$childResult = mysqli_query($res1,$option);
				while($child = mysqli_fetch_assoc($childResult)) {

						$output .= '<option name="'.$child['title'].'" value="'.$child['id'].'">'.$child['title'].' </option>';
				}
				$output .= '</select>';		
			
		}elseif($resFields['type']=="checkbox"){
		// Checkboxes
			$output .= '<label class="checkbox"><input type="'.$resFields['type'].'" name="'.$resFields['title'].'" value="'.$resFields['placeholder'].'" >'.$resFields['title'].'</label>';
		}
		elseif($resFields['type']=="radio"){
		// Radiobuttons, Childs are other options
			$selectId = $resFields['id'];
			$radiogroup = "SELECT *
						FROM contactform
						WHERE visible = 1 AND parent = ".(int)$selectId."
						ORDER BY ordening";
						
			$output.='<label class="radioButton"><input type="'.$resFields['type'].'" name="'.$resFields['title'].'" value="'.$resFields['placeholder'].'" >'.$resFields['title'].'</label>';
			
			$radio = mysqli_query($res1,$radiogroup);
			while($radiobutton = mysqli_fetch_assoc($radio)) {
				$output .= '<label class="radioButton"><input type="'.$radiobutton['type'].'" name="'.$resFields['title'].'" value="'.$radiobutton['id'].'">'.$radiobutton['title'].' </option></label>';
			}
		}
	}
	
	
	return $output;
}

$getContactSettings = mysqli_query($res1 ,"SELECT * FROM settings_contact");
$resContactSettings = mysqli_fetch_assoc($getContactSettings);

$sendok=0;
if(isset($_POST['submit']) && $_POST["check"] == 1){

	$captcha = $_POST['g-recaptcha-response'];
	
	$secretKey = '6LdNG38UAAAAAFK3P1pNPBYgAJhsQiVer7vNywXq';
	$ip = $_SERVER['REMOTE_ADDR'];
	$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);

	$responseKeys = json_decode($response,true);

	if(intval($responseKeys["success"]) === 1) {


	$mail = new mosPHPMailer();
	
		if(isset($array[1])){
			$addition="/".$array[1];
		}else{
			$addition="";
		}
		
	$plaintext = '  
		<table width="100%" border="0" cellpadding="0" cellspacing="2">
			<tbody>
				<tr>
				  <td colspan="2">Er is een contactformulier ingevuld op '.SITENAAM.'</td>
				</tr>
				<tr>
				  <td colspan="2">&nbsp;</td>
				</tr>
				<tr>
				  <td colspan="2">---------------</td>
				</tr>
				<tr>
				  <td colspan="2">&nbsp;</td>
				</tr>';
		
	foreach($_POST as $item => $value){
		if($item!="check" && $item!="submit" && $item!="g-recaptcha-response"){
			$plaintext .= '<tr>
							<td><b>'.htmlspecialchars($item).':</b></td>
							<td>'.htmlspecialchars($value).'</td>
						</tr>';
		}
	}
	$plaintext .='
				<tr>
				  <td colspan="2">&nbsp;</td>
				</tr>
				<tr>
				  <td colspan="2">---------------</td>
				</tr>
				<tr>
				  <td colspan="2">&nbsp;</td>
				</tr>
				
				<tr>
				  <td colspan="2"><i>Dit contactformulier werd ingevuld op de volgende pagina : '.SITEURL.htmlspecialchars($array[0].$addition).'.html</i></td>
				</tr>
			</tbody>
		</table>';
		
	$sitenaam=SITENAAM;
	$sitemail=SITEMAIL;
	//$sitemail="cimst05@gmail.com";
	$subject="Contactformulier ".SITENAAM;
	$mail->From = $sitemail;
	$mail->FromName = $sitenaam;
	$mail->Body = $plaintext;
	$mail->Subject = $subject;
	$mail->IsHTML(true);
	$mail->AddAddress($sitemail, $sitenaam);
	$mail->AddBCC(SITEMAILBCC, $sitenaam);
	$mail->ClearReplyTos();
	$mail->AddReplyTo($_POST['email'], $_POST['naam']);
	$query=$mail->Send();
	$mail->ClearAddresses();
			
	if ($query==true){
		$sendok=1;
	}
	
	//echo '<meta http-equiv="refresh" content="0;URL='.SITEURL.$resContactSettings['bedanktpagina'].'.html" />';
	header('Location: '.$resContactSettings['bedanktpagina'].'.html');
	exit;
	} else {
		echo '<span style="float:left;width:100%;box-sizing:border-box;padding:10px;background:#F99D9D;border:1px solid #B71010;color:#fff;text-align:center;">Er lijkt iets mis te gaan. Probeer het later nog eens.</span>';
	}
		
}

if ($sendok==0){
?>
<form name="contactformulier" action="" method="post" id="mainContact" class="formLayout" onsubmit="return validateForm()" >
	<?=$resContactSettings['titel'] ? '<span class="formTitle">'.$resContactSettings['titel'].'</span>' : ''?>
	
	
	<?php
	echo generateSettingsOverview();
	?>
	
	<input name="check" id="check" value="0" type="hidden">
		<script type="text/javascript">
		   document.getElementById("check").value = 1;
		   
		   function validateForm() {
			   //ga naar het id mainContact en zoek daar de input en haal daar de value van op
				var inputFields = $("#mainContact").find("input").get();
					for( var i = 0; i < inputFields.length; i++) {
						if( $(inputFields[i]).val() == "" ) {
							 alert("Vul a.u.b. alle velden in.");
							return false;
						}
					}
					return true;
			}
					
		</script>

</form>
<?php
}elseif ($sendok==1){
?>
<div style="font-size:12px;">Bedankt voor uw bericht. We zullen zo snel mogelijk contact met u opnemen.</div>
<?php
}
?>