
var sample_domain = (window.location.href).replace(/\/[0-9a-zA-Z+_-]+$/, '');

if($$.findId("p-close-shared")) {
    jH("#p-close-shared").on('click', function () {
        jH("#div-info-build-in").fadeOut({timer_fade: 5});
    })
}

/**
 * Liberar a tela
 * */
if($$.findId("#div-modal-javascript")) {
    jH("#div-modal-javascript").display('none');
}

/**
 * Ajuste de Luz de acordo com o horario do computador de acesso
 * */
//ajax: Check if theme is active in PHP SESSION
$$.ajax({
    method: "POST",
    url: sample_domain+"/api/session/",
    async: true,
    cors: true,
    data: "action=check",
    dataType: "json",
    contentType: "application/json",
    success: function(data) {

        try {
            let t = JSON.parse(data).theme;
            if(t) {
                if($$.findId("night-light")) {
                    jH("#night-light").attr("href", "./resources/css/styles-"+t+".css");
                }
            }
        } catch (er) {
            //...
        }

    },
    error: function(err) {
        console.log("[Error] check active theme: " + err);
    }
});

let d = new Date();
if(d.getHours() >= 0 && d.getHours() <= 6 || d.getHours() >= 18 && d.getHours() <= 23) {
    if($$.findId("night-light")) {
        jH("#night-light").attr("href", "./resources/css/styles-night.css");
    } else {
        console.error("Error in application: Not found the element #night-light !");
    }
}

/**
 * Aplicar Temas Light
 * */
if($$.findId("light-theme")) {
    jH("#light-theme").on('click', function () {
        if($$.findId("night-light") && $$.findId("div-master")) {
            jH("#night-light").attr("href", "./resources/css/styles-light.css");
            jH("#div-master").fadeIn({timer_fade: 20});

            //ajax: Save theme in PHP SESSION
            $$.ajax({
                method: "POST",
                url: sample_domain+"/api/session/",
                async: false,
                cors: true,
                data: "action=save&theme=light",
                dataType: "json",
                contentType: "application/json",
                success: function(data) {
                    console.log("Theme light was saved !");
                },
                error: function(err) {
                    console.log("[Error] Theme light was not saved: " + err);
                }
            });
        }
    });
}

/**
 * Aplicar Temas Dark
 * */
if($$.findId("dark-theme")) {
    jH("#dark-theme").on('click', function(){
        if($$.findId("night-light") && $$.findId("div-master")) {
            jH("#night-light").attr("href", "./resources/css/styles-night.css");
            jH("#div-master").fadeIn({timer_fade: 20});

            //ajax: Save theme in PHP SESSION
            $$.ajax({
                method: "POST",
                url: sample_domain+"/api/session/",
                async: false,
                cors: true,
                data: "action=save&theme=night",
                dataType: "json",
                contentType: "application/json",
                success: function(data) {
                    console.log("Theme night was saved !");
                },
                error: function(err) {
                    console.log("[Error] Theme night was not saved: " + err);
                }
            });
        }
    });
}

/**
 * Mostrar o documento com efeito fade-in
 * */
if($$.findId("div-master")) {
    setTimeout(function () {
        jH("#div-master").fadeIn({timer_fade: 20});
    }, 300);
} else {
    console.error("Error in application: Not found the element #div-master !");
}

/***
 * scroller()
 * */
if($$.findElements("[data-scroll-anchor]")) {
    jH("[data-scroll-anchor]", {rsp: "hash"}).on('click', function (target) {
        if($$.findId(target)) {
            jH(target).scroller();
        } else {
            console.error("Error in application: Not found the element "+target+" to scroller() function !");
        }
    });
}

/***
 * screenSizer()
 * */

//Adjust Height of documentation menu
if($$.findId("div-menu")) {
    let s = $$.screen();
    let menu_height = Math.ceil(100 - ((80 / s.height) * 100)) + 2;
    jH("#div-menu").height(menu_height + "%");
}

