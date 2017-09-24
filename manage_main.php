<?
 session_start();
 include("config.php");
 include("set_bootstrap.php");
 include("check_session.php");
?>

<body>

    <div id="wrapper">
        <? 
			include("manage_nav.php");
			?>
        <div id="page-wrapper">
		<? 
		include("manage_show_link.php");
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
