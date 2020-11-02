@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Création d'un nouveau post</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="caption" class="">Caption</label>
                                <input id="caption" type="text"
                                       class="form-control @error('caption') is-invalid @enderror" name="caption"
                                       value="{{ old('caption') }}" autocomplete="caption" autofocus>

                                @error('caption')
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
                                    @error('caption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Créer mon post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
