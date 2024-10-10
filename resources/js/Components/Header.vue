<template>
  <header class="bg-white text-blue-900 shadow-md h-20">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center h-full">
      <div class="flex items-center space-x-3">
        <div class="text-2xl font-bold">
          <!-- Imagen con tamaño adaptado al header -->
          <img src="/images/LOGOCTI.png" alt="Logo Fundación CTI" class="max-h-13 w-auto">
        </div>
      </div>

      <div class="flex items-center space-x-6">
        <nav class="hidden md:block">
          <ul class="flex space-x-6">
            <li><a href="home" class="hover:underline">Home</a></li>
            <li><a href="programs" class="hover:underline">Programs</a></li>
            <li><a href="contact" class="hover:underline">Contact us</a></li>
          </ul>
        </nav>
        <a href="/donation">
          <button class="flex items-center space-x-2 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded">
            Donate
          </button>
        </a>

        <a href="/dashboard">
          <button class="flex items-center space-x-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
            <UserIcon class="w-6 h-6" />
          </button>
        </a>

        <!-- Widget de Google Translate -->
        <div id="google_translate_element" class="ml-4"></div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { UserIcon } from 'lucide-vue-next'
import { onMounted } from 'vue'

// Función para cargar dinámicamente el script de Google Translate
const loadGoogleTranslateScript = () => {
  const script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
  document.head.appendChild(script);
};

// Función que inicializa el traductor
window.googleTranslateElementInit = () => {
  new google.translate.TranslateElement(
    {
      pageLanguage: 'en',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
    },
    'google_translate_element'
  );
};

// Cargar el script cuando el componente se monta
onMounted(() => {
  loadGoogleTranslateScript();
});
</script>


