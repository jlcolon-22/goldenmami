<template>
    <section class="px-10 py-16 ">
        <div class="bg-[#000000ec] absolute top-0 left-0 w-full h-full z-20 p-6 overflow-x-auto" v-show="viewModal">
            <div class=" flex justify-between">
                <button class="bg-red-600 px-5 py-2 text-white mb-2 rounded" @click="viewModal = false">Close</button>
            <form @submit.prevent="searching">
                <input type="search" class="py-2 px-4 bg-gray-300 rounded w-[200px]" v-model="search" placeholder="search">
            </form>
        </div>

            <table class="w-full text-sm text-left text-gray-500 z-0 max-h-[90%] ">

                <thead class="text-xs text-gray-50 uppercase bg-[#ebb700] ">
                    <tr>
                        <th scope="col" class="px-6 py-3  font-inter">
                            ITEM NAME
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            ITEM CATEGORY
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            QUANTITY
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                           UNIT
                        </th>
                        <!-- <th scope="col" class="px-6 py-3  font-inter">
                            STATUS
                        </th> -->
                        <th scope="col" class="px-6 py-3  font-inter">
                            EXPIRATION DATE
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            Tools
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b " v-for="item in allData" :key="item.id">

                        <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap   font-inter">
                            {{ item.item_name }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                            <span class="font-inter" v-if="item.item_category">{{ item.item_category.name }}</span>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                            {{ item.quantity }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap   font-inter ">
                            <span class="text-gray-500 font-inter" v-if="!!item.unit">{{ item.unit }}</span>
                            <span class="text-gray-500 font-inter" v-else>0</span>
                        </th>
                        <!-- <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                            <span class="flex  font-inter" v-if="item.status == 0"><img src="/svg/circle-green.svg" alt="">Surplus</span>
                            <span class="flex  font-inter" v-else><img src="/svg/circle-red.svg" alt="">Critical</span>
                        </th> -->
                        <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap   font-inter ">
                            {{ item.expiration_date }}
                        </th>
                        <td class="px-6 py-4  font-inter">

                            <button @click="destroy(item.id)"
                                class=" px-1 py-2 font-bold text-sm font-inter hover:opacity-80 rounded inline-block mr-2"><img src="/svg/delete.svg" alt=""></button>

                            <button @click="edit(item.id)"
                                class="inline-block px-1 py-2 font-bold text-sm font-inter hover:opacity-80 rounded"><img src="/svg/edit.svg" alt=""/></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="py-3 bg-white px-1">
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
        <!-- modal add -->
        <div v-show="addModal"
            class="add-modal absolute top-0 left-0 w-full h-screen z-40 bg-[#0005] flex justify-center items-center transition-all ease-in-out">
            <form @submit.prevent="add" class="bg-white shadow rounded min-w-[500px] h-fit " style="max-width: 300px"
                enctype="multipart/form-data">
                <div class="bg-[#ebb700] flex justify-between items-center px-2">
                    <h1 v-if="!updateButton" class="text-lg font-bold font-inter p-2 text-gray-200 ">ADD ITEM</h1>
                    <h1 v-else class="text-lg font-bold font-inter p-2 text-gray-200 ">UPDATE ITEM</h1>
                    <a role="button" @click="addButton" class="hover:opacity-70 cursor-pointer"><img src="/svg/exit.svg"
                            alt=""></a>
                </div>
                <div class="p-5 flex justify-between gap-10">
                    <div class=" grid grid-cols-1 gap-3 w-full">

                        <div>
                            <label>Item name</label>
                            <input type="text" v-model="data.item_name"
                                class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter" placeholder="Sugar">
                            <small v-if="errors.item_name" class="text-red-600 font-inter">{{ errors.item_name[0]
                            }}</small>
                        </div>



                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label>Item Category</label>
                                <select v-model="data.item_category"
                                    class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter">
                                    <option value="">Choose..</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id" class="font-inter">{{ category.name }}</option>

                                </select>
                                <small v-if="errors.item_category" class="text-red-600 font-inter">{{
                                    errors.item_category[0] }}</small>
                            </div>
                            <div>
                                <label>Quantity</label>
                                <input type="number" v-model="data.quantity"
                                    class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter"
                                    placeholder="23">
                                <small v-if="errors.password" class="text-red-600 font-inter">{{ errors.password[0]
                                }}</small>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label>Unit</label>
                                <input type="text" v-model="data.unit"
                                    class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter"
                                    placeholder="0">
                                <small v-if="errors.unit" class="text-red-600 font-inter">{{
                                    errors.unit[0] }}</small>
                            </div>
                            <div>
                                <label>Expiration Date</label>
                                <input type="date" v-model="data.expiration_date"
                                    class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter"
                                    placeholder="0">
                                <small v-if="errors.expiration_date" class="text-red-600 font-inter">{{
                                    errors.expiration_date[0] }}</small>
                            </div>
                        </div>

                        <div>
                            <button type="submit" v-if="!updateButton"
                                class="py-3 px-6 bg-green-700 text-gray-100 font-normal hover:opacity-70 rounded w-full inline-block font-inter">ADD
                                ITEM</button>
                            <div>
                                <button v-if="updateButton" type="submit"
                                    class="py-2 px-4 bg-green-700 text-gray-100 font-normal hover:opacity-70 rounded w-full inline-block font-inter mb-2">UPDATE
                                    ITEM</button>
                                <button v-if="updateButton" @click="addButton"
                                    class="py-2 px-4 bg-red-700 text-gray-100 font-normal hover:opacity-70 rounded w-full inline-block font-inter">CANCEL</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>



        <div class="py-2 flex justify-between">
            <button @click="addButton"
                class="py-2 px-4 transition-all ease-in-out hover:opacity-70  bg-green-700 rounded text-[#fff] text-xs font-inter font-bold">ADD</button>
            <!-- <form @submit.prevent="searching">
                <input type="search" class="py-2 px-4 bg-gray-300 rounded w-[200px]" v-model="search" placeholder="search">
            </form> -->
        </div>
        <div class="relative overflow-x-auto z-0">
            <table class="w-full text-sm text-left text-gray-500 z-0">
                <thead class="text-xs text-gray-50 uppercase bg-[#ebb700] ">
                    <tr>
                        <th scope="col" class="px-6 py-3  font-inter">
                            ITEM CATEGORY
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            QUANTITY
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                           UNIT
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            STATUS
                        </th>

                        <th scope="col" class="px-6 py-3  font-inter">
                            Tools
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b " v-for="(item,index) in allDataCat" :key="index">

                        <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap   font-inter">
                            {{ item[0][0].item_category.name }}

                        </th>
                        <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap   font-inter">
                            {{ item[0][1].count }}

                        </th>
                        <th scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap   font-inter">
                            {{ item[0][0].unit }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">

                            <span class="flex  font-inter" v-if="item[0][1].count > 10"><img src="/svg/circle-green.svg" alt="">Surplus</span>
                            <span class="flex  font-inter" v-else><img src="/svg/circle-red.svg" alt="">Critical</span>
                        </th>
                        <td class="px-6 py-4  font-inter">

                            <button @click="destroy(item[0][0].category_id)"
                                class="hover:opacity-80  px-1 py-2 font-bold text-sm font-inter rounded inline-block mr-2"><img src="/svg/delete.svg" alt=""></button>
                            <button @click="viewItem(item[0][0].category_id)"
                                class="inline-block  px-1 py-2 font-bold text-sm font-inter hover:opacity-80 rounded"><img src="/svg/view.svg" alt=""></button>

                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="py-3">
                <paginate
                    :active-class="'text-blue-600 border border-gray-300 bg-blue-200 font-bold'"
                    :page-count="pageCountCat"
                    :page-range="perPageCat"
                    :margin-pages="2"
                    :click-handler="fetchCat"
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
import { ref, reactive, onMounted } from 'vue';
import Swal from 'sweetalert2'
import Paginate from 'vuejs-paginate-next';
import parseJson from 'parse-json';
const addModal = ref(false);
const viewModal = ref(false);
const data = reactive({
    branch_id: 2,
    item_name: '',
    item_category: '',
    quantity: '',
    unit: '',
    status: 0,
    expiration_date: '',

});
const updateButton = ref(false)
const errors = ref([]);
const allData = ref([]);
const allDataCat = ref([]);
const categories = ref([]);
const ids = ref('');
const page = ref(1);
const pageCount = ref(null);
const perPage = ref(null);
const pageCat = ref(1);
const pageCountCat = ref(null);
const perPageCat = ref(null);
const search = ref('');
const cat_id = ref(null);
const searching = async () => {
    if (search.value == '') {
        fetchCat();
    } else {
        const res = await axios.post('/api/admin/inventory/dagupan/search', { search: search.value,catid: cat_id.value });
        allData.value = res.data.data;
    pageCount.value = res.data.last_page;
    page.value = res.data.current_page;
    perPage.value = res.data.per_page;
    }
}

function addButton() {
    addModal.value = !addModal.value;
    if (updateButton.value == true) {
        updateButton.value = false;

        clear();
    }
}
const add = async () => {

   try {
    if (updateButton.value) {
        const res = await axios.post('/api/admin/inventory/dagupan/update/' + ids.value, data);
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Updated Successfully!',
            showConfirmButton: false,
            timer: 1500
        })
        await addButton();

        fetchCat();
        fetch();

    } else {

        const res = await axios.post('/api/admin/inventory/dagupan/add', data)
        console.log(res.data)
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
            })
            addButton();
            clear();
            fetchCat();
            fetch();

    }

   } catch (err) {
        errors.value = err.response.data.errors;
   }

}

const fetch = async (pageNum) => {

    const res = await axios.get('/api/admin/inventory/dagupan/all?page=' + pageNum+'&catid='+cat_id.value);
    allData.value = res.data.data;
    pageCount.value = res.data.last_page;
    page.value = res.data.current_page;
    perPage.value = res.data.per_page;

}
const fetchCat = async (pageNum) =>{

    const res = await axios.get('/api/admin/inventory/dagupan/all/cat?page=' + pageNum);

    var result = [];
    var keys = Object.keys(res.data.data);
    keys.forEach(function(key){



        var sum = 0;

        res.data.data[key].forEach(value => {
           sum += parseInt(value.quantity);

            });
        var y = res.data.data[key].map(value=>{
            var x = [value,{count:sum}];
            return x;
        })
        result.push(y)

    });
    allDataCat.value = result.reverse()

    pageCountCat.value = res.data.last_page;
    pageCat.value = res.data.current_page;
    perPageCat.value = res.data.per_page;
}
onMounted(() => {
    // fetch();
    fetchCat();
    allcategories();
})
const allcategories = async () => {
    const res = await axios.get('/api/admin/inventory/category/global');
    categories.value = res.data;

}
const edit = async (id) => {
    updateButton.value = true;
    addModal.value = true;
    const datas = allData.value.filter((value) => {
        return value.id == id;
    });
    data.item_name = datas[0].item_name;
    data.item_category = datas[0].category_id;
    data.quantity = datas[0].quantity;
    data.unit = datas[0].unit;
    data.status = datas[0].status;
    data.expiration_date = datas[0].expiration_date;

    ids.value = id;
}

const destroy = (id) => {
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
            axios.delete('/api/admin/inventory/dagupan/delete/' + id).then(res => {
                fetchCat();
                fetch();
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            });


        }
    })

}
const clear = () => {
   data.item_category = 1;
   data.item_name = '';
   data.quantity = '';
   data.unit = '';
   data.status = '';
   data.expiration_date = '';
}


// ###################### category ####################
const viewItem = (ids) =>{
    cat_id.value = ids;
    fetch();

   setTimeout(()=>{

    viewModal.value = true;
   },400)

}
</script>
