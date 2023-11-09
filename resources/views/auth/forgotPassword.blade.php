<x-layout>
  <div class="hero h-96 bg-base-200">
    <div class="hero-content flex-col lg:flex-row-reverse gap-12">
      <div class="w-full md:w-[50%] text-center lg:text-left">
        <h1 class="text-2xl lg:text-5xl font-bold">Forgot Password ?</h1>
        <p class="py-6"> Forgot your password? No problem. Just let us know your email address and we will email you a
          password
          reset link that will allow you to choose a new one.</p>
      </div>
      <div class="w-full md:w-[50%] card flex-shrink-0 max-w-sm shadow-2xl bg-base-100">
        <form class="card-body" action="{{route('forgot.password.post')}}" method="post">
          @csrf
          <div class="form-control">
            <label class="label">
              <span class="label-text">Email</span>
            </label>
            <input type="email" name="email" placeholder="example@gamil.com" class="input h-10 input-bordered text-sm" />

            @error('email')
            <p class="text-red-600 text-sm">{{$message}}</p>
            @enderror
          </div>
          <div class="form-control mt-4">
            <button class="btn btn-primary btn-sm h-10 capitalize">Email password reset link</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-layout>