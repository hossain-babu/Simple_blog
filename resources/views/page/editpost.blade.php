@extends('welcome')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">

      <a href="{{ route('all.post') }}" class="btn btn-info">All Posts</a>
      <hr>
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <form action="{{ URL::to('update/post/'.$post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Post Title</label>
            <input type="text" class="form-control"  name="title" value="{{ $post->title }}" required>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Category</label>
            <select class="form-control" name="category_id">
              @foreach($category as $cat)
              <option value="{{ $cat->id }}" <?php if($cat->id == $post->category_id) echo "selected";  ?>>  {{ $cat->name }} </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group col-xs-12 floating-label-form-group controls">
            <label>New Image</label>
            <input type="file" class="form-control" name="image">
          Old Image :  <img src="{{ url($post->image) }}" height="70px" width="70px">
          <input type="hidden" name="old_photo" value="{{ $post->image }}">
          </div>
        </div>
        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Post Details</label>
            <textarea rows="5" class="form-control" name="details" required> {{$post->details}} </textarea>
          </div>
        </div>
        <br>
        <div id="success"></div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary" id="sendMessageButton">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection