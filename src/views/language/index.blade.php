@extends(Config::get('blogfolio::views.master'))

@section('content')
<script src="{{ asset('packages/ukadev/blogfolio/js/dashboard/languages.js') }}"></script>

@include('syntara::layouts.dashboard.confirmation-modal',  array('title' => trans('syntara::all.confirm-delete-title'), 'content' => trans('Are you sure you want to delete it?'), 'type' => 'delete-language'))

<div class="row">
    <div class="col-lg-9">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ trans('blogfolio::navigation.languages') }}</h3>

                <div class="box-tools">
                    <div class="pull-right">
                        <a id="delete-item" class="btn btn-danger posts">{{ trans('syntara::all.delete') }}</a>
                        <a class="btn btn-info btn-new" href="{{ URL::route('newLanguage') }}">{{ trans('blogfolio::languages.new') }}</a>
                    </div>
                </div>
            </div>
            <div class="box-body ajax-content no-padding">
                @include('blogfolio::language.list')
            </div>
        </div>
    </div>

</div>
@stop