<script>
    $(document).ready(function(e) {

        $("#stk_trans_from").change(function() {
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
            let prodid = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-prodid')
            let batchid = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-batchid')
            let prodname = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-prodname')
            let avlbal = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-avlbal')
            let pckgname = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-pckgname')
            let sizename = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-sizename')
            let warehseid = $("#items_datalist option[value='" + $(this).val() + "']").attr('data-warehseid')
            let batchno = $(this).val();
            incount++

            addrow(incount, prodid, batchid, batchno, avlbal, pckgname, sizename, prodname);
            $(this).val('');
        });

        $(document).on("keyup", '.checkqty', function() {
            var count = $(this).data('count');
            var qty_avail = $('#stk_trans_batch' + count).data('avlqty');
            var batchId = $('#stk_trans_batch' + count).val();

            var totalentQty = 0;
            $('input[name="stk_trans_qty[]"]').each(function() {
                var rowCount = $(this).data('count');
                var rowBatchId = $('#stk_trans_batch' + rowCount).val();
                if (rowBatchId == batchId) {
                    totalentQty += parseInt($('#stk_trans_qty' + rowCount).val()) || 0;
                }
            });

            if (qty_avail < totalentQty) {
                swal('Quantity should be equal or less then ' + qty_avail, {
                    icon: "error",
                    timer: 5000,
                });
                $(this).val(0);
            }

            total_calculate_fun();

        });

        $(document).on("click", '.removerow', function() {
            var count = $(this).data('count');
            $('#rowcot' + count).remove();
            total_calculate_fun();
        });


        $("form#frm-add-stocktrans").submit(function(e) {
            e.preventDefault();
            var clkbtn = $("#btn-add-stocktrans");
            clkbtn.prop('disabled', true);
            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Invoice/insert_stock_transfe'); ?>",
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
                            window.location = "<?php echo site_url('Invoice/stock_transfer_list'); ?>";
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


        $(".delete-stocktrans").on("click",function() {
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
                        url: "<?php echo site_url('Invoice/delete_stock_transfe'); ?>",
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


    function addrow(x, prodid, batchid, batchno, avlbal, pckgname, sizename, prodname) {
        $('#tableblock').append(` <tr id="rowcot${x}">
        <td id="rowcount${x}">${x}</td>
                                            <td id="item_name${x}">${prodname}</td>
                                            <td id="item_batch${x}">${batchno}</td>
                                            <td><input type="hidden" name="stk_trans_id[]" id="stk_trans_id${x}" value="">
                                            <input type="hidden" name="stk_trans_prod[]" id="stk_trans_prod${x}" value="${prodid}">
                                            <input type="hidden" name="stk_trans_batch[]" id="stk_trans_batch${x}" data-avlqty="${avlbal}" value="${batchid}">
                                            <input type="number" id="stk_trans_qty${x}" name="stk_trans_qty[]" class="prodqty checkqty" data-count="${x}" style="width:80px" value="0">
                                            <input type="hidden" name="pre_item_qty[]" value="0"></td>
                                            <td id="item_pckage${x}">${pckgname}</td>
                                            <td id="item_size${x}">${sizename}</td>
                                            <td>  <button type="button" class="btn btn-danger px-1 py-0 removerow" data-count="${x}" title="Delete"><i class="fa fa-trash"></i></button></td>
                                            </tr>`);
    }

    function total_calculate_fun() {
        var totalqty = 0;
        $('.prodqty').each(function(index) {
            totalqty += parseInt($(this).val());
        });

        $('#qty_total').html(totalqty);

    }
</script>