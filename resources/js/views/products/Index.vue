<script>
export default {
    data() {
        return {
            products: [],
            modalProduct: null,
            filters: [],
            price: {
                min: 0,
                max: 0,
            }
        }
    },
    mounted() {
        this.getProducts()
        this.getFilter()
    },
    methods: {
        getProducts() {
            axios.get('/api/products')
                .then(res => {
                    this.products = res.data.data
                })
        },
        getProduct(id) {
            axios.get(`/api/products/${id}`)
                .then(res => {
                    this.modalProduct = res.data.data
                }).then(() => {
                    document.getElementById(`product_${this.modalProduct.id}`).click()
                })
        },
        getFilter() {
            axios.get('/api/products/filter')
                .then(res => {
                    this.filters = res.data
                    if (res.data.price.min) {
                        this.price.min = res.data.price.min
                    }
                    if (res.data.price.max) {
                        this.price.max = res.data.price.max
                    }
                    console.log(this.filters)
                })
        },
    }
}
</script>
<template>
    <main class="container">
        <h1>Products</h1>
        <ul class="nav justify-content-end mb-2">
            <li class="nav-item m-1">
                <div class="nav-link text-dark">Filter: </div>
            </li>
            <li class="nav-item m-1">
                <div class="dropdown">
                    <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                        data-bs-auto-close="outside">
                        Categories
                    </button>
                    <ul class="dropdown-menu">
                        <li v-for="category in filters.categories">
                            <div class="dropdown-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" :value="category.id"
                                        :id="`category_${category.id}`">
                                    <label class="form-check-label" :for="`category_${category.id}`">
                                        {{ category.title }}
                                    </label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item m-1">
                <div class="dropdown">
                    <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                        data-bs-auto-close="outside">
                        Tags
                    </button>
                    <ul class="dropdown-menu">
                        <li v-for="tag in filters.tags">
                            <div class="dropdown-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" :value="tag.id" :id="`tag_${tag.id}`">
                                    <label class="form-check-label" :for="`tag_${tag.id}`">
                                        {{ tag.title }}
                                    </label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item m-1">
                <div class="dropdown">
                    <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                        data-bs-auto-close="outside">
                        Colors
                    </button>
                    <ul class="dropdown-menu">
                        <li v-for="color in filters.colors">
                            <div class="dropdown-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" :value="color.id"
                                        :id="`color_${color.id}`">
                                    <label class="form-check-label d-flex justify-content-between"
                                        :for="`color_${color.id}`">
                                        <div>#{{ color.title }}</div>
                                        <div class="color-circle" :style="`background-color: #${color.title};`"></div>
                                    </label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item m-1">
                <div class="dropdown">
                    <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                        data-bs-auto-close="outside">
                        Price
                    </button>
                    <ul class="dropdown-menu p-4">
                        <li>
                            <div class="mb-3">
                                <label for="priceFrom" class="form-label">From</label>
                                <input type="text" class="form-control" id="priceFrom" :placeholder="price.min">
                            </div>
                            <div class="mb-3">
                                <label for="priceTo" class="form-label">To</label>
                                <input type="text" class="form-control" id="priceTo" :placeholder="price.max">
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item m-1">
                <button class="btn btn-primary">Apply</button>
            </li>
        </ul>
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
                                    <div v-if="modalProduct.product_images" class="row">
                                        <div v-for="productImage in modalProduct.product_images" class="col-4">
                                            <img :src="productImage.url" class="img-fluid" :alt="productImage.url">
                                        </div>
                                    </div>
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