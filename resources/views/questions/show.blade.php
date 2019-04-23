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
            
            <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <div class="card m-3 p-3">
                <div class="my-2">
                    <i class="fas fa-reply"></i> Write a reply
                </div>
            </div>
            </a>

            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <form action="">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Reply</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection