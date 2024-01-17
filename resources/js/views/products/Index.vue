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
            },
            filter: {
                categories: [],
                tags: [],
                colors: [],
                prices: [],
                page: null,
            },
            sort: 'min',
            pagination: [],
            productQty: 0,
            productCount: 1,
        }
    },
    mounted() {
        this.getProducts()
        this.getFilter()
    },
    methods: {
        getProducts(page = 1) {
            this.filter.page = page
            axios.post('/api/products', this.filter)
                .then(res => {
                    this.products = res.data.data
                    this.pagination = res.data.meta
                })
        },
        getProduct(id) {
            axios.get(`/api/products/${id}`)
                .then(res => {
                    this.modalProduct = res.data.data
                }).then(() => {
                    document.getElementById(`product_${this.modalProduct.id}`).click()
                })
            let productsInCart = localStorage.getItem('cart')
            productsInCart = JSON.parse(productsInCart)
            productsInCart.forEach(productInCart => {
                if (productInCart.id === id) {
                    this.productQty = +productInCart.qty
                }
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
                })
        },
        getFilteredProducts() {
            this.getProducts()
        },
        resetFilteredProducts() {
            this.filter.categories = []
            this.filter.tags = []
            this.filter.colors = []
            this.filter.prices = []
            this.getFilteredProducts()
        },
        sortBy() {
            switch (this.sort) {
                case 'min':
                    this.products.sort((a, b) => a.price - b.price)
                    break;
                case 'max':
                    this.products.sort((a, b) => b.price - a.price)
                    break;
                case 'a-z':
                    this.products.sort((a, b) => {
                        const titleA = a.title.toUpperCase()
                        const titleB = b.title.toUpperCase()
                        if (titleA < titleB) {
                            return -1;
                        }
                        if (titleA > titleB) {
                            return 1;
                        }
                        return 0;
                    })
                    break;
                case 'z-a':
                    this.products.sort((a, b) => {
                        const titleA = a.title.toUpperCase()
                        const titleB = b.title.toUpperCase()
                        if (titleA > titleB) {
                            return -1;
                        }
                        if (titleA < titleB) {
                            return 1;
                        }
                        return 0;
                    })
                    break;
                default:
                    break;
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
                this.productCount = 0
            } else {
                cart = JSON.parse(cart)
                cart.forEach(productInCart => {
                    if (productInCart.id === id) {
                        if (isSingle) {
                            productInCart.qty += 1
                        } else {
                            productInCart.qty = +productInCart.qty + (+this.productCount)
                            this.productCount = 0
                        }
                        this.productQty = +productInCart.qty
                        productToCart = null
                    }
                })
                Array.prototype.push.apply(cart, productToCart)
                localStorage.setItem('cart', JSON.stringify(cart))
            }
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
        }
    }
}
</script>
<template>
    <main class="container">
        <h1>Products</h1>
        <ul class="nav justify-content-end mb-2">
            <li class="nav-item m-1">
                <div class="nav-link text-dark">Sort by: </div>
            </li>
            <li class="nav-item m-1">
                <select v-model="sort" :on-select="sortBy()" class="form-select" aria-label="Default select example">
                    <option value="min">Min price</option>
                    <option value="max">Max price</option>
                    <option value="a-z">A-Z</option>
                    <option value="z-a">Z-A</option>
                </select>
            </li>
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
                                    <input v-model="filter.categories" class="form-check-input" type="checkbox"
                                        :value="category.id" :id="`category_${category.id}`">
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
                                    <input v-model="filter.tags" class="form-check-input" type="checkbox" :value="tag.id"
                                        :id="`tag_${tag.id}`">
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
                                    <input v-model="filter.colors" class="form-check-input" type="checkbox"
                                        :value="color.id" :id="`color_${color.id}`">
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
                                <input v-model="filter.prices[0]" type="text" class="form-control" id="priceFrom"
                                    :placeholder="price.min">
                            </div>
                            <div class="mb-3">
                                <label for="priceTo" class="form-label">To</label>
                                <input v-model="filter.prices[1]" type="text" class="form-control" id="priceTo"
                                    :placeholder="price.max">
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item m-1">
                <button @click="resetFilteredProducts" class="btn btn-secondary">Reset</button>
            </li>
            <li class="nav-item m-1">
                <button @click="getFilteredProducts" class="btn btn-primary">Apply</button>
            </li>
        </ul>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 pb-5">
            <template v-for="product in products">
                <div v-if="product.is_published" class="col">
                    <div class="card shadow-sm">
                        <RouterLink :to="{ name: 'products.show', params: { id: product.id } }">
                            <img :src="product.preview_image" :alt="product.preview_image" class="card-img-top">
                        </RouterLink>
                        <div class="card-body">
                            <h5 class="card-title">
                                <RouterLink :to="{ name: 'products.show', params: { id: product.id } }">
                                    {{ product.title }}
                                </RouterLink>
                            </h5>
                            <p class="card-text">{{ product.description }}</p>
                            <div class="text-body-secondary">$ {{ product.price }}</div>
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="btn-group">
                                    <button @click="getProduct(product.id)" type="button" class="btn btn-outline-secondary">
                                        Quick view
                                    </button>
                                    <button @click="addToCart(product.id, true)" type="button" class="btn btn-primary">Add
                                        to
                                        cart</button>
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
                                        :alt="modalProduct.preview_image" class="img-fluid pb-2">
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
                                                :style="'background-color: #' + color.title + ';'"
                                                :title="groupProducts.title"></span>
                                            <small>
                                                {{ groupProducts.title }}
                                            </small>
                                        </template>
                                    </div>
                                    <div>Price: $ <strong>{{ modalProduct.price }}</strong></div>
                                </div>
                                <div class="modal-footer">
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
                    </div>
                </div>
            </template>
        </div>
        <nav v-if="pagination.last_page > 1" class="d-flex justify-content-center" aria-label="Page navigation example">
            <ul class="pagination">
                <li v-if="pagination.current_page !== 1" class="page-item">
                    <a @click.prevent="getProducts(pagination.current_page - 1)" class="page-link" href="#"
                        aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <template v-for="link in pagination.links">
                    <template v-if="+link.label">
                        <li v-if="(pagination.current_page - link.label < 2 &&
                            pagination.current_page - link.label > -2) ||
                            +link.label === 1 ||
                            +link.label === pagination.last_page"
                            :class="link.active ? 'page-item active' : 'page-item'">
                            <a @click.prevent="getProducts(link.label)" class="page-link" href="#">{{ link.label }}</a>
                        </li>
                        <li v-if="pagination.current_page !== 3 &&
                            (pagination.current_page - link.label === 2 ||
                                pagination.current_page - link.label === -2)">
                            <span class="page-link">...</span>
                        </li>
                    </template>
                </template>
                <li v-if="pagination.current_page !== pagination.last_page" class="page-item">
                    <a @click.prevent="getProducts(pagination.current_page + 1)" class="page-link" href="#"
                        aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </main>
</template>