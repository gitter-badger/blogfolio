@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('packages/ukadev/blogfolio/js/dashboard/posts.js') }}"></script>
<div class="row">
    <div class="col-lg-12">
        <section class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ trans("blogfolio::navigation.posts") }}</h3>
            </div>
            <form class="form" id="edit-post-form" method="PUT" onsubmit="return false;">
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
						        <li class="{{$active}}"><a data-toggle="tab" href="#{{ $lang->name }}-title">{{ $lang->name }}</a></li>
						        <?php $i++ ?>
								@endforeach
							<li class="pull-left header"><i class="fa fa-th"></i>{{ trans('Title') }}</li>
						</ul>
                        <div class="tab-content">
                        	@foreach ($post->postData as $key => $data)
		                    		<?php $i = 0?>
										@foreach ($langs as $lang)
											@if ($i == 0)
												<?php $active = 'active'?>
											@else
												<?php $active = '' ?>
											@endif
											@if (in_array($lang->id, $allLangs))
												@if ($data->lang_id == $lang->id)
													<div id="{{ $lang->name }}-title" class="tab-pane {{$active}}">
							                        	<input type="text" class="form-control" id="{{$lang->locale}}-title" name="{{$lang->locale}}-title" value='{{$data->title}}'>
							                        </div>
												@endif
											@else
											<div id="{{ $lang->name }}-title" class="tab-pane">
					                        	<input type="text" class="form-control" id="{{$lang->locale}}-title" name="{{$lang->locale}}-title" value=''>
					                        </div>
											@endif
											<?php $i++ ?>
										@endforeach
		                    @endforeach
                        </div>
            		</div>
            		<div class="nav-tabs-custom">
						<ul class="nav nav-tabs pull-right">
							<?php $i = 0?>
							@foreach ($langs as $lang)
								@if ($i == 0)
									<?php $active = 'active'?>
								@else
									<?php $active = '' ?>
								@endif
						        <li class="{{$active}}"><a data-toggle="tab" href="#{{ $lang->name }}-content">{{ $lang->name }}</a></li>
						        <?php $i++ ?>
								@endforeach
							<li class="pull-left header"><i class="fa fa-th"></i>{{ trans('Content') }}</li>
						</ul>
                        <div class="tab-content">
                        	@foreach ($post->postData as $key => $data)
	                    		<?php $i = 0?>
									@foreach ($langs as $lang)
										@if ($i == 0)
											<?php $active = 'active'?>
										@else
											<?php $active = '' ?>
										@endif
										@if (in_array($lang->id, $allLangs))
											@if ($data->lang_id == $lang->id)
												<div id="{{ $lang->name }}-content" class="tab-pane {{$active}}">
						                        	 <textarea class="form-control" id="{{$lang->locale}}-content" name="{{$lang->locale}}-content">{{$data->content}}</textarea>
						                        </div>
											@endif
										@else
										<div id="{{ $lang->name }}-content" class="tab-pane">
				                        	 <textarea class="form-control" id="{{$lang->locale}}-content" name="{{$lang->locale}}-content"></textarea>
				                        </div>
										@endif
										<?php $i++ ?>
									@endforeach
		                    @endforeach
                        </div>
            		</div>
	                    <div class="form-group">
	                        {{ Form::label('active', trans('Active ?')) }}
	                       	{{ Form::checkbox('active', 1, $post->active) }}
	                    </div>
	                    <div class="form-group">
	                        {{ Form::label('category', trans('Category')) }}
	                        <select class="form-control" name="category" id="category">
		                       	@foreach ($cats as $cat)
		                       		<option value='{{$cat->cat_id}}'{{($cat->cat_id == $post->category_id) ? ' selected' : ''}}>{{$cat->name}}</option>
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