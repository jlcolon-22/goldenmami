<template>
    <section class="px-10 py-16 ">

        <!-- modal add -->
        <div v-show="addModal"
            class="add-modal absolute top-0 left-0 w-full h-screen z-20 bg-[#0005] flex justify-center items-center transition-all ease-in-out">
            <form @submit.prevent="add" class="bg-white shadow rounded min-w-[70%] h-fit " enctype="multipart/form-data">
                <div class="bg-[#ebb700] flex justify-between items-center px-2">
                    <h1 v-if="!updateButton" class="text-lg font-bold font-inter p-2 text-gray-200 ">ADD MENU</h1>
                    <h1 v-else class="text-lg font-bold font-inter p-2 text-gray-200 ">UPDATE MENU</h1>
                    <a role="button" @click="addButton" class="hover:opacity-70 cursor-pointer"><img
                            src="/svg/exit.svg" alt=""></a>
                </div>
                <div class="p-5 flex justify-between gap-10">
                    <div class="w-[300px]">
                        <div class="border-2 mb-2 border-gray-500 border-dashed py-7 px-4 flex justify-center items-center">
                            <label for="image" class="bg-blue-500 px-2 py-1 text-center text-white">Upload a file</label>
                            <input type="file" ref="image" @change="uploadFile" id="image"
                                class="py-2 px-4 bg-gray-200 rounded w-full font-inter hidden">
                        </div>
                        <small v-if="errors.photo" class="text-red-600 font-inter">{{ errors.photo[0] }}</small>
                        <img v-if="previewImage != ''" :src="previewImage" class="mt-2 w-full h-[150px]" alt="">
                    </div>
                    <div class=" grid grid-cols-1 gap-3 w-full">
                        <div>
                            <label for="">Name</label>
                            <input type="text" v-model="data.name"
                                class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter"
                                placeholder="Product name">
                                <small v-if="errors.name" class="text-red-600 font-inter">{{ errors.name[0] }}</small>
                        </div>
                        <div>
                            <label for="">Price</label>
                            <input type="text" v-model="data.price"
                                class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter" placeholder="76">
                                <small v-if="errors.price" class="text-red-600 font-inter">{{ errors.price[0] }}</small>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label for="">Status</label>
                                <select v-model="data.status"
                                    class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter">
                                    <option value="">Choose..</option>
                                    <option value="0" class="font-inter">Active</option>
                                    <option value="1" class="font-inter">Not active</option>
                                </select>
                                <small v-if="errors.status" class="text-red-600 font-inter">{{ errors.status[0] }}</small>
                            </div>
                            <div>
                                <label for="">Category</label>
                                <select v-model="data.category"
                                    class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter">
                                    <option value="">Choose..</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id" class="font-inter">{{ category.name }}</option>

                                </select>
                                <small v-if="errors.category" class="text-red-600 font-inter">{{ errors.category[0] }}</small>
                            </div>
                        </div>
                        <div>
                            <label for="">Description</label>
                            <textarea v-model="data.description"
                                class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter"
                                placeholder="Meat, Potatoes, Rice, Tomatoe"></textarea>
                                <small v-if="errors.description" class="text-red-600 font-inter">{{ errors.description[0] }}</small>
                        </div>
                        <div>
                            <button v-if="!updateButton" type="submit"
                                class="py-2 px-4 bg-green-700 text-gray-100 font-normal hover:opacity-70 rounded w-full inline-block font-inter">ADD
                                PRODUCT</button>
                            <div>
                                <button v-if="updateButton" type="submit"
                                class="py-2 px-4 bg-green-700 text-gray-100 font-normal hover:opacity-70 rounded w-full inline-block font-inter mb-2">UPDATE
                                PRODUCT</button>
                                <button v-if="updateButton" @click="addButton"
                                class="py-2 px-4 bg-red-700 text-gray-100 font-normal hover:opacity-70 rounded w-full inline-block font-inter">CANCEL</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>



        <div class="py-2 flex justify-between">
            <button @click="addButton()"
                class="py-2 px-4 transition-all ease-in-out hover:opacity-70  bg-green-700 rounded text-[#fff] text-xs font-inter font-bold">ADD</button>
            <form @submit.prevent="searching">
                <input type="search" class="py-2 px-4 bg-gray-300 rounded w-[200px]" v-model="search" placeholder="search">
            </form>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 z-0">
                <thead class="text-xs text-gray-50 uppercase bg-[#ebb700] ">
                    <tr>
                        <th scope="col" class="px-6 py-3  font-inter">
                            NAME
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            IMAGE
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            PRICE
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            DESCRIPTION
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            STATUS
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            CATEGORY
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            Tools
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b " v-for="menu in allData.data" :key="menu.id">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                            {{ menu.name }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                            <img :src="'/storage/menu/'+menu.photo" class="w-[50px] h-[50px]" alt="">
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                            {{ menu.price }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                            {{ menu.description }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                            <span v-if="menu.status == 0" class="px-4 py-2 text-xs bg-emerald-400 text-gray-50 font-bold font-inter">ACTIVE</span>
                            <span v-else class="px-4 py-2 text-xs bg-red-500 text-gray-50 font-bold font-inter">NOT ACTIVE</span>
                        </th>
                        <th scope="row" class="px-6 py-4  font-bold whitespace-nowrap   font-inter text-violet-700">
                            {{ menu.category_menu ? menu.category_menu.name : '' }}
                        </th>
                        <td class="px-6 py-4  font-inter">
                            <button @click="destroy(menu.id)"
                                class="bg-red-300 text-red-800 px-4 py-2 font-bold text-sm font-inter hover:text-red-500 rounded inline-block mr-2">Delete</button>
                            <button @click="show(menu.id)"
                                class="bg-green-300 inline-block text-green-800 px-4 py-2 font-bold text-sm font-inter hover:text-green-500 rounded">Update</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="py-3">
                <paginate
                    :active-class="'text-blue-600 border border-gray-300 bg-blue-200 font-bold'"
                    :page-count="pageCount"
                    :page-range="perPage"
                    :margin-pages="2"
                    :click-handler="fetch"
                    :prev-text="'Prev'"
                    :next-text="'Next'"
                    disabled-class="opacity-50 disabled outline-none"
                    :container-class="'inline-flex -space-x-px'"
                    prev-class="px-3 py-2 cursor-pointer ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700"
                    next-class="px-3 py-2 cursor-pointer leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700"
                    page-class="px-3 cursor-pointer py-2 leading-tight text-gray-500  border border-gray-300 hover:bg-gray-100 hover:text-gray-700"


                >
                </paginate>
            </div>
        </div>

    </section>
</template>
<script setup>

import { ref, reactive, inject, onMounted } from 'vue';
import Swal from 'sweetalert2'
import Paginate from 'vuejs-paginate-next';
const addModal = ref(false);
const updateButton = ref(false);
const previewImage = ref('');
const categories = ref([]);
const errors = ref([]);
const allData = ref([]);
const image = ref('');
const ids = ref('');
const search = ref('');
const page = ref(1);
const pageCount = ref(0);
const perPage = ref(null);
const searching = async () =>{
        if(search.value == '')
        {
            fetch();
        }else{
            const res = await axios.post('/api/admin/menu/search',{search: search.value});
            allData.value = res.data;
            pageCount.value = res.data.last_page;
            page.value = res.data.current_page;
            perPage.value = res.data.per_page;
        }
}
function addButton(){
    addModal.value = !addModal.value;

    if(updateButton.value == true)
    {
        updateButton.value = false;
        data.name = '';
                data.price = '';
                data.status = '';
                data.category = '';
                data.description = '';
                data.photo = '';
                image.value.value = '';
                errors.value = [];
                previewImage.value = '';
    }
}
const data = reactive({
    name: '',
    price: '',
    status: '',
    category: '',
    description: '',
    photo: '',
})
const uploadFile = (e) => {
    const file = e.target.files[0];
    previewImage.value = URL.createObjectURL(file);
    data.photo = file;
};
const add = async () => {


    if(updateButton.value)
    {
        let updateFormData = new FormData();
        updateFormData.append('photo', data.photo);
        updateFormData.append('name', data.name);
        updateFormData.append('price', data.price);
        updateFormData.append('status', data.status);
        updateFormData.append('category', data.category);
        updateFormData.append('description', data.description);

        await axios.post('/api/admin/menu/'+ids.value,updateFormData )
                    .then(res =>{
                        console.log(res.data)
                        errors.value = [];
                        Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                        })
                        fetch()
                    }).catch(err =>{
                        errors.value = err.response.data.errors;
                    });
    }else{
        const config = {

headers: { 'content-type': 'multipart/form-data' }

}
let formData = new FormData();
formData.append('photo', data.photo);
formData.append('name', data.name);
formData.append('price', data.price);
formData.append('status', data.status);
formData.append('category', data.category);
formData.append('description', data.description);
await axios.post('/api/admin/menu', formData, config)
.then(res => {
    if(res.status == 200)
    {
        data.name = '';
        data.price = '';
        data.status = '';
        data.category = '';
        data.description = '';
        data.photo = '';
        image.value.value = '';
        errors.value = [];
        previewImage.value = '';
        fetch();
        addModal.value = false;
        Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1500
        })
    }
}).catch(err =>{

    errors.value = err.response.data.errors;
})
    }
}
const fetch = async (pageNum) =>{
    const res = await axios.get('/api/admin/menu/all?page='+pageNum);
    allData.value = res.data;
    pageCount.value = res.data.last_page;
    page.value = res.data.current_page;
    perPage.value = res.data.per_page;

}
const category = async () =>{
    const res = await axios.get('/api/admin/menu/category/global');
    categories.value = res.data;
}
const show = async (id) =>{
    addModal.value = true;
    updateButton.value = true;
    const x = allData.value.data.filter((value)=>{
        return value.id == id;
    });
    data.name = x[0].name;
    data.price = x[0].price;
    data.status = x[0].status;
    data.category = x[0].category_id;
    data.description = x[0].description;
    previewImage.value = '/storage/menu/'+x[0].photo;
    ids.value = id;
}
const destroy = (id) =>{
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            axios.delete('/api/admin/menu/delete/'+id).then(res =>{
                fetch()
                Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
            });


        }
        })

}
onMounted(() =>{
    fetch();
});
category()
</script>

<style scoped>

</style>
