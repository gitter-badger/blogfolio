@extends(Config::get('blogfolio::views.master'))

@section('content')
<script src="{{ asset('packages/ukadev/blogfolio/js/dashboard/categories.js') }}"></script>
<div class="row">
    <div class="col-lg-6">
        <section class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ trans("blogfolio::navigation.categories") }}</h3>
            </div>
            <form class="form" id="create-category-form" method="PUT" onsubmit="return false;">
            	<div class="box-body clearfix">
                    @foreach ($langs as $lang)
                    	<div class="form-group">
	                        <label for="{{$lang->id}}_name">{{ trans('Category Name') }} {{ $lang->name }}:</label>
	                        <input type="text" class="form-control" id="lang_id-{{$lang->id}}" name="lang_id-{{$lang->id}}" value=''>
	                    </div>
                    @endforeach
                    <div class="box-footer">
                   		<button id="update-settings" class="btn btn-primary">{{ trans('syntara::all.create') }}</button>
                   	</div>
            	</div>
            </form>
        </section>
    </div>
</div>
@stop