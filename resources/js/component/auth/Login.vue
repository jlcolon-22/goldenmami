<template>
    <form @submit.prevent="login" class="bg-[#f8f8f8] rounded shadow p-3" style="width: 500px;">
        <p class="text-gray-800 text-4xl  font-serif">Sign In</p>
        <div class="grid grid-cols-1 gap-3 p-3">
            <div class="bg-red-300 p-3 text-red-600" v-if="wrongCredentials">
                <strong>Wrong Credentials!</strong>
            </div>
            <div class="flex flex-col">
                <label for="">Email</label>
                <input type="email" v-model="data.email" class="p-3 bg-gray-200" placeholder="example@gmail.com">
                <small v-if="errors.email" class="text-red-500 text-base" >{{ errors.email[0] }}</small>
            </div>
            <div class="flex flex-col">
                <label for="">Password</label>
                <input type="password" v-model="data.password" class="p-3 bg-gray-200" placeholder="**********">
                <small v-if="errors.password" class="text-red-500 text-base" >{{ errors.password[0] }}</small>
                <a href="" class="text-blue-400 text-right  text-lg">Forgot password?</a>
            </div>
            <button type="submit" class="bg-blue-500 p-3 text-gray-200 font-sans font-semibold" v-if="loginLoading == false">Sign in</button>
            <button type="submit" class="bg-blue-500 p-3 text-gray-200 font-sans font-semibold opacity-80" disabled v-else><i class="fa-solid fa-spinner animate-spin"></i></button>
            <a href="/register" class="text-blue-400 text-center text-lg">Don't have an account?</a>
        </div>
    </form>
</template>
<script setup>
import {ref,reactive} from 'vue';
const data = reactive({
    email:'',
    password:'',
});
const errors = ref([]);
const loginLoading = ref(false);
const wrongCredentials = ref(false);
const login = async () =>{
    loginLoading.value = true;

    await axios.post('/api/auth/login',data).then(res =>{
        if(res.status == 203)
        {
            wrongCredentials.value = true;
            setTimeout(()=>{
                wrongCredentials.value = false;
            },4000)
        }else if(res.status == 202){
            location.href = '/employee/dashboard';
        }else if(res.status == 201){
            location.href = '/';
            localStorage.setItem('auth',true);
        }else if(res.status == 200){
            location.href = '/admin/dashboard';
        }
        errors.value = [];
        loginLoading.value = false;
    }).catch(err =>{
        errors.value = err.response.data.errors;

        loginLoading.value = false;
    })
}

</script>
