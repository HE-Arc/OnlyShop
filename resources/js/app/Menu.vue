<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the menu page

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->
<template>
    <v-app-bar>
        <v-app-bar-nav-icon
            @click.stop="drawer = !drawer"
            class="d-lg-none d-flex"
        >
            <i class="material-icons"> menu </i>
        </v-app-bar-nav-icon>
        <div>
            <v-toolbar-title>
                <div class="m_title">
                    <router-link :to="{ name: 'items' }">OnlyShop</router-link>
                </div></v-toolbar-title
            >
        </div>

        <v-spacer></v-spacer>

        <v-app-bar-nav-icon>
            <i class="material-icons"> search </i>
        </v-app-bar-nav-icon>

        <v-list class="d-none d-lg-flex">
            <v-list-item v-for="item in items">
                <v-list-item-title>
                    <v-btn>
                        <router-link :to="{ path: item.router }">
                            {{ item.title }}
                        </router-link>
                    </v-btn>
                </v-list-item-title>
            </v-list-item>
        </v-list>

        <v-app-bar-nav-icon>
            <i class="material-icons"> nightlight_round </i>
        </v-app-bar-nav-icon>
    </v-app-bar>

    <v-navigation-drawer v-model="drawer" bottom temporary>
        <v-list>
            <v-list-item v-for="item in items">
                <v-list-item-title>
                    <router-link :to="{ path: item.router }">
                        {{ item.title }}
                    </router-link>
                </v-list-item-title>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
export default {
    name: "Menu",
    data() {
        return {
            drawer: false,
            items: [
                { title: "Tous les articles", router: "/items" },
                { title: "Mes articles", router: "/myitems" },
                { title: "Panier", router: "/mybacket" },
                { title: "Contact", router: "/contact" },
                { title: "Se déconnecter", router: "/login" },
            ],
        };
    },
};
</script>

<style scoped>
.m_title {
    font-family: "Pacifico", cursive;
    font-size: 2rem;
    height: 50px;
    padding: 2px;
}

a {
    text-decoration: none;
    color: black;
}
</style>
