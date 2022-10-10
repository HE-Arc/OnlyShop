<script setup>
import { ref } from 'vue'
import { storeToRefs } from "pinia";
import { useStore as useItemsStore } from "./store/item.store";

const show = ref(false)
const itemsStore = useItemsStore();
const { items, loading, error } = storeToRefs(itemsStore);

itemsStore.fetchItems();

</script>

<template>
    <h1>Tous les articles</h1>

    <div v-if="loading">Loading...</div>
    <div v-else>
        <div v-if="error">Error: {{ error }}</div>

        <div v-if="items">
            <v-container class="bg-surface-variant">
                <v-row no-gutters>
                    <v-col v-for="item in items" :key="item.id" cols="12" sm="4">
                        <v-sheet class="ma-2 pa-2">
                            <v-card class="mx-auto" max-width="344">
                                <v-img src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg" height="200px" cover>
                                </v-img>

                                <v-card-title> {{item.name}} </v-card-title>

                                <v-card-subtitle> {{item.price}} </v-card-subtitle>

                                <v-card-action>
                                    <v-btn><i class="material-icons"> payment </i></v-btn>
                                    <v-btn @click="show = !show">
                                        <i v-if="show" class="material-icons">
                                            close
                                        </i>
                                        <i v-else class="material-icons"> add </i>
                                    </v-btn>

                                    <v-btn href="/item/1"><i class="material-icons"> edit </i></v-btn>
                                    <v-btn @click="itemsStore.deleteItem(item.id)"><i class="material-icons"> delete
                                        </i></v-btn>
                                </v-card-action>
                                <v-expand-transition>
                                    <div v-show="show">
                                        <v-divider></v-divider>
                                        <v-card-text>
                                            Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua.
                                            Ut enim ad minim veniam, quis nostrud
                                            exercitation ullamco laboris nisi ut aliquip
                                            ex ea commodo consequat. Duis aute irure
                                            dolor in reprehenderit in voluptate velit
                                            esse cillum dolore eu fugiat nulla pariatur.
                                            Excepteur sint occaecat cupidatat non
                                            proident, sunt in culpa qui officia deserunt
                                            mollit anim id est laborum.
                                        </v-card-text>
                                    </div>
                                </v-expand-transition>
                            </v-card>
                        </v-sheet>
                    </v-col>
                </v-row>
            </v-container>
        </div>

    </div>
</template>
