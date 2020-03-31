@extends('46728.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="float-left">
                    <h1>Edit Student</h1>
                </div>
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('students.index') }}"> Back</a>
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
                <form action="{{ route('students.update',$student->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-row ">
                        <div class="form-group col-12 col-md-4">
                            <label for="surname">Surname</label>
                            <input type="text" name="surname" id="surname" class="form-control"
                                   value="{{$student->surname}}" placeholder="Surname">
                        </div>
                        <div class="form-group col-12 col-md-4">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control"
                                   value="{{$student->first_name}}" placeholder="First name">
                        </div>
                        <div class="form-group col-12 col-md-4">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control"
                                   value="{{$student->last_name}}" placeholder="Last name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-4">
                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" id="dob" value="{{$student->dob->format('Y-m-d')}}"
                                   class="form-control">
                        </div>
                        <div class="form-group col-12 col-md-4">
                            <label for="course">Course</label>
                            <select class="form-control" id="course" name="course">
                                <option <?php if (empty($student->course)) echo 'selected'; ?> value="">Select course to
                                    enroll student
                                </option>
                                <option <?php if ($student->course == 'BBIT') echo 'selected'; ?> value="BBIT">BBIT
                                </option>
                                <option <?php if ($student->course == 'BCOM') echo 'selected'; ?> value="BCOM">BCOM
                                </option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
