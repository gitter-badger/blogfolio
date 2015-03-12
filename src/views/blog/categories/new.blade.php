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
            		<div class="nav-tabs-custom">
	                    <ul class="nav nav-tabs pull-right">
	                    	 <?php $i = 0?>
							@foreach ($langs as $lang)
								@if ($i == 0)
									<?php $active = 'active'?>
								@else
									<?php $active = '' ?>
								@endif
					        <li class="{{$active}}"><a data-toggle="tab" href="#{{ $lang->name }}">{{ $lang->name }}</a></li>
					        <?php $i++ ?>
							@endforeach
	                        <li class="pull-left header"><i class="fa fa-th"></i>{{ trans('blogfolio::all.name') }}</li>
	                    </ul>
	                    <div class="tab-content">
						<?php $i = 0?>
                        @foreach ($langs as $lang)
						    	@if ($i == 0)
										<?php $active = 'active'?>
								@else
									<?php $active = '' ?>
								@endif
						    	<div id="{{ $lang->name }}" class="tab-pane {{$active}}">
		                        	<input type="text" class="form-control" id="lang_id-{{$lang->id}}" name="lang_id-{{$lang->id}}" value=''>
		                        </div>
		                        	<?php $i++ ?>
							@endforeach
                        </div><!-- /.tab-content -->
                    <div class="box-footer">
                   		<button id="update-settings" class="btn btn-primary">{{ trans('syntara::all.create') }}</button>
                   	</div>
            	</div>
            </form>
        </section>
    </div>
</div>
@stop