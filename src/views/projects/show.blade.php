@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('packages/ukadev/blogfolio/js/dashboard/projects.js') }}"></script>
<div class="row">
    <div class="col-lg-12">
        <section class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ trans("blogfolio::navigation.project") }}</h3>
            </div>
            <form class="form" id="edit-project-form" method="post" action="portfolio/projects/uploadFile">
            	<div class="box-body clearfix">
                	<div class="form-group">
                        <label for="name">{{ trans('Name') }}:</label>
                        <input type="text" class="form-control" id="name" name="name" value='{{$project->name}}'>
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
                                <li class="{{$active}}"><a data-toggle="tab" href="#{{ $lang->locale }}-content">{{ $lang->name }}</a></li>
                                <?php $i++ ?>
                        @endforeach
                            <li class="pull-left header"><i class="fa fa-th"></i>{{ trans('Content') }}</li>
                        </ul>
                       <div class="tab-content">
                       	@foreach ($project->projectData as $key => $data)
                       	
                        <?php $i = 0?>
	                        @foreach ($langs as $lang)
	                            @if ($i == 0)
	                                    <?php $active = 'active'?>
	                            @else
	                                <?php $active = '' ?>
	                            @endif
								
								@if (in_array($lang->id, $allLangs))
									@if ($data->lang_id == $lang->id)
										<div id="{{ $lang->locale }}-content" class="tab-pane {{$active}}">
				                        	 <textarea class="form-control" id="{{$lang->locale}}-content" name="{{$lang->locale}}-content">{{$data->content}}</textarea>
				                        </div>
									@endif
								@else
								<div id="{{ $lang->locale }}-content" class="tab-pane {{$active}}">
	                                <textarea class="form-control" id="{{$lang->locale}}-content" name="{{$lang->locale}}-content"></textarea>
	                            </div>
								@endif	                            
	                                <?php $i++ ?>
	                        @endforeach
	                    @endforeach
                        </div><!-- /.tab-content -->    
                    </div>
                    <div class="form-group">
                        <label for="name">{{ trans('Image') }}:</label>
                        <input type="file" class="form-control" id="file" name="file" />
                        <input type="hidden" class="form-control" id="imageName" name="imageName" value="{{$project->image}}" />
                        <div id="previewFile">
                            @if ($project->image)
                                <img src="/packages/ukadev/blogfolio/uploads/projects/{{$project->image}}" alt="project image" class="project_thumb100" id="preview_image"> <i class="fa fa-refresh fa-spin" id="loaderSpin"></i>
                            @else
                                <img src="" alt="project image" class="project_thumb100 hidden" id="preview_image"> <i class="fa fa-refresh fa-spin" id="loaderSpin"></i>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('active', trans('Active?')) }}
                        {{ Form::checkbox('active', 1, true) }}
                    </div>
                    <div class="box-footer">
                   		<button id="create-project" class="btn btn-primary">{{ trans('syntara::all.update') }}</button>
                   	</div>
            	</div>
            </form>
        </section>
    </div>
</div>
@stop