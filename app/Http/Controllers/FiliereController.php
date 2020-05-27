<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Filiere;
use App\Media;

class FiliereController extends Controller
{
    public $model = 'filiere';
    public function filter_fields(){
        return [
            'name'=>[
                'type'=>'text'
            ],
            'type'=>[
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
        $filieres = Filiere::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['filiere'=>null]));

        return view('filiere.list', [
            'results'=>$filieres
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('filiere.update',[
            'object'=> new Filiere(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $filiere = Filiere::create([
            'name'=>request('name'),
            'type'=>request('type'),
            'description'=>request('description'),
        ]);
       

       return redirect()
                ->route('filiere_edit', $filiere->id)
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
        $filiere = Filiere::findOrFail($id);
        return view('filiere.update', [
            'object'=>$filiere,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);
      
        $filiere = Filiere::findOrFail($id);
        $filiere->name = request('name');
        $filiere->type = request('type');
        $filiere->description = request('description');
        $filiere->save();

        return redirect()
                ->route('filiere_edit', $filiere->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $filiere = Filiere::findOrFail($id);
        
        $references = $filiere->images;
            
        if( $filiere->delete() ){            
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('filiere')
            ->with($flash_type, __('global.'.$msg));
    }
}