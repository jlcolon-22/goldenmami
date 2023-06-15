<template>
    <div>
        <div class="grid grid-cols-2 gap-5 p-10">

            <form @submit.prevent="add" class="bg-white shadow h-fit">
                <div class="bg-green-600 flex justify-between items-center px-2">
                    <h1 v-if="!updateButton" class="text-lg font-bold font-inter p-2 text-gray-200 ">ADD EMPLOYEE TYPE</h1>
                    <h1 v-else class="text-lg font-bold font-inter p-2 text-gray-200 ">EMPLOYEE TYPE</h1>

                </div>
                <div class="mb-6  px-6 " style="padding-top: 24px;">
                    <label for="name" class="block mb-2 text-sm font-medium  font-inter">Name</label>
                    <input type="text" id="name" v-model="data.name"
                        class="bg-gray-50 border  font-inter border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Mami" >
                        <small class="font-inter text-red-600" v-if="errors.name">{{ errors.name[0] }}</small>
                </div>

                <div class="px-6" style="padding-bottom: 24px;">
                    <button v-if="!updateButton"  type="submit"
                    class="text-white bg-green-700  font-inter hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">ADD</button>
                <div>
                    <button v-if="updateButton" type="submit"
                    class="text-white bg-green-700  font-inter hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto mr-2 px-5 py-2.5 text-center ">UPDATE</button>
                    <button v-if="updateButton"  @click="cancel()"
                    class="text-white bg-red-700  font-inter hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">CANCEL</button>
                </div>
                </div>

            </form>

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 z-0">
                    <thead class="text-xs text-gray-50 uppercase bg-[#ebb700] ">
                        <tr>
                            <th scope="col" class="px-6 py-3  font-inter">
                                Name
                            </th>

                            <th scope="col" class="px-6 py-3  font-inter">
                                Tools
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="type in allData.data" :key="type.id" class="bg-white border-b ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                                {{ type.name }}
                            </th>

                            <td class="px-6 py-4  font-inter">
                                <button @click="destroy(type.id)"
                                    class="bg-red-300 text-red-800 px-2 py-1 font-bold text-sm font-inter hover:text-red-700 rounded inline-block mr-2">Delete</button>
                                <button @click="edit(type.id)"
                                    class="bg-green-300 inline-block text-green-800 px-2 py-1 font-bold text-sm font-inter hover:text-green-700 rounded">Update</button>
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
        </div>
    </div>
</template>
<script setup>
import axios from 'axios';
import  {ref,reactive, onMounted} from 'vue';
import Swal from 'sweetalert2'
import Paginate from 'vuejs-paginate-next';
const data = reactive({
    name:''
})
const page = ref(1);
const pageCount = ref(null);
const perPage = ref(null);
const updateButton = ref(false);
const allData = ref([]);
const errors = ref([])
const ids = ref('');
const add = async () =>{
    try {
        if(updateButton.value)
        {
            const res = await axios.post('/api/admin/employee/type/update/'+ids.value,data);
            fetch();
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Updated Successfully!',
                showConfirmButton: false,
                timer: 1500
            })
            updateButton.value = false;
            data.name = '';

        }else{
            const res = await axios.post('/api/admin/employee/type/add',data);
            fetch();
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Created Successfully!',
                showConfirmButton: false,
                timer: 1500
            })
            data.name = '';
            }
    } catch (err) {
        errors.value = err.response.data.errors;
    }
}

const fetch = async (pageNum) =>{
    try {
        const res = await axios.get('/api/admin/employee/types?page='+pageNum);
        allData.value = res.data;
        pageCount.value = res.data.last_page;
        page.value = res.data.current_page;
        perPage.value = res.data.per_page;
    } catch (error) {

    }
}
const edit = (id) =>{
    updateButton.value = true;
    const res = allData.value.data.filter((value)=>{
        return value.id == id;
    });

    data.name = res[0].name;
    ids.value = id;
}
const destroy = async (id) =>{
    try {
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
            axios.delete('/api/admin/employee/type/delete/'+id).then(res =>{
                fetch()
                Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
            });


        }
        })


    } catch (error) {

    }
}
function cancel(){
    data.name = '';
    updateButton.value = false;
    errors.value = [];
}
onMounted(()=>{
    fetch()
})
</script>

