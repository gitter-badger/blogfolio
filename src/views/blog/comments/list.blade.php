<table class="table table-hover">
<thead>
    <tr>
        <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all"></th>
        <th class="col-lg-1" style="text-align: center;">#</th>
        <th class="col-lg-2" style="text-align: center;">{{ trans('blogfolio::blog.author') }}</th>
        <th class="col-lg-8" style="text-align: center;">{{ trans('blogfolio::blog.comment') }}</th>
        <th class="col-lg-8" style="text-align: center;">{{ trans('blogfolio::blog.status') }}</th>
    </tr>
</thead>
<tbody>
    @foreach ($comments as $comment)

    <tr onclick="document.location='{{ URL::route('showComment', $comment['id'])}}'">
        <td style="text-align: center;" class="span1">
            <input type="checkbox" data-comment-id="{{ $comment['id'] }}">
        </td>
        <td style="text-align: center;" class="col-lg-1">{{ $comment['id'] }}</td>
	    <td class="col-lg-2">{{ $comment['commenter'] }}</td>
        <td class="col-lg-8">{{ str_limit($comment['comment'], 60, '...') }}</td>
	    <td class="col-lg-8">{{ ($comment['approved'] == 1) ? trans('blogfolio::all.active') : trans('blogfolio::al.inactive') }}</td>
    </tr>
    @endforeach
</tbody>
</table>