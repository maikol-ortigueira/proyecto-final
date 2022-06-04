<div class="w-full overflow-hidden rounded-lg shadow-lg sm:flex">
  <div class="w-full sm:w-1/3 max-h-80">
      <img class="w-full h-full  object-cover" :src="receta.fotos[0] ? `/storage/${receta.fotos[0].url}` : ''" :alt="receta.nombre" />
  </div>

  <div class="flex-1 px-6 py-4">
    <a :href="`/recetas/${receta.id}`">
      <h4 class="mb-3 text-xl font-semibold tracking-tight text-gray-800" x-text="receta.nombre"></h4>
    </a>
    <p class="leading-normal text-gray-700" x-html="receta.descripcion"></p>
    <div class="mt-1 mb-4 text-xs">
      <div class="mb-1">
        {{ __('Created by ') }}
        <span x-on:click="buscarPorAutor(receta.autor.id)"
          class="text-secondary-700 hover:text-secondary-400 cursor-pointer" x-text="receta.autor.name">
      </span>
      </div>
      <div class=""> {{ __('Category') }}: <span
          x-on:click="buscaPorCategoria([receta.categoria.id])"
          class="text-secondary-700 hover:text-secondary-400 cursor-pointer" x-text="receta.categoria.nombre">
      </span>
      </div>
    </div>

    <div class="etiquetas flex flex-row gap-2">
      <template x-for="etiqueta in receta.etiquetas">
        <span x-text="etiqueta.nombre" class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-primary-100 bg-primary-600 rounded-full"></span>
      </template>
    </div>
    <div class="mt-4 text-right ml-4">
      <a :href="`/recetas/${receta.id}`" class="bg-secondary-500 text-secondary-100 rounded px-4 py-1 hover:bg-secondary-800">Ver receta</a>
    </div>
  </div>
</div>
