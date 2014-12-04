@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('packages/ukadev/blogfolio/js/dashboard/posts.js') }}"></script>
<div class="row">
    <div class="col-lg-12">
        <section class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ trans("blogfolio::navigation.blogfolio") }}</h3>
            </div>
            <form class="form" id="create-post-form" method="PUT" onsubmit="return false;">
            	<div class="box-body clearfix">
                    	<div class="form-group">
	                        <label for="name">{{ trans('Name') }}:</label>
	                        <input type="text" class="form-control" id="name" name="name" value=''>
	                    </div>
	                @foreach ($langs as $lang)
                    	<div class="form-group">
	                        <label for="{{$lang->locale}}-content">{{ trans('Content') }} {{ $lang->name }}:</label>
	                        <textarea class="form-control" id="{{$lang->locale}}-content" name="{{$lang->locale}}-content"></textarea>
	                    </div>
                    @endforeach
                    <div class="form-group">
                        {{ Form::label('active', trans('Active?')) }}
                       	{{ Form::checkbox('active', 1, true) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('user_skills', trans('Show skills?')) }}
                       	{{ Form::checkbox('user_skills', 1) }}
                    </div>
                    <div class="form-group">
	                        <label for="tags">{{ trans('Tags') }}: <br>
	                    	<input type="text" data-role="tagsinput" class="form-control" id="tags" name="tags" />
	                    </div>
                    <div class="box-footer">
                   		<button id="create-post" class="btn btn-primary">{{ trans('syntara::all.create') }}</button>
                   	</div>
            	</div>
            </form>
        </section>
    </div>
</div>
@stop