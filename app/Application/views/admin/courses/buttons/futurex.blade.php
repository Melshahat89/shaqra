<!-- Duplicated courses with there included courses -->
@if(\Illuminate\Support\Facades\Auth::user()->group_id == 1)
        <a href="{{ url('/lazyadmin/futurex/'.$id) }}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
            Edit
        </a>
    @if ($futurexid)
        {{$futurexid}}  --  <a href="{{ url('/lazyadmin/futurex/'.$id) }}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
            Edit
        </a>
        <br>
        <a href="{{ 'https://futurex.nelc.gov.sa/ar/course/'.$futurexcourseid }}" class="btn btn-black btn-circle waves-effect waves-circle waves-float">
            Link
        </a>

    @else
        <a href="{{ url('/lazyadmin/futurex/'.$id) }}" class="btn btn-success btn-circle waves-effect waves-circle waves-float">
            + Create Futurex
        </a>
    @endif
@endif
