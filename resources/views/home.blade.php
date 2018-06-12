@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bine ai venit! 
                    <hr>

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
        </div>
    </div>
</div>
@endsection
