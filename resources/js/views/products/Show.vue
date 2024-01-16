<script>
export default {
    data() {
        return {
            product: [],
        }
    },
    mounted() {
        this.getProduct(this.$route.params.id)
    },
    methods: {
        getProduct(id) {
            axios.get(`/api/products/${id}`)
                .then(res => {
                    this.product = res.data.data
                })
        },
    }
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
                    <button type="button" class="btn btn-outline-primary">Order</button>
                    <button type="button" class="btn btn-primary">Add to cart</button>
                </div>
            </div>
        </div>
    </main>
</template>