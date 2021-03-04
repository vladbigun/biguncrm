<template>
<div><h1>Заказы</h1>
	<br>
	Комментарий
	<input v-model="app.message" type="checkbox">
		<div class="tablebox">

	<div v-if="loading">Загрузка...</div>
	<table v-else class="tableOrder">
		<thead>
			<tr>
			<th>ID</th>
			<th>ФИО</th>
			<th>Номер телефона</th>
			<th v-if="app.message">Комментарий</th>
			<th>ТТН</th>
			<th>Cтатус</th>
			<th>Дроп цена</th>
			<th>Цена</th>
			</tr>
		</thead>
		<tbody>
			<router-link tag="tr" v-for="post in posts" :key="post.id" :to="'/orders/' + post.id">
				<td>{{post.id}}</td>
				<td>{{post.surname}} {{post.name}} {{post.middle_name}}</td>
				<td>{{post.phone_number}}</td>
				<td v-if="app.message">{{post.message}}</td>
				<td>{{post.ttn}}</td>
				<td>{{post.status}}</td>
				<td>{{post.sum_purchase_price}}₴</td>
				<td>{{post.sum_price}}₴</td>
			</router-link>
		</tbody>
	</table>
</div>
	<router-link tag="div" :to="{ name: 'orderNew'}">Добавить</router-link>
</div>
</template>
<script>
export default {
	data() {
		return {
			np: [],
			posts: [],
			post:{
				id: '',
				name: '',
				surname: ''
			},
			app:{
				message: false,
			},
			post_id: '',
			pagination: {},
			edit: false,
			loading: true,
			errored: false
		}
	},
	mounted(){
		this.getPosts();
		this.statusNp();
	},
	methods: {
		getPosts(page_url){
			page_url = page_url || '/api/orders'

           axios
			.get(page_url)
			.then(response => this.posts = response.data.data)
	        .catch(error => this.errored = true)
	        .finally(() => this.loading = false)
		},
		statusNp(){
			        
		}
	}
}
</script>