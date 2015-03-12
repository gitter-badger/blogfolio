<table class="table table-hover">
<thead>
    <tr>
        <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all"></th>
        <th class="col-lg-1" style="text-align: center;">#</th>
        @foreach ($langs as $key => $lang)
        	@if ($lang->locale == Settings::get('site_admin_lang'))
        		<th class="col-lg-2 center">{{ trans('blogfolio::all.title') }}</th>
        	@endif
        @endforeach
    </tr>
</thead>
<tbody>
    @foreach ($posts as $post)
    <tr onclick="document.location='{{ URL::route('showPost', $post['id'])}}'">
        <td style="text-align: center;" class="row1">
            <input type="checkbox" data-post-id="{{ $post['id'] }}">
        </td>
        <td style="text-align: center;">{{ $post['id'] }}</td>
	       	@foreach($post->postData as $data)
				@if ($data->lang == Settings::get('site_admin_lang'))
	       			<td>{{ str_limit($data->title, 100, '...') }}</td>
	       		@endif
	       	@endforeach
    </tr>
    @endforeach
</tbody>
</table>
