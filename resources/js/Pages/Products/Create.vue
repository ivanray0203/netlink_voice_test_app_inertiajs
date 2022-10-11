<template>
    <div>
        <Head title="Create Product" />

        <h1 class="text-3xl">Create New Product</h1>

        <form @submit.prevent="submit" class="max-w-md mx-auto mt-8">
            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name">
                    Name
                </label>
                <input v-model="form.name" class="border border-gray-400 p-2 w-full" type="text" name="name" id="name"/>
                <div v-if="form.errors.name" v-text="$page.props.errors.name" class="text-red-500 text-xs mt-1"></div>
            </div>

            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="description">
                    Description
                </label>
                <input v-model="form.description" class="border border-gray-400 p-2 w-full" type="text" name="description" id="description"/>
                <div v-if="form.errors.description" v-text="$page.props.errors.description" class="text-red-500 text-xs mt-1"></div>
            </div>

            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="category">
                    Category
                </label>
                <select v-model="form.category_id" class="border border-gray-400 p-2 w-full" type="text" name="descripcategorytion" id="category">
                    <option v-for="category in categories.data" :key="category.id" :value="category.id">{{ category.name }}</option>
                </select>
                <div v-if="form.errors.category_id" v-text="$page.props.errors.category_id" class="text-red-500 text-xs mt-1"></div>
            </div>

            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="quantity">
                    quantity
                </label>
                <input v-model="form.quantity" class="border border-gray-400 p-2 w-full" type="text" name="quantity" id="quantity"/>
                <div v-if="form.errors.quantity" v-text="$page.props.errors.quantity" class="text-red-500 text-xs mt-1"></div>
            </div>

            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="price">
                    price
                </label>
                <input v-model="form.price" class="border border-gray-400 p-2 w-full" type="text" name="price" id="price"/>
                <div v-if="form.errors.price" v-text="$page.props.errors.price" class="text-red-500 text-xs mt-1"></div>
            </div>

            <div class="mb-6">
                <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" :disabled="form.processing">Submit</button>
            </div>
        </form>
        <ul>
        </ul>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3'

let props = defineProps({
    categories: Object
})

let form = useForm({
    name: '',
    description: '',
    category_id: null,
    price: null,
    quantity: null
})

let submit = () => {
    form.post('/products')
}
</script>
