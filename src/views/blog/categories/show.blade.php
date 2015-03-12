@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('packages/ukadev/blogfolio/js/dashboard/categories.js') }}"></script>
<div class="row">
    <div class="col-lg-6">
        <section class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ trans("blogfolio::navigation.categories") }}</h3>
            </div>
            <form class="form" id="edit-category-form" method="POST" onsubmit="return false;">
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
						        <li class="{{$active}}"><a data-toggle="tab" href="#{{ $lang->locale }}">{{ $lang->name }}</a></li>
						        <?php $i++ ?>
								@endforeach
							<li class="pull-left header"><i class="fa fa-th"></i>{{ trans('blogfolio::all.name') }}</li>
						</ul>
                        <div class="tab-content">
                        	@foreach ($cat->catData as $key => $data)
		                    		<?php $i = 0?>
										@foreach ($langs as $lang)
											@if ($i == 0)
												<?php $active = 'active'?>
											@else
												<?php $active = '' ?>
											@endif
											@if (in_array($lang->id, $allLangs))
												@if ($data->lang == $lang->locale)
													<div id="{{ $lang->locale }}" class="tab-pane {{$active}}">
							                        	<input type="text" class="form-control" id="{{$lang->locale}}" name="lang-{{$lang->locale}}" value='{{$data->name}}'>
							                        </div>
												@endif
											@else
											<div id="{{ $lang->locale }}" class="tab-pane">
					                        	<input type="text" class="form-control" id="{{$lang->locale}}" name="lang-{{$lang->locale}}" value=''>
					                        </div>
											@endif
											<?php $i++ ?>
										@endforeach
		                    @endforeach
                        </div>
            		</div>
                    <div class="box-footer">
                   		<button id="update-settings" class="btn btn-primary">{{ trans('syntara::all.update') }}</button>
                   	</div>
            	</div>
            </form>
        </section>
    </div>
</div>
@stop