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
    <h2>Clasament
    <a  href="/pdf" class="btn btn-success" style='float:right'>PDF</a>
</h2>
</br>
<div class="table-responsive">

    <table class="table table-hover" >
        <tr class="table-info">
            <th>#</th>
            
            <th class="col-md-2">Echipa</th>
            <th>Meciuri</th>
            <th>Victorii</th>
            <th>Egaluri</th>
            <th>Infrangeri</th>
            <th>Golaveraj</th>
            <th  style='text-align:center'>Puncte</th>
        </tr>
        @forelse($table as $team)
            <tr>
                <td style='height:5px' class=" nav-link disabled">{{ $loop->iteration }}.</td>
                <td class="col-md-2"><a style='height:5px' class=" nav-link disabled" href="/posts/{{$team->id}}">{{ $team->team }}</a></td>
                <td>{{ $team->game }}</td>
                <td>{{ $team->won }}</td>
                <td>{{ $team->tied }}</td>
                <td>{{ $team->lost }}</td>
                <td>{{ $team->gol_marcat }} : {{ $team->gol_primit }}</td>
                <td style='text-align:center'>{{ $team->points }}</td>
            </tr>
        
        @empty
            <tr>
                <td colspan="6">Nu exista echipe.</td>
            </tr>
        @endforelse
        
    </table>
</div>
</div>
</div>
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="col-md-12 col-md-offset-2">
                <br>
               <h2>Clasament
               <a  href="/pdf" class="btn btn-success" style='float:right'>PDF</a>
           </h2>
           </br>
           <div class="table-responsive">
           
               <table class="table table-hover" >
                   <tr class="table-info">
                       <th>#</th>
                       
                       <th class="col-md-2">Echipa</th>
                       <th>Meciuri</th>
                       <th>Victorii</th>
                       <th>Egaluri</th>
                       <th>Infrangeri</th>
                       <th>Golaveraj</th>
                       <th  style='text-align:center'>Puncte</th>
                   </tr>
                   @forelse($tableb as $team)
                       <tr>
                           <td style='height:5px' class=" nav-link disabled">{{ $loop->iteration }}.</td>
                           <td class="col-md-2"><a style='height:5px' class=" nav-link disabled" href="/posts/{{$team->id}}">{{ $team->team }}</a></td>
                           <td>{{ $team->game }}</td>
                           <td>{{ $team->won }}</td>
                           <td>{{ $team->tied }}</td>
                           <td>{{ $team->lost }}</td>
                           <td>{{ $team->gol_marcat }} : {{ $team->gol_primit }}</td>
                           <td style='text-align:center'>{{ $team->points }}</td>
                       </tr>
                   
                   @empty
                       <tr>
                           <td colspan="6">Nu exista echipe.</td>
                       </tr>
                   @endforelse
                   
               </table>
           </div>
           </div>
</div>   
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <div class="col-md-12 col-md-offset-2">
            @if(count($tableh)>0)     <br>
               <h2>Clasament
               <a  href="/pdf" class="btn btn-success" style='float:right'>PDF</a>
           </h2>
           </br>
           <div class="table-responsive">
               
               <table class="table table-hover" >
                   <tr class="table-info">
                       <th>#</th>
                       
                       <th class="col-md-2">Echipa</th>
                       <th>Meciuri</th>
                       <th>Victorii</th>
                       <th>Egaluri</th>
                       <th>Infrangeri</th>
                       <th>Golaveraj</th>
                       <th  style='text-align:center'>Puncte</th>
                   </tr>
                   @foreach($tableh as $team)
                       <tr>
                           <td style='height:5px' class=" nav-link disabled">{{ $loop->iteration }}.</td>
                           <td class="col-md-2"><a style='height:5px' class=" nav-link disabled" href="/posts/{{$team->id}}">{{ $team->team }}</a></td>
                           <td>{{ $team->game }}</td>
                           <td>{{ $team->won }}</td>
                           <td>{{ $team->tied }}</td>
                           <td>{{ $team->lost }}</td>
                           <td>{{ $team->gol_marcat }} : {{ $team->gol_primit }}</td>
                           <td style='text-align:center'>{{ $team->points }}</td>
                       </tr>
                   
                   @endforeach
                   @else
                   <br>
                       <tr>
                           <td colspan="6">Nu exista echipe.</td>
                       </tr>
                   @endif
                   
               </table>
           </div>
           </div>
</div>  
@endsection