<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Semestre;
use App\Media;

class SemestreController extends Controller
{
    public $model = 'semestre';
    public function filter_fields(){
        return [
            'name'=>[
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
        $semestres = Semestre::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['semestre'=>null]));

        return view('semestre.list', [
            'results'=>$semestres
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('semestre.update',[
            'object'=> new Semestre(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:255',
        ]);

        $semestre = Semestre::create([
            'name'=>request('name'),
        ]);
       

       return redirect()
                ->route('semestre_edit', $semestre->id)
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
        $semestre = Semestre::findOrFail($id);
        return view('semestre.update', [
            'object'=>$semestre,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:255',
        ]);
      
        $semestre = Semestre::findOrFail($id);
        $semestre->name = request('name');
        $semestre->save();

        return redirect()
                ->route('semestre_edit', $semestre->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $semestre = Semestre::findOrFail($id);
        
        $references = $semestre->images;
            
        if( $semestre->delete() ){            
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('semestre')
            ->with($flash_type, __('global.'.$msg));
    }
}