<template>
    <div class="">
        <div class="grid grid-cols-2 gap-5 p-10">

            <form @submit.prevent="add" class="bg-white shadow p-6">
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium  font-inter">Name</label>
                    <input type="text" id="name" v-model="data.name"
                        class="bg-gray-50 border  font-inter border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Mami" required>
                        <small class="font-inter text-red-600" v-if="errors.name">{{ errors.name[0] }}</small>
                </div>

                <button v-if="!updateButton"  type="submit"
                    class="text-white bg-green-700  font-inter hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">ADD</button>
                <div>
                    <button v-if="updateButton" type="submit"
                    class="text-white bg-green-700  font-inter hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto mr-2 px-5 py-2.5 text-center ">UPDATE</button>
                    <button v-if="updateButton"  @click="cancel()"
                    class="text-white bg-red-700  font-inter hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">CANCEL</button>
                </div>

            </form>

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 z-0">
                    <thead class="text-xs text-gray-50 uppercase bg-[#ebb700] ">
                        <tr>
                            <th scope="col" class="px-6 py-3  font-inter">
                                Product name
                            </th>

                            <th scope="col" class="px-6 py-3  font-inter">
                                Tools
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="category in allData" :key="category.id" class="bg-white border-b ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                                {{ category.name }}
                            </th>

                            <td class="px-6 py-4  font-inter">
                                <button @click="destroy(category.id)"
                                    class="bg-red-300 text-red-800 px-2 py-1 font-bold text-sm font-inter hover:text-red-700 rounded inline-block mr-2">Delete</button>
                                <button @click="show(category.id)"
                                    class="bg-green-300 inline-block text-green-800 px-2 py-1 font-bold text-sm font-inter hover:text-green-700 rounded">Update</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, reactive } from 'vue';
const data = reactive({
    name: ''
});
const updateButton = ref(false);
const allData = ref([]);
const errors = ref([]);
const ids = ref('');
const add = async () => {
  if(updateButton.value)
  {
    const res = await axios.put('/api/admin/menu/category/'+ids.value,data);
    fetch();
    cancel();
  }else{
        await axios.post('/api/admin/menu/category', data).then(res =>{
                fetch();
                data.name = '';
                errors.value = [];
        }).catch(err =>{
            errors.value = err.response.data.errors;
        })

  }

}
function cancel()
{
    data.name = '';
    updateButton.value = false;
}
const fetch = async () => {
    const res = await axios.get('/api/admin/menu/category/all');
    allData.value = res.data.data;
}
const destroy = async (id) => {
    const res = await axios.delete('/api/admin/menu/category/' + id);
    fetch();
}
const show = (id) =>{
    const x = allData.value.filter((value) =>{
        return value.id == id;
    });
    data.name = x[0].name;
    updateButton.value = true;
    ids.value = id;
}
fetch();
</script>
