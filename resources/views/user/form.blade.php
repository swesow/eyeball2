@extends('layout.app', ['active_page' => 'user'])

@section('content')
<div id="app" class="container mb-5">
    <div>
        <a href="{{ route('users.index') }}"><i class="bi bi-arrow-left"></i> Back</a>
    </div>

    <form class="mt-3" @submit.prevent="submitForm">
        <h3 v-cloak>@{{ formTitle }}</h3>

        <div class="mb-3">
            <label for="first-name" class="form-label">First Name</label>
            <input v-model="user.first_name" type="text" class="form-control" id="first-name" required>
        </div>
        <div class="mb-3">
            <label for="last-name" class="form-label">Last Name</label>
            <input v-model="user.last_name" type="text" class="form-control" id="last-name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input v-model="user.email" type="text" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input v-model="user.username" type="text" class="form-control" id="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input v-model="user.password" type="password" class="form-control" id="password" required>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" v-cloak>@{{ positiveButtonText }}</button>
        </div>
        
    </form>
</div>
@endsection

@push('scripts')
<script>
    new Vue({
        el: '#app',
        data: {
            user_id: '@isset($user_id){{ $user_id }}@endisset',
            user: {
                first_name: '',
                last_name: '',
                email: '',
                username: '',
                password: ''
            }
        },
        computed: {
            isUpdate() {
                return this.user_id != '';
            },
            formTitle() {
                if (this.isUpdate) {
                    return 'Edit User';
                } else {
                    return 'Add new User';
                }
            },
            positiveButtonText() {
                if (this.isUpdate) {
                    return 'Update';
                } else {
                    return 'Add';
                }
            }
        },
        methods: {
            fetchUser() {
                HttpClient.get('/users/fetch/' + this.user_id)
                    .then(res => {
                        this.user = res.data.user;
                    });
            },
            submitForm() {
                if (this.isUpdate) {
                    this.updateUser();
                } else {
                    this.createUser();
                }
                
            },
            createUser() {
                HttpClient.post('/users', this.user)
                .then(res => {
                    // success
                    // redirect to index
                    window.location.href = this.$rootUrl + '/users';
                });
            },
            updateUser() {
                HttpClient.put('/users/' + this.user_id, this.user)
                .then(res => {
                    // success
                    // redirect to index
                    window.location.href = this.$rootUrl + '/users';
                });
            }
        },
        created() {
            if (this.isUpdate) {
                this.fetchUser();
            }
        }
    });
</script>
@endpush
