@extends('layouts.app')

@section('content')

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

@endsection