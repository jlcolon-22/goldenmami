<template>
          <section id="menu">
            <div class="w-[85%] mx-auto mt-20 pb-10">
                <h2 class=" text-7xl font-bold text-[#ebb700] text-center" style="font-family: 'Dancing Script', cursive;">Our Menu</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 w-full py-10 gap-y-36 md:gap-10">

                    <div id="menus" ref="menus" class="menus  w-full bg-transparent  shadow-none md:flex md:shadow md:bg-[#f8f8f8f8] h-fit md:h-[200px] opacity-0 " v-for="(menu, index) in allData" :key="index"
               >
               <!-- :class="index % 2 == 0 ? ' animate-menuleft  ' : ' animate-menuright  '" -->
                <img :src="'/storage/menu/' + menu.photo" class="object-cover object-center w-full md:w-[50%] h-[250px] md:h-auto" s alt="" />
                <div class=" p-1  relative  w-full min-h-[60px] md:h-auto md:w-1/2 md:p-6">
                    <h3 class="text-2xl md;text-4xl font-bold  w-[80%]" >{{ menu.name }}</h3>
                    <small class="text-lg text-center text-gray-500 ">{{
                        menu.description
                    }} </small>
                    <h6 class="text-[#ebb700] font-bold text-2xl absolute right-1 top-1  md:top-6 md:right-2">
                        ₱{{ menu.price }}
                    </h6>
                    <button v-if="props.auth == '1'" @click="add(menu.id,index)" ref="refIndex" :value="index"
                        class="bg-transparent px-3 py-2 text-yellow-500 ring-2 ring-yellow-500 font-bold font-inter absolute  -bottom-10 left-1 md:bottom-6 md:left-6 hover:bg-yellow-500 transition-all ease-in-out duration-500 hover:text-[#fff]">
                        Add to cart

                    </button>
                    <a v-else href="/login"  ref="refIndex" :value="index"
                        class="bg-transparent px-3 py-2 text-yellow-500 ring-2 ring-yellow-500 font-bold font-inter absolute -bottom-10 left-1 md:bottom-6 md:left-6 hover:bg-yellow-500 transition-all ease-in-out duration-500 hover:text-[#fff]">
                        Add to cart

                    </a>
                    <button ref="check" value="x"
                        class="bg-transparent px-3 py-2 text-green-500 ring-2 ring-green-500 font-bold font-inter absolute  -bottom-10 left-1 md:bottom-6 md:left-6 hover:bg-green-500 transition-all ease-in-out duration-500 hover:text-[#fff] w-[111.15px] h-[40px]  hidden">
                        <span class="flex justify-center items-center"> <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="16px" height="16px" x="0" y="0" viewBox="0 0 2.54 2.54" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><circle cx="1.27" cy="1.27" r="1.27" fill="#00ba00" data-original="#00ba00" class=""></circle><path fill="#ffffff" d="M.873 1.89.41 1.391a.17.17 0 0 1 .008-.24.17.17 0 0 1 .24.009l.358.383.567-.53a.17.17 0 0 1 .016-.013l.266-.249a.17.17 0 0 1 .24.008.17.17 0 0 1-.008.24l-.815.76-.283.263-.125-.134z" data-original="#ffffff"></path></g></svg></span>


                    </button>

                </div>
            </div>

                </div>
            </div>
        </section>
</template>
<script setup>
import { onMounted, ref,onUpdated } from "vue";
import { useIndexStore } from '../../store';
const props = defineProps({auth:String})
const store = useIndexStore();
const allData = ref([]);
const refIndex = ref('');
const check = ref('');
const menus = ref(null)
const fetch = async () => {
        const res = await axios.get("/api/frontend/dashboard/menu");
        allData.value = res.data;


};
const add = async (id,index) =>{
    const res = await axios.post('/api/frontend/cart/add',{id:id});
    store.fetchCart()
    // refIndex.value = index

    refIndex.value[index].classList.toggle('hidden');
    check.value[index].classList.toggle('hidden');
    setTimeout(()=>{
        refIndex.value[index].classList.toggle('hidden');
    check.value[index].classList.toggle('hidden');
    },1000)
}
fetch();
onMounted(()=>{

    // const menu = document.querySelector('#menu');

    // const animate = new IntersectionObserver(entries =>{
    //     entries.forEach(element => {
    //         const menus = document.querySelectorAll('.menus');
    //         if(element.isIntersecting)
    //         {


    //             menus.forEach((value,key )=>{

    //                 if(key % 2 == 0)
    //                 {
    //                     value.classList.add('animate-menuleft');
    //                 }else{
    //                     value.classList.add('animate-menuright');
    //                 }
    //             })
    //         }else{
    //             menus.forEach((value,key )=>{

    //                 if(key % 2 == 0)
    //                 {
    //                     value.classList.remove('animate-menuleft');
    //                 }else{
    //                     value.classList.remove('animate-menuright');
    //                 }
    //                 })
    //         }
    //     });
    // })
    // animate.observe(menu)

})
onUpdated(()=>{

const animate = new IntersectionObserver(entries =>{
    entries.forEach(element => {
        if(!element.isIntersecting) return;
        element.target.classList.remove('opacity-0')
        element.target.classList.add('animate-opacityUp')
    });
},{rootMargin: '-200px 0px -200px 0px'})
menus.value.forEach(element => {
   animate.observe(element)
});

})
</script>
