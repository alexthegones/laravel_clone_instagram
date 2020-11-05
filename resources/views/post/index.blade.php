@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="display-4 text-center mb-5"><u>Dernier posts</u></h1>
        @foreach($posts as $post)
            <div class="row mb-3">
                <div class=" col-6 offset-3">
                    <a href="{{ route('post.show', ['post' => $post->id]) }}"><img
                            src="{{ asset('storage') . '/' . $post->image }}" class="w-100" alt=""></a>
                    <div class="mt-2">
                        Posté par <strong>{{ $post->user->username }}</strong>
                        le {{ $post->created_at->format('d/m/Y') }}
                    </div>
                    <hr>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
