@extends('layouts.app')

@section('content')


<h2>Meciuri</h2>
<div class='row'>
<div class="col-md-12 col-sm-3 " >
<table  class="table table-hover">
    <tr style='text-align:center' class="table-info">
        <th style='text-align:left'>Data</th>
        <th>Meciuri</th>
        <th></th>

    </tr>
    @forelse($games as $game)
        <tr style='text-align:center'>
            <td style='text-align:left'>{{ $game->data }} {{ $game->hour }}</td>
            <td >{{ $game->echipa1 }} - {{ $game->echipa2 }}</td> 
            <td></td> 

        </tr>
    @empty
        <tr>
            <td colspan="2">Nu exista meciuri programate</td>
        </tr>
    @endforelse
</table>
</div>  


@endsection