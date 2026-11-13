function addToCart(bookId, that){
    let quantity = +that.parentElement.querySelector('input').value;
    if(quantity <= 0){
        return;
    }
        
    let dataForm = {
        'book_id': bookId,
        'quantity': quantity
    };
    $.ajax({
        url: 'profile/addToCart',
        method: 'POST',
        data: dataForm,
        success: function(response){
            console.log(response);
            let totalItems = document.getElementById('TotalItems');
            totalItems.innerHTML = response.data.total;
            quantity = '';
        },
        error: function(response){
            console.log(response);
        }
    })
}

function getItemsIntoCarts(orderId = null, status = 'cart'){
    let formData = {
        orderId: orderId
    };

    $.ajax({
        url: 'profile/getItemsIntoCarts',
        method: 'POST',
        data: formData,
        success: function(response){
            console.log(response);
            let books = response.data;

            if(books.length === 0){
                $('#Cart .modal-body>.row').html(/*html*/`
                    <div class='alert alert-warning w-75 mx-auto text-center' role='alert'>Your Cart Is MT!</div>
                `);
                // return;
            }

            $('#Cart .modal-body').html(/*html*/`
                <h5 class="text-center mb-4 w-100">
                    Total Price : <span class="text-success fw-bolder" id="CartTotalPrice">${books[0]?.orders_total_price ?? 0}</span>
                </h5>
                <div class="row"></div>
                ${status == 'cart' ?/*html*/`
                    <button class="btn btn-success w-100 mx-auto" onclick="fireOrder(${books[0]?.orders_id})">
                        Order Now
                    </button>
                `:''}
            `);

            if(books.length === 0){
                $('#Cart .modal-body>.row').append(/*html */`
                    <div class='alert alert-warning w-75 mx-auto text-center' role='alert'>
                        There Are No Books Inside The Cart!
                    </div>
                `)
            }

            for(let book of books){
                $('#Cart .modal-body>.row').append(bookComponent(book, status, 50));
            }
            
            openModal('Cart');
        },
        error: function(response){
            console.log(response);
        }
    })
}

function increaseOrderItem(orderItemId, btn){
    let cartEle = $(btn).parents('.card');
    let buttons = cartEle.find('button');
    buttons.prop('disabled', true);

    let dataForm = {
        orderItemId: orderItemId,
    };
    $.ajax({
        url: "profile/incOrderItem",
        type: "POST",
        data: dataForm,
        success: function (res){
            console.log(res);
            let orderItem = res.data.orderItem, 
                bookId = orderItem.book_id;

            buttons.prop('disabled', false);

            $(`#Cart .card[data-book-id="${bookId}"] .subtotal`).text(orderItem.subtotal);
            $(`#Cart .card[data-book-id="${bookId}"] input`).val(orderItem.quantity);
            $("#Cart #CartTotalPrice").text(res.data.totalPrice);
        },
        error: function (res){
            console.log(res);
            buttons.prop('disabled', false);
        },
    });
}

function decreaseOrderItem(orderItemId, btn){
    let cartEle = $(btn).parents('.card');
    let buttons = cartEle.find('button');
    buttons.prop('disabled', true);

    let dataForm = {
        orderItemId: orderItemId,
    };
    $.ajax({
        url: "profile/decOrderItem",
        type: "POST",
        data: dataForm,
        success: function (res){
            console.log(res);
            let orderItem = res.data.orderItem, 
                bookId = orderItem.book_id;

            buttons.prop('disabled', false);

            if(orderItem.quantity == 0){
                $(`#Cart .card[data-book-id="${bookId}"]`).parent().remove();
                if($(`#Cart .card`).length === 0){
                    $('#Cart .modal-body>.row')
                        .html(`
                            <div class='alert alert-warning w-75 mx-auto text-center' role='alert'>Your Cart Is MT!</div>
                        `)
                }
            }
            else{
                $(`#Cart .card[data-book-id="${bookId}"] .subtotal`).text(orderItem.subtotal);
                $(`#Cart .card[data-book-id="${bookId}"] input`).val(orderItem.quantity);
            }
            $("#Cart #CartTotalPrice").text(res.data.totalPrice);
        },
        error: function (res){
            console.log(res);
            buttons.prop('disabled', false);
        },
    });
}

function deleteOrderItem(orderItemId, btn){
    let cartEle = $(btn).parents('.card');
    let buttons = cartEle.find('button');
    buttons.prop('disabled', true);

    let dataForm = {
        orderItemId: orderItemId,
    };
    $.ajax({
        url: "profile/deleteOrderItem",
        type: "POST",
        data: dataForm,
        success: function (res){
            console.log(res);
            cartEle.parent().remove();
            if($(`#Cart .card`).length === 0){
                $('#Cart .modal-body>.row').html(`
                    <div class='alert alert-warning w-75 mx-auto text-center' role='alert'>Your Cart Is MT!</div>
                `)
            }
            else{
                $("#Cart #CartTotalPrice").text(res.data.totalPrice);
            }
        },
        error: function (res){
            console.log(res);
            buttons.prop('disabled', false);
        },
    });
}

function fireOrder(orderId){
    let dataForm = {
        orderId: orderId,
    };

    $.ajax({
        url: "profile/fireOrder",
        type: "POST",
        data: dataForm,
        success: function (res){
            console.log(res);
            // cartEle.parent().remove();
            $('#Cart .btn-close').click();
            $('#TotalItems').text(0);
            swal.fire({
                title: `Orderd!`,
                text: "Your Order has been updated successfully",
                icon: "success"
            })

        },
        error: function (res){
            console.log(res);
            buttons.prop('disabled', false);
        },
    });
}
