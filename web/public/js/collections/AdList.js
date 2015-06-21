/**
 * Created by bruno on 06/06/15.
 */

var app = app || {};

app.AdList = Backbone.Collection.extend({
    model: app.Ad,

    url: "/api/ads"
});