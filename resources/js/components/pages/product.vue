<template>
<div><h1>Товар</h1>
	<br>
	<div v-if="loading">Загрузка...</div>
	<div v-else class="row">
		<div v-for="product in products" class="col-lg-2">
			<div class="bg-white p-3 mt-3">
				<h4>{{product.title}}</h4>
				<p>{{product.teg}}</p>
			<img style="width: 100%;" v-bind:src="'/storage/product_images/'+product.teg+'.jpeg'">
			<!-- <p>{{product.description}}</p> -->
			<span class="btn-success">{{product.purchase_price}} ₴</span>
			<table>
				<thead>
					<tr>
						<th>Размер</th>
						<th>Наличие</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="size in product.sizes">
						<th>{{size.title_size}}</th>
						<th>{{size.availability}}</th>
					</tr>
				</tbody>
			</table>
			</div>
		</div>
	</div>
	<!--	<div class="tablebox">
	<div v-if="loading">Загрузка...</div>
	<table v-else class="tableOrder">
		<thead>
			<tr>
			<th>Фото</th>
			<th>Артикул</th>
			<th>Название</th>
			<th>Описание</th>
			<th>Цена</th>
			<th>Цена закупки</th>
			<th>Размеры</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="product in products" :key="product.id">
			<td><img style="width: 100px;" v-bind:src="'storage/app/public/product_images/'+product.teg+'.jpeg'"></td>
			<td>{{product.teg}}</td>
			<td>{{product.title}}</td>
			<td>{{product.description}}</td>
			<td>{{product.price}}</td>
			<td>{{product.purchase_price}}</td>
			<td>1{{product.sizes}}</td>
			</tr>
		</tbody>
	</table>
</div> -->
	<router-link tag="div" :to="{ name: 'productNew'}">Новый товар</router-link>
</div>
</template>
<script>
export default {
	data() {
		return {
			products: [],
			product:{
				id: '',
				name: '',
				surname: ''
			},
			product_id: '',
			pagination: {},
			edit: false,
			loading: true,
			errored: false
		}
	},
	mounted(){
		this.getPosts();
	
	},
	methods: {
		getPosts(page_url){
			page_url = page_url || '/api/product'

           axios
			.get(page_url)
			.then(response => {
				this.products = response.data
				console.log(response)
			})
	        .catch(error => this.errored = true)
	        .finally(() => this.loading = false)
		},
	}
}
</script>