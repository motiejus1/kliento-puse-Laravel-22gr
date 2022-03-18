<form method="POST" action="{{route('client.store')}}">
    @csrf
    <input type="text" name="client_name"  />
    <input type="text" name="client_surname" />
    <input type="text" name="client_description" />
    <input type="text" name="client_company_title" />
    <button type="submit">Add Client to API database</button>
</form>    