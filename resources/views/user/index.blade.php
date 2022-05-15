@extends('layout.app', ['active_page' => 'user'])

@section('content')
<div id="app" class="container">
    
    <div class="d-flex justify-content-between align-items-center">
        <h3>Users</h3>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Add New User</a>
    </div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Username</th>
            <th scope="col">User Type</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id" v-cloak>
            <td>@{{ user.first_name }}</td>
            <td>@{{ user.last_name }}</td>
            <td>@{{ user.email }}</td>
            <td>@{{ user.username }}</td>
            <td>@{{ user.user_type }}</td>
            <td>
                <a :href="$rootUrl + '/users/edit/' + user.id" class="btn btn-sm btn-primary">Edit</a>
                <button @click="deleteUser(user.id)" class="btn btn-sm btn-primary">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
</div>
@endsection

@push('scripts')
<script>
    new Vue({
        el: '#app',
        data: {
            users: [],
        },
        methods: {
            fetchUsers() {
                HttpClient.get('/users/fetch_all')
                    .then(res => {
                        this.users = res.data.users;
                    });
            },
            deleteUser(user_id) {
                if (user_id == 1) {
                  return;
                }

                
                HttpClient.delete('/users/' + user_id)
                    .then(res => {
                        //success
                        //refresh the list
                        this.fetchUsers();
                    });
            }
        },
        created() {
            this.fetchUsers();
        }
    });
</script>
@endpush
