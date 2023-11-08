<x-layout>
  <a href="/" class="btn btn-sm btn-primary mb-5" role="button">
    Back</a>
  <div class="hero mt-5">
    <div class="w-[80%] lg:w-[60%] flex flex-col lg:flex-row bg-base-100 rounded-md p-10">
      <div class="w-full lg:w-[50%] text-left">
        <div class="flex">
          <div class="avatar mr-5">
            <div class="w-12 rounded-full ring ring-accent ring-offset-base-100 ring-offset-2">
              <img src={{$post->user->image ? asset('/storage/posts/'. $post->user->image) :
              asset('/images/default-avatar.jpg')}} />
            </div>
          </div>
          <div>
            <p class="font-semibold">{{$post->user->name}}</p>
            <p class="text-xs text-slate-500">{{($post->created_at)->format('F j, Y')}}</p>
          </div>
        </div>
        <p class="text-xl lg:text-3xl font-bold mt-5">{{$post->title}}</p>
      </div>
      <div class="w-full lg:w-[50%] mt-4">
        <p class="text-gray-500 text-[0.85rem] leading-6 tracking-wide">{{$post->description}}</p>
        <div class="text-end mt-6">
          @if (auth()->id() != $post->user_id)
          <a class="btn btn-sm btn-primary capitalize" onclick="permission_modal.showModal();">Edit</a>
          <a class="btn btn-sm btn-error capitalize" onclick="permission_modal.showModal()">Delete</a>
          @else
          <a class="btn btn-sm btn-primary capitalize" href="/posts/{{$post->id}}/edit">Edit</a>
          <a class="btn btn-sm btn-error capitalize" onclick="delete_post.showModal()">Delete</a>
          @endif
        </div>
      </div>
    </div>
  </div>

  {{-- Edit Permission Modal --}}
  <dialog id="permission_modal" class="modal">
    <div class="modal-box">
      <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
      </form>
      <h3 class="font-bold text-lg">Edit Permission Denied!</h3>
      <p class="py-4 text-sm">We're sorry, but you do not have the authorization to edit or delete this post. Only the
        author of
        this post
        can make changes.</p>
    </div>
  </dialog>

  {{-- Delete Post Modal --}}
  <dialog id="delete_post" class="modal">
    <div class="modal-box">

      <div class="card-body items-center text-center">
        <h2 class="card-title">Delete Post!</h2>
        <p class="my-3 text-sm">Are you sure you want to delete this post?</p>
        <div class="card-actions justify-end">
          <form action="/posts/{{$post->id}}/delete" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm h-10 btn-primary" type="submit">Accept</button>
          </form>
          <form method="dialog">
            <button class="btn btn-sm h-10 btn-ghost">Deny</button>
          </form>
        </div>
      </div>

    </div>
    </div>
  </dialog>
</x-layout>