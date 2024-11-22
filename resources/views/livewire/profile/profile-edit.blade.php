<main
      class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
      <!-- Profile Edit Form -->
 @if (session()->has('success'))
        <div class="bg-green-600 text-white px-3 py-2">
            {{ session('success') }}
        </div>
    @endif

      <form wire:submit.prevent="saveForm" enctype="multipart/form-data">
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-xl font-semibold leading-7 text-gray-900">
              Edit Profile
            </h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">
              This information will be displayed publicly so be careful what you
              share.
            </p>

            <div class="mt-10 border-b border-gray-900/10 pb-12">
                <div class="col-span-full mt-10 pb-10">
                  <label
                    for="photo"
                    class="block text-sm font-medium leading-6 text-gray-900"
                    >Photo</label
                  >
                  <div class="mt-2 flex items-center gap-x-3">
                    <input
                      class="hidden"
                      type="file"
                      name="avatar"
                      wire:model="form.avatar"
                      id="avatar" />


                    @if ($form->avatar)
<img
                      class="h-32 w-32 rounded-full"
                      src="{{$form->avatar->temporaryUrl()}}"
                      alt="{{$author->first_name}}" />

                    @else

<img
                      class="h-32 w-32 rounded-full"
                      src="{{  $author->avatar_url  }}"
                      alt="{{$author->first_name}}" />

                    @endif




                    <label for="avatar">
                      <div
                        class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        Change
                      </div>
                    </label>
                  </div>
                </div>
                @error('form.avatar')
                    <p class="text-red-500">{{$message}}</p>
                @enderror

              <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                  <label
                    for="first-name"
                    class="block text-sm font-medium leading-6 text-gray-900"
                    >First name</label
                  >
                  <div class="mt-2">
                    <input
                      type="text"
                      name="first-name"
                      id="first-name"
                      wire:model="form.first_name"
                      autocomplete="given-name"

                      class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                  </div>
                  @error('form.first_name')
                    <p class="text-red-500">{{$message}}</p>
                  @enderror
                </div>

                <div class="sm:col-span-3">
                  <label
                    for="last-name"
                    class="block text-sm font-medium leading-6 text-gray-900"
                    >Last name</label
                  >
                  <div class="mt-2">
                    <input
                      type="text"
                      name="last-name"
                      id="last-name"
                       wire:model="form.last_name"

                      autocomplete="family-name"
                      class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                  </div>
                  @error('form.last_name')
                    <p class="text-red-500">{{$message}}</p>
                  @enderror
                </div>

                <div class="col-span-full">
                  <label
                    for="email"
                    class="block text-sm font-medium leading-6 text-gray-900"
                    >Email address</label
                  >
                  <div class="mt-2">
                    <input
                      id="email"
                      name="email"
                      type="email"
                       wire:model="form.email"
                      autocomplete="email"
                      class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                  </div>
                  @error('form.email')
                    <p class="text-red-500">{{$message}}</p>
                  @enderror
                </div>

                <div class="col-span-full">
                  <label
                    for="password"
                    class="block text-sm font-medium leading-6 text-gray-900"
                    >Password</label
                  >
                  <div class="mt-2">
                    <input
                      type="password"
                      name="password"
                      id="password"
                       wire:model="form.password"
                      autocomplete="password"
                      class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                  </div>
                  @error('form.password')
                    <p class="text-red-500">{{$message}}</p>
                  @enderror
                </div>
              </div>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="col-span-full">
                <label
                  for="bio"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >Bio</label
                >
                <div class="mt-2">
                  <textarea
                    id="bio"
                    name="bio"
                    wire:model="form.bio"
                    rows="3"
                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6"></textarea
                  >
                </div>
                @error('form.bio')
                    <p class="text-red-500">{{$message}}</p>
                  @enderror
                <p class="mt-3 text-sm leading-6 text-gray-600">
                  Write a few sentences about yourself.
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
          <a
            href="{{route('dashboard')}}"
            type="button"
            class="text-sm px-3 rounded-md py-1 font-semibold leading-6 bg-red-500 text-white">
            Cancel
          </a>
          <button
            type="submit"
            class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
            Save
          </button>
        </div>
      </form>
      <!-- /Profile Edit Form -->
    </main>
