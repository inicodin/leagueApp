@extends('layouts.app')

@section('content')


<div class='row'>
    <div class="col-md-3 col-sm-3 " >
    </div>    

    <div class="col-md-6 col-sm-6 " >
    <h2 style='text-align:center'>Adauga jucator</h2>
    
    {!! Form::open(['action' =>['PlayerController@update',$player->idplayer], 'method'=> 'POST']) !!}
    
    {{Form::text('idteam',$player->idteam,['class'=>'form-control','placeholder'=>'id','hidden' => 'hidden'])}}
    
    <div class="form-group">
        {{Form::label('team','Echipa')}}
        {{Form::text('team',$player->player['nume'],['class'=>'form-control','disabled' => 'disabled'])}}
    </div>  
    <div class="form-group"> 
        {{Form::label('name','Nume jucator')}}
        {{Form::text('name',$player->name,['class'=>'form-control'])}}
    </div>   
    <div class="form-group">
            {{Form::label('birth','Data nasterii')}}
            {{Form::date('birth',$player->birth,['class'=>'form-control','placeholder'=>'yyyy-MM-dd'])}}
        </div> 
        {{Form::label('rol','Rol')}}    
    <select name='rol' class="form-control input-lg dynamic">
            <option value={{$player->rol}} >{{$player->rol}}</option>
            <option value='' ></option>
            <option value='Portar' >Portar</option>
            <option value='Fundas'>Fundas</option>
            <option value='Mijlocas'>Mijlocas</option> 
            <option value='Atacant'>Atacant</option>
    </select>
    <br>
    {{Form::hidden('_method','PUT')}}

    {{Form::submit('Actualizeaza',['class'=>'btn btn-primary'])}}
    
    {!! Form::close() !!}
    </div> 
    </div>  
@endsection