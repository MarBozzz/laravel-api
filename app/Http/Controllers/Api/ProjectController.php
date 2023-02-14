<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::with(['type','technologies','user'])->orderBy('id','desc')->paginate(10);
        //dd($projects);
        $types = Type::all();
        $technologies = Technology::all();
        return response()->json(compact('projects', 'types', 'technologies'));
    }

    public function show($slug){
        $project = Project::where('slug',$slug)->with(['technologies','type','user'])->first();

        if($project->cover_image){
            $project->cover_image = url("storage/" . $project->cover_image);
        }else{
            $project->cover_image = url("storage/uploads/image-placeholder.png");
        }
        return response()->json($project);
    }

    public function search(){

        $tosearch = $_GET['tosearch'];

        $projects = Project::where('name','like',"%$tosearch%")->with(['technologies','type','user'])->get();

        return response()->json($projects);
    }

    public function getByType($id){
        $projects = Project::where('type_id',$id)->with(['technologies','type','user'])->get();
        return response()->json($projects);
    }

    public function getByTechnology($id){

        //sfrutta gli id della tabella pivot

        /*$list_projects = [];
        $technology = Technology::where('id',$id)->with(['projects'])->first();
        foreach($technology->projects as $project){
            $list_projects[] = Project::where('id',$project->id)->with(['technologies','type','user'])->first();
        }*/

        $posts = Project::with(['technologies','type','user'])
            ->whereHas('technologies', function (Builder $query) use($id){
                $query->where('technology_id', $id);
            })
            ->get();

        //return response()->json($list_projects);
        return response()->json($posts);
    }
}
