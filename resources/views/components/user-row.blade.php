<!-- user row data -->

<tr>
  <td>
    <div>{{$key + 1}}</div>
  </td>
  <td>
    <div class="flex items-center space-x-3">
      <div class="avatar">
        <div class="mask mask-squircle w-12 h-12 bg-cover bg-no-repeat"
          style="background-image: url('{{$user->image ? asset('storage/posts/'. $user->image) : asset('/images/default-avatar.jpg')}}')">
        </div>
      </div>
      <div>
        <div class="font-bold">{{$user->name}}</div>
        <div class="text-sm opacity-50">{{$user->is_admin == 1 ? 'Admin' : 'User'}}</div>
      </div>
    </div>
  </td>
  <td>
    {{$user->email}}
  </td>
  <td>{{$user->phone ? $user->phone : '-'}}</td>
  <td>{{$user->dob ? $user->dob : '-'}}</td>
  <td>{{$user->address ? $user->address : '-'}}</td>
  <td>
    <div class="flex items-center space-x-3">
      <a class="btn btn-info btn-xs capitalize" href="/users/{{$user->id}}/detail">Detail</a>
    </div>
  </td>
</tr>