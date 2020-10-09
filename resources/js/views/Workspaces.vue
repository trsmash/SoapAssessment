<template>
    <div class="login-page">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Workspaces</h1>
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
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody v-if="workspaces.length">
                    <tr v-for="workspace in workspaces">
                        <td>{{ workspace.id }}</td>
                        <td>{{ workspace.name }}</td>
                        <td>{{ workspace.created_at }}</td>
                        <td><router-link class="btn btn-sm btn-outline-secondary" :to="{ name: 'channels', params: { workspace: workspace }}">View Channels</router-link></td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td class="text-center" colspan="4">You have no workspaces</td>
                    </tr>
                </tbody>
            </table>
            <b-modal id="aw-modal" @ok="submitWorkspace">
                <template v-slot:modal-title>
                    Add Workspace
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
        props: ['user'],
        mounted() {
            this.fetchWorkspaces();
        },
        data() {
            return {
                workspaces: [],
                name: ""
            }
        },
        methods: {
            fetchWorkspaces() {
                axios.get(`/api/users/${this.user.id}/workspaces`)
                    .then(response => this.workspaces = response.data)
                    .catch(error => console.error(error));
            },
            showModal() {
                this.name = "";
                this.$bvModal.show('aw-modal');
            },
            submitWorkspace() {
                axios.post(`/api/users/${this.user.id}/workspaces`, { name: this.name })
                    .then(() => this.fetchWorkspaces())
                    .catch(error => console.error(error));
            }
        }
    };
</script>