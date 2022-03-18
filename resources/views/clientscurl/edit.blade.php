<form method="POST" action="{{route('client.update', $id)}}">
{{-- <form method="POST" > --}}
    @csrf
    <input type="text" name="client_name" value='{{$client->name}}'  />
    <input type="text" name="client_surname" value='{{$client->surname}}' />
    <input type="text" name="client_description" value='{{$client->description}}' />
    <input type="text" name="client_company_title" value='{{$client->company_title}}' />
    <button type="submit">Add Client to API database</button>
</form>    