<template>
<div><h1>Товар</h1>
	<br>
		<div class="tablebox">
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
			</tr>
		</thead>
		<tbody>
			<tr v-for="product in products" :key="product.id">
			<td><img style="width: 100px;" v-bind:src="'img/products/'+product.teg+'.jpeg'"></td>
			<td>{{product.teg}}</td>
			<td>{{product.title}}</td>
			<td>{{product.description}}</td>
			<td>{{product.price}}</td>
			<td>{{product.purchase_price}}</td>
			<td>1{{product.sizes}}</td>
			</tr>
		</tbody>
	</table>
</div>
	
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
				this.products = response.data.data
				console.log(response)
			})
	        .catch(error => this.errored = true)
	        .finally(() => this.loading = false)
		},
	}
}
</script>