<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Absence;
use App\Media;
use App\Etudiant;
use App\Seance;

class AbsenceController extends Controller
{
    public $model = 'absence';
    public function filter_fields(){
        return [
            'date'=>[
                'type'=>'text'
            ],
            'etudiant'=>[
                'type'=>'text'
            ],
            'seance'=>[
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
        $absences = Absence::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['absence'=>null]));

        return view('absence.list', [
            'results'=>$absences
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $etudiants = Etudiant::all();
        $seances = Seance::all();

        return view('absence.update',[
            'object'=> new Absence(),
            'etudiants'=>$etudiants,
            'seances'=>$seances
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->validate(request(), [
        //     'justification' => 'required',
        // ]);

        $absence = Absence::create([
            'etudiant_id'=>request('etudiant'),
            'seance_id'=>request('seance'),
            'justification'=>request('justification')
        ]);

       return redirect()
                ->route('absence_edit', $absence->id)
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
        $etudiants = Etudiant::all();
        $seances = Seance::all();
        $absence = Absence::findOrFail($id);

        return view('absence.update', [
            'object'=>$absence,
            'etudiants'=>$etudiants,
            'seances'=>$seances
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'date' => 'required',
        ]);
      
        $absence = Absence::findOrFail($id);
        $absence->date = request('date');
        $absence->etudiant_id = request('etudiant');
        $absence->seance_id = request('seance');
        $absence->save();

        return redirect()
                ->route('absence_edit', $absence->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $absence = Absence::findOrFail($id);
        
        $references = $absence->images;
            
        if( $absence->delete() ){            
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('absence')
            ->with($flash_type, __('global.'.$msg));
    }
}