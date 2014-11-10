<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IIA Zadanie 5</title>
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
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/z5">IIA Zadanie 5</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="register.php">Michal Gallovic</a></li>
        </ul>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        </div><!-- /.navbar-collapse -->
    </div>
</nav>
<div class="container text-center">
    <h1>Vyhľadaj si ceny benzínu na základe PSČ</h1>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4 space">
            <div id="error-message" class="alert alert-danger">
                <p>

                </p>
            </div>
        </div>
    </div>
    <div class="row">
        
                <form id="psc-form" action="find.php" method="post" class="space">
                    <div class="col-sm-4 col-sm-offset-2">
                        <div class="form-group">
                            <input class="form-control text-center" id="psc" type="text" name="psc"/>
                        </div>
                    </div>
                    <div class="col-sm-4 ">
                        <select id="fuel-type" name="price_search_fuel" class="form-control">
                            <option value="8" id="OPTION_2">
                                Diesel
                            </option>
                            <option value="256" id="OPTION_3">
                                Diesel+ (aditovovaný)
                            </option>
                            <option value="32" id="OPTION_4">
                                Normal95 (UNI)
                            </option>
                            <option value="2" id="OPTION_5">
                                Natural95
                            </option>
                            <option value="4096" id="OPTION_6">
                                Natural95+ (aditovovaný)
                            </option>
                            <option value="4" id="OPTION_7">
                                Natural98
                            </option>
                            <option value="128" id="OPTION_8">
                                Natural99+ (aditovovaný 99/100)
                            </option>
                            <option value="16" id="OPTION_9">
                                LPG
                            </option>
                            <option value="8192" id="OPTION_10">
                                Adblue
                            </option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-sm-offset-3 space">
                        <button type="submit" class="btn btn-success">Find prices</button>
                    </div>
                </form>
    </div>
    <div class="row space">
        <div class="col-sm-8 col-sm-offset-2">
            <table class="table table-striped" style="text-align: left;">
                <thead>
                    <tr>
                        <th>Čerpacia stanica</th>
                        <th>Cena</th>
                        <th>Lokalita</th>
                        <th>Dátum</th>
                    </tr>
                </thead>
                <tbody id="petrolRows">

                </tbody>
            </table>
            <p id="loading" class="text-center space">
                Loading your awesome data
                <img class="spinner" src="spinner.GIF" alt=""/>
            </p>

        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
    (function(){
        $(document).ready(function(){
            $('input[name="psc"]').attr('autocomplete', 'off');
        });
        var PetrolInfo = function(data) {
            this.station = data.station;
            this.price = data.price;
            this.locality = data.locality;
            this.date = data.date;
        };

        var refreshTable = function(data) {
            data.forEach(function(elm){
                var row = $('<tr/>');
                for(var propName in elm) {
                    $('<td/>',{
                        html: elm[propName]
                    }).appendTo(row);
                }
               row.appendTo($('#petrolRows'));
            });

            $('#loading').hide();
        };
        $("#psc-form").submit(function(event){
            $('#petrolRows').empty();
            $('#loading').show();
            $('#error-message').slideUp(200);

            event.preventDefault();

            var psc = $('#psc').val();
            var fuelType = $('#fuel-type').val();
            var petrolData = [];

            $.ajax({
                type: "POST",
                url: 'find.php',
                data: {'psc':psc,'price_search_fuel':fuelType}
            }).done(function(response){
                if(response.hasOwnProperty('message') || response.length == 0) {
                    $('#error-message').slideDown(200);
                    $('#error-message p').html(response.message);
                } else {
                    response.forEach(function(elm){
                        petrolData.push(new PetrolInfo(elm));
                    });
                }
                refreshTable(petrolData);
            });
        });
    })();
</script>
</body>
</html>