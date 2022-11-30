<script setup>

import { ref } from "vue";

const user = ref({
    firstName: "",
    lastName: "",
    email: "",
    password: "",
    password_confirmation: "",
});

let form = ref(false);
let isLoading = ref(false);

let rules = {
    length: len => v => (v || '').length >= len || `Invalid character length, required ${len}`,
    email: v => !!(v || '').match(/@/) || 'Please enter a valid email',
    length: len => v => (v || '').length >= len || `Invalid character length, required ${len}`,
    password: v => !!(v || '').match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/) ||
        'Password must contain an upper case letter, a numeric character, and a special character',
    required: v => !!v || 'This field is required',
    password_confirmation: v => v === user.value.password || 'Passwords do not match',
}
</script>

<template>

    <v-container>
        <v-form v-model="form">

            <v-text-field v-model="user.firstName" :rules="[rules.length]" variant="filled" color="deep-purple"
                label="First Name" name="firstname" type="text"></v-text-field>

            <v-text-field v-model="user.lastName" :rules="[rules.length]" variant="filled" color="deep-purple"
                label="First Name" name="lastname" type="text"></v-text-field>

            <v-text-field prepend-icon="mdi-at" v-model="user.email" :rules="[rules.email]" variant="filled"
                color="deep-purple" label="Email address" name="email" type="email"></v-text-field>

            <v-text-field prepend-icon="mdi-lock-outline" v-model="user.password" :rules="[rules.password]"
                variant="filled" color="deep-purple" label="Password" name="password" type="password"></v-text-field>

            <v-text-field prepend-icon="mdi-lock-outline" v-model="user.password_confirmation"
                :rules="[rules.password_confirmation]" variant="filled" color="deep-purple" label="Password validation"
                name="password_confirmation" type="password"></v-text-field>


        </v-form>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn :disabled="!form" :loading="isLoading" color="primary">
                Register
            </v-btn>
        </v-card-actions>

    </v-container>
</template>
