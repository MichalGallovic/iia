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
    <h1>Zobraz si štátne sviatky: </h1>

    <div class="row text-center">
        <button style="outline: none" id="slovak" class="btn btn-warning">Slovenské</button>
        <button style="outline: none" id="czech" class="btn btn-info">České</button>
    </div>

    <div id="panels" class="space">

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
        $("#czech").click(function() {
            $('#panels').empty();
            $('#slovak').removeClass('active');
            $('#czech').addClass('active');
            $.ajax({
                type: 'GET',
                url: 'api/v1/sviatky?state=cz'
            }).then(function(response) {
                showHolidays(response);
            })
        });
        $("#slovak").click(function() {
            $('#panels').empty();
            $('#czech').removeClass('active');
            $('#slovak').addClass('active');
            $.ajax({
                type: 'GET',
                url: 'api/v1/sviatky?state=sk'
            }).then(function(response) {
                showHolidays(response);
            });
        });

        var showHolidays = function(response) {
            var chunks = [];
            for(var i = 0; i<response.length;) {
                chunks.push(response.slice(i,i+=4));
            }
            chunks.forEach(function(chunk) {
                var row = $('<div/>', {
                    class: 'row'
                });
                var container;
                chunk.forEach(function(elm){
                    container = $('<div/>', {
                        class: 'col-sm-3'
                    });

                    var panel = $("<div/>", {
                        class: 'panel panel-default'
                    }).appendTo(container);
                    var body = $("<div/>", {
                        class: 'panel-body'
                    }).appendTo(panel);

                    var when = elm.day;
                    when = when.substr(0,2) + "-" + when.substr(2,2);
                    when = moment(when).format('LL');

                    var strong = $("<strong/>", {
                        style: 'display: block',
                        text: when
                    }).appendTo(body);

                    strong.after(elm.name);

                    container.appendTo(row);
                });
                row.appendTo($('#panels'));
            });
        }
    });
</script>
</body>
</html>