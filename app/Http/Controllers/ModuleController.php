<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Module;
use App\Media;
use App\Semestre;
use App\Filiere;
use App\Prof;
use App\User;

class ModuleController extends Controller
{
    public $model = 'module';
    public function filter_fields(){
        return [
            'name'=>[
                'type'=>'text'
            ],
            'ref'=>[
                'type'=>'text'
            ],
            'description'=>[
                'type'=>'text'
            ]
        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }
    public function index()
    {
        $modules = Module::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['module'=>null]));

        return view('module.list', [
            'results'=>$modules
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $semestres = Semestre::all();
        $filieres = Filiere::all();
        $profs = Prof::all();

        return view('module.update',[
            'object'=> new Module(),
            'semestres'=>$semestres,
            'filieres'=>$filieres,
            'profs'=>$profs
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'ref' => 'required|string|max:255',
        ]);

        $module = Module::create([
            'name'=>request('name'),
            'ref'=>request('ref'),
            'description'=>request('description'),
            'filiere_id'=>request('filiere'),
            'semestre_id'=>request('semestre'),
        ]);
        $module->profs()->sync(request('profs'));

       return redirect()
                ->route('module_edit', $module->id)
                ->with('success', __('global.create_succees'));
    }

    /*
     * Display the specified resource.
     */

    public function show($id)
    {
        return $this->edit($id);
    }

    
    public function edit($id)
    {
        $semestres = Semestre::all();
        $filieres = Filiere::all();
        $profs = Prof::all();

        $module = Module::findOrFail($id);


        foreach ($module->profs as $key => $value) {
            //dd($value->user);
            $list[] = $value->id;
        }
        foreach ($profs as $key => $value) {
            if(in_array($value->id, $list))
                $value->en = 'yes';
        }
        return view('module.update', [
            'object'=>$module,
            'semestres'=>$semestres,
            'filieres'=>$filieres,
            'profs'=>$profs
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'ref' => 'required|string|max:255',
        ]);
      
        $module = Module::findOrFail($id);
        $module->name = request('name');
        $module->ref = request('ref');
        $module->description = request('description');
        $module->filiere_id = request('filiere');
        $module->semestre_id = request('semestre');
        $module->save();
        $module->profs()->sync(request('profs'));

        return redirect()
                ->route('module_edit', $module->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $module = Module::findOrFail($id);
        
        $references = $module->images;
            
        if( $module->delete() ){            
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('module')
            ->with($flash_type, __('global.'.$msg));
    }

    //Api mobile
    public function modules(Request $request){
        $user = User::find($request->user()->id);
        $modules = $user->prof->modules;
        //$modules = $request->user->prof->modules;
        return response()
            ->json(['modules' => $modules,'name' => $request->user()->name]);
    }

}