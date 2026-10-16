document.addEventListener('DOMContentLoaded', function () {
    let type = window.location.search.replace('?', '').split('-')[0];
    let actualType = type.charAt(0).toUpperCase() + type.slice(1);
    document.querySelector(`#${actualType}-tab`)?.click();
});

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

$('#addAuthorForm').submit(function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    $.ajax({
        url: 'profile/addAuthor',
        type: 'POST',
        data: formData,
        success: function (response) {
            alert('success', 'Author added successfully');
            $(`#addAuthorForm p.alert[data-error-name]`);
            $(`#addAuthorForm`).get(0).reset();
            $('#addAuthor btn-close').click();
            console.log(response)
            $('Authors-tab-pane > .row').prepend(`

                <div class='col-xl-4 col-lg-6'>

                    <div class='card my-1 rounded-4 bg-primary-subtle text-primary-emphasis'>
                        <img src='${imgPath('author.png')}' class='card-img-top mx-auto mt-3' style='width: 100px;'>

                        <div class='card-body'>
                            <h5 class='card-title text-center'>${response.data.name}</h5>
                            <p class='card-text' style='overflow-x: auto;'>Bio: <span class='ms-2'>${response.data.bio.substring(0, 100)}...</span></p>
                            <a class='btn btn-primary d-block mx-auto'>Edit</a>

                        </div>

                    </div>

                </div><!--total Authors-->

            `);
            // console.log(response.data);
        },
        error: function (response) {
            // console.log(response)
            let errors = response.responseJSON.data;
            showErrors(errors);
            alert('error', 'Author not added');
        }
    });
});

function showErrors(errors){
    for(let error in errors){
        // console.log(error)
        // console.log(document.querySelector(`p.alert[data-error-name="${error}"]`))
        $(`#addAuthorForm p.alert[data-error-name="${error}"]`)
            .text(errors[error])
            .removeClass('d-none');
    }
}

$('#BookfilterForm').submit(function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    // console.log(formData)
    $.ajax({
        url: 'profile/filterBooks',
        type: 'POST',
        data: formData,
        success: function (response) {
            // console.log(response, $('#Books-tab-pane > .container > .row').get(0));
            // $('body').append(`<pre>${JSON.stringify(response)}</pre>`); return;
            let books = response.data.data;
            // console.log(books)
            let currentPage = response.data.currentPage;
            let total = response.data.total;
            
            $('#Books-tab-pane > .container > .row').html(``);
            
            if(books.length != 0){
                for(let book of books){
                    let imgUrl = imgPath(book.image == null ? '/book.png' : '/uploads/' + book.image);
                    // console.log(book.image); console.log(imgUrl);
                    let shortDescription = book.description.substring(0, 100);
                    $('#Books-tab-pane > .container > .row').append(`

                        <div class='col-xl-4 col-lg-6'>

                            <div class='card my-1 rounded-4 bg-primary-subtle text-primary-emphasis'>
                                <img src='${imgUrl}' class='card-img-top mx-auto mt-3' style='width: 100px;'>

                                <div class='card-body'>
                                    <h5 class='card-title text-center'>${book.title}</h5>
                                    <p class='card-text' style='overflow-x: auto;'>Description: <span class='ms-2'>${shortDescription}...</span></p>
                                    <p class='card-text' style='overflow-x: auto;'>Author: <span class='ms-2'>${book.author_name}</span></p>
                                    <p class='card-text' style='overflow-x: auto;'>Description: <span class='ms-2'>
                                    ${shortDescription}
                                    </span></p>
                                    <p class='card-text' style='overflow-x: auto;'>Price: <span class='ms-2'>${book.price}</span></p>
                                    <p class='card-text' style='overflow-x: auto;'>Stock: <span class='ms-2'>${book.stock}</span></p>
                                    <a class='btn btn-primary d-block mx-auto'>Edit</a>

                                </div>

                            </div>

                        </div><!--total Books-->

                    `);
                }
                $('#Books-tab-pane > .container > nav').html(preparePagination(response.data));
            }
            else{
                $('#Books-tab-pane > .container > .row')
                    .append(`
                        <div class="alert alert-warning w-75 mx-auto text-center" role="alert">
                            No Books Found!
                        </div>
                    `);
            }
            
        },

        error: function (response) {
            console.log(response)
        }

    });

});

function changePage(page){
    $("#__7ambozo").val(page);
    // console.log($("#__7ambozo").get(0))
    $('#BookfilterForm').trigger('submit');
    // console.log('ok')
}

function preparePagination(data){
    if(data.length != 0){

    let prepareLi = '';

    let pagesNumber = Math.ceil(data.total / 10);

    let currentPage = data['currentPage'];

    let pageIndex = currentPage - 1;

    let NextPageNumber = (pageIndex + 1) % pagesNumber;
    NextPageNumber++;
        
    let PreviousPageNumber = (pageIndex - 1 + pagesNumber) % pagesNumber;
    PreviousPageNumber++;

    let profileLink = window.location.origin + '/php/BookStore/public/profile';

    let isActive = '';

    for (let i = 1; i <= pagesNumber; i++) {
        isActive = (i === currentPage) ? 'active' : '';
        prepareLi += `<li class='page-item ${isActive}'><a class='page-link' onclick='changePage(${i})' data-page=${i}>${i}</a></li>`;
    }

    return `
        <ul class='pagination'>
            <li class='page-item'><a class='page-link' onclick='changePage(${PreviousPageNumber})' data-page=${PreviousPageNumber}>Previous</a></li>
            ${prepareLi}
            <li class='page-item'><a class='page-link' onclick='changePage(${NextPageNumber})' data-page=${NextPageNumber}>Next</a></li>
        </ul>
    `;

    }
    else{
        return '';
    }
}