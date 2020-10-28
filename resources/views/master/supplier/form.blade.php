		<div class="box-body" style="border-radius:0;">
			<div class="row">
			    <div class="col-md-12">
                  <div class="form-group">
					<label>Supplier name *</label>
					<input type="text" class="form-control" name="supplier_name" value="{{isset($info[0]->supplier_name)?$info[0]->supplier_name:''}}" placeholder="Enter Supplier name" required>
				  </div>
              </div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>E-mail *</label>
						<input type="email" class="form-control" name="email" value="{{isset($info[0]->supplier_email)?$info[0]->supplier_email:''}}" placeholder="Enter E-mail" required>
					</div>
				</div>
            </div>
            <div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Phone *</label>
						<input type="text" class="form-control" id="phone" name="phone" value="{{isset($info[0]->supplier_phone)?$info[0]->supplier_phone:''}}" placeholder="Enter Phone" required>
					</div>
				</div>
			</div>
			<div class="row">
				 <div class="col-md-12">
					<div class="form-group">
						<label>Country *</label>
						<select name="country_id" class="form-control" >
						<?php 
						if(isset($country)&&!empty($country)&&count($country)>0)
						{
						   foreach($country as $k=>$countries)
						   {
						?>
							<option value="{{isset($countries->id)?$countries->id :''}}" <?php if(isset( $info[0]->country_id) && ($countries->id == $info[0]->country_id)){echo "selected";}?>>{{isset($countries->country_name)?$countries->country_name :''}}</option>
							<?php
						   }
						}
							?>
						</select>
					</div>
				</div>
            </div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Region/Province *</label>
						<select name="province_id" class="form-control">
						<?php 
						if(isset($province)&&!empty($province)&&count($province)>0)
						{
						   foreach($province as $k=>$provinces)
						   {
						?>
								<option value="{{isset($provinces->id)?$provinces->id :''}}" <?php if(isset( $info[0]->province_id) && ($provinces->id == $info[0]->province_id)){echo "selected";}?>>{{isset($provinces->name)?$provinces->name :''}}</option>
						   <?php 
						   }
						}
						?>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
			    <div class="col-md-12">
					<div class="form-group">
						<label>City *</label>
						<input type="text" class="form-control" name="city" value="{{isset($info[0]->city)?$info[0]->city:''}}" placeholder="Enter City" required>
					</div>
				</div>
			</div>
			<div class="row">
			    <div class="col-md-12">
					<div class="form-group">
						<label >Zip Code/Postal Code *</label>
						<input type="text" class="form-control" name="zip" value="{{isset($info[0]->postal_code)?$info[0]->postal_code:''}}" placeholder="Enter Zip" required>
					</div>
				</div>
			</div>
			<div class="row">
			    <div class="col-md-12">
					<div class="form-group">
						<label>Address *</label>
						<input type="text" class="form-control" name="address" value="{{isset($info[0]->address)?$info[0]->address:''}}" placeholder="Enter Address" required>
						<!--<br/>
						<input type="text" class="form-control" placeholder="Address line 2">-->
					</div>
				</div>
			</div>

          <!-- /.box-body -->
          <div class="box-footer">
		  <input type="hidden" name="id" value="{{isset($info[0]->id)?$info[0]->id:''}}" >
            <button type="submit" class="btn btn-dark">
              <i class="ti-save-alt"></i> &nbsp; Save Supplier
            </button>
          </div>  
		  </div>