"use strict"

$(document).ready(function () {
    $(window).initKeyboard();
    $('.select2').select2();
    //Todo::there are some code to hide alertClose
    setTimeout(alertClose, 3000);
});

//store the product  id for increment or decrement
var ids = [];

//there are the shortcut key
$(window).on('Shift+D', function () {
    //discount field
    $('#discount').on('focus');
}).on('Shift+Z', function () {
    //category field

    $('.category').on('focus');
    $('.category').select2('open');
}).on('Shift+B', function () {
    //brand field
    $('.brand').on('focus');
    $('.brand').select2('open');
}).on('Shift+Q', function () {
    //Quotation Field
    $('#quotation').on('focus');
    $('#quotation').on('click');
}).on('Shift+W', function () {
    //Customer Dropdown field
    $('#customer').select2('open');

}).on('Shift+A', function () {
    //create new Customer
    $('.customer').on('focus');
    $('.customer').on('click');
}).on('Shift+C', function () {
    //cancel the customer modal
    $('#customer').select2('close');
    $('#product').select2('close');
    $('.brand').select2('close');
    $('.category').select2('close');
    $('.close').on('focus');
    $('.close').on('click');
}).on('Shift+S', function () {
    //submit the form
    $('.save').on('focus');
    $('.save').on('click');
}).on('Shift+R', function () {
    //product dropdown
    $('#product').select2('open')
}).on('F2', function () {
    //goto quantity field
    $('#proQuantity-' + ids[0]).on('focus');
});

//show the modal
function forModal(url, message) {
    $('#show-modal').modal('show');
    $('#title').text(message);
    $('#show-form').load(url);
}

//this is for hide alert
function alertClose() {
    $("#gone").alert('close');
}

//category by products show
function categoryByProduct() {
    var categoryId = $('#category :selected').val();
    var brandId = $('#brand :selected').val();
    var param = {};
    param['categoryId'] = categoryId;
    param['brandId'] = brandId;
    $.ajax({
        url: "product",
        method: 'get',
        data: param,
        success: function (data) {
            var html = "";
            $.each(data, function (index, value) {
                html += '<tr onclick="productAdd(' + value.id + ')" class="pointer">\n' +
                    '                                        <td class="text-capitalize font-weight-bold">' + value.name + '</td>\n' +
                    '                                        <td>' + value.warehouse + ' <br>' + value.quantity + ' </td>\n' +
                    '                                        <td>' + value.price + '</td>\n' +
                    '                                    </tr>';
            });
            $('#products').empty();
            $('#products').append(html);
        }
    });
}

//click the product from product gallery
function productAdd(id) {
    forSearchPur(id);
}

var audio = document.getElementById('chatAudio');

function play() {
    audio.play()
}


/*submit the pos form*/
$('.save').on('click', function () {
    $('#posForm').submit();
});

function forSearchBarcode() {
    var flus = false;

    // proId = $('.dataBarcode :selected').val();
    var proId = $('.dataBarcode').val();


    console.log(proId);
    // alert(proId);
if (proId != ''){
    $.ajax({
        url: "single/product/barcode/" + proId,
        method: 'get',
        success: function (data) {
            console.log(data);
            //check if product have stock
            if (data.product_stock == null) {
                $.notify("Stock Out", "warning");
                $('.dataBarcode').val('');
                $('.dataBarcode').focus();
            } else {
                //check if id have in array product quantity price  is ++
                var index = ids.indexOf(data.id);
                flus = index != -1 ? true : false;
                $(".data option:selected").removeAttr("selected");
                if (flus) {
                    var q = $("#proQuantity-" + data.id).val();
                    $("#proQuantity-" + data.id).val(parseInt(q) + 1);
                    proMultiPur(data.id);
                } else {
                    var html = '<tr id="pro-' + data.id + '">\n' +
                        '                                            <td style="min-width: 100px"><p id="proName" class="text-primary">' + data.name + '</p><input type="hidden" name="proId[]" value="' + data.id + '"><input type="hidden" name="warehouse_id[]" value="' + data.product_stock.warehouse_id + '"></td>\n' +
                        '                                            <td style="min-width: 100px"><input id="proQuantity-' + data.id + '" class="form-control" type="number" min="1" max="' + data.product_stock.quantity + '" onchange="proMultiPur(' + data.id + ')" id="proQuantity-' + data.id + '" name="proQuantity[]" value="1"></td>\n' +
                        '                                            <td style="min-width: 100px">\n' +
                        '                                                <input name="unit_price[]" onchange="proMultiPur(' + data.id + ')" type="number" step="0.01" class="form-control" id="proUnitPrice-' + data.id + '" value="' + data.price + '">\n' +
                        '                                            </td>\n' +
                        '                                            <td style="min-width: 100px">\n' +
                        '                                                <div class="form-control"> <span id="proSubPrice-' + data.id + '">' + data.price + '</span></div>\n' +
                        '                                            </td>\n' +
                        '                                            <td>\n' +
                        '                                                <a  onclick="removeProductPur(' + data.id + ')" class="kt-nav__link pointer">\n' +
                        '                                                    <i class="kt-nav__link-icon flaticon-delete danger"></i>\n' +
                        '                                                </a>\n' +
                        '\n' +
                        '                                            </td>\n' +
                        '                                        </tr>';
                    $("#productTable").append(html);
                    ids.push(data.id);
                }
                totalPur();
            }
        }
    })
}
    $('.dataBarcode').val('');
    $('.dataBarcode').focus();
}

//get the product
function forSearchPur(id = 0) {

    var flus = false;
    var proId = id;
    if (proId == 0) {
        proId = $('.data :selected').val();
    }
    $.ajax({
        url: "single/product/" + proId,
        method: 'get',
        success: function (data) {
            //check if product have stock
            if (data.product_stock == null) {
                alert("Stock Out");
            } else {
                //check if id have in array product quantity price  is ++
                var index = ids.indexOf(data.id);
                flus = index != -1 ? true : false;
                $(".data option:selected").removeAttr("selected");
                if (flus) {
                    var q = $("#proQuantity-" + data.id).val();
                    $("#proQuantity-" + data.id).val(parseInt(q) + 1);
                    proMultiPur(data.id);
                } else {
                    var html = '<tr id="pro-' + data.id + '">\n' +
                        '                                            <td style="min-width: 100px"><p id="proName" class="text-primary">' + data.name + '</p><input type="hidden" name="proId[]" value="' + data.id + '"><input type="hidden" name="warehouse_id[]" value="' + data.product_stock.warehouse_id + '"></td>\n' +
                        '                                            <td style="min-width: 100px"><input id="proQuantity-' + data.id + '" class="form-control" type="number" min="1" max="' + data.product_stock.quantity + '" onchange="proMultiPur(' + data.id + ')" id="proQuantity-' + data.id + '" name="proQuantity[]" value="1"></td>\n' +
                        '                                            <td style="min-width: 100px">\n' +
                        '                                                <input name="unit_price[]" onchange="proMultiPur(' + data.id + ')" type="number" step="0.01" class="form-control" id="proUnitPrice-' + data.id + '" value="' + data.price + '">\n' +
                        '                                            </td>\n' +
                        '                                            <td style="min-width: 100px">\n' +
                        '                                                <div class="form-control"> <span id="proSubPrice-' + data.id + '">' + data.price + '</span></div>\n' +
                        '                                            </td>\n' +
                        '                                            <td>\n' +
                        '                                                <a  onclick="removeProductPur(' + data.id + ')" class="kt-nav__link pointer">\n' +
                        '                                                    <i class="kt-nav__link-icon flaticon-delete danger"></i>\n' +
                        '                                                </a>\n' +
                        '\n' +
                        '                                            </td>\n' +
                        '                                        </tr>';
                    $("#productTable").append(html);
                    ids.push(data.id);
                }
                totalPur();
            }
        }
    })

}

//remove the product
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

//multiply the product
function proMultiPur(id) {
    var quantity = $("#proQuantity-" + id).val();
    var price = $("#proUnitPrice-" + id).val();
    var subPrice = quantity * price;
    $("#proSubPrice-" + id).text(subPrice);
    totalPur();
}

//total product price
function totalPur() {
    var total = 0;
    var item = 0;
    // debugger
    $.each(ids, function (index, value) {
        var subPrice = parseFloat($("#proSubPrice-" + value).text());
        total = total + subPrice;
        var quantity = $("#proQuantity-" + value).val();
        item = item + parseInt(quantity);
    });
    $("#totalPrice").text(parseFloat(total));
    $("#total").text(parseInt(item));
    play();
}
