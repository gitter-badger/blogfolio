<table class="table table-hover">
<thead>
    <tr>
        <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all"></th>
        <th class="col-lg-1" style="text-align: center;">#</th>
        @foreach ($langs as $key => $lang)
        	@if ($lang->id == Settings::get('site_default_lang'))
        		<th class="col-lg-2 center">{{ trans('syntara::all.name') }}</th>
        	@endif
        @endforeach
    </tr>
</thead>
<tbody>
    @foreach ($cats as $cat)
    <tr onclick="document.location='{{ URL::route('showCategory', $cat['id'])}}'">
        <td style="text-align: center;">
            <input type="checkbox" data-category-id="{{ $cat['id'] }}">
        </td>
        <td style="text-align: center;">{{ $cat['id'] }}</td>
        @foreach ($cat->catData as $key =>$name)
        	@if ($name->lang_id == Settings::get('site_default_lang'))
        		<td>{{ $name->name }}</td>
        	@endif
        @endforeach
    </tr>
    @endforeach
</tbody>
</table>
