<?php
    //防跳墙
    function session_check()
    {
    	if (!isset($_SESSION['username'])) {
    		header('Location:'.site_url("Login"));
    	}
    }
?>