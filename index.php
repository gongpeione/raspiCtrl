<?php
	
	//error_reporting(E_ALL);;

	include('config/config.php');

	$login = 0;
	if(!empty($_COOKIE["user"]) && !empty($_COOKIE["passwd"]))
    {
        if($_COOKIE["user"] == $user && $_COOKIE["passwd"] == $pass)
        {
            $login = 1;
        }
    }
    else
    {
        if(!empty($_POST['u']) && !empty($_POST['p']))
        {
            $userName = $_POST['u'];
            $passwd   = $_POST['p'];   
        }    

        if($userName == $user && md5($passwd) == $pass)
        {
            $login = 1;
            setcookie("user", "pi", time() + 3600);
            setcookie("passwd", md5($passwd), time() + 3600);
        }
        else
        {
            $login = 0;
        }
    }
	

	require_once('html/header.php');

	if(!$login) 
	{ 
		require_once('html/login.php'); 
	} 
	else 
	{
		require_once('html/home.php'); 
	}

	require_once('html/footer.php');