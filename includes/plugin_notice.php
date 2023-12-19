<?php
	$getNotice = mysqli_query($res1 ,"SELECT * FROM settings_notice WHERE id = 1");
	$resNotice = mysqli_fetch_assoc($getNotice);
	
	if($resNotice['active']){
		// This plugin uses JS to close the notice and remember it. See js below.
		echo '<div class="notice">'.$resNotice['noticeText'].getAffiliateBanner(9).'<div id="closeNotice">X</div></div>';
		echo '<div id="openNotice" style="display:none;">'.$resNotice['buttonText'].'</div>';
?>
 
		<script type="text/javascript">
			$(function() {
				notice('.notice','#closeNotice','#openNotice');	
			});

			function notice(noticeDiv, closeButton, openButton){
				// If the notice has been closed, hide the notice by default for the rest of the session
				if($.cookie('noticeState')=='closed'){
					$(noticeDiv).hide();
					$(openButton).show();
				}
				
				$(closeButton).on('click',function(){
					$(noticeDiv).slideToggle();
					$(openButton).slideToggle();
					
					//Create cookie to remember closing notice
					$.cookie('noticeState', 'closed');
				});
				
				$(openButton).on('click',function(){
					$(noticeDiv).slideToggle();
					$(openButton).slideToggle();
					
					$.cookie('noticeState', 'open');
				});
			}
		</script>
<?php
	}