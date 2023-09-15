<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>eSanjeevani</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('img/eSanjeevaniLogo.svg') }}" alt="eSanjeevani"
                    class="d-inline-block align-text-top">
            </a>
        </div>
    </nav>

    <!-- Message -->
    @if (Session::has('message'))
        <div class="container mt-4">
            <div class="row">
                <div class="col-4 mx-auto">
                    <div class="alert alert-{{ session('class') }} alert-dismissible fade show rounded-0"
                        role="alert">
                        <strong><i class="fa fa-{{ session('icon') }}"></i></strong> {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        {{-- <div class="row">
            <div class="col-6">
                @foreach ($totalConsultations as $item)
                    <h5>Total Consultion: <span
                            class="badge bg-primary rounded-0 shadow totalCon">{{ $item->Total_Consultation }}</span>
                    </h5>
                @endforeach
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-6">

                @foreach ($totalHwc as $item)
                    <h5>Total HWC: <span
                            class="badge bg-primary rounded-0 shadow totalHWC">{{ $item->Total_HWC }}</span></h5>
                @endforeach

                <h5>Leading States HWC:</h5>
                @foreach ($leadingStatesHwc as $item)
                    @php
                        $state = explode(' ', $item->State);
                        $statesAcronym = '';
                        
                        foreach ($state as $s) {
                            $statesAcronym .= mb_substr($s, 0, 1);
                        }
                    @endphp
                    {{ $statesAcronym }}- {{ $item->Total_Consultation }},
                @endforeach
            </div>
            <div class="col-6">
                @foreach ($opdServed as $item)
                    <h5>Total OPD: <span
                            class="badge bg-primary rounded-0 shadow totalOpd">{{ $item->Total_OPD }}</span></h5>
                @endforeach

                <h5>Leading States HWC:</h5>
                @foreach ($leadingStatesOpd as $item)
                    @php
                        $state = explode(' ', $item->State);
                        $statesAcronym = '';
                        
                        foreach ($state as $s) {
                            $statesAcronym .= mb_substr($s, 0, 1);
                        }
                    @endphp
                    {{ $statesAcronym }} - {{ $item->Total_OPD }},
                @endforeach

            </div>

        </div> --}}

        <div class="row">
            <div class="col-7 mx-auto mt-5">
                <div id="factData" class="card rounded-0 p-3">

                    <h6>
                        *🔔 eSanjeevani served
                        <span class="totalConText">
                            @foreach ($totalConsultations as $item)
                                {{ number_format($item->Total_Consultation) }}
                            @endforeach
                        </span> patients
                        🔔 [{{ now()->format('M d') }}]*
                    </h6>
                    <ol>
                        <li>
                            <h6>*eSanjeevaniAB-HWC served
                                <span class="totalHWCText">
                                    @foreach ($totalHwc as $item)
                                        {{ number_format($item->Total_HWC) }}
                                    @endforeach
                                </span> patients*
                            </h6>
                        </li>
                        <li>
                            Leading States:
                            @foreach ($leadingStatesHwc as $item)
                                @php
                                    $state = explode(' ', $item->State);
                                    $statesAcronym = '';
                                    
                                    foreach ($state as $s) {
                                        $statesAcronym .= mb_substr($s, 0, 1);
                                    }
                                @endphp
                                {{ $statesAcronym }}- {{ $item->Total_Consultation }}

                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </li>
                        <li>
                            <h6>*eSanjeevaniOPD served
                                <span class="totalOPDText">
                                    @foreach ($opdServed as $item)
                                        {{ number_format($item->Total_OPD) }}
                                    @endforeach
                                </span> patients*
                            </h6>
                        </li>
                        <li>
                            Leading States:
                            @foreach ($leadingStatesOpd as $item)
                                @php
                                    $state = explode(' ', $item->State);
                                    $statesAcronym = '';
                                    
                                    foreach ($state as $s) {
                                        $statesAcronym .= mb_substr($s, 0, 1);
                                    }
                                @endphp
                                {{ $statesAcronym }} - {{ $item->Total_OPD }}

                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </li>
                        <li>NEWS:</li>
                    </ol>
                    <div class="">
                        🟠TOTALS🟢
                        <h6>*eSanjeevani Consultations: lakhs* </h6>
                        eSanjeevaniHWC: lakhs<br>
                        eSanjeevaniOPD: lakhs<br>
                        *eSanjeevaniHWC was operational today at
                        @foreach ($spoke as $item)
                            {{ number_format($item->Spoke) }}
                        @endforeach Spokes &
                        @foreach ($hub as $item)
                            {{ number_format($item->Hub) }}
                        @endforeach
                        Hubs*
                    </div>

                </div>
            </div>
            <small class="text-danger text-center fw-bold">**This message is formatted for Whatsapp**</small>

            <div class="col-12 text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-secondary rounded-0 shadow">Back</a>
                <button class="btn btn-success rounded-0 shadow" onClick="getMessage();">Click To Copy
                    Message</button>
            </div>
        </div>

    </div>



    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
        integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
    <script src="
                                                    https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js
                                                    "></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>
