<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $projects = Project::all(); */

        $projects = Project::orderByDesc('id')->paginate(4);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies = Technology::orderBy('tech_name')->get();
        $types = Type::all();
        return view('admin.projects.create', compact('types', 'technologies'));

        /* tech create */

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* inside $data there are form dates */
        /*  $data = $request->all(); */

        /* validation call */
        $data = $this->validation($request->all());

        /* create a new comic*/
        $project = new Project();

        /* fill with form information */
        $project->fill($data);

        /* save inside database */
        $project->save();

        /* 
        ! REMEMBER TO CODE IN MODEL FOR FILLABLE CONTENTS  
        */
        return redirect()->route('admin.projects.show', $project)
            ->with('message_type', 'success')
            ->with('message', 'Project added successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * * @return \Illuminate\Http\Response
     */

    /* update  */
    public function update(Request $request, Project $project)
    {
        /* $data = $request->all(); */

        /* validation call */
        $data = $this->validation($request->all());
        /* $this->validation($data); */

        $project->update($data);

        return redirect()->route('admin.projects.show', $project)
            ->with('message_type', 'success')
            ->with('message', 'Project edited successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * * @return \Illuminate\Http\Response
     */
    /* destroy  */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')
            ->with('message_type', 'danger')
            ->with('message', 'Project deleted !');
    }

    private function validation($data)
    {
        $validator = Validator::make(
            $data,
            [
                'author' => 'required|string|max:50',
                'title' => 'required|string|max:50',
                'slug' => 'required|string',
                'type_id' => 'required',
                'link' => 'required|string',
                'date' => 'required|string|max:50',
                'description' => 'required',
            ],
            [
                'author.required' => 'The author is binding!',
                'author.string' => 'author need to be a string!',
                'author.max' => 'The author must have max 100 characters!',

                'title.required' => 'The title is binding!',
                'title.string' => 'title need to be a string!',
                'title.max' => 'The title must have max 100 characters!',

                'slug.required' => 'The slug is binding!',
                'slug.string' => 'slug need to be a string!',

                'type_id.required' => 'Type is not valid, select a type!',

                'link.required' => 'The link is binding!',
                'link.string' => 'link need to be a string!',

                'date.required' => 'The date is binding!',
                'date.string' => 'date need to be a string!',
                'date.max' => 'The date must have max 100 characters!',

                'description.required' => 'The date is binding!'

            ]
        )->validate();

        return $validator;
    }
}
