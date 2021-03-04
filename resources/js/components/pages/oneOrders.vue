<template>
<div><h1>Заказ #{{order.id}}</h1>
	
<form v-if="!loading">
   <div class="row p-2">
   	<div class="col-lg-3">
   		<div class="bg-white p-2">

   <label>Данные получателя:</label>
               <div class="form-row">
                  <div class="col-md-4 mb-3">
                     <label>Фамилия</label>
                     <input v-model="order.surname" type="text" class="form-control" disabled>
                  </div>
                  <div class="col-md-4 mb-3">
                     <label>Имя</label>
                     <input v-model="order.name" type="text" class="form-control" disabled>
                  </div>
                  <div class="col-md-4 mb-3">
                     <label>Отчество</label>
                     <input v-model="order.middle_name" type="text" class="form-control" disabled>
                  </div>
               </div>
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label>Номер телефона</label>
                     <input v-model="order.phone_number" type="text" class="form-control" disabled>
                  </div>
               </div>
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label>Комментарий к заказу</label>
                     <textarea v-model="order.message" type="text" class="form-control" disabled></textarea>
                  </div>
               </div>
   	</div>
   	</div>
   	 	<div class="col-lg-3">
   	 		<div class="bg-white p-2">
   	 		<label>Данные доставки:</label>
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label>Сумма наложеного платежа</label>
                     <input v-model="order.sum_price" type="text" class="form-control" disabled>
                  </div>
               </div>
   		</div>


   	 	</div>
   	 	<div class="col-lg-3">
   	 		<div class="bg-white p-2">
<div v-if="!np.loading">
   	 		<label>{{order.ttn}}</label>
  <div class="form-row">
    <div class="col-md-12 mb-3">
      <label>Статус доставки</label>
      <input v-model="np.Status" type="text" class="form-control" disabled>
    </div>
  </div>
  <div class="form-row">
   <div class="col-md-12 mb-3">
      <label>Стоимость доставки</label>
      <input v-model="np.DocumentCost" type="text" class="form-control" disabled>
    </div>
  </div>
</div>
<div v-else>
   <div class="form-row">
    <div class="col-md-12 mb-3">
      <label>ТТН</label>
      <input v-model="order.ttn" type="text" class="form-control">
    </div>
  </div>
</div>
</div>

   	 	</div>
   	 	<div class="col-lg-3">
   	 		<div class="bg-white p-2">
   	 		<label>Дополнительно</label>
            <p>Дроп цена: {{order.sum_purchase_price}} ₴</p>
            <div class="form-row">
               <div class="col-md-12 mb-3">
                  <label>Статус</label>
                  <select v-on:change="statusСhange()" class="form-control" v-model="order.status" id="status">
                     <option value="В обработке">В обработке</option>
                     <option value="Упакован">Упакован</option>
                     <option value="Отправлен">Отправлен</option>
                     <option value="Закрыт">Закрыт</option>
                     <option value="Удален">Удален</option>
                  </select>
                </div>
            </div>
            <div class="form-row">
               <div class="col-md-12 mb-3">
                  <label>Дата создания</label>
                     <input v-model="order.created_at" type="text" class="form-control" disabled>
                </div>
            </div>
            <div class="form-row">
               <div class="col-md-12 mb-3">
                  <label>Дата изменения</label>
                     <input v-model="order.updated_at" type="text" class="form-control" disabled>
                </div>
            </div>
   	 	</div>
   	 	</div>
   </div>
   <div class="row p-2">
   	<div class="col-lg-12 mt-4 mb-4"><h3>Товары</h3></div>
   	<div class="col-lg-3">
   		<div class="bg-white p-2">
  <p>{{product.title}} ({{product.teg}})</p>
<img style="width: 100%;" v-bind:src="'/storage/product_images/'+product.teg+'.jpeg'">
   		</div>
   	  </div>
   </div>
	</form>
	<div v-else>Загрузка!</div>
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
				product: '',
            status: '',
			},
			product: {
            title: ''
         },
         np: {
            loading: true
         },
			loading: true,
			errored: false
		}
	},
	mounted(){
           this.getPost(this.$route.params.id);      
	},
	methods: {
      date(date){
         return (new Date(date)).toLocaleString()
      },
		getPost(id){
			
		 axios
			.get('/api/orders/' + id)
			.then(response =>{
            this.getProduct(response.data.data.product);
            this.order = response.data.data
            this.order.created_at = this.date(this.order.created_at)
            this.order.updated_at = this.date(this.order.updated_at)
            if(this.order.ttn)this.statusNP()
         })
	        .catch(error => this.errored = true)
	        .finally(() => this.loading = false)
			
		},
		getProduct(id){
			
		 axios
			.get('/api/product/' + id)
			.then(response => this.product = response.data.data)
	        .catch(error => this.errored = true)
	        .finally(() => this.loading = false)
			
		},
      statusNP(){
         const dataNP = {
            "apiKey": "2c2e0c400880596b554eb22a0a0c6867",
            "modelName": "TrackingDocument",
            "calledMethod": "getStatusDocuments",
            "methodProperties": {
               "Documents": [
                  {
                  "DocumentNumber": this.order.ttn,
                  "Phone": ""
                  },
               ]
            }
         }

         axios({
            url: 'https://api.novaposhta.ua/v2.0/json/',
            method: 'POST',
            data: dataNP
         })
         .then(response => {
            this.np = response.data.data['0']
            console.log(this.np)
         })
         .catch(error => this.errored = true)
         .finally(() => this.np.loading = false)


      },
      statusСhange: function(){
         axios
         .put('/api/orders/' + this.order.id, {
              status: this.order.status,
              ttn: this.order.ttn
         })
         .then(response => {
            console.log(response)
            this.getPost(this.$route.params.id);
         })
           .catch(error => this.errored = true)
           .finally(() => this.loading = false)
      }
	}
}
</script>
