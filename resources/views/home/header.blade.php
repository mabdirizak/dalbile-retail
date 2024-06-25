<header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                 <a class="navbar-brand d-flex" href="{{ url('/') }}">
                    <div><img src="/images/dalbile.svg" style="height:20px; border-right: solid 1px #e25858;" class="pr-3"></div>
                    <div class="pl-3 pt-1">Dalbile Retail</div>
                </a>
                  
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <li class="nav-item active">
                           <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                        </li>
                       
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('products')}}">Products</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="https://www.retaildive.com/">Blog</a>
                        </li>
                        {{-- <li class="nav-item">
                           <a class="nav-link" href="#information_f">Contact</a>
                        </li> --}}

                        <li class="nav-item">
                           <a class="nav-link" href="{{url('show_cart')}}">Cart</a>
                        </li>

                        
                        <li class="nav-item">
                           <a class="nav-link" href="{{url('show_order')}}">Order</a>
                        </li>

                        <form class="form-inline">
                           <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                           <i class="fa fa-search" aria-hidden="true"></i>
                           </button>
                        </form>



                        @if (Route::has('login'))

                        @auth 
                        <li class="nav-item">
                           <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>           

                        </li>

                        @else
                        <li class="nav-item">
                           <a class="btn btn-primary mr-2" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                           <a class="btn btn-success" href="{{ route('register') }}">Register</a>
                        </li>
                        @endauth

                       @endif
                        
                     </ul>
                  </div>
               </nav>
            </div>
         </header>