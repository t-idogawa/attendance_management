<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


defineProps({
  id: String,
  note: Object
})
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">お知らせ</h2>
          <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <div class="p-6 text-gray-900 text-center font-bold text-xl">{{ note.title }}<br /></div>
                  <p class="text-gray-900 text-center font-bold">{{ note.content }}</p>
                </div>
            </div>
          </div>
    </template>
  </AuthenticatedLayout>
  
</template>