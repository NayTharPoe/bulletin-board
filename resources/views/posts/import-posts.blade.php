<x-layout>
  <a href="/" class="btn btn-sm btn-primary mb-5" role="button">
    Back</a>
  <div class="hero">
    <div class="card flex-shrink-0 w-full max-w-lg shadow-2xl bg-base-100">
      <form id="import_excel" class="card-body" action="{{ route('posts.import.post') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <h3 class=" text-md">Import your excel sheet file here!</h3>
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