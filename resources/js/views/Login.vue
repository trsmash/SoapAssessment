<template>
    <div class="login-page">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Login</h1>
            <!--                        <div class="btn-toolbar mb-2 mb-md-0">-->
            <!--                            <div class="btn-group mr-2">-->
            <!--                                <button class="btn btn-sm btn-outline-secondary">Share</button>-->
            <!--                                <button class="btn btn-sm btn-outline-secondary">Export</button>-->
            <!--                            </div>-->
            <!--                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle">-->
            <!--                                <span data-feather="calendar"></span>-->
            <!--                                This week-->
            <!--                            </button>-->
            <!--                        </div>-->
        </div>
        <div>
            <form v-on:submit.prevent="authLoginAppUser">
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" v-model="email" placeholder="Enter your email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" v-model="password" placeholder="Enter your password">
                    </div>
                </div>
                <button type="submit" class="btn btn-dark btn-block">LOG IN &nbsp;&nbsp;<span v-if="showSpinner" class="fa fa-spin fa-spinner"></span> </button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: "",
                password: '',
                showSpinner: false,
                token: '',
            };
        },
        methods: {
            authLoginAppUser() {
                let userData = {
                    email: this.email,
                    password: this.password
                };

                if (this.email && this.password) {
                    axios.post(`/api/login`, userData).then(response => {
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.token;
                        this.$router.push({
                            name: 'workspaces',
                            params: {user: response.data.user}
                        });
                    }).catch(error => {
                        alert(error.response.data.message);
                        console.log(error.response.data.message);
                    })
                } else {
                    alert('Please check your credentials');
                }
            },
            redirectToRegister() {
                this.$router.push({name: 'register'});
            }
        }
    };
</script>