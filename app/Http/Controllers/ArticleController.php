<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Articles;
use Response;
use App\User;
use Cookie;

// http://api.kme.si/v1/articles?resource_id=22&order=desc&limit=20

class ArticleController extends Controller {

    /*public function __construct()
    {
        $this->middleware('auth', ['only' => 'getCookie']);
    }*/

    /**
     * Create and set access token cookie
     * @param $token
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function setOCookie($token){
        $minutes = 2;

        Cookie::queue('access_token', $token, $minutes);

        return Response::json(array('success' => true));
    }

    /**
     * Get users cookie
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getOCookie(){
        return Response::json((['access_token' => !is_null(Cookie::get('access_token')) ? Cookie::get('access_token') : false]));
    }

    /**
     * Get users favorites
     * @return \Symfony\Component\HttpFoundation\Response
     */
	public function index()
    {
        if(Auth::user()) {
            return Response::json(Auth::user()->articles);
        } else {
            return Response::json(array('success' => false));
        }
        //return Articles::all();
    }

    /**
     * Save new favorite
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
	public function store(Request $request)
	{
        $input = array(
            'section'   => $request->input('section'),
            'title'     => $request->input('title'),
            'image'     => $request->input('image')
        );

        $article = Auth::user()->articles()->create($input);

        if($article){
            return Response::json(array('success' => true));
        } else {
            return Response::json(array('success' => false));
        }
	}

    /**
     * Show articles for single user #2
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
	public function show($id)
	{
        return Response::json(User::find($id)->articles->toArray());
	}

    /**
     * Remove article from favorites
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
	public function destroy($id)
	{
        Articles::destroy($id);
        return Response::json(array('success' => true));
	}


}
