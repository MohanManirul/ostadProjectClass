<template>
  <div class="container">
    <h1>My Vue App</h1>
  
  <div v-if="isLoading">
      <div >Loading...</div>
  </div>
  <div v-else >
    <table class="table table-striped">

        <thead class="">

          <tr>
            <th>title</th>
            <th>category</th>
            <th>price</th>
          </tr>

        </thead>



        <tbody>
          <tr v-for="item in products" :key="item.id" >
            <td>{{item.title}}</td>
            <td>{{item.category}}</td>
            <td>{{item.price}}</td>
          </tr>
        </tbody>

      </table>
  </div>

    <router-view></router-view>

  </div>
</template>

<script setup >
import { ref } from "vue";


  const products = ref([]) ;
  const isLoading = ref(false) ;

  callApi()

  async function callApi() {
    isLoading.value = true ;
    const res = await fetch("https://dummyjson.com/products");
   
    const data = await res.json();
    
    
    products.value = data.products ;
    isLoading.value = false ;

  }

</script>