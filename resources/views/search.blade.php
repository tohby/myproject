@extends('layouts/app')
@section('content')
    <div class="container">
        @foreach ($questions as $question)
        <a href="question/{{$question->slug}}" class="carded">
            <div class="card border-0 p-3">
                <div class="media my-2">
                    <img src="{{ $question->user->getUrlfriendlyAvatar() }}" />
                    <div class="media-body ml-2">
                        <div class="card-title">
                            <h1 class="mt-0">{{$question->title}}</h1>
                            <h5>{{$question->user->name}} <small> <i>{{$question->created_at->diffForHumans()}}</i> </small>
                            </h5>
                        </div>
                        <p>{{$question->question}}</p>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
        <div class="float-right">
            {{$questions->links()}}
        </div>
    </div>
@endsection