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


    <title>import droppoint</title>
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

    <div class="container my-5">
        <form action="/droppoint" method="POST" enctype="multipart/form-data" id="csvForm">
            @csrf
            <input type="file" name="csv_file_droppoint" accept=".csv" required>
            <input type="submit" name="preview_droppoint" value="แสดงข้อมูล Droppoint ที่ต้องการเพิ่ม"
                data-bs-toggle="modal" data-bs-target="#exampleModal">
        </form>
    </div>

    <div class="container col-12">
        <form action="/Adddroppoint" class="d-flex align-items-center gap-2">
            @csrf
            <!-- Input Fields -->
            <input style="width: 250px" type="text" name="droppoint" class="form-control" id="droppoint" placeholder="Droppoint">
            
            <input style="width: 250px" type="text" name="coordinate" class="form-control" id="coordinate" placeholder="พิกัด">

            <input style="width: 250px" type="text" name="contact" class="form-control" id="contact" placeholder="ติดต่อ">
    
            <!-- Submit Button -->
            <input class="btn btn-primary" type="submit" value="ADD Droppoint">
    
            <!-- Error Message -->
            @error('droppoint')
                <small class="text-danger ms-2">{{ $message }}</small>
            @enderror
        </form>
    </div>
    

    <hr>

    <style>
        .table-container {
            width: 98%;
            max-height: 530px;
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

<h5 class="text-center mt-4" style="font-size: 20px;">Droppoint ที่มีอยู่แล้ว</h5>

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
        <div style="width: 750px; height: 330px ;  margin: auto;">


            <table class="table" id="table" style="height: 200px">

                <thead style="font-size: 12px; text-align:center ">
                    <!--  <th scope="col">id</th> -->
                    <th scope="col">Droppoint</th>
                    <th scope="col">พิกัด</th>
                    <th scope="col">ติดต่อ</th>
                </thead>

                <tbody>
                    @foreach ($droppoint as $item)
                        <tr style="font-size: 10px; text-align:center ">
                            <td>{{ $item->droppoint}}</td>
                            <td>{{ $item->coordinate}}</td>
                            <td>{{ $item->contact }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    @if (!empty($dataToSave) && (is_array($dataToSave) || is_object($dataToSave)))
        <h5 class="text-center mt-4" style="font-size: 20px;">ตรวจสอบข้อมูลที่ Import Droppoint</h5>

        <form action="savedroppoint" method="POST" class="mt-4">
            @csrf

            <div class="table-container ms-3">
                <table id="table">
                    <thead style="font-size: 12px; text-align: center; height: 40px;">
                        <tr>
                            <th scope="col">Dropppoint</th>
                            <th scope="col">พิกัด</th>
                            <th scope="col">ติดต่อ</th>
                            <th scope="col">ChecK </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataToSave as $row)
                            <tr style="font-size: 12px; text-align: center;">
                                @foreach ($row as $key => $cell)
                                    <td>{{ htmlspecialchars($cell) }}</td>
                                @endforeach

                                @php
                                    $matched = false;
                                    foreach ($droppoint as $item) {
                                        if ($item->droppoint === $row['droppoint']) {
                                            $matched = true;
                                            break;
                                        }
                                    }
                                @endphp

                                <td>
                                    @if ($matched)
                                        <span style="color: rgb(255, 6, 6);">Droppoint ซ้ำกัน</span>
                                    @else
                                        <span style="color: green;">สามารถ upload Droppoint ได้</span>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <!-- Hidden input field below the table -->
            <input type="hidden" name="data_add" value="{{ json_encode($dataToSave) }}">


            <div class="text-center mt-4 mb-4">
                <button type="submit" class="btn btn-success" onclick="return confirmUpdate()">เพิ่มข้อมูล</button>
                <a href='/droppoint' class="btn btn-danger">ย้อนกลับ</a>
            </div>
        </form>

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
    @endif

</body>

</html>
