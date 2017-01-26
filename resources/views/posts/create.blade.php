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
<form method="post" id="new-blog">
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <div class="form-group">
        <input required="required" placeholder="Enter title here" type="text" name = "title" class="form-control" value="{{ old('title') }}"/>
    </div>
    <div class="form-group">
        <textarea id='content' name='content' class="form-control">
        </textarea>
    </div>
    <input type="submit" name='publish' class="btn btn-success" value = "Create"/>
</form>
</div>
@endsection
