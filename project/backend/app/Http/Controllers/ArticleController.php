<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles.
     */
    public function index(Request $request)
    {
        $articles = Article::all();

        $articles = $articles->map(function ($article) use ($request) {
            if ($request->has('performance_test')) {
                usleep(30000); // 30ms par article pour simuler le coût du N+1
            }

            return [
                'id' => $article->id,
                'title' => $article->title,
                'content' => substr($article->content, 0, 200) . '...',
                'author' => $article->author->name,
                'comments_count' => $article->comments->count(),
                'published_at' => $article->published_at,
                'created_at' => $article->created_at,
            ];
        });

        return response()->json($articles);
    }

    /**
     * Display the specified article.
     */
    public function show($id)
    {
        $article = Article::with(['author', 'comments.user'])->findOrFail($id);

        return response()->json([
            'id' => $article->id,
            'title' => $article->title,
            'content' => $article->content,
            'author' => $article->author->name,
            'author_id' => $article->author->id,
            'image_path' => $article->image_path,
            'published_at' => $article->published_at,
            'created_at' => $article->created_at,
            'comments' => $article->comments->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'content' => $comment->content,
                    'user' => $comment->user->name,
                    'created_at' => $comment->created_at,
                ];
            }),
        ]);
    }

    /**
     * Search articles.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return response()->json([]);
        }

        $articles = DB::select(
            "SELECT * FROM articles WHERE title LIKE '%" . $query . "%'"
        );

        $results = array_map(function ($article) {
            return [
                'id' => $article->id,
                'title' => $article->title,
                'content' => substr($article->content, 0, 200),
                'published_at' => $article->published_at,
            ];
        }, $articles);

        return response()->json($results);
    }

    /**
     * Store a newly created article.
     */
    use Intervention\Image\Facades\Image;

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'author_id' => 'required|exists:users,id',
        'image' => 'nullable|image|max:10240', // max 10MB
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $imageName = time() . '_' . $file->getClientOriginalName();

        // Redimensionner et compresser l'image
        $image = Image::make($file)
                      ->resize(1200, null, function ($constraint) {
                          $constraint->aspectRatio();
                      })
                      ->encode('jpg', 80);

        $image->save(storage_path('app/public/' . $imageName));
        $imagePath = 'storage/' . $imageName;
    }

    $article = Article::create([
        'title' => $validated['title'],
        'content' => $validated['content'],
        'author_id' => $validated['author_id'],
        'image_path' => $imagePath,
        'published_at' => now(),
    ]);

    return response()->json($article, 201);
}

    /**
     * Remove the specified article.
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json(['message' => 'Article deleted successfully']);
    }
}

