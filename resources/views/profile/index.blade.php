@extends('layouts.main')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Profile </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('profiles.create') }}"> Create New Profile</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Picture</th>
            <th>Phone Number</th>      
            <th width="280px">Action</th>
        </tr>
    @foreach ($items as $key => $item)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->email }}</td>
        <td><img src='{{ $item->profilepic }}' width="100" height="100"></td>
         <td>{{ $item->phonenumber }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('profiles.show',$item->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('profiles.edit',$item->id) }}">Edit</a>
           
        </td>
    </tr>
    @endforeach
    </table>

    {!! $items->render() !!}

@endsection