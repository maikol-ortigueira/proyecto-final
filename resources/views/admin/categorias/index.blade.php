<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold capitalize leading-tight text-gray-800">
      {{ __('categorias') }}
    </h2>
  </x-slot>
  <div class="container m-auto mt-5">
    {{-- Botón para añadir nuevos categorias --}}
    <div class="my-6 text-right">
      <a href="{{ route('admin.categorias.create') }}"
        class="rounded bg-blue-500 py-1 px-2 capitalize text-blue-100 hover:bg-blue-800">{{ __('new category') }}</a>
    </div>
    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
          <div class="overflow-hidden shadow-md sm:rounded-lg">
            <table class="min-w-full">
              <thead class="bg-blue-300 dark:bg-gray-700">
                <tr>
                  <th scope="col"
                    class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-400">
                    {{ __('id') }}
                  </th>
                  <th scope="col"
                    class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-400">
                    {{ __('name') }}
                  </th>
                  <th scope="col"
                    class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-400">
                    {{ __('parent') }}
                  </th>
                  <th scope="col"
                    class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-400">
                    {{ __('type') }}
                  </th>
                  <th scope="col" class="relative py-3 px-6">
                    <span class="sr-only">Edit</span>
                  </th>
                  <th scope="col" class="relative py-3 px-6">
                    <span class="sr-only">Delete</span>
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categorias as $item)
                  <tr
                    class="border-b odd:bg-white even:bg-gray-50 dark:border-gray-600 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <td class="whitespace-nowrap py-4 px-6 text-sm text-gray-500 dark:text-gray-400">
                      {{ $item->id }}
                    </td>
                    <td class="whitespace-nowrap py-4 px-6 text-sm font-medium text-gray-900 dark:text-white">
                      {{ $item->nombre }}
                    </td>
                    <td class="whitespace-nowrap py-4 px-6 text-sm font-medium text-gray-900 dark:text-white">
                      @if ($item->parent_id)
                        {{ App\Models\Categoria::find($item->parent_id)->nombre }}
                      @endif
                    </td>
                    @php
                      $types = [App\Models\Unidad::class => __('unit'), App\Models\Receta::class => __('recipe')];
                    @endphp
                    <td class="whitespace-nowrap py-4 px-6 text-sm font-medium text-gray-900 dark:text-white">
                      {{ $types[$item->type] }}
                    </td>
                    <td class="whitespace-nowrap py-4 px-6 text-right text-sm font-medium">
                      <a href="{{ route('admin.categorias.edit', ['categoria' => $item]) }}"
                        class="rounded-md bg-blue-600 py-1 px-3 text-sm capitalize text-blue-100 hover:bg-blue-900">{{ __('edit') }}</a>
                    </td>
                    <td class="whitespace-nowrap py-4 px-6 text-right text-sm font-medium">
                      <form action="{{ route('admin.categorias.destroy', $item) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button size="small"
                          class="rounded-md bg-red-600 py-1 px-3 text-sm text-red-100 hover:bg-red-900 hover:bg-red-900">{{ __('delete') }}</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="my-10">
            {{ $categorias->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>