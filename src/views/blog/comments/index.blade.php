@extends(Config::get('adminlte::views.master'))

@section('content')
<script src="{{ asset('/admin/js/comments.js') }}"></script>

@include('syntara::layouts.dashboard.confirmation-modal',  array('title' => trans('syntara::all.confirm-delete-title'), 'content' => trans('syntara::all.confirm-delete-message'), 'type' => 'delete-comment'))

<div class="row">
    <div class="col-lg-10">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ trans('admin/navigation.comments') }}</h3>

                <div class="box-tools">
                    <div class="pull-right">
                        <a id="delete-item" class="btn btn-danger comments">{{ trans('syntara::all.delete') }}</a>
                    </div>
                </div>
            </div>
            <div class="box-body ajax-content no-padding">
                @include('admin.blog.comments.list')
            </div>
        </div>
    </div>

</div>
@stop