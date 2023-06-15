import { defineStore } from "pinia";

export const useIndexStore = defineStore('index',{
    state: () =>({
        carts: [],
        total: 0

    }),
    actions:{
        async fetchCart(){
            const res = await axios.get('/api/frontend/cart/customer');
            this.carts = res.data;

        }
    },

})
