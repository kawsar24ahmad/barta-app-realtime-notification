<main class="container max-w-2xl mx-auto space-y-8 mt-8 px-2 min-h-screen">
      <!-- Cover Container -->
      <section
        class="bg-white border-2 p-8 border-gray-800 rounded-xl min-h-[350px] space-y-8 flex items-center flex-col justify-center">
        <!-- Profile Info -->
        <div
          class="flex gap-4 justify-center flex-col text-center items-center">
          <!-- Avatar -->
          <div class="relative">
            <img
              class="w-32 h-32 rounded-full border-2 border-gray-800"
              src="{{$author->avatar_url}}"
              alt="{{$author->first_name}}" />
<!--            <span class="bottom-2 right-4 absolute w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>-->
          </div>
          <!-- /Avatar -->

          <!-- User Meta -->
          <div>
            <h1 class="font-bold md:text-2xl">{{$author->first_name .' '. $author->last_name }} </h1>
            <p class="text-gray-700">Less Talk, More Code ðŸ’»</p>
          </div>
          <!-- / User Meta -->
        </div>
        <!-- /Profile Info -->

        <!-- Profile Stats -->
        <div
          class="flex flex-row gap-16 justify-center text-center items-center">
          <!-- Total Posts Count -->
          <div class="flex flex-col justify-center items-center">
            <h4 class="sm:text-xl font-bold">{{$author->posts->count()}}</h4>
            <p class="text-gray-600">Post{{$author->posts->count() > 0 ? 's' : ''}}</p>
          </div>

          <!-- Total Comments Count -->
          <div class="flex flex-col justify-center items-center">
            <h4 class="sm:text-xl font-bold">14</h4>
            <p class="text-gray-600">Comments</p>
          </div>
        </div>
        <!-- /Profile Stats -->

        @if (auth()->user()->id == $author->id)


        <!-- Edit Profile Button (Only visible to the profile owner) -->
        <a
          href="{{route('profile.edit', $author->id)}}"
          type="button"
          class="-m-2 flex gap-2 items-center rounded-full px-4 py-2 font-semibold bg-gray-100 hover:bg-gray-200 text-gray-700">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-5 h-5">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
          </svg>

          Edit Profile
        </a>
      @endif
        <!-- /Edit Profile Button -->
      </section>
      <!-- /Cover Container -->
 @if (auth()->user()->id == $author->id)
      @livewire('post.post-create')
@endif
      <!-- User Specific Posts Feed -->

      @foreach ($author->posts as $post )
        <!-- Barta Card -->

      <article
        class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
        <!-- Barta Card Top -->
        <header>
          <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
              <!-- User Avatar -->
                  <div class="flex-shrink-0">
                    <img
                      class="h-10 w-10 rounded-full object-cover"
                      src="{{$author->avatar_url}}"
                      alt="{{$author->first_name}}" />
                  </div>
              <!-- /User Avatar -->

              <!-- User Info -->
              <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                <a
                  href="{{route('profile')}}"
                  class="hover:underline font-semibold line-clamp-1">
                  {{$post->author->first_name . ' ' . $post->author->last_name}}
                </a>

                <a
                  href="{{route('profile')}}"
                  class="hover:underline text-sm text-gray-500 line-clamp-1">
                  {{ $post->author->email }}
                </a>
              </div>
              <!-- /User Info -->
            </div>

            <!-- Card Action Dropdown -->
@if (auth()->user()->id == $post->author->id)
<div
              class="flex flex-shrink-0 self-center"
              x-data="{ open: false }">
              <div class="relative inline-block text-left">
                <div>
                  <button
                    @click="open = !open"
                    type="button"
                    class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                    id="menu-0-button">
                    <span class="sr-only">Open options</span>
                    <svg
                      class="h-5 w-5"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      aria-hidden="true">
                      <path
                        d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"></path>
                    </svg>
                  </button>
                </div>
                <!-- Dropdown menu -->
                <div
                  x-show="open"
                  @click.away="open = false"
                  class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                  role="menu"
                  aria-orientation="vertical"
                  aria-labelledby="user-menu-button"
                  tabindex="-1">
                  <a
                    href="{{route('posts.edit', $post->id)}}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    role="menuitem"
                    tabindex="-1"
                    id="user-menu-item-0"
                    >Edit</a
                  >
                  <a
                    href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    role="menuitem"
                    tabindex="-1"
                    id="user-menu-item-1"
                    >Delete</a
                  >
                </div>
              </div>
            </div>
@endif
            <!-- /Card Action Dropdown -->
          </div>
        </header>

        <!-- Content -->
        <a href="{{route('posts.show', $post->id)}}">
          <div class="py-4 text-gray-700 font-normal">
            <p>
              {{$post->body}}
            </p>
          </div>
        </a>

        <!-- Date Created & View Stat -->
        <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
          <span class="">{{$post->created_at->diffForHumans()}}</span>
          <span class="">â€¢</span>
          <span>4,450 views</span>
        </div>

        <!-- Barta Card Bottom -->
        <footer class="border-t border-gray-200 pt-2">
          <!-- Card Bottom Action Buttons -->
          <div class="flex items-center justify-between">
            <div class="flex gap-8 text-gray-600">
              <!-- Comment Button -->
              <button
                type="button"
                class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                <span class="sr-only">Comment</span>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="2"
                  stroke="currentColor"
                  class="w-5 h-5">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                </svg>

                <p>3</p>
              </button>
              <!-- /Comment Button -->
            </div>
          </div>
          <!-- /Card Bottom Action Buttons -->
        </footer>
        <!-- /Barta Card Bottom -->
      </article>
      <!-- /Barta Card -->
      @endforeach

      <!-- User Specific Posts Feed -->
    </main>