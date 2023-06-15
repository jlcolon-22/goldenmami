<template>
    <li class="relative">
        <button onclick="cart()"  class="lg:hidden text-lg relative font-normal fill-red-600"><i
                class="fa-solid fa-cart-shopping text-[#ebb700]"></i>
        </button>
        <button onclick="cartMobile()"  class="hidden lg:block text-lg relative font-normal fill-red-600"><i
                class="fa-solid fa-cart-shopping text-[#ebb700]"></i>
        </button>
        <div id="cartDropDown"
                class="z-50 cartDropDown bg-white px-2 pb-3 w-[350px] border shadow-2xl absolute left-auto top-9 -right-[124px] md:right-0 bottom-auto transition-all ease-in-out  rounded hidden">
                <h1 class="text-left leading-normal text-2xl">My Cart</h1>
                <div class="grid grid-cols-1 gap-4 p-2 max-h-[300px] overflow-y-auto">
                    <div v-for="(menu) in allData.data" :key="menu.id">
                        <div class="grid grid-cols-4 items-start ">
                            <img :src="'/storage/menu/'+menu.customer_cart_menu.photo" class="w-[70px] rounded h-[70px] mr-2 " alt="">
                            <div class="flex justify-between item flex-col h-full col-span-2">
                                <h1 class="text-base text-left font-inter w-[160px] truncate">{{ menu.customer_cart_menu.name }}</h1>
                                <input type="number" min="1" :value="menu.qty"  @change="qytUpdate(menu.id)"  class="w-[50px] rounded ring-sky-500 ring-1 text-sm text-center p-1"
                                    placeholder="qty">
                            </div>
                            <div class="flex justify-between flex-col h-full">
                                <a class="text-red-500 text-base" @click="destroy(menu.id)">Delete</a>
                                <p class="text-[#ebb700] text-base"> ₱{{ menu.qty * menu.customer_cart_menu.price }}</p>
                            </div>

                        </div>
                        <hr class="my-2">
                    </div>


                </div>
                <div class="w-full">
                    <small class="text-lg font-inter font-bold text-right w-full">Total: ₱{{ store.total }}</small>
                    <a href="/reservation"
                        class="bg-[#ebb700] py-2 px-4 text-base font-inter inline-block w-full font-bold hover:opacity-70 text-white text-center">Make
                        Reservation</a>
                </div>
            </div>
    </li>
</template>
<script setup>
  import { storeToRefs } from 'pinia'
import { onMounted, reactive, ref, watch } from "vue";
import { useIndexStore } from "../../store";
const store = useIndexStore();
const qty = ref([])
const allData = reactive({data: []});
const total = ref(0);
const { carts } = storeToRefs(store)
onMounted(()=>{
    if(localStorage.getItem('auth'))
    {
        store.fetchCart()
    }
    setTimeout(()=>{
        allData.data = store.carts;
        var x = allData.data.map((value)=>{
            var totals = parseInt(value.customer_cart_menu.price) * value.qty;

            return totals;
        });
        var totals = 0;
        x.forEach(element => {
            totals = totals + element;

        });
        store.total = totals;

    },1000)
})
const qytUpdate = async (id) =>{
    const res  = await axios.post('/api/frontend/cart/qty/update',{qty:event.target.value, id:id});

    store.fetchCart()
    setTimeout(()=>{
        allData.data = store.carts;

    },600)




}
const destroy = async (id) =>{
    const res = await axios.delete('/api/frontend/cart/item/delete/'+id);
    store.fetchCart()
    setTimeout(()=>{
        allData.data = store.carts;

    },600)
}
watch(carts,(x)=>{
    allData.data = x;
    var x = allData.data.map((value)=>{
            var totals = parseInt(value.customer_cart_menu.price) * value.qty;

            return totals;
        });
        var totals = 0;
        x.forEach(element => {
            totals = totals + element;

        });
        store.total = totals;
})
</script>
