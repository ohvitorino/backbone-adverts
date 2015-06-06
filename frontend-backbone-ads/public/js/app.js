/**
 * Created by bruno on 06/06/15.
 */

var app = app || {};

$(function() {
    new app.AdListView([
        {
            title: 'bla',
            content: 'I want bla bla',
            author: 'no@author.net',
            publication_time: new Date()
        }
    ]);
});