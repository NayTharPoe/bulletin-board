<x-layout>
  <div class="flex flex-col sm:flex-row sm:justify-between mb-12 gap-4">
    <div class="w-full md:w-[40%]">
      @include('partials._posts-search', ['status' => 'posts/manage'])
    </div>
    <div class="w-full md:w-[50%] flex gap-3 sm:justify-end">
      @include('partials._export')
      @include('partials._import')
    </div>
  </div>
  <div class="flex justify-center gap-10 flex-wrap">
    @unless (count($posts) == 0)
    @foreach ($posts as $post)
    <x-post-card :post="$post" />
    @endforeach
    @else
    <p>There is no posts</p>
    @endunless
  </div>
  <div class="mt-6 py-4">{{$posts->links()}}</div>
</x-layout>