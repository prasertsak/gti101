<?
 include("config.php");
 include("set_bootstrap.php");
 $error = $_REQUEST[error];
?>
สวัสดีครับ
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
		          <div class="login-panel panel panel-default">        				
						<div class="panel-body">
							<h3><p class="text-center"><? echo $system_name;?></p></h3>
								<p class="text-center"><? echo $school_name;?>
								<img src="images/logo_pijit.png"/></p>
								<div class="mx-auto d-block">					
								
					<?
					if($error==1){
					?>
					<div class="alert alert-danger alert-dismissable">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          กรุณาตรวจสอบ ชื่อผู้ใช้งานและรหัสผ่าน 
                    </div>
					<? } ?>
					<?
					if($error==2){
					?>
					<div class="alert alert-danger alert-dismissable">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          กรุณาเข้าสู่ระบบ 
                    </div>
					<? } ?>
                        <form role="form" method="POST" action="check_login.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="ชื่อผู้ใช้งาน" name="userlogin" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="รหัสผ่าน" name="password" type="password" value="">
                                </div>
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <input   class="btn btn-lg btn-success btn-block" type="submit" value="เข้าสู่ระบบ">
                            </fieldset>
                        </form>
					
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
