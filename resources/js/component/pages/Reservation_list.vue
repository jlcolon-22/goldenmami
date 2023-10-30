<template>
    <div
        class="bg-[#f8f8f8] flex justify-start flex-col items-start rounded shadow max-w-[100%] mx-auto overflow-x-auto p-3"
    >
        <div class="flex justify-between items-center w-full">
            <h1 class="text-2xl font-inter text-gray-700 py-3">Reservation List</h1>
        <button class="bg-blue-600 py-2 px-6 text-white rounded" @click="refundModal = true" >Refund</button>
        </div>
        <table class="w-full text-sm text-left text-gray-500 z-0">
            <thead class="text-xs text-gray-50 uppercase bg-[#ebb700]">
                <tr>
                    <th scope="col" class="px-6 py-3 font-inter">#</th>
                    <th scope="col" class="px-6 py-3 font-inter">DATE</th>

                    <th scope="col" class="px-6 py-3 font-inter">TIME</th>
                    <th scope="col" class="px-6 py-3 font-inter">STATUS</th>
                    <th scope="col" class="px-6 py-3 font-inter">
                        PAYMENT STATUS
                    </th>
                    <th scope="col" class="px-6 py-3 font-inter">BRANCH</th>
                    <th scope="col" class="px-6 py-3 font-inter">ACTION</th>
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
                        {{ item.id }}
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
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap font-inter"
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
                            >FAILED</span
                        >
                    </th>
                    <th
                        scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap font-inter"
                    >
                        <span
                            v-if="item.payment_status == 'paid'"
                            class="p-2 rounded text-green-500 font-bold text-sm font-inter"
                            >PAID</span
                        >
                        <span
                            v-if="item.payment_status == 'failed'"
                            class="p-2 rounded text-red-500 font-bold text-sm font-inter"
                            >Unpaid</span
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
                            class="p2-4 py-2 font-bold text-sm font-inter hover:text-blue-500 rounded inline-block mr-2"
                        >
                            <img src="/svg/view.svg" alt="" />
                        </button>
                        <!-- <button @click="destroy(item.id)"
                                        class="  px-2 py-2 font-bold text-sm font-inter hover:text-red-500 rounded inline-block mr-2"><img src="/svg/delete.svg" alt=""></button> -->
                        <!-- <button @click="edit(item.id)"
                                        class=" inline px-2 py-2 font-bold text-sm font-inter hover:text-green-500 rounded"><img src="/svg/edit.svg" alt=""></button> -->
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
    <div
        v-show="viewModal"
        class="bg-gray-200 shadow border-t-[5px] border-blue-600 absolute left-0 right-0 w-[90%] sm:w-[500px] top-[160px] h-fit mx-auto p-3"
    >
        <div class="flex justify-between">
            <h1 class="text-lg">Reservation Details</h1>
            <button @click="viewModal = false">
                <img
                    src="/svg/exit.svg"
                    class="hover:opacity-100 opacity-60"
                    alt=""
                />
            </button>
        </div>
        <h1 class="font-inter">
            <span class="font-bold text-gray-400 font-inter text-sm"># -</span>
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
            <span class="font-bold flex text-gray-400 font-inter text-sm"
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
        <h1 class="font-inter"  v-if="!!viewData[0]">
            <span class="font-bold text-gray-400 font-inter text-sm"
                >PAYMENT STATUS -</span
            >
            {{ viewData[0][0].payment_status == 'paid' ? viewData[0][0].payment_status : "UNPAID" }}
        </h1>
        <h1 class="font-inter">
            <span class="font-bold text-gray-400 font-inter text-sm"
                >DOWNPAYMENT -</span
            >₱{{ !!viewData[0] ? viewData[0][0].payment : "" }}
        </h1>
        <hr class="bg-gray-700 my-3 h-[2px]" />
        <small class="font-inter text-sm">Orders</small>
        <div class="">
            <div class="flex justify-between items-center">
                <h1 class="bg-gray-300 w-full">Image</h1>
                <h1 class="bg-gray-300 w-full">Name</h1>
                <h1 class="bg-gray-300 w-full">Price</h1>
                <h1 class="bg-gray-300 w-full">Quantity</h1>
            </div>
            <div class="grid grid-cols-1 gap-y-2 overflow-y-auto max-h-[180px]">
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
                    <h1 class="w-full">{{ reservationData[1].name }}</h1>
                    <h1 class="w-full">₱{{ reservationData[1].price }}</h1>
                    <h1 class="w-full">{{ reservationData[2].qty }}</h1>
                </div>
            </div>
        </div>
    </div>


<!-- Main modal -->
<div v-if="refundModal == true" id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50  w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full bg-[#0004] flex justify-center pt-20">
    <div class="relative w-full max-w-2xl max-h-full ">
        <!-- Modal content -->
        <form @submit.prevent="submitRefund" class="relative bg-white rounded-lg shadow  ">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t ">
                <h3 class="text-xl font-semibold text-gray-900">
                    Refund
                </h3>
                <button type="button" @click="refundModal = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center " data-modal-hide="static-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div>
                    <label for="">Receipt </label>
                    <br>
                    <input type="file" required @change="uploadFile" class="p-2 bg-gray-200 w-full">
                </div>
                <div>
                    <label for="">Reason</label>
                    <br>
                    <textarea v-model="refundData.reason" required class="p-2 bg-gray-200 w-full" cols="30" rows="2" placeholder="reasons..."></textarea>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b ">
                <button v-if="loadingRefund == false" data-modal-hide="static-modal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
                <button v-else data-modal-hide="static-modal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center opacity-60" disabled="true">Loading...</button>
                <button  @click="refundModal = false" data-modal-hide="static-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"> Close</button>
            </div>
        </form>
    </div>
</div>

</template>
<script setup>
import { ref, onMounted, reactive } from "vue";
import Swal from 'sweetalert2'
import Paginate from "vuejs-paginate-next";
const viewModal = ref(false);
const refundModal = ref(false);
const allData = ref([]);
const page = ref(1);
const pageCount = ref(0);
const perPage = ref(null);
const viewData = ref([]);
const loadingRefund = ref(false)
const refundData = reactive({
    file:'',
    reason:''
})
const fetch = async (pageNum) => {
    try {
        const res = await axios.get(
            "/api/frontend/reservation/list?page=" + pageNum
        );
        allData.value = res.data;
        pageCount.value = res.data.last_page;
        page.value = res.data.current_page;
        perPage.value = res.data.per_page;
    } catch (error) {}
};
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
const uploadFile = (e) =>{
    refundData.file = e.target.files[0];
}
const submitRefund = async () =>{
    loadingRefund.value = true;
    try {
        var formData = new FormData();
        formData.append('receipt',refundData.file);
        formData.append('reason',refundData.reason);
        await axios.post('/api/frontend/refund',formData);
        refundData.file = '';
        refundData.reason = '';
        loadingRefund.value = false;
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Submited Successfully!',
            showConfirmButton: false,
            timer: 2500
        })

    } catch (error) {

    }

}
onMounted(() => {
    fetch();
});
</script>
