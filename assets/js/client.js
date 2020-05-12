/*
 * Fichier de dépendances Javascript et CSS utilisé par webpack encore
 * Ce fichier contient l'ensemble des dépendances nécessaires au chargement de toutes les pages
 * (inclus dans base.html.twig)
 */

// Fichiers CSS

require('../css/client.scss');

/**
 * Sauver une adresse en cours d'édition
 * @param id
 */
function cSaveNewTitre(id)
{
    var url = $(id).data('url');

    var ancestor    = $(id).closest('.zone-globale');
    var zoneclients = ancestor.find('.zone-liste-clients');
    var card        = $(id).closest('.card');
    var form        = card.find('.zone-form');

    var fields = $(form).serializeArray();
    $.ajax({
        method: 'POST',
        data: { fields: fields },
        url: url
    }).done(function (data) {
        $(zoneclients).prepend(data)
    })
} window.cSaveNewTitre = cSaveNewTitre;

/**
 * Sauver une adresse en cours d'édition
 * @param id
 */
function cSaveNew(id)
{
    var url = $(id).data('url');

    var ancestor = $(id).closest('.card');
    var rec = ancestor.find('.zone-old-edit')
    var form = ancestor.find('.zone-new-edit').find('form');

    var fields = $(form).serializeArray();
    $.ajax({
        method: 'POST',
        data: { fields: fields },
        url: url
    }).done(function (data) {
        $(rec).prepend(data)
    })
} window.cSaveNew = cSaveNew;

/**
 * Sauver une adresse en cours d'édition
 * @param id
 */
function cSaveTitre(id)
{
    var url = $(id).data('url');

    var card  = $(id).closest('.card');
    var form      = $(card).find('.zone-form');

    var fields = $(form).serializeArray();
    $.ajax({
        method: 'POST',
        data: { fields: fields },
        url: url
    }).done(function (data) {
        $(card).replaceWith(data)
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
 * Sauver une adresse en cours d'édition
 * @param id
 */
function cSave(id)
{
    var url = $(id).data('url');

    var rec  = $(id).closest('.zone-item-edit');
    var form = $(rec).find('.zone-form');

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
    var rec = $(id).closest('.zone-item-edit');

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
