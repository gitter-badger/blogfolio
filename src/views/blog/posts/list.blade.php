<table class="table table-hover">
<thead>
    <tr>
        <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all"></th>
        <th class="col-lg-1" style="text-align: center;">#</th>
        @foreach ($langs as $key => $lang)
        	@if ($lang->id == Settings::get('site_default_lang'))
        		<th class="col-lg-2 center">{{ trans('Title') }}</th>
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
				@if ($data->lang_id == Settings::get('site_default_lang'))
	       			<td>{{ str_limit($data->title, 100, '...') }}</td>
	       		@endif
	       	@endforeach
    </tr>
    @endforeach
</tbody>
</table>
