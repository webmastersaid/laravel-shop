<script>
export default {
    data() {
        return {
            products: [],
            modalProduct: null,
        }
    },
    mounted() {
        this.getProducts()
    },
    methods: {
        getProducts() {
            axios.get('/api/products')
                .then(res => {
                    this.products = res.data.data
                    console.log(this.products)
                })
        },
        getProduct(id) {
            axios.get(`/api/products/${id}`)
                .then(res => {
                    this.modalProduct = res.data.data
                    console.log(this.modalProduct)
                }).then(() => {
                    document.getElementById(`product_${this.modalProduct.id}`).click()
                })
        },
    }
}
</script>
<template>
    <main class="container">
        <h1>Products</h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <template v-for="product in products">
                <div v-if="product.is_published" class="col">
                    <div class="card shadow-sm">
                        <img :src="product.preview_image" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ product.title }}</h5>
                            <p class="card-text">{{ product.description }}</p>
                            <div class="text-body-secondary">$ {{ product.price }}</div>
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="btn-group">
                                    <button @click="getProduct(product.id)" type="button" class="btn btn-outline-secondary">
                                        Quick view
                                    </button>
                                    <button type="button" class="btn btn-primary">Add to cart</button>
                                </div>
                            </div>
                            <div :id="`product_${product.id}`" data-bs-toggle="modal"
                                :data-bs-target="`#productModal_${product.id}`" class="d-none"></div>
                        </div>
                    </div>
                    <div class="modal fade" :id="`productModal_${product.id}`" tabindex="-1"
                        :aria-labelledby="`productLabel_${product.id}`" aria-hidden="true">
                        <div v-if="modalProduct" class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" :id="`productLabel_${modalProduct.id}`">{{
                                        modalProduct.title }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img v-if="modalProduct.preview_image" :src="modalProduct.preview_image"
                                        :alt="modalProduct.preview_image" class="img-fluid">
                                    <div v-if="modalProduct.description">Description:
                                        <p>{{ modalProduct.description }}</p>
                                    </div>
                                    <div v-if="modalProduct.content">Content:
                                        <p>{{ modalProduct.content }}</p>
                                    </div>
                                    <img v-if="modalProduct.detail_image" :src="modalProduct.detail_image"
                                        :alt="modalProduct.detail_image" class="img-fluid">
                                    <div v-if="modalProduct.group_products" class="d-flex align-items-center">
                                        Colors:
                                        <template v-for="groupProducts in modalProduct.group_products">
                                            <span @click="getProduct(groupProducts.id)"
                                                v-for="color in groupProducts.colors" class="color-circle m-1"
                                                :style="'background-color: #' + color.title + ';'"></span>
                                        </template>
                                    </div>
                                    <div>Price: $ <strong>{{ modalProduct.price }}</strong></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary">Order</button>
                                    <button type="button" class="btn btn-primary">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </main>
</template>