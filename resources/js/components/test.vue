<template>
<div><h1>Страница в разработке...</h1>
<p>Если у вас возникла проблема обратитесь к разработчику в <a href="https://t.me/Vlad_Bigun">Telegram</a></p>
<p>Ваш id #{{user.id}}</p>
<p>Ваш email: {{user.email}}</p>
</div>
</template>
<script>
export default{
	data(){
		return{
	    	user: {
	    		id: 0
	    	}
	 	}
	},
	mounted(){
	    axios.get('/user').then((res) =>{
	    	this.user = res.data
	    	console.log(res)
	    })
	}
}
</script>