@extends('layout.app', ['active_page' => 'client'])

@section('content')
<div id="app" class="container">
    
    <div class="d-flex justify-content-between align-items-center">
        <h3>Clients</h3>
        <a href="{{ route('clients.create') }}" class="btn btn-primary">Add New Client</a>
    </div>

    <input v-model="searchQuery" class="form-control mr-sm-2" type="search" placeholder="search product">
    <button @click="searchClient()" class="btn btn-primary">Search</button>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">Client</th>
            <th scope="col">Case Officer</th>
            <th scope="col">Start Date</th>
            <th scope="col">Follow Up Date</th>
            <th scope="col">Inquiries From</th>
            <th scope="col">Web Leads</th>
            <th scope="col">Status</th>
            <th scope="col">Notice</th>
            <th scope="col">Insurer</th>
            <th scope="col">Cover</th>
            <th scope="col">Respond</th>
            <th scope="col">Remark</th>
            <th scope="col">Contact</th>
            <th scope="col">Email</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="clients.length == 0">
            <td colspan="13" class="text-center">No Client</td>
          </tr>
          <template v-else>
            <tr v-for="client in clients" :key="client.id" v-cloak>
              <td>@{{ client.first_name + ' ' + client.last_name }}</td>
              <td>@{{ client.agent.first_name + ' ' + client.agent.last_name }}</td>
              <td>@{{ client.start_date }}</td>
              <td>@{{ client.follow_up_date }}</td>
              <td>@{{ client.inq }}</td>
              <td>@{{ client.web }}</td>
              <td>@{{ client.status }}</td>
              <td>@{{ client.notice }}</td>
              <td>@{{ client.insurer }}</td>
              <td>@{{ client.cover }}</td>
              <td>@{{ client.respond }}</td>
              <td>@{{ client.remark }}</td>
              <td>@{{ client.contact }}</td>
              <td>@{{ client.email }}</td>
              <td>
                  <a :href="$rootUrl + '/clients/edit/' + client.id" class="btn btn-sm btn-primary">Edit</a>
                  <button @click="deleteClient(client.id)" class="btn btn-sm btn-danger">Delete</button>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
</div>
@endsection

@push('scripts')
<script>
    new Vue({
        el: '#app',
        data: {
            clients: [],
            searchQuery: ''
        },
        watch: {
          searchQuery() {
            if (this.searchQuery.trim() == '') {
              this.fetchClients();
            }
          }
        },
        methods: {
            fetchClients() {
                HttpClient.get('/clients/fetch_all')
                    .then(res => {
                        this.clients = res.data.clients;
                    });
            },
            searchClient() {
                HttpClient.get('/search?query=' + this.searchQuery)
                    .then(res => {
                        this.clients = res.data.clients;
                    });
            },
            deleteClient(client_id) {
                HttpClient.delete('/clients/' + client_id)
                    .then(res => {
                        //success
                        //refresh the list
                        this.fetchClients();
                    });
            }
        },
        created() {
            this.fetchClients();
        }
    });
</script>
@endpush
