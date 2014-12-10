<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Intervention - Image Lib</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/prism.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/animate.css"/>
</head>
<body>
<div class="container">
    <div class="row space-sm">
        <div class="col-sm-12" style="margin-left:0px;">
            <ul class="nav nav-pills">
                <li class="active"><a href="index.php">Príklad</a></li>
                <li><a href="install.php">Inštalácia + kód</a></li>
            </ul>
        </div>
    </div>
<!--    <h1>Guzzle + Github API + Handlebars + animate.css</h1>-->
    <h4 class="text-center">Search Github users</h4>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <form id="github-search" action="github.php" method="get">
                <div class="form-group space-xs">
                    <input id="username" type="text" class="form-control text-center animated" placeholder="JeffreyWay"/>
                </div>

                <div class="text-center">
                    <button class="btn btn-success">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div id="gitcard-placeholder" class="animated">

    </div>

    <script id="github-card" type="text/x-handlebars-template">
        <div class="row space-sm">
            <div class="col-sm-4">
                <div class="well">
                    <h3>{{ fullname }}</h3>
                    <img class="space-xs img-responsive" src="{{ avatar_url }}" alt=""/>
                    <p class="space-xs">
                        <strong>Username:</strong> {{ username }}
                    </p>
                    <p class="space-xs">
                        <strong>Link:</strong> <a href="{{ github_url }}">{{ github_url }}</a>
                    </p>
                </div>
            </div>
            <div class="col-sm-6">
                <span class="h3">Repositories <span class="badge badge-repo">{{ public_repos.length }}</span></span>
                <div class="list-group space-sm">
                    {{#each public_repos}}
                    <a href="{{ repo_url }}" class="list-group-item">
                        <h4 class="list-group-item-heading">{{ repo_name }}</h4>
                        <p class="list-group-item-text">{{ repo_description }}</p>
                    </a>
                    {{/each}}
                </div>
            </div>
        </div>
    </script>

    <script id="github-error" type="text/x-handlebars-template">
        <div class="row space-sm">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="well">
                    <h3>{{ message }}</h3>
                </div>
            </div>
        </div>
    </script>
</div>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="js/prism.js"></script>
<script src="js/handlebars-v2.0.0.js"></script>
<script src="js/app.js"></script>
</body>
</html>