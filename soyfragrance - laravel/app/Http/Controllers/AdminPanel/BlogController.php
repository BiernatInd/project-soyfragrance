<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Blog\BlogList;
use App\Models\Blog\BlogImages;
use App\Models\Blog\BlogContent;

class BlogController extends Controller
{
    public function addBlogPost(Request $request)
    {
        $request->validate([
            'article_title' => 'required|string',
        ]);
    
        $articles = new BlogList;
        $articles->article_title = $request->input('article_title');
    
        // Pobierz najwyższy slug i dodaj 1
        $latestSlug = BlogList::max('slug');
        $articles->slug = $latestSlug + 1;
    
        $articles->save();
    
        return response()->json(['message' => 'Wpis dodany pomyślnie', 'slug' => $articles->slug], 201);
    }

    public function addBlogPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'slug' => 'nullable|integer'
        ]);
    
        $photo = $request->file('photo');
        $slug = $request->input('slug');
    
        // Utwórz folder jeśli nie istnieje
        $path = public_path('blog-photos/' . $slug);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    
        // Konwersja obrazu do formatu JPG
        $image = imagecreatefromstring(file_get_contents($photo));
        $fileName = '1.webp'; // Nazwa pliku ustawiona na stałe jako "1.jpg"
        imagejpeg($image, $path . '/' . $fileName, 90); // Zapisz jako JPG z jakością 90%
    
        // Zwolnij pamięć
        imagedestroy($image);
    
        // Zapisz informacje o zdjęciu w bazie danych
        $blogPhoto = new BlogImages();
        $blogPhoto->image_path = url('blog-photos/' . $slug . '/' . $fileName);
        $blogPhoto->slug = $slug;
        $blogPhoto->save();
    
        return response()->json(['message' => 'Zdjęcie dodane pomyślnie']);
    }

    public function addBlogMeta(Request $request, $slug)
    {
        $request->validate([
            'article_meta_title' => 'required|string',
            'article_meta_description' => 'required|string',
        ]);
    
        $article = BlogList::where('slug', $slug)->firstOrFail();
        $article->article_meta_title = $request->input('article_meta_title');
        $article->article_meta_description = $request->input('article_meta_description');
        $article->save();
    
        return response()->json(['message' => 'Meta tagi zaktualizowane pomyślnie', 'slug' => $article->slug], 200);
    }

    public function addBlogContent(Request $request)
    {
        $request->validate([
            'article_type' => 'required|string',
            'article_text' => 'required|string',
            'slug' => 'required|string',
        ]);
    
        // Fetch the highest article_number for the current slug
        $maxArticleNumber = BlogContent::where('slug', $request->slug)
            ->max('article_number');
    
        // If no record is found, start with 1, else increment by 1
        $articleNumber = $maxArticleNumber ? $maxArticleNumber + 1 : 1;
    
        $content = new BlogContent();
        $content->article_type = $request->article_type;
        $content->article_text = $request->article_text;
        $content->slug = $request->slug;
        $content->article_number = $articleNumber; // Set the article_number
        $content->save();
    
        return response()->json(['message' => 'Treść dodana pomyślnie'], 200);
    }

    public function downloadBlogContent($slug)
    {
        $blogContents = BlogContent::where('slug', $slug)->get(); // Fetches all records with the specified slug
        return response()->json($blogContents); // Returns the data as JSON
    }

    public function editBlogContent(Request $request, $slug)
    {
        $blogContent = BlogContent::where('slug', $slug)
                        ->where('article_number', $request->article_number)
                        ->firstOrFail();
    
        $blogContent->update([
            'article_text' => $request->article_text,
        ]);
    
        return response()->json(['message' => 'Treść zaktualizowana pomyślnie']);
    }

    public function downloadBlogList() {
        $articles = BlogList::all();

        return response()->json(['articles' => $articles]);
    }

    public function deleteBlogArticle($slug) {
        $article = BlogList::where('slug', $slug)->first();
    
        if (!$article) {
            return response()->json(['error' => 'Artykuł nie został znaleziony.'], 404);
        }
    
        // Usuń powiązane treści i obrazy używając slug
        BlogContent::where('slug', $slug)->delete();
        BlogImages::where('slug', $slug)->delete();
    
        // Usuń artykuł
        $article->delete();
    
        return response()->json(['message' => 'Artykuł oraz powiązane treści i obrazy zostały pomyślnie usunięte.']);
    }

    public function downloadBlogAllData()
    {
        $blogContents = BlogContent::all();
        $blogImages = BlogImages::all();
        $blogList = BlogList::all();
    
        // Modyfikuj każdy element blogList
        foreach ($blogList as $blogItem) {
            if (strlen($blogItem->article_meta_description) > 100) {
                // Ogranicz do 100 znaków i dodaj "..."
                $blogItem->article_meta_description = substr($blogItem->article_meta_description, 0, 100) . "...";
            }
        }
    
        return response()->json([
            'blogContents' => $blogContents,
            'blogImages' => $blogImages,
            'blogList' => $blogList,
        ]);
    }

    public function downloadBlogArticle($slug) {
        $blogContents = BlogContent::where('slug', $slug)->get();
        $blogImages = BlogImages::where('slug', $slug)->get();
        $blogList = BlogList::where('slug', $slug)->get();
    
        return response()->json([
            'blogContents' => $blogContents,
            'blogImages' => $blogImages,
            'blogList' => $blogList,
        ]);
    }

    public function downloadBlogMeta($slug)
    {
        $article = BlogList::where('slug', $slug)->first();
    
        if (!$article) {
            return response()->json(['message' => 'Artykuł nie znaleziony'], 404);
        }
    
        return response()->json(['article' => $article], 200);
    }        
}
