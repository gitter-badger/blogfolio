<table class="table table-hover">
<thead>
    <tr>
        <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all"></th>
        <th class="col-lg-1" style="text-align: center;">#</th>
        <th class="col-lg-2 center">{{ trans('Language') }}</th>
		<th class="col-lg-2 center">{{ trans('Locale') }}</th>
    </tr>
</thead>
<tbody>
    @foreach ($languages as $language)
    <tr onclick="document.location='{{ URL::route('showLanguage', $language->id)}}'">
        <td style="text-align: center;" class="row1">
            <input type="checkbox" data-language-id="{{ $language->id }}">
        </td>
        <td style="text-align: center;">{{ $language->id }}</td>
        <td>{{ $language->name }}</td>
	    <td>{{ $language->locale }}</td>
    </tr>
    @endforeach
</tbody>
</table>
