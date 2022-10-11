<template>
    <div>
      <div class="flex justify-between mb-6">
        <div class="flex item-center">
          <h1 class="text-3xl font-bold">Products</h1>
        </div>
        <div class="flex item-center justify-center">
            <input
          v-model="search"
          type="text"
          placeholder="Search..."
          class="border px-2 rounded-lg"
        />
        <div class="flex justify-center">
  <div class="form-check form-switch ml-2 flex item-center text-center justify-center">
    <input v-model="with_stocks" class="form-check-input appearance-none w-9 mr-2 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm" type="checkbox" role="switch" id="flexSwitchCheckDefault">
    <label class="form-check-label inline-block text-gray-800" for="flexSwitchCheckDefault">With Stocks</label>
  </div>
</div>
      </div>
            
        </div>
        
  
      <div class="mt-4">
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500">
        <thead
          class="
            text-xs text-gray-700
            uppercase
            bg-gray-50
            
          "
        >
          <tr>
            <th scope="col" class="py-3 px-6">Name</th>
            <th scope="col" class="py-3 px-6">Description</th>
            <th scope="col" class="py-3 px-6">Price</th>
            <th scope="col" class="py-3 px-6">Quantity</th>
            <th scope="col" class="py-3 px-6">Category</th>
            <th scope="col" class="py-3 px-6">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="product in products.data"
            :key="product.id"
            class="bg-white border-b"
          >
            <th
              scope="row"
              class="
                py-4
                px-6
                font-medium
                text-gray-900
                whitespace-nowrap
              "
            >
              {{ product.name }}
            </th>
            <td class="py-4 px-6">
              {{ product.description }}
            </td>
            <td class="py-4 px-6">
              {{ product.price }}
            </td>
            <td class="py-4 px-6">
              {{ product.quantity }}
            </td>
            <td class="py-4 px-6">
              {{ product.category.name }}
            </td>
            <td class="py-4 px-6">
              <button class="text-blue-500" @click="showProduct(product.id)"
                >Edit</button
              > | 
              <button class="text-red-500"
                @click="deleteProduct(product.id)"
                >Delete</button
              >
            </td>
          </tr>
        </tbody>
      </table>
  
          <div>
            <!-- <div class="mt-6">
              <Link
                v-for="link in users.links"
                :key="link.url"
                :href="link.url"
                v-html="link.label"
                :class="{ 'text-gray-500': !link.url, 'font-bold': link.active }"
              />
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ExclamationCircleOutlined } from "@ant-design/icons-vue";
  import { ref, watch, createVNode } from "vue";
  import { Inertia } from '@inertiajs/inertia'
  import throttle from 'lodash/throttle'
  import { Modal, notification } from "ant-design-vue";
  
  let props = defineProps({
    products: Object,
    search: String,
    with_stocks: String
  });
  
  let search = ref(props.search.search);
  let with_stocks = ref(true)

  const showProduct = (id) => {
    Inertia.get(`/products/${id}`)
  }

  const deleteProduct = (id) => {
    Modal.confirm({
    title: "Do you Want to delete these Product?",
    icon: createVNode(ExclamationCircleOutlined),
    onOk() {
        Inertia.delete(`/products/${id}`, {
            onFinish: () => {
                notification.success({
                message: "Product Deleted Successfully!",
          });
            }
        })
    },
    onCancel() {
      console.log("Cancel");
    },
    class: "test",
  });
  }
  
  watch(search, throttle(function (value) {
    Inertia.get('/products', {search: value, with_stocks: with_stocks.value}, {
      preserveState: true,
      replace: true
    })
  }, 500))

  watch(with_stocks, throttle(function (value) {
    Inertia.get('/products', {search: search.value, with_stocks: value}, {
      preserveState: true,
      replace: true
    })
  }, 500))
  </script>
  