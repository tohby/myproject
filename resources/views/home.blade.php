@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @auth
        <button type="button" class="btn btn-primary btn-lg btn-block mb-5" data-toggle="modal" data-target="#exampleModal">Create New Post</button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{action("QuestionController@store")}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control border-0" name="title" placeholder="Add a title">
                            </div>
                            <hr>
                            <div class="form-group">
                                <textarea class="form-control border-0" name="question" rows="3" placeholder="What's on your mind?"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        @endauth

        <div class="col-lg-12">
            @foreach ($questions as $question)
            <a href="{{$question->slug}}">
            <div class="card border-0">
                <div class="media">
                    <img src="{{ Avatar::create($question->user->name)->setDimension(50, 50) }}" />
                    <div class="media-body ml-2">
                        <h1 class="mt-0">{{$question->title}}</h1>
                        <p>{{$question->question}}</p>
                    </div>
                </div>
            </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection