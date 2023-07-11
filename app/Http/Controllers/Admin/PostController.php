<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class PostController extends Controller
{

    private $validations = [
        'title' => 'required|string|min:5|max:100',
        'category_id' => 'required|integer|exists:categories,id',
        // exist si usa per vedere se è presente nella tabella, altrimenti non arriva il salvataggio nel db e Laravel stampa l'errore
        'url_image' => 'required|url|max:200',
        'content' => 'required|string',
    ];

    private $validation_messages = [

        // title
        'title.required' => 'Il campo titolo è obbligatorio',
        'title.min' => 'Il campo titolo deve avere almeno :min caratteri',
        'title.max' => 'Il campo titolo deve avere massimo :max caratteri',
        // exist
        'category_id.exists' => 'Valore non valido',
        // url
        'url_image.required' => 'Il campo Immagine è obbligatorio',
        'url_image.url' => 'Il campo Immagine deve essere un url valido',
        'url_image.max' => 'Il campo Immagine deve avere massimo :max caratteri',
        // content
        'content.required' => 'Il campo Content è obbligatorio',
    ];

    public function index()
    {
        $posts = Post::paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        // facciamo la richiesta al db per estrarre le categorie
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
        // col compact passiamo le inormazioni estratte
    }

    public function store(Request $request)
    {
        // validare i dati del form
        $request->validate($this->validations, $this->validation_messages);

        // i dati li prendiamo da $request che contiente i dati che inseriramo nel form...Request contiene tutte le informazioni della richiesta dell'utente, tra cui i dati del form
        $data = $request->all();

        // salvare i dati nel database se validi
        $newPost = new Post();
        $newPost->title = $data['title'];
        // associamo la categoria al post con la funzione 
        $newPost->category_id = $data['category_id'];
        $newPost->url_image = $data['url_image'];
        $newPost->content = $data['content'];
        // salvare i dati
        $newPost->save();

        // ridirezionare su una rotta di tipo get, la show è una rotta con parametri quindi bisogna passarlo, tramite array
        return to_route('admin.posts.show', ['post' => $newPost]);
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        // bisogna passare i dati, ci pensa Laravel con la dependencie injection
        // da compact('post) deriva la variabile $post che abbiamo nell'edit
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();
        // aggiornare i dati nel database se validi
        $post->title = $data['title'];
        $post->category_id = $data['category_id'];
        $post->url_image = $data['url_image'];
        $post->content = $data['content'];
        // aggiornare i dati
        $post->update();
        // reindirizza alla pagina show
        return to_route('admin.posts.show', ['post' => $post]);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return to_route('admin.posts.index')->with('delete_success', $post);
    }
}
