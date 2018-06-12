@extends('layouts.app')

@section('content')


<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
          <img src="/storage/minge_fotbal.jpg" width="25" height="25"  alt=""> Fotbal</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
          <img src="/storage/minge_basket.jpg" width="25" height="25"  alt="" > Baschet</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
          <img src="/storage/minge_handbal.jpg" width="25" height="25"  alt="" > Handbal</a>
    </li>
  </ul>
  <br>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        @if(count($posts)>0)
        @foreach($posts as $post)
        <div class="card bg-light mb-1" >
                <div class='row'>
                  <div class="col-md-1 col-sm-1 " >
                  <img class="img-thumbnail" style='width:50px;height:40px;' src="/storage/image/{{$post->img}}">
                  </div>
                    <div class="col-md-11 col-sm-11">
                    <a  class=" nav-link disabled" href="/posts/{{$post->id}}">{{$post->nume}}</a>
                    </div>
                </div>     
      </div>  
        @endforeach
    @else
    <p>Nu exista nici o echipa inregistrata</p>
    @endif 
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @if(count($postsb)>0)
        @foreach($postsb as $post)
        <div class="card bg-light mb-1" >
                <div class='row'>
                  <div class="col-md-1 col-sm-1 " >
                  <img class="img-thumbnail" style='width:50px;height:40px;' src="/storage/image/{{$post->img}}">
                  </div>
                    <div class="col-md-11 col-sm-11">
                    <a  class=" nav-link disabled" href="/posts/{{$post->id}}">{{$post->nume}}</a>
                    </div>
                </div>     
      </div>  
        @endforeach
    @else
    <p>Nu exista nici o echipa inregistrata</p>
    @endif 
    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        @if(count($postsh)>0)
        @foreach($postsh as $post)
        <div class="card bg-light mb-1" >
                <div class='row'>
                  <div class="col-md-1 col-sm-1 " >
                  <img class="img-thumbnail" style='width:50px;height:40px;' src="/storage/image/{{$post->img}}">
                  </div>
                    <div class="col-md-11 col-sm-11">
                    <a  class=" nav-link disabled" href="/posts/{{$post->id}}">{{$post->nume}}</a>
                    </div>
                </div>     
      </div>  
        @endforeach
    @else
    <p>Nu exista nici o echipa inregistrata</p>
    @endif 
    </div>

  </div>

@endsection
