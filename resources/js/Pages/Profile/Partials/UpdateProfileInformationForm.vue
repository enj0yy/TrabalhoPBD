<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

const form = useForm({
    nome: user.nome,
    email: user.email,
    biografia: user.biografia,
});

const submit = () => {
    form.put(route('profile.update'));
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Informaçoes do Perfil</h2>
        </header>

        <form @submit.prevent="submit" class="mt-6 space-y-6">
            <div>
                <InputLabel for="nome" value="Nome" />

                <TextInput
                    id="nome"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.nome"
                    required
                    autofocus
                    autocomplete="nome"
                />

                <InputError class="mt-2" :message="form.errors.nome" />
            </div>

            <div>
                <InputLabel for="biografia" value="Biografia" />

                <TextArea
                    id="biografia"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.biografia"
                    autofocus
                    autocomplete="biografia"
                />

                <InputError class="mt-2" :message="form.errors.biografia" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Salvar</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Salvo.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
