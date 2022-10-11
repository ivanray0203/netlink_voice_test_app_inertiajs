<template>
    <div>
      <nav class="ml-6">
        <ul class="flex space-x-4 list-inside">
          <li>
            <Link
              href="/products"
              class="text-blue-500 hover:underline"
              :class="{ 'font-bold underline': $page.url === '/products' }"
              >Products</Link
            >
          </li>
          <li>
            <Link href="/products/create" class="text-blue-500 hover:underline" :class="{ 'font-bold underline': $page.url === '/products/create' }"
              >Create Product</Link
            >
          </li>
        </ul>
      </nav>
    </div>
  </template>
  
  <script>
  export default {};
  </script>