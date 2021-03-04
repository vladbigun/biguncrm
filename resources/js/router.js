import VueRouter from 'vue-router';

import test from './components/test';
import Orders from './components/pages/orders';
import newOrders from './components/pages/newOrders';
import newProduct from './components/pages/newProduct';
import oneOrder from './components/pages/oneOrders';
import product from './components/pages/product';

export default new VueRouter({
	routes : [
        {
        path: '/orders',
        component : Orders
        },
        {
        path: '/orders/New',
        component : newOrders,
        name: 'orderNew'
        },
        {
        path: '/product/New',
        component : newProduct,
        name: 'productNew'
        },
        {
        path: '/product',
        component : product
        },
        {
        path: '/payment',
        component : test
        },
        {
        path: '/orders/:id',
        component : oneOrder,
        name: 'oneOrder'
        }
	],
	mode: 'history'
});