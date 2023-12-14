<template>



        <form @submit.prevent="add" class="bg-[#f8f8f8] w-full md:w-[80%] max-w-[100%] mx-auto rounded shadow  p-3">
            <p class="text-gray-800 text-7xl text-center">Reservation</p>
            <p class="text-gray-600 text-2xl text-center">Book a table online. Leads will reach in your email.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2   ">
                <div class="grid grid-cols-1 gap-4 p-3  w-full">
                <div class="flex flex-col">
                    <label for="">Time</label>
                    <!-- <input type="time" v-model="data.time" class="p-3 bg-gray-200 w-full inline-block" :class="errors.time ? 'border-2 border-red-400' : ''" placeholder="time"> -->
                    <VueDatePicker :input-class-name="errors.time ? 'date_style error' : 'date_style'" :start-time="startTime" v-model="data.time"  :min-time="{ hours: 10, minutes: 30 }" time-picker  :max-time="{ hours: 21, minutes: 0 }"  placeholder="Select time" ></VueDatePicker>
                    <small class="text-base text-red-500" v-if="errors.time">{{ errors.time[0] }}</small>
                    <small class="text-base text-red-500" v-if="!!timeError">{{ timeError }}</small>
                </div>
                <div class="flex flex-col">
                    <label for="">Date</label>
                    <!-- <input type="date" v-model="data.date" class="p-3 bg-gray-200 w-full inline-block" :class="errors.date ? 'border-2 border-red-400' : ''" placeholder="example@gmail.com"> -->
                    <VueDatePicker  :input-class-name="errors.date ? 'date_style error' : 'date_style'" v-model="data.date"  :min-date="new Date()"   :enable-time-picker="false"  hide-navigation="['time']"  placeholder="Select Date" ></VueDatePicker>
                    <small class="text-base text-red-500" v-if="errors.date">{{ errors.date[0] }}</small>
                </div>
                <div class="flex flex-col relative">
                    <label for="">Phone Number</label>
                    <input type="number" pattern="^[09]\d{10,10}$" v-model="data.phone_number" class="py-3 pr-3 pl-14 bg-gray-200 w-full inline-block" :class="errors.phone_number ? 'border-2 border-red-400' : ''"  placeholder="91023213****">
                    <div class="bg-gray-300 w-fit p-3 absolute top-6">
                        +63
                    </div>
                    <small class="text-base text-red-500" v-if="errors.phone_number">{{ errors.phone_number[0] }}</small>
                </div>

            </div>
            <div class="grid grid-cols-1 gap-4 p-3 w-full">
                <div class="flex flex-col">
                    <label for="">Guest</label>
                    <input type="number"  v-model="data.guest" class="p-3 bg-gray-200 w-full inline-block" :class="errors.guest ? 'border-2 border-red-400' : ''" placeholder="1">
                    <small class="text-base text-red-500" v-if="errors.guest">{{ errors.guest[0] }}</small>
                </div>
                <div class="flex flex-col">
                    <label for="">Branch</label>
                    <select v-model="data.branch"  class="p-3 bg-gray-200 w-full inline-block" :class="errors.branch ? 'border-2 border-red-400' : ''">
                        <option value="">Choose...</option>
                        <option value="1">Calasiao</option>
                        <option value="2">Dagupan</option>
                        <option value="3">Lingayen</option>
                    </select>
                    <small class="text-base text-red-500" v-if="errors.branch">{{ errors.branch[0] }}</small>
                </div>
                <div class="flex flex-col">
                    <label for="">My Order</label>
                    <select v-model="data.order" class="p-3 bg-gray-200 w-full inline-block" :class="errors.order ? 'border-2 border-red-400' : ''">
                        <option value="">Choose...</option>
                        <option value="1">All in my cart</option>
                    </select>
                    <small class="text-base text-red-500" v-if="errors.order">{{ errors.order[0] }}</small>
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
import { reactive, ref ,onMounted,watch } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
const errors = ref([]);
const timeError = ref('');
const datx = ref('');
watch(datx,(n,o)=>{
    console.log(n)
})
const startTime = ref({ hours: 10, minutes: 30 });
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
        timeError.value = '';
        alert('you need to add to cart menu!')
    }else if(res.status == 207)
    {
        timeError.value = '';
        alert('Minimum amount of order is 500')
    }
    else if(res.status == 233)
    {
        timeError.value = `If you want to reserve for today, you should advance your time by ${res.data}.`;
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
onMounted(() => {
    data.guest = 1;
});
</script>
<style >
.date_style{
    background-color:rgb(229 231 235) !important;
    color: black !important;
    padding: 10px 0px 10px 40px !important;
    border-radius: 0px !important;
}
.error{
    border:1px solid red !important;
}
</style>
