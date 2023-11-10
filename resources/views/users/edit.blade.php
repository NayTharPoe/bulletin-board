<x-layout>
  <a href="{{!auth()->user()->is_admin ? '/' : '/users'}}" class="btn btn-sm btn-primary mb-5" role="button">
    Back</a>
  <div class="min-h-screen">
    <div class="hero">
      <div class="card flex-shrink-0 w-full max-w-lg shadow-2xl bg-base-100">
        <form id="updateUserForm" class="card-body" action="/users/{{$user->id}}/update" method="post"
          enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-control">
            <p
              class="font-noto underline underline-offset-4 decoration-indigo-500 text-center text-xl mb-4 tracking-wide">
              Edit User Form</p>
          </div>

          <div class="form-control">
            <label class="label">
              <span class="label-text">Name</span>
            </label>
            <input type="text" name="name" class="input input-bordered text-sm h-10" value="{{$user->name}}" />

            @error('name')
            <p class="text-red-600">{{$message}}</p>
            @enderror
          </div>

          <div class="form-control">
            <label class="label">
              <span class="label-text">Email</span>
            </label>
            <input type="email" name="email" class="input input-bordered text-sm h-10" value="{{$user->email}}" />

            @error('email')
            <p class="text-red-600">{{$message}}</p>
            @enderror
          </div>

          <div class="form-control">
            <label class="label">
              <span class="label-text">Phone</span>
            </label>
            <input type="text" name="phone" class="input input-bordered text-sm h-10" value="{{$user->phone}}" />

            @error('phone')
            <p class="text-red-600">{{$message}}</p>
            @enderror
          </div>

          <div class="form-control">
            <label class="label">
              <span class="label-text">Date of Birth</span>
            </label>
            <input type="date" name="dob" class="input input-bordered text-sm h-10" value="{{$user->dob}}" />

            @error('dob')
            <p class="text-red-600">{{$message}}</p>
            @enderror
          </div>

          @if (auth()->user()->is_admin == 1)
          <div class="form-control">
            <label class="label">
              <span class="label-text">Role</span>
            </label>
            <select name="is_admin" class="select select-bordered text-sm select-sm h-10">
              <option value="admin" @if($user->is_admin) selected @endif>Admin</option>
              <option value="user" @unless($user->is_admin) selected @endunless>User</option>
            </select>
          </div>
          @else
          <input type="text" name="is_admin" class="hidden" value="{{$user->is_admin}}">
          @endif

          <div class="form-control">
            <label class="label">
              <span class="label-text">Address</span>
            </label>
            <textarea type="text" name="address"
              class="textarea textarea-bordered textarea-md w-full h-24 text-sm">{{$user->address}}</textarea>

            @error('address')
            <p class="text-red-600">{{$message}}</p>
            @enderror
          </div>

          <div class="form-control">
            <label class="label">
              <span><label class="label-text">Profile</span>
            </label>
            <input type="file" name="image" id="image" class="edit-profile-image" data-max-files="1">

            @if ($user->image)
            {{-- hidden image data for passing props to js file --}}
            <div id="user-image-data" data-image="{{ $user->image }}" class="hidden"></div>

            <div class="avatar relative border border-gray-300 rounded-xl" id="preview-profile-image">
              <a class="btn btn-sm btn-circle absolute right-0 top-0 m-4" onclick="delete_profile_image.showModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </a>
              <div class="w-full h-72 bg-contain bg-no-repeat bg-center rounded-xl"
                style="background-image: url('{{asset('storage/posts/'. $user->image)}}')">
              </div>
            </div>
            @endif

            <button class="btn btn-sm h-10 btn-primary capitalize mt-6" type="submit"
              form="updateUserForm">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  {{-- Delete Existing Profile Image Modal --}}
  <dialog id="delete_profile_image" class="modal">
    <div class="modal-box">

      <div class="card-body items-center text-center">
        <h2 class="card-title">Remove Profile Image!</h2>
        <p class="my-3 text-sm">This profile image will be permanently deleted?</p>
        <div class="card-actions justify-end">
          <form id="updateImgForm" action="/users/{{$user->id}}/clear-profile-image" method="POST">
            @csrf
            <button class="btn btn-sm h-10 btn-primary" type="submit" form="updateImgForm"
              id="clear-profile-image-btn">Accept</button>
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