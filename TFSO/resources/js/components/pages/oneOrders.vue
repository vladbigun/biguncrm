<template>
<div><h1>Заказ #{{order.id}}</h1>
	
<form v-if="!loading">
   <div class="row p-2">
   	<div class="col-lg-3">
   		<div class="bg-white p-2">
   		<div class="form-group">
   			<label>Данные получателя:</label>
   			<input class="w-33" disabled v-model="order.surname" placeholder="Фамилия" type="text">
		    <input class="w-33" disabled v-model="order.name" placeholder="Имя" type="text">
			<input class="w-33" disabled v-model="order.middle_name" placeholder="Отчество" type="text">
   		</div>
   		<div class="form-group">
   			<input class="w-100" disabled v-model="order.phone_number" placeholder="Номер телефона" type="text" >
   		</div>
   			<div class="form-group">
   				<textarea class="w-100" disabled v-model="order.message" placeholder="Комментарий к заказу"></textarea>
   			</div>
   	</div>
   	</div>
   	 	<div class="col-lg-3">
   	 		<div class="bg-white p-2">
   	 		<label>Данные доставки:</label>

   		<div class="form-group">
<label>Сумма наложеного платежа:</label>
   			<input class="w-50" disabled v-model="order.sum_price" type="text">
 </div>
   		</div>
   	 	</div>
   	 	<div class="col-lg-3">
   	 		<div class="bg-white p-2">
   	 		<label>{{order.ttn}}</label>
 </div>
   	 	</div>
   	 	<div class="col-lg-3">
   	 		<div class="bg-white p-2">
   	 		<label>Дополнительно</label>
            <p>Дроп цена: {{order.sum_purchase_price}} ₴</p>
            <div class="form-group">
            	<label>Статус:</label>
   			<input class="w-100" disabled v-model="order.status" placeholder="Статус" type="text">
   		</div>
   	 	</div>
   	 	</div>
   </div>
   <div class="row p-2">
   	<div class="col-lg-12 mt-4 mb-4"><h3>Товары</h3></div>
   	<div class="col-lg-3">
   		<div class="bg-white p-2">
  <p>{{product.title}} ({{product.teg}})</p>
<img style="width: 400px;" v-bind:src="'/img/products/'+product.teg+'.jpeg'">
   		</div>
   	  </div>
   </div>

	</form>
	<div v-else>Такого заказа нет!</div>
	</div>
</template>
<script>
export default {
	data() {
		return {
			order:{
				id: '',
				name: '',
				surname: '',
				price: 0,
				product: 1
			},
			product: {},
			loading: true,
			errored: false
		}
	},
	mounted(){
	
	
           this.getPost(this.$route.params.id);
           this.getProduct(this.order.product);
      
     
	
	},
	methods: {
		getPost(id){
			
		 axios
			.get('/api/orders/' + id)
			.then(response => this.order = response.data.data)
	        .catch(error => this.errored = true)
	        .finally(() => this.loading = false)
			
		},
		getProduct(id){
			
		 axios
			.get('/api/product/' + id)
			.then(response => this.product = response.data.data)
	        .catch(error => this.errored = true)
	        .finally(() => this.loading = false)
			
		}
	}
}
</script>
