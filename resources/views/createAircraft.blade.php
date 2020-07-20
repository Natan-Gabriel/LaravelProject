@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h1>Add an aircraft</h1>
        </div>
        <div class="row">
            <form method="post"  action="{{ route('aircrafts.store') }}" >
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
                    <label for="hub_id">Hub(id)</label>
                    <input type="text" class="form-control @error('hub_id') is-invalid @enderror" id="hub_id" name="hub_id" placeholder="Hub(id)" value="{{ old('hub_id') }}">
                    @error('hub_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection