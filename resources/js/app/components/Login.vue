<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the login page

Wrote by : Lucas Perrin
updated by : Lucas Perrin
-->

<script setup>
import { ref } from "vue";

const user = ref({
    email: "",
    password: "",
});

let form = ref(false);
let isLoading = ref(false);

let rules = {
    length: (v) => (v || "").length >= 3 || "Doit avoir au moins 3 caractères",
    email: (v) =>
        !!(v || "").match(/@/) || "Merci d'entrer une adresse email valide",
    password: (v) =>
        !!(v || "").match(
            /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/
        ) ||
        "Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial",
    required: (v) => !!v || "Ce champ est requis",
};

let changePasswordFieldType = (id) => {
    let passwordField = document.getElementById(id);
    if (passwordField.type === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
};
</script>

<template>
    <v-container>
        <v-form v-model="form">
            <v-text-field
                prepend-icon="mdi-at"
                v-model="user.email"
                :rules="[rules.email]"
                variant="filled"
                color="deep-purple"
                label="Adresse email"
                type="email"
            ></v-text-field>

            <v-text-field
                prepend-icon="mdi-lock-outline"
                v-model="user.password"
                name="password"
                id="password_login"
                :rules="[rules.password, rules.length]"
                variant="filled"
                color="deep-purple"
                label="Mot de passe"
                :append-icon="user.password ? 'mdi-eye' : 'mdi-eye-off'"
                @click:append="() => changePasswordFieldType('password_login')"
                type="password"
            ></v-text-field>
        </v-form>

        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                :disabled="!form"
                :loading="isLoading"
                @click="$emit('login', user)"
                color="primary"
            >
                Login
            </v-btn>
        </v-card-actions>
    </v-container>
</template>
