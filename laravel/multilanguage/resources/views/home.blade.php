@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h4>{{ __('welcome') }}</h4>
                <p>{{ __('login') }}</p>

                <form>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Email') }}</label>
                        <input type="text" class="form-control">
                    </div>

                    <button class="btn btn-primary">{{ __('login') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
