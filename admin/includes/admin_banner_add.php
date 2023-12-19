<div class="heading">
	<h1 style="background-image: url('images/category.png');">Nieuwe banner</h1>
	<div class="buttons">
		<a onclick="$('#form').submit();" class="green_btn"><span>Opslaan</span></a>
		<a onclick="location = 'index.php?action=banner&clear=true'" class="gray_btn"><span>Annuleren</span></a>
	</div>
</div>

<div class="content" id="newInputs">	
	<form method="post" action="index.php?action=banner" id="form" enctype="multipart/form-data">
		<input type="hidden" name="addbanner" value="true">
		<div id="tab_general">			
			<table class="form">
				<tr>
					<td width="30%">Bovenste tekst:</td>
					<td>
						<input type="text" name="topTextNL" value="<?=isset($row['topTextNL'])?>" />
					</td>
				</tr>
				<tr>
					<td width="30%">Onderste tekst:</td>
					<td>
						<input type="text" name="bottomTextNL" value="<?=isset($row['bottomTextNL'])?>" />
					</td>
				</tr>
				<tr>
					<td width="30%">Button Text:</td>
					<td>
						<input type="text" name="bannerButtonNL" value="<?=isset($row['bannerButtonNL'])?>" />
					</td>
				</tr>
				<tr>
					<td width="30%">Button link:</td>
					<td>
						<input type="text" name="bannerLinkNL" value="<?=isset($row['bannerLinkNL'])?>" />
					</td>
				</tr>
				<tr>
					<td colspan="2"><i>Note: Als je de button text of link leeg laat, dan wordt er geen button getoont in de banner.</i></td>
				</tr>
				<tr>
					<td width="30%">Sortering:</td>
					<td><input type="text" name="bannerOrder" value="" style="width:40%;" /></td>
				</tr>
				<tr>
					<td width="30%">Banner overlay?</td>
					<td>
					<div class="slideThree">  
						<input type="checkbox" id="bannerOverlay" name="bannerOverlay" value="1" />
						<label for="bannerOverlay"></label>
					</div>
					</td>
				</tr>
				<tr>
					<td width="30%">Banner overlay color:</td>
					<td>
						<input type="text" name="bannerOverlayColor" value="" class="colorPicker" />
					</td>
				</tr>
				<tr>
					<td width="30%">Banner overlay opacity:</td>
					<td>
						<input type="range" min="0.0" max="1.0" step="0.1" name="bannerOverlayOpacity" value="0.0" placeholder="Waarde tussen '0.0' en '1.0'" /> <span class="rangeVal"></span>
					</td>
				</tr>
				<tr>
					<td width="30%">Banner background color:</td>
					<td>
						<input type="text" name="bannerBackground" value="" class="colorPicker" />
					</td>
				</tr>
				<tr>
					<td width="30%">Bannerpadding:</td>
					<td>
						<input type="text" name="bannerPadding" value="" placeholder="Ruimte boven en onder in banner..." />
					</td>
				</tr>
				<tr>
					<td width="30%">Bannerfocus:</td>
					<td>
						<select name="bannerFocus">
							<option value="top">Bovenkant</option>
							<option value="center" selected>Midden</option>
							<option value="bottom">Onderkant</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Banner image:</td>
					<td>
						<span class="bannerPreview" style="">
							<span class="bannerPreviewOverlay"></span>
						</span><br/>
						<input type="file" name="bannerSrc" class="bannerSrc" />
					</td>
				</tr>
				<tr>
					<td colspan="2"><i>Note: Onderstaand werkt enkel met de 'Custom banner per page' setting.</i></td>
				</tr>
				<tr>
					<td>Pagina's:</td>
					<td>
						<select multiple name="bannerPage[]" style="min-height:300px;">
							<?php 
								$getAllPages = mysqli_query($res1, "SELECT title, rewrite FROM sitetree_language");
								while($resAllPages = mysqli_fetch_assoc($getAllPages)){
									echo '<option '.$selected.' style="padding:5px;" value="'.$resAllPages['rewrite'].'">'.$resAllPages['title'].' ('.$resAllPages['rewrite'].'.html)</option>';
								}
							?>
							
						</select> 
					</td>
				</tr>
			</table>	
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('.rangeVal').html($('input[name="bannerOverlayOpacity"]').val());
	
		$('input[name="bannerOverlayOpacity"]').on('change click', function(){
			$('.rangeVal').html($('input[name="bannerOverlayOpacity"]').val());
			updatePreview();
		});
		
		
		
		$('input[name="bannerOverlayColor"]').on('change click mouseleave', function(){
			updatePreview();
		});
		
		$('.colorpicker').on('mouseleave', function(){
			updatePreview();
		});
		
		function readURL(input) {

			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('.bannerPreview').css('background-image', 'url('+e.target.result+')');
					console.log(e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}

		$(".bannerSrc").change(function(){
			readURL(this);
		});
	});
	
	function hexToRgb(hex) {
		var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
		return result ? {
			r: parseInt(result[1], 16),
			g: parseInt(result[2], 16),
			b: parseInt(result[3], 16)
		} : null;
	}
	
	function updatePreview(){
		if(hexToRgb($('input[name="bannerOverlayColor"]').val())!=null){
			$('.bannerPreviewOverlay').css('background','rgba('+hexToRgb($('input[name="bannerOverlayColor"]').val()).r + ',' + hexToRgb($('input[name="bannerOverlayColor"]').val()).g + ',' + hexToRgb($('input[name="bannerOverlayColor"]').val()).b + ',' + $('input[name="bannerOverlayOpacity"]').val() + ')');
		}
	}
</script>