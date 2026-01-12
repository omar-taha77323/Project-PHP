@extends('dsadmin.layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Discount</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Code</th>
                                        <th>Value</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($discounts as $discount)
                                        <tr>
                                            <td>{{ $discount->id }}</td>
                                            <td>{{ $discount->code }}</td>
                                            <td>{{ $discount->value }}</td>
                                            <td>{{ $discount->start_date }}</td>
                                            <td>{{ $discount->end_date }}</td>
                                            <td>{{ $discount->created_at }}</td>
                                            <td>{{ $discount->updated_at }}</td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection