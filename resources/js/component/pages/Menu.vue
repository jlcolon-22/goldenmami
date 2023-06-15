<template>

    <div class="flex justify-center min-w-[60%]  sm:min-max-w-[70%] w-[60%] sm:max-w-[70%] mx-auto relative ">
        <button @click="prev" class="px-6 py-3 bg-transparent absolute -left-24 -top-2 " :class="scroll == 0 ? 'opacity-40' : ''" :disabled="scroll < 0 ? true : false"> <img src="/svg/arrow.svg" alt=""> </button>
        <button @click="next"  class="px-6 py-3 bg-transparent absolute -right-24 rotate-180 -top-2 " :class="scrollNext ? 'opacity-40' : ''" :disabled="scrollNext? true : false" > <img src="/svg/arrow.svg" alt=""> </button >
        <div ref="content"  class="snap-x scroll-smooth catContainer  flex touch-pan-x  relative w-full  overflow-x-auto  mb-20 mx-auto ">


                <a class="snap-end whitespace-nowrap cursor-pointer   px-7 py-3 relative text-base inline-block w-fit  font-semibold hover:bg-[#ebb700] hover:text-[#fff] transition-all ease-in-out duration-500" style="font-family: Verdana, Geneva, Tahoma, sans-serif"
                @click="fetch(null)" :class="ctgy == null ? 'bg-[#ebb700] text-[#fff]' : 'text-gray-400 '">ALL
                </a>


                <a v-for="category in allCategory" :key="category.id"
                class="snap-end px-7 py-3 relative  cursor-pointer text-base inline-block w-fit whitespace-nowrap items-center font-semibold hover:bg-[#ebb700] hover:text-[#fff] transition-all ease-in-out duration-500"
                @click="fetch(category.id)" :class="ctgy == category.id ? 'bg-[#ebb700] text-[#fff]' : 'text-gray-400'"
                style="font-family: Verdana, Geneva, Tahoma, sans-serif">{{ category.name }}

                <!-- <div
                    v-show="ctgy == category.id"
                    class="bg-[#ebb700] h-[50px] w-[50px] rotate-45 absolute -bottom-3 -z-50 left-0 right-0 mx-auto">
                </div> -->
            </a>



        </div>
    </div>
    <div class="w-[85%] mx-auto pb-10">
        <!-- :class="index % 2 == 0 ? ' animate-menuleft  ' : ' animate-menuright  '" -->
        <div v-if="!loading" class="grid grid-cols-1 lg:grid-cols-2 w-full py-10 gap-y-36 md:gap-10">
            <div class=" w-full   menus opacity-0 h-fit bg-transparent  shadow-none md:flex md:shadow md:bg-[#f8f8f8f8] md:h-[200px]" ref="menus" v-for="(menu, index) in allData.data" :key="index"
               >
                <img :src="'/storage/menu/' + menu.photo" class="object-cover object-center w-full md:w-[50%] h-[250px] md:h-auto"  alt="" />
                <div class="w-full p-1 relative min-h-[60px] md:h-auto md:w-1/2 md:p-6">
                    <h3 class="text-2xl md;text-4xl font-bold  w-[80%]">{{ menu.name }}</h3>
                    <small class="text-lg text-center text-gray-500">{{
                        menu.description
                    }}</small>
                    <h6 class="text-[#ebb700] font-bold text-2xl absolute right-1 top-1  md:top-6 md:right-2">
                        ₱{{ menu.price }}
                    </h6>
                    <button v-if="props.auth == '1'" @click="add(menu.id,index)" ref="refIndex" :value="index"
                        class="bg-transparent px-3 py-2 text-yellow-500 ring-2 ring-yellow-500 font-bold font-inter absolute -bottom-10 left-1 md:bottom-6 md:left-6 hover:bg-yellow-500 transition-all ease-in-out duration-1000 hover:text-[#fff]">
                        Add to cart

                    </button>
                    <a v-else href="/login" ref="refIndex" :value="index"
                        class="bg-transparent px-3 py-2 text-yellow-500 ring-2 ring-yellow-500 font-bold font-inter absolute -bottom-10 left-1 md:bottom-6 md:left-6 hover:bg-yellow-500 transition-all ease-in-out duration-1000 hover:text-[#fff]">
                        Add to cart

                    </a>
                    <button ref="check" value="x"
                        class="bg-transparent px-3 py-2 text-green-500 ring-2 ring-green-500 font-bold font-inter absolute -bottom-10 left-1 md:bottom-6 md:left-6 hover:bg-green-500 transition-all ease-in-out duration-1000 hover:text-[#fff] w-[111.15px] h-[40px]  hidden">
                        <span class="flex justify-center items-center"> <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="16px" height="16px" x="0" y="0" viewBox="0 0 2.54 2.54" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><circle cx="1.27" cy="1.27" r="1.27" fill="#00ba00" data-original="#00ba00" class=""></circle><path fill="#ffffff" d="M.873 1.89.41 1.391a.17.17 0 0 1 .008-.24.17.17 0 0 1 .24.009l.358.383.567-.53a.17.17 0 0 1 .016-.013l.266-.249a.17.17 0 0 1 .24.008.17.17 0 0 1-.008.24l-.815.76-.283.263-.125-.134z" data-original="#ffffff"></path></g></svg></span>


                    </button>
                </div>
            </div>
        </div>
       <div v-show="loading"  class="h-[70vh]">
        <Loading ></Loading>
       </div>
    </div>

</template>
<script setup>
import Loading from '../loading/menuLoading.vue'
import { onMounted, onUpdated, ref,onActivated, onBeforeMount, onUnmounted } from "vue";
import { useIndexStore } from '../../store';
const props = defineProps({auth:String})
const store = useIndexStore();
const allData = ref([]);
const allCategory = ref([]);
const content = ref(null);
const ctgy = ref("");
const loading = ref(true);
const scroll = ref(0)
const scrollNext = ref(false)
const refIndex = ref('');
const check = ref('');
const menus = ref([])
const fetch = async (id) => {
    loading.value = true;
    ctgy.value = id;
    try {
        const res = await axios.post("/api/frontend/menus", { search: ctgy.value });
        allData.value = res.data;
        setTimeout(() => {
            loading.value = false;
        }, 1000)
    } catch (error) { }
};
const categories = async () => {
    try {
        const res = await axios.get("/api/frontend/menu/categories");
        allCategory.value = res.data;

    } catch (error) { }
};
const add = async (id,index) =>{
    const res = await axios.post('/api/frontend/cart/add',{id:id});
    store.fetchCart()
    refIndex.value[index].classList.toggle('hidden');
    check.value[index].classList.toggle('hidden');
    setTimeout(()=>{
        refIndex.value[index].classList.toggle('hidden');
    check.value[index].classList.toggle('hidden');
    },1000)
}

function prev()
{


    content.value.scrollBy(-200,0)
    scroll.value = content.value.scrollLeft;

    scrollNext.value = false;
}
function next()
{

    content.value.scrollBy(200,0)
    scroll.value = content.value.scrollLeft;
    if(content.value.scrollWidth == scroll.value)
    {
        scrollNext.value = true;
    }

}
fetch();
  categories();

 onMounted( () => {




});

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

<style>
.catContainer::-webkit-scrollbar {
    display: block;
}

</style>
