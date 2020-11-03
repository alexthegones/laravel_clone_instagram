@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">

            </div>
            <div class="col-8">
                <div class="h4 mr-3">{{ $user->username }}</div>
                <button class="btn btn-primary">S'abonner</button>
                <div class="d-flex mt-3">
                    <div class="mr-3"><strong>18</strong> publications</div>
                    <div class="mr-3"><strong>210</strong> abonnés</div>
                    <div class="mr-3"><strong>180</strong> abonnements</div>
                </div>
                <div>
                    <div class="font-weight-bold">{{ $user->profile->title }}</div>
                    <div class="font-weight-bold">{{ $user->profile->description }}</div>
                    <div><img src="{{ asset('svg/github.svg') }}" width="25px" class="mr-2" alt=""><a
                            href="#">{{ $user->profile->url }}</a></div>
                </div>
            </div>
        </div>
        <div class="row">
{{--            @if (session('status'))--}}
{{--                <div class="alert alert-success">--}}
{{--                    {{ session('status') }}--}}
{{--                </div>--}}
{{--            @endif--}}
            @foreach($user->posts as $post)
                <div class="col-4 p-2">
                    <a href="{{ route('post.show', ['post' => $post->id]) }}"><img src="{{ asset('storage') . '/' . $post->image }}" class="w-100" alt=""></a>
                </div>
            @endforeach
        </div>
@endsection
