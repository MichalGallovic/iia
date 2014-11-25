<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IIA Zadanie 6</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
    <style>
        .space{
            margin-top: 40px;
        }
        #loading {
            display:none;
        }
        #error-message{
            display:none;
        }
        .spinner {
            width: 15px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">

            <a class="navbar-brand" href="/z6">IIA Zadanie 6</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Michal Gallovic</a></li>
        </ul>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        </div><!-- /.navbar-collapse -->
    </div>
</nav>
<div class="container text-center">
    <h1>Zisti, kto a kde má kedy meniny:</h1>

    <div class="row">
        <form role="form" class="space" id="form">
            <div class="col-sm-4 col-sm-offset-2">
                <div class="form-group">
                    <input id="day" class="form-control text-center" placeholder="den"/>
                </div>
            </div>
            <div class="col-sm-4">
                <input id="month" class="form-control text-center" placeholder="mesiac"/>
            </div>
            <div class="col-sm-4 col-sm-offset-4">
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Hľadaj</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row" >
        <div class="col-sm-4 col-sm-offset-4" id="panel">

        </div>
    </div>

</div>




<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="http://momentjs.com/downloads/moment-with-locales.js"></script>
<script>
    $(document).ready(function(){

        $('#form').submit(function(event){
            event.preventDefault();
            $('#panel').empty();
            $('#namesday-panels').empty();
            var day = $('#day').val();
            var month = $('#month').val();
            $.ajax({
                type: 'GET',
                url: 'api/v1/meniny/'+day+"/"+month
            }).then(function(response) {


                var container = $('<div/>',{
                    class: 'panel panel-default'
                });
                var body = $('<div/>',{
                    class: 'panel-body'
                }).appendTo(container);


                for(var propName in response) {
                    var value = response[propName];
                    var row, strong, stateName;

                    if(value != "" && propName != "sk") {
                        row = $('<div/>', {
                            class: 'row'
                        });
                        switch(propName) {
                            case 'sk_many':
                                stateName = 'Slovensko';
                                break;
                            case 'cz':
                                stateName = 'Česká republika';
                                break;
                            case 'hu':
                                stateName = 'Maďarsko';
                                break;
                            case 'pl':
                                stateName = 'Poľsko';
                                break;
                            case 'at':
                                stateName = 'Rakúsko';
                                break;
                        }
                        strong = $('<strong/>', {
                            text: stateName
                        });
                        strong.appendTo(row);
                        strong.after(" - "+value);
                        row.appendTo(body);
                    }
                }

                container.appendTo($('#panel'));

            });
        });
    });
</script>
</body>
</html>