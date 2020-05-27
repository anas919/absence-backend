<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Seance;
use App\Media;
use App\Prof;
use App\Absence;
use App\Module;
use App\User;
use DB;

class SeanceController extends Controller
{
    public $model = 'seance';
    public function filter_fields(){
        return [
            'date'=>[
                'type'=>'text'
            ],
            'prof'=>[
                'type'=>'text'
            ],
            'module'=>[
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
        $seances = Seance::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['seance'=>null]));

        return view('seance.list', [
            'results'=>$seances
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profs = Prof::all();
        $modules = Module::all();

        return view('seance.update',[
            'object'=> new Seance(),
            'profs'=>$profs,
            'modules'=>$modules
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'date' => 'required',
        ]);

        $seance = Seance::create([
            'date'=>request('date'),
            'prof_id'=>request('prof'),
            'module_id'=>request('module'),
        ]);

       return redirect()
                ->route('seance_edit', $seance->id)
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
        $profs = Prof::all();
        $modules = Module::all();
        $seance = Seance::findOrFail($id);

        return view('seance.update', [
            'object'=>$seance,
            'profs'=>$profs,
            'modules'=>$modules
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
      
        $seance = Seance::findOrFail($id);
        $seance->date = request('date');
        $seance->prof_id = request('prof');
        $seance->module_id = request('module');
        $seance->save();

        return redirect()
                ->route('seance_edit', $seance->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $seance = Seance::findOrFail($id);
        
        $references = $seance->images;
            
        if( $seance->delete() ){            
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('seance')
            ->with($flash_type, __('global.'.$msg));
    }

    //Api mobile
    public function seances(Request $request) {
        $user = User::find($request->user()->id);
        $seances = $user->prof->seances;
        foreach ($seances as $key => $value) {
            $value->module = $value->module;
        }
        return response()
            ->json(['seances' => $seances]);
    }
    public function seance_store(Request $request) {
        $user = User::find($request->user()->id);

        $seance = Seance::create([
            'date'=>$request->date,
            'prof_id'=>$user->prof->id,
            'module_id'=>$request->module_id,
        ]);

        return response()
            ->json(['success','ajouté avec succés']);
    }
    public function seance_fetch($id)
    {
        $modules = Module::all();
        $seance = Seance::findOrFail($id);

        return response()
            ->json(['seance' => $seance, 'modules' => $modules]);
    }
    public function seance_update(Request $request, $id) {
        $user = User::find($request->user()->id);

        $seance = Seance::findOrFail($id);
        $seance->date = $request->date;
        $seance->prof_id = $user->prof->id;
        $seance->module_id = $request->module_id;
        $seance->save();
        
        return response()
            ->json(['success' => 'modifié avec succés']);
    }
    public function studentsBySeance(Request $request, $id) {
        $seance = Seance::findOrFail($id);

        //$absents = Absence::select('etudiant_id')->where('seance_id', '=', $id)->get();

        $absents = DB::table('absences')->where('seance_id',$id)->count();

        $students = $seance->module->filiere->etudiants;

        foreach ($students as $key => $value) {
            $value->avatar = $value->user->getavatarForMobile();
            $value->is_absent = DB::table('absences')->where([['etudiant_id', '=', $value->id],['seance_id', '=', $id],])->count();
        }

        return response()
            ->json(['students' => $students]);
    }
    public function markAbsentStudents(Request $request) {

        $seanceId = $request->seanceId;
        $absentStudentIds = $request->absentStudentIds;
        $presentStudentIds = $request->presentStudentIds;

        foreach ($absentStudentIds as $key => $studentId) {
            $absence = new Absence();

            $absence->seance_id = $seanceId;
            $absence->etudiant_id = $studentId;

            $absence->save();
        }

        foreach ($presentStudentIds as $key => $studentId) {
            Absence::where('etudiant_id', $studentId)->where('seance_id', $seanceId)->delete();
        }
        return response()
            ->json(['success' => 'Absence noté']);
    }
}