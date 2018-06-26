@extends('layouts.app')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<div class="container box">
    <h3 align="center">Live search in laravel using AJAX</h3><br />
    <div class="panel panel-default">
     <div class="panel-heading">Search Customer Data</div>
     <div class="panel-body">
      <div class="form-group">
       <input type="text" name="search" id="search" class="form-control" placeholder="Search Customer Data" />
      </div>
      <div class="table-responsive">
       <h3 align="center">Total Data : <span id="total_records"></span></h3>
       <table class="table table-striped table-bordered">
        <thead>
         <tr>
          <th>Customer Name</th>
          <th>Address</th>
          <th>City</th>
          <th>Postal Code</th>
          <th>Country</th>
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
    
     function fetch_customer_data(query = '')
     {
      $.ajax({
       url:"{{ route('chart.action') }}",
       method:'GET',
       data:{query:query},
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
      fetch_customer_data(query);
     });
    });
    </script>


@endsection