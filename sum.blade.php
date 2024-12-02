<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <title>Balance</title>
</head>

<body>

    <style>
        .hidden-input {
            display: none;
        }
    </style>

    <!-- NAVBAR-->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="/import">นำของเข้า</a>
                    <a class="nav-link" href="/withdraw">เบิกของใช้งาน</a>
                    <a class="nav-link" href="/material">import Material</a>
                    <a class="nav-link" href="/addrefcode">import Refcode</a>
                    <a class="nav-link" href="/droppoint">import Droppoint</a>
                    <a class="nav-link" href="/sum" style="margin-left: auto;">Balance</a>
                </div>
            </div>
        </div>
    </nav>


    <hr>

    <style>
        .table-container {
            width: 99%;
            max-height: 500px;
            overflow-x: auto;
            overflow-y: auto;

        }

        .table-container table {
            border: 1px solid #ddd;
            width: 100%;
            height: 100%;
            border-collapse: collapse;
        }

        .table-container td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            white-space: nowrap;
        }

        .table-container th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            white-space: nowrap;
            position: sticky;
            top: 0px;
            background-color: #f8f9fa;
            /* Optional: Add background to the header for contrast */
        }
    </style>

    <h5 class="text-center mt-4" style="font-size: 20px;">BALANCE</h5>

    <div class="table-container ">

        <!-- แสดงข้อความสำเร็จ -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->has('error'))
            <div class="alert alert-danger">
                {{ $errors->first('error') }}
            </div>
        @endif

        <div class="table-container ">
            <table class="table" id="table">
                <thead style="font-size: 12px; text-align:center ">
                    <!--  <th scope="col">id</th> -->
                    <th scope="col">Refcode</th>
                    <th scope="col">Droppoint</th>
                    <th scope="col">Material_code</th>
                    <th scope="col">Material_name</th>
                    <th scope="col">Spec</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Withdraw</th>
                    <th scope="col">Available</th>
                </thead>

                <tbody>
                    @foreach ($summary as $item)
                        <tr style="font-size: 10px; text-align:center">
                            <td>{{ $item->refcode }}</td>
                            @foreach ($droppoint as $no)
                                @if ($item->droppoint == $no->id)
                                    <td>{{ $no->droppoint }}</td>
                                @endif
                            @endforeach
                            <td>{{ $item->material_code }}</td>
                            <td>{{ $item->material_name }}</td>
                            <td>{{ $item->spec }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->withdraw }}</td>
                            <td>{{ $item->available }}</td>
                        </tr>
                    @endforeach


                </tbody>
            </table>

        </div>
    </div>

    <script>
        function confirmUpdate() {
            // แสดงกล่องยืนยัน
            if (confirm('คุณต้องการเพิ่มข้อมูลหรือไม่?')) {
                return true; // ถ้าผู้ใช้ยืนยัน ให้ส่งฟอร์ม
            } else {
                return false; // ถ้าผู้ใช้ยกเลิก ไม่ส่งฟอร์ม
            }
        }
    </script>


</body>

</html>
