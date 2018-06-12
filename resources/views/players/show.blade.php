@extends('layouts.app')

@section('content')

<a  href="/players" class="btn btn-secondary"> Go back</a>

@if(count($players)>0)
<table class='table table-striped'>
    <tr>
        <th>Jucatori</th>
        <td></td>
        <td></td>
    </tr>
    @foreach($players as $player)
        <tr>
            <th>{{$player->name}}</th>
            <td ><a href ='/players/{{$player->idplayer}}/edit' class='btn btn-secondary'>Edit</a>
            
                    {!!Form::open(['action'=>['PlayerController@destroy' ,$player->idplayer], 'method' =>'POST', 'class'=>'float-right'])!!}
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

@endsection