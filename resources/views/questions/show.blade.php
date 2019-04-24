@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card border-0 p-3">
                <div class="media my-2">
                    <img src="{{ $question->user->getUrlfriendlyAvatar() }}" />
                    <div class="media-body ml-2">
                        <div class="card-title">
                            <h1 class="mt-0">{{$question->title}}</h1>
                            <h5>{{$question->user->name}} <small> <i>{{$question->created_at->diffForHumans()}}</i> </small></h5>
                        </div>
                        <p>{{$question->question}}</p>
                    </div>
                </div>
            </div>
            <div class="my-2">
                {{count($question->comments)}} Answers
            </div>

            <hr> @foreach ($question->comments as $comment)
            <div class="card border-0 p-5 mb-2 {{$comment->id == $question->best_reply ? 'bg-success' : ''}}">
                <div class="media my-2">
                    <img src="{{ $comment->user->getUrlfriendlyAvatar() }}" />
                    <div class="media-body ml-2">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="card-title">
                                    <h5>{{$comment->user->name}} <small> <i>{{$comment->created_at->diffForHumans()}}</i> </small></h5>
                                </div>
                            </div>
                            @auth
                                @if (Auth::user()->id == $question->user->id)
                                    @if ($question->best_reply == null)
                                        <div class="col-lg-3">
                                            <form action="{{action(" BestReply@update ", "$question->id")}}" method="POST" enctype="multipart/form-data"> @csrf
                                                <input type="hidden" name="bestReply" id="bestReply" value="{{$comment->id}}"> @method('PUT')
                                                <button type="submit" class="btn btn-outline-success">Best Answer</button>
                                            </form>
                                        </div>
                                    @endif
                                @endif
                            @endauth
                            
                            
                        </div>

                        <p>{{$comment->comment}}</p>
                    </div>
                </div>
            </div>
            @endforeach {{-- {{$question->comments}} --}} @auth
            <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <div class="card m-3 p-3">
                    <div class="my-2">
                        <i class="fas fa-reply"></i> Write a reply
                    </div>
                </div>
            </a>

            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <form action="{{action("CommentController@store")}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Reply</label>
                            <textarea class="form-control" name="comment" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="questionId" value="{{$question->id}}">
                        <button type="submit" class="btn btn-primary float-right">Save</button>
                    </form>
                </div>
            </div>
            @endauth

        </div>
    </div>
</div>
@endsection