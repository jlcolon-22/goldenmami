<template>
    <form @submit.prevent="login" class="bg-[#f8f8f8] rounded shadow p-3" style="width: 500px;">
        <p class="text-gray-800 text-4xl  font-serif">Sign Up</p>
        <div class="grid grid-cols-1 gap-3 p-3">
            <div class="bg-red-300 p-3 text-red-600" v-if="wrongCredentials">
                <strong>Wrong Credentials!</strong>
            </div>
            <div class="flex flex-col">
                <label for="">Nickname</label>
                <input type="text" v-model="data.nickname" class="p-3 bg-gray-200" placeholder="Jessica">
                <small v-if="errors.nickname" class="text-red-500 text-base" >{{ errors.nickname[0] }}</small>
            </div>
            <div class="flex flex-col">
                <label for="">Email</label>
                <input type="email" v-model="data.email" class="p-3 bg-gray-200" placeholder="example@gmail.com">
                <small v-if="errors.email" class="text-red-500 text-base" >{{ errors.email[0] }}</small>
            </div>
            <div class="flex flex-col">
                <label for="">Number</label>
                <input type="tel" v-model="data.number" class="p-3 bg-gray-200" placeholder="092313***">
                <small v-if="errors.number" class="text-red-500 text-base" >{{ errors.number[0] }}</small>
            </div>
            <div class="flex flex-col">
                <label for="">Password</label>
                <input type="password" v-model="data.password" class="p-3 bg-gray-200" placeholder="**********">
                <small v-if="errors.password" class="text-red-500 text-base" >{{ errors.password[0] }}</small>

            </div>
            <button type="submit" class="bg-blue-500 p-3 text-gray-200 font-sans font-semibold" v-if="loginLoading == false">Sign in</button>
            <button type="submit" class="bg-blue-500 p-3 text-gray-200 font-sans font-semibold opacity-80" disabled v-else><i class="fa-solid fa-spinner animate-spin"></i></button>
            <span class="font-inter text-sm text-center">Already have an account?<a href="/login" class="text-blue-500 font-inter text-sm">Login here</a></span>
        </div>
    </form>
</template>
<script setup>
import {ref,reactive} from 'vue';
const data = reactive({
    email:'',
    nickname:'',
    number:'',
    password:'',
});
const errors = ref([]);
const loginLoading = ref(false);
const wrongCredentials = ref(false);
const login = async () =>{
    loginLoading.value = true;
    try {
      const res = await axios.post('/api/auth/register',data)


            location.href = '/';

        errors.value = [];
        loginLoading.value = false;
    } catch (err) {
        errors.value = err.response.data.errors;
        loginLoading.value = false;
    }


}

</script>
