"use strict";

$(document).ready(function () {
    
  
    
    $('#dtHorizontalExample').DataTable({
        "scrollX": true
        });
        $('.dataTables_length').addClass('bs-select');
      
   
    //there are some code to hide alertClose
    setTimeout(alertClose, 3000);
    taxType();
    //datatable with export excel,csv,pdf,copy
    $('.report').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    //report datatable
    $('.report2').DataTable();

//this function for show dropdown image
    $('.select').select2();
    $(".lang").select2({
        templateResult: formatState,
        templateSelection: formatState
    });

//this function for show dropdown image
    function formatState(opt) {
        if (!opt.id) {
            return opt.text.toUpperCase();
        }
        var optimage = $(opt.element).attr('data-image');
        if (!optimage) {
            return opt.text.toUpperCase();
        } else {
            var $opt = $(
                '<span><img src="' + optimage + '" width="32px" height="auto"/> ' + opt.text.toUpperCase() + '</span>'
            );
            return $opt;
        }
    }

});


//translate in one click
function copy() {
    $('#tranlation-table > tbody  > tr').each(function (index, tr) {
        $(tr).find('.value').val($(tr).find('.key').text());
    });
}


//this is for hide alert
function alertClose() {
    $("#gone").alert('close');
}

//checked all in group create pages
function markAll() {
    $('input:checkbox').prop('checked', this.checked);
}


//show the modal
function forModal(url, message) {
    $('#show-modal').modal('show');
    $('#title').text(message);
    $('#show-form').load(url);
    $('body').on('shown.bs.modal', '.modal', function () {
        $(this).find('select').each(function () {
            var dropdownParent = $(document.body);
            if ($(this).parents('.modal.in:first').length !== 0)
                dropdownParent = $(this).parents('.modal.in:first');
            $(this).select2({
                dropdownParent: dropdownParent
            });
        });
    });
}
//Hide Show Status Update 
function status() {
    console.log('ok');
    
}

//tax input field show
function taxType() {
    var tax = $('#tax-type :selected').val();
    if (tax === 'Exclusive') {
        $('#taxs').removeClass('invisible').addClass('visible');
        $('select[name=tax_id]').prop('required', true);
    } else {
        $('#taxs').removeClass('visible').addClass('invisible');
        $('select[name=tax_id]').prop('required', false);
    }

}


//todo::Start Stock Manage
var ids = [];

//get from ware house product data
function optionList() {
    var id = $('.fromW :selected').val();
    $.ajax({
        url: "optionList/" + id,
        method: 'get',
        success: function (data) {
            //console.log(data);
            var html = "<option value=''></option>";
            $.each(data, function (index, value) {
                if (value.product != null) {
                    html += "<option value=" + value.id + ">" + value.product.name + " " + (value.product.code) + "</option>"
                }
            });
            $('.data').append(html);
        }
    })
}

//Search product for stock and select
function forSearch() {
    var proId = $('.data :selected').val();

    $.ajax({
        url: "single/product/" + proId ?? 0,
        method: 'get',
        success: function (data) {
            ids.push(data.id);
            $('.data option:selected').remove();
            var html = '<tr id="pro-' + data.id + '">\n' +
                '                                            <td><p id="proName" class="text-primary">' + data.product.name + '</p><input type="hidden" name="proId[]" value="' + data.id + '"></td>\n' +
                '                                            <td><input class="form-control" value="1" type="number" max="' + data.quantity + '" min="0" onchange="proMulti(' + data.id + ')" id="proQuantity-' + data.id + '" name="proQuantity[]"></td>\n' +
                '                                            <td>\n' +
                '                                                <input type="number" class="form-control" readonly id="proUnitPrice-' + data.id + '"  value="' + data.product.price + '">\n' +
                '                                            </td>\n' +
                '                                            <td>\n' +
                '                                                <input type="number" class="form-control" readonly id="proSubPrice-' + data.id + '"  value="' + data.product.price + '">\n' +
                '                                            </td>\n' +
                '                                            <td>\n' +
                '                                                <a  onclick="removeProduct(' + data.id + ')" class="kt-nav__link">\n' +
                '                                                    <i class="kt-nav__link-icon flaticon-delete danger"></i>\n' +
                '                                                </a>\n' +
                '\n' +
                '                                            </td>\n' +
                '                                        </tr>';
            $("#productTable").append(html);
            total();
        }
    })
}

/*stock adjustment*/
function forStockAdjustment() {
    var proId = $('.data :selected').val();

    $.ajax({
        url: "single/product/" + proId ?? 0,
        method: 'get',
        success: function (data) {
            console.log(data)
            $('.data option:selected').remove();
            var html = '<tr id="pro-' + data.id + '">\n' +
                '   <td><p id="proName" class="text-primary">' + data.name + '</p><input type="hidden" name="proId[]" value="' + data.id + '"></td>\n' +
                '   <td><input class="form-control" value="1" type="number"  id="proQuantity-' + data.id + '" name="proQuantity[]"></td>\n' +
                '   <td>\n' +
                '   <input type="number" class="form-control" readonly id="proUnitPrice-' + data.id + '"  value="' + data.price + '">\n' +
                '   </td>\n' +
                '   <td>\n' +
                '    <input type="number" class="form-control" readonly id="proSubPrice-' + data.id + '"  value="' + data.price + '">\n' +
                '    </td>\n' +
                '     <td>\n' +
                '    <a  onclick="removeProduct(' + data.id + ')" class="kt-nav__link">\n' +
                '     <i class="kt-nav__link-icon flaticon-delete danger"></i>\n' +
                '    </a>\n' +
                '\n' +
                '  </td>\n' +
                '  </tr>';
            $("#productTable").append(html);
            total();
        }
    })
}

//removeProduct form  the stock
function removeProduct(id) {
    $("#pro-" + id).remove();
    var index = ids.indexOf(id);
    ids.splice(index, 1);
    //add option
    $.ajax({
        url: "single/product/" + id,
        method: 'get',
        success: function (data) {
            $('.data').append("<option value=" + data.id + ">" + data.product.name + " " + (data.product.code) + "</option>");
        }

    });
    total();
}

//multiply the quantity or price on the stock
function proMulti(id) {
    var quantity = $("#proQuantity-" + id).val();
    var price = $("#proUnitPrice-" + id).val();
    var subPrice = quantity * price;
    $("#proSubPrice-" + id).val(subPrice);
    total();
}

//calculate the total price for the stock product
function total() {
    var total = 0;
    $.each(ids, function (index, value) {
        var subPrice = parseFloat($("#proSubPrice-" + value).val());
        total = total + subPrice;
    });
    $("#totalPrice").text(parseFloat(total));
}

//end the Stock manage


//Start Quotation
var ids = [];

//get product for the Quotation
function forSearchQuo() {
    var proId = $('.data :selected').val();
    $.ajax({
        url: "single/product/" + proId,
        method: 'get',
        success: function (data) {
            ids.push(data.id);
            $('.data option:selected').remove();
            var html = '<tr id="pro-' + data.id + '">\n' +
                '                                            <td><p id="proName" class="text-primary">' + data.name + '</p><input type="hidden" name="proId[]" value="' + data.id + '"></td>\n' +
                '                                            <td><input class="form-control" type="number" min="0" onchange="proMultiQuo(' + data.id + ')" id="proQuantity-' + data.id + '" name="proQuantity[]" value="1"></td>\n' +
                '                                            <td>\n' +
                '                                                <input type="number" class="form-control" readonly id="proUnitPrice-' + data.id + '"  value="' + data.price + '">\n' +
                '                                            </td>\n' +
                '                                            <td>\n' +
                '                                                <input type="number" class="form-control" readonly id="proSubPrice-' + data.id + '"  value="' + data.price + '">\n' +
                '                                            </td>\n' +
                '                                            <td>\n' +
                '                                                <a  onclick="removeProductQuo(' + data.id + ')" class="kt-nav__link">\n' +
                '                                                    <i class="kt-nav__link-icon flaticon-delete danger"></i>\n' +
                '                                                </a>\n' +
                '\n' +
                '                                            </td>\n' +
                '                                        </tr>';
            $("#productTable").append(html);
            totalQuo();
        }
    })
}

//removeProduct in Quotation
function removeProductQuo(id) {
    $("#pro-" + id).remove();
    var index = ids.indexOf(id);
    ids.splice(index, 1);
    //add option
    $.ajax({
        url: "single/product/" + id,
        method: 'get',
        success: function (data) {
            $('.data').append("<option value=" + data.id + ">" + data.name + "" + (data.code) + "</option>");
        }

    });
    totalQuo();
}

//multiply the quantity or price on the Quotation
function proMultiQuo(id) {
    var quantity = $("#proQuantity-" + id).val();
    var price = $("#proUnitPrice-" + id).val();
    var subPrice = quantity * price;
    $("#proSubPrice-" + id).val(subPrice);
    totalQuo();
}

//total price calculate on the Quotation
function totalQuo() {
    var total = 0;
    $.each(ids, function (index, value) {
        var subPrice = parseFloat($("#proSubPrice-" + value).val());
        total = total + subPrice;
    });
    $("#totalPrice").text(parseFloat(total));
}

//end the quotation


//start the purchase
var ids = [];

//get product information  purchase functionality
function forSearchPur() {
    var proId = $('.data :selected').val();
    $.ajax({
        url: "single/product/" + proId,
        method: 'get',
        success: function (data) {
            ids.push(data.id);
            $('.data option:selected').remove();
            var html = '<tr id="pro-' + data.id + '">\n' +
                '                                            <td><p id="proName" class="text-primary">' + data.name + '</p><input type="hidden" name="proId[]" value="' + data.id + '"></td>\n' +
                '                                            <td><input class="form-control" type="number" min="0" onchange="proMultiPur(' + data.id + ')" id="proQuantity-' + data.id + '" name="proQuantity[]" value="1"></td>\n' +
                '                                            <td>\n' +
                '                                                <input type="number" class="form-control" readonly id="proUnitPrice-' + data.id + '"  value="' + data.cost + '">\n' +
                '                                            </td>\n' +
                '                                            <td>\n' +
                '                                                <input type="number" class="form-control" readonly id="proSubPrice-' + data.id + '"  value="' + data.cost + '">\n' +
                '                                            </td>\n' +
                '                                            <td>\n' +
                '                                                <a  onclick="removeProductPur(' + data.id + ')" class="kt-nav__link">\n' +
                '                                                    <i class="kt-nav__link-icon flaticon-delete danger"></i>\n' +
                '                                                </a>\n' +
                '\n' +
                '                                            </td>\n' +
                '                                        </tr>';
            $("#productTable").append(html);
            totalPur();
        }
    })
}

//removeProduct from purchase product list
function removeProductPur(id) {
    $("#pro-" + id).remove();
    var index = ids.indexOf(id);
    ids.splice(index, 1);
    //add option
    $.ajax({
        url: "single/product/" + id,
        method: 'get',
        success: function (data) {
            $('.data').append("<option value=" + data.id + ">" + data.name + "" + (data.code) + "</option>");
        }

    });
    totalPur();
}

//multiply the quantity or price on the purchase product
function proMultiPur(id) {
    var quantity = $("#proQuantity-" + id).val();
    var price = $("#proUnitPrice-" + id).val();
    var subPrice = quantity * price;
    $("#proSubPrice-" + id).val(subPrice);
    totalPur();
}

//calculate the total price on the purchase
function totalPur() {
    var total = 0;
    $.each(ids, function (index, value) {
        var subPrice = parseFloat($("#proSubPrice-" + value).val());
        total = total + subPrice;
    });
    $("#totalPrice").text(parseFloat(total));
}

//end the purchase

var KTAppOptions = {
    "colors": {
        "state": {
            "brand": "#5d78ff",
            "light": "#ffffff",
            "dark": "#282a3c",
            "primary": "#5867dd",
            "success": "#34bfa3",
            "info": "#36a3f7",
            "warning": "#ffb822",
            "danger": "#fd3995"
        },
        "base": {
            "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
            "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
        }
    }
};


/*print all selected barcode*/
function printBarcode(){
    $('#barcode-form').submit();
}



