@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('packages/ukadev/blogfolio/js/dashboard/languages.js') }}"></script>
<div class="row">
    <div class="col-lg-12">
        <section class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ trans("blogfolio::navigation.language") }}</h3>
            </div>
            <form class="form" id="create-language-form" method="post">
                <div class="box-body clearfix">
                    <div class="form-group">
                        <label for="name">{{ trans('Name') }}:</label>
                        <input type="text" class="form-control" id="name" name="name" value=''>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ trans('Locale') }}:</label>
                        <input type="text" class="form-control" id="locale" name="locale" value=''>
                    </div>
                    <div class="form-group">
                        {{ Form::label('status', trans('Active?')) }}
                        {{ Form::checkbox('status', 1, true) }}
                    </div>
                    <div class="box-footer">
                        <button id="create-language" class="btn btn-primary">{{ trans('syntara::all.update') }}</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@stop