@extends('layouts.app')

@section('content')
<div class='row'>
    <div class="col-md-2 col-sm-3 " >
        </div>    
<div class="col-md-8 col-md-offset-2">
<h3  style='text-align:center'>Actualizeaza meci</h3><br/>
<div class="table-responsive">
       

{!! Form::open(['action' =>['GameController@update',$game->idgame], 'method'=> 'POST']) !!}
<table class="table">
        <tr >
        <select name='idsport' class="form-control input-lg dynamic">
                <option  value="{{$game->idsport}}" >{{$game->gamesport['sport']}} </option>
                    @foreach ($class_array_sport as $data)     
                            <option value="{{$data->idsport}}"  > {{$data->sport}} </option>
                    @endforeach  
</select>

</tr>
        <tr >
            <th>Echipe</th>

<td>

<select  name="idteam1"  class="form-control input-lg dynamic">
          <option   value="{{$game->idteam1}}"> {{$game->gameteam1['nume']}} </option>
            @foreach ($class_array as $data)     
                    <option value="{{$data->id}}" > {{$data->nume}} </option>
            @endforeach  
</select>

</td>

<td>
   
       <select name='idteam2' class="form-control input-lg dynamic">
            <option value="{{$game->idteam2}}" > {{$game->gameteam2['nume']}} </option>
                   @foreach ($class_array as $data)     
                           <option value="{{$data->id}}"  > {{$data->nume}} </option>
                   @endforeach  
       </select>
      
</td>
</tr>

        
<tr>
<th>Rezultat</th>
<td>
        {{Form::text('result1',$game->result1,['class'=>'form-control','placeholder'=>'Scor gazde'])}}
</td>

<td>
    {{Form::text('result2',$game->result2,['class'=>'form-control','placeholder'=>'Scor oaspeti'])}}
</td> 
</tr>

<tr ><th>Data</th>
<td>  
            {{Form::date('data',$game->data,['class'=>'form-control','placeholder'=>'yyyy-MM-dd'])}}
</td>
<td>  
        {{Form::time('ora',$game->ora,['class'=>'form-control','placeholder'=>'yyyy-MM-dd'])}}
</td>
</tr>
<tr>
<td>Sanse %</td>
<td></td>
<td></td>
</tr>    
    <tr>
<td>
    {{Form::text('cota1',$game->cota1,['class'=>'form-control','placeholder'=>'Gazde'])}} 
</td> 

<td>
    {{Form::text('cotax',$game->cotax,['class'=>'form-control','placeholder'=>'Egal'])}} 
</td> 

<td>
    {{Form::text('cota2',$game->cota2,['class'=>'form-control','placeholder'=>'Oaspeti'])}} 
</td> 

    </tr>       
</table>
{{Form::hidden('_method','PUT')}}
<p style='text-align:center'>
{{Form::submit('Actualizeaza',['class'=>'btn btn-primary'])}}
</p>
{!! Form::close() !!}
</div>
    </div>
@endsection