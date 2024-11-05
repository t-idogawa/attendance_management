<script setup>
import { Link } from '@inertiajs/vue3';

// 受け取るプロパティを定義
const props = defineProps({
  notes: Array
})

const formatDate = (dateStr) => {
  const date = new Date(dateStr);
  return `${date.getFullYear()}年${date.getMonth() + 1}月${date.getDate()}日`;
};
</script>

<template>
  <!-- <div class="bg-white shadow-sm rounded-lg">
    <h2 class="text-2xl font-bold mb-4 text-center pt-2">お知らせ一覧</h2>
    <ul>
        <li v-for="note in notes" :key="note.id" class="flex justify-between items-center p-4 mx-8">
          <Link :href="route('attendance.note', {id: note.id})" class="flex w-full items-center">
            <p>{{ new Date(note.created_at).toLocaleDateString() }}</p>
            <h3>{{ note.title }}</h3>
          </Link>
        </li>
      </ul>
  </div> -->
  <div class="bg-white shadow-sm rounded-lg">
    <div class="inner w-4/5 mx-auto py-16">
      <h2 class="sub_ttl text-3xl text-center mb-10">お知らせ</h2>
      <ul class="news_list mx-5">
        <li v-for="note in notes" :key="note.id" class="news_list_item py-6 border-b border-gray-300 first:border-t">
          <Link :href="route('attendance.note', {id: note.id})" class="flex relative pr-7">
            <div class="news_list_date text-sm flex items-center mr-4">
              {{ new Date(note.created_at).toLocaleDateString('ja-JP', { year: 'numeric', month: '2-digit', day: '2-digit' }) }}
            </div>
            <div class="news_item bg-[#F6C6A2] rounded-lg text-center w-[6em]">お知らせ</div>
            <p class="flex-grow ml-4">{{ note.title }}</p>
            <div class="arrow w-6 h-0.5 bg-gray-400 absolute top-1/2 right-0 hidden sm:block"></div>
          </Link>
        </li>
      </ul>
    </div>
  </div>
</template>