@extends('layouts/app')
@section('content')
    <div class="container">
        <form action="{{action("CommentController@update", $comment->id)}}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control border-0" name="comment" placeholder="Add a comment"
                    value="{{$comment->comment}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            @method('PUT')
        </form>
    </div>
@endsection