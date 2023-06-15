<template>

            <form @submit.prevent="update" class="shadow bg-[#fff] rounded p-5 grid grid-cols-1 gap-3 min-w-[70%] mx-auto">
                <div class="grid   gap-2 relative">

                    <div class="border-2 mb-2 h-[150px] w-[250px] border-gray-500 border-dashed py-7 px-4 flex justify-center items-center">
                        <label for="image" class="bg-blue-500 px-2 py-1 z-30 text-center text-white">Change Profile</label>
                        <input type="file" id="image" ref="image" @change="uploadFile"  class="py-2 px-4 bg-gray-200 rounded w-full font-inter hidden">

                    </div>

                 <small v-if="errors.logo" class="text-red-600 font-inter"></small>
                    <img v-if="previewImage != ''" :src="previewImage" class="w-[250px] h-[150px] absolute left-0 z-10"  alt="">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="font-inter">Nickname</label>
                        <input type="text" v-model="data.nickname"  class="bg-gray-200 font-inter px-4 py-2 w-full inline-block  rounded"
                            placeholder="Golden Mami ewqe">
                    </div>
                    <div>
                        <label class="font-inter">Email</label>
                        <input type="email" v-model="data.email" class="bg-gray-200 font-inter px-4 py-2 w-full inline-block rounded"
                            placeholder="Golden Mami ewqe">
                    </div>
                </div>
                <div>
                    <label class="font-inter">Number</label>
                    <input type="text" v-model="data.number" class="bg-gray-200 font-inter px-4 py-2 w-full inline-block rounded"
                        placeholder="Golden Mami ewqe" min="11">
                </div>
                <div>
                    <label class="font-inter">Address</label>

                        <textarea v-model="data.address" class="bg-gray-200 font-inter px-4 py-2 w-full inline-block rounded" cols="2" rows="2"  placeholder="Complete Address"></textarea>
                </div>
                <div>
                    <label class="font-inter">Change Password</label>
                    <input type="text"  class="bg-gray-200 font-inter px-4 py-2 w-full inline-block rounded"
                        placeholder="Golden Mami ewqe">
                </div>
                <div>
                    <button type="submit" class="bg-green-400 font-inter px-4 py-2 w-full inline-block rounded">Change</button>

                </div>
            </form>

</template>
<script setup>
import axios from 'axios';
import { onMounted, reactive,ref } from 'vue';
import Swal from 'sweetalert2'
const data = reactive({
    nickname:'',
    email:'',
    number:'',
    address:'',
    photo:'',
    password:'',
});
const errors = ref([])
const previewImage = ref('');
const uploadFile = (e) => {
    const file = e.target.files[0];
    previewImage.value = URL.createObjectURL(file);
    data.photo = file;

};
const update = async () =>{
    const formData = new FormData();
    formData.append('photo',data.photo);
    formData.append('address',data.address);
    formData.append('nickname',data.nickname);
    formData.append('email',data.email);
    formData.append('number',data.number);
    formData.append('password',data.password);

    try {
        const res = await axios.post('/api/frontend/my/update',formData);
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Updated Successfully!',
            showConfirmButton: false,
            timer: 1500
        })
        setTimeout(()=>{
            location.reload();
        },2000)

    } catch (error) {

    }
}
const show = async () =>{
    const res = await axios.get('/api/frontend/my');
    data.nickname = res.data.nickname;
    data.email = res.data.email;
    data.number = res.data.number;
    data.address = res.data.address;
}
onMounted(()=>{
    show()
})

</script>
