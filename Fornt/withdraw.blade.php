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


    <title>Import</title>
</head>

<body>

    <style>
        .hidden-input {
            display: none;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        //ฟังก์ชั่น search
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var query = $(this).val().toLowerCase(); // ทำให้ query เป็นตัวพิมพ์เล็กทั้งหมด
                $('#table tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(query) > -1);
                });
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
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">เบิกของ</h4>
                        <div class="d-flex align-items-center"> <!-- Keep the search and export buttons together -->
                            <form class="d-flex ms-2">
                                <input type="text" class="form-control fixed-width-input" name="search"
                                    id="search" placeholder="Search" aria-label="Search" style="width: 400px;">
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
                                        <th scope="col">Material_Name</th>
                                        <th scope="col">Material_Code</th>
                                        <th scope="col">Spec</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Droppoint</th>
                                        <th scope="col">Refcode</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Available</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($summary as $item)
                                        <tr style="font-size: 10px; text-align:center">

                                            <td>
                                                <a href="#" data-material-name="{{ $item->material_name }}"
                                                    data-material-code="{{ $item->material_code }}"
                                                    data-spec-size="{{ $item->spec }}" data-unit="{{ $item->unit }}"
                                                    data-available="{{ $item->available }}"
                                                    data-refcode="{{ $item->refcode }}"
                                                    data-description="{{ $item->description }}"
                                                    data-droppoint="{{ $item->droppoint }}"
                                                    onclick="populateHiddenFieldsFromData(this); $('#myModal').modal('hide');">
                                                    {{ $item->material_name }}
                                                </a>
                                            </td>

                                            <td>{{ $item->material_code }}</td>
                                            <td>{{ $item->spec }}</td>
                                            <td>{{ $item->unit }}</td>
                                            <td>{{ $item->droppoint }}</td>
                                            <td>{{ $item->refcode }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->available }}</td>
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
            action="/withdrawAdd">
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
                        <input type="date" name="date[]" class="form-control" id="date" required>
                    </div>
                </div>

                <div id="refcode-message"></div>

                <div class="row g-12">
                    <button type="button" id="addButton" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#myModal"
                        style="display: none; width: 70px; text-align: center; float: left;">
                        ADD
                    </button>
                </div>

                <div id="refcode-table-container" style="display: none; margin-top: 20px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 200px">Refcode_Withdraw</th>
                                <th style="width: 200px">Material Code</th>
                                <th style="width: 220px">Material Name</th>
                                <th style="width: 120px">Unit</th>
                                <th style="width: 200px">Spec</th>
                                <th>Droppoint</th>
                                <th>Available</th>
                                <th style="width: 100px">Withdraw</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="refcode-table-body">
                            <!-- Rows will be dynamically added here -->
                        </tbody>



                    </table>
                    <div class="d-flex justify-content-center "> <!-- Center the button -->
                        <input class="btn btn-success" type="submit" value="Submit">
                    </div>
                </div>

            </div>

    </div>

    </form>

    <hr>

    <!-- Show data Table 1 -->

    <div class="table-container ">
        <table class="table">
            <thead style="font-size: 12px; text-align:center ">
                <!--  <th scope="col">id</th> -->
                <th scope="col">Refcode </th>
                <th scope="col">Refcode_withdraw</th>
                <th scope="col">Material Code</th>
                <th scope="col">Material Name</th>
                <th scope="col">Droppoint</th>
                <th scope="col">Date</th>
                <th scope="col">Available</th>
                <th scope="col">Withdraw</th>
            </thead>

            <tbody>

                @foreach ($withdraw as $item)
                    <tr style="font-size: 10px; text-align:center">
                        <td>{{ $item->refcode_with }}</td>
                        <td>{{ $item->refcode_before }}</td>

                        <td>{{ $item->material_code }}</td>
                        <td>{{ $item->material_name }}</td>

                        @foreach ($droppoint as $no)
                            @if ($item->droppoint == $no->id)
                                <td>{{ $no->droppoint }}</td>
                            @endif
                        @endforeach

                        <td>{{ $item->date }}</td>
                        <td>{{ $item->quantity_before }}</td>
                        <td>{{ $item->quantity_with }}</td>

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
        function populateHiddenFieldsFromData(link) {
            const materialName = link.getAttribute('data-material-name');
            const materialCode = link.getAttribute('data-material-code');
            const specSize = link.getAttribute('data-spec-size');
            const unit = link.getAttribute('data-unit');
            const quantity = link.getAttribute('data-available');
            const refcode = link.getAttribute('data-refcode');
            const description = link.getAttribute('data-description');
            const droppoint = link.getAttribute('data-droppoint');

            // สร้างแถวใหม่ในตาราง
            const container = document.getElementById('refcode-table-body'); // ตารางที่จะแสดงแถวใหม่

            const newRow = document.createElement('tr'); // ใช้ <tr> แทน <div>

            newRow.innerHTML = `
        <td><input type="text" name="refcode_import[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${refcode}" ></td>
        <td><input type="text" name="material_code_import[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${materialCode}" ></td>
        <td><input type="text" name="material_name_import[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${materialName}" ></td>
        <td><input type="text" name="unit[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${unit}" ></td>
        <td><input type="text" name="specSize[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${specSize}" ></td>
        <td><input type="text" name="droppoint[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${droppoint}" ></td>        
        <td><input type="text" name="available[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${quantity}" ></td>
        <td><input type="number" name="Amout[]" class="form-control" style="text-align: center;" step="1" ></td>
        <td><button type="button" class="btn btn-danger" onclick="removeRow(this)" >ลบ</button></td>

                 
<!-- comment

        <td><input type="text" name="material_code_import[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${materialCode}" readonly></td>
        <td><input type="text" name="spec_size_import[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${specSize}" readonly></td>
        <td><input type="text" name="quantity[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${quantity}" readonly></td>
        <td><input type="text" name="description[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${description}" readonly></td>
        <td><button type="button" class="btn btn-danger" onclick="removeRow(this)" >ลบ</button></td>
-->

    `;

            // เพิ่มแถวใหม่ในตาราง
            container.appendChild(newRow);
        }

        function removeRow(button) {
            // ลบแถวที่คลิกจากตาราง
            const row = button.closest('tr');
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
                            url: "{{ route('check.import') }}",
                            method: "GET",
                            data: {
                                refcode: refcode
                            },
                            success: function(response) {
                                if (response.exists) {
                                    $('#refcode-message')
                                        .text("ของที่สามารถเบิกได้: " + response
                                            .description)
                                        .css("color", "green")
                                        .show();

                                    $('#refcode-table-body').empty();

                                    response.imports.forEach(function(importData) {

                                        // สร้างแถวใหม่โดยใช้ข้อมูลจาก importData //แสดงตารางเมื่อ Refcode ถูก
                                        let row = `
    <tr>
        <td><input type="text" name="refcode_import[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${importData.refcode}" ></td>
        <td><input type="text" name="material_code_import[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${importData.material_code}" ></td>
        <td><input type="text" name="material_name_import[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${importData.material_name}" ></td>
        <td><input type="text" name="unit[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${importData.unit}" ></td>
        <td><input type="text" name="specSize[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${importData.spec}" ></td>
        <td><input type="text" name="droppoint[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${importData.droppoint}" ></td>  
        <td><input type="text" name="available[]" class="form-control" style="text-align: center; border: none; background-color: transparent;" value="${importData.available}" ></td>
        <td><input type="number" name="Amout[]" class="form-control" required style="font-size: 12px; text-align: center;" step="1" ></td>
        <td><button type="button" class="btn btn-warning" onclick="removeRow(this)" >ลบ</button></td>
    </tr>
`;
                                        $('#refcode-table-body').append(row);

                                    });

                                    $('#refcode-table-container').show();
                                    $('#addButton').show();
                                } else {
                                    $('#refcode-message')
                                        .text("ไม่พบ Refcode.")
                                        .css("color", "red")
                                        .show();

                                    $('#refcode-table-container').hide();
                                    $('#addButton').hide();
                                }
                            }

                        });
                    } else {
                        $('#refcode-message').text('').hide(); // ล้างข้อความ
                        $('#refcode-table-container').hide(); // ซ่อนตาราง
                        $('#addButton').hide(); // ซ่อนปุ่ม ADD
                    }
                }, 300); // Adjust timeout as needed
            });
        });

        function removeRow(button) {
            // ลบแถวที่คลิกจากตาราง
            const row = button.closest('tr');
            if (row) {
                row.remove();
            }
        }
    </script>

</body>

</html>
