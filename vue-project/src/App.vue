<template>
  <div>
    <h1>My Vue App</h1>
    <p>{{ products }}</p>
    <router-view></router-view>
  </div>
</template>

<script setup >
import { ref } from "vue";


  const products = ref([]) ;
callApi()
  async function callApi() {
    const res = await fetch("https://dummyjson.com/products");
   
    const data = await res.json();
    console.log(data);
    
    products.value = data ;
  }
</script>