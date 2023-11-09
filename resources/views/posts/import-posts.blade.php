<x-layout>
  <a href="/" class="btn btn-sm btn-primary mb-5" role="button">
    Back</a>
  <div class="hero">
    <div class="card flex-shrink-0 w-full max-w-xl shadow-2xl bg-base-100">
      <form id="import_excel" class="card-body" action="{{ route('posts.import.post') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <h3 class="text-lg font-semibold mb-2">Import Data from Excel !</h3>
        <p class="text-sm mb-5">To successfully import your data, ensure your Excel file follows this format:</p>

        <p class="text-sm mb-2"><strong>CSV Format:</strong></p>
        <ul class="list-disc pl-5 mb-5 text-sm">
          <li><strong>Title:</strong> Column header for the post title</li>
          <li><strong>Description:</strong> Column header for the post description</li>
          <li><strong>Show_on_list:</strong> Column header for post visibility (Use 1 for active and 0 for inactive)
          </li>
        </ul>

        <p class="text-sm mb-5">For example, your CSV file should look like this:</p>
        <pre class="bg-base-200 p-4 rounded-md text-sm"><code>Title,Description,Show_on_list
Example Title 1,This is the description for Example 1,1
Example Title 2,Description for Example 2,0</code></pre>

        <p class="text-sm mb-5">Make sure to match the column headers exactly, and use <span class="underline underline-offset-4 decoration-indigo-500">1 for active</span> and <span class="underline underline-offset-4 decoration-indigo-500">0 for inactive</span>
          in the 'Show_on_list' column.</p>

        <p class="text-sm">After selecting your file, click the "Import" button to proceed.</p>

        <div class="flex items-center space-x-4 mt-4">
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