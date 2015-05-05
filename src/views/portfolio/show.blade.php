@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('packages/ukadev/blogfolio/js/dashboard/portfolios.js') }}"></script>
<div class="row">
    <div class="col-lg-12">
        <section class="box box-primary">
            <form class="form" id="edit-portfolio-form" method="PUT" onsubmit="return false;">
            	<div class="box-body clearfix">
                	<div class="form-group">
                        <label for="first_name">{{ trans('blogfolio::all.first_name') }}:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value='{{$portfolio->first_name}}'>
                    </div>
                    <div class="form-group">
                        <label for="last_name">{{ trans('blogfolio::all.last_name') }}:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value='{{$portfolio->last_name}}'>
                    </div>
                    <div class="form-group">
                        <label for="date_of_birth">{{ trans('blogfolio::all.dOB') }}:</label>
                        <input type="text" class="form-control datepicker" id="date_of_birth" name="date_of_birth" value='{{$portfolio->dOB}}'>
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
                            <li class="pull-left header"><i class="fa fa-th"></i>{{ trans('blogfolio::all.content') }}</li>
                        </ul>
                       <div class="tab-content">
                       	@foreach ($portfolio->portfolioData as $key => $data)
                       	
                        <?php $i = 0?>
	                        @foreach ($langs as $lang)
	                            @if ($i == 0)
	                                    <?php $active = 'active'?>
	                            @else
	                                <?php $active = '' ?>
	                            @endif
								@if (in_array($lang->id, $allLangs))
									@if ($data->lang == $lang->locale)
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
                        {{ Form::label('status', trans('blogfolio::all.active')) }}
                       	{{ Form::checkbox('status', 1, $portfolio->status); }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('user_skills', trans('blogfolio::portfolio.showSkills')) }}
                       	{{ Form::checkbox('user_skills', 1, $portfolio->use_skills) }}
                    </div>
                    <div class="form-group{{($portfolio->use_skills == 0) ? ' hidden' : ''}}" id="showSkills">
                    @if($portfolio->use_skills)
                        @foreach ($skills as $key => $value)
                        	@if ($key == 0)
                        		<div class="row" id='skillsDiv'>
		                            <div class="col-xs-2">
		                                <input type="text" class="form-control" name="skills[name][]" value="{{$value['name']}}">
		                            </div>
		                            <div class="col-xs-1 input-group float-left">
		                                <input type="text" class="form-control right-no-radius" name="skills[percent][]" value="{{$value['percent']}}">
		                                <span class="input-group-addon">%</span>
		                            </div>
		                            <div class="col-xs-2">
		                                <span class="input-group-btn"><button class="btn btn-info btn-flat" type="button" id="addSkill">+</button></span>
		                            </div>
		                        </div>
                        	@else
								<div class="row" id='skillsDiv'>
								<br />
		                            <div class="col-xs-2">
		                                <input type="text" class="form-control" name="skills[name][]" value="{{$value['name']}}">
		                            </div>
		                            <div class="col-xs-1 input-group float-left">
		                                <input type="text" class="form-control right-no-radius" name="skills[percent][]" value="{{$value['percent']}}">
		                                <span class="input-group-addon">%</span>
		                            </div>
		                            <div class="col-xs-2">
		                                <span class="input-group-btn"><button class="btn btn-danger btn-flat" type="button" id="removeSkill" style="width:33px">-</button></span>
		                            </div>
		                        </div>
                        	@endif
                        @endforeach
                    @else
                        <div class="row" id='skillsDiv'>
                            <div class="col-xs-2">
                                <input type="text" class="form-control" name="skills[name][]">
                            </div>
                            <div class="col-xs-1 input-group float-left">
                                <input type="text" class="form-control right-no-radius" name="skills[percent][]">
                                <span class="input-group-addon">%</span>
                            </div>
                            <div class="col-xs-2">
                                <span class="input-group-btn"><button class="btn btn-info btn-flat" type="button" id="addSkill">+</button></span>
                            </div>
                        </div>
                    @endif
                    </div>
                    <div id="social">
                        <div class="form-group" id="showSocial">
                             {{ Form::label('socialLinks', trans('blogfolio::portfolio.socialLinks')) }}
                            @if(count($portfolio->portfolioSocial) == 0)
                            <div class="row" id='socialDiv'>
                                <div class="col-xs-5 width420" id="socialLinks">
                                    <select class="form-control right-no-radius width120 float-left btn btn-info" name="social[name][]">
                                        <option value="Facebook">Facebook</option>
                                        <option value="Twitter">Twitter</option>
                                        <option value="LinkedIn">LinkedIn</option>
                                    </select>
                                    <input type="text" class="form-control left-no-radius width260 float-left" name="social[url][]" />
                                </div>
                                <div class="col-xs-2">
                                    <span class="input-group-btn"><button class="btn btn-info btn-flat left-18" type="button" id="addSocial">+</button></span>
                                </div>
                            </div>
                            @else
                                @foreach($portfolio->portfolioSocial as $key => $value)
                                    @if($key == 0)
                                         <div class="row" id='socialDiv'>
                                            <div class="col-xs-5 width420" id="socialLinks">
                                                <select class="form-control right-no-radius width120 float-left btn btn-info" name="social[name][]">
                                                    <option value="facebook" {{($value['name'] == 'facebook') ? 'selected' : ''}}>Facebook</option>
                                                    <option value="twitter" {{($value['name'] == 'twitter') ? 'selected' : ''}}>Twitter</option>
                                                    <option value="linkedIn" {{($value['name'] == 'linkedin') ? 'selected' : ''}}>LinkedIn</option>
                                                </select>
                                                <input type="text" class="form-control left-no-radius width260 float-left" name="social[url][]" value='{{$value['link']}}' />
                                            </div>
                                            <div class="col-xs-2">
                                                <span class="input-group-btn"><button class="btn btn-info btn-flat left-18" type="button" id="addSocial">+</button></span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row" id="socialDiv"><br />
                                            <div class="col-xs-5 width420" id="socialLinks">
                                                <select class="form-control right-no-radius width120 float-left btn btn-info" name="social[name][]">
                                                    <option value="facebook" {{($value['name'] == 'facebook') ? 'selected' : ''}}>Facebook</option>
                                                    <option value="twitter" {{($value['name'] == 'twitter') ? 'selected' : ''}}>Twitter</option>
                                                    <option value="linkedIn" {{($value['name'] == 'linkedin') ? 'selected' : ''}}>LinkedIn</option>
                                                </select>
                                            <input type="text" class="form-control left-no-radius width260 float-left" name="social[url][]" value='{{$value['link']}}' />
                                            </div>
                                            <div class="col-xs-2">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-danger btn-flat left-18" type="button" style="width:33px" id="removeSocial">-</button>
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('projects', trans('blogfolio::portfolio.projects')) }}: <br>
                        <a id="select-all" href="#">{{trans('select all')}}</a> / <a id="deselect-all" href="#">{{trans('deselect all')}}</a>
                        <select id="projects-select" name='projects[]' multiple='multiple'>
                            @foreach ($projects as $project)
                                <option value='{{$project->id}}'{{(in_array($project->id, $portfolio->projects))? ' selected' : ''}}>{{$project->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="box-footer">
                   		<button id="create-post" class="btn btn-primary">{{ trans('syntara::all.update') }}</button>
                   	</div>
            	</div>
            </form>
        </section>
    </div>
</div>
@stop