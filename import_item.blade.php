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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">


    <title>Import</title>
</head>

<body>

    <style>
        .hidden-input {
            display: none;
        }
        .ui-autocomplete {
    z-index: 1000; /* ตั้งค่าให้ Overlay อยู่บนสุด */
    max-height: 200px; /* จำกัดความสูง */
    overflow-y: auto; /* เพิ่ม Scrollbar ถ้าข้อมูลเยอะ */
    background-color: #fff; /* ตั้งสีพื้นหลัง */
    border: 1px solid #ccc; /* เพิ่มขอบ */
}
    </style>

    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var query = $(this).val().toLowerCase(); // ทำให้ query เป็นตัวพิมพ์เล็กทั้งหมด
                $('#table tbody tr').filter(function() {
                    // ดึงค่าจากคอลัมน์ที่ 3 และ 4
                    var col1 = $(this).find('td:nth-child(3)').text().toLowerCase(); // ชื่อ
                    var col2 = $(this).find('td:nth-child(4)').text().toLowerCase(); // Spec

                    // รวมค่าทั้งสองคอลัมน์เป็นข้อความเดียว
                    var combined = col1 + col2;

                    // แสดงหรือซ่อนแถวโดยตรวจสอบว่าค่าที่กรอกพบใน combined หรือไม่
                    $(this).toggle(combined.indexOf(query) > -1);
                });
            });
        });
    </script>


<!-- API DROPPOINT -->
<script>
    $(document).ready(function () {
        $("#droppoint").autocomplete({
            source: function (request, response) {
                console.log("Request term:", request.term); // Debug: ดูค่าที่ส่ง
                $.ajax({
                    url: "/droppoint/search",
                    type: "GET",
                    data: {
                        term: request.term // ส่งค่าที่ผู้ใช้พิมพ์ไป
                    },
                    success: function (data) {
                        console.log("Response data:", data); // Debug: ดูค่าที่ได้กลับมา
                        response(data); // ส่งข้อมูลไปยัง Autocomplete
                    },
                    error: function (xhr, status, error) {
                        console.error("Error occurred:", error); // Debug: แสดงข้อผิดพลาด
                    }
                });
            },
            minLength: 2, // เริ่มค้นหาหลังจากพิมพ์ 2 ตัวอักษร
            select: function (event, ui) {
                console.log("Selected item:", ui.item); // Debug: แสดงค่าที่เลือก
                $("#droppoint").val(ui.item.label); // ใส่ชื่อใน Input Field
                return false;
            }
        });
    });
</script>





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

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Material</h4>
                        <div class="d-flex align-items-center"> <!-- Keep the search and export buttons together -->
                            <form class="d-flex ms-2">
                                <input type="text" class="form-control fixed-width-input" name="search"
                                    id="search" placeholder="Search" aria-label="Search">
                            </form>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="table-container">
                            <table class="table" id="table">
                                <thead style="font-size: 12px; text-align:center ">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Material Code</th>
                                        <th scope="col">Material Name </th>
                                        <th scope="col">Spec/Size</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($material as $item)
                                        <tr style="font-size: 10px; text-align:center ">
                                            <td>{{ $item->id }}</td>
                                            <td>
                                                <a href="#"
                                                    onclick="populateHiddenFields({{ json_encode($item->material_c) }}, {{ json_encode($item->material_n) }}, {{ json_encode($item->spec_size) }}, {{ json_encode($item->brand) }}, {{ json_encode($item->unit) }}, event); $('#myModal').modal('hide');">
                                                    {{ $item->material_c }}
                                                </a>
                                            </td>

                                            <td class="searchtable">{{ $item->material_n }}</td>
                                            <td class="searchtable">{{ $item->spec_size }}</td>
                                            <td>{{ $item->brand }}</td>
                                            <td>{{ $item->unit }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>

            </div>

        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form class="row g-3 justify-content-center my-2 text-center" autocomplete="off" method="POST"
            action="/importadd">
            @csrf

            <div class="container my-5">
                <div class="row g-3 ">
                    <div class="col-md-3">
                        <label for="refcode" class="form-label" style="text-align: left">Refcode</label>
                        <input type="text" name="refcodename[]" class="form-control" id="refcode"
                            placeholder="กรุณากรอก Refcode" required>
                    </div>

                    <div class="col-md-2 ">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date[]" class="form-control" id="date"
                            placeholder="กรุณากรอก Droppoint" required>
                    </div>

                    <div class="col-md-2">
                        <label for="droppoint" class="form-label">Droppoint</label>
                        <select name="droppoint[]" class="form-control" id="droppoint" required>
                            <option value="" disabled selected>กรุณาเลือก Droppoint</option>
                            @foreach ($droppoint as $item)
                                <option value="{{ $item->id }}">{{ $item->droppoint }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- ดึง API -->
                    <div class="col-md-2">
                        <label for="droppoint" class="form-label">Droppoint</label>
                        <input 
                            type="text" 
                            name="droppoint" 
                            class="form-control" 
                            id="droppoint" 
                            placeholder="กรุณากรอก Droppoint" 
                            required
                        >
                    </div>
                </div>

                <div class="row g-3 my-2">
                    <div class="col-md-4 d-flex align-items-center">
                        <div id="refcode-message" style="display: none;" class="ms-3 text-center mt-4"></div>
                    </div>
                </div>

            </div>

            <hr>

            <div class="row g-12">
                <button type="button" id="addButton" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#myModal" style="display: none; width: 70px; text-align: center; float: left;">
                    ADD
                </button>
            </div>

            <div id="refcode-message"></div>

            <div class="row g-12 ">

                <div class="col-md-1">
                    <label for="No" class="form-label">No</label>
                    <input type="text" class="form-control hidden-input" id="No"
                        style="font-size: 12px; text-align: center; border: none; background-color: transparent;"
                        readonly value="1">
                </div>

                <div class="col-md-1" style="width: 150px">
                    <label for="materialCode" id="materialCode" class="form-label">Material Code</label>
                </div>
                <div class="col-md-1" style="width: 150px">
                    <label for="materialName" id="materialName" class="form-label">Material Name</label>

                </div>
                <div class="col-md-" style="width: 150px">
                    <label for="specSize" id="specSize" class="form-label">Spec/Size</label>

                </div>
                <div class="col-md-1">
                    <label for="brand" id="brand" class="form-label">Brand</label>

                </div>
                <div class="col-md-1">
                    <label for="unit" id="unit" class="form-label">Unit</label>

                </div>

                <div class="col-md-1">
                    <label for="Quantity" class="form-label" name="Amout">Quantity</label>
                </div>

                <div class="col-md-1">
                    <label for="Remark" id="Remark" class="form-label">Remark</label>
                </div>

            </div>

            <div id="rowsContainer">
                <!-- แถวแรกจะถูกเพิ่มที่นี่ -->
            </div>

            <div class="d-flex justify-content-center my-4"> <!-- Center the button -->
                <input class="btn btn-success" type="submit" value="Submit">
            </div>

            <hr>
    </div>

    </form>

    <!-- Show data Table 1 -->

    <div class="table-container" style="width: 100%; height: 400px; ">

        <table class="table">
            <thead style="font-size: 12px; text-align:center ">
                <th scope="col">Refcode</th>
                <th scope="col">Droppoint</th>
                <th scope="col">Material Code</th>
                <th scope="col">Material Name</th>
                <th scope="col">Spec/Size</th>
                <th scope="col">Brand</th>
                <th scope="col">Unit</th>
                <th scope="col">Quantity</th>
                <th scope="col">Remark</th>
                <th scope="col">Date</th>
                <th scope="col">Transaction ID</th>
                <th scope="col">import_quantity</th>
            </thead>

            <tbody>
                @foreach ($import_add as $item)
                    <tr style="font-size: 10px; text-align:center">
                        <!-- <td>{{ $item->id }}</td> -->
                        <td>{{ $item->refcode_import }}</td>

                        @foreach ($droppoint as $no)
                            @if ($item->droppoint_import == $no->id)
                                <td>{{ $no->droppoint }}</td>
                            @endif
                        @endforeach

                        <td>{{ $item->material_code_import }}</td>
                        <td>{{ $item->material_name_import }}</td>
                        <td>{{ $item->spec_size_import }}</td>
                        <td>{{ $item->brand }}</td>
                        <td>{{ $item->unit }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->remark }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->transaction }}</td>
                        <td>{{ $item->import_quantity }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rowsContainer = document.getElementById('rowsContainer');
            const submitButton = document.querySelector('input[type="submit"]');

            if (rowsContainer.children.row === 0) {
                submitButton.style.display = 'none'; // ซ่อนปุ่ม
            } else {
                submitButton.style.display = 'block'; // แสดงปุ่ม
            }
        });
    </script>

    <!-- click link -->
    <script>
        function populateHiddenFields(materialCode, materialName, specSize, brand, unit, event) {
            event.preventDefault(); // Prevent page redirection

            // Set values in hidden input fields (if needed for form submission)
            document.getElementById('materialCode').value = materialCode;
            document.getElementById('materialName').value = materialName;
            document.getElementById('specSize').value = specSize;
            document.getElementById('brand').value = brand;
            document.getElementById('unit').value = unit;

            // Find the container to add new rows
            const container = document.getElementById('rowsContainer');

            // Create a new row
            const newRow = document.createElement('div');
            newRow.className = 'row g-12 row-item'; // Add the row-item class

            // Find the last row number to calculate the next row number
            let lastRowNumber = 0;
            const rows = container.getElementsByClassName('row-item');
            if (rows.length > 0) {
                const lastRow = rows[rows.length - 1];
                const lastRowNumberInput = lastRow.querySelector('#No');
                if (lastRowNumberInput) {
                    lastRowNumber = parseInt(lastRowNumberInput.value, 10);
                }
            }

            // Increment the row counter by 1 based on the last row number
            let rowCounter = lastRowNumber + 1;

            newRow.innerHTML = `

        <div class="row g-12 my-1" >

            <div class="col-md-1">
                <input type="text" class="form-control" id="No"
                style="font-size: 12px; text-align: center; border: none; background-color: transparent;" 
                 value="${rowCounter}" readonly> 
            </div>
            <div class="col-md-1" style="width: 160px">
                <input type="text" name="materialCode[]" class="form-control" value="${materialCode}" 
                style="font-size: 12px; text-align: center; border: none; background-color: transparent;" readonly>
            </div>
            <div class="col-md-1" style="width: 150px">
                <input type="text"  name="materialName[]" class="form-control" value="${materialName}" 
                style="font-size: 12px; text-align: center; border: none; background-color: transparent;" readonly>
            </div>
            <div class="col-md-1" style="width: 150px">
                <input type="text" name="specSize[]" class="form-control" value="${specSize}" 
                style="font-size: 12px; text-align: center; border: none; background-color: transparent;" readonly>
            </div>
            <div class="col-md-1">
                <input type="text" name="brand[]" class="form-control" value="${brand}" 
                style="font-size: 12px; text-align: center; border: none; background-color: transparent;" readonly>
            </div>
            <div class="col-md-1">
                <input type="text" name="unit[]" class="form-control" value="${unit}" 
                style="font-size: 12px; text-align: center; border: none; background-color: transparent;" readonly>
            </div>
           
            <div class="col-md-1">
                <input type="number" name="Amout[]" class="form-control" id="Amout" required
                    style="font-size: 12px; text-align: center" step="1" >
            </div>
            <div class="col-md-1" style="width: 170px">
                <input type="text" name="Remark[]" class="form-control" id="Remark" 
                style="font-size: 12px; text-align: center;" >
            </div>


            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger" onclick="removeRow(this)" style="font-size: 12px">ลบ</button>
            </div>

            </div>
        `;
            // Append the new row to the container
            container.appendChild(newRow);
        }

        function removeRow(button) {
            // Remove the row containing the clicked button
            const row = button.closest('.row-item');
            if (row) {
                row.remove();
            }
        }
    </script>


    <!-- jQuery (if not already included) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let timeout;
        $(document).ready(function() {
            $('#refcode').on('input', function() {
                clearTimeout(timeout); // Clear the previous timeout

                let refcode = $(this).val().trim();
                console.log('Input value:', refcode); // Debugging line

                timeout = setTimeout(function() {
                    if (refcode) {
                        $.ajax({
                            url: "{{ route('check.refcode') }}",
                            method: "GET",
                            data: {
                                refcode: refcode
                            },
                            success: function(response) {
                                if (response.exists) {
                                    // Show success message and ADD button
                                    $('#refcode-message').text("Description: " +
                                            response.description)
                                        .css("color", "green")
                                        .show();
                                    $('#addButton').show(); // Show the ADD button
                                } else {
                                    // Show not found message and hide ADD button
                                    $('#refcode-message').text("Refcode not found.")
                                        .css("color", "red")
                                        .show();
                                    $('#addButton').hide(); // Hide the ADD button
                                }
                            }
                        });
                    } else {
                        $('#refcode-message').text(''); // Clear any previous messages
                        $('#refcode-message').hide(); // Hide message if input is empty
                    }
                }, 300); // Adjust timeout as needed
            });
        });
    </script>

</body>

</html>
