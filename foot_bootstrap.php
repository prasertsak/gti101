<!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
	<script src="../vendor/color-picker/bootstrap.colorpickersliders.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

	<!-- Bootbox plugin JavaScript -->
    <script src="../dist/js/bootbox.min.js"></script>

   <!-- Toggle switch JavaScript -->
	<script src="../vendor/bootstrap-toggle/js/bootstrap-toggle.js"></script>

	 <!-- bootstrap switch JavaScript -->
	<script src="../vendor/bootstrap-switch/dist/js/bootstrap-switch.js"></script>

	<!-- bootstrap bootstrap-calendar -->
	<script src="../vendor/bootstrap-year-calendar/js/bootstrap-year-calendar.min.js"></script>

	<!-- bootstrap-datepicker JavaScript -->
	<script src="../vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker-custom.js"></script>
	<script src="../vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>
	<script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
               // format: 'dd/mm/yyyy',
			    format: 'yyyy/mm/dd',
				daysOfWeekDisabled: "0,2,3,4,5,6",
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
        });
    </script>
	<script>
        $(document).ready(function () {
            $('.datepicker2').datepicker({
               // format: 'dd/mm/yyyy',
			    format: 'yyyy/mm/dd',
				//daysOfWeekDisabled: "0,2,3,4,5,6",
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
        });
    </script>

    <script>
        $(document).on("click", ".alert", function(e) {
            bootbox.alert("Hello world!", function() {
                console.log("Alert Callback");
            });
        });

		$(document).on("click", ".confirm", function(e) {
            bootbox.confirm("ต้องการลบข้อมูล?", function(x) {
                console.log("Alert Callback"+ x);
            });
        });
    </script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        //$('.datatable').dataTable();
		$('.datatable2').dataTable();
		
		$("input").not('input[type=submit]').addClass('form-control');

		$('.edit-position').click(function(){				
			// get data from edit btn
			var position_id = $(this).attr('data-position_id');
			var position_name = $(this).attr('data-position_name');
			var color = $(this).attr('data-color');	
			// set value to modal
			$('#position_id').val(position_id);
			$('#position_name').val(position_name);
			$('#pcolor').val(color);	
			//show form
			$('#formEditPosition').modal('show');
		});

		$('.add-position').click(function(){							
			//show form
			$('#formAddPosition').modal('show');
		});

		$('.edit-group').click(function(){				
			// get data from edit btn
			var depgroup_id = $(this).attr('data-depgroup_id');
			var depgroup_name = $(this).attr('data-depgroup_name');
			var link = $(this).attr('data-link');	
			var show = $(this).attr('data-show');	
			// set value to modal
			$('#depgroup_id').val(depgroup_id);
			$('#depgroup_name').val(depgroup_name);
			$('#link').val(link);	
			$('#show').val(show);	
			//show form
			$('#formEditGroup').modal('show');
		});

		$('.add-group').click(function(){							
			//show form
			$('#formAddGroup').modal('show');
		});

		$('.edit-system').click(function(){				
			// get data from edit btn

			//menu_id	menu_name	menu_link	menu_icon	menu_show
			var menu_id = $(this).attr('data-menu_id');
			var menu_name = $(this).attr('data-menu_name');
			var menu_link = $(this).attr('data-menu_link');	
			var menu_icon = $(this).attr('data-menu_icon');	
			var menu_show = $(this).attr('data-menu_show');	
			// set value to modal
			$('#menu_id').val(menu_id);
			$('#menu_name').val(menu_name);
			$('#menu_link').val(menu_link);	
			$('#menu_icon').val(menu_icon);	
			$('#menu_show').val(menu_show);	
			//show form
			$('#formEditSystem').modal('show');
		});

		$('.add-system').click(function(){							
			//show form
			$('#formAddSystem').modal('show');
		});

		$('.permit-position').click(function(){				
			// get data from edit btn
			
			//show form
			$('#formEditPermit').modal('show');
		});

		$('.edit-name').click(function(){				
			// get data from edit btn

			//menu_id	menu_name	menu_link	menu_icon	menu_show
			var pin_id = $(this).attr('data-pin_id');
			var user_name = $(this).attr('data-user_name');
			var user_password = $(this).attr('data-user_password');	
			var prename = $(this).attr('data-prename');	
			var fname = $(this).attr('data-fname');	
			var lname = $(this).attr('data-lname');	
			var birth = $(this).attr('data-birth');	
			// set value to modal
			$('#pin_id').val(pin_id);
			$('#user_name').val(user_name);
			$('#user_password').val(user_password);	
			$('#prename').val(prename);	
			$('#fname').val(fname);	
			$('#lname').val(lname);	
			$('#birth').val(birth);	
			//show form
			$('#formEditName').modal('show');
		});

		$('.add-name').click(function(){							
			//show form
			$('#formAddName').modal('show');
		});	
		
		$('.add-term').click(function(){							
			//show form
			$('#formAddTerm').modal('show');
		});	

		$('.add-project').click(function(){							
			//show form
			$('#formAddProject').modal('show');
		});
		
		$('.edit-project').click(function(){				
			// get data from edit btn
			var pt_ide = $(this).attr('data-pt_ide');
			var pt_namee = $(this).attr('data-pt_namee');
			var terme = $(this).attr('data-terme');	
			var date_starte = $(this).attr('data-date_starte');	
			var date_stope = $(this).attr('data-date_stope');				
			// set value to modal
			$('#pt_ide').val(pt_ide);
			$('#pt_namee').val(pt_namee);
			$('#terme').val(terme);	
			$('#date_starte').val(date_starte);	
			$('#date_stope').val(date_stope);				
			//show form
			$('#formEditProject').modal('show');
		});

		$('.updata-project').click(function(){					
			var pt_idu = $(this).attr('data-pt_idu');
			var pt_nameu = $(this).attr('data-pt_nameu');
			var termu = $(this).attr('data-termu');		
			var date_inu = $(this).attr('data-date_inu');	
			// set value to modal
			$('#pt_idu').val(pt_idu);
			$('#pt_nameu').val(pt_nameu);
			$('#termu').val(termu);				
			$('#date_inu').val(date_inu);
			//show form
			$('#formUpdata').modal('show');
		});

		
	});
    </script>
  
<script>
$(function() {
    var header_height = 0;
    $('table th span').each(function() {
        if ($(this).outerWidth() > header_height) header_height = $(this).outerWidth();
    });

    $('table th').height(header_height);
});
 </script>