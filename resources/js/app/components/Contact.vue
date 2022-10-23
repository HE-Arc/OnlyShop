<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the contact page

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->
<script setup></script>

<template>
    <h1>Contact</h1>
    <v-card class="mx-auto" max-width="60%" max-height="90%" variant="outlined">
        <v-card-item>
            <div>
                <div class="text-h6 mb-1">Contact us</div>

                <div class="text-caption">
                    <v-form lazy-validation>
                        <v-text-field
                            label="Email"
                            name="email"
                            type="email"
                        ></v-text-field>

                        <v-textarea
                            label="Description"
                            name="text"
                        ></v-textarea>
                    </v-form>
                </div>
            </div>
        </v-card-item>

        <v-card-actions>
            <v-btn variant="outlined"> Validate </v-btn>
        </v-card-actions>
    </v-card>
</template>
