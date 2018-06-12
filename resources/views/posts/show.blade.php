@extends('layouts.app')

@section('content')

  {{--<a  href="/posts" class="btn btn-secondary"> Go back</a>  --}}

  

  @if(!Auth::guest())
  @if(Auth::user()->getId()=='1')
        <div class='float-right'>
                <a href="/posts/{{$post->id}}/edit" class='btn btn-info'>Edit</a>

                {!!Form::open(['action'=>['PostsController@destroy' ,$post->id], 'method' =>'POST', 'class'=>'float-right'])!!}
                    {{Form::hidden('_method','DELETE')}}
                    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                {!!Form::close()!!}
        </div>
        @endif
    @endif
 <div class='row'>
      <div class="col-md-2 col-sm-2">
        <img class="img-thumbnail" style='width:100%;' src="/storage/image/{{$post->image}}">
        </div>
        <div class="col-md-10 col-sm-10">   
        <h1 >{{$post->nume}}</h1>
          {{$post->detalii}}
      </div>
</div>

    <hr>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                  <img src="/storage/stats.jpg" width="25" height="25"  alt=""> Statistici</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                  <img src="/storage/results.jpg" width="25" height="25"  alt="" > Rezultate</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                        <img src="/storage/jucatori.jpg" width="25" height="25"  alt="" > Jucatori</a>
                  </li>
          </ul>
          <br>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row justify-content-center">  
                <div class="col-md-10">
                            <div class="card">
                                
                                <div class="card-header" style='text-align:center'>Goluri marcate si primite in ultimele 4 meciuri</div>
                    <div class="card-body">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
                    
                    <div style="width:100%;">
                        {!! $chartjs->render() !!}
                    </div>
                    </div>
                    </div>
                    </div>
                </div>
                
 
</div>
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

<table class="table">
    <tr style='text-align:center'>
            <th style='text-align:left'>Data</th>
            <th></th>
            <th >Rezultate</th>
            <th></th>
    </tr>
    @forelse($game as $game)
        <tr style='text-align:center'>
                <td style='text-align:left'>{{ $game->data }} {{ substr($game->hour,0,5) }}</td>
                <td>{{ $game->echipa1 }}</td> 
                <td >{{ $game->result1 }} - {{ $game->result2 }}</td>
                <td> {{ $game->echipa2 }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="2">Nu exista rezultate.</td>
        </tr>
    @endforelse
</table>
</div>
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
     

    @if(count($player)>0)
    <table class="table">
        <tr >
            <th>#</th>
            <th>Jucatori</th>
            <th>Rol</th>
            <th>Varsta</th>
            @if(!Auth::guest())
                @if(Auth::user()->getId()=='1')<th></th>@endif
                @endif
        </tr>

     @foreach($player as $player)
            <tr>
                    <th>{{ $loop->iteration }}.</th>
                <td>{{$player->name}}</td>
                <td>{{$player->rol}}</td>
                <th>{{$player->age}}</td>
                @if(!Auth::guest())
                @if(Auth::user()->getId()=='1')
                <td class='float-left'><a href ='/players/{{$player->idplayer}}/edit' class='btn btn-info'>Edit</a>
                
                        {!!Form::open(['action'=>['PlayerController@destroy' ,$player->idplayer], 'method' =>'POST', 'class'=>'float-right'])!!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                    {!!Form::close()!!}
                </td>
                
                  
                @endif
                @endif
            </tr>
    @endforeach
    </table>
@else 
<p> Nu exista nici un jucator </p>
@endif

@if(!Auth::guest())
@if(Auth::user()->getId()=='1')
<a  href="{{ route('players.create',['id' => $post->id]) }}" class="btn btn-primary"> Adauga jucatori</a>
@endif
@endif

    @endsection