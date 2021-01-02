<div class="box-body" style="border-radius:0;">
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

          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
            <h6 class="box-title text-dark">Item: {{$product_name}} - {{$itemSkuCode}}</h6>

            <small class="pull-right"><span class="text-blue">Available Qty: {{get_product_quantity_by_stock_id($stockid,Auth::user()->id)}}</span></small>
              </div>
            </div>
			<input type="hidden" value="{{get_product_quantity_by_stock_id($stockid,Auth::user()->id)}}" id="total_quantity" name="total_quantity" class="total_quantity">
			<input type="hidden" name="itemid" value="{{$itemId}}">


			<input type="hidden" name="itemSkuCode" value="{{$itemSkuCode}}">
			<input type="hidden" name="stockid" value="{{$stockid}}">
			<input type="hidden" name="page" value="{{$page}}">

			<input type="hidden" name="countrow" id="countrow" value="1">




            <hr class="my-15">
            <!--- ROW 4 ----->
			<!-- edit section -->

			 <div class="row">
              <div class="col-md-2">
						<div class="input-group mb-10">
						<select name="userrole1_0" id="role_0_{{$item_id}}" required onchange="get_role2(this,0,{{$item_id}})" aria-controls="project-table" class="form-control form-control-sm">
						<option value="">Select</option>
						  <?php foreach($userRole as $userRole)
						{ ?>
						<option value="{{$userRole->id}}">{{$userRole->name}}</option>
						<?php } ?>
						</select>
					  </div>
              </div>
              <div class="col-md-2">
					  <div class="form-group">
					  <select name="userrole2_0[]" class="form-control select2" usertype="" roleid="" id="role1_0_{{$item_id}}" required onchange="get_role3(this,0,'{{$item_id}}')"  data-placeholder=""
						  style="width: 100%;">

					  </select>
					  </div>
              </div>
              <div class="col-md-2" id="dynamo_dropdown_0_{{$item_id}}_0">
					  <div class="form-group">
					  <select class="form-control select2" name="userrole3_0[]" required usertype="" roleid="" id="role2_0_{{$item_id}}" dynamodropdownincid="0" onchange="get_role4(this,0,'{{$item_id}}')"  data-placeholder=""
						  style="width: 100%;">

					  </select>
					  </div>
              </div>

			  <div class="col-md-2">
					  <div class="input-group">
					  <div class="checkbox checkbox-success"  id="hide_locker_0_{{$item_id}}"  style="margin-right: 20px;">
						<input id="checkbox3_0_{{$item_id}}" value="store" type="checkbox" name="storelocator_0" >
						<label for="checkbox3_0_{{$item_id}}"> Locker </label>
					  </div>
					  <div class="checkbox checkbox-success" >
						<input id="checkbox4_0_{{$item_id}}" value="each" type="checkbox" name="eachselectbox_0">
						<label for="checkbox4_0_{{$item_id}}"> Each </label>
					  </div>
					</div>
              </div>
              <div class="col-md-2">
						<div class="form-group">
						 <input type="number" name="quantity_0" required id="quantity_0_{{$item_id}}" class="form-control quantity" placeholder="" onblur="calculate_amount()" min="0">
						</div>
						<input type="hidden" name="dynamoselectcount_0" id="dynamoselectcount_0_{{$item_id}}">
              </div>
              <div class="col-md-2">
					  <div class="pull-right">
						<div class="input-group">
						<button type="button" onclick="addmorerow('{{$item_id}}')" id="add_field_button_1_{{$item_id}}" class="btn btn-danger btn-sm mb-5"><i class="fa fa-plus" aria-hidden="true"></i></button>
						</div>
						</div>
						&nbsp;&nbsp;
						<div class="pull-right" style="margin-right:20px;">
				<div class="input-group">
				<button type="button" onClick="remove_field_1('1')" class="btn btn-dark btn-sm mb-5"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
				</div>
				</div>

              </div>
            </div>


			<!--- edit section -->
			<!--- Add section -->
			<!--- Add section -->


						<hr class="my-15">
						<div class="input_fields_wrap_1"></div>

            </div>




          <!-- /.box-body -->
          <div class="box-footer">

                      <button   class="btn btn-dark">
              Save & Finish &nbsp;<i class="fa fa-angle-double-right" aria-hidden="true"></i>
            </button>
          </div>

        </div>
