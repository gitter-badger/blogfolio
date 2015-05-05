<table class="table table-hover">
<thead>
    <tr>
        <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all minimal"></th>
        <th class="col-lg-1" style="text-align: center;">#</th>
        <th class="col-lg-2 center">{{ trans('Language') }}</th>
        <th class="col-lg-2 center">{{ trans('Locale') }}</th>
		<th class="col-lg-2 center">{{ trans('Status') }}</th>
    </tr>
</thead>
<tbody>
    @foreach ($languages as $language)
    <tr>
        <td style="text-align: center;" class="row1">
            <input type="checkbox" class="minimal" data-language-id="{{ $language->id }}">
        </td>
        <td onclick="document.location='{{ URL::route('showLanguage', $language->id)}}'" style="text-align: center;">{{ $language->id }}</td>
        <td onclick="document.location='{{ URL::route('showLanguage', $language->id)}}'">{{ $language->name }}</td>
        <td onclick="document.location='{{ URL::route('showLanguage', $language->id)}}'">{{ $language->locale }}</td>
	    <td onclick="document.location='{{ URL::route('showLanguage', $language->id)}}'">{{ ($language->status == 1) ? trans('Active') : trans('Inactive') }}</td>
    </tr>
    @endforeach
</tbody>
</table>
