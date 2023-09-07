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
</head>

<body>

    <nav class="navbar bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
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

    <div id="main" class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-4 mx-auto">
                    <div class="row mb-4">
                        <div class="col-8 mx-auto">
                            <a href="{{ route('truncatePrevData') }}" class="btn btn-secondary rounded-0">Click Truncate
                                Previous Data</a>
                        </div>
                    </div>

                    <form action="{{ route('uploadCsv') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="uploadFile" class="form-label h5">Upload The CSV File</label>

                        <input id="uploadFile" type="file" class="form-control rounded-0" name="csvFile" />

                        <input class="btn btn-outline-success rounded-0" type="submit" name="submit"
                            value="Import CSV" />
                        <a href="{{ route('getFacts') }}" class="btn btn-outline-warning rounded-0 float-end">Get Factual Data</a>
                    </form>
                </div>
            </div>

            {{-- Data Table Start --}}

            <table id="table" class="display table table-bordered my-4 table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>State</th>
                        <th>Spoke</th>
                        <th>Hub</th>
                        <th>CHO</th>
                        <th>OPD_V1</th>
                        <th>OPD_V2</th>
                        <th>Total_OPD</th>
                        <th>HWC_V1</th>
                        <th>HWC_V2</th>
                        <th>Total_HWC</th>
                        <th>Total_Consultation</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($reports))
                        @foreach ($reports as $report)
                            <tr>
                                <td>{{ $report->id }}</td>
                                <td>{{ $report->State }}</td>
                                <td>{{ $report->Spoke }}</td>
                                <td>{{ $report->Hub }}</td>
                                <td>{{ $report->CHO }}</td>
                                <td>{{ $report->OPD_V1 }}</td>
                                <td>{{ $report->OPD_V2 }}</td>
                                <td>{{ $report->Total_OPD }}</td>
                                <td>{{ $report->HWC_V1 }}</td>
                                <td>{{ $report->HWC_V2 }}</td>
                                <td>{{ $report->Total_HWC }}</td>
                                <td>{{ $report->Total_Consultation }}</td>
                            </tr>
                        @endforeach
                    @else
                    @endif
                </tbody>
            </table>
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
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>
