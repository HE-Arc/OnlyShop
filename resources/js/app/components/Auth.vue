<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the login page

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->
<script setup>
import Login from "./Login.vue";
import Register from "./Register.vue";
import { ref } from "vue";

let tab = ref("login");
</script>

<template>
    <v-app>
        <!--<v-row justify="center">
            <img id="logo" src="/images/logo.png" alt="Logo" /> CHECK LATER WIP
        </v-row>-->
        <v-container>
            <v-row justify="center">
                <v-card width="500px" height="550px">
                    <v-tabs v-model="tab" grow>
                        <v-tab value="login">Login</v-tab>
                        <v-tab value="register">Register</v-tab>
                    </v-tabs>

                    <v-card-text>
                        <v-window v-model="tab">
                            <v-window-item value="login">
                                <Login />
                            </v-window-item>
                            <v-window-item value="register">
                                <Register />
                            </v-window-item>
                        </v-window>
                    </v-card-text>
                </v-card>
            </v-row>
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
