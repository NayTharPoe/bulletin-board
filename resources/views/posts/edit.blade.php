<x-layout>
  <div class="hero">
    <div class="card flex-shrink-0 w-full max-w-lg shadow-2xl bg-base-100">
      <form class="card-body" action="/posts/{{$post->id}}/update" method="POST">
        @csrf
        @method('PUT')
        <div class="form-control">
          <p
            class="font-noto underline underline-offset-4 decoration-indigo-500 text-center text-xl mb-4 tracking-wide">
            Edit Post Form</p>
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Title</span>
          </label>
          <input type="text" name="title" class="input input-bordered text-sm h-10" value="{{$post->title}}" required />

          @error('title')
          <p class="text-red-600 text-sm">{{$message}}</p>
          @enderror
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Description</span>
          </label>
          <textarea type="text" name="description"
            class="textarea textarea-bordered textarea-md w-full h-24 text-sm">{{$post->description}}</textarea>

          @error('description')
          <p class="text-red-600 text-sm">{{$message}}</p>
          @enderror
        </div>
        <div class="form-control max-w-full">
          <label class="cursor-pointer label">
            <span class="label-text">Status</span>
            <input type="checkbox" name="show_on_list" class="toggle toggle-primary" @php if($post->show_on_list
            == 1) {
            echo 'checked';
            }
            @endphp />

            @error('show_on_list')
            <p class="text-red-600 text-sm">{{$message}}</p>
            @enderror
          </label>
        </div>
        <div class="form-control mt-6">
          <button class="btn btn-sm h-10 btn-primary capitalize" type="submit">Update Post</button>
        </div>
      </form>
    </div>
  </div>
</x-layout>