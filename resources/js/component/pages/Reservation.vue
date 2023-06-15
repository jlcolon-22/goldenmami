<template>



        <form @submit.prevent="add" class="bg-[#f8f8f8] w-full md:w-[80%] max-w-[100%] mx-auto rounded shadow  p-3">
            <p class="text-gray-800 text-7xl text-center">Reservation</p>
            <p class="text-gray-600 text-2xl text-center">Book a table online. Leads will reach in your email.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2   ">
                <div class="grid grid-cols-1 gap-4 p-3  w-full">
                <div class="flex flex-col">
                    <label for="">Time</label>
                    <input type="time" v-model="data.time" class="p-3 bg-gray-200 w-full inline-block" :class="errors.time ? 'border-2 border-red-400' : ''" placeholder="time">
                </div>
                <div class="flex flex-col">
                    <label for="">Date</label>
                    <input type="date" v-model="data.date" class="p-3 bg-gray-200 w-full inline-block" :class="errors.date ? 'border-2 border-red-400' : ''" placeholder="example@gmail.com">
                </div>
                <div class="flex flex-col">
                    <label for="">Phone Number</label>
                    <input type="tel" v-model="data.phone_number" class="p-3 bg-gray-200 w-full inline-block" :class="errors.phone_number ? 'border-2 border-red-400' : ''" placeholder="091023213****">
                </div>

            </div>
            <div class="grid grid-cols-1 gap-4 p-3 w-full">
                <div class="flex flex-col">
                    <label for="">Guest</label>
                    <input type="number" v-model="data.guest" class="p-3 bg-gray-200 w-full inline-block" :class="errors.guest ? 'border-2 border-red-400' : ''" placeholder="1">
                </div>
                <div class="flex flex-col">
                    <label for="">Branch</label>
                    <select v-model="data.branch"  class="p-3 bg-gray-200 w-full inline-block" :class="errors.branch ? 'border-2 border-red-400' : ''">
                        <option value="">Choose...</option>
                        <option value="1">calasiao</option>
                        <option value="2">Dagupan</option>
                        <option value="3">Lingayen</option>
                    </select>
                </div>
                <div class="flex flex-col">
                    <label for="">My Order</label>
                    <select v-model="data.order" class="p-3 bg-gray-200 w-full inline-block" :class="errors.order ? 'border-2 border-red-400' : ''">
                        <option value="">Choose...</option>
                        <option value="1">All in my cart</option>
                    </select>
                </div>
            </div>
            </div>
            <!-- <div class="grid grid-cols-2 gap-10 p-3">
                <div class="flex flex-col">
                    <label for="">Time</label>
                    <input type="time" v-model="data.time" class="p-3 bg-gray-200" :class="errors.time ? 'border-2 border-red-400' : ''" placeholder="time">
                </div>
                <div class="flex flex-col">
                    <label for="">Date</label>
                    <input type="date" v-model="data.date" class="p-3 bg-gray-200" :class="errors.date ? 'border-2 border-red-400' : ''" placeholder="example@gmail.com">
                </div>
            </div> -->
            <!-- <div class="grid grid-cols-2 gap-10 p-3">
                <div class="flex flex-col">
                    <label for="">Phone Number</label>
                    <input type="tel" v-model="data.phone_number" class="p-3 bg-gray-200" :class="errors.phone_number ? 'border-2 border-red-400' : ''" placeholder="091023213****">
                </div>
                <div class="flex flex-col">
                    <label for="">Guest</label>
                    <input type="number" v-model="data.guest" class="p-3 bg-gray-200" :class="errors.guest ? 'border-2 border-red-400' : ''" placeholder="1">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-10 p-3">
                <div class="flex flex-col">
                    <label for="">Branch</label>
                    <select v-model="data.branch"  class="p-3 bg-gray-200" :class="errors.branch ? 'border-2 border-red-400' : ''">
                        <option value="">Choose...</option>
                        <option value="1">Calasioa</option>
                        <option value="2">Dagupan</option>
                        <option value="3">Lingayen</option>
                    </select>
                </div>
                <div class="flex flex-col">
                    <label for="">My Order</label>
                    <select v-model="data.order" class="p-3 bg-gray-200" :class="errors.order ? 'border-2 border-red-400' : ''">
                        <option value="">Choose...</option>
                        <option value="1">All in my cart</option>
                    </select>
                </div>
            </div>
             -->
             <div class="grid grid-cols-1 gap-10 p-3">
                <a v-if="props.auth == '0'" href="/login"  class="bg-[#ebb700] p-3 text-gray-200 font-sans text-center font-semibold">Make a Reservation</a>
                <div v-else  class="w-full">
                    <button v-if="!loading" type="submit"  class="bg-[#ebb700] p-3 text-gray-200 font-sans font-semibold w-full">Make a Reservation</button>
                    <button v-else  type="submit"  class="bg-[#ebb700] p-3 text-gray-100 font-sans font-semibold w-full"><i class="fa-solid fa-spinner animate-spin"></i></button>
                </div>
            </div>
        </form>

</template>
<script setup>
import { reactive, ref } from 'vue';

const errors = ref([]);
const data = reactive({
    time:'',
    date:'',
    phone_number:'',
    guest:'',
    branch:'',
    order:''
});
const loading = ref(false);
const props = defineProps({auth:String})

const add = async () =>{
    loading.value= true;
   try {
    const res = await axios.post('/api/frontend/reservation/payment',data);
    loading.value= false;
    if(res.status == 205)
    {
        alert('you need to add to cart menu!')
    }else if(res.status == 207)
    {
        alert('Minimum amount of order is 500')
    }
    else{
        window.location.replace(res.data);
    }


    errors.value = [];
   } catch (error) {
        errors.value = error.response.data.errors;
        loading.value= false;

   }
}
</script>

