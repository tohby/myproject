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
        @if (count($questions) > 0)
            @foreach ($questions as $question)
            <a href="question/{{$question->slug}}" class="carded">
            <div class="card border-0 p-3">
                <div class="media my-2">
                    <img src="{{ $question->user->getUrlfriendlyAvatar() }}" />
                    <div class="media-body ml-2">
                        <div class="card-title"><h1 class="mt-0">{{$question->title}}</h1><h5>{{$question->user->name}} <small> <i>{{$question->created_at->diffForHumans()}}</i> </small></h5></div>
                        <p>{{$question->question}}</p>
                    </div>
                </div>
            </div>
            </a>
            @endforeach
        @endif
        </div>
    </div>
</div>
@endsection