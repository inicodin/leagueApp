@extends('layouts.app')

@section('content')
 



@guest
<div class="jumbotron text-center">
        <img style="width:20%;"  src="/trophy.jpg" alt='trofeu'/>
        <h1>League App!</h1>
        {{-- <p>Aceasta aplicatie este destinata organizarii si gestionarii competitiilor sportive</p> --}}
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Autentificare</a> 
            <a class="btn btn-success btn-lg" href="/register" role="button">Inregistrare</a></p>
    </div>

@else
@if(!Auth::guest())
@if(Auth::user()->getId()=='1')
<div class="container">
    <div class="row justify-content-center">
         
            <div class="col-md-8">
            <div class="card">
                <div class="card-header" style='text-align:center'>Numarul de echipe pe fiecare sport</div>
                <div class="card-body">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>

                    <div style="width:100%;text-align:center" >
                        {!! $chartjs->render() !!}
                    </div>
            </div>
           
        </div>
    </div>
</div>
</div> 

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



@endguest
@endsection

 