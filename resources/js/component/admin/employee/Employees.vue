<template>
    <section class="px-10 py-16 ">
        <!-- view modal -->
        <div v-show="viewModal"
            class="add-modal absolute top-0 left-0 w-full min-h-screen overflow-y-auto z-20 bg-[#0005] flex justify-center items-center transition-all ease-in-out">

            <div class="bg-[#fff] shadow rounded min-w-[70%]" style="max-width: 70%;">
                <div class="bg-sky-500 flex justify-between items-center px-2">
                    <h1  class="text-lg font-bold font-inter p-2 text-gray-200 ">EMPLOYEE INFORMATION</h1>
                    <a role="button" @click="closeView" class="hover:opacity-70 cursor-pointer"><img src="/svg/exit.svg"
                            alt=""></a>
                </div>
                <div class="p-5 flex justify-between items-start">
                    <div class="w-[300px]">
                        <img  :src="data.photo" class="mt-2 min-w-[300px] max-h-[300px] " alt="">
                    </div>

                    <div class="w-full  p-5">
                        <h1 class="font-inter text-lg font-bold">Fullname: <span class="font-inter font-normal text-base">{{ data.firstname+' '+data.lastname }}</span></h1>
                        <h1 class="font-inter text-lg font-bold">Email: <span class="font-inter font-normal text-base">{{ data.email }}</span></h1>
                        <h1 class="font-inter text-lg font-bold">Number: <span class="font-inter font-normal text-base">{{ data.number }}</span></h1>
                        <h1 class="font-inter text-lg font-bold">Gender: <span class="font-inter font-normal text-base">{{ data.gender == 0 ? 'Male' : 'Female' }}</span></h1>
                        <h1 class="font-inter text-lg font-bold">Age: <span class="font-inter font-normal text-base">{{ data.age }}</span></h1>
                        <h1 class="font-inter text-lg font-bold">Address: <span class="font-inter font-normal text-base">{{ data.address }}</span></h1>
                        <h1 class="font-inter text-lg font-bold mb-2">Branch:  <span v-if="data.branch  == 0" class="bg-yellow-400 p-2 rounded text-white text-xs font-inter">CALASIAO</span>
                            <span v-if="data.branch  == 1" class="bg-blue-400 p-2 rounded text-white text-xs font-inter">DAGUPAN</span>
                            <span v-if="data.branch  == 2" class="bg-red-400 p-2 rounded text-white text-xs font-inter">LINGAYEN</span></h1>
                        <h1 class="font-inter text-lg font-bold ">Type: <span class="bg-violet-400 p-2 rounded text-white text-xs font-inter">{{ data.type }}</span></h1>

                    </div>
                </div>
            </div>
        </div>
        <!-- modal add -->
        <div v-show="addModal"
            class="add-modal absolute top-0 left-0 w-full min-h-screen overflow-y-auto z-20 bg-[#0005] flex justify-center items-center transition-all ease-in-out py-10">
            <form @submit.prevent="add" class="bg-white shadow rounded min-w-[70%] h-fit " style="max-width: 70%"
                enctype="multipart/form-data">
                <div class="bg-[#ebb700] flex justify-between items-center px-2">
                    <h1 v-if="!updateButton" class="text-lg font-bold font-inter p-2 text-gray-200 ">ADD MENU</h1>
                    <h1 v-else class="text-lg font-bold font-inter p-2 text-gray-200 ">UPDATE MENU</h1>
                    <a role="button" @click="addButton" class="hover:opacity-70 cursor-pointer"><img src="/svg/exit.svg"
                            alt=""></a>
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
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label>Firstname</label>
                                <input type="text" v-model="data.firstname"
                                    class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter"
                                    placeholder="ex: Leni">
                                <small v-if="errors.firstname" class="text-red-600 font-inter">{{ errors.firstname[0]
                                }}</small>
                            </div>
                            <div>
                                <label>Lastname</label>
                                <input type="text" v-model="data.lastname"
                                    class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter"
                                    placeholder="ex: marcos">
                                <small v-if="errors.lastname" class="text-red-600 font-inter">{{ errors.lastname[0]
                                }}</small>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                            <label>Email</label>
                            <input type="email" v-model="data.email"
                                class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter"
                                placeholder="example@gmail.com">
                            <small v-if="errors.email" class="text-red-600 font-inter">{{ errors.email[0] }}</small>
                            </div>
                            <div>
                                <label>Branch</label>
                                <select v-model="data.branch"
                                    class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter">
                                    <option value="">Choose..</option>
                                    <option value="0" class="font-inter">Calasiao</option>
                                    <option value="1" class="font-inter">Dagupan</option>
                                    <option value="2" class="font-inter">Lingayen</option>
                                </select>
                                <small v-if="errors.branch" class="text-red-600 font-inter">{{ errors.branch[0] }}</small>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label>Phone Number</label>
                                <input type="tel" v-model="data.number"
                                    class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter"
                                    placeholder="092102313**">
                                <small v-if="errors.number" class="text-red-600 font-inter">{{ errors.number[0] }}</small>
                            </div>
                            <div>
                                <label>Age</label>
                                <input type="number" v-model="data.age"
                                    class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter" placeholder="22">
                                <small v-if="errors.age" class="text-red-600 font-inter">{{ errors.age[0] }}</small>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label>Gender</label>
                                <select v-model="data.gender"
                                    class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter">
                                    <option value="">Choose..</option>
                                    <option value="0" class="font-inter">Male</option>
                                    <option value="1" class="font-inter">Female</option>
                                </select>
                                <small v-if="errors.gender" class="text-red-600 font-inter">{{ errors.gender[0] }}</small>
                            </div>
                            <div>
                                <label>Type</label>
                                <select v-model="data.type"
                                    class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter">
                                    <option value="" selected>Choose..</option>
                                    <option v-for="value in types" :key="value.id" :value="value.id" class="font-inter">{{
                                        value.name }}</option>

                                </select>
                                <small v-if="errors.type" class="text-red-600 font-inter">{{ errors.type[0] }}</small>
                            </div>
                        </div>
                        <div>
                            <label>Password</label>
                            <input type="password" v-model="data.password"
                                class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter"
                                placeholder="************">
                            <small v-if="errors.password" class="text-red-600 font-inter">{{ errors.password[0] }}</small>
                        </div>
                        <div>
                            <label>Address</label>
                            <textarea v-model="data.address"
                                class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter"
                                placeholder="Complete address"></textarea>
                            <small v-if="errors.address" class="text-red-600 font-inter">{{ errors.address[0] }}</small>
                        </div>
                        <div>
                            <button type="submit" v-if="!updateButton"
                                class="py-3 px-6 bg-green-700 text-gray-100 font-normal hover:opacity-70 rounded w-full inline-block font-inter">ADD
                                EMPLOYEE</button>
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
            <div>
                <button @click="addButton"
                class="py-2 px-4 transition-all ease-in-out hover:opacity-70  bg-green-700 rounded text-[#fff] text-xs font-inter font-bold">ADD</button>

            </div>
            <div class="flex items-center gap-2">
                <button @click="viewBranch(3)"
                class="py-2 px-4 transition-all ease-in-out hover:opacity-70  bg-green-700 rounded text-[#fff] text-xs font-inter font-bold">ALL</button>
                <button @click="viewBranch(0)"
                class="py-2 px-4 transition-all ease-in-out hover:opacity-70  bg-green-700 rounded text-[#fff] text-xs font-inter font-bold">Calasiao</button>
                <button @click="viewBranch(1)"
                class="py-2 px-4 transition-all ease-in-out hover:opacity-70  bg-green-700 rounded text-[#fff] text-xs font-inter font-bold">Dagupan</button>
                <button @click="viewBranch(2)"
                class="py-2 px-4 transition-all ease-in-out hover:opacity-70  bg-green-700 rounded text-[#fff] text-xs font-inter font-bold">Lingayen</button>
                <form @submit.prevent="searching">
                <input type="search" class="py-2 px-4 bg-gray-300 rounded w-[200px]" v-model="search" placeholder="search">
                 </form>
            </div>

        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 z-0">
                <thead class="text-xs text-gray-50 uppercase bg-[#ebb700] ">
                    <tr>
                        <th scope="col" class="px-6 py-3  font-inter">
                            IMAGE
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            FULLNAME
                        </th>

                        <th scope="col" class="px-6 py-3  font-inter">
                            EMAIL
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            Branch
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            TYPE
                        </th>
                        <th scope="col" class="px-6 py-3  font-inter">
                            Tools
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b " v-for="employee in allData.data" :key="employee.id">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                            <img v-if="!!employee.photo" :src="'/storage/employee/' + employee.photo" class="w-[50px] h-[50px]" alt="">
                            <img v-else :src="'https://eu.ui-avatars.com/api/?background=random&name='+employee.firstname+' '+employee.lastname" class="w-[50px] h-[50px]" alt="">

                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                            {{ employee.firstname + ' ' + employee.lastname }}
                        </th>

                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                            {{ employee.email }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                            <span v-if="employee.branch  == 0" class="bg-yellow-400 p-2 rounded text-white text-xs font-inter">CALASIAO</span>
                            <span v-if="employee.branch  == 1" class="bg-blue-400 p-2 rounded text-white text-xs font-inter">DAGUPAN</span>
                            <span v-if="employee.branch  == 2" class="bg-red-400 p-2 rounded text-white text-xs font-inter">LINGAYEN</span>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap   font-inter">
                            {{ employee.employee_type.name }}
                        </th>
                        <td class="px-6 py-4  font-inter">

                                <button @click="view(employee.id)"
                                        class="  p2-4 py-2 font-bold text-sm font-inter hover:text-blue-500 rounded inline-block mr-2"><img src="/svg/view.svg" alt=""></button>
                                    <button @click="destroy(employee.id)"
                                        class="  px-2 py-2 font-bold text-sm font-inter hover:text-red-500 rounded inline-block mr-2"><img src="/svg/delete.svg" alt=""></button>
                                    <button @click="edit(employee.id)"
                                        class=" inline px-2 py-2 font-bold text-sm font-inter hover:text-green-500 rounded"><img src="/svg/edit.svg" alt=""></button>
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
    password: '',
    branch:''
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
        if(search.value == '')
        {
            fetch();
        }else{
            const res = await axios.post('/api/admin/employee/search',{search: search.value});
            allData.value = res.data;
            pageCount.value = res.data.last_page;
            page.value = res.data.current_page;
            perPage.value = res.data.per_page;
        }
}
const uploadFile = (e) => {
    const file = e.target.files[0];
    previewImage.value = URL.createObjectURL(file);
    data.photo = file;

};
const viewBranch = async (id) =>{
            if(id == 3)
            {
                fetch();
            }else{
                const res = await axios.get('/api/admin/employee/search/branch?branch='+id);
            allData.value = res.data;
            pageCount.value = res.data.last_page;
            page.value = res.data.current_page;
            perPage.value = res.data.per_page;
            }

}
function closeView()
{
    viewModal.value = false;
    clear();
}
function addButton() {
    addModal.value = !addModal.value;
    viewModal.value = false;
    if (updateButton.value == true) {
        updateButton.value = false;

        clear();
    }
}
const add = async () => {

    if(updateButton.value)
    {
        let formData = new FormData();
        formData.append('details', JSON.stringify(data));
        formData.append('photo', data.photo);
        const res = await axios.post('/api/admin/employee/update/'+ids.value,formData);
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Updated Successfully!',
            showConfirmButton: false,
            timer: 1500
        })
        addButton();
        fetch();
    }else{
        let formData = new FormData();
    formData.append('details', JSON.stringify(data));
    formData.append('photo', data.photo);
    const res = await axios.post('/api/admin/employee/add', formData)
    if (res.status == 244) {
        errors.value = res.data.errors;
    } else {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Your work has been saved',
            showConfirmButton: false,
            timer: 1500
        })
        clear();
        fetch();
    }
    }


}

const fetch = async (pageNum) => {
    const res = await axios.get('/api/admin/employees?page='+pageNum);
    allData.value = res.data;
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
    data.branch = datas[0].branch;
    data.type = datas[0].type_id;
    console.log(JSON.stringify(datas[0].photo).trim())
    if(JSON.stringify(datas[0].photo) == null)
    {
        previewImage.value = '/storage/employee/'+datas[0].photo;
    }else{
        previewImage.value = 'https://eu.ui-avatars.com/api/?background=random&name='+datas[0].firstname+' '+datas[0].lastname;
    }
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
    data.branch = datas[0].branch;
    data.type = datas[0].employee_type.name;
    if(!!datas[0].photo)
    {
        data.photo = '/storage/employee/'+datas[0].photo;
    }else{
        data.photo = 'https://eu.ui-avatars.com/api/?background=random&name='+datas[0].firstname+' '+datas[0].lastname;
    }


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
    data.branch = '';
    data.password = '';
    image.value.value = '';
    errors.value = [];
    previewImage.value = '';
}
</script>
