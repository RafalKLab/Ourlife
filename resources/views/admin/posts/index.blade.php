@extends('templates.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>All user posts</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>user_id</th>
                        <th>parent_id</th>
                        <th>body</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->user_id }}</td>
                            <td>{{ $item->parent_id }}</td>
                            <td>{{ $item->body }}</td>
                            <td>
                                <form action="{{route('PostDelete', ['id'=>$item->id])}}" method="POST">
                                    @csrf
                                    <input type="submit" class="btn btn-danger my-2" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
