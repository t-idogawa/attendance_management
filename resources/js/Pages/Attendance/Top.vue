<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted, reactive, ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';
import NoteList from '@/Components/NoteList.vue';

const props = defineProps({
  statusMessage: "",
  notes: Array,
});

// リアクティブなデータを定義
const data = reactive({
  appName: "",
  currentTime: "00:00:00",
  currentDate: "",
  week: ['（日）', '（月）', '（火）', '（水）', '（木）',  '（金）', '（土）'] ,
});

// お知らせデータを格納する空の定数を定義
const notes = ref([]);
notes.value = props.notes;
console.log(props.notes);

// 現在時刻を取得
const updateTime = () => {
  const now = new Date;
  const hours = String(now.getHours()).padStart(2, '0');
  const minutes = String(now.getMinutes()).padStart(2, '0');
  const seconds = String(now.getSeconds()).padStart(2, '0');
  data.currentTime = `${hours}:${minutes}:${seconds}`;

  const years = String(now.getFullYear());
  const month = String(now.getMonth() + 1).padStart(2, '0');
  const date = String(now.getDate()).padStart(2, '0');
  const days = data.week[now.getDay()];
  data.currentDate = `${years}年${month}月${date}日${days}`;
}

/**
 * 出勤時間を記録
 */
const clockIn = () => {
  Inertia.post(route('attendance.clockIn'));
}

/**
 * 退勤時間を記録
 */
const clockOut = () => {
  Inertia.post(route('attendance.clockOut'));
}

onMounted(() => {
  updateTime();
  setInterval(updateTime, 1000);
});

</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
      <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">勤怠管理TOP</h2>
      </template>

      <div class="py-4">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <div class="p-6 text-gray-900 text-center font-bold text-xl">{{ data.currentDate }}<br />
                    <p class="text-gray-900 text-center font-bold text-6xl">{{ data.currentTime }}</p>
                  </div>
                  <div class="buttons flex justify-center space-x-5 m-2">
                      <button @click="clockIn" class="bg-green-400 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">出勤</button>
                      <button @click="clockOut" class="bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">退勤</button>
                      <button @click="breakIn" class="bg-yellow-400 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">休憩入</button>
                      <button @click="breakOut" class="bg-blue-400 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">休憩出</button>
                  </div>
              </div>
          </div>
      </div>
      <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <NoteList :notes="notes" />
        </div>
      </div>
  </AuthenticatedLayout>
</template>