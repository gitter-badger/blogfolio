<table class="table table-hover">
<thead>
    <tr>
        <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all"></th>
        <th class="col-lg-1" style="text-align: center;">#</th>
		<th class="col-lg-2 center">{{ trans('blogfolio::portfolio.project') }}</th>
    </tr>
</thead>
<tbody>
    @foreach ($projects as $project)
    <tr>
        <td style="text-align: center;" class="row1">
            <input type="checkbox" data-project-id="{{ $project->id }}">
        </td>
        <td style="text-align: center;" onclick="document.location='{{ URL::route('showProject', $project->id)}}'">{{ $project->id }}</td>
	    <td onclick="document.location='{{ URL::route('showProject', $project->id)}}'">{{ $project->name }}</td>
    </tr>
    @endforeach
</tbody>
</table>
