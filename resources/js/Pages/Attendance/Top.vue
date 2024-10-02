<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted, reactive, ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';

defineProps({
  statusMessage: ""
});

// リアクティブなデータを定義
const data = reactive({
  appName: "",
  currentTime: "00:00:00",
  currentDate: "",
  week: ['（日）', '（月）', '（火）', '（水）', '（木）',  '（金）', '（土）'] ,
});

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
  console.log('通過');
}

/**
 * 退勤時間を記録
 */
const clockOut = () => {
  Inertia.post(route('attendance.clockOut'));
  console.log('通過2');
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

      <div class="py-12 ">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <div class="p-6 text-gray-900 text-center font-bold text-xl">{{ data.currentDate }}<br />
                    <p class="text-gray-900 text-center font-bold text-6xl">{{ data.currentTime }}</p>
                  </div>
                  <div class="buttons">
                    <p>isClockedIn: {{ data.isClockedIn }}</p>
                    <button @click="clockIn">出勤</button>
                    <button @click="clockOut">退勤</button>
                    <button @click="breakIn">休憩入</button>
                    <button @click="breakOut">休憩出</button>
                  </div>
              </div>
          </div>
      </div>
  </AuthenticatedLayout>
</template>