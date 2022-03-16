
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
            <table id="clients" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>    
        <script>

            $(document).ready(function(){
                console.log('jquery veikia');
            })

            $.ajax({
                    type: 'GET',
                    url: 'http://127.0.0.1:8000/api/clients',
                    success: function(data) {
                        console.log(data);

                        // if ($.isEmptyObject(data.errorMessage)) {
                        //     //sekmes atvejis
                        //     $("#clients-table tbody").html('');
                        //     $.each(data.clients, function(key, client) {
                        //         let html;
                        //         html = createRowFromHtml(client.id, client.name, client
                        //             .surname, client.description, client
                        //             .client_company.title);
                        //         // console.log(html)
                        //         $("#clients-table tbody").append(html);
                        //     });

                        //     $("#createClientModal").hide();
                        //     $('body').removeClass('modal-open');
                        //     $('.modal-backdrop').remove();
                        //     $('body').css({
                        //         overflow: 'auto'
                        //     });

                        //     $("#alert").removeClass("d-none");
                        //     $("#alert").html(data.successMessage + " " + data.clientName + " " +
                        //         data.clientSurname);

                        //     $('#client_name').val('');
                        //     $('#client_surname').val('');
                        //     $('#client_description').val('');
                        // } else {
                        //     console.log(data.errorMessage);
                        //     console.log(data.errors);
                        //     $('.create-input').removeClass('is-invalid');
                        //     $('.invalid-feedback').html('');

                        //     $.each(data.errors, function(key, error) {
                        //         console.log(key); //key = input id
                        //         $('#' + key).addClass('is-invalid');
                        //         $('.input_' + key).html("<strong>" + error +
                        //             "</strong>");
                        //     });
                        // }
                    }
                });



        </script>
    </body>
</html>
