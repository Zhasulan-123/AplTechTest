<template>
    <tr>
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
    </tr>
</template>
  
<script>
  export default {
      name: "UserList",
      props: ["item"],
  }
</script>