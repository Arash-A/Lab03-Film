<?php
session_start ();
require_once ("../BD/param.php");
require_once("../BD/connexion.inc.php");

$_SESSION['login']=="";
session_unset();

?>
<script language="javascript">
document.location="../index.php";
</script>