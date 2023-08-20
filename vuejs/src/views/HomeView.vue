<template>
  <div class="container-fluid">
    <Header />
    <div class="container mb-5">
      <div class="row" style="margin-top: 6%;">
        <div class="col">
          <button class="btn btn-warning float-end position-relative" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <CartIcon />
               Корзина
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              {{ cart.length}}+
            </span>
          </button>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h3 class="text-primary">Списки тавара</h3>
            <div class="row">
              <CartList 
                v-for="list in products"
                :key="list.id"
                :list="list"
                @add="add"
              />
            </div>
        </div>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Корзина</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="card">
                    <div class="card-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">№</th>
                            <th scope="col">Название</th>
                            <th scope="col">Категория</th>
                            <th scope="col">Имя бренда</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Цена Акция</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Кол-во</th>
                            <th scope="col">Сумма</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody v-if="cart.length > 0">
                          <tr v-for="item in cart" :key="item.id">
                              <td>{{item.id}}</td>
                              <td>{{item.name}}</td>
                              <td>{{item.category_name}}</td>
                              <td>{{item.brand_name}}</td>
                              <td>{{item.price}}т</td>
                              <td>{{item.rrp_price}}т</td>
                              <td>
                                <span class="text-success" v-if="item.status === 1">&nbsp; В наличии</span>
                                <span class="text-warning" v-if="item.status === 2">&nbsp; Под заказ</span>
                              </td>
                              <td>{{item.qty}}</td>
                              <td>{{item.price * item.qty}}т</td>
                              <td>
                                <a href="#" @click="remove(item.id)">
                                    <Delete />
                                </a>
                              </td>
                          </tr>
                          <tr scope="col">
                            <td colspan="7" class="fw-bold">
                                Общая сумма: <span class="text-danger">{{total}} тенге</span>
                            </td>
                          </tr>
                          <tr scope="col" v-if="cart.length > 0">
                            <td colspan="7" class="fw-bold">
                                Кол-во тавара: <span class="text-danger">{{ cart.length}} шт</span>
                            </td>
                          </tr>
                        </tbody>
                        <tbody v-else>
                          <tr>
                              <td colspan="7" class="text-center text-danger">Корзина пусто!!!</td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                  <button type="button" class="btn btn-danger" @click="clearCart">Очистить</button>
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="handleOrders">Оформить</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal-end -->
      </div>
    </div>
  </div>
</template>

<script>

import productsService from "@/api/products.service";
import CartList from '@/components/Cart/CartList.vue';
import Delete from '@/icons/Delete.vue';
import CartIcon from '@/icons/CartIcon.vue';
import Header from '@/components/Header/Header.vue';

export default {
  name: 'HomeView',
  components: {
    CartList,
    Delete,
    CartIcon,
    Header
  },
  data() {
    return {
        products: [],
        cart: []
    }
  },
  methods: {
    async productsAll(){
      const {data} = await productsService.get();
      this.products = data;
    },
    handleOrders(){
      this.$router.push("/admin/orders");
    },
    createLocalStorage(){
      localStorage.removeItem("cart");
      localStorage.setItem("cart", JSON.stringify(this.cart));
    },
    add(product){
      this.products[product.id - 1].inCart = true;
      this.products[product.id - 1].qty = product.qty;
      this.cart.push(product);
      this.createLocalStorage();
    },
    remove(id){
      for(let index = 0; index < this.cart.length; index++){
        const cart_item_id = this.cart[index].id;
        if(cart_item_id == id){
            this.cart.splice(index, 1);
            for(let i = 0; i < this.products.length; i++){
              if(cart_item_id == this.products[i].id){
                this.products[i].inCart = false;
                this.createLocalStorage();
              }
            }
        }
        let cartLocalStorage = JSON.parse(localStorage.getItem("cart"));
        if(cartLocalStorage == 0){
          localStorage.removeItem("cart");
          console.clear();
        }
      }
    },
    clearCart(){
      this.cart = [];
      localStorage.removeItem("cart");
      console.clear();
      for(let i = 0; i < this.products.length; i++){
        this.products[i].inCart = false;
      }
    },
    cartLocalStorage(){
      if(localStorage.getItem("cart")){
        let cartLocalStorage = JSON.parse(localStorage.getItem("cart"));
        return cartLocalStorage;
      }else{
        return [];
      }
    },
  },
  computed: {
    total(){
      let i = 0;
      for(let index = 0; index < this.cart.length; index++){
          i += this.cart[index].price * this.cart[index].qty;
      }
      return i;
    },
  },
  mounted() {
    this.productsAll();
    this.cart = this.cartLocalStorage();
    for(let index = 0; index < this.products.length; index++){
        const product = this.products[index];
        if(localStorage.getItem("cart")){
          let cartLocalStorage = JSON.parse(localStorage.getItem("cart"));
          for(let i = 0; i < cartLocalStorage.length; i++){
            const cartItem = cartLocalStorage[i];
            if(product.id == cartItem.id){
              product.inCart = true;
            }
          }
        }
    }
    
  },
}
</script>

<style scoped>
.list_pointer {
  cursor: pointer;
  line-height: 1.5;
}
</style>