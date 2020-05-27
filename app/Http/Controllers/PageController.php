<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Page;
use App\Media;

class PageController extends Controller
{
    public $model = 'page';
    public function filter_fields(){
        return [
            'title'=>[
                'type'=>'text'
            ],
            'link'=>[
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
        $pages = Page::where($this->filter(false))
                        ->orderBy($this->orderby, 'desc')->paginate($this->perpage())
                        ->withPath($this->url_params(true,['page'=>null]));

        return view('page.list', [
            'results'=>$pages
        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.update',[
            'object'=> new Page(),
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
        ]);

        $page = Page::create([
            'title'=>request('title'),
            'link'=>request('link'),
            'content'=>request('content'),
        ]);
       

       return redirect()
                ->route('page_edit', $page->id)
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
        $page = Page::findOrFail($id);
        return view('page.update', [
            'object'=>$page,
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
        ]);
      
        $page = Page::findOrFail($id);
        $page->title = request('title');
        $page->link = request('link');
        $page->content = request('content');
        $page->save();

        return redirect()
                ->route('page_edit', $page->id)
                ->with('success', __('global.edit_succees'));
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $page = Page::findOrFail($id);
        
        $references = $page->images;
            
        if( $page->delete() ){            
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return redirect()
            ->route('page')
            ->with($flash_type, __('global.'.$msg));
    }
}