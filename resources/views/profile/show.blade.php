@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-4">
                <img src="{{ $user->profile->getImage() ?? asset('/storage/default.png') }}" class="rounded-circle"
                     width="180" alt="">
            </div>
            <div class="col-8">
                <div class="d-flex">
                    <div class="h4 mr-3">{{ $user->username }}</div>
                    @if(!$protect)
                        <follow-button profile-id="{{ $user->profile->id }}" follow="{{ $follow }}"></follow-button>
                    @endif
                </div>
                <div class="mt-2">
                    @can('update', $user->profile)
                        <a href="{{ route('profile.edit', ['username' => $user->username]) }}"
                           class="btn btn-outline-secondary">Modifier mes informations</a>
                    @endcan
                </div>
                <div class="d-flex mt-3">
                    <div class="mr-3"><strong>{{ $postsCount }}</strong> publications</div>
                    <div class="mr-3"><strong>{{ $followersCount }}</strong> abonnés</div>
                    <div class="mr-3"><strong>{{ $followingCount }}</strong> abonnements</div>
                </div>
                <div class="mt-2">
                    <div class="font-weight-bold">{{ $user->profile->title }}</div>
                    <div class="font-weight-bold">{{ $user->profile->description }}</div>
                    <div><a href="#">{{ $user->profile->url }}</a></div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            {{--            @if (session('status'))--}}
            {{--                <div class="alert alert-success">--}}
            {{--                    {{ session('status') }}--}}
            {{--                </div>--}}
            {{--            @endif--}}
            @if($user->posts->count())
                @foreach($user->posts as $post)
                    <div class="col-4 p-2">
                        <a href="{{ route('post.show', ['post' => $post->id]) }}"><img
                                src="{{ asset('storage') . '/' . $post->image }}" class="w-100" alt=""></a>
                    </div>
                @endforeach
            @else
                <div class="col-6">
                    <div class="alert alert-warning" role="alert">
                        Pas de posts encore disponible sur ce profile..
                    </div>
                </div>
            @endif
        </div>
@endsection
