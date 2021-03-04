<template>
<div><h1>Новый заказ</h1>
	
<form @submit.prevent="addPost">
   <div class="row text-white">
   	<div class="col-lg-4 bg-dark">
   		<div class="form-group">
   			<label>Данные получателя: {{ $route.params.id }}</label>
   			<input v-model="post.surname" placeholder="Фамилия" type="text" id="surname">
		    <input v-model="post.name" placeholder="Имя" type="text" id="name">
			<input v-model="post.middle_name" placeholder="Отчество" type="text" id="middle_name">
   		</div>
   		<div class="form-group">
   			<input v-model="post.phone_number" placeholder="Номер телефона" type="text" id="phone_number">
   		</div>
   			<div class="form-group">
   				<textarea v-model="post.message" placeholder="Комментарий к заказу"></textarea>
   			</div>
   	</div>
   	 	<div class="col-lg-4 bg-dark">
   	 		<label>Тип доставки:</label>
        <div class="form-group">
   			<p>Дроп цена заказа: {{post.sum_purchase_price}} ₴</p>
   			<input v-model="post.sum_price" placeholder="Наложеный платеж" type="text">
   		</div>
   	 	</div>
   	 	<div class="col-lg-4 bg-dark">
   	 		<label>Детали доставки:</label>

   	 	</div>
   </div>
<div class="form-group">
   			<select v-on:click="sumOrder" v-model="post.product" id="product">
    <option value="off" disabled>Выбирите товар</option>
    <option v-for="post in posts" :value="post.id">{{post.title}} - {{post.teg}}</option>
   </select>
   		</div>

		<button type="submit">Добавить</button>
	</form>
	
	</div>
</template>
<script>
export default {
	data() {
		return {
			posts: [],
			post:{
				id: '',
				name: '',
				surname: '',
				price: 0,
            product: 'off'
			},
			post_id: '',
			pagination: {},
			loading: true,
			errored: false
		}
	},
	mounted(){
           this.getPosts();
	},
	methods: {
		sumOrder: function(){
			for(let i = 0; i < this.posts.length; i++)
				if(this.posts[i]['id'] == this.post.product)
					this.post.sum_purchase_price = this.posts[i]['purchase_price']


		},
		addPost(){
				axios
               .post('/api/orders', {
               	   name: this.post.name,
               	   surname: this.post.surname,
               	   middle_name: this.post.middle_name,
               	   phone_number: this.post.phone_number,
               	   product: this.post.product,
               	   sum_purchase_price: this.post.sum_purchase_price,
               	   sum_price: this.post.sum_price,
               	   message: this.post.message
               })
               .then(response => {
                    console.log(response)
               	  
               	})
	           .catch(error => console.log(error))
			     
		},
		getPosts(){
           axios
			.get('/api/product')
			.then(response => this.posts = response.data.data)
	        .catch(error => this.errored = true)
	        .finally(() => this.loading = false)
		}
	}
}
</script>
