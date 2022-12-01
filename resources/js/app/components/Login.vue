
<script setup>


import { ref } from "vue";

const user = ref({
    email: "",
    password: "",
});

let form = ref(false);
let isLoading = ref(false);

let rules = {
    email: v => !!(v || '').match(/@/) || 'Please enter a valid email',
    length: len => v => (v || '').length >= len || `Invalid character length, required ${len}`,
    password: v => !!(v || '').match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/) ||
        'Password must contain an upper case letter, a numeric character, and a special character',
    required: v => !!v || 'This field is required',
};

let changePasswordFieldType = (id) => {
    let passwordField = document.getElementById(id);
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
}

</script>


<template>
    <v-container>
        <v-form v-model="form">
            <v-text-field prepend-icon="mdi-at" v-model="user.email" :rules="[rules.email]" variant="filled"
                color="deep-purple" label="Email address" type="email"></v-text-field>

            <v-text-field prepend-icon="mdi-lock-outline" v-model="user.password" name="password" id="password_login"
                :rules="[rules.password, rules.length(6)]" variant="filled" color="deep-purple" counter="6"
                label="Password" :append-icon="user.password ? 'mdi-eye' : 'mdi-eye-off'"
                @click:append="() => changePasswordFieldType('password_login')" type="password"></v-text-field>
        </v-form>

        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn :disabled="!form" :loading="isLoading" @click="$emit('login', user)" color="primary">
                Login
            </v-btn>
        </v-card-actions>

    </v-container>
</template>

