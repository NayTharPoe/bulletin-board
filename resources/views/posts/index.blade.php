<x-layout>
  <div class="flex flex-col sm:flex-row sm:justify-between mb-12 gap-4">
    <div class="w-full md:w-[40%]">
      @include('partials._posts-search')
    </div>
    <div class="w-full md:w-[50%] flex gap-3 sm:justify-end">
      @include('partials._export')
      @include('partials._import')
    </div>
  </div>
  <div class="flex justify-center gap-10 flex-wrap">
    @forelse($posts->where('show_on_list', 1) as $post)
    <x-post-card :post="$post" />
    @empty
    <p>There is no posts</p>
    @endforelse
  </div>
  @if (count($posts) > 0)
  <div class="flex flex-col gap-3 lg:flex-row justify-between items-center mt-12">
    <div>
      <form method="get">
        <label for="page-size" class="text-[0.9rem] mr-2">Page Size : </label>
        <select name="page-size" id="page-size" onchange="this.form.submit()" class="select select-sm">
          <option value="6" @if(request('page-size')==6) selected @endif>6</option>
          <option value="12" @if(request('page-size')==12) selected @endif>12</option>
          <option value="24" @if(request('page-size')==24) selected @endif>24</option>
        </select>

        <input type="hidden" name="page" value="{{ $posts->currentPage() }}">
      </form>
    </div>
    <div>{{$posts->appends(['page-size' => request('page-size')])->links()}}</div>
  </div>
  @endif
</x-layout>