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
    length: (v) => (v || "").length >= 3 || "Must be at least 3 characters",
    email: (v) => !!(v || "").match(/@/) || "Please enter a valid email",
    password: (v) =>
        !!(v || "").match(
            /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/
        ) ||
        "Password must contain an upper case letter, a numeric character, and a special character",
    required: (v) => !!v || "This field is required",
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
                label="Email address"
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
                label="Password"
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
