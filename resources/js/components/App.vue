<template>
    <div>
        <nav-bar />
        <div class="container-fluid">
            <div class="row">
                <side-nav />
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                    <router-view />
                </main>
            </div>
        </div>
    </div>
</template>

<script>
    import NavBar from "./NavBar";
    import SideNav from "./SideNav";

    export default {
        components: {NavBar, SideNav},
        mounted() {
            console.log("App component mounted");
        }
    };
</script>