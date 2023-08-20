<template>
  <tr>
    <td>{{item.id}}</td>
    <td>{{item.name}}</td>
    <td>{{item.category_name}}</td>
    <td>{{item.brand_name}}</td>
    <td>{{item.price}}</td>
    <td>{{item.rrp_price}}</td>
    <td>
       <span class="text-success" v-if="item.status === 1">&nbsp; В наличии</span>
       <span class="text-danger" v-if="item.status === 2">&nbsp; Под заказ</span>
    </td>
    <td>
       <router-link :to="'/admin/edit/' + item.id">
          <Pencil />
      </router-link>
    </td>
  </tr>
</template>

<script>
import Pencil from '@/icons/Pencil.vue';

export default {
    name: "AdminList",
    props: ["item"],
    components: {
      Pencil,
    },
}
</script>