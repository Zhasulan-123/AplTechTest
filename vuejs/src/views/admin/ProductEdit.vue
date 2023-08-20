<template>
  <div class="container-fluid">
        <Header />
        <div class="card mt-5">
            <div class="card-body">
                <h5 class="card-title text-center mb-5">Редактирование товара</h5>
                <form @submit.prevent="update">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Название:</label>
                                    <input type="text" v-model="product.name" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Категория:</label>
                                    <input type="text" v-model="product.category_name" class="form-control">
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Имя бренда:</label>
                                    <input type="text" v-model="product.brand_name" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Цена:</label>
                                    <input type="text" v-model="product.price" class="form-control">
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Рекомендованная цена:</label>
                                    <input type="text" v-model="product.rrp_price" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Статус:</label>
                                    <select v-model="product.status" class="form-select form-select-lg mb-3" aria-label="Large select example">
                                        <option value="1" selected>В наличии</option>
                                        <option value="2">Под заказ</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                     <button type="submit" class="btn btn-primary float-end">обновить</button>
                </form>

            </div>
        </div>
  </div>
 </template>
   
 <script>
 import productsService from "@/api/products.service";
 import Header from '@/components/Admin/Header.vue';
 
 export default {
    name: 'Admin',
    components: { Header },
    data() {
       return {
          productId: {},
          product: {
            name: '',
            category_name: '',          
            brand_name: '',          
            price: '',          
            rrp_price: '',          
            status: ''      
         },
       }
    },
    mounted(){
        this.getProductId(this.$route.params.id)
    },
    methods: {
        async getProductId(productId){
           const {data} = await productsService.getId(productId);
           this.product = data;
        },
        async update() {
         const {data} = await productsService.update(this.product);
          if(data){
            this.$router.push('/admin')
          }
      },
    },
 }
 </script>