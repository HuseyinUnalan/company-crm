@extends('frontend.main_master')
@section('content')

@section('site_title')
    Teklif Hazırla
@endsection

@section('meta_keywords')
    {{ $settings->site_keywords }}
@endsection

@section('meta_description')
    {{ $settings->site_description }}
@endsection

<style>
    .modal-backdrop {
        z-index: -1;
    }
</style>

<!-- Start main-content -->
<section class="page-title"
    style="background-image: url({{ asset('frontend/assets/images/background/page-title.jpg') }});">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">Teklif Hazırla</h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('/') }}">Anasayfa</a></li>
                <li>Teklif Hazırla</li>
            </ul>
        </div>
    </div>
</section>
<!-- end main-content -->

<form id="regForm" action="{{ route('store.calculate') }}" method="POST">
    @csrf
    <!-- One "tab" for each step in the form: -->
    <div class="tab">
        <div class="row mb-3">
            <label for="example-text-input" class="col-sm-2 col-form-label">Müşteri Seçin </label>
            <div class="col-sm-12">
                <select class="form-control" name="customer_id" type="text" required>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>
    <div class="tab">
        <div class="row mb-3">
            <label for="example-text-input" class="col-sm-2 col-form-label">Teslimat Tarihi </label>
            <div class="col-sm-12">
                <input type="date" class="form-control" name="delivery_date" required>

            </div>
        </div>
    </div>
    <div class="tab">

        <div class="row mb-3">
            <label for="example-text-input" class="col-sm-12 col-form-label">Teklif Opsiyonu </label>
            <div class="col-sm-12">
                <input type="text" class="form-control" name="bid_option" required>

            </div>
        </div>
    </div>
    <div class="tab">
        <div class="row mb-3">
            <label for="example-text-input" class="col-sm-12 col-form-label">Ödeme Koşulları </label>
            <div class="col-sm-12">
                <input type="text" class="form-control" name="terms_of_payment" required>

            </div>
        </div>
    </div>

    <div class="tab">
        <div class="col-md-12">
            <div class="classic-card my-2 bg-white">

                <div class="classic-card-body p-3">
                    <div class="d-flex my-2 d-flex flex-column">
                        <div class="select-box mt-2 w-100">
                            <!-- Ürünlerin listelendiği foreach döngüsü -->
                            <div class="options-container">
                                <!-- Ürünlerin listelendiği foreach döngüsü -->

                                @foreach ($products as $product)
                                    <div class="option">
                                        <input type="radio" class="radio" id="product{{ $product->id }}"
                                            value="{{ $product->name }}" name="product_id" />
                                        <label for="product{{ $product->id }}">{{ $product->name }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="selected" style="min-height: 40px;">
                                Ürün Seçin
                            </div>

                            <div class="search-box">
                                <input type="search" placeholder="Ürün Ara..." />
                            </div>


                            <!-- Modal -->
                            <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="background-color: #fff;">
                                        <div class="modal-header">

                                            <input id="productName" class="form-control col-md-12" disabled
                                                style="border: none; background-color: #FFF;">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-5">

                                            <input type="hidden" class="classic-input" name="product_id"
                                                id="productId" />



                                            <div class="container">

                                                <div class="form-wrap">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label id="name-label" for="name">Miktar

                                                                </label>
                                                                <input type="number" placeholder="Miktar"
                                                                    class="form-control" id="quantityInput">
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label id="email-label" for="">Birim
                                                                    Fiyat</label>
                                                                <input type="number" class="form-control"
                                                                    id="priceInput" placeholder="Fiyat">

                                                            </div>
                                                        </div>

                                                        <input type="hidden" id="type">

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label id="email-label" for="">KDV</label>
                                                                <input type="number" class="form-control"
                                                                    id="kdvSelect" disabled>

                                                            </div>
                                                        </div>


                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label id="email-label"
                                                                    for="">Yükseklik</label>
                                                                <input type="number" class="form-control"
                                                                    id="heightSelect" disabled>

                                                            </div>
                                                        </div>



                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label id="email-label" for="">Birim
                                                                    Ağırlık</label>
                                                                <input type="number" class="form-control"
                                                                    id="weightSelect" disabled>

                                                            </div>
                                                        </div>



                                                        {{-- <input type="hidden" id="productWithholding"> --}}

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label id="email-label" for="">Tevkifat
                                                                    Durumu</label>
                                                                <select name="" id="productWithholding"
                                                                    class="form-control" required>
                                                                    <option value="1">Var</option>
                                                                    <option value="2">Yok</option>
                                                                </select>
                                                            </div>
                                                        </div>



                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                {{-- <label id="email-label"
                                                                    for="">İndirim</label> --}}
                                                                <input type="hidden" class="form-control"
                                                                    id="discountInput" value="0">

                                                            </div>
                                                        </div>


                                                    </div>


                                                </div>
                                            </div>

                                            <div class="modal-footer mt-3">
                                                <button type="button" class="btn btn-warning classic-button"
                                                    data-bs-dismiss="modal">Vazgeç</button>
                                                <button type="button" id="saveButton"
                                                    class="classic-button btn btn-success">Devam
                                                    Et</button>
                                            </div>



                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>


                        <!-- jQuery -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



                        <!-- JavaScript Kodu -->
                        <script>
                            $(document).ready(function() {

                                var salesData = []; // Ürün satış verilerini tutacak dizi

                                function calculateTotalPrice() {
                                    var totalPrice = 0;
                                    for (var i = 0; i < salesData.length; i++) {
                                        totalPrice += parseFloat(salesData[i].total);
                                    }
                                    return totalPrice.toFixed(2);
                                }



                                // Kaydet butonuna tıklandığında
                                $('#saveButton').on('click', function() {
                                    // Formdaki verileri al
                                    var productName = $('#productName').val();
                                    var productId = $('#productId').val();
                                    var productWithholding = $('#productWithholding').val();
                                    var height = $('#heightSelect').val();
                                    var quantity_weight = $('#weightSelect').val();
                                    var quantity = parseFloat($('#quantityInput').val());
                                    var customerId = $('#customerSelect').val();
                                    var kdv = parseFloat($('#kdvSelect').val());
                                    var unit_price = parseFloat($('#priceInput').val());
                                    var sales_unit = $('#salesunitInput').val();
                                    var discount = parseFloat($('#discountInput').val());
                                    var type = parseFloat($('#type').val());


                                    // Tip değerine göre farklı hesaplamalar yapın


                                    // Tutar hesapla
                                    var total_weight = height * quantity_weight * quantity;
                                    // var amount = total_weight * unit_price;
                                    if (type === 1) {
                                        var amount = quantity * unit_price;
                                        total = amount.toFixed(2);
                                    } else if (type === 2) {
                                        var total_weight = height * quantity_weight * quantity;
                                        var amount = total_weight * unit_price;
                                        total = amount.toFixed(2);
                                    } else if (type === 3) {
                                        var amount = height * quantity * unit_price;
                                        total = amount.toFixed(2);
                                    } else if (type === 4) {
                                        var amount = unit_price;
                                        total = amount.toFixed(2);
                                    }
                                    var netAmount = amount * (1 - (discount / 100));
                                    var kdvAmount = netAmount * (kdv / 100);
                                    var total = netAmount;
                                    var total_with_kdv = netAmount + kdvAmount;

                                    // Tabloya verileri ekle
                                    var newRow = '<tr>' +
                                        '<td>' + productName + '</td>' +
                                        '<td>' + height + ' mt' + '</td>' +
                                        '<td>' + quantity + '</td>' +
                                        '<td>' + quantity_weight + '</td>' +
                                        '<td>' + total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' TL' + '</td>' +
                                        '<td>' + total_weight.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</td>' +
                                        // '<td>' + kdvAmount.toFixed(2) + '</td>' +
                                        '</tr>';

                                    $('#salesTable tbody').append(newRow);

                                    // Ürün satış verilerini bir nesne olarak oluştur ve diziye ekle
                                    var saleData = {
                                        productId: productId,
                                        withholding_status: productWithholding,
                                        productName: productName,
                                        quantity: quantity,
                                        height: height,
                                        quantity_weight: quantity_weight,
                                        customerId: customerId,
                                        kdv: kdv,
                                        unit_price: unit_price,
                                        discount: discount,
                                        amount: amount.toFixed(2),
                                        netAmount: netAmount.toFixed(2),
                                        total: total.toFixed(2),
                                        total_weight: total_weight.toFixed(2),
                                        type: type,

                                    };

                                    salesData.push(saleData); // Ürün satış verilerini diziye ekle

                                    // Gizli (hidden) input alanlarına JSON olarak dizi içindeki verileri ekle
                                    $('#hiddenSalesData').val(JSON.stringify(salesData));

                                    function updateTotalPrice() {
                                        var totalPrice = calculateTotalPrice();
                                        $('#totalPriceDiv').text('Toplam Fiyat: ' + totalPrice + ' TL');
                                        $('#totalPriceInput').val(totalPrice);
                                        $('#totalPriceInputTwo').val(totalPrice);
                                        $('#totalPriceInputThree').val(totalPrice);

                                    }
                                    // Toplam fiyatı hesapla ve göster
                                    updateTotalPrice();

                                    // Ürünlerin toplam fiyatını hesapla ve tfoot alanına yazdır
                                    var totalSalesPrice = calculateTotalPrice();
                                    $('#totalPriceFooter').text(totalSalesPrice);


                                });

                                // Ürünlerin üzerine tıklandığında
                                $('.radio').on('click', function() {
                                    var productName = $(this).val();
                                    var productId = $(this).attr('id').substring(7); // "product" kısmını çıkararak id'yi al

                                    // Ürün bilgilerini çek ve fiyatı güncelle
                                    $.ajax({
                                        url: '/get-product-details/' + productId,
                                        type: 'GET',
                                        dataType: 'json',
                                        success: function(data) {
                                            $('#productName').val(productName);
                                            $('#productId').val(productId);
                                            $('#priceInput').val(data.unit_price);
                                            $('#quantityInput').val(data.quantity);
                                            $('#productWithholding').val(data.withholding_status);
                                            $('#kdvSelect').val(data.kdv);
                                            $('#weightSelect').val(data.quantity_weight);
                                            $('#heightSelect').val(data.height);
                                            $('#type').val(data.type);




                                        },
                                        error: function() {
                                            alert('Ürün detayları çekilirken bir hata oluştu.');
                                        }
                                    });

                                    // Modalı aç
                                    $('#productModal').modal('show');

                                });


                            });
                        </script>




                    </div>
                </div>
            </div>

            <!-- Tablo -->
            <table class="table" id="salesTable">
                <thead>
                    <tr>
                        <th style="width:20%">Ürün </th>
                        <th style="width:20%">Boy</th>
                        <th style="width:20%"> Adet</th>
                        <th style="width:20%">Birim Ağırlık</th>
                        <th style="width:20%">Toplam Fiyat</th>
                        <th style="width:20%">Toplam Ağırlık</th>
                        {{-- <th style="width:20%">Toplam Fiyat</th> --}}

                    </tr>
                </thead>
                <tbody>
                    <!-- Tablo Satırları Buraya Eklenecek -->
                </tbody>

            </table>

        </div>

        <!-- Gizli (Hidden) Input Alanları -->
        <input type="hidden" name="sales_data" id="hiddenSalesData" />


    </div>



    <div style="overflow:auto;">
        <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Geri</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">İleri</button>
        </div>
    </div>
    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
</form>





<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Kaydet";
        } else {
            document.getElementById("nextBtn").innerHTML = "İleri";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n);
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // Check if it's a date input
                if (y[i].type === "date") {
                    y[i].className += " invalid";
                    valid = false;
                } else if (y[i].type === "text") {
                    y[i].className += " invalid";
                    valid = false;
                }
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }


    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
</script>


<!-- End Page-content -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    const selected = document.querySelector(".selected");
    const optionsContainer = document.querySelector(".options-container");
    const searchBox = document.querySelector(".search-box input");

    const optionsList = document.querySelectorAll(".option");

    selected.addEventListener("click", () => {
        optionsContainer.classList.toggle("active");

        searchBox.value = "";
        filterList("");

        if (optionsContainer.classList.contains("active")) {
            searchBox.focus();
        }
    });

    optionsList.forEach(o => {
        o.addEventListener("click", () => {
            if (!o.classList.contains("option-header")) {
                selected.innerHTML = o.querySelector("label").innerHTML;
                optionsContainer.classList.remove("active");
            }
        });


    });

    searchBox.addEventListener("keyup", function(e) {
        filterList(e.target.value);
    });

    const filterList = searchTerm => {
        searchTerm = searchTerm.toLowerCase();
        optionsList.forEach(option => {
            let label = option.firstElementChild.nextElementSibling.innerText.toLowerCase();
            if (label.indexOf(searchTerm) != -1) {
                option.style.display = "block";
            } else {
                option.style.display = "none";
            }
        });
    };
</script>
@endsection
