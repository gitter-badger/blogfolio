@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('/admin/js/posts.js') }}"></script>
<div class="row">
    <div class="col-lg-12">
        <section class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ trans("admin/navigation.posts") }}</h3>
            </div>
            <form class="form" id="edit-post-form" method="PUT" onsubmit="return false;">
            	<div class="box-body clearfix">
            		@foreach ($post->postData as $key => $data)
                    	<div class="form-group">
								@foreach ($langs as $lang)
									@if ($data->lang_id == $lang->id)
	                        			<label for="{{$lang->locale}}-title">{{ trans('Title') }}
											{{ $lang->name }}
		                        		:</label>
		                        		<input type="text" class="form-control" id="{{$lang->locale}}-title" name="{{$lang->locale}}-title" value='{{$data->title}}'>
									@endif
								@endforeach
	                    </div>
                    @endforeach
	                @foreach ($post->postData as $key => $data)
	                    <div class="form-group">
								@foreach ($langs as $lang)
									@if ($data->lang_id == $lang->id)
	                        			<label for="{{$lang->locale}}-content">{{ trans('Content') }}
										{{ $lang->name }}
				                        :</label>
				                        <textarea class="form-control" id="{{$lang->locale}}-content" name="{{$lang->locale}}-content">{{$data->content}}</textarea>
									@endif
								@endforeach
	                    </div>
	                @endforeach
	                    <div class="form-group">
	                        {{ Form::label('active', trans('Active ?')) }}
	                       	{{ Form::checkbox('active', 1, true) }}
	                    </div>
	                    <div class="form-group">
	                        {{ Form::label('category', trans('Category')) }}
	                        <select class="form-control" name="category" id="category">
		                       	@foreach ($cats as $cat)
		                       		<option value='{{$cat->id}}'{{($cat->cat_id == $post->category_id) ? ' selected' : ''}}>{{$cat->name}}</option>
		                       	@endforeach
	                       	</select>
	                    </div>
	                    <div class="form-group">
	                        {{ Form::label('tags', trans('Tags')) }}
	                    	<input type="text" data-role="tagsinput" class="form-control" id="tags" name="tags" value="{{$post->tags}}" />
	                    </div>
                    <div class="box-footer">
                   		<button id="update-settings" class="btn btn-primary">{{ trans('syntara::all.create') }}</button>
                   	</div>
            	</div>
            </form>
        </section>
    </div>
</div>
@stop