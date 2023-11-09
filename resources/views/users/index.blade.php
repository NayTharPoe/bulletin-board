<x-layout>
  <div class="flex mb-12">
    <div class="w-full md:w-[40%]">
      @include('partials._users-search')
    </div>
  </div>
  <div class="overflow-x-auto bg-base-100 rounded-lg mx-5">
    <x-user-table :users="$users" />
  </div>
  <div class="mt-6 py-4">{{$users->links()}}</div>
</x-layout>