<template>
  <div class="col mt-3">
    <div class="card text-center fw-bold" style="width: 18rem;">
        <div class="card-header text-bg-secondary">{{list.name}}</div>
        <div class="card-body">
            <p class="card-text"><span class="text-danger">{{list.category_name}}</span></p>
            <p class="card-text"><span class="text-danger">{{list.brand_name}}</span></p>
            <p class="card-title" v-if="list.brand_name != 'Dell' && 'Lenovo' && list.status != 2">
              <span class="text-black">Цена:</span>
              <span class="text-danger">&nbsp;{{list.price}} тенге</span>
            </p>
            <p class="card-title" v-if="list.status === 2">
              <span class="text-success">Цена по запросу</span>
            </p>
            <p class="card-title" v-if="list.brand_name === 'Dell' && 'Lenovo'">
              <span class="text-danger">Цена Акция:</span>
              {{list.rrp_price}}
            </p>
            <p class="card-title">
              <span class="text-success" v-if="list.status === 1">&nbsp; В наличии</span>
              <span class="text-warning" v-if="list.status === 2">&nbsp; Под заказ</span>
            </p>
            <p>
              Кол-во:
              <input type="number" class="form-control number_w" v-model="list.qty" min="1" max="30" step="1" />
              <InCart v-if="list.inCart" />
            </p>
            <span v-if="list.inCart" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
              <CartIcon />+
            </span>
        </div>
        <div class="card-footer">
          <a href="#" class="btn btn-primary position-relative" @click="addCart" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <CartIcon />
              в корзину
          </a>
        </div>
    </div>
  </div>
</template>

<script>
import CartIcon from '@/icons/CartIcon.vue';
import InCart from '@/icons/InCart.vue';

export default {
   name: 'CartList',
   props: ["list"],
   components: {
      CartIcon,
      InCart
   },
   methods: {
    addCart(){
      this.$emit('add', this.list);
    }
   },
}
</script>

<style scoped>
.number_w{
   width: 4rem;
   display: inline;
}
</style>