@extends('layouts.app')

@section('content')


<ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
              <img src="/storage/minge_fotbal.jpg" width="25" height="25"  alt=""> Fotbal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
              <img src="/storage/minge_basket.jpg" width="25" height="25"  alt="" > Baschet</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
              <img src="/storage/minge_handbal.jpg" width="25" height="25"  alt="" > Handbal</a>
        </li>
      </ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
<div class="col-md-12 col-md-offset-2">
       <br>
        <h2>Rezultate</h2>
        <table class="table table-hover">
            <tr style='text-align:center' class="table-info">
                    <th style='text-align:left'>Data</th>
                    <th></th>
                    <th >Rezultate</th>
                    <th></th>
                    @if(!Auth::guest())
                    @if(Auth::user()->getId()=='1')<th></th>@endif
                    @endif
            </tr>
            @forelse($results as $game)
                <tr style='text-align:center'>
                        <td style='text-align:left'>{{ $game->data }}  {{ substr($game->hour,0,5) }}</td>
                        <td>{{ $game->echipa1 }}</td> 
                        <td >{{ $game->result1 }} - {{ $game->result2 }}</td>
                        <td> {{ $game->echipa2 }}</td>
                        @if(!Auth::guest())
                                 @if(Auth::user()->getId()=='1')
                                 <td class='float-right'><a href ='/games/{{$game->idgame}}/edit' class='btn btn-info'>Edit</a>
                                 
                                         {!!Form::open(['action'=>['GameController@destroy' ,$game->idgame], 'method' =>'POST', 'class'=>'float-right'])!!}
                                         {{Form::hidden('_method','DELETE')}}
                                         {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                     {!!Form::close()!!}
                                 </td>
                                 @endif
                                 @endif
                </tr>
            @empty
                <tr>
                    <td colspan="2">Nu exista rezultate.</td>
                </tr>
            @endforelse
            {{ $results->links()}}
        </table>
    </div>
</div>
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="col-md-12 col-md-offset-2">
                <br>
                 <h2>Rezultate</h2>
                 <table class="table table-hover">
                     <tr style='text-align:center' class="table-info">
                             <th style='text-align:left'>Data</th>
                             <th></th>
                             <th >Rezultate</th>
                             <th></th>
                             @if(!Auth::guest())
                @if(Auth::user()->getId()=='1')<th></th>@endif
                @endif
                     </tr>
                     @forelse($resultsb as $game)
                         <tr style='text-align:center'>
                                 <td style='text-align:left'>{{ $game->data }}  {{ substr($game->hour,0,5) }}</td>
                                 <td>{{ $game->echipa1 }}</td> 
                                 <td >{{ $game->result1 }} - {{ $game->result2 }}</td>
                                 <td> {{ $game->echipa2 }}</td>
                                 @if(!Auth::guest())
                                 @if(Auth::user()->getId()=='1')
                                 <td class='float-right'><a href ='/games/{{$game->idgame}}/edit' class='btn btn-info'>Edit</a>
                                 
                                         {!!Form::open(['action'=>['GameController@destroy' ,$game->idgame], 'method' =>'POST', 'class'=>'float-right'])!!}
                                         {{Form::hidden('_method','DELETE')}}
                                         {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                     {!!Form::close()!!}
                                 </td>
                                 @endif
                                 @endif
                         </tr>
                     @empty
                         <tr>
                             <td colspan="2">Nu exista rezultate.</td>
                         </tr>
                     @endforelse
                     {{ $resultsb->links()}}
                 </table>
             </div>
</div>   
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <div class="col-md-12 col-md-offset-2">
                <br>
                 <h2>Rezultate</h2>
                 <table class="table table-hover">
                     <tr style='text-align:center' class="table-info">
                             <th style='text-align:left'>Data</th>
                             <th></th>
                             <th >Rezultate</th>
                             <th></th>
                             @if(!Auth::guest())
                @if(Auth::user()->getId()=='1')<th></th>@endif
                @endif
                     </tr>
                     @forelse($resultsh as $game)
                         <tr style='text-align:center'>
                                 <td style='text-align:left'>{{ $game->data }}  {{ substr($game->hour,0,5) }}</td>
                                 <td>{{ $game->echipa1 }}</td> 
                                 <td >{{ $game->result1 }} - {{ $game->result2 }}</td>
                                 <td> {{ $game->echipa2 }}</td>
                                 @if(!Auth::guest())
                                 @if(Auth::user()->getId()=='1')
                                 <td class='float-right'><a href ='/games/{{$game->idgame}}/edit' class='btn btn-info'>Edit</a>
                                 
                                         {!!Form::open(['action'=>['GameController@destroy' ,$game->idgame], 'method' =>'POST', 'class'=>'float-right'])!!}
                                         {{Form::hidden('_method','DELETE')}}
                                         {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                     {!!Form::close()!!}
                                 </td>
                                 @endif
                                 @endif
                         </tr>
                     @empty
                         <tr>
                             <td colspan="2">Nu exista rezultate.</td>
                         </tr>
                     @endforelse
                     {{ $resultsh->links()}}
                 </table>
             </div>
</div> 
</div>
@endsection