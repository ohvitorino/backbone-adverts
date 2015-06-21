/**
 * Created by bruno on 06/06/15.
 */

var app = app || {};

app.AdList = Backbone.Collection.extend({
    model: app.Ad,

    url: "/api/ads",

    search: function(txt) {
        if (txt == "") return this;

        var pattern = new RegExp(txt, "gi");
        return _(this.filter(function (data) {
            return pattern.test(data.get("title")) || pattern.test(data.get("body"));
        }));
    }
});