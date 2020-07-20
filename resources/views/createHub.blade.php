@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h1>Add an hub</h1>
        </div>
        <div class="row">
            <form method="post"  action="{{ route('hubs.store') }}" >
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        Please fix the following errors
                    </div>
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" placeholder="Code" value="{{ old('code') }}">
                    @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="reputation">Reputation</label>
                    <textarea class="form-control @error('reputation') is-invalid @enderror" id="reputation" name="reputation" placeholder="Reputation">{{ old('reputation') }}</textarea>
                    @error('reputation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <textarea class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Price">{{ old('price') }}</textarea>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection