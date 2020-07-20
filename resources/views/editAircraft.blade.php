{{--<!--  @extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Update a contact</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif --> --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h1>Update the aircraft</h1>
        </div>
        <div class="row">
        <form method="post" action="{{ route('aircrafts.update', $aircraft->id) }}">
            @method('PATCH') 
            @csrf
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        Please fix the following errors
                    </div>
                @endif
            <div class="form-group">

                <label for="name">Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value= "<?php echo $aircraft->name ?>" />
                @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="hub_id">Hub(id):</label>
                <input type="text" class="form-control @error('hub_id') is-invalid @enderror" name="hub_id" value={{ $aircraft->hub_id }} />
                @error('hub_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection