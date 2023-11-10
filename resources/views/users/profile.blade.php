<x-layout>
  <a href="/" class="btn btn-sm btn-primary mb-5" role="button">
    Back</a>
  <div class="w-[100%] flex flex-col lg:flex-row justify-center items-center space-y-10 p-2">
    <div class="card w-full lg:w-[50%] sm:card-side bg-base-100 shadow-xl">
      <div class="w-[50%] rounded-xl bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{$user->image ? asset('storage/posts/'. $user->image) : asset('/images/default-avatar.jpg')}}')">
      </div>
      <div class="card-body">
        <div class="avatar block sm:hidden">
          <div class="w-20 rounded-full bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{$user->image ? asset('storage/posts/'. $user->image) : asset('/images/default-avatar.jpg')}}')">
          </div>
        </div>
        <h2 class="card-title">
          {{$user->name}}
          <div class="badge badge-secondary">{{$user->is_admin == 1 ? "Admin" : "User"}}</div>
        </h2>
        <div class="text-[0.84rem] font-noto space-y-2 tracking-wide leading-6 my-3 mb-6">
          <p>Email - {{$user->email}}</p>
          <p>Phone - {{$user->phone ? $user->phone : ''}}</p>
          <p>Created at - {{$user->created_at}}</p>
          <p>Address - {{$user->address}}</p>
        </div>
        <div class="card-actions justify-end mt-auto">
          <a class="btn btn-sm btn-accent capitalize" href="/users/{{$user->id}}/edit">Edit</a>
          <a class="btn btn-sm btn-error capitalize" onclick="delete_user.showModal()">Delete</a>
        </div>
      </div>
    </div>
  </div>

  {{-- Delete User Modal --}}
  <dialog id="delete_user" class="modal">
    <div class="modal-box">

      <div class="card-body items-center text-center">
        <h2 class="card-title">Delete User!</h2>
        <p class="my-3 text-sm">Are you sure you want to delete this user?</p>
        <div class="card-actions justify-end">
          <form action="/users/{{$user->id}}/delete" method="POST">
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