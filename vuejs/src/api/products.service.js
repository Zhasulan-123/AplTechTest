import httpAdmin from "@/api/http.admin";

/**
 * Created by on 19/08/2023.
 */
const productsService = {
  get() {
    return httpAdmin.get('products')
  },
  getId(id) {
    return httpAdmin.get(`product/${id}`)
  },
  create(product) {
    return httpAdmin.post('product/create', product)
  },
  update(product) {
    return httpAdmin.put(`product/update/${product.id}`, product)
  }
};

export default productsService;