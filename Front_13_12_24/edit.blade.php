<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- Add Boxicons -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <!-- Add Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    :root {
        --color-default: #004f83;
        --color-second: #0067ac;
        --color-white: #fff;
        --color-body: #e4e9f7;
        --color-light: #e0e0e0;
    }


    * {
        padding: 0%;
        margin: 0%;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        min-height: 100vh;
    }

    .sidebar {
        min-height: 100vh;
        width: 78px;
        padding-right: 10px;
        z-index: 99;
        background-color: var(--color-default);
        transition: all .5s ease;
        position: fixed;
        top: 0;
        left: 0;
    }

    .sidebar.open {
        width: 250px;
    }

    .sidebar .logo_details {
        height: 60px;
        display: flex;
        align-items: center;
        position: relative;
    }

    .sidebar .logo_details .icon {
        opacity: 0;
        transition: all 0.5s ease;
    }



    .sidebar .logo_details .logo_name {
        color: var(--color-white);
        font-size: 22px;
        font-weight: 600;
        opacity: 0;
        transition: all .5s ease;
    }

    .sidebar.open .logo_details .icon,
    .sidebar.open .logo_details .logo_name {
        opacity: 1;
        margin: 10px;
    }

    .sidebar .logo_details #btn {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        font-size: 23px;
        text-align: center;
        cursor: pointer;
        transition: all .5s ease;
    }

    .sidebar.open .logo_details #btn {
        text-align: right;
    }

    .sidebar i {
        color: var(--color-white);
        height: 60px;
        line-height: 60px;
        min-width: 50px;
        font-size: 25px;
        text-align: center;
    }

    .sidebar .nav-list {
        margin-top: 20px;
        height: 100%;
    }

    .sidebar li {
        position: relative;
        margin: 8px 0;
        list-style: none;
    }

    .sidebar li .tooltip {
        position: absolute;
        top: -20px;
        left: calc(100% + 15px);
        z-index: 3;
        background-color: var(--color-white);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
        padding: 6px 14px;
        font-size: 15px;
        font-weight: 400;
        border-radius: 5px;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
    }

    .sidebar li:hover .tooltip {
        opacity: 1;
        pointer-events: auto;
        transition: all 0.4s ease;
        top: 50%;
        transform: translateY(-50%);
    }

    .sidebar.open li .tooltip {
        display: none;
    }

    .sidebar input {
        font-size: 15px;
        color: var(--color-white);
        font-weight: 400;
        outline: none;
        height: 35px;
        width: 35px;
        border: none;
        border-radius: 5px;
        background-color: var(--color-second);
        transition: all .5s ease;
    }

    .sidebar input::placeholder {
        color: var(--color-light)
    }

    .sidebar.open input {
        width: 100%;
        padding: 0 20px 0 50px;
    }

    .sidebar .bx-search {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        font-size: 22px;
        background-color: var(--color-second);
        color: var(--color-white);
    }

    .sidebar li a {
        display: flex;
        height: 100%;
        width: 100%;
        align-items: center;
        text-decoration: none;
        background-color: var(--color-default);
        position: relative;
        transition: all .5s ease;
        z-index: 12;
    }

    .sidebar li a::after {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        transform: scaleX(0);
        background-color: var(--color-white);
        border-radius: 5px;
        transition: transform 0.3s ease-in-out;
        transform-origin: left;
        z-index: -2;
    }

    .sidebar li a:hover::after {
        transform: scaleX(1);
        color: var(--color-default)
    }

    .sidebar li a .link_name {
        color: var(--color-white);
        font-size: 15px;
        font-weight: 400;
        white-space: nowrap;
        pointer-events: auto;
        transition: all 0.4s ease;
        pointer-events: none;
        opacity: 0;
    }

    .sidebar li a:hover .link_name,
    .sidebar li a:hover i {
        transition: all 0.5s ease;
        color: var(--color-default)
    }

    .sidebar.open li a .link_name {
        opacity: 1;
        pointer-events: auto;
    }

    .sidebar li i {
        height: 35px;
        padding-right: 30px;
        line-height: 35px;
        font-size: 18px;
        border-radius: 5px;
    }

    .sidebar li.profile {
        position: fixed;
        height: 60px;
        width: 78px;
        left: 0;
        bottom: -8px;
        padding: 10px 14px;
        overflow: hidden;
        transition: all .5s ease;
    }

    .sidebar.open li.profile {
        width: 250px;
    }

    .sidebar .profile .profile_details {
        display: flex;
        align-items: center;
        flex-wrap: nowrap;
    }

    .sidebar li img {
        height: 45px;
        width: 45px;
        object-fit: cover;
        border-radius: 50%;
        margin-right: 10px;
    }

    .sidebar li.profile .name,
    .sidebar li.profile .designation {
        font-size: 15px;
        font-weight: 400;
        color: var(--color-white);
        white-space: nowrap;
    }

    .sidebar li.profile .designation {
        font-size: 12px;
    }

    .sidebar .profile #log_out {
        position: absolute;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        background-color: var(--color-second);
        width: 100%;
        height: 60px;
        line-height: 60px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.5s ease;
    }

    .sidebar.open .profile #log_out {
        width: 50px;
        background: none;
    }

    .home-section {
        position: relative;
        background-color: var(--color-body);
        min-height: 100vh;
        top: 0;
        left: 78px;
        width: calc(100% - 78px);
        transition: all .5s ease;
        z-index: 2;
    }

    .home-section .text {
        display: inline-block;
        color: var(--color-default);
        font-size: 15px;
        font-weight: 500;
        margin: 18px;
    }

    .sidebar.open~.home-section {
        left: 250px;
        width: calc(100% - 250px);
    }




    /* From */

    .form button {
        border: none;
        background: none;
        color: #8b8ba7;
    }

    .from {
        display: flex;
        align-items: center;

    }

    .form {
        margin-left: 40px;
        --timing: 0.3s;
        --width-of-input: 200px;
        --height-of-input: 40px;
        --border-height: 2px;
        --input-bg: #fff;
        --border-color: #2f2ee9;
        --border-radius: 30px;
        --after-border-radius: 1px;
        position: relative;
        width: var(--width-of-input);
        height: var(--height-of-input);
        display: flex;
        align-items: center;
        padding-inline: 0.8em;
        border-radius: var(--border-radius);
        transition: border-radius 0.5s ease;
        background: var(--input-bg, #fff);
    }


    /* from Input */
    .input {
        font-size: 0.9rem;
        background-color: transparent;
        width: 100%;
        height: 100%;
        padding-inline: 0.5em;
        padding-block: 0.7em;
        border: none;
    }

    /* styling of animated border */
    .form:before {
        content: "";
        position: absolute;
        background: var(--border-color);
        transform: scaleX(0);
        transform-origin: center;
        width: 100%;
        height: var(--border-height);
        left: 0;
        bottom: 0;
        border-radius: 1px;
        transition: transform var(--timing) ease;
    }

    /* Hover on Input */
    .form:focus-within {
        border-radius: var(--after-border-radius);
    }



    input:focus {
        outline: none;
    }

    /* here is code of animated border */
    .form:focus-within:before {
        transform: scale(1);
    }

    /* styling of close button */
    /* == you can click the close button to remove text == */
    .reset {
        border: none;
        background: none;
        opacity: 0;
        visibility: hidden;
    }

    /* close button shown when typing */
    input:not(:placeholder-shown)~.reset {
        opacity: 1;
        visibility: visible;
    }

    /* sizing svg icons */
    .form svg {
        width: 17px;
        margin-top: 3px;
    }



    /* ปุ่มนำของเข้า */
    .cssbuttons-io {
        position: relative;
        font-family: inherit;
        font-weight: 500;
        font-size: 12px;
        letter-spacing: 0.05em;
        border-radius: 0.8em;
        cursor: pointer;
        border: none;
        background: linear-gradient(to right, #8e2de2, #4a00e0);
        color: rgb(0, 0, 0);
        overflow: hidden;
    }

    .cssbuttons-io svg {
        width: 1.2em;
        height: 1.2em;
        margin-right: 0.5em;
    }

    .cssbuttons-io span {
        position: relative;
        z-index: 10;
        transition: color 0.4s;
        display: inline-flex;
        align-items: center;
        padding: 0.8em 1.2em 0.8em 1.05em;
    }

    .cssbuttons-io::before,
    .cssbuttons-io::after {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
    }

    .cssbuttons-io::before {
        content: "";
        background: skyblue;
        width: 120%;
        left: -10%;
        transform: skew(30deg);
        transition: transform 0.4s cubic-bezier(0.3, 1, 0.8, 1);
    }

    .cssbuttons-io:hover::before {
        transform: translate3d(100%, 0, 0);
    }

    .cssbuttons-io:active {
        transform: scale(0.95);
    }



    /* input */
    .input-style {
        padding: 10px;
        border: 2px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        color: #555;
        outline: none;
    }

    .input-style:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }



    .fb {
        display: flex;
        flex-wrap: wrap;
        align-content: center;
        justify-content: center;
        align-items: center;
    }

    .modal-header {
        font-size: 10px;
        font-family: sans-serif;
        display: flex;
        align-items: center;
        gap: 50px;

    }

    .modal-backdrop.show {
        display: none;
    }

    .modal-body {
        max-height: 500px;
        /* กำหนดความสูงสูงสุดของตาราง */
        background: white;
        padding: 20px;
        border-radius: 10px;
    }




    .hi {
        display: flex;
        align-items: baseline;
        gap: 10px;
    }



    /* Export*/
    .button {
        position: relative;
        width: 150px;
        height: 40px;
        cursor: pointer;
        display: flex;
        align-items: center;
        border: 1px solid #17795E;
        background-color: #209978;
        overflow: hidden;
    }

    .button,
    .button__icon,
    .button__text {
        transition: all 0.3s;
    }

    .button .button__text {
        transform: translateX(22px);
        color: #fff;
        font-size: 9px;
        font-weight: 600;
    }

    .button .button__icon {
        position: absolute;
        transform: translateX(109px);
        height: 100%;
        width: 39px;
        background-color: #17795E;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .button .svg {
        width: 20px;
        fill: #fff;
    }

    .button:hover {
        background: #17795E;
    }

    .button:hover .button__text {
        color: transparent;
    }

    .button:hover .button__icon {
        width: 148px;
        transform: translateX(0);
    }

    .button:active .button__icon {
        background-color: #146c54;
    }

    .button:active {
        border: 1px solid #146c54;
    }


    .table>:not(caption)>*>* {
        text-align: center;
    }

    .table-wrapper {
        height: auto;
        /* กำหนดความสูงสูงสุดของตาราง */
        box-shadow: 0 2px 5px #8494a4;
        background: white;
        padding: 20px;
        border-radius: 10px;
    }

    /* ปรับการจัดตำแหน่งข้อความในตาราง */
    .table th,
    .table td {
        text-align: center;
    }

    .table-wrapper {
        max-height: 500px;
        box-shadow: 0 2px 5px #8494a4;
        background: white;
        padding: 20px;
        border-radius: 10px;
    }

    .table-container {
        display: flex;
        align-content: center;
        justify-content: center;
        align-items: baseline;
        font-family: sans-serif;
        width: 100%;
        height: 346px;
        overflow-y: auto;
        border: 1px solid #ccc;
    }

    .table thead th {
        position: sticky;
        /* ทำให้คงที่ */
        top: 0;
        /* ติดด้านบน */
        background-color: skyblue;
        /* กำหนดสีพื้นหลังของหัวตาราง */
        z-index: 2;
        /* ให้หัวคอลัมน์อยู่ด้านบนของเนื้อหา */
        text-align: center;
        padding: 10px;
        font-size: 11px;
    }


    .texeadd {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        gap: 1rem;
    }

    .mb-4 {
        font-size: 15px;
    }

    .mt-5 {
        margin-top: 1rem !important;
    }

    .table th {
        background-color: skyblue;
        /* กำหนดสีพื้นหลังของหัวตาราง */
        text-align: center;
        padding: 15px;
        font-size: 14px;
    }

    .table td {
        background-color: #ffffff33;
        padding: 0px;
        text-align: center;
    }



    .table thead {
        background-color: #55608f;
        /* สีพื้นหลังที่เหมาะสมสำหรับ thead */
    }
</style>

<body>

    <div class="sidebar ">
        <div class="logo_details">
            <div class="logo_name">GTN</div>
            <i class="bx bx-menu" id="btn"></i>
        </div>

        <ul class="nav-list">

            <li>
                <a href="/import">
                    <i class="fa-solid fa-warehouse"></i>
                    <span class="link_name">นำของเข้า</span>
                </a>
                <span class="tooltip">นำของเข้า</span>
            </li>


            <li>
                <a href="/withdraw">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                    <span class="link_name">เบิกของ</span>
                </a>
                <span class="tooltip">เบิกของ</span>
            </li>

            <li>
                <a href="/sum">
                    <i class="fa-solid fa-square-poll-vertical"></i>
                    <span class="link_name">วัสดุคงคลัง</span>
                </a>
                <span class="tooltip">วัสดุคงคลัง</span>
            </li>

            <li>
                <a href="/material">
                    <i class="fa-solid fa-cart-plus"></i>
                    <span class="link_name">รายการวัสดุ</span>
                </a>
                <span class="tooltip">รายการวัสดุ</span>
            </li>

            <li>
                <a href="/droppoint">
                    <i class="fa-solid fa-location-dot"></i>
                    <span class="link_name">สถานที่เก็บอุปกรณ์</span>
                </a>
                <span class="tooltip">สถานที่เก็บอุปกรณ์</span>
            </li>

            <li>
                <a href="/addrefcode">
                    <i class="fa-solid fa-file-code"></i>
                    <span class="link_name">Refcode</span>
                </a>
                <span class="tooltip">Refcode</span>
            </li>

        </ul>
    </div>

    <div class="container mt-4">
        <h2>Edit Data</h2>

        <!-- Form starts here -->
        <form action="/edit/save" method="POST">
            @csrf

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
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
                        <th scope="col">Import Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="font-size: 8px; text-align:center">
                        <td>
                            <input class="form-control" name="refcode" value="{{ $edit->refcode_import }}" readonly
                                style="font-size: 12px;">
                        </td>


                        <td>
                            <input class="form-control" name="Droppoint" value="{{ $edit->droppoint_import }}" readonly
                                style="font-size: 12px;">
                        </td>


                        <td><input type="text" class="form-control" name="material_code"
                                value="{{ $edit->material_code_import }}" readonly></td>
                        <td><input type="text" class="form-control" name="material_name"
                                value="{{ $edit->material_name_import }}" readonly></td>
                        <td><input type="text" class="form-control" name="spec_size_import"
                                value="{{ $edit->spec_size_import }}" readonly></td>
                        <td><input type="text" class="form-control" name="brand" value="{{ $edit->brand }}"
                                readonly></td>
                        <td><input type="text" class="form-control" name="unit" value="{{ $edit->unit }}"
                                readonly></td>

                        <td>
                            <input type="hidden" name="quantity" id="quantityHidden"
                                value="-{{ abs($edit->quantity) }}">
                            <!-- ซ่อนค่าเดิม -->

                            <input type="number" class="form-control" name="quantity_with" id="quantityInput"
                                value="-{{ abs($edit->quantity) }}" required oninput="forceNegativeValue(this)">
                        </td>

                        <td><input type="text" class="form-control" name="remark" value="{{ $edit->remark }}"
                                required></td>
                        <td><input type="text" class="form-control" name="date" value="{{ $edit->date }}"
                                readonly></td>
                        <td><input type="text" class="form-control" name="transaction"
                                value="{{ $edit->transaction }}" readonly></td>
                        <td><input type="text" class="form-control" name="import_quantity"
                                value="{{ $edit->import_quantity }}" readonly></td>
                    </tr>

                </tbody>
            </table>

            <!-- Submit Button -->

            <button type="submit" class="btn btn-success">Edit</button>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    function forceNegativeValue(input) {
        // ตรวจสอบว่าค่าปัจจุบันมี "-" หรือไม่
        if (input.value && !input.value.startsWith("-")) {
            input.value = "-" + input.value;
        }

        const quantityHidden = document.getElementById("quantityHidden").value; // ค่าเดิม
        const quantityInput = document.getElementById("quantityInput"); // ช่องกรอกใหม่

        if (parseFloat(quantityInput.value) < parseFloat(quantityHidden)) {
            alert("ค่าที่กรอกห้ามเกินค่าเดิม!");
            quantityInput.value = quantityHidden; // รีเซ็ตค่าให้กลับเป็นค่าเดิม
        }
    }
</script>


<script>
    window.onload = function() {
        const sidebar = document.querySelector(".sidebar");
        const closeBtn = document.querySelector("#btn");

        closeBtn.addEventListener("click", function() {
            sidebar.classList.toggle("open");
        });
    }
</script>

<!-- ซ่อน ประวัติการนำเข้า -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.sidebar'); // เลือก sidebar
        const showDataModal = document.getElementById('showDataModal'); // เลือก showDataModal

        // ซ่อน sidebar เมื่อ showDataModal เปิด
        showDataModal.addEventListener('show.bs.modal', function() {
            if (sidebar) {
                sidebar.classList.add('d-none'); // เพิ่มคลาสซ่อน
            }
        });

        // แสดง sidebar เมื่อ showDataModal ปิด
        showDataModal.addEventListener('hidden.bs.modal', function() {
            if (sidebar) {
                sidebar.classList.remove('d-none'); // เอาคลาสซ่อนออก
            }
        });
    });
</script>

</html>
