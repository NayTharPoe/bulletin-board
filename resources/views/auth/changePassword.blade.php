<x-layout>
  <a href="/" class="btn btn-sm btn-primary mb-5" role="button">
    Back</a>
  <div class="w-[100%] flex flex-col lg:flex-row justify-center items-center space-y-10 p-2">
    <div class="card w-full lg:w-[40%] shadow-2xl bg-base-100">
      <form class="card-body" action="/update-password" method="post">
        @csrf
        <div class="form-control">
          <label class="label">
            <span class="label-text">Old Password</span>
          </label>
          <input type="password" name="old_password" class="input input-sm input-bordered text-sm"
            value="{{old('old_password')}}" required />

          @error('old_password')
          <p class="text-sm text-red-600">{{$message}}</p>
          @enderror
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">New Password</span>
          </label>
          <input type="password" name="new_password" class="input input-sm input-bordered text-sm"
            value="{{old('new_password')}}" required />

          @error('new_password')
          <p class="text-sm text-red-600">{{$message}}</p>
          @enderror
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Confirm New Password</span>
          </label>
          <input type="password" name="new_password_confirmation" class="input input-sm input-bordered text-sm"
            value="{{old('new_password_confirmation')}}" required />

          @error('new_password_confirmation')
          <p class="text-sm text-red-600">{{$message}}</p>
          @enderror
        </div>
        <div class="form-control mt-4">
          <button class="btn btn-sm h-10 btn-primary capitalize">Change Password</button>
        </div>
      </form>
    </div>
  </div>
</x-layout>