 <div class="flex flex-col space-y-6 mt-4">
          <h1 class="text-lg font-semibold">Comment{{$comments->count() > 0 ? "s":""}} {{$comments->count()}}</h1>

          <!-- Barta User Comments Container -->
          <article
            class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-2 sm:px-6 min-w-full divide-y">
            <!-- Comments -->
@forelse($comments as $comment )
            <!-- Comment 1 -->
            <div class="py-4">
              <!-- Barta User Comments Top -->
              <header>
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-3">
                    <!-- User Avatar -->
                    <div class="flex-shrink-0">
                      <img
                              class="h-10 w-10 rounded-full object-cover"
                              src="{{$comment->user->avatar_url}}"
                              alt="{{$comment->user->first_name}}" />
                    </div>
                    <!-- /User Avatar -->
                    <!-- User Info -->
                    <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                      <a
                        href="{{route('profile.show', $comment->user->id)}}"
                        class="hover:underline font-semibold line-clamp-1">
                        {{$comment->user->first_name}}
                      </a>

                      <a
                        href="{{route('profile.show', $comment->user->id)}}"
                        class="hover:underline text-sm text-gray-500 line-clamp-1">
                        {{$comment->user->email}}
                      </a>
                    </div>
                    <!-- /User Info -->
                  </div>
                </div>
              </header>

              <!-- Content -->
              <div class="py-4 text-gray-700 font-normal">
                <p>{{$comment->comment}}</p>
              </div>

              <!-- Date Created -->
              <div class="flex items-center gap-2 text-gray-500 text-xs">
                <span class="">{{$comment->created_at->diffForHumans()}}</span>
              </div>
            </div>
            <!-- /Comment 1 -->
@empty
No comments
@endforelse


            <!-- /Comments -->
          </article>
          <!-- /Barta User Comments -->
        </div>
