<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Prof;
use App\Groupe;
use App\Media;

class ProfController extends Controller
{
    /*
     * Create a new controller instance.
     */

    public $model = 'prof';
    public function filter_fields(){
        return [
            'avatar'=>null,
            'name'=>[
                'type'=>'text',
            ],
            'role'=>[
                'type'=>'select',
                'operation' => '=',
                'data' => ['ADMIN'=>'ADMIN','USER'=>'USER','ETUDIANT'=>'ETUDIANT','PROF'=>'PROF'],
            ],
            'email'=>[
                'type'=>'text',
            ],
            'phone'=>[
                'type'=>'text',
            ],
            'matricule'=>null
            /*'groupes' => [
                'type' => 'select',
                'operation' => null,
                'data' => [],
                'table' => 'groupes',
                'fields' => ['id as key_','name as value_'],
                'where' => [],
            ],*/
        ];
    }

    public function __construct()
    {
        //$this->middleware('auth');

    }

    /*
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where($this->filter(false))
                        //->join('profs', 'users.id', '=', 'profs.user_id')
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));
        //dd($users);
        foreach ($users as $key => $value) {
            if(!$value::find($value->id)->prof)
                unset($users[$key]);
        }
        return view('prof.list', [
            'results'=>$users
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $groupes = Groupe::all();

        return view('prof.update',[
            'object'=> new User(),
            'prof'=> new Prof(),
            'groupes'=>$groupes
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $avatar = null;

        $media = new Media();
        if($request->file('avatar')){
            $media->_file = $request->file('avatar');
            $media->_path = 'Avatar/Profs';
            $media = $media->_save();

            if($media)
                $avatar = $media->id;
        }

        $user = User::create([
            'name'=>request('name'),
            'email'=>request('email'),
            'role'=>request('role'),
            'phone'=>request('phone'),
            'avatar'=>$avatar,
            'password'=>bcrypt( request('password') ),
        ]);

        $prof = Prof::create([
            'user_id'=>$user->id,
            'matricule'=>request('matricule'),
        ]);
        
        $user->groupes()->sync(request('groupe'));

        return redirect()->route('user_edit', $user->id);
    }

    /*
     * Display the specified resource.
     */

    public function show($id)
    {
        return $this->edit($id);
        /*$user = User::findOrFail($id);
        return view('user.show', [
            'object'=>$user
        ]);*/
    }

    /*
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $prof = Prof::findOrFail($id);
        $groupes = Groupe::all();
        //dd($user->user->getname());
        return view('prof.update', [
            'object'=>$prof,
            'groupes'=>$groupes
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $prof = Prof::findOrFail($id);

        $user = User::where('profs.user_id', '=', $id)
                    ->join('profs', 'users.id', '=', 'profs.user_id');

        $user->name = request('name');
        $user->role = request('role');
        $user->email = request('email');
        $user->phone = request('phone');

        $prof->matricule = request('matricule');

        $media = new Media();
        if($request->file('avatar')){
            if($user->avatar)
                $media = Media::find($user->avatar);

            $media->_file = $request->file('avatar');
            $media->_path = 'Avatar/Profs';
            $media = $media->_save();

            if($media)
                $user->avatar = $media->id;
        }

        if(request('password'))
            $user->password = bcrypt(request('password'));
            
        $user1 = User::findOrFail($user->id);
        $user1->groupes()->sync(request('groupe'));
        
        $user->save();
        $user1->save();
        $prof->save();

        return redirect()->route('user_edit', $user->id);
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $prof = Prof::where('user_id', '=', $id)->firstOrFail();

        if( $user->picture )
            $user->picture->delete();
        $user->delete();
        $prof->delete();

        return redirect()->route('prof');
    }

}
