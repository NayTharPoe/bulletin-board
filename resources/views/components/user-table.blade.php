<table class="table">
  <!-- head -->
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Email</th>
      <th class="pr-28">Phone</th>
      <th class="pr-8">Date of birth</th>
      <th>Address</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $key => $user)
    <x-user-row :key="$key" :user="$user" />
    @endforeach
</table>