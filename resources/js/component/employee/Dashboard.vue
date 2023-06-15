<template>
    <div class=" min-w-[96%] p-10">
        <div class="grid grid-cols-2 gap-10 mb-10">
            <div class="shadow rounded py-3 px-6  bg-[#fff] ">
                <h1 class="text-lg font-bold font-inter">Events</h1>
                <div class="flex flex-col gap-10 py-6 px-6    min-h-[60vh] overflow-y-auto">
                    <div class=" flex  w-full relative h-fit" v-for="event in allEvents" :key="event.id">
                        <img src="/svg/event.svg" class="mr-1" alt="">
                        <div class=" w-full ">
                            <h2 class="text-2xl " style="line-height: 25px;">{{ event.name }}</h2>
                            <small class="flex items-center opacity-70 absolute right-0 top-0"> <img src="/svg/timer.svg" class="w-[17px] mr-1" alt=""> <span class="inline-block text-base">{{ newDate(event.start) + ' - ' + newDate(event.end) }}</span></small>
                            <small class="flex items-center opacity-70 "> <span class="inline-block text-base">{{ event.date }}</span></small>
                        </div>
                        <hr class="w-full absolute -bottom-5">
                    </div>


                </div>
            </div>

            <!-- attendance -->
            <div class="shadow rounded py-3 px-6 h-fit  bg-[#fff] ">
                <h1 class="text-lg font-bold font-inter">ATTENDANCE</h1>
                <div class="grid grid-cols-2 gap-10 p-3 max-h-[60vh] overflow-y-auto">
                    <button @click="add(0)" class="py-5 px-10 text-center bg-emerald-400 text-lg  text-white" :disabled="!!check.time_in
                     ? true : false"  :class="!!check.time_in ? 'opacity-30' :  'hover:opacity-70'">
                        Time In
                    </button>
                    <button @click="add(1)" class="py-5 px-10 text-center bg-red-400 text-lg text-white" :disabled="!!check.time_out ? true : false"  :class="!!check.time_out ? 'opacity-30' : 'hover:opacity-70'">
                        Time Out
                    </button>
                </div>
            </div>
        </div>

    </div>
</template>
<script setup>

import { onMounted, ref } from 'vue';
const allEvents = ref([]);
const check = ref([]);
const fetch = async () =>{
    const res = await axios.get('/api/employee/events');
    allEvents.value = res.data.events;
}
const add = async (id) =>{
    const res = await axios.post('/api/employee/attendance/add',{id:id});
    show();
}
const show = async () =>
{
    const res = await axios.get('/api/employee/attendance/show')
    check.value = res.data;


}
onMounted(() => {
fetch();
show();
})
const newDate = (olddate) => {
    if(!!olddate)
    {
        const [hours, minutes] = olddate.split(":");
          const time = new Date();
          time.setHours(hours);
          time.setMinutes(minutes);
          const ampm = time.getHours() >= 12 ? "PM" : "AM";
          let hours12 = time.getHours() % 12;
          hours12 = hours12 ? hours12 : 12; // convert 0 to 12
          return `${hours12}:${minutes} ${ampm}`;
    }else{
        return '';
    }


}
</script>
