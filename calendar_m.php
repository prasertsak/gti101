<?
 session_start();
 include("config.php");
 include("set_bootstrap.php");
 include("check_session.php");
?>
		<!-- 
th { font-size:12pt; 
line-height:14pt; 
font-family:Helvetica,Arial; 
} 
//--> 
</style> 
<?
$year=2017; 
?>

<table class="table" border='0' width='300'>
<tr><td>
<? 
for($month=1;$month<13;$month++) { 
	?>
	<div class="col-md-4">
	<table class="table"  border='1' width="200">
	<tr><th colspan='7'><? echo date("F",mktime(0,0,0,$month,1,$year));?></th></tr>
	<tr><th>อา.</th><th>จ.</th><th>อ.</th><th>พ.</th><th>พฤ.</th><th>ศ.</th><th>ส.</th></tr>
	<?
	$fdom=date("w",mktime(0,0,0,$month,1,$year)); 
	$ct=0; 
	for($row=1;$row<7;$row++) 
	{ 
		echo "<tr>";
		for($week=1;$week<8;$week++) 
		{ 
			$ct++; 
			$value=mktime(0,0,0,$month,$ct-$fdom,$year); 
			if (date("m",$value)==$month) 
			{ 
				?>
				<th><? echo date("d",$value);?> 
				<?
			} 
			else { ?><td></td><? } 
		} 
		?></tr><?
	} 
	?><tr><td colspan='7'><br><br></td></tr></table>
	</div>
	<?
} 
?>

</td></tr>
<table>
<div class="calendar-demo">
</div>
<?

 include("foot_bootstrap.php");
?>


</body>

</html>
