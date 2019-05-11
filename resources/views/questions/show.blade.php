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
                            <h5>{{$question->user->name}} <small> <i>{{$question->created_at->diffForHumans()}}</i>
                                </small></h5>
                        </div>
                        <p>{{$question->question}}</p>
                        <br>
                        @auth
                            @if ( $question->user->id == Auth::user()->id)
                            <div class="float-right">
                                <a data-toggle="modal" href=".bd-example-modal-xl"><i class="fas fa-pencil-alt"></i> Edit</a>
                               
                                <a data-toggle="modal" href="#deleteModal" class="text-danger ml-2"><i class="fas fa-trash-alt"></i> Delete</a>
                            </div>
                            @endif
                        @endauth
                        
                    </div>
                </div>
            </div>
            <div class="my-2">
                {{count($question->comments)}} Answers
            </div>

            <hr> @foreach ($question->comments as $comment)
            <div class="card border-0 p-5 mb-2 {{$comment->id == $question->best_reply ? 'correct' : ''}}">
                <div class="media my-2">
                    <img src="{{ $comment->user->getUrlfriendlyAvatar() }}" />
                    <div class="media-body ml-2">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="card-title">
                                    <h5 class="d-inline">{{$comment->user->name}} <small>
                                            <i>{{$comment->created_at->diffForHumans()}}</i> </small></h5>
                                </div>
                            </div>
                            <div class="col-lg-3">
                            @if ($comment->id == $question->best_reply)
                            <button type="button" class="btn btn-outline-success" data-toggle="button"
                                aria-pressed="false" autocomplete="off"><i class="far fa-check-circle"></i> Best
                                Answer</button>
                            @else
                            @auth
                            @if (Auth::user()->id == $question->user->id)
                            @if ($question->best_reply == null)
                           
                                <form action="{{action("BestReply@update", "$question->id")}}" method="POST"
                                    enctype="multipart/form-data"> @csrf
                                    <input type="hidden" name="bestReply" id="bestReply" value="{{$comment->id}}">
                                    @method('PUT')
                                    <button type="submit" class="btn btn-outline-success"><i
                                            class="far fa-check-circle"></i> Best Answer</button>
                                </form>
                            
                            @else
                            @endif
                            @endif
                            @endauth
                            @endif
                            </div>
                        </div>

                        <p class="mt-2">{{$comment->comment}}</p>
                    </div>
                </div>
                @auth
                    @if ( $question->user->id == Auth::user()->id)
                    <div class="float-right">
                        <a data-toggle="modal" href="#deleteModal" class="text-danger ml-2"><i class="fas fa-trash-alt"></i> Delete</a>
                    </div>
                    @elseif ($comment->user->id == Auth::user()->id)
                    <div class="row float-right">
                        <a data-toggle="collapse" href="#collapse{{$comment->id}}" role="button" aria-expanded="false"
                                aria-controls="collapseExample" class="d-inline float-right"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <a data-toggle="collapse" href="#collapseDelete{{$comment->id}}" class="d-inline text-danger ml-2"><i class="fas fa-trash-alt"></i> Delete</a>
                    </div>
                        
                        <div class="collapse" id="collapse{{$comment->id}}">
                            <div class="card card-body mt-2">
                                <form action="{{action("CommentController@update", $comment->id)}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="comment" placeholder="Add a comment"
                                            value="{{$comment->comment}}">
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right">Save changes</button>
                                    @method('PUT')
                                </form>
                            </div>
                        </div>
                        <div class="collapse" id="collapseDelete{{$comment->id}}">
                            <div class="card card-body mt-2">
                               <h5>Are you sure you want to delete this comment? Please note that this action is not reversible.</h5>
                               <form action="{{action("CommentController@destroy", "$comment->id")}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete" />
                                    <a data-toggle="collapse" href="#collapseDelete{{$comment->id}}" class="d-inline text-secondary ml-2"> Cancel</a>
                                    <button type="submit" class="btn btn-danger ml-1"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endauth
            </div>
            @endforeach {{-- {{$question->comments}} --}}
            @auth
            <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                aria-controls="collapseExample">
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
            @guest
            <a href="#" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">Login to Post a
                Comment</a>
            @endguest

        </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{action("QuestionController@update", $question->slug)}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control border-0" name="title" placeholder="Add a title" value="{{$question->title}}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <textarea class="form-control border-0" name="question" rows="3"
                            placeholder="What's on your mind?">{{$question->question}}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    @method('PUT')
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End edit modal->

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title font-weight-bold" id="deleteModalLabel">Are you sure you want to delete this question?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                This action will make the question unaccessible to other users, but you can still access it in the trash
            </div>
            <div class="modal-footer border-0">
                <form action="{{action("QuestionController@destroy", "$question->slug")}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="delete" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- delete modal end --}}
@endsection