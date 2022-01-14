@include('admin.layouts.head')
@include('admin.layouts.nav-bar')
<h1>Hello</h1>

<div class="container mt-3">
    <form method="post">
    @csrf
        @foreach($table_columns as $table_column)

            @if($table_column->type=='short_text')
                <div class="mb-3 mt-3">
                    <label for="{{$table_column->column_title}}">{{$table_column->column_title}}:</label>
                    <input {{ $table_column->required === 1 ? "required" : "" }} {{ $table_column->size > 0 ? "maxlength=$table_column->size" : "" }} type="text" class="form-control" id="{{$table_column->column_title}}" placeholder="{{$table_column->column_title}}" name="{{$table_column->column_title}}">
                </div>
                @if($table_column->ckeditor==1)
                    <script>
                        CKEDITOR.replace( '{{$table_column->column_title}}' );
                    </script>
                @endif
            @endif

            @if($table_column->type=='long_text')
                <div class="mb-3 mt-3">
                    <label for="{{$table_column->column_title}}">{{$table_column->column_title}}</label>
                    <textarea name="{{$table_column->column_title}}" {{ $table_column->required === 1 ? "required" : "" }} id="{{$table_column->column_title}}" class="form-control" name="story" rows="5" cols="33"></textarea>
                </div>

                @if($table_column->ckeditor==1)
                        <script>
                            CKEDITOR.replace( '{{$table_column->column_title}}' );
                        </script>
                @endif

            @endif

            @if($table_column->type=='number')
                <div class="mb-3 mt-3">
                    <label for="{{$table_column->column_title}}">{{$table_column->column_title}}:</label>
                    <input {{ $table_column->required === 1 ? "required" : "" }} type="number" class="form-control" id="{{$table_column->column_title}}" placeholder="{{$table_column->column_title}}" name="{{$table_column->column_title}}">
                </div>
            @endif

        @endforeach
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
