/*
 * Fichier de dépendances Javascript et CSS utilisé par webpack encore
 * Ce fichier contient l'ensemble des dépendances nécessaires au chargement de toutes les pages
 * (inclus dans base.html.twig)
 */

// Fichiers CSS

require('../css/client.scss');

//require('./clientAdr')
//require('./clientTel')

/**
 * Ajout d'une adresse vide en mode édition
 * @param id
 */
function cAdd(id)
{
    var url = $(id).data('url');
    var client = $(id).data('clientId');
    var rec  = $(id).data('receiver');

    $.ajax({
        method: 'POST',
        data: { receiver: rec },
        url: url + '/' + client,
    }).done(function (data) {
        $(rec).html(data);
    })
} window.cAdd = cAdd;

/**
 * Edition d'une adresse existante
 * @param id
 */
function cEdit(id)
{
    var url = $(id).data('url');
    var rec  = $(id).data('receiver');
    $.ajax({
        method: 'POST',
        data: { receiver: rec },
        url: url
    }).done(function (data) {
        $(rec).html(data);
    })
} window.cEdit = cEdit;

/**
 * Aborter une édition d'adresse en cours
 * @param id
 */
function cCancel(id)
{
    var url = $(id).data('url');

    var rec = $(id).closest('.new-edit').attr('id');

    $.ajax({
        method: 'POST',
        data: { receiver: rec },
        url: url
    }).done(function (data) {
        $('#'+rec).html(data);
    })

} window.cCancel = cCancel;

/**
 * Sauver une adresse en cours d'édition
 * @param id
 */
function cSave(id)
{
    var adrId = $(id).data('id');
    var form  = $(id).data('form');
    var url = $(id).data('url');

    var rec = $(id).closest('.new-edit').attr('id');

    if (adrId !== 0) {
        url = url + "/" + adrId;
    }
    var fields = $(form).serializeArray();
    $.ajax({
        method: 'POST',
        data: {receiver: rec, fields: fields },
        url: url
    }).done(function (data) {
        $('#'+rec).html(data)
    })
} window.cSave = cSave;

/**
 * Suppression d'une adresse dans la base
 * @param id
 */
function cDel(id)
{
    var url = $(id).data('url');
    var rec  = $(id).data('receiver');
    if (id !== 0) {
        if (window.confirm('Êtes-vous sûr ?')) {
            $.ajax(url).done(function (data) {
                $(rec).html(data)
            })
        }
    }
} window.cDel = cDel;

function initEdit() {
    var idx = 1;
    $('.edit-save').each(function (d) {
        //$(d).attr('id',idx);
        //console.log($(this));
    })
} window.initEdit = initEdit;
