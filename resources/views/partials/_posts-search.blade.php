@props(['status' => ''])
<form action="/{{ $status }}" method="get">
  <div class="w-full flex items-center space-x-4">
    <div class="form-control grow">
      <input type="text" placeholder="Search title, description ..." name="search"
        class="input input-sm py-5 focus:outline-0" />
    </div>
    <div class="grow-0">
      <button class="btn btn-sm h-10 btn-primary" type="submit">
        <span>Search</span>
      </button>
    </div>
  </div>
</form>