function alert(type, msg) {
    Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    }).fire({
        icon: type,
        title: msg
    });
}

function imgPath(name){
    return window.location.origin + '/php/BookStore/public/assets/imgs' + name;
}

function showErrors(errors) {
    $('#addBookForm p.alert[data-error-name]')
        .addClass('d-none')
        .text('');

    for (let error in errors) {
        $(`#addBookForm p.alert[data-error-name="${error}"]`)
            .text(errors[error].join(', '))
            .removeClass('d-none');
    }
}

function openModal(ModalId){
    const myModal = new bootstrap.Modal(`#${ModalId}`);
    myModal.show();
    document.activeElement?.blur();
}

function bookComponent(book, status = 'books', descriptionLength = 100){
    let imgUrl = '';
    let shortDescription = '';
    let additionalRows = '';
    let cartButton = '';
    if(status == 'books'){
        imgUrl = book.image == null ? imgPath('/book.png') : imgPath('/uploads/' + book.image);
        shortDescription = book.description.substring(0, descriptionLength);
        additionalRows = /*html*/`
            <h5 class='card-title text-center'>${book.title}</h5>
            <p class='card-text' style='overflow-x: auto;'>Author: <span class='ms-2'>${book.author_name}</span></p>
            <p class='card-text' style='overflow-x: auto;'>Description: <span class='ms-2'>
            ${shortDescription}...
            </span></p>
            <p class='card-text' style='overflow-x: auto;'>Price: <span class='ms-2'>${book.price}</span></p>
            <p class='card-text' style='overflow-x: auto;'>Stock: <span class='ms-2'>${book.stock}</span></p>
        `;
        cartButton = /*html*/`
            <div class='input-group'>
                <input 
                    type='number'
                    min='1' 
                    class='form-control' 
                    placeholder='add to cart' 
                    aria-label='Example text with button addon' 
                    aria-describedby='button-addon1'
                    id='input-quantity-${book.id}'>
                <button class='btn btn-outline-success' type='button' onclick='addToCart(${book.id}, this)'>Add To Cart</button>
            </div>
        `;
    }
    else if(status == 'cart'){
        imgUrl = book.books_image == null ? imgPath('/book.png') : imgPath('/uploads/' + book.books_image);
        shortDescription = book.books_description.substring(0, descriptionLength);
        additionalRows += /* html */ `
            <i 
                class='fa-solid fa-trash-can text-danger fs-6 position-absolute' 
                style="top: 10px; right: 10px; cursor: pointer;"
                onclick="deleteOrderItem(${book['items_id']}, this)">
            </i>
            <h5 class='card-title text-center'>${book.books_title}</h5>
            <p class='card-text' style='overflow-x: auto;'>Author: <span class='ms-2'>${book.authors_name}</span></p>
            <p class='card-text' style='overflow-x: auto;'>Description: <span class='ms-2'>
                ${shortDescription}...
            </span></p>
            <p class='card-text' style='overflow-x: auto;'>Price: <span class='ms-2'>${book.books_price}</span></p>
            <p class='card-text' style='overflow-x: auto;'>Stock: <span class='ms-2'>${book.books_stock}</span></p>
            <p class='card-text' style='overflow-x: auto;'>subTotal: <span class='ms-2 subtotal'>${book.items_subtotal}</span></p>
        `;
        cartButton = /*html*/`
            <div class="input-group mb-3">
                <button class="btn btn-outline-danger" onclick='decreaseOrderItem(${book["items_id"]}, this)' id="button-addon1"><i class='fa-solid fa-minus'></i></button>
                <input type="text" class="form-control text-center" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" value="${book.items_quantity}" disabled>
                <button class="btn btn-outline-success" onclick='increaseOrderItem(${book["items_id"]}, this)' id="button-addon1"><i class='fa-solid fa-plus'></i></button>
            </div>
        `;
    }
    else if(status == 'showOrder'){
        imgUrl = book.books_image == null ? imgPath('/book.png') : imgPath('/uploads/' + book.books_image);
        shortDescription = book.books_description.substring(0, descriptionLength);
        additionalRows += /* html */ `
            <h5 class='card-title text-center'>${book.books_title}</h5>
            <p class='card-text' style='overflow-x: auto;'>Author: <span class='ms-2'>${book.authors_name}</span></p>
            <p class='card-text' style='overflow-x: auto;'>Description: <span class='ms-2'>
                ${shortDescription}...
            </span></p>
            <p class='card-text' style='overflow-x: auto;'>Price: <span class='ms-2'>${book.books_price}</span></p>
            <p class='card-text' style='overflow-x: auto;'>Stock: <span class='ms-2'>${book.books_stock}</span></p>
            <p class='card-text' style='overflow-x: auto;'>subTotal: <span class='ms-2 subtotal'>${book.items_subtotal}</span></p>
        `;
    }
    // if(status == 'cart') console.log(book);
    return /*html*/`
        <div class='col-xl-4 col-lg-6'>

            <div class='card my-1 rounded-4 bg-primary-subtle text-primary-emphasis position-relative' data-book-id='${book['books_id']}'>
                <img src='${imgUrl}' class='card-img-top mx-auto mt-3' style='width: 100px;'>

                <div class='card-body'>
                    ${additionalRows}
                    ${cartButton}

                </div>

            </div>

        </div><!--total Books-->
    `;
}
