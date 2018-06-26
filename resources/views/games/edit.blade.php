@extends('layouts.app')

@section('content')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class='row'>
    <div class="col-md-2 col-sm-3 " >
        </div>    
<div class="col-md-8 col-md-offset-2">
<h3  style='text-align:center'>Actualizeaza meci</h3><br/>
<div class="table-responsive">



{!! Form::open(['action' =>['GameController@update',$game->idgame], 'method'=> 'POST']) !!}
<table class="table order-list" id="myTable">
        <tr >
        <select name='idsport' class="form-control input-lg dynamic" disabled>
                <option  value="{{$game->idsport}}" >{{$game->gamesport['sport']}} </option>
                    @foreach ($class_array_sport as $data)     
                            <option value="{{$data->idsport}}"  > {{$data->sport}} </option>
                    @endforeach  
</select>
<select name='idsport' class="form-control input-lg dynamic" hidden>
        <option  value="{{$game->idsport}}" >{{$game->gamesport['sport']}} </option>
            @foreach ($class_array_sport as $data)     
                    <option value="{{$data->idsport}}"  > {{$data->sport}} </option>
            @endforeach  
</select>
</tr>
        <tr >
            <th>Echipe</th>

<td>

<select  name="idteam1"  class="form-control input-lg dynamic" disabled>
          <option   value="{{$game->idteam1}}"> {{$game->gameteam1['nume']}} </option>
            @foreach ($class_array as $data)     
                    <option value="{{$data->id}}" > {{$data->nume}} </option>
            @endforeach  
</select>
<select  name="idteam1"  class="form-control input-lg dynamic" hidden>
        <option   value="{{$game->idteam1}}"> {{$game->gameteam1['nume']}} </option>
          @foreach ($class_array as $data)     
                  <option value="{{$data->id}}" > {{$data->nume}} </option>
          @endforeach  
</select>
</td>

<td>
<select name='idteam2' class="form-control input-lg dynamic" disabled>
        <option value="{{$game->idteam2}}" > {{$game->gameteam2['nume']}} </option>
                @foreach ($class_array as $data)     
                        <option value="{{$data->id}}"  > {{$data->nume}} </option>
                @endforeach  
</select>
<select name='idteam2' class="form-control input-lg dynamic" hidden>
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
  
     
</table>
<div align="right">
        <input type="button" class="btn btn-lg btn-block " id="addrow" value="Adauga informatii despre meci" />
 </div>
 <br>
 {{Form::hidden('_method','PUT')}}
 <p style='text-align:center'>
 {{Form::submit('Actualizeaza',['class'=>'btn btn-primary'])}}
 </p>
 {!! Form::close() !!}
 </div>

<script>
$(document).ready(function () {
var counter = 0;
 

$("#addrow").on("click", function () {
   
var newRow = $("<tr>");
var cols = "";


cols += '<td><select name="action[]" id="action'+counter+'" class="form-control input-lg dynamic" ><option value="Gol">Gol</option><option value="Cartonas rosu">Cartonas rosu</option></select></td>';
cols +='<td><select name="team'+counter+'" id="team'+counter+'" class="form-control input-lg dynamic" data-dependent="player'+counter+'"><option value="">-echipa-</option> <option   value="{{$game->idteam1}}"> {{$game->gameteam1['nume']}} </option> <option value="{{$game->idteam2}}" > {{$game->gameteam2['nume']}} </option></select></td>'
cols += '<td><select name="player'+counter+'" id="player'+counter+'" class="form-control input-lg dynamic" ><option value="">-jucator-</option></select></td>';

cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
console.log(cols);
newRow.append(cols);
$("table.order-list").append(newRow);
counter++;
     $('.dynamic').change(function(){
        if($(this).val() != '')
                {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();
                        $.ajax({
                        url:"{{ route('dynamicdependent.dropdownplayer') }}",
                        method:"POST",
                        data:{select:select, value:value, _token:_token, dependent:dependent},
                        success:function(result)
                                {
                                $('#'+dependent).html(result);
                                }
                        })
                }
        });
});

$("table.order-list").on("click", ".ibtnDel", function (event) {
$(this).closest("tr").remove();       
counter -= 1
});

});


$(document).ready(function(){
       
});
</script>   




    </div>

@endsection