@extends('layouts.app')

@section('content')
 



@guest
<div class="jumbotron text-center">
        <img style="width:20%;"  src="/trophy.jpg" alt='trofeu'/>
        <h1>League App!</h1>
        <p>Aceasta aplicatie este destinata organizarii si gestionarii competitiilor sportive</p>
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Autentificare</a> 
            <a class="btn btn-success btn-lg" href="/register" role="button">Inregistrare</a></p>
    </div>

@else
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

@endguest
@endsection

 