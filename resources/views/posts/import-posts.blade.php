<x-layout>
  <a href="/" class="btn btn-sm btn-primary mb-5" role="button">
    Back</a>
  <div class="hero">
    <div class="card flex-shrink-0 w-full max-w-xl shadow-2xl bg-base-100 p-4">
      <form id="import_excel" class="card-body" action="{{ route('posts.import.post') }}" method="post"
        enctype="multipart/form-data">
        @csrf

        <h3 class="font-semibold text-xl">Import Data !</h3>
        <div>
          <span class="text-sm">Ensure successful data import by following this CSV format</span>
          <div class="dropdown dropdown-bottom dropdown-right">
            <label tabindex="0" class="btn btn-circle btn-ghost btn-xs text-info">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-4 h-4 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </label>
            <div tabindex="0" class="card compact dropdown-content z-[1] shadow rounded-box w-max-content btn-neutral p-4">
              <ul class="list-disc pl-5 mb-4 text-[12.8px] leading-6">
                <li><strong>Title:</strong> Column header for the post title</li>
                <li><strong>Description:</strong> Column header for the post description</li>
                <li><strong>Show on list:</strong> Column header for post visibility (Use <span
                    class="underline underline-offset-1 decoration-indigo-500">1 for active</span> and <span
                    class="underline underline-offset-1 decoration-indigo-500">0 for
                    inactive</span>)
                </li>
              </ul>
              <pre class="p-4 rounded-md text-[13.5px] bg-white text-neutral"><code>Title,Description,Show on list
Example Title 1,Description for Example 1,1
Example Title 2,Description for Example 2,0</code></pre>
            </div>
          </div>

        </div>


        <div class="flex items-center space-x-4 mt-3">
          <input type="file" name="excel-file" class="file-input file-input-bordered file-input-sm w-full max-w-xs" />

          <button class="btn btn-sm capitalize" type="submit" form="import_excel">Import</button>
        </div>
        @error('excel-file')
        <p class="text-red-600 text-xs mt-2">{{$message}}</p>
        @enderror
      </form>
    </div>
  </div>
</x-layout>