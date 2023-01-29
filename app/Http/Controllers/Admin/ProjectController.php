<?php

namespace App\Http\Controllers\Admin; // <- se spostato a mano aggiungere Admin nel namespace

use App\Http\Controllers\Controller; // <----- a aggiungere se il controller lo abbiamo spostato a mano

use App\Http\Requests\ProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $projects = Project::where('user_id', Auth::id())->where('name','like',"%$search%")->paginate(10);
            }else{
            $projects = Project::where('user_id', Auth::id())->orderBy('id','desc')->paginate(10);
        }
        //$projects = Project::orderBy('id','desc')->paginate(10);
        $direction = 'desc';
        return view('admin.projects.index', compact('projects','direction'));
    }

    public function types_project(){
        $types = Type::all();
        return view('admin.projects.list_type_project', compact('types'));
    }


    public function orderby($column, $direction){
        $direction = $direction === 'desc' ? 'asc' : 'desc';
        $projects = Project::orderBy($column,$direction)->paginate(10);
        return view('admin.projects.index', compact('projects','direction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();
        $form_data['slug'] = Project::generateSlug($form_data['name']);

        if(array_key_exists('cover_image',$form_data)){
            $form_data['cover_image_original_name'] = $request->file('cover_image')->getClientOriginalName();
            $form_data['cover_image'] = Storage::put('uploads',$form_data['cover_image']);
        }

        //dd($form_data);
        $form_data['user_id'] = Auth::id();

        $new_project = Project::create($form_data);

        if(array_key_exists('technologies',$form_data)){
            $new_project->technologies()->attach($form_data['technologies']);
        }

        return redirect()->route('admin.projects.show', $new_project)->with('message',"The project $new_project->name has been correctly created");
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        if($project->user_id === Auth::id()){
            return view('admin.projects.show', compact('project'));
        }
        return redirect()->route('admin.projects.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        if($project->user_id != Auth::id()){
            return redirect()->route('admin.projects.index');
        }
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project','types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data = $request->all();

        if($form_data['name'] != $project->name){
            $form_data['slug'] = Project::generateSlug($form_data['name']);
        }else{
            $form_data['slug'] = $project->slug;
        }

        if(array_key_exists('cover_image',$form_data)){
            if($project->cover_image){
                Storage::disk('public')->delete($project->cover_image);
            }

            $form_data['cover_image_original_name'] = $request->file('cover_image')->getClientOriginalName();
            $form_data['cover_image'] = Storage::put('uploads',$form_data['cover_image']);
        }



        $project->update($form_data);

        if(array_key_exists('technologies',$form_data)){
            $project->technologies()->sync($form_data['technologies']);
        }else{
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project)->with('message','Project correctly edited');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->cover_image){
            Storage::disk('public')->delete($project->cover_image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('deleted',"The Project $project->name has been correctly deleted");
    }
}
