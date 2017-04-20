<?php
	$conn=new PDO('mysql:host=localhost;dbname=monsters','monsters','university');
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    /*** echo a message saying we have connected ***/
    
?>
