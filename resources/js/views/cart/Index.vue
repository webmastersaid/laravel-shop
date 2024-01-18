<script>
export default {
    data() {
        return {
            productsInCart: [],
        }
    },
    methods: {
        getProductsInCart() {
            this.productsInCart = JSON.parse(localStorage.getItem('cart'))
        },
        addProductQty(product) {
            product.qty++
        },
        removeProductQty(product) {
            if (product.qty === 0) return
            product.qty--
        },
        removeProductFromCart(id) {
            this.productsInCart = this.productsInCart.filter(product => {
                return product.id !== id
            })
        },
        updateProductsInCart() {
            localStorage.setItem('cart', JSON.stringify(this.productsInCart))
        }
    },
    computed: {
        totalPrice() {
            let price = 0
            this.productsInCart.forEach(product => {
                price += product.price * product.qty
            })
            return price
        },
        totalQuantity() {
            let quantity = 0
            this.productsInCart.forEach(product => {
                quantity += product.qty
            })
            return quantity
        },
    },
    mounted() {
        this.getProductsInCart()
    },
    updated() {
        this.updateProductsInCart()
    }
}
</script>
<template>
    <main class="container">
        <h1>Cart</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total price</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="productInCart in productsInCart">
                    <tr v-if="productInCart.qty > 0">
                        <td>
                            <RouterLink :to="{ name: 'products.show', params: { id: productInCart.id } }">
                                <img :src="productInCart.preview_image" :alt="productInCart.title" width="200">
                            </RouterLink>
                        </td>
                        <td>
                            <RouterLink :to="{ name: 'products.show', params: { id: productInCart.id } }">
                                {{ productInCart.title }}
                            </RouterLink>
                        </td>
                        <td>$ {{ productInCart.price }}</td>
                        <td>
                            <div class="d-flex">
                                <div class="m-1">
                                    <button @click="removeProductQty(productInCart)"
                                        class="btn btn-outline-primary">-</button>
                                </div>
                                <div class="m-1">
                                    <input v-model="productInCart.qty" type="text" class="form-control">
                                </div>
                                <div class="m-1">
                                    <button @click="addProductQty(productInCart)" class="btn btn-outline-primary">+</button>
                                </div>
                            </div>
                        </td>
                        <td>
                            $ {{ productInCart.price * productInCart.qty }}
                        </td>
                        <td>
                            <button @click="removeProductFromCart(productInCart.id)" class="btn btn-transparent">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path
                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <table class="table">
            <tbody>
                <tr>
                    <th>Total quantity:</th>
                    <td>{{ totalQuantity }}</td>
                    <th>Total price:</th>
                    <td>$ {{ totalPrice }}</td>
                    <td class="d-flex justify-content-end">
                        <button class="btn btn-outline-primary px-5">Order</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
</template>