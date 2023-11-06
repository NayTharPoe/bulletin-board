<x-layout>
  @include('partials._back-btn', ['route'])
  <div class="w-[100%] flex flex-col justify-center items-center space-y-10 p-2">
    <div class="card w-full lg:w-[50%] h-96 sm:card-side bg-base-100 shadow-xl">
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
        <div class="text-[0.84rem] font-noto text-gray-600 space-y-2 tracking-wide leading-6 mt-2">
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

    <div class="card w-full lg:w-[50%] shadow-2xl bg-base-100">
      <form class="card-body" action="/update-password" method="post">
        @csrf
        <div class="form-control">
          <label class="label">
            <span class="label-text">Old Password</span>
          </label>
          <input type="password" name="old_password" placeholder="Old Password" class="input input-bordered text-sm" value="{{old('old_password')}}"
            required />

          @error('old_password')
          <p class="text-sm text-red-600">{{$message}}</p>
          @enderror
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">New Password</span>
          </label>
          <input type="password" name="new_password" placeholder="New Password" class="input input-bordered text-sm" value="{{old('new_password')}}"
            required />

          @error('new_password')
          <p class="text-sm text-red-600">{{$message}}</p>
          @enderror
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Confirm New Password</span>
          </label>
          <input type="password" name="new_password_confirmation" placeholder="Confirm New Password"
            class="input input-bordered text-sm" value="{{old('new_password_confirmation')}}" required />

          @error('new_password_confirmation')
          <p class="text-sm text-red-600">{{$message}}</p>
          @enderror
        </div>
        <div class="form-control mt-6">
          <button class="btn btn-primary capitalize">Change Password</button>
        </div>
      </form>
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