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

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Створити транзакцію</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('transaction_store') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group" id="modelAction">
                            <label>Тип:</label>
                            <select name="action" v-model="action" v-on:change="changeType" class="form-control">
                                <option value="0">Виберіть тип</option>
                                @foreach($actions as $action)
                                <option value="{{$action->id}}">{{$action->name}}</option>
                                @endforeach
                            </select>
                        </div>             

                        <div class="form-group" id="modelPayment">
                            <label>Оплата:</label>
                            <select name="payment" v-model="payment" v-on:change="changePayment" class="form-control">
                                <option value="0">Виберіть оплату</option>
                                @foreach($payments as $payment)
                                <option value="{{$payment->id}}">{{$payment->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="modelTransactionCategory">
                            <label>Категорія транзакції:</label>
                            <select name="transaction_category" v-model="transaction_category" class="form-control">
                                <option value="0">Виберіть категорію транзакції</option>
                                @foreach($transaction_category as $category)
                                    @foreach($category->payments as $payment)
                                        <option value="{{$category->id}}" v-if="{{$category->action_id}} == action && {{$payment->id}} == payment">
                                            - {{$category->name}}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Сума:</label>
                            <input type="text" name="price" class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Submit">
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <h1 class="text-center">Тестове завдання</h1>
            <div class="form-group">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Зробити транзакцію</button>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <h2 class="text-center">Транзакції</h2>
            <table class="table table-striped">
                <tr>
                    <td><b>id</b></td>
                    <td><b>Час</b></td>
                    <td><b>Категорія</b></td>
                    <td><b>Поповнили</b></td>
                    <td><b>Витратили</b></td>
                    <td><b>Відмінити</b></td>
                </tr>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{$transaction->id}}</td>
                    <td>{{$transaction->created_at}}</td>
                    <td>{{$transaction->transactionCategory->name}}</td>
                    <td>
                        @if($transaction->action['id'] == 1)
                            @if($transaction->paymend_id == 1)
                            <i class="fa fa-money"></i> {{$transaction->price}}
                            @elseif($transaction->paymend_id == 2)
                            <i class="fa fa-credit-card"></i> {{$transaction->price}}
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($transaction->action['id'] == 2)
                            @if($transaction->paymend_id == 1)
                            <i class="fa fa-money"></i> {{$transaction->price}}
                            @elseif($transaction->paymend_id == 2)
                            <i class="fa fa-credit-card"></i> {{$transaction->price}}
                            @endif
                        @endif
                    </td>
                    <td><a class="btn btn-danger" href="{{ route('transaction_rollback', [ 'id' => $transaction->id ]) }}">X</a></td>
                </tr>
                @endforeach
            </table>

            <h2 class="text-center">Баланс</h2>
            <table class="table table-striped">
                <tr>
                    <td><b>Готівковою</b></td>
                    <td><b>Без готівки</b></td>
                </tr>
                <tr>
                    <td><i class="fa fa-money"></i> {{$nalichni}}</td>
                    <td><i class="fa fa-credit-card"></i> {{$nenalicni}}</td>
                </tr>
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
