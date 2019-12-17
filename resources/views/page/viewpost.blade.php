@extends('welcome')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
    <a href="{{ route('all.post') }}" class="btn btn-info">All Posts</a>
      <hr>

      <br>
        <h1>{{ $post->title }}</h1>
        <img src="{{ URL::to($post->image) }} " height="340px">
        <p>Category Name : {{ $post->name }}</p>
        <p>{{ $post->details }}</p>
      

    </div>
  </div>
</div>

@endsection