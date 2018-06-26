@extends('layouts.app')

@section('content')


@if(!Auth::guest())
@if(Auth::user()->getId()=='1')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                   

                    <div class="card">
                            <div class="card-header" style='text-align:center'>Numarul de echipe pe fiecare sport</div>
                            <div class="card-body" >
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
            
                                <div style="width:100%;text-align:center" >
                                    {!! $chartjs->render() !!}
                                </div>
                        </div>                     
                </div>
            </div>
        </div>                     
</div>
</div>                     
</div>
@endif
@endif

@if(Auth::user()->getId()!='1')
@if ( (!empty($post->id)) )
<div class='float-right'>
    <a href="/posts/{{$post->id}}/edit" class='btn btn-info'>Edit</a>

    {!!Form::open(['action'=>['PostsController@destroy' ,$post->id], 'method' =>'POST', 'class'=>'float-right'])!!}
        {{Form::hidden('_method','DELETE')}}
        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
    {!!Form::close()!!}
</div>

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
                            
                            <div class="card-header" style='text-align:center'>Goluri marcate si primite in ultimele 3 meciuri</div>
                <div class="card-body">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
                
                <div style="width:100%;">
                    {!! $chartjss->render() !!}
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
        <th></th>
        <th></th>
    </tr>

 @foreach($player as $player)
        <tr>
                <th>{{ $loop->iteration }}.</th>
            <td>{{$player->name}}</td>
            <td>{{$player->rol}}</td>
            <th>{{$player->age}}</td>
            
            <td ><a href ='/players/{{$player->idplayer}}/edit' class='btn btn-info'>Edit</a>
            </td>
            <td>
                    {!!Form::open(['action'=>['PlayerController@destroy' ,$player->idplayer], 'method' =>'POST', 'class'=>'float-center'])!!}
                    {{Form::hidden('_method','DELETE')}}
                    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                {!!Form::close()!!}
            </td>
            
        </tr>
@endforeach
</table>
@else 
<p> Nu exista nici un jucator </p>
@endif


<a  href="{{ route('players.create',['id' => $post->id]) }}" class="btn btn-primary"> Adauga jucatori</a>



@else





<div class='row'>
    <div class="col-md-3 col-sm-3 " >
        </div>    
<div class="col-md-6 col-sm-6 " >
<h2  style='text-align:center'>Adauga echipa</h2>

{!! Form::open(['action' => 'PostsController@store', 'method'=> 'POST','enctype'=>'multipart/form-data']) !!}

<div class="form-group">
    {{Form::label('idsport1','Sport')}}
    <select name='idsport' class="form-control input-lg dynamic">
            <option  > -select- </option>
                @foreach ($class_array_sport as $data)     
                        <option value="{{$data->idsport}}"  > {{$data->sport}} </option>
                @endforeach  
</select>
</div> 

<div class="form-group">
{{Form::label('nume','Echipa')}}
{{Form::text('nume','',['class'=>'form-control','placeholder'=>'Echipa'])}}
</div>   
<div class="form-group">
    {{Form::label('detalii','Detalii')}}
    {{Form::text('detalii','',['class'=>'form-control','placeholder'=>'Detalii'])}}
</div> 
<div class="form-group">
    {{Form::file('image')}}
</div> 


{{Form::submit('Adauga',['class'=>'btn btn-primary'])}}

{!! Form::close() !!}
</div> 
</div> 

@endif
@endif
            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
