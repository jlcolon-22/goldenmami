<template>
    <div class=" min-w-[96%] p-10">
        <div class="grid grid-cols-1 gap-10 mb-10">


            <!-- attendance -->
            <div class=" py-3 px-6  ">
                <h1 class="text-lg font-bold font-inter">MY ATTENDANCE</h1>
                <div class="grid grid-cols-1 gap-10 p-3 max-h-[60vh] overflow-y-auto">

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-inter">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-inter">
                                        Time in
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-inter">
                                        Time out
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-inter">
                                        Status
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="attendance in allAttendance.data" :key="attendance.id"
                                    class="bg-white border-b hover:bg-gray-50 ">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap font-inter ">
                                      {{ attendance.created_at }}
                                    </th>
                                    <td class="px-6 py-4 font-inter">
                                        {{ attendance.time_in }}
                                    </td>
                                    <td class="px-6 py-4 font-inter">
                                        {{ attendance.time_out }}
                                    </td>
                                    <td class="px-6 py-4 font-inter">
                                        <span class="inline-block   font-inter text-sm font-bold py-2 px-4 rounded" :class="!!attendance.time_in || !!attendance.time_out ? 'text-violet-800 bg-violet-300 ' : 'bg-red-300 text-red-800'">{{ !!attendance.time_in || !!attendance.time_out ? 'Present' : 'Absent' }}</span>
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>



                </div>
            </div>
        </div>

    </div>
</template>
<script setup>

import { onMounted, ref } from 'vue';
const allAttendance = ref([]);
const fetch = async () => {
    const res = await axios.get('/api/employee/attendance');
    allAttendance.value = res.data;
}
onMounted(() => {
    fetch();
})

// const newDate = (olddate) => {
//     if (!!olddate) {
//         const [hours, minutes] = olddate.split(":");
//         const time = new Date();
//         time.setHours(hours);
//         time.setMinutes(minutes);
//         const ampm = time.getHours() >= 12 ? "PM" : "AM";
//         let hours12 = time.getHours() % 12;
//         hours12 = hours12 ? hours12 : 12; // convert 0 to 12
//         return `${hours12}:${minutes} ${ampm}`;
//     } else {
//         return '';
//     }


// }
</script>
