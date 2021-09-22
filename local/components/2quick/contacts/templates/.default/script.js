window.onload = function () {
    if ($('#map').length) {
        YaMapsShown = false;
        $(window).on("scroll load resize", function () {
            if (!YaMapsShown) {
                if ($(window).scrollTop() + $(window).height() > $('#map').offset().top - 500) {
                    showYaMaps();
                    YaMapsShown = true;
                }
            }
        });

        function showYaMaps() {
            var script = document.createElement("script");
            script.type = "text/javascript";
            script.src = "https://api-maps.yandex.ru/2.1/?lang=ru_RU";
            document.getElementById("map").appendChild(script);
            script.onload = function () {
                ymaps.ready(init);
                var myMap,
                    myPlacemark;

                function init() {
                    myMap = new ymaps.Map("map", {
                        center: tqContactsCoords,
                        zoom: 13,
                        behaviors: ['default', 'scrollZoom'],
                    });
                    myMap.behaviors.disable('scrollZoom');
                    myMap.geoObjects.add(new ymaps.Placemark(tqContactsCoords, {
                        balloonContent: tqContactsCoordsDescription,
                    }, {
                        iconLayout: 'default#image',
                        iconImageHref: '/local/templates/balticplast/img/icons/marker-icon.svg',
                        iconImageSize: [46, 61],
                    }));
                }
            }
        }
    }
}