<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    nome_usuario: '',
    data_nascimento: '',
    foto: null,
    email: '',
    password: '',
    password_confirmation: '',
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

        <form @submit.prevent="submit" enctype="multipart/form-data">
            <div>
                <InputLabel for="name" value="Nome" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="nome_usuario" value="Nome de Usuário" />

                <TextInput
                    id="nome_usuario"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.nome_usuario"
                    required
                    autofocus
                    autocomplete="nome_usuario"
                />

                <InputError class="mt-2" :message="form.errors.nome_usuario" />
            </div>

            <div class="mt-4">
                <InputLabel for="data_nascimento" value="Data de Nascimento" />

                <TextInput
                    id="data_nascimento"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.data_nascimento"
                    required
                    autofocus
                    autocomplete="data_nascimento"
                />

                <InputError class="mt-2" :message="form.errors.data_nascimento" />
            </div>

            <div class="mt-4">
                <InputLabel for="foto" value="Foto de Perfil" />

                <TextInput
                    id="foto"
                    type="file"
                    class="mt-1 block w-full"
                    @input="form.foto = $event.target.files[0]"
                    required
                    autofocus
                    autocomplete="foto"
                />

                <InputError class="mt-2" :message="form.errors.foto" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

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
                <InputLabel for="password" value="Senha" />

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
                <InputLabel for="password_confirmation" value="Confirme sua Senha" />

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
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                >
                Já possui uma conta?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Registrar
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
