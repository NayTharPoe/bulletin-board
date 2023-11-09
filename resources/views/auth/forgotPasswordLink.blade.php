<x-layout>
  <div class="hero items-center bg-base-200">
    <div class="hero-content flex-col lg:flex-row-reverse gap-12">
      <div class="w-full md:w-[50%] text-center lg:text-left">
        <h1 class="text-2xl lg:text-5xl font-bold">Reset Password now!</h1>
        <p class="py-6">Welcome to the password reset page. We're here to assist you in enhancing the security of your
          account. To get started, create a new, secure password.
        </p>
      </div>
      <div class="w-full md:w-[50%] card flex-shrink-0 max-w-sm shadow-2xl bg-base-100">
        <form class="card-body" action="{{ route('reset.password.post') }}" method="post">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">

          <div class="form-control">
            <label class="label">
              <span class="label-text">Email</span>
            </label>
            <input readonly type="email" name="email" class="input input-bordered text-sm h-10" required value="{{ $email ?: old('email') }}" />

            @error('email')
            <p class="text-red-600 text-sm">{{$message}}"></p>
            @enderror
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Password</span>
            </label>
            <input type="password" name="password" class="input input-bordered text-sm h-10" required />

            @error('password')
            <p class="text-red-600 text-sm">{{$message}}"></p>
            @enderror
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Confirm Password</span>
            </label>
            <input type="password" name="password_confirmation" class="input input-bordered text-sm h-10" required />

            @error('password_confirmation')
            <p class="text-red-600 text-sm">{{$message}}"></p>
            @enderror
          </div>
          <div class="form-control mt-6">
            <button class="btn btn-primary btn-sm h-10 capitalize">Reset Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-layout>