<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blocked Page</title>

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap JavaScript Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(-120deg,
                    #7b848c 0%,
                    #7b848c 33%,
                    rgb(234, 240, 245) 64%,
                    rgb(234, 240, 245) 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content {
            /* padding-left: 10%; */
        }

        h1 {
            font-size: 10rem;
            font-weight: 900;
            margin: 0;
            color: #000;
            /* Change the color as needed */
        }

        h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            color: #000;
            /* Change the color as needed */
        }

        h6 {
            font-size: 0.8rem;
            margin: 0;
            color: #ec6325;
            /* Change the color as needed */
        }

        p {
            font-size: 0.8rem;
            color: #ec6235;
            /* Adjust the color to your preference */
        }

        .search-btn-orange {
            color: #fff;
            background-color: #ec6235;
            border-color: #ec6235;
            border-radius: 11px;
            font-size: 0.8rem;
        }

        .search-btn-orange:hover {
            color: #fff;
            background-color: #ec6235;
            border-color: #ec6235;
            filter: brightness(1.1);
            transform: scale(1.01);
        }

        .search-btn-orange:active {
            color: #fff !important;
            background-color: #ec6235 !important;
            border-color: #ec6235 !important;
            filter: brightness(1.1);
            transform: scale(1.01);
        }
    </style>
</head>

<body>
    <section class="container-fluid">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-4">
                <div class="content">
                    <h1>Blocked</h1>

                    <p style="color: #44525d" class="mt-2">
                        Sorry Your Account Blocked
                    </p>
                    <div class="row p-2 mt-3">
                        <a href="{{ route('dashboard') }}" class="col-4 btn search-btn-orange mx-1"
                            style="padding: 0.8rem">
                            Home Page
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6"></div>
        </div>
    </section>
</body>

</html>
