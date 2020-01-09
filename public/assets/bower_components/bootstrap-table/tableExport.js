/*
 tableExport.jquery.plugin

 Version 1.10.7

 Copyright (c) 2015-2019 hhurz, https://github.com/hhurz

 Original Work Copyright (c) 2014 Giri Raj

 Licensed under the MIT License
*/
var $jscomp = $jscomp || {};
$jscomp.scope = {};
$jscomp.findInternal = function(c, n, t) {
    c instanceof String && (c = String(c));
    for (var z = c.length, A = 0; A < z; A++) {
        var R = c[A];
        if (n.call(t, R, A, c)) return { i: A, v: R };
    }
    return { i: -1, v: void 0 };
};
$jscomp.ASSUME_ES5 = !1;
$jscomp.ASSUME_NO_NATIVE_MAP = !1;
$jscomp.ASSUME_NO_NATIVE_SET = !1;
$jscomp.defineProperty =
    $jscomp.ASSUME_ES5 || "function" == typeof Object.defineProperties
        ? Object.defineProperty
        : function(c, n, t) {
              c != Array.prototype && c != Object.prototype && (c[n] = t.value);
          };
$jscomp.getGlobal = function(c) {
    return "undefined" != typeof window && window === c
        ? c
        : "undefined" != typeof global && null != global
        ? global
        : c;
};
$jscomp.global = $jscomp.getGlobal(this);
$jscomp.polyfill = function(c, n, t, z) {
    if (n) {
        t = $jscomp.global;
        c = c.split(".");
        for (z = 0; z < c.length - 1; z++) {
            var A = c[z];
            A in t || (t[A] = {});
            t = t[A];
        }
        c = c[c.length - 1];
        z = t[c];
        n = n(z);
        n != z &&
            null != n &&
            $jscomp.defineProperty(t, c, {
                configurable: !0,
                writable: !0,
                value: n
            });
    }
};
$jscomp.polyfill(
    "Array.prototype.find",
    function(c) {
        return c
            ? c
            : function(c, t) {
                  return $jscomp.findInternal(this, c, t).v;
              };
    },
    "es6",
    "es3"
);
(function(c) {
    c.fn.tableExport = function(n) {
        function t(b) {
            var d = [];
            A(b, "thead").each(function() {
                d.push.apply(d, A(c(this), a.theadSelector).toArray());
            });
            return d;
        }
        function z(b) {
            var d = [];
            A(b, "tbody").each(function() {
                d.push.apply(d, A(c(this), a.tbodySelector).toArray());
            });
            a.tfootSelector.length &&
                A(b, "tfoot").each(function() {
                    d.push.apply(d, A(c(this), a.tfootSelector).toArray());
                });
            return d;
        }
        function A(b, d) {
            var a = b[0].tagName,
                h = b.parents(a).length;
            return b.find(d).filter(function() {
                return (
                    h ===
                    c(this)
                        .closest(a)
                        .parents(a).length
                );
            });
        }
        function R(b) {
            var d = [];
            c(b)
                .find("thead")
                .first()
                .find("th")
                .each(function(b, a) {
                    void 0 !== c(a).attr("data-field")
                        ? (d[b] = c(a).attr("data-field"))
                        : (d[b] = b.toString());
                });
            return d;
        }
        function I(b) {
            var d = "undefined" !== typeof b[0].rowIndex,
                a = !1 === d && "undefined" !== typeof b[0].cellIndex,
                h = a || d ? Ia(b) : b.is(":visible"),
                f = b.attr("data-tableexport-display");
            a &&
                "none" !== f &&
                "always" !== f &&
                ((b = c(b[0].parentNode)),
                (d = "undefined" !== typeof b[0].rowIndex),
                (f = b.attr("data-tableexport-display")));
            d &&
                "none" !== f &&
                "always" !== f &&
                (f = b.closest("table").attr("data-tableexport-display"));
            return "none" !== f && (!0 === h || "always" === f);
        }
        function Ia(b) {
            var d = [];
            U &&
                (d = H.filter(function() {
                    var d = !1;
                    this.nodeType === b[0].nodeType &&
                        ("undefined" !== typeof this.rowIndex &&
                        this.rowIndex === b[0].rowIndex
                            ? (d = !0)
                            : "undefined" !== typeof this.cellIndex &&
                              this.cellIndex === b[0].cellIndex &&
                              "undefined" !== typeof this.parentNode.rowIndex &&
                              "undefined" !== typeof b[0].parentNode.rowIndex &&
                              this.parentNode.rowIndex ===
                                  b[0].parentNode.rowIndex &&
                              (d = !0));
                    return d;
                }));
            return !1 === U || 0 === d.length;
        }
        function sa(b, d, e) {
            var h = !1;
            I(b)
                ? 0 < a.ignoreColumn.length &&
                  (-1 !== c.inArray(e, a.ignoreColumn) ||
                      -1 !== c.inArray(e - d, a.ignoreColumn) ||
                      (S.length > e &&
                          "undefined" !== typeof S[e] &&
                          -1 !== c.inArray(S[e], a.ignoreColumn))) &&
                  (h = !0)
                : (h = !0);
            return h;
        }
        function B(b, d, e, h, f) {
            if ("function" === typeof f) {
                var l = !1;
                "function" === typeof a.onIgnoreRow &&
                    (l = a.onIgnoreRow(c(b), e));
                if (
                    !1 === l &&
                    (0 === a.ignoreRow.length ||
                        (-1 === c.inArray(e, a.ignoreRow) &&
                            -1 === c.inArray(e - h, a.ignoreRow))) &&
                    I(c(b))
                ) {
                    var m = A(c(b), d),
                        r = 0;
                    m.each(function(b) {
                        var d = c(this),
                            a,
                            h = N(this),
                            l = T(this);
                        c.each(E, function() {
                            if (
                                e >= this.s.r &&
                                e <= this.e.r &&
                                r >= this.s.c &&
                                r <= this.e.c
                            )
                                for (a = 0; a <= this.e.c - this.s.c; ++a)
                                    f(null, e, r++);
                        });
                        if (!1 === sa(d, m.length, b)) {
                            if (l || h)
                                (h = h || 1),
                                    E.push({
                                        s: { r: e, c: r },
                                        e: { r: e + (l || 1) - 1, c: r + h - 1 }
                                    });
                            f(this, e, r++);
                        }
                        if (h) for (a = 0; a < h - 1; ++a) f(null, e, r++);
                    });
                    c.each(E, function() {
                        if (
                            e >= this.s.r &&
                            e <= this.e.r &&
                            r >= this.s.c &&
                            r <= this.e.c
                        )
                            for (ba = 0; ba <= this.e.c - this.s.c; ++ba)
                                f(null, e, r++);
                    });
                }
            }
        }
        function ta(b, d, a, h) {
            if (
                "undefined" !== typeof h.images &&
                ((a = h.images[a]), "undefined" !== typeof a)
            ) {
                d = d.getBoundingClientRect();
                var e = b.width / b.height,
                    c = d.width / d.height,
                    m = b.width,
                    r = b.height,
                    x = 19.049976 / 25.4,
                    g = 0;
                c <= e
                    ? ((r = Math.min(b.height, d.height)),
                      (m = (d.width * r) / d.height))
                    : c > e &&
                      ((m = Math.min(b.width, d.width)),
                      (r = (d.height * m) / d.width));
                m *= x;
                r *= x;
                r < b.height && (g = (b.height - r) / 2);
                try {
                    h.doc.addImage(a.src, b.textPos.x, b.y + g, m, r);
                } catch (Oa) {}
                b.textPos.x += m;
            }
        }
        function ua(b, d) {
            if ("string" === a.outputMode) return b.output();
            if ("base64" === a.outputMode) return J(b.output());
            if ("window" === a.outputMode)
                (window.URL = window.URL || window.webkitURL),
                    window.open(window.URL.createObjectURL(b.output("blob")));
            else
                try {
                    var e = b.output("blob");
                    saveAs(e, a.fileName + ".pdf");
                } catch (h) {
                    ia(
                        a.fileName + ".pdf",
                        "data:application/pdf" + (d ? "" : ";base64") + ",",
                        d ? b.output("blob") : b.output()
                    );
                }
        }
        function va(b, d, a) {
            var e = 0;
            "undefined" !== typeof a && (e = a.colspan);
            if (0 <= e) {
                for (
                    var f = b.width,
                        c = b.textPos.x,
                        m = d.table.columns.indexOf(d.column),
                        r = 1;
                    r < e;
                    r++
                )
                    f += d.table.columns[m + r].width;
                1 < e &&
                    ("right" === b.styles.halign
                        ? (c = b.textPos.x + f - b.width)
                        : "center" === b.styles.halign &&
                          (c = b.textPos.x + (f - b.width) / 2));
                b.width = f;
                b.textPos.x = c;
                "undefined" !== typeof a &&
                    1 < a.rowspan &&
                    (b.height *= a.rowspan);
                if (
                    "middle" === b.styles.valign ||
                    "bottom" === b.styles.valign
                )
                    (a =
                        ("string" === typeof b.text
                            ? b.text.split(/\r\n|\r|\n/g)
                            : b.text
                        ).length || 1),
                        2 < a &&
                            (b.textPos.y -=
                                (((2 - 1.15) / 2) *
                                    d.row.styles.fontSize *
                                    (a - 2)) /
                                3);
                return !0;
            }
            return !1;
        }
        function wa(b, d, a) {
            "undefined" !== typeof b &&
                null !== b &&
                (b.hasAttribute("data-tableexport-canvas")
                    ? ((d = new Date().getTime()),
                      c(b).attr("data-tableexport-canvas", d),
                      (a.images[d] = {
                          url: '[data-tableexport-canvas="' + d + '"]',
                          src: null
                      }))
                    : "undefined" !== d &&
                      null != d &&
                      d.each(function() {
                          if (c(this).is("img")) {
                              var d = xa(this.src);
                              a.images[d] = { url: this.src, src: this.src };
                          }
                          wa(b, c(this).children(), a);
                      }));
        }
        function Ja(b, d) {
            function a(b) {
                if (b.url)
                    if (b.src) {
                        var a = new Image();
                        h = ++f;
                        a.crossOrigin = "Anonymous";
                        a.onerror = a.onload = function() {
                            if (
                                a.complete &&
                                (0 === a.src.indexOf("data:image/") &&
                                    ((a.width = b.width || a.width || 0),
                                    (a.height = b.height || a.height || 0)),
                                a.width + a.height)
                            ) {
                                var e = document.createElement("canvas"),
                                    c = e.getContext("2d");
                                e.width = a.width;
                                e.height = a.height;
                                c.drawImage(a, 0, 0);
                                b.src = e.toDataURL("image/png");
                            }
                            --f || d(h);
                        };
                        a.src = b.url;
                    } else {
                        var e = c(b.url);
                        e.length &&
                            ((h = ++f),
                            html2canvas(e[0]).then(function(a) {
                                b.src = a.toDataURL("image/png");
                                --f || d(h);
                            }));
                    }
            }
            var h = 0,
                f = 0;
            if ("undefined" !== typeof b.images)
                for (var l in b.images)
                    b.images.hasOwnProperty(l) && a(b.images[l]);
            (b = f) || (d(h), (b = void 0));
            return b;
        }
        function ya(b, d, e) {
            d.each(function() {
                if (c(this).is("div")) {
                    var d = ca(K(this, "background-color"), [255, 255, 255]),
                        f = ca(K(this, "border-top-color"), [0, 0, 0]),
                        l = da(this, "border-top-width", a.jspdf.unit),
                        m = this.getBoundingClientRect(),
                        r = this.offsetLeft * e.wScaleFactor,
                        x = this.offsetTop * e.hScaleFactor,
                        g = m.width * e.wScaleFactor;
                    m = m.height * e.hScaleFactor;
                    e.doc.setDrawColor.apply(void 0, f);
                    e.doc.setFillColor.apply(void 0, d);
                    e.doc.setLineWidth(l);
                    e.doc.rect(b.x + r, b.y + x, g, m, l ? "FD" : "F");
                } else c(this).is("img") && ((d = xa(this.src)), ta(b, this, d, e));
                ya(b, c(this).children(), e);
            });
        }
        function za(b, d, e) {
            if ("function" === typeof e.onAutotableText)
                e.onAutotableText(e.doc, b, d);
            else {
                var h = b.textPos.x,
                    f = b.textPos.y,
                    l = { halign: b.styles.halign, valign: b.styles.valign };
                if (d.length) {
                    for (d = d[0]; d.previousSibling; ) d = d.previousSibling;
                    for (var m = !1, r = !1; d; ) {
                        var x = d.innerText || d.textContent || "",
                            g = x.length && " " === x[0] ? " " : "",
                            k =
                                1 < x.length && " " === x[x.length - 1]
                                    ? " "
                                    : "";
                        !0 !== a.preserve.leadingWS && (x = g + ja(x));
                        !0 !== a.preserve.trailingWS && (x = ka(x) + k);
                        c(d).is("br") &&
                            ((h = b.textPos.x),
                            (f += e.doc.internal.getFontSize()));
                        c(d).is("b") ? (m = !0) : c(d).is("i") && (r = !0);
                        (m || r) &&
                            e.doc.setFontType(
                                m && r ? "bolditalic" : m ? "bold" : "italic"
                            );
                        if (
                            (g =
                                e.doc.getStringUnitWidth(x) *
                                e.doc.internal.getFontSize())
                        ) {
                            "linebreak" === b.styles.overflow &&
                                h > b.textPos.x &&
                                h + g > b.textPos.x + b.width &&
                                (0 <= ".,!%*;:=-".indexOf(x.charAt(0)) &&
                                    ((k = x.charAt(0)),
                                    (g =
                                        e.doc.getStringUnitWidth(k) *
                                        e.doc.internal.getFontSize()),
                                    h + g <= b.textPos.x + b.width &&
                                        (e.doc.autoTableText(k, h, f, l),
                                        (x = x.substring(1, x.length))),
                                    (g =
                                        e.doc.getStringUnitWidth(x) *
                                        e.doc.internal.getFontSize())),
                                (h = b.textPos.x),
                                (f += e.doc.internal.getFontSize()));
                            if ("visible" !== b.styles.overflow)
                                for (
                                    ;
                                    x.length && h + g > b.textPos.x + b.width;

                                )
                                    (x = x.substring(0, x.length - 1)),
                                        (g =
                                            e.doc.getStringUnitWidth(x) *
                                            e.doc.internal.getFontSize());
                            e.doc.autoTableText(x, h, f, l);
                            h += g;
                        }
                        if (m || r)
                            c(d).is("b") ? (m = !1) : c(d).is("i") && (r = !1),
                                e.doc.setFontType(
                                    m || r ? (m ? "bold" : "italic") : "normal"
                                );
                        d = d.nextSibling;
                    }
                    b.textPos.x = h;
                    b.textPos.y = f;
                } else e.doc.autoTableText(b.text, b.textPos.x, b.textPos.y, l);
            }
        }
        function ea(b, a, e) {
            return null == b
                ? ""
                : b
                      .toString()
                      .replace(
                          new RegExp(
                              null == a
                                  ? ""
                                  : a
                                        .toString()
                                        .replace(
                                            /([.*+?^=!:${}()|\[\]\/\\])/g,
                                            "\\$1"
                                        ),
                              "g"
                          ),
                          e
                      );
        }
        function ja(b) {
            return null == b ? "" : b.toString().replace(/^\s+/, "");
        }
        function ka(b) {
            return null == b ? "" : b.toString().replace(/\s+$/, "");
        }
        function la(b) {
            b = ea(b || "0", a.numbers.html.thousandsSeparator, "");
            b = ea(b, a.numbers.html.decimalMark, ".");
            return "number" === typeof b || !1 !== jQuery.isNumeric(b) ? b : !1;
        }
        function Ka(b) {
            -1 < b.indexOf("%")
                ? ((b = la(b.replace(/%/g, ""))), !1 !== b && (b /= 100))
                : (b = !1);
            return b;
        }
        function D(b, d, e) {
            var h = "";
            if (null !== b) {
                var f = c(b);
                if (f[0].hasAttribute("data-tableexport-canvas")) var l = "";
                else if (f[0].hasAttribute("data-tableexport-value"))
                    l = (l = f.attr("data-tableexport-value")) ? l + "" : "";
                else if (
                    ((l = f.html()), "function" === typeof a.onCellHtmlData)
                )
                    l = a.onCellHtmlData(f, d, e, l);
                else if ("" !== l) {
                    var m = c.parseHTML(l),
                        r = 0,
                        g = 0;
                    l = "";
                    c.each(m, function() {
                        if (c(this).is("input"))
                            l += f
                                .find("input")
                                .eq(r++)
                                .val();
                        else if (c(this).is("select"))
                            l += f
                                .find("select option:selected")
                                .eq(g++)
                                .text();
                        else if (c(this).is("br")) l += "<br>";
                        else if ("undefined" === typeof c(this).html())
                            l += c(this).text();
                        else if (
                            void 0 === jQuery().bootstrapTable ||
                            (!1 === c(this).hasClass("fht-cell") &&
                                !1 === c(this).hasClass("filterControl") &&
                                0 === f.parents(".detail-view").length)
                        )
                            l += c(this).html();
                    });
                }
                if (!0 === a.htmlContent) h = c.trim(l);
                else if (l && "" !== l)
                    if ("" !== c(b).attr("data-tableexport-cellformat")) {
                        var k = l
                            .replace(/\n/g, "\u2028")
                            .replace(/(<\s*br([^>]*)>)/gi, "\u2060");
                        m = c("<div/>")
                            .html(k)
                            .contents();
                        b = !1;
                        k = "";
                        c.each(m.text().split("\u2028"), function(b, d) {
                            0 < b && (k += " ");
                            !0 !== a.preserve.leadingWS && (d = ja(d));
                            k += !0 !== a.preserve.trailingWS ? ka(d) : d;
                        });
                        c.each(k.split("\u2060"), function(b, d) {
                            0 < b && (h += "\n");
                            !0 !== a.preserve.leadingWS && (d = ja(d));
                            !0 !== a.preserve.trailingWS && (d = ka(d));
                            h += d.replace(/\u00AD/g, "");
                        });
                        h = h.replace(/\u00A0/g, " ");
                        if (
                            "json" === a.type ||
                            ("excel" === a.type &&
                                "xmlss" === a.mso.fileFormat) ||
                            !1 === a.numbers.output
                        )
                            (b = la(h)), !1 !== b && (h = Number(b));
                        else if (
                            a.numbers.html.decimalMark !==
                                a.numbers.output.decimalMark ||
                            a.numbers.html.thousandsSeparator !==
                                a.numbers.output.thousandsSeparator
                        )
                            if (((b = la(h)), !1 !== b)) {
                                m = ("" + b.substr(0 > b ? 1 : 0)).split(".");
                                1 === m.length && (m[1] = "");
                                var n = 3 < m[0].length ? m[0].length % 3 : 0;
                                h =
                                    (0 > b ? "-" : "") +
                                    (a.numbers.output.thousandsSeparator
                                        ? (n
                                              ? m[0].substr(0, n) +
                                                a.numbers.output
                                                    .thousandsSeparator
                                              : "") +
                                          m[0]
                                              .substr(n)
                                              .replace(
                                                  /(\d{3})(?=\d)/g,
                                                  "$1" +
                                                      a.numbers.output
                                                          .thousandsSeparator
                                              )
                                        : m[0]) +
                                    (m[1].length
                                        ? a.numbers.output.decimalMark + m[1]
                                        : "");
                            }
                    } else h = l;
                !0 === a.escape && (h = escape(h));
                "function" === typeof a.onCellData &&
                    (h = a.onCellData(f, d, e, h));
            }
            return h;
        }
        function Aa(b) {
            return 0 < b.length &&
                !0 === a.preventInjection &&
                0 <= "=+-@".indexOf(b.charAt(0))
                ? "'" + b
                : b;
        }
        function La(b, a, e) {
            return a + "-" + e.toLowerCase();
        }
        function ca(b, a) {
            (b = /^rgb\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3})\)$/.exec(b)) &&
                (a = [parseInt(b[1]), parseInt(b[2]), parseInt(b[3])]);
            return a;
        }
        function Ba(b) {
            var a = K(b, "text-align"),
                e = K(b, "font-weight"),
                c = K(b, "font-style"),
                f = "";
            "start" === a &&
                (a = "rtl" === K(b, "direction") ? "right" : "left");
            700 <= e && (f = "bold");
            "italic" === c && (f += c);
            "" === f && (f = "normal");
            a = {
                style: {
                    align: a,
                    bcolor: ca(K(b, "background-color"), [255, 255, 255]),
                    color: ca(K(b, "color"), [0, 0, 0]),
                    fstyle: f
                },
                colspan: N(b),
                rowspan: T(b)
            };
            null !== b &&
                ((b = b.getBoundingClientRect()),
                (a.rect = { width: b.width, height: b.height }));
            return a;
        }
        function N(b) {
            var a = c(b).attr("data-tableexport-colspan");
            "undefined" === typeof a &&
                c(b).is("[colspan]") &&
                (a = c(b).attr("colspan"));
            return parseInt(a) || 0;
        }
        function T(b) {
            var a = c(b).attr("data-tableexport-rowspan");
            "undefined" === typeof a &&
                c(b).is("[rowspan]") &&
                (a = c(b).attr("rowspan"));
            return parseInt(a) || 0;
        }
        function K(b, a) {
            try {
                return window.getComputedStyle
                    ? ((a = a.replace(/([a-z])([A-Z])/, La)),
                      window.getComputedStyle(b, null).getPropertyValue(a))
                    : b.currentStyle
                    ? b.currentStyle[a]
                    : b.style[a];
            } catch (e) {}
            return "";
        }
        function da(b, a, e) {
            a = K(b, a).match(/\d+/);
            if (null !== a) {
                a = a[0];
                b = b.parentElement;
                var d = document.createElement("div");
                d.style.overflow = "hidden";
                d.style.visibility = "hidden";
                b.appendChild(d);
                d.style.width = 100 + e;
                e = 100 / d.offsetWidth;
                b.removeChild(d);
                return a * e;
            }
            return 0;
        }
        function Ma(b) {
            for (
                var a = new ArrayBuffer(b.length), e = new Uint8Array(a), c = 0;
                c !== b.length;
                ++c
            )
                e[c] = b.charCodeAt(c) & 255;
            return a;
        }
        function ma(b) {
            var a = b.c,
                c = "";
            for (++a; a; a = Math.floor((a - 1) / 26))
                c = String.fromCharCode(((a - 1) % 26) + 65) + c;
            return c + ("" + (b.r + 1));
        }
        function na(b, a) {
            if ("undefined" === typeof a || "number" === typeof a)
                return na(b.s, b.e);
            "string" !== typeof b && (b = ma(b));
            "string" !== typeof a && (a = ma(a));
            return b === a ? b : b + ":" + a;
        }
        function Ca(b) {
            var a = Number(b);
            if (!isNaN(a)) return a;
            var c = 1;
            b = b
                .replace(/([\d]),([\d])/g, "$1$2")
                .replace(/[$]/g, "")
                .replace(/[%]/g, function() {
                    c *= 100;
                    return "";
                });
            if (!isNaN((a = Number(b)))) return a / c;
            b = b.replace(/[(](.*)[)]/, function(a, b) {
                c = -c;
                return b;
            });
            return isNaN((a = Number(b))) ? a : a / c;
        }
        function Na(a, d) {
            var b = new Date("2017-02-19T19:06:09.000Z");
            isNaN(b.getFullYear()) && (b = new Date("2/19/17"));
            var c = new Date(a);
            if (2017 === b.getFullYear())
                return (
                    0 < d
                        ? c.setTime(c.getTime() + 6e4 * c.getTimezoneOffset())
                        : 0 > d &&
                          c.setTime(c.getTime() - 6e4 * c.getTimezoneOffset()),
                    c
                );
            if (a instanceof Date) return a;
            if (1917 === b.getFullYear() && !isNaN(c.getFullYear())) {
                d = c.getFullYear();
                if (-1 < a.indexOf("" + d)) return c;
                c.setFullYear(c.getFullYear() + 100);
                return c;
            }
            c = a.match(/\d+/g) || "2017 2 19 0 0 0".split(" ");
            c = new Date(
                +c[0],
                +c[1] - 1,
                +c[2],
                +c[3] || 0,
                +c[4] || 0,
                +c[5] || 0
            );
            -1 < a.indexOf("Z") &&
                (c = new Date(c.getTime() - 6e4 * c.getTimezoneOffset()));
            return c;
        }
        function xa(a) {
            var b = 0,
                c;
            if (0 === a.length) return b;
            var h = 0;
            for (c = a.length; h < c; h++) {
                var f = a.charCodeAt(h);
                b = (b << 5) - b + f;
                b |= 0;
            }
            return b;
        }
        function L(b, c, e, h, f, l) {
            var d = !0;
            "function" === typeof a.onBeforeSaveToFile &&
                ((d = a.onBeforeSaveToFile(b, c, e, h, f)),
                "boolean" !== typeof d && (d = !0));
            if (d)
                try {
                    if (
                        ((Da = new Blob([b], { type: e + ";charset=" + h })),
                        saveAs(Da, c, !1 === l),
                        "function" === typeof a.onAfterSaveToFile)
                    )
                        a.onAfterSaveToFile(b, c);
                } catch (r) {
                    ia(
                        c,
                        "data:" +
                            e +
                            (h.length ? ";charset=" + h : "") +
                            (f.length ? ";" + f : "") +
                            "," +
                            (l ? "\ufeff" : ""),
                        b
                    );
                }
        }
        function ia(b, c, e) {
            var d = window.navigator.userAgent;
            if (!1 !== b && window.navigator.msSaveOrOpenBlob)
                window.navigator.msSaveOrOpenBlob(new Blob([e]), b);
            else if (
                !1 !== b &&
                (0 < d.indexOf("MSIE ") || d.match(/Trident.*rv\:11\./))
            ) {
                if ((c = document.createElement("iframe"))) {
                    document.body.appendChild(c);
                    c.setAttribute("style", "display:none");
                    c.contentDocument.open("txt/plain", "replace");
                    c.contentDocument.write(e);
                    c.contentDocument.close();
                    c.contentWindow.focus();
                    switch (b.substr(b.lastIndexOf(".") + 1)) {
                        case "doc":
                        case "json":
                        case "png":
                        case "pdf":
                        case "xls":
                        case "xlsx":
                            b += ".txt";
                    }
                    c.contentDocument.execCommand("SaveAs", !0, b);
                    document.body.removeChild(c);
                }
            } else {
                var f = document.createElement("a");
                if (f) {
                    var l = null;
                    f.style.display = "none";
                    !1 !== b ? (f.download = b) : (f.target = "_blank");
                    "object" === typeof e
                        ? ((window.URL = window.URL || window.webkitURL),
                          (d = []),
                          d.push(e),
                          (l = window.URL.createObjectURL(
                              new Blob(d, { type: c })
                          )),
                          (f.href = l))
                        : 0 <= c.toLowerCase().indexOf("base64,")
                        ? (f.href = c + J(e))
                        : (f.href = c + encodeURIComponent(e));
                    document.body.appendChild(f);
                    if (document.createEvent)
                        null === fa &&
                            (fa = document.createEvent("MouseEvents")),
                            fa.initEvent("click", !0, !1),
                            f.dispatchEvent(fa);
                    else if (document.createEventObject) f.fireEvent("onclick");
                    else if ("function" === typeof f.onclick) f.onclick();
                    setTimeout(function() {
                        l && window.URL.revokeObjectURL(l);
                        document.body.removeChild(f);
                        if ("function" === typeof a.onAfterSaveToFile)
                            a.onAfterSaveToFile(e, b);
                    }, 100);
                }
            }
        }
        function J(a) {
            var b,
                c = "",
                h = 0;
            if ("string" === typeof a) {
                a = a.replace(/\x0d\x0a/g, "\n");
                var f = "";
                for (b = 0; b < a.length; b++) {
                    var l = a.charCodeAt(b);
                    128 > l
                        ? (f += String.fromCharCode(l))
                        : (127 < l && 2048 > l
                              ? (f += String.fromCharCode((l >> 6) | 192))
                              : ((f += String.fromCharCode((l >> 12) | 224)),
                                (f += String.fromCharCode(
                                    ((l >> 6) & 63) | 128
                                ))),
                          (f += String.fromCharCode((l & 63) | 128)));
                }
                a = f;
            }
            for (; h < a.length; ) {
                var m = a.charCodeAt(h++);
                f = a.charCodeAt(h++);
                b = a.charCodeAt(h++);
                l = m >> 2;
                m = ((m & 3) << 4) | (f >> 4);
                var r = ((f & 15) << 2) | (b >> 6);
                var g = b & 63;
                isNaN(f) ? (r = g = 64) : isNaN(b) && (g = 64);
                c =
                    c +
                    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=".charAt(
                        l
                    ) +
                    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=".charAt(
                        m
                    ) +
                    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=".charAt(
                        r
                    ) +
                    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=".charAt(
                        g
                    );
            }
            return c;
        }
        var a = {
                csvEnclosure: '"',
                csvSeparator: ",",
                csvUseBOM: !0,
                displayTableName: !1,
                escape: !1,
                exportHiddenCells: !1,
                fileName: "tableExport",
                htmlContent: !1,
                ignoreColumn: [],
                ignoreRow: [],
                jsonScope: "all",
                jspdf: {
                    orientation: "p",
                    unit: "pt",
                    format: "a4",
                    margins: { left: 20, right: 10, top: 10, bottom: 10 },
                    onDocCreated: null,
                    autotable: {
                        styles: {
                            cellPadding: 2,
                            rowHeight: 12,
                            fontSize: 8,
                            fillColor: 255,
                            textColor: 50,
                            fontStyle: "normal",
                            overflow: "ellipsize",
                            halign: "inherit",
                            valign: "middle"
                        },
                        headerStyles: {
                            fillColor: [52, 73, 94],
                            textColor: 255,
                            fontStyle: "bold",
                            halign: "inherit",
                            valign: "middle"
                        },
                        alternateRowStyles: { fillColor: 245 },
                        tableExport: {
                            doc: null,
                            onAfterAutotable: null,
                            onBeforeAutotable: null,
                            onAutotableText: null,
                            onTable: null,
                            outputImages: !0
                        }
                    }
                },
                mso: {
                    fileFormat: "xlshtml",
                    onMsoNumberFormat: null,
                    pageFormat: "a4",
                    pageOrientation: "portrait",
                    rtl: !1,
                    styles: [],
                    worksheetName: ""
                },
                numbers: {
                    html: { decimalMark: ".", thousandsSeparator: "," },
                    output: { decimalMark: ".", thousandsSeparator: "," }
                },
                onAfterSaveToFile: null,
                onBeforeSaveToFile: null,
                onCellData: null,
                onCellHtmlData: null,
                onIgnoreRow: null,
                outputMode: "file",
                pdfmake: {
                    enabled: !1,
                    docDefinition: {
                        pageOrientation: "portrait",
                        defaultStyle: { font: "Roboto" }
                    },
                    fonts: {}
                },
                preserve: { leadingWS: !1, trailingWS: !1 },
                preventInjection: !0,
                sql: { tableEnclosure: "`", columnEnclosure: "`" },
                tbodySelector: "tr",
                tfootSelector: "tr",
                theadSelector: "tr",
                tableName: "Table",
                type: "csv"
            },
            M = {
                a0: [2383.94, 3370.39],
                a1: [1683.78, 2383.94],
                a2: [1190.55, 1683.78],
                a3: [841.89, 1190.55],
                a4: [595.28, 841.89],
                a5: [419.53, 595.28],
                a6: [297.64, 419.53],
                a7: [209.76, 297.64],
                a8: [147.4, 209.76],
                a9: [104.88, 147.4],
                a10: [73.7, 104.88],
                b0: [2834.65, 4008.19],
                b1: [2004.09, 2834.65],
                b2: [1417.32, 2004.09],
                b3: [1000.63, 1417.32],
                b4: [708.66, 1000.63],
                b5: [498.9, 708.66],
                b6: [354.33, 498.9],
                b7: [249.45, 354.33],
                b8: [175.75, 249.45],
                b9: [124.72, 175.75],
                b10: [87.87, 124.72],
                c0: [2599.37, 3676.54],
                c1: [1836.85, 2599.37],
                c2: [1298.27, 1836.85],
                c3: [918.43, 1298.27],
                c4: [649.13, 918.43],
                c5: [459.21, 649.13],
                c6: [323.15, 459.21],
                c7: [229.61, 323.15],
                c8: [161.57, 229.61],
                c9: [113.39, 161.57],
                c10: [79.37, 113.39],
                dl: [311.81, 623.62],
                letter: [612, 792],
                "government-letter": [576, 756],
                legal: [612, 1008],
                "junior-legal": [576, 360],
                ledger: [1224, 792],
                tabloid: [792, 1224],
                "credit-card": [153, 243]
            },
            y = this,
            fa = null,
            u = [],
            v = [],
            q = 0,
            p = "",
            S = [],
            E = [],
            Da,
            H = [],
            U = !1;
        c.extend(!0, a, n);
        "xlsx" === a.type && ((a.mso.fileFormat = a.type), (a.type = "excel"));
        "undefined" !== typeof a.excelFileFormat &&
            "undefined" === a.mso.fileFormat &&
            (a.mso.fileFormat = a.excelFileFormat);
        "undefined" !== typeof a.excelPageFormat &&
            "undefined" === a.mso.pageFormat &&
            (a.mso.pageFormat = a.excelPageFormat);
        "undefined" !== typeof a.excelPageOrientation &&
            "undefined" === a.mso.pageOrientation &&
            (a.mso.pageOrientation = a.excelPageOrientation);
        "undefined" !== typeof a.excelRTL &&
            "undefined" === a.mso.rtl &&
            (a.mso.rtl = a.excelRTL);
        "undefined" !== typeof a.excelstyles &&
            "undefined" === a.mso.styles &&
            (a.mso.styles = a.excelstyles);
        "undefined" !== typeof a.onMsoNumberFormat &&
            "undefined" === a.mso.onMsoNumberFormat &&
            (a.mso.onMsoNumberFormat = a.onMsoNumberFormat);
        "undefined" !== typeof a.worksheetName &&
            "undefined" === a.mso.worksheetName &&
            (a.mso.worksheetName = a.worksheetName);
        a.mso.pageOrientation =
            "l" === a.mso.pageOrientation.substr(0, 1)
                ? "landscape"
                : "portrait";
        S = R(y);
        if ("csv" === a.type || "tsv" === a.type || "txt" === a.type) {
            var O = "",
                X = 0;
            E = [];
            q = 0;
            var oa = function(b, d, e) {
                b.each(function() {
                    p = "";
                    B(this, d, q, e + b.length, function(b, c, d) {
                        var f = p,
                            e = "";
                        if (null !== b)
                            if (
                                ((b = D(b, c, d)),
                                (c =
                                    null === b || "" === b ? "" : b.toString()),
                                "tsv" === a.type)
                            )
                                b instanceof Date && b.toLocaleString(),
                                    (e = ea(c, "\t", " "));
                            else if (b instanceof Date)
                                e =
                                    a.csvEnclosure +
                                    b.toLocaleString() +
                                    a.csvEnclosure;
                            else if (
                                ((e = Aa(c)),
                                (e = ea(
                                    e,
                                    a.csvEnclosure,
                                    a.csvEnclosure + a.csvEnclosure
                                )),
                                0 <= e.indexOf(a.csvSeparator) ||
                                    /[\r\n ]/g.test(e))
                            )
                                e = a.csvEnclosure + e + a.csvEnclosure;
                        p =
                            f +
                            (e + ("tsv" === a.type ? "\t" : a.csvSeparator));
                    });
                    p = c.trim(p).substring(0, p.length - 1);
                    0 < p.length && (0 < O.length && (O += "\n"), (O += p));
                    q++;
                });
                return b.length;
            };
            X += oa(
                c(y)
                    .find("thead")
                    .first()
                    .find(a.theadSelector),
                "th,td",
                X
            );
            A(c(y), "tbody").each(function() {
                X += oa(A(c(this), a.tbodySelector), "td,th", X);
            });
            a.tfootSelector.length &&
                oa(
                    c(y)
                        .find("tfoot")
                        .first()
                        .find(a.tfootSelector),
                    "td,th",
                    X
                );
            O += "\n";
            if ("string" === a.outputMode) return O;
            if ("base64" === a.outputMode) return J(O);
            if ("window" === a.outputMode) {
                ia(
                    !1,
                    "data:text/" +
                        ("csv" === a.type ? "csv" : "plain") +
                        ";charset=utf-8,",
                    O
                );
                return;
            }
            L(
                O,
                a.fileName + "." + a.type,
                "text/" + ("csv" === a.type ? "csv" : "plain"),
                "utf-8",
                "",
                "csv" === a.type && a.csvUseBOM
            );
        } else if ("sql" === a.type) {
            q = 0;
            E = [];
            var w =
                "INSERT INTO " +
                a.sql.tableEnclosure +
                a.tableName +
                a.sql.tableEnclosure +
                " (";
            u = t(c(y));
            c(u).each(function() {
                B(this, "th,td", q, u.length, function(b, c, e) {
                    w +=
                        a.sql.columnEnclosure +
                        D(b, c, e) +
                        a.sql.columnEnclosure +
                        ",";
                });
                q++;
                w = c.trim(w).substring(0, w.length - 1);
            });
            w += ") VALUES ";
            v = z(c(y));
            c(v).each(function() {
                p = "";
                B(this, "td,th", q, u.length + v.length, function(a, c, e) {
                    p += "'" + D(a, c, e) + "',";
                });
                3 < p.length &&
                    ((w += "(" + p),
                    (w = c.trim(w).substring(0, w.length - 1)),
                    (w += "),"));
                q++;
            });
            w = c.trim(w).substring(0, w.length - 1);
            w += ";";
            if ("string" === a.outputMode) return w;
            if ("base64" === a.outputMode) return J(w);
            L(w, a.fileName + ".sql", "application/sql", "utf-8", "", !1);
        } else if ("json" === a.type) {
            var V = [];
            E = [];
            u = t(c(y));
            c(u).each(function() {
                var a = [];
                B(this, "th,td", q, u.length, function(b, c, h) {
                    a.push(D(b, c, h));
                });
                V.push(a);
            });
            var pa = [];
            v = z(c(y));
            c(v).each(function() {
                var a = {},
                    d = 0;
                B(this, "td,th", q, u.length + v.length, function(b, c, f) {
                    V.length
                        ? (a[V[V.length - 1][d]] = D(b, c, f))
                        : (a[d] = D(b, c, f));
                    d++;
                });
                !1 === c.isEmptyObject(a) && pa.push(a);
                q++;
            });
            n = "";
            n =
                "head" === a.jsonScope
                    ? JSON.stringify(V)
                    : "data" === a.jsonScope
                    ? JSON.stringify(pa)
                    : JSON.stringify({ header: V, data: pa });
            if ("string" === a.outputMode) return n;
            if ("base64" === a.outputMode) return J(n);
            L(
                n,
                a.fileName + ".json",
                "application/json",
                "utf-8",
                "base64",
                !1
            );
        } else if ("xml" === a.type) {
            q = 0;
            E = [];
            var P = '<?xml version="1.0" encoding="utf-8"?>';
            P += "<tabledata><fields>";
            u = t(c(y));
            c(u).each(function() {
                B(this, "th,td", q, u.length, function(a, c, e) {
                    P += "<field>" + D(a, c, e) + "</field>";
                });
                q++;
            });
            P += "</fields><data>";
            var qa = 1;
            v = z(c(y));
            c(v).each(function() {
                var a = 1;
                p = "";
                B(this, "td,th", q, u.length + v.length, function(b, c, h) {
                    p +=
                        "<column-" +
                        a +
                        ">" +
                        D(b, c, h) +
                        "</column-" +
                        a +
                        ">";
                    a++;
                });
                0 < p.length &&
                    "<column-1></column-1>" !== p &&
                    ((P += '<row id="' + qa + '">' + p + "</row>"), qa++);
                q++;
            });
            P += "</data></tabledata>";
            if ("string" === a.outputMode) return P;
            if ("base64" === a.outputMode) return J(P);
            L(P, a.fileName + ".xml", "application/xml", "utf-8", "base64", !1);
        } else if ("excel" === a.type && "xmlss" === a.mso.fileFormat) {
            var ra = [],
                F = [];
            c(y)
                .filter(function() {
                    return I(c(this));
                })
                .each(function() {
                    function b(a, b, d) {
                        var e = [];
                        c(a).each(function() {
                            var b = 0,
                                f = 0;
                            p = "";
                            B(this, "td,th", q, d + a.length, function(
                                a,
                                d,
                                l
                            ) {
                                if (null !== a) {
                                    var h = "";
                                    d = D(a, d, l);
                                    l = "String";
                                    if (!1 !== jQuery.isNumeric(d))
                                        l = "Number";
                                    else {
                                        var m = Ka(d);
                                        !1 !== m &&
                                            ((d = m),
                                            (l = "Number"),
                                            (h += ' ss:StyleID="pct1"'));
                                    }
                                    "Number" !== l &&
                                        (d = d.replace(/\n/g, "<br>"));
                                    m = N(a);
                                    a = T(a);
                                    c.each(e, function() {
                                        if (
                                            q >= this.s.r &&
                                            q <= this.e.r &&
                                            f >= this.s.c &&
                                            f <= this.e.c
                                        )
                                            for (
                                                var a = 0;
                                                a <= this.e.c - this.s.c;
                                                ++a
                                            )
                                                f++, b++;
                                    });
                                    if (a || m)
                                        (a = a || 1),
                                            (m = m || 1),
                                            e.push({
                                                s: { r: q, c: f },
                                                e: {
                                                    r: q + a - 1,
                                                    c: f + m - 1
                                                }
                                            });
                                    1 < m &&
                                        ((h +=
                                            ' ss:MergeAcross="' +
                                            (m - 1) +
                                            '"'),
                                        (f += m - 1));
                                    1 < a &&
                                        (h +=
                                            ' ss:MergeDown="' +
                                            (a - 1) +
                                            '" ss:StyleID="rsp1"');
                                    0 < b &&
                                        ((h += ' ss:Index="' + (f + 1) + '"'),
                                        (b = 0));
                                    p +=
                                        "<Cell" +
                                        h +
                                        '><Data ss:Type="' +
                                        l +
                                        '">' +
                                        c("<div />")
                                            .text(d)
                                            .html() +
                                        "</Data></Cell>\r";
                                    f++;
                                }
                            });
                            0 < p.length &&
                                (G +=
                                    '<Row ss:AutoFitHeight="0">\r' +
                                    p +
                                    "</Row>\r");
                            q++;
                        });
                        return a.length;
                    }
                    var d = c(this),
                        e = "";
                    "string" === typeof a.mso.worksheetName &&
                    a.mso.worksheetName.length
                        ? (e = a.mso.worksheetName + " " + (F.length + 1))
                        : "undefined" !==
                              typeof a.mso.worksheetName[F.length] &&
                          (e = a.mso.worksheetName[F.length]);
                    e.length || (e = d.find("caption").text() || "");
                    e.length || (e = "Table " + (F.length + 1));
                    e = c.trim(
                        e.replace(/[\\\/[\]*:?'"]/g, "").substring(0, 31)
                    );
                    F.push(
                        c("<div />")
                            .text(e)
                            .html()
                    );
                    !1 === a.exportHiddenCells &&
                        ((H = d.find("tr, th, td").filter(":hidden")),
                        (U = 0 < H.length));
                    q = 0;
                    S = R(this);
                    G = "<Table>\r";
                    e = b(t(d), "th,td", 0);
                    b(z(d), "td,th", e);
                    G += "</Table>\r";
                    ra.push(G);
                });
            n = {};
            for (var C = {}, k, Q, W = 0, ba = F.length; W < ba; W++)
                (k = F[W]),
                    (Q = n[k]),
                    (Q = n[k] = null == Q ? 1 : Q + 1),
                    2 === Q && (F[C[k]] = F[C[k]].substring(0, 29) + "-1"),
                    1 < n[k]
                        ? (F[W] = F[W].substring(0, 29) + "-" + n[k])
                        : (C[k] = W);
            n =
                '<?xml version="1.0" encoding="UTF-8"?>\r<?mso-application progid="Excel.Sheet"?>\r<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"\r xmlns:o="urn:schemas-microsoft-com:office:office"\r xmlns:x="urn:schemas-microsoft-com:office:excel"\r xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"\r xmlns:html="http://www.w3.org/TR/REC-html40">\r<DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">\r  <Created>' +
                new Date().toISOString() +
                '</Created>\r</DocumentProperties>\r<OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">\r  <AllowPNG/>\r</OfficeDocumentSettings>\r<ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">\r  <WindowHeight>9000</WindowHeight>\r  <WindowWidth>13860</WindowWidth>\r  <WindowTopX>0</WindowTopX>\r  <WindowTopY>0</WindowTopY>\r  <ProtectStructure>False</ProtectStructure>\r  <ProtectWindows>False</ProtectWindows>\r</ExcelWorkbook>\r<Styles>\r  <Style ss:ID="Default" ss:Name="Normal">\r    <Alignment ss:Vertical="Bottom"/>\r    <Borders/>\r    <Font/>\r    <Interior/>\r    <NumberFormat/>\r    <Protection/>\r  </Style>\r  <Style ss:ID="rsp1">\r    <Alignment ss:Vertical="Center"/>\r  </Style>\r  <Style ss:ID="pct1">\r    <NumberFormat ss:Format="Percent"/>\r  </Style>\r</Styles>\r';
            for (C = 0; C < ra.length; C++)
                (n +=
                    '<Worksheet ss:Name="' +
                    F[C] +
                    '" ss:RightToLeft="' +
                    (a.mso.rtl ? "1" : "0") +
                    '">\r' +
                    ra[C]),
                    (n = a.mso.rtl
                        ? n +
                          '<WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">\r<DisplayRightToLeft/>\r</WorksheetOptions>\r'
                        : n +
                          '<WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel"/>\r'),
                    (n += "</Worksheet>\r");
            n += "</Workbook>\r";
            if ("string" === a.outputMode) return n;
            if ("base64" === a.outputMode) return J(n);
            L(n, a.fileName + ".xml", "application/xml", "utf-8", "base64", !1);
        } else if ("excel" === a.type && "xlsx" === a.mso.fileFormat) {
            var Y = [],
                Ea = XLSX.utils.book_new();
            c(y)
                .filter(function() {
                    return I(c(this));
                })
                .each(function() {
                    for (
                        var b = c(this),
                            d = {},
                            e = this.getElementsByTagName("tr"),
                            h = { s: { r: 0, c: 0 }, e: { r: 0, c: 0 } },
                            f = [],
                            l,
                            m = [],
                            g = 0,
                            k = 0,
                            n,
                            p,
                            u,
                            v,
                            t;
                        g < e.length && 1e7 > k;
                        ++g
                    )
                        if (
                            ((n = e[g]),
                            (p = !1),
                            "function" === typeof a.onIgnoreRow &&
                                (p = a.onIgnoreRow(c(n), g)),
                            !1 === p &&
                                -1 === c.inArray(q, a.ignoreRow) &&
                                -1 === c.inArray(q - qa, a.ignoreRow) &&
                                I(c(n)))
                        ) {
                            var y = n.children,
                                A = 0;
                            for (n = 0; n < y.length; ++n)
                                (t = y[n]), (v = +N(t) || 1), (A += v);
                            var z = 0;
                            for (n = p = 0; n < y.length; ++n)
                                if (
                                    ((t = y[n]),
                                    (v = +N(t) || 1),
                                    (l = n + z),
                                    !sa(c(t), A, l + (l < p ? p - l : 0)))
                                ) {
                                    z += v - 1;
                                    for (l = 0; l < f.length; ++l) {
                                        var w = f[l];
                                        w.s.c == p &&
                                            w.s.r <= k &&
                                            k <= w.e.r &&
                                            ((p = w.e.c + 1), (l = -1));
                                    }
                                    (0 < (u = +T(t)) || 1 < v) &&
                                        f.push({
                                            s: { r: k, c: p },
                                            e: {
                                                r: k + (u || 1) - 1,
                                                c: p + v - 1
                                            }
                                        });
                                    l = D(t, g, n + z);
                                    w = { t: "s", v: l };
                                    t = t.getAttribute("t") || "";
                                    if (null != l)
                                        if (0 == l.length) w.t = t || "z";
                                        else if (
                                            0 != l.trim().length &&
                                            "s" != t
                                        )
                                            if ("TRUE" === l)
                                                w = { t: "b", v: !0 };
                                            else if ("FALSE" === l)
                                                w = { t: "b", v: !1 };
                                            else if (isNaN(Ca(l))) {
                                                t = isNaN;
                                                var B = l;
                                                var C = new Date(B),
                                                    F = new Date(NaN),
                                                    E = C.getFullYear(),
                                                    G = C.getMonth(),
                                                    H = C.getDate();
                                                B =
                                                    isNaN(H) ||
                                                    0 > E ||
                                                    8099 < E
                                                        ? F
                                                        : ((0 < G || 1 < H) &&
                                                              101 != E) ||
                                                          B.toLowerCase().match(
                                                              /jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec/
                                                          )
                                                        ? C
                                                        : B.match(
                                                              /[^-0-9:,\/\\]/
                                                          )
                                                        ? F
                                                        : C;
                                                t(B.getDate()) ||
                                                    (w = {
                                                        t: "d",
                                                        v: Na(l),
                                                        z: "yyyymmdd"
                                                    });
                                            } else w = { t: "n", v: Ca(l) };
                                    d[ma({ c: p, r: k })] = w;
                                    h.e.c < p && (h.e.c = p);
                                    p += v;
                                }
                            ++k;
                        }
                    f.length && (d["!merges"] = f);
                    m.length && (d["!rows"] = m);
                    h.e.r = k - 1;
                    d["!ref"] = na(h);
                    1e7 <= k &&
                        (d["!fullref"] = na(
                            ((h.e.r = e.length - g + k - 1), h)
                        ));
                    e = "";
                    "string" === typeof a.mso.worksheetName &&
                    a.mso.worksheetName.length
                        ? (e = a.mso.worksheetName + " " + (Y.length + 1))
                        : "undefined" !==
                              typeof a.mso.worksheetName[Y.length] &&
                          (e = a.mso.worksheetName[Y.length]);
                    e.length || (e = b.find("caption").text() || "");
                    e.length || (e = "Table " + (Y.length + 1));
                    e = c.trim(
                        e.replace(/[\\\/[\]*:?'"]/g, "").substring(0, 31)
                    );
                    Y.push(e);
                    XLSX.utils.book_append_sheet(Ea, d, e);
                });
            n = XLSX.write(Ea, {
                type: "binary",
                bookType: a.mso.fileFormat,
                bookSST: !1
            });
            L(
                Ma(n),
                a.fileName + "." + a.mso.fileFormat,
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                "UTF-8",
                "",
                !1
            );
        } else if (
            "excel" === a.type ||
            "xls" === a.type ||
            "word" === a.type ||
            "doc" === a.type
        ) {
            n = "excel" === a.type || "xls" === a.type ? "excel" : "word";
            C = "excel" === n ? "xls" : "doc";
            k = 'xmlns:x="urn:schemas-microsoft-com:office:' + n + '"';
            var G = "",
                Z = "";
            c(y)
                .filter(function() {
                    return I(c(this));
                })
                .each(function() {
                    var b = c(this);
                    "" === Z &&
                        ((Z =
                            a.mso.worksheetName ||
                            b.find("caption").text() ||
                            "Table"),
                        (Z = c.trim(
                            Z.replace(/[\\\/[\]*:?'"]/g, "").substring(0, 31)
                        )));
                    !1 === a.exportHiddenCells &&
                        ((H = b.find("tr, th, td").filter(":hidden")),
                        (U = 0 < H.length));
                    q = 0;
                    E = [];
                    S = R(this);
                    G += "<table><thead>";
                    u = t(b);
                    c(u).each(function() {
                        var b = c(this);
                        p = "";
                        B(this, "th,td", q, u.length, function(c, d, f) {
                            if (null !== c) {
                                var e = "";
                                p += "<th";
                                if (a.mso.styles.length) {
                                    var m = document.defaultView.getComputedStyle(
                                            c,
                                            null
                                        ),
                                        h = document.defaultView.getComputedStyle(
                                            b[0],
                                            null
                                        ),
                                        g;
                                    for (g in a.mso.styles) {
                                        var k = m[a.mso.styles[g]];
                                        "" === k && (k = h[a.mso.styles[g]]);
                                        "" !== k &&
                                            "0px none rgb(0, 0, 0)" !== k &&
                                            "rgba(0, 0, 0, 0)" !== k &&
                                            ((e += "" === e ? 'style="' : ";"),
                                            (e += a.mso.styles[g] + ":" + k));
                                    }
                                }
                                "" !== e && (p += " " + e + '"');
                                e = N(c);
                                0 < e && (p += ' colspan="' + e + '"');
                                e = T(c);
                                0 < e && (p += ' rowspan="' + e + '"');
                                p += ">" + D(c, d, f) + "</th>";
                            }
                        });
                        0 < p.length && (G += "<tr>" + p + "</tr>");
                        q++;
                    });
                    G += "</thead><tbody>";
                    v = z(b);
                    c(v).each(function() {
                        var b = c(this);
                        p = "";
                        B(this, "td,th", q, u.length + v.length, function(
                            d,
                            g,
                            f
                        ) {
                            if (null !== d) {
                                var e = D(d, g, f),
                                    m = "",
                                    h = c(d).attr(
                                        "data-tableexport-msonumberformat"
                                    );
                                "undefined" === typeof h &&
                                    "function" ===
                                        typeof a.mso.onMsoNumberFormat &&
                                    (h = a.mso.onMsoNumberFormat(d, g, f));
                                "undefined" !== typeof h &&
                                    "" !== h &&
                                    (m =
                                        "style=\"mso-number-format:'" +
                                        h +
                                        "'");
                                if (a.mso.styles.length) {
                                    g = document.defaultView.getComputedStyle(
                                        d,
                                        null
                                    );
                                    f = document.defaultView.getComputedStyle(
                                        b[0],
                                        null
                                    );
                                    for (var k in a.mso.styles)
                                        (h = g[a.mso.styles[k]]),
                                            "" === h &&
                                                (h = f[a.mso.styles[k]]),
                                            "" !== h &&
                                                "0px none rgb(0, 0, 0)" !== h &&
                                                "rgba(0, 0, 0, 0)" !== h &&
                                                ((m +=
                                                    "" === m ? 'style="' : ";"),
                                                (m +=
                                                    a.mso.styles[k] + ":" + h));
                                }
                                p += "<td";
                                "" !== m && (p += " " + m + '"');
                                m = N(d);
                                0 < m && (p += ' colspan="' + m + '"');
                                d = T(d);
                                0 < d && (p += ' rowspan="' + d + '"');
                                "string" === typeof e &&
                                    "" !== e &&
                                    ((e = Aa(e)),
                                    (e = e.replace(/\n/g, "<br>")));
                                p += ">" + e + "</td>";
                            }
                        });
                        0 < p.length && (G += "<tr>" + p + "</tr>");
                        q++;
                    });
                    a.displayTableName &&
                        (G +=
                            "<tr><td></td></tr><tr><td></td></tr><tr><td>" +
                            D(c("<p>" + a.tableName + "</p>")) +
                            "</td></tr>");
                    G += "</tbody></table>";
                });
            k =
                '<html xmlns:o="urn:schemas-microsoft-com:office:office" ' +
                k +
                ' xmlns="http://www.w3.org/TR/REC-html40">' +
                ('<meta http-equiv="content-type" content="application/vnd.ms-' +
                    n +
                    '; charset=UTF-8">');
            k += "<head>";
            "excel" === n &&
                ((k += "\x3c!--[if gte mso 9]>"),
                (k += "<xml>"),
                (k += "<x:ExcelWorkbook>"),
                (k += "<x:ExcelWorksheets>"),
                (k += "<x:ExcelWorksheet>"),
                (k += "<x:Name>"),
                (k += Z),
                (k += "</x:Name>"),
                (k += "<x:WorksheetOptions>"),
                (k += "<x:DisplayGridlines/>"),
                a.mso.rtl && (k += "<x:DisplayRightToLeft/>"),
                (k += "</x:WorksheetOptions>"),
                (k += "</x:ExcelWorksheet>"),
                (k += "</x:ExcelWorksheets>"),
                (k += "</x:ExcelWorkbook>"),
                (k += "</xml>"),
                (k += "<![endif]--\x3e"));
            k += "<style>";
            k +=
                "@page { size:" +
                a.mso.pageOrientation +
                "; mso-page-orientation:" +
                a.mso.pageOrientation +
                "; }";
            k +=
                "@page Section1 {size:" +
                M[a.mso.pageFormat][0] +
                "pt " +
                M[a.mso.pageFormat][1] +
                "pt";
            k +=
                "; margin:1.0in 1.25in 1.0in 1.25in;mso-header-margin:.5in;mso-footer-margin:.5in;mso-paper-source:0;}";
            k += "div.Section1 {page:Section1;}";
            k +=
                "@page Section2 {size:" +
                M[a.mso.pageFormat][1] +
                "pt " +
                M[a.mso.pageFormat][0] +
                "pt";
            k +=
                ";mso-page-orientation:" +
                a.mso.pageOrientation +
                ";margin:1.25in 1.0in 1.25in 1.0in;mso-header-margin:.5in;mso-footer-margin:.5in;mso-paper-source:0;}";
            k += "div.Section2 {page:Section2;}";
            k += "br {mso-data-placement:same-cell;}";
            k += "</style>";
            k += "</head>";
            k += "<body>";
            k +=
                '<div class="Section' +
                ("landscape" === a.mso.pageOrientation ? "2" : "1") +
                '">';
            k += G;
            k += "</div>";
            k += "</body>";
            k += "</html>";
            if ("string" === a.outputMode) return k;
            if ("base64" === a.outputMode) return J(k);
            L(
                k,
                a.fileName + "." + C,
                "application/vnd.ms-" + n,
                "",
                "base64",
                !1
            );
        } else if ("png" === a.type)
            html2canvas(c(y)[0]).then(function(b) {
                b = b.toDataURL();
                for (
                    var c = atob(b.substring(22)),
                        e = new ArrayBuffer(c.length),
                        h = new Uint8Array(e),
                        f = 0;
                    f < c.length;
                    f++
                )
                    h[f] = c.charCodeAt(f);
                if ("string" === a.outputMode) return c;
                if ("base64" === a.outputMode) return J(b);
                "window" === a.outputMode
                    ? window.open(b)
                    : L(e, a.fileName + ".png", "image/png", "", "", !1);
            });
        else if ("pdf" === a.type)
            if (!0 === a.pdfmake.enabled) {
                n = [];
                var Fa = [];
                q = 0;
                E = [];
                C = function(a, d, e) {
                    var b = 0;
                    c(a).each(function() {
                        var a = [];
                        B(this, d, q, e, function(b, c, d) {
                            if ("undefined" !== typeof b && null !== b) {
                                var e = N(b),
                                    f = T(b);
                                b = D(b, c, d) || " ";
                                1 < e || 1 < f
                                    ? a.push({
                                          colSpan: e || 1,
                                          rowSpan: f || 1,
                                          text: b
                                      })
                                    : a.push(b);
                            } else a.push(" ");
                        });
                        a.length && Fa.push(a);
                        b < a.length && (b = a.length);
                        q++;
                    });
                    return b;
                };
                u = t(c(this));
                k = C(u, "th,td", u.length);
                for (Q = n.length; Q < k; Q++) n.push("*");
                v = z(c(this));
                C(v, "th,td", u.length + v.length);
                n = {
                    content: [
                        { table: { headerRows: u.length, widths: n, body: Fa } }
                    ]
                };
                c.extend(!0, n, a.pdfmake.docDefinition);
                pdfMake.fonts = {
                    Roboto: {
                        normal: "Roboto-Regular.ttf",
                        bold: "Roboto-Medium.ttf",
                        italics: "Roboto-Italic.ttf",
                        bolditalics: "Roboto-MediumItalic.ttf"
                    }
                };
                c.extend(!0, pdfMake.fonts, a.pdfmake.fonts);
                pdfMake.createPdf(n).getBuffer(function(b) {
                    L(b, a.fileName + ".pdf", "application/pdf", "", "", !1);
                });
            } else if (!1 === a.jspdf.autotable) {
                n = {
                    dim: {
                        w: da(
                            c(y)
                                .first()
                                .get(0),
                            "width",
                            "mm"
                        ),
                        h: da(
                            c(y)
                                .first()
                                .get(0),
                            "height",
                            "mm"
                        )
                    },
                    pagesplit: !1
                };
                var Ga = new jsPDF(
                    a.jspdf.orientation,
                    a.jspdf.unit,
                    a.jspdf.format
                );
                Ga.addHTML(
                    c(y).first(),
                    a.jspdf.margins.left,
                    a.jspdf.margins.top,
                    n,
                    function() {
                        ua(Ga, !1);
                    }
                );
            } else {
                var g = a.jspdf.autotable.tableExport;
                if (
                    "string" === typeof a.jspdf.format &&
                    "bestfit" === a.jspdf.format.toLowerCase()
                ) {
                    var ha = "",
                        aa = "",
                        Ha = 0;
                    c(y).each(function() {
                        if (I(c(this))) {
                            var a = da(c(this).get(0), "width", "pt");
                            if (a > Ha) {
                                a > M.a0[0] && ((ha = "a0"), (aa = "l"));
                                for (var d in M)
                                    M.hasOwnProperty(d) &&
                                        M[d][1] > a &&
                                        ((ha = d),
                                        (aa = "l"),
                                        M[d][0] > a && (aa = "p"));
                                Ha = a;
                            }
                        }
                    });
                    a.jspdf.format = "" === ha ? "a4" : ha;
                    a.jspdf.orientation = "" === aa ? "w" : aa;
                }
                if (
                    null == g.doc &&
                    ((g.doc = new jsPDF(
                        a.jspdf.orientation,
                        a.jspdf.unit,
                        a.jspdf.format
                    )),
                    (g.wScaleFactor = 1),
                    (g.hScaleFactor = 1),
                    "function" === typeof a.jspdf.onDocCreated)
                )
                    a.jspdf.onDocCreated(g.doc);
                !0 === g.outputImages && (g.images = {});
                "undefined" !== typeof g.images &&
                    (c(y)
                        .filter(function() {
                            return I(c(this));
                        })
                        .each(function() {
                            var b = 0;
                            E = [];
                            !1 === a.exportHiddenCells &&
                                ((H = c(this)
                                    .find("tr, th, td")
                                    .filter(":hidden")),
                                (U = 0 < H.length));
                            u = t(c(this));
                            v = z(c(this));
                            c(v).each(function() {
                                B(
                                    this,
                                    "td,th",
                                    u.length + b,
                                    u.length + v.length,
                                    function(a) {
                                        wa(a, c(a).children(), g);
                                    }
                                );
                                b++;
                            });
                        }),
                    (u = []),
                    (v = []));
                Ja(g, function() {
                    c(y)
                        .filter(function() {
                            return I(c(this));
                        })
                        .each(function() {
                            var b;
                            q = 0;
                            E = [];
                            !1 === a.exportHiddenCells &&
                                ((H = c(this)
                                    .find("tr, th, td")
                                    .filter(":hidden")),
                                (U = 0 < H.length));
                            S = R(this);
                            g.columns = [];
                            g.rows = [];
                            g.teCells = {};
                            if (
                                "function" === typeof g.onTable &&
                                !1 === g.onTable(c(this), a)
                            )
                                return !0;
                            a.jspdf.autotable.tableExport = null;
                            var d = c.extend(!0, {}, a.jspdf.autotable);
                            a.jspdf.autotable.tableExport = g;
                            d.margin = {};
                            c.extend(!0, d.margin, a.jspdf.margins);
                            d.tableExport = g;
                            "function" !== typeof d.beforePageContent &&
                                (d.beforePageContent = function(a) {
                                    if (1 === a.pageCount) {
                                        var b = a.table.rows.concat(
                                            a.table.headerRow
                                        );
                                        c.each(b, function() {
                                            0 < this.height &&
                                                ((this.height +=
                                                    ((2 - 1.15) / 2) *
                                                    this.styles.fontSize),
                                                (a.table.height +=
                                                    ((2 - 1.15) / 2) *
                                                    this.styles.fontSize));
                                        });
                                    }
                                });
                            "function" !== typeof d.createdHeaderCell &&
                                (d.createdHeaderCell = function(a, b) {
                                    a.styles = c.extend({}, b.row.styles);
                                    if (
                                        "undefined" !==
                                        typeof g.columns[b.column.dataKey]
                                    ) {
                                        var e = g.columns[b.column.dataKey];
                                        if ("undefined" !== typeof e.rect) {
                                            a.contentWidth = e.rect.width;
                                            if (
                                                "undefined" ===
                                                    typeof g.heightRatio ||
                                                0 === g.heightRatio
                                            ) {
                                                var f = b.row.raw[
                                                    b.column.dataKey
                                                ].rowspan
                                                    ? b.row.raw[
                                                          b.column.dataKey
                                                      ].rect.height /
                                                      b.row.raw[
                                                          b.column.dataKey
                                                      ].rowspan
                                                    : b.row.raw[
                                                          b.column.dataKey
                                                      ].rect.height;
                                                g.heightRatio =
                                                    a.styles.rowHeight / f;
                                            }
                                            f =
                                                b.row.raw[b.column.dataKey].rect
                                                    .height * g.heightRatio;
                                            f > a.styles.rowHeight &&
                                                (a.styles.rowHeight = f);
                                        }
                                        a.styles.halign =
                                            "inherit" === d.headerStyles.halign
                                                ? "center"
                                                : d.headerStyles.halign;
                                        a.styles.valign = d.headerStyles.valign;
                                        "undefined" !== typeof e.style &&
                                            !0 !== e.style.hidden &&
                                            ("inherit" ===
                                                d.headerStyles.halign &&
                                                (a.styles.halign =
                                                    e.style.align),
                                            "inherit" === d.styles.fillColor &&
                                                (a.styles.fillColor =
                                                    e.style.bcolor),
                                            "inherit" === d.styles.textColor &&
                                                (a.styles.textColor =
                                                    e.style.color),
                                            "inherit" === d.styles.fontStyle &&
                                                (a.styles.fontStyle =
                                                    e.style.fstyle));
                                    }
                                });
                            "function" !== typeof d.createdCell &&
                                (d.createdCell = function(a, b) {
                                    b =
                                        g.teCells[
                                            b.row.index + ":" + b.column.dataKey
                                        ];
                                    a.styles.halign =
                                        "inherit" === d.styles.halign
                                            ? "center"
                                            : d.styles.halign;
                                    a.styles.valign = d.styles.valign;
                                    "undefined" !== typeof b &&
                                        "undefined" !== typeof b.style &&
                                        !0 !== b.style.hidden &&
                                        ("inherit" === d.styles.halign &&
                                            (a.styles.halign = b.style.align),
                                        "inherit" === d.styles.fillColor &&
                                            (a.styles.fillColor =
                                                b.style.bcolor),
                                        "inherit" === d.styles.textColor &&
                                            (a.styles.textColor =
                                                b.style.color),
                                        "inherit" === d.styles.fontStyle &&
                                            (a.styles.fontStyle =
                                                b.style.fstyle));
                                });
                            "function" !== typeof d.drawHeaderCell &&
                                (d.drawHeaderCell = function(a, b) {
                                    var c = g.columns[b.column.dataKey];
                                    return (!0 !==
                                        c.style.hasOwnProperty("hidden") ||
                                        !0 !== c.style.hidden) &&
                                        0 <= c.rowIndex
                                        ? va(a, b, c)
                                        : !1;
                                });
                            "function" !== typeof d.drawCell &&
                                (d.drawCell = function(a, b) {
                                    var d =
                                        g.teCells[
                                            b.row.index + ":" + b.column.dataKey
                                        ];
                                    if (
                                        !0 !==
                                        ("undefined" !== typeof d && d.isCanvas)
                                    )
                                        va(a, b, d) &&
                                            (g.doc.rect(
                                                a.x,
                                                a.y,
                                                a.width,
                                                a.height,
                                                a.styles.fillStyle
                                            ),
                                            "undefined" !== typeof d &&
                                            "undefined" !== typeof d.elements &&
                                            d.elements.length
                                                ? ((b =
                                                      a.height / d.rect.height),
                                                  b > g.hScaleFactor &&
                                                      (g.hScaleFactor = b),
                                                  (g.wScaleFactor =
                                                      a.width / d.rect.width),
                                                  (b = a.textPos.y),
                                                  ya(a, d.elements, g),
                                                  (a.textPos.y = b),
                                                  za(a, d.elements, g))
                                                : za(a, {}, g));
                                    else {
                                        d = d.elements[0];
                                        var e = c(d).attr(
                                                "data-tableexport-canvas"
                                            ),
                                            f = d.getBoundingClientRect();
                                        a.width = f.width * g.wScaleFactor;
                                        a.height = f.height * g.hScaleFactor;
                                        b.row.height = a.height;
                                        ta(a, d, e, g);
                                    }
                                    return !1;
                                });
                            g.headerrows = [];
                            u = t(c(this));
                            c(u).each(function() {
                                b = 0;
                                g.headerrows[q] = [];
                                B(this, "th,td", q, u.length, function(
                                    a,
                                    c,
                                    d
                                ) {
                                    var e = Ba(a);
                                    e.title = D(a, c, d);
                                    e.key = b++;
                                    e.rowIndex = q;
                                    g.headerrows[q].push(e);
                                });
                                q++;
                            });
                            if (0 < q)
                                for (var e = q - 1; 0 <= e; )
                                    c.each(g.headerrows[e], function() {
                                        var a = this;
                                        0 < e &&
                                            null === this.rect &&
                                            (a = g.headerrows[e - 1][this.key]);
                                        null !== a &&
                                            0 <= a.rowIndex &&
                                            (!0 !==
                                                a.style.hasOwnProperty(
                                                    "hidden"
                                                ) ||
                                                !0 !== a.style.hidden) &&
                                            g.columns.push(a);
                                    }),
                                        (e = 0 < g.columns.length ? -1 : e - 1);
                            var h = 0;
                            v = [];
                            v = z(c(this));
                            c(v).each(function() {
                                var a = [];
                                b = 0;
                                B(
                                    this,
                                    "td,th",
                                    q,
                                    u.length + v.length,
                                    function(d, e, f) {
                                        if (
                                            "undefined" === typeof g.columns[b]
                                        ) {
                                            var k = {
                                                title: "",
                                                key: b,
                                                style: { hidden: !0 }
                                            };
                                            g.columns.push(k);
                                        }
                                        "undefined" !== typeof d && null !== d
                                            ? ((k = Ba(d)),
                                              (k.isCanvas = d.hasAttribute(
                                                  "data-tableexport-canvas"
                                              )),
                                              (k.elements = k.isCanvas
                                                  ? c(d)
                                                  : c(d).children()))
                                            : ((k = c.extend(
                                                  !0,
                                                  {},
                                                  g.teCells[h + ":" + (b - 1)]
                                              )),
                                              (k.colspan = -1));
                                        g.teCells[h + ":" + b++] = k;
                                        a.push(D(d, e, f));
                                    }
                                );
                                a.length && (g.rows.push(a), h++);
                                q++;
                            });
                            if ("function" === typeof g.onBeforeAutotable)
                                g.onBeforeAutotable(
                                    c(this),
                                    g.columns,
                                    g.rows,
                                    d
                                );
                            g.doc.autoTable(g.columns, g.rows, d);
                            if ("function" === typeof g.onAfterAutotable)
                                g.onAfterAutotable(c(this), d);
                            a.jspdf.autotable.startY =
                                g.doc.autoTableEndPosY() + d.margin.top;
                        });
                    ua(
                        g.doc,
                        "undefined" !== typeof g.images &&
                            !1 === jQuery.isEmptyObject(g.images)
                    );
                    "undefined" !== typeof g.headerrows &&
                        (g.headerrows.length = 0);
                    "undefined" !== typeof g.columns && (g.columns.length = 0);
                    "undefined" !== typeof g.rows && (g.rows.length = 0);
                    delete g.doc;
                    g.doc = null;
                });
            }
        return this;
    };
})(jQuery);
