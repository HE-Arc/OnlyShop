<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the edit page

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->

<script setup>
import { ref } from "vue";
import { storeToRefs } from "pinia";
import { useStore as useItemsStore } from "../store/item.store";
import router from "./../../router";

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

// Fetch the item to edit according to the id in the route ⚠️
itemsStore.fetchItem(router.currentRoute.value.params.id);

const { currentEditItem, loading, error } = storeToRefs(itemsStore);

const editItem = async () => {
    await itemsStore.updateItem(currentEditItem.value);
    router.push({ name: "myitems" });
};
</script>

<template>
    <div v-if="loading">Loading...</div>
    <div v-else>
        <div v-if="error">Error: {{ error }}</div>

        <div v-if="currentEditItem">
            <v-container>
                <v-form v-model="form">
                    <v-row>
                        <v-banner
                            single-line
                            class="ma-4"
                            elevation="2"
                            rounded
                        >
                            <v-icon slot="icon" color="info" size="36">
                                mdi-information
                            </v-icon>
                            Mettre a jour un article
                            <template v-slot:actions>
                                <v-btn
                                    :disabled="
                                        currentEditItem.attributes.name == '' ||
                                        currentEditItem.attributes.price ==
                                            '' ||
                                        currentEditItem.attributes
                                            .description == ''
                                    "
                                    :loading="isLoading"
                                    color="primary"
                                    @click="() => editItem()"
                                >
                                    Mettre a jour
                                </v-btn>
                            </template>
                        </v-banner>
                    </v-row>
                    <v-row>
                        <v-col cols="12" md="4">
                            <v-text-field
                                v-model="currentEditItem.attributes.name"
                                :rules="[
                                    rules.length,
                                    rules.name,
                                    rules.required,
                                ]"
                                label="Nouveaux nom"
                                required
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12" md="4">
                            <v-text-field
                                v-model="currentEditItem.attributes.price"
                                :rules="[rules.price, rules.required]"
                                label="Nouveau prix"
                                type="number"
                                min="0"
                                required
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12" md="4">
                            <v-text-field
                                v-model="currentEditItem.attributes.description"
                                :rules="[
                                    rules.length,
                                    rules.description,
                                    rules.required,
                                ]"
                                label="Nouvelle description"
                                required
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-form>
            </v-container>
        </div>
    </div>
</template>
