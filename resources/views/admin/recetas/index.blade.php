<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold capitalize leading-tight text-gray-800">
      {{ __('recipes') }}
    </h2>
  </x-slot>

<div class="container m-auto mt-5">
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
                <th scope="col" class="relative py-3 px-6">
                  <span class="sr-only">Edit</span>
                </th>
                <th scope="col" class="relative py-3 px-6">
                    <span class="sr-only">Delete</span>
                  </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recetas as $item)
                    <tr class="border-b odd:bg-white even:bg-gray-50 dark:border-gray-600 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                        <td class="whitespace-nowrap py-4 px-6 text-sm text-gray-500 dark:text-gray-400">
                          {{ $item->id }}
                        </td>
                        <td class="whitespace-nowrap py-4 px-6 text-sm font-medium text-gray-900 dark:text-white">
                          {{ $item->nombre }}
                        </td>
                        <td class="whitespace-nowrap py-4 px-6 text-right text-sm font-medium">
                          <a href="{{ route('admin.recetas.edit', ['receta' => $item]) }}" class="text-blue-100 bg-blue-600 hover:bg-blue-900 rounded-md py-1 px-3 text-sm capitalize" >{{ __('edit') }}</a>
                        </td>
                        <td class="whitespace-nowrap py-4 px-6 text-right text-sm font-medium">
                            <form action="{{ route('admin.recetas.destroy', $item) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button size="small" class="text-sm rounded-md py-1 px-3 text-red-100 bg-red-600 hover:bg-red-900 hover:bg-red-900">{{ __('delete') }}</button>
                            </form>
                          </td>
                      </tr>
                @endforeach
            </tbody>
          </table>
          {{ $recetas->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
</x-app-layout>
