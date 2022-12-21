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
    length: (v) => (v || "").length >= 3 || "Doit avoir au moins 3 caractères",
    name: (v) =>
        !!(v || "").match(/^[a-zA-Z0-9 ]*$/) || "Merci d'entrer un nom valide",
    price: (v) =>
        !!(v || "").match(/^[0-9]*$/) || "Merci d'entrer un prix valide",
    description: (v) =>
        !!(v || "").match(/^[a-zA-Z0-9 ]*$/) ||
        "Merci d'entrer une description valide",
    required: (v) => !!v || "Ce champ est requis",
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
                    Ajouter un article
                    <template v-slot:actions>
                        <v-btn
                            :disabled="!form"
                            :loading="isLoading"
                            color="primary"
                            @click="() => addItem()"
                        >
                            Ajouter
                        </v-btn>
                    </template>
                </v-banner>
            </v-row>

            <v-row>
                <v-col cols="12" md="3">
                    <v-text-field
                        v-model="item.name"
                        :rules="[rules.length, rules.name]"
                        label="Nom"
                        required
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                        v-model="item.price"
                        :rules="[rules.price]"
                        label="Prix"
                        type="number"
                        min="0"
                        required
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-text-field
                        v-model="item.description"
                        :rules="[rules.length, rules.description]"
                        label="Description"
                        required
                    ></v-text-field>
                </v-col>

                <v-col cols="12" md="3">
                    <v-file-input
                        label="Image de l'article"
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
