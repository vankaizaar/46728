@extends('46728.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="float-left">
                    <h1>Showing Payment</h1>
                </div>
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('fees.index') }}"> Back</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Amount: {{$fee->amount}}</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Paid By:</h5>
                        <p class="card-text">{{ $fee->student->full_name }}</p>
                        <h5 class="card-title">Date of Payment:</h5>
                        <p class="card-text">{{ $fee->created_at->format('M d Y') }}</p>
                        <a href="{{ route('fees.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
