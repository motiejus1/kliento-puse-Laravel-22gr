<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Atkomentuoti norint pasipildyti duombaze
        // $this->loadDataFromApi();

        // $clients = Client::all();
        //rysio neturim ir jo net nepatartina turet
        
        // be rysio funckijos su join komanda sujungem lenteles ir rikiavom
        
        // dvigubas foreachas - atsisakom
        // client.company_title -> company.title

        // SELECT * FROM `clients` LEFT JOIN companies ON clients.company_title = companies.title WHERE 1
        $clients = Client::leftJoin('companies', function($join) {
            $join->on('companies.title', '=', 'clients.company_title');
        })->orderBy('api_client_id', 'ASC')->get();

        // dd($clients->toArray());

            //  dd($clients->toArray());
        // return view('test', ['clients'=> json_decode($response)]);
        return view('test', ['clients'=>$clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientscurl.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $data = array(
            'client_name' => $request->client_name,
            'client_surname' => $request->client_surname,
            'client_description' => $request->client_description,
            'client_company_title' => $request->client_company_title,
        ); 

        // return $data;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://127.0.0.1:8000/api/clients",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,//ms
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
    ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $this->loadDataFromApi();

        return  redirect()->route('client.index');

        //curl komanda kuri veikia POST ir perduoda kintamuosius i API
        //loadDataFromApi
        //redirect tiesiog clientscurl.index
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        //Client $client jis dirba pagal id kuris yra irasytas i duomenu baze
        //serverio puseje id gali visiskai skirtis nuo to kas yra kliento puseje
        //mes sitoje vietoje klienta galim pasirinkti iprastai, taciau atnaujinant jo
        //duomenis per update funkcija turime kreipti demesi i api_client_id laukeli

        $client = Client::where('api_client_id', '=', $id )->first();
        // dd($client);

        return view('clientscurl.edit', ['id' => $id, 'client' => $client ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update( $id, Request $request)
    {
        $data = array(
            'client_name' => $request->client_name,
            'client_surname' => $request->client_surname,
            'client_description' => $request->client_description,
            'client_company_title' => $request->client_company_title,
        ); 

        // return $data;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://127.0.0.1:8000/api/clients/".$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,//ms
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
    ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $this->loadDataFromApi();

        // return $response;

        return  redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::where('api_client_id', '=', $id )->first();
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://127.0.0.1:8000/api/clients/".$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,//ms
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            // CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
    ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $this->loadDataFromApi();
        return redirect()->route('client.index');

        // $client->delete();
    }

    public function loadDataFromApi() {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://127.0.0.1:8000/api/clients?csrf=123456789&clientsAll=all",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,//ms
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
    ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        // dd nutrauks funkcija ir atvaizduos visa kintamaji
        
        //$response - json formatu. Reikia i PHP masyva
        
        
        //$istrins klientu duomenu baze

        $deleteClient = Client::all();
        if(count($deleteClient) > 0) {
            foreach($deleteClient as $item) {
                $item->delete();
            }
        }
        
        $clients = json_decode($response);

        foreach($clients as $client) {
            $newClient = new Client;
            $newClient->name = $client->name;
            $newClient->surname = $client->surname;
            $newClient->description = $client->description;
            $newClient->company_title = $client->company_title;
            $newClient->api_client_id = $client->id;
            $newClient->save();
            //sukuriant nauja klienta jam duomenu bazeje yra priskiriamas autoincrement id
        }
        return 0;
    }
}
