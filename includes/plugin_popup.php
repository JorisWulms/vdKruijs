<?php
	$getPopup = mysqli_query($res1 ,"SELECT * FROM settings_popup WHERE id = 1");
	$resPopup = mysqli_fetch_assoc($getPopup);
	
	if($resPopup['active']){

		// This plugin uses JS to close the notice and remember it. See js below.
		echo '<div class="popup" id="popup">'.$resPopup['popupContent'].getAffiliateBanner(8).'<div id="closePopup"><span>X</span></div></div>';
?>
		<script type="text/javascript">
			$(function() {
				if($.cookie('popupSate')!='closed'){
					var popup = $('#popup').bPopup({
						transition: 'slideDown'
					});
					$('#closePopup').on('click',function(){
						popup.close();
					});
				}else{
					$('#popup').hide();
				}
				$.cookie('popupSate', 'closed');
			});
		</script>
<?php
	}