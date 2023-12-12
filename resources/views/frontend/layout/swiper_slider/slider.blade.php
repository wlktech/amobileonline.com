<!-- Swiper -->
<div class="swiper mySwiper rounded-1">
  <div class="swiper-wrapper">
     @forelse ($banner as $b )
     <div class="swiper-slide">
       <img src="{{ asset($b->image)}}" class="w-100" alt="">
     </div>
     @empty
      <div class="swiper-slide">
          <h3>There is No Banner </h3>
       </div>
     @endforelse
  </div>
  <div class="swiper-pagination"></div>
</div>