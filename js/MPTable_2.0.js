/*
  Autor: Mauricio Pimentel Aviles
  Version: 2.0
  Dependencias: jquery.dataTables.js y las librerias para exportar los datos, bootstrap css
  Mejoras: Integracion de librerias externas y optimizacion del codigo
  
*/

/*Libreria Parseo a base 64*/
jQuery.base64 = (function ($) {

    var _PADCHAR = "=",
      _ALPHA = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/",
      _VERSION = "1.0";


    function _getbyte64(s, i) {
        // This is oddly fast, except on Chrome/V8.
        // Minimal or no improvement in performance by using a
        // object with properties mapping chars to value (eg. 'A': 0)

        var idx = _ALPHA.indexOf(s.charAt(i));

        if (idx === -1) {
            throw "Cannot decode base64";
        }

        return idx;
    }


    function _decode(s) {
        var pads = 0,
          i,
          b10,
          imax = s.length,
          x = [];

        s = String(s);

        if (imax === 0) {
            return s;
        }

        if (imax % 4 !== 0) {
            throw "Cannot decode base64";
        }

        if (s.charAt(imax - 1) === _PADCHAR) {
            pads = 1;

            if (s.charAt(imax - 2) === _PADCHAR) {
                pads = 2;
            }

            // either way, we want to ignore this last block
            imax -= 4;
        }

        for (i = 0; i < imax; i += 4) {
            b10 = (_getbyte64(s, i) << 18) | (_getbyte64(s, i + 1) << 12) | (_getbyte64(s, i + 2) << 6) | _getbyte64(s, i + 3);
            x.push(String.fromCharCode(b10 >> 16, (b10 >> 8) & 0xff, b10 & 0xff));
        }

        switch (pads) {
            case 1:
                b10 = (_getbyte64(s, i) << 18) | (_getbyte64(s, i + 1) << 12) | (_getbyte64(s, i + 2) << 6);
                x.push(String.fromCharCode(b10 >> 16, (b10 >> 8) & 0xff));
                break;

            case 2:
                b10 = (_getbyte64(s, i) << 18) | (_getbyte64(s, i + 1) << 12);
                x.push(String.fromCharCode(b10 >> 16));
                break;
        }

        return x.join("");
    }


    function _getbyte(s, i) {
        var x = s.charCodeAt(i);

        if (x > 255) {
            //  throw "INVALID_CHARACTER_ERR: DOM Exception 5";
        }

        return x;
    }


    function _encode(s) {
        if (arguments.length !== 1) {
            throw "SyntaxError: exactly one argument required";
        }

        s = String(s);

        var i,
          b10,
          x = [],
          imax = s.length - s.length % 3;

        if (s.length === 0) {
            return s;
        }

        for (i = 0; i < imax; i += 3) {
            b10 = (_getbyte(s, i) << 16) | (_getbyte(s, i + 1) << 8) | _getbyte(s, i + 2);
            x.push(_ALPHA.charAt(b10 >> 18));
            x.push(_ALPHA.charAt((b10 >> 12) & 0x3F));
            x.push(_ALPHA.charAt((b10 >> 6) & 0x3f));
            x.push(_ALPHA.charAt(b10 & 0x3f));
        }

        switch (s.length - imax) {
            case 1:
                b10 = _getbyte(s, i) << 16;
                x.push(_ALPHA.charAt(b10 >> 18) + _ALPHA.charAt((b10 >> 12) & 0x3F) + _PADCHAR + _PADCHAR);
                break;

            case 2:
                b10 = (_getbyte(s, i) << 16) | (_getbyte(s, i + 1) << 8);
                x.push(_ALPHA.charAt(b10 >> 18) + _ALPHA.charAt((b10 >> 12) & 0x3F) + _ALPHA.charAt((b10 >> 6) & 0x3f) + _PADCHAR);
                break;
        }

        return x.join("");
    }


    return {
        decode: _decode,
        encode: _encode,
        VERSION: _VERSION
    };

}(jQuery));

(function ($) {
    $.extend({
        MPTable: function (Opts)
        {
            var defaults =
            {
                tableId: "",
                objTable: null,
                settDataTable:{},
                type: "excel",  // Permite configurar el tipo de archivo que se exportara ("excel","csv")
                group: false, // Permite o no agrupar los datos
                cols: false, // Permite o no seleccionar las columnas a mostrar
                title: "",  // Permite identificar el nombre de la tabla,
                ban: false
            };
            var Sett = $.extend(defaults, Opts);
            /*  Funciones propias*/
            function GetColumn (Texto) {
                var _NumColum = -1;
                $.each(_Inter.columnText, function (e, a) {
                    if (a == Texto) _NumColum = e;
                });
                return _NumColum;
            };
            function parseString(data) {
                if (defaults.htmlContent == 'true') content_data = data.html().trim();
                else content_data = data.text().trim();

                if (defaults.escape == 'true') content_data = escape(content_data);
                return content_data;
            }
            function Botons() {
                if (Sett.cols) {
                    Sett.settDataTable.buttons.push(
                        {
                            text: "Columnas",
                            action: function (e, dt, node, config) {
                                var _X = e.pageX;
                                var _Y = e.pageY;
                                var divGeneral = $("<div />", { class: 'col-md-12 col-sm-12 col-lg-12' });
                                var optsDivChild = { class: "col-md-6 col-sm-6 col-lg-6 menuCols" };
                                console.log(Sett.ban);
                                var id = Sett.tableId;
                                $("#" + id + " thead th").each(function (q) {
                                    var valor = $(this).text();
                                    var Check = $("<input />", { class: "CheckPlus", type: "checkbox", "data-column": q, checked: "checked" });

                                    Check.click(function () {
                                        var column = Sett.objTable.column($(this).attr('data-column'));
                                        column.visible(!column.visible());
                                    });
                                    var label = $("<label />").text(valor).css({
                                        cursor: "pointer",
                                        width: "100%"
                                    });
                                    label.prepend(Check);
                                    divGeneral.append(
                                        $("<div/>", optsDivChild).html(label).css({
                                            padding: ".3em",
                                            "border-radius": ".3em",
                                            border: "solid .1em lightgrey",
                                            "margin-bottom": ".3em"
                                        }).hover(function () {
                                            $(this).css({
                                                background: "lightgrey"
                                            });
                                        }, function () {
                                            $(this).css({
                                                background: "white"
                                            });
                                        })
                                    );
                                });
                                
                                if ($("#tblColumnsDefs_" + Sett.tableId))
                                    $("#tblColumnsDefs_" + Sett.tableId).remove();

                                    $("body").append(
                                        $("<div />", { id: "tblColumnsDefs_"+Sett.tableId, class: "col-md-6 col-lg-6" })
                                        .html(divGeneral)
                                        .css({
                                            background: "white none repeat scroll 0 0",
                                            border: "0.1em solid #004462",
                                            "border-radius": "0.3em",
                                            color: "#004462",
                                            cursor: "pointer",
                                            font: "bold 1em verdana",
                                            height: "auto",
                                            left: "10px",
                                            padding: "1em",
                                            position: "absolute",
                                            top: (_Y + 26) + "px",
                                            "z-index": "9999"
                                        })
                                        .append(
                                            $("<button />", { type: "button", class: "btn btn-danger" })
                                            .click(function () {
                                                $($(this).parents()[0]).remove();
                                            })
                                            .css({
                                                float: "right"
                                            })
                                            .text("Cerrar")
                                        )
                                    );
                            }
                        }
                    );
                }
            }
            /*  Region para las variables  */
            Botons();
            Sett.objTable = $("#" + Sett.tableId).DataTable(Sett.settDataTable);
            var _This = $("#"+Sett.tableId);
            var _Thead = _This.children("thead");
            var _Tbody = _This.children("tbody");
            var _Tfoot = _This.children("tfoot");
            var _Inter = {
                columnText:[]
            };


            /*  Llenado de variables internas  */
            _Thead.find("th").each(function (num) {
                var _Th = $(this);
                _Inter.columnText.push(_Th.text());
            });

            

            /*  Tratamiento de los datos */
            

            if (Sett.title != "") {
                $(_This.parents()[1]).prepend(
                    $("<div/>", { class: "col-md-3 col-lg-3 col-xs-3" })
                    .css({
                        "text-align": "left",
                        "font": "bold 1em verdana",
                        color: "#004463",
                        padding: "0px"
                    })
                    .append(
                        $("<h3/>").text(Sett.title)
                    )
                );
            }

            return Sett.objTable;
        }
    });
})(jQuery);

