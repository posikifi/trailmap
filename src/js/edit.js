var DeleteFeature = OpenLayers.Class(OpenLayers.Control, {
    initialize: function (layer, options) {
        OpenLayers.Control.prototype.initialize.apply(this, [options]);
        this.layer = layer;
        this.handler = new OpenLayers.Handler.Feature(
            this, layer, {
                click: this.clickFeature
            }
        );
    },
    clickFeature: function (feature) {
        // if feature doesn't have a fid, destroy it
        if (feature.fid == undefined) {
            this.layer.destroyFeatures([feature]);
        } else {
            feature.state = OpenLayers.State.DELETE;
            this.layer.events.triggerEvent("afterfeaturemodified", {
                feature: feature
            });
            feature.renderIntent = "select";
            this.layer.drawFeature(feature);
        }
    },
    setMap: function (map) {
        this.handler.setMap(map);
        OpenLayers.Control.prototype.setMap.apply(this, arguments);
    },
    CLASS_NAME: "OpenLayers.Control.DeleteFeature"
});

$(function () {

    var map = new OpenLayers.Map('map', {
        projection: new OpenLayers.Projection("EPSG:900913"),
        displayProjection: new OpenLayers.Projection("EPSG:4326"),
        controls: [
            new OpenLayers.Control.PanZoom(),
            new OpenLayers.Control.Navigation()
        ]
    });
    var wgs = new OpenLayers.Projection("EPSG:4326");

    var gphy = new OpenLayers.Layer.WMS("MML",
        "http://tiles.kartat.kapsi.fi/peruskartta?", {
            layers: 'peruskartta'
        });

    var saveStrategy = new OpenLayers.Strategy.Save();

    var wfs = new OpenLayers.Layer.Vector("Polut", {
        strategies: [new OpenLayers.Strategy.Fixed(), saveStrategy],
        projection: new OpenLayers.Projection("EPSG:900913"),
        protocol: new OpenLayers.Protocol.WFS({
            version: "1.1.0",
            srsName: "EPSG:900913",
            url: "http://trailmap.hylly.org/geoserver/trailmap/wfs",
            featureType: "segment",
            featureNS: "trailmap",
            geometryName: "geom",
            extractAttributes: true
        }),
        styleMap: new OpenLayers.StyleMap({
            'default': new OpenLayers.Style({
                strokeWidth: 5,
                strokeColor: '#00ff00',
                strokeOpacity: 0.7,
                pointRadius: 6
            }),
            'select': new OpenLayers.Style({
                strokeWidth: 5,
                strokeColor: '#ff0000',
                strokeOpacity: 0.7,
                pointRadius: 6
            })
        })
    });
    var tracklayer = new OpenLayers.Layer.WMS("Tracks",
        "./mapproxy.php", {
            layers: 'trailmap:tracks',
            transparent: true
        }, {
            isBaseLayer: false
        });
    map.addLayers([gphy, tracklayer, wfs]);

    var panel = new OpenLayers.Control.Panel({
        displayClass: 'customEditingToolbar',
        allowDepress: true
    });

    snap = new OpenLayers.Control.Snapping({
        layer: wfs,
        edge: false,
        vertexTolerance: 10,
        nodeTolerance: 10
    });
    map.addControl(snap);
    snap.activate();

    // configure split agent
    split = new OpenLayers.Control.Split({
        layer: wfs,
        source: wfs,
        deferDelete: true,
        tolerance: 0.0001,
        eventListeners: {
            aftersplit: function (event) {
                flashFeatures(event.features);
            }
        }
    });
    map.addControl(split);
    split.activate();

    var draw = new OpenLayers.Control.DrawFeature(
        wfs, OpenLayers.Handler.Path, {
            title: "Draw Feature",
            displayClass: "olControlDrawFeaturePolygon",
            multi: false
        }
    );

    var edit = new OpenLayers.Control.ModifyFeature(wfs, {
        title: "Modify Feature",
        displayClass: "olControlModifyFeature"
    });


    wfs.events.register('beforefeaturemodified', wfs, function (e) {
        var attr = e.feature.attributes;
        $('#inp-sel').val(attr.selkeys);
        $('#inp-epa').val(attr.epatas);
        $('#inp-alu').val(attr.alusta);
        $('#attrform').show(200);
        console.log('before');
        return true;
    });
    wfs.events.register('afterfeaturemodified', wfs, function (e) {
        e.feature.attributes.selkeys = $('#inp-sel').val();
        e.feature.attributes.epatas = $('#inp-epa').val();
        e.feature.attributes.alusta = $('#inp-alu').val();
        $('#attrform').hide(200);
        console.log('after');
        return true;
    });

    var del = new DeleteFeature(wfs, {
        title: "Delete Feature"
    });

    var save = new OpenLayers.Control.Button({
        title: "Save Changes",
        trigger: function () {
            edit.deactivate();
            if (edit.feature) {
                edit.selectControl.unselectAll();
            }

            saveStrategy.save();
        },
        displayClass: "olControlSaveFeatures"
    });

    panel.addControls([save, del, edit, draw]);
    map.addControl(panel);



    var center = new OpenLayers.LonLat(26, 61).transform(wgs, map.getProjectionObject());

    map.setCenter(center, 7);
    $('#attrform').hide();

    $('#savebtn').click(function (e) {
        //edit.deactivate();
        save.trigger();
    });

});