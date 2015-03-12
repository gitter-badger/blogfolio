@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('packages/ukadev/blogfolio/js/dashboard/projects.js') }}"></script>
<div class="row">
    <div class="col-lg-12">
        <section class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ trans("blogfolio::navigation.project") }}</h3>
            </div>
            <form class="form" id="create-project-form" method="PUT">
                <div class="box-body clearfix">
                    <div class="form-group">
                        <label for="name">{{ trans('blogfolio::all.name') }}:</label>
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
                            <li class="pull-left header"><i class="fa fa-th"></i>{{ trans('blogfolio::all.content') }}</li>
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
                        <label for="name">{{ trans('blogfolio::all.image') }}:</label>
                        <input type="file" class="form-control" id="file" name="file" />
                        <input type="hidden" class="form-control" id="imageName" name="imageName" value="default.png" />
                        <div id="previewFile">
                            <img alt="project image" class="project_thumb100" id="preview_image" src="/packages/ukadev/blogfolio/uploads/projects/default.png"> <i class="fa fa-refresh fa-spin" id="loaderSpin"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('status', trans('blogfolio::all.active')) }}
                        {{ Form::checkbox('status', 1, true) }}
                    </div>
                    <div class="box-footer">
                        <button id="create-project" class="btn btn-primary">{{ trans('syntara::all.create') }}</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@stop