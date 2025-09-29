@extends('layout.master')

@section('title','Participations')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Participations</h2>
    <a href="{{ route('participations.create') }}" class="btn btn-primary">Add Participation</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Challenge</th>
            <th>User</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($participations as $part)
        <tr>
            <td>{{ $part->id }}</td>
            <td>{{ $part->challenge->name }}</td>
            <td>{{ $part->user->name }}</td>
            <td>{{ ucfirst($part->status) }}</td>
            <td>
                <a href="{{ route('participations.edit', $part->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('participations.destroy', $part->id) }}" method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this participation?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
