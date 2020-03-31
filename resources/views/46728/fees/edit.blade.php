@extends('46728.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="float-left">
                    <h1>Edit Payment</h1>
                </div>
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('fees.index') }}"> Back</a>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="container">
            <div class="row">
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
        <div class="row">
            <div class="col-12">
                <form action="{{ route('fees.update',$fee->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-row ">
                        <div class="form-group col-12 col-md-4">
                            <label for="amount">Amount</label>

                            @php
                                //reverting string back to int
                                    $fmt = numfmt_create( 'en_EN', NumberFormatter::TYPE_INT32  );
                                    $amount = numfmt_parse($fmt,$fee->amount);
                            @endphp
                            <input type="text" name="amount" id="amount" class="form-control"
                                   value="{{$amount}}" placeholder="Amount">
                        </div>
                        <div class="form-group col-12 col-md-4">
                            <label for="student_id">Student</label>
                            <select class="form-control selectpicker" id="student_id" name="student_id"
                                    data-live-search="true" data-show-subtext="true">
                                @foreach($students as $student)
                                    <option
                                        <?php if ($fee->student_id == $student->id) echo 'selected'; ?> value="{{$student->id}}"
                                        data-subtext="{{$student->id}}">
                                        {{$student->full_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
