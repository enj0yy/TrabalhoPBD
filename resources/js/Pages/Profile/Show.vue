<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

</script>

<style>
.seguindo_btn:hover{
    background-color: #b94b4b !important;
    transition:0.2s
}
.seguindo_btn:hover span {
  display:none
}
.seguindo_btn:hover:before {
  content:"Deixar de seguir";
  transition:0.2s
}
</style>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
            <img :src="'/img/'+ user.foto" class="w-20 h-20 rounded-full">
            <p class="dark:text-white mt-5">{{user.nome}}    <small class="dark:text-gray-500 ml-1">@{{user.nome_usuario}}</small></p> 
            
            <p class="dark:text-gray-300 mt-2">{{user.biografia}}</p>
            
            <p class="dark:text-gray-500 mt-2">{{ user.seguidoresCount }} seguidores ‎ ‎ ‎ {{ user.seguindoCount }} seguindo</p>

            <template v-if="user.id != $page.props.auth.user.id">   
                <template v-if="user.seguido">
                    <button 
                    v-on:click="seguir(user)"
                    class="seguindo_btn mt-3 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
                    <span>Seguindo</span>
                </button>
                </template>

                <template v-else>
                <button 
                    v-on:click="seguir(user)"
                    class="mt-3 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
                    Seguir
                </button>
                </template>
            </template>

            <template v-else>
            <a :href="route('profile.edit')">
            <button 
                  class="mt-3 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
                  Editar Perfil
            </button>
            </a>
            </template>
        

            <div class="sm:rounded-lg mt-6">
                <div v-for="publicacao in publicacoes" :key="publicacao.id" class="bg-white dark:bg-slate-800 p-5 shadow-md rounded-lg mb-5"
                style="word-wrap: break-word;">

                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-2">
                    <img :src="'/img/' + publicacao.usuario.foto" alt="{{ publicacao.usuario.nome }}" class="w-10 h-10 rounded-full">
                    <div>
                        <a :href="route('profile.show', publicacao.usuario.nome_usuario)"><p class="text-gray-800 dark:text-white font-semibold">{{ publicacao.usuario.nome }}</p></a>
                        <p class="text-gray-500 text-sm">{{ '@' }}{{ publicacao.usuario.nome_usuario }} a {{ timeSince(publicacao.data_criacao) }}
                        </p>
                    </div>
                    </div>
                </div>


                <div class="mb-4">
                    <p class="text-gray-800 dark:text-slate-300">
                    {{ publicacao.conteudo }}
                    </p>
                </div>

                <div class="flex items-center justify-between text-gray-500">
                    <div class="flex items-center space-x-2">
                    <button v-on:click="like(publicacao)"  class="flex justify-center items-center gap-2 px-2 rounded-full p-1">
                    <template v-if="publicacao.curtida">
                        <svg class="w-5 h-5 fill-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                            d="M12 21.35l-1.45-1.32C6.11 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-4.11 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                        <span class="text-indigo-500">{{ publicacao.curtidasCount }}</span>
                    </template>

                    <template v-else>
                        <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                            d="M12 21.35l-1.45-1.32C6.11 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-4.11 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                        
                        <span class="text-current">{{ publicacao.curtidasCount }}</span>
                    </template>
                    </button>
                    

                    </div>

                    <button class="flex justify-center items-center gap-2 px-2 rounded-full p-1">
                    <svg width="22px" height="22px" viewBox="0 0 24 24" class="w-5 h-5 fill-current"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 13.5997 2.37562 15.1116 3.04346 16.4525C3.22094 16.8088 3.28001 17.2161 3.17712 17.6006L2.58151 19.8267C2.32295 20.793 3.20701 21.677 4.17335 21.4185L6.39939 20.8229C6.78393 20.72 7.19121 20.7791 7.54753 20.9565C8.88837 21.6244 10.4003 22 12 22ZM8 13.25C7.58579 13.25 7.25 13.5858 7.25 14C7.25 14.4142 7.58579 14.75 8 14.75H13.5C13.9142 14.75 14.25 14.4142 14.25 14C14.25 13.5858 13.9142 13.25 13.5 13.25H8ZM7.25 10.5C7.25 10.0858 7.58579 9.75 8 9.75H16C16.4142 9.75 16.75 10.0858 16.75 10.5C16.75 10.9142 16.4142 11.25 16 11.25H8C7.58579 11.25 7.25 10.9142 7.25 10.5Z">
                        </path>
                        </g>
                    </svg>
                    <span>{{ publicacao.comentariosCount }} Comentários</span>
                    </button>
                </div>
            </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>


<script>
function timeSince(datetime) {

var date = new Date(datetime); 

var seconds = Math.floor((new Date() - date) / 1000);

var interval = seconds / 31536000;

if (interval > 1) {
  return Math.floor(interval) + " anos atrás";
}
interval = seconds / 2592000;
if (interval > 1) {
  return Math.floor(interval) + " meses atrás";
}
interval = seconds / 86400;
if (interval > 1) {
  return Math.floor(interval) + " dias atrás";
}
interval = seconds / 3600;
if (interval > 1) {
  return Math.floor(interval) + " horas atrás";
}
interval = seconds / 60;
if (interval > 1) {
  return Math.floor(interval) + " minutos atrás";
}
return Math.floor(seconds) + " segundos atrás";
}

export default {
    props: {
        user: {
            type: Object,
            required: true
        },
        publicacoes: {
            type: Object,
            required: true
        },
    },
    methods : {
    like: function(publicacao) {
      axios.post(route('curtir', publicacao.id))
      .then(response => {
        publicacao.curtida = !publicacao.curtida;
        if (publicacao.curtida)
          publicacao.curtidasCount++;
        else
          publicacao.curtidasCount--;
      })
      .catch(error => {
        alert("Ocorreu um erro ao fazer a requisição");
      });
      
    },

    seguir: function(user) {
      axios.post(route('seguir', user.id))
      .then(response => {
        user.seguido = !user.seguido;
        if (user.seguido)
          user.seguidoresCount++;
        else
          user.seguidoresCount--;
      })
      .catch(error => {
        alert("Ocorreu um erro ao fazer a requisição");
      });
    }
  },
};
</script>
