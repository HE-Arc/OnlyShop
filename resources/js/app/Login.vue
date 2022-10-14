<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the login page

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->
<template>
    <v-app>
        <v-row justify="center">
            <img id="logo" src="/images/logo.png" alt="Logo" />
        </v-row>

        <v-row justify="center">
            <v-card width="500px" height="550px">
                <v-tabs v-model="tab">
                    <v-tab value="login">Login</v-tab>
                    <v-tab value="register">Register</v-tab>
                </v-tabs>

                <v-card-text>
                    <v-window v-model="tab">
                        <v-window-item value="login">
                            <v-form lazy-validation>
                                <v-text-field
                                    label="Email"
                                    name="email"
                                    type="email"
                                ></v-text-field>

                                <v-text-field
                                    id="password"
                                    label="Password"
                                    name="password"
                                    type="password"
                                ></v-text-field>
                            </v-form>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="primary">Login</v-btn>
                            </v-card-actions>
                        </v-window-item>
                        <v-window-item value="register">
                            <v-form lazy-validation>
                                <v-text-field
                                    label="First Name"
                                    name="firstname"
                                    type="text"
                                ></v-text-field>

                                <v-text-field
                                    label="Last Name"
                                    name="lastname"
                                    type="text"
                                ></v-text-field>

                                <v-text-field
                                    label="Email"
                                    name="email"
                                    type="email"
                                ></v-text-field>

                                <v-text-field
                                    id="password"
                                    label="Password"
                                    name="password"
                                    type="password"
                                ></v-text-field>

                                <v-text-field
                                    id="confirmPassword"
                                    label="Confirm Password"
                                    name="confirmpassword"
                                    type="password"
                                ></v-text-field>
                            </v-form>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="primary">Register</v-btn>
                            </v-card-actions>
                        </v-window-item>
                    </v-window>
                </v-card-text>
            </v-card>
        </v-row>
    </v-app>
</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            tab: null,
        };
    },
};
</script>

<style>
.v-card {
    margin-top: auto;
    margin-bottom: auto;
}

#logo {
    width: 500px;
    height: 202px;
    margin-top: 20px;
}
</style>
