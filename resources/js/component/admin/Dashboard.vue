<template>
    <div class=" min-w-[96%] p-10">
        <div class="grid grid-cols-3 gap-10 mb-10">
            <div class="shadow rounded py-3 px-6 flex bg-[#fff] justify-between">
               <div>
                <small class="font-inter text-xs opacity-70">Total Employee</small>
                <h1 class="text-2xl font-bold font-inter">{{ datas['employees'] }}</h1>
               </div>
               <img src="/svg/employeesColor.svg" alt="">
            </div>
            <div class="shadow rounded py-3 px-6 flex bg-[#fff] justify-between">
               <div>
                <small class="font-inter text-xs opacity-70">Total Customer</small>
                <h1 class="text-2xl font-bold font-inter">{{ datas['customers'] }}</h1>
               </div>
               <img src="/svg/customers.svg" alt="">
            </div>
            <div class="shadow rounded py-3 px-6 flex bg-[#fff] justify-between">
               <div>
                <small class="font-inter text-xs opacity-70">New Reservation</small>
                <h1 class="text-2xl font-bold font-inter">{{ datas['reservations'] }}</h1>
               </div>
               <img src="/svg/reserve.svg" alt="">
            </div>
        </div>
        <canvas id="myChart" style="max-width: 98%;"></canvas>
    </div>
</template>
<script setup>
import Chart from 'chart.js/auto';
import { onMounted,onUpdated,reactive,ref } from 'vue';
const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'Aug',
    'Sep',
    'Oct',
    'Nov',
    'Dec',

];
const allRes = reactive({
    datas:[]
});
const fetchRes = async () =>{
    const res = await axios.get('/api/admin/graph');
var x = Object.keys(res.data).length;
var y = Object.keys(res.data);

        const res_array = [];
        //  for(let i = 0; i < Object.keys(res.data).length;i++) {
        //             res_array[Object.keys(res.data)[i]] = res.data[Object.keys(res.data)[i]];
        //         };

                var i = 13;
                while(i != 0){
                    i--;
                    if(i == 0)
                    {
                        break;
                    }
                    if(res.data[i])
                    {
                        var h = i - 1;
                        data.datasets[0].data[h] = res.data[i];
                    }else{
                        var h = i - 1;
                        data.datasets[0].data[h] = 0;
                    }


                };
           allRes.datas = res.data;
                console.log(data.datasets[0].data)

}
const data = {
    labels: labels,
    datasets: [{
        label: 'Monthly Reservation',
        backgroundColor: 'rgb(75, 192, 192)',
        borderColor: 'rgb(75, 192, 192)',
        data: [0],
    }]
};

const datas = ref([]);
const config = {
    type: 'line',
    data: data,
    options: {}
};

const fetch = async () =>{
    const res = await axios.get('/api/admin/count');
    datas.value = res.data;
}

onMounted(() => {
    fetch();

   setTimeout(()=>{
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
   },1000)
})
onUpdated(()=>{
    fetchRes()

})
</script>
