<?php

ini_set("display_errors", 0);
error_reporting(E_ALL);
require_once('../../includes/prefs.php');
require_once(DIR_SYSTEM . 'includes/database.php');
require_once(DIR_SYSTEM . 'includes/settings.php');

$directory = HTTP_USERFILES.'userfiles/';

if (isset($_GET['field'])) {
	$field = $_GET['field'];
} else {
	$field = '';
}

if (isset($_GET['CKEditorFuncNum'])) {
	$fckeditor = TRUE;
} else {
	$fckeditor = FALSE;
}
?>
<?php echo '<?php xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en" xml:lang="en">
<head>
<title><?php echo $title; ?></title>
<base href="<?=SITEURL?><?=ADMIN_PATH?>/" />
<link rel="stylesheet" type="text/css" href="js/jquery/ui/themes/ui-lightness/ui.all.css" />
	<script type="text/javascript" src="js/jquery/jquery-1.5.1.min.js"></script>
	<script type="text/javascript" src="js/jquery/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="js/jquery/jstree/jquery.tree.min.js"></script>
<script type="text/javascript" src="js/jquery/ajaxupload.js"></script>

<style type="text/css">
body {
	padding: 0;
	margin: 0;
	background: #F7F7F7;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
img {
	border: 0;
}
#container {
	padding: 0px 10px 7px 10px;
	height: 340px;
}
#menu {
	clear: both;
	height: 29px;
	margin-bottom: 3px;
}
#column_left {
	background: #FFF;
	border: 1px solid #CCC;
	float: left;
	width: 20%;
	height: 320px;
	overflow: auto;
}
#column_right {
	background: #FFF;
	border: 1px solid #CCC;
	float: right;
	width: 78%;
	height: 320px;
	overflow: auto;
	text-align: center;
}
#column_right div {
	text-align: left;
	padding: 5px;
}
#column_right a {
	display: inline-block;
	text-align: center;
	border: 1px solid #EEEEEE;
	cursor: pointer;
	margin: 5px;
	padding: 5px;
}
#column_right a.selected {
	border: 1px solid #7DA2CE;
	background: #EBF4FD;
}
#column_right input {
	display: none;
}
#dialog {
	display: none;
}
.button {
	display: block;
	float: left;
	padding: 8px 5px 8px 25px;
	margin-right: 5px;
	background-position: 5px 6px;
	background-repeat: no-repeat;
	cursor: pointer;
}
.button:hover {
	background-color: #EEEEEE;
}
.thumb {
	padding: 5px;
	width: 105px;
	height: 105px;
	background: #F7F7F7;
	border: 1px solid #CCCCCC;
	cursor: pointer;
	cursor: move;
	position: relative;
}
</style>
</head>
<body>
<div id="container">
  <div id="menu"><a id="create" class="button" style="background-image: url('images/filemanager/folder.png');">Nieuw map</a><a id="delete" class="button" style="background-image: url('images/filemanager/edit-delete.png');">Verwijderen</a><a id="move" class="button" style="background-image: url('images/filemanager/edit-cut.png');">Verplaatsen</a><a id="copy" class="button" style="background-image: url('images/filemanager/edit-copy.png');">Kopieren</a><a id="rename" class="button" style="background-image: url('images/filemanager/edit-rename.png');">Hernoemen</a><a id="upload" class="button" style="background-image: url('images/filemanager/upload.png');">Toevoegen</a><a id="refresh" class="button" style="background-image: url('images/filemanager/refresh.png');">Verversen</a></div>
  <div id="column_left"></div>
  <div id="column_right"></div>
</div>
<script type="text/javascript"><!--
$(document).ready(function () { 
	$('#column_left').tree({
		data: { 
			type: 'json',
			async: true, 
			opts: { 
				method: 'POST', 
				url: 'includes/browse.php?directory=true'
			} 
		},
		selected: 'top',
		ui: {		
			theme_name: 'classic',
			animation: 700
		},	
		types: { 
			'default': {
				clickable: true,
				creatable: false,
				renameable: false,
				deletable: false,
				draggable: false,
				max_children: -1,
				max_depth: -1,
				valid_children: 'all'
			}
		},
		callback: {
			beforedata: function(NODE, TREE_OBJ) { 
				if (NODE == false) {
					TREE_OBJ.settings.data.opts.static = [ 
						{
							data: 'image',
							attributes: { 
								'id': 'top',
								'directory': ''
							}, 
							state: 'closed'
						}
					];
					
					return { 'directory': '' } 
				} else {
					TREE_OBJ.settings.data.opts.static = false;  
					
					return { 'directory': $(NODE).attr('directory') } 
				}
			},		
			onselect: function (NODE, TREE_OBJ) {
				$.ajax({
					url: 'includes/browse.php?files=true',
					type: 'POST',
					data: 'directory=' + encodeURIComponent($(NODE).attr('directory')),
					dataType: 'json',
					success: function(json) {
						var html = '<div>';
						
						if (json) {
							for (i = 0; i < json.length; i++) {

								if(json[i]['filename'] == undefined) {
									continue;
								}
								name = '';
								
								filename = json[i]['filename'];
								
								for (j = 0; j < filename.length; j = j + 15) {
									name += filename.substr(j, 15) + '<br />';
								}
								
								name += json[i]['size'];
								
								html += '<a file="' + json[i]['file'] + '"><img src="' + json[i]['thumb'] + '" title="' + json[i]['filename'] + '" /><br />' + name + '</a>';
							}
						}
						
						html += '</div>';
						
						$('#column_right').html(html);
					}
				});
			}
		}
	});	
	
	$('#column_right a').live('click', function () {
		if ($(this).attr('class') == 'selected') {
			$(this).removeAttr('class');
		} else {
			$('#column_right a').removeAttr('class');
			
			$(this).attr('class', 'selected');
		}
	});
	
	$('#column_right a').live('dblclick', function () {
		<?php if ($fckeditor) { ?>
		window.opener.CKEDITOR.tools.callFunction(<?=$_GET['CKEditorFuncNum']?>, '<?php echo $directory; ?>' + $(this).attr('file'));
		
		self.close();	
		<?php } else { ?>
		parent.$('#<?php echo $field; ?>').attr('value', '' + $(this).attr('file'));
		parent.$('#dialog').dialog('close');
		
		parent.$('#dialog').remove();	
		<?php } ?>
	});		
						
	$('#create').bind('click', function () {
		var tree = $.tree.focused();
		
		if (tree.selected) {
			$('#dialog').remove();
			
			html  = '<div id="dialog">';
			html += '<?php echo $entry_folder; ?> <input type="text" name="name" value="" /> <input type="button" value="Submit" />';
			html += '</div>';
			
			$('#column_right').prepend(html);
			
			$('#dialog').dialog({
				title: '<?php echo $button_folder; ?>',
				resizable: false
			});	
			
			$('#dialog input[type=\'button\']').bind('click', function () {
				$.ajax({
					url: 'includes/browse.php?create=true',
					type: 'POST',
					data: 'directory=' + encodeURIComponent($(tree.selected).attr('directory')) + '&name=' + encodeURIComponent($('#dialog input[name=\'name\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
							
							tree.refresh(tree.selected);
							
							alert(json.success);
						} else {
							alert(json.error);
						}
					}
				});
			});
		} else {
			alert('<?php echo $error_directory; ?>');	
		}
	});
	
	$('#delete').bind('click', function () {
		path = $('#column_right a.selected').attr('file');
							 
		if (path) {
			$.ajax({
				url: 'includes/browse.php?delete=true',
				type: 'POST',
				data: 'path=' + path,
				dataType: 'json',
				success: function(json) {
					if (json.success) {
						var tree = $.tree.focused();
					
						tree.select_branch(tree.selected);
						
						alert(json.success);
					}
					
					if (json.error) {
						alert(json.error);
					}
				}
			});				
		} else {
			var tree = $.tree.focused();
			
			if (tree.selected) {
				$.ajax({
					url: 'includes/browse.php?delete=true',
					type: 'POST',
					data: 'path=' + encodeURIComponent($(tree.selected).attr('directory')),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							tree.select_branch(tree.parent(tree.selected));
							
							tree.refresh(tree.selected);
							
							alert(json.success);
						} 
						
						if (json.error) {
							alert(json.error);
						}
					}
				});			
			} else {
				alert('<?php echo $error_select; ?>');
			}			
		}
	});
	
	$('#move').bind('click', function () {
		$('#dialog').remove();
		
		html  = '<div id="dialog">';
		html += '<?php echo $entry_move; ?> <select name="to"></select> <input type="button" value="Submit" />';
		html += '</div>';

		$('#column_right').prepend(html);
		
		$('#dialog').dialog({
			title: '<?php echo $button_move; ?>',
			resizable: false
		});

		$('#dialog select[name=\'to\']').load('includes/browse.php?folders=true');
		
		$('#dialog input[type=\'button\']').bind('click', function () {
			path = $('#column_right a.selected').attr('file');
							 
			if (path) {																
				$.ajax({
					url: 'includes/browse.php?move=true',
					type: 'POST',
					data: 'from=' + encodeURIComponent(path) + '&to=' + encodeURIComponent($('#dialog select[name=\'to\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
							
							var tree = $.tree.focused();
							
							tree.select_branch(tree.selected);
							
							alert(json.success);
						}
						
						if (json.error) {
							alert(json.error);
						}
					}
				});
			} else {
				var tree = $.tree.focused();
				
				$.ajax({
					url: 'includes/browse.php?move=true',
					type: 'POST',
					data: 'from=' + encodeURIComponent($(tree.selected).attr('directory')) + '&to=' + encodeURIComponent($('#dialog select[name=\'to\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
							
							tree.select_branch('#top');
								
							tree.refresh(tree.selected);
							
							alert(json.success);
						}						
						
						if (json.error) {
							alert(json.error);
						}
					}
				});				
			}
		});
	});

	$('#copy').bind('click', function () {
		$('#dialog').remove();
		
		html  = '<div id="dialog">';
		html += '<?php echo $entry_copy; ?> <input type="text" name="name" value="" /> <input type="button" value="Submit" />';
		html += '</div>';

		$('#column_right').prepend(html);
		
		$('#dialog').dialog({
			title: '<?php echo $button_copy; ?>',
			resizable: false
		});
		
		$('#dialog select[name=\'to\']').load('includes/browse.php?folders=true');
		
		$('#dialog input[type=\'button\']').bind('click', function () {
			path = $('#column_right a.selected').attr('file');
							 
			if (path) {																
				$.ajax({
					url: 'includes/browse.php?copy=true',
					type: 'POST',
					data: 'path=' + encodeURIComponent(path) + '&name=' + encodeURIComponent($('#dialog input[name=\'name\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
							
							var tree = $.tree.focused();
							
							tree.select_branch(tree.selected);
							
							alert(json.success);
						}						
						
						if (json.error) {
							alert(json.error);
						}
					}
				});
			} else {
				var tree = $.tree.focused();
				
				$.ajax({
					url: 'includes/browse.php?copy=true',
					type: 'POST',
					data: 'path=' + encodeURIComponent($(tree.selected).attr('directory')) + '&name=' + encodeURIComponent($('#dialog input[name=\'name\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
							
							tree.select_branch(tree.parent(tree.selected));
							
							tree.refresh(tree.selected);
							
							alert(json.success);
						} 						
						
						if (json.error) {
							alert(json.error);
						}
					}
				});				
			}
		});	
	});
	
	$('#rename').bind('click', function () {
		$('#dialog').remove();
		
		html  = '<div id="dialog">';
		html += '<?php echo $entry_rename; ?> <input type="text" name="name" value="" /> <input type="button" value="Submit" />';
		html += '</div>';

		$('#column_right').prepend(html);
		
		$('#dialog').dialog({
			title: '<?php echo $button_rename; ?>',
			resizable: false
		});
		
		$('#dialog input[type=\'button\']').bind('click', function () {
			path = $('#column_right a.selected').attr('file');
							 
			if (path) {		
				$.ajax({
					url: 'includes/browse.php?rename=true',
					type: 'POST',
					data: 'path=' + encodeURIComponent(path) + '&name=' + encodeURIComponent($('#dialog input[name=\'name\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
							
							var tree = $.tree.focused();
					
							tree.select_branch(tree.selected);
							
							alert(json.success);
						} 
						
						if (json.error) {
							alert(json.error);
						}
					}
				});			
			} else {
				var tree = $.tree.focused();
				
				$.ajax({ 
					url: 'includes/browse.php?rename=true',
					type: 'POST',
					data: 'path=' + encodeURIComponent($(tree.selected).attr('directory')) + '&name=' + encodeURIComponent($('#dialog input[name=\'name\']').val()),
					dataType: 'json',
					success: function(json) {
						if (json.success) {
							$('#dialog').remove();
								
							tree.select_branch(tree.parent(tree.selected));
							
							tree.refresh(tree.selected);
							
							alert(json.success);
						} 
						
						if (json.error) {
							alert(json.error);
						}
					}
				});
			}
		});		
	});
	
	new AjaxUpload('#upload', {
		action: 'includes/browse.php?upload=true',
		name: 'image',
		autoSubmit: false,
		responseType: 'json',
		onChange: function(file, extension) {
			var tree = $.tree.focused();
			
			if (tree.selected) {
				this.setData({'directory': $(tree.selected).attr('directory')});
			} else {
				this.setData({'directory': ''});
			}
			
			this.submit();
		},
		onSubmit: function(file, extension) {
			$('#upload').append('<img src="images/loading.gif" id="loading" style="padding-left: 5px;" />');
		},
		onComplete: function(file, json) {
			if (json.success) {
				var tree = $.tree.focused();
					
				tree.select_branch(tree.selected);
				
				alert(json.success);
			}
			
			if (json.error) {
				alert(json.error);
			}
			
			$('#loading').remove();	
		}
	});
	
	$('#refresh').bind('click', function () {
		var tree = $.tree.focused();
		
		tree.refresh(tree.selected);
	});	
});
//--></script>
</body>
</html>