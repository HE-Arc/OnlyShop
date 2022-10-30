<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the add item form in the "myitems page"

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->

<script setup>
import { ref } from "vue";

// ref --> re-build or re-evaluate everything
//  that depends on those variables every time they change
const dialog = ref(false);
const valid = ref(false);
const item = ref({
    name: "",
    description: "",
    price: "",
});

const nameRules = [
    (v) => !!v || "Name is required",
    (v) => v.length <= 15 || "Name must be less than 15 characters",
];
const descRules = [
    (v) => !!v || "Description is required",
    (v) => v.length <= 50 || "Description must be less than 50 characters",
];
const priceRules = [(v) => !!v || "Price is required"];
</script>

<template>
    <div class="text-center">
        <v-dialog v-model="dialog" width="500">
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                    color="primary"
                    dark
                    v-bind="attrs"
                    @click.stop="dialog = true"
                    icon="mdi-plus"
                >
                </v-btn>
            </template>

            <v-card>
                <v-card-title class="text-h5 grey lighten-2">
                    Add your new item
                </v-card-title>

                <v-card-text>
                    <v-form v-model="valid">
                        <v-row>
                            <v-col>
                                <v-text-field
                                    v-model="item.name"
                                    :rules="nameRules"
                                    :counter="15"
                                    label="Item name"
                                    required
                                ></v-text-field>
                            </v-col>

                            <v-col>
                                <v-text-field
                                    v-model="item.price"
                                    :rules="priceRules"
                                    label="Item price"
                                    type="number"
                                    required
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-text-field
                                    v-model="item.description"
                                    :rules="descRules"
                                    :counter="50"
                                    label="Item description"
                                    required
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="dialog = false">
                        Close
                    </v-btn>
                    <v-btn
                        color="primary"
                        text
                        @click="dialog = false"
                        v-on:click="$emit('item', (userId = 1), this.item)"
                    >
                        Add item
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>
