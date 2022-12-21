<script setup>
import router from "./../../router";
</script>

<template>
    <!-- Page not found-->
    <v-container>
        <v-row justify="center">
            <v-col cols="12" sm="8" md="6">
                <v-card class="elevation-12">
                    <v-toolbar color="deep-purple" dark flat>
                        <v-toolbar-title>Page non trouvée</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-alert type="error" outlined>
                            La page que vous recherchez n'existe pas ou a été
                            supprimée.
                        </v-alert>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="deep-purple"
                            text
                            @click="() => router.push({ name: 'home' })"
                        >
                            Retour à l'accueil
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
