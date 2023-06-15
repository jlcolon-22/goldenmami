<template>
    <div class="p-10 ">
        <form @submit.prevent="add()" class="shadow bg-[#fff] rounded p-5 grid grid-cols-1 gap-3">
            <div class="grid   gap-2 relative">

                <div class="border-2 mb-2 h-[150px] w-[250px] border-gray-500 border-dashed py-7 px-4 flex justify-center items-center">
                    <label for="image" class="bg-blue-500 px-2 py-1 z-30 text-center text-white">Change Logo</label>
                    <input type="file" id="image" ref="image" @change="uploadFile" class="py-2 px-4 bg-gray-200 rounded w-full font-inter hidden">

                </div>

              <small v-if="errors.logo" class="text-red-600 font-inter">{{ errors.logo[0] }}</small>
                <img v-if="previewImage != ''" :src="previewImage" class="w-[250px] h-[150px] absolute left-0 z-10"  alt="">
            </div>
            <div class="grid grid-cols-2 gap-x-3">
                <div>
                    <label class="font-inter">Firstname</label>
                <input type="text" v-model="data.firstname" class="bg-gray-200 font-inter px-4 py-2 w-full inline-block  rounded"
                    placeholder="Golden Mami ewqe">
                </div>
                <div>
                    <label class="font-inter">Lastname</label>
                    <input type="text" v-model="data.lastname" class="bg-gray-200 font-inter px-4 py-2 w-full inline-block  rounded"
                        placeholder="Golden Mami ewqe">
                </div>
            </div>
          <div class="grid grid-cols-2 gap-x-3">
            <div>
                <label class="font-inter">Email</label>
                <input type="email" v-model="data.email" class="bg-gray-200 font-inter px-4 py-2 w-full inline-block rounded"
                    placeholder="Golden Mami ewqe">
            </div>
            <div>
                <label class="font-inter">Phone Number</label>
                <input type="text" v-model="data.number" class="bg-gray-200 font-inter px-4 py-2 w-full inline-block rounded"
                    placeholder="Golden Mami ewqe" min="11">
            </div>
          </div>
          <div class="grid grid-cols-2 gap-x-3">
            <div>
                <label class="font-inter">Gender</label>
                <input type="text" disabled v-model="data.gender" class="bg-gray-400 opacity-50 font-inter px-4 py-2 w-full inline-block rounded"
                    placeholder="Golden Mami ewqe">
            </div>
            <div>
                <label class="font-inter">Age</label>
                <input type="text" disabled v-model="data.age" class="bg-gray-400 opacity-50 font-inter px-4 py-2 w-full inline-block rounded"
                    placeholder="Golden Mami ewqe" min="11">
            </div>
          </div>
          <div class="grid grid-cols-2 gap-x-3">
            <div>
                <label class="font-inter">Branch</label>
                <input type="text" disabled v-model="data.branch" class="bg-gray-400 opacity-50 font-inter px-4 py-2 w-full inline-block rounded"
                    placeholder="Golden Mami ewqe">
            </div>
            <div>
                <label class="font-inter">Type</label>
                <input type="text" disabled v-model="data.type" class="bg-gray-400 opacity-50 font-inter px-4 py-2 w-full inline-block rounded"
                    placeholder="Golden Mami ewqe" min="11">
            </div>
          </div>
          <div>
                <label class="font-inter">Password</label>
                <input type="password" v-model="data.password" class="bg-gray-200 font-inter px-4 py-2 w-full inline-block rounded"
                    placeholder="Golden Mami ewqe" min="11">
            </div>
            <div>
                <button type="submit" class="bg-green-400 font-inter px-4 py-2 w-full inline-block rounded">Change</button>

            </div>
        </form>
    </div>
</template>
<script setup>
import {ref, reactive, onMounted,defineProps} from 'vue';
import Swal from 'sweetalert2'
const props = defineProps({auth:Object});

const data = reactive({
    photo:"",
    firstname: props.auth.firstname,
    lastname:props.auth.lastname,
    email:props.auth.email,
    number:props.auth.number,
    branch:props.auth.branch == 0 ? 'Calasiao' : props.auth.branch == 1 ? 'Dagupan' : 'Lingayen' ,
    type:props.auth.employee_type.name,
    password:'',
    age:props.auth.age,
    gender:
    props.auth.gender == 0 ? 'Male' : 'Female' ,
});
console.log(props.auth)
const previewImage = ref('/storage/employee/'+props.auth.photo);
const errors = ref([]);
const image = ref('');
const uploadFile = (e) => {
    const file = e.target.files[0];
    previewImage.value = URL.createObjectURL(file);
    data.photo = file;

};
const add = async () =>{
    try {
        const formData = new FormData();
        formData.append('firstname',data.firstname);
        formData.append('lastname',data.lastname);
        formData.append('email',data.email);
        formData.append('number',data.number);
        formData.append('password',data.password);
        formData.append('photo', data.photo);
        const res = await axios.post(`/api/employee/setting/update/${props.auth.id}`,formData);

        image.value.value = '';
        previewImage.value = '';
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Updated Successfully!',
            showConfirmButton: false,
            timer: 1500
        })
        setTimeout(()=>{
            window.location.reload();
        },1300)
    } catch (error) {
        console.log(error)
    }
}

onMounted(()=>{
    // show();
})
</script>
