<template>
    <section class="max-w-[calc(100%)] py-16">
        <!-- modal add -->
        <!-- <div v-show="addModal"
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
</div> -->

        <div
            v-show="viewModal"
            class="bg-[#0009] absolute top-[60px] left-0 z-0 w-full h-[calc(100vh-60px)] flex justify-center items-center"
        >
            <div
                class="bg-gray-200 shadow border-t-[5px] border-blue-600 w-[890px] top-[160px] h-fit mx-auto grid grid-cols-2 gap-x-5 p-3 z-30"
            >
                <div>
                    <h1 class="text-lg">Customer Info Details</h1>

                    <h1 class="font-inter">
                        <span class="font-bold text-gray-400 font-inter text-sm"
                            >Nickname -</span
                        >
                        {{
                            !!viewData[0]
                                ? viewData[0][0].customer_info.nickname
                                : ""
                        }}
                    </h1>
                    <h1 class="font-inter">
                        <span class="font-bold text-gray-400 font-inter text-sm"
                            >Email -</span
                        >
                        {{
                            !!viewData[0]
                                ? viewData[0][0].customer_info.email
                                : ""
                        }}
                    </h1>
                    <h1 class="font-inter">
                        <span class="font-bold text-gray-400 font-inter text-sm"
                            >Number -</span
                        >
                        {{
                            !!viewData[0]
                                ? viewData[0][0].customer_info.number
                                : ""
                        }}
                    </h1>

                    <hr class="bg-gray-700 my-3 h-[2px]" />

                    <h1 class="text-lg">Reservation Details</h1>
                    <h1 class="font-inter">
                        <span class="font-bold text-gray-400 font-inter text-sm"
                            ># -</span
                        >
                        {{ !!viewData[0] ? viewData[0][0].id : "" }}
                    </h1>
                    <h1 class="font-inter">
                        <span class="font-bold text-gray-400 font-inter text-sm"
                            >DATE -</span
                        >
                        {{ !!viewData[0] ? viewData[0][0].date : "" }}
                    </h1>
                    <h1 class="font-inter">
                        <span class="font-bold text-gray-400 font-inter text-sm"
                            >GCASH CHECKOUT ID -</span
                        >
                        {{ !!viewData[0] ? viewData[0][0].cs_id : "" }}
                    </h1>
                    <h1 class="font-inter">
                        <span class="font-bold text-gray-400 font-inter text-sm"
                            >TIME -</span
                        >
                        {{ !!viewData[0] ? tConv24(viewData[0][0].time) : "" }}
                    </h1>
                    <h1 class="font-inter">
                        <span class="font-bold text-gray-400 font-inter text-sm"
                            >NUMBER OF GUEST -</span
                        >
                        {{ !!viewData[0] ? viewData[0][0].guest : "" }}
                    </h1>
                    <h1 class="font-inter flex items-center gap-1">
                        <span
                            class="font-bold flex text-gray-400 font-inter text-sm"
                            >BRANCH -</span
                        >
                        <span v-if="!!viewData[0]">
                            <h2
                                class="bg-yellow-600 text-gray-100 px-5 py-1 rounded w-fit"
                                v-if="viewData[0][0].branch == 1"
                            >
                                CALASIAO
                            </h2>
                            <h2
                                class="bg-yellow-600 text-gray-100 px-5 py-1 rounded w-fit"
                                v-if="viewData[0][0].branch == 2"
                            >
                                DAGUPAN
                            </h2>
                            <h2
                                class="bg-yellow-600 text-gray-100 px-5 py-1 rounded w-fit"
                                v-if="viewData[0][0].branch == 3"
                            >
                                LINGAYEN
                            </h2>
                        </span>
                    </h1>
                    <h1 class="font-inter">
                        <span class="font-bold text-gray-400 font-inter text-sm"
                            >STATUS -</span
                        >
                        <span v-if="!!viewData[0]">
                            <span
                                v-if="viewData[0][0].status == 0"
                                class="text-yellow-400 p-2 rounded font-bold text-lg font-inter"
                                >processing</span
                            >
                            <span
                                v-if="viewData[0][0].status == 1"
                                class="text-green-400 p-2 rounded font-bold text-lg font-inter"
                                >Aproved</span
                            >
                            <span
                                v-if="viewData[0][0].status == 2"
                                class="text-red-400 p-2 rounded font-bold text-lg font-inter"
                                >Failed</span
                            >
                        </span>
                    </h1>
                    <h1 class="font-inter" v-if="!!viewData[0]">
                        <span class="font-bold text-gray-400 font-inter text-sm"
                            >PAYMENT STATUS -</span
                        >
                        {{ viewData[0][0].payment_status == 'paid'  ? viewData[0][0].payment_status : "unpaid" }}
                    </h1>
                    <h1 class="font-inter">
                        <span class="font-bold text-gray-400 font-inter text-sm"
                            >DOWNPAYMENT -</span
                        >₱{{ !!viewData[0] ? viewData[0][0].payment : "" }}
                    </h1>
                    <hr class="bg-gray-700 my-3 h-[2px]" />
                </div>
                <div>
                    <div class="flex justify-between">
                        <h1 class="text-lg">Orders</h1>
                        <button @click="viewModal = false">
                            <img
                                src="/svg/exit.svg"
                                class="hover:opacity-100 opacity-60"
                                alt=""
                            />
                        </button>
                    </div>
                    <div class="">
                        <div class="flex justify-between items-center">
                            <h1 class="bg-gray-300 w-full">Image</h1>
                            <h1 class="bg-gray-300 w-full">Name</h1>
                            <h1 class="bg-gray-300 w-full">Price</h1>
                            <h1 class="bg-gray-300 w-full">Quantity</h1>
                        </div>
                        <div
                            class="grid grid-cols-1 gap-y-2 overflow-y-auto max-h-[180px]"
                        >
                            <div
                                class="flex justify-between items-center"
                                v-for="reservationData in viewData"
                                :key="reservationData.id"
                            >
                                <div class="w-full">
                                    <img
                                        :src="`/storage/menu/${reservationData[1].photo}`"
                                        class="w-[60px] h-[50px] rounded object-cover"
                                        alt=""
                                    />
                                </div>
                                <h1 class="w-full">
                                    {{ reservationData[1].name }}
                                </h1>
                                <h1 class="w-full">
                                    ₱{{ reservationData[1].price }}
                                </h1>
                                <h1 class="w-full">
                                    {{ reservationData[2].qty }}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            v-show="loading"
            class="bg-[#0009] absolute top-[60px] left-0 z-0 w-full h-[calc(100vh-60px)] flex justify-center items-center"
        >
            <div
                class="border-t-[6px] flex items-center border-t-blue-600 bg-white w-[200px] h-[80px] px-4 py-2"
            >
                <h1 class="font-inter font-semibold">Loading...</h1>
            </div>
        </div>
        <div class="py-2 flex justify-end">
            <input
                type="date"
                @change="search()"
                class="py-2 px-4 bg-gray-300 rounded w-[200px]"
                placeholder="search"
            />
        </div>
        <div class="w-full">
            <table
                class="text-sm text-left text-gray-500 z-0 overflow-hidden w-full"
            >
                <thead class="text-xs text-gray-50 uppercase bg-[#ebb700]">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-inter">
                            username
                        </th>

                        <th scope="col" class="px-6 py-3 font-inter">DATE</th>

                        <th scope="col" class="px-6 py-3 font-inter">TIME</th>
                        <th scope="col" class="px-6 py-3 font-inter">STATUS</th>
                        <th scope="col" class="px-6 py-3 font-inter">
                            PAYMENT STATUS
                        </th>
                        <th scope="col" class="px-6 py-3 font-inter">BRANCH</th>
                        <th scope="col" class="px-6 py-3 font-inter">Tools</th>
                        <th scope="col" class="px-6 py-3 font-inter">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="bg-white border-b"
                        v-for="item in allData.data"
                        :key="item.id"
                    >
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap font-inter"
                        >
                            {{ item.customer_info.nickname }}
                        </th>

                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap font-inter"
                        >
                            {{ convertDate(item.date) }}
                        </th>
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap font-inter"
                        >
                            {{ tConv24(item.time) }}
                        </th>
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap flex items-center justify-between font-inter"
                        >
                            <span
                                v-if="item.status == 0"
                                class="bg-yellow-400 p-2 rounded text-white text-xs font-inter"
                                >processing</span
                            >
                            <span
                                v-if="item.status == 1"
                                class="bg-green-400 p-2 rounded text-white text-xs font-inter"
                                >Aproved</span
                            >
                            <span
                                v-if="item.status == 2"
                                class="bg-red-400 p-2 rounded text-white text-xs font-inter"
                                >Failed</span
                            >
                        </th>
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap font-inter"
                        >
                            <span
                                v-if="item.payment_status == 'paid'"
                                class="p-2 rounded opacity-70 font-bold text-sm font-inter"
                                >PAID</span
                            >
                            <span
                                v-if="item.payment_status == 'failed'"
                                class="p-2 rounded text-red-500 font-bold text-sm font-inter"
                                >UNPAID</span
                            >
                        </th>
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap font-inter"
                        >
                            <span
                                v-if="item.branch == 1"
                                class="bg-yellow-400 p-2 rounded text-white text-xs font-inter"
                                >CALASIAO</span
                            >
                            <span
                                v-if="item.branch == 2"
                                class="bg-blue-400 p-2 rounded text-white text-xs font-inter"
                                >DAGUPAN</span
                            >
                            <span
                                v-if="item.branch == 3"
                                class="bg-red-400 p-2 rounded text-white text-xs font-inter"
                                >LINGAYEN</span
                            >
                        </th>

                        <td class="px-6 py-4 font-inter">
                            <button
                                @click="view(item.id)"
                                class="p2-4 py-2 font-bold text-sm font-inter hover:opacity-70 rounded inline-block mr-2"
                            >
                                <img src="/svg/view.svg" alt="" />
                            </button>
                            <button
                                @click="destroy(item.id)"
                                class="p2-4 py-2 font-bold text-sm font-inter hover:opacity-70 rounded inline-block mr-2"
                            >
                                <img src="/svg/delete.svg" alt="" />
                            </button>
                        </td>
                        <td class="px-6 py-4 font-inter">
                            <button
                                title="aprroved"
                                @click="approvedReject(item.id, 1)"
                                class="inline px-2 py-2 font-bold text-sm font-inter hover:opacity-70 rounded"
                            >
                                <img src="/svg/check.svg" alt="" />
                            </button>

                            <button
                                title="reject"
                                @click="approvedReject(item.id, 2)"
                                class="px-2 py-2 font-bold text-sm font-inter hover:opacity-70 rounded inline-block mr-2"
                            >
                                <img src="/svg/exit.btn.svg" alt="" />
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
import { ref, onMounted } from "vue";
import Swal from "sweetalert2";
import Paginate from "vuejs-paginate-next";
const viewModal = ref(false);
const allData = ref([]);
const page = ref(1);
const pageCount = ref(0);
const perPage = ref(null);
const viewData = ref([]);
const loading = ref(false);

const search = async () => {
    if (event.target.value == "") {
        fetch();
    } else {
        try {
            const res = await axios.get(
                "/api/admin/reservation/search?s=" + event.target.value
            );
            allData.value = res.data;
            pageCount.value = res.data.last_page;
            page.value = res.data.current_page;
            perPage.value = res.data.per_page;
        } catch (error) {}
    }
};
const fetch = async (pageNum) => {
    try {
        const res = await axios.get(
            "/api/admin/reservation/list?page=" + pageNum
        );
        allData.value = res.data;

        pageCount.value = res.data.last_page;
        page.value = res.data.current_page;
        perPage.value = res.data.per_page;
    } catch (error) {}
};
function tConv24(time24) {
    var ts = time24;
    var H = +ts.substr(0, 2);
    var h = H % 12 || 12;
    h = h < 10 ? "0" + h : h; // leading 0 at the left for 1 digit hours
    var ampm = H < 12 ? " AM" : " PM";
    ts = h + ts.substr(2, 3) + ampm;
    return ts;
}
const view = (reserveId) => {
    const x = allData.value.data.filter((value) => {
        return value.id == reserveId;
    });
    viewData.value = x[0];
    viewModal.value = true;
    var total = [];
    x[0].order_item.forEach((element, key) => {
        x[0].order_items.forEach((v, i) => {
            if (key == i) {
                total[key] = [x[0], v, element];
            }
        });
    });
    viewData.value = total;
    console.log(viewData.value);
};
const destroy = async (id) => {
    loading.value = true;
    await Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete("/api/admin/reservation/delete/" + id).then((res) => {
                fetch();
                loading.value = false;
                Swal.fire("Deleted!", "Your file has been deleted.", "success");
            });
        }
        loading.value = false;
    });
};
const approvedReject = async (id, status) => {
    loading.value = true;
    const res = await axios.post(`/api/admin/reservation/approved/${id}`, {
        data: status,
    });
    await fetch();
    loading.value = false;
    Swal.fire({
        position: "center",
        icon: "success",
        title: "Updated Successfully!",
        showConfirmButton: false,
        timer: 1500,
    });
};
function convertDate(dt) {
    const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];
    const d = new Date(
        dt.split("-")[0],
        dt.split("-")[1] - 1,
        dt.split("-")[2]
    );
    const monthIndex = d.getMonth();
    const year = d.getFullYear(); // 2019
    const date = d.getDate(); // 23
    const monthName = months[monthIndex];

    return monthName + " " + date + " " + year;
}

onMounted(() => {
    fetch();
});
</script>
