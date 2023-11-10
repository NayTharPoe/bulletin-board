{{-- navigation bar --}}
<div class="navbar bg-base-100 shadow-md px-6 py-3 fixed top-0 z-[1] h-[74px]">
  {{-- mobile --}}
  <div class="navbar-start">
    <div class="dropdown">
      <label tabindex="0" class="btn btn-ghost lg:hidden mr-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
        </svg>
      </label>
      @if (auth()->check())
      <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
        @if (auth()->user()->is_admin)
        <li>
          <a>Users</a>
          <ul class="p-2">
            <li><a href="/users/create">Create User</a></li>
            <li><a href="/users">User Lists</a></li>
          </ul>
        </li>
        @endif
        <li>
          <a>Posts</a>
          <ul class="p-2">
            <li><a href="/posts/create">Create Post</a></li>
            <li><a href="/">Post Lists</a></li>
          </ul>
        </li>
        @guest
        <li>
          <a class="btn btn-sm btn-primary btn-outline my-2" href="/register">Register</a>
        </li>
        <li>
          <a class="btn btn-sm mb-2" href="/login">Login</a>
        </li>
        @endguest
      </ul>
      @endif
    </div>
    <a href="/" class="font-agbalumo flex normal-case text-[1.35rem] mr-12">
      Bulletin Board</a>

    {{-- desktop --}}
    <div class="hidden lg:flex">
      @if (auth()->check())
      <ul class="menu menu-horizontal px-1">
        <li>
          <a href="/posts/manage">Own Posts</a>
        </li>
        <li tabindex="0">
          <details>
            <summary>Posts</summary>
            <ul class="p-2">
              <li><a href="/posts/create">Create</a></li>
              <li><a href="/">Lists</a></li>
            </ul>
          </details>
        </li>
        @if (auth()->user()->is_admin)
        <li tabindex="0">
          <details>
            <summary>Users</summary>
            <ul class="p-2">
              <li><a href="/users/create">Create</a></li>
              <li><a href="/users">Lists</a></li>
            </ul>
          </details>
        </li>
        @endif
      </ul>
      @endif
    </div>
  </div>

  <div class="navbar-end">
    @auth
    <span class="hidden md:inline-block font-semibold text-sm">Welcome {{auth()->user()->name}}</span>
    {{-- profile dropdown --}}
    <div class="dropdown dropdown-end mx-4">
      <label tabindex="0" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          <img
            src="{{auth()->user()->image ? asset('storage/posts/'. auth()->user()->image) : asset('/images/default-avatar.jpg')}}" />
        </div>
      </label>
      <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
        <li>
          <a class="justify-between" href="/users/{{auth()->user()->id}}/profile">
            Profile
          </a>
        </li>
        <li>
          <a class="justify-between" href="/change-password">
            Change Password
          </a>
        </li>
        <form action="/logout" method="POST">
          <li>
            @csrf
            <button>Logout</button>
          </li>
        </form>
      </ul>
    </div>
    @else
    <div class="hidden lg:flex">
      <a class="btn btn-sm btn-primary" href="/register">Register</a>
      <a class="btn btn-sm btn-ghost mx-4" href="/login">Login</a>
    </div>
    @endauth
    {{-- theme switcher --}}
    <div class="btn btn-square btn-sm p-5 relative">
      <svg class="sun fill-current w-8 h-8 absolute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
        id="sun_icon">
        <path
          d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
      </svg>

      <svg class="moon fill-current w-6 h-6 absolute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
        id="moon_icon">
        >
        <path
          d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
      </svg>
    </div>
  </div>
</div>