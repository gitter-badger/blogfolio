<table class="table table-hover">
<thead>
    <tr>
        <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all"></th>
        <th class="col-lg-1" style="text-align: center;">#</th>
		<th class="col-lg-2 center">{{ trans('Portfolio') }}</th>
		<th class="col-lg-2 center">{{ trans('Status') }}</th>
    </tr>
</thead>
<tbody>
    @foreach ($portfolios as $portfolio)
    <tr onclick="document.location='{{ URL::route('showPortfolio', $portfolio->id)}}'">
        <td style="text-align: center;" class="row1">
            <input type="checkbox" data-post-id="{{ $portfolio->id }}">
        </td>
        <td style="text-align: center;">{{ $portfolio->id }}</td>
	    <td>{{ str_limit($portfolio->name, 100, '...') }}</td>
	    <td>{{$portfolio->status}}</td>
    </tr>
    @endforeach
</tbody>
</table>
