/**
 * Created by bruno on 06/06/15.
 */

var app = app || {};

app.Ad = Backbone.Model.extend({
    defaults: {
        title: 'anonymous',
        body: 'No content',
        author: 'anonymous@nowhere.net',
        published_time: new Date()
    }
});