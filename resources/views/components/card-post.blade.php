{{-- recibimos la variable post con la directiva @props --}}
@props(['post'])

<article class="mb-8 bg-white shadow-lg rounded-lg overflow-hidden">
    @if ($post->image)
        <img class="w-full h-72 object-cover object-center" src="{{ Storage::url($post->image->url) }}">
    @else
        <img class="w-full h-72 object-cover object-center" src="https://cdn.pixabay.com/photo/2022/11/14/20/14/compass-7592447_960_720.jpg">
    @endif
    <div class="px-6 py-4">
        <h1 class="font-bold text-xl mb-2">
            <a href="{{ route('post.show', $post) }}">{{ $post->name }}</a>
        </h1 class="text-gray-700 text-base">
        {{-- Para que laravel imprima el parrafo como codigo y no como texto --}}
        {{-- <div>{{ $post->extract }}</div> --}}
        <div>{!! $post->extract !!}</div>
    </div>
    <div class="px-6 pt-4 pb-2">
        @foreach ($post->tags as $tag)
            <a href="{{ route('post.tag', $tag) }}" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm text-gray-700 mr-2">{{ $tag->name }}</a>
        @endforeach
    </div>
</article>
