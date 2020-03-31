@extends('46728.app')


@section('content')

    <div class="container">
        <div class="row my-4">
            <div class="col-12">
                <div class="float-left">
                    <h1>Make a Payment for {{$student->full_name}}</h1>
                </div>
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('fees.index') }}"> Back</a>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="container">
            <div class="row my-4">
                <div class="col-12">
                    <div class="alert alert-danger">
                        <h3>Fix the following</h3>
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row my-4">
            <div class="col-12">
                <form action="{{ route('fees.store') }}" method="POST">
                    @csrf
                    <div class="form-row align-items-center">
                        <div class="form-group col-12">

                            <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount"
                                   value="{{ old('amount') }}">
                        </div>
                        <div class="form-group col-12">
                            <select class="form-control" id="student_id" name="student_id">
                                <option value="{{$student->id}}"
                                        selected readonly>{{$student->full_name}}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

