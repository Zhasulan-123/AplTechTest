<template>
   <div class="container-fluid">
     <Header />
     <div class="container mb-5">
         <div class="row" style="margin-top: 6%;">
            <div class="col">
               <div class="card">
                  <h5 class="card-header text-center text-bg-primary">Списки Товары
                  <span class="float-end">
                     <!-- Button trigger modal -->
                     <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Добваить
                     </button>
                  </span>
                  </h5>
                  <div class="card-body">
                  <table class="table">
                     <thead>
                        <tr>
                        <th scope="col">№</th>
                        <th scope="col">Название</th>
                        <th scope="col">Категория</th>
                        <th scope="col">Имя бренда</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Рекомендованная цена</th>
                        <th scope="col">Статус</th>
                        <th scope="col"></th>
                        </tr>
                     </thead>
                     <tbody>
                        <AdminList 
                           v-for="item in products"
                           :key="item.id"
                           :item="item"
                        />
                     </tbody>
                  </table>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-xl">
            <div class="modal-content">
               <form @submit.prevent="submit">
               <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Добавить товар</h1>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
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
                                 <label class="form-label">Рекомендованная цена:</label>
                                 <input type="text" v-model="product.rrp_price" class="form-control">
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
                                 <label class="form-label">Категория:</label>
                                 <input type="text" v-model="product.category_name" class="form-control">
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
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                  <button type="submit" class="btn btn-primary">Добавить</button>
               </div>
              </form>
            </div>
         </div>
      </div>

   </div>
</template>
  
<script>
import productsService from "@/api/products.service";
import Header from '@/components/Admin/Header.vue';
import AdminList from "@/components/Admin/AdminList.vue";

export default {
   name: 'Admin',
   components: { Header, AdminList },
   data() {
      return {
         products: [],
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
   mounted() {
      this.productsAll()
   },
   methods: {
      async productsAll(){
           const {data} = await productsService.get();
           this.products = data;
      },
      async submit() {
         const {success, status, message} = await productsService.create(this.product);
         if (status) {
            document.location.reload();
         }
      },
   },
}
</script>