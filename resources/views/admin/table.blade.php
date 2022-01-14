@include('admin.layouts.head')
@include('admin.layouts.nav-bar')

<h1>{{$table_info->table_text}} Administration</h1>

<a href="/admin/create/{{request()->id}}" type="button" class="btn btn-primary">Add {{$table_info->table_text}}</a>

@if(session()->has('message'))
    @if(session('type') == 1)
        <script>swal("SUCCESS!", "{{session('message')}}", "success");</script>
    @endif
    @if(session('type') == 2)
        <script>swal("FAIL!", "{{session('message')}}", "error");</script>
    @endif
    {{Session::forget('message')}}
    {{Session::forget('type')}}
@endif()

<table class="table">
    <thead>
    <tr>
        @foreach($table_columns as $table_column)
            <th scope="col">{{$table_column}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>

    @foreach($table_objects as $table_object)
        <tr>
        @foreach($table_columns as $table_column)
                <td> {{ Str::limit($table_object->$table_column, 90) }}</td>
        @endforeach
        </tr>
    @endforeach


    </tbody>
</table>
