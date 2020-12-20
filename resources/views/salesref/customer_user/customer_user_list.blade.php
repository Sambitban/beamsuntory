@extends('layouts.master')

@section('header_styles')

<!-- Bootstrap extend-->
<link rel="stylesheet" href="{{asset('assets/main/css/bootstrap-extend.css')}}">

<!-- Bootstrap 4.1-->
<link rel="stylesheet" href="{{asset('assets/assets/vendor_components/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- theme style -->
<link rel="stylesheet" href="{{asset('assets/main/css/master_style.css')}}">
<!-- SoftPro admin skins -->
<link rel="stylesheet" href="{{asset('assets/main/css/skins/_all-skins.css')}}">

@stop
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
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
					  <div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h6><i class="icon fa fa-ban"></i> {{session('success-msg')}}</h6>
						
					  </div>
					  @endif
		
          <!---- List Item ------>
          <div class="box">		
		<div class="box-header no-border bg-dark">
             <h6 class="pull-left">User List</h6>
             <div class="pull-right">
              <a href="#"><i class="fa fa-filter font-size-20 text-secondary" aria-hidden="true"></i></a>
             </div>
			 <form id="project_list" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
			   @csrf
             <div class="input-group">
                <input type="search" name="search_category" value="{{isset($search_category)?$search_category:''}}" class="form-control form-control-sm" placeholder="Store Name" aria-controls="project-table">
               &nbsp;<button type="submit" class="btn btn-blue btn-sm">Search</button>
            </div>
			</form>
            </div>
				<div class="box-body p-0">
				<span style="padding: 11px;font-size: 18px;">Role Name : {{get_chiled_role_name(Auth::user()->role_id)}}
								
				</span>
				<a style="float: right;" class="btn btn-dark btn-lg mt-10" href="{{URL('add-customer-user')}}">Add user</a>
				</div>
				<div class="box-body p-0">
				<form id="add_development_plan" action="<?= URL('remove-user')?>" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
				@csrf
				<div class="media-list media-list-hover media-list-divided">
				@foreach($info as $k=>$tlist)
				<div class="media media-single m-media">
				  <div class="media-body">
					<div class="pull-right mr-10"><a class="dropdown-item" href="{{URL('edit-customer-user/'.base64_encode($tlist->id))}}"><i class="ti-pencil font-size-20"></i></a></div>
				  <div class="pull-left ml-10">
					  <div class="checkbox checkbox-success">
					  <input id="checkbox2_{{$k}}" type="checkbox" name="check_list[]" value="{{$tlist->id}}">
					  <label for="checkbox2_{{$k}}"></label>
					  </div>
				  </div>
				  <h6>{{isset($tlist->useId)?$tlist->useId:''}}</h6>
				  <!--<small>34/B lindsey street, Standford, CA 744587, USA</small>-->
				  <p><b>Phone:</b><small>{{isset($tlist->phone)?$tlist->phone:''}}</small></p>
				  <p><b>Email:</b><small>{{isset($tlist->email)?$tlist->email:''}}</small></p>
				 
				  </div>
				</div>
			 @endforeach
            <div class="media media-single bg-light text-center">
              <div class="media-body">
                <div class="flexbox flex-justified ">
                <button type="submit" class="btn btn-success btn-lg mt-10">Remove user</button>
                </div>
            </div>
			</div>
				</div>
				</form>
			</div>
      
    </section>
    <!-- /.content -->
  </div>
  
@stop

@section('footer_scripts')
<!-- jQuery 3 -->
	<script src="assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js"></script>
	
	<!-- fullscreen -->
	<script src="assets/vendor_components/screenfull/screenfull.js"></script>
	
	<!-- popper -->
	<script src="assets/vendor_components/popper/dist/popper.min.js"></script>
	
	<!-- Bootstrap 4.1-->
	<script src="assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>
	
	<!-- SlimScroll -->
	<script src="assets/vendor_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	
	<!-- FastClick -->
	<script src="assets/vendor_components/fastclick/lib/fastclick.js"></script>
	
	<!-- SoftPro admin App -->
	<script src="js/template.js"></script>

@stop
