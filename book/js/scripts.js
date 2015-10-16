$(function () {


});

var toggle = 0;

$(document).on("click", '.hideAlert', function (event) {
    $('.modal').modal('hide');
});

$(document).on('click', '.codersAjaxAll', function() {
/*
    $.ajax({
        type: 'GET',
        url: 'api/api.php',
        success: function(itemBooks){
            $.each(itemBooks, function(i, itemBook){
                $('.books').append('<li>book </li>');
            });
        }
    });
});
*/

    var thisData = $(this);
    var request_method = thisData.attr('data-method');
    var sendAjaxData = {};

    if (thisData.parents('form').length > 0) {
        var formGet = thisData.parents('form');
        sendAjaxData['data'] = formData(formGet);
    }
    formClassNew(request_method, sendAjaxData, true, function (result) {
        alertTimeout = 0;
        if (result['error'] != undefined) {
            showAlert(3, result['error'], false);

        }
        else {
            if (result['success'] != undefined) {
                showAlert(1, result['success'], false);
            }

            if (result['bookInfoAll'] != undefined) {
                $('.books').html('');
                var newBooks = '';
                for(var i=0; i<result['bookInfoAll'].length; i++){
                    var currentBook = result['bookInfoAll'][i];
                    newBooks += '<div class="bookSingle codersAjax" data-method="GET" data-id="' + currentBook.id + '"> <b>Tytuł: </b> ' + currentBook.title + ' (Autor : ' + currentBook.author + ')<button data-method="DELETE" class="form-control codersAjax" data-id="' + currentBook.id + '">USUŃ</button></div>'; //poprzez konkatenacje dodajemy pojedyńczą książke currentBook.author[jak w bazie bo bierze to z Json]
                }
                $('div.books').html(newBooks);
            }
        }

        if ($btn != undefined && $btn.length > 0) {
            $btn.button('reset');
        }
        return false;
    });

    return false;

});

$(document).on("click", '.codersAjax', function (event) {
    var thisData = $(this);
    var request_method = thisData.attr('data-method');
    var sendAjaxData = {};

    if (thisData.hasClass('btn')) {
        var $btn = thisData.button('loading');
    }

    if (thisData.parents('form').length > 0) {
        var formGet = thisData.parents('form');
        sendAjaxData['data'] = formData(formGet);
    }
    else {
        var dane = {};
        dane.id = thisData.attr('data-id');
        sendAjaxData['data'] = dane;
    }

    formClassNew(request_method, sendAjaxData, true, function (result) {
        alertTimeout = 0;
        if (result['error'] != undefined) {
            showAlert(3, result['error'], false);

        }
        else {
            if (result['success'] != undefined) {
                showAlert(1, result['success'], false);
            }
            if (result['bookList'] != undefined) {
                $('.books').html('');
                var newBooks = '';
                for(var i=0; i<result['bookList'].length; i++){
                    var currentBook = result['bookList'][i];
                    newBooks += '<div class="bookSingle codersAjax" data-method="GET" data-id="' + currentBook.id + '"> <b>Tytuł: </b> ' + currentBook.title + ' (Autor : ' + currentBook.author + ')<button data-method="DELETE" class="form-control codersAjax" data-id="' + currentBook.id + '">USUŃ</button></div>'; //poprzez konkatenacje dodajemy pojedyńczą książke currentBook.author[jak w bazie bo bierze to z Json]
                }
                $('.books').html(newBooks);
            }
            if(result['bookInfo'] != undefined){
                var currentBook = result['bookInfo'][0];
                var bookDescription = currentBook.description;
                $('[data-id=' + currentBook.id + ']').append('<div><b>Opis:</b>' + bookDescription +' </div> ');
            }
        }

        if ($btn != undefined && $btn.length > 0) //sprawdzamy czy nasz button istnieje
            $btn.button('reset'); // jak tak to go resetujemy

        return false;
    });

    return false;
});

var modalShown = false;

function showAlert(type, msg) {
    modalExec('sm', type, msg);
}

function modalExec(elem, type, msg) {
    var modal = $('.modal');
    var modalEl = modal.find('.alert');
    modal.find('.modal-dialog').attr('class', 'modal-dialog modal-' + elem);
    var modalText = 'Sukces';
    switch (type) {
        case 1://success
            modalEl.attr('class', 'alert alert-success');
            break;
        case 2: //info
            modalEl.attr('class', 'alert alert-info');
            modalText = 'Informacja';
            break;
        case 3: //danger/error
            modalEl.attr('class', 'alert alert-danger');
            modalText = 'Błąd';
            break;
    }

    modalEl.children('.modal-text').html(msg);
    modalEl.find('.modal-title > b').html(modalText);
    modalToggle($('#alert_small'));
}

function modalToggle(elem) {
    var isModalOpen = elem.hasClass('in');

    elem.modal(isModalOpen ? 'show' : 'toggle');
}

function formClassNew(request_method, args, async, callback) {
    var json = {}, async = !async ? false : true;
    $.ajax({                                        // funkcja kominkuje sie z ajaxem ( tablica danych )
        url: 'api/api.php',                         // adres pod ktory sie laczycmy
        type: request_method,                       // metoda jaka przesylamy dane
        data: args.data,                           // dane ktore przesylamy ( dane do wyslania )    // to samo co -> args['data']
        dataType: 'json',                           // rodzaj danytch jaki przesylamy
        async: async,                               // asynchornicznie

        success: function (json) { //do zmiennej json przypisywana jest odpowiedz z serwera juz w tym nawiasie
            if ($.isEmptyObject(json)) { //sprawdzamy czy jest pustym obiektem
                json = {};
                json['error'] = 'Pusta odpowiedź serwera';
                console.info('Empty response - isEmptyObject: true');
            }
            if (typeof callback == 'function')callback(json); // sprwdzamy czy typem callbacka jest funckaj, jezeli tak to sie do niej odwolujemy
        },
        error: function (jqXhr, errorStatus, error) {
            var json = {};
            json['error'] = 'Wysapil błąd';
            if (typeof callback == 'function')callback(json);
        }
    });
    console.log(json);
    return json;
}

function formData(formClass) {
    dane = {};
    $.each(formValues(formClass), function (name, input) {
        dane[name] = input;
    });
    return dane;
}

function formValues(formClass) {
    var inputs = {};
    $('input[type="text"], input[type="password"], input[type="hidden"], input[type="date"], input[type="email"], textarea', formClass).each(function () {
        var tmpClass = $(this).attr('name');
        inputs[tmpClass] = $(this).val();

    });

    $('input[type="checkbox"]', formClass).each(function () {
        var tmpClass = $(this).attr('name');

        if ($(this).is(':checked')) {
            inputs[tmpClass] = 1;
        } else {
            inputs[tmpClass] = 0;
        }
    });
    $('input[type="radio"]', formClass).each(function () {
        var tmpClass = $(this).attr('name');
        if ($(this).is(':checked')) {
            inputs[tmpClass] = $(this).val();
        }
    });

    $('select', formClass).each(function () {
        var tmpClass = $(this).attr('name');
        if ($(this).val() != '')
            inputs[tmpClass] = $(this).val();

    });
    return inputs;
}

