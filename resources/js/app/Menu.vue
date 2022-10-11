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
                <div class="m_title">OnlyShop</div></v-toolbar-title
            >
        </div>

        <v-spacer></v-spacer>

        <v-app-bar-nav-icon>
            <i class="material-icons"> search </i>
        </v-app-bar-nav-icon>

        <v-list class="d-none d-lg-flex">
            <v-list-item v-for="item in items">
                <v-list-item-title>
                    <v-btn href="#"> {{ item.title }} </v-btn>
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
                    <v-btn href="#" flat> {{ item.title }} </v-btn>
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
                { title: "Tous les articles" },
                { title: "Mes articles" },
                { title: "Panier" },
                { title: "Contact" },
                { title: "A propos" },
                { title: "Se déconnecter" },
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
</style>
