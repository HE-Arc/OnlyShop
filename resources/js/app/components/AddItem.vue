<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the add page

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->

<script setup>
import { ref } from "vue";
import { useStore as useItemsStore } from "../store/item.store";
import router from "./../../router";

const item = ref({
    name: "",
    description: "",
    price: "",
    images: "",
});

let form = ref(false);
let isLoading = ref(false);

let rules = {
    length: (v) => (v || "").length >= 3 || "Must be at least 3 characters",
    name: (v) =>
        !!(v || "").match(/^[a-zA-Z0-9 ]*$/) || "Please enter a valid name",
    price: (v) => !!(v || "").match(/^[0-9]*$/) || "Please enter a valid price",
    description: (v) =>
        !!(v || "").match(/^[a-zA-Z0-9 ]*$/) ||
        "Please enter a valid description",
    required: (v) => !!v || "This field is required",
};

const itemsStore = useItemsStore();

const addItem = async () => {
    await itemsStore.addItem(item.value);
    router.push({ name: "myitems" });
};
</script>

<template>
    <v-container>
        <v-form v-model="form">
            <v-row>
                <v-banner single-line class="ma-4" elevation="2" rounded>
                    <v-icon slot="icon" color="info" size="36">
                        mdi-information
                    </v-icon>
                    Add your item
                    <template v-slot:actions>
                        <v-btn
                            :disabled="!form"
                            :loading="isLoading"
                            color="primary"
                            @click="() => addItem()"
                        >
                            Add item
                        </v-btn>
                    </template>
                </v-banner>
            </v-row>

            <v-row>
                <v-col cols="12" md="3">
                    <v-text-field
                        v-model="item.name"
                        :rules="[rules.length, rules.name]"
                        label="New item name"
                        required
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                        v-model="item.price"
                        :rules="[rules.price]"
                        label="New item price"
                        type="number"
                        min="0"
                        required
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                        v-model="item.description"
                        :rules="[rules.length, rules.description]"
                        label="New item description"
                        required
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-file-input
                        label="New item image"
                        prepend-icon="mdi-camera"
                        v-model="item.images"
                        accept="image/png, image/jpeg, image/bmp"
                        multiple
                    ></v-file-input>
                </v-col>
            </v-row>
        </v-form>
    </v-container>
</template>
