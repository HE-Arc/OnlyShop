<template>
    <v-app>
        <Menu/>

        <Footer/>
    </v-app>
</template>

<script>
import Menu from "./Menu.vue";
import Footer from "./Footer.vue";

export default {
    name: "App",
    data() {
        return {
            //
        };
    },
    components: {
        Menu,
        Footer
    }
};
</script>

<style>


</style>
