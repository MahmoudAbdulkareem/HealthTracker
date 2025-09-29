@extends('layout.master')

@section('title','Add Participation')

@section('content')
<div class="card">
    <div class="card-header">Add Participation</div>
    <div class="card-body">
        <form action="{{ route('participations.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Challenge</label>
                <select name="challenge_id" class="form-control" required>
                    @foreach($challenges as $challenge)
                        <option value="{{ $challenge->id }}">{{ $challenge->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>User</label>
                <select name="user_id" class="form-control" required>
                    @foreach(\App\Models\User::all() as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Add</button>
            <a href="{{ route('participations.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
