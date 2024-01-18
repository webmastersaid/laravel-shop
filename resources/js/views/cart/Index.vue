<script>
export default {
    data() {
        return {
            productsInCart: [],
            userName: null,
            userEmail: null,
            userAddress: null
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
        },
        orderProducts() {
            const productsToOrder = {
                'products': this.productsInCart,
                'name': this.userName,
                'email': this.userEmail,
                'address': this.userAddress,
                'total_price': this.totalPrice
            }
            axios.post('/api/order', productsToOrder)
                .then(res => {
                    console.log(res)
                })
        },
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
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    Total quantity:
                    <span class="fs-5">{{ totalQuantity }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input v-model="userName" type="text" class="form-control" id="name" placeholder="Bob">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input v-model="userEmail" type="email" class="form-control" id="email" placeholder="bob@mail.com">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input v-model="userAddress" type="text" class="form-control" id="address" placeholder="City, street">
                </div>
                <div class="mb-3">
                    Total price:
                    <span class="fs-4">$ {{ totalPrice }}</span>
                </div>
                <div class="mb-3">
                    <button @click="orderProducts" class="btn btn-outline-primary px-5">Order</button>
                </div>
            </div>
        </div>
    </main>
</template>