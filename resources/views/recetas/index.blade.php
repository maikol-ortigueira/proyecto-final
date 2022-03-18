<x-guest-layout>
  <div class="min-h-full" x-data="main()"
    x-init="fetch(url).then(response => response.json()).then(json => {recetas = json.recetas.data})">
    <div id="recetas-section-1" class="h-72">
      <div class="flex h-full items-center pl-24">
        <div class="w-1/3">
          <h1 class="text-primary-600 text-6xl font-bold">{{ __('What do we eat this week?') }}</h1>
        </div>
      </div>
    </div>
    <div class="container mx-auto mt-10">
      <x-filtros.index>
        <div class="flex flex-col gap-8">
          <template x-for="receta in recetas">
            <x-recetas.card />
          </template>
        </div>
      </x-filtros.index>
    </div>
    <div class="container mx-auto">
      {{ $recetas->links() }}
    </div>
  </div>
  @once
    @push('bottom')
      <script>
        function main() {
          return {
            url: '/api/recetas',
            recetas: [],
            buscarPorAutor: async function(id) {
              const response = await fetch(`${this.url}?autor=${id}`);
              this.recetas = (await response.json()).recetas.data;
            },
            buscaPorCategoria: async function(id) {
              id = this.serailizaUrl(id, 'categoria')
              const response = await fetch(`${this.url}?${id}`);
              this.recetas = (await response.json()).recetas.data;
            },
            serailizaUrl: function(elem, obj) {
              let str = [];
              elem.forEach(element => {
                str.push(encodeURIComponent(`${obj}[]`) + '=' + encodeURIComponent(element));
              });

              return str.join("&");
            },
            buscarDeForm: async function() {
              // Recuperamos los datos del formulario
              let form = document.getElementById('filtrosForm');
              let cat = form.elements['categoria[]'];
              let tags = form.elements['tag[]'];
              // Inicializamos variables
              let etiquetas = [];
              let categorias = [];
              let consulta = []

              // Comprobamos los elementos seleccionados
              tags.forEach(elem => {
                if (elem.checked == true) {
                  etiquetas.push(elem.value);
                }
              })

              cat.forEach(elem => {
                if (elem.checked == true) {
                  categorias.push(elem.value);
                }
              })

              // Con los datos del formulario formateamos la consulta
              consulta.push(this.serailizaUrl(etiquetas, 'tag'));
              consulta.push(this.serailizaUrl(categorias, 'categoria'));

              let params = consulta.join('&');

              // Realizamos la consulta y pasamos los datos a la vista
              const response = await fetch(`${this.url}?${params}`);
              this.recetas = (await response.json()).recetas.data;

            }
          }
        }
      </script>
    @endpush
  @endonce
</x-guest-layout>
