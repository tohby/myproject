@extends('layouts/app')
@section('content')
<div class="container">
    @foreach ($questions as $question)
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
            <form action="{{action("QuestionController@restore", "$question->slug")}}" method="POST">
                @csrf
                {{-- <input type="text" name="question" value="{{$question->slug}}"> --}}
                <button type="submit" class="btn btn-danger ml-1 float-right"><i class="fas fa-trash-restore"></i></i> Restore</button>
            </form>
        </div>
    @endforeach
    <div class="float-right">
        {{$questions->links()}}
    </div>
</div>
@endsection