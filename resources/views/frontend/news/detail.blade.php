@extends('frontend.layout.app')
@section('title','A-Mobile | News Detail')
@push('style')
<style>
  .new-detail-card-header{
    overflow: hidden;
    height: 500px;
  }

  .new-detail-card-header img{
    width: 100%;
    height: 100%;
  }

  .more-news-card-header{
    height: 300px;
    overflow: hidden;
  }

  .more-news-card-header img{
    height: 100%;
    width: 100%;
    transition: .8s ease-in-out;
    cursor: pointer;
  }

  .more-news-card-header img:hover{
    transform: scale(1.2);
  }

  .post-title{
    font-size: 15px;
  }
  @media screen and (max-width: 560px) {
    .new-detail-card-header{
       overflow: hidden;
       height: 250px;
     }
     .more-news-card-header{
       height: 180px !important;
       overflow: hidden;
      }

  }
</style>
@endpush

@section('content')
<section class="row justify-content-center px-3 px-lg-5 py-4">
  <div class="col-12 col-lg-8 p-1">
        <div class="new-detail-card-header w-100 mb-4">
          <img src="{{ asset($post->img)}}" alt="" class="mb-2">
          
        </div>
        <h2 class="font-weight-bolder">{{ $post->title }}</h2>
       
        <div class="paragraph">
          <p>{!! $post->description !!}</p>
        </div>
  </div>
  <div class="col-12 col-lg-4 px-lg-3 p-0">
    <h3 class="font-weight-bolder">More News</h3>
        @forelse ($more_news as $post)
        <div class="w-100 mb-2">
         <div class="more-news-card-header mb-lg-3 mb-2">
           <a href="{{ route('news.detail',$post->id )}}">
            <img src="{{ asset($post->img)}}" alt="" class="">
           </a>
         </div>
         <a href="{{ route('news.detail',$post->id )}}" class="font-weight-bolder post-title">{{ $post->title }}</a>
        </div>
        @empty
          <span>There is no post</span>
        @endforelse
  </div>
</section>
@endsection