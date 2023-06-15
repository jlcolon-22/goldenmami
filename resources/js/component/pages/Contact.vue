<template>
      <form @submit.prevent="add()" class="bg-[#f8f8f8] rounded shadow w-[600px] p-3">
                    <p class="text-gray-800 text-4xl font-serif">Contact us</p>


                    <div class="grid grid-cols-1 gap-3 p-3">
                        <div class="flex flex-col">
                            <label for="">Your Name</label>
                            <input type="text" class="p-3 bg-gray-200" v-model="data.name" placeholder="Fullname">
                            <h1 class="text-red-500 font-inter text-sm" v-if="errors.name">{{ errors.name[0] }}</h1>
                        </div>
                        <div class="flex flex-col">
                            <label for="">Email</label>
                            <input type="email" class="p-3 bg-gray-200" v-model="data.email" placeholder="example@gmail.com">
                            <h1 class="text-red-500 font-inter text-sm" v-if="errors.email">{{ errors.email[0] }}</h1>
                        </div>
                        <div class="flex flex-col">
                            <label for="">Phone Number</label>
                            <input type="tel" class="p-3 bg-gray-200" v-model="data.phone" placeholder="09132131**">
                            <h1 class="text-red-500 font-inter text-sm" v-if="errors.phone">{{ errors.phone[0] }}</h1>
                        </div>
                        <div class="flex flex-col">
                            <label for="">Message</label>
                            <textarea class="p-3 bg-gray-200" v-model="data.message" placeholder="Message..."></textarea>
                            <h1 class="text-red-500 font-inter text-sm" v-if="errors.message">{{ errors.message[0] }}</h1>
                        </div>

                    </div>


                    <div class="grid grid-cols-1 gap-10 p-3">
                       <button type="submit" class="bg-[#ebb700] p-3 text-gray-200 font-sans font-semibold" v-if="!loading">Send Message</button>
                       <button type="submit" class="bg-[#ebb700] p-3 text-gray-200 font-sans font-semibold" v-else disabled><i class="fa-solid fa-spinner animate-spin"></i></button>
                    </div>
                </form>
</template>
<script setup>
import axios from "axios"
import { reactive,ref } from "vue";
import Swal from 'sweetalert2'
const loading = ref(false);
const data = reactive({
    name:'',
    email:'',
    phone:'',
    message:'',
})
const errors = ref([]);
const add = async () =>{
    loading.value = true;
    try {
        const res = await axios.post('/api/frontend/contact/add',data);
        loading.value = false;
        Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Thank you for contact us. we will contact you shortly.',
                        showConfirmButton: true,
                        timer: 10000
                        })
                        errors.value = [];
        data.email = '';
        data.name = '';
        data.phone = '';
        data.message = '';
    } catch (error) {
       errors.value = error.response.data.errors;
    }
}
</script>
