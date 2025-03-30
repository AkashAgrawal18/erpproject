<script>
    $(document).ready(function(e) {

        $(document).on('change', '#m_entity_mobile', function() {
            let custid = $("#cust_datalist option[value='" + $(this).val() + "']").attr('data-custid')
            let custname = $("#cust_datalist option[value='" + $(this).val() + "']").attr('data-custname')
            let custtype = $("#cust_datalist option[value='" + $(this).val() + "']").attr('data-custtype')
            let custmobile = $(this).val();

            $('#m_entity_type').val(custtype);
            $('#m_inv_entity').val(custid);
            $('#m_entity_name').val(custname);

        });


        $("#m_inv_store").change(function() {
            var selectedWrh = $(this).val();

            $("#items_datalist option").each(function() {
                var btchWrh = $(this).data("warehseid");

                if (selectedWrh === "" || btchWrh == selectedWrh) {
                    $(this).prop("disabled", false).show();
                } else {
                    $(this).prop("disabled", true).hide();
                }
            });
        });


        total_calculate_fun();
        let incount = $('#rowunt').val();
        $(document).on('change', '#item_serch_inp', function() {
            let sttnid = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-sttnid')
            let prodid = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-prodid')
            let batchid = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-batchid')
            let batchno = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-batchno')
            let avlbal = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-avlbal')
            let pckgname = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-pckgname')
            let sizename = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-sizename')
            let warehseid = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-warehseid')
            let price = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-price')
            let prodname = $(this).val();
            incount++

            addrow(incount, sttnid, prodid, batchid, batchno, avlbal, pckgname, sizename, prodname, price);
            $(this).val('');
        });

        $(document).on("keyup", '.checkqty', function() {
            var count = $(this).data('count');
            var qty_avail = $('#inv_item_batch' + count).data('avlqty');
            var batchId = $('#inv_item_batch' + count).val();

            var totalentQty = 0;
            $('input[name="inv_item_qty[]"]').each(function() {
                var rowCount = $(this).data('count');
                var rowBatchId = $('#inv_item_batch' + rowCount).val();
                if (rowBatchId == batchId) {
                    totalentQty += parseInt($('#inv_item_qty' + rowCount).val()) || 0;
                }
            });

            if (qty_avail < totalentQty) {
                swal('Quantity should be equal or less then ' + qty_avail, {
                    icon: "error",
                    timer: 5000,
                });
                $(this).val(0);
            }
        });

        $(document).on("keyup", '.calclss', function() {
            var count = $(this).data('count');
            calculate_function(count);
            total_calculate_fun();
        });
        $(document).on("keyup", '#m_inv_dispr', function() {
            discount_cal_fun();
        });

        $(document).on("click", '.removerow', function() {
            var count = $(this).data('count');
            $('#rowcot' + count).remove();
            total_calculate_fun();
        });


        $("form#frm-add-invoice").submit(function(e) {
            e.preventDefault();
            var clkbtn = $("#btn-add-invoice");
            clkbtn.prop('disabled', true);
            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Invoice/insert_invoice'); ?>",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 'success') {
                        swal(data.message, {
                            icon: "success",
                            timer: 1000,
                        });
                        setTimeout(function() {
                            window.location = "<?php echo site_url('Invoice/invoice_list'); ?>";
                        }, 1000);
                    } else {
                        clkbtn.prop('disabled', false);
                        swal(data.message, {
                            icon: "error",
                            timer: 5000,
                        });
                    }
                },
                error: function(jqXHR, status, err) {
                    clkbtn.prop('disabled', false);
                    swal("Some Problem Occurred!! please try again", {
                        icon: "error",
                        timer: 2000,
                    });
                }
            });

        });


        $(".delete-invoice").on("click", function() {
            var clkbtn = $(this);
            clkbtn.prop('disabled', true);
            var dlt_id = $(this).data('value');
            var dlt_type = $(this).data('dtype');

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Invoice/delete_invoice'); ?>",
                        data: {
                            delete_id: dlt_id,
                            delete_type: dlt_type
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == 'success') {
                                swal(data.message, {
                                    icon: "success",
                                    timer: 1000,
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                clkbtn.prop('disabled', false);
                                swal(data.message, {
                                    icon: "error",
                                    timer: 5000,
                                });
                            }
                        },
                        error: function(jqXHR, status, err) {
                            clkbtn.prop('disabled', false);
                            swal("Some Problem Occurred!! please try again", {
                                icon: "error",
                                timer: 2000,
                            });
                        }
                    });

                } else {
                    clkbtn.prop('disabled', false);
                    swal("Your Data is safe!", {
                        icon: "info",
                        timer: 2000,
                    });
                }
            });
        });

    });


    function addrow(x, sttnid, prodid, batchid, batchno, avlbal, pckgname, sizename, prodname, price) {
        $('#tableblock').append(` <tr id="rowcot${x}">
        <td id="rowcount${x}">${x}</td>
                                            <td id="item_name${x}">${prodname}</td>
                                            <td id="item_batch${x}">${batchno}</td>
                                            <td id="item_pckage${x}">${pckgname} - ${sizename}</td>
                                            <td>
                                            <input type="hidden" name="inv_item_id[]" id="inv_item_id${x}" value="">
                                            <input type="hidden" name="inv_item_stcktrans[]" id="inv_item_stcktrans${x}" value="${sttnid}">
                                            <input type="hidden" name="inv_item_product[]" id="inv_item_product${x}" value="${prodid}">
                                            <input type="hidden" name="inv_item_batch[]" id="inv_item_batch${x}" data-avlqty="${avlbal}" value="${batchid}">
                                            <input type="number" id="inv_item_qty${x}" name="inv_item_qty[]" class="prodqty checkqty calclss" data-count="${x}" style="width:80px" value="0">
                                            <input type="hidden" name="pre_item_qty[]" value="0"></td>
                                            <td><input type="number" id="inv_item_rate${x}" name="inv_item_rate[]" class="prodrate calclss " data-count="${x}" style="width:80px" value="${price}">
                                            <input type="hidden" id="inv_item_pretaxamt${x}" name="inv_item_pretaxamt[]" value="0" class="prodstotal">
                                            <input type="hidden" id="inv_item_cgst${x}" name="inv_item_cgst[]" value="0" class="prodcgst">
                                            <input type="hidden" id="inv_item_sgst${x}" name="inv_item_sgst[]" value="0" class="prodsgst">
                                            <input type="hidden" id="inv_item_netamt${x}" name="inv_item_netamt[]" value="0" class="prodntotal"></td>
                                            <td id="item_pretaxamt${x}"></td>
                                            <td id="item_cgst${x}"></td>
                                            <td id="item_sgst${x}"></td>
                                            <td id="item_netamt${x}"></td>
                                            <td>  <button type="button" class="btn btn-danger px-1 py-0 removerow" data-count="${x}" title="Delete"><i class="fa fa-trash"></i></button></td>
                                            </tr>`);
    }

    function calculate_function(count) {

        let rate = parseFloat($('#inv_item_rate' + count).val());
        let qty = parseInt($('#inv_item_qty' + count).val());
        let gstpr = 9;
        let subtotal = (rate * qty);
        let gstamount = ((gstpr / 100) * subtotal);
        let nettotal = (subtotal + (gstamount * 2));
        $('#item_pretaxamt' + count).html(subtotal);
        $('#item_cgst' + count).html(gstamount.toFixed(2));
        $('#item_sgst' + count).html(gstamount.toFixed(2));
        $('#item_netamt' + count).html(nettotal.toFixed(2));

        $('#inv_item_pretaxamt' + count).val(subtotal);
        $('#inv_item_cgst' + count).val(gstamount.toFixed(2));
        $('#inv_item_sgst' + count).val(gstamount.toFixed(2));
        $('#inv_item_netamt' + count).val(nettotal.toFixed(2));
    }

    function total_calculate_fun() {
        var totalqty = 0;
        $('.prodqty').each(function(index) {
            totalqty += parseInt($(this).val());

        });

        var Tstotal = 0;
        $('.prodstotal').each(function(index) {
            Tstotal += parseFloat($(this).val());

        });

        var Tcgst = 0;
        $('.prodcgst').each(function(index) {
            Tcgst += parseFloat($(this).val());

        });
        var Tsgst = 0;
        $('.prodsgst').each(function(index) {
            Tsgst += parseFloat($(this).val());

        });
        var Tntotal = 0;
        $('.prodntotal').each(function(index) {
            Tntotal += parseFloat($(this).val());

        });

        $('#qty_total').html(totalqty);
        $('#sub_total').html(Tstotal);
        $('#cgst_total').html(Tcgst);
        $('#sgst_total').html(Tsgst);
        $('#grand_total').html(Tntotal);
        discount_cal_fun();
    }

    function discount_cal_fun() {
        let Tstotal = parseFloat($('#sub_total').html());
        let dispr = parseInt($('#m_inv_dispr').val());
        let disamt = ((dispr / 100) * Tstotal);
        let gstpr = 9;
        let subtotal = (Tstotal - disamt);
        let gstamount = ((gstpr / 100) * subtotal);
        let nettotal = (subtotal + (gstamount * 2));

        $('#m_inv_amount').val(Tstotal);
        $('#m_inv_discount').val(disamt.toFixed(2));
        $('#m_inv_pretax_amount').val(subtotal.toFixed(2));
        $('#m_inv_cgst').val(gstamount.toFixed(2));
        $('#m_inv_sgst').val(gstamount.toFixed(2));
        $('#total_tax').val(gstamount.toFixed(2) * 2);
        $('#m_inv_totalamt').val(nettotal.toFixed(2));

    }
</script>