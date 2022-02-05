<!-- Font Awesome -->
<link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        rel="stylesheet"
/>
<!-- Google Fonts -->
<link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet"
/>
<!-- MDB -->
<link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css"
        rel="stylesheet"
/>
<!--Main Navigation-->
<header>
    <style>
        /* Height for devices larger than 576px */
        @media (min-width: 992px) {
            #intro {
                margin-top: -58.59px;
            }
        }

        .navbar .nav-link {
            color: #fff !important;
        }
    </style>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark d-none d-lg-block" style="z-index: 2000;">
        <div class="container-fluid">
            <!-- Navbar brand -->
            <a class="navbar-brand nav-link" target="_blank" href="/">
                <strong>Clinica STORMA</strong>
            </a>
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01"
                    aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarExample01">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="/">Pagina Principala</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cabinet" rel="nofollow"
                           target="_blank">Cabinet</a>
                    </li>

                </ul>

                <ul class="navbar-nav d-flex flex-row">
                    <!-- Icons -->

                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->

    <!-- Background image -->
    <div id="intro" class="bg-image vh-100 shadow-1-strong">
        <video style="min-width: 100%; min-height: 100%;" playsinline autoplay muted loop>
            <source class="h-100" src="https://mdbootstrap.com/img/video/Lines.mp4" type="video/mp4"/>
        </video>
        <div class="mask" style="
        background: linear-gradient(
          45deg,
          rgba(29, 236, 197, 0.7),
          rgba(91, 14, 214, 0.7) 100%
        );
      ">
            <div class="h1 container mt-5 pt-5 text-center text-white">Programare la stomatolog {{ $doctor->name ?? 'Daniel' }}</div>
            <div class="container d-flex align-items-center justify-content-center text-center h-75">
                <div class="  d-flex  justify-content-center bg-white rounded-2  p-4 " >


                    @foreach($week_days as $index => $day)

                    <div class="">
                        <div class="p-3   fw-bold">{{$day}}</div>
                        <?php  for($i = 1; $i <= $work_hours + 1;  $i++) { ?>
                        <form action="/make-appointment" method="POST">
                            @csrf
                            <input type="hidden" name="doctor_id" value="{{$doctor->id}}">
                            <input type="hidden" name="order" value="{{$i}}">
                            <input type="hidden" name="appointment_date" value="{{$week_days_in_dates[$index]->format('Y-m-d')}}">
                            <button type="submit" class="
                                    {{
                                        //Nu permitem programarea la zilele din trecut
                                        now()->subDay()->greaterThan($week_days_in_dates[$index]) ? 'disabled' : '' }}
                                    {{
                                        //Daca ziua din calendar este egala cu ziua de azi permitem programarea doar la orele din viitor
                                        now()->startOfDay()->equalTo($week_days_in_dates[$index])
                                        ?
                                            (
                                            (
                                                now()->greaterThan(
                                                carbon()->parse($week_days_in_dates[$index]->format("Y-m-d ". ((8+$i -1) < 10 ? '0': '') . (8 + $i -1)  .':00:00')."")
                                                )
                                               ) ? 'disabled' : ''
                                               )
                                       : ''
                                     }}

                                    {{
                                        //Nu permite sa te programezi daca deja e ocupat
                                       $week_appointments->where('order', $i)->where('appointment_date', $week_days_in_dates[$index]->format('Y-m-d'))->first()
                                        ? 'disabled'
                                        : ''
                                    }}

                                    btn btn-primary justify-content-center m-1 p-2 {{$i === 5 ? 'disabled' : ''}}" >   {{((8+$i -1) < 10 ? '0': '') . (8 + $i -1)}}:00 - {{((8+$i) < 10 ? '0': '') . ( 8 + $i )}}:00  </button>
                        </form>
                            <?php } ?>

                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- Background image -->
</header>
<!--Main Navigation-->

<!--Footer-->
<footer class="bg-light text-lg-start">
    <hr class="m-0"/>
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2022 Riscovoi Alina
    </div>
    <!-- Copyright -->
</footer>
<!--Footer-->
<!-- MDB -->
<script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"
></script>