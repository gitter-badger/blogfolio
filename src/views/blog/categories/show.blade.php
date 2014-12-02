@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('/admin/js/categories.js') }}"></script>
<div class="row">
    <div class="col-lg-6">
        <section class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ trans("admin/navigation.categories") }}</h3>
            </div>
            <form class="form" id="edit-category-form" method="POST" onsubmit="return false;">
            	<div class="box-body clearfix">
                    @foreach ($cat->catData as $key => $data)
                    	<div class="form-group">
	                        <label for="lang_id-{{$data->lang_id}}">{{ trans('Name') }}
								@foreach ($langs as $lang)
									@if ($data->lang_id == $lang->id)
										{{ $lang->name }}
									@endif
								@endforeach
	                        :</label>
	                        <input type="text" class="form-control" id="lang_id-{{$data->lang_id}}" name="lang_id-{{$data->lang_id}}" value='{{$data->name}}'>
	                    </div>
                    @endforeach
                    <div class="box-footer">
                   		<button id="update-settings" class="btn btn-primary">{{ trans('syntara::all.update') }}</button>
                   	</div>
            	</div>
            </form>
        </section>
    </div>
</div>
@stop