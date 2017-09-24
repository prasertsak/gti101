<?
 session_start();
 include("config.php");
 include("set_bootstrap.php");
 include("check_session.php");
?>

<body>

    <div id="wrapper">
        <? 
			include("main_navigation.php");
			?>
        <div id="page-wrapper">
		<? 
		//include("dashboard1.php");
		include("main_show_link.php");
		
		    
            
			//include("page_header.php");

			//include("dashboard1.php");
			//include("dashboard2.php");
			?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<?
 include("foot_bootstrap.php");
?>


</body>

</html>
