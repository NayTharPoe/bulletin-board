<x-layout>
  <div class="flex mb-12">
    <div class="w-full md:w-[40%]">
      @include('partials._users-search')
    </div>
  </div>
  <div class="overflow-x-auto bg-base-100 rounded-lg mx-5">
    <x-user-table :users="$users" />
  </div>
  <div class="flex flex-col gap-3 lg:flex-row justify-between items-center mt-12">
    <div>
      <form action="/users" method="get">
        <label for="page-size" class="text-[0.9rem] mr-2">Page Size : </label>
        <select name="page-size" id="page-size" onchange="this.form.submit()" class="select select-sm">
          <option value="6" @if(request('page-size')==6) selected @endif>6</option>
          <option value="12" @if(request('page-size')==12) selected @endif>12</option>
          <option value="24" @if(request('page-size')==24) selected @endif>24</option>
        </select>

        <input type="hidden" name="page" value="{{ $users->currentPage() }}">
      </form>
    </div>
    <div>{{$users->appends(['page-size' => request('page-size')])->links()}}</div>
  </div>
</x-layout>