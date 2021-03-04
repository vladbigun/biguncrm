<template>
<div><h1>Новый заказ</h1>
  <div></div>
	<div v-for="error in validationErrors" class="alert alert-danger mt-1 p-2 position-relative" role="alert">{{error}}</div>
<form @submit.prevent="newPost">
   <div class="row p-2">
    <div class="col-lg-4">
      <div class="bg-white p-2">
        <h3 class="mb-4">Данные получателя:</h3>
               <div class="form-row">
                  <div class="col-md-4 mb-3">
                     <label>Фамилия</label>
                     <input v-model="order.surname" type="text" class="form-control">
                  </div>
                  <div class="col-md-4 mb-3">
                     <label>Имя</label>
                     <input v-model="order.name" type="text" class="form-control">
                  </div>
                  <div class="col-md-4 mb-3">
                     <label>Отчество</label>
                     <input v-model="order.middle_name" type="text" class="form-control">
                  </div>
               </div>
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label>Номер телефона</label>
                     <input v-model="order.phone_number" type="text" class="form-control">
                  </div>
               </div>
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label>Комментарий к заказу</label>
                     <textarea v-model="order.message" type="text" class="form-control"></textarea>
                  </div>
               </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="bg-white p-2">
        <h3 class="mb-4">Данные получателя:</h3>
        <h5 class="pb-3">Дроп цена заказа: {{order.sum_purchase_price}}₴</h5>
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                      <span>Способ доставки</span>
                       <div class="form-check">
                          <input class="form-check-input" value="np" type="radio" v-model="deliveryMethod" id="delivery_np">
                          <label class="form-check-label" for="delivery_np">
                            Новая почта
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" value="pickup" type="radio" v-model="deliveryMethod" id="delivery_pickup">
                          <label class="form-check-label" for="delivery_pickup">
                            Самовывоз
                          </label>
                        </div>
                        <div class="pt-3">
                          <div v-if="deliveryMethod == 'np'">
                             <span>Способ оплаты</span>
                            <div class="form-check">
                              <input class="form-check-input" value="prepayment" type="radio" v-model="payMethod" id="prepayment">
                              <label class="form-check-label" for="prepayment">
                                Предоплата
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" value="imposedNP" type="radio" v-model="payMethod" id="imposedNP">
                              <label class="form-check-label" for="imposedNP">
                                Наложенный платеж
                              </label>
                            </div>
                             <div v-if="payMethod == 'imposedNP'">
                                <div class="input-group">
                                    <input v-model="order.sum_price" type="text" class="form-control" aria-label="Amount">
                                    <div class="input-group-append">
                                      <span class="input-group-text">₴</span>
                                    </div>
                                  </div>
                             </div>
                             <div v-else>
                                <div class="input-group">
                                    <input v-model="сardNumber" type="text" class="form-control" aria-label="Amount" disabled>
                                    <div class="input-group-append">
                                      <span class="input-group-text">Номер карты</span>
                                    </div>
                                  </div>
                             </div>
                          </div>
                          <div v-else>
                              <div class="form-row">
                                <div class="col-md-12 mb-3">
                                   <div class="input-group">
                                    <input v-model="order.sum_price" placeholder="Сумма к оплате" type="text" class="form-control" aria-label="Amount">
                                    <div class="input-group-append">
                                      <span class="input-group-text">₴</span>
                                    </div>
                                  </div>
                                    <p>Мостонахождение: ТРЦ "Глобал". <br>Клиент должен сказать id заказа, статут должен быть "Упакован"</p>
                                </div>
                             </div>
                          </div>
                        </div>
                  </div>
               </div>
      </div>
    </div>

<div class="col-lg-4">
      <div v-if="deliveryMethod == 'np'" class="bg-white p-2">

        <h3 class="mb-4">Детали доставки</h3>
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                       <label>Выбирите город</label>
                       <input class="form-control" placeholder="Начните вводить" v-on:change="npsity()" type="text" v-model="AddressGeneral">
                       <select v-on:change="ondelNP()" class="custom-select" v-model="order.sity" id="size">
                          <option value="off" disabled>Выбирите город</option>
                          <option v-for="сity in novapost.city" :value="сity">{{сity.DescriptionRu}}</option>
                       </select>
               </div>
              </div>
              <div v-if="order.sity != 'off'" class="form-row">
                  <div class="col-md-12 mb-3">
                       <label>Выбирите отделение</label>
                       <select class="custom-select" v-model="order.branch" id="size">
                          <option value="off" disabled>Выбирите отделение</option>
                          <option v-for="otdel in novapost.otdel" :value="otdel">{{otdel.DescriptionRu}}</option>
                       </select>
               </div>
              </div>
      </div>
    </div>


   </div>

      <div class="form-group">
   			<select class="custom-select" v-on:change="sumOrder" v-model="order.product" id="product">
        <option value="off" disabled>Выбирите товар</option>
        <option v-for="product in products" :value="product">{{product.title}} - {{product.teg}}</option>
        </select>
   		</div>
      <div v-if="order.product != 'off'" class="form-group">
        <select class="custom-select" v-model="order.size" id="size">
          <option value="off" disabled>Выбирите размер</option>
          <option v-for="size in order.product.sizes" :value="size.title_size">{{size.title_size}}</option>
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
      products: {},
			order:{
				id: '',
				name: '',
				surname: '',
				price: 0,
        product: 'off',
        size: 'off',
        sum_purchase_price: 0,
        sity: 'off'
			},
      AddressGeneral: '',
      novapost: {
        city: '',
        otdel: '',
      },
			post_id: '',
			pagination: {},
			loading: true,
			errored: false,
      validationErrors: '',
      deliveryMethod: 'np',
      payMethod: 'imposedNP',
      сardNumber: '4441114443408156'
		}
	},
	mounted(){
           this.getPosts();
           
	},
	methods: {
		sumOrder: function(){
					this.order.sum_purchase_price = this.order.product.purchase_price
		},
    npsity: function(){
                     if(this.AddressGeneral.length >= 3) this.adressNP();
    },
    newPost(){
        if(this.deliveryMethod == "np") this.recipientNP()
        else this.addPost('')
    },
		addPost(NPttn){
				axios
               .post('/api/orders', {
               	   name: this.order.name,
               	   surname: this.order.surname,
               	   middle_name: this.order.middle_name,
               	   phone_number: this.order.phone_number,
               	   product: this.order.product.id,
               	   sum_purchase_price: this.order.sum_purchase_price,
               	   sum_price: this.order.sum_price,
               	   message: this.order.message,
                   ttn: NPttn,
               })
               .then(response => {
                    console.log(response)
               	    this.$router.push('/orders')
               	})
	           .catch(error => { 
              console.log(error.response.data.errors)
              this.validationErrors = error.response.data.errors
            })

		},
		getPosts(){
           axios
			.get('/api/product')
			.then(response => {
        this.products = response.data;
        console.log(response.data);
      })
	        .catch(error => this.errored = true)
	        .finally(() => this.loading = false)
		},
  adressNP(){
         const dataNP = {
            "apiKey": "2c2e0c400880596b554eb22a0a0c6867",
            "modelName": "Address",
            "calledMethod": "getCities",
            "methodProperties": {
              "FindByString": this.AddressGeneral
            }
         }

         axios({
            url: 'https://api.novaposhta.ua/v2.0/json/',
            method: 'POST',
            data: dataNP
         })
         .then(response => {
            this.novapost.city = response.data.data
            console.log(this.novapost.city)
         })
         .catch(error => this.errored = true)
         .finally(() => this.loading = false)


      },
  ondelNP(){
       //console.log(this.order.sity)
         const dataNP = {
            "apiKey": "2c2e0c400880596b554eb22a0a0c6867",
            "modelName": "Address",
            "calledMethod": "getWarehouses",
            "methodProperties": {
               "CityRef": this.order.sity.Ref
            }
         }

         axios({
            url: 'https://api.novaposhta.ua/v2.0/json/',
            method: 'POST',
            data: dataNP
         })
         .then(response => {
            this.novapost.otdel = response.data.data
            console.log(this.novapost.otdel)
         })
         .catch(error => this.errored = true)
         .finally(() => this.loading = false)


      },
      recipientNP(){
         const dataNP = {
            "apiKey": "2c2e0c400880596b554eb22a0a0c6867",
            "modelName": "Counterparty",
            "calledMethod": "save",
            "methodProperties": {
              "FirstName": this.order.name,
              "MiddleName": this.order.middle_name,
              "LastName": this.order.surname,
              "Phone": this.order.phone_number,
              "Email": "",
              "CounterpartyType": "PrivatePerson",
              "CounterpartyProperty": "Recipient"
            }
         }

         axios({
            url: 'https://api.novaposhta.ua/v2.0/json/',
            method: 'POST',
            data: dataNP
         })
         .then(response => {
            this.novapost.agent = response.data.data
            console.log('agent:')
            console.log(this.novapost.agent)
            this.documentNP()
         })
         .catch(error => this.errored = true)
         .finally(() => this.loading = false)


      },
      documentNP(){
        console.log('document:')
         const dataNP = {
            "apiKey": "2c2e0c400880596b554eb22a0a0c6867",
            "modelName": "InternetDocument",
            "calledMethod": "save",
            "methodProperties": {
              "PayerType": "Recipient",
              "PaymentMethod": "Cash",
              "DateTime": "25.02.2021",
              "CargoType": "Parcel",
              "VolumeGeneral": "0.01",
              "Weight": "0.5",
              "ServiceType": "WarehouseWarehouse",
              "SeatsAmount": "1",
              "Description": "Одяг",
              "Cost": "300",
              "CitySender": "db5c88c4-391c-11dd-90d9-001a92567626",
              "Sender": "f91af453-b136-11e9-9937-005056881c6b",
              "SenderAddress": "eda917da-3e8f-11e6-a9f2-005056887b8d",
              "ContactSender": "f9203b48-b136-11e9-9937-005056881c6b",
              "SendersPhone": "380674122103",
              "CityRecipient": this.order.sity.Ref,
              "Recipient": this.novapost.agent.['0'].Ref,
              "RecipientAddress": this.order.branch.Ref,
              "ContactRecipient": this.novapost.agent.['0'].ContactPerson.data.['0'].Ref,
              "RecipientsPhone":  this.order.phone_number
            }
         }

         axios({
            url: 'https://api.novaposhta.ua/v2.0/json/',
            method: 'POST',
            data: dataNP
         })
         .then(response => {
            console.log('Создание ТТН:')
            console.log(response)
            this.addPost(response.data.data.['0'].IntDocNumber)

         })
         .catch(error => this.errored = true)
         .finally(() => this.loading = false)


      },
}
}
</script>
