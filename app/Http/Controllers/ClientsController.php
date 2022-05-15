<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index() {
        return view('client.index');
    }

    public function search()
    {
        $search_text = $_GET['query'];
        //$clients = Client::where('agent','LIKE', '%'.$search_text.'%')->with('clients.id')->get();
        $clients = Client::where('agent_id','LIKE', '%'.$search_text.'%')
        ->with('agent')
        ->orderBy('clients.id', 'DESC')
        ->get();
        return view ('client.search',compact('clients'));
    }


    public function fetchAll() {
        $user_type = auth()->user()->user_type;

        if ($user_type == 'admin') {
            // fetch all
            $clients = Client::with('agent')->orderBy('clients.id', 'DESC')->get();
        } else if ($user_type == 'agent') {
            // fetch only clients of current agent
            $clients = Client::where('agent_id', auth()->user()->id)
                ->with('agent')
                ->orderBy('clients.id', 'DESC')
                ->get();
        }
       

        return [
            'clients' => $clients
        ];
    }

    public function fetch($client_id) {
        $client = Client::find($client_id);

        return [
            'client' => $client
        ];
    }

    public function create() {
        return view('client.form');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'follow_up_date' => 'required',
            'inq' => 'required',
            'web' => 'required',
            'status' => 'required',
            'start_date' => 'required',
            'notice' => 'required',
            'insurer' => 'required',
            'cover' => 'required',
            'respond' => 'required',
            'remark' => 'required',
            'contact' => 'required',
            'email' => 'required'
        ]);


        $client = new Client();
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->follow_up_date = $request->follow_up_date;
        $client->inq = $request->inq;
        $client->web = $request->web;
        $client->status = $request->status;
        $client->agent_id = auth()->user()->id;
        $client->start_date = $request->start_date;
        $client->notice = $request->notice;
        $client->insurer = $request->insurer;
        $client->cover = $request->cover;
        $client->respond = $request->respond;
        $client->remark = $request->remark;
        $client->contact = $request->contact;
        $client->email = $request->email;

        $client->save();

        return $client;
    }

    public function edit($client_id) {
        return view('client.form')->with('client_id', $client_id);
    }

    public function update(Request $request, $client_id) {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'follow_up_date' => 'required',
            'status' => 'required',
            'inq' => 'required',
            'web' => 'required',
            'start_date' => 'required',
            'notice' => 'required',
            'insurer' => 'required',
            'cover' => 'required',
            'respond' => 'required',
            'remark' => 'required',
            'contact' => 'required',
            'email' => 'required'
        ]);

        $client = Client::find($client_id);
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->follow_up_date = $request->follow_up_date;
        $client->inq = $request->inq;
        $client->web = $request->web;
        $client->status = $request->status;
        $client->start_date = $request->start_date;
        $client->notice = $request->notice;
        $client->insurer = $request->insurer;
        $client->cover = $request->cover;
        $client->respond = $request->respond;
        $client->remark = $request->remark;
        $client->contact = $request->contact;
        $client->email = $request->email;

        $client->save();

        return $client;
    }

    public function destroy($client_id) {
        $client = Client::find($client_id);

        $client->delete();

        return [
            'message' => 'Client Deleted'
        ];
    }
}
