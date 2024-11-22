<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Pagination\Cursor;
use Illuminate\Support\Collection;

use function Laravel\Prompts\confirm;

class PostIndex extends Component
{
    public $posts;  // Will store the posts
    public $nextCursor;  // Stores the cursor for the next page
    public $hasMorePages;  // Whether more posts are available

    public function mount()
    {
        $this->posts = new Collection();  // Initialize posts as an empty collection
        $this->loadPosts();  // Load initial set of posts
    }
    public function loadPosts()
    {
        if ($this->hasMorePages === false) {
            return;  // Don't load more if there are no more pages
        }

        // Fetch posts, ordered by creation date, and paginate using the cursor
        $query = Post::orderBy('created_at', 'desc');

        // If there is a next cursor, use it to fetch the next page
        $posts = $query->cursorPaginate(3, ['*'], 'cursor', Cursor::fromEncoded($this->nextCursor ?? ''));

        // Merge new posts into the existing ones
        $this->posts = $this->posts->merge($posts->items());

        // Update the pagination state
        $this->hasMorePages = $posts->hasMorePages();
        if ($this->hasMorePages) {
            // Update the cursor for the next page of posts
            $this->nextCursor = $posts->nextCursor()->encode();
        }
    }
    public function deletePost($id){
        $post = Post::find($id);
        $post->delete();
        session()->flash('success','Post has been deleted');
        return redirect()->route('dashboard');
    }
    public function render()
    {
        return view('livewire.post.post-index');
    }
}
