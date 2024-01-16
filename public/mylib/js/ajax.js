$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //fifter item
    $(document).on('change', "select[name='category'],select[name='state'],input[name='search']", function () {
        let category_id = $("select[name='category']").val();
        let state = $("select[name='state']").val();
        let search = $("input[name='search']").val();

        var url = $("#form_filter").data("url");

        function getStatus(id) {
            if (id === 1) {
                return "<span class='badge bg-success'>Active</span>";
            } else if (id === 2) {
                return "<span class='badge bg-dark'>Ended</span>";
            } else if (id === 3) {
                return "<span class='badge bg-warning'>Await</span>";
            } else {
                return "<span class='badge bg-danger'>Bannded</span>";
            }
        }

        $.ajax({
            type: "POST",
            url: url,
            data: { category_id: category_id, state: state, search: search },
            dataType: "json",
            success: function (response) {
                $('.QA_section .QA_table').html("");
                $('.QA_section .QA_table').append(`
                <table class="table lms_table_active">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Owner (nick name)</th>
                            <th scope="col">Auctions</th>
                            <th scope="col">Status</th>
                            <th scope="col">View more</th>
                            <th scope="col">Ban</th> 
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                `);

                response.result.map(value => {
                    $('.QA_section .QA_table table tbody').append(`
                    <tr>
                    <td scope="row"> <a href="#" class="question_content">${value.id}</a></td>
                    <td>${value.name}</td>
                    <td>${value.price} ETH</td>
                    <td>${value.nick_name}</td>
                    <td>${value.count}</td>
                    <td>
                        ${getStatus(value.status)}
                    </td >
                    <td><a href="http://127.0.0.1:8000/admin/item/items_list/${value.id}" type="button" class="btn btn-outline-secondary">View more</a></td>
                    <td><a href="http://127.0.0.1:8000/admin/item/ban_item/${value.id}" class="btn btn-outline-danger">Ban</a></td>
                    </tr >
                    `)
                })
                $('.QA_section .QA_table table').DataTable({ "pageLength": 10, bLengthChange: false, "bDestroy": true, language: { search: "<i class='ti-search'></i>", searchPlaceholder: 'Quick Search', paginate: { next: "<i class='ti-arrow-right'></i>", previous: "<i class='ti-arrow-left'></i>" } }, columnDefs: [{ visible: false }], responsive: true, searching: false, });;
            }
        });
    });
    //fifter bid
    $(document).on('change', "select[name='filter_date']", function () {
        let filter_date = $("select[name='filter_date']").val();

        var url = $("#form_filter").data("url");

        function getStatus(id) {
            if (id === 1) {
                return "<span class='badge bg-primary'>Active</span>";
            } else if (id === 2) {
                return "<span class='badge bg-danger'>Fail</span>  ";
            } else if (id === 3) {
                return "<span class='badge bg-success'>Success</span>  ";
            }
        }

        $.ajax({
            type: "POST",
            url: url,
            data: { filter_date: filter_date },
            dataType: "json",
            success: function (response) {
                $('.QA_section .QA_table').html("");
                $('.QA_section .QA_table').append(`
                <table class="table lms_table_active">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Price</th>
                            <th scope="col">Auctioneer</th>
                            <th scope="col">Status</th>
                            <th scope="col">Bidding time</th>
                            <th scope="col">View more</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                `);

                response.result.map(value => {
                    $('.QA_section .QA_table table tbody').append(`
                    <tr>
                    <td scope="row"> <a class="question_content">${value.id}</a></td>
                    <td>${value.price} ETH</td>
                    <td>${value.nick_name}</td>
                    <td>${getStatus(value.status)}</td>
                    <td>${value.create_date}</td>
                    <td><button data-price="${value.price}" data-status="${value.status}" data-bid-id="${value.id}"
                        class="btn btn-outline-secondary bid_view_more">Edit</button>
                    </td>
                    </tr>
                    `)
                })
                $('.QA_section .QA_table table').DataTable({ "pageLength": 10, bLengthChange: false, "bDestroy": true, language: { search: "<i class='ti-search'></i>", searchPlaceholder: 'Quick Search', paginate: { next: "<i class='ti-arrow-right'></i>", previous: "<i class='ti-arrow-left'></i>" } }, columnDefs: [{ visible: false }], responsive: true, searching: false, });
            }
        });
    });

    // //popup bid
    // var bid_status;

    // $(document).on('click', ".bid_view_more", function () {
    //     $("#bid_popup").addClass("active");
    //     $(".box").removeClass("hidden");
    //     $(".box").addClass("show");
    //     $("input[name='price']").val($(this).data("price"));
    //     $("input[name='bid_id']").val($(this).data("bid-id"));
    //     $("#select_id").html("");
    //     bid_status = $(this).data("status");
    //     $("#select_id").append(`
    //     <select class="nice-select wide" name="status" >
    //         <option value="1" ${bid_status == 1 ? "selected" : ""}>Active</option>										  
    //         <option value="2" ${bid_status == 2 ? "selected" : ""}>Fail</option>
    //         <option value="3" ${bid_status == 3 ? "selected" : ""}>Success</option>
    //     </select>
    //     `);

    //     $('#select_id select').niceSelect();
    // });


    // $(document).on('click', ".close", function () {
    //     $(".box").removeClass("show");
    //     $(".box").addClass("hidden");
    //     $("#bid_popup").removeClass("active");
    // });

    // $(document).on('click', window, function (event) {
    //     var modal = document.getElementById('bid_popup');
    //     if (event.target == modal) {
    //         $(".close").trigger('click');
    //     }
    // });
});