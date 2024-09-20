<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reports</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body,
        body *:not(html):not(style):not(br):not(tr):not(code) {
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
                'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
            position: relative;
        }
        .header {
            padding: 25px 0;
            text-align: center;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, thead {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        .text-decoration-underline {
            text-decoration: underline;
        }
        .text-center {
            text-align: center;
        }
        .fw-bold {
            font-weight: bold;
        }
        .mt-n5 {
            margin-top: -5px;
        }
        .row {
            gap: 1.5rem;
            row-gap: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: 0;
            margin-right: 0;
            margin-left: 0;
        }
        .col-6 {
            flex: 0 0 auto;
            max-width: 50%;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="w3-container header">
        <div class="w3-row">
            {{-- <div class="w3-quarter">
                <img src="{{ asset('/asset/images/logo.jpg') }}" alt="avatar" height="90px" width="90px">
            </div> --}}
            <div class="w3-half">
                <p class="text-center g"  style="font-size: 13px; font-weight:bold">{{ __('PAWSSIBLE SOLUTIONS') }}</p>
                <p class="text-center g" style="font-size: 14px;">{{ __('Briana Catapang Tower, MCLL Highway, Guiwan, Zamboanga City') }}</p>
                <p class="text-center g" style="font-size: 14px; font-weight:bold">{{ __('Contact No. (+63) 947-7312-312') }}</p>
            </div>
        </div>
    </div>
    <hr style="color: black; border:solid 2px" class="mt-n5">
    <div class="container">
        @foreach ( $appointment as $items)
        <div class="w3-container w3-padding-16 w3-light-grey">
            <div class="row">
                <div class="col-6">
                    <p class="text-decoration-underline">{{ __('Name of pet: '.$items->pet->name) }}</p>
                    <p class="text-decoration-underline mt-n5">{{ __('Breed: '.$items->pet->breed) }}</p>
                    <p class="text-decoration-underline mt-n5">{{ __('Species: '.$items->pet->species) }}</p>
                    <p class="text-decoration-underline mt-n5">{{ __('Birthdate/Age: '.$items->pet->age) }}</p>
                    <p class="text-decoration-underline mt-n5">{{ __('Color/Markings: '.$items->pet->color) }}</p>
                </div>
                <div class="col-6">
                    <p class="text-decoration-underline">{{ __('Pet\'s owner Name: '.$items->user->name) }}</p>
                    <p class="text-decoration-underline mt-n5">{{ __('Pet\'s owner Email: '.$items->user->email) }}</p>
                </div>
            </div>
        </div>
        <h3 class="text-center fw-bold">PATIENT RECORD</h3>
        <table style="width:100%">
            <thead>
                <tr>
                    <td class="text-center">History/Physical Examination</td>
                    <td class="text-center">Diagnosis/Treament Plan</td>
                    <td class="text-center">Date</td>
                </tr>
            </thead>
            <tbody>
                    @foreach ( $items->result as $item)
                    <tr>
                        <td>{{ $item->physical_exam }}</td>
                        <td>{{ $item->treatment_plan }}</td>
                        <td>{{ $item->created_at->toDayDateTimeString() }}</td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
