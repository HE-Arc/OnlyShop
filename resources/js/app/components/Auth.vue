<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : authentification

Wrote by : Rui Marco Loureiro
updated by : Lucas Perrin
-->
<script setup>
import Login from "./Login.vue";
import Register from "./Register.vue";
import { ref } from "vue";
import { storeToRefs } from "pinia";
import { useStore as useUserStore } from "../store/user.store";
import router from "./../../router";
import AlertVue from "./Alert.vue";

let userStore = useUserStore();
let { loading, error } = storeToRefs(userStore);

let tab = ref("login");

let login = async (user) => {
    console.log(user);
    await userStore.login(user);
    // navigate to home
    router.push({ name: "myitems" });
};

let register = async (user) => {
    console.log(user);
    await userStore.register(user);
    // change tab to login
    tab.value = "Connexion";
};
</script>

<template>
    <v-app>
        <v-container>
            <div v-if="loading">
                <v-progress-linear
                    indeterminate
                    color="primary"
                ></v-progress-linear>
            </div>
            <div v-else>
                <v-container>
                    <v-row justify="center">
                        <v-card width="500px" height="550px">
                            <v-tabs v-model="tab" grow>
                                <v-tab value="Connexion">Connexion</v-tab>
                                <v-tab value="S'inscrire">S'inscrire</v-tab>
                            </v-tabs>

                            <v-card-text>
                                <v-window v-model="tab">
                                    <v-window-item value="Connexion">
                                        <Login @login="(user) => login(user)" />
                                    </v-window-item>
                                    <v-window-item value="S'inscrire">
                                        <Register
                                            @register="(user) => register(user)"
                                        />
                                    </v-window-item>
                                </v-window>
                            </v-card-text>
                        </v-card>
                    </v-row>
                </v-container>
            </div>
        </v-container>
    </v-app>
</template>

<style>
/*.v-card {
    margin-top: auto;
    margin-bottom: auto;
}*/

/*#logo {
    width: 500px;
    height: 202px;
    margin-top: 20px;
}*/
</style>
