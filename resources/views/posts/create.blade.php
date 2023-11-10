<x-layout>
  <a href="/" class="btn btn-sm btn-primary mb-5" role="button">
    Back</a>
  <div class="hero">
    <div class="card flex-shrink-0 w-full max-w-lg shadow-2xl bg-base-100">
      <form class="card-body" action="/post" method="post">
        @csrf
        <div class="form-control">
          <p
            class="font-noto underline underline-offset-4 decoration-indigo-500 text-center text-xl mb-4 tracking-wide">
            Create Post Form</p>
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Title</span>
          </label>
          <input type="text" name="title" placeholder="title" class="input input-bordered text-sm h-10" required />
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Description</span>
          </label>
          <textarea type="text" name="description" placeholder="your description ..."
            class="textarea textarea-bordered textarea-md w-full h-24 text-sm"></textarea>
        </div>
        <div class="form-control mt-6">
          <button class="btn btn-sm h-10 btn-primary capitalize">Create Post</button>
        </div>
      </form>
    </div>
  </div>
</x-layout>