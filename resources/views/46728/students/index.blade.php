@extends('46728.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="float-left">
                    <h1>Students</h1>
                </div>
                <div class="float-right">
                    <a class="btn btn-success" href="{{ route('students.create') }}"> New Student</a>
                </div>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="container">
            <div class="row my-4">
                <div class="col-12">
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row my-4">
            <div class="col-12">
                <h4>Filter students</h4>
                <input class="form-control" id="filter-students" type="text" placeholder="Search..">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="students-table">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>DOB</th>
                            <th>Course</th>
                            <th>Registration Date</th>
                            <th width="280px">Actions</th>
                        </tr>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $student->full_name}}</td>
                                <td>{{ $student->dob->year }}</td>
                                <td>{{ $student->course }}</td>
                                <td>{{ $student->created_at }}</td>
                                <td>
                                    <form action="{{ route('students.destroy',$student->id) }}" method="POST">
                                        <a class="btn btn-info btn-sm my-1"
                                           href="{{ route('students.show',$student->id) }}">Show</a>
                                        <a class="btn btn-primary btn-sm my-1"
                                           href="{{ route('students.edit',$student->id) }}">Edit</a>
                                        <a class="btn btn-warning btn-sm my-1"
                                           href="{{ route('fees.directpay',$student->id) }}">Make Payment</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm my-1">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                {!! $students->links() !!}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script !src="">
        $(document).ready(function () {
            $("#filter-students").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#students-table tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
