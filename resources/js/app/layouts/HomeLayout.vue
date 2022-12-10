<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the page with a menu and a footer

Wrote by : Rui Marco Loureiro
updated by : Lucas Perrin
-->
<script setup>
import Menu from "../components/Menu.vue";
import Footer from "../components/Footer.vue";
</script>

<template>
    <v-app>
        <Menu />
        <v-main>
            <router-view></router-view>
        </v-main>
        <Footer />
    </v-app>
</template>

<style></style>
