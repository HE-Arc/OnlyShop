<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the backet page

Wrote by : Rui Marco Loureiro
updated by : Rui Marco Loureiro
-->

<script setup>
import ItemImagesShopcartVue from "./ItemImagesShopcart.vue";

import { storeToRefs } from "pinia";
import { ref } from "vue";
import { useStore as useItemsStore } from "../store/item.store";

const itemsStore = useItemsStore();
const { basketItems, totalBascketPrice, loading, error } =
    storeToRefs(itemsStore);

itemsStore.fetchBasketItems();

const showAlert = (msg) => {
    alert(msg);
};
</script>

<template>
    <!-- <h1>Mon panier</h1> -->

    <div v-if="loading">Loading...</div>
    <div v-else>
        <div v-if="error">Error: {{ error }}</div>

        <div v-if="basketItems">
            <v-container>
                <v-card class="mx-auto">
                    <v-card-title>Mon panier</v-card-title>

                    <v-card-text>
                        <v-container>
                            <v-row no-gutters>
                                <v-col
                                    v-for="item in basketItems"
                                    :key="item.id"
                                    cols="12"
                                    sm="4"
                                >
                                    <v-sheet class="ma-2 pa-2">
                                        <v-card class="mx-auto" max-width="344">
                                            <ItemImagesShopcartVue
                                                :item="item"
                                            />

                                            <v-card-title
                                                class="justify-center"
                                            >
                                                <div class="text-center">
                                                    {{ item.name }}
                                                </div>
                                            </v-card-title>

                                            <v-card-subtitle
                                                class="justify-center"
                                            >
                                                <div class="text-center">
                                                    {{ item.price }}
                                                    CHF
                                                </div>
                                            </v-card-subtitle>

                                            <v-card-actions>
                                                <v-spacer></v-spacer>

                                                <v-btn
                                                    color="red"
                                                    icon
                                                    disabled
                                                    @click="
                                                        itemsStore.removeFromBasket(
                                                            item.id
                                                        )
                                                    "
                                                >
                                                    <v-icon>mdi-delete</v-icon>
                                                </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-sheet>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>

                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-btn
                            color="success"
                            text
                            @click="
                                showAlert(
                                    'Votre commande a été effectuée avec succès 😎\n Le livreur sonne déja à votre porte 🚚'
                                )
                            "
                        >
                            Commander
                        </v-btn>

                        <v-btn
                            color="warning"
                            text
                            disabled
                            @click="itemsStore.clearBasket()"
                        >
                            Vider le panier
                        </v-btn>

                        <v-spacer></v-spacer>

                        <v-btn
                            color="primary"
                            text
                            @click="
                                showAlert(
                                    'Le prix total de votre panier est de : ' +
                                        totalBascketPrice +
                                        ' CHF'
                                )
                            "
                        >
                            Total : {{ totalBascketPrice }} CHF
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-container>
        </div>
    </div>
</template>
<style></style>
