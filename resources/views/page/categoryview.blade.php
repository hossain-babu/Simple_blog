@extends('welcome')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">

      <a href="{{ route('add.category')}}" class="btn btn-danger">Add Category</a>
      <a href="{{ route('all.category') }}" class="btn btn-info">All Category</a>
      <hr>
      <br>
      <ol>
        <li>Category Name :  {{ $cat->name }}</li>
        <li>Slug Name : {{ $cat->slug }}</li>
        <li>Date Of Creation : {{ $cat->created_at}} </li>
      </ol>

    </div>
  </div>
</div>

@endsection