<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : alerts

Wrote by : Lucas Perrin
updated by : Lucas Perrin
-->

<script setup>
import { useStore as useAlertStore } from "../store/alert.store";
import { storeToRefs } from "pinia";

const store = useAlertStore();

let { alerts } = storeToRefs(store);
</script>

<template>
    <div v-for="alert in alerts">
        <v-alert
            :key="alert.id"
            :type="alert.type"
            closable
            @click="() => store.removeAlert(alert.id)"
        >
            {{ alert.message }}
        </v-alert>
    </div>
</template>
