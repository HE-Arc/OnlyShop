<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the page with a menu and a footer

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->
<template>
    <v-app>
        <Menu />
        <v-main>
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
