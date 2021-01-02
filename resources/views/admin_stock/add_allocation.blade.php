@extends('layouts.master')
@section('header_styles')
 <!-- Bootstrap select -->
  <link rel="stylesheet" href="{{asset('assets/assets/vendor_components/bootstrap-select/dist/css/bootstrap-select.css')}}">
  <link rel="stylesheet" href="{{asset('assets/assets/vendor_components/select2/dist/css/select2.min.css')}}">
<!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('assets/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.css')}}">

  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('assets/assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('assets/assets/vendor_plugins/iCheck/all.css')}}">

  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('assets/assets/vendor_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">

  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('assets/assets/vendor_plugins/timepicker/bootstrap-timepicker.min.css')}}">



  <!-- Bootstrap tagsinput -->
  <link rel="stylesheet" href="{{asset('assets/assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}">

  <!-- Bootstrap touchspin -->
  <link rel="stylesheet" href="{{asset('assets/assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css')}}">


    <link rel="stylesheet" href="{{asset('assets/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css')}}">
 <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/css/master_style.css')}}">
@stop
@section('content')

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Ownership  &nbsp;
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i> Dashboard</a></li>

        <li class="breadcrumb-item active"> Assign Ownership</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	  <div class="row">
    <div class="col-lg-12 col-12">
        <div class="box box-solid bg-gray">
        <div class="box-header with-border">
          <h4 class="box-title">{{$product_name}} / Assign Ownership</h4>
          <ul class="box-controls pull-right">
            <li><a class="box-btn-fullscreen" href="#"></a></li>
          </ul>
        </div>

						<!-- Step 1 -->

						<form id="add_development_plan" name="submit_form" onsubmit="return validate_form ();" action="<?= URL('admin-submit-assign-ownership')?>"
						method="post" class="needs-validation" novalidate enctype="multipart/form-data">
						<!-- Step 1 -->
						@csrf
						@include('admin_stock/form_allocation')
					</form>




			</div>
		  </div>
      <!-- /.row -->
	  </div>
    </section>
    <!-- /.content -->
  </div>
                 <!-- Modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Allocate Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">

			  </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
@stop

@section('footer_scripts')

 <script src="{{asset('assets/assets/vendor_components/select2/dist/js/select2.full.js')}}"></script>
 <!-- date-range-picker -->
  <script src="{{asset('assets/assets/vendor_components/moment/min/moment.min.js')}}"></script>

  <!-- iCheck 1.0.1 -->
  <script src="{{asset('assets/assets/vendor_plugins/iCheck/icheck.min.js')}}"></script>

  <!-- SoftPro admin for advanced form element -->
  <script src="{{asset('assets/js/pages/advanced-form-element.js')}}"></script>

  <!-- Bootstrap Select -->
  <script src="{{asset('assets/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>


  <!-- Bootstrap tagsinput -->
  <script src="{{asset('assets/assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')}}"></script>

  <!-- Bootstrap touchspin -->
  <script src="{{asset('assets/assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}"></script>





  <!-- InputMask -->
  <script src="{{asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.js')}}"></script>
  <script src="{{asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
  <script src="{{asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>

  <script src="{{asset('assets/assets/vendor_components/datatable/datatables.js')}}"></script>
<script src="{{asset('assets/js/pages/project-table.js')}}"></script>

		<!-- This is data table -->
    <script src="{{asset('assets/vendor_components/datatable/datatables.min.js')}}"></script>

	<!-- SoftPro admin for Data Table -->

	<script src="{{asset('assets/js/pages/data-table.js')}}"></script>

    <!-- Bootstrap WYSIHTML5 -->
  <script src="{{asset('assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>

 <?php

 $htmloption = '<option value="">Select</option>';
       foreach($userRole as $userRole){
          $htmloption .= '<option value="'.$userRole->id.'">'.$userRole->name.'</option>';
           }

 ?>

<script>
$('.select2').select2({ width: 'resolve' });
(function() {
	$('#Attributes').css('display','none');
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

</script>
<script type="text/javascript">

$('#datepicker').daterangepicker({
singleDatePicker: true,
autoUpdateInput: true,
defaultDate: new Date(),

});
 $('#datetimepicker3').daterangepicker({
	 singleDatePicker: true,
        timePicker: true,

        locale: {
            format: 'hh:mm A'
        }
    }, function (start, end, label) { //callback
        start_time = start.format('hh:mm A');
        end_time = end.format('hh:mm A');
        console.log(start_time, end_time);
    }).on('show.daterangepicker', function (ev, picker) {
        picker.container.find(".calendar-table").hide(); //Hide calendar
 });
/* //$( "#datepicker" ).datepicker();
 $("#datetimepicker3" ).daterangepicker({
      timePicker: true,
	 startDate: "07/01/2015",
    endDate: "07/15/2015",
  }, function (start_date) {
    $('#datetimepicker3').val(start_date.format('H:i:s'));
}); */
 $('#datetimepicker3').timepicker({
    showInputs: false
  });

  function open_modal(obj,varienceId,itemId,poDetailsId,po_id)
    {
      /*alert(varienceId);
		alert(itemId);
		alert(poDetailsId);
		alert(po_id); */
        $('.modal-body').empty();
       // $(obj).attr('data-target','#modal-'+id);
      //  $("#myModal").modal("show");

        $.ajax({
            url: '<?php echo URL("get-allocation-window"); ?>',
            method: "POST",
            dataType: 'html',
            data: {
				"itemId":itemId,
				"poDetailsId":poDetailsId,
				"po_id":po_id,
                "varienceId": varienceId,
                "_token": "{{ csrf_token() }}",

            },
            success: function(data) {
                console.log(data);
                $('.modal-body').append(data);
                $("#myModal").modal("show");


            }

        });

    }

	function get_role2(obj,incid,pid)
	{
		console.log($(obj).val()) ;

		var userid = $(obj).val();
		if($(obj).val() == 11)
		{
			$("#hide_locker_"+incid+'_'+pid).show() ;
		}
		else{
			$("#hide_locker_"+incid+'_'+pid).hide() ;
		}

		$.ajax({
            url: '<?php echo URL("get-role2"); ?>',
            method: "POST",
            dataType: 'html',
            data: {
				"value":$(obj).val(),
				"incid":incid,
				"pod_id":pid,
                "_token": "{{ csrf_token() }}",

            },
            success: function(data) {
                 console.log(data);
				var datahtml = JSON.parse(data).html ;
			var childid = JSON.parse(data).childid ;


			for(i=1;i<=6;i++)
			{
			$("#dynamo_dropdown_"+incid+'_'+pid+'_'+i).remove() ;
			}

			$("#role1_"+incid+'_'+pid).html(datahtml);


			if(userid == 20)
			{
				$("#role1_"+incid+'_'+pid).attr('usertype','mixit');
				$("#role1_"+incid+'_'+pid).attr('roleid',childid);
				$("#role1_"+incid+'_'+pid).attr('data-placeholder','select Mixit Managers');


				$("#role2_"+incid+'_'+pid).attr('multiple','multiple');
				//$("#role2_"+incid+'_'+pid).addClass('select2');

			}
			else if(userid == 5)
			{
				$("#role1_"+incid+'_'+pid).attr('usertype','marketing');
				$("#role1_"+incid+'_'+pid).attr('roleid',childid);
				$("#role1_"+incid+'_'+pid).attr('data-placeholder','select Brand');

				$("#role2_"+incid+'_'+pid).attr('multiple','multiple');
				//$("#role2_"+incid+'_'+pid).addClass('select2');
			}
			else if(userid == 15)
			{
				$("#role1_"+incid+'_'+pid).attr('usertype','field_marking');
				$("#role1_"+incid+'_'+pid).attr('roleid',childid);
				$("#role1_"+incid+'_'+pid).attr('data-placeholder','select Country');

				$("#role2_"+incid+'_'+pid).removeAttr('multiple','multiple');



			}
			else if(userid == 11)
			{
				$("#role1_"+incid+'_'+pid).attr('usertype','sales_ref');
				$("#role1_"+incid+'_'+pid).attr('roleid',childid);
				$("#role1_"+incid+'_'+pid).attr('data-placeholder','select Region');
				$("#role2_"+incid+'_'+pid).attr('multiple','multiple');
				//$("#role2_"+incid+'_'+pid).removeAttr('multiple','multiple');
				//$("#role2_"+incid+'_'+pid).removeClass('select2');

			}
			else{
			}
			$('.select2').select2({ width: 'resolve' });

            }

        });

	}

	function get_role3(obj,incid,pid)
	{
		var attrval = $("#role1_"+incid+'_'+pid).attr('usertype');
		var attrroleval = $("#role1_"+incid+'_'+pid).attr('roleid');
		//var dynamodropdownattrval = $("#role1_"+incid+'_'+pid).attr('dynamodropdownincid');

		var value = $("#role1_"+incid+'_'+pid).val();
		$.ajax({
            url: '<?php echo URL("get-role3"); ?>',
            method: "POST",
            dataType: 'html',
            data: {
				"value":value,
				"incid":incid,
				"pod_id":pid,
				"usertype":attrval,
				"roleid":attrroleval,

                "_token": "{{ csrf_token() }}",

            },
            success: function(data) {

				var datahtml = JSON.parse(data).html ;
			var childid = JSON.parse(data).childid ;

				 $("#role2_"+incid+'_'+pid).html(datahtml);


				 if(attrval == 'mixit')
			{
				$("#role2_"+incid+'_'+pid).attr('usertype','mixit');
				$("#role2_"+incid+'_'+pid).attr('roleid',childid);
			}
			else if(attrval == 'marketing')
			{
				$("#role2_"+incid+'_'+pid).attr('usertype','marketing');
				$("#role2_"+incid+'_'+pid).attr('roleid',childid);
			}
			else if(attrval == 'field_marking')
			{
				$("#role2_"+incid+'_'+pid).attr('usertype','field_marking');
				$("#role2_"+incid+'_'+pid).attr('roleid',childid);
				$("#role2_"+incid+'_'+pid).removeAttr('multiple','multiple');
				//$("#role2_"+incid+'_'+pid).removeClass('select2');
			}
			else if(attrval == 'sales_ref')
			{
				$("#role2_"+incid+'_'+pid).attr('usertype','sales_ref');
				$("#role2_"+incid+'_'+pid).attr('roleid',childid);
			}
			else{
			}






            }

        });
	}

	function get_role4(obj,incid,pid)
	{
		//console.log($(obj).val().length);

		var attrval = $(obj).attr('usertype');
		var attrroleval = $(obj).attr('roleid');
		var dynamodropdownattrval = $(obj).attr('dynamodropdownincid');
		var value = $(obj).val();

		$.ajax({
            url: '<?php echo URL("get-role4"); ?>',
            method: "POST",
            dataType: 'html',
            data: {
				"value":value,
				"incid":incid,
				"pod_id":pid,
				"usertype":attrval,
				"roleid":attrroleval,
				"dynamodropdownincid":dynamodropdownattrval,
                "_token": "{{ csrf_token() }}",

            },
            success: function(data) {
				var datahtml = JSON.parse(data).html ;
				var dynamoid = JSON.parse(data).dynamodropdownid ;
				var prevdynamoid = JSON.parse(data).prevdynamodropdownid ;
				var countnextdiv = JSON.parse(data).countnextdiv ;
				var childid = JSON.parse(data).childid ;

				//console.log(dynamoid);
				//console.log(prevdynamoid);
				//console.log(countnextdiv);

				 if(countnextdiv>0)
				 {
					 if($(obj).val().length ==1)
					 {
				 $('#dynamo_dropdown_'+incid+'_'+pid+'_'+dynamoid).remove();
				 $("#dynamo_dropdown_"+incid+'_'+pid+'_'+prevdynamoid).after('<div class="col-md-2" id="dynamo_dropdown_'+incid+'_'+pid+'_'+dynamoid+'"></div>');
					 }


				 }
				 else{


				 }
                // console.log(JSON.parse(data).datahtml);
				 $("#dynamo_dropdown_"+incid+'_'+pid+'_'+dynamoid).html(datahtml);
				 $("#dynamo"+dynamoid+"_"+incid+'_'+pid).attr('dynamodropdownincid',dynamoid);
				 //$("#dynamo_dropdown_"+incid+'_'+pid+'_'+prevdynamoid).after('<div class="col-md-2" id="dynamo_dropdown_'+incid+'_'+pid+'_'+dynamoid'"></div>');
				 //$("#dynamo_dropdown_"+incid+'_'+pid+'_'+prevdynamoid).remove() ;
				// $("#dynamo_dropdown_"+incid+'_'+pid+'_'+prevdynamoid).next().remove("#dynamo_dropdown_"+incid+'_'+pid+'_1') ;


				 if(attrval == 'mixit')
			{
				$("#dynamo"+dynamoid+"_"+incid+'_'+pid).attr('usertype','mixit');
				$("#dynamo"+dynamoid+"_"+incid+'_'+pid).attr('roleid',childid);

				$("#dynamoselectcount_"+incid+'_'+pid).val(dynamoid);



			}
			else if(attrval == 'marketing')
			{
				$("#dynamo"+dynamoid+"_"+incid+'_'+pid).attr('usertype','marketing');
				$("#dynamo"+dynamoid+"_"+incid+'_'+pid).attr('roleid',childid);
				$("#dynamoselectcount_"+incid+'_'+pid).val(dynamoid);
			}
			else if(attrval == 'field_marking')
			{
				$("#dynamo"+dynamoid+"_"+incid+'_'+pid).attr('usertype','field_marking');
				$("#dynamo"+dynamoid+"_"+incid+'_'+pid).attr('roleid',childid);
				$("#dynamoselectcount_"+incid+'_'+pid).val(dynamoid);
			}
			else if(attrval == 'sales_ref')
			{
				$("#dynamo"+dynamoid+"_"+incid+'_'+pid).attr('usertype','sales_ref');
				$("#dynamo"+dynamoid+"_"+incid+'_'+pid).attr('roleid',childid);
				$("#dynamoselectcount_"+incid+'_'+pid).val(dynamoid);
			}
			else{
			}
			$('.select2').select2({ width: 'resolve' });

            }



        });


	}

	function addmorerow(pid)
	{
		//alert(pid);
		var count = $("#countrow").val();
		var max_fields_1 = 10; //maximum input boxes allowed
        var wrapper_1 = $(".input_fields_wrap_1"); //Fields wrapper
        //var add_button_1 = $("#add_field_button_1_"+pid); //Add button ID
        var option_value_1 = '';
        //initlal text box count
        var extct = 0;
         //on add input button click
           // e.preventDefault();
            if (count < max_fields_1) { //max input box allowed

                console.log(count);
                $(wrapper_1).append('<div class="row add_1_' + count + '"><div class="col-md-2 add_1_' + count + '"><div class="input-group"><select  aria-controls="project-table" name="userrole1_'+count+'" id="role_'+count+'_'+pid+'" onchange=get_role2(this,'+count + ','+pid+') required class="form-control form-control-sm">'+'<?=$htmloption?>'+'</select></div></div><div class="col-md-2 add_1_' + count + '"><div class="form-group"><select name="userrole2_'+count+'[]" class="form-control select2" id="role1_'+count+'_'+pid+'" roleid="" usertype="" required onchange=get_role3(this,'+count + ','+pid+')  data-placeholder=""style="width: 100%;"></select></div></div><div class="col-md-2 add_1_' + count + '" id="dynamo_dropdown_'+count+'_'+pid+'_0"><div class="form-group"><select class="form-control select2" dynamodropdownincid="0" name="userrole3_'+count+'[]" usertype="" required roleid="" id="role2_'+count+'_'+pid+'" onchange=get_role4(this,'+count + ','+pid+')  data-placeholder=""style="width: 100%;"></select></div></div><div class="col-md-2 add_1_' + count + '"><div class="input-group"><div class="checkbox checkbox-success"  style="margin-right: 20px;" id="hide_locker_'+count + '_'+pid+'"><input id="checkbox3_'+count + '_'+pid+'" type="checkbox" name="storelocator_'+count + '" value="store" ><label for="checkbox3_'+count + '_'+pid+'"> Locker </label></div><div class="checkbox checkbox-success" ><input id="checkbox4_'+count + '_'+pid+'" type="checkbox" name="eachselectbox_'+count + '" value="each"><label for="checkbox4_'+count + '_'+pid+'"> Each </label></div></div></div><div class="col-md-2 add_1_' + count + '"><div class="form-group"><input type="number"  onblur="calculate_amount()" min="0" name="quantity_'+count+'" id="quantity_'+count+'_'+pid+'" required  class="form-control quantity" placeholder=""></div><input type="hidden" name="dynamoselectcount_'+count+'" id="dynamoselectcount_'+count+'_'+pid+'"></div><div class="col-md-2 add_1_' + count + '"><div class="pull-right"><div class="input-group"><button type="button" onClick="addmorerow('+pid+')" class="btn btn-danger btn-sm mb-5"><i class="fa fa-plus" aria-hidden="true"></i></button></div></div><div class="pull-right" style="margin-right:20px;"><div class="input-group"><button type="button" onClick="remove_field_1('+count+')" class="btn btn-dark btn-sm mb-5"><i class="fa fa-trash-o" aria-hidden="true"></i></button></div></div></div></div>');
              count++; //text box increment
			   $("#countrow").val(count) ;

            }

     $('.select2').select2({ width: 'resolve' });
	}

	function remove_field_1(remove_class) {
		var count = $("#countrow").val() ;
		console.log(remove_class);
		if(count > 1)
		{
       new_remove_class = 'add_1_' + remove_class;
	   console.log(new_remove_class);
       $("." + new_remove_class).remove();
	    count--;
		$("#countrow").val(count) ;
		}
		else{
			alert('You Can not delete this row you can only modify it');
		}
   }



$(document).ready(function(e){



});

function validate_form ( )
{
    valid = true;

	var sum = 0 ;
		var total_quantity = $('#total_quantity').val() ;

	$(".quantity").each(function( index ) {

	//alert($(this).val());
		 sum += Number($(this).val());


		});
	 if(sum > total_quantity)
	 {
		 alert ( "Allocation Quantity exceeded from total quantity" );
        valid = false;
	 }

    return valid;
}



</script>
@stop
