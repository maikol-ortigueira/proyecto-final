<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold capitalize leading-tight text-gray-800">
      {{ __('users') }}
    </h2>
  </x-slot>
  <div class="container m-auto mt-5">
    {{-- Botón para añadir nuevos users --}}
    <div class="my-6 text-right">
      {{-- Solo el superusuario tiene permiso para añadir nuevos usuarios --}}
      @if (auth()->user()->isAdmin(['superadmin']))
        <a href="{{ route('admin.users.create') }}"
          class="rounded bg-blue-500 py-1 px-2 capitalize text-blue-100 hover:bg-blue-800">{{ __('new') . ' ' . __('user') }}</a>
      @endif
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
                    {{ __('email') }}
                  </th>
                  <th scope="col"
                    class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-400">
                    {{ __('roles') }}
                  </th>
                  <th scope="col"
                    class="py-3 px-6 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-400">
                    {{ __('phone number') }}
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
                @foreach ($users as $item)
                  @php
                    $nombreRoles = [];
                  @endphp
                  <tr
                    class="border-b odd:bg-white even:bg-gray-50 dark:border-gray-600 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <td class="whitespace-nowrap py-4 px-6 text-sm text-gray-500 dark:text-gray-400">
                      {{ $item->id }}
                    </td>
                    <td class="whitespace-nowrap py-4 px-6 text-sm font-medium text-gray-900 dark:text-white">
                      {{ $item->name }}

                    </td>
                    <td class="whitespace-nowrap py-4 px-6 text-sm font-medium text-gray-900 dark:text-white">
                      {{ $item->email }}
                    </td>
                    <td class="whitespace-nowrap py-4 px-6 text-sm font-medium text-gray-900 dark:text-white">
                      @foreach ($item->roles as $rol)
                        @php
                          // Aprovechamos para guardar los roles en un array, los vamos a necesitar
                          $nombreRoles[] = $rol->nombre;
                        @endphp
                        <span>{{ $rol->nombre }}</span><br>
                      @endforeach
                    </td>
                    <td class="whitespace-nowrap py-4 px-6 text-sm font-medium text-gray-900 dark:text-white">
                      @if ($item->perfil)
                          
                      {{ $item->perfil->telefonos }}
                      @endif
                    </td>
                    <td class="whitespace-nowrap py-4 px-6 text-right text-sm font-medium">
                      @auth
                        {{-- Solo el superusuario tiene permisos de edición y borrado para todos los elementos --}}
                        @if (auth()->user()->isAdmin(['superadmin']) || auth()->user()->id === $item->id)
                          <a href="{{ route('admin.users.edit', ['user' => $item]) }}"
                            class="rounded-md bg-blue-600 py-1 px-3 text-sm capitalize text-blue-100 hover:bg-blue-900">{{ __('edit') }}</a>
                        @endif
                      @endauth

                    </td>

                    <td class="whitespace-nowrap py-4 px-6 text-right text-sm font-medium">
                      @auth
                        {{-- Solo el superusuario tiene permisos de edición y borrado para todos los elementos --}}
                        {{-- Además un usuario no puede borrarse a si mismo --}}
                        @if (auth()->user()->isAdmin(['superadmin']))
                          {{-- Un superusuario no se puede borrar --}}
                          @if (!in_array('superadmin', $nombreRoles))
                            <form action="{{ route('admin.users.destroy', $item) }}" method="post">
                              @csrf
                              @method('DELETE')
                              <button size="small"
                                class="rounded-md bg-red-600 py-1 px-3 text-sm text-red-100 hover:bg-red-900 hover:bg-red-900">{{ __('delete') }}</button>
                            </form>
                          @endif
                        @endif
                      @endauth

                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="my-10">
            {{ $users->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
