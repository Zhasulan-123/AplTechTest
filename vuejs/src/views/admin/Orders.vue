<template>
    <div class="container-fluid">
          <Header />
          <div class="card mt-5">
            <h5 class="card-header text-center text-bg-primary">Ваш заказ
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
                    <th scope="col">Цена Акция</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Кол-во</th>
                    <th scope="col">Сумма</th>
                  </tr>
                </thead>
                <tbody v-if="dataList.cart.length > 0">
                  <OrdersList
                    v-for="item in dataList.cart"
                    :key="item.id"
                    :item="item"
                  />
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="9" class="text-center text-danger">Корзина пусто!!!</td>
                  </tr>
                </tbody>
              </table>
              <div class="row" v-if="dataList.cart.length > 0">
                <div class="col clearfix inline_text">
                  <div class="float-start">
                     <p>
                      <strong>
                        Общая сумма: {{total}} тенге
                      </strong>
                     </p>
                     <p>
                      <strong>
                        Кол-во товара: {{ dataList.cart.length}} шт
                      </strong>
                     </p>
                  </div>
                  <div class="float-end">
                    <a href="#" class="btn btn-danger margin_right" @click="clearCart">Удалить</a>
                  </div>
                </div>
              </div>
           </div>
          </div>
    </div>
</template>
     
<script>
   import Header from '@/components/Admin/Header.vue';
   import OrdersList from "@/components/Order/OrdersList.vue";
   
   export default {
      name: 'Orders',
      components: { Header, OrdersList },
      data() {
            return {
                dataList: {
                    cart: []
                },
            }
      },
      methods: {
            clearCart(){
                 this.dataList.cart = [];
                 localStorage.removeItem("cart");
                 console.clear();
                for(let i = 0; i < this.dataList.cart.length; i++){
                    this.dataList.cart[i].inCart = false;
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
            for(let index = 0; index < this.dataList.cart.length; index++){
                i += this.dataList.cart[index].price * this.dataList.cart[index].qty;
            }
            return i;
        },
      },
    mounted() {
        this.dataList.cart = this.cartLocalStorage();
    },
   }
</script>

<style scoped>
.margin_right{
   margin-right: 1rem;
}
.inline_text{
  display: inline;
}
</style>