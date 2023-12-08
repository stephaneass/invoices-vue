import { createRouter, createWebHistory } from "vue-router";

import InvoiceIndex from '../components/invoices/Index.vue'
import InvoiceNew from '../components/invoices/New.vue'
import InvoiceShow from '../components/invoices/Show.vue'
import NotFound from '../components/NotFound.vue'

const routes = [
    {path: '/', component: InvoiceIndex},
    {path: '/invoice/new', component: InvoiceNew},
    {path: '/invoice/show/:id', component: InvoiceShow, props: true},
    {path: '/:pathMatch(.*)*', component: NotFound},
]

const router  = createRouter({
    history: createWebHistory(),
    routes
})

export default router