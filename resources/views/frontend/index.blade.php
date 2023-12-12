@extends('frontend.layout.app')
@section('title','A-Mobile')
@php
    use App\Models\Favourite;
@endphp
@push('style')
{{-- <link rel="icon" href="{{ asset('images/logos/logo.png') }}"> --}}
    <style>
        @media screen and (max-width: 547px) {
            .my-cart{
                border-radius: 50px;
                width:30px;
                height:30px;
                background-color:#0b1c35;
                display: flex;
                justify-content: center;
                align-items: center;
                color: #ffffff;
            }

            .fa-shopping-cart{
                font-size: 12.2px;
            }

            .ads img{
                object-fit: fill;
            }

        }
    </style>
@endpush
@section('content')
    <section class="row justify-content-center">
       <div class="col-lg-12 col-12 px-3 px-lg-5">
         @include('frontend.layout.swiper_slider.slider')
          <div class="row sub-title p-2">
            <div class="col-12 py-lg-3 p-1">
                <div class="px-lg-1 d-flex justify-content-between align-items-lg-center ">
                   <div class="sub-title-inner-width d-block d-lg-flex justify-content-between align-items-center ">
                    <h3 class="mb-3 mb-lg-0 font-weight-bolder">Our New Arrivals</h3>
                    <div class="tab p-lg-2 tab-inner-width d-lg-flex  justify-content-lg-between mt-2">
                        <div class="tablinks rounded-4 active" onclick="opemTab(event, 'Phone')">Phone</div>
                        <div class="tablinks rounded-4" onclick="opemTab(event, 'Laptop')">Laptop</div>
                    </div>
                   </div>
                   <a href="{{ route('products.all.phone') }}" class="font-weight-bolder ">See All</a>
                </div>
            </div>
          </div>
          <div class="row new-arrivals-product mb-lg-5 p-2">
            <div class="col-12 p-lg-0 p-2">
                <div id="Phone" class="tabcontent">
                   <div class="row">
                    @forelse ($new_arrival_phones as $p)
                    <div class="col-6 p-0 mb-2 col-xl-3 p-lg-0  card-height d-flex justify-content-center">
                        <div class="card rounded-3">
                            <div  class="card-header border-0 p-0 text-center">
                                <a href="{{ route('product_detail',$p->id)}}">
                                @if (isset($p->OnePhoto->image))
                                <img src="{{ asset($p->OnePhoto->image)}}" alt="" class="product-photo">
                                @else
                                <img src="{{ asset('images/assets/default_product.png')}}" alt="" class="default-photo-bg product-photo">
                                @endif
                                </a>
                            {{-- Wishlist --}}
                                @if (session('wishlist'))
                                    @foreach (session('wishlist') as $key)
                                      @if($p->id == $key)
                                       <div data-id="{{ $p->id }}" class="addWishlistFarSession"><i class="far fa-heart"></i></div>
                                       <div data-id="{{ $p->id }}" class="addWishlistFasSession"><i class="fas fa-heart"></i></div>
                                     @else
                                       <div data-id="{{ $p->id }}" class="addWishlistFar"><i class="far fa-heart"></i></div>
                                      @endif
                                    @endforeach
                                @elseif(Favourite::where('product_id',$p->id)->where('user_id',Auth::id())->first())
                                   <div data-id="{{ $p->id }}" class="addWishlistFarAuth"><i class="far fa-heart"></i></div>
                                   <div data-id="{{ $p->id }}" class="addWishlistFasAuth"><i class="fas fa-heart"></i></div>
                                @else
                                   <div data-id="{{ $p->id }}" class="addWishlistFar" ><i class="far fa-heart"></i></div>
                                   <div data-id="{{ $p->id }}" class="addWishlistFas d-none"><i class="fas fa-heart"></i></div>
                                @endif
                            {{--End  Wishlist --}}
                            </div>
                            <div class="card-body p-2">
                                <div class="row p-lg-2">
                                    <div class="col-12 mb-lg-4 mb-2">
                                        <span class="product-title">{{ $p->title }}</span>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                        <span class="text-info font-weight-bolder price">$&nbsp;{{ $p->price }}</span>
                                         @if ($p->stock == 1)
                                         <div class="my-cart add-my-cart" data-id="{{ $p->id }}">
                                            <div class="d-flex  align-items-center">
                                               <span class="d-none d-xl-block p-1">Add To Cart</span> <i class="fas fa-shopping-cart"></i>
                                            </div>
                                         </div>
                                         @else
                                         <div class="my-cart outOfStock">
                                            <div class="d-flex align-items-center">
                                               <span class="d-none d-xl-block p-1">Add To Cart</span> <i class="fas fa-shopping-cart"></i>
                                            </div>
                                         </div>
                                         @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="w-100 d-flex justify-content-center align-items-center">
                            <h1>There is No Product</h1>
                        </div>
                    @endforelse
                   </div>
                </div>
                <div id="Laptop" class="tabcontent tabcontent-2">
                  <div class="row">
                    @forelse ($new_arrival_laptops as $p)
                    <div class="col-6 p-0 mb-2 col-xl-3 p-lg-0  card-height d-flex justify-content-center">
                        <div class="card rounded-3">
                            <div  class="card-header border-0 p-0 text-center">
                                <a href="{{ route('product_detail',$p->id)}}">
                                @if (isset($p->OnePhoto->image))
                                <img src="{{ asset($p->OnePhoto->image)}}" alt="" class="product-photo">
                                @else
                                <img src="{{ asset('images/assets/default_product.png')}}" alt="" class="default-photo-bg">
                                @endif
                                </a>

                                {{-- Wishlist --}}
                                @if (session('wishlist'))
                                    @foreach (session('wishlist') as $key)
                                      @if($p->id == $key)
                                       <div data-id="{{ $p->id }}" class="addWishlistFarSession"><i class="far fa-heart"></i></div>
                                       <div data-id="{{ $p->id }}" class="addWishlistFasSession"><i class="fas fa-heart"></i></div>
                                     @else
                                       <div data-id="{{ $p->id }}" class="addWishlistFar"><i class="far fa-heart"></i></div>
                                      @endif
                                    @endforeach
                                @elseif(Favourite::where('product_id',$p->id)->where('user_id',Auth::id())->first())
                                   <div data-id="{{ $p->id }}" class="addWishlistFarAuth"><i class="far fa-heart"></i></div>
                                   <div data-id="{{ $p->id }}" class="addWishlistFasAuth"><i class="fas fa-heart"></i></div>
                                @else
                                   <div data-id="{{ $p->id }}" class="addWishlistFar" ><i class="far fa-heart"></i></div>
                                   <div data-id="{{ $p->id }}" class="addWishlistFas d-none"><i class="fas fa-heart"></i></div>
                                @endif
                            {{--End  Wishlist --}}

                            </div>
                            <div class="card-body p-2">
                                <div class="row p-lg-2">
                                    <div class="col-12 mb-lg-4 mb-2">
                                        <span class="product-title">{{ $p->title }}</span>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                        <span class="text-info font-weight-bolder price">$&nbsp;{{ $p->price }}</span>
                                        @if ($p->stock == 1)
                                         <div class="my-cart add-my-cart" data-id="{{ $p->id }}">
                                            <div class="d-flex  align-items-center">
                                               <span class="d-none d-xl-block p-1">Add To Cart</span> <i class="fas fa-shopping-cart"></i>
                                            </div>
                                         </div>
                                         @else
                                         <div class="my-cart outOfStock">
                                            <div class="d-flex align-items-center">
                                               <span class="d-none d-xl-block p-1">Add To Cart</span> <i class="fas fa-shopping-cart"></i>
                                            </div>
                                         </div>
                                         @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="w-100 d-flex justify-content-center align-items-center">
                            <h1>There is No laptop</h1>
                        </div>
                    @endforelse
                   </div>
                </div>
            </div>
          </div>
          <div class="row sub-title">
            <div class="col-12 py-lg-3 p-2 p-lg-2">
                <div class="px-lg-1 p-0 d-flex justify-content-between align-items-lg-center ">
                   <div class="sub-title-inner-width d-block d-lg-flex justify-content-between align-items-center ">
                    <h3 class="mb-3 mb-lg-0 font-weight-bolder">Grab the best deals on <span class="text-info">Smartphones</span></h3>
                   </div>
                   <a href="{{ route('products.all.phone') }}" class="font-weight-bolder">See All</a>
                </div>
            </div>
          </div>
          <div class="row smart-phone mb-3">
            <div class="col-12 p-lg-0 p-3">
                  <div class="row">
                    @forelse ($phones as $p)
                    <div class="col-6 p-0 mb-2 col-xl-3 p-lg-0  card-height d-flex justify-content-center">
                        <div class="card rounded-3">
                            <div  class="card-header border-0 p-0 text-center">
                                <a href="{{ route('product_detail',$p->id)}}">
                                @if (isset($p->OnePhoto->image))
                                <img src="{{ asset($p->OnePhoto->image)}}" alt="" class="product-photo">
                                @else
                                <img src="{{ asset('images/assets/default_product.png')}}" alt="" class="default-photo-bg">
                                @endif
                                </a>
                                {{-- Wishlist --}}
                                    @if (session('wishlist'))
                                        @foreach (session('wishlist') as $key)
                                        @if($p->id == $key)
                                        <div data-id="{{ $p->id }}" class="addWishlistFarSession"><i class="far fa-heart"></i></div>
                                        <div data-id="{{ $p->id }}" class="addWishlistFasSession"><i class="fas fa-heart"></i></div>
                                        @else
                                        <div data-id="{{ $p->id }}" class="addWishlistFar"><i class="far fa-heart"></i></div>
                                        @endif
                                        @endforeach
                                    @elseif(Favourite::where('product_id',$p->id)->where('user_id',Auth::id())->first())
                                    <div data-id="{{ $p->id }}" class="addWishlistFarAuth"><i class="far fa-heart"></i></div>
                                    <div data-id="{{ $p->id }}" class="addWishlistFasAuth"><i class="fas fa-heart"></i></div>
                                    @else
                                    <div data-id="{{ $p->id }}" class="addWishlistFar" ><i class="far fa-heart"></i></div>
                                    <div data-id="{{ $p->id }}" class="addWishlistFas d-none"><i class="fas fa-heart"></i></div>
                                    @endif
                                {{--End  Wishlist --}}

                            </div>
                            <div class="card-body p-2">
                                <div class="row p-lg-2">
                                    <div class="col-12 mb-lg-4 mb-2">
                                        <span class="product-title">{{ $p->title }}</span>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                        <span class="text-info font-weight-bolder price">$&nbsp;{{ $p->price }}</span>
                                        @if ($p->stock == 1)
                                         <div class="my-cart add-my-cart" data-id="{{ $p->id }}">
                                            <div class="d-flex  align-items-center">
                                               <span class="d-none d-xl-block p-1">Add To Cart</span> <i class="fas fa-shopping-cart"></i>
                                            </div>
                                         </div>
                                         @else
                                         <div class="my-cart outOfStock">
                                            <div class="d-flex align-items-center">
                                               <span class="d-none d-xl-block p-1">Add To Cart</span> <i class="fas fa-shopping-cart"></i>
                                            </div>
                                         </div>
                                         @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="w-100 d-flex justify-content-center align-items-center">
                            <h1>There is No Product</h1>
                        </div>
                    @endforelse
                   </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 p-lg-2 p-1 ">
                <div class="ads">
                    <!-- <div class="row ads-title-inner">
                         <div class="col-lg-4 col-5 d-flex justify-content-center align-items-center">
                           <h1 class="font-weight-bolder text-light">Purchase directly at <br> A-Mobile!</h1>
                         </div>
                         <div class="col-4 col-lg-6 d-flex justify-content-end align-items-center">
                         <div class="ads-img-section ">
                             <div class="image-box">
                               <img src="{{ asset('images/assets/Laptop-PNG.png')}}"  alt="laptop">
                               <img src="{{ asset('images/assets/phone.png')}}"  alt="phone">
                             </div>
                           </div>
                         </div>
                         <div class="col-2 d-flex justify-content-center align-items-center">
                         <div class="bank-info">
                               <div class=" d-flex justify-content-center">
                                 <img src="{{ asset('images/assets/kbz.png')}}" class="bank-info-img" alt="">
                               </div>
                               <div class=" d-flex justify-content-center">
                               <img src="{{ asset('images/assets/yomabank.png')}}" class="bank-info-img" alt="">
                               </div>
                            </div>
                         </div>
                    </div> -->
                    @isset($ads->image)
                      <img src="{{ asset($ads->image) }}" alt="" class="w-100 h-100">
                    @endisset
                </div>
            </div>
          </div>

          <div class="row sub-title">
            <div class="col-12 py-lg-3 p-1 p-lg-2">
                <div class="px-1 d-flex justify-content-between align-items-lg-center ">
                   <div class="sub-title-inner-width d-block d-lg-flex justify-content-between align-items-center ">
                    <h3 class="mb-3 mb-lg-0 font-weight-bolder">Our rustable <span class="text-info">Laptops</span></h3>
                   </div>
                   <a href="{{ route('products.all.laptop') }}" class="font-weight-bolder">See All</a>
                </div>
            </div>
          </div>
          <div class="row laptop">
            <div class="col-12 p-lg-0 p-3">
                <div class="row">
                  @forelse ($laptops as $p)
                    <div class="col-6 p-0 mb-2 col-xl-3 p-lg-0  card-height d-flex justify-content-center">
                        <div class="card rounded-3">
                            <div  class="card-header border-0 p-0 text-center">
                                <a href="{{ route('product_detail',$p->id)}}">
                                @if (isset($p->OnePhoto->image))
                                  <img src="{{ asset($p->OnePhoto->image)}}" alt="" class="product-photo">
                                @else
                                  <img src="{{ asset('images/assets/default_product.png')}}" alt="" class="default-photo-bg">
                                @endif
                                </a>
                            {{-- Wishlist --}}
                                @if (session('wishlist'))
                                    @foreach (session('wishlist') as $key)
                                      @if($p->id == $key)
                                       <div data-id="{{ $p->id }}" class="addWishlistFarSession"><i class="far fa-heart"></i></div>
                                       <div data-id="{{ $p->id }}" class="addWishlistFasSession"><i class="fas fa-heart"></i></div>
                                     @else
                                       <div data-id="{{ $p->id }}" class="addWishlistFar"><i class="far fa-heart"></i></div>
                                      @endif
                                    @endforeach
                                @elseif(Favourite::where('product_id',$p->id)->where('user_id',Auth::id())->first())
                                   <div data-id="{{ $p->id }}" class="addWishlistFarAuth"><i class="far fa-heart"></i></div>
                                   <div data-id="{{ $p->id }}" class="addWishlistFasAuth"><i class="fas fa-heart"></i></div>
                                @else
                                   <div data-id="{{ $p->id }}" class="addWishlistFar" ><i class="far fa-heart"></i></div>
                                   <div data-id="{{ $p->id }}" class="addWishlistFas d-none"><i class="fas fa-heart"></i></div>
                                @endif
                            {{--End  Wishlist --}}
                            </div>
                            <div class="card-body p-2">
                                <div class="row p-lg-2">
                                    <div class="col-12 mb-lg-4 mb-2">
                                        <span class="product-title">{{ $p->title }}</span>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                        <span class="text-info font-weight-bolder price">$&nbsp;{{ $p->price }}</span>
                                        @if ($p->stock == 1)
                                         <div class="my-cart add-my-cart" data-id="{{ $p->id }}">
                                            <div class="d-flex  align-items-center">
                                               <span class="d-none d-xl-block p-1">Add To Cart</span> <i class="fas fa-shopping-cart"></i>
                                            </div>
                                         </div>
                                         @else
                                         <div class="my-cart outOfStock">
                                            <div class="d-flex align-items-center">
                                               <span class="d-none d-xl-block p-1">Add To Cart</span> <i class="fas fa-shopping-cart"></i>
                                            </div>
                                         </div>
                                         @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="w-100 d-flex justify-content-center align-items-center">
                            <h1>There is No laptop</h1>
                        </div>
                    @endforelse
                </div>
            </div>
          </div>
       </div>
    </section>
@endsection
@push('scripts')
    <script>

        var swiper = new Swiper(".mySwiper", {
            pagination: {
               el: ".swiper-pagination",
            },
            autoplay: {
              delay: 3000,
            },
         });

        function opemTab(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

    </script>
@endpush
