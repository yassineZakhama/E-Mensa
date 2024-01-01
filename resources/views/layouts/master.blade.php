<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title", "E-Mensa")</title>
    <link rel="stylesheet" href="/css/all.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/stars.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-auto" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-auto">
                @yield("navbar-list-items")
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield("main-content")
    </main>

    <footer class="bg-dark text-light bottom p-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4 text-center">
                    &#169; E-Mensa GmbH
                </div>
                <div class="col-sm-12 col-md-4 text-center">
                    Author: Yassine Zakhama
                </div>
                <div class="col-sm-12 col-md-4 text-center">
                    <a href="#" class="fh-color">Impressum</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="/js/all.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>
