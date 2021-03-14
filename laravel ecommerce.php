
Message:
========
========

  @if(Session::has('flash_message_error')) 
            <div class="alert alert-error alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif   

    @if(Session::has('flash_message_success')) 
         <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!! session('flash_message_success') !!}</strong>
         </div>
    @endif 

Delete Alert:
============
============
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    $(function(){
    $(document).on('click','#delete',function(e){
    e.preventDefault();
    var link = $(this).attr("href");


    Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href = link;
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})

});

});

</script>


Text Editor:
============
============
  <textarea class="textarea" placeholder="Place some text here"style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> 
  </textarea>

  <script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>           


 Jquery Validation:
==================
==================
=================
 <script type="text/javascript">
$(document).ready(function () {

  $('#myform').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      current_pwd: {
        required: true,
        minlength: 5
      },
     
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      current_pwd: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
    
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>

javascript image upload:
=======================
<script type="text/javascript">
    /* The uploader form */
    $(function () {
        $("#image").change(function(e) {
          var reader = new FileReader();
          reader.onload = function(e){
            $("#showImage").attr('src',e.target.result);
          }
          reader.readAsDataURL(e.target.files['0']);
           
        });
    });
</script>


          <div class="form-group">
                <label for="images">Images</label>
                <input type="file" name="images[]" id="images" multiple class="form-control" required>
              </div>

              <div class="form-group">
                <div id="image_preview" style="width:100%;">
                  
                </div>
              </div>

<script type="text/javascript">
  $(document).ready(function() {
  var fileArr = [];
   $("#images").change(function(){
      // check if fileArr length is greater than 0
       if (fileArr.length > 0) fileArr = [];
       
        $('#image_preview').html("");
        var total_file = document.getElementById("images").files;
        if (!total_file.length) return;
        for (var i = 0; i < total_file.length; i++) {
          if (total_file[i].size > 1048576) {
            return false;
          } else {
            fileArr.push(total_file[i]);
            $('#image_preview').append("<div class='img-div' id='img-div"+i+"'><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-responsive image img-thumbnail' title='"+total_file[i].name+"'><div class='middle'><button id='action-icon' value='img-div"+i+"' class='btn btn-danger' role='"+total_file[i].name+"'><i class='fa fa-trash'></i></button></div></div>");
          }
        }
   });
  
  $('body').on('click', '#action-icon', function(evt){
      var divName = this.value;
      var fileName = $(this).attr('role');
      $(`#${divName}`).remove();
    
      for (var i = 0; i < fileArr.length; i++) {
        if (fileArr[i].name === fileName) {
          fileArr.splice(i, 1);
        }
      }
    document.getElementById('images').files = FileListItem(fileArr);
      evt.preventDefault();
  });
  
   function FileListItem(file) {
            file = [].slice.call(Array.isArray(file) ? file : arguments)
            for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
            if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
            for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
            return b.files
        }
});
</script>


====================================================================================================================================================================================
    
           Frontend  Code 
====================================================================================================================================================================================




                 Product Page
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
<?php

Checkbox Filter:
===============
<script type="text/javascript">
    var $filterCheckboxes = $('input[type="checkbox"]');
var filterFunc = function() {
  
  var selectedFilters = {};

  $filterCheckboxes.filter(':checked').each(function() {

    if (!selectedFilters.hasOwnProperty(this.name)) {
      selectedFilters[this.name] = [];
    }

    selectedFilters[this.name].push(this.value);
  });

  // create a collection containing all of the filterable elements
  var $filteredResults = $('.flower');

  // loop over the selected filter name -> (array) values pairs
  $.each(selectedFilters, function(name, filterValues) {

    // filter each .flower element
    $filteredResults = $filteredResults.filter(function() {

      var matched = false,
        currentFilterValues = $(this).data('category').split(' ');

      // loop over each category value in the current .flower's data-category
      $.each(currentFilterValues, function(_, currentFilterValue) {

        // if the current category exists in the selected filters array
        // set matched to true, and stop looping. as we're ORing in each
        // set of filters, we only need to match once

        if ($.inArray(currentFilterValue, filterValues) != -1) {
          matched = true;
          return false;
        }
      });

      // if matched is true the current .flower element is returned
      return matched;

    });
  });

  $('.flower').hide().filter($filteredResults).show();
}

$filterCheckboxes.on('change', filterFunc);  

</script>

@php
 $products = App\Product::paginate(2);
        foreach ($products as $prod) {
          $prod->class = DB::table('brands')->where('id',$prod->brand_id)->value('slug');
          
        }
@endphp
$brands = Brand::get();

  Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of total {{$products->total()}} entries


@foreach($products as $product)
  <div class="flower" data-category="{{$product->class}}">
    {{$product->name}}
</div>
@endforeach

 @foreach($product_brand as $brand)
    <label><input type="checkbox" value="{{$brand->slug}}"/>{{$brand->name}}</label><br>
   @endforeach



Show By Product:
===============
==============

 public function product(){
          $products=Product::query();

          if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
             //dd( $price);
            $products->whereBetween('price',$price);
        }
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status','1')->paginate($_GET['show']);
        }
        else{
            $products=$products->where('status','1')->paginate(9);
        }
       
       $product_brand = Brand::get();
        return view('frontend.products.product')->with('products',$products)->with('product_brand',$product_brand);
    }


   public function productFilter(Request $request){
      
            $data= $request->all();
             //return $data;
      
            $showURL="";
            if(!empty($data['show'])){
                $showURL .='&show='.$data['show'];
            }
            $sortByURL='';
            if(!empty($data['sortBy'])=='product_highest'){
               Product::orderBy('price','Desc');
            }
            $priceRangeURL="";
            if(!empty($data['price_range'])){
                $priceRangeURL .='&price='.$data['price_range'];
            }

            if(request()->is('/product')){
                return redirect()->route('product-lists',$showURL.$sortByURL.$priceRangeURL);
            } else{
                return redirect()->route('product-lists',$showURL.$sortByURL.$priceRangeURL);
            }
            
    }


 <div class="single-shorter">
  <label>Show :</label>
  <select class="show" name="show" onchange="this.form.submit();">
      <option value="">Default</option>
      <option value="1" @if(!empty($_GET['show']) && $_GET['show']=='1') selected @endif>01</option>
      <option value="15" @if(!empty($_GET['show']) && $_GET['show']=='15') selected @endif>15</option>
      <option value="21" @if(!empty($_GET['show']) && $_GET['show']=='21') selected @endif>21</option>
      <option value="30" @if(!empty($_GET['show']) && $_GET['show']=='30') selected @endif>30</option>
  </select>
 </div>

<div class="single-widget range">
    <h3 class="title">Shop by Price</h3>
    <div class="price-filter">
        <div class="price-filter-inner">
            @php
                $max=DB::table('products')->max('price');
                // dd($max);
            @endphp
            <div id="slider-range" data-min="0" data-max="{{$max}}"></div>
            <div class="product_filter">
            <button type="submit" class="filter_button">Filter</button>
            <div class="label-input">
                <span>Range:</span>
                <input style="" type="text" id="amount" readonly/>
    <input type="text" name="price_range" id="price_range" value="@if(!empty($_GET['price'])){{$_GET['price']}}@endif"/>
            </div>
            </div>
        </div>
    </div>
    
</div>

<script>
        $(document).ready(function(){
        /*----------------------------------------------------*/
        /*  Jquery Ui slider js
        /*----------------------------------------------------*/
        if ($("#slider-range").length > 0) {
            const max_value = parseInt( $("#slider-range").data('max') ) || 500;
            const min_value = parseInt($("#slider-range").data('min')) || 0;
            const currency = $("#slider-range").data('currency') || '';
            let price_range = min_value+'-'+max_value;
            if($("#price_range").length > 0 && $("#price_range").val()){
                price_range = $("#price_range").val().trim();
            }
            
            let price = price_range.split('-');
            $("#slider-range").slider({
                range: true,
                min: min_value,
                max: max_value,
                values: price,
                slide: function (event, ui) {
                    $("#amount").val(currency + ui.values[0] + " -  "+currency+ ui.values[1]);
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
            }
        if ($("#amount").length > 0) {
            const m_currency = $("#slider-range").data('currency') || '';
            $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
                "  -  "+m_currency + $("#slider-range").slider("values", 1));
            }
        })
    </script>



?>


$categories = Category::with('categories')->where(['parent_id' => 0])->get();

public function categories(){
        return $this->hasMany('App\Category','parent_id');
  }


    @foreach($categories as $cat)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordian" href="#{{$cat->id}}">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                {{$cat->category_name}}
                            </a>
                        </h4>
                    </div>
                    <div id="{{$cat->id}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach($cat->categories as $subcat)
                                   
                                    <li><a href="{{ asset('products/'.$subcat->url) }}">{{$subcat->category_name}} </a></li>
                                    
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach













              Product Details Page
========================================================================================================================================================================================================================
<?php

Route::get('/details-product/{slug}', 'Frontend\ProductController@productdetails')->name('product.details');


Route::post('product/{slug}/review','Frontend\ProductController@reviewproduct')->name('review.product');




public function productdetails($slug){
    ///product Details 
    $productDetails =Product::where('slug',$slug)->first();
  
    return view('frontend.products.details_product',compact('productDetails'));
}

  public function reviewproduct(Request $request){
      //return $request->all();
       $product_info=Product::where('slug',$request->slug)->first();
         //return $product_info;
         //return $request->all();
        $data=$request->all();
        $data  = new ProductReview();
        $data['product_id']=$product_info->id;
        $data['user_id']=$request->user()->id;
        $data['rate']=$request->rate;
        $data['review']=$request->review;
        $data['status']='active';
        $data->save();
        //$status=ProductReview::create($data);
     
         return redirect()->back();

  }



class Product extends Model
{

    public function getReview(){
        return $this->hasMany('App\ProductReview','product_id','id')->with('user_info')->where('status','active')->orderBy('id','DESC'); }
 

}



class ProductReview extends Model
{
      public function user_info(){
        return $this->hasOne('App\User','id','user_id');
    }
}




///////Product Review

  @php
        $rate=ceil($productDetails->getReview->avg('rate'))
      @endphp
        @for($i=1; $i<=5; $i++)
          @if($rate>=$i)
            <li><i class="fa fa-star"></i></li>
          @else 
          <i class="far fa-star"></i>
          @endif
        @endfor
 ({{$productDetails['getReview']->count()}}) 



 <?php?>


 <form  method="post" action="{{route('review.product', $productDetails->slug)}}">
@csrf
     <div class="star-rating">
      <div class="star-rating__wrap">
        <input class="star-rating__input" id="star-rating-5" type="radio" name="rate" value="5">
        <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-5" title="5 out of 5 stars"></label>
        <input class="star-rating__input" id="star-rating-4" type="radio" name="rate" value="4">
        <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-4" title="4 out of 5 stars"></label>
        <input class="star-rating__input" id="star-rating-3" type="radio" name="rate" value="3">
        <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3" title="3 out of 5 stars"></label>
        <input class="star-rating__input" id="star-rating-2" type="radio" name="rate" value="2">
        <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2" title="2 out of 5 stars"></label>
        <input class="star-rating__input" id="star-rating-1" type="radio" name="rate" value="1">
        <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1" title="1 out of 5 stars"></label>
      </div>
    </div>
      <div class="form-group col-12">
        <textarea id="review" name="review" class="form-control" placeholder="Write Your Review" rows="4" required data-error="Please,leave us a review."></textarea>
        <div class="help-block with-errors"></div>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary btn-animated mt-1">Post Review</button>
      </div>
    </form>


<!--tab end-->
<h4>{{ceil($productDetails->getReview->avg('rate'))}} <span>(Overall)</span></h4>

  <span>Based on {{$productDetails->getReview->count()}} Comments</span>



@foreach($productDetails['getReview'] as $data)
                <!-- Single Rating -->
<div class="single-rating">
  <div class="rating-author">
    @if($data->user_info['photo'])
    <img src="{{$data->user_info['photo']}}" alt="{{$data->user_info['photo']}}">
    @else 
    <img src="{{asset('backend/img/avatar.png')}}" alt="Profile.jpg">
    @endif
  </div>
  <div class="rating-des">
    <h6>{{$data->user_info['name']}}</h6>
    <div class="ratings">

      <ul class="rating">
        @for($i=1; $i<=5; $i++)
          @if($data->rate>=$i)
            <li><i class="fa fa-star"></i></li>
          @else 
            <li><i class="fa fa-star-o"></i></li>
          @endif
        @endfor
      </ul>
      <div class="rate-count">(<span>{{$data->rate}}</span>)</div>
    </div>
    <p>{{$data->review}}</p>
  </div>
</div>



             Product Cart Page
========================================================================================================================================================================================================================
<?php
        Table:

    Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->string('product_name');
            $table->string('product_price');
            $table->string('product_code');
            $table->string('product_color');
            $table->integer('quantity');
            $table->string('user_email');
            $table->string('session_id');
            $table->timestamps();
        });

// Route for add to cart
Route::match(['get','post'],'add-cart','ProductController@addtoCart')

 if (empty($data['session_id'])){
       $data['session_id'] = '';
    }

    public function addtoCart(Request $request){
        $data = $request->all();
        //echo "<pre>";print_r($data);die;
        if (empty($data['user_email'])) {
            $data['user_email'] = '';
        }

        $session_id = Session::get('session_id');
        if(empty($session_id)){
        $session_id = str_random(40);
        Session::put('session_id',$session_id);
        }
          
        ///Cart save
    DB::table('carts')->insert([
        'product_id'=>$data['product_id'],
        'product_name'=>$data['product_name'],
        'product_code'=>$data['product_code'],
        'price'=>$data['product_price'],
        'quantity'=>$data['quantity'],
        'user_email'=>$data['user_email'],
        'session_id'=>$session_id]
        );
    
   return redirect('cart')->with('flash_message_success','Product has been added in Cart!');
    }

?>

    Example:

     <form action="{{url('add-cart')}}" method="post">
                        @csrf
<input type="hidden" name="product_color" value="{{ $productDetails->product_color }}">
<input type="hidden" name="product_id" value="{{$productDetails->id}} ">
<input type="hidden" name="product_name" value="{{$productDetails->product_name}} ">
 <input type="hidden" name="product_code" value="{{$productDetails->product_code}} ">
  <input type="hidden" name="product_price" value="{{$productDetails->product_price}} ">

<div class="product-information"><!--/product-information-->
    <img src="images/product-details/new.jpg" class="newarrival" alt="" />
    <h2>{{$productDetails->product_name}} Scuba</h2>
    <p>Web ID: 1089772</p>
    <img src="" alt="" />
    <span>
        <span>US ${{$productDetails->product_price}} </span>
        <label>Quantity:</label>
        <input type="text" name="quantity" value="3" />                                   
        <button type="submit" class="btn btn-fefault cart">
            <i class="fa fa-shopping-cart"></i>
            Add to cart
        </button>
       
    </span>
    <p><b>Availability:</b> In Stock</p>
    <p><b>Condition:</b> New</p>
    <p><b>Brand:</b> E-SHOPPER</p>
    <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
</div><!--/product-information-->
 </form>
	

// Cart Page
Route::match(['get', 'post'],'/cart','ProductsController@cart');


    public function cart(Request $request){
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
          
        foreach($userCart as $key=>$products){
            $productDetails = Product::where(['id'=>$products->product_id])->first();
            $userCart[$key]->image = $productDetails->image;
             } 
      return view('Frontend.add_cart',compact('userCart'));
        
        }


Example::

<?php $total_amount = 0; ?>
                        @foreach($userCart as $cart)
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img style="width:100px;" src="{{ asset('/images/backend_images/product/small/'.$cart->image) }}" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $cart->product_name }}</a></h4>
                                    <p>Product Code: {{ $cart->product_code }}</p>
                                </td>
                                <td class="cart_price">
                                    <?php $product_price = Product::getProductPrice($cart->product_id,$cart->size); ?>
                                    <p>INR {{ $product_price }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" href="{{ url('/cart/update-quantity/'.$cart->id.'/1') }}"> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity" value="{{ $cart->quantity }}" autocomplete="off" size="2">
                                        @if($cart->quantity>1)
                                            <a class="cart_quantity_down" href="{{ url('/cart/update-quantity/'.$cart->id.'/-1') }}"> - </a>
                                        @endif
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">INR {{ $product_price*$cart->quantity }}</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="{{ url('/cart/delete-product/'.$cart->id) }}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            <?php $total_amount = $total_amount + ($product_price*$cart->quantity); ?>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a coupon code you want to use.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <form action="{{ url('cart/apply-coupon') }}" method="post">{{ csrf_field() }}
                                <label>Coupon Code</label>
                                <input type="text" name="coupon_code">
                                <input type="submit" value="Apply" class="btn btn-default">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        @if(!empty(Session::get('CouponAmount')))
                            <li>Sub Total <span>INR <?php echo $total_amount; ?></span></li>
                            <li>Coupon Discount <span>INR <?php echo Session::get('CouponAmount'); ?></span></li>
                            <?php 
                            $total_amount = $total_amount - Session::get('CouponAmount');
                            $getCurrencyRates = Product::getCurrencyRates($total_amount); ?>
                            <li>Grand Total <span class="btn-secondary" data-toggle="tooltip" data-html="true" title="
                                USD {{ $getCurrencyRates['USD_Rate'] }}<br>
                                GBP {{ $getCurrencyRates['GBP_Rate'] }}<br>
                                EUR {{ $getCurrencyRates['EUR_Rate'] }}
                                ">INR <?php echo $total_amount; ?></span></li>
                        @else
                            <?php $getCurrencyRates = Product::getCurrencyRates($total_amount); ?>
                            <li>Grand Total <span class="btn-secondary" data-toggle="tooltip" data-html="true" title="
                                USD {{ $getCurrencyRates['USD_Rate'] }}<br>
                                GBP {{ $getCurrencyRates['GBP_Rate'] }}<br>
                                EUR {{ $getCurrencyRates['EUR_Rate'] }}
                                ">INR <?php echo $total_amount; ?></span></li>
                        @endif
                    </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="{{ url('/checkout') }}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->

@endsection
                            


Cart remove
......................................................
Route::get('/cart/delete-product/{id}','ProductController@deleteCartProduct');

 public function deleteCartProduct($id=null){
        DB::table('carts')->where('id',$id)->delete();
        return redirect('/cart');
    }


Example:

<td class="cart_delete">
    <a class="cart_quantity_delete" href="{{ url('/cart/delete-product/'.$cart->id) }}"><i class="fa fa-times"></i></a> 
</td>




                Cart Update
......................................................
Route::get('/cart/update-quantity/{id}/{qty}','ProductController@updatequantity');


    public function updatequantity($id = null, $quantity = null){

        DB::table('carts')->where('id',$id)->increment('qty', $quantity);
       
        return redirect('/cart');
    }


Example:

<td class="cart_quantity">
   <div class="cart_quantity_button">
     <a class="cart_quantity_up" href="{{ url('/cart/update-quantity/'.$cart->id.'/1') }}"> + </a>
       <input class="cart_quantity_input" type="text" name="quantity" value="{{ $cart->quantity }}" autocomplete="off" size="2">
        @if($cart->quantity>1)
        <a class="cart_quantity_down" href="{{ url('/cart/update-quantity/'.$cart->id.'/-1') }}"> - </a>
        @endif
        </div>
 </td>





              Product Checkout Page
========================================================================================================================================================================================================================
<?php
Route::match(['get','post'],'/checkout','Frontend\ProductController@checkout');
Route::match(['get','post'],'/checkout','UsersController@checkout');


 public function checkout(Request $request){
        $user_id = Auth::user()->id;
        $user_email =Auth::user()->email;
        $userDetails =User::find($user_id);
        $countries = Country::get();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
          
      





        if($request->isMethod('post')){
          $user_id = Auth::user()->id;
        $user_email =Auth::user()->email;
            $data=$request->all();
         	//echo "<pre>";print_r($data);die;
            
         	$billing = User::find($user_id);

         	$billing->email = $user_email;
         	$billing->name = $data['name'];
            $billing->last_name = $data['last_name'];
            $billing->address = $data['address'];
            $billing->city = $data['city'];
            $billing->state= $data['state'];
            $billing->country =$data['country'];
            $billing->save();

          $userDetails = User::where(['email'=>$user_email])->first();
          // echo "<pre>";print_r($userDetails);die;
            $order = new Order();
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $userDetails->name;
            $order->address = $userDetails->address;
            $order->city = $userDetails->city;
            $order->state = $userDetails->state;
            $order->order_status = "New";
            $order->payment_method = $data['payment_method'];
            $order->Save();


             $order_id = DB::getPdo()->lastinsertID();

            $catProducts = DB::table('carts')->where(['user_email'=>$user_email])->get();
            // echo "<pre>";print_r($catProducts);die;
            foreach($catProducts as $pro){
                $cartPro = new OrderProduct;
                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $pro->product_id;
               
                $cartPro->name = $pro->name;
                
                $cartPro->price = $pro->price;
                $cartPro->quantity = $pro->quantity;
                $cartPro->save();
                 
            }
           Session::put('order_id',$order_id);
             return redirect('/thanks');
            
        }


      return view('frontend.cart.checkout',compact('userDetails','countries','userCart'));     
     } 


      public function thanks(){
        $user_email = Auth::user()->email;
        DB::table('carts')->where('user_email',$user_email)->delete();
        return view('frontend.cart.thanks');
    }





<??>

<div class="cart-detail my-5">
           <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input id="credit" name="payment_method" value="cod"  type="radio" class="custom-control-input cod">
                    <label class="custom-control-label" for="credit">Cash On Delivery</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="debit" name="payment_method" value="paypal" type="radio" class="custom-control-input paypal" >
                    <label class="custom-control-label" for="debit">Paypal</label>
                </div>
                <div class="col-12 d-flex shopping-box">
                    <button  type="submit" class="btn btn-primary btn-animated btn-block" onclick="return selectPaymentMethod();">Place Order</button> 
                </div>
            </div>
         
        </div>


<script type="text/javascript">
   function selectPaymentMethod(){
      if($('.paypal').is(':checked') || $('.cod').is(':checked')){
        //alert('checked');
      }else{
        alert('Please Select Payment Method');
        return false;
      }
    }
</script>






example :
<div class="page-content">

<section class="checkout-page">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-md-12">
        <div class="checkout-form box-shadow white-bg">
          <h4 class="mb-4 font-w-6">Billing Details</h4>
          <form class="row" method="post" action="{{url('/checkout')}}">
            @csrf
            <div class="col-md-6">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" id="name" value="{{$userDetails->name}}" name="name" class="form-control" placeholder="Your firstname">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Your lastname">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>E-mail Address</label>
                <input type="text" id="email" name="email" value="{{$userDetails->email}}" class="form-control" placeholder="E-mail">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Select Country</label>
                <select name="country" id="country" class="form-control">
                    <option value="0">Select country</option>
                  @foreach($countries as $country)
                    <option value="{{$country->country_code}}">{{$country->country_name}}</option>
                  @endforeach
                    
                  </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Address</label>
                <input type="text" id="address" name="address" class="form-control" placeholder="Enter Your Address">
              </div>

            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Town/City</label>
                <input type="text" id="city" name="city" class="form-control" placeholder="Town or City">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-md-0">
                <label>State/Province</label>
                <input type="text" id="state" name="state" class="form-control" placeholder="State Province">
              </div>
            </div>
          
        </div>
      </div>
      <div class="col-lg-5 col-md-12 mt-5 mt-lg-0">
        <div class="border bg-light-4 p-3 p-lg-5">
          <div class="mb-7">
              <label class="text-black mb-3">Enter your coupon code if you have one</label>
              <div class="input-group">
                <input class="form-control" id="c-code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2" type="text">
                <div class="input-group-append">
                  <button class="btn btn-primary btn-sm px-4" type="button" id="button-addon2">Apply</button>
                </div>
              </div>
            </div>
        <div class="mb-7">
          <h6 class="mb-3 font-w-6">Your Order</h6>
          <ul class="list-unstyled">
           @foreach($userCart as $cart)
            <li class="mb-3 border-bottom pb-3 d-flex"><span class="mr-auto">  {{$cart->name}} </span> <span>$2399.00</span></li>
            @endforeach
            <li class="d-flex"><span class="mr-auto"><strong class="cart-total"> Total :</strong></span>  <strong class="cart-total">$2399.00 </strong>
            </li>
          </ul>
        </div>
       
          @include('frontend.cart.payment')
       
        </div>
       </form>
      </div>
    </div>
  </div>
</section>
</div>


	 		 Product Account  Page
========================================================================================================================================================================================================================
<?php


//Route for middleware after front login
Route::group(['middleware' => ['frontlogin']],function(){

Route::get('/account','UsersController@account')->name('account');

//Route for users account



Route::match(['get','post'],'/my-order','UsersController@myorder')->name('my.order');

Route::match(['get','post'],'/my-address','UsersController@myaddress')->name('my.address');

Route::match(['get','post'],'/update-address/{id}','UsersController@updateaddress')->name('update.address');

Route::get('add/to-wishlist/{product_id}','UsersController@addtowishlist');

Route::get('/wishlist','UsersController@wishlistpage');

Route::get('wishlist/delete/{$id}','UsersController@wishlistdelete');


Route::get('/wishlist/delete-product/{id}','UsersController@deletewishlisttProduct');








Route::match(['get','post'],'/account/update/{id}','UsersController@accountupdate')->name('account.update');
Route::match(['get','post'],'/change-password','UsersController@changePassword');
Route::match(['get','post'],'/change-address','UsersController@changeAddress');

Route::match(['get','post'],'/checkout','UsersController@checkout');
Route::match(['get','post'],'/order-view','ProductController@orderview');
Route::match(['get','post'],'/place-order','ProductController@placeorder');
Route::get('/thanks','UsersController@thanks');
/////User Order//////

Route::get('/orders','ProductController@userorders');

});





 public function account(){
 	$user_id = Auth::user()->id;
  $userDetails =User::find($user_id);

  $orders = Order::with('orders')->where('user_id',$user_id)->orderBy('id','DESC')->get();

   return view('frontend.account.account',compact('userDetails','orders'));
  	} 



     public function myorder(){
      return view('frontend.account.orders');
    }


     public function myaddress(){
       $userDetails = Auth::user();
      return view('frontend.account.address',compact('userDetails'));
    }


    public function updateaddress(Request $request,$id){

       $user = User::where('id',$id)->update(['name'=>$request->name,'last_name'=>$request->last_name,'email'=>$request->email,'address'=>$request->address,'city'=>$request->city,'state'=>$request->state,'country'=>$request->country]);

       return redirect()->back();

    }




    public function accountdetails(){
        $userDetails = Auth::user();
          
      return view('frontend.account.account-detail',compact('userDetails'));
    }



    public function accountupdate(Request $request,$id){

      $haspassword = Auth::user()->password;

      if ($request->oldpassword==null && $request->newpassword==null) {

       User::where('id',$id)->update(['name'=>$request->name,'last_name'=>$request->last_name,'email'=>$request->email]);
       return redirect()->back()->with('success','Account Successfully Updated!');

      }else{

$password=User::where('id',$id)->update(['name'=>$request->name,'last_name'=>$request->last_name,'email'=>$request->email,
                'password'=>Hash::make($request->newpassword)]);
             
                return redirect()->back()->with('success','Account Successfully Updated!');



        }
    }







?>



	 		 Product Wishlist  Page
========================================================================================================================================================================================================================
<?
table:

Schema::create('wishlists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->date('date');
            $table->timestamps();
        });






    public function addtowishlist($product_id){
  
        Wishlist::insert([
          'user_id' => Auth::id(),
          'product_id' => $product_id,
         ]);

        return redirect()->back();

    }



      public function wishlistpage(){
        $wishlists = Wishlist::where('user_id',Auth::id())->latest()->get();
        return view('frontend.cart.wishlist',compact('wishlists'));
      }


     public function deletewishlisttProduct($id=null){
        DB::table('wishlists')->where('id',$id)->delete();
        return redirect()->back();
    }


?>
Example:

<div class="page-content">

<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <table class="cart-table table">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
             
             @foreach($wishlists as $wishlist)
              <tr>
                <td>
                  <div class="cart-thumb media align-items-center">
                    <a href="#">
                      <img class="img-fluid" src="assets/images/product/p13.jpg" alt="">
                    </a>
                    <div class="media-body ml-3">
                      <div class="product-title mb-2"><a class="link-title" href="#">{{$wishlist->product->name}}</a>
                      </div>
                    </div>
                  </div>
                </td>
                <td> <span class="product-price text-muted">{{$wishlist->product->price}}</span>
                </td>
                <td>
                  <div class="d-flex align-items-center">
                    <button class="btn-product btn-product-up"> <i class="las la-minus"></i>
                    </button>
                    <input class="form-product" type="number" name="form-product" value="1">
                    <button class="btn-product btn-product-down"> <i class="las la-plus"></i>
                    </button>
                  </div>
                </td>
                <td> 

                	 <form action="{{url('add-cart')}}" method="post">
                       @csrf
                  <input type="hidden" name="name" value="{{ $wishlist->product->name }}">
                  <input type="hidden" name="price" value="{{ $wishlist->product->price}}">
                  <input type="hidden" name="product_id" value="{{ $wishlist->product->id}}">
            
                   <input type="hidden" name="quantity" value="1">
                    

                          <div class="card-footer bg-transparent border-0">
                            <div class="product-link d-flex align-items-center justify-content-center">

                              <button class="btn-cart btn btn-pink mx-3" type="submit"><i class="las la-shopping-cart mr-1"></i> Add to cart </button>
                            </div>
                          </div>
                      </form>



                 <a href="{{ url('/wishlist/delete-product/'.$wishlist->id) }}" class="close-link"><i class="las la-times"></i></a>
                </td>
              </tr>
             @endforeach
             
            </tbody>
          </table>
        </div>
        
      </div>
      
    </div>
    
  </div>
</section>

</div>














====================================================================================================================================================================================
    
           Admin Code
====================================================================================================================================================================================








           			 Admin Section
=============================================================================================================================
<?php
DataTable:

            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->integer('status');
            $table->timestamps();




Route::prefix('/admin')->namespace('Admin')->group(function(){
        //All Admin Route Here
Route::match(['get','post'],'/','AdminController@login');

 Route::group(['middleware' => ['admin']],function(){

    Route::get('/dashboard', 'AdminController@dashboard');
    Route::get('/settings', 'AdminController@settings');
    Route::post('/check-current-pwd', 'AdminController@checkcurrentpwd');
    Route::post('/update-current-pwd', 'AdminController@updatecurrentpwd')->name('update.password');
    Route::get('/logout', 'AdminController@logout');
    
 });

});


<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Admin;

class AdminController extends Controller
{
    
     public function dashboard(){
        return view('backend.layouts.index');
     }

     public function login(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>";print_r($data);die;

             $validated = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
            ]);


         if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){

                return redirect('admin/dashboard');
            }else{
                return redirect()->back()->with('flash_message_error','Invalid Email or Password!');
            }

        }

     return view('backend.layouts.login');
     }



    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }




    public function settings(){
        $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();
        
    return view('backend.admin.setting',compact('adminDetails'));
    }


    public function checkcurrentpwd(Request $request){
         $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        if (Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)) {
            echo "true";
        }else{
            echo "false";
        }
    }



    public function updatecurrentpwd(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
        if (Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){

                if($data['new_pwd']==$data['comfirm_pwd']){

                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bCrypt($data['new_pwd'])]);
                return redirect()->back()->with('flash_message_success','Password Update Successfully!');

                }else{
                return redirect()->back()->with('flash_message_error','Your New and Comfirm  Password Does not match');
                }



            }else{
                return redirect()->back()->with('flash_message_error','Your Current Password is Incorrect');
            }

        }


    }

}

?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#current_pwd").keyup(function(){
      var current_pwd = $("#current_pwd").val();

        $.ajax({
        url:"/admin/check-current-pwd",
        type:"post",
        data:{current_pwd:current_pwd},
        success:function(resp){
          if (resp=="false") {
            $("#checkcurrentpwd").html("<font color=red>Current Password is Incorrect</font>");
          }else{
              $("#checkcurrentpwd").html("<font color=green>Current Password is correct</font>")
          }
        },error:function(){
          alert('error');
        }

      });
    });

  });
</script>




                    Brand Section
==============================================================================================================================

<?php

table->string('brand_name');
App\Brand

 public function allbrand(){
        $brands= Brand::all();
        return view('Backend.all_brand',compact('brands'));
        }


        public function addbrand(){
      
             return view('Backend.add_brand');
        }

        public function brandinsert(Request $request)

        {
           $brand= new Brand();
            $brand->brand_name = $request->brand_name;  
            $brand->save();
            return redirect()->back();

        }

        public function branddelete($id){
            $delete=Brand::find($id); 
            $delete->delete();
             return view('Backend.add_brand');
        }
        public function brandedit($id){
            $edits=Brand::find($id); 
            return view('Backend.edit_brand',compact('edits'));
        }


        public function brandupdate(Request $request,$id){
            $brand= Brand::find($id);
            $brand->brand_name = $request->brand_name;  
            $brand->save();
            return redirect()->route('all.brand');
        }

{{route('brand.update',$edits->id)}}
{{url('/edit-brand/'.$brand->id)}}
      
Route::get('/all-brand', 'CategoryController@allbrand')->name('all.brand');
Route::get('/add-brand', 'CategoryController@addbrand')->name('add.brand');

Route::post('/insert-brand', 'CategoryController@brandinsert')->name('insert.brand');

Route::get('/edit-brand/{id}', 'CategoryController@brandedit')->name('brand.edit');

Route::post('/brand-update/{id}', 'CategoryController@brandupdate')->name('brand.update');

Route::get('/delete-brand/{id}', 'CategoryController@branddelete')->name('brand.delete');


?>
     










      					Category Section 
==============================================================================================================================



<?
 //Backend Categories Routes
   Route::get('/all-category', 'CategoryController@allcategory')->name('all.category');
Route::get('/add-category', 'CategoryController@addcategory')->name('add.category');

Route::post('/insert-category', 'CategoryController@categoryinsert')->name('insert.category');

Route::get('/edit-category/{id}', 'CategoryController@categoryedit')->name('category.edit');

Route::post('/category-update/{id}', 'CategoryController@categoryupdate')->name('category.update');

Route::get('/delete-category/{id}', 'CategoryController@categorydelete')->name('category.delete');



 Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_name');
            $table->integer('parent_id');
            $table->string('description');
            $table->string('url');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }





	public function all(){
        $categories= Category::all();
        return view('Backend.all_category',compact('categories'));
      }


	public function add() {
   		 $cat= Category::all();
    	return view('Backend.add_category',compact('cat'));
	}


<div class="form-group">
<label>Parent Category</label>
        <select name="parent_id" id="parent_id" class="form-control">
                     <option value="0">Parent Category</option>
                  @foreach($cat as $val)
                 <option value="{{$val->id}}">{{$val->category_name}}</option>
                  @endforeach
                   
         </select>
 </div>


  	public function insert(Request $request) {
                $data= new Category();
                $data->category_name = $request->category_name;
                $data->parent_id = $request->parent_id;
                $data->url = $request->url;
                $data->save();
               return redirect()->back();
    	}


     public function categoryedit($id){
           $editdata =Category::find($id); 
           $parent_cat= Category::all();
            return view('backend.category.edit_category',compact('editdata','parent_cat'));
   		 }


		/////edit category
 		$categories= Category::all();
  			 @foreach($categories as $val)
			<option value="{{$val->id}}" <?php if($val->id == $editdata->parent_id): echo "selected";?> <?php endif; ?>  >{{$val->category_name}}
		</option>                  
		@endforeach




 		..View Category....
 @if(!isset($category['parent']['category_name']))
 <?php $parent_category = 'root';?>
 @else  
 <?php $parent_category = $category['parent']['category_name']; ?>
 @endif

   <td>{{$parent_category }}</td>





   		<main>model </main>
  public function parent(){
        return $this->belongsTo(Category::class,'parent_id');
    }


 public function update(Request $request,$id){
        $data= Category::find($id);
        $data->category_name = $request->category_name;
        $data->parent_id = $request->parent_id;
        $data->url = $request->url;
        $data->save()
        return redirect()->route('all.category');
}


public function delete($id){
     $delete= Category::find($id);
     $delete->delete();
    return redirect()->route('all.category');
 }


  
    public function category(){
    return $this->belongsTo(Category::class, 'category_id', 'id');
    }


Category Active/Deactive:
=========================
=========================
<td>  @if($category->status==1) 
<a  class="updateCategoryStatus" id="category-{{ $category->id }}" category_id="{{ $category->id }}" href="javascript:void(0)">Active</a>
    @else 
<a class="updateCategoryStatus" id="category-{{ $category->id }}" category_id="{{ $category->id }}" href="javascript:void(0)">Inactive</a>
 @endif
</td>


<script >
  $(document).ready(function(){

    $(".updateCategoryStatus").click(function(){
      var status = $(this).text();
      var category_id = $(this).attr("category_id");
      
        $.ajax({
        url:"/admin/update-category-status",
        type:"post",
        data:{status:status,category_id:category_id},
        success:function(resp){
         if (resp['status']==0) {
            $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>Inactive</a>");
         }else{
           $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)'>Active</a>");
         }
        },error:function(){
          alert('error');
        }

      });

    });
  });
</script>


<?php
Route::post('/admin/update-category-status', 'Backend\CategoryController@updatecategoystatus');

 public function updatecategoystatus(Request $request){
       if ($request->ajax()) {

        $data = $request->all();
       //echo "<pre>"; print_r($data);die;
        if ($data['status']=='Active') {
            $status = 0;  
        }else{
           $status = 1;  
        }

    Category::where('id',$data['category_id'])->update(['status'=>$status]);
    return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);

    }

    }

?>






             Coupon Section
===================================================================================================================================
<?
// Admin Coupon Routes
    Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');
    Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponsController@editCoupon');
    Route::get('/admin/view-coupons','CouponsController@viewCoupons');
    Route::get('/admin/delete-coupon/{id}','CouponsController@deleteCoupon');


 Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('coupon_code');
            $table->integer('amount');
            $table->string('amount_type');
            $table->date('expiry_date');
            $table->timestamps();
        });



  public function addCoupon(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            $coupon = new Coupon;
            $coupon->coupon_code = $data['coupon_code'];    
            $coupon->amount_type = $data['amount_type'];    
            $coupon->amount = $data['amount'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->status = $data['status'];
            $coupon->save();    
            return redirect()->action('CouponsController@viewCoupons')->with('flash_message_success', 'Coupon has been added successfully');
        }
        return view('admin.coupons.add_coupon');
    }  

    public function editCoupon(Request $request,$id=null){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            $coupon = Coupon::find($id);
            $coupon->coupon_code = $data['coupon_code'];    
            $coupon->amount_type = $data['amount_type'];    
            $coupon->amount = $data['amount'];
            $coupon->expiry_date = $data['expiry_date'];
            if(empty($data['status'])){
                $data['status'] = 0;
            }
            $coupon->status = 1;
            $coupon->save();    
            return redirect()->action('CouponsController@viewCoupons')->with('flash_message_success', 'Coupon has been updated successfully');
        }
        $couponDetails = Coupon::find($id);
        /*$couponDetails = json_decode(json_encode($couponDetails));
        echo "<pre>"; print_r($couponDetails); die;*/
        return view('admin.coupons.edit_coupon')->with(compact('couponDetails'));
    } 

    public function viewCoupons(){
        $coupons = Coupon::orderBy('id','DESC')->get();
        return view('admin.coupons.view_coupons')->with(compact('coupons'));
    }

    public function deleteCoupon($id = null){
        Coupon::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Coupon has been deleted successfully');
    }



?>


             


               

                Product Section
===================================================================================================================================
<?php
    
   Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->integer('section_id');
            $table->string('product_name');
            $table->string('product_code');
            $table->string('product_price');
            $table->string('product_color');
            $table->string('product_video');
            $table->string('product_discount');
            $table->string('sleeve')->nullable();
            $table->enum('is_feature',['Yes','No']);
            $table->string('image')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();  
        });



    // Admin Products Routes
    Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
    Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
    Route::get('/admin/delete-product/{id}','ProductsController@deleteProduct');
    Route::get('/admin/view-products','ProductsController@viewProducts');
    Route::get('/admin/export-products','ProductsController@exportProducts');
    Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');
    Route::get('/admin/delete-product-video/{id}','ProductsController@deleteProductVideo');
    
    Route::match(['get', 'post'], '/admin/add-images/{id}','ProductsController@addImages');
    Route::get('/admin/delete-alt-image/{id}','ProductsController@deleteProductAltImage');
////////////////details///////////////

// Product Detail Page
Route::get('/product/{id}','ProductsController@product');




    public function addProduct(Request $request){

        if ($request->isMethod('post')) {
           $data = $request->all();

           //echo "<pre>"; print_r($data);die;
 
    if(!empty($data['product_video'])){
      $data['product_video'] = "";
        }
    $product = new Product;
    $categoryDetails =Category::find($data['category_id']);
    $product->section_id = $categoryDetails['section_id'];
    $product->category_id = $data['category_id'];
    $product->product_name = $data['product_name'];
    $product->product_code = $data['product_code'];
    $product->product_color = $data['product_color'];
    $product->product_price = $data['product_price'];
    $product->product_discount = $data['product_discount'];
    $product->sleeve = $data['sleeve'];
    $product->status = 1;

    if(!empty($data['is_featured'])){
                $is_featured = "No";
        }else{

        $is_featured = "Yes";
        }
    $product->is_featured =$is_featured;
    

            // Upload Image
              $image=$request->file('image');
            if ($image) {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $product['image']=$image_url;
            $product->save();
            }  
            $product->save();
            return redirect()->back()->with('flash_message_success', 'Product has been added successfully');
        }



        $categories = Section::with('categories')->get();
        //echo "<pre>";print_r($categories);die;
        $productFilters = Product::productFilters();
        $sleevearray = $productFilters['sleevearray'];

        return view('admin.products.add_product',compact('categories','sleevearray'));
    }


        public function viewProducts(){
            $products = Product::orderBy('id','DESC')->get();
            return view('admin.products.view_products')->with(compact('products'));
        }



Top Product:
===========
==========
<??>
<div class="control-group">
                <label class="control-label">Is featyure</label>
                <div class="controls">
                  <input type="checkbox" name="is_feature" id="is_feature" value="No">
                </div>
 </div>


 if(!empty($data['is_feature'])){
                $is_feature = "Yes";
        }else{

            $is_feature = "No";
        }
$product->is_feature =$is_feature;
    


Upload Image:
=============
============

 <div class="form-group">
    <label>product Image</label>
    <input type="file" name="image" id="image" class="form-control" multiple>
</div>

 <div class="form-group">
   <div id="image_preview2" style="width:100%;">               
   </div>
</div>


            <div class="form-group">
                <label for="images">Images</label>
                <input type="file" name="images[]" id="images" multiple class="form-control" required>
              </div>

              <div class="form-group">
                <div id="image_preview" style="width:100%;">
                  
                </div>
              </div>

<script type="text/javascript">
  $(document).ready(function() {
  var fileArr = [];
   $("#images").change(function(){
      // check if fileArr length is greater than 0
       if (fileArr.length > 0) fileArr = [];

        $('#image_preview').html("");
        var total_file = document.getElementById("images").files;
        if (!total_file.length) return;
        for (var i = 0; i < total_file.length; i++) {
          if (total_file[i].size > 1048576) {
            return false;
          } else {
            fileArr.push(total_file[i]);
            $('#image_preview').append("<div class='img-div' id='img-div"+i+"'><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-responsive image img-thumbnail' title='"+total_file[i].name+"'><div class='middle'><button id='action-icon' value='img-div"+i+"' class='btn btn-danger' role='"+total_file[i].name+"'><i class='fa fa-trash'></i></button></div></div>");
          }
        }
   });
  
  $('body').on('click', '#action-icon', function(evt){
      var divName = this.value;
      var fileName = $(this).attr('role');
      $(`#${divName}`).remove();
    
      for (var i = 0; i < fileArr.length; i++) {
        if (fileArr[i].name === fileName) {
          fileArr.splice(i, 1);
        }
      }
    document.getElementById('images').files = FileListItem(fileArr);
      evt.preventDefault();
  });
  
   function FileListItem(file) {
            file = [].slice.call(Array.isArray(file) ? file : arguments)
            for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
            if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
            for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
            return b.files
        }
});
</script>



<script type="text/javascript">
  $(document).ready(function() {
  var fileArr = [];
   $("#image").change(function(){
      // check if fileArr length is greater than 0
       if (fileArr.length > 0) fileArr = [];

        $('#image_preview2').html("");
        var total_file = document.getElementById("image").files;
        if (!total_file.length) return;
        for (var i = 0; i < total_file.length; i++) {
          if (total_file[i].size > 1048576) {
            return false;
          } else {
            fileArr.push(total_file[i]);
            $('#image_preview2').append("<div class='img-div' id='img-div"+i+"'><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-responsive image img-thumbnail' title='"+total_file[i].name+"'><div class='middle'><button id='action-icon' value='img-div"+i+"' class='btn btn-danger' role='"+total_file[i].name+"'><i class='fa fa-trash'></i></button></div></div>");
          }
        }
   });
  
  $('body').on('click', '#action-icon', function(evt){
      var divName = this.value;
      var fileName = $(this).attr('role');
      $(`#${divName}`).remove();
    
      for (var i = 0; i < fileArr.length; i++) {
        if (fileArr[i].name === fileName) {
          fileArr.splice(i, 1);
        }
      }
    document.getElementById('image').files = FileListItem(fileArr);
      evt.preventDefault();
  });
  
   function FileListItem(file) {
            file = [].slice.call(Array.isArray(file) ? file : arguments)
            for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
            if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
            for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
            return b.files
        }
});
</script>



<style type="text/css">
  .img-div {
    position: relative;
    width: 46%;
    float:left;
    margin-right:5px;
    margin-left:5px;
    margin-bottom:10px;
    margin-top:10px;
}

.image {
    opacity: 1;
    display: block;
    width: 100%;
    max-width: auto;
    transition: .5s ease;
    backface-visibility: hidden;
}

.middle {
    transition: .5s ease;
    opacity: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    text-align: center;
}

.img-div:hover .image {
    opacity: 0.3;
}

.img-div:hover .middle {
    opacity: 1;
}
</style>



Backend Category Show::
============================
============================

 $categories = Category::where(['parent_id'=>0])->get();

..........................sub category.......................

   <div class="form-group">
     <label> Select Category</label>
    <select name="category_id" id="category_id" class="form-control">
       <option value="0">Select Category for product</option> 

@foreach($categories as $parent)
 <option value="{{$parent->id}}">{{ $parent->category_name}}</option> 
@foreach(App\Model\Category::where('parent_id', $parent->id)->get() as $subcategory)
 <option value="{{$subcategory->id}}">----{{ $subcategory->category_name}}</option> 

@endforeach

@endforeach

    </select>                   
  </div>
         

















































........................................................................................................................................
    
                 Account comfirmation send
........................................................................................................................................

///////////order email/////////////////////



                $productDetails = Order::with('orders')->where('id',$order_id)->first();
                $productDetails = json_decode(json_encode($productDetails),true);
                /*echo "<pre>"; print_r($productDetails);*/ /*die;*/

                $userDetails = User::where('id',$user_id)->first();
                $userDetails = json_decode(json_encode($userDetails),true);
                /*echo "<pre>"; print_r($userDetails); die;*/
                /* Code for Order Email Start */
                $email = $user_email;
                $messageData = [
                    'email' => $email,
                    'name' => $shippingDetails->name,
                    'order_id' => $order_id,
                    'productDetails' => $productDetails,
                    'userDetails' => $userDetails
                ];
                Mail::send('emails.order',$messageData,function($message) use($email){
                    $message->to($email)->subject('Order Placed - E-com Website');    
                });
                /* Code for Order Email Ends */



?>



    
    		User Login And Register Page
=============================================================================================================================================================================================


@if(empty(Auth::check()))
 <li><a href="{{url('/login-register')}}"><i class="fa fa-lock"></i> Login</a></li>
  @else

 <li><a href="{{url('/user-logout')}}"><i class="fa fa-lock"></i> Login out</a></li>
@endif



<?php
Route::get('/login-register','UsersController@userLoginRegister');
//Route for login-User
Route::post('/user-login','UsersController@login');
//Route for add users registration
Route::post('/user-register','UsersController@register');
//Route for add users registration
Route::get('/user-logout','UsersController@logout');
// Route for add to cart




<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
use Auth;
use Session;
use App\Country;
class UsersController extends Controller
{
   public function userLoginRegister(){
        return view('Frontend.login_register');
    }

public function register( Request $request){

 if($request->isMethod('post')){
            $data = $request->all();
          //echo "<pre>"; print_r($data); die;
            $userCount = User::where('email',$data['email'])->count();

            if($userCount>0){
                return redirect()->back()->with('flash_message_error','Email is already exist');
            }else{
                //adding user in table
                $user = new User();
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();

                   // Send Confirmation Email
                $email = $data['email'];
                $messageData = ['email'=>$data['email'],'name'=>$data['name'],'code'=>base64_encode($data['email'])];
                Mail::send('emails.confirmation',$messageData,function($message) use($email){
                    $message->to($email)->subject('Confirm your E-com Account');
                });


                if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                   Session::put('frontSession',$data['email']);
                   return redirect('/cart');
                }
                   
                   
          
        }
    }


}

    public function confirmAccount($email){
        $email = base64_decode($email);
        $userCount = User::where('email',$email)->count();
        if($userCount > 0){
            $userDetails = User::where('email',$email)->first();
            if($userDetails->status == 1){
                return redirect('login-register')->with('flash_message_success','Your Email account is already activated. You can login now.');
            }else{
                User::where('email',$email)->update(['status'=>1]);

                // Send Welcome Email
                $messageData = ['email'=>$email,'name'=>$userDetails->name];
                Mail::send('emails.welcome',$messageData,function($message) use($email){
                    $message->to($email)->subject('Welcome to E-com Website');
                });

                return redirect('login-register')->with('flash_message_success','Your Email account is activated. You can login now.');
            }
        }else{
            abort(404);
        }
    }



public function logout(){
       Session::forget('frontSession');
       session::forget('session_id()');
       Auth::logout();
       return redirect('/');
   }



 public function login(Request $request){
       if($request->isMethod('post')){
           $data = $request->all();
           //echo "<pre>";print_r($data);die;
        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'], 'status' => '1'])){
            Session::put('frontSession',$data['email']);
            return redirect('/cart');
        }else{
            return redirect()->back()->with('flash_message_error','Invalid username and password!');
        }
       }
   }


 

}


        if(empty(Session::has('frontSession'))){
            return redirect('/login-register');
        }
        
return $next($request);
kannel.phpversion()
'frontlogin' => \App\Http\Middleware\frontlogin::class,



?>









Jquery validatation::
....................
<?
   public function checkEmail(Request $request){
        // Check if User already exists
        $data = $request->all();
        $usersCount = User::where('email',$data['email'])->count();
        if($usersCount>0){
            echo "false";
        }else{
            echo "true"; die;
        }   



$().ready(function(){
    // Validate Register form on keyup and submit
    $("#registerForm").validate({
        rules:{
            name:{
                required:true,
                minlength:2,
                accept: "[a-zA-Z]+"
            },
            password:{
                required:true,
                minlength:6
            },
            email:{
                required:true,
                email:true,
                remote:"/check-email"
            }
        },
        messages:{
            name:{ 
                required:"Please enter your Name",
                minlength: "Your Name must be atleast 2 characters long",
                accept: "Your Name must contain letters only"       
            }, 
            password:{
                required:"Please provide your Password",
                minlength: "Your Password must be atleast 6 characters long"
            },
            email:{
                required: "Please enter your Email",
                email: "Please enter valid Email",
                remote: "Email already exists!"
            }
        }
    });

    // Validate Register form on keyup and submit
    $("#accountForm").validate({
        rules:{
            name:{
                required:true,
                minlength:2,
                accept: "[a-zA-Z]+"
            },
            address:{
                required:true,
                minlength:6
            },
            city:{
                required:true,
                minlength:2
            },
            state:{
                required:true,
                minlength:2
            },
            country:{
                required:true
            }
        },
        messages:{
            name:{ 
                required:"Please enter your Name",
                minlength: "Your Name must be atleast 2 characters long",
                accept: "Your Name must contain letters only"       
            }, 
            address:{
                required:"Please provide your Address",
                minlength: "Your Address must be atleast 10 characters long"
            },
            city:{
                required:"Please provide your City",
                minlength: "Your City must be atleast 2 characters long"
            },
            state:{
                required:"Please provide your State",
                minlength: "Your State must be atleast 2 characters long"
            },
            country:{
                required:"Please select your Country"
            },
        }
    });

    // Validate Login form on keyup and submit
    $("#loginForm").validate({
        rules:{
            email:{
                required:true,
                email:true
            },
            password:{
                required:true
            }
        },
        messages:{
            email:{
                required: "Please enter your Email",
                email: "Please enter valid Email"
            },
            password:{
                required:"Please provide your Password"
            }
        }
    });

    $("#passwordForm").validate({
        rules:{
            current_pwd:{
                required: true,
                minlength:6,
                maxlength:20
            },
            new_pwd:{
                required: true,
                minlength:6,
                maxlength:20
            },
            confirm_pwd:{
                required:true,
                minlength:6,
                maxlength:20,
                equalTo:"#new_pwd"
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    // Check Current User Password
    $("#current_pwd").keyup(function(){
        var current_pwd = $(this).val();
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type:'post',
            url:'/check-user-pwd',
            data:{current_pwd:current_pwd},
            success:function(resp){
                /*alert(resp);*/
                if(resp=="false"){
                    $("#chkPwd").html("<font color='red'>Current Password is incorrect</font>");
                }else if(resp=="true"){
                    $("#chkPwd").html("<font color='green'>Current Password is correct</font>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    // Password Strength Script
    $('#myPassword').passtrength({
      minChars: 4,
      passwordToggle: true,
      tooltip: true,
      eyeImg : "/images/frontend_images/eye.svg"
    });

   



















   





   






























