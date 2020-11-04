@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edition du profil</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update', ['user' => $user]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="title" class="">Title</label>
                                <input id="title" type="text"
                                       class="form-control @error('title') is-invalid @enderror" name="title"
                                       value="{{ old('title') ?? $user->profile->title  }}" autocomplete="title"
                                       autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description" class="">Description</label>
                                <textarea id="description" type="text"
                                          class="form-control @error('description') is-invalid @enderror"
                                          name="description"
                                          autocomplete="description" autofocus>{{ old('description') ?? $user->profile->description  }}</textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="url" class="">URL</label>
                                <input id="url" type="text"
                                       class="form-control @error('url') is-invalid @enderror"
                                       name="url"
                                       value="{{ old('url') ?? $user->profile->url }}" autocomplete="url" autofocus>

                                @error('url')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                           name="image" id="image">
                                    <label class="custom-file-label" for="validatedCustomFile">Choisir un
                                        fichier</label>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Modifier mes informations
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
