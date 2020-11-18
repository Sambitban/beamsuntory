@extends('layouts.master')
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/assets/vendor_components/datatable/datatables.min.css')}}"/>
@stop
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pickup - Order List
      </h1>
    </section>

    <!-- Main content -->
    <section class="content mob-container">
		@if (session('error-msg'))
					  <div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h6><i class="icon fa fa-ban"></i> {{session('error-msg')}}</h6>
						
					  </div>
					  @endif
					  @if (session('success-msg'))
					  <div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h6><i class="icon fa fa-ban"></i> {{session('success-msg')}}</h6>
						
					  </div>
					  @endif
          <!---- List Item ------>
          <div class="box">				
            	<div class="box-header no-border bg-dark">
				 <form id="project_list" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
			   @csrf
            	<div class="input-group">
                <input type="text" name="purchase_order_no_val" class="form-control form-control-sm" placeholder="Order ID" aria-controls="project-table" value="<?= isset($purchase_order_no_val)?$purchase_order_no_val:''?>">
              &nbsp;<button type="submit" class="btn btn-blue btn-sm">Search</button>
				</div>
				</form>
            	</div>
				<div class="box-body p-0">
					<div class="media-list media-list-hover media-list-divided">
					@if(!empty($purchase_order) && count($purchase_order)>0)
					  @foreach($purchase_order as $k=>$list)
						<div class="media media-single">
						  <div class="media-body">
							<h6><a href="#">Order ID: {{$list->order_no}}</a> &nbsp; (<?= get_total_purchase_item($list->id)?>)</h6>
							@if($list->status == "draft")
							<small class="badge bg-gray">{{str_replace('_',' ',ucfirst($list->status))}}</small>
						</div>
						<div class="media-right">
							<a class="btn btn-block btn-dark btn-sm" href="#">Confirm</a>
						  </div>
						@elseif(trim($list->status) =='assigned_for_pickup')
						<small class="badge bg-warning">{{str_replace('_',' ',ucfirst($list->status))}}</small>
						</div>
						<div class="media-right">
							<a class="btn btn-block btn-dark btn-sm" href="{{URL('pickup-order-confirmation/'.base64_encode($list->id))}}">Confirm</a>
						  </div>
						@elseif($list->status =='in_transit')
						<small class="badge bg-success">{{str_replace('_',' ',ucfirst($list->status))}}</small>
						</div>
						<div class="media-right">
							<a class="btn btn-block btn-dark btn-sm" href="#">Confirm</a>
						  </div>
					@elseif($list->status =='delivered')
						<small class="badge bg-success">{{str_replace('_',' ',ucfirst($list->status))}}</small>
						</div>
 						  <div class="media-right">
							<small>Delivered on<br/>15-Nov-2020</small>
						  </div>
						@else
						<small class="badge bg-success">{{str_replace('_',' ',ucfirst($list->status))}}</small>
						</div>
 						  <div class="media-right">
							<small> </small>
						  </div>
						@endif

						  
						</div>
						 @endforeach
					@endif
					</div>
				</div>
			</div>
      
    </section>
    <!-- /.content -->
  </div>
<div class="box-body">
              <!-- sample modal content -->
				<div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="myLargeModalLabel">Product Details</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body">
								
							</div>
							<div class="modal-footer">
								<!--<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>-->
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
              <!-- <img src="../../images/model2.png" alt="default" data-toggle="modal" data-target=".bs-example-modal-lg" class="model_img img-fluid" /> -->
            </div>


@stop

@section('footer_scripts')
<script src="{{asset('assets/assets/vendor_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- owlcarousel -->
<script src="{{asset('assets/assets/vendor_components/OwlCarousel2/dist/owl.carousel.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('assets/assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
<!-- This is data table -->
<script src="{{asset('assets/assets/vendor_components/datatable/datatables.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('assets/assets/vendor_components/select2/dist/js/select2.full.js')}}"></script>
<!-- This is data table -->
<script src="{{asset('assets/assets/vendor_components/datatable/datatables.min.js')}}"></script>
<!-- SoftPro admin for Data Table -->
<script src="{{asset('assets/js/pages/data-table.js')}}"></script>
<!-- SoftP-->
<script>
function open_modal(obj,id)
    {
        //alert(obj);
		//alert(id);
        $('.modal-body').empty();
       // $(obj).attr('data-target','#modal-'+id);
      //  $("#myModal").modal("show");
        
        $.ajax({
            url: '<?php echo URL("product-details"); ?>',
            method: "POST",
            dataType: 'html',
            data: {
                "item_id": id,
                "_token": "{{ csrf_token() }}",

            },
            success: function(data) {
                console.log(data);
               
               

                $('.modal-body').append(data);
                $("#myModal").modal("show");

               
            }

        });
	
    }
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
@stop
