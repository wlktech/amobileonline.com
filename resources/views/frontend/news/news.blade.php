@extends('frontend.layout.app')
@section('title','A-Mobile | News')
@push('style')
<style>
  a:hover {
    color: #000;
  }
  h3, h4 {
    font-weight: 900;
  }
  .sn-news img {
    aspect-ratio: 3/2;
    object-fit: cover;
    border-radius: 5px;
  }

  .news-card-header{
    overflow: hidden;
  }

  .news-card-header img{
    transition: .8s ease-in-out;
    cursor: pointer;
  }

  .news-card-header img:hover{
    transform: scale(1.2);
  }


  
  /* Tablet */
  @media (max-width: 767px) {
    
  }

  /* Mobile */
  @media screen and (max-width: 480px) {
    
  }
</style>
@endpush

@section('content')
<section class="row justify-content-center px-3 px-lg-5 py-4">
  <div class="container">
    <div class="row sn-news">
      @forelse ($posts as $p)
      <div class="col-sm col-12 col-lg-4 mb-3">
        <div class="card border-0">
          <div class="news-card-header p-0 rounded-0 mb-0">
            <a href="{{ route('news.detail',$p->id)}}">
             <img src="{{ asset($p->img)}}" alt="" class="w-100 rounded-0"> 
            </a>
          </div>
          <div class="card-body p-0">
              <a href="{{ route('news.detail',$p->id)}}">
              <h4 class="mt-3">{{ $p->title }}</h4>
              </a>
              <p class="text-secondary ">
              {{ Str::words(strip_tags($p->description),10) }}
              </p>
              <span class="news-date">{{ $p->created_at->format('M d Y')}}</span>
              </div>
        </div>
      </div>
      @empty
        
      @endforelse

    </div>
  </div>
</section>
@endsection

