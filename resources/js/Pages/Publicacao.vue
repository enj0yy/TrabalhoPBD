<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm,router  } from '@inertiajs/vue3';
import { computed, onMounted, onUnmounted, ref } from 'vue';
import axios from "axios";
</script>


<script>

export default {
  
  props: {
    publicacao: Object,
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
      
    }
  },
}

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
</script>


<template>
  <Head title="Home" />

  <AuthenticatedLayout>

    <div class="py-7">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-slate-800 p-5 shadow-md rounded-lg mb-5"
          style="word-wrap: break-word;">

          <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-2">
              <img :src="'./../img/' + publicacao.usuario.foto" alt="{{ publicacao.usuario.nome }}" class="w-10 h-10 rounded-full">
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

          <div v-for="comentario in publicacao.comentarios" :key="comentario.id" 
          class="p-5 mb-5 flex items-center justify-between bg-white dark:bg-slate-800 shadow-md rounded-lg">
            
            <div class="flex items-center space-x-2">
              <img :src="'./../img/' + comentario.foto" alt="{{ comentario.nome }}" class="w-8 h-8 rounded-full mr-3">
              <div>
                <a :href="route('profile.show', comentario.nome_usuario)">
                    
                <p class="text-gray-800 dark:text-white ">
                    {{ comentario.nome }}
                <small class="text-gray-500 text-sm">
                    {{ '@' }}{{ comentario.nome_usuario }} a {{ timeSince(comentario.pivot.data_interacao) }} 
                </small></p> </a>
                
                <p class="text-gray-800 dark:text-slate-300"> {{ comentario.pivot.comentario }}</p>
              </div>
            </div>

          </div>

    </div>
  </div>
</AuthenticatedLayout></template>
