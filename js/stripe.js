! function(n) { var r = {};

    function o(e) { if (r[e]) return r[e].exports; var t = r[e] = { i: e, l: !1, exports: {} }; return n[e].call(t.exports, t, t.exports, o), t.l = !0, t.exports }
    o.m = n, o.c = r, o.d = function(e, t, n) { o.o(e, t) || Object.defineProperty(e, t, { enumerable: !0, get: n }) }, o.r = function(e) { "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(e, "__esModule", { value: !0 }) }, o.t = function(t, e) { if (1 & e && (t = o(t)), 8 & e) return t; if (4 & e && "object" == typeof t && t && t.__esModule) return t; var n = Object.create(null); if (o.r(n), Object.defineProperty(n, "default", { enumerable: !0, value: t }), 2 & e && "string" != typeof t)
            for (var r in t) o.d(n, r, function(e) { return t[e] }.bind(null, r)); return n }, o.n = function(e) { var t = e && e.__esModule ? function() { return e.default } : function() { return e }; return o.d(t, "a", t), t }, o.o = function(e, t) { return Object.prototype.hasOwnProperty.call(e, t) }, o.p = "", o(o.s = 4) }([function(e, t, n) { "use strict";
    n.d(t, "a", function() { return r }); var r = function(e, t) { throw new Error(1 < arguments.length && void 0 !== t ? t : "absurd") } }, function(e, t, n) { "use strict"; var c = n(5);
    e.exports = c; var r = l(!0),
        o = l(!1),
        i = l(null),
        a = l(void 0),
        s = l(0),
        u = l("");

    function l(e) { var t = new c(c._61); return t._81 = 1, t._65 = e, t }
    c.resolve = function(e) { if (e instanceof c) return e; if (null === e) return i; if (void 0 === e) return a; if (!0 === e) return r; if (!1 === e) return o; if (0 === e) return s; if ("" === e) return u; if ("object" == typeof e || "function" == typeof e) try { var t = e.then; if ("function" == typeof t) return new c(t.bind(e)) } catch (n) { return new c(function(e, t) { t(n) }) }
        return l(e) }, c.all = function(e) { var s = Array.prototype.slice.call(e); return new c(function(o, i) { if (0 === s.length) return o([]); var a = s.length; for (var e = 0; e < s.length; e++) ! function t(n, e) { if (e && ("object" == typeof e || "function" == typeof e)) { if (e instanceof c && e.then === c.prototype.then) { for (; 3 === e._81;) e = e._65; return 1 === e._81 ? t(n, e._65) : (2 === e._81 && i(e._65), void e.then(function(e) { t(n, e) }, i)) } var r = e.then; if ("function" == typeof r) return void new c(r.bind(e)).then(function(e) { t(n, e) }, i) }
                s[n] = e, 0 == --a && o(s) }(e, s[e]) }) }, c.reject = function(n) { return new c(function(e, t) { t(n) }) }, c.race = function(e) { return new c(function(t, n) { e.forEach(function(e) { c.resolve(e).then(t, n) }) }) }, c.prototype.catch = function(e) { return this.then(null, e) } }, function(t, n, e) { var r;! function() { "use strict"; var e = function() {
            function a() {}

            function s(e, t) { for (var n = t.length, r = 0; r < n; ++r) ! function(e, t) { if (!t) return; var n = typeof t; "string" == n ? function(e, t) { for (var n = t.split(i), r = n.length, o = 0; o < r; ++o) e[n[o]] = !0 }(e, t) : Array.isArray(t) ? s(e, t) : "object" == n ? function(e, t) { for (var n in t) o.call(t, n) && (e[n] = !!t[n]) }(e, t) : "number" == n && (e[t] = !0) }(e, t[r]) }
            a.prototype = Object.create(null); var o = {}.hasOwnProperty; var i = /\s+/; return function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; var r = new a;
                s(r, t); var o, i = []; for (o in r) r[o] && i.push(o); return i.join(" ") } }();
        t.exports ? t.exports = e : void 0 === (r = function() { return e }.apply(n, [])) || (t.exports = r) }() }, function(e, t) { e.exports = function(e) { return "_" + e.split("").map(function(e) { return e.charCodeAt(0) }).reduce(function(e, t) { return (e << 5) - e + t & (e << 5) - e + t }, 0).toString().replace(/[-.]/g, "_") } }, function(e, t, n) { e.exports = n(13) }, function(e, t, n) { "use strict"; var o = n(6);

    function a() {} var i = null,
        s = {};

    function c(e) { if ("object" != typeof this) throw new TypeError("Promises must be constructed via new"); if ("function" != typeof e) throw new TypeError("not a function");
        this._45 = 0, this._81 = 0, this._65 = null, this._54 = null, e !== a && f(e, this) }

    function u(e, t) { for (; 3 === e._81;) e = e._65; if (c._10 && c._10(e), 0 === e._81) return 0 === e._45 ? (e._45 = 1, void(e._54 = t)) : 1 === e._45 ? (e._45 = 2, void(e._54 = [e._54, t])) : void e._54.push(t); var n, r;
        n = e, r = t, o(function() { var e, t = 1 === n._81 ? r.onFulfilled : r.onRejected;
            null !== t ? (e = function(e, t) { try { return e(t) } catch (e) { return i = e, s } }(t, n._65)) === s ? p(r.promise, i) : l(r.promise, e) : (1 === n._81 ? l : p)(r.promise, n._65) }) }

    function l(e, t) { if (t === e) return p(e, new TypeError("A promise cannot be resolved with itself.")), 0; if (t && ("object" == typeof t || "function" == typeof t)) { var n = function(e) { try { return e.then } catch (e) { return i = e, s } }(t); if (n === s) return p(e, i), 0; if (n === e.then && t instanceof c) return e._81 = 3, e._65 = t, void r(e); if ("function" == typeof n) return void f(n.bind(t), e) }
        e._81 = 1, e._65 = t, r(e) }

    function p(e, t) { e._81 = 2, e._65 = t, c._97 && c._97(e, t), r(e) }

    function r(e) { if (1 === e._45 && (u(e, e._54), e._54 = null), 2 === e._45) { for (var t = 0; t < e._54.length; t++) u(e, e._54[t]);
            e._54 = null } }

    function d(e, t, n) { this.onFulfilled = "function" == typeof e ? e : null, this.onRejected = "function" == typeof t ? t : null, this.promise = n }

    function f(e, t) { var n = !1,
            r = function(e, t, n) { try { e(t, n) } catch (e) { return i = e, s } }(e, function(e) { n || (n = !0, l(t, e)) }, function(e) { n || (n = !0, p(t, e)) });
        n || r !== s || (n = !0, p(t, i)) }(e.exports = c)._10 = null, c._97 = null, c._61 = a, c.prototype.then = function(e, t) { if (this.constructor !== c) return o = e, i = t, new(r = this).constructor(function(e, t) { var n = new c(a);
            n.then(e, t), u(r, new d(o, i, n)) }); var r, o, i, n = new c(a); return u(this, new d(e, t, n)), n } }, function(d, e, t) { "use strict";
    (function(e) {
        function t(e) { r.length || (n(), 0), r[r.length] = e }
        d.exports = t; var n, r = [],
            o = 0;

        function i() { for (; o < r.length;) { var e = o; if (o += 1, r[e].call(), 1024 < o) { for (var t = 0, n = r.length - o; t < n; t++) r[t] = r[t + o];
                    r.length -= o, o = 0 } }
            r.length = 0, o = 0, 0 } var a, s, c, u = void 0 !== e ? e : self,
            l = u.MutationObserver || u.WebKitMutationObserver;

        function p(r) { return function() { var e = setTimeout(n, 0),
                    t = setInterval(n, 50);

                function n() { clearTimeout(e), clearInterval(t), r() } } }
        n = "function" == typeof l ? (a = 1, s = new l(i), c = document.createTextNode(""), s.observe(c, { characterData: !0 }), function() { a = -a, c.data = a }) : p(i), t.requestFlush = n, t.makeRequestCallFromTimer = p }).call(this, t(7)) }, function(e, t) { var n = function() { return this }(); try { n = n || new Function("return this")() } catch (e) { "object" == typeof window && (n = window) }
    e.exports = n }, function(e, t) {}, , , , , function(e, t, n) { "use strict";

    function r(e) {! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, r); var t = function(e, t) { if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return !t || "object" != typeof t && "function" != typeof t ? e : t }(this, (r.__proto__ || Object.getPrototypeOf(r)).call(this, e)); return window.__stripeElementsController && window.__stripeElementsController.reportIntegrationError(e), t.name = "IntegrationError", Object.defineProperty(t, "message", { value: t.message, enumerable: !0 }), t }
    n.r(t); var S = (function(e, t) { if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function, not " + typeof t);
            e.prototype = Object.create(t && t.prototype, { constructor: { value: e, enumerable: !1, writable: !0, configurable: !0 } }), t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t) }(r, Error), r),
        m = n(0),
        o = n(1),
        i = n.n(o),
        E = window.Promise ? Promise : i.a,
        a = function(e, t, n) { return t && s(e.prototype, t), n && s(e, n), e };

    function s(e, t) { for (var n = 0; n < t.length; n++) { var r = t[n];
            r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r) } } var c = Date.now ? function() { return Date.now() } : function() { return (new Date).getTime() },
        u = c(),
        l = window.performance && window.performance.now ? function() { return window.performance.now() } : function() { return c() - u },
        b = (a(p, [{ key: "getAsPosixTime", value: function() { return c() - this.getElapsedTime() } }, { key: "getElapsedTime", value: function(e) { return Math.round((e ? e.timestampValue : l()) - this.timestampValue) } }, { key: "valueOf", value: function() { return Math.round(this.timestampValue) } }], [{ key: "fromPosixTime", value: function(e) { return new p(e - c() + l()) } }]), p);

    function p(e) {! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, p), this.timestampValue = null != e ? e : l() }

    function w(e, t) { for (var n = 0; n < e.length; n++)
            if (t(e[n])) return e[n] }

    function d(e, t) { if ("object" !== (void 0 === e ? "undefined" : f(e)) || "object" !== (void 0 === t ? "undefined" : f(t))) return e === t; if (null === e || null === t) return e === t; var n = Array.isArray(e); if (n !== Array.isArray(t)) return !1; var r = Object.prototype.toString.call(e) === h; if (r != (Object.prototype.toString.call(t) === h)) return !1; if (!r && !n) return !1; var o = Object.keys(e),
            i = Object.keys(t); if (o.length !== i.length) return !1; for (var a = {}, s = 0; s < o.length; s++) a[o[s]] = !0; for (var c = 0; c < i.length; c++) a[i[c]] = !0; var u = Object.keys(a); if (u.length !== o.length) return !1; var l = e,
            p = t; return u.every(function(e) { return d(l[e], p[e]) }) }

    function P(r, o) { var i = 0; return new E(function e(t) { for (var n = new b; i < r.length && n.getElapsedTime() < 50;) o(r[i]), i++;
            i === r.length ? t() : setTimeout(function() { return e(t) }) }) }

    function g(e) { return T.test(e) }

    function k(e) { if (!g(e)) return null; var t = document.createElement("a");
        t.href = e; var n = t.protocol,
            r = t.host,
            o = t.pathname,
            i = /:80$/,
            a = /:443$/; return "http:" === n && i.test(r) ? r = r.replace(i, "") : "https:" === n && a.test(r) && (r = r.replace(a, "")), { host: r, protocol: n, origin: n + "//" + r, path: o } } var f = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) { return typeof e } : function(e) { return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e },
        h = "[object Object]",
        _ = ["aed", "afn", "all", "amd", "ang", "aoa", "ars", "aud", "awg", "azn", "bam", "bbd", "bdt", "bgn", "bhd", "bif", "bmd", "bnd", "bob", "brl", "bsd", "btn", "bwp", "byr", "bzd", "cad", "cdf", "chf", "clf", "clp", "cny", "cop", "crc", "cuc", "cup", "cve", "czk", "djf", "dkk", "dop", "dzd", "egp", "ern", "etb", "eur", "fjd", "fkp", "gbp", "gel", "ghs", "gip", "gmd", "gnf", "gtq", "gyd", "hkd", "hnl", "hrk", "htg", "huf", "idr", "ils", "inr", "iqd", "irr", "isk", "jmd", "jod", "jpy", "kes", "kgs", "khr", "kmf", "kpw", "krw", "kwd", "kyd", "kzt", "lak", "lbp", "lkr", "lrd", "lsl", "ltl", "lvl", "lyd", "mad", "mdl", "mga", "mkd", "mmk", "mnt", "mop", "mro", "mur", "mvr", "mwk", "mxn", "myr", "mzn", "nad", "ngn", "nio", "nok", "npr", "nzd", "omr", "pab", "pen", "pgk", "php", "pkr", "pln", "pyg", "qar", "ron", "rsd", "rub", "rwf", "sar", "sbd", "scr", "sdg", "sek", "sgd", "shp", "skk", "sll", "sos", "srd", "ssp", "std", "svc", "syp", "szl", "thb", "tjs", "tmt", "tnd", "top", "try", "ttd", "twd", "tzs", "uah", "ugx", "usd", "uyu", "uzs", "vef", "vnd", "vuv", "wst", "xaf", "xag", "xau", "xcd", "xdr", "xof", "xpf", "yer", "zar", "zmk", "zmw", "btc", "jep", "eek", "ghc", "mtl", "tmm", "yen", "zwd", "zwl", "zwn", "zwr"],
        y = { AE: "AE", AT: "AT", AU: "AU", BE: "BE", BG: "BG", BR: "BR", CA: "CA", CH: "CH", CI: "CI", CR: "CR", CY: "CY", CZ: "CZ", DE: "DE", DK: "DK", DO: "DO", EE: "EE", ES: "ES", FI: "FI", FR: "FR", GB: "GB", GR: "GR", GT: "GT", HK: "HK", HU: "HU", ID: "ID", IE: "IE", IN: "IN", IT: "IT", JP: "JP", LT: "LT", LU: "LU", LV: "LV", MT: "MT", MX: "MX", MY: "MY", NL: "NL", NO: "NO", NZ: "NZ", PE: "PE", PH: "PH", PL: "PL", PT: "PT", RO: "RO", SE: "SE", SG: "SG", SI: "SI", SK: "SK", SN: "SN", TH: "TH", TT: "TT", US: "US", UY: "UY" },
        v = Object.keys(y),
        O = { live: "live", test: "test", unknown: "unknown" },
        A = function(e) { return /^pk_test_/.test(e) ? O.test : /^pk_live_/.test(e) ? O.live : O.unknown },
        T = /^(http(s)?):\/\//,
        I = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) { return typeof e } : function(e) { return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e },
        C = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e };

    function R(e, t, n) { return t in e ? Object.defineProperty(e, t, { value: n, enumerable: !0, configurable: !0, writable: !0 }) : e[t] = n, e }

    function j(e) { if (Array.isArray(e)) { for (var t = 0, n = Array(e.length); t < e.length; t++) n[t] = e[t]; return n } return Array.from(e) }

    function N(e, t, n) { return "Invalid value for " + n.label + ": " + (n.path.join(".") || "value") + " should be " + e + ". You specified: " + t + "." }

    function M(e, t) { return { type: "valid", value: e, warnings: 1 < arguments.length && void 0 !== t ? t : [] } }

    function x(e) { return { error: e, errorType: "full", type: "error" } }

    function L(e, t, n) { var r = new S(N(e, t, n)); return x(r) }

    function D(e, t, n) { return { expected: e, actual: String(t), options: n, errorType: "mismatch", type: "error" } }

    function B(e, t) { return C({}, e, { path: [].concat(j(e.path), [t]) }) }

    function q(n) { return function(e, t) { return void 0 === e ? M(e) : n(e, t) } }

    function F(v, b) { return function(e, t) {
            function n(e) { var t = e.options.path.join(".") || "value"; return { error: t + " should be " + e.expected, actual: t + " as " + e.actual } }

            function r(e, t, n) { return x(new S("Invalid value for " + e + ": " + t + ". You specified " + n + ".")) } var o = v(e, t),
                i = b(e, t); if ("error" !== o.type || "error" !== i.type) return "valid" === o.type ? o : i; if ("mismatch" === o.errorType && "mismatch" === i.errorType) { var a = n(o),
                    s = a.error,
                    c = a.actual,
                    u = n(i),
                    l = u.error,
                    p = u.actual; return r(t.label, s === l ? s : s + " or " + l, c === p ? c : c + " and " + p) } if ("mismatch" === o.errorType) { var d = n(o),
                    f = d.error,
                    m = d.actual; return r(t.label, f, m) } if ("mismatch" !== i.errorType) return x(o.error); var h = n(i),
                _ = h.error,
                y = h.actual; return r(t.label, _, y) } }

    function U(o, i) { return function(t, e) { var n = w(o, function(e) { return e === t }); if (void 0 !== n) return M(n); var r = i ? "a recognized string." : "one of the following strings: " + o.join(", "); return D(r, t, e) } }

    function H(n) { return function(e, t) { return "string" == typeof e && 0 === e.indexOf(n) ? M(e) : D("a string starting with " + n, e, t) } }

    function z() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return U(t, !1) }

    function G() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return U(t, !0) }

    function Y(e, t) { return "string" == typeof e ? M(e) : D("a string", e, t) }

    function W(n, r) { return function(e, t) { return void 0 === e ? M(r()) : n(e, t) } }

    function K(e, t) { return "boolean" == typeof e ? M(e) : D("a boolean", e, t) }

    function V(e, t) { return "number" == typeof e ? M(e) : D("a number", e, t) }

    function J(n) { return function(e, t) { return "number" == typeof e && n < e ? M(e) : D("a number greater than " + n, e, t) } }

    function $(n) { return function(e, t) { return "number" == typeof e && e === parseInt(e, 10) && (!n || 0 <= e) ? M(e) : D(n ? "a positive amount in the currency's subunit" : "an amount in the currency's subunit", e, t) } }

    function X(e, t) { return $(!1)(e, t) }

    function Z(e, t) { return e && "object" === (void 0 === e ? "undefined" : I(e)) ? M(e) : D("an object", e, t) }

    function Q(r) { return function(e, n) { return Array.isArray(e) ? e.map(function(e, t) { return r(e, B(n, String(t))) }).reduce(function(e, t) { return "error" === e.type ? e : "error" === t.type ? t : M([].concat(j(e.value), [t.value]), [].concat(j(e.warnings), j(t.warnings))) }, M([])) : D("array", e, n) } }

    function ee(u) { return function(c) { return function(e, t) { if (Array.isArray(e)) { var n = c(e, t); if ("valid" === n.type)
                        for (var r = {}, o = 0; o < n.value.length; o += 1) { var i = n.value[o]; if ("object" === (void 0 === i ? "undefined" : I(i)) && i && "string" == typeof i[u]) { var a = i[u],
                                    s = "_" + a; if (r[s]) return x(new S("Duplicate value for " + u + ": " + a + ". The property '" + u + "' of '" + t.path.join(".") + "' has to be unique."));
                                r[s] = !0 } }
                    return n } return D("array", e, t) } } }

    function te(n) { return function(e, t) { return void 0 === e ? M(void 0) : D("used in " + n + " instead", e, t) } }

    function ne(s) { return function(a) { return function(e, r) { if (!e || "object" !== (void 0 === e ? "undefined" : I(e)) || Array.isArray(e)) return D("an object", e, r); var o = e,
                    t = w(Object.keys(o), function(e) { return !a[e] }); if (t && s) return x(new S("Invalid " + r.label + " parameter: " + [].concat(j(r.path), [t]).join(".") + " is not an accepted parameter.")); var n = Object.keys(o),
                    i = M({}); return t && (i = n.reduce(function(e, t) { return a[t] ? e : M(e.value, [].concat(j(e.warnings), ["Unrecognized " + r.label + " parameter: " + [].concat(j(r.path), [t]).join(".") + " is not a recognized parameter. This may cause issues with your integration in the future."])) }, i)), Object.keys(a).reduce(function(e, t) { if ("error" === e.type) return e; var n = (0, a[t])(o[t], B(r, t)); return "valid" === n.type && void 0 !== n.value ? M(C({}, e.value, R({}, t, n.value)), [].concat(j(e.warnings), j(n.warnings))) : "valid" === n.type ? M(e.value, [].concat(j(e.warnings), j(n.warnings))) : n }, i) } } }

    function re(e, t, n, r) { var o = r || {},
            i = e(t, { authenticatedOrigin: o.authenticatedOrigin || "", element: o.element || "", label: n, path: o.path || [] }); return "valid" === i.type || "full" === i.errorType ? i : { type: "error", errorType: "full", error: new S(N(i.expected, i.actual, i.options)) } }

    function oe(e) { return "https://js.stripe.com/v3/" + (e || "") }

    function ie() { var e = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : ""; return e ? (parseInt(e, 10) ^ 16 * Math.random() >> parseInt(e, 10) / 4).toString(16) : "00000000-0000-4000-8000-000000000000".replace(/[08]/g, ie) } var ae = z.apply(void 0, j(v)),
        se = z.apply(void 0, j(_)),
        ce = (z.apply(void 0, j(Object.keys(O))), ne(!0)),
        ue = ne(!1),
        le = function(e, t, n, r) { var o = re(e, t, n, r); switch (o.type) {
                case "valid":
                    return { value: o.value, warnings: o.warnings };
                case "error":
                    throw o.error;
                default:
                    return Object(m.a)(o) } },
        pe = { ADDRESS_AUTOCOMPLETE: "ADDRESS_AUTOCOMPLETE", CARD_ELEMENT: "CARD_ELEMENT", CARD_LIGHT_ELEMENT: "CARD_LIGHT_ELEMENT", CONTROLLER: "CONTROLLER", METRICS_CONTROLLER: "METRICS_CONTROLLER", PAYMENT_REQUEST_ELEMENT: "PAYMENT_REQUEST_ELEMENT", PAYMENT_REQUEST_BROWSER: "PAYMENT_REQUEST_BROWSER", PAYMENT_REQUEST_GOOGLE_PAY: "PAYMENT_REQUEST_GOOGLE_PAY", IBAN_ELEMENT: "IBAN_ELEMENT", IDEAL_BANK_ELEMENT: "IDEAL_BANK_ELEMENT", P24_BANK_ELEMENT: "P24_BANK_ELEMENT", AUTHORIZE_WITH_URL: "AUTHORIZE_WITH_URL", STRIPE_3DS2_CHALLENGE: "STRIPE_3DS2_CHALLENGE", STRIPE_3DS2_FINGERPRINT: "STRIPE_3DS2_FINGERPRINT", AU_BANK_ACCOUNT_ELEMENT: "AU_BANK_ACCOUNT_ELEMENT", FPX_BANK_ELEMENT: "FPX_BANK_ELEMENT", LIGHTBOX_APP: "LIGHTBOX_APP", ISSUING_CARD_NUMBER_DISPLAY_ELEMENT: "ISSUING_CARD_NUMBER_DISPLAY_ELEMENT", ISSUING_CARD_CVC_DISPLAY_ELEMENT: "ISSUING_CARD_CVC_DISPLAY_ELEMENT", ISSUING_CARD_EXPIRY_DISPLAY_ELEMENT: "ISSUING_CARD_EXPIRY_DISPLAY_ELEMENT", EPS_BANK_ELEMENT: "EPS_BANK_ELEMENT", HCAPTCHA_APP: "HCAPTCHA_APP", NETBANKING_BANK_ELEMENT: "NETBANKING_BANK_ELEMENT" },
        de = function(e) { switch (e) {
                case "ADDRESS_AUTOCOMPLETE":
                    return oe("checkout-inner-address-autocomplete-938651a43b44fc27991d65eff362958d.html");
                case "CARD_ELEMENT":
                    return oe("elements-inner-card-d15d70e865ddb6c06fd7bc1aa869a341.html");
                case "CARD_LIGHT_ELEMENT":
                    return oe("elements-inner-card-light-391dc495f934bf33a5f54d5eb95e6992.html");
                case "CONTROLLER":
                    return oe("controller-03968b1875cd75710e0553b31ce244af.html");
                case "METRICS_CONTROLLER":
                    return oe("m-outer-d9e5e2bfda26c81fe55a41963856c287.html");
                case "PAYMENT_REQUEST_ELEMENT":
                    return oe("elements-inner-payment-request-fdd269f42056726c7ce0a27236fc4623.html");
                case "PAYMENT_REQUEST_BROWSER":
                    return oe("payment-request-inner-browser-7dfd29e9a03495b5d98b0cdcf4e61583.html");
                case "PAYMENT_REQUEST_GOOGLE_PAY":
                    return oe("payment-request-inner-google-pay-7f5b4a54aa34448e1e5f3d7b9a7bef0f.html");
                case "IBAN_ELEMENT":
                    return oe("elements-inner-iban-d9a9fc053f91ac5801378a3f9e7ba336.html");
                case "IDEAL_BANK_ELEMENT":
                    return oe("elements-inner-ideal-bank-06b3ef0b4c75c586c508d992ce601e6c.html");
                case "P24_BANK_ELEMENT":
                    return oe("elements-inner-p24-bank-39f2d71b8209932e7ac147c7509ea557.html");
                case "AUTHORIZE_WITH_URL":
                    return oe("authorize-with-url-inner-530f617cf37b25b7f0e7d2b9d07617d6.html");
                case "STRIPE_3DS2_CHALLENGE":
                    return oe("three-ds-2-challenge-2bcd4c597ef5661a5fc7f7f725545a3e.html");
                case "STRIPE_3DS2_FINGERPRINT":
                    return oe("three-ds-2-fingerprint-5df932595701b792ae0790ce7b1b5c73.html");
                case "AU_BANK_ACCOUNT_ELEMENT":
                    return oe("elements-inner-au-bank-account-219cd744412e370f58512543145cd597.html");
                case "FPX_BANK_ELEMENT":
                    return oe("elements-inner-fpx-bank-cf979935b148e6a9142ac5d626422c47.html");
                case "LIGHTBOX_APP":
                    return oe("lightbox-inner-0fba17b51b6487943586aedc89d692e8.html");
                case "ISSUING_CARD_NUMBER_DISPLAY_ELEMENT":
                    return oe("elements-inner-issuing-card-number-display-1dfee0f1dcd8e5c84601c44a2a987f2d.html");
                case "ISSUING_CARD_CVC_DISPLAY_ELEMENT":
                    return oe("elements-inner-issuing-card-cvc-display-7e9a1c88ccd7a1a3c24c3c05c468a893.html");
                case "ISSUING_CARD_EXPIRY_DISPLAY_ELEMENT":
                    return oe("elements-inner-issuing-card-expiry-display-739706a442484067061bca4fcb0bde6e.html");
                case "EPS_BANK_ELEMENT":
                    return oe("elements-inner-eps-bank-194037eaea8f8f5d25033085ee3d6a53.html");
                case "HCAPTCHA_APP":
                    return oe("hcaptcha-inner-3998bf5d5800b58e9a385a5fd4bc0bb0.html");
                case "NETBANKING_BANK_ELEMENT":
                    return oe("elements-inner-netbanking-bank-aee46590cc6d3cbf36aa60208cb0649e.html");
                default:
                    return Object(m.a)(e) } },
        fe = { card: "card", cardNumber: "cardNumber", cardExpiry: "cardExpiry", cardCvc: "cardCvc", postalCode: "postalCode", iban: "iban", idealBank: "idealBank", p24Bank: "p24Bank", paymentRequestButton: "paymentRequestButton", auBankAccount: "auBankAccount", fpxBank: "fpxBank", netbankingBank: "netbankingBank", epsBank: "epsBank", idealBankSecondary: "idealBankSecondary", p24BankSecondary: "p24BankSecondary", auBankAccountNumber: "auBankAccountNumber", auBsb: "auBsb", fpxBankSecondary: "fpxBankSecondary", netbankingBankSecondary: "netbankingBankSecondary", issuingCardNumberDisplay: "issuingCardNumberDisplay", issuingCardCvcDisplay: "issuingCardCvcDisplay", issuingCardExpiryDisplay: "issuingCardExpiryDisplay", epsBankSecondary: "epsBankSecondary" },
        me = { PAYMENT_INTENT: "PAYMENT_INTENT", SETUP_INTENT: "SETUP_INTENT" },
        he = [fe.card, fe.cardNumber, fe.cardExpiry, fe.cardCvc, fe.postalCode],
        _e = "https://js.stripe.com/v3/",
        ye = k(_e),
        ve = ye ? ye.origin : "",
        be = { family: "font-family", src: "src", unicodeRange: "unicode-range", style: "font-style", variant: "font-variant", stretch: "font-stretch", weight: "font-weight", display: "font-display" },
        ge = Object.keys(be).reduce(function(e, t) { return e[be[t]] = t, e }, {}),
        we = [fe.idealBank, fe.p24Bank, fe.netbankingBank, fe.idealBankSecondary, fe.p24BankSecondary, fe.netbankingBankSecondary, fe.fpxBank, fe.fpxBankSecondary, fe.epsBank, fe.epsBankSecondary],
        Ee = ("00" + Math.floor(1e3 * Math.random())).slice(-3),
        Se = 0,
        Pe = function(e) { return "" + e + Ee + Se++ },
        ke = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) { return typeof e } : function(e) { return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e };

    function Oe(e) { if (Array.isArray(e)) { for (var t = 0, n = Array(e.length); t < e.length; t++) n[t] = e[t]; return n } return Array.from(e) }

    function Ae(e, t) { var o = {};
        t.forEach(function(e) { var t = De(e, 2),
                n = t[0],
                r = t[1];
            n.split(/\s+/).forEach(function(e) { e && (o[e] = o[e] || r) }) }), e.className = Le()(e.className, o) }

    function Te(e) { try { return window.parent.frames[e] } catch (e) { return null } }

    function Ie() { if (!document.body) throw new S("Stripe.js requires that your page has a <body> element."); return document.body }

    function Ce(e) { var t = e.controllerId,
            n = e.frameId,
            r = e.targetOrigin,
            o = e.type,
            i = r,
            a = void 0; "controller" === o ? a = Te(n) : "group" === o ? a = Te(t) : "outer" === o || "hosted" === o ? a = window.frames[n] : "inner" === o && (i = i || "*", a = window.parent), i = i || ve, a && a.postMessage(JSON.stringify(Fe({}, e, { __stripeJsV3: !0 })), i) }

    function Re(e, t) { var n = e._isUserError || "IntegrationError" === e.name; throw t && !n && t.report("fatal.uncaught_error", { iframe: !1, name: e.name, element: "outer", message: e.message || e.description, fileName: e.fileName, lineNumber: e.lineNumber, columnNumber: e.columnNumber, stack: e.stack && e.stack.substring(0, 1e3) }), e }

    function je(t, n) { return function(e) { try { return t.call(this, e) } catch (e) { return Re(e, n || this && this._controller) } } }

    function Ne(r, o) { return function(e, t, n) { try { return r.call(this, e, t, n) } catch (e) { return Re(e, o || this && this._controller) } } } var Me = function o(i, a) { var s = []; return Object.keys(i).forEach(function(e) { var t, n = i[e],
                    r = a ? a + "[" + e + "]" : e;
                n && "object" === (void 0 === n ? "undefined" : ke(n)) ? "" !== (t = o(n, r)) && (s = [].concat(Oe(s), [t])) : null != n && (s = [].concat(Oe(s), [r + "=" + encodeURIComponent(String(n))])) }), s.join("&").replace(/%20/g, "+") },
        xe = n(2),
        Le = n.n(xe),
        De = function(e, t) { if (Array.isArray(e)) return e; if (Symbol.iterator in Object(e)) return function(e, t) { var n = [],
                    r = !0,
                    o = !1,
                    i = void 0; try { for (var a, s = e[Symbol.iterator](); !(r = (a = s.next()).done) && (n.push(a.value), !t || n.length !== t); r = !0); } catch (e) { o = !0, i = e } finally { try {!r && s.return && s.return() } finally { if (o) throw i } } return n }(e, t); throw new TypeError("Invalid attempt to destructure non-iterable instance") },
        Be = function(e, t) { e.style.cssText = Object.keys(t).map(function(e) { return e + ": " + t[e] + " !important;" }).join(" ") },
        qe = { border: "none", margin: "0", padding: "0", width: "1px", "min-width": "100%", overflow: "hidden", display: "block", visibility: "hidden", position: "fixed", height: "1px", "pointer-events": "none", "user-select": "none" },
        Fe = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e },
        Ue = (n(8), function(n, r) { return function(e, t) { try { return n.call(this, e, t) } catch (e) { return Re(e, r || this && this._controller) } } });

    function He() { var i = this;! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, He), this._emit = function(e) { for (var t = arguments.length, n = Array(1 < t ? t - 1 : 0), r = 1; r < t; r++) n[r - 1] = arguments[r]; return (i._callbacks[e] || []).forEach(function(e) { var t = e.fn; if (t._isUserCallback) try { t.apply(void 0, n) } catch (e) { throw e._isUserError = !0, e } else t.apply(void 0, n) }), i }, this._once = function(t, n) { return i._on(t, function e() { i._off(t, e), n.apply(void 0, arguments) }, n) }, this._removeAllListeners = function() { return i._callbacks = {}, i }, this._on = function(e, t, n) { return i._callbacks[e] = i._callbacks[e] || [], i._callbacks[e].push({ original: n, fn: t }), i }, this._validateUserOn = function(e, t) {}, this._userOn = function(e, t) { if ("string" != typeof e) throw new S("When adding an event listener, the first argument should be a string event name."); if ("function" != typeof t) throw new S("When adding an event listener, the second argument should be a function callback."); return i._validateUserOn(e, t), t._isUserCallback = !0, i._on(e, t) }, this._hasRegisteredListener = function(e) { return i._callbacks[e] && 0 < i._callbacks[e].length }, this._off = function(e, t) { if (t) { for (var n, r = i._callbacks[e], o = 0; o < r.length; o++)
                    if ((n = r[o]).fn === t || n.original === t) { r.splice(o, 1); break } } else delete i._callbacks[e]; return i }, this._callbacks = {}; var r, o, e = Ue(this._userOn),
            t = Ue(this._off),
            n = Ue(this._once),
            a = je(this._hasRegisteredListener),
            s = je(this._removeAllListeners),
            c = (r = this._emit, function() { try { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return r.call.apply(r, [this].concat(t)) } catch (e) { return Re(e, o || this && this._controller) } });
        this.on = this.addListener = this.addEventListener = e, this.off = this.removeListener = this.removeEventListener = t, this.once = n, this.hasRegisteredListener = a, this.removeAllListeners = s, this.emit = c } var ze = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e },
        Ge = function(e, t, n) { return t && Ye(e.prototype, t), n && Ye(e, n), e };

    function Ye(e, t) { for (var n = 0; n < t.length; n++) { var r = t[n];
            r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r) } }

    function We(e) { if (Array.isArray(e)) { for (var t = 0, n = Array(e.length); t < e.length; t++) n[t] = e[t]; return n } return Array.from(e) }

    function Ke(e) { var t = e.type,
            n = e.controllerId,
            r = e.listenerRegistry,
            o = e.betas,
            i = e.appParams;! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, Ke); var a = function(e, t) { if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return !t || "object" != typeof t && "function" != typeof t ? e : t }(this, (Ke.__proto__ || Object.getPrototypeOf(Ke)).call(this)); return a._sendFAReq = function(n) { var r = Pe(n.tag); return new E(function(e, t) { a._requests[r] = { resolve: e, reject: t }, a._send({ message: { action: "stripe-frame-action", payload: { nonce: r, faReq: n } }, type: "outer", frameId: a.id, controllerId: a._controllerId }) }) }, a.action = { perform3DS2Challenge: function(e) { return a._sendFAReq({ tag: "PERFORM_3DS2_CHALLENGE", value: e }) }, perform3DS2Fingerprint: function(e) { return a._sendFAReq({ tag: "PERFORM_3DS2_FINGERPRINT", value: e }) }, show3DS2Spinner: function(e) { return a._sendFAReq({ tag: "SHOW_3DS2_SPINNER", value: e }) }, checkCanMakePayment: function(e) { return a._sendFAReq({ tag: "CHECK_CAN_MAKE_PAYMENT", value: e }) }, closeLightboxFrame: function(e) { return a._sendFAReq({ tag: "CLOSE_LIGHTBOX_FRAME", value: e }) }, openLightboxFrame: function(e) { return a._sendFAReq({ tag: "OPEN_LIGHTBOX_FRAME", value: e }) } }, a.type = t, a.loaded = !1, a._controllerId = n, a._persistentMessages = [], a._queuedMessages = [], a._requests = {}, a._listenerRegistry = r, a.id = a._generateId(), a._iframe = a._createIFrame(t, o, i), a._on("load", function() { a.loaded = !0, a._ensureMounted(), a.loaded && (a._persistentMessages.forEach(function(e) { return a._send(e) }), a._queuedMessages.forEach(function(e) { return a._send(e) }), a._queuedMessages = []) }), a._on("title", function(e) { var t = e.title;
            a._iframe.setAttribute("title", t) }), a } var Ve = (function(e, t) { if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function, not " + typeof t);
            e.prototype = Object.create(t && t.prototype, { constructor: { value: e, enumerable: !1, writable: !0, configurable: !0 } }), t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t) }(Ke, He), Ge(Ke, [{ key: "_generateId", value: function() { return Pe("__privateStripeFrame") } }, { key: "send", value: function(e) { this._send({ message: e, type: "outer", frameId: this.id, controllerId: this._controllerId }) } }, { key: "sendPersistent", value: function(e) { this._ensureMounted(); var t = { message: e, type: "outer", frameId: this.id, controllerId: this._controllerId };
                this._persistentMessages = [].concat(We(this._persistentMessages), [t]), this.loaded && Ce(t) } }, { key: "resolve", value: function(e, t) { this._requests[e] && this._requests[e].resolve(t) } }, { key: "reject", value: function(e, t) { this._requests[e] && this._requests[e].reject(t) } }, { key: "_send", value: function(e) { this._ensureMounted(), this.loaded ? Ce(e) : this._queuedMessages = [].concat(We(this._queuedMessages), [e]) } }, { key: "appendTo", value: function(e) { this._emit("mount", { anchor: e }), e.appendChild(this._iframe) } }, { key: "unmount", value: function() { this.loaded = !1, this._emit("unload") } }, { key: "destroy", value: function() { this.unmount(); var e = this._iframe.parentElement;
                e && e.removeChild(this._iframe), this._emit("destroy") } }, { key: "_ensureMounted", value: function() { this._isMounted() || this.unmount() } }, { key: "_isMounted", value: function() { return !!document.body && document.body.contains(this._iframe) } }, { key: "_createIFrame", value: function(e, t, n) { var r = window.location.href.toString(),
                    o = "string" == typeof n ? n : Me(ze({}, n || {}, { referrer: r, controllerId: this._controllerId })),
                    i = document.createElement("iframe"); return i.setAttribute("frameborder", "0"), i.setAttribute("allowTransparency", "true"), i.setAttribute("scrolling", "no"), i.setAttribute("name", this.id), i.setAttribute("allowpaymentrequest", "true"), i.src = de(e) + (o ? "#" : "") + o, i } }]), Ke),
        Je = function(e, t, n) { return t && $e(e.prototype, t), n && $e(e, n), e };

    function $e(e, t) { for (var n = 0; n < t.length; n++) { var r = t[n];
            r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r) } }

    function Xe(e, t, n) { null === e && (e = Function.prototype); var r = Object.getOwnPropertyDescriptor(e, t); if (void 0 === r) { var o = Object.getPrototypeOf(e); return null === o ? void 0 : Xe(o, t, n) } if ("value" in r) return r.value; var i = r.get; return void 0 !== i ? i.call(n) : void 0 }

    function Ze(e) {! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, Ze); var t, n = function(e, t) { if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return !t || "object" != typeof t && "function" != typeof t ? e : t }(this, (Ze.__proto__ || Object.getPrototypeOf(Ze)).call(this, e)); return n.autoload = e.autoload || !1, "complete" === document.readyState ? n._ensureMounted() : (t = n._ensureMounted.bind(n), n._listenerRegistry.addEventListener(document, "DOMContentLoaded", t), n._listenerRegistry.addEventListener(window, "load", t), setTimeout(t, 5e3)), n } var Qe = (function(e, t) { if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function, not " + typeof t);
            e.prototype = Object.create(t && t.prototype, { constructor: { value: e, enumerable: !1, writable: !0, configurable: !0 } }), t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t) }(Ze, Ve), Je(Ze, [{ key: "_ensureMounted", value: function() { Xe(Ze.prototype.__proto__ || Object.getPrototypeOf(Ze.prototype), "_ensureMounted", this).call(this), this._isMounted() || this._autoMount() } }, { key: "_autoMount", value: function() { var e = document.body; if (e) { var t = document.querySelector("#stripe-hidden-frames-container") || e;
                    this.appendTo(t) } else if ("complete" === document.readyState || "interactive" === document.readyState) throw new S("Stripe.js requires that your page has a <body> element.");
                this.autoload && (this.loaded = !0) } }, { key: "_createIFrame", value: function(e, t, n) { var r = Xe(Ze.prototype.__proto__ || Object.getPrototypeOf(Ze.prototype), "_createIFrame", this).call(this, e, t, n); return r.setAttribute("aria-hidden", "true"), r.setAttribute("allowpaymentrequest", "true"), r.setAttribute("tabIndex", "-1"), Be(r, qe), r } }]), Ze),
        et = function(e, t, n) { return t && tt(e.prototype, t), n && tt(e, n), e };

    function tt(e, t) { for (var n = 0; n < t.length; n++) { var r = t[n];
            r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r) } }

    function nt() { return function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, nt),
            function(e, t) { if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return !t || "object" != typeof t && "function" != typeof t ? e : t }(this, (nt.__proto__ || Object.getPrototypeOf(nt)).apply(this, arguments)) }

    function rt(e) { return /Edge\//i.test(e) }

    function ot(e) { return /(MSIE ([0-9]{1,}[.0-9]{0,})|Trident\/)/i.test(e) }

    function it(e) { return /SamsungBrowser/.test(e) }

    function at(e) { return /iPad|iPhone/i.test(e) && !ot(e) }

    function st(e) { return /^((?!chrome|android).)*safari/i.test(e) && !it(e) }

    function ct(e) { return /Android/i.test(e) && !ot(e) } var ut, lt, pt, dt, ft, mt = (function(e, t) { if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function, not " + typeof t);
            e.prototype = Object.create(t && t.prototype, { constructor: { value: e, enumerable: !1, writable: !0, configurable: !0 } }), t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t) }(nt, Qe), et(nt, [{ key: "_generateId", value: function() { return this._controllerId } }]), nt),
        ht = window.navigator.userAgent,
        _t = rt(ht),
        yt = (/Edge\/((1[0-6]\.)|0\.)/i.test(ht), ot(ht)),
        vt = (/MSIE ([0-9]{1,}[.0-9]{0,})/i.test(ht), at(ht)),
        bt = (at(ut = ht) || ct(ut), ct(ht), /Android 4\./i.test(lt = ht) && !/Chrome/i.test(lt) && ct(lt), st(ht)),
        gt = (st(pt = ht) && at(pt), /Firefox\//i.test(ht), /Firefox\/(50|51|[0-4]?\d)([^\d]|$)/i.test(ht), it(ht)),
        wt = (/Chrome\/(6[6-9]|[7-9]\d+|[1-9]\d{2,})/i.test(ht), /AppleWebKit/i.test(dt = ht) && !/Chrome/i.test(dt) && !rt(dt) && !ot(dt)),
        Et = /Chrome/i.test(ft = ht) && !rt(ft),
        St = (/CriOS/i.test(ht), bt && "download" in document.createElement("a")),
        Pt = function(e, t, n) { return t && kt(e.prototype, t), n && kt(e, n), e };

    function kt(e, t) { for (var n = 0; n < t.length; n++) { var r = t[n];
            r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r) } } var Ot = { border: "none", margin: "0", padding: "0", width: "1px", "min-width": "100%", overflow: "hidden", display: "block", "user-select": "none", "will-change": "transform" };

    function At() { return function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, At),
            function(e, t) { if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return !t || "object" != typeof t && "function" != typeof t ? e : t }(this, (At.__proto__ || Object.getPrototypeOf(At)).apply(this, arguments)) }

    function Tt(e, t) { var n = !1; return function() { if (n) throw new S(t);
            n = !0; try { return e.apply(void 0, arguments).then(function(e) { return n = !1, e }, function(e) { throw n = !1, e }) } catch (e) { throw n = !1, e } } }

    function It(e) { var t = e; return function() { t && (t.apply(void 0, arguments), t = null) } } var Ct = (function(e, t) { if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function, not " + typeof t);
            e.prototype = Object.create(t && t.prototype, { constructor: { value: e, enumerable: !1, writable: !0, configurable: !0 } }), t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t) }(At, Ve), Pt(At, [{ key: "update", value: function(e) { this.send({ action: "stripe-user-update", payload: e }) } }, { key: "updateStyle", value: function(t) { var n = this;
                Object.keys(t).forEach(function(e) { n._iframe.style[e] = t[e] }) } }, { key: "forceRepaint", value: function() { var e = this._iframe,
                    t = e.style.display;
                e.style.display = "none"; var n = e.offsetHeight; return e.style.display = t, n } }, { key: "focus", value: function() { this.loaded && (bt ? this._iframe.focus() : this.send({ action: "stripe-user-focus", payload: {} })) } }, { key: "blur", value: function() { this.loaded && (this._iframe.contentWindow.blur(), this._iframe.blur(), document.activeElement === this._iframe && window.focus()) } }, { key: "clear", value: function() { this.send({ action: "stripe-user-clear", payload: {} }) } }, { key: "_createIFrame", value: function(e, t, n) { var r = function e(t, n, r) { null === t && (t = Function.prototype); var o = Object.getOwnPropertyDescriptor(t, n); if (void 0 === o) { var i = Object.getPrototypeOf(t); return null === i ? void 0 : e(i, n, r) } if ("value" in o) return o.value; var a = o.get; return void 0 !== a ? a.call(r) : void 0 }(At.prototype.__proto__ || Object.getPrototypeOf(At.prototype), "_createIFrame", this).call(this, e, t, n); return r.setAttribute("title", "Secure payment input frame"), Be(r, Ot), r } }]), At),
        Rt = function(e, t) { return e ? window.getComputedStyle(e, t) : null },
        jt = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e }; var Nt = { display: "block", position: "fixed", "z-index": "2147483647", background: "rgba(40,40,40,0)", transition: "background 400ms ease", "will-change": "background", top: "0", left: "0", right: "0", bottom: "0" },
        Mt = jt({}, Nt, { background: "rgba(40,40,40,0.75)" }),
        xt = function e(t) { var w = this,
                n = t.lockScrolling,
                r = t.lockFocus,
                o = t.lockFocusOn,
                i = t.listenerRegistry;! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, e), this.domElement = document.createElement("div"), this._runOnHide = [], this.mount = function() { var e = Ie();
                w.domElement.style.display = "none", e.contains(w.domElement) || e.insertBefore(w.domElement, e.firstChild) }, this.show = function() { var e, t, n, r, o, i, a, s, c, u, l, p, d, f, m, h, _, y, v, b, g;
                Be(w.domElement, Nt), w._lockScrolling && (t = Ie(), n = t.style, r = n.position, o = n.top, i = n.left, a = n.bottom, s = n.right, c = n.overflow, u = document.documentElement ? document.documentElement.style : { overflow: "", scrollBehavior: "" }, l = u.overflow, p = u.scrollBehavior, d = window, f = d.pageXOffset, m = d.pageYOffset, h = document.documentElement ? window.innerWidth - document.documentElement.offsetWidth : 0, _ = document.documentElement ? window.innerHeight - document.documentElement.offsetHeight : 0, t.style.position = "fixed", t.style.overflow = "hidden", document.documentElement && (document.documentElement.style.overflow = "visible", document.documentElement.style.scrollBehavior = "auto"), t.style.top = -m + "px", t.style.left = -f + "px", t.style.right = h + "px", t.style.bottom = _ + "px", e = It(function() { t.style.position = r, t.style.top = o, t.style.left = i, t.style.bottom = a, t.style.right = s, t.style.overflow = c, document.documentElement && (document.documentElement.style.overflow = l), window.scrollTo(f, m), document.documentElement && (document.documentElement.style.scrollBehavior = p) }), w._runOnHide.push(e)), w._lockFocus && (v = w._lockFocusOn, b = [], g = P(document.querySelectorAll("*"), function(e) { var t = e.getAttribute("tabindex") || "";
                    v !== e && (e.tabIndex = -1), b.push({ element: e, tabIndex: t }) }), y = It(function() { g.then(function() { return P(b, function(e) { var t = e.element,
                                n = e.tabIndex; "" === n ? t.removeAttribute("tabindex") : t.setAttribute("tabindex", n) }) }) }), w._runOnHide.push(y)) }, this.fadeIn = function() { setTimeout(function() { Be(w.domElement, Mt) }) }, this.fadeOut = function() { return new E(function(e) { Be(w.domElement, Nt), setTimeout(e, 500), w._listenerRegistry.addEventListener(w.domElement, "transitionend", e) }).then(function() { for (w.domElement.style.display = "none"; w._runOnHide.length;) w._runOnHide.pop()() }) }, this.unmount = function() { Ie().removeChild(w.domElement) }, this._lockScrolling = !!n, this._lockFocus = !!r, this._lockFocusOn = o || null, this._listenerRegistry = i },
        Lt = function e(t, n, r) { null === t && (t = Function.prototype); var o = Object.getOwnPropertyDescriptor(t, n); if (void 0 === o) { var i = Object.getPrototypeOf(t); return null === i ? void 0 : e(i, n, r) } if ("value" in o) return o.value; var a = o.get; return void 0 !== a ? a.call(r) : void 0 }; var Dt = { position: "absolute", left: "0", top: "0", height: "100%", width: "100%" };

    function Bt(e) { var t = e.type,
            n = e.controllerId,
            r = e.listenerRegistry,
            o = e.options;! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, Bt); var i = function(e, t) { if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return !t || "object" != typeof t && "function" != typeof t ? e : t }(this, (Bt.__proto__ || Object.getPrototypeOf(Bt)).call(this, { type: t, controllerId: n, listenerRegistry: r, appParams: o })); return i._autoMount = function() { i.appendTo(i._backdrop.domElement), i._backdrop.mount() }, i.show = function() { i._backdrop.show(), Be(i._iframe, Dt) }, i.fadeInBackdrop = function() { i._backdrop.fadeIn() }, i._backdropFadeoutPromise = null, i.fadeOutBackdrop = function() { return i._backdropFadeoutPromise || (i._backdropFadeoutPromise = i._backdrop.fadeOut()), i._backdropFadeoutPromise }, i.destroy = function() { var e = 0 < arguments.length && void 0 !== arguments[0] && arguments[0],
                t = i.fadeOutBackdrop().then(function() { i._backdrop.unmount(), e || Lt(Bt.prototype.__proto__ || Object.getPrototypeOf(Bt.prototype), "destroy", i).call(i) }); return e && Lt(Bt.prototype.__proto__ || Object.getPrototypeOf(Bt.prototype), "destroy", i).call(i), t }, i._backdrop = new xt({ lockScrolling: !0, lockFocus: !0, lockFocusOn: i._iframe, listenerRegistry: r }), i._autoMount(), i } var qt = (function(e, t) { if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function, not " + typeof t);
            e.prototype = Object.create(t && t.prototype, { constructor: { value: e, enumerable: !1, writable: !0, configurable: !0 } }), t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t) }(Bt, Ve), Bt),
        Ft = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e },
        Ut = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) { return typeof e } : function(e) { return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e },
        Ht = function(e, t, n) { return t && zt(e.prototype, t), n && zt(e, n), e };

    function zt(e, t) { for (var n = 0; n < t.length; n++) { var r = t[n];
            r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r) } } var Gt = { display: "block", position: "absolute", "z-index": "1000", width: "1px", "min-width": "100%", margin: "2px 0 0 0", padding: "0", border: "none", overflow: "hidden" };

    function Yt() { return function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, Yt),
            function(e, t) { if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return !t || "object" != typeof t && "function" != typeof t ? e : t }(this, (Yt.__proto__ || Object.getPrototypeOf(Yt)).apply(this, arguments)) }

    function Wt(e, t) { var n = k(e),
            r = k(t); return !(!n || !r) && n.origin === r.origin }

    function Kt(e) { var t = e.name,
            n = e.value,
            r = e.expiresIn,
            o = e.path,
            i = e.domain,
            a = new Date,
            s = r || 31536e6;
        a.setTime(a.getTime() + s); var c = o || "/",
            u = (n || "").replace(/[^!#-+\--:<-[\]-~]/g, encodeURIComponent),
            l = encodeURIComponent(t) + "=" + u + ";expires=" + a.toGMTString() + ";path=" + c + ";SameSite=Lax"; return i && (l += ";domain=" + i), document.cookie = l }

    function Vt(n) { var e = w(document.cookie.split("; "), function(e) { var t = e.indexOf("="); return decodeURIComponent(e.substr(0, t)) === n }); if (e) { var t = e.indexOf("="); return decodeURIComponent(e.substr(t + 1)) } return null }

    function Jt(e, t) { return Object.prototype.hasOwnProperty.call(e, t) } var $t = (function(e, t) { if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function, not " + typeof t);
            e.prototype = Object.create(t && t.prototype, { constructor: { value: e, enumerable: !1, writable: !0, configurable: !0 } }), t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t) }(Yt, Ve), Ht(Yt, [{ key: "updateStyle", value: function(t) { var n = this;
                Object.keys(t).forEach(function(e) { n._iframe.style[e] = t[e] }) } }, { key: "update", value: function(e) { this.send({ action: "stripe-user-update", payload: e }) } }, { key: "_createIFrame", value: function(e, t, n) { var r = function e(t, n, r) { null === t && (t = Function.prototype); var o = Object.getOwnPropertyDescriptor(t, n); if (void 0 === o) { var i = Object.getPrototypeOf(t); return null === i ? void 0 : e(i, n, r) } if ("value" in o) return o.value; var a = o.get; return void 0 !== a ? a.call(r) : void 0 }(Yt.prototype.__proto__ || Object.getPrototypeOf(Yt.prototype), "_createIFrame", this).call(this, e, t, n && "object" === (void 0 === n ? "undefined" : Ut(n)) ? Ft({}, n, { isSecondaryFrame: !0 }) : n); return Be(r, Gt), r.style.height = "0", r } }]), Yt),
        Xt = function(e) { return Wt(e, "https://js.stripe.com/v3/") || (t = k(e), "stripe.com" === (n = t ? t.host : "") || !!n.match(/\.stripe\.(com|me)$/)); var t, n },
        Zt = ["button", "checkbox", "file", "hidden", "image", "submit", "radio", "reset"],
        Qt = function(e) { var t = e.tagName; if (e.isContentEditable || "TEXTAREA" === t) return !0; if ("INPUT" !== t) return !1; var n = e.getAttribute("type"); return -1 === Zt.indexOf(n) },
        en = function(e) { var u = {}; return e.replace(/\+/g, " ").split("&").forEach(function(e, t) { var n, r = e.split("="),
                    o = decodeURIComponent(r[0]),
                    i = u,
                    a = 0,
                    s = o.split("]["),
                    c = s.length - 1,
                    c = /\[/.test(s[0]) && /\]$/.test(s[c]) ? (s[c] = s[c].replace(/\]$/, ""), (s = s.shift().split("[").concat(s)).length - 1) : 0; if (!(0 <= s.indexOf("__proto__")))
                    if (2 === r.length)
                        if (n = decodeURIComponent(r[1]), c)
                            for (; a <= c; a++) { if (o = "" === s[a] ? i.length : s[a], !Jt(i, o) && i[o]) return;
                                i[o] = a < c ? i[o] || (s[a + 1] && isNaN(s[a + 1]) ? {} : []) : n, i = i[o] } else if (Array.isArray(u[o])) u[o].push(n);
                            else if (void 0 !== u[o]) { if (!Jt(u, o)) return;
                    u[o] = [u[o], n] } else u[o] = n;
                else o && (u[o] = "") }), u },
        tn = n(3),
        nn = n.n(tn),
        rn = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e },
        on = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) { return typeof e } : function(e) { return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e };

    function an(e) { return e && "object" === (void 0 === e ? "undefined" : on(e)) && (e.constructor === Array || e.constructor === Object) }

    function sn(e) { return an(e) ? Array.isArray(e) ? e.slice(0, e.length) : rn({}, e) : e }

    function cn(a) { return function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; if (Array.isArray(t[0]) && a) return sn(t[0]); var i = Array.isArray(t[0]) ? [] : {}; return t.forEach(function(o) { o && Object.keys(o).forEach(function(e) { var t = i[e],
                        n = o[e],
                        r = an(t) && !(a && Array.isArray(t)); "object" === (void 0 === n ? "undefined" : on(n)) && r ? i[e] = cn(a)(t, sn(n)) : void 0 !== n ? i[e] = (an(n) ? cn(a) : sn)(n) : void 0 !== t && (i[e] = t) }) }), i } }
    cn(!1); var un = cn(!0),
        ln = _e.replace(/\/$/, ""); var pn = "_1776170249",
        dn = function(e) { var t, n, r, o = (r = !0, (n = pn) in (t = {}) ? Object.defineProperty(t, n, { value: r, enumerable: !0, configurable: !0, writable: !0 }) : t[n] = r, t); try { var i = en(e.slice(e.indexOf("?") + 1));
                Object.keys(i).forEach(function(e) { var t = nn()(e),
                        n = i[e];
                    t === pn && "false" === n && (o[t] = !1) }) } catch (e) {} return o }(function(e) { try { if (e.currentScript) return e.currentScript.src; var t = e.querySelectorAll('script[src^="' + ln + '"]'),
                    n = w(t, function(e) { var t = (e.getAttribute("src") || "").split("?")[0]; return new RegExp("^" + ln + "/?$").test(t) }); return n && n.getAttribute("src") || "" } catch (e) { return "" } }(document))[pn],
        fn = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) { return typeof e } : function(e) { return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e },
        mn = function(e, t) { if (Array.isArray(e)) return e; if (Symbol.iterator in Object(e)) return function(e, t) { var n = [],
                    r = !0,
                    o = !1,
                    i = void 0; try { for (var a, s = e[Symbol.iterator](); !(r = (a = s.next()).done) && (n.push(a.value), !t || n.length !== t); r = !0); } catch (e) { o = !0, i = e } finally { try {!r && s.return && s.return() } finally { if (o) throw i } } return n }(e, t); throw new TypeError("Invalid attempt to destructure non-iterable instance") },
        hn = function() { var o = []; return { addEventListener: function(e, t, n, r) { e.addEventListener(t, n, r), o.push([e, t, n, r]) }, removeEventListener: function(d, f, m, h) { d.removeEventListener(f, m, h), o = o.filter(function(e) { return t = e, n = mn([d, f, m, h], 4), r = n[0], o = n[1], i = n[2], a = n[3], s = mn(t, 4), c = s[0], u = s[1], l = s[2], p = s[3], c !== r || u !== o || l !== i || !0 === ("object" === (void 0 === a ? "undefined" : fn(a)) && a ? a.capture : a) != (!0 === ("object" === (void 0 === p ? "undefined" : fn(p)) && p ? p.capture : p)); var t, n, r, o, i, a, s, c, u, l, p }) } } };

    function _n(e, t) { for (var n = 0; n < t.length; n++) { var r = t[n];
            r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r) } }

    function yn(e) { return 42 === e.length }

    function vn(e, t, n) { return n ? !e || !yn(e) && yn(t) ? t : e : ie() } var bn = "__privateStripeMetricsController",
        gn = { MERCHANT: "merchant", SESSION: "session" },
        wn = "NA",
        En = (function(e, t, n) { return t && _n(e.prototype, t), n && _n(e, n), e }(Sn, [{ key: "ids", value: function() { return { guid: this._guid, muid: this._muid, sid: this._sid } } }, { key: "idsPromise", value: function() { var e = this; return this._idsPromise.then(function() { return e.ids() }) } }, { key: "_establishMessageChannel", value: function(e) { if (!dn) return this._guid = ie(), void e();
                this._listenerRegistry.addEventListener(window, "message", this._handleMessage(e)) } }, { key: "_startIntervalCheck", value: function() { var t = this,
                    n = window.location.href;
                setInterval(function() { var e = window.location.href;
                    e !== n && (t.send(function(e) { return { action: "ping", payload: { sid: e.sid, muid: e.muid, title: document.title, referrer: document.referrer, url: document.location.href, version: 6 } } }), n = e) }, 5e3) } }, { key: "report", value: function(t, n) { this.send(function(e) { return { action: "track", payload: { sid: e.sid, muid: e.muid, url: document.location.href, source: t, data: n, version: 6 } } }) } }, { key: "send", value: function(e) { var t = this;
                this._idsPromise.then(function() { try { t._controllerFrame && t._controllerFrame.send(e(t.ids())) } catch (e) {} }) } }, { key: "_testLatency", value: function() { var n = this,
                    r = new Date;
                this._listenerRegistry.addEventListener(document, "mousemove", function e() { try { var t = new Date;
                        n._latencies.push(t - r), 10 <= n._latencies.length && (n.report("mouse-timings-10", n._latencies), n._listenerRegistry.removeEventListener(document, "mousemove", e)), r = t } catch (e) {} }) } }, { key: "_extractMetaReferrerPolicy", value: function() { var e = document.querySelector("meta[name=referrer]"); return null != e && e instanceof HTMLMetaElement ? e.content.toLowerCase() : null } }, { key: "_extractUrl", value: function(e) { var t = document.location.href; switch (e) {
                    case "origin":
                    case "strict-origin":
                    case "origin-when-cross-origin":
                    case "strict-origin-when-cross-origin":
                        return document.location.origin;
                    case "unsafe-url":
                        return t.split("#")[0];
                    default:
                        return t } } }, { key: "_buildFrameQueryString", value: function() { var e = this._extractMetaReferrerPolicy(),
                    t = this._extractUrl(e),
                    n = { url: t, title: document.title, referrer: document.referrer, muid: this._muid, sid: this._sid, version: 6, preview: Xt(t) }; return null != e && (n.metaReferrerPolicy = e), Object.keys(n).map(function(e) { return null != n[e] ? e + "=" + encodeURIComponent(n[e].toString()) : null }).join("&") } }, { key: "_getID", value: function(e, t) { var n = 1 < arguments.length && void 0 !== t ? t : wn; switch (e) {
                    case gn.MERCHANT:
                        if (this._doNotPersist) return vn(this._muid, n, dn); try { var r = "__stripe_mid",
                                o = vn(Vt(r), n, dn); return yn(o) && Kt({ name: r, value: o, domain: "." + document.location.hostname }), o } catch (e) { return wn }
                    case gn.SESSION:
                        if (this._doNotPersist) return vn(this._sid, n, dn); try { var i = "__stripe_sid",
                                a = vn(Vt(i), n, dn); return yn(a) && Kt({ name: i, value: a, domain: "." + document.location.hostname, expiresIn: 18e5 }), a } catch (e) { return wn }
                    default:
                        throw new Error("Invalid ID type specified: " + e) } } }]), Sn);

    function Sn() { var e, t, n, l = this,
            r = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : {};! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, Sn), this._controllerFrame = null, this._latencies = [], this._handleMessage = function(u) { return function(e) { var t = e.data,
                    n = e.origin; if (Xt(n) && "string" == typeof t) try { var r, o, i, a = JSON.parse(t),
                        s = a.originatingScript,
                        c = a.payload; "m2" === s && (r = c.guid, o = c.muid, i = c.sid, l._guid = r, l._muid = l._getID(gn.MERCHANT, o), l._sid = l._getID(gn.SESSION, i), u()) } catch (e) {} } }, r.checkoutIds ? (t = (e = r.checkoutIds).muid, n = e.sid, this._guid = wn, this._muid = t, this._sid = n, this._doNotPersist = !0) : (this._guid = wn, this._muid = this._getID(gn.MERCHANT), this._sid = this._getID(gn.SESSION), this._doNotPersist = !1), this._listenerRegistry = hn(), this._idsPromise = new E(function(e) { l._establishMessageChannel(e) }), this._id = Pe(bn), dn && (this._controllerFrame = new mt({ type: pe.METRICS_CONTROLLER, controllerId: this._id, listenerRegistry: this._listenerRegistry, autoload: !0, appParams: this._buildFrameQueryString() }), this._startIntervalCheck(), setTimeout(this._testLatency.bind(this), 2e3 + 500 * Math.random())) } var Pn, kn = null,
        On = function(e) { return kn = new En(0 < arguments.length && void 0 !== e ? e : {}) },
        An = !1,
        Tn = function() { var t = kn;
            t && (An || (An = !0, t.send(function(e) { return { action: "ping", payload: { v2: 2, sid: e.sid, muid: e.muid, title: document.title, referrer: document.referrer, url: document.location.href, version: 6 } } }), t.send(function(e) { return { action: "track", payload: { sid: e.sid, muid: e.muid, url: document.location.href, source: "mouse-timings-10-v2", data: t._latencies, version: 6 } } }))) },
        In = { checkout_beta_2: "checkout_beta_2", checkout_beta_3: "checkout_beta_3", checkout_beta_4: "checkout_beta_4", checkout_beta_testcards: "checkout_beta_testcards", payment_intent_beta_1: "payment_intent_beta_1", payment_intent_beta_2: "payment_intent_beta_2", payment_intent_beta_3: "payment_intent_beta_3", card_payment_method_beta_1: "card_payment_method_beta_1", acknowledge_ie9_deprecation: "acknowledge_ie9_deprecation", cvc_update_beta_1: "cvc_update_beta_1", google_pay_beta_1: "google_pay_beta_1", google_pay_beta_2: "google_pay_beta_2", acss_debit_beta_1: "acss_debit_beta_1", acss_debit_beta_2: "acss_debit_beta_2", afterpay_clearpay_pm_beta_1: "afterpay_clearpay_pm_beta_1", alipay_pm_beta_1: "alipay_pm_beta_1", au_bank_account_beta_1: "au_bank_account_beta_1", au_bank_account_beta_2: "au_bank_account_beta_2", bacs_debit_beta: "bacs_debit_beta", bancontact_pm_beta_1: "bancontact_pm_beta_1", boleto_pm_beta_1: "boleto_pm_beta_1", eps_pm_beta_1: "eps_pm_beta_1", fpx_bank_beta_1: "fpx_bank_beta_1", giropay_pm_beta_1: "giropay_pm_beta_1", grabpay_pm_beta_1: "grabpay_pm_beta_1", ideal_pm_beta_1: "ideal_pm_beta_1", konbini_pm_beta_1: "konbini_pm_beta_1", line_items_beta_1: "line_items_beta_1", oxxo_pm_beta_1: "oxxo_pm_beta_1", p24_pm_beta_1: "p24_pm_beta_1", paypal_pm_beta_1: "paypal_pm_beta_1", sepa_pm_beta_1: "sepa_pm_beta_1", sofort_pm_beta_1: "sofort_pm_beta_1", tax_product_beta_1: "tax_product_beta_1", wechat_pay_pm_beta_1: "wechat_pay_pm_beta_1", checkout_beta_locales: "checkout_beta_locales", stripe_js_beta_locales: "stripe_js_beta_locales", ideal_sepa_beta_1: "ideal_sepa_beta_1", sofort_sepa_beta_1: "sofort_sepa_beta_1", bancontact_sepa_beta_1: "bancontact_sepa_beta_1", upi_beta_1: "upi_beta_1", issuing_elements_1: "issuing_elements_1", return_intents_beta_1: "return_intents_beta_1", netbanking_beta_1: "netbanking_beta_1", eps_bank_beta_1: "eps_bank_beta_1", card_light_beta_1: "card_light_beta_1", no_card_light_beta_1: "no_card_light_beta_1", p24_bank_beta_1: "p24_bank_beta_1", netbanking_bank_beta_1: "netbanking_bank_beta_1" },
        Cn = Object.freeze({ netbankingBank: "netbanking_bank_beta_1" }),
        Rn = Object.keys(In),
        jn = function(e, t) { return 0 <= e.indexOf(t) };

    function Nn(e, t, n) { return t in e ? Object.defineProperty(e, t, { value: n, enumerable: !0, configurable: !0, writable: !0 }) : e[t] = n, e } var Mn, xn, Ln = (Nn(Pn = {}, fe.card, { unique: !0, conflict: [fe.cardNumber, fe.cardExpiry, fe.cardCvc, fe.postalCode], beta: !1, implementation: "legacy" }), Nn(Pn, fe.cardNumber, { unique: !0, conflict: [fe.card], beta: !1, implementation: "legacy" }), Nn(Pn, fe.cardExpiry, { unique: !0, conflict: [fe.card], beta: !1, implementation: "legacy" }), Nn(Pn, fe.cardCvc, { unique: !0, conflict: [fe.card], beta: !1, implementation: "legacy" }), Nn(Pn, fe.postalCode, { unique: !0, conflict: [fe.card], beta: !1, implementation: "legacy" }), Nn(Pn, fe.paymentRequestButton, { unique: !0, conflict: [], beta: !1, implementation: "legacy" }), Nn(Pn, fe.iban, { unique: !0, conflict: [], beta: !1, implementation: "legacy" }), Nn(Pn, fe.idealBank, { unique: !0, conflict: [], beta: !1, implementation: "legacy" }), Nn(Pn, fe.p24Bank, { unique: !0, conflict: [], beta: !1, implementation: "legacy" }), Nn(Pn, fe.auBankAccount, { unique: !0, beta: !1, conflict: [], implementation: "legacy" }), Nn(Pn, fe.fpxBank, { unique: !0, beta: !1, conflict: [], implementation: "legacy" }), Nn(Pn, fe.netbankingBank, { unique: !0, beta: !0, conflict: [], implementation: "legacy" }), Nn(Pn, fe.issuingCardNumberDisplay, { unique: !1, beta: !0, conflict: [], implementation: "legacy" }), Nn(Pn, fe.issuingCardCvcDisplay, { unique: !1, beta: !0, conflict: [], implementation: "legacy" }), Nn(Pn, fe.issuingCardExpiryDisplay, { unique: !1, beta: !0, conflict: [], implementation: "legacy" }), Nn(Pn, fe.epsBank, { unique: !0, conflict: [], beta: !0, implementation: "legacy" }), Pn);

    function Dn(e, t, n) { return t in e ? Object.defineProperty(e, t, { value: n, enumerable: !0, configurable: !0, writable: !0 }) : e[t] = n, e } var Bn = "__PrivateStripeElement",
        qn = Bn + "-input",
        Fn = Bn + "-safariInput",
        Un = ["brand"],
        Hn = (Dn(Mn = {}, fe.card, Un), Dn(Mn, fe.cardNumber, Un), Dn(Mn, fe.iban, ["country", "bankName"]), Dn(Mn, fe.auBankAccount, ["bankName", "branchName"]), Mn),
        zn = (Dn(xn = {}, fe.idealBank, { secondary: fe.idealBankSecondary }), Dn(xn, fe.p24Bank, { secondary: fe.p24BankSecondary }), Dn(xn, fe.fpxBank, { secondary: fe.fpxBankSecondary }), Dn(xn, fe.netbankingBank, { secondary: fe.netbankingBankSecondary }), Dn(xn, fe.epsBank, { secondary: fe.epsBankSecondary }), xn),
        Gn = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e };

    function Yn(e, t) { for (var n = 0; n < t.length; n++) { var r = t[n];
            r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r) } } var Wn = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) { return typeof e } : function(e) { return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e };

    function Kn(e, t) { return document.activeElement === e._iframe || e._iframe.parentElement && document.activeElement === t }

    function Vn(e) { return "object" === (void 0 === e ? "undefined" : Wn(e)) && null !== e && "IntegrationError" === e.name ? new S("string" == typeof e.message ? e.message : "") : e } var Jn = "__privateStripeController",
        $n = !1,
        Xn = {},
        Zn = function(e) { return { cl: !jn(e, "no_card_light_beta_1") && (jn(e, "card_light_beta_1") || Math.random() < .5), clc: Math.random() < .5 } },
        Qn = (function(e, t, n) { return t && Yn(e.prototype, t), n && Yn(e, n), e }(er, [{ key: "registerWrapper", value: function(e) { this._controllerFrame.send({ action: "stripe-wrapper-register", payload: { wrapperLibrary: e } }) } }]), er);

    function er(e) { var n = this;! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, er), nr.call(this); var t = e.listenerRegistry,
            r = e.stripeJsLoadTimestamp,
            o = e.stripeCreateTimestamp,
            i = e.onFirstLoad,
            a = e.betas,
            s = function(e, t) { var n, r = {}; for (n in e) 0 <= t.indexOf(n) || Object.prototype.hasOwnProperty.call(e, n) && (r[n] = e[n]); return r }(e, ["listenerRegistry", "stripeJsLoadTimestamp", "stripeCreateTimestamp", "onFirstLoad", "betas"]),
            c = s.apiKey,
            u = s.stripeAccount,
            l = s.stripeJsId,
            p = s.locale;
        this._id = Pe(Jn), this._stripeJsId = l, this._apiKey = c, this._stripeAccount = u, this._listenerRegistry = t, this._betas = a, this._flags = Zn(a), this._controllerFrame = new mt({ type: pe.CONTROLLER, betas: a, controllerId: this._id, listenerRegistry: t, appParams: Gn({}, s, { outerFlags: this._flags, betas: a, stripeJsLoadTime: r.getAsPosixTime() }) }), this._stripeJsLoadTimestamp = r, this._createTimestamp = o, this._loadCount = 0;

        function d(e) { var t = e.anchor;
            n._mountTimestamp = new b, t !== document.body && n.report("controller.mount.custom_container") }
        this._controllerFrame._isMounted() ? d({ anchor: this._controllerFrame._iframe.parentElement }) : this._controllerFrame._once("mount", d), i && this._controllerFrame._once("load", i), this._frames = {}, this._requests = {}, this._setupPostMessage(), this._handleMessage = Ue(this._handleMessage, this), this.action.fetchLocale({ locale: p || "auto" }) }

    function tr() { var e = document.querySelectorAll("meta[name=viewport][content]"),
            t = e[e.length - 1]; return t && t instanceof HTMLMetaElement ? t.content : "" } var nr = function() { var p = this;
            this._sendCAReq = function(n) { var r = Pe(n.tag); return new E(function(e, t) { p._requests[r] = { resolve: e, reject: t }, p._controllerFrame.send({ action: "stripe-safe-controller-action-request", payload: { nonce: r, caReq: n } }) }) }, this.livemode = function() { var e = p._apiKey; return /^pk_test_/.test(e) ? "testmode" : /^pk_live_/.test(e) ? "livemode" : "unknown" }, this.action = { retrievePaymentIntent: function(e) { return p._sendCAReq({ tag: "RETRIEVE_PAYMENT_INTENT", value: e }) }, confirmPaymentIntent: function(e) { return p._sendCAReq({ tag: "CONFIRM_PAYMENT_INTENT", value: e }) }, cancelPaymentIntentSource: function(e) { return p._sendCAReq({ tag: "CANCEL_PAYMENT_INTENT_SOURCE", value: e }) }, confirmSetupIntent: function(e) { return p._sendCAReq({ tag: "CONFIRM_SETUP_INTENT", value: e }) }, retrieveSetupIntent: function(e) { return p._sendCAReq({ tag: "RETRIEVE_SETUP_INTENT", value: e }) }, cancelSetupIntentSource: function(e) { return p._sendCAReq({ tag: "CANCEL_SETUP_INTENT_SOURCE", value: e }) }, fetchLocale: function(e) { return p._sendCAReq({ tag: "FETCH_LOCALE", value: e }) }, updateCSSFonts: function(e) { return p._sendCAReq({ tag: "UPDATE_CSS_FONTS", value: e }) }, createApplePaySession: function(e) { return p._sendCAReq({ tag: "CREATE_APPLE_PAY_SESSION", value: e }) }, retrieveSource: function(e) { return p._sendCAReq({ tag: "RETRIEVE_SOURCE", value: e }) }, tokenizeWithElement: function(e) { return p._sendCAReq({ tag: "TOKENIZE_WITH_ELEMENT", value: e }) }, tokenizeCvcUpdate: function(e) { return p._sendCAReq({ tag: "TOKENIZE_CVC_UPDATE", value: e }) }, tokenizeWithData: function(e) { return p._sendCAReq({ tag: "TOKENIZE_WITH_DATA", value: e }) }, createSourceWithElement: function(e) { return p._sendCAReq({ tag: "CREATE_SOURCE_WITH_ELEMENT", value: e }) }, createSourceWithData: function(e) { return p._sendCAReq({ tag: "CREATE_SOURCE_WITH_DATA", value: e }) }, createPaymentMethodWithElement: function(e) { return p._sendCAReq({ tag: "CREATE_PAYMENT_METHOD_WITH_ELEMENT", value: e }) }, createPaymentMethodWithData: function(e) { return p._sendCAReq({ tag: "CREATE_PAYMENT_METHOD_WITH_DATA", value: e }) }, createPaymentPage: function(e) { return p._sendCAReq({ tag: "CREATE_PAYMENT_PAGE", value: e }) }, createPaymentPageWithSession: function(e) { return p._sendCAReq({ tag: "CREATE_PAYMENT_PAGE_WITH_SESSION", value: e }) }, createRadarSession: function(e) { return p._sendCAReq({ tag: "CREATE_RADAR_SESSION", value: e }) }, authenticate3DS2: function(e) { return p._sendCAReq({ tag: "AUTHENTICATE_3DS2", value: e }) }, verifyMicrodepositsForPayment: function(e) { return p._sendCAReq({ tag: "VERIFY_MICRODEPOSITS_FOR_PAYMENT", value: e }) }, verifyMicrodepositsForSetup: function(e) { return p._sendCAReq({ tag: "VERIFY_MICRODEPOSITS_FOR_SETUP", value: e }) }, retrieveIssuingCard: function(e) { return p._sendCAReq({ tag: "RETRIEVE_ISSUING_CARD", value: e }) }, updatePaymentIntent: function(e) { return p._sendCAReq({ tag: "UPDATE_PAYMENT_INTENT", value: e }) }, createAcssDebitSession: function(e) { return p._sendCAReq({ tag: "CREATE_ACSS_DEBIT_SESSION", value: e }) }, confirmReturnIntent: function(e) { return p._sendCAReq({ tag: "CONFIRM_RETURN_INTENT", value: e }) }, localizeError: function(e) { return p._sendCAReq({ tag: "LOCALIZE_ERROR", value: e }) } }, this.createElementFrame = function(e, t, n, r) { var o = p._betas,
                    i = new Ct({ type: e, betas: o, controllerId: p._id, listenerRegistry: p._listenerRegistry, appParams: Gn({}, r, { componentName: t, keyMode: A(p._apiKey), apiKey: p._apiKey }) }); return p._setupFrame(i, e, n) }, this.createSecondaryElementFrame = function(e, t, n, r, o) { var i = p._betas,
                    a = new $t({ type: e, betas: i, controllerId: p._id, listenerRegistry: p._listenerRegistry, appParams: Gn({}, o, { componentName: t, primaryElementType: n, keyMode: A(p._apiKey) }) }); return p._setupFrame(a, e, r) }, this.createHiddenFrame = function(e, t) { var n = new Qe({ type: e, betas: p._betas, controllerId: p._id, listenerRegistry: p._listenerRegistry, appParams: t }); return p._setupFrame(n, e) }, this.createLightboxFrame = function(e) { var t = e.type,
                    n = e.options,
                    r = new qt({ type: t, controllerId: p._id, listenerRegistry: p._listenerRegistry, options: Gn({}, n, { betas: p._betas }) }); return p._setupFrame(r, t) }, this.getFlags = function() { return p._flags }, this._setupFrame = function(e, t, n) { return p._frames[e.id] = e, p._controllerFrame.sendPersistent({ action: "stripe-user-createframe", payload: { newFrameId: e.id, frameType: t, groupId: n } }), e._on("unload", function() { p._controllerFrame.sendPersistent({ action: "stripe-frame-unload", payload: { unloadedFrameId: e.id } }) }), e._on("destroy", function() { delete p._frames[e.id], p._controllerFrame.sendPersistent({ action: "stripe-frame-destroy", payload: { destroyedFrameId: e.id } }) }), e._on("load", function() { p._controllerFrame.sendPersistent({ action: "stripe-frame-load", payload: { loadedFrameId: e.id } }), p._controllerFrame.loaded && e.send({ action: "stripe-controller-load", payload: {} }) }), e }, this.report = function(e) { var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {};
                p._controllerFrame.send({ action: "stripe-controller-report", payload: { event: e, data: t } }) }, this.warn = function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n];
                p._controllerFrame.send({ action: "stripe-controller-warn", payload: { args: t } }) }, this.controllerFor = function() { return "outer" }, this._setupPostMessage = function() { p._listenerRegistry.addEventListener(window, "message", function(e) { var t = e.data,
                        n = e.origin,
                        r = e.source,
                        o = function(e) { try { var t = "string" == typeof e ? JSON.parse(e) : e; return t.__stripeJsV3 ? t : null } catch (e) { return null } }(t);
                    o && Wt(ve, n) && p._handleMessage(o, r) }) }, this._nodeIsKnownElement = function(e) { return e && "IFRAME" === e.nodeName && !!p._frames[e.getAttribute("name") || ""] }, this._handleMessage = function(e, t) { var n = e.controllerId,
                    r = e.frameId,
                    o = e.message,
                    i = p._frames[r]; if (n === p._id) switch (o.action) {
                    case "stripe-frame-event":
                        var a = o.payload.event,
                            s = o.payload.data; if (i) { if (vt) { var c = i._iframe.parentElement,
                                    u = c && c.querySelector("." + qn); if ("focus" === a && !$n && u && !Kn(i, u) && !Xn[r]) { u.focus(), $n = !0, Xn[r] = !0, setTimeout(function() { Xn[r] = !1 }, 1e3); break } if ("blur" === a && $n) { $n = !1; break } "blur" === a && St && setTimeout(function() { var e, t, n = document.activeElement;!n || Kn(i, u) || Qt(n) || p._nodeIsKnownElement(n) || ((e = c && c.querySelector("." + Fn)) && ((t = e).disabled = !1, t.focus(), t.blur(), t.disabled = !0), n.focus()) }, 400) } "load" === a && (s = Gn({}, s, { source: t })), i._emit(a, s) } break;
                    case "stripe-frame-action-response":
                        i && i.resolve(o.payload.nonce, o.payload.faRes); break;
                    case "stripe-frame-action-error":
                        i && i.reject(o.payload.nonce, Vn(o.payload.faErr)); break;
                    case "stripe-frame-error":
                        throw new S(o.payload.message);
                    case "stripe-integration-error":
                        i && i._emit("__privateIntegrationError", { message: o.payload.message }); break;
                    case "stripe-controller-load":
                        p._controllerFrame._emit("load", { source: t }), p._loadCount++, Object.keys(p._frames).forEach(function(e) { return p._frames[e].send({ action: "stripe-controller-load", payload: {} }) }); var l = p._createTimestamp.getAsPosixTime();
                        p._controllerFrame.send({ action: "stripe-user-mount", payload: { timestamps: { stripeJsLoad: p._stripeJsLoadTimestamp.getAsPosixTime(), stripeCreate: l, create: l, mount: p._mountTimestamp.getAsPosixTime() }, loadCount: p._loadCount, matchFrame: t === p._controllerFrame._iframe.contentWindow, rtl: !1, paymentRequestButtonType: null } }); break;
                    case "stripe-safe-controller-action-response":
                        p._requests[o.payload.nonce] && p._requests[o.payload.nonce].resolve(o.payload.caRes); break;
                    case "stripe-safe-controller-action-error":
                        p._requests[o.payload.nonce] && p._requests[o.payload.nonce].reject(Vn(o.payload.caErr)); break;
                    case "stripe-api-call":
                        Tn() } } },
        rr = Qn;

    function or() {! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, or); var e = function(e, t) { if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return !t || "object" != typeof t && "function" != typeof t ? e : t }(this, (or.__proto__ || Object.getPrototypeOf(or)).call(this)); return e.name = "NetworkError", e.type = "network_error", e } var ir = (function(e, t) { if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function, not " + typeof t);
            e.prototype = Object.create(t && t.prototype, { constructor: { value: e, enumerable: !1, writable: !0, configurable: !0 } }), t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t) }(or, Error), or),
        ar = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e },
        sr = function f(m) { return new E(function(e, t) { var n = m.method,
                    r = m.url,
                    o = m.data,
                    i = m.headers,
                    a = m.withCredentials,
                    s = m.contentType,
                    c = void 0 === s ? "application/x-www-form-urlencoded" : s,
                    u = "";
                o && "application/x-www-form-urlencoded" === c ? u = Me(o) : o && "application/json" === c && (u = JSON.stringify(o)); var l = "GET" === n && u ? r + "?" + u : r,
                    p = "GET" === n ? "" : u,
                    d = new XMLHttpRequest;
                a && (d.withCredentials = a), d.open(n, l, !0), d.setRequestHeader("Accept", "application/json"), d.setRequestHeader("Content-Type", c), i && Object.keys(i).forEach(function(e) { var t = i[e]; "string" == typeof t && d.setRequestHeader(e, t) }), d.onreadystatechange = function() { 4 === d.readyState && (d.onreadystatechange = function() {}, 0 === d.status ? a ? t(new ir) : f(ar({}, m, { withCredentials: !0 })).then(e, t) : e(d)) }; try { d.send(p) } catch (e) { t(e) } }) },
        cr = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e };

    function ur(e, c) { var t = e.reduce(function(e, t) { var n, r, o, i = function(e, t) { var n = e.indexOf(":"); if (-1 === n) throw new S("Invalid css declaration in file from " + t + ': "' + e + '"'); var r = e.slice(0, n).trim(),
                        o = ge[r]; if (!o) throw new S("Unsupported css property in file from " + t + ': "' + r + '"'); return { property: o, value: e.slice(n + 1).trim() } }(t, c),
                a = i.property,
                s = i.value; return cr({}, e, (o = s, (r = a) in (n = {}) ? Object.defineProperty(n, r, { value: o, enumerable: !0, configurable: !0, writable: !0 }) : n[r] = o, n)) }, {}); return ["family", "src"].forEach(function(e) { if (!t[e]) throw new S("Missing css property in file from " + c + ': "' + be[e] + '"') }), t }

    function lr(e, t) { var n, r, o, i = "string" == typeof(n = e) && w(Object.keys(Ln), function(e) { return e === n }) || null; if (!i || (r = t, (o = Cn[i]) && !jn(r, o))) { var a = "string" == typeof e ? e : void 0 === e ? "undefined" : mr(e); throw new S("A valid Element name must be provided. Valid Elements are:\n  " + Object.keys(Ln).filter(function(e) { return !Ln[e].beta }).join(", ") + "; you passed: " + a + ".") } } var pr, dr = function(r) { return sr({ url: r, method: "GET" }).then(function(e) { return e.responseText }).then(function(e) { return function(e, t) { var n = e.match(/@font-face[ ]?{[^}]*}/g); if (!n) throw new S("No @font-face rules found in file from " + t); return n }(e, r).map(function(e) { var t, n = function(e, t) { var n = e.replace(/\/\*.*\*\//g, "").trim(),
                            r = (n.length && /;$/.test(n) ? n : n + ";").match(/((([^;(]*\([^()]*\)[^;)]*)|[^;]+)+)(?=;)/g); if (!r) throw new S("Found @font-face rule containing no valid font-properties in file from " + t); return r }((t = e.match(/@font-face[ ]?{([^}]*)}/)) ? t[1] : "", r); return ur(n, r) }) }) },
        fr = (pr = ["hu", "mt", "tr", "zh-HK", "zh-TW"], function(e, t) { return jn(t, In.stripe_js_beta_locales) || -1 === pr.indexOf(e) ? e : "auto" }),
        mr = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) { return typeof e } : function(e) { return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e },
        hr = function(e, t, n) { var r, o = 0 < arguments.length && void 0 !== e ? e : "1.2em",
                i = 1 < arguments.length && void 0 !== t ? t : "14px",
                a = 1 === (r = (2 < arguments.length && void 0 !== n ? n : "0").split(" ").map(function(e) { return parseInt(e.trim(), 10) })).length || 2 === r.length ? 2 * r[0] : 3 === r.length || 4 === r.length ? r[0] + r[2] : 0; if ("string" == typeof o && /^[0-9.]+px$/.test(o)) return parseFloat(o.toString().replace(/[^0-9.]/g, "")) + a + "px"; var s = parseFloat(o.toString().replace(/[^0-9.]/g, "")),
                c = parseFloat("14px".replace(/[^0-9.]/g, "")),
                u = parseFloat(i.toString().replace(/[^0-9.]/g, "")),
                l = void 0; if ("string" == typeof i && /^(\d+|\d*\.\d+)px$/.test(i)) l = u;
            else if ("string" == typeof i && /^(\d+|\d*\.\d+)em$/.test(i)) l = u * c;
            else if ("string" == typeof i && /^(\d+|\d*\.\d+)%$/.test(i)) l = u / 100 * c;
            else { if ("string" != typeof i || !/^[\d.]+$/.test(i) && !/^\d*\.(px|em|%)$/.test(i)) return "100%";
                l = c } var p = s * l + a + "px"; return /^[0-9.]+px$/.test(p) ? p : "100%" },
        _r = function(e, n) { return e.reduce(function(e, t) { return e.then(function(e) { return "SATISFIED" === e.type ? e : t().then(function(e) { return n(e) ? { type: "SATISFIED", value: e } : { type: "UNSATISFIED" } }) }) }, E.resolve({ type: "UNSATISFIED" })) },
        yr = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e },
        vr = { success: "success", fail: "fail", invalid_shipping_address: "invalid_shipping_address" },
        br = { shipping: "shipping", delivery: "delivery", pickup: "pickup" },
        gr = yr({ success: "success" }, { fail: "fail", invalid_payer_name: "invalid_payer_name", invalid_payer_email: "invalid_payer_email", invalid_payer_phone: "invalid_payer_phone", invalid_shipping_address: "invalid_shipping_address" }),
        wr = { merchantCapabilities: ["supports3DS"], displayItems: [] };

    function Er(e) { if (Array.isArray(e)) { for (var t = 0, n = Array(e.length); t < e.length; t++) n[t] = e[t]; return n } return Array.from(e) }

    function Sr(e) { if (window.ApplePaySession) try { return window.ApplePaySession.supportsVersion(e) } catch (e) { return } } var Pr, kr, Or, Ar = ue({ amount: function(e, t) { return $(!0)(e, t) }, label: Y, pending: q(K) }),
        Tr = ue({ amount: X, label: Y, pending: q(K) }),
        Ir = ue({ amount: X, label: Y, pending: q(K), id: W(Y, function() { return Pe("shippingOption") }), detail: W(Y, function() { return "" }) }),
        Cr = z.apply(void 0, Er(Object.keys(br))),
        Rr = ue({ origin: Y, name: Y }),
        jr = ue({ displayItems: q(Q(Tr)), shippingOptions: q(ee("id")(Q(Ir))), total: Ar, requestShipping: q(K), requestPayerName: q(K), requestPayerEmail: q(K), requestPayerPhone: q(K), shippingType: q(Cr), currency: se, country: ae, jcbEnabled: q(K), __billingDetailsEmailOverride: q(Y), __minApplePayVersion: q(V), __merchantDetails: q(Rr), __skipGooglePayInPaymentRequest: q(K), __isCheckout: q(K) }),
        Nr = ce({ currency: q(se), displayItems: q(Q(Tr)), shippingOptions: q(ee("id")(Q(Ir))), total: q(Ar) }),
        Mr = ue({ displayItems: q(Q(Tr)), shippingOptions: q(ee("id")(Q(Ir))), total: q(Ar), status: function(e, t) { return z.apply(void 0, Er(Object.keys(vr)))(-1 !== ["invalid_payer_name", "invalid_payer_email", "invalid_payer_phone"].indexOf(e) ? "fail" : e, t) } }),
        xr = z.apply(void 0, Er(Object.keys(gr))),
        Lr = function(e) { return window.ApplePaySession ? ["APPLE_PAY"] : jn(e, In.google_pay_beta_2) ? ["GOOGLE_PAY"] : jn(e, In.google_pay_beta_1) ? ["GOOGLE_PAY", "BROWSER"] : ["BROWSER"] },
        Dr = 2,
        Br = (Pr = function(e) { return window.ApplePaySession.canMakePaymentsWithActiveCard(e) }, kr = {}, Or = {}, function(e) { var t = "_" + e; if ("string" == typeof e && void 0 !== kr[t]) return kr[t]; if ("number" == typeof e && void 0 !== Or[t]) return Or[t]; var n = Pr(e); return "string" == typeof e && (kr[t] = n), "number" == typeof e && (Or[t] = n), n }),
        qr = function(n, r, o, i, e) { var t = 4 < arguments.length && void 0 !== e ? e : Dr,
                a = Math.max(Dr, t); if (window.ApplePaySession) { if (function() { try { return window.location.origin === window.top.location.origin } catch (e) { return !1 } }()) { if (window.ApplePaySession.supportsVersion(a)) { var s = "merchant." + (r ? [n, r] : [n]).join(".") + ".stripe"; return Br(s).then(function(e) { var t; return i("pr.apple_pay.can_make_payment_native_response", { available: e }), o && !e && window.console && (t = r ? "or stripeAccount parameter (" + r + ") " : "", window.console.warn("Either you do not have a card saved to your Wallet or the current domain (" + n + ") " + t + "is not registered for Apple Pay. Visit https://dashboard.stripe.com/account/apple_pay to register this domain.")), e }) } return o && window.console && window.console.warn("This version of Safari does not support ApplePay JS version " + a + "."), E.resolve(!1) } return E.resolve(!1) } return E.resolve(!1) };

    function Fr(e) { if (Array.isArray(e)) { for (var t = 0, n = Array(e.length); t < e.length; t++) n[t] = e[t]; return n } return Array.from(e) }

    function Ur(e, t) { var n = "US" === e || t ? ["discover", "diners", "jcb"].concat(Wr) : Wr; return -1 !== Kr.indexOf(e) ? ["amex"].concat(Fr(n)) : n }

    function Hr(e, t) { var n, r = { unitSize: 1 / (n = Vr[t.toLowerCase()] || 100), fractionDigits: Math.ceil(Math.log(n) / Math.log(10)) }; return (e * r.unitSize).toFixed(r.fractionDigits) } var zr, Gr, Yr, Wr = ["mastercard", "visa"],
        Kr = ["AT", "AU", "BE", "CA", "CH", "DE", "DK", "EE", "ES", "FI", "FR", "GB", "GR", "HK", "IE", "IT", "JP", "LT", "LU", "LV", "MX", "NL", "NO", "NZ", "PL", "PT", "SE", "SG", "US"],
        Vr = { bif: 1, clp: 1, djf: 1, gnf: 1, jpy: 1, kmf: 1, krw: 1, mga: 1, pyg: 1, rwf: 1, vnd: 1, vuv: 1, xaf: 1, xof: 1, xpf: 1, bhd: 1e3, jod: 1e3, kwd: 1e3, omr: 1e3, tnd: 1e3 },
        Jr = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e };

    function $r(e, t, n) { return t in e ? Object.defineProperty(e, t, { value: n, enumerable: !0, configurable: !0, writable: !0 }) : e[t] = n, e }

    function Xr(e, t) { return { amount: Hr(e.amount, t.currency), label: e.label, type: e.pending ? "pending" : "final" } }

    function Zr(e, t) { return new window.ApplePayError(e, t) }

    function Qr(t) { return function(e) { return e[t] && "string" == typeof e[t] ? e[t].toUpperCase() : null } } var eo, to = ($r(zr = {}, gr.success, 0), $r(zr, gr.fail, 1), $r(zr, gr.invalid_payer_name, 2), $r(zr, gr.invalid_shipping_address, 3), $r(zr, gr.invalid_payer_phone, 4), $r(zr, gr.invalid_payer_email, 4), zr),
        no = ($r(Gr = {}, gr.success, function() { return null }), $r(Gr, gr.fail, function() { return null }), $r(Gr, gr.invalid_payer_name, function() { return Zr("billingContactInvalid", "name") }), $r(Gr, gr.invalid_shipping_address, function() { return Zr("shippingContactInvalid", "postalAddress") }), $r(Gr, gr.invalid_payer_phone, function() { return Zr("shippingContactInvalid", "phoneNumber") }), $r(Gr, gr.invalid_payer_email, function() { return Zr("shippingContactInvalid", "emailAddress") }), Gr),
        ro = ($r(Yr = {}, br.pickup, "storePickup"), $r(Yr, br.shipping, "shipping"), $r(Yr, br.delivery, "delivery"), Yr),
        oo = { total: function(e) { return Xr(e.total, e) }, lineItems: function(t) { return t.displayItems ? t.displayItems.map(function(e) { return Xr(e, t) }) : [] }, shippingMethods: function(r) { return r.shippingOptions ? r.shippingOptions.map(function(e) { return n = r, { amount: Hr((t = e).amount, n.currency), label: t.label, detail: t.detail, identifier: t.id }; var t, n }) : [] } },
        io = { shippingType: function(e) { var t = e.shippingType; if (!t) return null; var n = ro[t]; if (void 0 !== n) return n; throw new S("Invalid value for shippingType: " + t) }, requiredBillingContactFields: function(e) { return e.requestPayerName ? ["postalAddress"] : null }, requiredShippingContactFields: function(e) { var t = []; return e.requestShipping && t.push("postalAddress"), e.requestPayerEmail && t.push("email"), e.requestPayerPhone && t.push("phone"), t.length ? t : null }, countryCode: Qr("country"), currencyCode: Qr("currency"), merchantCapabilities: (eo = "merchantCapabilities", function(e) { return e[eo] || null }), supportedNetworks: function(e) { var t, n, r = (t = e.country, n = e.jcbEnabled || !1, Ur(t, n).reduce(function(e, t) { return "mastercard" === t ? [].concat(Fr(e), ["masterCard"]) : "diners" === t ? e : [].concat(Fr(e), [t]) }, [])); return Sr(4) && r.push("maestro"), r } },
        ao = { status: function(e) { var t = to[e.status]; return Sr(3) && 1 < t ? 1 : t }, error: function(e) { return Sr(3) ? no[e.status]() : null } },
        so = Jr({}, oo, io),
        co = Jr({}, oo, ao),
        uo = function(e) { var r = Jr({}, wr, e); return Object.keys(so).reduce(function(e, t) { var n = (0, so[t])(r); return null !== n ? Jr({}, e, $r({}, t, n)) : e }, {}) },
        lo = function(r) { return Object.keys(co).reduce(function(e, t) { var n = (0, co[t])(r); return null !== n ? Jr({}, e, $r({}, t, n)) : e }, {}) };

    function po(e) { return "string" == typeof e ? e : null }

    function fo(e) { return e ? [e.givenName, e.familyName].filter(function(e) { return e && "string" == typeof e }).join(" ") : null } var mo = function(e) { var t = e.addressLines,
                n = e.countryCode,
                r = e.postalCode,
                o = e.administrativeArea,
                i = e.locality,
                a = e.phoneNumber,
                s = po(n); return { addressLine: Array.isArray(t) ? t.reduce(function(e, t) { return "string" == typeof t ? [].concat(function(e) { if (Array.isArray(e)) { for (var t = 0, n = Array(e.length); t < e.length; t++) n[t] = e[t]; return n } return Array.from(e) }(e), [t]) : e }, []) : [], country: s ? s.toUpperCase() : "", postalCode: po(r) || "", recipient: fo(e) || "", region: po(o) || "", city: po(i) || "", phone: po(a) || "", sortingCode: "", dependentLocality: "", organization: "" } },
        ho = function(e, t) { var n = e.identifier,
                r = e.label; return t.filter(function(e) { return e.id === n && e.label === r })[0] },
        _o = function(e, t) { var n, r, o = e.shippingContact,
                i = e.shippingMethod,
                a = e.billingContact; return { shippingOption: i && t.shippingOptions && t.shippingOptions.length ? ho(i, t.shippingOptions) : null, shippingAddress: o ? mo(o) : null, payerEmail: (r = o) ? po(r.emailAddress) : null, payerPhone: (n = o) ? po(n.phoneNumber) : null, payerName: fo(a), methodName: "apple-pay" } },
        yo = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e };

    function vo(e, t) { for (var n = 0; n < t.length; n++) { var r = t[n];
            r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r) } } var bo = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) { return typeof e } : function(e) { return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e }; var go = { austria: "AT", sterreich: "AT", csterreich: "AT", au: "AU", australia: "AU", belgium: "BE", br: "BR", brasil: "BR", brazil: "BR", ca: "CA", canada: "CA", ch: "CH", schweiz: "CH", switzerland: "CH", china: "CN", czechrepublic: "CZ", de: "DE", deutschland: "DE", germany: "DE", danmark: "DK", denmark: "DK", es: "ES", espaa: "ES", spain: "ES", finland: "FI", suomi: "FI", fr: "FR", hk: "HK", hongkong: "HK", england: "GB", gb: "GB", uk: "GB", unitedkingdom: "GB", scotland: "GB", wales: "GB", it: "IT", italy: "IT", italia: "IT", japan: "JP", lietuva: "LT", luxembourg: "LU", netherlands: "NL", nederland: "NL", norway: "NO", poland: "PL", polska: "PL", russia: "RU", saudiarabia: "SA", se: "SE", sweden: "SE", sverige: "SE", singapore: "SG", us: "US", usa: "US", unitedstatesofamerica: "US", unitedstates: "US", estadosunidos: "US" },
        wo = function(e, t) { return e && "object" === (void 0 === e ? "undefined" : bo(e)) ? t(e) : null };

    function Eo(e) { var s = this;! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, Eo), this._onEvent = function() {}, this.setEventHandler = function(e) { s._onEvent = e }, this.canMakePayment = function() { return qr(window.location.hostname, s._authentication.accountId, A(s._authentication.apiKey) === O.test, s._report, s._minimumVersion) }, this.update = function(e) { s._initialPaymentRequest = un(s._paymentRequestOptions, e), s._initializeSessionState() }, this.show = function() { s._initializeSessionState(); var e = void 0; try { e = new window.ApplePaySession(s._minimumVersion, uo(s._paymentRequestOptions)) } catch (e) { throw "Must create a new ApplePaySession from a user gesture handler." === e.message ? new S("show() must be called from a user gesture handler (such as a click handler, after the user clicks a button).") : e }
            s._privateSession = e, s._setupSession(e, s._usesButtonElement()), e.begin(), s._isShowing = !0 }, this.abort = function() { s._privateSession && s._privateSession.abort() }, this._warn = function(e) {}, this._report = function(e, t) { s._controller.report(e, yo({}, t, { backingLibrary: "APPLE_PAY", usesButtonElement: s._usesButtonElement() })) }, this._validateMerchant = function(t, n) { return function(e) { s._controller.action.createApplePaySession({ data: { validation_url: e.validationURL, domain_name: window.location.hostname, display_name: s._paymentRequestOptions.total.label }, usesButtonElement: n }).then(function(e) { if (s._isShowing) switch (e.type) {
                        case "object":
                            t.completeMerchantValidation(JSON.parse(e.object.session)); break;
                        case "error":
                            s._handleValidationError(t)(e.error); break;
                        default:
                            Object(m.a)(e) } }, s._handleValidationError(t)) } }, this._handleValidationError = function(n) { return function(e) { s._report("error.pr.apple_pay.session_creation_failed", { error: e }), n.abort(); var t = e.message; "string" == typeof t && s._controller.warn(t) } }, this._paymentAuthorized = function(i) { return function(e) { var o = e.payment,
                    t = s._usesButtonElement() ? fe.paymentRequestButton : null;
                s._controller.action.tokenizeWithData({ type: "apple_pay", elementName: t, tokenData: yo({}, o, { billingContact: wo(o.billingContact, s._normalizeContact) }), mids: s._mids }).then(function(e) { var t, n, r; "error" === e.type ? (i.completePayment(window.ApplePaySession.STATUS_FAILURE), s._report("error.pr.create_token_failed", { error: e.error })) : (t = wo(o.shippingContact, s._normalizeContact), n = wo(o.billingContact, s._normalizeContact), t && s._paymentRequestOptions.requestShipping && !t.countryCode && i.completePayment(window.ApplePaySession.STATUS_INVALID_SHIPPING_POSTAL_ADDRESS), r = _o({ shippingContact: t, billingContact: n }, s._paymentRequestOptions), s._onToken(i)(yo({}, r, { shippingOption: s._privateShippingOption, token: e.object }))) }) } }, this._normalizeContact = function(e) { if (e.country && "string" == typeof e.country) { var t = e.country.toLowerCase().replace(/[^a-z]+/g, ""),
                    n = void 0; return e.countryCode ? "string" == typeof e.countryCode && (n = e.countryCode.toUpperCase()) : (n = go[t]) || s._report("warn.pr.apple_pay.missing_country_code", { country: e.country }), yo({}, e, { countryCode: n }) } return e }, this._onToken = function(t) { return function(e) { s._onEvent({ type: "paymentresponse", payload: yo({}, e, { complete: s._completePayment(t) }) }) } }, this._completePayment = function(o) { return function(e) { s._paymentRequestOptions = un(s._paymentRequestOptions, { status: e }); var t = lo(s._paymentRequestOptions),
                    n = t.status,
                    r = t.error;
                r ? o.completePayment({ status: n, errors: [r] }) : o.completePayment(n), (0 === n || 1 === n && null == r) && (s._isShowing = !1, s._onEvent && s._onEvent({ type: "close" })) } }, this._shippingContactSelected = function(t) { return function(e) { s._onEvent({ type: "shippingaddresschange", payload: { shippingAddress: mo(s._normalizeContact(e.shippingContact)), updateWith: s._completeShippingContactSelection(t) } }) } }, this._completeShippingContactSelection = function(a) { return function(e) { s._paymentRequestOptions = un(s._paymentRequestOptions, e), s._paymentRequestOptions.shippingOptions && s._paymentRequestOptions.shippingOptions.length && (s._privateShippingOption = s._paymentRequestOptions.shippingOptions[0]); var t = lo(s._paymentRequestOptions),
                    n = t.status,
                    r = t.shippingMethods,
                    o = t.total,
                    i = t.lineItems;
                a.completeShippingContactSelection(n, r, o, i) } }, this._shippingMethodSelected = function(n) { return function(e) { var t;
                s._paymentRequestOptions.shippingOptions && (t = ho(e.shippingMethod, s._paymentRequestOptions.shippingOptions), s._privateShippingOption = t, s._onEvent({ type: "shippingoptionchange", payload: { shippingOption: t, updateWith: s._completeShippingMethodSelection(n) } })) } }, this._completeShippingMethodSelection = function(i) { return function(e) { s._paymentRequestOptions = un(s._paymentRequestOptions, e); var t = lo(s._paymentRequestOptions),
                    n = t.status,
                    r = t.total,
                    o = t.lineItems;
                i.completeShippingMethodSelection(n, r, o) } }; var t = e.controller,
            n = e.authentication,
            r = e.mids,
            o = e.options,
            i = e.usesButtonElement,
            a = e.listenerRegistry;
        this._controller = t, this._authentication = n, this._mids = r, this._minimumVersion = o.__minApplePayVersion || Dr, this._usesButtonElement = i, this._listenerRegistry = a, this._initialPaymentRequest = o, this._isShowing = !1, this._initializeSessionState() } var So = (function(e, t, n) { return t && vo(e.prototype, t), n && vo(e, n), e }(Eo, [{ key: "_initializeSessionState", value: function() { this._paymentRequestOptions = yo({}, wr, this._initialPaymentRequest, { status: gr.success }), this._privateSession = null, this._privateShippingOption = null; var e = this._paymentRequestOptions.shippingOptions;
                e && e.length && (this._privateShippingOption = e[0]) } }, { key: "_setupSession", value: function(e, t) { var n = this;
                this._listenerRegistry.addEventListener(e, "validatemerchant", je(this._validateMerchant(e, t))), this._listenerRegistry.addEventListener(e, "paymentauthorized", je(this._paymentAuthorized(e))), this._listenerRegistry.addEventListener(e, "cancel", je(function() { n._isShowing = !1, n._onEvent({ type: "cancel" }), n._onEvent({ type: "close" }) })), this._listenerRegistry.addEventListener(e, "shippingcontactselected", je(this._shippingContactSelected(e))), this._listenerRegistry.addEventListener(e, "shippingmethodselected", je(this._shippingMethodSelected(e))) } }]), Eo),
        Po = null; var ko = function(e) { return null !== Po ? E.resolve(Po) : e().then(function(e) { return Po = e }) },
        Oo = function() { return !(!wt && !Et) },
        Ao = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e }; var To = function e(t) { var i = this;! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, e), this._mids = null, this._frame = null, this._initFrame = function(e) { var t = i._controller.createHiddenFrame(pe.PAYMENT_REQUEST_GOOGLE_PAY, { authentication: i._authentication, mids: i._mids, origin: i._origin });
                t.send({ action: "stripe-pr-initialize", payload: { data: e } }), i._initFrameEventHandlers(t), i._frame = t }, this._initFrameEventHandlers = function(o) { o._on("pr-cancel", function() { i._onEvent({ type: "cancel" }) }), o._on("pr-close", function() { i._backdrop.fadeOut().then(function() { i._backdrop.unmount() }), i._onEvent({ type: "close" }) }), o._on("pr-error", function(e) { i._onEvent({ type: "error", payload: { errorMessage: e.errorMessage, errorCode: e.errorCode } }) }), o._on("pr-callback", function(e) { var t = e.event,
                        n = e.options,
                        r = e.nonce; switch (t) {
                        case "paymentresponse":
                            i._handlePaymentResponse(o, n, r); break;
                        case "shippingaddresschange":
                            i._handleShippingAddressChange(o, n, r); break;
                        case "shippingoptionchange":
                            i._handleShippingOptionChange(o, n, r); break;
                        default:
                            throw new Error("Unexpected event name: " + t) } }) }, this._handlePaymentResponse = function(t, e, n) { i._onEvent({ type: "paymentresponse", payload: Ao({}, e, { complete: function(e) { t.send({ action: "stripe-pr-callback-complete", payload: { nonce: n, data: { status: e } } }) } }) }) }, this._handleShippingAddressChange = function(t, e, n) { i._onEvent({ type: "shippingaddresschange", payload: Ao({}, e, { updateWith: function(e) { t.send({ action: "stripe-pr-callback-complete", payload: { nonce: n, data: e } }) } }) }) }, this._handleShippingOptionChange = function(t, e, n) { i._onEvent({ type: "shippingoptionchange", payload: Ao({}, e, { updateWith: function(e) { t.send({ action: "stripe-pr-callback-complete", payload: { nonce: n, data: e } }) } }) }) }, this.setEventHandler = function(e) { i._onEvent = e }, this.canMakePayment = function() { if (!Oo()) return E.resolve(!1); if (!i._frame) throw new Error("Frame not initialized."); var e = i._frame; return ko(function() { return e.action.checkCanMakePayment().then(function(e) { return !0 === e.available }) }) }, this.show = function() { i._frame && (i._frame.send({ action: "stripe-pr-show", payload: { data: { usesButtonElement: i._usesButtonElement() } } }), i._backdrop.mount(), i._backdrop.show(), i._backdrop.fadeIn()) }, this.update = function(e) { i._frame && i._frame.send({ action: "stripe-pr-update", payload: { data: e } }) }, this.abort = function() { i._frame && i._frame.send({ action: "stripe-pr-abort", payload: {} }) }, this._controller = t.controller, this._authentication = t.authentication, this._mids = t.mids, this._origin = t.origin, this._usesButtonElement = t.usesButtonElement, this._backdrop = new xt({ lockScrolling: !1, lockFocus: !0, lockFocusOn: null, listenerRegistry: t.listenerRegistry }), Oo() && this._controller && (this._controller.action.fetchLocale({ locale: "auto" }), this._initFrame(t.options)) },
        Io = function() { if (!window.PaymentRequest) return null; if (/CriOS\/59/.test(navigator.userAgent)) return null; if (/.*\(.*; wv\).*Chrome\/(?:53|54)\.\d.*/g.test(navigator.userAgent)) return null; if (gt) return null; var e = window.PaymentRequest; return e.prototype.canMakePayment || (e.prototype.canMakePayment = function() { return E.resolve(!1) }), e }(),
        Co = null,
        Ro = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e }; var jo = function() { var i = this;
            this._onEvent = function() {}, this.setEventHandler = function(e) { i._onEvent = e }, this.canMakePayment = function() { return e = i._prFrame, A(i._authentication.apiKey), O.test, null !== Co ? E.resolve(Co) : Io && e ? e.action.checkCanMakePayment().then(function(e) { var t = e.available; return Co = !0 === t }) : E.resolve(!1); var e }, this.update = function(e) { var t = i._prFrame;
                t && t.send({ action: "stripe-pr-update", payload: { data: e } }) }, this.show = function() { if (!i._prFrame) throw new S("Payment Request is not available in this browser.");
                i._prFrame.send({ action: "stripe-pr-show", payload: { data: { usesButtonElement: i._usesButtonElement() } } }) }, this.abort = function() { i._prFrame && i._prFrame.send({ action: "stripe-pr-abort", payload: {} }) }, this._setupPrFrame = function(o, e) { o.send({ action: "stripe-pr-initialize", payload: { data: e } }), o._on("pr-cancel", function() { i._onEvent({ type: "cancel" }) }), o._on("pr-close", function() { i._onEvent({ type: "close" }) }), o._on("pr-error", function(e) { i._onEvent({ type: "error", payload: { errorMessage: e.message || "", errorCode: e.code || "" } }) }), o._on("pr-callback", function(e) { var t = e.event,
                        n = e.nonce,
                        r = e.options; switch (t) {
                        case "token":
                            i._onEvent({ type: "paymentresponse", payload: Ro({}, r, { complete: function(e) { o.send({ action: "stripe-pr-callback-complete", payload: { data: { status: e }, nonce: n } }) } }) }); break;
                        case "shippingaddresschange":
                            i._onEvent({ type: "shippingaddresschange", payload: { shippingAddress: r.shippingAddress, updateWith: function(e) { o.send({ action: "stripe-pr-callback-complete", payload: { nonce: n, data: e } }) } } }); break;
                        case "shippingoptionchange":
                            i._onEvent({ type: "shippingoptionchange", payload: { shippingOption: r.shippingOption, updateWith: function(e) { o.send({ action: "stripe-pr-callback-complete", payload: { nonce: n, data: e } }) } } }); break;
                        default:
                            throw new Error("Unexpected event from PaymentRequest inner: " + t) } }) } },
        No = function e(t) {! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, e), jo.call(this); var n, r = t.authentication,
                o = t.controller,
                i = t.mids,
                a = t.origin,
                s = t.usesButtonElement,
                c = t.options;
            this._authentication = r, this._controller = o, this._usesButtonElement = s, Io && "https:" === window.location.protocol ? (this._controller.action.fetchLocale({ locale: "auto" }), n = this._controller.createHiddenFrame(pe.PAYMENT_REQUEST_BROWSER, { authentication: r, mids: i, origin: a }), this._setupPrFrame(n, c), this._prFrame = n) : this._prFrame = null },
        Mo = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e };

    function xo(e, t) { var n, r = {}; for (n in e) 0 <= t.indexOf(n) || Object.prototype.hasOwnProperty.call(e, n) && (r[n] = e[n]); return r } var Lo = (function(e, t) { if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function, not " + typeof t);
        e.prototype = Object.create(t && t.prototype, { constructor: { value: e, enumerable: !1, writable: !0, configurable: !0 } }), t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t) }(Do, He), Do);

    function Do(e) {! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, Do); var t = function(e, t) { if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return !t || "object" != typeof t && "function" != typeof t ? e : t }(this, (Do.__proto__ || Object.getPrototypeOf(Do)).call(this));
        Uo.call(t), t._controller = e.controller, t._authentication = e.authentication, t._mids = e.mids, t._listenerRegistry = e.listenerRegistry, t._report("pr.options", { options: e.rawOptions }); var n = le(jr, e.rawOptions || {}, "paymentRequest()"),
            r = n.value; if (n.warnings.forEach(function(e) { return t._warn(e) }), r.__billingDetailsEmailOverride && r.requestPayerEmail) throw new S("When providing `__billingDetailsEmailOverride`, `requestPayerEmail` has to be `false` so that the customer is not prompted for their email in the payment sheet."); return t._queryStrategy = e.queryStrategyOverride || Lr(e.betas), t._report("pr.query_strategy", { queryStrategy: t._queryStrategy }), t._initialOptions = Mo({}, r, { __skipGooglePayInPaymentRequest: -1 !== t._queryStrategy.indexOf("GOOGLE_PAY") }), jn(e.betas, In.google_pay_beta_2) && (t._shouldTimeout = !1), t._initBackingLibraries(t._initialOptions), t } var Bo, qo, Fo, Uo = function() { var f = this;
            this._shouldTimeout = !0, this._usedByButtonElement = null, this._showCalledByButtonElement = !1, this._isShowing = !1, this._backingLibraries = { APPLE_PAY: null, GOOGLE_PAY: null, BROWSER: null }, this._activeBackingLibraryName = null, this._activeBackingLibrary = null, this._canMakePaymentAvailability = { APPLE_PAY: null, GOOGLE_PAY: null, BROWSER: null }, this._canMakePaymentResolved = !1, this._validateUserOn = function(e, t) { "string" == typeof e && ("source" === e && f._hasRegisteredListener("paymentmethod") || "paymentmethod" === e && f._hasRegisteredListener("source")) && (f._report("pr.double_callback_registration"), f._controller.warn("Do not register event listeners for both `source` or `paymentmethod`. Only one of them will succeed.")) }, this._report = function(e, t) { f._controller.report(e, Mo({}, t, { activeBackingLibrary: f._activeBackingLibraryName, usesButtonElement: f._usedByButtonElement || !1 })) }, this._warn = function(e) { f._controller.warn(e) }, this._registerElement = function() { f._usedByButtonElement = !0 }, this._elementShow = function() { f._showCalledByButtonElement = !0, f.show() }, this._initBackingLibraries = function(n) { f._queryStrategy.forEach(function(e) { var t = { controller: f._controller, authentication: f._authentication, mids: f._mids, origin: window.location.origin, options: n, usesButtonElement: function() { return !0 === f._usedByButtonElement }, listenerRegistry: f._listenerRegistry }; switch (e) {
                        case "APPLE_PAY":
                            f._backingLibraries.APPLE_PAY = new So(t), f._backingLibraries.APPLE_PAY.setEventHandler(f._handleInternalEvent); break;
                        case "GOOGLE_PAY":
                            f._backingLibraries.GOOGLE_PAY = new To(t), f._backingLibraries.GOOGLE_PAY.setEventHandler(f._handleInternalEvent); break;
                        case "BROWSER":
                            f._backingLibraries.BROWSER = new No(t), f._backingLibraries.BROWSER.setEventHandler(f._handleInternalEvent); break;
                        default:
                            Object(m.a)(e) } }) }, this._handleInternalEvent = function(e) { switch (e.type) {
                    case "paymentresponse":
                        f._emitPaymentResponse(e.payload); break;
                    case "error":
                        f._report("error.pr.internal_error", { error: e.payload }); break;
                    case "close":
                        f._isShowing = !1; break;
                    default:
                        f._emitExternalEvent(e) } }, this._emitExternalEvent = function(a) { switch (a.type) {
                    case "cancel":
                        f._emit("cancel"); break;
                    case "shippingoptionchange":
                    case "shippingaddresschange":
                        var s = a.type,
                            c = a.payload,
                            u = null,
                            l = !1,
                            p = !1,
                            e = function(e) { if (p && l) return f._report("pr.update_with_called_after_timeout", { event: s }), void f._controller.warn("Call to updateWith() was ignored because it has already timed out. Please ensure that updateWith is called within 30 seconds."); if (l) return f._report("pr.update_with_double_call", { event: s }), void f._controller.warn("Call to updateWith() was ignored because it has already been called. Do not call updateWith more than once.");
                                u && clearTimeout(u), l = !0, f._report("pr.update_with", { event: s, updates: e }); var t = le(Mr, e || {}, s + " callback"),
                                    n = t.value;
                                t.warnings.forEach(function(e) { return f._controller.warn(e) }); var r = n,
                                    o = !1;
                                f._initialOptions.__isCheckout && "APPLE_PAY" === f._activeBackingLibraryName && n.shippingOptions && 1 === n.shippingOptions.length && 0 === n.shippingOptions[0].amount && (n.shippingOptions, r = xo(n, ["shippingOptions"]), o = !0); var i = n.shippingOptions || f._initialOptions.shippingOptions; if (!(o || "shippingaddresschange" !== a.type || n.status !== gr.success || i && i.length)) throw new S("When requesting shipping information, you must specify shippingOptions once a shipping address is selected.\nEither provide shippingOptions in stripe.paymentRequest(...) or listen for the shippingaddresschange event and provide shippingOptions to the updateWith callback there.");
                                c.updateWith(r) };
                        f._hasRegisteredListener(a.type) ? (u = setTimeout(function() { p = !0, f._report("pr.update_with_timed_out", { event: s }), f._controller.warn('Timed out waiting for a call to updateWith(). If you listen to "' + a.type + '" events, then you must call event.updateWith in the "' + a.type + '" handler within 30 seconds.'), e({ status: "fail" }) }, 29900), f._emit(s, Mo({}, c, { updateWith: e }))) : e({ status: "success" }); break;
                    case "token":
                    case "source":
                    case "paymentmethod":
                        var t = a.type,
                            r = a.payload,
                            o = null,
                            i = !1,
                            d = !1,
                            n = function(e) { if (i && d) return f._report("pr.complete_called_after_timeout"), void f._controller.warn("Call to complete() was ignored because it has already timed out. Please ensure that complete is called within 30 seconds."); if (d) return f._report("pr.complete_double_call"), void f._controller.warn("Call to complete() was ignored because it has already been called. Do not call complete more than once.");
                                o && clearTimeout(o), d = !0; var t = le(xr, e, "status for PaymentRequest completion"),
                                    n = t.value;
                                t.warnings.forEach(function(e) { return f._controller.warn(e) }), r.complete(n) },
                            o = setTimeout(function() { i = !0, f._report("pr.complete_timed_out"), f._controller.warn('Timed out waiting for a call to complete(). Once you have processed the payment in the "' + a.type + '" handler, you must call event.complete within 30 seconds.'), n("fail") }, 29900);
                        f._emit(t, Mo({}, r, { complete: n })); break;
                    default:
                        Object(m.a)(a) } }, this._maybeEmitPaymentResponse = function(e) { f._isShowing && f._emitExternalEvent(e) }, this._emitPaymentResponse = function(e) { f._report("pr.payment_authorized"); var t = e.token,
                    n = xo(e, ["token"]),
                    r = n.payerEmail,
                    o = n.payerPhone,
                    i = n.complete,
                    a = f._showCalledByButtonElement ? fe.paymentRequestButton : null;
                f._hasRegisteredListener("token") && f._maybeEmitPaymentResponse({ type: "token", payload: e }), f._hasRegisteredListener("source") && f._controller.action.createSourceWithData({ elementName: a, type: "card", sourceData: { token: t.id, owner: { email: f._initialOptions.__billingDetailsEmailOverride || r, phone: o } }, mids: null }).then(function(e) { "error" === e.type ? e.error.code && "email_invalid" === e.error.code ? i("invalid_payer_email") : (f._report("fatal.pr.token_to_source_failed", { error: e.error, token: t.id }), i("fail")) : f._maybeEmitPaymentResponse({ type: "source", payload: Mo({}, n, { source: e.object }) }) }), f._hasRegisteredListener("paymentmethod") && f._controller.action.createPaymentMethodWithData({ elementName: a, type: "card", paymentMethodData: { card: { token: t.id }, billing_details: { email: f._initialOptions.__billingDetailsEmailOverride || r, phone: o } }, mids: null }).then(function(e) { "error" === e.type ? e.error.code && "email_invalid" === e.error.code ? i("invalid_payer_email") : (f._report("fatal.pr.token_to_payment_method_failed", { error: e.error, token: t.id }), i("fail")) : f._maybeEmitPaymentResponse({ type: "paymentmethod", payload: Mo({}, n, { paymentMethod: e.object }) }) }) }, this._canMakePaymentForBackingLibrary = function(o) { var e = f._backingLibraries[o]; if (!e) throw new Error("Unexpectedly calling canMakePayment on uninitialized backing library."); return E.race([new E(function(e) { f._shouldTimeout && setTimeout(e, 1e4) }).then(function() { return !1 }), e.canMakePayment().then(function(e) { return !!e })]).then(function(e) { var t, n, r; return f._canMakePaymentAvailability = Mo({}, f._canMakePaymentAvailability, (r = e, (n = o) in (t = {}) ? Object.defineProperty(t, n, { value: r, enumerable: !0, configurable: !0, writable: !0 }) : t[n] = r, t)), { backingLibraryName: o, available: e } }) }, this._constructCanMakePaymentResponse = function() { return Mo({ applePay: !!f._canMakePaymentAvailability.APPLE_PAY }, -1 !== f._queryStrategy.indexOf("GOOGLE_PAY") ? { googlePay: !!f._canMakePaymentAvailability.GOOGLE_PAY } : {}) }, this.canMakePayment = je(function() { if (f._report("pr.can_make_payment"), f._canMakePaymentResolved) { var e = null !== f._activeBackingLibrary ? f._constructCanMakePaymentResponse() : null; return f._report("pr.can_make_payment_response", { response: e, cached: !0 }), E.resolve(e) } if ("https:" !== window.location.protocol) return f._controller.warn("If you are testing the PaymentRequest button (to accept Apple Pay, Google Pay, etc.) you must serve this page over HTTPS as it will not work over HTTP. Please read https://stripe.com/docs/stripe-js/elements/payment-request-button#html-js-prerequisites for more details."), f._canMakePaymentResolved = !0, E.resolve(null); var t = f._queryStrategy.map(function(e) { return function() { return f._canMakePaymentForBackingLibrary(e) } }),
                    r = new b; return _r(t, function(e) { var t = e.backingLibraryName,
                        n = e.available; return n && (f._activeBackingLibraryName = t, f._activeBackingLibrary = f._backingLibraries[t]), n }).then(function(e) { var t = new b;
                    f._canMakePaymentResolved = !0; var n = null; return "SATISFIED" === e.type && (n = f._constructCanMakePaymentResponse()), f._report("pr.can_make_payment_response", { response: n, cached: !1, duration: r.getElapsedTime(t) }), n }) }), this.update = je(function(e) { if (f._isShowing) throw f._report("pr.update_called_while_showing"), new S("You cannot update Payment Request options while the payment sheet is showing.");
                f._report("pr.update", { updates: e }); var t = le(Nr, e, "PaymentRequest update()"),
                    n = t.value;
                t.warnings.forEach(function(e) { return f._warn(e) }), f._activeBackingLibrary && f._activeBackingLibrary.update(n) }), this.show = je(function() { if (f._usedByButtonElement && !f._showCalledByButtonElement && (f._report("pr.show_called_with_button"), f._warn("Do not call show() yourself if you are using the paymentRequestButton Element. The Element handles showing the payment sheet.")), !f._canMakePaymentResolved) throw f._report("pr.show_called_before_can_make_payment"), new S("You must first check the Payment Request API's availability using paymentRequest.canMakePayment() before calling show()."); if (!f._activeBackingLibrary) throw f._report("pr.show_called_with_can_make_payment_false"), new S("Payment Request is not available in this browser."); var e = f._activeBackingLibrary;
                f._report("pr.show", { listeners: Object.keys(f._callbacks).sort() }), f._isShowing = !0, e.show() }), this.abort = je(function() { var e;
                f._activeBackingLibrary && (e = f._activeBackingLibrary, f._report("pr.abort"), e.abort()) }), this.isShowing = function() { return f._isShowing } },
        Ho = Lo,
        zo = { base: q(Z), complete: q(Z), empty: q(Z), invalid: q(Z), paymentRequestButton: q(Z) },
        Go = { classes: q(ue({ base: q(Y), complete: q(Y), empty: q(Y), focus: q(Y), invalid: q(Y), webkitAutofill: q(Y) })), hidePostalCode: q(K), hideIcon: q(K), showIcon: q(K), style: q(ue(zo)), iconStyle: q(z("solid", "default")), value: q(F(Y, Z)), __privateCvcOptional: q(K), __privateValue: q(F(Y, Z)), __privateEmitIbanValue: q(K), error: q(ue({ type: Y, code: q(Y), decline_code: q(Y), param: q(Y) })), locale: te("elements()"), fonts: te("elements()"), placeholder: q(Y), disabled: q(K), placeholderCountry: q(Y), paymentRequest: q((Bo = Ho, qo = "stripe.paymentRequest(...)", function(e, t) { return e instanceof Bo ? M(e) : D("a " + qo + " instance", e, t) })), supportedCountries: q(Q(Y)), accountHolderType: q(z("individual", "company")), issuingCard: q(Y) },
        Yo = ue(Go);

    function Wo(e, t, n) { return t in e ? Object.defineProperty(e, t, { value: n, enumerable: !0, configurable: !0, writable: !0 }) : e[t] = n, e }

    function Ko(e, t) { return (n = e) !== fe.cardNumber && n !== fe.cardExpiry && n !== fe.cardCvc || !t.cl ? Jo[e] : pe.CARD_LIGHT_ELEMENT; var n }

    function Vo(e) { switch (e.type) {
            case "object":
                return $o.push(e.object.id), { issuingCard: e.object };
            case "error":
                return { error: e.error };
            default:
                return Object(m.a)(e) } } var Jo = (Wo(Fo = {}, fe.card, pe.CARD_ELEMENT), Wo(Fo, fe.cardNumber, pe.CARD_ELEMENT), Wo(Fo, fe.cardExpiry, pe.CARD_ELEMENT), Wo(Fo, fe.cardCvc, pe.CARD_ELEMENT), Wo(Fo, fe.postalCode, pe.CARD_ELEMENT), Wo(Fo, fe.paymentRequestButton, pe.PAYMENT_REQUEST_ELEMENT), Wo(Fo, fe.iban, pe.IBAN_ELEMENT), Wo(Fo, fe.idealBank, pe.IDEAL_BANK_ELEMENT), Wo(Fo, fe.p24Bank, pe.P24_BANK_ELEMENT), Wo(Fo, fe.auBankAccount, pe.AU_BANK_ACCOUNT_ELEMENT), Wo(Fo, fe.fpxBank, pe.FPX_BANK_ELEMENT), Wo(Fo, fe.issuingCardNumberDisplay, pe.ISSUING_CARD_NUMBER_DISPLAY_ELEMENT), Wo(Fo, fe.issuingCardCvcDisplay, pe.ISSUING_CARD_CVC_DISPLAY_ELEMENT), Wo(Fo, fe.issuingCardExpiryDisplay, pe.ISSUING_CARD_EXPIRY_DISPLAY_ELEMENT), Wo(Fo, fe.epsBank, pe.EPS_BANK_ELEMENT), Wo(Fo, fe.netbankingBank, pe.NETBANKING_BANK_ELEMENT), Fo),
        $o = ["test_id"],
        Xo = function(e) { return -1 !== $o.indexOf(e) },
        Zo = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e };

    function Qo(e, t) { for (var n = 0; n < t.length; n++) { var r = t[n];
            r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r) } }

    function ei(e, t) { var n, r = {}; for (n in e) 0 <= t.indexOf(n) || Object.prototype.hasOwnProperty.call(e, n) && (r[n] = e[n]); return r }

    function ti(e) { return parseFloat(e.toFixed(1)) } var ni = { base: "StripeElement", focus: "StripeElement--focus", invalid: "StripeElement--invalid", complete: "StripeElement--complete", empty: "StripeElement--empty", webkitAutofill: "StripeElement--webkit-autofill" },
        ri = "#faffbd",
        oi = { margin: "0", padding: "0", border: "none", display: "block", background: "transparent", position: "relative", opacity: "1" },
        ii = { border: "none", display: "block", position: "absolute", height: "1px", top: "-1px", left: "0", padding: "0", margin: "0", width: "100%", opacity: "0", background: "transparent", "pointer-events": "none", "font-size": "16px" };

    function ai(e) { var n = this;! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, ai), this.focus = function() { if (n._isIssuingElement()) throw new S("Cannot call focus() on an " + n._componentName + " Element.");
            document.activeElement && document.activeElement.blur && document.activeElement.blur(), n._fakeInput.focus() }, this._formSubmit = function() { for (var e, t = n._component.parentElement; t && "FORM" !== t.nodeName;) t = t.parentElement;
            t && ((e = document.createEvent("Event")).initEvent("submit", !0, !0), t.dispatchEvent(e)) }; var t = e.options,
            r = e.component,
            o = e.listenerRegistry,
            i = e.elementTimings,
            a = e.emitEvent,
            s = e.getParent,
            c = t.controller,
            u = t.componentName,
            l = t.publicOptions;
        this._componentName = u, this._component = r, this._controller = c, this._listenerRegistry = o, this._emitEvent = a, this._getParent = s; var p = le(Yo, l || {}, "create()"),
            d = p.value;
        p.warnings.forEach(function(e) { return n._controller.warn(e) }); var f = d.paymentRequest,
            m = d.classes,
            h = d.issuingCard,
            _ = "paymentRequestButton" === this._componentName; if (_) { if (!f) throw new S("You must pass in a stripe.paymentRequest object in order to use this Element.");
            this._paymentRequest = f, this._paymentRequest._registerElement() } if (this._isIssuingElement()) { if (!h) throw new Error("You must pass in an ID to the issuingCard option in order to use this Element."); if (!Xo(h)) throw new Error("Issuing card " + h + " has not been retrieved.") }
        this._createElement(t, d, i), this._classes = ni, this._computeCustomClasses(m || {}), this._lastBackgroundColor = "", this._focused = !1, this._empty = !_, this._invalid = !1, this._complete = !1, this._autofilled = !1, this._lastSubmittedAt = null } var si = (function(e, t, n) { return t && Qo(e.prototype, t), n && Qo(e, n), e }(ai, [{ key: "update", value: function(e) { var t, n, r = this,
                    o = le(Yo, e || {}, "element.update()"),
                    i = o.value;
                o.warnings.forEach(function(e) { return r._controller.warn(e) }), i && (t = i.classes, n = ei(i, ["classes"]), t && (this._removeClasses(), this._computeCustomClasses(t), this._updateClasses()), this._updateFrameHeight(i), Object.keys(n).length && (this._frame.update(n), this._secondaryFrame && this._secondaryFrame.update(n))) } }, { key: "blur", value: function() { if (this._isIssuingElement()) throw new S("Cannot call blur() on an " + this._componentName + " Element.");
                this._frame.blur(), this._fakeInput.blur() } }, { key: "clear", value: function() { this._frame.clear() } }, { key: "unmount", value: function() { var e = this._getParent(),
                    t = this._label;
                e && (this._listenerRegistry.removeEventListener(e, "click", this.focus), this._removeClasses()), t && (this._listenerRegistry.removeEventListener(t, "click", this.focus), this._label = null), this._secondaryFrame && (this._secondaryFrame.unmount(), this._listenerRegistry.removeEventListener(window, "click", this._handleOutsideClick)), this._fakeInput.disabled = !0, this._frame.unmount() } }, { key: "mount", value: function() { if (this._paymentRequest) { if (!this._paymentRequest._canMakePaymentResolved) throw new S("For the paymentRequestButton Element, you must first check availability using paymentRequest.canMakePayment() before mounting the Element."); if (!this._paymentRequest._activeBackingLibraryName) throw new S("The paymentRequestButton Element is not available in the current environment.") }
                this._mountTimestamp = new b, this._findPossibleLabel(), this._updateClasses() } }, { key: "_isIssuingElement", value: function() { return "issuingCardNumberDisplay" === this._componentName || "issuingCardCvcDisplay" === this._componentName || "issuingCardExpiryDisplay" === this._componentName } }, { key: "_updateClasses", value: function() { var e = this._getParent();
                e && Ae(e, [
                    [this._classes.base, !0],
                    [this._classes.empty, this._empty],
                    [this._classes.focus, this._focused],
                    [this._classes.invalid, this._invalid],
                    [this._classes.complete, this._complete],
                    [this._classes.webkitAutofill, this._autofilled]
                ]) } }, { key: "_removeClasses", value: function() { var e = this._getParent();
                e && Ae(e, [
                    [this._classes.base, !1],
                    [this._classes.empty, !1],
                    [this._classes.focus, !1],
                    [this._classes.invalid, !1],
                    [this._classes.complete, !1],
                    [this._classes.webkitAutofill, !1]
                ]) } }, { key: "_findPossibleLabel", value: function() { var e = this._getParent(); if (e) { var t = e.getAttribute("id"),
                        n = void 0; if (t && (n = document.querySelector("label[for='" + t + "']")), n) this._listenerRegistry.addEventListener(e, "click", this.focus);
                    else
                        for (n = n || e.parentElement; n && "LABEL" !== n.nodeName;) n = n.parentElement;
                    n ? (this._label = n, this._listenerRegistry.addEventListener(n, "click", this.focus)) : this._listenerRegistry.addEventListener(e, "click", this.focus) } } }, { key: "_computeCustomClasses", value: function(n) { var r = {}; return Object.keys(n).forEach(function(e) { if (!ni[e]) throw new S(e + " is not a customizable class name.\nYou can customize: " + Object.keys(ni).join(", ")); var t = n[e] || ni[e];
                    r[e] = t.replace(/\./g, " ") }), this._classes = Zo({}, this._classes, r), this } }, { key: "_setupEvents", value: function(e) { var n, p = this,
                    a = e.stripeJsLoadTimestamp,
                    s = e.stripeCreateTimestamp,
                    c = e.groupCreateTimestamp,
                    u = e.createTimestamp,
                    l = 0,
                    r = 0;
                this._frame._on("load", function(e) { var t = e.source;
                    l++; var n = p._getParent(),
                        r = Rt(n, null),
                        o = !!r && "rtl" === r.getPropertyValue("direction"),
                        i = p._paymentRequest ? p._paymentRequest._activeBackingLibraryName : null;
                    p._frame.send({ action: "stripe-user-mount", payload: { timestamps: { stripeJsLoad: a.getAsPosixTime(), stripeCreate: s.getAsPosixTime(), groupCreate: c.getAsPosixTime(), create: u.getAsPosixTime(), mount: p._mountTimestamp.getAsPosixTime() }, loadCount: l, matchFrame: t === p._frame._iframe.contentWindow, rtl: o, paymentRequestButtonType: i } }) }), this._secondaryFrame && (n = this._secondaryFrame)._on("load", function(e) { var t = e.source;
                    r++, n.send({ action: "stripe-user-mount", payload: { timestamps: { stripeJsLoad: a.getAsPosixTime(), stripeCreate: s.getAsPosixTime(), groupCreate: c.getAsPosixTime(), create: u.getAsPosixTime(), mount: p._mountTimestamp.getAsPosixTime() }, loadCount: r, matchFrame: t === n._iframe.contentWindow, rtl: !1, paymentRequestButtonType: null } }) }), this._frame._on("redirectfocus", function(e) { var t, n, r, o = e.focusDirection,
                        i = (t = p._component, n = o, (r = Array.prototype.slice.call(document.querySelectorAll("a[href], area[href], input:not([disabled]),\n  select:not([disabled]), textarea:not([disabled]), button:not([disabled]),\n  object, embed, *[tabindex], *[contenteditable]")).filter(function(e) { var t = e.getAttribute("tabindex"),
                                n = !t || 0 <= parseInt(t, 10),
                                r = e.getBoundingClientRect(),
                                o = Rt(e),
                                i = 0 < r.width && 0 < r.height && o && "hidden" !== o.getPropertyValue("visibility"); return n && i }))[function(e, t) { for (var n = 0; n < e.length; n++)
                                if (t(e[n])) return n;
                            return -1 }(r, function(e) { return e === t || t.contains(e) }) + ("previous" === n ? -1 : 1)]);
                    i && i.focus() }), this._frame._on("focus", function() { p._focused = !0, p._updateClasses() }), this._frame._on("blur", function() { p._focused = !1, p._updateClasses(), p._lastSubmittedAt && "paymentRequestButton" === p._componentName && (p._controller.report("payment_request_button.sheet_visible", { latency: p._lastSubmittedAt.getElapsedTime() }), p._lastSubmittedAt = null) }), this._frame._on("submit", function() { var e, t; "paymentRequestButton" === p._componentName ? (p._lastSubmittedAt = new b, t = e = !1, Tn(), p._emitEvent("click", { preventDefault: function() { p._controller.report("payment_request_button.default_prevented"), e && p._controller.warn("event.preventDefault() was called after the payment sheet was shown. Make sure to call it synchronously when handling the `click` event."), t = !0 } }), !t && p._paymentRequest && (p._paymentRequest._elementShow(), e = !0)) : (p._emitEvent("submit"), p._formSubmit()) }), ["ready", "focus", "blur", "escape"].forEach(function(e) { p._frame._on(e, function() { p._emitEvent(e) }) }), this._frame._on("change", function(t) { Tn(); var n = {},
                        e = Hn[p._componentName] || [];
                    ["error", "value", "empty", "complete"].concat(function(e) { if (Array.isArray(e)) { for (var t = 0, n = Array(e.length); t < e.length; t++) n[t] = e[t]; return n } return Array.from(e) }(e)).forEach(function(e) { return n[e] = t[e] }), p._emitEvent("change", n), p._empty = n.empty, p._invalid = !!n.error, p._complete = n.complete, p._updateClasses() }), this._frame._on("__privateIntegrationError", function(e) { var t = e.message;
                    p._emitEvent("__privateIntegrationError", { message: t }) }), this._frame._on("dimensions", function(e) { var t, n, r, o, i, a, s, c, u, l = p._getParent();!l || (t = Rt(l, null)) && (i = parseFloat(t.getPropertyValue("height")), n = e.height, "border-box" === t.getPropertyValue("box-sizing") && (r = parseFloat(t.getPropertyValue("padding-top")), o = parseFloat(t.getPropertyValue("padding-bottom")), i = i - parseFloat(t.getPropertyValue("border-top")) - parseFloat(t.getPropertyValue("border-bottom")) - r - o), a = ti(i), s = ti(n), 0 !== i && a < s && p._controller.report("wrapper_height_mismatch", { height: s, outer_height: a }), c = p._component.getBoundingClientRect().height, u = ti(c), 0 !== c && 0 !== n && u !== s && (p._frame.updateStyle({ height: n + "px" }), p._controller.report("iframe_height_update", { height: s, calculated_height: u }))) }), this._frame._on("autofill", function() { var e, t, n = p._getParent();
                    n && (t = (e = n.style.backgroundColor) === ri || "rgb(250, 255, 189)" === e, p._lastBackgroundColor = t ? p._lastBackgroundColor : e, n.style.backgroundColor = ri, p._autofilled = !0, p._updateClasses()) }), this._frame._on("autofill-cleared", function() { var e = p._getParent();
                    p._autofilled = !1, e && (e.style.backgroundColor = p._lastBackgroundColor), p._updateClasses() }), this._frame._on("update-outer-style", function(t) { Object.keys(t).forEach(function(e) { p._component.style.setProperty(e, t[e]) }) }) } }, { key: "_handleOutsideClick", value: function() { this._secondaryFrame && this._secondaryFrame.send({ action: "stripe-outside-click", payload: {} }) } }, { key: "_updateFrameHeight", value: function(e, t) { var n, r, o, i, a, s, c, u, l, p, d, f = 1 < arguments.length && void 0 !== t && t,
                    m = e.style; "paymentRequestButton" === this._componentName ? (r = "string" == typeof(n = (m && m.paymentRequestButton || {}).height) ? n : void 0, (f || r) && (this._frame.updateStyle({ height: r || this._lastHeight || "40px" }), this._lastHeight = r || this._lastHeight)) : (a = (o = m && m.base || {}).fontSize, s = o.padding, c = "string" != typeof(i = o.lineHeight) || isNaN(parseFloat(i)) ? void 0 : i, l = "string" == typeof s ? s : void 0, (u = "string" == typeof a ? a : void 0) && !/^\d+(\.\d*)?px$/.test(u) && this._controller.warn("The fontSize style you specified (" + u + ") is not in px. We do not recommend using relative css units, as they will be calculated relative to our iframe's styles rather than your site's."), (f || c || u) && (p = -1 === we.indexOf(this._componentName) ? void 0 : l || this._lastPadding, d = hr(c || this._lastHeight, u || this._lastFontSize, p), this._frame.updateStyle({ height: d }), this._lastFontSize = u || this._lastFontSize, this._lastHeight = c || this._lastHeight, this._lastPadding = p)) } }, { key: "_createElement", value: function(e, t, n) { var r = this,
                    o = (e.controller, e.publicOptions, e.componentName),
                    i = e.groupId,
                    a = ei(e, ["controller", "publicOptions", "componentName", "groupId"]),
                    s = (t.classes, t.paymentRequest, ei(t, ["classes", "paymentRequest"])),
                    c = this._component,
                    u = document.createElement("input");
                u.className = qn, u.setAttribute("aria-hidden", "true"), u.setAttribute("aria-label", " "), u.setAttribute("autocomplete", "false"), u.maxLength = 1, u.disabled = !0, Be(c, oi), Be(u, ii); var l, p, d, f = Rt(document.body),
                    m = !!f && "rtl" === f.getPropertyValue("direction"),
                    h = Ko(o, this._controller.getFlags()),
                    _ = Zo({}, a, s, { rtl: m }),
                    y = this._controller.createElementFrame(h, o, i, _);
                y._on("load", function() { u.disabled = !1 }), this._listenerRegistry.addEventListener(u, "focus", function() { y.focus() }), bt && this._listenerRegistry.addEventListener(document, "transitionstart", function(e) { switch (e.propertyName) {
                        case "opacity":
                        case "transform":
                        case "visibility":
                            var t = e.target;
                            r._getParent() && t.contains(r._component) && r._frame.forceRepaint() } }, { passive: !0 }), y.appendTo(c), zn[o] && (l = zn[o].secondary, (p = this._controller.createSecondaryElementFrame(h, l, o, i, _)) && p.on && p.on("height-change", function(e) { p.updateStyle({ height: e.height + "px" }) }), (this._secondaryFrame = p).appendTo(c), this._listenerRegistry.addEventListener(window, "click", function() { return r._handleOutsideClick() })), c.appendChild(u), vt && o !== fe.paymentRequestButton && ((d = document.createElement("input")).className = Fn, d.setAttribute("aria-hidden", "true"), d.setAttribute("tabindex", "-1"), d.setAttribute("autocomplete", "false"), d.maxLength = 1, d.disabled = !0, Be(d, ii), c.appendChild(d)), this._frame = y, this._fakeInput = u, this._setupEvents(n), this._updateFrameHeight(t, !0) } }]), ai),
        ci = function(e, t) { var n = function(e) { if (!Ln[e]) throw new Error("Unexpected Element type: " + e + "."); return Ln[e].implementation }(e); return "legacy" !== n ? Object(m.a)(n, "Unexpected implementation type: " + n + ".") : new si(t) },
        ui = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e },
        li = function(e, t, n) { return t && pi(e.prototype, t), n && pi(e, n), e };

    function pi(e, t) { for (var n = 0; n < t.length; n++) { var r = t[n];
            r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r) } } var di = (function(e, t) { if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function, not " + typeof t);
        e.prototype = Object.create(t && t.prototype, { constructor: { value: e, enumerable: !1, writable: !0, configurable: !0 } }), t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t) }(fi, He), li(fi, [{ key: "_checkDestroyed", value: function() { if (this._destroyed) throw new S("This Element has already been destroyed. Please create a new one.") } }, { key: "_isMounted", value: function() { return !!document.body && document.body.contains(this._component) } }, { key: "_unmount", value: function() { var e = this._component.parentElement;
            e && e.removeChild(this._component), this._implementation.unmount(), this._parent = null } }, { key: "_mountToParent", value: function(e) { var t = this._component.parentElement,
                n = this._isMounted(); if (e === t) { if (n) return;
                this.unmount(), this._mountTo(e) } else if (t) { if (n) throw new S("This Element is already mounted. Use `unmount()` to unmount the Element before re-mounting.");
                this.unmount(), this._mountTo(e) } else this._mountTo(e) } }, { key: "_mountTo", value: function(e) { for (this._parent = e; e.firstChild;) e.removeChild(e.firstChild);
            e.appendChild(this._component), this._implementation.mount() } }]), fi);

    function fi(e, t, n) {! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, fi); var r = function(e, t) { if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return !t || "object" != typeof t && "function" != typeof t ? e : t }(this, (fi.__proto__ || Object.getPrototypeOf(fi)).call(this));
        hi.call(r); var o = e.controller,
            i = e.componentName;
        r._controller = o, r._componentName = i, r._destroyed = !1; var a = document.createElement("div"); return a.className = Bn, r._component = a, r._implementation = ci(r._componentName, { options: e, component: a, listenerRegistry: t, elementTimings: n, emitEvent: r._emitEvent, getParent: r._getParent }), r }

    function mi(e, t) { e._controller.report("legacy_private_property_used", { prop: t, componentName: e._componentName }) } var hi = function() { var r = this;
        this.mount = je(function(e) { r._checkDestroyed(); var t = void 0; if (!e) throw new S("Missing argument. Make sure to call mount() with a valid DOM element or selector."); if ("string" == typeof e) { var n = document.querySelectorAll(e); if (1 < n.length && r._controller.warn("The selector you specified (" + e + ") applies to " + n.length + " DOM elements that are currently on the page.\nThe Stripe Element will be mounted to the first one."), !n.length) throw new S("The selector you specified (" + e + ") applies to no DOM elements that are currently on the page.\nMake sure the element exists on the page before calling mount().");
                t = n[0] } else { if (!e.appendChild) throw new S("Invalid DOM element. Make sure to call mount() with a valid DOM element or selector.");
                t = e } if ("INPUT" === t.nodeName) throw new S("Stripe Elements must be mounted in a DOM element that\ncan contain child nodes. `input` elements are not permitted to have child\nnodes. Try using a `div` element instead.");
            t.children.length && r._controller.warn("This Element will be mounted to a DOM element that contains child nodes."), r._mountToParent(t) }), this.update = je(function(e) { return r._checkDestroyed(), r._implementation.update(e), r }), this.focus = je(function(e) { return r._checkDestroyed(), e && e.preventDefault(), r._implementation.focus(), r }), this.blur = je(function() { return r._checkDestroyed(), r._implementation.blur(), r }), this.clear = je(function() { return r._checkDestroyed(), r._implementation.clear(), r }), this.unmount = je(function() { return r._checkDestroyed(), r._unmount(), r }), this.destroy = je(function() { return r._checkDestroyed(), r.unmount(), r._destroyed = !0, r._emitEvent("destroy"), r }), this._getParent = function() { return r._parent }, this._emitEvent = function(e, t) { return r._emit(e, ui({ elementType: r._componentName }, t)) } };
    ["_autofilled", "_classes", "_complete", "_empty", "_fakeInput", "_focused", "_frame", "_invalid", "_lastBackgroundColor", "_lastFontSize", "_lastHeight", "_lastPadding", "_lastSubmittedAt", "_listenerRegistry", "_paymentRequest"].forEach(function(e) { Object.defineProperty(di.prototype, e, { enumerable: !1, get: function() { return mi(this, e), this._implementation[e] } }) });
    ["_formSubmit", "_isIssuingElement"].forEach(function(e) { Object.defineProperty(di.prototype, e, { enumerable: !1, writable: !1, value: function() { return mi(this, e), this._implementation[e]() } }) }); var _i = di,
        yi = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e };

    function vi(e, t) { var n, r = {}; for (n in e) 0 <= t.indexOf(n) || Object.prototype.hasOwnProperty.call(e, n) && (r[n] = e[n]); return r }

    function bi(e) { if (Array.isArray(e)) { for (var t = 0, n = Array(e.length); t < e.length; t++) n[t] = e[t]; return n } return Array.from(e) }

    function gi(e) { var t = re(Ai, e, ""); return "error" === t.type ? null : t.value } var wi, Ei = ue({ locale: q(Y), fonts: q(Q(Z)), betas: q(Q(G.apply(void 0, bi(Rn)))) }),
        Si = function() { var c = this;
            this.getElement = je(function(e) { var t, n = (null != (t = e) && t.__elementType && "string" == typeof t.__elementType && "function" == typeof t ? t.__elementType : null) || e; return lr(n, c._betas), w(c._elements, function(e) { return e._componentName === n }) || null }), this.create = Ue(function(t, e) { var n = new b;! function(e, t, n) { if (lr(e, n), Ln[e].unique && -1 !== t.indexOf(e)) throw new S("Can only create one Element of type " + e + "."); var r = function(e, t) { for (var n = {}, r = 0; r < t.length; r++) n[t[r]] = !0; for (var o = [], i = 0; i < e.length; i++) n[e[i]] && o.push(e[i]); return o }(t, Ln[e].conflict); if (r.length) { var o = r[0]; throw new S("Cannot create an Element of type " + e + " after an Element of type " + o + " has already been created.") } }(t, c._elements.map(function(e) { return e._componentName }), c._betas); var r = yi({}, e, c._commonOptions, { componentName: t, groupId: c._id }),
                    o = (r.paymentRequest, vi(r, ["paymentRequest"])),
                    i = (_t || yt) && 2e3 < Me(o).length,
                    a = !!c._pendingFonts || i,
                    s = new _i(yi({ publicOptions: e }, c._commonOptions, { componentName: t, groupId: c._id, fonts: i ? null : c._commonOptions.fonts, controller: c._controller, wait: a }), c._listenerRegistry, yi({}, c._timings, { createTimestamp: n })); return c._elements = [].concat(bi(c._elements), [s]), s._on("destroy", function() { c._elements = c._elements.filter(function(e) { return e._componentName !== t }) }), i && s._implementation._frame && s._implementation._frame.send({ action: "stripe-user-update", payload: { fonts: c._commonOptions.fonts } }), s }) },
        Pi = function e(t, n, r, o) { var i = this;! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, e), Si.call(this); var a, s = new b,
                c = le(Ei, o || {}, "elements()"),
                u = c.value,
                l = u.betas,
                p = void 0 === l ? [] : l,
                d = u.fonts,
                f = void 0 === d ? [] : d,
                m = u.locale,
                h = vi(u, ["betas", "fonts", "locale"]);
            c.warnings.forEach(function(e) { return t.warn(e) }), a = t.warn, tr().match(/width=device-width/) || a('Elements requires "width=device-width" be set in your page\'s viewport meta tag.\n       For more information: https://stripe.com/docs/js/appendix/viewport_meta_requirements'), t.report("elements", { options: o }), this._elements = [], this._id = Pe("elements"), this._timings = yi({}, r, { groupCreateTimestamp: s }), this._controller = t, this._betas = p, this._listenerRegistry = n; var _ = fr(m, p);
            this._controller.action.fetchLocale({ locale: _ || "auto" }); var y = f.filter(function(e) { return !e.cssSrc || "string" != typeof e.cssSrc }).map(function(e) { return yi({}, e, { __resolveFontRelativeTo: window.location.href }) }),
                v = f.map(function(e) { return e.cssSrc }).reduce(function(e, t) { return "string" == typeof t ? [].concat(bi(e), [t]) : e }, []).map(function(e) { return g(e) ? e : function(e, t) { if ("/" !== t[0]) return "" + e.replace(/\/[^/]*$/, "/") + t; var n = k(e); return n ? "" + n.origin + t : t }(window.location.href, e) }); return this._pendingFonts = v.length, this._commonOptions = yi({}, h, { betas: p, locale: _, fonts: y }), v.forEach(function(n) { var r; "string" == typeof n && (r = new b, dr(n).then(function(e) { i._controller.report("font.loaded", { load_time: r.getElapsedTime(), font_count: e.length, css_src: n }); var t = e.map(function(e) { return yi({}, e, { __resolveFontRelativeTo: n }) });
                    i._controller.action.updateCSSFonts({ fonts: t, groupId: i._id }), i._commonOptions = yi({}, i._commonOptions, { fonts: [].concat(bi(i._commonOptions.fonts ? i._commonOptions.fonts : []), bi(t)) }) }).catch(function(e) { i._controller.report("error.font.not_loaded", { load_time: r.getElapsedTime(), message: e && e.message && e.message, css_src: n }), i._controller.warn("Failed to load CSS file at " + n + ".") })) }), this },
        ki = function(e, t, n, r, o, i, a) { return new Ho({ controller: e, authentication: t, mids: n, rawOptions: r, betas: o, queryStrategyOverride: i, listenerRegistry: a }) },
        Oi = { _componentName: Y, _implementation: ue({ _frame: ue({ id: Y }) }) },
        Ai = ue(Oi);

    function Ti(e, t, n) { return t in e ? Object.defineProperty(e, t, { value: n, enumerable: !0, configurable: !0, writable: !0 }) : e[t] = n, e }

    function Ii(e) { return -1 === he.indexOf(e) }

    function Ci(e, t) { switch (e.type) {
            case "object":
                return { paymentIntent: e.object };
            case "error":
                return { error: Di({}, t ? { payment_intent: t } : {}, e.error) };
            default:
                return Object(m.a)(e) } }

    function Ri(e) { switch (e.type) {
            case "error":
                return { error: e.error };
            case "object":
                return { setupIntent: e.object };
            default:
                return Object(m.a)(e) } }

    function ji(e) { return { id: e.id, clientSecret: e.client_secret } }

    function Ni(e) { return "requires_source_action" === e || "requires_action" === e }

    function Mi(e) { return "requires_source_action" === e.status || "requires_action" === e.status ? e.next_action : null } var xi = { alipay: "alipay", afterpay_clearpay: "afterpay_clearpay", au_becs_debit: "au_becs_debit", acss_debit: "acss_debit", bacs_debit: "bacs_debit", bancontact: "bancontact", boleto: "boleto", card: "card", eps: "eps", fpx: "fpx", giropay: "giropay", grabpay: "grabpay", ideal: "ideal", konbini: "konbini", oxxo: "oxxo", p24: "p24", paypal: "paypal", sepa_debit: "sepa_debit", sofort: "sofort", three_d_secure: "three_d_secure", upi: "upi", wechat_pay: "wechat_pay", netbanking: "netbanking" },
        Li = (Ti(wi = {}, fe.auBankAccount, xi.au_becs_debit), Ti(wi, fe.card, xi.card), Ti(wi, fe.cardNumber, xi.card), Ti(wi, fe.cardExpiry, xi.card), Ti(wi, fe.cardCvc, xi.card), Ti(wi, fe.postalCode, xi.card), Ti(wi, fe.iban, xi.sepa_debit), Ti(wi, fe.idealBank, xi.ideal), Ti(wi, fe.fpxBank, xi.fpx), Ti(wi, fe.p24Bank, xi.p24), Ti(wi, fe.netbankingBank, xi.netbanking), Ti(wi, fe.epsBank, xi.eps), wi),
        Di = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e },
        Bi = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e },
        qi = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) { return typeof e } : function(e) { return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e };

    function Fi(e) { if (Array.isArray(e)) { for (var t = 0, n = Array(e.length); t < e.length; t++) n[t] = e[t]; return n } return Array.from(e) }

    function Ui(e, t) { var n, r = {}; for (n in e) 0 <= t.indexOf(n) || Object.prototype.hasOwnProperty.call(e, n) && (r[n] = e[n]); return r }

    function Hi(e, t) { if ("string" != typeof e) return D("a client_secret string", e, t); var n, r = (n = e.trim().match(/^([a-z]+_[^_]+)_secret_[^-]+$/)) ? { id: n[1], clientSecret: n[0] } : null; return null === r ? D("a client secret of the form ${id}_secret_${secret}", e, t) : M(r, []) }

    function zi(e, t) { if (null === e) return L("object", "null", t); if ("object" !== (void 0 === e ? "undefined" : qi(e))) return L("object", void 0 === e ? "undefined" : qi(e), t); var n = e.client_secret,
            r = e.status,
            o = e.next_action,
            i = Hi(n, B(t, "client_secret")); return "error" === i.type ? i : "string" != typeof r ? L("string", void 0 === r ? "undefined" : qi(r), B(t, "status")) : "requires_source_action" !== r && "requires_action" !== r || "object" === (void 0 === o ? "undefined" : qi(o)) ? (e.object, M(e, [])) : L("object", void 0 === o ? "undefined" : qi(o), B(t, "next_action")) }

    function Gi(d) { return function(e, t) { if ("object" !== (void 0 === e ? "undefined" : qi(e))) return L("object", void 0 === e ? "undefined" : qi(e), t); if (null === e) return L("object", "null", t); var n = e.type,
                r = Ui(e, ["type"]),
                o = void 0; if (null === d) { if ("string" != typeof n) return L("string", void 0 === n ? "undefined" : qi(n), B(t, "type"));
                o = n } else { if (void 0 !== n && n !== d) return "string" != typeof n ? L("string", void 0 === n ? "undefined" : qi(n), B(t, "type")) : L('"' + n + '"', '"' + d + '"', B(t, "type"));
                o = d } var i = r[o],
                a = (r[o], Ui(r, [o])); if (-1 !== ["acss_debit", "afterpay_clearpay", "alipay", "bancontact", "eps", "giropay", "grabpay", "konbini", "oxxo", "p24", "paypal", "wechat_pay"].indexOf(o) && void 0 === i && (i = {}), "object" !== (void 0 === i ? "undefined" : qi(i))) return L("object or element", qi(e[o]), B(t, o)); if (null === i) return L("object or element", "null", B(t, o)); var s = gi(i); if (s) { var c = s._componentName; if (Li[c] === o) return M({ type: o, element: s, data: a }); var u = [].concat(Fi(t.path), [o]).join("."),
                    l = t.label,
                    p = new S("Invalid value for " + l + ": " + u + " was `" + c + "` Element, which cannot be used to create " + o + " PaymentMethods."); return x(p) } return M({ type: o, element: null, data: r }) } }

    function Yi(d, f) { return function(e, t) { if (void 0 === e) return M({ paymentMethodData: null, paymentMethodOptions: null, source: null, paymentMethod: null, otherParams: {} }); if ("object" !== (void 0 === e ? "undefined" : qi(e))) return L("object", void 0 === e ? "undefined" : qi(e), t); if (null === e) return L("object", "null", t); var n = e.source,
                r = e.source_data,
                o = e.payment_method_data,
                i = e.payment_method_options,
                a = e.payment_method,
                s = Ui(e, ["source", "source_data", "payment_method_data", "payment_method_options", "payment_method"]); if (null != r) throw new S(f + ": Expected payment_method, or source, not source_data."); if (null != o) throw new S(f + ": Expected payment_method, or source, not payment_method_data."); if (null != n && null != a) throw new S(f + ": Expected either payment_method or source, but not both."); if (null === d && null != a && "string" != typeof a) throw new S(f + ": Expected payment_method[type] to be set if payment_method is passed."); if (null != n) { if ("string" != typeof n) return L("string", void 0 === n ? "undefined" : qi(n), B(t, "source")); if ("updatePaymentIntent" === f) throw new S(f + ": Expected payment_method, not source to be passed."); return M({ source: n, paymentMethodData: null, paymentMethodOptions: null, paymentMethod: null, otherParams: s }) } if (null != a && "string" != typeof a && "object" !== (void 0 === a ? "undefined" : qi(a))) return L("string or object", void 0 === a ? "undefined" : qi(a), B(t, "payment_method")); var c, u = re((c = d, function(e, t) { if (null == e) return M(null); if ("object" !== (void 0 === e ? "undefined" : qi(e))) return L("object", void 0 === e ? "undefined" : qi(e), t); var n = e.card,
                    r = Ui(e, ["card"]); if (!n || "object" !== (void 0 === n ? "undefined" : qi(n))) return M(e); var o = n.cvc,
                    i = Ui(n, ["cvc"]); if (null == o) return M(e); var a = gi(o),
                    s = a ? a._componentName : ""; return fe.cardCvc !== s ? L("`" + fe.cardCvc + "` Element", s ? "`" + s + "` Element" : void 0 === o ? "undefined" : qi(o), B(t, (c || "card") + ".cvc")) : M(Bi({}, r, { card: Bi({}, i, { cvc: a }) })) }), i, f, { path: [].concat(Fi(t.path), ["payment_method_options"]) }); if ("error" === u.type) return u; if ("string" == typeof a) return M({ source: null, paymentMethodData: null, paymentMethodOptions: u.value, paymentMethod: a, otherParams: s }); if ("object" !== (void 0 === a ? "undefined" : qi(a)) || null === a) return M({ source: null, paymentMethodData: null, paymentMethodOptions: null, paymentMethod: null, otherParams: s }); var l = re(Gi(d), a, f, { path: [].concat(Fi(t.path), ["payment_method"]) }); if ("error" === l.type) return l; var p = l.value; return M({ source: null, paymentMethod: null, paymentMethodOptions: u.value, paymentMethodData: p, otherParams: s }) } } var Wi, Ki = W(ue({ handleActions: W(K, function() { return !0 }) }), function() { return { handleActions: !0 } }),
        Vi = ue({ name: z("react-stripe-js", "stripe-js", "react-stripe-elements"), version: (Wi = Y, function(e, t) { return null === e ? M(e) : Wi(e, t) }), startTime: q(V) });

    function Ji(e, t) { for (var n = 0; n < t.length; n++) { var r = t[n];
            r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r) } } var $i = ["elements", "createToken", "createPaymentMethod"],
        Xi = ["elements", "createSource", "createToken", "createPaymentMethod"],
        Zi = (function(e, t, n) { return t && Ji(e.prototype, t), n && Ji(e, n), e }(Qi, [{ key: "got", value: function(e) { this._didDetect || ("elements" === e ? this._gets = ["elements"] : this._gets.push(e), this._checkForWrapper()) } }, { key: "called", value: function(t) { this._didDetect || (this._gets = this._gets.filter(function(e) { return e !== t })) } }, { key: "_checkForWrapper", value: function() { d(this._gets, $i) ? this._onDetection("react-stripe-js") : d(this._gets, Xi) && this._onDetection("react-stripe-elements") } }]), Qi);

    function Qi(t) { var n = this;! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, Qi), this._gets = [], this._didDetect = !1, this._onDetection = function(e) { n._didDetect = !0, t(e) }, window.Stripe && window.Stripe.__cachedInstances && this._onDetection("react-stripe-elements") } var ea = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) { return typeof e } : function(e) { return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e };

    function ta(e) { if (!e || "object" !== (void 0 === e ? "undefined" : ea(e))) return null; var t = e.type; return { type: "string" == typeof t ? t : null, data: function(e, t) { var n, r = {}; for (n in e) 0 <= t.indexOf(n) || Object.prototype.hasOwnProperty.call(e, n) && (r[n] = e[n]); return r }(e, ["type"]) } }

    function na(e) { switch (e.type) {
            case "object":
                return { source: e.object };
            case "error":
                return { error: e.error };
            default:
                return Object(m.a)(e) } }

    function ra(e) { switch (e.type) {
            case "object":
                return { paymentMethod: e.object };
            case "error":
                return { error: e.error };
            default:
                return Object(m.a)(e) } }

    function oa(e, t, n, r, o) { if ("string" == typeof n) return function(e, t, n, r, o) { var i = gi(r),
                a = ta(i ? o : r),
                s = a || { type: null, data: {} },
                c = s.type,
                u = s.data; if (c && n !== c) return E.reject(new S("The type supplied in payment_method_data is not consistent.")); if (i) { var l = i._implementation._frame.id,
                    p = i._componentName; return e.action.createPaymentMethodWithElement({ frameId: l, elementName: p, type: n, paymentMethodData: u, mids: t }).then(ra) } return a ? e.action.createPaymentMethodWithData({ elementName: null, type: n, paymentMethodData: u, mids: t }).then(ra) : E.reject(new S("Please provide either an Element or PaymentMethod creation parameters to createPaymentMethod.")) }(e, t, n, r, o); try { var i = le(Gi(null), n, "createPaymentMethod").value,
                a = i.element,
                s = i.type,
                c = i.data; if (a) { var u = a._implementation._frame.id,
                    l = a._componentName; return e.action.createPaymentMethodWithElement({ frameId: u, elementName: l, type: s, paymentMethodData: c, mids: t }).then(ra) } return e.action.createPaymentMethodWithData({ elementName: null, type: s, paymentMethodData: c, mids: t }).then(ra) } catch (e) { return E.reject(e) } }

    function ia(e) { return "https://stripe.com/docs/stripe-js/reference#stripe-" + e.split(/(?=[A-Z])/).join("-").toLowerCase() }

    function aa(e, t) { return le(Hi, e, "stripe." + t + " intent secret").value }

    function sa(e, t) { return le(Ki, t, e).value }

    function ca(e, t, n) { if ("valid" === re(Ai, n, t).type) throw new S("Do not pass an Element to stripe." + t + "() directly.\nFor more information: " + ia(t)); var r = le(Yi(e, t), n, t).value,
            o = r.source,
            i = r.paymentMethodData,
            a = r.paymentMethodOptions,
            s = r.paymentMethod,
            c = r.otherParams; if (null != o && (null != i || null != s)) throw new S(t + ": Expected either source or payment_method, but not both."); if (i) { if (i.element) return { mode: { tag: "paymentMethod-from-element", type: e, elementName: i.element._componentName, frameId: i.element._implementation._frame.id, data: i.data, options: a }, otherParams: c }; if (e) return { mode: { tag: "paymentMethod-from-data", type: e, data: i.data, options: a }, otherParams: c } } else { if (s) return { mode: { tag: "paymentMethod", paymentMethod: s, options: a }, otherParams: c }; if (o) return { mode: { tag: "source", source: o }, otherParams: c } } return { mode: { tag: "none" }, otherParams: c } }

    function ua(e, t) { var n = { skipFingerprint: !1, sandboxFingerprintFrame: !1, sandboxChallengeFrame: !1, useSecureModalWindow: !1 }; return -1 !== e.indexOf("Y") && (t.report("3ds2.optimization.Y"), n.skipFingerprint = !0), -1 !== e.indexOf("k") && (t.report("3ds2.optimization.k"), n.sandboxFingerprintFrame = !0), -1 !== e.indexOf("5") && (t.report("3ds2.optimization.5"), n.sandboxChallengeFrame = !0), -1 !== e.indexOf("R") && (t.report("3ds2.optimization.R"), n.useSecureModalWindow = !0), n }

    function la(e) { return { american_express: "amex", visa: "visa", mastercard: "mastercard", discover: "discover" }[e] || "unknown" }

    function pa(e, t, n) { if (!e) return null; if ("use_stripe_sdk" === e.type) { var r = e.use_stripe_sdk; switch (r.type) {
                case "stripe_3ds2_fingerprint":
                    return { type: "3ds2-fingerprint", threeDS2Source: r.three_d_secure_2_source, cardBrand: la(r.directory_server_name), transactionId: r.server_transaction_id, optimizations: ua(r.three_ds_optimizations, n), methodUrl: r.three_ds_method_url };
                case "stripe_3ds2_challenge":
                    return { type: "3ds2-challenge", threeDS2Source: r.stripe_js.three_d_secure_2_source, cardBrand: la(r.stripe_js.directory_server_name), transactionId: r.stripe_js.server_transaction_id, optimizations: ua(r.stripe_js.three_ds_optimizations, n), acsTransactionId: r.stripe_js.acs_transaction_id, acsUrl: r.stripe_js.acs_url, creq: r.stripe_js.creq, securePaymentConfirmation: r.stripe_js.secure_payment_confirmation };
                case "three_d_secure_redirect":
                    return { type: "3ds1-modal", url: r.stripe_js, source: r.source } } } if ("redirect_to_url" === e.type) return { type: "redirect", redirectUrl: e.redirect_to_url.url }; if ("alipay_handle_redirect" === e.type) return { type: "redirect", redirectUrl: e.alipay_handle_redirect.url }; if ("boleto_display_details" === e.type) return { type: "boleto-display" }; if ("display_oxxo_details" === e.type) return { type: "oxxo-display", hostedVoucherUrl: e.display_oxxo_details.hosted_voucher_url }; if ("display_konbini_details" === e.type) return { type: "konbini-display" }; if ("oxxo_display_details" === e.type) return { type: "oxxo-display", hostedVoucherUrl: e.oxxo_display_details.hosted_voucher_url }; if ("authorize_with_url" === e.type) { var o = e.authorize_with_url.url; switch (t) {
                case xi.card:
                    return { type: "3ds1-modal", url: o, source: null };
                case xi.ideal:
                    return { type: "redirect", redirectUrl: o } } } return "upi_await_notification" === e.type ? { type: "upi_await_notification" } : "wechat_pay_display_qr_code" === e.type ? { type: "wechat_pay_display_qr_code" } : null }

    function da(e) { switch (e.type) {
            case "error":
                return { error: e.error };
            case "object":
                switch (e.object.object) {
                    case "payment_intent":
                        return { paymentIntent: e.object };
                    case "setup_intent":
                        return { setupIntent: e.object };
                    default:
                        return Object(m.a)(e.object) }
            default:
                return Object(m.a)(e) } }

    function fa(e, t, n, r) { return t === me.PAYMENT_INTENT ? n.action.retrievePaymentIntent({ hosted: !1, intentSecret: e, locale: r, asErrorIfNotSucceeded: !0 }).then(da) : n.action.retrieveSetupIntent({ hosted: !1, intentSecret: e, locale: r, asErrorIfNotSucceeded: !0 }).then(da) }

    function ma(e, t, n, r, o) { return t === me.PAYMENT_INTENT ? n.action.cancelPaymentIntentSource({ intentSecret: e, locale: o, sourceId: r }).then(da) : n.action.cancelSetupIntentSource({ intentSecret: e, locale: o, sourceId: r }).then(da) }

    function ha(e) { return (e.error ? e.error.payment_intent || e.error.setup_intent : e.paymentIntent || e.setupIntent) || null }

    function _a(n, l, p, d, f) { var e, t, r, o, i, a = tr(),
            m = new b,
            h = (e = d, t = n.url, r = l.id, o = n.source, i = f, e.createLightboxFrame({ type: pe.AUTHORIZE_WITH_URL, options: ga({ url: t, locale: i, intentId: r }, o ? { source: o } : {}) })); return h.show(), d.report("authorize_with_url.loading", { viewport: a, intentId: l.id }), h._on("load", function() { d.report("authorize_with_url.loaded", { loadDuration: m.getElapsedTime(), intentId: l.id }), h.fadeInBackdrop() }), h._on("challenge_complete", function() { h.fadeOutBackdrop() }), new E(function(u, e) { var t = n.source;
            t && h._once("cancel", function() { E.all([ma(l, p, d, t, f), h.destroy()]).then(function(e) { var t = ba(e, 1)[0]; return u(t) }) }), h._once("authorize_with_url_done", function() { var e, t, n, o, i, a, s, c, r = h.destroy();
                e = l, t = p, n = d, o = f, i = function(e, t) { r.then(function() { d.report("authorize_with_url.done", { shownDuration: m.getElapsedTime(), success: !("error" in e), intentId: l.id, iterations: t }), u(e) }) }, a = !0, s = 3, c = 0,
                    function r() { c += 1, fa(e, t, n, o).then(function(e) { if (a) { var t, n = ha(e); if (null !== n) switch (s = 3, n.status) {
                                    case "requires_action":
                                    case "requires_source_action":
                                        return void setTimeout(r, 5e3);
                                    case "processing":
                                        return void setTimeout(r, 1e3);
                                    default:
                                        i(e, c) } else 0 < s ? (t = 500 * Math.pow(2, 3 - s), setTimeout(r, t), --s) : i(e, c) } }) }() }) }) } var ya = { source: ue({ id: H("src_"), client_secret: H("src_client_secret_") }) },
        va = ue(ya),
        ba = function(e, t) { if (Array.isArray(e)) return e; if (Symbol.iterator in Object(e)) return function(e, t) { var n = [],
                    r = !0,
                    o = !1,
                    i = void 0; try { for (var a, s = e[Symbol.iterator](); !(r = (a = s.next()).done) && (n.push(a.value), !t || n.length !== t); r = !0); } catch (e) { o = !0, i = e } finally { try {!r && s.return && s.return() } finally { if (o) throw i } } return n }(e, t); throw new TypeError("Invalid attempt to destructure non-iterable instance") },
        ga = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e },
        wa = function(e, t) { if (Array.isArray(e)) return e; if (Symbol.iterator in Object(e)) return function(e, t) { var n = [],
                    r = !0,
                    o = !1,
                    i = void 0; try { for (var a, s = e[Symbol.iterator](); !(r = (a = s.next()).done) && (n.push(a.value), !t || n.length !== t); r = !0); } catch (e) { o = !0, i = e } finally { try {!r && s.return && s.return() } finally { if (o) throw i } } return n }(e, t); throw new TypeError("Invalid attempt to destructure non-iterable instance") },
        Ea = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e };

    function Sa(t) { return new E(function(e) { t._on("load", function() { return e(t) }) }) }

    function Pa(e, n, t, r, o) { return n.optimizations.skipFingerprint ? E.resolve({ fingerprintAttempted: !1, fingerprintData: null }) : "" === n.methodUrl ? (t.report("3ds2.fingerprint.no_method_url", { hosted: r, intentId: e.id }), E.resolve({ fingerprintAttempted: !1, fingerprintData: null })) : function(e, t, n, r) { var o = e.createHiddenFrame(pe.STRIPE_3DS2_FINGERPRINT, { intentId: t, locale: r, hosted: n });
            e.report("3ds2.fingerprint_frame.loading", { hosted: n, intentId: t }); var i = Sa(o); return i.then(function() { e.report("3ds2.fingerprint_frame.loaded", { hosted: n, intentId: t }) }), i }(t, e.id, r, o).then(function(t) { return t.action.perform3DS2Fingerprint({ transactionId: n.transactionId, methodUrl: n.methodUrl, shouldSandbox: n.optimizations.sandboxFingerprintFrame }).then(function(e) { return t.destroy(), e }) }) }

    function ka(a, i, s, c, u, l) {
        function p(o) { return new E(function(r) { t.then(function(e) { e._once("cancel", function() { e.fadeOutBackdrop(), ma(a, i, c, s.threeDS2Source, u).then(r) }), l || (e.show(), e.fadeInBackdrop());
                    o.type; var t = o.optimizations,
                        n = function(e, t) { var n, r = {}; for (n in e) 0 <= t.indexOf(n) || Object.prototype.hasOwnProperty.call(e, n) && (r[n] = e[n]); return r }(o, ["type", "optimizations"]);
                    e.action.perform3DS2Challenge(Ea({}, n, { shouldSandbox: t.sandboxChallengeFrame, useSecureModalWindow: t.useSecureModalWindow })).then(function() { r() }) }) }) }

        function d(e) { return E.all([e ? E.resolve(e) : fa(a, i, c, u), t.then(function(e) { return e.destroy() })]).then(function(e) { var t = wa(e, 1)[0]; return c.report("3ds2.done", Ea({ intentId: a.id, hosted: l, totalDuration: n.getElapsedTime() }, t.error ? { error: t.error, success: !1 } : { success: !0 })), t }) } var n = new b,
            t = function(e, t, n, r, o) { var i = t.createLightboxFrame({ type: pe.STRIPE_3DS2_CHALLENGE, options: { intentId: e, hosted: r, locale: o } });
                t.report("3ds2.challenge_frame.loading", { intentId: e, hosted: r }), i._on("challenge_complete", function() { i.fadeOutBackdrop() }); var a = Sa(i); return a.then(function() { return t.report("3ds2.challenge_frame.loaded", { intentId: e, hosted: r }) }), r && (i.show(), i.action.show3DS2Spinner({ cardBrand: n })), a }(a.id, c, s.cardBrand, l, u); switch (s.type) {
            case "3ds2-challenge":
                return p(s).then(d);
            case "3ds2-fingerprint":
                return Pa(a, s, c, l, u).then(function(e) { return c.report("3ds2.authenticate", { hosted: l, intentId: a.id }), c.action.authenticate3DS2({ threeDS2Source: s.threeDS2Source, outerWindowWidth: window.innerWidth, hosted: l, fingerprintResult: e }).then(function(e) { return "error" === e.type ? c.report("3ds2.authenticate.error", { error: e.error, hosted: l, intentId: a.id }) : c.report("3ds2.authenticate.success", { hosted: l, intentId: a.id }), e }) }).then(function(e) { if ("error" === e.type || null === e.object.ares) return d(); var t = e.object,
                        n = t.ares,
                        r = t.creq; if ("C" !== n.transStatus || null == r) return c.report("3ds2.frictionless", { hosted: l, intentId: a.id }), d(); var o = null; if (e.object.secure_payment_confirmation) try { var i = window.top.origin,
                            o = Ea({}, e.object.secure_payment_confirmation, { merchantOrigin: i }) } catch (e) { c.report("3ds2.secure_payment_confirmation.origin_check_error", { intentId: a.id, source: s.threeDS2Source, error: Ea({ name: e.name, message: e.message }, e) }) }
                    return p({ type: "3ds2-challenge", threeDS2Source: s.threeDS2Source, cardBrand: s.cardBrand, transactionId: s.transactionId, acsUrl: n.acsURL, acsTransactionId: n.acsTransID, optimizations: s.optimizations, creq: r, securePaymentConfirmation: o }).then(d) });
            default:
                return Object(m.a)(s) } }

    function Oa(e, t) { var n = e.createLightboxFrame({ type: pe.LIGHTBOX_APP, options: t }); return n.show(), n._on("nested-frame-loaded", function() { n.fadeInBackdrop(), setTimeout(function() { n.action.openLightboxFrame() }, 200) }), n }

    function Aa(e) { return e.action.closeLightboxFrame(), e.destroy() }

    function Ta(r) { return new E(function(e, t) { var n = setTimeout(function() { e({ type: "error", error: { code: "redirect_error", message: "Failed to redirect to " + r }, locale: "en" }) }, 6e4);
            window.addEventListener("pagehide", function() { clearTimeout(n) }), window.top.location.href = r }) }

    function Ia(e, t, n) { e.report("redirect_error", { initiator: t, error: n.error }) }

    function Ca(e) { switch (e.type) {
            case "error":
                var t = e.error; if ("payment_intent_unexpected_state" === t.code && "object" === Ua(t.payment_intent) && null != t.payment_intent && "string" == typeof t.payment_intent.status && Ni(t.payment_intent.status)) { var n = t.payment_intent; return { type: "object", locale: e.locale, object: n } } return e;
            case "object":
                return e;
            default:
                return Object(m.a)(e) } }

    function Ra(e, t, n, r, o) { var i, a, s, c, u, l, p, d, f, m, h, _, y, v, b, g = pa(Mi(t), n, e),
            w = ji(t); if (!g) return E.resolve({ paymentIntent: t }); switch (g.type) {
            case "3ds1-modal":
                return _a(g, w, me.PAYMENT_INTENT, e, r);
            case "3ds2-fingerprint":
            case "3ds2-challenge":
                return ka(w, me.PAYMENT_INTENT, g, e, r, o);
            case "redirect":
                return _ = t, y = n, v = g.redirectUrl, b = e, Ta(v).then(function(e) { return Ia(b, y + " redirect", e), Ci(e, _) });
            case "boleto-display":
                throw new S("Expected option `handleActions` to be `false`. The Boleto private beta does not handle the next actions for you automatically (e.g. display Boleto details). Please refer to the Stripe Boleto integration guide for more info: \n\nhttps://stripe.com/docs/payments/boleto");
            case "konbini-display":
                throw new S("Expected option `handleActions` to be `false`. Automatic display of Konbini payment details is not supported in the Pilot. Please refer to the Stripe Konbini integration guide for more info: \n\nhttps://stripe.com/docs/payments/konbini");
            case "oxxo-display":
                if (void 0 === g.hostedVoucherUrl) throw new S("To handle the next actions automatically, set the API version to oxxo_beta=v2. Please refer to the Stripe OXXO integration guide for more info: \n\nhttps://stripe.com/docs/payments/oxxo"); return l = { controller: e, locale: r, url: g.hostedVoucherUrl, intent: t }, p = l.controller, d = l.url, f = l.intent, m = l.locale, h = Oa(p, { url: d, size: "600x700", locale: m, frameTitle: "oxxo.voucher_frame_title", useLightboxHostedCloseButton: !1 }), new E(function(e) { h._on("request-close", function() { Aa(h).then(function() { e({ paymentIntent: f }) }) }) });
            case "upi_await_notification":
                return a = (i = { controller: e, intentSecret: w, intentType: me.PAYMENT_INTENT, locale: r }).controller, s = i.intentSecret, c = i.intentType, u = i.locale, new E(function(r) { setTimeout(function n() { fa(s, c, a, u).then(function(e) { var t = ha(e);
                            null !== t && ("requires_action" !== t.status ? r(e) : setTimeout(n, 1e4)) }) }, 5e3) });
            case "wechat_pay_display_qr_code":
                throw new S("Expected option `handleActions` to be `false`.");
            default:
                return E.resolve({ paymentIntent: t }) } }

    function ja(e, t, n, r, o) { return Ra(e, t, n, r, o).then(function(e) { if (e.setupIntent) throw new Error("Got unexpected SetupIntent response"); return e }) }

    function Na(i, a, s, c) { return function(e) { var t = Ca(e); switch (t.type) {
                case "error":
                    var n = t.error,
                        r = n.payment_intent; return s && r && "payment_intent_unexpected_state" === n.code && ("succeeded" === r.status || "requires_capture" === r.status) ? E.resolve({ paymentIntent: r }) : E.resolve(Ci(e));
                case "object":
                    var o = t.object; return ja(i, o, a, t.locale, c);
                default:
                    return Object(m.a)(t) } } }

    function Ma(l, p) { return function(e, t, n, r, o) { var i = aa(n, l),
                a = ca(p, l, r),
                s = sa(l, o),
                c = "none" === a.mode.tag,
                u = e.action.confirmPaymentIntent(Ha({}, a, { intentSecret: i, expectedType: p, options: s, mids: t })); return s.handleActions ? u.then(Na(e, p, c, !1)) : u.then(Ci) } }

    function xa(e, t, n, r) { var o = aa(n, "updatePaymentIntent"),
            i = function(e) { if (!e || !e.payment_method || !e.payment_method.type || "string" != typeof e.payment_method.type) return null; var t = e.payment_method.type; return xi[t] || null }(r),
            a = ca(i, "updatePaymentIntent", r); return e.action.updatePaymentIntent(Ha({}, a, { intentSecret: o, expectedType: i, mids: t, options: null })).then(Ci) }

    function La(e, r) { var t = aa(e, "handleCardAction"); return r.action.retrievePaymentIntent({ intentSecret: t, hosted: !1 }).then(function(e) { var t = Ca(e); switch (t.type) {
                case "error":
                    return E.resolve(Ci(e));
                case "object":
                    var n = t.object; if (Ni(n.status)) { if ("manual" !== n.confirmation_method) throw new S("handleCardAction: The PaymentIntent supplied does not require manual server-side confirmation. Please use confirmCardPayment instead to complete the payment."); return ja(r, n, xi.card, t.locale, !1) } throw new S("handleCardAction: The PaymentIntent supplied is not in the requires_action state.");
                default:
                    return Object(m.a)(t) } }) }

    function Da(e, t) { if ("object" === (void 0 === e ? "undefined" : ls(e)) && null !== e && void 0 !== e.handleActions) throw new S("stripe." + t + " does not support a handleActions option. For more information, see " + ia(t)) }

    function Ba(e) { var t = e.mode; if (t.data && t.data.billing_details && "object" === ls(t.data.billing_details)) return t.data.billing_details; throw new S("Missing payment_method[billing_details]") }

    function qa(e) { var t = e.mode,
            n = "none" === t.tag,
            r = "paymentMethod" === t.tag,
            o = "paymentMethod-from-data" === t.tag && t.data.acss_debit; return !n && !r && !o }

    function Fa(e) { var t = e.controller,
            n = e.intentSecret,
            r = e.mode,
            o = e.billingDetails; return t.action.createAcssDebitSession({ intentSecret: n, billingDetails: o, mode: r }).then(function(e) { if ("error" === e.type) return { type: "error", error: e.error }; var r = Oa(t, { url: e.object.url, size: "400x600", locale: e.locale, frameTitle: "acss.dialog_frame_title", useLightboxHostedCloseButton: !1 }); return new E(function(n) { r._on("request-close", function() { Aa(r).then(function() { return t.action.localizeError(ps) }).then(function(e) { n({ type: "error", error: e }) }) }), r._on("session-complete", function(e) { var t = e.paymentMethod;
                    Aa(r).then(function() { n({ type: "success", paymentMethod: t }) }) }) }) }) } var Ua = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) { return typeof e } : function(e) { return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e },
        Ha = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e },
        za = Ma("confirmAcssDebitPayment", xi.acss_debit),
        Ga = Ma("confirmAfterpayClearpayPayment", xi.afterpay_clearpay),
        Ya = Ma("confirmAuBecsDebitPayment", xi.au_becs_debit),
        Wa = Ma("confirmBacsDebitPayment", xi.bacs_debit),
        Ka = Ma("confirmBancontactPayment", xi.bancontact),
        Va = Ma("confirmBoletoPayment", xi.boleto),
        Ja = Ma("confirmCardPayment", xi.card),
        $a = Ma("confirmEpsPayment", xi.eps),
        Xa = Ma("confirmFpxPayment", xi.fpx),
        Za = Ma("confirmGiropayPayment", xi.giropay),
        Qa = Ma("confirmGrabPayPayment", xi.grabpay),
        es = Ma("confirmIdealPayment", xi.ideal),
        ts = Ma("confirmOxxoPayment", xi.oxxo),
        ns = Ma("confirmAlipayPayment", xi.alipay),
        rs = Ma("confirmP24Payment", xi.p24),
        os = Ma("confirmPayPalPayment", xi.paypal),
        is = Ma("confirmSepaDebitPayment", xi.sepa_debit),
        as = Ma("confirmSofortPayment", xi.sofort),
        ss = Ma("confirmUpiPayment", xi.upi),
        cs = Ma("confirmNetbankingPayment", xi.netbanking),
        us = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e },
        ls = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) { return typeof e } : function(e) { return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e },
        ps = { type: "validation_error", code: "incomplete_payment_details" },
        ds = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e },
        fs = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) { return typeof e } : function(e) { return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e };

    function ms(e, t) { var n, r = {}; for (n in e) 0 <= t.indexOf(n) || Object.prototype.hasOwnProperty.call(e, n) && (r[n] = e[n]); return r }

    function hs(e, t) { if (null == e) return M(null); var n = e.type,
            r = ms(e, ["type"]),
            o = W(Y, function() { return null })(n, B(t, "type")); return "error" === o.type ? o : M({ type: o.value, data: r }) }

    function _s(e, t, n, r) { if (null === e) { if (null !== t) return t; throw new S(n + ": you must additionally specify the type of payment method to create within " + (r ? "source_data" : "payment_method_data") + ".") } if (null === t) return e; if (t !== e) throw new S(n + ": you specified `type: " + t + "`, but " + n + " will create a " + e + " payment method."); return e }

    function ys(p) { return function(e, t) { if ("object" !== (void 0 === e ? "undefined" : fs(e)) || null === e) return L("object", null === e ? "null" : void 0 === e ? "undefined" : fs(e), t); var n = e.source,
                r = e.source_data,
                o = e.payment_method,
                i = e.payment_method_data,
                a = ms(e, ["source", "source_data", "payment_method", "payment_method_data"]); if (null != n && "string" != typeof n) return L("string", void 0 === n ? "undefined" : fs(n), B(t, "source")); if (null != o && "string" != typeof o) return L("string", void 0 === o ? "undefined" : fs(o), B(t, "payment_method")); if (null != r && "object" !== (void 0 === r ? "undefined" : fs(r))) return L("object", void 0 === r ? "undefined" : fs(r), B(t, "source_data")); if (null != i && "object" !== (void 0 === i ? "undefined" : fs(i))) return L("object", void 0 === i ? "undefined" : fs(i), B(t, "payment_method_data")); var s = hs(r, B(t, "source_data")); if ("error" === s.type) return s; var c = s.value,
                u = hs(i, B(t, "payment_method_data")); if ("error" === u.type) return u; var l = u.value; return M({ sourceData: c, source: null == n ? null : n, paymentMethodData: l, paymentMethod: null == o ? null : o, otherParams: ds({}, p, a) }) } }

    function vs(o) { return function(e, t) { if (void 0 === e) return M({ sourceData: null, paymentMethodData: null, source: null, paymentMethod: null, otherParams: {} }); if ("object" !== (void 0 === e ? "undefined" : fs(e))) return L("object", void 0 === e ? "undefined" : fs(e), t); if (null === e) return L("object", "null", t); if (o) { if (!e.payment_intent) return M({ sourceData: null, paymentMethodData: null, source: null, paymentMethod: null, otherParams: e }); var n = e.payment_intent,
                    r = ms(e, ["payment_intent"]); return ys(r)(n, B(t, "payment_intent")) } return e.payment_intent ? x(new S("The payment_intent parameter has been removed. To fix, move everything nested under the payment_intent parameter to the top-level object.")) : ys({})(e, t) } }

    function bs(e, t, n, r, o, i) { var a = re(Ai, o, r); if ("error" === a.type) return null; var s = a.value,
            c = le(vs(t), i, r).value,
            u = c.sourceData,
            l = c.source,
            p = c.paymentMethodData,
            d = c.paymentMethod,
            f = c.otherParams; if (!e && u) throw new S(r + ": Expected payment_method_data, not source_data."); if (null != l) throw new S("When calling " + r + " on an Element, you can't pass in a pre-existing source ID, as a source will be created using the Element."); if (null != d) throw new S("When calling " + r + " on an Element, you can't pass in a pre-existing PaymentMethod ID, as a PaymentMethod will be created using the Element."); var m, h, _ = s._componentName,
            y = s._implementation._frame.id,
            v = u || p || { type: null, data: {} },
            b = v.data,
            g = (m = _, null != (h = v.type) ? h : !Ii(m) && Li[m] || null),
            w = e && !p,
            E = { elementName: _, frameId: y, type: _s(n, g, r, w), data: b }; return w ? { mode: ds({ tag: "source-from-element" }, E), otherParams: f } : { mode: ds({ tag: "paymentMethod-from-element", options: null }, E), otherParams: f } }

    function gs(o, i, a, s) { return function(e, t) { var n = bs(o, i, a, s, e, t); if (n) return n; var r = function(e, t, n, r, o) { var i = le(vs(t), o, r).value,
                    a = i.sourceData,
                    s = i.source,
                    c = i.paymentMethodData,
                    u = i.paymentMethod,
                    l = i.otherParams; if (!e && a) throw new S(r + ": Expected payment_method, source, or payment_method_data, not source_data."); if (null !== s && null !== a) throw new S(r + ": Expected either source or source_data, but not both."); if (null !== u && null !== c) throw new S(r + ": Expected either payment_method or payment_method_data, but not both."); if (null !== u && null !== s) throw new S(r + ": Expected either payment_method or source, but not both."); if (a || c) { var p = a || c || {},
                        d = p.data,
                        f = e && !c,
                        m = _s(n, p.type, r, f); return f ? { mode: { tag: "source-from-data", type: m, data: d }, otherParams: l } : { mode: { tag: "paymentMethod-from-data", type: m, data: d, options: null }, otherParams: l } } return null !== s ? { mode: { tag: "source", source: s }, otherParams: l } : null !== u ? { mode: { tag: "paymentMethod", paymentMethod: u, options: null }, otherParams: l } : { mode: { tag: "none" }, otherParams: l } }(o, i, a, s, e); if (r) return r; throw new S("Expected: stripe." + s + "(intentSecret, element[, data]) or stripe." + s + "(intentSecret[, data]). Please see the docs for more usage examples https://stripe.com/docs/payments/dynamic-authentication") } }

    function ws(e, t, n, r, o, i) { var a = le(Hi, r, "stripe.confirmPaymentIntent intent secret").value,
            s = null,
            c = gs(e, !1, s, "confirmPaymentIntent")(o, i); return t.action.confirmPaymentIntent(Ns({}, c, { intentSecret: a, expectedType: s, options: { handleActions: !1 }, mids: n })).then(Ci) }

    function Es(e, t, n, r, o, i, a) { var s = le(Hi, o, "stripe.handleCardPayment intent secret").value,
            c = xi.card,
            u = gs(e, r, c, "handleCardPayment")(i, a),
            l = !i && !a; return t.action.confirmPaymentIntent(Ns({}, u, { intentSecret: s, expectedType: c, options: { handleActions: !0 }, mids: n })).then(Na(t, c, l, !1)) }

    function Ss(e, t, n, r, o, i, a) { var s = le(Hi, o, "stripe.handleIdealPayment intent secret").value,
            c = xi.ideal,
            u = gs(e, r, c, "handleIdealPayment")(i, a),
            l = !i && !a; return t.action.confirmPaymentIntent(Ns({}, u, { intentSecret: s, expectedType: c, options: { handleActions: !0 }, mids: n })).then(Na(t, c, l, !1)) }

    function Ps(e) { switch (e.type) {
            case "object":
                return { returnIntent: e.object };
            case "error":
                return { error: e.error };
            default:
                return Object(m.a)(e) } }

    function ks(e, t, n, r, o) { var i, a, s, c = pa(Mi(t), n, e),
            u = ji(t); if (!c) return E.resolve({ setupIntent: t }); switch (c.type) {
            case "3ds1-modal":
                return _a(c, u, me.SETUP_INTENT, e, r);
            case "3ds2-fingerprint":
            case "3ds2-challenge":
                return ka(u, me.SETUP_INTENT, c, e, r, o);
            case "redirect":
                return i = n, a = c.redirectUrl, s = e, Ta(a).then(function(e) { return Ia(s, i + " redirect", e), Ri(e) });
            default:
                return E.resolve({ setupIntent: t }) } }

    function Os(e, t, n, r, o) { return ks(e, t, n, r, o).then(function(e) { if (e.paymentIntent) throw new Error("Got unexpected PaymentIntent response"); return e }) }

    function As(o, i, a, s) { return function(e) { switch (e.type) {
                case "error":
                    var t = e.error,
                        n = t.setup_intent; return a && n && "succeeded" === n.status ? E.resolve({ setupIntent: n }) : E.resolve({ error: t });
                case "object":
                    var r = e.object; return Os(o, r, i, e.locale, s);
                default:
                    return Object(m.a)(e) } } }

    function Ts(l, p) { return function(e, t, n, r, o) { var i = aa(n, l),
                a = ca(p, l, r),
                s = sa(l, o),
                c = "none" === a.mode.tag,
                u = e.action.confirmSetupIntent(Ms({}, a, { intentSecret: i, expectedType: p, options: s, mids: t })); return s.handleActions ? u.then(As(e, p, c, !1)) : u.then(Ri) } }

    function Is(e, t, n, r, o) { var i = le(Hi, n, "stripe.handleCardSetup intent secret").value,
            a = xi.card,
            s = gs(!1, !1, a, "handleCardSetup")(r, o),
            c = !r && !o; return e.action.confirmSetupIntent(Gs({}, s, { intentSecret: i, expectedType: a, options: { handleActions: !0 }, mids: t })).then(As(e, a, c, !1)) }

    function Cs(e, t) { if ("string" != typeof e) return D("an Issuing card ID of the form ic_xxx", e, t); var n, r = (n = e.trim().match(/ic_[a-zA-Z0-9_]+$/)) ? n[0] : null; return null === r ? D("an Issuing card ID of the form ic_xxx", e, t) : M(r, []) }

    function Rs(e, t) { if ("string" != typeof e) return D("an ephemeral key secret of the form ek_xxx", e, t); var n, r = (n = e.trim().match(/ek_[a-zA-Z0-9_]+$/)) ? n[0] : null; return null === r ? D("an ephemeral key secret of the form ek_xxx", e, t) : M(r, []) }

    function js(e, t, n) { var r = le(Cs, e, "stripe." + "retrieveIssuingCard" + " cardId").value,
            o = le(Rs, t, "stripe." + "retrieveIssuingCard" + " ephemeral key secret").value; return n.action.retrieveIssuingCard({ cardId: r, ephemeralKeySecret: o }).then(Vo) } var Ns = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e },
        Ms = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e },
        xs = Ts("confirmAcssDebitSetup", xi.acss_debit),
        Ls = Ts("confirmCardSetup", xi.card),
        Ds = Ts("confirmSepaDebitSetup", xi.sepa_debit),
        Bs = Ts("confirmAuBecsDebitSetup", xi.au_becs_debit),
        qs = Ts("confirmBacsDebitSetup", xi.bacs_debit),
        Fs = Ts("confirmIdealSetup", xi.ideal),
        Us = Ts("confirmAlipaySetup", xi.alipay),
        Hs = Ts("confirmSofortSetup", xi.sofort),
        zs = Ts("confirmBancontactSetup", xi.bancontact),
        Gs = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e },
        Ys = [In.checkout_beta_2, In.checkout_beta_3, In.checkout_beta_4],
        Ws = [In.checkout_beta_2, In.checkout_beta_3, In.checkout_beta_4, In.checkout_beta_locales, In.checkout_beta_testcards],
        Ks = Object.keys({ bg: "bg", cs: "cs", da: "da", de: "de", el: "el", en: "en", "en-GB": "en-GB", es: "es", "es-419": "es-419", et: "et", fi: "fi", fr: "fr", "fr-CA": "fr-CA", hu: "hu", id: "id", it: "it", ja: "ja", lt: "lt", lv: "lv", ms: "ms", mt: "mt", nb: "nb", nl: "nl", pl: "pl", pt: "pt", "pt-BR": "pt-BR", ro: "ro", ru: "ru", sk: "sk", sl: "sl", sv: "sv", tr: "tr", zh: "zh", "zh-HK": "zh-HK", "zh-TW": "zh-TW" }),
        Vs = Object.keys({ th: "th", "pt-PT": "pt-PT" }),
        Js = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e };

    function $s(e, t) { var n, r = {}; for (n in e) 0 <= t.indexOf(n) || Object.prototype.hasOwnProperty.call(e, n) && (r[n] = e[n]); return r }

    function Xs(e) { if (Array.isArray(e)) { for (var t = 0, n = Array(e.length); t < e.length; t++) n[t] = e[t]; return n } return Array.from(e) }

    function Zs(e, t) { var n = ce(Js({}, tc, { items: q(F(Q(ce({ type: z("plan"), quantity: J(0), id: Y })), Q(ce({ type: z("sku"), quantity: J(0), id: Y })))), successUrl: Y, cancelUrl: Y })),
            r = le(n, t, "stripe.redirectToCheckout").value,
            o = r.sku,
            i = r.plan,
            a = r.items,
            s = $s(r, ["sku", "plan", "items"]),
            c = function(e, t, n) { if (e && t || (e || t) && n) throw new S("stripe.redirectToCheckout: Expected only one of sku, plan, or items."); if ("string" == typeof e) return [{ sku: e, quantity: 1 }]; if ("string" == typeof t) return [{ plan: t, quantity: 1 }]; if (n) return n.map(function(e) { return "sku" === e.type ? { sku: e.id, quantity: e.quantity } : { plan: e.id, quantity: e.quantity } }); throw new S("stripe.redirectToCheckout: You must provide either sku, plan, or items.") }(o, i, a); return Js({ tag: "no-session", items: c }, s) }

    function Qs(e, t, n) { var r = ce(Js({}, tc, { sessionId: q(Y), successUrl: q(Y), cancelUrl: q(Y), mode: q(z("subscription", "payment")), items: q(F(Q(ce({ quantity: J(0), plan: Y })), Q(ce({ quantity: J(0), sku: Y })))), lineItems: q(Q(ce({ quantity: J(0), price: Y }))) }, -1 !== e.indexOf("checkout_beta_locales") ? { locale: q(z.apply(void 0, ["auto"].concat(Xs(Ks), Xs(Vs)))) } : {})),
            o = le(r, t, "stripe.redirectToCheckout").value; if (o.sessionId) { var i = o.sessionId; if (1 < Object.keys(o).length) throw new S("stripe.redirectToCheckout: Do not provide other parameters when providing sessionId. Specify all parameters on your server when creating the CheckoutSession."); if (!/^cs_/.test(i)) throw new S("stripe.redirectToCheckout: Invalid value for sessionId. You specified '" + i + "'."); if ("livemode" === n && /^cs_test_/.test(i)) throw new S("stripe.redirectToCheckout: the provided sessionId is for a test mode Checkout Session, whereas Stripe.js was initialized with a live mode publishable key."); if ("testmode" === n && /^cs_live_/.test(i)) throw new S("stripe.redirectToCheckout: the provided sessionId is for a live mode Checkout Session, whereas Stripe.js was initialized with a test mode publishable key."); return { tag: "session", sessionId: i } }
        o.sessionId, o.sku, o.plan; var a = o.items,
            s = o.lineItems,
            c = o.successUrl,
            u = o.cancelUrl,
            l = o.mode,
            p = $s(o, ["sessionId", "sku", "plan", "items", "lineItems", "successUrl", "cancelUrl", "mode"]); if (!s && !a) throw new S("stripe.redirectToCheckout: You must provide one of lineItems, items, or sessionId."); if (!c || !u) throw new S("stripe.redirectToCheckout: You must provide successUrl and cancelUrl."); return Js({ tag: "no-session", items: a, lineItems: s, successUrl: c, cancelUrl: u, mode: l }, p) }

    function ec(e, t, n) { var r = Qs(e, t, n); if ("no-session" !== r.tag) return r; var o = r.successUrl,
            i = r.cancelUrl; if (!g(o)) throw new S("stripe.redirectToCheckout: successUrl must start with either http:// or https://."); if (!g(i)) throw new S("stripe.redirectToCheckout: cancelUrl must start with either http:// or https://."); return r } var tc = { sku: q(Y), plan: q(Y), clientReferenceId: q(Y), locale: q(z.apply(void 0, ["auto"].concat(Xs(Ks)))), customerEmail: q(Y), billingAddressCollection: q(z("required", "auto")), submitType: q(z("auto", "pay", "book", "donate")), allowIncompleteSubscriptions: q(K), shippingAddressCollection: q(ce({ allowedCountries: Q(Y) })) },
        nc = /cs_(test|live)_.+/,
        rc = function(e, t, n, r) { var o, i; return o = t, "session" === (i = function(t, e, n) { var r = w(Ys, function(e) { return jn(t, e) }); if (e && e.lineItems && r) throw new S("Prices cannot be used with " + r); if ("string" == typeof e && nc.test(e)) throw new S("stripe.redirectToCheckout: Checkout Session IDs must be passed in as an object with a key of `sessionId` and the Session ID as the value."); switch (r) {
                    case "checkout_beta_2":
                        return Zs(0, e);
                    case "checkout_beta_3":
                        return Qs(t, e, n);
                    case "checkout_beta_4":
                    default:
                        return ec(t, e, n) } }(e, n, 3 < arguments.length && void 0 !== r ? r : "unknown")).tag || null == o || i.locale || -1 === ["auto"].concat(Xs(Ks)).indexOf(o) ? i : Js({}, i, { locale: o }) },
        oc = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e };

    function ic(t, e) { return Ta(e).then(function(e) { return Ia(t, "redirectToCheckout", e), { error: e.error } }) }

    function ac(n, t, e, r, o) { n.report("redirect_to_checkout.options", { betas: t, options: o, globalLocale: r }); var i = rc(t, r, o, n.livemode()); if ("session" === i.tag) { var a = i.sessionId; return n.action.createPaymentPageWithSession({ betas: t, mids: e(), sessionId: a }).then(function(e) { if ("error" === e.type) return { error: e.error }; var t = e.object.url; return ic(n, t) }) }
        i.tag; var s = i.items,
            c = i.lineItems,
            u = i.mode,
            l = i.successUrl,
            p = i.cancelUrl,
            d = i.clientReferenceId,
            f = i.customerEmail,
            m = i.billingAddressCollection,
            h = i.submitType,
            _ = i.allowIncompleteSubscriptions,
            y = i.shippingAddressCollection,
            v = function(e, t) { var n, r = {}; for (n in e) 0 <= t.indexOf(n) || Object.prototype.hasOwnProperty.call(e, n) && (r[n] = e[n]); return r }(i, ["tag", "items", "lineItems", "mode", "successUrl", "cancelUrl", "clientReferenceId", "customerEmail", "billingAddressCollection", "submitType", "allowIncompleteSubscriptions", "shippingAddressCollection"]),
            b = []; if (c && s) throw new Error("Only one of items, lineItems can be passed in."); if (c) { if (!u) throw new Error("Expected `mode`");
            b = c.map(function(e) { if (e.price) return { type: "price", id: e.price, quantity: e.quantity }; throw new Error("Unexpected item shape.") }) } else { if (!s) throw new Error("An items field must be passed in.");
            b = s.map(function(e) { if (e.sku) return { type: "sku", id: e.sku, quantity: e.quantity }; if (e.plan) return { type: "plan", id: e.plan, quantity: e.quantity }; throw new Error("Unexpected item shape.") }) } var g = w(Ys, function(e) { return jn(t, e) }); return n.action.createPaymentPage(oc({ betas: t, mids: e(), items: b, mode: u, success_url: l, cancel_url: p, client_reference_id: d, customer_email: f, billing_address_collection: m, submit_type: h, use_payment_methods: !g, allow_incomplete_subscriptions: _, shipping_address_collection: y && { allowed_countries: y.allowedCountries } }, v)).then(function(e) { if ("error" === e.type) return { error: e.error }; var t = e.object.url; return ic(n, t) }) }

    function sc(e) { switch (e.type) {
            case "object":
                return { token: e.object };
            case "error":
                return { error: e.error };
            default:
                return Object(m.a)(e) } }

    function cc(e) { return "object" === (void 0 === e ? "undefined" : lc(e)) && null !== e ? e : {} }

    function uc(e) { switch (e.type) {
            case "object":
                return { radarSession: e.object };
            case "error":
                return { error: e.error };
            default:
                return Object(m.a)(e) } } var lc = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) { return typeof e } : function(e) { return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e },
        pc = function(e, t, n) { return t && dc(e.prototype, t), n && dc(e, n), e };

    function dc(e, t) { for (var n = 0; n < t.length; n++) { var r = t[n];
            r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(e, r.key, r) } } var fc = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e };

    function mc(e) { if (Array.isArray(e)) { for (var t = 0, n = Array(e.length); t < e.length; t++) n[t] = e[t]; return n } return Array.from(e) } var hc = new b,
        _c = document ? document.readyState : "unknown",
        yc = !1; switch (_c) {
        case "loading":
            yc = !0; break;
        case "interactive":
            try { var vc = function() { yc = !0 };
                setTimeout(function() { document.removeEventListener("DOMContentLoaded", vc) }, 0), document.addEventListener("DOMContentLoaded", vc) } catch (e) {} }

    function bc(e, t, n, r) { var o, i, a, s, c, u, l, p, d, f;
        Sc && !r || (Sc = !0, o = r || new b, "complete" === document.readyState ? (f = l = u = c = s = null, window.performance && (window.performance.timing && (a = (i = window.performance.timing).fetchStart, s = i.domLoading - a, c = i.domInteractive - a, u = i.domComplete - a, l = b.fromPosixTime(a).getElapsedTime(hc)), window.performance.getEntriesByType && (p = window.performance.getEntriesByType("resource"), d = "https://js.stripe.com/v3/".replace(/\/$/, ""), f = p.reduce(function(e, t) { if (0 === t.name.indexOf(d)) { var n = t.name.match(/\/([^/#?]*)\/?(?:$|[#?])/); if (n && n[1]) { var r = n[1].replace(/-[0-9a-f]{32}\./, "."); return "v3" === r && (r = "stripe.js"), fc({}, e, (o = {}, i = r, a = { transfer_size: t.transferSize, duration: Math.round(t.duration) }, i in o ? Object.defineProperty(o, i, { value: a, enumerable: !0, configurable: !0, writable: !0 }) : o[i] = a, o)) } } var o, i, a; return e }, {}))), e.report("timings", { element: e.controllerFor(), dom_loading: s, dom_interactive: c, dom_complete: u, since_fetch: l, load_count: 1, load_before_dom_content_loaded: yc, load_ready_state: _c, first_create_ready_state: t, first_mount_readyState: n, until_first_create: hc.getElapsedTime(e._createTimestamp), until_first_mount: hc.getElapsedTime(e._mountTimestamp), until_first_load: hc.getElapsedTime(o), resource_timings: f })) : window.addEventListener("load", function() { return bc(e, t, n, o) })) }

    function gc(e) { return "You have an in-flight " + e + "! Please be sure to disable your form submit button when " + e + " is called." }

    function wc(e) { return function() { throw new S("You cannot call `stripe." + e + "` without supplying a PaymentIntents beta flag when initializing Stripe.js.    You can find more information including code snippets at https://www.stripe.com/docs/payments/payment-intents/quickstart.") } } var Ec, Sc = !1,
        Pc = ue({ apiKey: Y, stripeAccount: q(Y), locale: q(Y), apiVersion: q(Y), __privateApiUrl: q(Y), __checkout: q(ue({ mids: ue({ muid: Y, sid: Y }) })), __hosted3DS: q(K), canCreateRadarSession: q(K), betas: q(Q(G.apply(void 0, mc(Rn)))) }),
        kc = (pc(Oc, [{ key: "_attachCreateRadarSession", value: function(e) { var t, n, r = this;
                e && (this.createRadarSession = (t = function() { var e, t, n = r._mids(); return e = r._controller, t = n, e.action.createRadarSession({ mids: t }).then(uc) }, function() { try { return t.call(this) } catch (e) { return Re(e, n || this && this._controller) } })) } }, { key: "_attachPaymentIntentMethods", value: function(e, t) {
                function r() { return o._mids() } var o = this;
                this.createPaymentMethod = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return oa.apply(void 0, [o._controller, r()].concat(t)) }), this._createPaymentMethod = this.createPaymentMethod, this.retrievePaymentIntent = je(function(e) { return t = e, n = o._controller, r = aa(t, "retrievePaymentIntent"), n.action.retrievePaymentIntent({ intentSecret: r, hosted: !1 }).then(Ci); var t, n, r }), this.retrieveSetupIntent = je(function(e) { return t = e, n = o._controller, r = aa(t, "retrieveSetupIntent"), n.action.retrieveSetupIntent({ intentSecret: r, hosted: !1 }).then(Ri); var t, n, r }), this.updatePaymentIntent = wc("updatePaymentIntent"), (jn(this._betas, In.line_items_beta_1) || jn(this._betas, In.tax_product_beta_1)) && (this.updatePaymentIntent = Ue(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return xa.apply(void 0, [o._controller, r()].concat(t)) })); var n = Tt(La, gc("handleCardAction"));
                this.handleCardAction = je(function(e) { return n(e, o._controller) }); var i = Tt(Ja, gc("confirmCardPayment"));
                this.confirmCardPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return i.apply(void 0, [o._controller, r()].concat(t)) }); var a = Tt(Ls, gc("confirmCardSetup"));
                this.confirmCardSetup = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return a.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmIdealPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return es.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmSepaDebitPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return is.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmSepaDebitSetup = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return Ds.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmFpxPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return Xa.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmAlipayPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return ns.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmAlipaySetup = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return Us.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmAuBecsDebitPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return Ya.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmAuBecsDebitSetup = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return Bs.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmBacsDebitPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return Wa.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmBacsDebitSetup = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return qs.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmBancontactPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return Ka.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmEpsPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return $a.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmGiropayPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return Za.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmOxxoPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return ts.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmP24Payment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return rs.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmSofortPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return as.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmIdealSetup = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return Fs.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmSofortSetup = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return Hs.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmBancontactSetup = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return zs.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmGrabPayPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return Qa.apply(void 0, [o._controller, r()].concat(t)) }), this.verifyMicrodepositsForPayment = wc("verifyMicrodepositsForPayment"), this.verifyMicrodepositsForSetup = wc("verifyMicrodepositsForSetup"), (jn(this._betas, In.acss_debit_beta_1) || jn(this._betas, In.acss_debit_beta_2)) && (this.verifyMicrodepositsForPayment = Ue(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return function(e, t, n) { var r = aa(t, "verifyMicrodepositsForSetup"),
                            o = le(Z, n, "stripe.verifyMicrodepositsForSetup"); return e.action.verifyMicrodepositsForPayment({ intentSecret: r, data: o.value }).then(Ci) }.apply(void 0, [o._controller].concat(t)) }), this.verifyMicrodepositsForSetup = Ue(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return function(e, t, n) { var r = aa(t, "verifyMicrodepositsForSetup"),
                            o = le(Z, n, "stripe.verifyMicrodepositsForSetup"); return e.action.verifyMicrodepositsForSetup({ intentSecret: r, data: o.value }).then(Ri) }.apply(void 0, [o._controller].concat(t)) })), this.confirmAcssDebitPayment = wc("confirmAcssDebitPayment"), this.confirmAcssDebitSetup = wc("confirmAcssDebitSetup"), jn(this._betas, In.acss_debit_beta_1) ? (this.confirmAcssDebitPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return za.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmAcssDebitSetup = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return xs.apply(void 0, [o._controller, r()].concat(t)) })) : jn(this._betas, In.acss_debit_beta_2) && (this.confirmAcssDebitPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return function(t, n, e, r, o) { var i = "confirmAcssDebitPayment",
                            a = xi.acss_debit,
                            s = aa(e, i),
                            c = ca(a, i, r); return Da(o, i), qa(c) ? Fa({ controller: t, intentSecret: s, mode: "payment", billingDetails: Ba(c) }).then(function(e) { switch (e.type) {
                                case "error":
                                    return { error: e.error };
                                case "success":
                                    return t.action.confirmPaymentIntent({ mode: { tag: "paymentMethod", paymentMethod: e.paymentMethod, options: c.mode.options || {} }, otherParams: c.otherParams, intentSecret: s, expectedType: a, options: { handleActions: !1 }, mids: n }).then(Ci);
                                default:
                                    return Object(m.a)(e.type) } }) : t.action.confirmPaymentIntent(us({}, c, { intentSecret: s, expectedType: a, options: { handleActions: !1 }, mids: n })).then(Ci) }.apply(void 0, [o._controller, r()].concat(t)) }), this.confirmAcssDebitSetup = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return function(t, n, e, r, o) { var i = "confirmAcssDebitSetup",
                            a = xi.acss_debit,
                            s = aa(e, i),
                            c = ca(a, i, r); return Da(o, i), qa(c) ? Fa({ controller: t, intentSecret: s, mode: "setup", billingDetails: Ba(c) }).then(function(e) { switch (e.type) {
                                case "error":
                                    return { error: e.error };
                                case "success":
                                    return t.action.confirmSetupIntent({ mode: { tag: "paymentMethod", paymentMethod: e.paymentMethod, options: c.mode.options || {} }, otherParams: c.otherParams, intentSecret: s, expectedType: a, options: { handleActions: !1 }, mids: n }).then(Ri);
                                default:
                                    return Object(m.a)(e.type) } }) : t.action.confirmSetupIntent(us({}, c, { intentSecret: s, expectedType: a, options: { handleActions: !1 }, mids: n })).then(Ri) }.apply(void 0, [o._controller, r()].concat(t)) })), jn(this._betas, In.return_intents_beta_1) && (this.confirmReturnIntent = Ue(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return function(e, t, n) { return e.action.confirmReturnIntent({ returnIntentId: t, data: n }).then(Ps) }.apply(void 0, [o._controller].concat(t)) })), this.confirmBoletoPayment = wc("confirmBoletoPayment"), jn(this._betas, In.boleto_pm_beta_1) && (this.confirmBoletoPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return Va.apply(void 0, [o._controller, r()].concat(t)) })), this.confirmKonbiniPayment = wc("confirmKonbiniPayment"), jn(this._betas, In.konbini_pm_beta_1) && (this.confirmKonbiniPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return function(e, t, n, r, o) { return o && !1 === o.handleActions ? Ma("confirmKonbiniPayment", xi.konbini)(e, t, n, r, o) : E.reject(new S("Expected option `handleActions` to be `false`.")) }.apply(void 0, [o._controller, r()].concat(t)) })), jn(this._betas, In.oxxo_pm_beta_1) && (this.confirmOxxoPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return ts.apply(void 0, [o._controller, r()].concat(t)) })), this.confirmWechatPayPayment = wc("confirmWechatPayPayment"), jn(this._betas, In.wechat_pay_pm_beta_1) && (this.confirmWechatPayPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return function(e, t, n, r, o) { if (o && !0 === o.handleActions) throw new S("Expected option `handleActions` to be `false`."); var i = Ha({}, r, { payment_method_options: Ha({}, r && r.payment_method_options || {}, { wechat_pay: Ha({}, r && r.payment_method_options && r.payment_method_options.wechat_pay || {}) }) }); return Ma("confirmWechatPayPayment", xi.wechat_pay)(e, t, n, i, o) }.apply(void 0, [o._controller, r()].concat(t)) })), this.confirmPayPalPayment = wc("confirmPayPalPayment"), jn(this._betas, In.paypal_pm_beta_1) && (this.confirmPayPalPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return os.apply(void 0, [o._controller, r()].concat(t)) })), this.confirmAfterpayClearpayPayment = wc("confirmAfterpayClearpayPayment"), jn(this._betas, In.afterpay_clearpay_pm_beta_1) && (this.confirmAfterpayClearpayPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return Ga.apply(void 0, [o._controller, r()].concat(t)) })), this.confirmUpiPayment = wc("confirmUpiPayment"), jn(this._betas, In.upi_beta_1) && (this.confirmUpiPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return ss.apply(void 0, [o._controller, r()].concat(t)) })), this.confirmNetbankingPayment = wc("confirmNetbankingPayment"), jn(this._betas, In.netbanking_beta_1) && (this.confirmNetbankingPayment = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return cs.apply(void 0, [o._controller, r()].concat(t)) })), t && (this.handleHosted3DS2Payment = je(function(e) { return t = e, n = o._controller, r = aa(t, "handleHosted3DS2Setup [internal]"), n.action.retrievePaymentIntent({ intentSecret: r, hosted: !0 }).then(Na(n, xi.card, !1, !0)); var t, n, r }), this.handleHosted3DS2Setup = je(function(e) { return t = e, n = o._controller, r = aa(t, "handleHosted3DS2Setup [internal]"), n.action.retrieveSetupIntent({ intentSecret: r, hosted: !0 }).then(As(n, xi.card, !1, !0)); var t, n, r })) } }, { key: "_attachLegacyPaymentIntentMethods", value: function() {
                function r() { return o._mids() } var o = this,
                    i = jn(this._betas, In.payment_intent_beta_1) || jn(this._betas, In.payment_intent_beta_2),
                    e = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return ws.apply(void 0, [!0, o._controller, r()].concat(t)) }),
                    t = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return ws.apply(void 0, [!1, o._controller, r()].concat(t)) }),
                    a = Tt(Es, gc("handleCardPayment")),
                    n = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return a.apply(void 0, [!0, o._controller, r(), i].concat(t)) }),
                    s = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return a.apply(void 0, [!1, o._controller, r(), i].concat(t)) }),
                    c = Tt(Is, gc("handleCardSetup")),
                    u = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return c.apply(void 0, [o._controller, r()].concat(t)) }),
                    l = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return function(e, t, n, r, o) { var i = le(Hi, n, "stripe.confirmSetupIntent intent secret").value,
                                a = null,
                                s = gs(!1, !1, a, "confirmSetupIntent")(r, o); return e.action.confirmSetupIntent(Gs({}, s, { otherParams: Gs({}, s.otherParams), intentSecret: i, expectedType: a, options: { handleActions: !1 }, mids: t })).then(Ri) }.apply(void 0, [o._controller, r()].concat(t)) }),
                    p = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return function(e, t, n, r, o, i) { var a = le(Hi, r, "stripe.handleSepaDebitPayment intent secret").value,
                                s = xi.sepa_debit,
                                c = gs(!1, n, s, "handleSepaDebitPayment")(o, i),
                                u = !o && !i; return e.action.confirmPaymentIntent(Ns({}, c, { intentSecret: a, expectedType: s, options: { handleActions: !0 }, mids: t })).then(Na(e, s, u, !1)) }.apply(void 0, [o._controller, r(), i].concat(t)) }),
                    d = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return function(e, t, n, r, o) { var i = le(Hi, n, "stripe.handleSepaDebitSetup intent secret").value,
                                a = xi.sepa_debit,
                                s = gs(!1, !1, a, "handleSepaDebitSetup")(r, o),
                                c = !r && !o; return e.action.confirmSetupIntent(Gs({}, s, { intentSecret: i, expectedType: a, options: { handleActions: !0 }, mids: t })).then(As(e, a, c, !1)) }.apply(void 0, [o._controller, r()].concat(t)) }),
                    f = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return Ss.apply(void 0, [!0, o._controller, r(), i].concat(t)) }),
                    m = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return Ss.apply(void 0, [!1, o._controller, r(), i].concat(t)) }),
                    h = Ne(function() { for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return function(e, t, n, r, o, i) { var a = le(Hi, r, "stripe.handleFpxPayment intent secret").value,
                                s = xi.fpx,
                                c = gs(!1, n, s, "handleFpxPayment")(o, i),
                                u = !o && !i; return e.action.confirmPaymentIntent(Ns({}, c, { intentSecret: a, expectedType: s, options: { handleActions: !0 }, mids: t })).then(Na(e, s, u, !1)) }.apply(void 0, [o._controller, r(), i].concat(t)) });
                this.handleCardPayment = s, this.confirmPaymentIntent = t, this.handleCardSetup = u, this.confirmSetupIntent = l, this.fulfillPaymentIntent = wc("fulfillPaymentIntent"), this.handleSepaDebitPayment = wc("handleSepaDebitPayment"), this.handleSepaDebitSetup = wc("handleSepaDebitSetup"), this.handleIdealPayment = wc("handleIdealPayment"), this.handleFpxPayment = wc("handleFpxPayment"), jn(this._betas, In.payment_intent_beta_1) ? this.fulfillPaymentIntent = n : (jn(this._betas, In.payment_intent_beta_3) || jn(this._betas, In.payment_intent_beta_2)) && (this.handleCardPayment = n), jn(this._betas, In.payment_intent_beta_3) && (this.confirmPaymentIntent = e, this.handleIdealPayment = f, this.handleSepaDebitPayment = p), jn(this._betas, In.fpx_bank_beta_1) && (this.handleFpxPayment = h), jn(this._betas, In.ideal_pm_beta_1) && (this.handleIdealPayment = m), jn(this._betas, In.sepa_pm_beta_1) && (this.handleSepaDebitPayment = p, this.handleSepaDebitSetup = d) } }, { key: "_attachPrivateMethodsForCheckout", value: function(e) { var i = this;
                e && (this.sendInteractionEvent = Tn, this.tryNextAction = Ue(function(e, t) { var n = le(zi, e, "Payment Intent").value,
                        r = Object.keys(xi).map(function(e) { return xi[e] }),
                        o = le(z.apply(void 0, mc(r)), t, "Source type").value; return ("payment_intent" === n.object ? ja : Os)(i._controller, n, o, "auto", !1) })) } }, { key: "_attachCheckoutMethods", value: function(e) {
                function t() { return n._mids() } var n = this,
                    r = e.reduce(function(e, t) { var n = w(Ws, function(e) { return e === t }); return n ? [].concat(mc(e), [n]) : e }, []);
                this.redirectToCheckout = function(e) { return ac(n._controller, r, t, n._locale, e) } } }, { key: "_attachGetters", value: function() { var t = this,
                    i = new Zi(function(e) { t._registerWrapper({ name: e, version: null }) });
                ["elements", "createToken", "createSource", "createPaymentMethod"].forEach(function(r) { var o, e;
                    t.hasOwnProperty(r) && (o = t[r], e = function() { i.called(r); for (var e = arguments.length, t = Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return o.apply(this, t) }, Object.defineProperty(t, r, { enumerable: !0, get: function() { return i.got(r), e } })) }) } }, { key: "_attachIssuingCardMethods", value: function() { var e, n = this;
                this.retrieveIssuingCard = (e = "retrieveIssuingCard", function() { throw new S("You cannot call `stripe." + e + "` without supplying an Issuing beta flag when initializing Stripe.js.") }), jn(this._betas, In.issuing_elements_1) && (this.retrieveIssuingCard = Ue(function(e, t) { return js(e, t, n._controller) })) } }, { key: "_attachControllerGetter", value: function(t, n, r, o) { var i = this,
                    a = [],
                    s = document.readyState,
                    c = void 0;
                Object.defineProperties(this, { _registerWrapper: { enumerable: !1, configurable: !0, writable: !1, value: function(e) { a.push(e) } }, _controller: { enumerable: !0, configurable: !0, get: function() { if (c) return c; var e = document.readyState; return c = new rr(fc({ apiKey: i._apiKey, apiVersion: t, __privateApiUrl: n, stripeAccount: r, betas: i._betas, stripeJsId: Oc.stripeJsId, stripeJsLoadTimestamp: hc, stripeCreateTimestamp: o, onFirstLoad: function() { try { bc(c, s, e) } catch (e) {} }, listenerRegistry: i._listenerRegistry }, i._locale ? { locale: i._locale } : {})), Object.defineProperties(i, { _registerWrapper: { value: Ic, writable: !1, enumerable: !1, configurable: !0 }, _controller: { value: c, writable: !0, enumerable: !0, configurable: !0 } }), a.forEach(function(e) { return i._registerWrapper(e) }), a.splice(0), c } } }) } }, { key: "_ensureHTTPS", value: function() { var e = window.location.protocol,
                    t = -1 !== ["https:", "file:", "ionic:", "httpsionic:", "chrome-extension:", "moz-extension:"].indexOf(e),
                    n = -1 !== ["localhost", "127.0.0.1", "0.0.0.0"].indexOf(window.location.hostname),
                    r = this._keyMode === O.live,
                    o = "Live Stripe.js integrations must use HTTPS. For more information: https://stripe.com/docs/security/guide#tls"; if (!t) { if (r && !n) throw this._controller.report("user_error.non_https_error", { protocol: e }), new S(o);!r || n ? window.console && console.warn("You may test your Stripe.js integration over HTTP. However, live Stripe.js integrations must use HTTPS.") : window.console && console.warn(o) } } }, { key: "_ensureStripeHosted", value: function(e) { if (!e) throw this._controller.report("user_error.self_hosted"), new S("Stripe.js must be loaded from js.stripe.com. For more information https://stripe.com/docs/stripe-js/reference#including-stripejs") } }, { key: "_mids", value: function() { return Oc._ec ? Oc._ec.ids() : null } }]), Oc);

    function Oc(e, t) { var n = this;! function(e, t) { if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function") }(this, Oc), Tc.call(this); var r = new b,
            o = le(Pc, e || {}, "Stripe()"),
            i = o.value,
            a = o.warnings,
            s = i.apiKey,
            c = i.stripeAccount,
            u = i.apiVersion,
            l = i.locale,
            p = i.__privateApiUrl,
            d = i.__checkout,
            f = i.__hosted3DS,
            m = i.canCreateRadarSession,
            h = i.betas; if ("" === s) throw new S("Please call Stripe() with your publishable key. You used an empty string."); if (0 === s.indexOf("sk_")) throw new S("You should not use your secret key with Stripe.js.\n        Please pass a publishable key instead.");
        d && d.mids && (Oc._ec = On({ checkoutIds: d.mids })), this._apiKey = s.trim(), this._keyMode = A(this._apiKey), this._betas = h || [], this._locale = fr(l, this._betas) || null, this._stripeAccount = c || null, this._isCheckout = !!d, this._attachControllerGetter(u, p, c, r), a.forEach(function(e) { return n._controller.warn(e) }), this._ensureHTTPS(), this._ensureStripeHosted(t), this._attachPaymentIntentMethods(this._betas, !!f), this._attachLegacyPaymentIntentMethods(this._betas), this._attachCheckoutMethods(this._betas), this._attachPrivateMethodsForCheckout(this._isCheckout), this._attachCreateRadarSession(m || !1), this._attachGetters(), this._attachIssuingCardMethods(this._betas) }
    kc.version = 3, kc.stripeJsId = ie(), kc._ec = (Ec = new RegExp(document.location.protocol + "//" + document.location.host), "https://checkout.stripe.com/".match(Ec) ? null : On());

    function Ac(e, t) { return new Cc(jc({ apiKey: e }, t && "object" === (void 0 === t ? "undefined" : Rc(t)) ? t : {}), Nc) } var Tc = function() { var l = this;
            this._listenerRegistry = hn(), this.elements = je(function(e) { return new Pi(l._controller, l._listenerRegistry, { stripeJsLoadTimestamp: hc, stripeCreateTimestamp: l._controller._createTimestamp }, fc({}, l._locale ? { locale: l._locale } : {}, e, { betas: l._betas })) }), this.createToken = Ue(function(e, t) { var c, u, n = l._mids(); return "cvc_update" === e ? function(e, t, n) { var r = gi(t); if (r && "cardCvc" === r._componentName) { var o = r._implementation._frame.id; return e.action.tokenizeCvcUpdate({ frameId: o, mids: n }).then(sc) } throw new S("You must provide a `cardCvc` Element to create a `cvc_update` token.") }(l._controller, t, n) : (c = l._controller, u = n, function(e, t) { var n = gi(e); if (n) { var r = n._implementation._frame.id,
                            o = n._componentName,
                            i = cc(t); return c.action.tokenizeWithElement({ frameId: r, elementName: o, tokenData: i, mids: u }).then(sc) } if ("string" != typeof e) throw new S("You must provide a Stripe Element or a valid token type to create a Token."); var a = e,
                        s = cc(t); return c.action.tokenizeWithData({ elementName: null, type: a, tokenData: s, mids: u }).then(sc) }(e, t)) }), this.createSource = Ue(function(e, t) { var n = gi(e),
                    r = ta(n ? t : e),
                    o = r || { type: null, data: {} },
                    i = o.type,
                    a = o.data; if (n) { var s = n._implementation._frame.id,
                        c = n._componentName; return !r && Ii(c) ? E.reject(new S("Please provide Source creation parameters to createSource.")) : l._controller.action.createSourceWithElement({ frameId: s, elementName: c, type: i, sourceData: a, mids: l._mids() }).then(na) } return r ? i ? l._controller.action.createSourceWithData({ elementName: null, type: i, sourceData: a, mids: l._mids() }).then(na) : E.reject(new S("Please provide a source type to createSource.")) : E.reject(new S("Please provide either an Element or Source creation parameters to createSource.")) }), this.retrieveSource = je(function(e) { var t = le(va, { source: e }, "retrieveSource"),
                    n = t.value; return t.warnings.forEach(function(e) { return l._controller.warn(e) }), l._controller.action.retrieveSource(n).then(na) }), this.paymentRequest = Ue(function(e, t) {! function(e) { if (e === O.unknown) throw new S("It looks like you're using an older Stripe key. In order to use this API, you'll need to use a modern API key, which is prefixed with 'pk_live_' or 'pk_test_'.\n    You can roll your publishable key here: https://dashboard.stripe.com/account/apikeys") }(l._keyMode); var n = l._isCheckout && t ? t : null; return ki(l._controller, { apiKey: l._apiKey, accountId: l._stripeAccount }, l._mids(), e, l._betas, n, l._listenerRegistry) }) },
        Ic = function(e) { var t, n, r, o, i = re(Vi, e, "WrapperLibrary"); "error" !== i.type ? (n = (t = i.value).name, r = t.version, o = t.startTime, this._controller.registerWrapper({ name: n, version: r, startTime: o })) : this._controller.report("register_wrapper.error", { error: i.error.message }) },
        Cc = kc,
        Rc = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) { return typeof e } : function(e) { return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e },
        jc = Object.assign || function(e) { for (var t = 1; t < arguments.length; t++) { var n, r = arguments[t]; for (n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n]) } return e },
        Nc = function() { if (document.currentScript) { var e = k(document.currentScript.src); return !e || Xt(e.origin) } return !0 }();
    Ac.version = Cc.version, window.Stripe && 2 === window.Stripe.version && !window.Stripe.StripeV3 ? window.Stripe.StripeV3 = Ac : window.Stripe ? window.console && console.warn("It looks like Stripe.js was loaded more than one time. Please only load it once per page.") : window.Stripe = Ac;
    t.default = Ac }]);