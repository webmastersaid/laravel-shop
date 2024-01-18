<script>
export default {
    data() {
        return {
            product: [],
            productQty: 0,
            productCount: 1,
        }
    },
    methods: {
        getProduct(id) {
            axios.get(`/api/products/${id}`)
                .then(res => {
                    this.product = res.data.data
                })
            let productsInCart = localStorage.getItem('cart')
            productsInCart = JSON.parse(productsInCart)
            if (productsInCart) {
                productsInCart.forEach(productInCart => {
                    if (productInCart.id === id) {
                        this.productQty = +productInCart.qty
                    }
                })
            }
        },
        addToCart(id, isSingle = false) {
            let cart = localStorage.getItem('cart')
            let productToCart = [
                {
                    'id': id,
                    'qty': this.productQty,
                },
            ]
            if (!cart) {
                this.productQty = 1
                productToCart[0].qty = +this.productQty
                localStorage.setItem('cart', JSON.stringify(productToCart))
            } else {
                cart = JSON.parse(cart)
                cart.forEach(productInCart => {
                    if (productInCart.id === id) {
                        if (isSingle) {
                            productInCart.qty += 1
                        } else {
                            productInCart.qty = +productInCart.qty + (+this.productCount)
                        }
                        this.productQty = +productInCart.qty
                        productToCart = null
                    }
                })
                Array.prototype.push.apply(cart, productToCart)
                localStorage.setItem('cart', JSON.stringify(cart))
            }
            this.productCount = 1
        },
        addProductQty() {
            this.productCount += 1
        },
        removeProductQty() {
            this.productCount -= 1
        },
        getProductQty(id) {
            let productsInCart = localStorage.getItem('cart')
            productsInCart = JSON.parse(productsInCart)
            if (productsInCart) {
                productsInCart.forEach(productInCart => {
                    if (productInCart.id === +id) {
                        this.productQty = productInCart.qty
                    }
                })
            } else {
                this.productQty = 0
            }
        },
    },
    mounted() {
        this.getProduct(this.$route.params.id)
        this.getProductQty(this.$route.params.id)
    },
    updated() {
        this.getProductQty(this.$route.params.id)
    },
}
</script>
<template>
    <main class="container">
        <h1>Product - {{ product.title }}</h1>
        <div class="row">
            <div class="col-lg-4">
                <img class="img-fluid" :src="product.detail_image" :alt="product.detail_image">
                <template v-if="product.product_images" v-for="productImage in product.product_images">
                    <img :src="productImage.url" class="img-fluid w-25" :alt="productImage.url">
                </template>
                <img class="img-fluid w-25" :src="product.preview_image" :alt="product.preview_image">
            </div>
            <div class="col-lg-8">
                <h2>{{ product.title }}</h2>
                <div v-if="product.group_products" class="d-flex align-items-center">
                    Colors:
                    <template v-for="groupProducts in product.group_products">
                        <span @click="getProduct(groupProducts.id)" v-for="color in groupProducts.colors"
                            class="color-circle m-1" :style="'background-color: #' + color.title + ';'"
                            :title="groupProducts.title"></span>
                        <small>
                            {{ groupProducts.title }}
                        </small>
                    </template>
                </div>
                <div v-if="product.description">Description:
                    <p class="fs-5">{{ product.description }}</p>
                </div>
                <div class="fs-4">Price: $ <strong>{{ product.price }}</strong></div>
                <div v-if="product.content">Content:
                    <p class="fs-5">{{ product.content }}</p>
                </div>
                <div class="row col-lg-6 g-1">
                    <span v-if="productQty > 0">
                        In cart: {{ productQty }}
                    </span>
                    <div class="d-flex">
                        <div class="m-1">
                            <button @click="removeProductQty" class="btn btn-outline-primary">-</button>
                        </div>
                        <div class="m-1">
                            <input v-model="productCount" type="text" class="form-control">
                        </div>
                        <div class="m-1">
                            <button @click="addProductQty" class="btn btn-outline-primary">+</button>
                        </div>
                    </div>
                    <button @click="addToCart(product.id)" type="button" class="btn btn-primary">
                        Add to cart
                    </button>
                </div>
            </div>
        </div>
    </main>
</template>