@include('admin.layouts.head')
{{--@include('admin.layouts.nav-bar')--}}

@include('admin.layouts.nav-bar', ['menu_elements' => 'TablesController@getMenu'])

<h1>Hello</h1>
