@extends('layouts.app')

@section('content')

<div class='row'>
    <div class="col-md-3 col-sm-3 " >
        </div>    
<div class="col-md-6 col-sm-6 " >
<h2 style='text-align:center'>Adauga jucator</h2>
{!! Form::open(['action' => 'PlayerController@store', 'method'=> 'POST']) !!}

{{Form::text('idteam',$post->id,['class'=>'form-control','placeholder'=>'id','hidden' => 'hidden'])}}

<div class="form-group">
    {{Form::label('team','Echipa')}}
    {{Form::text('team',$post->nume,['class'=>'form-control','placeholder'=>'Echipa','disabled' => 'disabled'])}}
</div>  
<div class="form-group"> 
    {{Form::label('name','Nume jucator')}}
    {{Form::text('name','',['class'=>'form-control','placeholder'=>'Nume'])}}
</div>   
<div class="form-group">
        {{Form::label('birth','Data nasterii')}}
        {{Form::date('birth','',['class'=>'form-control','placeholder'=>'yyyy-MM-dd'])}}
    </div> 
    {{Form::label('rol','Rol')}}    
<select name='rol' class="form-control input-lg dynamic">
        <option value='' ></option>
        <option value='Portar' >Portar</option>
        <option value='Fundas'>Fundas</option>
        <option value='Mijlocas'>Mijlocas</option> 
        <option value='Atacant'>Atacant</option>
</select>
<br>
{{Form::submit('Adauga',['class'=>'btn btn-primary'])}}

{!! Form::close() !!}
</div> 
</div>  

@endsection