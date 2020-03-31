@extends('46728.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="float-left">
                    <h1>Fees</h1>

                    <h2 class="text-info">Total Fees Paid: Ksh. {{$feesTotal}} </h2>
                </div>
                <div class="float-right">
                    <a class="btn btn-success" href="{{ route('fees.create') }}"> New Payment</a>
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
                <h4>Filter payments</h4>
                <input class="form-control" id="filter-fees" type="text" placeholder="Filter..">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="fees-table">
                        <tr>
                            <th>No</th>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($fees as $fee)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $fee->student->id}}</td>
                                <td>{{ $fee->student->full_name }}</td>
                                <td>{{ $fee->amount }}</td>
                                <td>{{ $fee->created_at }}</td>
                                <td>
                                    <form action="{{ route('fees.destroy',$fee->id) }}" method="POST">
                                        <a class="btn btn-info btn-sm my-1"
                                           href="{{ route('fees.show',$fee->id) }}">Show</a>
                                        <a class="btn btn-primary btn-sm my-1"
                                           href="{{ route('fees.edit',$fee->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm my-1">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                {!! $fees->links() !!}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script !src="">
        $(document).ready(function () {
            $("#filter-fees").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#fees-table tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
