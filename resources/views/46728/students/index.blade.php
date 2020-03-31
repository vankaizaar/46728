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
        <div class="row my-5">
            <div class="col-12 col-md-6 my-2">
                <h4>Filter students</h4>
                <input class="form-control" id="filter-students" type="text" placeholder="Filter..">
            </div>
            <div class="col-12 col-md-6 my-2">
                <h4>Search student by ID</h4>
                <input class="form-control" id="search-students" type="text" placeholder="Search..">
                <div class="my-5" id="search-results">

                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="students-table">
                        <tr>
                            <th>Reg No</th>
                            <th>Name</th>
                            <th>DOB</th>
                            <th>Course</th>
                            <th>Registration Date</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
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
    <script !src="">
        var searchRequest = null;
        $(function () {
            var minlength = 1;
            $("#search-students").keyup(function () {
                var that = this,
                    value = $(this).val(),
                    search_results = document.querySelector('#search-results');
                if (value.length >= minlength) {
                    if (searchRequest != null)
                        searchRequest.abort();
                    searchRequest = $.ajax({
                        type: "GET",
                        url: "/search/students/" + value,
                        dataType: "json",
                        success: function (msg) {
                            var name = msg.student.surname + " " + msg.student.first_name + " " + msg.student.last_name,
                                total = msg.total_payments;
                            search_results.innerHTML = "<h4 class='text-success'>" + name + "</h4>" +
                                "<p><strong>Total Paid: </strong>" + total + "</p>";
                        },
                        statusCode: {
                            404: function () {
                                search_results.innerHTML = "<h4 class='text-danger'>The ID provided is not in record.</h4>"
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
