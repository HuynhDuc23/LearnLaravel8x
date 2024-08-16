<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->is('user/*')) {
            $uri = $request->path();
            dd($uri); // response send route  path
        } else {
            return ('Can not find');
        }
        // return view('clients.users.index');
    }
    public function getUrl(Request $request)
    {
        if ($request->routeIs('user.*')) {
            $url = $request->url();

            // merge parameters , error
            //$request->fullUrlWithQuery([
            //   'name' => 'name'
            // ]);
            // dd($url); // can not get query string with url()
            //dd($request->fullUrlWithoutQuery('name')); // get url with query string

            //$host = $request->host();
            //dd($host); // get host url , host->ip

            // $data = $request->schemeAndHttpHost();
            // dd($data);


            // $method = $request->method();
            // if ($method == 'GET') {
            //     return 'This is method GET';
            // }

            // if ($request->isMethod('get')) {
            //     return 'This is method GET 1';
            // }

            // $ipAddress = $request->ip();
            // return $ipAddress;

            // $dataQueryString =  $request->all('id');
            // return $dataQueryString;

            $data = $request->input('id', '2'); // default value , if no value -> in ra rỗng
            return $data;
        }
    }
    public function showForm(Request $request)
    {

        $name = "";
        return view('clients.users.show', compact('name'));
    }
    public function handlePost(Request  $request)
    {


        if ($request->has('name')) { // kiem tra ton tai bien do hay khong
            dd($request);
        }

        if ($request->isMethod('post')) {
            //dd($request->query('name')); // null
            dd($request->name);
            return  redirect()->route('user.get')->with('success', 'Done');
        }
    }
    public function handleFile(Request $request)
    {
        //dd($request->file('file')); // information file
        //dd($request->file('file')->extension()); // extension
        // $request->file->store('images');
        $request->file->storeAs('images', 'filename.jpg');
    }
}
