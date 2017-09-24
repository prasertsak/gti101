<?
session_start();	
require_once('check_session.php');
require_once('config.php');
require_once('top.php');
require_once('head.php');
require_once('menu.php');
//require_once('config.php');

$namex = $_REQUEST[namex];
$user_loginx = $_REQUEST[user_loginx];
$passx = $_REQUEST[passx];
$u_idx = $_REQUEST[u_idx];
$act = $_REQUEST[act];
$mcount = $_REQUEST[mcount];
$me = $_REQUEST[me];
//echo $namex."-namex<br>";
//echo $user_loginx."-user_loginx<br>";
//echo $passx."-passx<br>";
//echo $u_idx."-u_idx<br>";

mysql_query("Set names tis620"); 
mysql_query("SET CHARACTER SET tis620");
mysql_query("SET collation_connection = tis620_thai_ci");

if(($act == "del") && (!empty($u_idx)))
{
	$sql = "delete from user where user_id ='$u_idx' ";
	$dbquery = mysql_db_query($db_qa, $sql);
}

if(($act == "add")&&(!empty($namex))&&(!empty($user_loginx))&&(!empty($passx)))
{
	////user_id	user_login	password user_name	
	$sql = "select * from user order by  user_id DESC";
	$db_query = mysql_db_query($db_qa, $sql); 
	$result = mysql_fetch_array($db_query);
	$new_id =  $result["user_id"]+1;
	//user_id	user_login	password	fname	lname	school_name	level_id	permit_id	confirm_id
	$sql1= "INSERT INTO user (user_id,user_login,password,user_name) VALUES ('$new_id','$user_loginx','$passx','$namex') "; 
	//echo $sql1."<br>";
	$dbquery1 = mysql_db_query($db_qa, $sql1);
}
if(($act == "save")&&(!empty($u_idx))&&(!empty($namex))&&(!empty($user_loginx))&&(!empty($passx)))
{
	//user_id	user_login	password	fname	lname	school_name	level_id	permit_id	confirm_id
	$sql1= "UPDATE  `user` SET  `user_login` =  '$user_loginx',`password` =  '$passx',`user_name` =  '$namex' WHERE  `user_id` ='$u_idx' LIMIT 1 ;";
	$dbquery1 = mysql_db_query($db_qa, $sql1);
}
if(($act == "psave")&&(!empty($u_idx)))
{
	//user_id	user_login	password	fname	lname	school_name	level_id	permit_id	confirm_id
	$sql1= "delete from permission where user_id='$u_idx' ;";
	$dbquery1 = mysql_db_query($db_qa, $sql1);
	for($m=1;$m <=$mcount;$m++)
	{
		if(!empty($me[$m]))
		{
			$sql1= "INSERT INTO permission (user_id,menu_id) VALUES ('$u_idx','$me[$m]') "; 
			//echo $sql1."<br>";
			$dbquery1 = mysql_db_query($db_qa, $sql1);
		}
	}
}

?><body>
<div class="jumbotron"  style="background-color:#ffccff">

<center>
<img src="images/personal1.png" border="0" width="30">
<b><a href="?m_id=<? echo $m_id;?>">จัดการข้อมูลผู้ใช้งาน</a></b><br><br>
<?
if($act=="permit")
{
?>
<b>จัดการสิทธิ์</b><br><br>
	<table  class="table table-hover">
	<tr bgcolor="#ff99cc">	<td align="center"><b>
	ลำดับ</td>
	<td align="center"><b>
	ชื่อผู้ใช้</td>
	<td align="center"><b>
	รหัส Login</td>
	<td align="center"><b>
	รหัสผ่าน</td>
	</tr>
	<?
	//user_id	user_login	password	fname	lname	school_name	level_id	permit_id	confirm_id
	$sql = "select * from user where user_id='$u_idx' ";
	$db_query = mysql_db_query($db_qa, $sql); 
	$num_rows = mysql_num_rows($db_query);
	//echo $sql."<br>";
	//echo $num_rows."<br>";
	$a = 0;
	while($result = mysql_fetch_array($db_query))
	{
		$a++;
		$user_id =  $result["user_id"];
		$user_login =  $result["user_login"];
		$password =  $result["password"];	
		$name =  $result["user_name"];
		?>
		<tr  bgcolor="#ffffff">
		<td align="center">
		<? echo $a ?></td>
		<td align="left">
		<? echo  $name ?></td>
		<td align="center">
		<? echo  $user_login ?></td>
		<td align="center">
		<? echo  $password ?></td>	
		</tr>
		<?
		
	}
	?>
	</table>
	<br><b>
	เลือกสิทธิ์การเข้าใช้ระบบ<br>
	<table>
		<tr>
			<td>รายการ</td>
			<td>เลือก</td>
		</tr>
		<?
		$sql = "select * from menu order by menu_id ";
		$db_query = mysql_db_query($db_qa, $sql); 
		$num_rows = mysql_num_rows($db_query);
		//echo $sql."<br>";
		//echo $num_rows."<br>";
		$a = 0;
		?>
		<form>
		<?
		while($result = mysql_fetch_array($db_query))
		{
			$a++;
			$menu_name =  $result["menu_name"];
			$menu_id =  $result["menu_id"];

			$sql3 = "select * from permission where user_id='$u_idx' and menu_id='$menu_id' ";
			//echo $sql3."=<br>";
			$db_query3 = mysql_db_query($db_qa, $sql3); 
			$num_rows3 = mysql_num_rows($db_query3);
			//echo $num_rows3."-<br>";
			if(!empty($num_rows3))
			{
				$show="checked";
			}
			else
			{
				$show="";
			}
			?>
			<tr>
				<td><? echo $menu_name;?></td>
				<td align="center"><input type="checkbox" name="me[<? echo $a;?>]" value="<? echo $menu_id;?>" <? echo $show;?>></td>
			</tr>
			<?
		}
		?>
	</table>
	<input type="hidden" name="act" value="psave">
	<input type="hidden" name="u_idx" value="<? echo $u_idx;?>">
	<input type="hidden" name="mcount" value="<? echo $a;?>">
	<input type="submit" value="บันทึก">
	</form>
	</div>
	<?

}
else
{
	?>
	<table  class="table table-hover">
	<tr bgcolor="#ff99cc">	<td align="center"><b>
	ลำดับ</td>
	<td align="center"><b>
	ชื่อผู้ใช้</td>
	<td align="center"><b>
	รหัส Login</td>
	<td align="center"><b>
	รหัสผ่าน</td>
	<td align="center"><b>
	กระทำ</td></tr>
	<?
	//user_id	user_login	password	fname	lname	school_name	level_id	permit_id	confirm_id
	$sql = "select * from user order by  user_id ";
	$db_query = mysql_db_query($db_qa, $sql); 
	$num_rows = mysql_num_rows($db_query);
	//echo $sql."<br>";
	//echo $num_rows."<br>";
	$a = 0;
	while($result = mysql_fetch_array($db_query))
	{
		$a++;
		$user_id =  $result["user_id"];
		$user_login =  $result["user_login"];
		$password =  $result["password"];	
		$name =  $result["user_name"];

		$sql3 = "select * from permission where user_id='$user_id' ";
		//echo $sql3."=<br>";
		$db_query3 = mysql_db_query($db_qa, $sql3); 
		$num_rows3 = mysql_num_rows($db_query3);
		if($act == "edit" && $user_id==$u_idx)
		{	
		?>
		<form name="form1" enctype="multipart/form-data" method="post" action="manage_user.php">

		<tr  bgcolor="#ffffff">
		<td align="center">
		<? echo $a ?></td>
		<td align="left">
		<input type="text" name="namex" size="12" value="<? echo $name ?>" ></td>
		<td align="center">
		<input type="text" name="user_loginx" size="12" value="<? echo $user_login ?>"></td>
		<td align="center">
		<input type="text" name="passx" size="12" value="<? echo $password ?>"></td>		
		<td align="center">	
		<input type="submit" name="Submit" value="บันทึก">
		<input type="hidden" name="act" value="save">
		<input type="hidden" name="u_idx" value="<? echo $user_id; ?>">
		<input type="hidden" name="m_id" value="<? echo $m_id; ?>">
		</form>

		</td>	
		</tr>
		<? 
		}
		else
		{	
		?>

		<tr  bgcolor="#ffffff">
		<td align="center">
		<? echo $a ?></td>
		<td align="left">
		<? echo  $name ?></td>
		<td align="center">
		<? echo  $user_login ?></td>
		<td align="center">
		<? echo  $password ?></td>			
		<td align="center">
		<a href="?act=permit&m_id=<? echo $m_id;?>&u_idx=<? echo  $user_id ; ?>">กำหนดสิทธิ์(<? echo $num_rows3;?>)<a> &nbsp;
		<a href="?act=edit&m_id=<? echo $m_id;?>&u_idx=<? echo  $user_id ; ?>">แก้ไข</a> &nbsp;
		<script language="JavaScript">
			function Confxx(object) {
			if (confirm("ยืนยันการลบข้อมูล ") ==true)
				return true;
			else
				return false;	
			}
		</script>
		<a href="?act=del&u_idx=<? echo  $user_id ; ?>" onClick="return Confxx(this)">ลบ</a></td>	
		</tr>
		<? 
		}
		
	}
	?>
	<tr>	<td align="center">-</td>
	<form name="form1" enctype="multipart/form-data" method="post" action="manage_user.php">
	<td align="center">	
	<input type="text" name="namex" size="12">
	<td align="center">	
	<input type="text" name="user_loginx" size="12"></td>
	<td align="center">	
	<input type="text" name="passx" size="12"></td>
	<td>
	<input type="submit" name="Submit" value="เพิ่มข้อมูล">
	<input type="hidden" name="act" value="add">
	</form></td></tr>
	</table>
	
	</div>
	<?
}
require_once('footer.php');
mysql_close();
?>

