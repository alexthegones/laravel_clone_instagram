@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">

            </div>
            <div class="col-8">
                <h4>laravel_clone_instagram</h4>
                <button class="btn btn-primary">S'abonner</button>
                <div class="d-flex mt-3">
                    <div class="mr-3"><strong>18</strong> publications</div>
                    <div class="mr-3"><strong>210</strong> abonnés</div>
                    <div class="mr-3"><strong>180</strong> abonnements</div>
                </div>
                <div>
                    <div>Laravel Application</div>
                    <div><img src="{{ asset('svg/github.svg') }}" width="25px" class="mr-2" alt=""><a href="#">github.com</a> </div>
                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-4">
        </div>
    </div>
@endsection
