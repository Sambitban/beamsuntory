<?php

namespace App\Http\Controllers\product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\ProductCategory;
use App\Model\Brand;
use App\Model\Supplier;
use App\Model\ProductAttribute;
use App\Model\ProductVariations;
use Auth;
use DB;
class ProductController extends Controller
{
    public function product_list()
    {
        $data['title']="Product category";
        $data['product_list']=$list = Product::select('item.*','brand.name as brand_name','product_category.name as cat_name','supplier_name')->join('product_category','product_category.id','=','item.category_id','left')->join('brand','brand.id','=','item.brand_id','left')->join('supplier','supplier.id','=','item.supplier_id','left')->where('item.is_deleted','No')->where('item.is_active','Yes')->orderBy('item.name','asc')->get();
		$data['product_category']=$list = ProductCategory::where('is_deleted','No')->where('is_active','Yes')->orderBy('id','asc')->get();
		$data['brand']=$list = Brand::where('is_deleted','No')->where('is_active','Yes')->orderBy('id','asc')->get();
		$data['supplier']=$list = Supplier::where('is_deleted','No')->where('is_active','Yes')->orderBy('id','asc')->get();
		//t($data,1);
        return view('product.ProductMaster.list',$data);
    }

     public function add()
    {
        $data['title']="Product category";
		
		$data['category']=$list = ProductCategory::where('is_deleted','No')->where('is_active','Yes')->orderBy('id','asc')->get();
		$data['brand']=$list = Brand::where('is_deleted','No')->where('is_active','Yes')->orderBy('id','asc')->get();
		$data['supplier']=$list = Supplier::where('is_deleted','No')->where('is_active','Yes')->orderBy('id','asc')->get();
		$data['product_attribute']=$list = ProductAttribute::where('is_deleted','No')->where('is_active','Yes')->orderBy('name','asc')->get();
		//t($data,1);
        return view('product.ProductMaster.add',$data);
    }
    public function get_attribute_detsils(Request $request)
	{
		$data=$request->all();
		$variation_count =isset($data['variation_count']) && $data['variation_count']!=''? $data['variation_count']:0;
		
		$variation_value = isset($varience[0]->variation)?json_decode($varience[0]->variation,true):array() ;
		
		if(isset($data['product_id'])&& $data['product_id']!='')
		{
			$attribute_details = ProductAttribute::orderBy('id','asc')->get();
			$varience =  ProductVariations::where('item_id',$data['product_id'])->get();
			$attribute_details = ProductAttribute::orderBy('id','asc')->get();
			$html='';
		foreach($varience as $k=>$varience)
			{
			$html.='<div class="row">';
			
				$varience_value = json_decode($varience->variation,true) ;
			  foreach($attribute_details as $attributeDetails)
			{
				
			  $attribute_val = isset($attributeDetails->value)&& $attributeDetails->value!=''?explode(',',$attributeDetails->value):array();
			   if(in_array($attributeDetails->name,array_keys($varience_value))) { 
              $html.='<div class="col-md-3">';
			  
               $html.=' <label>Select '.$attributeDetails->name.'</label>
                <div class="input-group">
				
                <select  aria-controls="project-table" name="variation'.$k.'[]" required class="form-control form-control-sm" onchange="remove_sku('.$k.')">';
				foreach($attribute_val as $attributeVal){
					if($varience_value[$attributeDetails->name]==$attributeVal)
					{
						$selected="selected";
					}
					else{
						$selected ='' ;
					}
                 $html.='<option value="'.$attributeVal.'" '.$selected.'>'.$attributeVal.'</option>';
				} 
                 $html.='</select>
                </div> 
              </div><input type="hidden" name="attribute_name'.$k.'[]" value="'.$attributeDetails->name.'">
			  ';
			  }
			}
			
              $html.='
			  
              <div class="col-md-3">
                <label>SKU</label>
                <div class="input-group">
                  <input type="text" class="form-control" value="'.$varience_value['sku'].'" required name="attribute_sku'.$k.'" id="sku'.$k.'">
                <button type="button" class="btn btn-dark btn-sm" onclick="genarate_sku(this)">Generate SKU</button>
                </div>
				<input type="hidden" value="'.$varience->id.'" name="varience_id'.$k.'[]">
              </div>
              <div class="col-md-3">
                <div class="pull-right">
                                    <label>Action</label>
                <div class="input-group">
                  <button type="button" class="btn btn-danger btn-sm" onclick="remove_variation(this)">Remove Variation</button>
                </div>
                </div>
              </div>
            </div> <hr class="my-15">';
		}
		}
		else{
			$attribute = isset($data['attribute']) && $data['attribute']!=''?implode(',',$data['attribute']):'';
		
		$attribute_details = ProductAttribute::whereRaw("id in ($attribute)")->orderBy('id','asc')->get();
			$html='';
		
			$html.='<div class="row">';
			foreach($attribute_details as $attributeDetails)
			{
				
			  $attribute_val = isset($attributeDetails->value)&& $attributeDetails->value!=''?explode(',',$attributeDetails->value):array();
              $html.='<div class="col-md-3">';
			 
               $html.=' <label>Select '.$attributeDetails->name.'</label>
                <div class="input-group">
				
                <select  aria-controls="project-table" name="variation'.$variation_count.'[]" required class="form-control form-control-sm" onchange="remove_sku('.$variation_count.')">';
				foreach($attribute_val as $attributeVal){
                 $html.='<option value="'.$attributeVal.'">'.$attributeVal.'</option>';
				} 
                 $html.='</select>
                </div> 
              </div><input type="hidden" name="attribute_name'.$variation_count.'[]" value="'.$attributeDetails->name.'">
			  ';
			}
              $html.='
              <div class="col-md-3">
                <label>SKU</label>
                <div class="input-group">
                  <input type="text" class="form-control" required name="attribute_sku'.$variation_count.'" id="sku'.$variation_count.'">
                <button type="button" class="btn btn-dark btn-sm" onclick="genarate_sku(this)">Generate SKU</button>
                </div>
				<input type="hidden" value="" name="varience_id'.$variation_count.'[]">
              </div>
              <div class="col-md-3">
                <div class="pull-right">
                                    <label>Action</label>
                <div class="input-group">
                  <button type="button" class="btn btn-danger btn-sm" onclick="remove_variation(this)">Remove Variation</button>
                </div>
                </div>
              </div>
            </div> <hr class="my-15">';
			}
		
		
		
		echo $html;
	}
    public function save_produt(Request $request)
    {
        $data=$request->all(); //t($data,1);
		$have_product = Product::where('name',$data['product_name'])->where('is_deleted','No')->get();
		if(!empty($have_product) && count($have_product)>0)
		{
			return redirect('add-product')->with('error-msg', 'Product  already exist');
		}
        $insert_data['name']=$data['product_name'];
		$insert_data['description']=isset($data['product_description'])?$data['product_description']:0;
		$insert_data['brand_id']=$data['brand'];
		$insert_data['product_type']=isset($data['product_type'])?$data['product_type']:'';
		$insert_data['category_id']=$data['category'];
		$insert_data['supplier_id']=$data['vendor'];
		$insert_data['regular_price']=$data['regular_price'];
		$insert_data['retail_price']=$data['retail_price'];
		$insert_data['sku']=$data['sku'];
		$insert_data['low_stock_level']=$data['low_stock_level'];
		$insert_data['status']=$data['status'];
		$insert_data['batch_no']='BEAM-'.rand(0,1500).'-'.rand(5,500);
		//$insert_data['shelf_life']=$data['shelf_life'];
		$insert_data['weight']=$data['weight'];
		$insert_data['length']=$data['length'];
		$insert_data['width']=$data['Width'];
		$insert_data['height']=$data['Height'];
		//upload image2wbmp
		$cat_image = $request->file('image');
			if($cat_image !='')
			{
				
					$cat_image_pic_name = upload_file_single_with_name($cat_image, 'product','product',$data['product_name']);	
					if($cat_image_pic_name!='')
					{
						$insert_data['image'] = $cat_image_pic_name;
					}
				
			}
        $insert_data['created_by'] = Auth::user()->id;
        $id=Product::insertGetId($insert_data);
		
		$variation=array();
		
		for($i=0;$i<$data['variation_count'];$i++)
		{
			$variation=array();
			foreach($data['attribute_name'.$i] as $k=>$variations)
			{
				
				$variation[$variations] =$data['variation'.$i][$k];
				$variation['sku']= $data['attribute_sku'.$i];
				
			}
			
			$insert_variation['item_id'] = $id;
			$insert_variation['variation'] = json_encode($variation);
			$insert_variation['created_by'] = Auth::user()->id;
			ProductVariations::insertGetId($insert_variation);
		}
		
        if($id!='')
        {
			
            return redirect('produt-list')->with('success-msg', 'Product Category successfully added');
        }
        else			
        {
            return redirect('produt-list')->with('error-msg', 'Please try after some time');
        }
    }

    public function edit_product($id)
    {
		$data['id'] =$product_id = base64_decode($id);
       
            $data['title']="Product category";
		
		$data['category']=$list = ProductCategory::where('is_deleted','No')->where('is_active','Yes')->orderBy('id','asc')->get();
		$data['brand']=$list = Brand::where('is_deleted','No')->where('is_active','Yes')->orderBy('id','asc')->get();
		$data['supplier']=$list = Supplier::where('is_deleted','No')->where('is_active','Yes')->orderBy('id','asc')->get();
		$data['product_attribute']=$list = ProductAttribute::where('is_deleted','No')->where('is_active','Yes')->orderBy('name','asc')->get();
		
		$data['info'] = $info = Product::where('id',$product_id)->get() ;
		$data['varience_count'] = $varience =  ProductVariations::where('item_id',$product_id)->count();
		//echo count($varience);
		//exit();
		
        return view('product.ProductMaster.edit',$data);
        
    }

    public function update_product(Request $request)
    {
        $data=$request->all();// t($data,1);
		
		$have_product = Product::where('name',$data['product_name'])->where('is_deleted','No')->get();
		if(!empty($have_product) && count($have_product)>0 && $have_product[0]->id !=  $data["id"])
		{
			return redirect('edit-product/'.base64_encode($data['id']))->with('error-msg', 'Product  already exist');
		}
        $insert_data['name']=$data['product_name'];
		$insert_data['description']=isset($data['product_description'])?$data['product_description']:0;
		$insert_data['brand_id']=$data['brand'];
		$insert_data['product_type']=isset($data['product_type'])?$data['product_type']:'';
		$insert_data['category_id']=$data['category'];
		$insert_data['supplier_id']=$data['vendor'];
		$insert_data['regular_price']=$data['regular_price'];
		$insert_data['retail_price']=$data['retail_price'];
		$insert_data['sku']=$data['sku'];
		$insert_data['low_stock_level']=$data['low_stock_level'];
		$insert_data['status']=$data['status'];
		//$insert_data['batch_no']='BEAM-'.rand(0,1500).'-'.rand(5,500);
		$insert_data['weight']=$data['weight'];
		$insert_data['length']=$data['length'];
		$insert_data['width']=$data['Width'];
		$insert_data['height']=$data['Height'];
		//upload image2wbmp
		$cat_image = $request->file('image');
			if($cat_image !='')
			{
				
					$cat_image_pic_name = upload_file_single_with_name($cat_image, 'product','product',$data['product_name']);	
					if($cat_image_pic_name!='')
					{
						$insert_data['image'] = $cat_image_pic_name;
					}
				
			}
        $insert_data['updated_by'] = Auth::user()->id;
		$insert_data['updated_at'] = date('Y-m-d h:i:s');
       $id = Product::where('id',$data["id"])->update($insert_data);
	   
	   
	    $varience_id_arr = [] ;
		for($i=0;$i<$data['variation_count'];$i++)
		{
			
			if($data['varience_id'.$i][0]!='')
			{
			array_push($varience_id_arr,implode(',',$data['varience_id'.$i]));
			}
		}
		
		ProductVariations::where('item_id',$data["id"])->whereNotIn('id', $varience_id_arr)->delete(); 
		
	 
		
		for($i=0;$i<$data['variation_count'];$i++)
		{
			$varience_id = $data['varience_id'.$i] ;
			$variation=array();
			foreach($data['attribute_name'.$i] as $k=>$variations)
			{
				//t($variations);
				//echo $k;
				//t($data['variation'.$i][$k]);
				$variation[$variations] =$data['variation'.$i][$k];
				$variation['sku']= $data['attribute_sku'.$i];
				
			}
			//t($variation);
			//t(json_encode($variation));
			$insert_variation['item_id'] = $data['id'];
			$insert_variation['variation'] = json_encode($variation);
			$insert_variation['created_by'] = Auth::user()->id;
			 if($varience_id[0]!='')
			{
				ProductVariations::where('id',$varience_id[0])->update($insert_variation);
			}
			else{
			ProductVariations::insertGetId($insert_variation);
			}
		} 
		
        if($id!='')
        {
			
            return redirect('product-list')->with('success-msg', 'Product Category successfully Updated');
        }
        else			
        {
            return redirect('edit-produt/'.base64_encode($data['id']))->with('error-msg', 'Please try after some time');
        }
		
    }
		public function changeStatus($id,$status)
	{
		$id= base64_decode($id);
		$update_data['is_active'] = $status;
		$updated=Product::where('id',$id)->update($update_data);
		if($updated)
            return redirect('product-list')->with('success-msg', 'Status successfully changed');
        else
        {
            return redirect('product-list')->with('error-msg', 'Please try after some time');    
        }
	}
	public function view(Request $Request)
	 {
		 $data = $Request->all();
		$profile_pic = $current_date = $description = $active = $userid = $email =
		$phone_number = $address = $member = $logo = '';
		//$no_image_path = URL("assets/images/avatar/user.jpg");
		$no_image_path = '';
		//$profile_pic_rel_path = 'public/profile_pic';
		$profile_pic_rel_path = 'public/product';
		//$logo_pic_rel_path = 'public/logo';
		
		$info = Product::select('item.*','brand.name as brand_name','product_category.name as cat_name','supplier_name')->join('product_category','product_category.id','=','item.category_id','left')->join('brand','brand.id','=','item.brand_id','left')->join('supplier','supplier.id','=','item.supplier_id','left')->where('item.is_deleted','No')->
		where('item.id','=',$data['facility_id'])->get();


			$name = isset($info[0]->name) ? $info[0]->name : '' ;

			
			$profile_pic = (isset($info[0]->image)&&$info[0]->image!='') ? asset($profile_pic_rel_path.'/'.$info[0]->image):$no_image_path;

			$current_date = date('d/m/Y',strtotime($info[0]->created_at)) ;
			if($info[0]->is_active!='Y'){
				$active = '<span class="badge badge-success">Active</span>' ;
			}else{
				$active = '<span class="badge badge-danger">Inactive</span>' ;
			}
			$description = isset($info[0]->description) ? $info[0]->description : '' ;
			$batch_no = isset($info[0]->batch_no) ? $info[0]->batch_no : '' ;
			$brand_name = isset($info[0]->brand_name) ? $info[0]->brand_name : '' ;
			$cat_name = isset($info[0]->cat_name) ? $info[0]->cat_name : '' ;
			$supplier_name = isset($info[0]->supplier_name) ? $info[0]->supplier_name : '' ;
			$regular_price = isset($info[0]->regular_price) ? $info[0]->regular_price : '' ;
			$retail_price = isset($info[0]->retail_price) ? $info[0]->retail_price : '' ;
			$sku = isset($info[0]->sku) ? $info[0]->sku : '' ;
			$status = isset($info[0]->status) ? $info[0]->status : '' ;
			$low_stock_level = isset($info[0]->low_stock_level) ? $info[0]->low_stock_level : '' ;
			$weight = isset($info[0]->weight) ? $info[0]->weight : '' ;
			$length = isset($info[0]->length) ? $info[0]->length : '' ;
			$width = isset($info[0]->width) ? $info[0]->width : '' ;
			$height = isset($info[0]->height) ? $info[0]->height : '' ;
			$expire_date = isset($info[0]->expire_date) ? date('d/m/Y',strtotime($info[0]->expire_date)) : '' ;


	$html = '
		   <div class="media-list bb-1 bb-dashed border-light">
					<div class="media align-items-center">
					  <a class="avatar avatar-lg status-success" href="#">
						<img src="'.$profile_pic.'" alt="...">
					  </a>
					  <div class="media-body">
						<p class="font-size-16">
						  <a class="hover-primary" href="#"><strong>'. $name .'</strong></a>
						</p>'.$current_date.'
						 
						<p>'.$description.'</p>
						</div>
					  <div class="media-right">'.$active.'</div>
					  
					</div>					
					
				  </div>
				 
				   <div class="box-body">
				<div class="table-responsive">
				  <table class="table table-striped mb-0">
					  
					  <tbody>
						<tr>
						  <th scope="row"> Batch No:</th>
						  <td>'.$batch_no.'</td>
						   <td></td>
						</tr>
						<tr>
						  <th scope="row"> Brand Name:</th>
						  <td>'.$brand_name.'</td>
						   <td></td>
						</tr>
						<tr>
						  <th scope="row">  category Name:</th>
						  <td>'.$cat_name.'</td>
						   <td></td>
						</tr>
						<tr>
						  <th scope="row">  Supplier Name:</th>
						  <td>'.$supplier_name.'</td>
						   <td></td>
						</tr>
						<tr>
						  <th scope="row">  Price:</th>
						   <td>'.$regular_price.'</td>
						   <td></td>
						</tr>
						<tr>
						  <th scope="row">  Retail Price:</th>
						   <td>'.$retail_price.'</td>
						   <td></td>
						</tr>
						<tr>
						  <th scope="row">  SKU:</th>
						   <td>'.$sku.'</td>
						   <td></td>
						</tr>
						<tr>
						  <th scope="row">  Status:</th>
						   <td>'.$status.'</td>
						   <td></td>
						</tr>
						<tr>
						  <th scope="row">  Low Stock Level:</th>
						   <td>'.$low_stock_level.'</td>
						   <td></td>
						</tr>
						<tr>
						  <th scope="row">  Weight:</th>
						   <td>'.$weight.'</td>
						   <td></td>
						</tr>
						<tr>
						  <th scope="row">  Length:</th>
						   <td>'.$length.'</td>
						   <td></td>
						</tr>
						<tr>
						  <th scope="row">  Width:</th>
						   <td>'.$width.'</td>
						   <td></td>
						</tr>
						<tr>
						  <th scope="row">  Height:</th>
						   <td>'.$height.'</td>
						   <td></td>
						</tr>
						<tr>
						  <th scope="row">  Expiration Date:</th>
						   <td>'.$expire_date.'</td>
						   <td></td>
						</tr>
						<!--<tr>
						  <th scope="row">  Logo:</th>
						  <td><a class="avatar avatar-lg status-success" href="#">
						   <img src="'.$logo.'" alt="...">
					       </a>
						   </td>
						   <td></td>
						</tr>-->
					  </tbody>
					</table>
				</div>
            </div>' ;
			//$html = '<div>HIIII</div>';
				 echo $html;
	 }
	
}
?>