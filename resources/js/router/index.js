import { createRouter, createWebHistory } from "vue-router";

import Home from "../app/Home.vue";
import Login from "../app/Login.vue";
import MyItems from "../app/myItems.vue";
import Items from "../app/Items.vue";
import Panier from "../app/Panier.vue";
import Contact from "../app/Contact.vue";
import About from "../app/About.vue";


const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
        children: [
            {
                path: "/items",
                name: "items",
                component: Items,
            },
            {
                path: "myitems",
                name: "myitems",
                component: MyItems,
            },
            {
                path: "mybacket",
                name: "mybacket",
                component: Panier,
            },
            {
                path: "contact",
                name: "contact",
                component: Contact,
            },
            {
                path: "about",
                name: "about",
                component: About,
            },

        ]
    },

    {
        path: '/login',
        name:'login',
        component: Login
    }
]


const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
