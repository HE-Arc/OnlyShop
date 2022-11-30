
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

</script>


<template>
    <v-container>
        <v-form v-model="form">
            <v-text-field v-model="user.email" :rules="[rules.email]" variant="filled" color="deep-purple"
                label="Email address" type="email"></v-text-field>

            <v-text-field v-model="user.password" :rules="[rules.password, rules.length(6)]" variant="filled"
                color="deep-purple" counter="6" label="Password" type="password"></v-text-field>
        </v-form>

        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn :disabled="!form" :loading="isLoading" color="primary">
                Login
            </v-btn>
        </v-card-actions>

    </v-container>
</template>

