@extends('layout.app', ['active_page' => 'client'])

@section('content')
<div id="app" class="container">
    <div>
        <a href="{{ route('clients.index') }}"><i class="bi bi-arrow-left"></i> Back</a>
    </div>

    <form class="mt-3" @submit.prevent="submitForm">
        <h3 v-cloak>@{{ formTitle }}</h3>

        <div class="mb-3">
            <label for="first-name" class="form-label">First Name</label>
            <input v-model="client.first_name" type="text" class="form-control" id="first-name" required>
        </div>
        <div class="mb-3">
            <label for="last-name" class="form-label">Last Name</label>
            <input v-model="client.last_name" type="text" class="form-control" id="last-name" required>
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input v-model="client.start_date" type="date" class="form-control" id="start_date" required>
        </div>
        <div class="mb-3">
            <label for="follow-up-date" class="form-label">Follow Up Date</label>
            <input v-model="client.follow_up_date" type="date" class="form-control" id="follow-up-date" required>
        </div>
        <div class="mb-3">
            <label for="status" >Inquiries Form</label>
            <select class="form-control" input v-model="client.inq" type="text" class="form-control" id="inq" required>
            <option>Website</option>
            <option>Referral</option>
            <option>Referral-Boss Liz</option>
            <option>Referral-Briony</option>
            <option>Sub-Agent</option>
            <option>LOA</option>
            <option>Not Applicable</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" >Web Leads</label>
            <select class="form-control" input v-model="client.web" type="text" class="form-control" id="web" required>
                    <option>Not Applicable</option>
                    <option>allexpathealth</option>
                    <option>Allmedical-Insurance</option>
                    <option>allprivatemedical</option>
                    <option>Bali-plans</option>
                    <option>banjinews</option>
                    <option>Bricon-us</option>
                    <option>Bupa-Medical</option>
                    <option>Cambodia-Plans</option>
                    <option>energyhorizon</option>
                    <option>expatglobalinsurance</option>
                    <option>first-petroleum</option>
                    <option>Flyingcarpert-asia</option>
                    <option>global-plans</option>
                    <option>globalprivateinsurance</option>
                    <option>healthglobalinsurance</option>
                    <option>help-global</option>
                    <option>indo-plans</option>
                    <option>juscall.com.ph</option>
                    <option>lippomedicalinsurance</option>
                    <option>luke-international</option>
                    <option>Luke-Medical</option>
                    <option>Malaysia-Plans</option>
                    <option>maxi-cover</option>
                    <option>med-assist</option>
                    <option>Medical818</option>
                    <option>Medical-intl</option>
                    <option>medicare-service</option>
                    <option>Medishure</option>
                    <option>medishureglobal</option>
                    <option>OILHR</option>
                    <option>pakistan-plans</option>
                    <option>Philippines-Plans</option>
                    <option>Pregnancy-Medicalinsurance</option>
                    <option>ptlukemedikal</option>
                    <option>raysunoilgas</option>
                    <option>rig-associates</option>
                    <option>sg-insurance</option>
                    <option>sg-plans</option>
                    <option>southernseaindooil</option>
                    <option>sri-lanka-plans</option>
                    <option>thailand-plans</option>
                    <option>tuvanbaohiemsuckhoe</option>
                    <option>uae-plans</option>
                    <option>vietnam-plans</option>
                    <option>vn-plans</option>
                    <option>vumi-medical</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" >Status</label>
            <select class="form-control" input v-model="client.status" type="text" class="form-control" id="status" required>
            <option>Not Started</option>
            <option>Send Quotation</option>
            <option>Send Renewal</option>
            <option>Waiting for Respond</option>
            <option>For Aproval</option>
            <option>Case Closed</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="notice" class="form-label">Notice</label>
            <select class="form-control" input v-model="client.notice" type="text" class="form-control" id="notice" required>
            <option>Renewal Notice</option>
            <option>Quotation</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="insurer" class="form-label">Insurer</label>
            <input v-model="client.insurer" type="text" class="form-control" id="insurer" required>
        </div>
        <div class="mb-3">
            <label for="cover" class="form-label">Cover</label>
            <input v-model="client.cover" type="text" class="form-control" id="cover" required>
        </div>
        <div class="mb-3">
            <label for="respond" class="form-label">Respond</label>
            <input v-model="client.respond" type="text" class="form-control" id="respond" required>
        </div>
        <div class="mb-3">
            <label for="remark" class="form-label">Remark</label>
            <input v-model="client.remark" type="text" class="form-control" id="remark" required>
        </div>
        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input v-model="client.contact" type="text" class="form-control" id="contact" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input v-model="client.email" type="text" class="form-control" id="email" required>
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
            client_id: '@isset($client_id){{ $client_id }}@endisset',
            client: {
                first_name: '',
                last_name: '',
                start_date: '',
                follow_up_date: '',
                inq: '',
                web: '',
                status: '',
                agent_id: '',
                notice: '',
                insurer: '',
                cover: '',
                respond: '',
                remark: '',
                contact: '',
                email: '',
            }
        },
        computed: {
            isUpdate() {
                return this.client_id != '';
            },
            formTitle() {
                if (this.isUpdate) {
                    return 'Edit Client';
                } else {
                    return 'Add new Client';
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
            fetchClient() {
                HttpClient.get('/clients/fetch/' + this.client_id)
                    .then(res => {
                        this.client = res.data.client;
                    });
            },
            submitForm() {
                if (this.isUpdate) {
                    this.updateClient();
                } else {
                    this.createClient();
                }
                
            },
            createClient() {
                HttpClient.post('/clients', this.client)
                .then(res => {
                    // success
                    // redirect to index
                    window.location.href = this.$rootUrl + '/clients';
                });
            },
            updateClient() {
                HttpClient.put('/clients/' + this.client_id, this.client)
                .then(res => {
                    // success
                    // redirect to index
                    window.location.href = this.$rootUrl + '/clients';
                });
            }
        },
        created() {
            if (this.isUpdate) {
                this.fetchClient();
            }
        }
    });
</script>
@endpush
