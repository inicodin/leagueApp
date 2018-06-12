@extends('layouts.app')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<div class='row'>
    <div class="col-md-2 col-sm-3 " >
        </div>    
<div class="col-md-8 col-md-offset-2">
<h2  style='text-align:center'>Adauga meci</h2><br/>
<div class="table-responsive">
{!! Form::open(['action' => 'GameController@store', 'method'=> 'POST']) !!}

<table class=" table order-list" id="myTable">
        <tr >

     
        <select name='idsport' id="posts.idsport" class="form-control input-lg dynamic" data-dependent="id">
                <option  > -sport- </option>
                    @foreach ($class_array_sport as $data)     
                            <option value="{{$data->idsport}}"  > {{$data->sport}} </option>
                    @endforeach  
</select>
</tr>

<tr>
<th>Echipe</th>
<td>
{{-- <select  name="idteam1"  class="form-control input-lg dynamic">
          <option  > -select- </option>
            @foreach ($class_array as $data)     
                    <option value="{{$data->id}}" > {{$data->nume}} </option>
            @endforeach  
</select> --}}
<select name="idteam1" id="id" class="form-control input-lg dynamic"  data-dependent="idteam2">
    <option value="">-Select-</option>
   </select>
</td>

<td>
    {{-- <select name='idteam2' class="form-control input-lg dynamic">
            <option  > -select- </option>
                   @foreach ($class_array as $data)     
                           <option value="{{$data->id}}"  > {{$data->nume}} </option>
                   @endforeach  
       </select>  --}}
       <select name="idteam2" id="idteam2" class="form-control input-lg dynamic" >
        <option value="">-Select-</option>
       </select>
    </td>
</tr>

<tr>
<th>Rezultat</th>
<td>
        {{Form::text('result1','',['class'=>'form-control','placeholder'=>'Scor gazde'])}}
</td>

<td>
    {{Form::text('result2','',['class'=>'form-control','placeholder'=>'Scor oaspeti'])}}
</td> 
</tr>

<tr ><th>Data</th>
<td>  
            {{Form::date('data','',['class'=>'form-control','placeholder'=>'yyyy-MM-dd'])}}
</td>
<td>  
        {{Form::time('ora','',['class'=>'form-control','placeholder'=>'yyyy-MM-dd'])}}
</td>
</tr>

 {{--<tr>
<td>
    {{Form::text('cota1','',['class'=>'form-control','placeholder'=>'Gazde'])}} 
</td> 

<td>
    {{Form::text('cotax','',['class'=>'form-control','placeholder'=>'Egal'])}} 
</td> 

<td>
    {{Form::text('cota2','',['class'=>'form-control','placeholder'=>'Oaspeti'])}} 
</td> 

 </tr>        --}}
</table>
<div align="right">
        <input type="button" class="btn btn-lg btn-block " id="addrow" value="Add Row" />

       </div>
<p style='text-align:center'>{{Form::submit('Adauga',['class'=>'btn btn-primary'])}}</p>
{{ csrf_field() }}
{!! Form::close() !!}

<script>
$(document).ready(function () {
    var counter = 0;

    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="form-control" name="name' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="mail' + counter + '"/></td>';


        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
    });



    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });


});

$(document).ready(function(){

 $('.dynamic').change(function(){
  if($(this).val() != '')
  {
   var select = $(this).attr("id");
   var value = $(this).val();
   var dependent = $(this).data('dependent');
   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ route('dynamicdependent.fetch') }}",
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

</script>

</div>
    </div>
@endsection