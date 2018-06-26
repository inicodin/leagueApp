@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
  
<ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
              <img src="/storage/minge_fotbal.jpg" width="25" height="25"  alt=""> Fotbal </a>
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
    </br>
<h3>Lista jucatori  <i class="fa fa-search  fa-sm" aria-hidden="true"></i></h3>
</br>
<div class="container box">
    
    <div class="panel panel-default">
     
     <div class="panel-body">
      <div class="form-group">
       <input type="text" name="search" id="search" class="form-control" placeholder="Cauta jucatori dupa nume, echipa, rol sau varsta" />
      </div>
      <div class="table-responsive">

       <table class="table">
        <thead>
         <tr>

          <th>#</th>
          <th>Jucator</th>
          <th>Echipa</th>
          <th>Rol</th>
          <th>Varsta</th>
         </tr>
        </thead>
        <tbody>
 
        </tbody>
       </table>
      </div>
     </div>    
    </div>
   </div>
   <script>
    $(document).ready(function(){
    
     fetch_customer_data();
    
     function fetch_customer_data(query = '',type='')
     {
      $.ajax({
       url:"{{ route('index.action') }}",
       method:'GET',
       data:{query:query,type:type},
       dataType:'json',
       success:function(data)
       {
        $('tbody').html(data.table_data);
        $('#total_records').text(data.total_data);
       }
      })
     }
    
     $(document).on('keyup', '#search', function(){
      var query = $(this).val();
      var type = $("ul li.nav-item.active a").text();
      fetch_customer_data(query,type);
     });

     $(document).on('click', '#home-tab', function(){
      var query = $("#search").val();
      var type = "1";
      fetch_customer_data(query,type);
     });
    
     $(document).on('click', '#profile-tab', function(){
      var query = $("#search").val();
      var type = "2";
      fetch_customer_data(query,type);
     });

     $(document).on('click', '#contact-tab', function(){
      var query = $("#search").val();
      var type = "3";
      fetch_customer_data(query,type);
     });

    });




    </script>




<hr>
</div>
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    </br>
    <h3>Lista jucatori</h3>
    </br>
    <div class="container box">
    
        <div class="panel panel-default">
         
         <div class="panel-body">
          <div class="form-group">
           <input type="text" name="search" id="search" class="form-control" placeholder="Cauta jucatori dupa nume, echipa, rol sau varsta" />
          </div>
          <div class="table-responsive">
    
           <table class="table">
            <thead>
             <tr>
    
              <th>#</th>
              <th>Jucator</th>
              <th>Echipa</th>
              <th>Rol</th>
              <th>Varsta</th>
             </tr>
            </thead>
            <tbody>
     
            </tbody>
           </table>
          </div>
         </div>    
        </div>
       </div>
      
        <hr>
        </div>
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    </br>
    <h3>Lista jucatori</h3>
    </br>
    <div class="container box">
    
        <div class="panel panel-default">
         
         <div class="panel-body">
          <div class="form-group">
           <input type="text" name="search" id="search" class="form-control" placeholder="Cauta jucatori dupa nume, echipa, rol sau varsta" />
          </div>
          <div class="table-responsive">
    
           <table class="table">
            <thead>
             <tr>
    
              <th>#</th>
              <th>Jucator</th>
              <th>Echipa</th>
              <th>Rol</th>
              <th>Varsta</th>
             </tr>
            </thead>
            <tbody>
     
            </tbody>
           </table>
          </div>
         </div>    
        </div>
       </div>

<hr>
</div>
</div>    
@endsection