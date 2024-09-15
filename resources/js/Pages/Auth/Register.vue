<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

// コントローラーから渡された店舗情報を取得
defineProps({
    stores: Array
});

const form = useForm({
    last_name: '',
    first_name: '',
    last_name_kana: '',
    first_name_kana: '',
    gender: '',
    email: '',
    phone: '',
    birthday: '',
    post_code: '',
    address: '',
    store_id: '',
    password: '',
    password_confirmation: '',
    // terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div class="flex space-x-4">
                <div class="w-1/2">
                    <InputLabel for="last_name" value="名字" />
                    <TextInput
                        id="last_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.last_name"
                        required
                        autofocus
                        autocomplete="last_name"
                    />
                    <InputError class="mt-2" :message="form.errors.last_name" />
                </div>

                <div class="w-1/2">
                    <InputLabel for="first_name" value="名前" />
                    <TextInput
                        id="first_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.first_name"
                        required
                        autocomplete="first_name"
                    />
                    <InputError class="mt-2" :message="form.errors.first_name" />
                </div>
            </div>

            <div class="flex space-x-4">
                <div class="w-1/2">
                    <InputLabel for="last_name_kana" value="名字カナ" />
                    <TextInput
                        id="last_name_kana"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.last_name_kana"
                        required
                        autocomplete="last_name_kana"
                    />
                    <InputError class="mt-2" :message="form.errors.last_name_kana" />
                </div>

                <div>
                    <InputLabel for="first_name_kana" value="名前カナ" />
                    <TextInput
                        id="first_name_kana"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.first_name_kana"
                        required
                        autocomplete="first_name_kana"
                    />
                    <InputError class="mt-2" :message="form.errors.first_name_kana" />
                </div>
            </div>

            <div class="mt-4">
                <InputLabel for="gender" value="性別" />
                <select
                    id="gender"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    v-model="form.gender"
                    required
                >
                    <option value="" disabled>選択してください</option>
                    <option value="0">男性</option>
                    <option value="1">女性</option>
                    <option value="2">その他</option>
                </select>
                <InputError class="mt-2" :message="form.errors.gender" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="メールアドレス" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="phone" value="連絡先｜電話番号" />
                <TextInput
                    id="phone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                    required
                    autocomplete="phone"
                />
                <InputError class="mt-2" :message="form.errors.phone" />
            </div>

            <div class="mt-4">
                <InputLabel for="birthday" value="生年月日" />
                <TextInput
                    id="birthday"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.birthday"
                    required
                />
                <InputError class="mt-2" :message="form.errors.birthday" />
            </div>

            <div class="mt-4">
                <InputLabel for="post_code" value="郵便番号" />
                <TextInput
                    id="post_code"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.post_code"
                    required
                />
                <InputError class="mt-2" :message="form.errors.post_code" />
            </div>

            <div class="mt-4">
                <InputLabel for="address" value="住所" />
                <TextInput
                    id="address"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.address"
                    required
                />
                <InputError class="mt-2" :message="form.errors.address" />
            </div>

            <div class="mt-4">
                <InputLabel for="store_id" value="店舗選択" />

                <select id="store_id" v-model="form.store_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">店舗を選択してください</option>
                    <option v-for="store in stores" :key="store.id" :value="store.id">
                        {{ store.name }}
                    </option>
                </select>

                <InputError class="mt-2" :message="form.errors.store_id" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="パスワード" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="パスワード（確認）" />
                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
