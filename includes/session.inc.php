<?php
// session.inc.php
//ini_set('session.save_path', '/tmp');
//ini_set('session.name', 'hash'); # try to hide the session name..
if (!isset($_SESSION['ip']))
  $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
if ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR'])
@trigger_error("Session Hijacking detected!", E_USER_WARNING);
?>