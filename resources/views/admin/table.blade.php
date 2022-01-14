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
        <th>ID</th>
    @foreach($table_columns as $table_column)
            <th scope="col">{{$table_column->label}}</th>
        @endforeach
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($table_objects as $table_object)
        <tr>
            <th>
                {{$table_object->id}}
            </th>
        @foreach($table_columns as $table_column)
                @php ($column_title = $table_column->column_title )
                <td> {{ Str::limit($table_object->$column_title, 90) }}</td>
        @endforeach
            <th>
                <i class="fa fa-pencil" style="font-size:24px; padding:3px"></i>
                <i class="delete_element fa fa-trash" id="{{$table_object->id}}" style="font-size:24px; padding:3px"></i>
                @if($table_object->visible==1)
                <i class="fa fa-eye" style="font-size:24px; padding:3px"></i>
                @else
                <i class="fa fa-eye-slash" style="font-size:24px; padding:3px"></i>
                @endif
            </th>
        </tr>
    @endforeach

    </tbody>
</table>

<script>
    $(document).ready(function() {
        $(".delete_element").click(function(event) {
            element_id = (event.target.id);
            this_element = $(this);

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                }
            ).then(
                function (isConfirm) {
                    if (isConfirm) {

            $.ajax({
                url: '/admin/deleteElement',
                type: 'POST',
                _token: $('#signup-token').val(),
                data: {
                    "_token": "{{ csrf_token() }}",
                    "element_id": element_id,
                    "table_id": "{{request()->id}}"
                },
                success: function( result ) {
                    $(this_element).closest('tr').remove();
                    swal("Poof! Deleted!", {
                        icon: "success",
                    });
                }
            });
                        console.log('CONFIRMED');
                    }
                },
                function() {
                    console.log('BACK');
                }
            );
        });
    });
</script>
