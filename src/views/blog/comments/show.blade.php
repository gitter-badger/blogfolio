@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('packages/ukadev/blogfolio/js/dashboard/comments.js') }}"></script>
<div class="row">
    <div class="col-lg-12">
        <section class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ trans("blogfolio::navigation.comments") }}</h3>
            </div>
            <form class="form" id="edit-comment-form" method="PUT" onsubmit="return false;">
            	<div class="box-body clearfix">
            		<div class="form-group">
	                        <label for="comment">{{ trans('blogfolio::blog.comment') }}
	                        :</label>
	                        <textarea class="form-control" id="comment" name="comment">{{$comment['comment']}}</textarea>
	                    </div>
                    <div class="form-group">
                       	 {{ trans('blogfolio::blog.approved') }} {{ Form::checkbox('approved', 1, $comment['approved']) }}
                    </div>
                    <div class="box-footer">
                   		<button id="update-comment" class="btn btn-primary">{{ trans('syntara::all.update') }}</button>
                   	</div>
            	</div>
            </form>
        </section>
    </div>
</div>
@stop