<template>
    <section class="px-10 py-16 ">




        <div class="py-2 flex justify-between">

                <input type="date" class="py-2 px-4 bg-gray-300 rounded w-[200px]" @change="searching()" placeholder="search">
                <div class="flex items-center gap-2">
                <button @click="viewBranch(3)"
                class="py-2 px-4 transition-all ease-in-out hover:opacity-70  bg-green-700 rounded text-[#fff] text-xs font-inter font-bold">ALL</button>
                <button @click="viewBranch(0)"
                class="py-2 px-4 transition-all ease-in-out hover:opacity-70  bg-green-700 rounded text-[#fff] text-xs font-inter font-bold">Calasiao</button>
                <button @click="viewBranch(1)"
                class="py-2 px-4 transition-all ease-in-out hover:opacity-70  bg-green-700 rounded text-[#fff] text-xs font-inter font-bold">Dagupan</button>
                <button @click="viewBranch(2)"
                class="py-2 px-4 transition-all ease-in-out hover:opacity-70  bg-green-700 rounded text-[#fff] text-xs font-inter font-bold">Lingayen</button>

            </div>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 z-0">
                <thead class="text-xs text-gray-50 uppercase bg-[#ebb700] ">
                    <tr>
                        <th scope="col" class="px-6 py-3  font-inter">
                            DATE
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            FULLNAME
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            BRANCH
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            TIME IN
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            TIME OUT
                        </th>
                        <!-- <th scope="col" class="px-6 py-3  font-inter">
                            Tools
                        </th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b " v-for="attendance in allData.data" :key="attendance.id">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                           {{ attendance.created_at }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                           {{ attendance.attendance_employee.firstname+' '+attendance.attendance_employee.lastname }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                            <span v-if="attendance.attendance_employee.branch == 0"
                                class="bg-yellow-400 p-2 rounded text-white text-xs font-inter">CALASIAO</span>
                            <span v-if="attendance.attendance_employee.branch == 1"
                                class="bg-blue-400 p-2 rounded text-white text-xs font-inter">DAGUPAN</span>
                            <span v-if="attendance.attendance_employee.branch == 2"
                                class="bg-red-400 p-2 rounded text-white text-xs font-inter">LINGAYEN</span>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                            {{  !!attendance.time_in ? attendance.time_in.split(' ')[1] : '' }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                            {{ !!attendance.time_out ? attendance.time_out.split(' ')[1] : '' }}
                        </th>
                        <!-- <td class="px-6 py-4  font-inter">

                            <button @click="destroy(employee.id)"
                                class="bg-red-300 text-red-800 px-4 py-2 font-bold text-sm font-inter hover:text-red-500 rounded inline-block mr-2">Delete</button>
                            <button @click="edit(employee.id)"
                                class="bg-green-300 inline-block text-green-800 px-4 py-2 font-bold text-sm font-inter hover:text-green-500 rounded">Update</button>
                        </td> -->
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
import { ref, reactive, onMounted } from 'vue';
import Swal from 'sweetalert2'
import Paginate from 'vuejs-paginate-next';
const addModal = ref(false);
const viewModal = ref(false);
const data = reactive({
    photo: '',
    firstname: '',
    lastname: '',
    email: '',
    address: '',
    number: '',
    age: '',
    gender: '',
    type: '',
    password: ''
});
const updateButton = ref(false)
const errors = ref([]);
const image = ref('');
const previewImage = ref('');
const allData = ref([]);
const types = ref([]);
const ids = ref('');
const page = ref(1);
const pageCount = ref(null);
const perPage = ref(null);
const search = ref('');
const searching = async () =>{
        if(event.target.value == '')
        {
            fetch();
        }else{
            const res = await axios.get('/api/admin/employee/attendance?s='+event.target.value);
            allData.value = res.data;
            pageCount.value = res.data.last_page;
            page.value = res.data.current_page;
            perPage.value = res.data.per_page;
        }
}

function addButton() {
    addModal.value = !addModal.value;
    viewModal.value = false;
    if (updateButton.value == true) {
        updateButton.value = false;

        clear();
    }
}
const viewBranch = async (id) =>{
            if(id == 3)
            {
                fetch();
            }else{
                const res = await axios.get('/api/admin/employee/attendance/branch/search?branch='+id);
            allData.value = res.data;
            pageCount.value = res.data.last_page;
            page.value = res.data.current_page;
            perPage.value = res.data.per_page;
            }

}
const fetch = async (pageNum) => {
    const res = await axios.get('/api/admin/employee/attendance?page='+pageNum);
    allData.value = res.data;
    console.log(res.data)
    pageCount.value = res.data.last_page;
    page.value = res.data.current_page;
    perPage.value = res.data.per_page;

}
onMounted(() => {
    fetch();
    allType();
})
const allType = async () => {
    const res = await axios.get('/api/admin/employee/type/global');
    types.value = res.data;

}
const edit = async (id) => {
    updateButton.value = true;
    addModal.value = true;
    const datas = allData.value.data.filter((value) => {
        return value.id == id;
    });
    data.firstname = datas[0].firstname;
    data.lastname = datas[0].lastname;
    data.email = datas[0].email;
    data.address = datas[0].address;
    data.number = datas[0].number;
    data.age = datas[0].age;
    data.gender = datas[0].gender;
    data.type = datas[0].type_id;
    previewImage.value = '/storage/employee/'+datas[0].photo;
    ids.value = id;
}
const view = (id) =>{

    viewModal.value = true;
    const datas = allData.value.data.filter((value) => {
        return value.id == id;
    });
    data.firstname = datas[0].firstname;
    data.lastname = datas[0].lastname;
    data.email = datas[0].email;
    data.address = datas[0].address;
    data.number = datas[0].number;
    data.age = datas[0].age;
    data.gender = datas[0].gender;
    data.type = datas[0].employee_type.name;
    data.photo = '/storage/employee/'+datas[0].photo;

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
            axios.delete('/api/admin/employee/delete/'+id).then(res =>{
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
const clear = () => {
    data.firstname = '';
    data.lastname = '';
    data.email = '';
    data.address = '';
    data.photo = '';
    data.number = '';
    data.age = '';
    data.gender = '';
    data.type = '';
    data.password = '';
    image.value.value = '';
    errors.value = [];
    previewImage.value = '';
}
</script>
