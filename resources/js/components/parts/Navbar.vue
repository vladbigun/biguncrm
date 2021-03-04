<template>

<div class="side-menu">
	<div class="logo"><img src="/img/favicon.png"></div>
	<ul class="nav">
	 	<router-link tag="li" to="/"><img class="icon" src="/img/glav.svg"></router-link>
	 	<router-link tag="li" to="/product"><img class="icon" src="/img/product.svg"></router-link>
	 	<router-link tag="li" to="/orders"><img class="icon" src="/img/orders.svg"></router-link>
		<router-link tag="li" to="/payment"><img class="icon" src="/img/money.svg"></router-link>
		<a href="/logout"><li><img class="icon" src="/img/exid.svg"></li></a>
		<!-- <router-link tag="li" to="/setings"><img class="icon" src="/img/setings.svg"></router-link> -->
	</ul>
</div>
</template>
