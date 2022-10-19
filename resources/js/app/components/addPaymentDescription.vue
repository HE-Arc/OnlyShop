<script setup>
import { ref } from "vue";
import { storeToRefs } from "pinia";
import { useStore as useItemsStore } from "../store/item.store";

const show = ref(false);
const itemsStore = useItemsStore();
const { items, loading, error } = storeToRefs(itemsStore);

itemsStore.fetchItems();
</script>

<template>
    <div v-if="loading">Loading...</div>
    <div v-else>
        <div v-if="error">Error: {{ error }}</div>

        <div v-if="items">
            <v-card-action class="justify-center">
                <div class="text-center">
                    <v-btn><i class="material-icons"> payment </i></v-btn>
                    <v-btn @click="show = !show">
                        <i v-if="show" class="material-icons">
                            arrow_drop_up
                        </i>
                        <i v-else class="material-icons"> arrow_drop_down </i>
                    </v-btn>
                </div>
            </v-card-action>
            <v-expand-transition>
                <div v-show="show">
                    <v-divider></v-divider>
                    <v-card-text>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea
                        commodo consequat. Duis aute irure dolor in
                        reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit
                        anim id est laborum.
                    </v-card-text>
                </div>
            </v-expand-transition>
        </div>
    </div>
</template>
