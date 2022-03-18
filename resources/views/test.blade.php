
{{-- 
    1. Sukuriame lentele x
    2. VYkdome ajax uzklausa kurios nuoroda eina i serverio puse http://127.0.0.1:8000/api/clients
    3. AJAX atsakyma json masyva
    4. mes su jquery/javascript galime lengvai uzpildyti susikurta lentele
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Client-side</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Styles -->
    </head>
    <body class="antialiased">
        <div class="container">
            <button id="show-create-client-modal" data-bs-toggle="modal" data-bs-target="#createClientModal" >Create Client</button>
            
            
            <table id="clients" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Description</th>
                        <th>Company name</th>
                        <th>API client id</th>
                        <th>Contact</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                   @foreach($clients as $client) 
                        <tr>
                            <td>{{$client->api_client_id}}</td>
                            <td>{{$client->name}}</td>
                            <td>{{$client->surname}}</td>
                            <td>{{$client->description}}</td>
                            <td>{{$client->company_title}}</td>
                            <td>{{$client->api_client_id}}</td>
                            <td>{{$client->contact}}</td>
                            <td>
                            <a class="btn btn-primary" href="{{route("client.edit", $client->api_client_id )}}">Edit</a>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>
