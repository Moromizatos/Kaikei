<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Kaikei</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body>
    <header class="container-fluid bg-body-tertiary">
        <div class="container">
            <div class="d-flex flex-wrap py-3 mb-4 border-bottom">
                <a href="/"
                    class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <svg width="72" height="72" viewBox="0 0 512 512" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M49.5 137.24L259.667 15.7539L461 137.24L255.5 250.5L49.5 137.24Z" fill="#61FF8B" />
                        <path d="M255.768 251.886L256 483L52 366.111L49 137L255.768 251.886Z" fill="#FF5B79" />
                        <path d="M256 250.165V483L460 366.332V136L256 250.165Z" fill="#7770FF" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M256 0L477.702 128V384L256 512L34.2974 384V128L256 0ZM236 57.7349L99.3105 136.653L236 215.57V57.7349ZM74.2974 168.399V332.601L216.5 250.5L74.2974 168.399ZM89.7843 369.847L236 454.265V285.43L89.7843 369.847ZM276 454.265L422.716 369.559L276 284.852V454.265ZM437.702 332.023V168.977L296.5 250.5L437.702 332.023ZM413.189 136.941L276 57.7351V216.148L413.189 136.941Z"
                            fill="#050315" />
                    </svg>

                    <span class="fs-4 m-3">Kaikei</span>
                </a>

                <ul class="nav nav-underline nav-fill align-content-center gap-">
                    <li class="nav-item"><a href="#" class="nav-link" aria-current="page">Dashboard</a>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link active">Accounts</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Expenses</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Hours</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Profile</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="container overflow-auto">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Library</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between page-header align-items-center">
                    <h1>Accounts</h1>
                    <button type="button" class="btn btn-secondary rounded-pill px-5">Create New +</button>
                </div>
                <hr>
                <p>Below is a listing of all your accounts with their respective details.</p>
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Account Name</th>
                            <th scope="col">Currency</th>
                            <th scope="col">Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><a href="#">View</a></th>
                            <td>Monzo - Klara</td>
                            <td>GBP</td>
                            <td>1,045.67</td>
                        </tr>
                        <tr>
                            <th scope="row"><a href="#">View</a></th>
                            <td>Lloyds - Current</td>
                            <td>GBP</td>
                            <td>126.34</td>
                        </tr>
                        <tr>
                            <th scope="row"><a href="#">View</a></th>
                            <td>Lloyds - Joint</td>
                            <td>GBP</td>
                            <td>1,400.00</td>
                        </tr>
                        <tr>
                            <th scope="row"><a href="#">View</a></th>
                            <td>Wise - CZK Balance</td>
                            <td>CZK</td>
                            <td>1,356.34</td>
                        </tr>
                        <tr>
                            <th scope="row"><a href="#">View</a></th>
                            <td>Nu Bank - Investments</td>
                            <td>BRL</td>
                            <td>10,740.12</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="my-5"></div>
    <footer class="fixed-bottom container-fluid bg-body-tertiary">
        <div class="container d-flex footer py-3 justify-content-center align-items-center gap-2">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M28.921 1.35272L28.5461 0L24.3442 2.20708L25.3951 4.22257L27.017 3.35419C27.0899 3.86776 27.1277 4.39293 27.1277 4.92728C27.1277 7.71093 26.101 10.2575 24.4051 12.2102C23.6188 11.1782 22.6466 10.2947 21.5383 9.60967C21.4903 10.4193 21.2657 11.204 20.8864 11.9103C21.5968 12.4312 22.2211 13.0621 22.7342 13.7777C20.8566 15.2088 18.5111 16.0593 15.9683 16.0593C13.4254 16.0593 11.0799 15.2088 9.20227 13.7777C9.71536 13.0621 10.3397 12.4312 11.0501 11.9103C10.6708 11.204 10.4462 10.4193 10.3982 9.60967C9.28988 10.2947 8.31766 11.1782 7.5314 12.2102C5.83552 10.2575 4.80883 7.71093 4.80883 4.92728C4.80883 4.40603 4.84476 3.89351 4.91418 3.39197L6.52166 4.21452L7.55191 2.18843L3.36712 0.0617739L3.00033 1.40796C2.69439 2.53084 2.5314 3.7111 2.5314 4.92728C2.5314 12.3255 8.55185 18.3311 15.9683 18.3311C23.3847 18.3311 29.4051 12.3255 29.4051 4.92728C29.4051 3.6911 29.2367 2.4921 28.921 1.35272Z"
                    fill="black" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M10.9769 9.2627C10.9769 7.94277 11.503 6.67508 12.439 5.74211C13.3743 4.80839 14.6451 4.28359 15.9683 4.28359C17.2914 4.28359 18.5622 4.80839 19.4975 5.74211C20.4335 6.67508 20.9596 7.94277 20.9596 9.2627C20.9596 10.5826 20.4335 11.8503 19.4975 12.7833C18.5622 13.717 17.2914 14.2418 15.9683 14.2418C14.6451 14.2418 13.3743 13.717 12.439 12.7833C11.503 11.8503 10.9769 10.5826 10.9769 9.2627ZM13.2543 9.2627C13.2543 8.5448 13.5405 7.85568 14.0491 7.3483C14.5578 6.84093 15.2486 6.55543 15.9683 6.55543C16.6879 6.55543 17.3787 6.84093 17.8874 7.3483C18.396 7.85568 18.6822 8.5448 18.6822 9.2627C18.6822 9.9806 18.396 10.6697 17.8874 11.1771C17.3787 11.6845 16.6879 11.97 15.9683 11.97C15.2486 11.97 14.5578 11.6845 14.0491 11.1771C13.5405 10.6697 13.2543 9.9806 13.2543 9.2627Z"
                    fill="black" />
                <path
                    d="M3.5942 15.1127L3.29054 17.3088L8.80494 19.8122L7.2381 30.902L9.51553 31.9621L10.7774 20.7076L15.9683 23.0641L21.1591 20.7076L22.421 31.9621L24.6984 30.902L23.1316 19.8122L28.646 17.3088L28.3423 15.1127L15.9683 20.6408L3.5942 15.1127Z"
                    fill="black" />
                <path
                    d="M11.0338 29.8039L11.3375 27.3049L15.9683 29.3495L20.599 27.3049L20.9027 29.8039L15.9683 32L11.0338 29.8039Z"
                    fill="black" />
                <path d="M4.27743 21.7389L4.88475 19.7699L7.46584 20.9059L7.16218 23.102L4.27743 21.7389Z"
                    fill="black" />
                <path d="M3.13872 25.1466L3.74603 23.102L6.93444 24.5408L6.63078 26.7369L3.13872 25.1466Z"
                    fill="black" />
                <path d="M2.68323 26.3583L2 28.4029L6.09938 30.2961L6.40304 28.1L2.68323 26.3583Z" fill="black" />
                <path d="M27.0518 19.7699L27.6591 21.7389L24.7743 23.102L24.4707 20.9059L27.0518 19.7699Z"
                    fill="black" />
                <path d="M28.7978 25.1466L28.1905 23.102L25.0021 24.5408L25.3057 26.7369L28.7978 25.1466Z"
                    fill="black" />
                <path d="M29.2533 26.3583L29.9365 28.4029L25.8371 30.2961L25.5335 28.1L29.2533 26.3583Z"
                    fill="black" />
            </svg>
            <span class="text-body-secondary">Murilo Moromizato - 2024</span>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
