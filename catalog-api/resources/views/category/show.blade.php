@include('layouts.app')

    @foreach($categores as $category)
        {{$category->name}}
    @endforeach
