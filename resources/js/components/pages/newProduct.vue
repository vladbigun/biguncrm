<template>
<div><h1>Новый товар</h1>
  <div></div>
	<div v-for="error in validationErrors" class="alert alert-danger mt-1 p-2 position-relative" role="alert">{{error}}</div>
<form @submit.prevent="addProduct">
<div class="row justify-content-center">
  <div class="col-lg-4 p-2">
          <div class="form-row">
    <div class="col-md-10 mb-3">
      <label for="teg">Название</label>
      <input v-model="product.title" type="text" class="form-control is-valid" id="title" placeholder="Название" required>
      <div class="invalid-feedback">
        Ошибка!
      </div>
    </div>
      <div class="col-md-2 mb-3">
      <label for="teg">Тег</label>
      <input v-model="product.teg" type="text" class="form-control is-valid" id="teg" placeholder="Тег" required>
      <div class="invalid-feedback">
        Ошибка!
      </div>
    </div>
  </div>
     <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="purchase_price">Цена закупки</label>
      <input v-model="product.purchase_price" type="text" class="form-control is-valid" id="purchase_price" placeholder="Цена закупки" required>
      <div class="invalid-feedback">
        Ошибка!
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="price">Цена продажи</label>
      <input v-model="product.price" type="text" class="form-control is-valid" id="price" placeholder="Цена продажи" required>
      <div class="invalid-feedback">
        Ошибка!
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-12 mb-3">
      <label for="purchase_price">Описание</label>
      <textarea v-model="product.description" class="form-control is-valid" placeholder="Описание"></textarea>
      <div class="invalid-feedback">
        Ошибка!
      </div>
    </div>
  </div>
  <div class="form-row">
   <!-- <div class="col-md-6 mb-3">
      <label for="sizes">Размеры</label>
      <select v-model="size" id="size">
    <option value="off" disabled>Выбирите размерную сетку</option>
    <option value="one">S M L XL</option>
    <option value="two">XS M L XL XXL</option>
   </select>
      <div class="invalid-feedback">
        Ошибка!
      </div>
    </div> -->
     <div class="col-md-6 mb-3">
  <label for="category">Категория</label>
   <select v-model="category" id="category">
      <option value="off" disabled>Выбирите категорию</option>
      <option v-for="category in categories" :value="category">{{category.title}}</option>
   </select>
</div>
  </div>


 <div class="form-row">
    <div class="col-md-12 mb-3">
    <input type="file" id="customFile" @change="onAttachmentChange">
</div>
</div>
    <button type="submit" class="btn btn-success">Добавить</button>
  </div>
</div>

	</form>
	
	</div>
</template>
<script>
export default {
	data() {
		return {
     attachment: null,
			product:{
				teg: ''
			},
      category: 'off',
      categories: {},
      size: 'off',
      validationErrors: ''
		}
	},
	mounted(){
      this.getCategory();
	},
	methods: {
    onAttachmentChange (e) {
                this.attachment = e.target.files[0]
    },
		addProduct(){			
        const formData = new FormData()
                formData.append('teg', this.product.teg)
                formData.append('main_image', this.attachment)
                formData.append('title', this.product.title)
                formData.append('purchase_price', this.product.purchase_price)
                formData.append('price', this.product.price)
                formData.append('description', this.product.description)
                formData.append('category', this.category.id)

              axios
               .post('/api/product', formData)
               .then(response => {
                    console.log(response)
               	    this.$router.push('/product')
               	})
	           .catch(error => { 
              console.log(error.response.data.errors)
              this.validationErrors = error.response.data.errors
            })

		},
    getCategory(){
      axios
      .get('/api/category')
      .then(response => {
        this.categories = response.data;
        console.log(response.data);
      })
          .catch(error => this.errored = true)
          .finally(() => this.loading = false)
    }
	}
}
</script>
