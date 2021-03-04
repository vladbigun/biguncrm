<template>
<div><h1>Заказы</h1>
	<br>
		<div class="tablebox">
	<div v-if="loading">Загрузка...</div>

	<table v-else class="tableOrder">
		<thead>
			<tr>
			<th>ID</th>
			<th>ФИО</th>
			<th>Номер телефона</th>
			<th>Комментарий</th>
			<th>ТТН</th>
			<th>Cтатус</th>
			<th>Статус доставки</th>
			<th></th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="post in posts" :key="post.id">
			<td>{{post.id}}</td>
			<td>{{post.name}} {{post.surname}} {{post.middle_name}}</td>
			<td>{{post.phone_number}}</td>
			<td>{{post.message}}</td>
			<td>{{post.ttn}}</td>
			<td>{{post.status}}</td>
			<td>Выключено</td>
			<td><router-link tag="div" :to="'/orders/' + post.id">Посмотреть</router-link></td>
			</tr>
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
			post_id: '',
			pagination: {},
			edit: false,
			loading: true,
			errored: false
		}
	},
	mounted(){
		this.getPosts();
		//this.statusNp();
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
				axios({
        		crossDomain: true,
  				method: 'POST',
  				url: 'http://bit.ly/2mTM3nY',
  				headers: {
        		  "content-type": "application/json",
        		},
        		processData: false,
        		data: {}
				})
               .then(response => this.np = response)
	           .catch(error => console.log(error))
			
		},
	}
}
</script>