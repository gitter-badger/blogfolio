@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('packages/ukadev/blogfolio/js/dashboard/portfolios.js') }}"></script>
<div class="row">
    <div class="col-lg-12">
        <section class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ trans("blogfolio::navigation.portfolio") }}</h3>
            </div>
            <form class="form" id="create-portfolio-form" method="PUT" onsubmit="return false;">
            	<div class="box-body clearfix">
                	<div class="form-group">
                        <label for="name">{{ trans('Name') }}:</label>
                        <input type="text" class="form-control" id="name" name="name" value=''>
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
                        <?php $i = 0?>
                        @foreach ($langs as $lang)
                                @if ($i == 0)
                                        <?php $active = 'active'?>
                                @else
                                    <?php $active = '' ?>
                                @endif
                                <div id="{{ $lang->locale }}-content" class="tab-pane {{$active}}">
                                    <textarea class="form-control" id="{{$lang->locale}}-content" name="{{$lang->locale}}-content"></textarea>
                                </div>
                                    <?php $i++ ?>
                            @endforeach
                        </div><!-- /.tab-content -->    
                    </div>
                    <div class="form-group">
                        {{ Form::label('active', trans('Active?')) }}
                       	{{ Form::checkbox('active', 1, true) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('user_skills', trans('Show skills?')) }}
                       	{{ Form::checkbox('user_skills', 1) }}
                    </div>
                    <div class="form-group hidden" id="showSkills">
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
                    </div>
                    <div id="social">
                        <div class="form-group" id="showSocial">
                             {{ Form::label('socialLinks', trans('Social Links')) }}
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
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('projects', trans('Projects')) }}: <br>
                        <a id="select-all" href="#">{{trans('select all')}}</a> / <a id="deselect-all" href="#">{{trans('deselect all')}}</a>
                        <select id="projects" name='projects[]' multiple='multiple'>
                            @foreach ($projects as $project)
                                <option value='{{$project->id}}'>{{$project->name}}</option>
                            @endforeach
                        </select>
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