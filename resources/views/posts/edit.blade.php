@extends('layouts.app')
@section('content')
<script type="text/javascript" src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector : "textarea",
        plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
    }); 
</script>
<div class="col-md-8 col-md-offset-2">
<form method="post" id="blog-edit">
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <input type="hidden" id="post_id" name="post_id" value="{{$post->id}}"/>
    <div class="form-group">
        <input required="required" placeholder="Enter title here" type="text" name = "title" class="form-control" value="@if(!old('title')){{$post->title}}@endif{{ old('title') }}"/>
    </div>
    <div class="form-group">
        <textarea name='content' class="form-control">
            @if(!old('content'))
            {!! $post->content !!}
            @endif
            {!! old('content') !!}
        </textarea>
    </div>
    <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
    <a href="/blog/{{$post->id}}" data-method='delete' rel='nofollow' class="jq-method-override btn btn-danger">Delete</a>
</form>
</div>
@endsection
