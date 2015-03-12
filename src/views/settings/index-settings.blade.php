@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('packages/ukadev/blogfolio/js/dashboard/settings.js') }}"></script>
<div class="row">
    <div class="col-lg-6">
        <section class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{ trans("blogfolio::breadcrumbs.Globalsettings") }}</h3>
            </div>
            <form class="form" id="update-settings-form" method="PUT" onsubmit="return false;">
            	<div class="box-body clearfix">
                    <div class="form-group">
                        <label for="siteUrl">{{ trans('blogfolio::settings.siteUrl') }}:</label>
                        <input type="text" class="form-control" id="siteUrl" name="site_url" value='{{$settings['site_url']}}'>
                    </div>
                    <div class="form-group">
                        <label for="siteName">{{ trans('blogfolio::settings.siteName') }}:</label>
                        <input type="text" class="form-control" id="siteName" name="site_name" value='{{$settings['site_name']}}'>
                    </div>
                    <div class="form-group">
                        <label for="siteEmail">{{ trans('blogfolio::settings.siteEmail') }}:</label>
                        <input type="email" class="form-control" id="siteEmail" name="site_email" value='{{$settings['site_email']}}'>
                    </div>
                    <div class="form-group">
                        <label for="siteDefaultLang">{{ trans('blogfolio::settings.siteLang') }}:</label>
                        <select class="form-control" id="siteDefaultLang" name="site_default_lang">
                            @foreach ($langs as $lang)
                            	@if ($lang['locale'] == $settings['site_default_lang'])
                            		<option value='{{$lang['locale']}}' selected>{{$lang['name']}}
                            	@else
                            		<option value='{{$lang['locale']}}'>{{$lang['name']}}
                            	@endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="siteAdminLang">{{ trans('blogfolio::settings.siteAdminLang') }}:</label>
                        <select class="form-control" id="siteAdminLang" name="site_admin_lang">
                            @foreach ($langs as $lang)
                            	@if ($lang['locale'] == $settings['site_admin_lang'])
                            		<option value='{{$lang['locale']}}' selected>{{$lang['name']}}
                            	@else
                            		<option value='{{$lang['locale']}}'>{{$lang['name']}}
                            	@endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="siteOffline">{{ trans('blogfolio::settings.siteOffline') }}</label>
                            <input type="checkbox" class="form-control" id="siteOffline" name="site_offline" value='{{$settings['site_offline']}}'>
                    </div>
                    <div class="box-footer">
                   		<button id="update-settings" class="btn btn-primary">{{ trans('syntara::all.update') }}</button>
                   	</div>
            	</div>
            </form>
        </section>
    </div>
</div>
@stop