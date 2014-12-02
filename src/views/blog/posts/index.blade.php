@extends(Config::get('adminlte::views.master'))

@section('content')
<script src="{{ asset('/admin/js/posts.js') }}"></script>

@include('syntara::layouts.dashboard.confirmation-modal',  array('title' => trans('syntara::all.confirm-delete-title'), 'content' => trans('syntara::all.confirm-delete-message'), 'type' => 'delete-post'))

<div class="row">
    <div class="col-lg-8">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ trans('admin/navigation.posts') }}</h3>

                <div class="box-tools">
                    <div class="pull-right">
                        <a id="delete-item" class="btn btn-danger posts">{{ trans('syntara::all.delete') }}</a>
                        <a class="btn btn-info btn-new" href="{{ URL::route('newPost') }}">{{ trans('admin/posts.new') }}</a>
                    </div>
                </div>
            </div>
            <div class="box-body ajax-content no-padding">
                @include('admin.blog.posts.list')
            </div>
        </div>
    </div>

</div>
@stop