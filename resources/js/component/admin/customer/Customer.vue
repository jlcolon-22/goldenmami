<template>
    <section class="px-10 py-16">
        <!-- view modal -->
        <div
            v-show="viewModal"
            class="add-modal absolute top-0 left-0 w-full h-screen z-20 bg-[#0005] flex justify-center items-center transition-all ease-in-out"
        >
            <div
                class="bg-[#fff] shadow rounded min-w-[70%]"
                style="max-width: 70%"
            >
                <div class="bg-sky-500 flex justify-between items-center px-2">
                    <h1 class="text-lg font-bold font-inter p-2 text-gray-200">
                        EMPLOYEE INFORMATION
                    </h1>
                    <a
                        role="button"
                        @click="closeView"
                        class="hover:opacity-70 cursor-pointer"
                        ><img src="/svg/exit.svg" alt=""
                    /></a>
                </div>
                <div class="p-5 flex justify-between items-start">
                    <div class="w-[300px]">
                        <img
                            :src="data.photo"
                            class="mt-2 min-w-[300px] max-h-[300px]"
                            alt=""
                        />
                    </div>

                    <div class="w-full p-5">
                        <h1 class="font-inter text-lg font-bold">
                            Nickname:
                            <span class="font-inter font-normal text-base">{{
                                data.nickname
                            }}</span>
                        </h1>
                        <h1 class="font-inter text-lg font-bold">
                            Email:
                            <span class="font-inter font-normal text-base">{{
                                data.email
                            }}</span>
                        </h1>
                        <h1 class="font-inter text-lg font-bold">
                            Number:
                            <span class="font-inter font-normal text-base">{{
                                data.number
                            }}</span>
                        </h1>

                        <h1 class="font-inter text-lg font-bold">
                            Address:
                            <span class="font-inter font-normal text-base">{{
                                data.address
                            }}</span>
                        </h1>
                        <h1 class="font-inter text-lg font-bold">
                            Email Validate:
                            <span
                                class="font-inter font-normal text-base bg-[#ebb700] py-1 px-2 rounded"
                                >{{ data.email_validate }}</span
                            >
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal add -->
        <div
            v-show="addModal"
            class="add-modal absolute top-0 left-0 w-full h-screen z-20 bg-[#0005] flex justify-center items-center transition-all ease-in-out"
        >
            <form
                @submit.prevent="add"
                class="bg-white shadow rounded min-w-[70%] h-fit"
                style="max-width: 70%"
                enctype="multipart/form-data"
            >
                <div
                    class="bg-[#ebb700] flex justify-between items-center px-2"
                >
                    <h1
                        v-if="!updateButton"
                        class="text-lg font-bold font-inter p-2 text-gray-200"
                    >
                        ADD CUSTOMER
                    </h1>
                    <h1
                        v-else
                        class="text-lg font-bold font-inter p-2 text-gray-200"
                    >
                        UPDATE CUSTOMER
                    </h1>
                    <a
                        role="button"
                        @click="addButton"
                        class="hover:opacity-70 cursor-pointer"
                        ><img src="/svg/exit.svg" alt=""
                    /></a>
                </div>
                <div class="p-5 flex justify-between gap-10">
                    <div class="w-[300px]">
                        <div
                            class="border-2 mb-2 border-gray-500 border-dashed py-7 px-4 flex justify-center items-center"
                        >
                            <label
                                for="image"
                                class="bg-blue-500 px-2 py-1 text-center text-white"
                                >Upload a file</label
                            >
                            <input
                                type="file"
                                ref="image"
                                @change="uploadFile"
                                id="image"
                                class="py-2 px-4 bg-gray-200 rounded w-full font-inter hidden"
                            />
                        </div>
                        <small
                            v-if="errors.photo"
                            class="text-red-600 font-inter"
                            >{{ errors.photo[0] }}</small
                        >
                        <img
                            v-if="previewImage != ''"
                            :src="previewImage"
                            class="mt-2 w-full h-[150px]"
                            alt=""
                        />
                    </div>
                    <div class="grid grid-cols-1 gap-3 w-full">
                        <div>
                            <label>Nickname</label>
                            <input
                                type="text"
                                v-model="data.nickname"
                                class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter"
                                placeholder="ex: Leni"
                            />
                            <small
                                v-if="errors.nickname"
                                class="text-red-600 font-inter"
                                >{{ errors.nickname[0] }}</small
                            >
                        </div>

                        <div>
                            <label>Email</label>
                            <input
                                type="email"
                                v-model="data.email"
                                class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter"
                                placeholder="example@gmail.com"
                            />
                            <small
                                v-if="errors.email"
                                class="text-red-600 font-inter"
                                >{{ errors.email[0] }}</small
                            >
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="relative">
                                <label>Number</label>

                                <input
                                    type="number"

                                    v-model="data.number"

                                    class="py-2 pr-4 pl-14 bg-gray-200 rounded w-full inline-block font-inter"
                                    placeholder="9101421***"
                                />
                                <div
                                    class="bg-gray-300 w-fit p-2 absolute top-6"
                                >
                                    +63
                                </div>
                                <small
                                    v-if="errors.number"
                                    class="text-red-600 font-inter"
                                    >{{ errors.number[0] }}</small
                                >
                            </div>
                            <div>
                                <label>Email Validate</label>
                                <select
                                    class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter"
                                    v-model="data.email_validate"
                                >
                                    <option value="">Choose</option>
                                    <option value="1">Validate</option>
                                    <option value="0">Not Validate</option>
                                </select>
                                <small
                                    v-if="errors.email_validate"
                                    class="text-red-600 font-inter"
                                    >{{ errors.email_validate[0] }}</small
                                >
                            </div>
                        </div>

                        <div>
                            <label>Password</label>
                            <input
                                type="password"
                                v-model="data.password"
                                class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter"
                                placeholder="************"
                            />
                            <small
                                v-if="errors.password"
                                class="text-red-600 font-inter"
                                >{{ errors.password[0] }}</small
                            >
                        </div>
                        <div>
                            <label>Address</label>
                            <textarea
                                v-model="data.address"
                                class="py-2 px-4 bg-gray-200 rounded w-full inline-block font-inter"
                                placeholder="Complete address"
                            ></textarea>
                            <small
                                v-if="errors.address"
                                class="text-red-600 font-inter"
                                >{{ errors.address[0] }}</small
                            >
                        </div>
                        <div>
                            <button
                                type="submit"
                                v-if="!updateButton"
                                class="py-3 px-6 bg-green-700 text-gray-100 font-normal hover:opacity-70 rounded w-full inline-block font-inter"
                            >
                                ADD CUSTOMER
                            </button>
                            <div>
                                <button
                                    v-if="updateButton"
                                    type="submit"
                                    class="py-2 px-4 bg-green-700 text-gray-100 font-normal hover:opacity-70 rounded w-full inline-block font-inter mb-2"
                                >
                                    UPDATE CUSTOMER
                                </button>
                                <button
                                    v-if="updateButton"
                                    @click="addButton"
                                    class="py-2 px-4 bg-red-700 text-gray-100 font-normal hover:opacity-70 rounded w-full inline-block font-inter"
                                >
                                    CANCEL
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="py-2 flex justify-between">
            <button
                @click="addButton"
                class="py-2 px-4 transition-all ease-in-out hover:opacity-70 bg-green-700 rounded text-[#fff] text-xs font-inter font-bold"
            >
                ADD
            </button>
            <form @submit.prevent="searching">
                <input
                    type="search"
                    class="py-2 px-4 bg-gray-300 rounded w-[200px]"
                    v-model="search"
                    placeholder="search"
                />
            </form>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 z-0">
                <thead class="text-xs text-gray-50 uppercase bg-[#ebb700]">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-inter">
                            FULLNAME
                        </th>

                        <th scope="col" class="px-6 py-3 font-inter">EMAIL</th>
                        <th scope="col" class="px-6 py-3 font-inter">NUMBER</th>
                        <th scope="col" class="px-6 py-3 font-inter">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="bg-white border-b"
                        v-for="customer in allData.data"
                        :key="customer.id"
                    >
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap font-inter"
                        >
                            {{ customer.nickname }}
                        </th>

                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap font-inter"
                        >
                            {{ customer.email }}
                        </th>
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap font-inter"
                        >
                            {{ customer.number }}
                        </th>
                        <td class="px-6 py-4 font-inter">
                            <button
                                @click="view(customer.id)"
                                class="p2-4 py-2 font-bold text-sm font-inter hover:text-blue-500 rounded inline-block mr-2"
                            >
                                <img src="/svg/view.svg" alt="" />
                            </button>
                            <button
                                @click="destroy(customer.id)"
                                class="px-2 py-2 font-bold text-sm font-inter hover:text-red-500 rounded inline-block mr-2"
                            >
                                <img src="/svg/delete.svg" alt="" />
                            </button>
                            <button
                                @click="edit(customer.id)"
                                class="inline px-2 py-2 font-bold text-sm font-inter hover:text-green-500 rounded"
                            >
                                <img src="/svg/edit.svg" alt="" />
                            </button>
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
import { ref, reactive, onMounted } from "vue";
import Swal from "sweetalert2";
import Paginate from "vuejs-paginate-next";
const addModal = ref(false);
const viewModal = ref(false);
const data = reactive({
    photo: "",
    nickname: "",
    email: "",
    address: "",
    number: "",
    email_validate: "",
    password: "",
});
const updateButton = ref(false);
const errors = ref([]);
const image = ref("");
const previewImage = ref("");
const allData = ref([]);
const types = ref([]);
const ids = ref("");
const page = ref(1);
const pageCount = ref(null);
const perPage = ref(null);
const search = ref("");
const searching = async () => {
    if (search.value == "") {
        fetch();
    } else {
        const res = await axios.post("/api/admin/customer/search", {
            search: search.value,
        });
        allData.value = res.data;
    }
};
const uploadFile = (e) => {
    const file = e.target.files[0];
    previewImage.value = URL.createObjectURL(file);
    data.photo = file;
};
function closeView() {
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
    if (updateButton.value) {
        let formData = new FormData();
        formData.append("details", JSON.stringify(data));
        formData.append("photo", data.photo);
        const res = await axios.post(
            "/api/admin/customer/update/" + ids.value,
            formData
        );
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Updated Successfully!",
            showConfirmButton: false,
            timer: 1500,
        });
        addButton();
        fetch();
    } else {
        console.log(data);
        try {
            let formData = new FormData();
            formData.append("details", JSON.stringify(data));
            formData.append("photo", data.photo);
            const res = await axios.post("/api/admin/customer/add", formData);

            Swal.fire({
                position: "center",
                icon: "success",
                title: "Your work has been saved",
                showConfirmButton: false,
                timer: 1500,
            });
            clear();
            fetch();
        } catch (err) {
            errors.value = err.response.data.errors;
        }
    }
};

const fetch = async (pageNum) => {
    const res = await axios.get("/api/admin/customers?page=" + pageNum);
    allData.value = res.data;
    pageCount.value = res.data.last_page;
    page.value = res.data.current_page;
    perPage.value = res.data.per_page;
};
onMounted(() => {
    fetch();
    allType();
});
const allType = async () => {
    const res = await axios.get("/api/admin/employee/type/global");
    types.value = res.data;
};
const edit = async (id) => {
    updateButton.value = true;
    addModal.value = true;
    const datas = allData.value.data.filter((value) => {
        return value.id == id;
    });
    data.nickname = datas[0].nickname;
    data.email = datas[0].email;
    data.number = datas[0].number;
    data.address = datas[0].address;
    data.email_validate = datas[0].email_validate;
    data.photo = datas[0].photo;
    previewImage.value = "/storage/customer/" + datas[0].photo;
    ids.value = id;
};
const view = (id) => {
    viewModal.value = true;
    const datas = allData.value.data.filter((value) => {
        return value.id == id;
    });
    data.nickname = datas[0].nickname;
    data.email = datas[0].email;
    data.number = datas[0].number;
    data.address = datas[0].address;
    data.email_validate = datas[0].email_validate;

    if (datas[0].photo == null) {
        data.photo =
            "https://eu.ui-avatars.com/api/?background=random&name=" +
            datas[0].nickname;
    } else {
        data.photo = "/storage/customer/" + datas[0].photo;
    }
};
const destroy = (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete("/api/admin/customer/delete/" + id).then((res) => {
                fetch();
                Swal.fire("Deleted!", "Your file has been deleted.", "success");
            });
        }
    });
};
const clear = () => {
    data.nickname = "";
    data.email = "";
    data.number = "";
    data.email_validate = "";
    data.address = "";
    data.photo = "";
    data.password = "";
    image.value.value = "";
    errors.value = [];
    previewImage.value = "";
};
</script>
