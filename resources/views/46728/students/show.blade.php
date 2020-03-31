@extends('46728.app')


@section('content')

    <div class="container">
        <div class="row my-4">
            <div class="col-12">
                <div class="float-left">
                    <h1>{{ $student->full_name }}</h1>
                </div>
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('students.index') }}"> Back</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row my-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{ $student->full_name }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Course:</h5>
                        <p class="card-text">{{ $student->course }}</p>
                        <h5 class="card-title">Date of Birth:</h5>
                        <p class="card-text">{{ $student->dob->year }}</p>
                        <h5 class="card-title">Payments:</h5>
                        @php
                            $total = $student->fees->reduce(function ($sum, $fee) {
                                $amount = (double) $fee->amount;
                                return $sum += $amount;
                            }, 0);
                        @endphp
                        <h6>Total: {{$total}}</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Payment #</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($student->fees as $fee)
                                    <tr>
                                        <td>{{ $fee->id }}</td>
                                        <td>{{ $fee->amount }}</td>
                                        <td>{{ $fee->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No payment has been made by this student.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('fees.directpay',$student->id) }}" class="btn btn-warning my-1">Make
                            Payment</a>
                        <a href="{{ route('students.index') }}" class="btn btn-primary my-1">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
