<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="/images/favicon.ico" type="">
      <title>Dalbile Retail</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />

      
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header');
         <!-- end header section -->
         <!-- slider section -->
        
     
      <div>
      <div class="col-sm-6 col-md-4 col-lg-4 w-3 m-auto p-7">
                  
                     <div class="img-box p-2">
                        <img src="/product/{{$product->image}}" alt="product image">
                     </div>
                     <div class="detail-box">
                        <h5 class="display-6">
                           {{$product->title}}
                        </h5>
                       

                        @if($product->discount_price!=null)
                        <h6 class="text-danger">
                           Discount Price
                           <br>
                           ${{$product->discount_price}}
                        </h6>

                        
                        <h6 style="text-decoration: line-through; color:blue;">
                        Price 
                        <br>
                           ${{$product->price}}
                        </h6>

                        @else
                        
                        <h6 class="text-primary">
                           Price
                           <br>
                           ${{$product->price}}
                        </h6>
                        @endif

                        <h6>Product Category: {{$product->category}}</h6>
                        <h6>Product Details: {{$product->description}}</h6>
                        <h6>Available Quantity: {{$product->quantity}}</h6>

                        <form action="{{url('add_cart', $product->id)}}" method="POST">
                              @csrf
                           <div class="row">
                              <div class="col-md-4">
                              <input type="number" name="quantity" value="1" min="1" style="width:100%;">
                              </div>
                           <div class="col-md-4">
                           <input type="submit" value="Add to cart">
                           </div>
                          
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
    </div>

      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2024 All Rights Reserved By <a href="https://github.com/maxamedamin/">RMS</a><br>
         
          
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>