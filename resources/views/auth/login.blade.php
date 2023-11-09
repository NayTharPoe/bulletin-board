<x-layout>
  <div class="hero items-center">
    <div class="hero-content flex-col lg:flex-row-reverse gap-12">
      <div class="w-full md:w-[50%] text-center lg:text-left">
        <div>
          <h1 class="text-2xl lg:text-5xl font-bold">Login now!</h1>
          <p class="py-6">Secure your account and access exclusive features. Explore a world of possibilities while
            protecting your personal information. Join us today!</p>
        </div>
      </div>
      <div class="w-full md:w-[50%] card flex-shrink-0 max-w-sm shadow-2xl bg-base-100">
        <form class="card-body" action="/post-login" method="post">
          @csrf
          <div class="form-control">
            <label class="label">
              <span class="label-text">Email</span>
            </label>
            <input type="email" name="email" placeholder="email" class="input input-bordered text-sm h-10"
              @if(isset($_COOKIE['email'])) value="{{$_COOKIE['email']}}" @else value="{{old('email')}}" @endif />

            @error('email')
            <p class="text-sm text-red-600">{{$message}}</p>
            @enderror
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Password</span>
            </label>
            <input type="password" name="password" placeholder="password" class="input input-bordered text-sm h-10"
              @if(isset($_COOKIE['password'])) value="{{$_COOKIE['password']}}" @else value="{{old('password')}}"
              @endif />

            @error('password')
            <p class="text-sm text-red-600">{{$message}}</p>
            @enderror
          </div>
          <div class="flex justify-between items-center">
            <div class="form-control">
              <label class="label cursor-pointer">
                <input type="checkbox" name="remember" class="checkbox checkbox-sm checkbox-primary mr-2" />
                <span class="label-text">Remember me</span>
              </label>
            </div>
            <label class="label">
              <a href="/forgot-password" class="label-text-alt link link-hover">Forgot password?</a>
            </label>
          </div>
          <div class="form-control mt-6">
            <button class="btn btn-primary btn-sm h-10 capitalize">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-layout>