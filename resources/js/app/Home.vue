<template>
    <v-app>
        <Menu />
        <v-main>
            <!-- <Items /> -->
            <router-view></router-view>
        </v-main>
        <Footer />
    </v-app>
</template>

<script>
import Menu from "./Menu.vue";
import Footer from "./Footer.vue";
import Items from "./Items.vue";

export default {
    name: "App",
    data() {
        return {
            //
        };
    },
    components: {
        Menu,
        Footer,
        Items,
    },
};
</script>

<style></style>
