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
    <h1>Zisti, kedy a kde má kto meniny:</h1>

    <div class="row">
        <form role="form" class="space" id="form">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="form-group">
                    <input id="name" class="form-control text-center"/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Hľadaj</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row" >
        <div class="col-sm-4 col-sm-offset-4" id="namesday-panels">

        </div>
    </div>

</div>




<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="http://momentjs.com/downloads/moment-with-locales.js"></script>
<script>
    $(document).ready(function(){
        moment.locale('sk', {
            longDateFormat: {
                LL : 'DD MMMM'
            }
        });
        $('#form').submit(function(event){
            event.preventDefault();
            $('#namesday-panels').empty();
            var name = $('#name').val();
            $.ajax({
                type: 'GET',
                url: 'api/v1/meniny?name='+name
            }).then(function(response) {

                response.forEach(function(elm, index) {
                    var container = $('<div/>',{
                        class: 'panel panel-default'
                    });
                    var body = $('<div/>',{
                    class: 'panel-body'
                    }).appendTo(container);

                    var when = elm.day;
                    when = when.substr(0,2) + "-" + when.substr(2,2);
                    when = moment(when).format('LL');
                    var state = " ";
                    switch (elm.state) {
                        case 'sk':
                            state += 'Slovensko';
                            break;
                        case 'cz':
                            state += 'Česká republika';
                            break;
                        case 'hu':
                            state += 'Maďarsko';
                            break;
                        case 'pl':
                            state += 'Poľsko';
                            break;
                        case 'at':
                            state += 'Rakúsko';
                            break;
                    }

                    var strong = $('<strong/>',{
                        text: when
                    }).appendTo(body);
                    strong.after(state);
                    container.appendTo($('#namesday-panels'));
                });
            });
        });
    });
</script>
</body>
</html>