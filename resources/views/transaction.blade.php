<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- CSS -->
        <link href="/public/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <!-- версия для разработки, включает отображение полезных предупреждений в консоли -->
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        
    </head>
    <body>

        <div class="container">
            <div class="row">
                <h1 class="text-center">Тестове завдання</h1>
                <div class="form-group">
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Зробити транзакцію</button>
                </div>
                <h2 class="text-center">Транзакції</h2>
                <table class="table table-striped">
                    <tr>
                        <td>id</td>
                        <td>Час</td>
                        <td>Поповнили</td>
                        <td>Витратили</td>
                        <td>Відмінити</td>
                    </tr>
                    @foreach($transiactions as $transiaction)
                    <tr>
                        <td>{{$transiaction->id}}</td>
                        <td>{{$transiaction->created_at}}</td>
                        <td>
                            @if($transiaction->action['id'] == 1)
                            <i class="fa fa-money"></i> {{$transiaction->price}}
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            @if($transiaction->action['id'] == 2)
                            <i class="fa fa-credit-card"></i> {{$transiaction->price}}
                            @else
                            -
                            @endif
                        </td>
                        <td><button class="btn btn-danger">X</button></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <!-- Vue module Casa-->
        <script src="/public/js/transaction.js"></script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
