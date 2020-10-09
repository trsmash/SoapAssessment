<template>
    <div class="login-page">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Channels</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button class="btn btn-sm btn-outline-secondary" @click="showModal">Add New</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody v-if="channels.length">
                    <tr v-for="channel in channels">
                        <td>{{ channel.id }}</td>
                        <td>{{ channel.name }}</td>
                        <td>{{ channel.description }}</td>
                        <td>{{ channel.created_at }}</td>
                        <td><button class="btn btn-sm btn-outline-secondary">Edit</button></td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td class="text-center" colspan="5">You have no channels</td>
                    </tr>
                </tbody>
            </table>
            <b-modal id="aw-modal" @ok="submitChannel">
                <template v-slot:modal-title>
                    Add Channel
                </template>
                <b-form>
                    <b-form-group
                        id="workspace-name-input-group"
                        label="Name:"
                        label-for="name"
                    >
                        <b-form-input
                            id="name"
                            type="text"
                            v-model="name"
                            required
                            placeholder="Enter a name"
                        />
                    </b-form-group>
                </b-form>
            </b-modal>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['workspace'],
        mounted() {
            this.fetchChannels();
        },
        data() {
            return {
                channels: [],
                name: "",
                description: ""
            }
        },
        methods: {
            fetchChannels() {
                axios.get(`/api/workspace/${this.workspace.id}/channels`)
                    .then(response => this.channels = response.data)
                    .catch(error => console.error(error));
            },
            showModal() {
                this.name = "";
                this.description = "";
                this.$bvModal.show('aw-modal');
            },
            submitChannel() {
                axios.post(`/api/users/${this.user.id}/workspaces`, { name: this.name, description: this.description })
                    .then(() => this.fetchWorkspaces())
                    .catch(error => console.error(error));
            }
        }
    };
</script>