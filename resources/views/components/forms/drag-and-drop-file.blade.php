@props(['name' => 'ficheros', 'id'])
<div class="flex flex-col flex-grow mb-3">
  <div x-data="{ files: null }" id="upload_{{ $id }}"
      class="block w-full py-2 px-3 relative bg-white appearance-none border-2 border-dashed border-gray-300 rounded-md hover:shadow-outline-gray">
      <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"
          aria-hidden="true">
          <path
              d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      <input type="file" multiple
          class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0"
          x-on:change="files = $event.target.files; console.log($event.target.files);"
          x-on:dragover="$el.classList.add('active')" x-on:dragleave="$el.classList.remove('active')"
          x-on:drop="$el.classList.remove('active')" name="{{$name}}[]">
      <template x-if="files !== null">
          <div class="flex flex-col space-y-1">
              <template x-for="(_,index) in Array.from({ length: files.length })">
                  <div class="flex flex-row items-center space-x-2">
                      <template x-if="files[index].type.includes('audio/')"><i
                              class="far fa-file-audio fa-fw"></i></template>
                      <template x-if="files[index].type.includes('application/')"><i
                              class="far fa-file-alt fa-fw"></i></template>
                      <template x-if="files[index].type.includes('image/')"><i
                              class="far fa-file-image fa-fw"></i></template>
                      <template x-if="files[index].type.includes('video/')"><i
                              class="far fa-file-video fa-fw"></i></template>
                      <span class="font-medium text-gray-900" x-text="files[index].name">{{__('Uploading')}}</span>
                      <span class="text-xs self-end text-gray-500"
                          x-text="filesize(files[index].size)">...</span>
                  </div>
              </template>
          </div>
      </template>
      <template x-if="files === null">
          <div class="flex flex-col space-y-2 items-center justify-center">
              <i class="fas fa-cloud-upload-alt fa-3x text-currentColor"></i>
              <p class="text-gray-700">{{ __('Drag your files here or click in this area.') }}</p>
              <a href="javascript:void(0)"
                  class="text-primary-600 hover:text-primary-500 focus-within:ring-primary-500 relative cursor-pointer rounded-md bg-white font-medium focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2">
                  {{ __('Upload a file') }}
              </a>
          </div>
      </template>
  </div>
</div>