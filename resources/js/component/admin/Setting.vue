<template>
    <div class="p-10 ">
        <form @submit.prevent="add" class="shadow bg-[#fff] rounded p-5 grid grid-cols-1 gap-3">
            <div class="grid   gap-2 relative">

                <div class="border-2 mb-2 h-[150px] w-[250px] border-gray-500 border-dashed py-7 px-4 flex justify-center items-center">
                    <label for="image" class="bg-blue-500 px-2 py-1 z-30 text-center text-white">Change Logo</label>
                    <input type="file" id="image" ref="image" @change="uploadFile" class="py-2 px-4 bg-gray-200 rounded w-full font-inter hidden">

                </div>

              <small v-if="errors.logo" class="text-red-600 font-inter">{{ errors.logo[0] }}</small>
                <img v-if="previewImage != ''" :src="previewImage" class="w-[250px] h-[150px] absolute left-0 z-10"  alt="">
            </div>
            <div>
                <label class="font-inter">Restaurant Name</label>
                <input type="text" v-model="data.res_name" class="bg-gray-200 font-inter px-4 py-2 w-full inline-block  rounded"
                    placeholder="Golden Mami">
            </div>
            <div>
                <label class="font-inter">Restaurant Email</label>
                <input type="email" v-model="data.res_email" class="bg-gray-200 font-inter px-4 py-2 w-full inline-block rounded"
                    placeholder="goldenmami@gmail.com">
            </div>
            <div>
                <label class="font-inter">Restaurant Number</label>
                <input type="text" v-model="data.res_number" class="bg-gray-200 font-inter px-4 py-2 w-full inline-block rounded"
                    placeholder="0923132***" min="11">
            </div>
            <div>
                <label class="font-inter">Restaurant FB Link</label>
                <input type="url" v-model="data.res_fb" class="bg-gray-200 font-inter px-4 py-2 w-full inline-block rounded"
                    placeholder="https://web.facebook.com/GoldenMamiHouse">
            </div>
            <div>
                <label class="font-inter">Restaurant Twitter Link</label>
                <input type="url" v-model="data.res_twitter" class="bg-gray-200 font-inter px-4 py-2 w-full inline-block rounded"
                    placeholder="https://web.facebook.com/GoldenMamiHouse">
            </div>
            <div>
                <label class="font-inter">Restaurant Instagram Link</label>
                <input type="url" v-model="data.res_instagram" class="bg-gray-200 font-inter px-4 py-2 w-full inline-block rounded"
                    placeholder="https://web.facebook.com/GoldenMamiHouse">
            </div>
            <div>
                <label class="font-inter">Change Admin Password</label>
                <input type="text" v-model="data.res_password" class="bg-gray-200 font-inter px-4 py-2 w-full inline-block rounded"
                    placeholder="**********">
            </div>
            <div>
                <button type="submit" class="bg-green-400 font-inter px-4 py-2 w-full inline-block rounded">Change</button>

            </div>
        </form>
    </div>
</template>
<script setup>
import {ref, reactive, onMounted} from 'vue';
import Swal from 'sweetalert2'
const data = reactive({
    logo:"",
    res_name:'',
    res_email:'',
    res_number:'',
    res_fb:'',
    res_instagram:'',
    res_twitter:'',
    res_password:'',
});
const previewImage = ref('');
const errors = ref([]);
const image = ref('');
const uploadFile = (e) => {
    const file = e.target.files[0];
    previewImage.value = URL.createObjectURL(file);
    data.logo = file;

};
const add = async () =>{
    try {
        const formData = new FormData();
        formData.append('details', JSON.stringify(data));
        formData.append('logo', data.logo);
        const res = await axios.post('/api/admin/setting',formData);
        show();
        image.value.value = '';
        previewImage.value = '';
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Updated Successfully!',
            showConfirmButton: false,
            timer: 1500
        })
    } catch (error) {

    }
}
const show = async () =>{
    try {
        const res = await axios.get('/api/admin/setting/show');
        data.res_name = res.data.res_name;
        data.res_email = res.data.res_email;
        data.res_number = res.data.res_number;
        data.res_fb = res.data.res_fb;
        data.res_twitter = res.data.res_twitter;
        data.res_instagram = res.data.res_instagram;
    } catch (error) {

    }
}
onMounted(()=>{
    show();
})
</script>
