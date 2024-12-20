@extends('backend.master')

@section('content')
    <div style="padding:20px">
        <h1>Discount List</h1>
        @if (checkPermission('discount.form'))
            <div><a href="{{ route('discount.form') }}" class="btn btn-primary">Add New Discount</a></div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id </th>
                    <th scope="col">Discount Name</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Discount Percentage</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($discount as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->discount_name }}</td>
                        <td>{{ $data->category_name }}</td>
                        <td>{{ $data->product_name }}</td>
                        <td>{{ $data->discount_percentage }}</td>
                        <td>
                            
                                <a href="" type="button" class="btn btn-success">Edit</a>
                            
                            @if (checkPermission('discount.delete'))
                                <a href="{{ route('discount.delete', $data->id) }}" type="button" class="btn btn-danger">Delete</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
