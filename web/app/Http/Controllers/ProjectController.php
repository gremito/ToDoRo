<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProject;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // 認証
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * プロジェクト追加
     * @param AddProject $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addProject(AddProject $request)
    {
        $project = new Project();
        $project->user_id = Auth::user()->id;
        $project->name = $request->project;

        Auth::user()->projects()->save($project);
        DB::commit();

        $new_project = Project::where('id', $project->id)->first();

        // リソースの新規作成なのでレスポンスコードは201(CREATED)
        return response()->json($new_project, 201, [], JSON_NUMERIC_CHECK);
    }

    /**
     * プロジェクト一覧
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(int $id)
    {
        $projects = Project::where('id', $id)->orderBy('created_at', 'desc')->get();

        return response()->json($projects, 200, [], JSON_NUMERIC_CHECK);
    }
}
