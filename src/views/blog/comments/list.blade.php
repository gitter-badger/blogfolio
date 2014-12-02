<table class="table table-hover">
<thead>
    <tr>
        <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all"></th>
        <th class="col-lg-1" style="text-align: center;">#</th>
        <th class="col-lg-1" style="text-align: center;">{{ trans('Author') }}</th>
        <th class="col-lg-1" style="text-align: center;">{{ trans('Comment') }}</th>
    </tr>
</thead>
<tbody>
    @foreach ($comments as $comment)

    <tr onclick="document.location='{{ URL::route('showComment', $comment['id'])}}'">
        <td style="text-align: center;" class="span2">
            <input type="checkbox" data-comment-id="{{ $comment['id'] }}">
        </td>
        <td style="text-align: center;" class="col-lg-1">{{ $comment['id'] }}</td>
	    <td class="col-lg-2">{{ $comment['commenter'] }}</td>
	    <td class="col-lg-7">{{ str_limit($comment['comment'], 60, '...') }}</td>
    </tr>
    @endforeach
</tbody>
</table>