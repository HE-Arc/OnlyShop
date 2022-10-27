<!-- CECI EST UNE CLASSE TEMPORAIRE UTILISE PAR RUI-->
<script setup>
import { useStore as useItemsStore } from "../store/item.store";

const itemsStore = useItemsStore();
const props = defineProps({
    item_id: Number,
});
</script>

<template>
    <v-card-actions class="justify-center">
        <div class="text-center">
            <v-btn>
                <router-link :to="{ name: 'edititem', params: { id: item_id } }"><i class="material-icons"> edit </i>
                </router-link>
            </v-btn>
            <v-btn @click="itemsStore.deleteItem(item_id)"><i class="material-icons"> delete </i></v-btn>
        </div>
    </v-card-actions>
</template>
