@extends('layouts.main')

@section('content')
<article class="container mx-auto px-4 py-12 max-w-4xl">
    <h1 class="text-4xl font-bold mb-4 text-gray-800">{{ $page->title }}</h1>
    
    <div class="prose prose-lg max-w-none">
        {!! $page->content !!}
    </div>
</article>
@endsection