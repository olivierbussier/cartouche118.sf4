/*
 * Fichier de dépendances Javascript et CSS utilisé par webpack encore
 * Ce fichier contient l'ensemble des dépendances nécessaires au chargement de toutes les pages
 * (inclus dans base.html.twig)
 */

// Fichiers CSS

require('../css/client.scss');

/**
 * Edition d'un élément de titre (existant)
 * @param id
 */
function cEditTitre(id)
{
    var url = $(id).data('url');
    var rec  = $(id).closest('.card-title').find('.item-edit');

    $.ajax(url).done(function (data) {
        $(rec).html(data);
    })
} window.cEditTitre = cEditTitre;

/**
 * Sauver une adresse en cours d'édition
 * @param id
 */
function cSaveTitre(id)
{
    var url = $(id).data('url');

    var ancestor = $(id).closest('.card-title');
    var editzone  = ancestor.find('.item-edit');
    var titrezone  = ancestor.find('.titre-edit');

    var form = $(editzone).find('form');

    var fields = $(form).serializeArray();
    $.ajax({
        method: 'POST',
        data: { fields: fields },
        url: url
    }).done(function (data) {
        $(titrezone).html(data)
        $(editzone).html('')
    })
} window.cSaveTitre = cSaveTitre;

/**
 * Suppression d'une adresse dans la base
 * @param id
 */
function cDelTitre(id)
{
    var url = $(id).data('url');
    var rec = $(id).closest('.card');

    if (id !== 0) {
        if (window.confirm('Êtes-vous sûr ?')) {
            $.ajax(url).done(function (data) {
                if (data.length === 0) {
                    $(rec).remove();
                }
            })
        }
    }
} window.cDelTitre = cDelTitre;

/**
 * Aborter une édition d'adresse en cours
 * @param id
 */
function cCancelTitre(id)
{
    var url = $(id).data('url');
    var rec  = $(id).closest('.card').find('.item-edit');

    $.ajax(url).done(function (data) {
        $(rec).html(data);
    })

} window.cCancelTitre = cCancelTitre;

/**
 * Ajout d'un element vide en mode édition
 * @param id
 */
function cAdd(id)
{
    var url = $(id).data('url');

    var o = $(id).closest('.card').find('.old-edit');

    $.ajax(url).done(function (data) {
        data = o.html() + '<div class="item-edit">' + data + "</div>"
        $(o).html(data);
    })
} window.cAdd = cAdd;

/**
 * Edition d'un élément existant
 * @param id
 */
function cEdit(id)
{
    var url = $(id).data('url');
    var rec  = $(id).closest('.item-edit');

    $.ajax(url).done(function (data) {
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
    var rec  = $(id).closest('.item-edit');

    $.ajax(url).done(function (data) {
        if (data.length === 0) {
            $(rec).remove();
        } else {
            $(rec).html(data);
        }
    })

} window.cCancel = cCancel;

/**
 * Sauver une adresse en cours d'édition
 * @param id
 */
function cSave(id)
{
    var url = $(id).data('url');

    var rec  = $(id).closest('.item-edit');
    var form = $(rec).find('form');

    var fields = $(form).serializeArray();
    $.ajax({
        method: 'POST',
        data: { fields: fields },
        url: url
    }).done(function (data) {
        $(rec).html(data)
    })
} window.cSave = cSave;

/**
 * Suppression d'une adresse dans la base
 * @param id
 */
function cDel(id)
{
    var url = $(id).data('url');
    var rec = $(id).closest('.item-edit');

    if (id !== 0) {
        if (window.confirm('Êtes-vous sûr ?')) {
            $.ajax(url).done(function (data) {
                if (data.length === 0) {
                    $(rec).remove();
                }
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
