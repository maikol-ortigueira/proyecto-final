<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold capitalize leading-tight text-gray-800">
      {{ __('contacts') }}
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
                                <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-400 w-4">
                                    {{__('id')}}
                                </th>
                                <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-400 w-96">
                                    {{__('email')}}
                                </th>
                                <th scope="col" class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-400">
                                    {{__('subject')}}
                                </th>
                                <th scope="col" class="relative py-3 px-6 w-8">
                                    <span class="sr-only">Edit</span>
                                </th>
                                <th scope="col" class="relative py-3 px-6 w-8">
                                    <span class="sr-only">Delete</span>
                                </th>                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contactos as $contacto)
                                <tr class="border-b odd:bg-white even:bg-gray-50 dark:border-gray-600 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                                    <td  class="whitespace-nowrap py-4 px-6 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $contacto->id }}
                                    </td>
                                    <td  class="whitespace-nowrap py-4 px-6 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $contacto->email }}
                                    </td>
                                    <td  class="whitespace-nowrap py-4 px-6 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $contacto->asunto }}
                                    </td>
                                    <td class="whitespace-nowrap py-4 px-6 text-right text-sm font-medium">
                                        <a href="{{ route('admin.contactos.edit', ['contacto' => $contacto]) }}"
                                            class="rounded-md bg-blue-600 py-1 px-3 text-sm capitalize text-blue-100 hover:bg-blue-900">{{ __('view') }}</a>
                                    </td>
                                    <td class="whitespace-nowrap py-4 px-6 text-right text-sm font-medium">
                                        <form action="{{ route('admin.contactos.destroy', $contacto) }}" method="post">
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
                    {{ $contactos->links() }}
                </div>
            </div>
        </div>
    </div>
  </div>
</x-app-layout>