<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    private $validations = [
        'title' => 'required|string|min:5|max:100',
        'author' => 'required|string|min:5|max:30',
        'url_github' => 'required|url|max:200',
        'description' => 'required|string',
        'languages' => 'required|string|min:5|max:50',
    ];

    private $validation_messages = [

        // title
        'title.required' => 'Il campo titolo è obbligatorio',
        'title.min' => 'Il campo titolo deve avere almeno :min caratteri',
        'title.max' => 'Il campo titolo deve avere massimo :max caratteri',
        // author
        'author.required' => 'Il campo autore è obbligatorio',
        'author.min' => 'Il campo Autore deve avere almeno :min caratteri',
        'author.max' => 'Il campo Autore deve avere massimo :max caratteri',
        // url
        'url_github.required' => 'Il campo Github è obbligatorio',
        'url_github.url' => 'Il campo Github deve essere un url valido',
        'url_github.max' => 'Il campo Github deve avere massimo :max caratteri',
        // description
        'description.required' => 'Il campo Descrizione è obbligatorio',
        // languages
        'languages.required' => 'Il campo Linguaggio è obbligatorio',
        'languages.min' => 'Il campo Linguaggio deve avere almeno :min caratteri',
        'languages.max' => 'Il campo Linguaggio deve avere massimo :max caratteri',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(5);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();

        $newProject = new Project();
        $newProject->title = $data['title'];
        $newProject->author = $data['author'];
        $newProject->url_github = $data['url_github'];
        $newProject->description = $data['description'];
        $newProject->languages = $data['languages'];

        $newProject->save();

        return to_route('admin.projects.show', ['project' => $newProject]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();
        // aggiornare i dati nel database se validi
        $project->title = $data['title'];
        $project->author = $data['author'];
        $project->url_github = $data['url_github'];
        $project->description = $data['description'];
        $project->languages = $data['languages'];
        // aggiornare i dati
        $project->update();
        // reindirizza alla pagina show
        return to_route('admin.projects.show', ['project' => $project]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index')->with('delete_success', $project);
    }
}
