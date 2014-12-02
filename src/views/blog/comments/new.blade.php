@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('/admin/js/posts.js') }}"></script>
<div class="row">
    <div class="col-lg-12">
        <section class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ trans("admin/navigation.posts") }}</h3>
            </div>
            <form class="form" id="create-post-form" method="PUT" onsubmit="return false;">
            	<div class="box-body clearfix">
					@foreach ($langs as $lang)
                    	<div class="form-group">
	                        <label for="{{$lang->locale}}-title">{{ trans('Title') }} {{ $lang->name }}:</label>
	                        <input type="text" class="form-control" id="{{$lang->locale}}-title" name="{{$lang->locale}}-title" value=''>
	                    </div>
                    @endforeach
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
                    <div class="box-footer">
                   		<button id="create-post" class="btn btn-primary">{{ trans('syntara::all.create') }}</button>
                   	</div>
            	</div>
            </form>
        </section>
    </div>
</div>
@stop