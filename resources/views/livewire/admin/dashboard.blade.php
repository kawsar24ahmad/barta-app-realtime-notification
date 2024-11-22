<div
      class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
      <!--      <div class="text-center p-12 border border-gray-800 rounded-xl">-->
      <!--        <h1 class="text-3xl justify-center items-center">Welcome to Barta!</h1>-->
      <!--      </div>-->

      @if (session()->has('success'))
      <span class="bg-green-400 text-white ml-auto mr-auto p-2">{{session('success')}}</span>
      @endif

     <!-- Barta Create Post Card -->
      @livewire('post.post-create')

      <!-- /Barta Create Post Card -->


      @livewire('post.post-index')


    </div>
