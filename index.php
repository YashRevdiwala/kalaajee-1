<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <!-- Added by AVADA SEO Suite -->

    <script>
      window.FPConfig = {};
      window.FPConfig.ignoreKeywords = ["/cart", "/account"];
    </script>

    <script>
      const lightJsExclude = [];
    </script>

    <script>
      class LightJsLoader {
        constructor(e) {
          (this.jQs = []),
            (this.listener = this.handleListener.bind(this, e)),
            (this.scripts = ["default", "defer", "async"].reduce(
              (e, t) => ({ ...e, [t]: [] }),
              {}
            ));
          const t = this;
          e.forEach((e) =>
            window.addEventListener(e, t.listener, { passive: !0 })
          );
        }
        handleListener(e) {
          const t = this;
          return (
            e.forEach((e) => window.removeEventListener(e, t.listener)),
            "complete" === document.readyState
              ? this.handleDOM()
              : document.addEventListener("readystatechange", (e) => {
                  if ("complete" === e.target.readyState)
                    return setTimeout(t.handleDOM.bind(t), 1);
                })
          );
        }
        async handleDOM() {
          this.suspendEvent(),
            this.suspendJQuery(),
            this.findScripts(),
            this.preloadScripts();
          for (const e of Object.keys(this.scripts))
            await this.replaceScripts(this.scripts[e]);
          for (const e of ["DOMContentLoaded", "readystatechange"])
            await this.requestRepaint(),
              document.dispatchEvent(new Event("lightJS-" + e));
          document.lightJSonreadystatechange &&
            document.lightJSonreadystatechange();
          for (const e of ["DOMContentLoaded", "load"])
            await this.requestRepaint(),
              window.dispatchEvent(new Event("lightJS-" + e));
          await this.requestRepaint(),
            window.lightJSonload && window.lightJSonload(),
            await this.requestRepaint(),
            this.jQs.forEach((e) => e(window).trigger("lightJS-jquery-load")),
            window.dispatchEvent(new Event("lightJS-pageshow")),
            await this.requestRepaint(),
            window.lightJSonpageshow && window.lightJSonpageshow();
        }
        async requestRepaint() {
          return new Promise((e) => requestAnimationFrame(e));
        }
        findScripts() {
          document.querySelectorAll("script[type=lightJs]").forEach((e) => {
            e.hasAttribute("src")
              ? e.hasAttribute("async") && e.async
                ? this.scripts.async.push(e)
                : e.hasAttribute("defer") && e.defer
                ? this.scripts.defer.push(e)
                : this.scripts.default.push(e)
              : this.scripts.default.push(e);
          });
        }
        preloadScripts() {
          const e = this,
            t = Object.keys(this.scripts).reduce(
              (t, n) => [...t, ...e.scripts[n]],
              []
            ),
            n = document.createDocumentFragment();
          t.forEach((e) => {
            const t = e.getAttribute("src");
            if (!t) return;
            const s = document.createElement("link");
            (s.href = t),
              (s.rel = "preload"),
              (s.as = "script"),
              n.appendChild(s);
          }),
            document.head.appendChild(n);
        }
        async replaceScripts(e) {
          let t;
          for (; (t = e.shift()); )
            await this.requestRepaint(),
              new Promise((e) => {
                const n = document.createElement("script");
                [...t.attributes].forEach((e) => {
                  "type" !== e.nodeName &&
                    n.setAttribute(e.nodeName, e.nodeValue);
                }),
                  t.hasAttribute("src")
                    ? (n.addEventListener("load", e),
                      n.addEventListener("error", e))
                    : ((n.text = t.text), e()),
                  t.parentNode.replaceChild(n, t);
              });
        }
        suspendEvent() {
          const e = {};
          [
            { obj: document, name: "DOMContentLoaded" },
            { obj: window, name: "DOMContentLoaded" },
            { obj: window, name: "load" },
            { obj: window, name: "pageshow" },
            { obj: document, name: "readystatechange" },
          ].map((t) =>
            (function (t, n) {
              function s(n) {
                return e[t].list.indexOf(n) >= 0 ? "lightJS-" + n : n;
              }
              e[t] ||
                ((e[t] = {
                  list: [n],
                  add: t.addEventListener,
                  remove: t.removeEventListener,
                }),
                (t.addEventListener = (...n) => {
                  (n[0] = s(n[0])), e[t].add.apply(t, n);
                }),
                (t.removeEventListener = (...n) => {
                  (n[0] = s(n[0])), e[t].remove.apply(t, n);
                }));
            })(t.obj, t.name)
          ),
            [
              { obj: document, name: "onreadystatechange" },
              { obj: window, name: "onpageshow" },
            ].map((e) =>
              (function (e, t) {
                let n = e[t];
                Object.defineProperty(e, t, {
                  get: () => n || function () {},
                  set: (s) => {
                    e["lightJS" + t] = n = s;
                  },
                });
              })(e.obj, e.name)
            );
        }
        suspendJQuery() {
          const e = this;
          let t = window.jQuery;
          Object.defineProperty(window, "jQuery", {
            get: () => t,
            set(n) {
              if (!n || !n.fn || !e.jQs.includes(n)) return void (t = n);
              n.fn.ready = n.fn.init.prototype.ready = (e) => {
                e.bind(document)(n);
              };
              const s = n.fn.on;
              (n.fn.on = n.fn.init.prototype.on =
                function (...e) {
                  if (window !== this[0]) return s.apply(this, e), this;
                  const t = (e) =>
                    e
                      .split(" ")
                      .map((e) =>
                        "load" === e || 0 === e.indexOf("load.")
                          ? "lightJS-jquery-load"
                          : e
                      )
                      .join(" ");
                  return "string" == typeof e[0] || e[0] instanceof String
                    ? ((e[0] = t(e[0])), s.apply(this, e), this)
                    : ("object" == typeof e[0] &&
                        Object.keys(e[0]).forEach((n) => {
                          delete Object.assign(e[0], { [t(n)]: e[0][n] })[n];
                        }),
                      s.apply(this, e),
                      this);
                }),
                e.jQs.push(n),
                (t = n);
            },
          });
        }
      }
      new LightJsLoader([
        "keydown",
        "mousemove",
        "touchend",
        "touchmove",
        "touchstart",
        "wheel",
      ]);
    </script>

    <!-- /Added by AVADA SEO Suite -->
    <script>
      window.KiwiSizing =
        window.KiwiSizing === undefined ? {} : window.KiwiSizing;
      KiwiSizing.shop = "peachm.myshopify.com";
    </script>
    <script type="text/javascript">
      var __wzrk_account_id = "44K-Z6K-6Z5Z";
      var __wzrk_region = "";
      var __wzrk_version = 2;
      var __wzrk_web_push_enabled = true;
      var __wzrk_webhook_enabled = "true";
      var __wzrk_variables =
        "shop_url,shop_domain,shop_email,shop_money_format,product_json,product_title,product_price,cart_json,cart_item_count,cart_total_price";
      var __wzrk_shop_url = "https://peachmode.com";
      var __wzrk_shop_domain = "peachmode.com";
      var __wzrk_shop_email = "contact@peachmode.com";
      var __wzrk_shop_money_format = '<span class="money">₹{{amount}}</span>';
      var __wzrk_shop_name = "Peachmode";
      var __wzrk_charged_currency = "INR";
      var __wzrk_customer_name = "";
      var __wzrk_customer_identity = "";
      var __wzrk_customer_email = "";
      var __wzrk_customer_phone = "";

      window.clevertapApp = {
        config: {
          currency: "INR",
          meta: {
            title:
              "Women Clothing-Buy Designer Ethnic Wear, Ethnic Suits, Bottoms Online",
            template: "index",
            url: "https://peachmode.com/",
            type: "index",
          },
          routes: {
            customer: {
              account: "/account",
              login: "/account/login",
              logout: "/account/logout",
              register: "/account/register",
            },
            cart: {
              list: "/cart",
              add: "/cart/add",
              clear: "/cart/clear",
              update: "/cart/change",
              change: "/cart/change",
            },
          },
        },
      };

      clevertapApp.frame = {
        hide: function () {
          window.document.body.style.overflow = "unset";
          window.document.getElementById("clevertap-frame").style.display =
            "none";
        },
      };
      if (localStorage) {
        localStorage.setItem(
          "WZRK_SHOP_INFO",
          '{ "acct_id" : "44K-Z6K-6Z5Z" , "region" : "" , "webPushEnabled" : true , "webhookEnabled" : true}'
        );
      }
    </script>
    <style>
      #clevertap-frame {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        min-width: 100vw;
      }
    </style>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, maximum-scale=1.0"
    />
    <meta name="theme-color" content="#ffffff" />

    <title>
      Women Clothing-Buy Designer Ethnic Wear, Ethnic Suits, Bottoms Online
    </title>
    <meta
      name="description"
      content="Peachmode is your one stop online shopping destination for designer ethnic wear. Browse through our handpicked designs of sarees, anarkalis, lehengas, kurtis, etc at best price."
    />
    <link rel="canonical" href="https://peachmode.com/" />
    <link rel="shortcut icon" href="img/1.png" />
    <link rel="preconnect" href="https://cdn.shopify.com" />
    <link rel="dns-prefetch" href="https://productreviews.shopifycdn.com" />
    <link rel="dns-prefetch" href="https://www.google-analytics.com" />
    <link rel="preconnect" href="https://fonts.shopifycdn.com" crossorigin />
    <link
      rel="preload"
      as="style"
      href="//cdn.shopify.com/s/files/1/0637/4834/1981/t/4/assets/theme.aio.min.css?v=41317135448036212481669276710"
    />
    <link
      rel="preload"
      as="script"
      href="//cdn.shopify.com/s/files/1/0637/4834/1981/t/4/assets/vendor.aio.min.js?v=150683728779720575551669276710"
    />
    <link
      rel="preload"
      as="script"
      href="//cdn.shopify.com/s/files/1/0637/4834/1981/t/4/assets/theme.aio.min.js?v=67881326845666540201669276710"
    />
    <script>
      // Google Tag Manager
      window.dataLayer = window.dataLayer || [];
    </script>

    <meta property="og:type" content="website" />
    <meta
      property="og:title"
      content="Women Clothing-Buy Designer Ethnic Wear, Ethnic Suits, Bottoms Online"
    />
    <meta
      property="og:image"
      content="http://cdn.shopify.com/s/files/1/0637/4834/1981/files/Peachmode_Logo.png?v=1649671323"
    />
    <meta
      property="og:image:secure_url"
      content="https://cdn.shopify.com/s/files/1/0637/4834/1981/files/Peachmode_Logo.png?v=1649671323"
    />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="628" />
    <meta
      property="og:description"
      content="Peachmode is your one stop online shopping destination for designer ethnic wear. Browse through our handpicked designs of sarees, anarkalis, lehengas, kurtis, etc at best price."
    />
    <meta property="og:url" content="https://peachmode.com/" />
    <meta property="og:site_name" content="Peachmode" />
    <meta name="twitter:card" content="summary" />
    <meta
      name="twitter:title"
      content="Women Clothing-Buy Designer Ethnic Wear, Ethnic Suits, Bottoms Online"
    />
    <meta
      name="twitter:description"
      content="Peachmode is your one stop online shopping destination for designer ethnic wear. Browse through our handpicked designs of sarees, anarkalis, lehengas, kurtis, etc at best price."
    />
    <meta
      name="twitter:image"
      content="https://cdn.shopify.com/s/files/1/0637/4834/1981/files/Peachmode_Logo_1200x1200_crop_center.png?v=1649671323"
    />
    <meta name="twitter:image:alt" content="peachmode.com" />

    <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
          {
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "https://peachmode.com"
          }
        ]
      }
    </script>

    <link
      rel="preload"
      href="https://fonts.shopifycdn.com/itc_caslon_no_224/itccaslonno224_n4.bcb2bf5af4b45921434d7417dc9de15d5a1006f6.woff2?h1=cGVhY2htb2RlLmNvbQ&h2=cGVhY2htLmFjY291bnQubXlzaG9waWZ5LmNvbQ&hmac=ccfeacb3060731732f311df105728be4bde3249bc094c9c02aaffeef765a9902"
      as="font"
      type="font/woff2"
      crossorigin
    />
    <link
      rel="preload"
      href="https://fonts.shopifycdn.com/avenir_next/avenirnext_n4.7fd0287595be20cd5a683102bf49d073b6abf144.woff2?h1=cGVhY2htb2RlLmNvbQ&h2=cGVhY2htLmFjY291bnQubXlzaG9waWZ5LmNvbQ&hmac=203a94c54a698cfd1007aac09fc0ef1564055aab89d03a430e277d7242277594"
      as="font"
      type="font/woff2"
      crossorigin
    />
    <style>
      /* Typography (heading) */
      @font-face {
        font-family: "ITC Caslon No 224";
        font-weight: 400;
        font-style: normal;
        font-display: swap;
        src: url("https://fonts.shopifycdn.com/itc_caslon_no_224/itccaslonno224_n4.bcb2bf5af4b45921434d7417dc9de15d5a1006f6.woff2?h1=cGVhY2htb2RlLmNvbQ&h2=cGVhY2htLmFjY291bnQubXlzaG9waWZ5LmNvbQ&hmac=ccfeacb3060731732f311df105728be4bde3249bc094c9c02aaffeef765a9902")
            format("woff2"),
          url("https://fonts.shopifycdn.com/itc_caslon_no_224/itccaslonno224_n4.405c142f0c9dca6af62eb394674784c2506ee02b.woff?h1=cGVhY2htb2RlLmNvbQ&h2=cGVhY2htLmFjY291bnQubXlzaG9waWZ5LmNvbQ&hmac=ab8db8a826fe3df3e007d943868d9411e149c73191ccdd9430a77fc35578d8d5")
            format("woff");
      }

      @font-face {
        font-family: "ITC Caslon No 224";
        font-weight: 400;
        font-style: italic;
        font-display: swap;
        src: url("https://fonts.shopifycdn.com/itc_caslon_no_224/itccaslonno224_i4.494d3b7e3dbb60dbc0e7c3ba158d53fa0b309bf1.woff2?h1=cGVhY2htb2RlLmNvbQ&h2=cGVhY2htLmFjY291bnQubXlzaG9waWZ5LmNvbQ&hmac=e5867e4c316ac410c185b2a159b32410fa72b0ac0b889831a67a8377c4152445")
            format("woff2"),
          url("https://fonts.shopifycdn.com/itc_caslon_no_224/itccaslonno224_i4.ab9256e1db8cfa6fae1765c06ac14b9d7ba299a1.woff?h1=cGVhY2htb2RlLmNvbQ&h2=cGVhY2htLmFjY291bnQubXlzaG9waWZ5LmNvbQ&hmac=ac1fe0d4f6f01d38b0eae6a03ab58e191d6f237628ebeb4eb4b33289a4476be8")
            format("woff");
      }

      /* Typography (body) */
      @font-face {
        font-family: "Avenir Next";
        font-weight: 400;
        font-style: normal;
        font-display: swap;
        src: url("https://fonts.shopifycdn.com/avenir_next/avenirnext_n4.7fd0287595be20cd5a683102bf49d073b6abf144.woff2?h1=cGVhY2htb2RlLmNvbQ&h2=cGVhY2htLmFjY291bnQubXlzaG9waWZ5LmNvbQ&hmac=203a94c54a698cfd1007aac09fc0ef1564055aab89d03a430e277d7242277594")
            format("woff2"),
          url("https://fonts.shopifycdn.com/avenir_next/avenirnext_n4.a26a334a0852627a5f36b195112385b0cd700077.woff?h1=cGVhY2htb2RlLmNvbQ&h2=cGVhY2htLmFjY291bnQubXlzaG9waWZ5LmNvbQ&hmac=7e0993e2c3c4353677bf8c982d450d5918894dd4123397e51e93d1c1ebc7abff")
            format("woff");
      }

      @font-face {
        font-family: "Avenir Next";
        font-weight: 400;
        font-style: italic;
        font-display: swap;
        src: url("https://fonts.shopifycdn.com/avenir_next/avenirnext_i4.f1583d9f457b68e44fbda187a48b4096d547d7f4.woff2?h1=cGVhY2htb2RlLmNvbQ&h2=cGVhY2htLmFjY291bnQubXlzaG9waWZ5LmNvbQ&hmac=025e85c77ec787bced3183150d4c7dfc4de058a68990b653ab2dc2660a972e6a")
            format("woff2"),
          url("https://fonts.shopifycdn.com/avenir_next/avenirnext_i4.67fb53a3e0351125941146246183577ae8d8bf23.woff?h1=cGVhY2htb2RlLmNvbQ&h2=cGVhY2htLmFjY291bnQubXlzaG9waWZ5LmNvbQ&hmac=8ee98c774ccf74c8f390fcc98273e3d31a6cb6dd275f9d5b60abf69fe0556f94")
            format("woff");
      }

      @font-face {
        font-family: "Avenir Next";
        font-weight: 600;
        font-style: normal;
        font-display: swap;
        src: url("https://fonts.shopifycdn.com/avenir_next/avenirnext_n6.08f6a09127d450aa39c74986de08fd8fa84e6a11.woff2?h1=cGVhY2htb2RlLmNvbQ&h2=cGVhY2htLmFjY291bnQubXlzaG9waWZ5LmNvbQ&hmac=87d62ef22b4eed0181d72e00c6f172b1e9ce66a15d197f8055000624ab16cef2")
            format("woff2"),
          url("https://fonts.shopifycdn.com/avenir_next/avenirnext_n6.bd2f76897d6f40c767db7c40226916ec7b6ffc65.woff?h1=cGVhY2htb2RlLmNvbQ&h2=cGVhY2htLmFjY291bnQubXlzaG9waWZ5LmNvbQ&hmac=6aaf392f5466f46410cfd7232cf2af9e48d6c9a64551648e1cd17819a022e79d")
            format("woff");
      }

      @font-face {
        font-family: "Avenir Next";
        font-weight: 600;
        font-style: italic;
        font-display: swap;
        src: url("https://fonts.shopifycdn.com/avenir_next/avenirnext_i6.449b8593f8987f1402fdf6d634f972f810c90c5c.woff2?h1=cGVhY2htb2RlLmNvbQ&h2=cGVhY2htLmFjY291bnQubXlzaG9waWZ5LmNvbQ&hmac=85940460570496b53db9fdafa6b6151a3cbdda4f36bec8e00093bc8db9e04136")
            format("woff2"),
          url("https://fonts.shopifycdn.com/avenir_next/avenirnext_i6.9c697a2eda486add54c668d1ec4ac662c8402e7c.woff?h1=cGVhY2htb2RlLmNvbQ&h2=cGVhY2htLmFjY291bnQubXlzaG9waWZ5LmNvbQ&hmac=cf01f88598cdc1fae92f37862322d0775181048d7e1fff0315a4db648fcbbb95")
            format("woff");
      }

      :root {
        --heading-color: 26, 26, 26;
        --text-color: 34, 34, 34;
        --background: 255, 255, 255;
        --secondary-background: 245, 241, 236;
        --border-color: 222, 222, 222;
        --border-color-darker: 167, 167, 167;
        --success-color: 46, 158, 123;
        --success-background: 213, 236, 229;
        --error-color: 222, 42, 42;
        --error-background: 253, 240, 240;
        --primary-button-background: 241, 63, 98;
        --primary-button-text-color: 255, 255, 255;
        --secondary-button-background: 247, 174, 166;
        --secondary-button-text-color: 255, 255, 255;
        --product-star-rating: 246, 164, 41;
        --product-on-sale-accent: 238, 61, 99;
        --product-sold-out-accent: 111, 113, 155;
        --product-custom-label-background: 64, 93, 230;
        --product-custom-label-text-color: 255, 255, 255;
        --product-custom-label-2-background: 243, 229, 182;
        --product-custom-label-2-text-color: 0, 0, 0;
        --product-low-stock-text-color: 222, 42, 42;
        --product-in-stock-text-color: 46, 158, 123;
        --loading-bar-background: 34, 34, 34;

        /* We duplicate some "base" colors as root colors, which is useful to use on drawer elements or popover without. Those should not be overridden to avoid issues */
        --root-heading-color: 26, 26, 26;
        --root-text-color: 34, 34, 34;
        --root-background: 255, 255, 255;
        --root-border-color: 222, 222, 222;
        --root-primary-button-background: 241, 63, 98;
        --root-primary-button-text-color: 255, 255, 255;

        --base-font-size: 15px;
        --heading-font-family: "ITC Caslon No 224", serif;
        --heading-font-weight: 400;
        --heading-font-style: normal;
        --heading-text-transform: normal;
        --text-font-family: "Avenir Next", sans-serif;
        --text-font-weight: 400;
        --text-font-style: normal;
        --text-font-bold-weight: 600;

        /* Typography (font size) */
        --heading-xxsmall-font-size: 11px;
        --heading-xsmall-font-size: 11px;
        --heading-small-font-size: 12px;
        --heading-large-font-size: 36px;
        --heading-h1-font-size: 36px;
        --heading-h2-font-size: 30px;
        --heading-h3-font-size: 26px;
        --heading-h4-font-size: 24px;
        --heading-h5-font-size: 20px;
        --heading-h6-font-size: 16px;

        /* Control the look and feel of the theme by changing radius of various elements */
        --button-border-radius: 4px;
        --block-border-radius: 8px;
        --block-border-radius-reduced: 4px;
        --color-swatch-border-radius: 100%;

        /* Button size */
        --button-height: 48px;
        --button-small-height: 40px;

        /* Form related */
        --form-input-field-height: 48px;
        --form-input-gap: 16px;
        --form-submit-margin: 24px;

        /* Product listing related variables */
        --product-list-block-spacing: 32px;

        /* Video related */
        --play-button-background: 255, 255, 255;
        --play-button-arrow: 34, 34, 34;

        /* RTL support */
        --transform-logical-flip: 1;
        --transform-origin-start: left;
        --transform-origin-end: right;

        /* Other */
        --zoom-cursor-svg-url: url(//cdn.shopify.com/s/files/1/0637/4834/1981/t/4/assets/zoom-cursor.svg?v=168007976863815382111650260039);
        --arrow-right-svg-url: url(//cdn.shopify.com/s/files/1/0637/4834/1981/t/4/assets/arrow-right.svg?v=2151866357717726961650260039);
        --arrow-left-svg-url: url(//cdn.shopify.com/s/files/1/0637/4834/1981/t/4/assets/arrow-left.svg?v=28017100529542663401650260039);

        /* Some useful variables that we can reuse in our CSS. Some explanation are needed for some of them:
       - container-max-width-minus-gutters: represents the container max width without the edge gutters
       - container-outer-width: considering the screen width, represent all the space outside the container
       - container-outer-margin: same as container-outer-width but get set to 0 inside a container
       - container-inner-width: the effective space inside the container (minus gutters)
       - grid-column-width: represents the width of a single column of the grid
       - vertical-breather: this is a variable that defines the global "spacing" between sections, and inside the section
                            to create some "breath" and minimum spacing
     */
        --container-max-width: 1600px;
        --container-gutter: 24px;
        --container-max-width-minus-gutters: calc(
          var(--container-max-width) - (var(--container-gutter)) * 2
        );
        --container-outer-width: max(
          calc((100vw - var(--container-max-width-minus-gutters)) / 2),
          var(--container-gutter)
        );
        --container-outer-margin: var(--container-outer-width);
        --container-inner-width: calc(100vw - var(--container-outer-width) * 2);

        --grid-column-count: 10;
        --grid-gap: 24px;
        --grid-column-width: calc(
          (
              100vw - var(--container-outer-width) * 2 - var(--grid-gap) *
                (var(--grid-column-count) - 1)
            ) / var(--grid-column-count)
        );

        --vertical-breather: 28px;
        --vertical-breather-tight: 28px;

        /* Shopify related variables */
        --payment-terms-background-color: #ffffff;
      }

      @media screen and (min-width: 741px) {
        :root {
          --container-gutter: 40px;
          --grid-column-count: 20;
          --vertical-breather: 40px;
          --vertical-breather-tight: 40px;

          /* Typography (font size) */
          --heading-xsmall-font-size: 12px;
          --heading-small-font-size: 13px;
          --heading-large-font-size: 52px;
          --heading-h1-font-size: 48px;
          --heading-h2-font-size: 38px;
          --heading-h3-font-size: 32px;
          --heading-h4-font-size: 24px;
          --heading-h5-font-size: 20px;
          --heading-h6-font-size: 18px;

          /* Form related */
          --form-input-field-height: 52px;
          --form-submit-margin: 32px;

          /* Button size */
          --button-height: 52px;
          --button-small-height: 44px;
        }
      }

      @media screen and (min-width: 1200px) {
        :root {
          --vertical-breather: 48px;
          --vertical-breather-tight: 48px;
          --product-list-block-spacing: 5px;

          /* Typography */
          --heading-large-font-size: 64px;
          --heading-h1-font-size: 56px;
          --heading-h2-font-size: 48px;
          --heading-h3-font-size: 36px;
          --heading-h4-font-size: 30px;
          --heading-h5-font-size: 24px;
          --heading-h6-font-size: 18px;
        }
      }

      @media screen and (min-width: 1600px) {
        :root {
          --vertical-breather: 48px;
          --vertical-breather-tight: 48px;
        }
      }
      @media screen and (max-width: 740px) {
        :root {
          --container-gutter: 15px;
        }
      }
    </style>
    <script>
      // This allows to expose several variables to the global scope, to be used in scripts
      window.themeVariables = {
        settings: {
          direction: "ltr",
          pageType: "index",
          cartCount: 0,
          moneyFormat:
            '\u003cspan class="money"\u003e₹{{amount}}\u003c\/span\u003e',
          moneyWithCurrencyFormat:
            '\u003cspan class="money"\u003e₹{{amount}}\u003c\/span\u003e',
          showVendor: false,
          discountMode: "percentage",
          currencyCodeEnabled: false,
          searchMode: "product",
          searchUnavailableProducts: "last",
          cartType: "drawer",
          cartCurrency: "INR",
          mobileZoomFactor: 2.5,
        },

        routes: {
          host: "peachmode.com",
          rootUrl: "\/",
          rootUrlWithoutSlash: "",
          cartUrl: "\/cart",
          cartAddUrl: "\/cart\/add",
          cartChangeUrl: "\/cart\/change",
          searchUrl: "\/search",
          predictiveSearchUrl: "\/search\/suggest",
          productRecommendationsUrl: "\/recommendations\/products",
        },

        strings: {
          accessibilityDelete: "Delete",
          accessibilityClose: "Close",
          collectionSoldOut: "Sold out",
          collectionDiscount: "Save @savings@",
          productSalePrice: "Sale price",
          productRegularPrice: "Regular price",
          productFormUnavailable: "Unavailable",
          productFormSoldOut: "Sold out",
          productFormPreOrder: "Pre-order",
          productFormAddToCart: "Add to cart",
          searchNoResults: "No results could be found.",
          searchNewSearch: "New search",
          searchProducts: "Products",
          searchArticles: "Journal",
          searchPages: "Pages",
          searchCollections: "Collections",
          cartViewCart: "View cart",
          cartItemAdded: "Item added to your cart!",
          cartItemAddedShort: "Added to your cart!",
          cartAddOrderNote: "Add order note",
          cartEditOrderNote: "Edit order note",
          shippingEstimatorNoResults: "Sorry, we do not ship to your address.",
          shippingEstimatorOneResult:
            "There is one shipping rate for your address:",
          shippingEstimatorMultipleResults:
            "There are several shipping rates for your address:",
          shippingEstimatorError:
            "One or more error occurred while retrieving shipping rates:",
        },

        libs: {
          flickity:
            "\/\/cdn.shopify.com\/s\/files\/1\/0637\/4834\/1981\/t\/4\/assets\/flickity.aio.min.js?v=52974065055626885651669276710",
          photoswipe:
            "\/\/cdn.shopify.com\/s\/files\/1\/0637\/4834\/1981\/t\/4\/assets\/photoswipe.aio.min.js?v=131347994699802193951669276710",
          qrCode:
            "\/\/cdn.shopify.com\/shopifycloud\/shopify\/assets\/themes_support\/vendor\/qrcode-ea937aa4cd73ad2566540626d466019ba1e2e0c445711833fb8918ad7589ecf2.js",
        },

        breakpoints: {
          phone: "screen and (max-width: 740px)",
          tablet: "screen and (min-width: 741px) and (max-width: 999px)",
          tabletAndUp: "screen and (min-width: 741px)",
          pocket: "screen and (max-width: 999px)",
          lap: "screen and (min-width: 1000px) and (max-width: 1199px)",
          lapAndUp: "screen and (min-width: 1000px)",
          desktop: "screen and (min-width: 1200px)",
          wide: "screen and (min-width: 1400px)",
        },
      };

      window.addEventListener("pageshow", async () => {
        const cartContent = await (
          await fetch(`${window.themeVariables.routes.cartUrl}.js`, {
            cache: "reload",
          })
        ).json();
        document.documentElement.dispatchEvent(
          new CustomEvent("cart:refresh", { detail: { cart: cartContent } })
        );
      });

      if ("noModule" in HTMLScriptElement.prototype) {
        // Old browsers (like IE) that does not support module will be considered as if not executing JS at all
        document.documentElement.className =
          document.documentElement.className.replace("no-js", "js");

        requestAnimationFrame(() => {
          const viewportHeight = window.visualViewport
            ? window.visualViewport.height
            : document.documentElement.clientHeight;
          document.documentElement.style.setProperty(
            "--window-height",
            viewportHeight + "px"
          );
        });
      }
    </script>

    <link
      rel="stylesheet"
      href="//cdn.shopify.com/s/files/1/0637/4834/1981/t/4/assets/theme.css?v=179782170850921857211660968963"
    />
    <link
      rel="stylesheet"
      href="//cdn.shopify.com/s/files/1/0637/4834/1981/t/4/assets/custom.aio.min.css?v=13877014798859137141669276710"
    />

    <script
      src="//cdn.shopify.com/s/files/1/0637/4834/1981/t/4/assets/vendor.js?v=31715688253868339281649670564"
      defer
    ></script>
    <script
      src="//cdn.shopify.com/s/files/1/0637/4834/1981/t/4/assets/theme.js?v=176847002945199770411657523293"
      defer
    ></script>
    <script
      src="//cdn.shopify.com/s/files/1/0637/4834/1981/t/4/assets/custom.aio.min.js?v=41133906798395419041669276710"
      defer
    ></script>

    <img
      alt="website"
      width="99999"
      height="99999"
      style="
        pointer-events: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 99vw;
        height: 99vh;
        max-width: 99vw;
        max-height: 99vh;
      "
      src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI5OTk5OSIgaGVpZ2h0PSI5OTk5OSIgdmlld0JveD0iMCAwIDk5OTk5IDk5OTk5IiAvPg=="
    />
    <script>
      window.performance &&
        window.performance.mark &&
        window.performance.mark("shopify.content_for_header.start");
    </script>
    <meta
      id="shopify-digital-wallet"
      name="shopify-digital-wallet"
      content="/63748341981/digital_wallets/dialog"
    />
    <meta
      id="in-context-paypal-metadata"
      data-shop-id="63748341981"
      data-venmo-supported="false"
      data-environment="production"
      data-locale="en_US"
      data-paypal-v4="true"
      data-currency="INR"
    />
    <script>
      (function () {
        var scripts = [
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/runtime.latest.en.96fe0b7abf48419e7469.js",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/checkout-web-packages-packages_checkout-react-html_src_hooks_title_ts.latest.en.3457953d3abd1b694aa5.js",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/vendors-node_modules_shopify_verdict_build_esm_runtimes_browser_index_mts_js.latest.en.f6f2083a5fb187836a1f.js",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/app_components_AddressForm_AddressForm_tsx-app_components_Step_Step_tsx-app_utilities_receipt-224401.latest.en.91b3bf74b8a9635d2c0a.js",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/Information.latest.en.94b7d1c1c7ab40c6eac2.js",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/checkout-web-ui-packages_checkout-web-ui_src_styles_global_css_ts-packages_checkout-web-ui_sr-da3b38.latest.en.d63d03b3b69c11f9e6aa.js",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/vendors-node_modules_bugsnag_js_browser_notifier_js-node_modules_vanilla-extract_sprinkles_cr-077d89.latest.en.0ca662c669b41a356f6a.js",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/checkout-web-packages-packages_card-fields-react_src_hook_ts-packages_checkout-graphql_src_in-92a386.latest.en.b39452fcc8039fc140d1.js",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/app.latest.en.aaa897dd9c534f7f99ac.js",
        ];
        var styles = [
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/checkout-web-ui-packages_checkout-web-ui_src_styles_global_css_ts-packages_checkout-web-ui_sr-da3b38.latest.en.5196d587d3de2d2fbc8a.css",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/vendors-node_modules_bugsnag_js_browser_notifier_js-node_modules_vanilla-extract_sprinkles_cr-077d89.latest.en.4e93eb2ccac793a61d40.css",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/app.latest.en.90bde523bde67a4067f2.css",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/Information.latest.en.f987e50a37d7171c2810.css",
        ];

        function prefetch(url, as, callback) {
          var link = document.createElement("link");
          if (link.relList.supports("prefetch")) {
            link.rel = "prefetch";
            link.fetchPriority = "low";
            link.as = as;
            link.href = url;
            link.onload = link.onerror = callback;
            document.head.appendChild(link);
          } else {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", url, true);
            xhr.onloadend = callback;
            xhr.send();
          }
        }

        function prefetchAssets() {
          var resources = [].concat(
            scripts.map(function (url) {
              return [url, "script"];
            }),
            styles.map(function (url) {
              return [url, "style"];
            })
          );
          var index = 0;
          (function next() {
            var res = resources[index++];
            if (res) prefetch(res[0], res[1], next);
          })();
        }

        addEventListener("load", prefetchAssets);
      })();
    </script>
    <script id="shopify-features" type="application/json">
      {
        "accessToken": "624de472c678fb3b99635fb7da9e76fb",
        "betas": ["rich-media-storefront-analytics"],
        "domain": "peachmode.com",
        "predictiveSearch": true,
        "shopId": 63748341981,
        "smart_payment_buttons_url": "https:\/\/cdn.shopify.com\/shopifycloud\/payment-sheet\/assets\/latest\/spb.en.js?v=2",
        "dynamic_checkout_cart_url": "https:\/\/cdn.shopify.com\/shopifycloud\/payment-sheet\/assets\/latest\/dynamic-checkout-cart.en.js?v=2",
        "locale": "en",
        "optimusEnabled": false
      }
    </script>
    <script>
      var Shopify = Shopify || {};
      Shopify.shop = "peachm.myshopify.com";
      Shopify.locale = "en";
      Shopify.currency = { active: "INR", rate: "1.0" };
      Shopify.country = "IN";
      Shopify.theme = {
        name: "Focal",
        id: 131960242397,
        theme_store_id: 714,
        role: "main",
      };
      Shopify.theme.handle = "null";
      Shopify.theme.style = { id: null, handle: null };
      Shopify.cdnHost = "cdn.shopify.com";
      Shopify.routes = Shopify.routes || {};
      Shopify.routes.root = "/";
    </script>
    <script type="module">
      !(function (o) {
        (o.Shopify = o.Shopify || {}).modules = !0;
      })(window);
    </script>
    <script>
      !(function (o) {
        function n() {
          var o = [];
          function n() {
            o.push(Array.prototype.slice.apply(arguments));
          }
          return (n.q = o), n;
        }
        var t = (o.Shopify = o.Shopify || {});
        (t.loadFeatures = n()), (t.autoloadFeatures = n());
      })(window);
    </script>
    <script>
      (function () {
        function asyncLoad() {
          var urls = [
            "https:\/\/loox.io\/widget\/N1gBr7V_Ih\/loox.1652507684332.js?shop=peachm.myshopify.com",
            "https:\/\/geolocation-recommendations.shopifyapps.com\/locale_bar\/script.js?shop=peachm.myshopify.com",
            "https:\/\/seo.apps.avada.io\/scripttag\/avada-seo-installed.js?shop=peachm.myshopify.com",
            "https:\/\/cdn1.avada.io\/flying-pages\/module.js?shop=peachm.myshopify.com",
          ];
          for (var i = 0; i < urls.length; i++) {
            var s = document.createElement("script");
            if (lightJsExclude.indexOf(urls[i]) === -1) s.type = "lightJs";
            else s.type = "text/javascript";
            s.async = true;
            s.src = urls[i];
            var x = document.getElementsByTagName("script")[0];
            x.parentNode.insertBefore(s, x);
          }
        }
        if (window.attachEvent) {
          window.attachEvent("onload", asyncLoad);
        } else {
          window.addEventListener("load", asyncLoad, false);
        }
      })();
    </script>
    <script id="__st">
      var __st = {
        a: 63748341981,
        offset: 19800,
        reqid: "14c00321-ae25-4477-b9b9-f399f47be979",
        pageurl: "peachmode.com\/",
        u: "fe63756cdaed",
        p: "home",
      };
    </script>
    <script>
      window.ShopifyPaypalV4VisibilityTracking = true;
    </script>
    <script>
      !(function (o) {
        o.addEventListener("DOMContentLoaded", function () {
          (window.Shopify = window.Shopify || {}),
            (window.Shopify.recaptchaV3 = window.Shopify.recaptchaV3 || {
              siteKey: "6LcCR2cUAAAAANS1Gpq_mDIJ2pQuJphsSQaUEuc9",
            });
          var t = [
            'form[action*="/contact"] input[name="form_type"][value="contact"]',
            'form[action*="/comments"] input[name="form_type"][value="new_comment"]',
            'form[action*="/account"] input[name="form_type"][value="customer_login"]',
            'form[action*="/account"] input[name="form_type"][value="recover_customer_password"]',
            'form[action*="/account"] input[name="form_type"][value="create_customer"]',
            'form[action*="/contact"] input[name="form_type"][value="customer"]',
          ].join(",");
          function n(e) {
            e = e.target;
            null == e ||
              (null !=
                (e = (function e(t, n) {
                  if (null == t.parentElement) return null;
                  if ("FORM" != t.parentElement.tagName)
                    return e(t.parentElement, n);
                  for (var o = t.parentElement.action, r = 0; r < n.length; r++)
                    if (-1 !== o.indexOf(n[r])) return t.parentElement;
                  return null;
                })(e, ["/contact", "/comments", "/account"])) &&
                null != e.querySelector(t) &&
                ((e = o.createElement("script")).setAttribute(
                  "src",
                  "https://cdn.shopify.com/shopifycloud/storefront-recaptcha-v3/v0.6/index.js"
                ),
                o.body.appendChild(e),
                o.removeEventListener("focus", n, !0),
                o.removeEventListener("change", n, !0),
                o.removeEventListener("click", n, !0)));
          }
          o.addEventListener("click", n, !0),
            o.addEventListener("change", n, !0),
            o.addEventListener("focus", n, !0);
        });
      })(document);
    </script>
    <script
      integrity="sha256-4VRZk5nmuLKdyxECzHbrGZ+jOgmvT6eNFej4VE7mT80="
      data-source-attribution="shopify.loadfeatures"
      defer="defer"
      src="//cdn.shopify.com/shopifycloud/shopify/assets/storefront/load_feature-e154599399e6b8b29dcb1102cc76eb199fa33a09af4fa78d15e8f8544ee64fcd.js"
      crossorigin="anonymous"
    ></script>
    <script
      integrity="sha256-h+g5mYiIAULyxidxudjy/2wpCz/3Rd1CbrDf4NudHa4="
      data-source-attribution="shopify.dynamic-checkout"
      defer="defer"
      src="//cdn.shopify.com/shopifycloud/shopify/assets/storefront/features-87e8399988880142f2c62771b9d8f2ff6c290b3ff745dd426eb0dfe0db9d1dae.js"
      crossorigin="anonymous"
    ></script>

    <style id="shopify-dynamic-checkout">
      .shopify-payment-button__button--hidden {
        visibility: hidden;
      }

      .shopify-payment-button__button {
        border-radius: 4px;
        border: none;
        box-shadow: 0 0 0 0 transparent;
        color: white;
        cursor: pointer;
        display: block;
        font-size: 1em;
        font-weight: 500;
        line-height: 1;
        text-align: center;
        width: 100%;
        transition: background 0.2s ease-in-out;
      }

      .shopify-payment-button__button[disabled] {
        opacity: 0.6;
        cursor: default;
      }

      .shopify-payment-button__button--unbranded {
        background-color: #1990c6;
        padding: 1em 2em;
      }

      .shopify-payment-button__button--unbranded:hover:not([disabled]) {
        background-color: #136f99;
      }

      .shopify-payment-button__more-options {
        background: transparent;
        border: 0 none;
        cursor: pointer;
        display: block;
        font-size: 1em;
        margin-top: 1em;
        text-align: center;
        width: 100%;
      }

      .shopify-payment-button__more-options:hover:not([disabled]) {
        text-decoration: underline;
      }

      .shopify-payment-button__more-options[disabled] {
        opacity: 0.6;
        cursor: default;
      }

      .shopify-payment-button__button--branded {
        display: flex;
        flex-direction: column;
        min-height: 44px;
        position: relative;
        z-index: 1;
      }

      .shopify-payment-button__button--branded .shopify-cleanslate {
        flex: 1 !important;
        display: flex !important;
        flex-direction: column !important;
      }
    </style>
    <script>
      window.performance &&
        window.performance.mark &&
        window.performance.mark("shopify.content_for_header.end");
    </script>

    <script>
      var loox_global_hash = "1681094666627";
    </script>
    <style>
      .loox-reviews-default {
        max-width: 1200px;
        margin: 0 auto;
      }
      .loox-rating .loox-icon {
        color: #fed264;
      }
    </style>
    <script>
      var loox_rating_icons_enabled = true;
    </script>

    <style type="text/css">
      .baCountry {
        width: 30px;
        height: 20px;
        display: inline-block;
        vertical-align: middle;
        margin-right: 6px;
        background-size: 30px !important;
        border-radius: 4px;
        background-repeat: no-repeat;
      }
      .baCountry-traditional .baCountry {
        background-image: url(https://cdn.shopify.com/s/files/1/0194/1736/6592/t/1/assets/ba-flags.png?=14261939516959647149);
        height: 19px !important;
      }
      .baCountry-modern .baCountry {
        background-image: url(https://cdn.shopify.com/s/files/1/0194/1736/6592/t/1/assets/ba-flags.png?=14261939516959647149);
      }
      .baCountry-NO-FLAG {
        background-position: 0 0;
      }
      .baCountry-AD {
        background-position: 0 -20px;
      }
      .baCountry-AED {
        background-position: 0 -40px;
      }
      .baCountry-AFN {
        background-position: 0 -60px;
      }
      .baCountry-AG {
        background-position: 0 -80px;
      }
      .baCountry-AI {
        background-position: 0 -100px;
      }
      .baCountry-ALL {
        background-position: 0 -120px;
      }
      .baCountry-AMD {
        background-position: 0 -140px;
      }
      .baCountry-AOA {
        background-position: 0 -160px;
      }
      .baCountry-ARS {
        background-position: 0 -180px;
      }
      .baCountry-AS {
        background-position: 0 -200px;
      }
      .baCountry-AT {
        background-position: 0 -220px;
      }
      .baCountry-AUD {
        background-position: 0 -240px;
      }
      .baCountry-AWG {
        background-position: 0 -260px;
      }
      .baCountry-AZN {
        background-position: 0 -280px;
      }
      .baCountry-BAM {
        background-position: 0 -300px;
      }
      .baCountry-BBD {
        background-position: 0 -320px;
      }
      .baCountry-BDT {
        background-position: 0 -340px;
      }
      .baCountry-BE {
        background-position: 0 -360px;
      }
      .baCountry-BF {
        background-position: 0 -380px;
      }
      .baCountry-BGN {
        background-position: 0 -400px;
      }
      .baCountry-BHD {
        background-position: 0 -420px;
      }
      .baCountry-BIF {
        background-position: 0 -440px;
      }
      .baCountry-BJ {
        background-position: 0 -460px;
      }
      .baCountry-BMD {
        background-position: 0 -480px;
      }
      .baCountry-BND {
        background-position: 0 -500px;
      }
      .baCountry-BOB {
        background-position: 0 -520px;
      }
      .baCountry-BRL {
        background-position: 0 -540px;
      }
      .baCountry-BSD {
        background-position: 0 -560px;
      }
      .baCountry-BTN {
        background-position: 0 -580px;
      }
      .baCountry-BWP {
        background-position: 0 -600px;
      }
      .baCountry-BYN {
        background-position: 0 -620px;
      }
      .baCountry-BZD {
        background-position: 0 -640px;
      }
      .baCountry-CAD {
        background-position: 0 -660px;
      }
      .baCountry-CC {
        background-position: 0 -680px;
      }
      .baCountry-CDF {
        background-position: 0 -700px;
      }
      .baCountry-CG {
        background-position: 0 -720px;
      }
      .baCountry-CHF {
        background-position: 0 -740px;
      }
      .baCountry-CI {
        background-position: 0 -760px;
      }
      .baCountry-CK {
        background-position: 0 -780px;
      }
      .baCountry-CLP {
        background-position: 0 -800px;
      }
      .baCountry-CM {
        background-position: 0 -820px;
      }
      .baCountry-CNY {
        background-position: 0 -840px;
      }
      .baCountry-COP {
        background-position: 0 -860px;
      }
      .baCountry-CRC {
        background-position: 0 -880px;
      }
      .baCountry-CU {
        background-position: 0 -900px;
      }
      .baCountry-CX {
        background-position: 0 -920px;
      }
      .baCountry-CY {
        background-position: 0 -940px;
      }
      .baCountry-CZK {
        background-position: 0 -960px;
      }
      .baCountry-DE {
        background-position: 0 -980px;
      }
      .baCountry-DJF {
        background-position: 0 -1000px;
      }
      .baCountry-DKK {
        background-position: 0 -1020px;
      }
      .baCountry-DM {
        background-position: 0 -1040px;
      }
      .baCountry-DOP {
        background-position: 0 -1060px;
      }
      .baCountry-DZD {
        background-position: 0 -1080px;
      }
      .baCountry-EC {
        background-position: 0 -1100px;
      }
      .baCountry-EE {
        background-position: 0 -1120px;
      }
      .baCountry-EGP {
        background-position: 0 -1140px;
      }
      .baCountry-ER {
        background-position: 0 -1160px;
      }
      .baCountry-ES {
        background-position: 0 -1180px;
      }
      .baCountry-ETB {
        background-position: 0 -1200px;
      }
      .baCountry-EUR {
        background-position: 0 -1220px;
      }
      .baCountry-FI {
        background-position: 0 -1240px;
      }
      .baCountry-FJD {
        background-position: 0 -1260px;
      }
      .baCountry-FKP {
        background-position: 0 -1280px;
      }
      .baCountry-FO {
        background-position: 0 -1300px;
      }
      .baCountry-FR {
        background-position: 0 -1320px;
      }
      .baCountry-GA {
        background-position: 0 -1340px;
      }
      .baCountry-GBP {
        background-position: 0 -1360px;
      }
      .baCountry-GD {
        background-position: 0 -1380px;
      }
      .baCountry-GEL {
        background-position: 0 -1400px;
      }
      .baCountry-GHS {
        background-position: 0 -1420px;
      }
      .baCountry-GIP {
        background-position: 0 -1440px;
      }
      .baCountry-GL {
        background-position: 0 -1460px;
      }
      .baCountry-GMD {
        background-position: 0 -1480px;
      }
      .baCountry-GNF {
        background-position: 0 -1500px;
      }
      .baCountry-GQ {
        background-position: 0 -1520px;
      }
      .baCountry-GR {
        background-position: 0 -1540px;
      }
      .baCountry-GTQ {
        background-position: 0 -1560px;
      }
      .baCountry-GU {
        background-position: 0 -1580px;
      }
      .baCountry-GW {
        background-position: 0 -1600px;
      }
      .baCountry-HKD {
        background-position: 0 -1620px;
      }
      .baCountry-HNL {
        background-position: 0 -1640px;
      }
      .baCountry-HRK {
        background-position: 0 -1660px;
      }
      .baCountry-HTG {
        background-position: 0 -1680px;
      }
      .baCountry-HUF {
        background-position: 0 -1700px;
      }
      .baCountry-IDR {
        background-position: 0 -1720px;
      }
      .baCountry-IE {
        background-position: 0 -1740px;
      }
      .baCountry-ILS {
        background-position: 0 -1760px;
      }
      .baCountry-INR {
        background-position: 0 -1780px;
      }
      .baCountry-IO {
        background-position: 0 -1800px;
      }
      .baCountry-IQD {
        background-position: 0 -1820px;
      }
      .baCountry-IRR {
        background-position: 0 -1840px;
      }
      .baCountry-ISK {
        background-position: 0 -1860px;
      }
      .baCountry-IT {
        background-position: 0 -1880px;
      }
      .baCountry-JMD {
        background-position: 0 -1900px;
      }
      .baCountry-JOD {
        background-position: 0 -1920px;
      }
      .baCountry-JPY {
        background-position: 0 -1940px;
      }
      .baCountry-KES {
        background-position: 0 -1960px;
      }
      .baCountry-KGS {
        background-position: 0 -1980px;
      }
      .baCountry-KHR {
        background-position: 0 -2000px;
      }
      .baCountry-KI {
        background-position: 0 -2020px;
      }
      .baCountry-KMF {
        background-position: 0 -2040px;
      }
      .baCountry-KN {
        background-position: 0 -2060px;
      }
      .baCountry-KP {
        background-position: 0 -2080px;
      }
      .baCountry-KRW {
        background-position: 0 -2100px;
      }
      .baCountry-KWD {
        background-position: 0 -2120px;
      }
      .baCountry-KYD {
        background-position: 0 -2140px;
      }
      .baCountry-KZT {
        background-position: 0 -2160px;
      }
      .baCountry-LBP {
        background-position: 0 -2180px;
      }
      .baCountry-LI {
        background-position: 0 -2200px;
      }
      .baCountry-LKR {
        background-position: 0 -2220px;
      }
      .baCountry-LRD {
        background-position: 0 -2240px;
      }
      .baCountry-LSL {
        background-position: 0 -2260px;
      }
      .baCountry-LT {
        background-position: 0 -2280px;
      }
      .baCountry-LU {
        background-position: 0 -2300px;
      }
      .baCountry-LV {
        background-position: 0 -2320px;
      }
      .baCountry-LYD {
        background-position: 0 -2340px;
      }
      .baCountry-MAD {
        background-position: 0 -2360px;
      }
      .baCountry-MC {
        background-position: 0 -2380px;
      }
      .baCountry-MDL {
        background-position: 0 -2400px;
      }
      .baCountry-ME {
        background-position: 0 -2420px;
      }
      .baCountry-MGA {
        background-position: 0 -2440px;
      }
      .baCountry-MKD {
        background-position: 0 -2460px;
      }
      .baCountry-ML {
        background-position: 0 -2480px;
      }
      .baCountry-MMK {
        background-position: 0 -2500px;
      }
      .baCountry-MN {
        background-position: 0 -2520px;
      }
      .baCountry-MOP {
        background-position: 0 -2540px;
      }
      .baCountry-MQ {
        background-position: 0 -2560px;
      }
      .baCountry-MR {
        background-position: 0 -2580px;
      }
      .baCountry-MS {
        background-position: 0 -2600px;
      }
      .baCountry-MT {
        background-position: 0 -2620px;
      }
      .baCountry-MUR {
        background-position: 0 -2640px;
      }
      .baCountry-MVR {
        background-position: 0 -2660px;
      }
      .baCountry-MWK {
        background-position: 0 -2680px;
      }
      .baCountry-MXN {
        background-position: 0 -2700px;
      }
      .baCountry-MYR {
        background-position: 0 -2720px;
      }
      .baCountry-MZN {
        background-position: 0 -2740px;
      }
      .baCountry-NAD {
        background-position: 0 -2760px;
      }
      .baCountry-NE {
        background-position: 0 -2780px;
      }
      .baCountry-NF {
        background-position: 0 -2800px;
      }
      .baCountry-NG {
        background-position: 0 -2820px;
      }
      .baCountry-NIO {
        background-position: 0 -2840px;
      }
      .baCountry-NL {
        background-position: 0 -2860px;
      }
      .baCountry-NOK {
        background-position: 0 -2880px;
      }
      .baCountry-NPR {
        background-position: 0 -2900px;
      }
      .baCountry-NR {
        background-position: 0 -2920px;
      }
      .baCountry-NU {
        background-position: 0 -2940px;
      }
      .baCountry-NZD {
        background-position: 0 -2960px;
      }
      .baCountry-OMR {
        background-position: 0 -2980px;
      }
      .baCountry-PAB {
        background-position: 0 -3000px;
      }
      .baCountry-PEN {
        background-position: 0 -3020px;
      }
      .baCountry-PGK {
        background-position: 0 -3040px;
      }
      .baCountry-PHP {
        background-position: 0 -3060px;
      }
      .baCountry-PKR {
        background-position: 0 -3080px;
      }
      .baCountry-PLN {
        background-position: 0 -3100px;
      }
      .baCountry-PR {
        background-position: 0 -3120px;
      }
      .baCountry-PS {
        background-position: 0 -3140px;
      }
      .baCountry-PT {
        background-position: 0 -3160px;
      }
      .baCountry-PW {
        background-position: 0 -3180px;
      }
      .baCountry-QAR {
        background-position: 0 -3200px;
      }
      .baCountry-RON {
        background-position: 0 -3220px;
      }
      .baCountry-RSD {
        background-position: 0 -3240px;
      }
      .baCountry-RUB {
        background-position: 0 -3260px;
      }
      .baCountry-RWF {
        background-position: 0 -3280px;
      }
      .baCountry-SAR {
        background-position: 0 -3300px;
      }
      .baCountry-SBD {
        background-position: 0 -3320px;
      }
      .baCountry-SCR {
        background-position: 0 -3340px;
      }
      .baCountry-SDG {
        background-position: 0 -3360px;
      }
      .baCountry-SEK {
        background-position: 0 -3380px;
      }
      .baCountry-SGD {
        background-position: 0 -3400px;
      }
      .baCountry-SI {
        background-position: 0 -3420px;
      }
      .baCountry-SK {
        background-position: 0 -3440px;
      }
      .baCountry-SLL {
        background-position: 0 -3460px;
      }
      .baCountry-SM {
        background-position: 0 -3480px;
      }
      .baCountry-SN {
        background-position: 0 -3500px;
      }
      .baCountry-SO {
        background-position: 0 -3520px;
      }
      .baCountry-SRD {
        background-position: 0 -3540px;
      }
      .baCountry-SSP {
        background-position: 0 -3560px;
      }
      .baCountry-STD {
        background-position: 0 -3580px;
      }
      .baCountry-SV {
        background-position: 0 -3600px;
      }
      .baCountry-SYP {
        background-position: 0 -3620px;
      }
      .baCountry-SZL {
        background-position: 0 -3640px;
      }
      .baCountry-TC {
        background-position: 0 -3660px;
      }
      .baCountry-TD {
        background-position: 0 -3680px;
      }
      .baCountry-TG {
        background-position: 0 -3700px;
      }
      .baCountry-THB {
        background-position: 0 -3720px;
      }
      .baCountry-TJS {
        background-position: 0 -3740px;
      }
      .baCountry-TK {
        background-position: 0 -3760px;
      }
      .baCountry-TMT {
        background-position: 0 -3780px;
      }
      .baCountry-TND {
        background-position: 0 -3800px;
      }
      .baCountry-TOP {
        background-position: 0 -3820px;
      }
      .baCountry-TRY {
        background-position: 0 -3840px;
      }
      .baCountry-TTD {
        background-position: 0 -3860px;
      }
      .baCountry-TWD {
        background-position: 0 -3880px;
      }
      .baCountry-TZS {
        background-position: 0 -3900px;
      }
      .baCountry-UAH {
        background-position: 0 -3920px;
      }
      .baCountry-UGX {
        background-position: 0 -3940px;
      }
      .baCountry-USD {
        background-position: 0 -3960px;
      }
      .baCountry-UYU {
        background-position: 0 -3980px;
      }
      .baCountry-UZS {
        background-position: 0 -4000px;
      }
      .baCountry-VEF {
        background-position: 0 -4020px;
      }
      .baCountry-VG {
        background-position: 0 -4040px;
      }
      .baCountry-VI {
        background-position: 0 -4060px;
      }
      .baCountry-VND {
        background-position: 0 -4080px;
      }
      .baCountry-VUV {
        background-position: 0 -4100px;
      }
      .baCountry-WST {
        background-position: 0 -4120px;
      }
      .baCountry-XAF {
        background-position: 0 -4140px;
      }
      .baCountry-XPF {
        background-position: 0 -4160px;
      }
      .baCountry-YER {
        background-position: 0 -4180px;
      }
      .baCountry-ZAR {
        background-position: 0 -4200px;
      }
      .baCountry-ZM {
        background-position: 0 -4220px;
      }
      .baCountry-ZW {
        background-position: 0 -4240px;
      }
      .bacurr-checkoutNotice {
        margin: 3px 10px 0 10px;
        left: 0;
        right: 0;
        text-align: center;
      }
      @media (min-width: 750px) {
        .bacurr-checkoutNotice {
          position: absolute;
        }
      }
    </style>

    <script>
      // FaceBook Pixel
      !(function (f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function () {
          n.callMethod
            ? n.callMethod.apply(n, arguments)
            : n.queue.push(arguments);
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = "2.0";
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s);
      })(
        window,
        document,
        "script",
        "https://connect.facebook.net/en_US/fbevents.js"
      );

      fbq("init", "795748567170435");

      fbq("track", "PageView");
    </script>

    <script>
      //code to store UTM params into the cookie

      function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(
          /[?&]+([^=&]+)=([^&]*)/gi,
          function (m, key, value) {
            vars[key] = value;
          }
        );
        return vars;
      }

      function getUrlParam(parameter, defaultvalue) {
        var urlparameter = defaultvalue;
        if (window.location.href.indexOf(parameter) > -1) {
          urlparameter = getUrlVars()[parameter];
        }
        return urlparameter;
      }

      // create UTM cookie
      function createUtmCookie() {
        var utm_source = getUrlParam("utm_source", "null");
        var utm_medium = getUrlParam("utm_medium", "null");
        var utm_campaign = getUrlParam("utm_campaign", "null");
        var utms =
          "utm_source=" +
          utm_source +
          "&utm_medium=" +
          utm_medium +
          "&utm_campaign=" +
          utm_campaign;
        localStorage.setItem("utm_params", utms);
      }

      if (
        window.location.search.indexOf("utm_source") > 0 ||
        window.location.search.indexOf("utm_medium") > 0 ||
        window.location.search.indexOf("utm_campaign") > 0
      ) {
        createUtmCookie();
      }
    </script>

    <script
      src="https://cdn.shopify.com/extensions/cece2cc8-741a-4309-94ee-04a78984c575/1.59.0/assets/ws-currencyconverter.js"
      type="text/javascript"
      defer="defer"
    ></script>
    <link href="https://monorail-edge.shopifysvc.com" rel="dns-prefetch" />
    <script>
      (function () {
        if ("sendBeacon" in navigator && "performance" in window) {
          var session_token = document.cookie.match(/_shopify_s=([^;]*)/);
          function handle_abandonment_event(e) {
            var entries = performance.getEntries().filter(function (entry) {
              return /monorail-edge.shopifysvc.com/.test(entry.name);
            });
            if (!window.abandonment_tracked && entries.length === 0) {
              window.abandonment_tracked = true;
              var currentMs = Date.now();
              var navigation_start = performance.timing.navigationStart;
              var payload = {
                shop_id: 63748341981,
                url: window.location.href,
                navigation_start,
                duration: currentMs - navigation_start,
                session_token:
                  session_token && session_token.length === 2
                    ? session_token[1]
                    : "",
                page_type: "index",
              };
              window.navigator.sendBeacon(
                "https://monorail-edge.shopifysvc.com/v1/produce",
                JSON.stringify({
                  schema_id: "online_store_buyer_site_abandonment/1.1",
                  payload: payload,
                  metadata: {
                    event_created_at_ms: currentMs,
                    event_sent_at_ms: currentMs,
                  },
                })
              );
            }
          }
          window.addEventListener("pagehide", handle_abandonment_event);
        }
      })();
    </script>
    <script>
      window.ShopifyAnalytics = window.ShopifyAnalytics || {};
      window.ShopifyAnalytics.meta = window.ShopifyAnalytics.meta || {};
      window.ShopifyAnalytics.meta.currency = "INR";
      var meta = { page: { pageType: "home" } };
      for (var attr in meta) {
        window.ShopifyAnalytics.meta[attr] = meta[attr];
      }
    </script>
    <script>
      window.ShopifyAnalytics.merchantGoogleAnalytics = function () {};
    </script>
    <script class="analytics">
      (function () {
        var customDocumentWrite = function (content) {
          var jquery = null;

          if (window.jQuery) {
            jquery = window.jQuery;
          } else if (window.Checkout && window.Checkout.$) {
            jquery = window.Checkout.$;
          }

          if (jquery) {
            jquery("body").append(content);
          }
        };

        var hasLoggedConversion = function (token) {
          if (token) {
            return document.cookie.indexOf("loggedConversion=" + token) !== -1;
          }
          return false;
        };

        var setCookieIfConversion = function (token) {
          if (token) {
            var twoMonthsFromNow = new Date(Date.now());
            twoMonthsFromNow.setMonth(twoMonthsFromNow.getMonth() + 2);

            document.cookie =
              "loggedConversion=" + token + "; expires=" + twoMonthsFromNow;
          }
        };

        var trekkie =
          (window.ShopifyAnalytics.lib =
          window.trekkie =
            window.trekkie || []);
        if (trekkie.integrations) {
          return;
        }
        trekkie.methods = [
          "identify",
          "page",
          "ready",
          "track",
          "trackForm",
          "trackLink",
        ];
        trekkie.factory = function (method) {
          return function () {
            var args = Array.prototype.slice.call(arguments);
            args.unshift(method);
            trekkie.push(args);
            return trekkie;
          };
        };
        for (var i = 0; i < trekkie.methods.length; i++) {
          var key = trekkie.methods[i];
          trekkie[key] = trekkie.factory(key);
        }
        trekkie.load = function (config) {
          trekkie.config = config || {};
          trekkie.config.initialDocumentCookie = document.cookie;
          var first = document.getElementsByTagName("script")[0];
          var script = document.createElement("script");
          script.type = "text/javascript";
          script.onerror = function (e) {
            var scriptFallback = document.createElement("script");
            scriptFallback.type = "text/javascript";
            scriptFallback.onerror = function (error) {
              var Monorail = {
                produce: function produce(monorailDomain, schemaId, payload) {
                  var currentMs = new Date().getTime();
                  var event = {
                    schema_id: schemaId,
                    payload: payload,
                    metadata: {
                      event_created_at_ms: currentMs,
                      event_sent_at_ms: currentMs,
                    },
                  };
                  return Monorail.sendRequest(
                    "https://" + monorailDomain + "/v1/produce",
                    JSON.stringify(event)
                  );
                },
                sendRequest: function sendRequest(endpointUrl, payload) {
                  // Try the sendBeacon API
                  if (
                    window &&
                    window.navigator &&
                    typeof window.navigator.sendBeacon === "function" &&
                    typeof window.Blob === "function" &&
                    !Monorail.isIos12()
                  ) {
                    var blobData = new window.Blob([payload], {
                      type: "text/plain",
                    });

                    if (window.navigator.sendBeacon(endpointUrl, blobData)) {
                      return true;
                    } // sendBeacon was not successful
                  } // XHR beacon

                  var xhr = new XMLHttpRequest();

                  try {
                    xhr.open("POST", endpointUrl);
                    xhr.setRequestHeader("Content-Type", "text/plain");
                    xhr.send(payload);
                  } catch (e) {
                    console.log(e);
                  }

                  return false;
                },
                isIos12: function isIos12() {
                  return (
                    window.navigator.userAgent.lastIndexOf(
                      "iPhone; CPU iPhone OS 12_"
                    ) !== -1 ||
                    window.navigator.userAgent.lastIndexOf(
                      "iPad; CPU OS 12_"
                    ) !== -1
                  );
                },
              };
              Monorail.produce(
                "monorail-edge.shopifysvc.com",
                "trekkie_storefront_load_errors/1.1",
                {
                  shop_id: 63748341981,
                  theme_id: 131960242397,
                  app_name: "storefront",
                  context_url: window.location.href,
                  source_url:
                    "https://cdn.shopify.com/s/trekkie.storefront.ff16095366b6f10320cdce1a0d6f696f3f3d4af4.min.js",
                }
              );
            };
            scriptFallback.async = true;
            scriptFallback.src =
              "https://cdn.shopify.com/s/trekkie.storefront.ff16095366b6f10320cdce1a0d6f696f3f3d4af4.min.js";
            first.parentNode.insertBefore(scriptFallback, first);
          };
          script.async = true;
          script.src =
            "https://cdn.shopify.com/s/trekkie.storefront.ff16095366b6f10320cdce1a0d6f696f3f3d4af4.min.js";
          first.parentNode.insertBefore(script, first);
        };
        trekkie.load({
          Trekkie: {
            appName: "storefront",
            development: false,
            defaultAttributes: {
              shopId: 63748341981,
              isMerchantRequest: null,
              themeId: 131960242397,
              themeCityHash: "5501724287074316170",
              contentLanguage: "en",
              currency: "INR",
            },
            isServerSideCookieWritingEnabled: true,
            monorailRegion: "shop_domain",
          },
          "Session Attribution": {},
          S2S: {
            facebookCapiEnabled: false,
            source: "trekkie-storefront-renderer",
          },
        });

        var loaded = false;
        trekkie.ready(function () {
          if (loaded) return;
          loaded = true;

          window.ShopifyAnalytics.lib = window.trekkie;

          var originalDocumentWrite = document.write;
          document.write = customDocumentWrite;
          try {
            window.ShopifyAnalytics.merchantGoogleAnalytics.call(this);
          } catch (error) {}
          document.write = originalDocumentWrite;

          window.ShopifyAnalytics.lib.page(null, { pageType: "home" });

          var match = window.location.pathname.match(
            /checkouts\/(.+)\/(thank_you|post_purchase)/
          );
          var token = match ? match[1] : undefined;
          if (!hasLoggedConversion(token)) {
            setCookieIfConversion(token);
          }
        });

        var eventsListenerScript = document.createElement("script");
        eventsListenerScript.async = true;
        eventsListenerScript.src =
          "//cdn.shopify.com/shopifycloud/shopify/assets/shop_events_listener-65cd0ba3fcd81a1df33f2510ec5bcf8c0e0958653b50e3965ec972dd638ee13f.js";
        document
          .getElementsByTagName("head")[0]
          .appendChild(eventsListenerScript);
      })();
    </script>
    <script class="boomerang">
      (function () {
        if (
          window.BOOMR &&
          (window.BOOMR.version || window.BOOMR.snippetExecuted)
        ) {
          return;
        }
        window.BOOMR = window.BOOMR || {};
        window.BOOMR.snippetStart = new Date().getTime();
        window.BOOMR.snippetExecuted = true;
        window.BOOMR.snippetVersion = 12;
        window.BOOMR.application = "storefront-renderer";
        window.BOOMR.themeName = "Focal";
        window.BOOMR.themeVersion = "8.8.1";
        window.BOOMR.shopId = 63748341981;
        window.BOOMR.themeId = 131960242397;
        window.BOOMR.renderRegion = "gcp-europe-west1";
        window.BOOMR.url =
          "https://cdn.shopify.com/shopifycloud/boomerang/shopify-boomerang-1.0.0.min.js";
        var where =
          document.currentScript || document.getElementsByTagName("script")[0];
        var parentNode = where.parentNode;
        var promoted = false;
        var LOADER_TIMEOUT = 3000;
        function promote() {
          if (promoted) {
            return;
          }
          var script = document.createElement("script");
          script.id = "boomr-scr-as";
          script.src = window.BOOMR.url;
          script.async = true;
          parentNode.appendChild(script);
          promoted = true;
        }
        function iframeLoader(wasFallback) {
          promoted = true;
          var dom, bootstrap, iframe, iframeStyle;
          var doc = document;
          var win = window;
          window.BOOMR.snippetMethod = wasFallback ? "if" : "i";
          bootstrap = function (parent, scriptId) {
            var script = doc.createElement("script");
            script.id = scriptId || "boomr-if-as";
            script.src = window.BOOMR.url;
            BOOMR_lstart = new Date().getTime();
            parent = parent || doc.body;
            parent.appendChild(script);
          };
          if (
            !window.addEventListener &&
            window.attachEvent &&
            navigator.userAgent.match(/MSIE [67]./)
          ) {
            window.BOOMR.snippetMethod = "s";
            bootstrap(parentNode, "boomr-async");
            return;
          }
          iframe = document.createElement("IFRAME");
          iframe.src = "about:blank";
          iframe.title = "";
          iframe.role = "presentation";
          iframe.loading = "eager";
          iframeStyle = (iframe.frameElement || iframe).style;
          iframeStyle.width = 0;
          iframeStyle.height = 0;
          iframeStyle.border = 0;
          iframeStyle.display = "none";
          parentNode.appendChild(iframe);
          try {
            win = iframe.contentWindow;
            doc = win.document.open();
          } catch (e) {
            dom = document.domain;
            iframe.src =
              "javascript:var d=document.open();d.domain='" +
              dom +
              "';void(0);";
            win = iframe.contentWindow;
            doc = win.document.open();
          }
          if (dom) {
            doc._boomrl = function () {
              this.domain = dom;
              bootstrap();
            };
            doc.write("<body onload='document._boomrl();'>");
          } else {
            win._boomrl = function () {
              bootstrap();
            };
            if (win.addEventListener) {
              win.addEventListener("load", win._boomrl, false);
            } else if (win.attachEvent) {
              win.attachEvent("onload", win._boomrl);
            }
          }
          doc.close();
        }
        var link = document.createElement("link");
        if (
          link.relList &&
          typeof link.relList.supports === "function" &&
          link.relList.supports("preload") &&
          "as" in link
        ) {
          window.BOOMR.snippetMethod = "p";
          link.href = window.BOOMR.url;
          link.rel = "preload";
          link.as = "script";
          link.addEventListener("load", promote);
          link.addEventListener("error", function () {
            iframeLoader(true);
          });
          setTimeout(function () {
            if (!promoted) {
              iframeLoader(true);
            }
          }, LOADER_TIMEOUT);
          BOOMR_lstart = new Date().getTime();
          parentNode.appendChild(link);
        } else {
          iframeLoader(false);
        }
        function boomerangSaveLoadTime(e) {
          window.BOOMR_onload = (e && e.timeStamp) || new Date().getTime();
        }
        if (window.addEventListener) {
          window.addEventListener("load", boomerangSaveLoadTime, false);
        } else if (window.attachEvent) {
          window.attachEvent("onload", boomerangSaveLoadTime);
        }
        if (document.addEventListener) {
          document.addEventListener("onBoomerangLoaded", function (e) {
            e.detail.BOOMR.init({
              ResourceTiming: {
                enabled: true,
                trackedResourceTypes: ["script", "img", "css"],
              },
            });
            e.detail.BOOMR.t_end = new Date().getTime();
          });
        } else if (document.attachEvent) {
          document.attachEvent("onpropertychange", function (e) {
            if (!e) e = event;
            if (e.propertyName === "onBoomerangLoaded") {
              e.detail.BOOMR.init({
                ResourceTiming: {
                  enabled: true,
                  trackedResourceTypes: ["script", "img", "css"],
                },
              });
              e.detail.BOOMR.t_end = new Date().getTime();
            }
          });
        }
      })();
    </script>
    <script id="web-pixels-manager-setup">
      (function e(e, n, a, o, t, r) {
        var i = null !== e;
        i &&
          ((window.Shopify = window.Shopify || {}),
          (window.Shopify.analytics = window.Shopify.analytics || {}),
          (window.Shopify.analytics.replayQueue = []),
          (window.Shopify.analytics.publish = function (e, n, a) {
            window.Shopify.analytics.replayQueue.push([e, n, a]);
          }));
        var s = (function () {
            var e = "legacy",
              n = "unknown",
              a = null,
              o = navigator.userAgent.match(/(Firefox|Chrome)\/(\d+)/i),
              t = navigator.userAgent.match(/(Edg)\/(\d+)/i),
              r = navigator.userAgent.match(
                /(Version)\/(\d+)(.+)(Safari)\/(\d+)/i
              );
            r
              ? ((n = "safari"), (a = parseInt(r[2], 10)))
              : t
              ? ((n = "edge"), (a = parseInt(t[2], 10)))
              : o && ((n = o[1].toLocaleLowerCase()), (a = parseInt(o[2], 10)));
            var i = { chrome: 60, firefox: 55, safari: 11, edge: 80 }[n];
            return void 0 !== i && null !== a && i <= a && (e = "modern"), e;
          })().substring(0, 1),
          l = o.substring(0, 1);
        if (i)
          try {
            self.performance.mark("wpm:start");
          } catch (e) {}
        var d,
          c,
          u,
          p,
          f,
          h,
          w,
          y,
          g = a + "/" + l + r + s + ".js";
        (d = {
          src: g,
          async: !0,
          onload: function () {
            if (e) {
              var a = window.webPixelsManager.init(e);
              n(a),
                window.Shopify.analytics.replayQueue.forEach(function (e) {
                  a.publishCustomEvent(e[0], e[1], e[2]);
                }),
                (window.Shopify.analytics.replayQueue = []),
                (window.Shopify.analytics.publish = a.publishCustomEvent);
            }
          },
          onerror: function () {
            var n =
                (e.storefrontBaseUrl
                  ? e.storefrontBaseUrl.replace(/\/$/, "")
                  : self.location.origin) +
                "/.well-known/shopify/monorail/unstable/produce_batch",
              a = JSON.stringify({
                metadata: { event_sent_at_ms: new Date().getTime() },
                events: [
                  {
                    schema_id: "web_pixels_manager_load/2.0",
                    payload: {
                      version: t || "latest",
                      page_url: self.location.href,
                      status: "failed",
                      error_msg: g + " has failed to load",
                    },
                    metadata: { event_created_at_ms: new Date().getTime() },
                  },
                ],
              });
            try {
              if (self.navigator.sendBeacon.bind(self.navigator)(n, a))
                return !0;
            } catch (e) {}
            const o = new XMLHttpRequest();
            try {
              return (
                o.open("POST", n, !0),
                o.setRequestHeader("Content-Type", "text/plain"),
                o.send(a),
                !0
              );
            } catch (e) {
              console &&
                console.warn &&
                console.warn(
                  "[Web Pixels Manager] Got an unhandled error while logging a load error."
                );
            }
            return !1;
          },
        }),
          (c = document.createElement("script")),
          (u = d.src),
          (p = d.async || !0),
          (f = d.onload),
          (h = d.onerror),
          (w = document.head),
          (y = document.body),
          (c.async = p),
          (c.src = u),
          f && c.addEventListener("load", f),
          h && c.addEventListener("error", h),
          w
            ? w.appendChild(c)
            : y
            ? y.appendChild(c)
            : console.error(
                "Did not find a head or body element to append the script"
              );
      })(
        {
          shopId: 63748341981,
          storefrontBaseUrl: "https://peachmode.com",
          cdnBaseUrl: "https://cdn.shopify.com",
          surface: "storefront-renderer",
          enabledBetaFlags: [
            "web_pixels_use_shop_domain_monorail_endpoint",
            "web_pixels_shopify_pixel_validation",
            "web_pixels_prefetch_assets",
          ],
          webPixelExtensionBaseUrl: "https://cdn.shopify.com",
          webPixelsConfigList: [
            {
              id: "shopify-app-pixel",
              configuration: "{}",
              eventPayloadVersion: "v1",
              runtimeContext: "STRICT",
              scriptVersion: "0530",
              apiClientId: "shopify-pixel",
              type: "APP",
            },
            {
              id: "shopify-custom-pixel",
              eventPayloadVersion: "v1",
              runtimeContext: "LAX",
              scriptVersion: "0530",
              apiClientId: "shopify-pixel",
              type: "CUSTOM",
            },
          ],
          initData: {
            cart: null,
            checkout: null,
            customer: null,
            productVariants: [],
          },
        },
        function pageEvents(webPixelsManagerAPI) {
          webPixelsManagerAPI.publish("page_viewed");
        },
        "https://cdn.shopify.com",
        "browser",
        "0.0.279",
        "518c152fw00918cf1pc7ca055am99284242"
      );
    </script>
  </head>
  <body
    class="no-focus-outline features--image-zoom template-index"
    data-instant-allow-query-string
  >
    <!-- Google Tag Manager (noscript) -->
    <noscript
      ><iframe
        src="https://www.googletagmanager.com/ns.html?id=GTM-W42Q78"
        height="0"
        width="0"
        style="display: none; visibility: hidden"
      ></iframe
    ></noscript>
    <!-- End Google Tag Manager (noscript) --><svg class="visually-hidden">
      <linearGradient id="rating-star-gradient-half">
        <stop offset="50%" stop-color="#f7921c" />
        <stop offset="50%" stop-color="#f7921c" stop-opacity="0.4" />
      </linearGradient>
    </svg>

    <a href="#main" class="visually-hidden skip-to-content">Skip to content</a>
    <loading-bar class="loading-bar"></loading-bar>
    <div
      id="shopify-section-announcement-bar"
      class="shopify-section shopify-section--announcement-bar"
    >
      <style>
        :root {
          --enable-sticky-announcement-bar: 0;
        }

        #shopify-section-announcement-bar {
          --heading-color: 86, 17, 42;
          --text-color: 86, 17, 42;
          --primary-button-background: 86, 17, 42;
          --primary-button-text-color: 255, 255, 255;
          --section-background: 247, 174, 166;
          z-index: 5; /* Make sure it goes over header */
          position: relative;
          top: 0;
        }

        @media screen and (min-width: 741px) {
          :root {
            --enable-sticky-announcement-bar: 0;
          }

          #shopify-section-announcement-bar {
            position: relative;
          }
        }
      </style>
      <section>
        <announcement-bar
          auto-play
          cycle-speed="5"
          class="announcement-bar announcement-bar--multiple"
          style="background-color: #ffda02"
          ><button data-action="prev" class="tap-area tap-area--large">
            <span class="visually-hidden">Previous</span>
            <svg
              fill="none"
              focusable="false"
              width="12"
              height="10"
              class="icon icon--nav-arrow-left-small icon--direction-aware"
              viewBox="0 0 12 10"
            >
              <path
                d="M12 5L2.25 5M2.25 5L6.15 9.16M2.25 5L6.15 0.840001"
                stroke="currentColor"
                stroke-width="2"
              ></path>
            </svg>
          </button>
          <div class="announcement-bar__list">
            <announcement-bar-item class="announcement-bar__item"
              ><div class="announcement-bar__message text--xsmall">
                <p>Extra 20% off on Sale Items. Use Code SALE20</p>
              </div></announcement-bar-item
            ><announcement-bar-item hidden class="announcement-bar__item"
              ><div class="announcement-bar__message text--xsmall">
                <p>All products will be dispatched within 24-48 hrs.</p>
              </div></announcement-bar-item
            ><announcement-bar-item hidden class="announcement-bar__item"
              ><div class="announcement-bar__message text--xsmall">
                <p>7 Day no questions asked return policy.</p>
              </div></announcement-bar-item
            >
          </div>
          <button data-action="next" class="tap-area tap-area--large">
            <span class="visually-hidden">Next</span>
            <svg
              fill="none"
              focusable="false"
              width="12"
              height="10"
              class="icon icon--nav-arrow-right-small icon--direction-aware"
              viewBox="0 0 12 10"
            >
              <path
                d="M-3.63679e-07 5L9.75 5M9.75 5L5.85 9.16M9.75 5L5.85 0.840001"
                stroke="currentColor"
                stroke-width="2"
              ></path>
            </svg></button
        ></announcement-bar>
      </section>

      <script>
        document.documentElement.style.setProperty(
          "--announcement-bar-height",
          document.getElementById("shopify-section-announcement-bar")
            .clientHeight + "px"
        );
      </script>
    </div>
    <div
      id="shopify-section-popup"
      class="shopify-section shopify-section--popup"
    >
      <style>
        [aria-controls="newsletter-popup"] {
          display: none; /* Allows to hide the toggle icon in the header if the section is disabled */
        }
      </style>
    </div>
    <div
      id="shopify-section-header"
      class="shopify-section shopify-section--header"
    >
      <style>
        :root {
          --enable-sticky-header: 1;
          --enable-transparent-header: 0;
          --loading-bar-background: 40, 44, 63; /* Prevent the loading bar to be invisible */
        }

        #shopify-section-header {
          --header-background: 255, 255, 255;
          --header-text-color: 40, 44, 63;
          --header-border-color: 223, 223, 226;
          --reduce-header-padding: 0;
          position: -webkit-sticky;
          position: sticky;
          top: calc(
            var(--enable-sticky-announcement-bar) *
              var(--announcement-bar-height, 0px)
          );
          z-index: 4;
        }
        #shopify-section-header .header__logo-image {
          max-width: 140px;
        }

        @media screen and (min-width: 741px) {
          #shopify-section-header .header__logo-image {
            max-width: 195px;
          }
        }

        @media screen and (min-width: 1200px) {
          /* For this navigation we have to move the logo and make sure the navigation takes the whole width */
          .header__logo {
            order: -1;
            flex: 1 1 0;
          }

          .header__inline-navigation {
            flex: 1 1 auto;
            justify-content: center;
            max-width: max-content;
            margin-inline: 48px;
          }
        }
      </style>

      <store-header sticky class="header header--bordered" role="banner"
        ><div
          class="top_wrapper hidden-phone"
          style="background-color: #f7921c"
        >
          <div class="container">
            <div
              class="header__top_wrapper d-flex align-center justify-between"
            >
              <div class="header__social_media">
                <ul
                  class="social-media social-media--no-radius1 list--unstyled"
                  role="list"
                >
                  <li class="social-media__item social-media__item--facebook">
                    <a
                      href="https://www.facebook.com/peachmode1"
                      target="_blank"
                      rel="noopener"
                      class="social-media__link"
                      aria-label="Follow us on Facebook"
                      ><svg
                        focusable="false"
                        width="9"
                        height="17"
                        class="icon icon--facebook"
                        viewBox="0 0 9 17"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M2.486 16.2084L2.486 8.81845H0L0 5.93845L2.486 5.93845L2.486 3.81845C2.38483 2.79982 2.73793 1.78841 3.45107 1.05407C4.16421 0.319722 5.16485 -0.0628415 6.186 0.00844868C6.9284 0.00408689 7.67039 0.0441585 8.408 0.128449V2.69845L6.883 2.69845C6.4898 2.61523 6.08104 2.73438 5.79414 3.01585C5.50724 3.29732 5.3803 3.70373 5.456 4.09845L5.456 5.93845H8.308L7.936 8.81845H5.46L5.46 16.2084H2.486Z"
                          fill="currentColor"
                        ></path></svg
                    ></a>
                  </li>
                  <li class="social-media__item social-media__item--twitter">
                    <a
                      href="https://www.twitter.com/peachmode1"
                      target="_blank"
                      rel="noopener"
                      class="social-media__link"
                      aria-label="Follow us on Twitter"
                      ><svg
                        focusable="false"
                        width="20"
                        height="16"
                        class="icon icon--twitter"
                        viewBox="0 0 20 16"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M12.845 2.13398C14.0997 2.11363 14.7676 2.53229 15.4054 3.06445C15.9468 3.02216 16.6505 2.74528 17.065 2.55232C17.1993 2.48493 17.3337 2.41786 17.468 2.35046C17.2312 2.93602 16.9103 3.39474 16.417 3.74251C16.3074 3.81976 16.1987 3.92434 16.0613 3.97362C16.0613 3.97584 16.0613 3.97838 16.0613 3.98061C16.7643 3.97394 17.3441 3.6837 17.8947 3.52603C17.8947 3.52856 17.8947 3.5311 17.8947 3.53365C17.6055 3.95454 17.214 4.38147 16.7963 4.6876C16.6277 4.8103 16.4591 4.93301 16.2905 5.05571C16.2997 5.73696 16.2795 6.38704 16.1404 6.95989C15.3314 10.2888 13.1878 12.5491 9.7945 13.517C8.5761 13.8648 6.60702 14.0075 5.21102 13.6903C4.51872 13.5329 3.89334 13.3552 3.30644 13.1203C2.98052 12.9896 2.67854 12.8485 2.38972 12.6876C2.29496 12.6346 2.2001 12.5818 2.10522 12.5287C2.42018 12.5376 2.78846 12.6168 3.14052 12.5649C3.45896 12.5179 3.77128 12.53 4.06514 12.4712C4.79794 12.324 5.4486 12.1294 6.00916 11.829C6.2809 11.6834 6.69324 11.5124 6.88634 11.3026C6.52248 11.3083 6.19256 11.2311 5.9223 11.144C4.87436 10.8051 4.26436 10.1824 3.86752 9.2468C4.1851 9.27827 5.09982 9.35394 5.31368 9.18894C4.91398 9.16891 4.52956 8.95688 4.25478 8.7992C3.41184 8.31634 2.72438 7.50634 2.72954 6.26021C2.84022 6.30821 2.9509 6.35653 3.06148 6.40453C3.27324 6.48622 3.48848 6.52978 3.74112 6.57778C3.8478 6.59781 4.06114 6.65534 4.18362 6.6137C4.17836 6.6137 4.17308 6.6137 4.16782 6.6137C4.00476 6.43982 3.73902 6.32411 3.57512 6.1375C3.03438 5.52206 2.52758 4.57507 2.84812 3.44686C2.9294 3.16077 3.05842 2.90805 3.19586 2.67502C3.20114 2.67757 3.2064 2.67979 3.21168 2.68234C3.2746 2.80282 3.415 2.89152 3.50408 2.99229C3.78024 3.30573 4.1209 3.5877 4.46812 3.83629C5.65108 4.68347 6.71642 5.20386 8.42738 5.58946C8.86134 5.68706 9.36308 5.76176 9.88146 5.76238C9.73578 5.37424 9.78258 4.7461 9.89726 4.37035C10.1856 3.42557 10.8119 2.74402 11.7307 2.37907C11.9504 2.29197 12.1941 2.22838 12.4498 2.17722C12.5815 2.16291 12.7133 2.14861 12.845 2.13398Z"
                          fill="currentColor"
                        ></path></svg
                    ></a>
                  </li>
                  <li class="social-media__item social-media__item--instagram">
                    <a
                      href="https://instagram.com/peachmodeinsta"
                      target="_blank"
                      rel="noopener"
                      class="social-media__link"
                      aria-label="Follow us on Instagram"
                      ><svg
                        focusable="false"
                        width="16"
                        height="16"
                        class="icon icon--instagram"
                        viewBox="0 0 16 16"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M8 0C5.827 0 5.555.01 4.702.048 3.85.087 3.269.222 2.76.42a3.921 3.921 0 00-1.417.923c-.445.444-.719.89-.923 1.417-.198.509-.333 1.09-.372 1.942C.01 5.555 0 5.827 0 8s.01 2.445.048 3.298c.039.852.174 1.433.372 1.942.204.526.478.973.923 1.417.444.445.89.719 1.417.923.509.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.445-.01 3.298-.048c.852-.039 1.433-.174 1.942-.372a3.922 3.922 0 001.417-.923c.445-.444.719-.89.923-1.417.198-.509.333-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.298c-.039-.852-.174-1.433-.372-1.942a3.922 3.922 0 00-.923-1.417A3.921 3.921 0 0013.24.42c-.509-.198-1.09-.333-1.942-.372C10.445.01 10.173 0 8 0zm0 1.441c2.136 0 2.39.009 3.233.047.78.036 1.203.166 1.485.276.374.145.64.318.92.598.28.28.453.546.598.92.11.282.24.705.276 1.485.038.844.047 1.097.047 3.233s-.009 2.39-.047 3.233c-.036.78-.166 1.203-.276 1.485-.145.374-.318.64-.598.92-.28.28-.546.453-.92.598-.282.11-.705.24-1.485.276-.844.038-1.097.047-3.233.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.479 2.479 0 01-.92-.598 2.478 2.478 0 01-.598-.92c-.11-.282-.24-.705-.276-1.485-.038-.844-.047-1.097-.047-3.233s.009-2.39.047-3.233c.036-.78.166-1.203.276-1.485.145-.374.318-.64.598-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.844-.038 1.097-.047 3.233-.047zm0 9.226a2.667 2.667 0 110-5.334 2.667 2.667 0 010 5.334zm0-6.775a4.108 4.108 0 100 8.216 4.108 4.108 0 000-8.216zm5.23-.162a.96.96 0 11-1.92 0 .96.96 0 011.92 0z"
                          fill="currentColor"
                        ></path></svg
                    ></a>
                  </li>
                  <li class="social-media__item social-media__item--youtube">
                    <a
                      href="https://www.youtube.com/c/Peachmode/"
                      target="_blank"
                      rel="noopener"
                      class="social-media__link"
                      aria-label="Follow us on YouTube"
                      ><svg
                        fill="none"
                        focusable="false"
                        width="18"
                        height="13"
                        class="icon icon--youtube"
                        viewBox="0 0 18 13"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M16.0325 0.369454C16.807 0.572743 17.4168 1.17173 17.6238 1.9324C18 3.31101 18 6.1875 18 6.1875C18 6.1875 18 9.06389 17.6238 10.4427C17.4168 11.2033 16.807 11.8023 16.0325 12.0056C14.6288 12.375 9 12.375 9 12.375C9 12.375 3.37122 12.375 1.96752 12.0056C1.19311 11.8023 0.583159 11.2033 0.376159 10.4427C0 9.06389 0 6.1875 0 6.1875C0 6.1875 0 3.31101 0.376159 1.9324C0.583159 1.17173 1.19311 0.572743 1.96752 0.369454C3.37122 0 9 0 9 0C9 0 14.6288 0 16.0325 0.369454ZM11.8636 6.1876L7.1591 8.79913V3.57588L11.8636 6.1876Z"
                          fill="currentColor"
                        ></path></svg
                    ></a>
                  </li>
                </ul>
              </div>
              <div class="header__secondary-links">
                <ul class="header__linklist list--unstyled" role="list">
                  <li class="header__linklist-item">
                    <a
                      class="header__linklist-link link--animated"
                      href="track-order.php"
                      >Track Order</a
                    >
                  </li>
                  <li class="header__linklist-item">
                    <a
                      class="header__linklist-link link--animated"
                      href="contact.php"
                      >Contact Us</a
                    >
                  </li>
                </ul>
                <form
                  method="post"
                  action="/localization"
                  id="header-localization-form"
                  accept-charset="UTF-8"
                  class="header__cross-border hidden-pocket"
                  enctype="multipart/form-data"
                >
                  <input
                    type="hidden"
                    name="form_type"
                    value="localization"
                  /><input type="hidden" name="utf8" value="✓" /><input
                    type="hidden"
                    name="_method"
                    value="put"
                  /><input type="hidden" name="return_to" value="/" />
                  <div class="popover-container"></div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="header__wrapper">
            <!-- LEFT PART -->
            <nav class="header__inline-navigation" role="navigation">
              <desktop-navigation>
                <ul
                  class="header__linklist list--unstyled hidden-pocket hidden-lap"
                  role="list"
                >
                  <li
                    class="header__linklist-item has-dropdown"
                    data-item-title="Collections"
                  >
                    <a
                      class="header__linklist-link link--animated"
                      href="product.php"
                      aria-controls="desktop-menu-1"
                      aria-expanded="false"
                      >Collections</a
                    >
                    <ul
                      hidden
                      id="desktop-menu-1"
                      class="nav-dropdown list--unstyled"
                      role="list"
                    >
                      <li class="nav-dropdown__item">
                        <a
                          class="nav-dropdown__link link--faded"
                          href="product.php"
                          >New Arrivals</a
                        >
                      </li>
                      <li class="nav-dropdown__item">
                        <a
                          class="nav-dropdown__link link--faded"
                          href="product.php"
                          >Handbags</a
                        >
                      </li>
                      <li class="nav-dropdown__item has-dropdown">
                        <a
                          class="nav-dropdown__link link--faded"
                          href="product.php"
                          aria-controls="desktop-menu-1-3"
                          aria-expanded="false"
                          >Jewellery<svg
                            focusable="false"
                            width="7"
                            height="10"
                            class="icon icon--dropdown-arrow-right icon--direction-aware"
                            viewBox="0 0 7 10"
                          >
                            <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M3.9394 5L0.469727 1.53033L1.53039 0.469666L6.06072 5L1.53039 9.53032L0.469727 8.46967L3.9394 5Z"
                              fill="currentColor"
                            ></path>
                          </svg>
                        </a>
                        <ul
                          hidden
                          id="desktop-menu-1-3"
                          class="nav-dropdown list--unstyled"
                          role="list"
                        >
                          <li class="nav-dropdown__item">
                            <a
                              class="nav-dropdown__link link--faded"
                              href="product.php"
                              >Earrings</a
                            >
                          </li>
                          <li class="nav-dropdown__item">
                            <a
                              class="nav-dropdown__link link--faded"
                              href="product.php"
                              >Necklace</a
                            >
                          </li>
                          <li class="nav-dropdown__item">
                            <a
                              class="nav-dropdown__link link--faded"
                              href="product.php"
                              >Rings</a
                            >
                          </li>
                          <li class="nav-dropdown__item">
                            <a
                              class="nav-dropdown__link link--faded"
                              href="product.php"
                              >Bracelet</a
                            >
                          </li>
                          <li class="nav-dropdown__item">
                            <a
                              class="nav-dropdown__link link--faded"
                              href="product.php"
                              >Maang Tika</a
                            >
                          </li>
                        </ul>
                      </li>
                      <li class="nav-dropdown__item">
                        <a
                          class="nav-dropdown__link link--faded"
                          href="product.php"
                          >Bedsheets</a
                        >
                      </li>
                      <li class="nav-dropdown__item">
                        <a
                          class="nav-dropdown__link link--faded"
                          href="product.php"
                          >Exclusive</a
                        >
                      </li>
                      <li class="nav-dropdown__item">
                        <a
                          class="nav-dropdown__link link--faded"
                          href="product.php"
                          >Combo Packs</a
                        >
                      </li>
                      <li class="nav-dropdown__item">
                        <a
                          class="nav-dropdown__link link--faded"
                          href="product.php"
                          >Mens Kurta Pyjama</a
                        >
                      </li>
                    </ul>
                  </li>
                  <li
                    class="header__linklist-item has-dropdown"
                    data-item-title="Sarees"
                  >
                    <a
                      class="header__linklist-link link--animated"
                      href="product.php"
                      aria-controls="desktop-menu-2"
                      aria-expanded="false"
                      >Sarees</a
                    >
                    <div hidden id="desktop-menu-2" class="mega-menu">
                      <div class="container">
                        <div class="mega-menu__inner">
                          <div class="mega-menu__columns-wrapper">
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Fabric</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Cotton Sarees</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Art Silk Sarees</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Chiffon Sarees</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Georgette Sarees</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Crepe Sarees</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Organza Sarees</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Chanderi Silk</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Bhagalpuri Silk</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Satin Sarees</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Linen Sarees</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Net Sarees</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Kanjivaram</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Banarasi Silk</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Print/Pattern</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Floral Print</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Bandhani Sarees</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Embroidered</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Paithani</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Lucknowi / Chickankari</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Patola</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Collection</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Half N Half Saree</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Authentic Drapes</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Bollywood</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Price</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >0-999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >1000-1999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >2000-2999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >3000-3999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >4000-4999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >5000 & above</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Occasion</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Bridal</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Casual / Daily</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Engagement</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Festive</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Haldi</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Mehendi</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Office wear</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Party
                                  </a>
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Reception</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Sangeet</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Wedding
                                  </a>
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Color</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Red</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Pink</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >White</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Black</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Orange</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Blue</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Purple</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Yellow</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Brown</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Grey</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Green</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Multicolor</a
                                  >
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="mega-menu__images-wrapper">
                            <div class="mega-menu__image-push image-zoom">
                              <div class="mega-menu__image-wrapper">
                                <img
                                  loading="lazy"
                                  class="mega-menu__image"
                                  sizes="240px"
                                  height="459"
                                  width="277"
                                  alt=""
                                  src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/Banner-10.jpg?v=1651132381"
                                />
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li
                    class="header__linklist-item has-dropdown"
                    data-item-title="Salwar Suits"
                  >
                    <a
                      class="header__linklist-link link--animated"
                      href="product.php"
                      aria-controls="desktop-menu-3"
                      aria-expanded="false"
                      >Salwar Suits</a
                    >
                    <div hidden id="desktop-menu-3" class="mega-menu">
                      <div class="container">
                        <div class="mega-menu__inner">
                          <div class="mega-menu__columns-wrapper">
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Fabric</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Rayon</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Cotton</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Georgette</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Crepe</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Chiffon</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Organza</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Bhagalpuri Silk</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Banarasi</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Chanderi</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Jacquard</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Tapetta Silk</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Tussar Silk</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Net</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Style</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Sharara Suits</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Anarkali Suits</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Palazzo Suits</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Patiala Suits</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Pakistani Suits</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Straight Cut Suits</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Indo western</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Stitch Type</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Unstitched Salwar suits</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Readymade Salwar suits</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Semi Stitched</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Price</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >0-999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >1000-1999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >2000-2999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >3000 & above</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Occasion</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Bridal</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Casual / Daily</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Engagement</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Festive</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Haldi</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Mehendi</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Office wear</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Party
                                  </a>
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Reception</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Sangeet</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Wedding
                                  </a>
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Color</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Red</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Pink</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >White</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Black</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Orange</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Blue</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Purple</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Yellow</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Brown</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Grey</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Green</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Multicolor</a
                                  >
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="mega-menu__images-wrapper">
                            <div class="mega-menu__image-push image-zoom">
                              <div class="mega-menu__image-wrapper">
                                <img
                                  loading="lazy"
                                  class="mega-menu__image"
                                  sizes="240px"
                                  height="646"
                                  width="380"
                                  alt=""
                                  src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/Banner-6.jpg?v=1651132202"
                                />
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li
                    class="header__linklist-item has-dropdown"
                    data-item-title="Kurtis"
                  >
                    <a
                      class="header__linklist-link link--animated"
                      href="product.php"
                      aria-controls="desktop-menu-4"
                      aria-expanded="false"
                      >Kurtis</a
                    >
                    <div hidden id="desktop-menu-4" class="mega-menu">
                      <div class="container">
                        <div class="mega-menu__inner">
                          <div class="mega-menu__columns-wrapper">
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Fabric</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Silk</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Rayon</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Cotton</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Georgette</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Crepe</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Chiffon</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Chanderi Cotton</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Jacquard</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Linen</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Muslin</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Print/Pattern</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Floral print</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Solid</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Bandhani</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Printed</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Embroidered</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Anarkali</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >A-Line</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Straight</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Short
                                  </a>
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Long</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >High Low</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Product Type</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Kurti Pant Set</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Kurti Palazzo Set</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Kurti Dhoti Set</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Kurti Skirt Set</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Palazzo Suit</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Top Bottom Set</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Kurti</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Kaftan</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Kaftan Set</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Occasion</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Casual / Daily</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Festive</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Office wear</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Party
                                  </a>
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Price</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >0-999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >1000-1999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >2000 & above</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Color</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Red</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Pink</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >White</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Black</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Orange</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Blue</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Purple</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Yellow</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Brown</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Grey</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Green</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Multicolor</a
                                  >
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="mega-menu__images-wrapper">
                            <div class="mega-menu__image-push image-zoom">
                              <div class="mega-menu__image-wrapper">
                                <img
                                  loading="lazy"
                                  class="mega-menu__image"
                                  sizes="240px"
                                  height="459"
                                  width="277"
                                  alt=""
                                  src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/Banner-9.jpg?v=1651132362"
                                />
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li
                    class="header__linklist-item has-dropdown"
                    data-item-title="Lehengas"
                  >
                    <a
                      class="header__linklist-link link--animated"
                      href="product.php"
                      aria-controls="desktop-menu-5"
                      aria-expanded="false"
                      >Lehengas</a
                    >
                    <div hidden id="desktop-menu-5" class="mega-menu">
                      <div class="container">
                        <div class="mega-menu__inner">
                          <div class="mega-menu__columns-wrapper">
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Fabric</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Art Silk</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Banarasi Silk</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Cotton</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Georgette</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Jacquard</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Organza</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Satin</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Silk</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Velvet</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Pattern</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Designer</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Digital</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Floral</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Price</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >0-999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >1000-1999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >2000-2999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >3000-3999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >4000-4999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >5000 & above</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Occasion</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Bridal</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Engagement</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Festive</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Haldi</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Mehendi</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Party
                                  </a>
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Reception</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Sangeet</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Wedding
                                  </a>
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Color</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Red</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Pink</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >White</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Black</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Orange</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Blue</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Purple</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Yellow</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Gold</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Grey</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Green</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Multicolor</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Style</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Ready to wear</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Unstiched</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Semi stitched</a
                                  >
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="mega-menu__images-wrapper">
                            <div class="mega-menu__image-push image-zoom">
                              <div class="mega-menu__image-wrapper">
                                <img
                                  loading="lazy"
                                  class="mega-menu__image"
                                  sizes="240px"
                                  height="459"
                                  width="277"
                                  alt=""
                                  src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/Banner-11.jpg?v=1651132400"
                                />
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li
                    class="header__linklist-item has-dropdown"
                    data-item-title="Gowns"
                  >
                    <a
                      class="header__linklist-link link--animated"
                      href="product.php"
                      aria-controls="desktop-menu-6"
                      aria-expanded="false"
                      >Gowns</a
                    >
                    <div hidden id="desktop-menu-6" class="mega-menu">
                      <div class="container">
                        <div class="mega-menu__inner">
                          <div class="mega-menu__columns-wrapper">
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Fabric</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Cotton</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Satin</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Chanderi</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Georgette</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Jacquard</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Net</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Rayon</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Silk</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Tapetta Silk</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Occasion</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Bridal</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Engagement</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Festive</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Haldi</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Mehendi</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Party
                                  </a>
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Reception</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Sangeet</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Wedding
                                  </a>
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Price</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >0-999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >1000-1999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >2000-2999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >3000-3999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >4000-4999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >5000 & above</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Color</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Red</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Pink</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Black</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Orange</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Blue</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Purple</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Yellow</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Brown</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Grey</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Green</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Multicolor</a
                                  >
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li
                    class="header__linklist-item has-dropdown"
                    data-item-title="Western"
                  >
                    <a
                      class="header__linklist-link link--animated"
                      href="product.php"
                      aria-controls="desktop-menu-7"
                      aria-expanded="false"
                      >Western</a
                    >
                    <div hidden id="desktop-menu-7" class="mega-menu">
                      <div class="container">
                        <div class="mega-menu__inner">
                          <div class="mega-menu__columns-wrapper">
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Fabric</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Rayon</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Cotton</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Georgette</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Chiffon</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Crepe</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Type</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Tops</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Tunics</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Dresses</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Jumpsuit</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Occasion</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Casual / Daily</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Festive</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Office wear</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Party
                                  </a>
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Price</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >0-999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >1000-1999</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >2000 & above</a
                                  >
                                </li>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <a
                                href="product.php"
                                class="mega-menu__title heading heading--small"
                                >Color</a
                              >
                              <ul class="linklist list--unstyled" role="list">
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Red</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Pink</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >White</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Black</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Orange</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Blue</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Purple</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Yellow</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Brown</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Grey</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Green</a
                                  >
                                </li>
                                <li class="linklist__item">
                                  <a href="product.php" class="link--faded"
                                    >Multicolor</a
                                  >
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="header__linklist-item" data-item-title="Live">
                    <a
                      class="header__linklist-link link--animated"
                      href="product.php"
                      >Live</a
                    >
                  </li>
                  <li class="header__linklist-item" data-item-title="Sale">
                    <a
                      class="header__linklist-link link--animated"
                      href="product.php"
                      >Sale</a
                    >
                  </li>
                </ul>
              </desktop-navigation>
              <div class="header__icon-list">
                <button
                  is="toggle-button"
                  class="header__icon-wrapper tap-area hidden-desk"
                  aria-controls="mobile-menu-drawer"
                  aria-expanded="false"
                >
                  <span class="visually-hidden">Navigation</span
                  ><svg
                    focusable="false"
                    width="18"
                    height="14"
                    class="icon icon--header-hamburger"
                    viewBox="0 0 18 14"
                  >
                    <path
                      d="M0 1h18M0 13h18H0zm0-6h18H0z"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                    ></path>
                  </svg>
                </button>
                <span class="st-mobile-icons"
                  ><div class="st-icons">
                    <span class="st-search-icon" style="display: flex">
                      <svg
                        focusable="false"
                        width="18"
                        height="25"
                        class="icon icon&#45;&#45;header-search"
                        viewBox="0 0 18 18"
                      >
                        <path
                          d="M12.336 12.336c2.634-2.635 2.682-6.859.106-9.435-2.576-2.576-6.8-2.528-9.435.106C.373 5.642.325 9.866 2.901 12.442c2.576 2.576 6.8 2.528 9.435-.106zm0 0L17 17"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                        ></path>
                      </svg>
                    </span>
                    <span class="st-search-close-btn" style="display: none">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="25"
                        height="20.677"
                        viewBox="0 0 17.139 20.677"
                      >
                        <g
                          id="Close_icon"
                          data-name="Close icon"
                          transform="translate(-557.089 -43.178)"
                        >
                          <path
                            id="Path_9404"
                            data-name="Path 9404"
                            d="M0,0,15.052,12.047"
                            transform="translate(558.458 47.107) rotate(3)"
                            fill="none"
                            stroke="#707070"
                            stroke-linecap="round"
                            stroke-width="1"
                          ></path>
                          <path
                            id="Path_9405"
                            data-name="Path 9405"
                            d="M0,0,16.909,8.935"
                            transform="matrix(-0.342, 0.94, -0.94, -0.342, 572.748, 47.1)"
                            fill="none"
                            stroke="#707070"
                            stroke-linecap="round"
                            stroke-width="1"
                          ></path>
                        </g>
                      </svg>
                    </span>
                  </div>
                  <script>
                    window.addEventListener("DOMContentLoaded", function () {
                      function isDeviceMobile() {
                        return window.matchMedia(
                          "only screen and (max-width:768px)"
                        ).matches;
                      }

                      let stIcon = isDeviceMobile()
                        ? document.querySelector(
                            ".st-mobile-icons .st-icons .st-search-icon"
                          )
                        : document.querySelector(
                            ".st-desktop-icons .st-icons .st-search-icon"
                          );
                      let stSearchBox = isDeviceMobile()
                        ? document.querySelector(".st-mobile-searchbox")
                        : document.querySelector(".st-search-box-desktop");
                      let stCrossIcon = isDeviceMobile()
                        ? document.querySelector(
                            ".st-mobile-icons .st-icons .st-search-close-btn"
                          )
                        : document.querySelector(
                            ".st-search-box-desktop .st-icons .st-search-close-btn"
                          );
                      let stSearchInput = isDeviceMobile()
                        ? document.querySelector(".st-mobile-searchbox input")
                        : document.querySelector(
                            ".st-search-box-desktop .st-search-input"
                          );

                      if (stIcon) {
                        stIcon.addEventListener("click", function () {
                          stIcon.style.display = "none";
                          stSearchBox.style.display = "block";

                          if (stCrossIcon) stCrossIcon.style.display = "flex";

                          setTimeout(() => {
                            stSearchInput.focus();
                          }, 500);

                          let mobileFilterBar = document.querySelector(
                            "#mobile-filter-sort.sticky"
                          );
                          if (isDeviceMobile() && mobileFilterBar) {
                            mobileFilterBar.style.top = "114px";
                          }
                        });
                      }

                      if (stCrossIcon) {
                        stCrossIcon.addEventListener("click", function () {
                          stCrossIcon.style.display = "none";
                          stSearchBox.style.display = "none";
                          stIcon.style.display = "flex";
                          let mobileFilterBar = document.querySelector(
                            "#mobile-filter-sort.sticky"
                          );
                          if (isDeviceMobile() && mobileFilterBar) {
                            mobileFilterBar.style.top = "64px";
                          }
                        });
                      }
                    });
                  </script>
                  <style>
                    .header .st-icons {
                      cursor: pointer;
                    }
                    @media only screen and (min-width: 768px) {
                      .st-mobile-icons .st-icons .st-search-icon {
                        display: none !important;
                      }
                    }

                    @media only screen and (max-width: 767px) {
                      .st-desktop-icons .st-icons .st-search-icon {
                        display: none !important;
                      }
                      .st-icons .st-search-icon {
                        margin-right: 0;
                        margin-left: 0;
                        display: flex;
                      }
                    }
                  </style></span
                >
              </div>
            </nav>
            <!-- LOGO PART -->
            <h1 class="header__logo">
              <a class="header__logo-link" href="index.php"
                ><span class="visually-hidden">Kalaajee</span>
                <img
                  loading="lazy"
                  class="header__logo-image"
                  width="280"
                  height="80"
                  src="img/KALAAJEE PNG FILE LOGO 8-5-2023.png"
                  alt=""
              /></a>
            </h1>
            <!-- SECONDARY LINKS PART -->
            <div class="header__secondary-links">
              <div class="header__icon-list">
                <button
                  is="toggle-button"
                  class="header__icon-wrapper tap-area hidden-phone hidden-desk"
                  aria-controls="newsletter-popup"
                  aria-expanded="false"
                >
                  <span class="visually-hidden">Newsletter</span
                  ><svg
                    focusable="false"
                    width="20"
                    height="16"
                    class="icon icon--header-email"
                    viewBox="0 0 20 16"
                  >
                    <path
                      d="M19 4l-9 5-9-5"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                    ></path>
                    <path
                      stroke="currentColor"
                      fill="none"
                      stroke-width="2"
                      d="M1 1h18v14H1z"
                    ></path>
                  </svg>
                </button>

                <span class="st-desktop-icons"
                  ><div class="st-icons">
                    <span class="st-search-icon" style="display: flex">
                      <svg
                        focusable="false"
                        width="18"
                        height="25"
                        class="icon icon&#45;&#45;header-search"
                        viewBox="0 0 18 18"
                      >
                        <path
                          d="M12.336 12.336c2.634-2.635 2.682-6.859.106-9.435-2.576-2.576-6.8-2.528-9.435.106C.373 5.642.325 9.866 2.901 12.442c2.576 2.576 6.8 2.528 9.435-.106zm0 0L17 17"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                        ></path>
                      </svg>
                    </span>
                    <span class="st-search-close-btn" style="display: none">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="25"
                        height="20.677"
                        viewBox="0 0 17.139 20.677"
                      >
                        <g
                          id="Close_icon"
                          data-name="Close icon"
                          transform="translate(-557.089 -43.178)"
                        >
                          <path
                            id="Path_9404"
                            data-name="Path 9404"
                            d="M0,0,15.052,12.047"
                            transform="translate(558.458 47.107) rotate(3)"
                            fill="none"
                            stroke="#707070"
                            stroke-linecap="round"
                            stroke-width="1"
                          ></path>
                          <path
                            id="Path_9405"
                            data-name="Path 9405"
                            d="M0,0,16.909,8.935"
                            transform="matrix(-0.342, 0.94, -0.94, -0.342, 572.748, 47.1)"
                            fill="none"
                            stroke="#707070"
                            stroke-linecap="round"
                            stroke-width="1"
                          ></path>
                        </g>
                      </svg>
                    </span>
                  </div>
                  <script>
                    window.addEventListener("DOMContentLoaded", function () {
                      function isDeviceMobile() {
                        return window.matchMedia(
                          "only screen and (max-width:768px)"
                        ).matches;
                      }

                      let stIcon = isDeviceMobile()
                        ? document.querySelector(
                            ".st-mobile-icons .st-icons .st-search-icon"
                          )
                        : document.querySelector(
                            ".st-desktop-icons .st-icons .st-search-icon"
                          );
                      let stSearchBox = isDeviceMobile()
                        ? document.querySelector(".st-mobile-searchbox")
                        : document.querySelector(".st-search-box-desktop");
                      let stCrossIcon = isDeviceMobile()
                        ? document.querySelector(
                            ".st-mobile-icons .st-icons .st-search-close-btn"
                          )
                        : document.querySelector(
                            ".st-search-box-desktop .st-icons .st-search-close-btn"
                          );
                      let stSearchInput = isDeviceMobile()
                        ? document.querySelector(".st-mobile-searchbox input")
                        : document.querySelector(
                            ".st-search-box-desktop .st-search-input"
                          );

                      if (stIcon) {
                        stIcon.addEventListener("click", function () {
                          stIcon.style.display = "none";
                          stSearchBox.style.display = "block";

                          if (stCrossIcon) stCrossIcon.style.display = "flex";

                          setTimeout(() => {
                            stSearchInput.focus();
                          }, 500);

                          let mobileFilterBar = document.querySelector(
                            "#mobile-filter-sort.sticky"
                          );
                          if (isDeviceMobile() && mobileFilterBar) {
                            mobileFilterBar.style.top = "114px";
                          }
                        });
                      }

                      if (stCrossIcon) {
                        stCrossIcon.addEventListener("click", function () {
                          stCrossIcon.style.display = "none";
                          stSearchBox.style.display = "none";
                          stIcon.style.display = "flex";
                          let mobileFilterBar = document.querySelector(
                            "#mobile-filter-sort.sticky"
                          );
                          if (isDeviceMobile() && mobileFilterBar) {
                            mobileFilterBar.style.top = "64px";
                          }
                        });
                      }
                    });
                  </script>
                  <style>
                    .header .st-icons {
                      cursor: pointer;
                    }
                    @media only screen and (min-width: 768px) {
                      .st-mobile-icons .st-icons .st-search-icon {
                        display: none !important;
                      }
                    }

                    @media only screen and (max-width: 767px) {
                      .st-desktop-icons .st-icons .st-search-icon {
                        display: none !important;
                      }
                      .st-icons .st-search-icon {
                        margin-right: 0;
                        margin-left: 0;
                        display: flex;
                      }
                    }
                  </style></span
                >
                <div class="st-search-autocomplete-desktop site-nav__link">
                  <div class="st-search-box-desktop">
                    <span class="st-icon-search">
                      <svg
                        data-icon="search"
                        viewBox="0 0 512 512"
                        width="16px"
                        height="16px"
                      >
                        <path
                          d="M495,466.2L377.2,348.4c29.2-35.6,46.8-81.2,46.8-130.9C424,103.5,331.5,11,217.5,11C103.4,11,11,103.5,11,217.5   S103.4,424,217.5,424c49.7,0,95.2-17.5,130.8-46.7L466.1,495c8,8,20.9,8,28.9,0C503,487.1,503,474.1,495,466.2z M217.5,382.9   C126.2,382.9,52,308.7,52,217.5S126.2,52,217.5,52C308.7,52,383,126.3,383,217.5S308.7,382.9,217.5,382.9z"
                        ></path>
                      </svg>
                    </span>

                    <input
                      class="st-search-input"
                      name="st"
                      autocomplete="off"
                      placeholder="Search"
                    />

                    <span class="input-close-btn" style="display: none">
                      <svg
                        height="12px"
                        style="enable-background: new 0 0 512.001 512.001"
                        viewBox="0 0 512.001 512.001"
                        width="12px"
                        x="0px"
                        xml:space="preserve"
                        y="0px"
                      >
                        <path
                          class="active-path"
                          d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717 L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859 c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287 l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285 L284.286,256.002z"
                          data-old_color="#000000"
                          data-original="#000000"
                          fill="#4E3830"
                        ></path>
                      </svg>
                    </span>
                  </div>
                </div>
                <style>
                  @media (max-width: 769px) {
                    .st-search-box-desktop {
                      display: none !important;
                    }
                  }
                  .st-search-box-desktop {
                    position: relative;
                    display: none;
                  }
                  .st-search-box-desktop input.st-search-input {
                    width: 100%;
                    border: none;
                    border-bottom: 1px solid #999;
                    height: 25px;
                    padding: 0 30px;
                    outline: none;
                    /*     padding-right: 20px;
    padding-left: 10px; */
                  }
                  .st-search-box-desktop span.st-icon-search {
                    position: absolute;
                    margin-top: 2px;
                    margin-left: 4px;
                  }
                  .st-search-box-desktop span.input-close-btn {
                    position: absolute;
                    right: 5px;
                    /*top: 150px;*/
                    cursor: pointer;
                    margin-top: -25px;
                    display: none;
                  }
                  .st-search-box-desktop span.input-close-btn svg {
                    width: 12px;
                    height: 12px;
                  }

                  @media (min-width: 1200px) {
                    .header__icons {
                      justify-self: left;
                    }
                    .st-search-autocomplete-desktop.site-nav__link {
                      margin-left: -70px;
                    }
                  }

                  /*@media (min-width: 767px) {
  .st-search-box-desktop span.input-close-btn {
  right: 82px;
  }
  }
  @media (min-width: 800px) {
  .st-search-bar span.input-close-btn {
  right: 22px;
  }
  }*/
                </style>
                <a
                  href="login.php"
                  class="header__icon-wrapper tap-area hidden-phone hidden-desk"
                  aria-label="Login"
                  ><svg
                    focusable="false"
                    width="18"
                    height="17"
                    class="icon icon--header-customer"
                    viewBox="0 0 18 17"
                  >
                    <circle
                      cx="9"
                      cy="5"
                      r="4"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linejoin="round"
                    ></circle>
                    <path
                      d="M1 17v0a4 4 0 014-4h8a4 4 0 014 4v0"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                    ></path></svg></a
                ><a
                  href="/cart"
                  is="toggle-link"
                  aria-controls="mini-cart"
                  aria-expanded="false"
                  class="header__icon-wrapper tap-area hidden-desk"
                  aria-label="Cart"
                  data-no-instant
                  ><svg
                    focusable="false"
                    width="21"
                    height="20"
                    class="icon icon--header-shopping-cart"
                    viewBox="0 0 21 20"
                  >
                    <path
                      d="M0 1H4L5 11H17L19 4H8"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                    ></path>
                    <circle
                      cx="6"
                      cy="17"
                      r="2"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                    ></circle>
                    <circle
                      cx="16"
                      cy="17"
                      r="2"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                    ></circle></svg
                  ><cart-count
                    class="header__cart-count header__cart-count--floating bubble-count"
                    >0</cart-count
                  >
                </a>
              </div>
              <ul
                class="header__linklist list--unstyled hidden-pocket hidden-lap"
                role="list"
              >
                <li class="header__linklist-item"></li>
                <li class="header__linklist-item">
                  <a href="login.php">Login </a>
                </li>
                <li class="header__linklist-item">
                  <a href="account.php">My Account </a>
                </li>
                <li class="header__linklist-item">
                  <a
                    href="/cart"
                    is="toggle-link"
                    aria-controls="mini-cart"
                    aria-expanded="false"
                    data-no-instant
                    >Cart<cart-count class="header__cart-count bubble-count"
                      >0</cart-count
                    >
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="st-mobile-searchbox" style="display: none">
          <div class="st-search-bar-mobile" style="display: block">
            <svg
              aria-hidden="true"
              focusable="false"
              role="presentation"
              width="20px"
              class="icon icon-search"
              viewBox="0 0 37 40"
            >
              <path
                d="M35.6 36l-9.8-9.8c4.1-5.4 3.6-13.2-1.3-18.1-5.4-5.4-14.2-5.4-19.7 0-5.4 5.4-5.4 14.2 0 19.7 2.6 2.6 6.1 4.1 9.8 4.1 3 0 5.9-1 8.3-2.8l9.8 9.8c.4.4.9.6 1.4.6s1-.2 1.4-.6c.9-.9.9-2.1.1-2.9zm-20.9-8.2c-2.6 0-5.1-1-7-2.9-3.9-3.9-3.9-10.1 0-14C9.6 9 12.2 8 14.7 8s5.1 1 7 2.9c3.9 3.9 3.9 10.1 0 14-1.9 1.9-4.4 2.9-7 2.9z"
              ></path>
            </svg>
            <input
              class="st-search-box"
              type="text"
              name="st"
              placeholder="Search..."
              autocapitalize="off"
              autocomplete="off"
              autocorrect="off"
            />
            <span class="input-close-btn" style="display: none">
              <!--     <svg height="12px" style="enable-background:new 0 0 512.001 512.001;" viewBox="0 0 512.001 512.001" width="12px" x="0px" xml:space="preserve" y="0px">
        <path class="active-path" d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717 L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859 c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287 l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285 L284.286,256.002z" data-old_color="#000000" data-original="#000000" fill="#4E3830"></path>
      </svg> -->
            </span>
          </div>
        </div>

        <style>
          .st-search-bar-mobile input {
            padding: 7px 28px 7px 40px;
            outline: 0;
            box-shadow: none;
            width: 100%;
            font-size: 16px;
            min-height: 40px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
          }
          .st-search-bar-mobile {
            width: 96%;
            /*max-width: 300px;*/
            margin: 0px auto 10px;
            display: none;
            position: relative;
          }
          .st-search-bar-mobile svg.icon-search {
            height: 40px;
            width: 20px;
            margin-left: 10px;
            position: absolute;
          }

          .st-search-bar-mobile .input-close-btn {
            width: 20px;
            height: 25px !important;
            display: block;
            cursor: pointer;
            background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MTIiIGhlaWdodD0iNjEyIj48cGF0aCBkPSJNNjEyIDM2LjAwNEw1NzYuNTIxLjYwMyAzMDYgMjcwLjYwOCAzNS40NzguNjAzIDAgMzYuMDA0bDI3MC41MjIgMjcwLjAwN0wwIDU3NS45OTdsMzUuNDc4IDM1LjRMMzA2IDM0MS40MTFsMjcwLjUyMSAyNjkuOTg2IDM1LjQ3OS0zNS40LTI3MC41NDEtMjY5Ljk4NnoiLz48L3N2Zz4=) !important;
            background-position-y: center !important;
            background-position-x: center;
            background-repeat: no-repeat !important;
            background-size: 11px !important;
            position: absolute;
            right: 10px;
            /*     margin-right: 32px; */
            margin-top: -43px;
            /*     color: #141414; */
          }

          @media screen and (min-width: 1380px) and (max-width: 1480px) {
            .st-search-bar-mobile {
              margin-right: -10px;
              /*max-width: 230px;*/
            }
          }
          @media screen and (max-width: 1380px) and (min-width: 1300px) {
            .st-search-bar-mobile {
              margin-right: -10px;
              /*max-width: 210px;*/
            }
          }
          @media screen and (min-width: 768px) {
            .st-mobile-searchbox {
              display: none !important;
            }
          }

          @media screen and (max-width: 767px) {
            body {
              padding-top: unset !important;
            }
            header.site-header {
              position: unset;
            }
            .st-desktop-searchbox {
              display: none !important;
            }
            .st-search-bar-mobile.hidden-desktop {
              width: 100%;
              max-width: 100%;
            }
          }
        </style> </store-header
      ><cart-notification
        global
        hidden
        class="cart-notification"
      ></cart-notification
      ><mobile-navigation
        append-body
        id="mobile-menu-drawer"
        class="drawer drawer--from-left"
      >
        <span class="drawer__overlay"></span>

        <div class="drawer__header drawer__header--shadowed">
          <button
            type="button"
            class="drawer__close-button drawer__close-button--block tap-area"
            data-action="close"
            title="Close"
          >
            <svg
              focusable="false"
              width="14"
              height="14"
              class="icon icon--close"
              viewBox="0 0 14 14"
            >
              <path
                d="M13 13L1 1M13 1L1 13"
                stroke="currentColor"
                stroke-width="2"
                fill="none"
              ></path>
            </svg>
          </button>
        </div>

        <div class="drawer__content">
          <ul class="mobile-nav list--unstyled" role="list">
            <li class="mobile-nav__item" data-level="1">
              <button
                is="toggle-button"
                class="mobile-nav__link heading h5"
                aria-controls="mobile-menu-1"
                aria-expanded="false"
              >
                Collections<span class="animated-plus"></span>
              </button>
              <a href="/collections">Collections</a>

              <collapsible-content id="mobile-menu-1" class="collapsible"
                ><ul class="mobile-nav list--unstyled" role="list">
                  <li class="mobile-nav__item" data-level="2">
                    <a href="/collections/new-arrival" class="mobile-nav__link"
                      >New Arrivals</a
                    >
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <a href="/collections/handbags" class="mobile-nav__link"
                      >Handbags</a
                    >
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-1-3"
                      aria-expanded="false"
                    >
                      Jewellery<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/jewellery">Jewellery</a>
                    <collapsible-content
                      id="mobile-menu-1-3"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/earrings"
                            class="mobile-nav__link"
                            >Earrings</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/necklace"
                            class="mobile-nav__link"
                            >Necklace</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a href="/collections/rings" class="mobile-nav__link"
                            >Rings</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/bracelet"
                            class="mobile-nav__link"
                            >Bracelet</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/maang-tika"
                            class="mobile-nav__link"
                            >Maang Tika</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <a href="/collections/bedsheet" class="mobile-nav__link"
                      >Bedsheets</a
                    >
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <a
                      href="/collections/aariya-designs"
                      class="mobile-nav__link"
                      >Exclusive</a
                    >
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <a href="/collections/combo-packs" class="mobile-nav__link"
                      >Combo Packs</a
                    >
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <a
                      href="/collections/mens-kurta-pyjama"
                      class="mobile-nav__link"
                      >Mens Kurta Pyjama</a
                    >
                  </li>
                </ul></collapsible-content
              >
            </li>
            <li class="mobile-nav__item" data-level="1">
              <button
                is="toggle-button"
                class="mobile-nav__link heading h5"
                aria-controls="mobile-menu-2"
                aria-expanded="false"
              >
                Sarees<span class="animated-plus"></span>
              </button>
              <a href="/collections/sarees">Sarees</a>

              <collapsible-content id="mobile-menu-2" class="collapsible"
                ><ul class="mobile-nav list--unstyled" role="list">
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-2-1"
                      aria-expanded="false"
                    >
                      Fabric<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/sarees">Fabric</a>
                    <collapsible-content
                      id="mobile-menu-2-1"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/cotton-sarees"
                            class="mobile-nav__link"
                            >Cotton Sarees</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/art-silk-saree"
                            class="mobile-nav__link"
                            >Art Silk Sarees</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/chiffon-sarees"
                            class="mobile-nav__link"
                            >Chiffon Sarees</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/georgette-saree"
                            class="mobile-nav__link"
                            >Georgette Sarees</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/crepe-sarees"
                            class="mobile-nav__link"
                            >Crepe Sarees</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/organza-saree"
                            class="mobile-nav__link"
                            >Organza Sarees</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/chanderi"
                            class="mobile-nav__link"
                            >Chanderi Silk</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/bhagalpuri-silk"
                            class="mobile-nav__link"
                            >Bhagalpuri Silk</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/satin-saree"
                            class="mobile-nav__link"
                            >Satin Sarees</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/linen-sarees"
                            class="mobile-nav__link"
                            >Linen Sarees</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/net-sarees"
                            class="mobile-nav__link"
                            >Net Sarees</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/kanjivaram-silk-saree"
                            class="mobile-nav__link"
                            >Kanjivaram</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/banarasi-silk"
                            class="mobile-nav__link"
                            >Banarasi Silk</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-2-2"
                      aria-expanded="false"
                    >
                      Print/Pattern<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/sarees">Print/Pattern</a>
                    <collapsible-content
                      id="mobile-menu-2-2"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/floral-sarees"
                            class="mobile-nav__link"
                            >Floral Print</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/bandhani-saree"
                            class="mobile-nav__link"
                            >Bandhani Sarees</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/embroidered-saree"
                            class="mobile-nav__link"
                            >Embroidered</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/paithani-saree"
                            class="mobile-nav__link"
                            >Paithani</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/lucknowi-chickankari-sarees"
                            class="mobile-nav__link"
                            >Lucknowi / Chickankari</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/patola-saree"
                            class="mobile-nav__link"
                            >Patola</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-2-3"
                      aria-expanded="false"
                    >
                      Collection<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/sarees">Collection</a>
                    <collapsible-content
                      id="mobile-menu-2-3"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/half-half-saree"
                            class="mobile-nav__link"
                            >Half N Half Saree</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/authentic-drapes-sarees"
                            class="mobile-nav__link"
                            >Authentic Drapes</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/bollywood"
                            class="mobile-nav__link"
                            >Bollywood</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-2-4"
                      aria-expanded="false"
                    >
                      Price<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/sarees">Price</a>
                    <collapsible-content
                      id="mobile-menu-2-4"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/saree?filter.v.price.gte=&filter.v.price.lte=999"
                            class="mobile-nav__link"
                            >0-999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/sarees?filter.v.price.gte=1000&filter.v.price.lte=1999"
                            class="mobile-nav__link"
                            >1000-1999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/sarees?filter.v.price.gte=2000&filter.v.price.lte=2999"
                            class="mobile-nav__link"
                            >2000-2999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/sarees?filter.v.price.gte=3000&filter.v.price.lte=3999"
                            class="mobile-nav__link"
                            >3000-3999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/sarees?filter.v.price.gte=4000&filter.v.price.lte=4999"
                            class="mobile-nav__link"
                            >4000-4999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/sarees?filter.v.price.gte=5000&filter.v.price.lte="
                            class="mobile-nav__link"
                            >5000 & above</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-2-5"
                      aria-expanded="false"
                    >
                      Occasion<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/sarees">Occasion</a>
                    <collapsible-content
                      id="mobile-menu-2-5"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/bridal-saree"
                            class="mobile-nav__link"
                            >Bridal</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/casual-sarees"
                            class="mobile-nav__link"
                            >Casual / Daily</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/engagement-sarees"
                            class="mobile-nav__link"
                            >Engagement</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/festive-wear-sarees"
                            class="mobile-nav__link"
                            >Festive</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/haldi-sarees"
                            class="mobile-nav__link"
                            >Haldi</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/mehendi-sarees"
                            class="mobile-nav__link"
                            >Mehendi</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/office-wear-sarees"
                            class="mobile-nav__link"
                            >Office wear</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/partywear-sarees"
                            class="mobile-nav__link"
                            >Party
                          </a>
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/reception-sarees"
                            class="mobile-nav__link"
                            >Reception</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/sangeet-sarees"
                            class="mobile-nav__link"
                            >Sangeet</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/wedding-wear-saree"
                            class="mobile-nav__link"
                            >Wedding
                          </a>
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-2-6"
                      aria-expanded="false"
                    >
                      Color<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/sarees">Color</a>
                    <collapsible-content
                      id="mobile-menu-2-6"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/red-saree"
                            class="mobile-nav__link"
                            >Red</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/pink-saree"
                            class="mobile-nav__link"
                            >Pink</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/white-saree"
                            class="mobile-nav__link"
                            >White</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/black-saree"
                            class="mobile-nav__link"
                            >Black</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/orange-saree"
                            class="mobile-nav__link"
                            >Orange</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/blue-saree"
                            class="mobile-nav__link"
                            >Blue</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/purple-saree"
                            class="mobile-nav__link"
                            >Purple</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/yellow-saree"
                            class="mobile-nav__link"
                            >Yellow</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/brown-saree"
                            class="mobile-nav__link"
                            >Brown</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/grey-saree"
                            class="mobile-nav__link"
                            >Grey</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/green-saree"
                            class="mobile-nav__link"
                            >Green</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/multicolor-saree"
                            class="mobile-nav__link"
                            >Multicolor</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                </ul>
                <div class="mobile-nav__images-wrapper hide-scrollbar">
                  <div class="mobile-nav__images-scroller">
                    <div class="mobile-nav__image-push">
                      <img loading="lazy" class="mobile-nav__image"
                      sizes="270px" height="459" width="277" alt=""
                      src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/Banner-10.jpg?v=1651132381"
                      ">
                    </div>
                  </div>
                </div></collapsible-content
              >
            </li>
            <li class="mobile-nav__item" data-level="1">
              <button
                is="toggle-button"
                class="mobile-nav__link heading h5"
                aria-controls="mobile-menu-3"
                aria-expanded="false"
              >
                Salwar Suits<span class="animated-plus"></span>
              </button>
              <a href="/collections/suits">Salwar Suits</a>

              <collapsible-content id="mobile-menu-3" class="collapsible"
                ><ul class="mobile-nav list--unstyled" role="list">
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-3-1"
                      aria-expanded="false"
                    >
                      Fabric<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/suits">Fabric</a>
                    <collapsible-content
                      id="mobile-menu-3-1"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/rayon-suits"
                            class="mobile-nav__link"
                            >Rayon</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/cotton-salwar-suit"
                            class="mobile-nav__link"
                            >Cotton</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/georgette-suits"
                            class="mobile-nav__link"
                            >Georgette</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/crepe-suits"
                            class="mobile-nav__link"
                            >Crepe</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/chiffon-suits"
                            class="mobile-nav__link"
                            >Chiffon</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/organza-suits"
                            class="mobile-nav__link"
                            >Organza</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/bhagalpuri-silk-suits"
                            class="mobile-nav__link"
                            >Bhagalpuri Silk</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/banarasi-suits"
                            class="mobile-nav__link"
                            >Banarasi</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/chanderi-silk-salwar-suit"
                            class="mobile-nav__link"
                            >Chanderi</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/jacquard-suits"
                            class="mobile-nav__link"
                            >Jacquard</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/tapetta-silk-suits"
                            class="mobile-nav__link"
                            >Tapetta Silk</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/tussar-silk-suits"
                            class="mobile-nav__link"
                            >Tussar Silk</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/net-suits"
                            class="mobile-nav__link"
                            >Net</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-3-2"
                      aria-expanded="false"
                    >
                      Style<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/suits">Style</a>
                    <collapsible-content
                      id="mobile-menu-3-2"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/sharara-suits"
                            class="mobile-nav__link"
                            >Sharara Suits</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/anarkali-suit"
                            class="mobile-nav__link"
                            >Anarkali Suits</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/palazzo-suits"
                            class="mobile-nav__link"
                            >Palazzo Suits</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/patiala-suits"
                            class="mobile-nav__link"
                            >Patiala Suits</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/pakistani-suits"
                            class="mobile-nav__link"
                            >Pakistani Suits</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/straight-cut-suits"
                            class="mobile-nav__link"
                            >Straight Cut Suits</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/indo-western"
                            class="mobile-nav__link"
                            >Indo western</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-3-3"
                      aria-expanded="false"
                    >
                      Stitch Type<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/suits">Stitch Type</a>
                    <collapsible-content
                      id="mobile-menu-3-3"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/unstitched-salwar-suits"
                            class="mobile-nav__link"
                            >Unstitched Salwar suits</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/readymade-salwar-suits"
                            class="mobile-nav__link"
                            >Readymade Salwar suits</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/semi-stitched-suits"
                            class="mobile-nav__link"
                            >Semi Stitched</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-3-4"
                      aria-expanded="false"
                    >
                      Price<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/suits">Price</a>
                    <collapsible-content
                      id="mobile-menu-3-4"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/suits?filter.v.price.gte=&filter.v.price.lte=999"
                            class="mobile-nav__link"
                            >0-999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/suits?filter.v.price.gte=1000&filter.v.price.lte=1999"
                            class="mobile-nav__link"
                            >1000-1999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/suits?filter.v.price.gte=2000&filter.v.price.lte=2999"
                            class="mobile-nav__link"
                            >2000-2999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/suits?filter.v.price.gte=3000&filter.v.price.lte="
                            class="mobile-nav__link"
                            >3000 & above</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-3-5"
                      aria-expanded="false"
                    >
                      Occasion<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/suits">Occasion</a>
                    <collapsible-content
                      id="mobile-menu-3-5"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/bridal-suits"
                            class="mobile-nav__link"
                            >Bridal</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/casual-suits-dress-material"
                            class="mobile-nav__link"
                            >Casual / Daily</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/engagement-suits"
                            class="mobile-nav__link"
                            >Engagement</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/festive-suits"
                            class="mobile-nav__link"
                            >Festive</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/haldi-suits"
                            class="mobile-nav__link"
                            >Haldi</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/mehendi-suits"
                            class="mobile-nav__link"
                            >Mehendi</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/office-wear-suits"
                            class="mobile-nav__link"
                            >Office wear</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/party-wear-suits"
                            class="mobile-nav__link"
                            >Party
                          </a>
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/reception-suits"
                            class="mobile-nav__link"
                            >Reception</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/sangeet-suits"
                            class="mobile-nav__link"
                            >Sangeet</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/wedding-suits"
                            class="mobile-nav__link"
                            >Wedding
                          </a>
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-3-6"
                      aria-expanded="false"
                    >
                      Color<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/suits">Color</a>
                    <collapsible-content
                      id="mobile-menu-3-6"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/red-salwar-suit"
                            class="mobile-nav__link"
                            >Red</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/pink-suits"
                            class="mobile-nav__link"
                            >Pink</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/white-suits"
                            class="mobile-nav__link"
                            >White</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/black-suits"
                            class="mobile-nav__link"
                            >Black</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/orange-suits"
                            class="mobile-nav__link"
                            >Orange</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/blue-suits"
                            class="mobile-nav__link"
                            >Blue</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/purple-suits"
                            class="mobile-nav__link"
                            >Purple</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/yellow-suits"
                            class="mobile-nav__link"
                            >Yellow</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/brown-suits"
                            class="mobile-nav__link"
                            >Brown</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/grey-suits"
                            class="mobile-nav__link"
                            >Grey</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/green-suits"
                            class="mobile-nav__link"
                            >Green</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/multicolor-suits"
                            class="mobile-nav__link"
                            >Multicolor</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                </ul>
                <div class="mobile-nav__images-wrapper hide-scrollbar">
                  <div class="mobile-nav__images-scroller">
                    <div class="mobile-nav__image-push">
                      <img loading="lazy" class="mobile-nav__image"
                      sizes="270px" height="646" width="380" alt=""
                      src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/Banner-6.jpg?v=1651132202"
                      ">
                    </div>
                  </div>
                </div></collapsible-content
              >
            </li>
            <li class="mobile-nav__item" data-level="1">
              <button
                is="toggle-button"
                class="mobile-nav__link heading h5"
                aria-controls="mobile-menu-4"
                aria-expanded="false"
              >
                Kurtis<span class="animated-plus"></span>
              </button>
              <a href="/collections/kurti">Kurtis</a>

              <collapsible-content id="mobile-menu-4" class="collapsible"
                ><ul class="mobile-nav list--unstyled" role="list">
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-4-1"
                      aria-expanded="false"
                    >
                      Fabric<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/cotton-kurties">Fabric</a>
                    <collapsible-content
                      id="mobile-menu-4-1"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/silk-kurti"
                            class="mobile-nav__link"
                            >Silk</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/rayon-kurti"
                            class="mobile-nav__link"
                            >Rayon</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/cotton-kurti"
                            class="mobile-nav__link"
                            >Cotton</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/georgette-kurti"
                            class="mobile-nav__link"
                            >Georgette</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/crepe-kurti"
                            class="mobile-nav__link"
                            >Crepe</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/chiffon-kurti"
                            class="mobile-nav__link"
                            >Chiffon</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/chanderi-cotton-kurtis"
                            class="mobile-nav__link"
                            >Chanderi Cotton</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/jacquard-kurti"
                            class="mobile-nav__link"
                            >Jacquard</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/linen-kurti"
                            class="mobile-nav__link"
                            >Linen</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/muslin-kurtis"
                            class="mobile-nav__link"
                            >Muslin</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-4-2"
                      aria-expanded="false"
                    >
                      Print/Pattern<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/cotton-kurties">Print/Pattern</a>
                    <collapsible-content
                      id="mobile-menu-4-2"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/floral-print-kurti"
                            class="mobile-nav__link"
                            >Floral print</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/solid-kurti"
                            class="mobile-nav__link"
                            >Solid</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/bandhani-kurti"
                            class="mobile-nav__link"
                            >Bandhani</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/printed-kurtis"
                            class="mobile-nav__link"
                            >Printed</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/embroidered-kurtis"
                            class="mobile-nav__link"
                            >Embroidered</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/anarkali-kurtis"
                            class="mobile-nav__link"
                            >Anarkali</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/a-line-kurtis"
                            class="mobile-nav__link"
                            >A-Line</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/straight-kurtis"
                            class="mobile-nav__link"
                            >Straight</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/short-kurtis"
                            class="mobile-nav__link"
                            >Short
                          </a>
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/long-kurtis"
                            class="mobile-nav__link"
                            >Long</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/high-low-kurtis"
                            class="mobile-nav__link"
                            >High Low</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-4-3"
                      aria-expanded="false"
                    >
                      Product Type<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/cotton-kurties">Product Type</a>
                    <collapsible-content
                      id="mobile-menu-4-3"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/kurti-pant-sets"
                            class="mobile-nav__link"
                            >Kurti Pant Set</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/kurti-palazzo-sets"
                            class="mobile-nav__link"
                            >Kurti Palazzo Set</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/kurti-dhoti-set"
                            class="mobile-nav__link"
                            >Kurti Dhoti Set</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/kurti-skirt-set"
                            class="mobile-nav__link"
                            >Kurti Skirt Set</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/palazzo-suit"
                            class="mobile-nav__link"
                            >Palazzo Suit</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/top-bottom-set"
                            class="mobile-nav__link"
                            >Top Bottom Set</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a href="/collections/kurti" class="mobile-nav__link"
                            >Kurti</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a href="/collections/kaftan" class="mobile-nav__link"
                            >Kaftan</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/kaftan-set"
                            class="mobile-nav__link"
                            >Kaftan Set</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-4-4"
                      aria-expanded="false"
                    >
                      Occasion<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/cotton-kurties">Occasion</a>
                    <collapsible-content
                      id="mobile-menu-4-4"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/casual-kurtis"
                            class="mobile-nav__link"
                            >Casual / Daily</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/festive-kurtis"
                            class="mobile-nav__link"
                            >Festive</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/office-wear-kurtis"
                            class="mobile-nav__link"
                            >Office wear</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/party-kurtis"
                            class="mobile-nav__link"
                            >Party
                          </a>
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-4-5"
                      aria-expanded="false"
                    >
                      Price<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/cotton-kurties">Price</a>
                    <collapsible-content
                      id="mobile-menu-4-5"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/cotton-kurties?filter.v.price.gte=&filter.v.price.lte=999"
                            class="mobile-nav__link"
                            >0-999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/cotton-kurties?filter.v.price.gte=1000&filter.v.price.lte=1999"
                            class="mobile-nav__link"
                            >1000-1999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/cotton-kurties?filter.v.price.gte=2000&filter.v.price.lte="
                            class="mobile-nav__link"
                            >2000 & above</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-4-6"
                      aria-expanded="false"
                    >
                      Color<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/cotton-kurties">Color</a>
                    <collapsible-content
                      id="mobile-menu-4-6"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/red-kurti"
                            class="mobile-nav__link"
                            >Red</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/pink-kurti"
                            class="mobile-nav__link"
                            >Pink</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/white-kurti"
                            class="mobile-nav__link"
                            >White</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/black-kurti"
                            class="mobile-nav__link"
                            >Black</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/orange-kurti"
                            class="mobile-nav__link"
                            >Orange</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/blue-kurti"
                            class="mobile-nav__link"
                            >Blue</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/purple-kurti"
                            class="mobile-nav__link"
                            >Purple</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/yellow-kurti"
                            class="mobile-nav__link"
                            >Yellow</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/brown-kurti"
                            class="mobile-nav__link"
                            >Brown</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/grey-kurti"
                            class="mobile-nav__link"
                            >Grey</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/green-kurti"
                            class="mobile-nav__link"
                            >Green</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/multicolor-kurti"
                            class="mobile-nav__link"
                            >Multicolor</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                </ul>
                <div class="mobile-nav__images-wrapper hide-scrollbar">
                  <div class="mobile-nav__images-scroller">
                    <div class="mobile-nav__image-push">
                      <img loading="lazy" class="mobile-nav__image"
                      sizes="270px" height="459" width="277" alt=""
                      src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/Banner-9.jpg?v=1651132362"
                      ">
                    </div>
                  </div>
                </div></collapsible-content
              >
            </li>
            <li class="mobile-nav__item" data-level="1">
              <button
                is="toggle-button"
                class="mobile-nav__link heading h5"
                aria-controls="mobile-menu-5"
                aria-expanded="false"
              >
                Lehengas<span class="animated-plus"></span>
              </button>
              <a href="/collections/lehengas">Lehengas</a>

              <collapsible-content id="mobile-menu-5" class="collapsible"
                ><ul class="mobile-nav list--unstyled" role="list">
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-5-1"
                      aria-expanded="false"
                    >
                      Fabric<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/lehengas">Fabric</a>
                    <collapsible-content
                      id="mobile-menu-5-1"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/art-silk-lehenga"
                            class="mobile-nav__link"
                            >Art Silk</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/banarasi-silk-lehenga"
                            class="mobile-nav__link"
                            >Banarasi Silk</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/cotton-lehenga"
                            class="mobile-nav__link"
                            >Cotton</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/georgette-lehenga"
                            class="mobile-nav__link"
                            >Georgette</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/jacquard-lehenga"
                            class="mobile-nav__link"
                            >Jacquard</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/organza-lehengas"
                            class="mobile-nav__link"
                            >Organza</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/satin-lehengas"
                            class="mobile-nav__link"
                            >Satin</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/silk-lehenga"
                            class="mobile-nav__link"
                            >Silk</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/velvet-lehenga"
                            class="mobile-nav__link"
                            >Velvet</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-5-2"
                      aria-expanded="false"
                    >
                      Pattern<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/lehengas">Pattern</a>
                    <collapsible-content
                      id="mobile-menu-5-2"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/designer-lehenga"
                            class="mobile-nav__link"
                            >Designer</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/digital-lehengas"
                            class="mobile-nav__link"
                            >Digital</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/floral-lehenga"
                            class="mobile-nav__link"
                            >Floral</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-5-3"
                      aria-expanded="false"
                    >
                      Price<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/lehengas">Price</a>
                    <collapsible-content
                      id="mobile-menu-5-3"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/lehenga?filter.v.price.gte=&filter.v.price.lte=999"
                            class="mobile-nav__link"
                            >0-999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/lehenga?filter.v.price.gte=1000&filter.v.price.lte=1999"
                            class="mobile-nav__link"
                            >1000-1999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/lehenga?filter.v.price.gte=2000&filter.v.price.lte=2999"
                            class="mobile-nav__link"
                            >2000-2999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/lehenga?filter.v.price.gte=3000&filter.v.price.lte=3999"
                            class="mobile-nav__link"
                            >3000-3999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/lehenga?filter.v.price.gte=4000&filter.v.price.lte=4999"
                            class="mobile-nav__link"
                            >4000-4999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/lehenga?filter.v.price.gte=5000&filter.v.price.lte="
                            class="mobile-nav__link"
                            >5000 & above</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-5-4"
                      aria-expanded="false"
                    >
                      Occasion<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/lehengas">Occasion</a>
                    <collapsible-content
                      id="mobile-menu-5-4"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/bridal-lehengas"
                            class="mobile-nav__link"
                            >Bridal</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/engagement-lehengas"
                            class="mobile-nav__link"
                            >Engagement</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/festive-lehenga"
                            class="mobile-nav__link"
                            >Festive</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/haldi-lehengas"
                            class="mobile-nav__link"
                            >Haldi</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/mehendi-lehengas"
                            class="mobile-nav__link"
                            >Mehendi</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/party-lehengas"
                            class="mobile-nav__link"
                            >Party
                          </a>
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/reception-lehengas"
                            class="mobile-nav__link"
                            >Reception</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/sangeet-lehengas"
                            class="mobile-nav__link"
                            >Sangeet</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/wedding-lehenga"
                            class="mobile-nav__link"
                            >Wedding
                          </a>
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-5-5"
                      aria-expanded="false"
                    >
                      Color<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/lehengas">Color</a>
                    <collapsible-content
                      id="mobile-menu-5-5"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/red-lehenga"
                            class="mobile-nav__link"
                            >Red</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/pink-lehenga"
                            class="mobile-nav__link"
                            >Pink</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/white-lehenga"
                            class="mobile-nav__link"
                            >White</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/black-lehenga"
                            class="mobile-nav__link"
                            >Black</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/orange-lehenga"
                            class="mobile-nav__link"
                            >Orange</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/blue-lehenga"
                            class="mobile-nav__link"
                            >Blue</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/purple-lehenga"
                            class="mobile-nav__link"
                            >Purple</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/yellow-lehenga"
                            class="mobile-nav__link"
                            >Yellow</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/gold-lehenga"
                            class="mobile-nav__link"
                            >Gold</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/grey-lehenga"
                            class="mobile-nav__link"
                            >Grey</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/green-lehenga"
                            class="mobile-nav__link"
                            >Green</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/multicolor-lehenga"
                            class="mobile-nav__link"
                            >Multicolor</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-5-6"
                      aria-expanded="false"
                    >
                      Style<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/lehengas">Style</a>
                    <collapsible-content
                      id="mobile-menu-5-6"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/ready-to-wear-lehengas"
                            class="mobile-nav__link"
                            >Ready to wear</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/unstiched-lehengas"
                            class="mobile-nav__link"
                            >Unstiched</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/semi-stitched-lehengas"
                            class="mobile-nav__link"
                            >Semi stitched</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                </ul>
                <div class="mobile-nav__images-wrapper hide-scrollbar">
                  <div class="mobile-nav__images-scroller">
                    <div class="mobile-nav__image-push">
                      <img loading="lazy" class="mobile-nav__image"
                      sizes="270px" height="459" width="277" alt=""
                      src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/Banner-11.jpg?v=1651132400"
                      ">
                    </div>
                  </div>
                </div></collapsible-content
              >
            </li>
            <li class="mobile-nav__item" data-level="1">
              <button
                is="toggle-button"
                class="mobile-nav__link heading h5"
                aria-controls="mobile-menu-6"
                aria-expanded="false"
              >
                Gowns<span class="animated-plus"></span>
              </button>
              <a href="/collections/gowns">Gowns</a>

              <collapsible-content id="mobile-menu-6" class="collapsible"
                ><ul class="mobile-nav list--unstyled" role="list">
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-6-1"
                      aria-expanded="false"
                    >
                      Fabric<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/gowns">Fabric</a>
                    <collapsible-content
                      id="mobile-menu-6-1"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/cotton-gowns"
                            class="mobile-nav__link"
                            >Cotton</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/satin-gowns"
                            class="mobile-nav__link"
                            >Satin</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/chanderi-gowns"
                            class="mobile-nav__link"
                            >Chanderi</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/georgette-gowns"
                            class="mobile-nav__link"
                            >Georgette</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/jacquard-gowns"
                            class="mobile-nav__link"
                            >Jacquard</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/net-gowns"
                            class="mobile-nav__link"
                            >Net</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/rayon-gowns"
                            class="mobile-nav__link"
                            >Rayon</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/silk-gowns"
                            class="mobile-nav__link"
                            >Silk</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/tapetta-silk-gowns"
                            class="mobile-nav__link"
                            >Tapetta Silk</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-6-2"
                      aria-expanded="false"
                    >
                      Occasion<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/gowns">Occasion</a>
                    <collapsible-content
                      id="mobile-menu-6-2"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/bridal-gowns"
                            class="mobile-nav__link"
                            >Bridal</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/engagement-gowns"
                            class="mobile-nav__link"
                            >Engagement</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/festive-gowns"
                            class="mobile-nav__link"
                            >Festive</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/haldi-gowns"
                            class="mobile-nav__link"
                            >Haldi</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/mehendi-gowns"
                            class="mobile-nav__link"
                            >Mehendi</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/party-gowns"
                            class="mobile-nav__link"
                            >Party
                          </a>
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/reception-gowns"
                            class="mobile-nav__link"
                            >Reception</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/sangeet-gowns"
                            class="mobile-nav__link"
                            >Sangeet</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/wedding-gowns"
                            class="mobile-nav__link"
                            >Wedding
                          </a>
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-6-3"
                      aria-expanded="false"
                    >
                      Price<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/gowns">Price</a>
                    <collapsible-content
                      id="mobile-menu-6-3"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/gowns?filter.v.price.gte=&filter.v.price.lte=999"
                            class="mobile-nav__link"
                            >0-999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/gowns?filter.v.price.gte=1000&filter.v.price.lte=1999"
                            class="mobile-nav__link"
                            >1000-1999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/gowns?filter.v.price.gte=2000&filter.v.price.lte=2999"
                            class="mobile-nav__link"
                            >2000-2999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/gowns?filter.v.price.gte=3000&filter.v.price.lte=3999"
                            class="mobile-nav__link"
                            >3000-3999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/gowns?filter.v.price.gte=4000&filter.v.price.lte=4999"
                            class="mobile-nav__link"
                            >4000-4999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/gowns?filter.v.price.gte=5000&filter.v.price.lte="
                            class="mobile-nav__link"
                            >5000 & above</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-6-4"
                      aria-expanded="false"
                    >
                      Color<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/gowns">Color</a>
                    <collapsible-content
                      id="mobile-menu-6-4"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/red-gowns"
                            class="mobile-nav__link"
                            >Red</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/pink-gowns"
                            class="mobile-nav__link"
                            >Pink</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/black-gowns"
                            class="mobile-nav__link"
                            >Black</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/orange-gowns"
                            class="mobile-nav__link"
                            >Orange</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/blue-gowns"
                            class="mobile-nav__link"
                            >Blue</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/purple-gowns"
                            class="mobile-nav__link"
                            >Purple</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/yellow-gowns"
                            class="mobile-nav__link"
                            >Yellow</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/brown-gowns"
                            class="mobile-nav__link"
                            >Brown</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/grey-gowns"
                            class="mobile-nav__link"
                            >Grey</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/green-gowns"
                            class="mobile-nav__link"
                            >Green</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/multicolor-gowns"
                            class="mobile-nav__link"
                            >Multicolor</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                </ul></collapsible-content
              >
            </li>
            <li class="mobile-nav__item" data-level="1">
              <button
                is="toggle-button"
                class="mobile-nav__link heading h5"
                aria-controls="mobile-menu-7"
                aria-expanded="false"
              >
                Western<span class="animated-plus"></span>
              </button>
              <a href="/collections/western">Western</a>

              <collapsible-content id="mobile-menu-7" class="collapsible"
                ><ul class="mobile-nav list--unstyled" role="list">
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-7-1"
                      aria-expanded="false"
                    >
                      Fabric<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/western">Fabric</a>
                    <collapsible-content
                      id="mobile-menu-7-1"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/rayon-western"
                            class="mobile-nav__link"
                            >Rayon</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/cotton-western"
                            class="mobile-nav__link"
                            >Cotton</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/georgette-western"
                            class="mobile-nav__link"
                            >Georgette</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/chiffon-western"
                            class="mobile-nav__link"
                            >Chiffon</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/crepe-western"
                            class="mobile-nav__link"
                            >Crepe</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-7-2"
                      aria-expanded="false"
                    >
                      Type<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/western">Type</a>
                    <collapsible-content
                      id="mobile-menu-7-2"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a href="/collections/tops" class="mobile-nav__link"
                            >Tops</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a href="/collections/tunics" class="mobile-nav__link"
                            >Tunics</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/dresses"
                            class="mobile-nav__link"
                            >Dresses</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/jumpsuit"
                            class="mobile-nav__link"
                            >Jumpsuit</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-7-3"
                      aria-expanded="false"
                    >
                      Occasion<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/western">Occasion</a>
                    <collapsible-content
                      id="mobile-menu-7-3"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/casual-daily-western"
                            class="mobile-nav__link"
                            >Casual / Daily</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/festive-western"
                            class="mobile-nav__link"
                            >Festive</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/office-wear-western"
                            class="mobile-nav__link"
                            >Office wear</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/party-western"
                            class="mobile-nav__link"
                            >Party
                          </a>
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-7-4"
                      aria-expanded="false"
                    >
                      Price<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/western">Price</a>
                    <collapsible-content
                      id="mobile-menu-7-4"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/western?filter.v.price.gte=&filter.v.price.lte=999"
                            class="mobile-nav__link"
                            >0-999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/western?filter.v.price.gte=1000&filter.v.price.lte=1999"
                            class="mobile-nav__link"
                            >1000-1999</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/western?filter.v.price.gte=2000&filter.v.price.lte="
                            class="mobile-nav__link"
                            >2000 & above</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                  <li class="mobile-nav__item" data-level="2">
                    <button
                      is="toggle-button"
                      class="mobile-nav__link"
                      aria-controls="mobile-menu-7-5"
                      aria-expanded="false"
                    >
                      Color<span class="animated-plus"></span>
                    </button>
                    <a href="/collections/western">Color</a>
                    <collapsible-content
                      id="mobile-menu-7-5"
                      class="collapsible"
                    >
                      <ul class="mobile-nav list--unstyled" role="list">
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/red-western"
                            class="mobile-nav__link"
                            >Red</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/pink-western"
                            class="mobile-nav__link"
                            >Pink</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/white-western"
                            class="mobile-nav__link"
                            >White</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/black-western"
                            class="mobile-nav__link"
                            >Black</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/orange-western"
                            class="mobile-nav__link"
                            >Orange</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/blue-western"
                            class="mobile-nav__link"
                            >Blue</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/purple-western"
                            class="mobile-nav__link"
                            >Purple</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/yellow-western"
                            class="mobile-nav__link"
                            >Yellow</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/brown-western"
                            class="mobile-nav__link"
                            >Brown</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/grey-western"
                            class="mobile-nav__link"
                            >Grey</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/green-western"
                            class="mobile-nav__link"
                            >Green</a
                          >
                        </li>
                        <li class="mobile-nav__item" data-level="3">
                          <a
                            href="/collections/multicolor-western"
                            class="mobile-nav__link"
                            >Multicolor</a
                          >
                        </li>
                      </ul>
                    </collapsible-content>
                  </li>
                </ul></collapsible-content
              >
            </li>
            <li class="mobile-nav__item" data-level="1">
              <a href="/pages/streams" class="mobile-nav__link heading h5"
                >Live</a
              >
            </li>
            <li class="mobile-nav__item" data-level="1">
              <a href="/collections/sale" class="mobile-nav__link heading h5"
                >Sale</a
              >
            </li>
            <li class="mobile-nav__item">
              <a class="mobile-nav__link heading h5" href="/blogs/peachmode"
                >Blog</a
              >
            </li>
            <li class="mobile-nav__item">
              <a class="mobile-nav__link heading h5" href="/pages/franchise"
                >Franchise</a
              >
            </li>
            <li class="mobile-nav__item">
              <a
                class="mobile-nav__link heading h5"
                href="/pages/store-locations"
                >Store Locator</a
              >
            </li>
            <li class="mobile-nav__item">
              <a
                class="mobile-nav__link heading h5"
                href="/pages/track-your-order"
                >Track Order</a
              >
            </li>
            <li class="mobile-nav__item">
              <a class="mobile-nav__link heading h5" href="/pages/contact"
                >Contact Us</a
              >
            </li>
          </ul>
        </div>
        <div
          class="drawer__footer drawer__footer--tight drawer__footer--bordered"
        >
          <div class="mobile-nav__footer">
            <a class="icon-text" href="/account/login"
              ><svg
                focusable="false"
                width="18"
                height="17"
                class="icon icon--header-customer"
                viewBox="0 0 18 17"
              >
                <circle
                  cx="9"
                  cy="5"
                  r="4"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linejoin="round"
                ></circle>
                <path
                  d="M1 17v0a4 4 0 014-4h8a4 4 0 014 4v0"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                ></path></svg
              >Account</a
            >
          </div>
        </div></mobile-navigation
      ><predictive-search-drawer
        append-body
        reverse-breakpoint="screen and (min-width: 1200px)"
        id="search-drawer"
        initial-focus-selector="#search-drawer [name='q']"
        class="predictive-search drawer drawer--large drawer--from-left"
      >
        <span class="drawer__overlay"></span>

        <header class="drawer__header">
          <form
            id="predictive-search-form"
            action="/search"
            method="get"
            class="predictive-search__form"
          >
            <svg
              focusable="false"
              width="18"
              height="18"
              class="icon icon--header-search"
              viewBox="0 0 18 18"
            >
              <path
                d="M12.336 12.336c2.634-2.635 2.682-6.859.106-9.435-2.576-2.576-6.8-2.528-9.435.106C.373 5.642.325 9.866 2.901 12.442c2.576 2.576 6.8 2.528 9.435-.106zm0 0L17 17"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              ></path></svg
            ><input type="hidden" name="type" value="product" />
            <input type="hidden" name="options[prefix]" value="last" />
            <input
              type="hidden"
              form="predictive-search-form"
              name="options[unavailable_products]"
              value="last"
            />
            <input
              class="predictive-search__input"
              type="text"
              name="q"
              autocomplete="off"
              autocorrect="off"
              aria-label="Search"
              placeholder="What are you looking for?"
            />
          </form>

          <button
            type="button"
            class="drawer__close-button tap-area"
            data-action="close"
            title="Close"
          >
            <svg
              focusable="false"
              width="14"
              height="14"
              class="icon icon--close"
              viewBox="0 0 14 14"
            >
              <path
                d="M13 13L1 1M13 1L1 13"
                stroke="currentColor"
                stroke-width="2"
                fill="none"
              ></path>
            </svg>
          </button>
        </header>

        <div class="drawer__content">
          <div class="predictive-search__content-wrapper">
            <div hidden class="predictive-search__loading-state">
              <div class="spinner">
                <svg
                  focusable="false"
                  width="50"
                  height="50"
                  class="icon icon--spinner"
                  viewBox="25 25 50 50"
                >
                  <circle
                    cx="50"
                    cy="50"
                    r="20"
                    fill="none"
                    stroke="#222222"
                    stroke-width="4"
                  ></circle>
                </svg>
              </div>
            </div>

            <div
              hidden
              class="predictive-search__results"
              aria-live="polite"
            ></div>
          </div>
        </div>

        <footer hidden class="drawer__footer drawer__footer--no-top-padding">
          <button
            type="submit"
            form="predictive-search-form"
            class="button button--primary button--full"
          >
            View all results
          </button>
        </footer>
      </predictive-search-drawer>
      <script>
        (() => {
          const headerElement = document.getElementById(
              "shopify-section-header"
            ),
            headerHeight = headerElement.clientHeight,
            headerHeightWithoutBottomNav =
              headerElement.querySelector(".header__wrapper").clientHeight;

          document.documentElement.style.setProperty(
            "--header-height",
            headerHeight + "px"
          );
          document.documentElement.style.setProperty(
            "--header-height-without-bottom-nav",
            headerHeightWithoutBottomNav + "px"
          );
        })();
      </script>

      <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "name": "Peachmode",

          "logo": "https:\/\/cdn.shopify.com\/s\/files\/1\/0637\/4834\/1981\/files\/280x80_d20e9ddd-ae15-43c9-9dc7-142b6b7c30e1_280x.png?v=1676437272",

          "url": "https:\/\/peachmode.com"
        }
      </script>
      <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "WebSite",
          "name": "Peachmode",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "https:\/\/peachmode.com\/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
          },
          "url": "https:\/\/peachmode.com"
        }
      </script>
    </div>
    <div
      id="shopify-section-mini-cart"
      class="shopify-section shopify-section--mini-cart"
    >
      <cart-drawer
        section="mini-cart"
        id="mini-cart"
        class="mini-cart drawer drawer--large"
      >
        <span class="drawer__overlay"></span>

        <header class="drawer__header">
          <p class="drawer__title heading h6">
            <svg
              focusable="false"
              width="21"
              height="20"
              class="icon icon--header-shopping-cart"
              viewBox="0 0 21 20"
            >
              <path
                d="M0 1H4L5 11H17L19 4H8"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              ></path>
              <circle
                cx="6"
                cy="17"
                r="2"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              ></circle>
              <circle
                cx="16"
                cy="17"
                r="2"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              ></circle></svg
            >Cart
          </p>

          <button
            type="button"
            class="drawer__close-button tap-area"
            data-action="close"
            title="Close"
          >
            <svg
              focusable="false"
              width="14"
              height="14"
              class="icon icon--close"
              viewBox="0 0 14 14"
            >
              <path
                d="M13 13L1 1M13 1L1 13"
                stroke="currentColor"
                stroke-width="2"
                fill="none"
              ></path>
            </svg>
          </button>
        </header>
        <div class="drawer__content drawer__content--center">
          <p>Your cart is empty</p>

          <div class="button-wrapper">
            <a href="index.php" class="button button--primary"
              >Start shopping</a
            >
            <a href="cart.php" class="button button--primary">View Cart</a>
          </div>
        </div>
        <openable-element id="mini-cart-note" class="mini-cart__order-note">
          <span class="openable__overlay"></span>
          <label
            for="cart[note]"
            class="mini-cart__order-note-title heading heading--xsmall"
            >Add order note</label
          >
          <textarea
            is="cart-note"
            name="note"
            id="cart[note]"
            rows="3"
            aria-owns="order-note-toggle"
            class="input__field input__field--textarea"
            placeholder="How can we help you?"
          ></textarea>
          <button
            type="button"
            data-action="close"
            class="form__submit form__submit--closer button button--secondary"
          >
            Save
          </button>
        </openable-element></cart-drawer
      >
    </div>
    <div id="main" role="main" class="anchor">
      <div
        id="shopify-section-template--15880464466141__slideshow"
        class="shopify-section shopify-section--slideshow"
      >
        <style>
          #shopify-section-template--15880464466141__slideshow {
            --progress-bar-color: 26, 26, 26;
            --section-autoplay-duration: 5s;
            --section-animation-play-state: paused;
            background-color: #000000; /* Allows to set a placeholder color while loading */
          }
          #block-template--15880464466141__slideshow-d300bc8e-c9c9-4ba5-89ab-90caef6bdd97 {
            --heading-color: 26, 26, 26;
            --text-color: 26, 26, 26;
            --primary-button-background: 255, 255, 255;
            --primary-button-text-color: 0, 0, 0;

            --section-blocks-alignment: center;
            --section-blocks-overlay-color: 0, 0, 0;
            --section-blocks-overlay-opacity: 0;
          }
          #block-template--15880464466141__slideshow-96fb9b8e-5524-4873-afe5-6d86e053434e {
            --heading-color: 255, 255, 255;
            --text-color: 255, 255, 255;
            --primary-button-background: 255, 255, 255;
            --primary-button-text-color: 0, 0, 0;

            --section-blocks-alignment: center;
            --section-blocks-overlay-color: 0, 0, 0;
            --section-blocks-overlay-opacity: 0.09;
          }
          #block-template--15880464466141__slideshow-d072197a-16d4-4d96-9715-b20ef7baba4f {
            --heading-color: 26, 26, 26;
            --text-color: 26, 26, 26;
            --primary-button-background: 255, 255, 255;
            --primary-button-text-color: 0, 0, 0;

            --section-blocks-alignment: center;
            --section-blocks-overlay-color: 0, 0, 0;
            --section-blocks-overlay-opacity: 0.3;
          }
        </style>

        <section class="section section--flush">
          <slide-show
            reveal-on-scroll
            auto-play
            transition-type="fade"
            class="slideshow slideshow--auto"
          >
            <div class="slideshow__slide-list">
              <slide-show-item
                reveal-visibility
                id="block-template--15880464466141__slideshow-d300bc8e-c9c9-4ba5-89ab-90caef6bdd97"
                class="slideshow__slide"
                style="
                  --image-aspect-ratio: 2.16;
                  --mobile-image-aspect-ratio: 0.7142857142857143;
                "
                ><a
                  class="slideshow__slide-inner"
                  href="/collections/eid-collection-2023"
                  ><div class="slideshow__image-wrapper hidden-pocket">
                    <img
                      src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-1_05.04.2023.jpg?v=1680847637&amp;width=3000"
                      alt=""
                      srcset="
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-1_05.04.2023.jpg?v=1680847637&amp;width=600   600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-1_05.04.2023.jpg?v=1680847637&amp;width=700   700w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-1_05.04.2023.jpg?v=1680847637&amp;width=800   800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-1_05.04.2023.jpg?v=1680847637&amp;width=1000 1000w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-1_05.04.2023.jpg?v=1680847637&amp;width=1200 1200w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-1_05.04.2023.jpg?v=1680847637&amp;width=1400 1400w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-1_05.04.2023.jpg?v=1680847637&amp;width=1600 1600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-1_05.04.2023.jpg?v=1680847637&amp;width=1800 1800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-1_05.04.2023.jpg?v=1680847637&amp;width=2000 2000w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-1_05.04.2023.jpg?v=1680847637&amp;width=2200 2200w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-1_05.04.2023.jpg?v=1680847637&amp;width=2400 2400w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-1_05.04.2023.jpg?v=1680847637&amp;width=2600 2600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-1_05.04.2023.jpg?v=1680847637&amp;width=2800 2800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-1_05.04.2023.jpg?v=1680847637&amp;width=3000 3000w
                      "
                      width="3000"
                      height="1389"
                      loading="eager"
                      draggable="false"
                      class="slideshow__image"
                    />
                  </div>
                  <div class="slideshow__image-wrapper hidden-lap-and-up">
                    <img
                      src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-1_05.04.2023.jpg?v=1680776482&amp;width=3000"
                      alt=""
                      srcset="
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-1_05.04.2023.jpg?v=1680776482&amp;width=600   600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-1_05.04.2023.jpg?v=1680776482&amp;width=700   700w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-1_05.04.2023.jpg?v=1680776482&amp;width=800   800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-1_05.04.2023.jpg?v=1680776482&amp;width=1000 1000w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-1_05.04.2023.jpg?v=1680776482&amp;width=1200 1200w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-1_05.04.2023.jpg?v=1680776482&amp;width=1400 1400w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-1_05.04.2023.jpg?v=1680776482&amp;width=1600 1600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-1_05.04.2023.jpg?v=1680776482&amp;width=1800 1800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-1_05.04.2023.jpg?v=1680776482&amp;width=2000 2000w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-1_05.04.2023.jpg?v=1680776482&amp;width=2200 2200w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-1_05.04.2023.jpg?v=1680776482&amp;width=2400 2400w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-1_05.04.2023.jpg?v=1680776482&amp;width=2600 2600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-1_05.04.2023.jpg?v=1680776482&amp;width=2800 2800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-1_05.04.2023.jpg?v=1680776482&amp;width=3000 3000w
                      "
                      width="3000"
                      height="4200"
                      loading="eager"
                      draggable="false"
                      class="slideshow__image"
                      sizes="100vw"
                    /></div></a></slide-show-item
              ><slide-show-item
                reveal-visibility
                id="block-template--15880464466141__slideshow-96fb9b8e-5524-4873-afe5-6d86e053434e"
                class="slideshow__slide"
                hidden
                style="
                  --image-aspect-ratio: 2.16;
                  --mobile-image-aspect-ratio: 0.7142857142857143;
                "
                ><a class="slideshow__slide-inner" href="/collections/sarees"
                  ><div class="slideshow__image-wrapper hidden-pocket">
                    <img
                      src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-2_05.04.2023.jpg?v=1680847637&amp;width=3000"
                      alt=""
                      srcset="
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-2_05.04.2023.jpg?v=1680847637&amp;width=600   600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-2_05.04.2023.jpg?v=1680847637&amp;width=700   700w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-2_05.04.2023.jpg?v=1680847637&amp;width=800   800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-2_05.04.2023.jpg?v=1680847637&amp;width=1000 1000w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-2_05.04.2023.jpg?v=1680847637&amp;width=1200 1200w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-2_05.04.2023.jpg?v=1680847637&amp;width=1400 1400w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-2_05.04.2023.jpg?v=1680847637&amp;width=1600 1600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-2_05.04.2023.jpg?v=1680847637&amp;width=1800 1800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-2_05.04.2023.jpg?v=1680847637&amp;width=2000 2000w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-2_05.04.2023.jpg?v=1680847637&amp;width=2200 2200w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-2_05.04.2023.jpg?v=1680847637&amp;width=2400 2400w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-2_05.04.2023.jpg?v=1680847637&amp;width=2600 2600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-2_05.04.2023.jpg?v=1680847637&amp;width=2800 2800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-2_05.04.2023.jpg?v=1680847637&amp;width=3000 3000w
                      "
                      width="3000"
                      height="1389"
                      loading="eager"
                      draggable="false"
                      class="slideshow__image"
                    />
                  </div>
                  <div class="slideshow__image-wrapper hidden-lap-and-up">
                    <img
                      src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-2_05.04.2023.jpg?v=1680776618&amp;width=3000"
                      alt=""
                      srcset="
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-2_05.04.2023.jpg?v=1680776618&amp;width=600   600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-2_05.04.2023.jpg?v=1680776618&amp;width=700   700w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-2_05.04.2023.jpg?v=1680776618&amp;width=800   800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-2_05.04.2023.jpg?v=1680776618&amp;width=1000 1000w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-2_05.04.2023.jpg?v=1680776618&amp;width=1200 1200w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-2_05.04.2023.jpg?v=1680776618&amp;width=1400 1400w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-2_05.04.2023.jpg?v=1680776618&amp;width=1600 1600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-2_05.04.2023.jpg?v=1680776618&amp;width=1800 1800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-2_05.04.2023.jpg?v=1680776618&amp;width=2000 2000w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-2_05.04.2023.jpg?v=1680776618&amp;width=2200 2200w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-2_05.04.2023.jpg?v=1680776618&amp;width=2400 2400w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-2_05.04.2023.jpg?v=1680776618&amp;width=2600 2600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-2_05.04.2023.jpg?v=1680776618&amp;width=2800 2800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-2_05.04.2023.jpg?v=1680776618&amp;width=3000 3000w
                      "
                      width="3000"
                      height="4200"
                      loading="eager"
                      draggable="false"
                      class="slideshow__image"
                      sizes="100vw"
                    /></div></a></slide-show-item
              ><slide-show-item
                reveal-visibility
                id="block-template--15880464466141__slideshow-d072197a-16d4-4d96-9715-b20ef7baba4f"
                class="slideshow__slide"
                hidden
                style="
                  --image-aspect-ratio: 2.16;
                  --mobile-image-aspect-ratio: 0.7142857142857143;
                "
                ><a class="slideshow__slide-inner" href="/collections/sale"
                  ><div class="slideshow__image-wrapper hidden-pocket">
                    <img
                      src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-3_05.04.2023.jpg?v=1680847637&amp;width=3000"
                      alt=""
                      srcset="
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-3_05.04.2023.jpg?v=1680847637&amp;width=600   600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-3_05.04.2023.jpg?v=1680847637&amp;width=700   700w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-3_05.04.2023.jpg?v=1680847637&amp;width=800   800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-3_05.04.2023.jpg?v=1680847637&amp;width=1000 1000w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-3_05.04.2023.jpg?v=1680847637&amp;width=1200 1200w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-3_05.04.2023.jpg?v=1680847637&amp;width=1400 1400w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-3_05.04.2023.jpg?v=1680847637&amp;width=1600 1600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-3_05.04.2023.jpg?v=1680847637&amp;width=1800 1800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-3_05.04.2023.jpg?v=1680847637&amp;width=2000 2000w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-3_05.04.2023.jpg?v=1680847637&amp;width=2200 2200w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-3_05.04.2023.jpg?v=1680847637&amp;width=2400 2400w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-3_05.04.2023.jpg?v=1680847637&amp;width=2600 2600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-3_05.04.2023.jpg?v=1680847637&amp;width=2800 2800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/Slider-3_05.04.2023.jpg?v=1680847637&amp;width=3000 3000w
                      "
                      width="3000"
                      height="1389"
                      loading="lazy"
                      draggable="false"
                      class="slideshow__image"
                    />
                  </div>
                  <div class="slideshow__image-wrapper hidden-lap-and-up">
                    <img
                      src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-3_05.04.2023.jpg?v=1680776627&amp;width=3000"
                      alt=""
                      srcset="
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-3_05.04.2023.jpg?v=1680776627&amp;width=600   600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-3_05.04.2023.jpg?v=1680776627&amp;width=700   700w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-3_05.04.2023.jpg?v=1680776627&amp;width=800   800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-3_05.04.2023.jpg?v=1680776627&amp;width=1000 1000w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-3_05.04.2023.jpg?v=1680776627&amp;width=1200 1200w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-3_05.04.2023.jpg?v=1680776627&amp;width=1400 1400w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-3_05.04.2023.jpg?v=1680776627&amp;width=1600 1600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-3_05.04.2023.jpg?v=1680776627&amp;width=1800 1800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-3_05.04.2023.jpg?v=1680776627&amp;width=2000 2000w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-3_05.04.2023.jpg?v=1680776627&amp;width=2200 2200w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-3_05.04.2023.jpg?v=1680776627&amp;width=2400 2400w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-3_05.04.2023.jpg?v=1680776627&amp;width=2600 2600w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-3_05.04.2023.jpg?v=1680776627&amp;width=2800 2800w,
                        //cdn.shopify.com/s/files/1/0637/4834/1981/files/mobile-Slider-3_05.04.2023.jpg?v=1680776627&amp;width=3000 3000w
                      "
                      width="3000"
                      height="4200"
                      loading="lazy"
                      draggable="false"
                      class="slideshow__image"
                      sizes="100vw"
                    /></div></a
              ></slide-show-item>
            </div>
            <page-dots animation-timer class="slideshow__nav container"
              ><button
                class="slideshow__progress-bar"
                aria-controls="block-template--15880464466141__slideshow-d300bc8e-c9c9-4ba5-89ab-90caef6bdd97"
                aria-current="true"
              >
                <span class="visually-hidden">Go to slide 1</span></button
              ><button
                class="slideshow__progress-bar"
                aria-controls="block-template--15880464466141__slideshow-96fb9b8e-5524-4873-afe5-6d86e053434e"
              >
                <span class="visually-hidden">Go to slide 2</span></button
              ><button
                class="slideshow__progress-bar"
                aria-controls="block-template--15880464466141__slideshow-d072197a-16d4-4d96-9715-b20ef7baba4f"
              >
                <span class="visually-hidden">Go to slide 3</span>
              </button></page-dots
            ></slide-show
          >
        </section>
      </div>
      <div
        id="shopify-section-template--15880464466141__88df96b5-7007-4e3b-908f-307b7eadb63f"
        class="shopify-section shopify-section--featured-collections"
      >
        <style>
          #shopify-section-template--15880464466141__88df96b5-7007-4e3b-908f-307b7eadb63f {
            --heading-color: 26, 26, 26;
            --text-color: 34, 34, 34;
            --primary-button-background: 241, 63, 98;
            --primary-button-text-color: 255, 255, 255;

            --prev-next-button-background: 255, 255, 255;
            --prev-next-button-color: 34, 34, 34;

            --section-background: 255, 255, 255;
            --section-products-per-row: 2;
          }

          @media screen and (min-width: 741px) {
            #shopify-section-template--15880464466141__88df96b5-7007-4e3b-908f-307b7eadb63f {
              --section-products-per-row: 3;
            }
          }

          @media screen and (min-width: 1000px) {
            #shopify-section-template--15880464466141__88df96b5-7007-4e3b-908f-307b7eadb63f {
              --section-products-per-row: 4;
            }
          }

          @media screen and (min-width: 1200px) {
            #shopify-section-template--15880464466141__88df96b5-7007-4e3b-908f-307b7eadb63f {
              --section-products-per-row: 4;
            }
          }
        </style>

        <section class="section">
          <div class="section__color-wrapper">
            <div class="container">
              <header class="section__header">
                <div class="text-container">
                  <h3 class="heading h2">New Arrivals</h3>
                </div>
              </header>
              <div class="featured-collections">
                <product-list
                  id="block-template--15880464466141__88df96b5-7007-4e3b-908f-307b7eadb63f-template--15880464466141__88df96b5-7007-4e3b-908f-307b7eadb63f-1667408731ac3fd976-0"
                  class="product-list product-list--center"
                >
                  <div>
                    <div class="product-list__inner">
                      <product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 50%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31626795843805" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Pink Printed
                            Georgette Saree With Tassels"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_002c2ee4-d534-43d2-af31-83230b46dc6c.jpg?v=1680870105"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="1200"
                            width="1200" alt="Pink Printed Georgette Saree With
                            Tassels"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_d4cc35ef-2ff2-4720-971d-ad81416a1b11.jpg?v=1680870105"
                            "></a
                          >
                          <form
                            method="post"
                            action="/cart/add"
                            id="product_form_template--15880464466141__88df96b5-7007-4e3b-908f-307b7eadb63f_template--15880464466141__88df96b5-7007-4e3b-908f-307b7eadb63f-1667408731ac3fd976-0_8045530808541_0"
                            accept-charset="UTF-8"
                            class="product-item__quick-form"
                            enctype="multipart/form-data"
                            is="product-form"
                          >
                            <input
                              type="hidden"
                              name="form_type"
                              value="product"
                            /><input
                              type="hidden"
                              name="utf8"
                              value="✓"
                            /><input type="hidden" name="quantity" value="1" />
                            <input
                              type="hidden"
                              name="id"
                              value="43795228786909"
                            />
                            <button
                              is="loader-button"
                              type="submit"
                              class="button button--outline button--text button--full hidden-touch"
                            >
                              + Add to cart
                            </button>
                            <button
                              type="submit"
                              class="product-item__quick-buy-button hidden-no-touch"
                            >
                              <span class="visually-hidden">+ Add to cart</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </form>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Pink Printed Georgette Saree With Tas...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹849.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹1,699.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 50%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31626795385053" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Mustard
                            Printed Georgette Saree With Tassels"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_d8eaabe7-11c4-46a5-8e67-e14be1428f97.jpg?v=1680870095"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="1200"
                            width="1200" alt="Mustard Printed Georgette Saree
                            With Tassels"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_7e3e8c3f-b28a-4a30-a834-a6731a43d11b.jpg?v=1680870095"
                            "></a
                          >
                          <form
                            method="post"
                            action="/cart/add"
                            id="product_form_template--15880464466141__88df96b5-7007-4e3b-908f-307b7eadb63f_template--15880464466141__88df96b5-7007-4e3b-908f-307b7eadb63f-1667408731ac3fd976-0_8045530611933_0"
                            accept-charset="UTF-8"
                            class="product-item__quick-form"
                            enctype="multipart/form-data"
                            is="product-form"
                          >
                            <input
                              type="hidden"
                              name="form_type"
                              value="product"
                            /><input
                              type="hidden"
                              name="utf8"
                              value="✓"
                            /><input type="hidden" name="quantity" value="1" />
                            <input
                              type="hidden"
                              name="id"
                              value="43795228524765"
                            />
                            <button
                              is="loader-button"
                              type="submit"
                              class="button button--outline button--text button--full hidden-touch"
                            >
                              + Add to cart
                            </button>
                            <button
                              type="submit"
                              class="product-item__quick-buy-button hidden-no-touch"
                            >
                              <span class="visually-hidden">+ Add to cart</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </form>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Mustard Printed Georgette Saree With ...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹849.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹1,699.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 50%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31626794893533" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Teal Blue
                            Printed Georgette Saree With Tassels"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_a7d3f774-094d-46f5-aa27-4df69f0da0f3.jpg?v=1680870086"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="1200"
                            width="1200" alt="Teal Blue Printed Georgette Saree
                            With Tassels"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_99957081-f148-4861-8aa5-301f292a412a.jpg?v=1680870086"
                            "></a
                          >
                          <form
                            method="post"
                            action="/cart/add"
                            id="product_form_template--15880464466141__88df96b5-7007-4e3b-908f-307b7eadb63f_template--15880464466141__88df96b5-7007-4e3b-908f-307b7eadb63f-1667408731ac3fd976-0_8045530120413_0"
                            accept-charset="UTF-8"
                            class="product-item__quick-form"
                            enctype="multipart/form-data"
                            is="product-form"
                          >
                            <input
                              type="hidden"
                              name="form_type"
                              value="product"
                            /><input
                              type="hidden"
                              name="utf8"
                              value="✓"
                            /><input type="hidden" name="quantity" value="1" />
                            <input
                              type="hidden"
                              name="id"
                              value="43795227771101"
                            />
                            <button
                              is="loader-button"
                              type="submit"
                              class="button button--outline button--text button--full hidden-touch"
                            >
                              + Add to cart
                            </button>
                            <button
                              type="submit"
                              class="product-item__quick-buy-button hidden-no-touch"
                            >
                              <span class="visually-hidden">+ Add to cart</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </form>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Teal Blue Printed Georgette Saree Wit...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹849.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹1,699.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 50%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31626793844957" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Dark Pink
                            Printed Georgette Saree With Tassels"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_261d38ec-973b-47b9-b2bc-7f3bb839e145.jpg?v=1680870077"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="1200"
                            width="1200" alt="Dark Pink Printed Georgette Saree
                            With Tassels"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_86ced709-bc6d-414c-92a4-294d4a6a8cd3.jpg?v=1680870077"
                            "></a
                          >
                          <form
                            method="post"
                            action="/cart/add"
                            id="product_form_template--15880464466141__88df96b5-7007-4e3b-908f-307b7eadb63f_template--15880464466141__88df96b5-7007-4e3b-908f-307b7eadb63f-1667408731ac3fd976-0_8045530022109_0"
                            accept-charset="UTF-8"
                            class="product-item__quick-form"
                            enctype="multipart/form-data"
                            is="product-form"
                          >
                            <input
                              type="hidden"
                              name="form_type"
                              value="product"
                            /><input
                              type="hidden"
                              name="utf8"
                              value="✓"
                            /><input type="hidden" name="quantity" value="1" />
                            <input
                              type="hidden"
                              name="id"
                              value="43795227672797"
                            />
                            <button
                              is="loader-button"
                              type="submit"
                              class="button button--outline button--text button--full hidden-touch"
                            >
                              + Add to cart
                            </button>
                            <button
                              type="submit"
                              class="product-item__quick-buy-button hidden-no-touch"
                            >
                              <span class="visually-hidden">+ Add to cart</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </form>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Dark Pink Printed Georgette Saree Wit...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹849.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹1,699.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div>
                      </product-item>
                    </div>
                  </div>
                  <div class="section__footer">
                    <a class="button button--primary" href="product.php"
                      >View All</a
                    >
                  </div></product-list
                >
              </div>
            </div>
          </div>
        </section>
      </div>
      <div
        id="shopify-section-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc"
        class="shopify-section shopify-section--featured-collections"
      >
        <style>
          #shopify-section-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc {
            --heading-color: 26, 26, 26;
            --text-color: 34, 34, 34;
            --primary-button-background: 241, 63, 98;
            --primary-button-text-color: 255, 255, 255;

            --prev-next-button-background: 255, 255, 255;
            --prev-next-button-color: 34, 34, 34;

            --section-background: 255, 255, 255;
            --section-products-per-row: 2;
          }

          @media screen and (min-width: 741px) {
            #shopify-section-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc {
              --section-products-per-row: 3;
            }
          }

          @media screen and (min-width: 1000px) {
            #shopify-section-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc {
              --section-products-per-row: 4;
            }
          }

          @media screen and (min-width: 1200px) {
            #shopify-section-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc {
              --section-products-per-row: 4;
            }
          }
        </style>

        <section class="section">
          <div class="section__color-wrapper">
            <div class="container">
              <header class="section__header">
                <div class="text-container">
                  <h3 class="heading h2">Latest Collection</h3>
                </div>
                <tabs-nav class="tabs-nav tabs-nav--center tabs-nav--edge2edge">
                  <scrollable-content class="tabs-nav__scroller hide-scrollbar">
                    <div class="tabs-nav__scroller-inner">
                      <div class="tabs-nav__item-list">
                        <button
                          type="button"
                          class="tabs-nav__item heading heading--small"
                          aria-expanded="true"
                          aria-controls="block-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b"
                        >
                          Gowns</button
                        ><button
                          type="button"
                          class="tabs-nav__item heading heading--small"
                          aria-expanded="false"
                          aria-controls="block-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-16676330054fc1c17a-0"
                        >
                          Special Eid Suits</button
                        ><button
                          type="button"
                          class="tabs-nav__item heading heading--small"
                          aria-expanded="false"
                          aria-controls="block-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3"
                        >
                          Sharara Suits</button
                        ><button
                          type="button"
                          class="tabs-nav__item heading heading--small"
                          aria-expanded="false"
                          aria-controls="block-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237"
                        >
                          Palazo Suits
                        </button>
                      </div>
                    </div>
                  </scrollable-content>
                </tabs-nav>
              </header>
              <div class="featured-collections">
                <product-list
                  id="block-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b"
                  class="product-list product-list--center"
                >
                  <div>
                    <div class="product-list__inner">
                      <product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 73%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31014891258077" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Maroon
                            Lucknowi Chikankari Rayon Partywear Gown -
                            Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/maroon-lucknowi-chikankari-rayon-partywear-gown-peachmode-1.jpg?v=1669036948"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Maroon Lucknowi Chikankari Rayon
                            Partywear Gown - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/maroon-lucknowi-chikankari-rayon-partywear-gown-peachmode-2.jpg?v=1669036950"
                            "></a
                          >
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7727460679901-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7727460679901-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7727460679901-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7727460679901-popover"
                            href="/products/maroon-lucknowi-chikankari-rayon-partywear-gown-132066?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7727460679901-drawer"
                            href="/products/maroon-lucknowi-chikankari-rayon-partywear-gown-132066?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Red Lucknowi Chikankari Rayon Partywe...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹1,999.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹7,399.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 72%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31012759568605" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Royal Blue
                            Woven Jacquard Gown - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/royal-blue-woven-jacquard-gown-peachmode-1.jpg?v=1669018820"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Royal Blue Woven Jacquard Gown -
                            Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/royal-blue-woven-jacquard-gown-peachmode-2.jpg?v=1669018822"
                            "></a
                          >
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7715767517405-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7715767517405-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7715767517405-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7715767517405-popover"
                            href="/products/royal-blue-designer-partywear-jacquard-gown-119151?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7715767517405-drawer"
                            href="/products/royal-blue-designer-partywear-jacquard-gown-119151?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Royal Blue Woven Jacquard Gown</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹1,699.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹5,999.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 73%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31014891192541" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Blue Lucknowi
                            Chikankari Rayon Partywear Gown - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/blue-lucknowi-chikankari-rayon-partywear-gown-peachmode-1.jpg?v=1669036947"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Blue Lucknowi Chikankari Rayon
                            Partywear Gown - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/blue-lucknowi-chikankari-rayon-partywear-gown-peachmode-2.jpg?v=1669036950"
                            "></a
                          >
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7727460843741-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7727460843741-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7727460843741-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7727460843741-popover"
                            href="/products/blue-lucknowi-chikankari-rayon-partywear-gown-132067?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7727460843741-drawer"
                            href="/products/blue-lucknowi-chikankari-rayon-partywear-gown-132067?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Blue Lucknowi Chikankari Rayon Partyw...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹1,999.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹7,399.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 71%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31013873058013" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Black Floral
                            Embroidered Flared Floor Touch Georgette Partywear
                            Gown - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/black-floral-embroidered-flared-floor-touch-georgette-partywear-gown-peachmode-1.jpg?v=1669028918"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Black Floral Embroidered Flared
                            Floor Touch Georgette Partywear Gown - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/black-floral-embroidered-flared-floor-touch-georgette-partywear-gown-peachmode-2.jpg?v=1669028921"
                            "></a
                          >
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7719886913757-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7719886913757-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7719886913757-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7719886913757-popover"
                            href="/products/black-floral-embroidered-flared-floor-touch-georgette-partywear-gown-138218?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-76b3ada9-b40f-4040-a94a-a85a8fe6191b-7719886913757-drawer"
                            href="/products/black-floral-embroidered-flared-floor-touch-georgette-partywear-gown-138218?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Black Floral Embroidered Flared Floor...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹1,649.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹5,599.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div>
                      </product-item>
                    </div>
                  </div></product-list
                ><product-list
                  hidden
                  id="block-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-16676330054fc1c17a-0"
                  class="product-list product-list--center"
                >
                  <div>
                    <div class="product-list__inner">
                      <product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 57%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31012452565213" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Wine Floral
                            Embroidered Work Net Pakistani Suit - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/wine-floral-embroidered-work-net-pakistani-suit-peachmode-1.jpg?v=1669015711"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Wine Floral Embroidered Work Net
                            Pakistani Suit - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/wine-floral-embroidered-work-net-pakistani-suit-peachmode-2.jpg?v=1669015713"
                            "></a
                          >
                          <form
                            method="post"
                            action="/cart/add"
                            id="product_form_template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc_template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-16676330054fc1c17a-0_7715611934941_0"
                            accept-charset="UTF-8"
                            class="product-item__quick-form"
                            enctype="multipart/form-data"
                            is="product-form"
                          >
                            <input
                              type="hidden"
                              name="form_type"
                              value="product"
                            /><input
                              type="hidden"
                              name="utf8"
                              value="✓"
                            /><input type="hidden" name="quantity" value="1" />
                            <input
                              type="hidden"
                              name="id"
                              value="42817522368733"
                            />
                            <button
                              is="loader-button"
                              type="submit"
                              class="button button--outline button--text button--full hidden-touch"
                            >
                              + Add to cart
                            </button>
                            <button
                              type="submit"
                              class="product-item__quick-buy-button hidden-no-touch"
                            >
                              <span class="visually-hidden">+ Add to cart</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </form>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Wine Floral Embroidered Work Net Paki...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹2,149.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹4,999.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 52%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31017279193309" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="White
                            Embroidered Netted Palazzo Suit - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/white-embroidered-netted-palazzo-suit-peachmode-1.jpg?v=1669058958"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="White Embroidered Netted Palazzo
                            Suit - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/white-embroidered-netted-palazzo-suit-peachmode-2.jpg?v=1669058960"
                            "></a
                          >
                          <form
                            method="post"
                            action="/cart/add"
                            id="product_form_template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc_template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-16676330054fc1c17a-0_7807648399581_0"
                            accept-charset="UTF-8"
                            class="product-item__quick-form"
                            enctype="multipart/form-data"
                            is="product-form"
                          >
                            <input
                              type="hidden"
                              name="form_type"
                              value="product"
                            /><input
                              type="hidden"
                              name="utf8"
                              value="✓"
                            /><input type="hidden" name="quantity" value="1" />
                            <input
                              type="hidden"
                              name="id"
                              value="43142773932253"
                            />
                            <button
                              is="loader-button"
                              type="submit"
                              class="button button--outline button--text button--full hidden-touch"
                            >
                              + Add to cart
                            </button>
                            <button
                              type="submit"
                              class="product-item__quick-buy-button hidden-no-touch"
                            >
                              <span class="visually-hidden">+ Add to cart</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </form>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >White Embroidered Netted Pakistani Suit</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹2,149.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹4,499.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 53%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31016557445341" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Pink Sequence
                            With Floral Embroidered Net Pakistani Suit -
                            Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/pink-sequence-with-floral-embroidered-net-pakistani-suit-peachmode-1.jpg?v=1669051516"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Pink Sequence With Floral
                            Embroidered Net Pakistani Suit - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/pink-sequence-with-floral-embroidered-net-pakistani-suit-peachmode-2.jpg?v=1669051519"
                            "></a
                          >
                          <form
                            method="post"
                            action="/cart/add"
                            id="product_form_template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc_template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-16676330054fc1c17a-0_7764650295517_0"
                            accept-charset="UTF-8"
                            class="product-item__quick-form"
                            enctype="multipart/form-data"
                            is="product-form"
                          >
                            <input
                              type="hidden"
                              name="form_type"
                              value="product"
                            /><input
                              type="hidden"
                              name="utf8"
                              value="✓"
                            /><input type="hidden" name="quantity" value="1" />
                            <input
                              type="hidden"
                              name="id"
                              value="42966697509085"
                            />
                            <button
                              is="loader-button"
                              type="submit"
                              class="button button--outline button--text button--full hidden-touch"
                            >
                              + Add to cart
                            </button>
                            <button
                              type="submit"
                              class="product-item__quick-buy-button hidden-no-touch"
                            >
                              <span class="visually-hidden">+ Add to cart</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </form>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Pink Sequins With Floral Embroidered ...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹1,699.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹3,599.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 52%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31017276342493" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Violet
                            Embroidered Netted Palazzo Suit - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/violet-embroidered-netted-palazzo-suit-peachmode-1.jpg?v=1669058917"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Violet Embroidered Netted Palazzo
                            Suit - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/violet-embroidered-netted-palazzo-suit-peachmode-2.jpg?v=1669058920"
                            "></a
                          >
                          <form
                            method="post"
                            action="/cart/add"
                            id="product_form_template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc_template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-16676330054fc1c17a-0_7807635587293_0"
                            accept-charset="UTF-8"
                            class="product-item__quick-form"
                            enctype="multipart/form-data"
                            is="product-form"
                          >
                            <input
                              type="hidden"
                              name="form_type"
                              value="product"
                            /><input
                              type="hidden"
                              name="utf8"
                              value="✓"
                            /><input type="hidden" name="quantity" value="1" />
                            <input
                              type="hidden"
                              name="id"
                              value="43142752796893"
                            />
                            <button
                              is="loader-button"
                              type="submit"
                              class="button button--outline button--text button--full hidden-touch"
                            >
                              + Add to cart
                            </button>
                            <button
                              type="submit"
                              class="product-item__quick-buy-button hidden-no-touch"
                            >
                              <span class="visually-hidden">+ Add to cart</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </form>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Violet Embroidered Netted Pakistani Suit</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹2,149.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹4,499.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div>
                      </product-item>
                    </div>
                  </div></product-list
                ><product-list
                  hidden
                  id="block-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3"
                  class="product-list product-list--center"
                >
                  <div>
                    <div class="product-list__inner">
                      <product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 33%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31015210418397" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="White
                            Partywear Sequence Embroidered Georgette Sharara
                            Suit - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/white-partywear-sequence-embroidered-georgette-sharara-suit-peachmode-1.jpg?v=1669040143"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="White Partywear Sequence
                            Embroidered Georgette Sharara Suit - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/white-partywear-sequence-embroidered-georgette-sharara-suit-peachmode-2.jpg?v=1669040146"
                            "></a
                          >
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7737332465885-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7737332465885-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7737332465885-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7737332465885-popover"
                            href="/products/white-partywear-sequence-embroidered-georgette-sharara-suit-with-dupatta-135704?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7737332465885-drawer"
                            href="/products/white-partywear-sequence-embroidered-georgette-sharara-suit-with-dupatta-135704?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >White Partywear Sequins Embroidered G...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹1,999.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹2,999.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 54%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31016241692893" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Black
                            Embroidered Georgette Sharara Suit - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/black-embroidered-georgette-sharara-suit-peachmode-1.jpg?v=1669049407"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Black Embroidered Georgette
                            Sharara Suit - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/black-embroidered-georgette-sharara-suit-peachmode-2.jpg?v=1669049410"
                            "></a
                          >
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7746362573021-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7746362573021-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7746362573021-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7746362573021-popover"
                            href="/products/black-embroidered-georgette-sharara-suit-144756?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7746362573021-drawer"
                            href="/products/black-embroidered-georgette-sharara-suit-144756?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Black Embroidered Georgette Sharara Suit</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹1,999.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹4,299.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 50%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31127585554653" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Lemon Yellow
                            Sequins Embroidered Georgette Sharara Suit"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/1_VIRAH-Z21-PEACHMODE.jpg?v=1670909696"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Lemon Yellow Sequins Embroidered
                            Georgette Sharara Suit"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/2_VIRAH-Z21-PEACHMODE.jpg?v=1670909701"
                            "></a
                          >
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7959420797149-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7959420797149-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7959420797149-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7959420797149-popover"
                            href="/products/lemon-yellow-sequence-embroidered-georgette-sharara-suit?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7959420797149-drawer"
                            href="/products/lemon-yellow-sequence-embroidered-georgette-sharara-suit?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Lemon Yellow Sequins Embroidered Geor...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹1,649.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹3,299.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 51%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31017053225181" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Teal Blue
                            Sequence Embroidered Georgette Sharara Suit -
                            Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/teal-blue-sequence-embroidered-georgette-sharara-suit-peachmode-1.jpg?v=1669056002"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="1200"
                            width="1200" alt="Teal Blue Sequence Embroidered
                            Georgette Sharara Suit - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/teal-blue-sequence-embroidered-georgette-sharara-suit-peachmode-2.jpg?v=1669056005"
                            "></a
                          >
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7798561407197-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7798561407197-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7798561407197-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7798561407197-popover"
                            href="/products/teal-blue-sequence-embroidered-georgette-sharara-suit?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-1fee8344-a163-4a14-b2f4-6705b5a2f4c3-7798561407197-drawer"
                            href="/products/teal-blue-sequence-embroidered-georgette-sharara-suit?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Teal Blue Sequins Embroidered Georget...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹2,049.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹4,199.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div>
                      </product-item>
                    </div>
                  </div></product-list
                ><product-list
                  hidden
                  id="block-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237"
                  class="product-list product-list--center"
                >
                  <div>
                    <div class="product-list__inner">
                      <product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 50%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31225026019549" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Navy Blue
                            Lucknowi Embroidered Georgette Kurti Palazzo Set"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_50ec74a3-0b71-4f4a-9e48-c525ee4e9688.jpg?v=1672657581"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Navy Blue Lucknowi Embroidered
                            Georgette Kurti Palazzo Set"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_f6283327-fe75-404b-b3a0-fa55a2a14d86.jpg?v=1672657589"
                            "></a
                          >
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7975678214365-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7975678214365-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7975678214365-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7975678214365-popover"
                            href="/products/navy-blue-lucknowi-embroidered-georgette-kurti-palazzo-set?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7975678214365-drawer"
                            href="/products/navy-blue-lucknowi-embroidered-georgette-kurti-palazzo-set?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Navy Blue Lucknowi Embroidered George...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹1,149.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹2,299.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 50%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31225028444381" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Mauve
                            Lucknowi Embroidered Georgette Kurti Palazzo Set"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_8fcbdd60-8d68-4553-a011-e60d7b894ff2.jpg?v=1672657621"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Mauve Lucknowi Embroidered
                            Georgette Kurti Palazzo Set"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_67f5aeb0-30bd-4b6f-a47d-69a3e07bf247.jpg?v=1672657628"
                            "></a
                          >
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7975683358941-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7975683358941-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7975683358941-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7975683358941-popover"
                            href="/products/mauve-lucknowi-embroidered-georgette-kurti-palazzo-set?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7975683358941-drawer"
                            href="/products/mauve-lucknowi-embroidered-georgette-kurti-palazzo-set?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Mauve Lucknowi Embroidered Georgette ...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹1,149.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹2,299.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 50%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31225033556189" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Grey Lucknowi
                            Embroidered Georgette Kurti Palazzo Set"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_2b70e607-c927-4fd8-b220-d1a2700a71b2.jpg?v=1672657685"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Grey Lucknowi Embroidered
                            Georgette Kurti Palazzo Set"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_fcee5714-4257-410f-8745-fe7f3342305c.jpg?v=1672657691"
                            "></a
                          >
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7975685685469-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7975685685469-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7975685685469-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7975685685469-popover"
                            href="/products/grey-lucknowi-embroidered-georgette-kurti-palazzo-set?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7975685685469-drawer"
                            href="/products/grey-lucknowi-embroidered-georgette-kurti-palazzo-set?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Grey Lucknowi Embroidered Georgette K...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹1,149.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹2,299.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 72%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31011246145757" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Surpassing
                            Light Aqua Green Colored Casual Digital Printed
                            Muslin Blend Kurti-Palazzo Set - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/surpassing-light-aqua-green-colored-casual-digital-printed-muslin-blend-kurti-palazzo-set-peachmode-1.jpg?v=1669001235"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Surpassing Light Aqua Green
                            Colored Casual Digital Printed Muslin Blend
                            Kurti-Palazzo Set - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/surpassing-light-aqua-green-colored-casual-digital-printed-muslin-blend-kurti-palazzo-set-peachmode-2.jpg?v=1669001237"
                            "></a
                          >
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7710747787485-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7710747787485-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7710747787485-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7710747787485-popover"
                            href="/products/surpassing-light-aqua-green-colored-casual-digital-printed-pure-muslin-kurti-palazzo-set-44559?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__4ac6e977-9b0d-47cb-b70d-6f3769f464dc-530319ee-a20a-4100-9051-65ff0c2ee237-7710747787485-drawer"
                            href="/products/surpassing-light-aqua-green-colored-casual-digital-printed-pure-muslin-kurti-palazzo-set-44559?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Surpassing Light Aqua Green Colored C...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹1,699.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹6,099.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div>
                      </product-item>
                    </div>
                  </div></product-list
                >
              </div>
            </div>
          </div>
        </section>
      </div>
      <div
        id="shopify-section-template--15880464466141__728da195-2413-415f-b745-18762cf940d9"
        class="shopify-section shopify-section--rich-text"
      >
        <style>
          #shopify-section-template--15880464466141__728da195-2413-415f-b745-18762cf940d9 {
            --heading-color: 26, 26, 26;
            --text-color: 34, 34, 34;
            --primary-button-background: 241, 63, 98;
            --primary-button-text-color: 255, 255, 255;

            --section-background: 255, 255, 255;
          }
        </style>
      </div>
      <div
        id="shopify-section-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a"
        class="shopify-section shopify-section--featured-collections"
      >
        <style>
          #shopify-section-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a {
            --heading-color: 26, 26, 26;
            --text-color: 34, 34, 34;
            --primary-button-background: 241, 63, 98;
            --primary-button-text-color: 255, 255, 255;

            --prev-next-button-background: 255, 255, 255;
            --prev-next-button-color: 34, 34, 34;

            --section-background: 255, 255, 255;
            --section-products-per-row: 2;
          }

          @media screen and (min-width: 741px) {
            #shopify-section-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a {
              --section-products-per-row: 3;
            }
          }

          @media screen and (min-width: 1000px) {
            #shopify-section-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a {
              --section-products-per-row: 4;
            }
          }

          @media screen and (min-width: 1200px) {
            #shopify-section-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a {
              --section-products-per-row: 4;
            }
          }
        </style>

        <section class="section">
          <div class="section__color-wrapper">
            <div class="container">
              <header class="section__header section__header--tight">
                <div class="text-container">
                  <h3 class="heading h2">Sale</h3>
                </div>
              </header>
              <div class="featured-collections">
                <product-list
                  id="block-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-167998712217971383-0"
                  class="product-list product-list--center"
                >
                  <div>
                    <div class="product-list__inner">
                      <product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 64%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31018225139933" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="1200" width="1200" alt="Navy Blue
                            Printed Queen Sized Bed Sheet With 2 Pillow Covers -
                            Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/navy-blue-printed-queen-sized-bed-sheet-with-2-pillow-covers-peachmode-1.jpg?v=1669069244"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Navy Blue Printed Queen Sized Bed
                            Sheet With 2 Pillow Covers - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/navy-blue-printed-queen-sized-bed-sheet-with-2-pillow-covers-peachmode-2.jpg?v=1669069247"
                            "></a
                          >
                          <form
                            method="post"
                            action="/cart/add"
                            id="product_form_template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a_template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-167998712217971383-0_7914970022109_0"
                            accept-charset="UTF-8"
                            class="product-item__quick-form"
                            enctype="multipart/form-data"
                            is="product-form"
                          >
                            <input
                              type="hidden"
                              name="form_type"
                              value="product"
                            /><input
                              type="hidden"
                              name="utf8"
                              value="✓"
                            /><input type="hidden" name="quantity" value="1" />
                            <input
                              type="hidden"
                              name="id"
                              value="43485801644253"
                            />
                            <button
                              is="loader-button"
                              type="submit"
                              class="button button--outline button--text button--full hidden-touch"
                            >
                              + Add to cart
                            </button>
                            <button
                              type="submit"
                              class="product-item__quick-buy-button hidden-no-touch"
                            >
                              <span class="visually-hidden">+ Add to cart</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </form>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Navy Blue Printed Queen Sized Bed She...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹399.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹1,099.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 58%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31016134312157" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Maroon
                            Sequence Embroidered Cotton Silk Top - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/maroon-sequence-embroidered-cotton-silk-top-peachmode-1.jpg?v=1669048826"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="1200"
                            width="1200" alt="Maroon Sequence Embroidered Cotton
                            Silk Top - Peachmode"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/maroon-sequence-embroidered-cotton-silk-top-peachmode-2.jpg?v=1669048828"
                            "></a
                          >
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-167998712217971383-0-7741562618077-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-167998712217971383-0-7741562618077-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-167998712217971383-0-7741562618077-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-167998712217971383-0-7741562618077-popover"
                            href="/products/maroon-sequence-embroidered-cotton-silk-top?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-167998712217971383-0-7741562618077-drawer"
                            href="/products/maroon-sequence-embroidered-cotton-silk-top?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Maroon Sequins Embroidered Cotton Sil...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  >From
                                  <span class="money" style="color: #13becf"
                                    >₹749.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹1,799.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item product-item--sold-out"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span class="label label--subdued">Sold out</span>
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31273537667293" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Beige Woven
                            Jacquard Silk Lehenga Choli"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/1_SVC-15041-PEACHMODE.jpg?v=1673525492"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="1200"
                            width="1200" alt="Beige Woven Jacquard Silk Lehenga
                            Choli"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/2_SVC-15041-PEACHMODE.jpg?v=1673525493"
                            "></a
                          >
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Beige Woven Jacquard Silk Lehenga Choli</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹649.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹1,849.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 58%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img
                              loading="lazy"
                              class="product-item__primary-image"
                              data-media-id="31016134377693"
                              sizes="(max-width: 740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 - 18px)"
                              height="2000"
                              width="2000"
                              alt="Wine Sequence Embroidered Cotton Silk Top - Peachmode"
                              src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/wine-sequence-embroidered-cotton-silk-top-peachmode-1.jpg?v=1669048826" /><img
                              loading="lazy"
                              class="product-item__secondary-image"
                              sizes="(max-width: 740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 - 18px)"
                              height="1200"
                              width="1200"
                              alt="Wine Sequence Embroidered Cotton Silk Top - Peachmode"
                              src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/wine-sequence-embroidered-cotton-silk-top-peachmode-2.jpg?v=1669048829"
                          /></a>
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-167998712217971383-0-7741561635037-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-167998712217971383-0-7741561635037-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-167998712217971383-0-7741561635037-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-167998712217971383-0-7741561635037-popover"
                            href="/products/wine-sequence-embroidered-cotton-silk-top?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-template--15880464466141__1d3bfca3-c043-492c-92b1-13a17dc3b33a-167998712217971383-0-7741561635037-drawer"
                            href="/products/wine-sequence-embroidered-cotton-silk-top?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Wine Sequins Embroidered Cotton Silk Top</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  >From
                                  <span class="money" style="color: #13becf"
                                    >₹749.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹1,799.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div>
                      </product-item>
                    </div>
                  </div>
                  <div class="section__footer">
                    <a class="button button--primary" href="product.php"
                      >View All</a
                    >
                  </div></product-list
                >
              </div>
            </div>
          </div>
        </section>
      </div>
      <div
        id="shopify-section-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5"
        class="shopify-section shopify-section--collection-list"
      >
        <style>
          #shopify-section-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5 {
            --heading-color: 26, 26, 26;
            --text-color: 34, 34, 34;
            --prev-next-button-background: var(--text-color);
            --prev-next-button-color: var(--section-background);

            --section-background: 255, 255, 255;
          }
          #block-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-1667559845a0357dbe-0 {
            --heading-color: 255, 255, 255;
            --text-color: 255, 255, 255;
            --section-block-overlay: 0, 0, 0;
            --section-block-overlay-opacity: 0.25;
          }
          #block-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-1667559845a0357dbe-1 {
            --heading-color: 255, 255, 255;
            --text-color: 255, 255, 255;
            --section-block-overlay: 0, 0, 0;
            --section-block-overlay-opacity: 0.3;
          }
          #block-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-1667559845a0357dbe-2 {
            --heading-color: 255, 255, 255;
            --text-color: 255, 255, 255;
            --section-block-overlay: 0, 0, 0;
            --section-block-overlay-opacity: 0.3;
          }
          #block-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-6ca66ac6-17a2-4cdc-8d64-0ddd74674e36 {
            --heading-color: 255, 255, 255;
            --text-color: 255, 255, 255;
            --section-block-overlay: 0, 0, 0;
            --section-block-overlay-opacity: 0.3;
          }
          #block-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-914d89a7-6260-48da-b108-93ef9bdf4343 {
            --heading-color: 255, 255, 255;
            --text-color: 255, 255, 255;
            --section-block-overlay: 0, 0, 0;
            --section-block-overlay-opacity: 0.3;
          }
          #block-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-8c0c071c-7e17-407a-abc2-7e05c06a8ef1 {
            --heading-color: 255, 255, 255;
            --text-color: 255, 255, 255;
            --section-block-overlay: 0, 0, 0;
            --section-block-overlay-opacity: 0.3;
          }
        </style>

        <section class="section">
          <div class="section__color-wrapper">
            <div class="">
              <header class="section__header container text-container">
                <h3 class="heading h2">Summer Arrivals</h3>
              </header>
              <collection-list class="list-collections list-collections--grid">
                <div class="container">
                  <div class="list-collections__item-list">
                    <a
                      id="block-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-1667559845a0357dbe-0"
                      href="product.php"
                      class="list-collections__item has-overlay image-zoom"
                    >
                      <div class="list-collections__item-image-wrapper">
                        <img
                          loading="lazy"
                          class="list-collections__item-image"
                          sizes="(max-width: 740px) calc(100vw - 48px), (max-width: 999px) calc(50vw - 60px), 480px"
                          height="2000"
                          width="2000"
                          alt="Innovative Rama Colored lining Pattern Casual Wear Cotton Saree - Peachmode"
                          src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/innovative-rama-colored-lining-pattern-casual-wear-cotton-saree-peachmode-1.jpg?v=1669011587"
                        />
                      </div>
                      <div class="list-collections__item-info text-container">
                        <p class="heading h3">Cotton Sarees</p>
                      </div></a
                    ><a
                      id="block-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-1667559845a0357dbe-1"
                      href="product.php"
                      class="list-collections__item has-overlay image-zoom"
                    >
                      <div class="list-collections__item-image-wrapper">
                        <img
                          loading="lazy"
                          class="list-collections__item-image"
                          sizes="(max-width: 740px) calc(100vw - 48px), (max-width: 999px) calc(50vw - 60px), 480px"
                          height="2000"
                          width="2000"
                          alt="Blue Casual Wear Embroidered Cotton Kurti - Peachmode"
                          src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/blue-casual-wear-embroidered-cotton-kurti-peachmode-1.jpg?v=1669033856"
                        />
                      </div>
                      <div class="list-collections__item-info text-container">
                        <p class="heading h3">Cotton Kurtis</p>
                      </div></a
                    ><a
                      id="block-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-1667559845a0357dbe-2"
                      href="product.php"
                      class="list-collections__item has-overlay image-zoom"
                    >
                      <div class="list-collections__item-image-wrapper">
                        <img
                          loading="lazy"
                          class="list-collections__item-image"
                          sizes="(max-width: 740px) calc(100vw - 48px), (max-width: 999px) calc(50vw - 60px), 480px"
                          height="2000"
                          width="2000"
                          alt="Grey Printed Poly Cotton Dress Material - Peachmode"
                          src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/grey-printed-poly-cotton-dress-material-peachmode-1_4496ee44-1032-488d-9235-807a07974df9.jpg?v=1669043693"
                        />
                      </div>
                      <div class="list-collections__item-info text-container">
                        <p class="heading h3">Cotton Salwar Suits</p>
                      </div></a
                    ><a
                      id="block-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-6ca66ac6-17a2-4cdc-8d64-0ddd74674e36"
                      href="product.php"
                      class="list-collections__item has-overlay image-zoom"
                    >
                      <div class="list-collections__item-image-wrapper">
                        <img
                          loading="lazy"
                          class="list-collections__item-image"
                          sizes="(max-width: 740px) calc(100vw - 48px), (max-width: 999px) calc(50vw - 60px), 480px"
                          height="2000"
                          width="2000"
                          alt="Beige Embroidered Art Silk Mens&#39;s Kurta Pyjama Set - Peachmode"
                          src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/beige-embroidered-art-silk-mens-s-kurta-pyjama-set-peachmode-1.jpg?v=1669056724"
                        />
                      </div>
                      <div class="list-collections__item-info text-container">
                        <p class="heading h3">Mens Kurta Pyjama</p>
                      </div></a
                    ><a
                      id="block-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-914d89a7-6260-48da-b108-93ef9bdf4343"
                      href="product.php"
                      class="list-collections__item has-overlay image-zoom"
                    >
                      <div class="list-collections__item-image-wrapper">
                        <img
                          loading="lazy"
                          class="list-collections__item-image"
                          sizes="(max-width: 740px) calc(100vw - 48px), (max-width: 999px) calc(50vw - 60px), 480px"
                          height="2000"
                          width="2000"
                          alt=""
                          src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_d8d4c078-979c-4365-b86a-154a5de3a59a.jpg?v=1676116753"
                        />
                      </div>
                      <div class="list-collections__item-info text-container">
                        <p class="heading h3">Jewellery</p>
                      </div></a
                    ><a
                      id="block-template--15880464466141__1204532a-27bd-454f-ba12-c3d904599de5-8c0c071c-7e17-407a-abc2-7e05c06a8ef1"
                      href="product.php"
                      class="list-collections__item has-overlay image-zoom"
                    >
                      <div class="list-collections__item-image-wrapper">
                        <img
                          loading="lazy"
                          class="list-collections__item-image"
                          sizes="(max-width: 740px) calc(100vw - 48px), (max-width: 999px) calc(50vw - 60px), 480px"
                          height="2000"
                          width="2000"
                          alt=""
                          src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/1_PEACHMODE_e588c929-aa0a-459d-a7ca-69c1f8b60ac3.jpg?v=1669026284"
                        />
                      </div>
                      <div class="list-collections__item-info text-container">
                        <p class="heading h3">Handbags</p>
                      </div></a
                    >
                  </div>
                </div>
              </collection-list>
            </div>
          </div>
        </section>
      </div>
      <div
        id="shopify-section-template--15880464466141__1651295720d6d36989"
        class="shopify-section shopify-section--featured-product"
      >
        <style>
          #shopify-section-template--15880464466141__1651295720d6d36989 {
            --heading-color: 26, 26, 26;
            --text-color: 34, 34, 34;

            --primary-button-background: 241, 63, 98;
            --primary-button-text-color: 255, 255, 255;
            --secondary-button-background: 247, 174, 166;
            --secondary-button-text-color: 255, 255, 255;
            --section-background: 255, 255, 255;
            --background: 255, 255, 255;
            --secondary-background: 245, 241, 236;
          }
        </style>

        <section class="section">
          <div class="section__color-wrapper">
            <div class="container">
              <header class="section__header text-container">
                <h2 class="heading heading--small">Just for you</h2>
              </header>
              <div class="product product--featured product--thumbnails-bottom">
                <product-media
                  form-id="product-form-template--15880464466141__1651295720d6d36989-8036890083549"
                  autoplay-video
                  thumbnails-position="bottom"
                  reveal-on-scroll
                  product-handle="peach-printed-pure-cotton-salwar-suit"
                  class="product__media"
                  style="--largest-image-aspect-ratio: 1"
                >
                  <div
                    class="product__media-list-wrapper"
                    style="max-width: 2000px"
                  >
                    <flickity-carousel
                      click-nav
                      flickity-config='{
        "adaptiveHeight": true,
        "dragThreshold": 10,
        "initialIndex": ".is-initial-selected",
        "fade": false,
        "draggable": "&gt;1",
        "contain": true,
        "cellSelector": ".product__media-item:not(.is-filtered)",
        "percentPosition": false,
        "pageDots": false,
        "prevNextButtons": false
      }'
                      id="product-template--15880464466141__1651295720d6d36989-8036890083549-media-list"
                      class="product__media-list"
                      ><div
                        id="product-template--15880464466141__1651295720d6d36989-31580871295197"
                        class="product__media-item is-initial-selected is-selected"
                        data-media-type="image"
                        data-media-id="31580871295197"
                        data-original-position="0"
                      >
                        <div
                          class="product__media-image-wrapper aspect-ratio aspect-ratio--natural"
                          style="padding-bottom: 100%; --aspect-ratio: 1"
                        >
                          <img loading="lazy" reveal loading="lazy"
                          sizes="(max-width: 999px) calc(100vw - 48px), 640px"
                          height="2000" width="2000" alt="Peach Printed Pure
                          Cotton Salwar Suit"
                          src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_ee741aff-e0df-4ff5-aa13-f703e5e73e0b.jpg?v=1679570674"
                          ">
                        </div>
                      </div>
                      <div
                        id="product-template--15880464466141__1651295720d6d36989-31580871327965"
                        class="product__media-item"
                        data-media-type="image"
                        data-media-id="31580871327965"
                        data-original-position="1"
                      >
                        <div
                          class="product__media-image-wrapper aspect-ratio aspect-ratio--natural"
                          style="padding-bottom: 100%; --aspect-ratio: 1"
                        >
                          <img loading="lazy" loading="lazy" sizes="(max-width:
                          999px) calc(100vw - 48px), 640px" height="1200"
                          width="1200" alt="Peach Printed Pure Cotton Salwar
                          Suit"
                          src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_69e3d65e-f8a1-4ab7-b8e5-a9a2929858b3.jpg?v=1679570674"
                          ">
                        </div>
                      </div>
                      <div
                        id="product-template--15880464466141__1651295720d6d36989-31580871360733"
                        class="product__media-item"
                        data-media-type="image"
                        data-media-id="31580871360733"
                        data-original-position="2"
                      >
                        <div
                          class="product__media-image-wrapper aspect-ratio aspect-ratio--natural"
                          style="padding-bottom: 100%; --aspect-ratio: 1"
                        >
                          <img loading="lazy" loading="lazy" sizes="(max-width:
                          999px) calc(100vw - 48px), 640px" height="2000"
                          width="2000" alt="Peach Printed Pure Cotton Salwar
                          Suit"
                          src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_eb62bc71-e920-40b7-a529-9b16fc5d96b2.jpg?v=1679570674"
                          ">
                        </div>
                      </div></flickity-carousel
                    ><button
                      is="toggle-button"
                      aria-controls="product-template--15880464466141__1651295720d6d36989-8036890083549-zoom"
                      aria-expanded="false"
                      class="tap-area product__zoom-button"
                    >
                      <span class="visually-hidden">Zoom</span
                      ><svg
                        fill="none"
                        focusable="false"
                        width="14"
                        height="14"
                        class="icon icon--image-zoom"
                        viewBox="0 0 14 14"
                      >
                        <path
                          d="M9.50184 9.50184C11.4777 7.52595 11.5133 4.358 9.58134 2.42602C7.64936 0.494037 4.48141 0.529632 2.50552 2.50552C0.529632 4.48141 0.494037 7.64936 2.42602 9.58134C4.358 11.5133 7.52595 11.4777 9.50184 9.50184ZM9.50184 9.50184L13 13"
                          stroke="currentColor"
                          stroke-width="2"
                        ></path>
                      </svg>
                    </button>
                  </div>
                  <flickity-controls
                    controls="product-template--15880464466141__1651295720d6d36989-8036890083549-media-list"
                    class="product__media-nav"
                  >
                    <button
                      class="product__media-prev-next hidden-lap-and-up tap-area tap-area--large"
                      aria-label="Previous"
                      data-action="prev"
                    >
                      <svg
                        focusable="false"
                        width="17"
                        height="14"
                        class="icon icon--nav-arrow-left icon--direction-aware"
                        viewBox="0 0 17 14"
                      >
                        <path
                          d="M17 7H2M8 1L2 7l6 6"
                          stroke="currentColor"
                          stroke-width="2"
                          fill="none"
                        ></path>
                      </svg>
                    </button>
                    <div class="dots-nav dots-nav--centered hidden-lap-and-up">
                      <button
                        type="button"
                        tabindex="-1"
                        class="dots-nav__item tap-area"
                        aria-current="true"
                        aria-controls="product-template--15880464466141__1651295720d6d36989-31580871295197"
                        data-media-id="31580871295197"
                        data-action="select"
                      >
                        <span class="visually-hidden"
                          >Go to slide 1</span
                        ></button
                      ><button
                        type="button"
                        tabindex="-1"
                        class="dots-nav__item tap-area"
                        aria-controls="product-template--15880464466141__1651295720d6d36989-31580871327965"
                        data-media-id="31580871327965"
                        data-action="select"
                      >
                        <span class="visually-hidden"
                          >Go to slide 2</span
                        ></button
                      ><button
                        type="button"
                        tabindex="-1"
                        class="dots-nav__item tap-area"
                        aria-controls="product-template--15880464466141__1651295720d6d36989-31580871360733"
                        data-media-id="31580871360733"
                        data-action="select"
                      >
                        <span class="visually-hidden">Go to slide 3</span>
                      </button>
                    </div>
                    <scroll-shadow
                      class="product__thumbnail-scroll-shadow hidden-pocket"
                    >
                      <div class="product__thumbnail-list hide-scrollbar">
                        <div class="product__thumbnail-list-inner">
                          <button
                            type="button"
                            tabindex="-1"
                            reveal
                            class="product__thumbnail-item hidden-pocket"
                            aria-current="true"
                            aria-controls="product-template--15880464466141__1651295720d6d36989-31580871295197"
                            data-media-id="31580871295197"
                            data-action="select"
                          >
                            <div class="product__thumbnail">
                              <img loading="lazy" sizes="(max-width: 999px)
                              72px, 60px" height="2000" width="2000" alt="Peach
                              Printed Pure Cotton Salwar Suit"
                              src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_ee741aff-e0df-4ff5-aa13-f703e5e73e0b.jpg?v=1679570674"
                              ">
                            </div></button
                          ><button
                            type="button"
                            tabindex="-1"
                            reveal
                            class="product__thumbnail-item hidden-pocket"
                            aria-controls="product-template--15880464466141__1651295720d6d36989-31580871327965"
                            data-media-id="31580871327965"
                            data-action="select"
                          >
                            <div class="product__thumbnail">
                              <img loading="lazy" sizes="(max-width: 999px)
                              72px, 60px" height="1200" width="1200" alt="Peach
                              Printed Pure Cotton Salwar Suit"
                              src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_69e3d65e-f8a1-4ab7-b8e5-a9a2929858b3.jpg?v=1679570674"
                              ">
                            </div></button
                          ><button
                            type="button"
                            tabindex="-1"
                            reveal
                            class="product__thumbnail-item hidden-pocket"
                            aria-controls="product-template--15880464466141__1651295720d6d36989-31580871360733"
                            data-media-id="31580871360733"
                            data-action="select"
                          >
                            <div class="product__thumbnail">
                              <img loading="lazy" sizes="(max-width: 999px)
                              72px, 60px" height="2000" width="2000" alt="Peach
                              Printed Pure Cotton Salwar Suit"
                              src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_eb62bc71-e920-40b7-a529-9b16fc5d96b2.jpg?v=1679570674"
                              ">
                            </div>
                          </button>
                        </div>
                      </div>
                    </scroll-shadow>

                    <button
                      class="product__media-prev-next hidden-lap-and-up tap-area tap-aera--large"
                      aria-label="Next"
                      data-action="next"
                    >
                      <svg
                        focusable="false"
                        width="17"
                        height="14"
                        class="icon icon--nav-arrow-right icon--direction-aware"
                        viewBox="0 0 17 14"
                      >
                        <path
                          d="M0 7h15M9 1l6 6-6 6"
                          stroke="currentColor"
                          stroke-width="2"
                          fill="none"
                        ></path>
                      </svg>
                    </button> </flickity-controls
                  ><product-image-zoom
                    product-handle="peach-printed-pure-cotton-salwar-suit"
                    id="product-template--15880464466141__1651295720d6d36989-8036890083549-zoom"
                    class="pswp"
                    tabindex="-1"
                    role="dialog"
                  >
                    <div class="pswp__bg"></div>

                    <div class="pswp__scroll-wrap">
                      <div class="pswp__container">
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                        <div class="pswp__item"></div>
                      </div>

                      <div class="pswp__ui pswp__ui--hidden">
                        <div class="pswp__top-bar">
                          <button
                            class="pswp__button pswp__button--close prev-next-button"
                            data-action="pswp-close"
                            title="Close"
                          >
                            <svg
                              focusable="false"
                              width="14"
                              height="14"
                              class="icon icon--close"
                              viewBox="0 0 14 14"
                            >
                              <path
                                d="M13 13L1 1M13 1L1 13"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                              ></path>
                            </svg>
                          </button>
                        </div>

                        <div class="pswp__prev-next-buttons hidden-pocket">
                          <button
                            class="pswp__button prev-next-button prev-next-button--prev"
                            data-action="pswp-prev"
                            title="Previous"
                          >
                            <svg
                              focusable="false"
                              width="17"
                              height="14"
                              class="icon icon--nav-arrow-left icon--direction-aware"
                              viewBox="0 0 17 14"
                            >
                              <path
                                d="M17 7H2M8 1L2 7l6 6"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                              ></path>
                            </svg>
                          </button>
                          <button
                            class="pswp__button prev-next-button prev-next-button--next"
                            data-action="pswp-next"
                            title="Next"
                          >
                            <svg
                              focusable="false"
                              width="17"
                              height="14"
                              class="icon icon--nav-arrow-right icon--direction-aware"
                              viewBox="0 0 17 14"
                            >
                              <path
                                d="M0 7h15M9 1l6 6-6 6"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                              ></path>
                            </svg>
                          </button>
                        </div>

                        <div class="pswp__dots-nav-wrapper hidden-lap-and-up">
                          <button
                            class="tap-area tap-area--large"
                            data-action="pswp-prev"
                          >
                            <span class="visually-hidden">Previous</span
                            ><svg
                              focusable="false"
                              width="17"
                              height="14"
                              class="icon icon--nav-arrow-left icon--direction-aware"
                              viewBox="0 0 17 14"
                            >
                              <path
                                d="M17 7H2M8 1L2 7l6 6"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                              ></path>
                            </svg>
                          </button>

                          <div class="dots-nav dots-nav--centered">
                            <!-- This will be fill at runtime as the number of items will be dynamic -->
                          </div>

                          <button
                            class="tap-area tap-area--large"
                            data-action="pswp-next"
                          >
                            <span class="visually-hidden">Next</span
                            ><svg
                              focusable="false"
                              width="17"
                              height="14"
                              class="icon icon--nav-arrow-right icon--direction-aware"
                              viewBox="0 0 17 14"
                            >
                              <path
                                d="M0 7h15M9 1l6 6-6 6"
                                stroke="currentColor"
                                stroke-width="2"
                                fill="none"
                              ></path>
                            </svg>
                          </button>
                        </div>
                      </div>
                    </div> </product-image-zoom
                ></product-media>
                <div class="product__info">
                  <!-- PRODUCT META -->
                  <product-meta
                    form-id="product-form-template--15880464466141__1651295720d6d36989-8036890083549"
                    price-class="price--large"
                    class="product-meta"
                  >
                    <h2 class="product-meta__title heading h4">
                      <a href="product-detail.php"
                        >Peach Printed Pure Cotton Salwar Suit</a
                      >
                    </h2>

                    <div
                      class="product-meta__price-list-container"
                      role="region"
                      aria-live="polite"
                    >
                      <div class="price-list" data-product-price-list>
                        <span class="price price--highlight price--large">
                          <span class="visually-hidden">Sale price</span
                          ><span class="money" style="color: #13becf"
                            >₹899.00</span
                          ></span
                        >

                        <span class="price price--compare">
                          <span class="visually-hidden">Regular price</span
                          ><span class="money">₹1,799.00</span></span
                        >
                      </div>

                      <div
                        class="product-meta__label-list label-list"
                        data-product-label-list
                      >
                        <span
                          class="label label--highlight"
                          style="background-color: #13becf"
                          >Save 50%</span
                        >
                      </div>
                    </div>
                    <p class="product-meta__taxes-included text--small">
                      <span>Inclusive of all taxes</span>
                      <span class="stock true"> In Stock </span>
                    </p>
                    <product-payment-terms
                      form-id="product-form-template--15880464466141__1651295720d6d36989-8036890083549"
                      ><form
                        method="post"
                        action="/cart/add"
                        id="product-installment-form-template--15880464466141__1651295720d6d36989-8036890083549"
                        accept-charset="UTF-8"
                        class="shopify-product-form"
                        enctype="multipart/form-data"
                      >
                        <input
                          type="hidden"
                          name="form_type"
                          value="product"
                        /><input type="hidden" name="utf8" value="✓" /><input
                          type="hidden"
                          name="id"
                          value="43775632310493"
                        /></form
                    ></product-payment-terms>
                    <div class="product-meta__reference">
                      <a
                        href="/products/peach-printed-pure-cotton-salwar-suit#product-8036890083549-reviews-pocket"
                        is="review-link"
                        onclick="document.querySelector('#product-8036890083549-reviews-pocket').click()"
                        data-smooth-scroll
                        class="product-meta__reviews-badge hidden-lap-and-up"
                      >
                      </a>
                      <a
                        href="/products/peach-printed-pure-cotton-salwar-suit#product-8036890083549-tabs"
                        is="review-link"
                        onclick="document.querySelector('#product-8036890083549-reviews-desktop').click()"
                        data-smooth-scroll
                        class="product-meta__reviews-badge hidden-pocket"
                      >
                      </a></div
                  ></product-meta>
                  <script>
                    var productSKU = "ZULFT-DINAAZ2-481-003";
                  </script>
                  <div class="product-form">
                    <div
                      class="product-form__option-info"
                      style="margin-bottom: 0"
                    >
                      <span class="product-form__option-name">Color:</span>
                      <span id="option-e" class="product-form__option-value"
                        >Peach</span
                      >
                    </div>
                    <div class="variant-swatch-list" style="margin-top: -15px">
                      <a href="product-detail.php">
                        <div class="variant-swatch">
                          <label
                            class="variant-swatch__item"
                            for="8036890116317-1"
                          >
                            <img
                              loading="lazy"
                              class="variant-swatch__image"
                              sizes="(max-width: 740px) 64px, 72px"
                              height="2000"
                              width="2000"
                              alt="Green Printed Pure Cotton Salwar Suit"
                              src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_9e3f4275-b064-43c7-a5ad-1c2b008c0b29.jpg?v=1679570683"
                            />
                          </label>
                        </div>
                      </a>

                      <a href="product-detail.php">
                        <div class="variant-swatch">
                          <label
                            class="variant-swatch__item"
                            for="8036890968285-2"
                          >
                            <img
                              loading="lazy"
                              class="variant-swatch__image"
                              sizes="(max-width: 740px) 64px, 72px"
                              height="2000"
                              width="2000"
                              alt="Chikoo Printed Pure Cotton Salwar Suit"
                              src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_1afed723-9f3b-4223-a7c9-acfb4013cd70.jpg?v=1679570744"
                            />
                          </label>
                        </div>
                      </a>

                      <a href="product-detail.php">
                        <div class="variant-swatch">
                          <label
                            class="variant-swatch__item"
                            for="8036890050781-3"
                          >
                            <img
                              loading="lazy"
                              class="variant-swatch__image"
                              sizes="(max-width: 740px) 64px, 72px"
                              height="2000"
                              width="2000"
                              alt="Blue Printed Pure Cotton Salwar Suit"
                              src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_24fd46da-1b56-43c9-957a-344957c2c7fc.jpg?v=1679570665"
                            />
                          </label>
                        </div>
                      </a>

                      <a href="product-detail.php">
                        <div class="variant-swatch">
                          <label
                            class="variant-swatch__item"
                            for="8036890411229-4"
                          >
                            <img
                              loading="lazy"
                              class="variant-swatch__image"
                              sizes="(max-width: 740px) 64px, 72px"
                              height="2000"
                              width="2000"
                              alt="Grey Printed Pure Cotton Salwar Suit"
                              src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_9af00259-9f0a-4bb1-8ede-2129e77d4589.jpg?v=1679570703"
                            />
                          </label>
                        </div>
                      </a>

                      <a href="product-detail.php">
                        <div class="variant-swatch">
                          <label
                            class="variant-swatch__item"
                            for="8036889985245-5"
                          >
                            <img
                              loading="lazy"
                              class="variant-swatch__image"
                              sizes="(max-width: 740px) 64px, 72px"
                              height="2000"
                              width="2000"
                              alt="Pink Printed Pure Cotton Salwar Suit"
                              src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_70b7e898-2502-4e4e-854b-35b2d324b758.jpg?v=1679570656"
                            />
                          </label>
                        </div>
                      </a>

                      <a href="product-detail.php">
                        <div class="variant-swatch">
                          <label
                            class="variant-swatch__item"
                            for="8036890247389-6"
                          >
                            <img
                              loading="lazy"
                              class="variant-swatch__image"
                              sizes="(max-width: 740px) 64px, 72px"
                              height="2000"
                              width="2000"
                              alt="Pink Printed Pure Cotton Salwar Suit"
                              src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_d37483ca-0371-4a80-ae99-613159b0b314.jpg?v=1679570693"
                            />
                          </label>
                        </div>
                      </a>

                      <a href="product-detail.php">
                        <div class="variant-swatch">
                          <label
                            class="variant-swatch__item"
                            for="8036890575069-8"
                          >
                            <img
                              loading="lazy"
                              class="variant-swatch__image"
                              sizes="(max-width: 740px) 64px, 72px"
                              height="2000"
                              width="2000"
                              alt="Yellow Printed Pure Cotton Salwar Suit"
                              src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_2e82bdbd-2489-46e0-a88c-df3a9b313066.jpg?v=1679570715"
                            />
                          </label>
                        </div>
                      </a>

                      <a href="product-detail.php">
                        <div class="variant-swatch">
                          <label
                            class="variant-swatch__item"
                            for="8036890673373-9"
                          >
                            <img
                              loading="lazy"
                              class="variant-swatch__image"
                              sizes="(max-width: 740px) 64px, 72px"
                              height="2000"
                              width="2000"
                              alt="Turquoise Printed Pure Cotton Salwar Suit"
                              src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_f6a8d2d2-27b2-423d-8aaf-0e09511b2eca.jpg?v=1679570725"
                            />
                          </label>
                        </div>
                      </a>
                    </div>

                    <div class="product-form__quantity">
                      <span class="product-form__quantity-label"
                        >Quantity:</span
                      >

                      <quantity-selector class="quantity-selector">
                        <button type="button" class="quantity-selector__button">
                          <span class="visually-hidden">Decrease quantity</span
                          ><svg
                            focusable="false"
                            width="10"
                            height="2"
                            class="icon icon--minus-big"
                            viewBox="0 0 10 2"
                          >
                            <path fill="currentColor" d="M0 0h10v2H0z"></path>
                          </svg>
                        </button>

                        <input
                          type="text"
                          form="product-form-template--15880464466141__1651295720d6d36989-8036890083549"
                          is="input-number"
                          class="quantity-selector__input"
                          inputmode="numeric"
                          name="quantity"
                          autocomplete="off"
                          min="1"
                          value="1"
                          size="2"
                          aria-label="Quantity"
                        />

                        <button type="button" class="quantity-selector__button">
                          <span class="visually-hidden">Increase quantity</span
                          ><svg
                            focusable="false"
                            width="10"
                            height="10"
                            class="icon icon--plus-big"
                            viewBox="0 0 10 10"
                          >
                            <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M4 6v4h2V6h4V4H6V0H4v4H0v2h4z"
                              fill="currentColor"
                            ></path>
                          </svg>
                        </button>
                      </quantity-selector>
                    </div>
                    <div class="product-form__buy-buttons">
                      <form
                        method="post"
                        action="/cart/add"
                        id="product-form-template--15880464466141__1651295720d6d36989-8036890083549"
                        accept-charset="UTF-8"
                        class="shopify-product-form"
                        enctype="multipart/form-data"
                        is="product-form"
                      >
                        <input
                          type="hidden"
                          name="form_type"
                          value="product"
                        /><input type="hidden" name="utf8" value="✓" /><input
                          type="hidden"
                          disabled
                          name="id"
                          value="43775632310493"
                        />

                        <product-payment-container
                          form-id="product-form-template--15880464466141__1651295720d6d36989-8036890083549"
                          class="product-form__payment-container"
                        >
                          <button
                            id="AddToCart"
                            type="submit"
                            is="loader-button"
                            data-product-add-to-cart-button
                            data-button-content="Add to cart"
                            class="product-form__add-button button button--secondary button--full"
                          >
                            Add to cart
                          </button>
                          <div
                            data-shopify="payment-button"
                            data-has-selling-plan="false"
                            data-has-fixed-selling-plan="false"
                            class="shopify-payment-button"
                          >
                            <button
                              class="shopify-payment-button__button shopify-payment-button__button--unbranded shopify-payment-button__button--hidden"
                              disabled="disabled"
                              aria-hidden="true"
                            ></button
                            ><button
                              class="shopify-payment-button__more-options shopify-payment-button__button--hidden"
                              disabled="disabled"
                              aria-hidden="true"
                            ></button>
                          </div>
                        </product-payment-container>
                      </form>
                    </div>
                    <store-pickup
                      form-id="product-form-template--15880464466141__1651295720d6d36989-8036890083549"
                      class="product-form__store-availability-container"
                    ></store-pickup>
                  </div>
                  <div class="product-meta__aside">
                    <div class="product-meta__share text--subdued">
                      <div class="product-meta__share-label">Share</div>

                      <div class="product-meta__share-button-list">
                        <a
                          class="product-meta__share-button-item product-meta__share-button-item--facebook link tap-area"
                          href="https://www.facebook.com/sharer.php?u=https://peachmode.com/products/peach-printed-pure-cotton-salwar-suit"
                          target="_blank"
                          rel="noopener"
                          aria-label="Share on Facebook"
                          ><svg
                            focusable="false"
                            width="8"
                            height="14"
                            class="icon icon--facebook"
                            viewBox="0 0 9 17"
                          >
                            <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M2.486 16.2084L2.486 8.81845H0L0 5.93845L2.486 5.93845L2.486 3.81845C2.38483 2.79982 2.73793 1.78841 3.45107 1.05407C4.16421 0.319722 5.16485 -0.0628415 6.186 0.00844868C6.9284 0.00408689 7.67039 0.0441585 8.408 0.128449V2.69845L6.883 2.69845C6.4898 2.61523 6.08104 2.73438 5.79414 3.01585C5.50724 3.29732 5.3803 3.70373 5.456 4.09845L5.456 5.93845H8.308L7.936 8.81845H5.46L5.46 16.2084H2.486Z"
                              fill="currentColor"
                            ></path></svg
                        ></a>
                        <a
                          class="product-meta__share-button-item product-meta__share-button-item--facebook link tap-area"
                          href="https://api.whatsapp.com/send?text=https://peachmode.com/products/peach-printed-pure-cotton-salwar-suit"
                          target="_blank"
                          rel="noopener"
                          aria-label="Share on Whatsapp"
                          ><svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="13"
                            height="13"
                            viewBox="0 0 24 24"
                          >
                            <path
                              fill="currentColor"
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"
                            /></svg
                        ></a>

                        <a
                          class="product-meta__share-button-item product-meta__share-button-item--pinterest link tap-area"
                          href="https://pinterest.com/pin/create/button/?url=https://peachmode.com/products/peach-printed-pure-cotton-salwar-suit&media=https://cdn.shopify.com/s/files/1/0637/4834/1981/products/file_ee741aff-e0df-4ff5-aa13-f703e5e73e0b_800x.jpg?v=1679570674&description=Peach%20colored%20suit%20is%20prettified%20with%20print%20work%20as%20shown%20which%20makes%20it%20appear%20classy...."
                          target="_blank"
                          rel="noopener"
                          aria-label="Pin on Pinterest"
                          ><svg
                            focusable="false"
                            width="10"
                            height="14"
                            class="icon icon--pinterest"
                            viewBox="0 0 12 16"
                          >
                            <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M5.8042 0.00123531C8.79537 -0.0442356 10.6685 1.16769 11.5498 3.29299C11.8407 3.99433 12.1516 5.28439 11.9181 6.35474C11.825 6.78208 11.7985 7.22812 11.6726 7.63086C11.4163 8.4496 11.0829 9.17441 10.6413 9.79945C10.0418 10.6486 9.13196 11.2212 7.98951 11.5091C6.97899 11.7637 6.04959 11.3826 5.50954 10.9732C5.33747 10.843 5.10674 10.6728 5.04304 10.4377C5.03488 10.4377 5.0267 10.4377 5.01853 10.4377C4.97972 10.8669 4.81532 11.3224 4.69924 11.7135C4.53858 12.2545 4.50733 12.8146 4.3064 13.3208C4.08349 13.8828 3.81274 14.3978 3.52072 14.8776C3.36739 15.1292 2.94427 15.9904 2.63675 16C2.60311 15.9354 2.58964 15.9105 2.58761 15.796C2.48858 15.6383 2.55757 15.3724 2.51393 15.1578C2.44604 14.8236 2.39317 14.2217 2.46491 13.8824C2.46491 13.7038 2.46491 13.5248 2.46491 13.3465C2.54397 12.9786 2.54085 12.6015 2.63675 12.2494C2.84537 11.4824 2.96145 10.6699 3.17692 9.87611C3.38398 9.11352 3.57396 8.27939 3.74172 7.50321C3.77957 7.32789 3.56652 6.82389 3.52072 6.63572C3.37628 6.04186 3.48624 5.21874 3.66805 4.77269C3.89698 4.21111 4.56717 3.3535 5.43589 3.57359C6.13407 3.75039 6.57846 4.50528 6.34437 5.46192C6.09862 6.46589 5.7798 7.3653 5.5587 8.37035C5.50173 8.62933 5.59968 8.90442 5.65687 9.05958C5.86357 9.61934 6.49037 10.163 7.32652 9.95278C8.59396 9.63365 9.15431 8.48627 9.53645 7.24791C9.63981 6.91302 9.62743 6.59647 9.70831 6.22709C9.87894 5.44763 9.80648 4.28411 9.56098 3.67556C9.16753 2.70023 8.43329 2.07518 7.42471 1.73624C7.1465 1.68526 6.86819 1.63427 6.58988 1.58329C6.12397 1.47655 5.23532 1.63685 4.92023 1.73624C3.51171 2.18156 2.63952 2.92544 2.09658 4.26247C1.91177 4.71767 1.81046 5.17911 1.77741 5.81884C1.76913 5.8955 1.76094 5.97217 1.75278 6.04883C1.86153 6.62068 1.87259 6.99959 2.09658 7.42657C2.20715 7.63711 2.46971 7.8029 2.51393 8.06444C2.54001 8.2185 2.42705 8.45105 2.39125 8.57467C2.33705 8.76137 2.35676 8.97522 2.26844 9.13625C2.10873 9.42678 1.67383 9.20852 1.48275 9.08491C0.489307 8.44373 -0.329526 6.5895 0.132284 4.79837C0.20342 4.5218 0.206915 4.28118 0.304126 4.03285C0.906661 2.49554 1.80565 1.55101 3.10325 0.741098C3.58947 0.437749 4.24511 0.287354 4.84657 0.128885C5.16574 0.0863481 5.48503 0.0437917 5.8042 0.00123531Z"
                              fill="currentColor"
                            ></path></svg
                        ></a>

                        <a
                          class="product-meta__share-button-item product-meta__share-button-item--twitter link tap-area"
                          href="https://twitter.com/share?text=Peach%20Printed%20Pure%20Cotton%20Salwar%20Suit&url=https://peachmode.com/products/peach-printed-pure-cotton-salwar-suit"
                          target="_blank"
                          rel="noopener"
                          aria-label="Tweet on Twitter"
                          ><svg
                            focusable="false"
                            width="17"
                            height="14"
                            class="icon icon--twitter"
                            viewBox="0 0 20 16"
                          >
                            <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M12.845 2.13398C14.0997 2.11363 14.7676 2.53229 15.4054 3.06445C15.9468 3.02216 16.6505 2.74528 17.065 2.55232C17.1993 2.48493 17.3337 2.41786 17.468 2.35046C17.2312 2.93602 16.9103 3.39474 16.417 3.74251C16.3074 3.81976 16.1987 3.92434 16.0613 3.97362C16.0613 3.97584 16.0613 3.97838 16.0613 3.98061C16.7643 3.97394 17.3441 3.6837 17.8947 3.52603C17.8947 3.52856 17.8947 3.5311 17.8947 3.53365C17.6055 3.95454 17.214 4.38147 16.7963 4.6876C16.6277 4.8103 16.4591 4.93301 16.2905 5.05571C16.2997 5.73696 16.2795 6.38704 16.1404 6.95989C15.3314 10.2888 13.1878 12.5491 9.7945 13.517C8.5761 13.8648 6.60702 14.0075 5.21102 13.6903C4.51872 13.5329 3.89334 13.3552 3.30644 13.1203C2.98052 12.9896 2.67854 12.8485 2.38972 12.6876C2.29496 12.6346 2.2001 12.5818 2.10522 12.5287C2.42018 12.5376 2.78846 12.6168 3.14052 12.5649C3.45896 12.5179 3.77128 12.53 4.06514 12.4712C4.79794 12.324 5.4486 12.1294 6.00916 11.829C6.2809 11.6834 6.69324 11.5124 6.88634 11.3026C6.52248 11.3083 6.19256 11.2311 5.9223 11.144C4.87436 10.8051 4.26436 10.1824 3.86752 9.2468C4.1851 9.27827 5.09982 9.35394 5.31368 9.18894C4.91398 9.16891 4.52956 8.95688 4.25478 8.7992C3.41184 8.31634 2.72438 7.50634 2.72954 6.26021C2.84022 6.30821 2.9509 6.35653 3.06148 6.40453C3.27324 6.48622 3.48848 6.52978 3.74112 6.57778C3.8478 6.59781 4.06114 6.65534 4.18362 6.6137C4.17836 6.6137 4.17308 6.6137 4.16782 6.6137C4.00476 6.43982 3.73902 6.32411 3.57512 6.1375C3.03438 5.52206 2.52758 4.57507 2.84812 3.44686C2.9294 3.16077 3.05842 2.90805 3.19586 2.67502C3.20114 2.67757 3.2064 2.67979 3.21168 2.68234C3.2746 2.80282 3.415 2.89152 3.50408 2.99229C3.78024 3.30573 4.1209 3.5877 4.46812 3.83629C5.65108 4.68347 6.71642 5.20386 8.42738 5.58946C8.86134 5.68706 9.36308 5.76176 9.88146 5.76238C9.73578 5.37424 9.78258 4.7461 9.89726 4.37035C10.1856 3.42557 10.8119 2.74402 11.7307 2.37907C11.9504 2.29197 12.1941 2.22838 12.4498 2.17722C12.5815 2.16291 12.7133 2.14861 12.845 2.13398Z"
                              fill="currentColor"
                            ></path></svg
                        ></a>

                        <a
                          class="product-meta__share-button-item product-meta__share-button-item--mail link tap-area"
                          href="mailto:?&subject=Peach Printed Pure Cotton Salwar Suit&body=https://peachmode.com/products/peach-printed-pure-cotton-salwar-suit"
                          aria-label="Share by e-mail"
                          ><svg
                            focusable="false"
                            width="13"
                            height="13"
                            class="icon icon--share"
                            viewBox="0 0 18 18"
                          >
                            <path
                              d="M17 1l-5.6 16-3.2-7.2M17 1L1 6.6l7.2 3.2M17 1L8.2 9.8"
                              fill="none"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            ></path></svg
                        ></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <div
        id="shopify-section-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2"
        class="shopify-section shopify-section--featured-collections"
      >
        <style>
          #shopify-section-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2 {
            --heading-color: 26, 26, 26;
            --text-color: 34, 34, 34;
            --primary-button-background: 241, 63, 98;
            --primary-button-text-color: 255, 255, 255;

            --prev-next-button-background: 255, 255, 255;
            --prev-next-button-color: 34, 34, 34;

            --section-background: 255, 255, 255;
            --section-products-per-row: 2;
          }

          @media screen and (min-width: 741px) {
            #shopify-section-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2 {
              --section-products-per-row: 3;
            }
          }

          @media screen and (min-width: 1000px) {
            #shopify-section-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2 {
              --section-products-per-row: 4;
            }
          }

          @media screen and (min-width: 1200px) {
            #shopify-section-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2 {
              --section-products-per-row: 4;
            }
          }
        </style>

        <section class="section">
          <div class="section__color-wrapper">
            <div class="container">
              <header class="section__header">
                <div class="text-container">
                  <h3 class="heading h2">Jaipuri Kurti Sets</h3>
                </div>
              </header>
              <div class="featured-collections">
                <product-list
                  id="block-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0"
                  class="product-list product-list--center"
                >
                  <div>
                    <div class="product-list__inner">
                      <product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 50%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31609845579997" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Plum Violet
                            Printed With Embroidered Rayon Kurti With Dhoti Set"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_f5327d0d-3d6a-4208-bb34-ed260776135f.jpg?v=1680345086"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Plum Violet Printed With
                            Embroidered Rayon Kurti With Dhoti Set"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_520df737-338f-4385-b762-cf518cd9130c.jpg?v=1680345092"
                            "></a
                          >
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8041673654493-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8041673654493-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8041673654493-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8041673654493-popover"
                            href="/products/purple-printed-with-embroidered-rayon-kurti-with-dhoti-set?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8041673654493-drawer"
                            href="/products/purple-printed-with-embroidered-rayon-kurti-with-dhoti-set?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Plum Violet Printed With Embroidered ...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹1,399.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹2,799.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 50%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31609823101149" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Yellow
                            Printed Pure Cotton Salwar Suit"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_333184ac-63e4-45d3-8161-1ab81b345eb1.jpg?v=1680344643"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Yellow Printed Pure Cotton Salwar
                            Suit"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_88726a04-a860-4960-9da6-0c0485eee8d7.jpg?v=1680344649"
                            "></a
                          >
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8041673097437-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8041673097437-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8041673097437-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8041673097437-popover"
                            href="/products/yellow-printed-pure-cotton-salwar-suit-1?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8041673097437-drawer"
                            href="/products/yellow-printed-pure-cotton-salwar-suit-1?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Yellow Printed Pure Cotton Salwar Suit</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹1,499.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹2,999.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 50%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31609818874077" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Blue Printed
                            Pure Cotton Top"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_57027bd9-ebb5-44a0-805f-8c155eea30e7.jpg?v=1680343972"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Blue Printed Pure Cotton Top"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/file_2c64f7c7-7dbe-43ae-942f-d82174b1f274.jpg?v=1680343977"
                            "></a
                          >
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8041672573149-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8041672573149-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8041672573149-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8041672573149-popover"
                            href="/products/blue-printed-pure-cotton-top?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8041672573149-drawer"
                            href="/products/blue-printed-pure-cotton-top?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Blue Printed Pure Cotton Top</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹599.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹1,199.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div> </product-item
                      ><product-item class="product-item"
                        ><div
                          class="product-item__image-wrapper product-item__image-wrapper--multiple"
                        >
                          <div class="product-item__label-list label-list">
                            <span
                              class="label label--highlight"
                              style="background-color: #13becf"
                              >Save 50%</span
                            >
                          </div>
                          <a
                            href="product-detail.php"
                            class="product-item__aspect-ratio aspect-ratio aspect-ratio--square"
                            style="padding-bottom: 100%; --aspect-ratio: 1"
                          >
                            <img loading="lazy"
                            class="product-item__primary-image"
                            data-media-id="31604869660893" sizes="(max-width:
                            740px) 52vw, calc(min(100vw - 80px, 1520px) / 4 -
                            18px)" height="2000" width="2000" alt="Mustard
                            Floral Printed Pure Cotton Salwar Suit"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/1_AARD-NAMAH-1499-MUSTRD-PEACHMODE.jpg?v=1680172771"
                            "><img loading="lazy"
                            class="product-item__secondary-image"
                            sizes="(max-width: 740px) 52vw, calc(min(100vw -
                            80px, 1520px) / 4 - 18px)" height="2000"
                            width="2000" alt="Mustard Floral Printed Pure Cotton
                            Salwar Suit"
                            src="//cdn.shopify.com/s/files/1/0637/4834/1981/products/2_AARD-NAMAH-1499-MUSTRD-PEACHMODE.jpg?v=1680172772"
                            "></a
                          >
                          <div class="product-item__quick-form">
                            <button
                              is="toggle-button"
                              loader
                              aria-controls="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8039739162845-drawer"
                              aria-expanded="false"
                              class="button button--outline button--text button--full hidden-touch hidden-phone"
                            >
                              Quick view
                            </button>
                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8039739162845-drawer"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-no-touch hidden-phone"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>

                            <button
                              is="toggle-button"
                              aria-controls="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8039739162845-popover"
                              aria-expanded="false"
                              class="product-item__quick-buy-button hidden-tablet-and-up"
                            >
                              <span class="visually-hidden">Quick view</span
                              ><svg
                                focusable="false"
                                width="24"
                                height="24"
                                class="icon icon--quick-buy-shopping-cart"
                                fill="none"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  d="M1 3H5L6 13H18L20 6H18"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                                <circle
                                  cx="7"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <circle
                                  cx="17"
                                  cy="19"
                                  r="2"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></circle>
                                <path
                                  d="M12 2V10M8 6H16"
                                  stroke="currentColor"
                                  stroke-width="2"
                                ></path>
                              </svg>
                            </button>
                          </div>

                          <quick-buy-popover
                            id="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8039739162845-popover"
                            href="/products/mustard-floral-printed-pure-cotton-salwar-suit?view=quick-buy-popover"
                            class="popover popover--quick-buy hidden-tablet-and-up"
                          ></quick-buy-popover>
                          <quick-buy-drawer
                            id="product-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-template--15880464466141__e32645d3-fcef-4ce0-8f64-4f0b8c94b1d2-166745958805805e9f-0-8039739162845-drawer"
                            href="/products/mustard-floral-printed-pure-cotton-salwar-suit?view=quick-buy-drawer"
                            class="drawer drawer--large drawer--quick-buy hidden-phone"
                          ></quick-buy-drawer>
                        </div>

                        <div class="product-item__info">
                          <div class="product-item-meta">
                            <a
                              href="product-detail.php"
                              class="product-item-meta__title"
                              >Mustard Floral Printed Pure Cotton Sa...</a
                            >

                            <div
                              class="product-item-meta__price-list-container"
                            >
                              <div class="price-list price-list--centered">
                                <span class="price price--highlight">
                                  <span class="visually-hidden">Sale price</span
                                  ><span class="money" style="color: #13becf"
                                    >₹999.00</span
                                  ></span
                                >

                                <span class="price price--compare">
                                  <span class="visually-hidden"
                                    >Regular price</span
                                  ><span class="money">₹1,999.00</span></span
                                >
                              </div>
                            </div>
                          </div>
                        </div>
                      </product-item>
                    </div>
                  </div>
                  <div class="section__footer">
                    <a class="button button--primary" href="product.php"
                      >View All</a
                    >
                  </div></product-list
                >
              </div>
            </div>
          </div>
        </section>
      </div>
      <div
        id="shopify-section-template--15880464466141__8a4f17bc-f5be-42c2-a249-f34d83dd5511"
        class="shopify-section shopify-section--rich-text"
      >
        <style>
          #shopify-section-template--15880464466141__8a4f17bc-f5be-42c2-a249-f34d83dd5511 {
            --heading-color: 26, 26, 26;
            --text-color: 34, 34, 34;
            --primary-button-background: 241, 63, 98;
            --primary-button-text-color: 255, 255, 255;

            --section-background: 255, 255, 255;
          }
        </style>

        <section class="section">
          <div>
            <div class="section__color-wrapper" style="color: #13becf">
              <div class="container">
                <div
                  class="content-box content-box--medium content-box--text-center content-box--center text-container"
                >
                  <h3 class="heading h2">Happy Customers</h3>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <div
        id="shopify-section-template--15880464466141__1652853782fd2055cb"
        class="shopify-section shopify-section--apps"
      >
        <div class=" ">
          <div
            id="shopify-block-b50961f1-c2a6-4366-ba4e-29d4973e26dd"
            class="shopify-block shopify-app-block"
          >
            <div
              class="loox-v2-carousel-container"
              id="LOOX-V2_CAROUSEL-b50961f1-c2a6-4366-ba4e-29d4973e26dd"
              data-widget="carousel"
              data-slide-type="gallery"
              data-max-width="1600"
              data-border-radius="24"
              data-items-per-view="5"
              data-image-ratio="1.25"
              data-reviewer-name-color="ffffff"
              data-stars-color="ffffff"
              data-arrows_background-color="ffffff"
              data-arrows_icon-color="9a9a9a"
              data-shadow="basic"
              data-border_active="no"
              data-border_width="2"
              data-border_color="000000"
              data-product-ids=""
              data-customer-locale="en"
            ></div>
          </div>
        </div>
      </div>
      <div
        id="shopify-section-template--15880464466141__newsletter"
        class="shopify-section shopify-section--newsletter"
      >
        <style>
          #shopify-section-template--15880464466141__newsletter {
            --heading-color: 26, 26, 26;
            --text-color: 34, 34, 34;
            --primary-button-background: 241, 63, 98;
            --primary-button-text-color: 255, 255, 255;
            --section-block-background: 247, 247, 247;
          }
        </style>

        <section class="section section--flush">
          <image-with-text-block
            reveal-on-scroll
            class="image-with-text-block image-with-text-block--small image-with-text-block--cover"
          >
            <div class="image-with-text-block__image-wrapper">
              <img
                loading="lazy"
                class="image-with-text-block__image"
                reveal
                sizes="100vw"
                height="1200"
                width="1200"
                alt=""
                src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/AI2527C5-profile.jpg?v=1652242536"
              />
            </div>

            <div class="container container--flush">
              <div
                reveal
                class="image-with-text-block__content image-with-text-block__content--tight content-box content-box--small content-box--text-center content-box--center text-container"
              >
                <h2 class="heading heading--small">
                  Subscribe to our Newsletter
                </h2>
                <form
                  method="post"
                  action="/contact#newsletter-template--15880464466141__newsletter"
                  id="newsletter-template--15880464466141__newsletter"
                  accept-charset="UTF-8"
                  class="form newsletter__form"
                >
                  <input
                    type="hidden"
                    name="form_type"
                    value="customer"
                  /><input type="hidden" name="utf8" value="✓" /><input
                    type="hidden"
                    name="contact[tags]"
                    value="newsletter"
                  />
                  <input
                    type="hidden"
                    name="contact[context]"
                    value="newsletter-template--15880464466141__newsletter"
                  />

                  <div class="input-row">
                    <div class="input">
                      <input
                        type="email"
                        id="newsletter[template--15880464466141__newsletter][contact][email]"
                        name="contact[email]"
                        class="input__field"
                        required
                      />
                      <label
                        for="newsletter[template--15880464466141__newsletter][contact][email]"
                        class="input__label"
                        >Your e-mail</label
                      >
                    </div>

                    <div class="input">
                      <button
                        type="submit"
                        is="loader-button"
                        class="button button--primary"
                      >
                        Subscribe
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </image-with-text-block>
        </section>
      </div>
      <div
        id="shopify-section-template--15880464466141__text-with-icons"
        class="shopify-section shopify-section--text-with-icons"
      >
        <style>
          #shopify-section-template--15880464466141__text-with-icons {
            --heading-color: 255, 255, 255;
            --text-color: 255, 255, 255;
            --section-background: 245, 127, 127;
            --vertical-breather: 40px; /* Inner spacing is smaller on this section */
          }
        </style>
        <section class="section section--flush">
          <div class="section__color-wrapper" style="background-color: #f7921c">
            <div class="container vertical-breather">
              <native-carousel class="text-with-icons">
                <div class="text-with-icons__list hide-scrollbar">
                  <native-carousel-item
                    id="block-template--15880464466141__text-with-icons-item-1"
                    class="text-with-icons__item"
                  >
                    <div class="text-with-icons__icon-wrapper">
                      <svg
                        fill="none"
                        focusable="false"
                        width="24"
                        height="24"
                        class="icon icon--picto-box"
                        viewBox="0 0 24 24"
                      >
                        <path
                          d="M12 21L21 17.1429V6.85714M12 21L3 17.1429V6.85714M12 21V10.7143M21 6.85714L12 3L3 6.85714M21 6.85714L12 10.7143M3 6.85714L12 10.7143"
                          stroke="currentColor"
                          stroke-width="2"
                        ></path>
                      </svg>
                    </div>
                    <div class="text-with-icons__content-wrapper">
                      <p class="heading heading--small">FREE SHIPPING</p>
                      <p>Free shipping in India</p>
                    </div></native-carousel-item
                  ><native-carousel-item
                    hidden
                    id="block-template--15880464466141__text-with-icons-item-2"
                    class="text-with-icons__item"
                  >
                    <div class="text-with-icons__icon-wrapper">
                      <svg
                        fill="none"
                        focusable="false"
                        width="24"
                        height="24"
                        class="icon icon--picto-phone"
                        viewBox="0 0 24 24"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M20.6636 16.7325L17.6844 13.7366C17.2337 13.2827 16.4999 13.2827 16.048 13.7343L13.4005 16.3802L7.62246 10.6056L10.2734 7.95613C10.7241 7.5057 10.7253 6.77463 10.2746 6.32305L7.29311 3.33869C6.84126 2.8871 6.10976 2.8871 5.65791 3.33869L3.00462 5.98927L3 5.9858C3 14.2783 9.72568 21 18.023 21L20.6613 18.3633C21.1119 17.9129 21.1131 17.1841 20.6636 16.7325Z"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        ></path>
                      </svg>
                    </div>
                    <div class="text-with-icons__content-wrapper">
                      <p class="heading heading--small">Customer service</p>
                      <p>
                        We are available from monday to saturday (9AM - 6PM)
                      </p>
                    </div></native-carousel-item
                  ><native-carousel-item
                    hidden
                    id="block-template--15880464466141__text-with-icons-33a9f141-c31d-4001-ba8e-e05bb9bde209"
                    class="text-with-icons__item"
                  >
                    <div class="text-with-icons__icon-wrapper">
                      <svg
                        fill="none"
                        focusable="false"
                        width="24"
                        height="24"
                        class="icon icon--picto-lock"
                        viewBox="0 0 24 24"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M12 17C13.1046 17 14 16.1046 14 15C14 13.8954 13.1046 13 12 13C10.8954 13 10 13.8954 10 15C10 16.1046 10.8954 17 12 17Z"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        ></path>
                        <path
                          d="M16 8H21V22H3V8H8M16 8C16 8 16 7.6 16 6C16 4 14.5 2 12 2C9.5 2 8 4 8 6C8 7.6 8 8 8 8M16 8H8"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        ></path>
                      </svg>
                    </div>
                    <div class="text-with-icons__content-wrapper">
                      <p class="heading heading--small">SECURE PAYMENT</p>
                      <p>Your payment information is processed securely.</p>
                    </div></native-carousel-item
                  ><native-carousel-item
                    hidden
                    id="block-template--15880464466141__text-with-icons-item-3"
                    class="text-with-icons__item"
                  >
                    <div class="text-with-icons__icon-wrapper">
                      <svg
                        fill="none"
                        focusable="false"
                        width="24"
                        height="24"
                        class="icon icon--picto-send"
                        viewBox="0 0 24 24"
                      >
                        <path
                          d="M21.913 2L15.3391 20L11.5826 11.9M21.913 2L3.13043 8.3L11.5826 11.9M21.913 2L11.5826 11.9"
                          stroke="currentColor"
                          stroke-width="2"
                        ></path>
                      </svg>
                    </div>
                    <div class="text-with-icons__content-wrapper">
                      <p class="heading heading--small">Contact Us</p>
                      <p>
                        Need to contact us ? Just send us an e-mail to
                        contact@kalaajee.com
                      </p>
                    </div></native-carousel-item
                  >
                </div>
                <page-dots
                  class="text-with-icons__dots dots-nav dots-nav--centered hidden-lap-and-up"
                  ><button class="dots-nav__item tap-area" aria-current="true">
                    <span class="visually-hidden">Go to slide 1</span></button
                  ><button class="dots-nav__item tap-area">
                    <span class="visually-hidden">Go to slide 2</span></button
                  ><button class="dots-nav__item tap-area">
                    <span class="visually-hidden">Go to slide 3</span></button
                  ><button class="dots-nav__item tap-area">
                    <span class="visually-hidden">Go to slide 4</span>
                  </button></page-dots
                ></native-carousel
              >
            </div>
          </div>
        </section>
      </div>
    </div>
    <div
      id="shopify-section-footer"
      class="shopify-section shopify-section--footer"
    >
      <style>
        #shopify-section-footer .footer {
          --background: 237, 64, 100;
          --heading-color: 255, 255, 255;
          --text-color: 255, 255, 255;
          --border-color: 240, 93, 123;
        }
      </style>

      <footer class="footer" style="background-color: #13becf">
        <div class="container">
          <div class="footer__inner">
            <div class="footer__item-list">
              <div class="footer__item footer__item--links is-first">
                <p
                  class="footer__item-title heading heading--small hidden-phone"
                >
                  Quick Links
                </p>

                <div class="footer__item-content hidden-phone">
                  <ul class="linklist list--unstyled" role="list">
                    <li class="linklist__item">
                      <a href="terms.php" class="link--faded"
                        >Terms & Condition</a
                      >
                    </li>
                    <li class="linklist__item">
                      <a href="shipping.php" class="link--faded"
                        >Shipping & Delivery</a
                      >
                    </li>
                    <li class="linklist__item">
                      <a href="good.php" class="link--faded"
                        >Goods & Services Tax</a
                      >
                    </li>
                    <li class="linklist__item">
                      <a href="refund.php" class="link--faded"
                        >Refund and Cancellation</a
                      >
                    </li>
                    <li class="linklist__item">
                      <a href="privacy.php" class="link--faded"
                        >Privacy Policies</a
                      >
                    </li>
                    <li class="linklist__item">
                      <a href="faq.php" class="link--faded">FAQs</a>
                    </li>
                    <li class="linklist__item">
                      <a href="contact.php" class="link--faded">Contact us</a>
                    </li>
                  </ul>
                </div>

                <div id="block-footer-links" class="hidden-tablet-and-up">
                  <button
                    is="toggle-button"
                    id="product--reviews-pocket"
                    class="collapsible-toggle heading heading--small hidden-lap-and-up anchor"
                    aria-controls="block-footer-links-content"
                    aria-expanded="false"
                  >
                    <span class="footer__item-title heading heading--small"
                      >Quick Links
                      <svg
                        focusable="false"
                        width="12"
                        height="8"
                        class="icon icon--chevron"
                        viewBox="0 0 12 8"
                      >
                        <path
                          fill="none"
                          d="M1 1l5 5 5-5"
                          stroke="currentColor"
                          stroke-width="2"
                        ></path></svg
                    ></span>
                  </button>

                  <collapsible-content
                    id="block-footer-links-content"
                    class="collapsible"
                  >
                    <div class="product-tabs__tab-item-content">
                      <div class="spr-reviews">
                        <ul class="linklist list--unstyled" role="list">
                          <li class="linklist__item">
                            <a href="terms.php" class="link--faded"
                              >Terms & Condition</a
                            >
                          </li>
                          <li class="linklist__item">
                            <a href="shipping.php" class="link--faded"
                              >Shipping & Delivery</a
                            >
                          </li>
                          <li class="linklist__item">
                            <a href="good.php" class="link--faded"
                              >Goods & Services Tax</a
                            >
                          </li>
                          <li class="linklist__item">
                            <a href="refund.php" class="link--faded"
                              >Refund and Cancellation</a
                            >
                          </li>
                          <li class="linklist__item">
                            <a href="privacy.php" class="link--faded"
                              >Privacy Policies</a
                            >
                          </li>
                          <li class="linklist__item">
                            <a href="reedem.php" class="link--faded"
                              >Reedem Gift Card</a
                            >
                          </li>
                          <li class="linklist__item">
                            <a href="faq.php" class="link--faded">FAQs</a>
                          </li>
                          <li class="linklist__item">
                            <a href="contact.php" class="link--faded"
                              >Contact us</a
                            >
                          </li>
                        </ul>
                      </div>
                    </div>
                  </collapsible-content>
                </div>
              </div>
              <div class="footer__item footer__item--links">
                <p
                  class="footer__item-title heading heading--small hidden-phone"
                >
                  Main menu
                </p>

                <div class="footer__item-content hidden-phone">
                  <ul class="linklist list--unstyled" role="list">
                    <li class="linklist__item">
                      <a href="product.php" class="link--faded">Collections</a>
                    </li>
                    <li class="linklist__item">
                      <a href="product.php" class="link--faded">Sarees</a>
                    </li>
                    <li class="linklist__item">
                      <a href="product.php" class="link--faded"
                        >Salwar Suits</a
                      >
                    </li>
                    <li class="linklist__item">
                      <a href="product.php" class="link--faded">Kurtis</a>
                    </li>
                    <li class="linklist__item">
                      <a href="product.php" class="link--faded">Lehengas</a>
                    </li>
                    <li class="linklist__item">
                      <a href="product.php" class="link--faded">Gowns</a>
                    </li>
                    <li class="linklist__item">
                      <a href="product.php" class="link--faded">Western</a>
                    </li>
                    <li class="linklist__item">
                      <a href="product.php" class="link--faded">Live</a>
                    </li>
                    <li class="linklist__item">
                      <a href="/collections/sale" class="link--faded">Sale</a>
                    </li>
                  </ul>
                </div>

                <div
                  id="block-footer-9efe0c55-78d1-4511-bd64-633f74e647ef"
                  class="hidden-tablet-and-up"
                >
                  <button
                    is="toggle-button"
                    id="product--reviews-pocket"
                    class="collapsible-toggle heading heading--small hidden-lap-and-up anchor"
                    aria-controls="block-footer-9efe0c55-78d1-4511-bd64-633f74e647ef-content"
                    aria-expanded="false"
                  >
                    <span class="footer__item-title heading heading--small"
                      >Main menu
                      <svg
                        focusable="false"
                        width="12"
                        height="8"
                        class="icon icon--chevron"
                        viewBox="0 0 12 8"
                      >
                        <path
                          fill="none"
                          d="M1 1l5 5 5-5"
                          stroke="currentColor"
                          stroke-width="2"
                        ></path></svg
                    ></span>
                  </button>

                  <collapsible-content
                    id="block-footer-9efe0c55-78d1-4511-bd64-633f74e647ef-content"
                    class="collapsible"
                  >
                    <div class="product-tabs__tab-item-content">
                      <div class="spr-reviews">
                        <ul class="linklist list--unstyled" role="list">
                          <li class="linklist__item">
                            <a href="/collections" class="link--faded"
                              >Collections</a
                            >
                          </li>
                          <li class="linklist__item">
                            <a href="/collections/sarees" class="link--faded"
                              >Sarees</a
                            >
                          </li>
                          <li class="linklist__item">
                            <a href="/collections/suits" class="link--faded"
                              >Salwar Suits</a
                            >
                          </li>
                          <li class="linklist__item">
                            <a href="/collections/kurti" class="link--faded"
                              >Kurtis</a
                            >
                          </li>
                          <li class="linklist__item">
                            <a href="/collections/lehengas" class="link--faded"
                              >Lehengas</a
                            >
                          </li>
                          <li class="linklist__item">
                            <a href="/collections/gowns" class="link--faded"
                              >Gowns</a
                            >
                          </li>
                          <li class="linklist__item">
                            <a href="/collections/western" class="link--faded"
                              >Western</a
                            >
                          </li>
                          <li class="linklist__item">
                            <a href="/pages/streams" class="link--faded"
                              >Live</a
                            >
                          </li>
                          <li class="linklist__item">
                            <a href="/collections/sale" class="link--faded"
                              >Sale</a
                            >
                          </li>
                        </ul>
                      </div>
                    </div>
                  </collapsible-content>
                </div>
              </div>
              <div class="footer__item footer__item--links">
                <p
                  class="footer__item-title heading heading--small hidden-phone"
                ></p>

                <div class="footer__item-content hidden-phone">
                  <ul class="linklist list--unstyled" role="list"></ul>
                </div>

                <div
                  id="block-footer-c77bf3d3-c7a3-4763-9818-bf0f832abbd7"
                  class="hidden-tablet-and-up"
                >
                  <button
                    is="toggle-button"
                    id="product--reviews-pocket"
                    class="collapsible-toggle heading heading--small hidden-lap-and-up anchor"
                    aria-controls="block-footer-c77bf3d3-c7a3-4763-9818-bf0f832abbd7-content"
                    aria-expanded="false"
                  >
                    <span class="footer__item-title heading heading--small"
                      >Information
                      <svg
                        focusable="false"
                        width="12"
                        height="8"
                        class="icon icon--chevron"
                        viewBox="0 0 12 8"
                      >
                        <path
                          fill="none"
                          d="M1 1l5 5 5-5"
                          stroke="currentColor"
                          stroke-width="2"
                        ></path></svg
                    ></span>
                  </button>

                  <collapsible-content
                    id="block-footer-c77bf3d3-c7a3-4763-9818-bf0f832abbd7-content"
                    class="collapsible"
                  >
                    <div class="product-tabs__tab-item-content">
                      <div class="spr-reviews">
                        <ul class="linklist list--unstyled" role="list"></ul>
                      </div>
                    </div>
                  </collapsible-content>
                </div>
              </div>
              <div class="footer__item footer__item--social-media">
                <p class="footer__item-title heading heading--small">
                  Follow us
                </p>
                <div class="footer__item-content footer__social">
                  <div>
                    <ul
                      class="social-media social-media--no-radius1 list--unstyled"
                      role="list"
                    >
                      <li
                        class="social-media__item social-media__item--facebook"
                      >
                        <a
                          href="https://www.facebook.com/peachmode1"
                          target="_blank"
                          rel="noopener"
                          class="social-media__link"
                          aria-label="Follow us on Facebook"
                          ><svg
                            focusable="false"
                            width="9"
                            height="17"
                            class="icon icon--facebook"
                            viewBox="0 0 9 17"
                          >
                            <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M2.486 16.2084L2.486 8.81845H0L0 5.93845L2.486 5.93845L2.486 3.81845C2.38483 2.79982 2.73793 1.78841 3.45107 1.05407C4.16421 0.319722 5.16485 -0.0628415 6.186 0.00844868C6.9284 0.00408689 7.67039 0.0441585 8.408 0.128449V2.69845L6.883 2.69845C6.4898 2.61523 6.08104 2.73438 5.79414 3.01585C5.50724 3.29732 5.3803 3.70373 5.456 4.09845L5.456 5.93845H8.308L7.936 8.81845H5.46L5.46 16.2084H2.486Z"
                              fill="currentColor"
                            ></path></svg
                        ></a>
                      </li>
                      <li
                        class="social-media__item social-media__item--twitter"
                      >
                        <a
                          href="https://www.twitter.com/peachmode1"
                          target="_blank"
                          rel="noopener"
                          class="social-media__link"
                          aria-label="Follow us on Twitter"
                          ><svg
                            focusable="false"
                            width="20"
                            height="16"
                            class="icon icon--twitter"
                            viewBox="0 0 20 16"
                          >
                            <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M12.845 2.13398C14.0997 2.11363 14.7676 2.53229 15.4054 3.06445C15.9468 3.02216 16.6505 2.74528 17.065 2.55232C17.1993 2.48493 17.3337 2.41786 17.468 2.35046C17.2312 2.93602 16.9103 3.39474 16.417 3.74251C16.3074 3.81976 16.1987 3.92434 16.0613 3.97362C16.0613 3.97584 16.0613 3.97838 16.0613 3.98061C16.7643 3.97394 17.3441 3.6837 17.8947 3.52603C17.8947 3.52856 17.8947 3.5311 17.8947 3.53365C17.6055 3.95454 17.214 4.38147 16.7963 4.6876C16.6277 4.8103 16.4591 4.93301 16.2905 5.05571C16.2997 5.73696 16.2795 6.38704 16.1404 6.95989C15.3314 10.2888 13.1878 12.5491 9.7945 13.517C8.5761 13.8648 6.60702 14.0075 5.21102 13.6903C4.51872 13.5329 3.89334 13.3552 3.30644 13.1203C2.98052 12.9896 2.67854 12.8485 2.38972 12.6876C2.29496 12.6346 2.2001 12.5818 2.10522 12.5287C2.42018 12.5376 2.78846 12.6168 3.14052 12.5649C3.45896 12.5179 3.77128 12.53 4.06514 12.4712C4.79794 12.324 5.4486 12.1294 6.00916 11.829C6.2809 11.6834 6.69324 11.5124 6.88634 11.3026C6.52248 11.3083 6.19256 11.2311 5.9223 11.144C4.87436 10.8051 4.26436 10.1824 3.86752 9.2468C4.1851 9.27827 5.09982 9.35394 5.31368 9.18894C4.91398 9.16891 4.52956 8.95688 4.25478 8.7992C3.41184 8.31634 2.72438 7.50634 2.72954 6.26021C2.84022 6.30821 2.9509 6.35653 3.06148 6.40453C3.27324 6.48622 3.48848 6.52978 3.74112 6.57778C3.8478 6.59781 4.06114 6.65534 4.18362 6.6137C4.17836 6.6137 4.17308 6.6137 4.16782 6.6137C4.00476 6.43982 3.73902 6.32411 3.57512 6.1375C3.03438 5.52206 2.52758 4.57507 2.84812 3.44686C2.9294 3.16077 3.05842 2.90805 3.19586 2.67502C3.20114 2.67757 3.2064 2.67979 3.21168 2.68234C3.2746 2.80282 3.415 2.89152 3.50408 2.99229C3.78024 3.30573 4.1209 3.5877 4.46812 3.83629C5.65108 4.68347 6.71642 5.20386 8.42738 5.58946C8.86134 5.68706 9.36308 5.76176 9.88146 5.76238C9.73578 5.37424 9.78258 4.7461 9.89726 4.37035C10.1856 3.42557 10.8119 2.74402 11.7307 2.37907C11.9504 2.29197 12.1941 2.22838 12.4498 2.17722C12.5815 2.16291 12.7133 2.14861 12.845 2.13398Z"
                              fill="currentColor"
                            ></path></svg
                        ></a>
                      </li>
                      <li
                        class="social-media__item social-media__item--instagram"
                      >
                        <a
                          href="https://instagram.com/peachmodeinsta"
                          target="_blank"
                          rel="noopener"
                          class="social-media__link"
                          aria-label="Follow us on Instagram"
                          ><svg
                            focusable="false"
                            width="16"
                            height="16"
                            class="icon icon--instagram"
                            viewBox="0 0 16 16"
                          >
                            <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M8 0C5.827 0 5.555.01 4.702.048 3.85.087 3.269.222 2.76.42a3.921 3.921 0 00-1.417.923c-.445.444-.719.89-.923 1.417-.198.509-.333 1.09-.372 1.942C.01 5.555 0 5.827 0 8s.01 2.445.048 3.298c.039.852.174 1.433.372 1.942.204.526.478.973.923 1.417.444.445.89.719 1.417.923.509.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.445-.01 3.298-.048c.852-.039 1.433-.174 1.942-.372a3.922 3.922 0 001.417-.923c.445-.444.719-.89.923-1.417.198-.509.333-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.298c-.039-.852-.174-1.433-.372-1.942a3.922 3.922 0 00-.923-1.417A3.921 3.921 0 0013.24.42c-.509-.198-1.09-.333-1.942-.372C10.445.01 10.173 0 8 0zm0 1.441c2.136 0 2.39.009 3.233.047.78.036 1.203.166 1.485.276.374.145.64.318.92.598.28.28.453.546.598.92.11.282.24.705.276 1.485.038.844.047 1.097.047 3.233s-.009 2.39-.047 3.233c-.036.78-.166 1.203-.276 1.485-.145.374-.318.64-.598.92-.28.28-.546.453-.92.598-.282.11-.705.24-1.485.276-.844.038-1.097.047-3.233.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.479 2.479 0 01-.92-.598 2.478 2.478 0 01-.598-.92c-.11-.282-.24-.705-.276-1.485-.038-.844-.047-1.097-.047-3.233s.009-2.39.047-3.233c.036-.78.166-1.203.276-1.485.145-.374.318-.64.598-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.844-.038 1.097-.047 3.233-.047zm0 9.226a2.667 2.667 0 110-5.334 2.667 2.667 0 010 5.334zm0-6.775a4.108 4.108 0 100 8.216 4.108 4.108 0 000-8.216zm5.23-.162a.96.96 0 11-1.92 0 .96.96 0 011.92 0z"
                              fill="currentColor"
                            ></path></svg
                        ></a>
                      </li>
                      <li
                        class="social-media__item social-media__item--youtube"
                      >
                        <a
                          href="https://www.youtube.com/c/Peachmode/"
                          target="_blank"
                          rel="noopener"
                          class="social-media__link"
                          aria-label="Follow us on YouTube"
                          ><svg
                            fill="none"
                            focusable="false"
                            width="18"
                            height="13"
                            class="icon icon--youtube"
                            viewBox="0 0 18 13"
                          >
                            <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M16.0325 0.369454C16.807 0.572743 17.4168 1.17173 17.6238 1.9324C18 3.31101 18 6.1875 18 6.1875C18 6.1875 18 9.06389 17.6238 10.4427C17.4168 11.2033 16.807 11.8023 16.0325 12.0056C14.6288 12.375 9 12.375 9 12.375C9 12.375 3.37122 12.375 1.96752 12.0056C1.19311 11.8023 0.583159 11.2033 0.376159 10.4427C0 9.06389 0 6.1875 0 6.1875C0 6.1875 0 3.31101 0.376159 1.9324C0.583159 1.17173 1.19311 0.572743 1.96752 0.369454C3.37122 0 9 0 9 0C9 0 14.6288 0 16.0325 0.369454ZM11.8636 6.1876L7.1591 8.79913V3.57588L11.8636 6.1876Z"
                              fill="currentColor"
                            ></path></svg
                        ></a>
                      </li>
                    </ul>
                    <br />
                  </div>
                </div>
              </div>
              <div class="footer__item footer__item--newsletter">
                <p class="footer__item-title heading heading--small">
                  Newsletter
                </p>
                <div class="footer__item-content">
                  <p>
                    Subscribe to our newsletter and get a 10% discount on your
                    first order.
                  </p>
                  <form
                    method="post"
                    action="/contact#footer-newsletter"
                    id="footer-newsletter"
                    accept-charset="UTF-8"
                    class="footer__newsletter-form form"
                  >
                    <input
                      type="hidden"
                      name="form_type"
                      value="customer"
                    /><input type="hidden" name="utf8" value="✓" /><input
                      type="hidden"
                      name="contact[tags]"
                      value="newsletter"
                    />

                    <div class="input">
                      <input
                        type="email"
                        id="footer[contact][email]"
                        name="contact[email]"
                        class="input__field input__field--text"
                        required
                      />
                      <label
                        for="footer[contact][email]"
                        class="input__label"
                        style="background-color: #13becf"
                        >Your e-mail</label
                      >
                      <button
                        type="submit"
                        class="input__submit-icon tap-area"
                        title="Register"
                      >
                        <svg
                          focusable="false"
                          width="17"
                          height="14"
                          class="icon icon--nav-arrow-right icon--direction-aware"
                          viewBox="0 0 17 14"
                        >
                          <path
                            d="M0 7h15M9 1l6 6-6 6"
                            stroke="currentColor"
                            stroke-width="2"
                            fill="none"
                          ></path>
                        </svg>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="footer__aside">
              <span class="footer__copyright text--xsmall text--subdued"
                >Copyright &copy; 2023
                <a href="index.php">&nbsp; Kalaajee Fashions</a>. All rights
                reserved And Proudly Powered By<a
                  href="https://www.successinnovativetechnologiespvtltd.com/"
                >
                  &nbsp;Success Innovative Technologies Pvt. Ltd.</a
                ></span
              >
              <div class="footer__payment-methods">
                <span
                  class="footer__payment-methods-label text--xsmall text--subdued"
                  >We accept</span
                >

                <div class="payment-methods-list payment-methods-list--auto">
                  <svg
                    viewBox="0 0 38 24"
                    xmlns="http://www.w3.org/2000/svg"
                    width="38"
                    height="24"
                    role="img"
                    aria-labelledby="pi-paypal"
                  >
                    <title id="pi-paypal">PayPal</title>
                    <path
                      opacity=".07"
                      d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z"
                    />
                    <path
                      fill="#fff"
                      d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"
                    />
                    <path
                      fill="#003087"
                      d="M23.9 8.3c.2-1 0-1.7-.6-2.3-.6-.7-1.7-1-3.1-1h-4.1c-.3 0-.5.2-.6.5L14 15.6c0 .2.1.4.3.4H17l.4-3.4 1.8-2.2 4.7-2.1z"
                    />
                    <path
                      fill="#3086C8"
                      d="M23.9 8.3l-.2.2c-.5 2.8-2.2 3.8-4.6 3.8H18c-.3 0-.5.2-.6.5l-.6 3.9-.2 1c0 .2.1.4.3.4H19c.3 0 .5-.2.5-.4v-.1l.4-2.4v-.1c0-.2.3-.4.5-.4h.3c2.1 0 3.7-.8 4.1-3.2.2-1 .1-1.8-.4-2.4-.1-.5-.3-.7-.5-.8z"
                    />
                    <path
                      fill="#012169"
                      d="M23.3 8.1c-.1-.1-.2-.1-.3-.1-.1 0-.2 0-.3-.1-.3-.1-.7-.1-1.1-.1h-3c-.1 0-.2 0-.2.1-.2.1-.3.2-.3.4l-.7 4.4v.1c0-.3.3-.5.6-.5h1.3c2.5 0 4.1-1 4.6-3.8v-.2c-.1-.1-.3-.2-.5-.2h-.1z"
                    />
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>
      <cookie-bar section="footer" hidden class="cookie-bar text--xsmall"
        ><p class="heading heading--xsmall">Cookie policy</p>
        <p>
          I agree to the processing of my data in accordance with the conditions
          set out in the policy of Privacy.
        </p>
        <div class="cookie-bar__actions">
          <button
            class="button button--text button--primary button--small text--xsmall"
            data-action="accept-policy"
          >
            Accept
          </button>
          <button
            class="button button--text button--ternary button--small text--xsmall"
            data-action="decline-policy"
          >
            Decline
          </button>
        </div>
      </cookie-bar>
    </div>
    <script
      async
      src="https://loox.io/widget/N1gBr7V_Ih/loox.1652507684332.js?shop=peachm.myshopify.com"
    ></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script
      src="//cdn.codeblackbelt.com/js/modules/also-bought/main.min.js?shop=peachm.myshopify.com"
      defer
    ></script>

    <script>
      $(".product-form__add-button,.shopify-payment-button button").on(
        "click",
        function () {
          setTimeout(function () {
            let proTitle = $(".product-meta__title a").html();

            let productName =
              proTitle + " - " + $(".block-swatch__radio:checked").val();
            let productPrice = $(
              ".product-meta__price-list-container .price.price--highlight .money"
            ).html();
            let variantID = $('[name="id"]').val();
            let currency = localStorage.getItem("wscc-currency") ?? "INR";
            fbq("track", "AddToCart", {
              content_name: productName,
              content_ids: productSKU,
              content_type: "product",
              value: productPrice.replace(",", "").match(/(\d+)/)[0],
              currency: currency,
            });
            console.log({
              content_name: productName,
              content_ids: productSKU,
              content_type: "product",
              value: productPrice.replace(",", "").match(/(\d+)/)[0],
              currency: currency,
            });
          }, 500);
        }
      );
    </script>

    <script>
      (function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
        var f = d.getElementsByTagName(s)[0],
          j = d.createElement(s),
          dl = l != "dataLayer" ? "&l=" + l : "";
        j.async = true;
        j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
        f.parentNode.insertBefore(j, f);
      })(window, document, "script", "dataLayer", "GTM-W42Q78");
    </script>
    <div id="shopify-section-searchtap" class="shopify-section">
      <link
        rel="stylesheet"
        href="//cdn.shopify.com/s/files/1/0637/4834/1981/t/4/assets/st.aio.min.css?v=6571519147001539231669276710"
      />
      <script
        src="//cdn.shopify.com/s/files/1/0637/4834/1981/t/4/assets/st.aio.min.js?v=90017031462102016991669276710"
        defer
      ></script>

      <div id="searchModalContainer" class="" v-cloak>
        <div
          class="container"
          id="searchModal"
          style="display: none"
          v-show="isOpen"
        >
          <div id="stOverlay">
            <div class="resultLoading" v-show="loader">
              <div class="st-loader"></div>
            </div>
            <div class="noResult" v-show="totalHits===0 && !someError">
              <div>
                No Search Result <span v-if="query"> for '${ query }$'</span>
              </div>
              <h3>
                <span
                  >Please try with different query
                  <span v-if="filterCount > 0"
                    >or try
                    <span
                      class="high-light text-main"
                      v-on:click="clearFilters()"
                      >clearing </span
                    >Filters.</span
                  ><span v-else>.</span></span
                >
              </h3>
              <div class="st-explore-more">Explore Our Other Collections</div>
              <ul class="st-row">
                <li class="st-col-md-3 st-col-sm-3 st-col-xs-6">
                  <!-- Collection image -->
                  <a href="/collections/indo-western">
                    <div class="image">
                      <div class="inner">
                        <img
                          loading="lazy"
                          src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/Banner-9_79b539fb-024e-453e-b19a-e057da36b7bb.jpg?v=1655475150"
                          alt=""
                          srcset="
                            //cdn.shopify.com/s/files/1/0637/4834/1981/files/Banner-9_79b539fb-024e-453e-b19a-e057da36b7bb.jpg?v=1655475150
                          "
                          sizes="auto"
                        />
                      </div>
                      <!--                                     <div class="brand-spacing">
                                         <div class="brand-txt">Fabrics</div>
                                     </div>-->
                    </div>
                  </a>
                </li>
                <li class="st-col-md-3 st-col-sm-3 st-col-xs-6">
                  <!-- Collection image -->
                  <a href="/collections/floral-lehenga">
                    <div class="image">
                      <div class="inner">
                        <img
                          loading="lazy"
                          src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/Banner-10_c457bafa-bf88-4572-b74d-9246026000db.jpg?v=1655475179"
                          alt=""
                          srcset="
                            //cdn.shopify.com/s/files/1/0637/4834/1981/files/Banner-10_c457bafa-bf88-4572-b74d-9246026000db.jpg?v=1655475179
                          "
                          sizes="auto"
                        />
                      </div>
                      <!--                                     <div class="brand-spacing">
                                         <div class="brand-txt">Dupattas</div>
                                     </div>-->
                    </div>
                  </a>
                </li>
                <li class="st-col-md-3 st-col-sm-3 st-col-xs-6">
                  <!-- Collection image -->
                  <a href="/collections/satin-saree">
                    <div class="image">
                      <div class="inner">
                        <img
                          loading="lazy"
                          src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/Banner-11_eca3e973-2ea4-4d48-8601-889ab3c6be96.jpg?v=1655475195"
                          alt=""
                          srcset="
                            //cdn.shopify.com/s/files/1/0637/4834/1981/files/Banner-11_eca3e973-2ea4-4d48-8601-889ab3c6be96.jpg?v=1655475195
                          "
                          sizes="auto"
                        />
                      </div>
                      <!--                                     <div class="brand-spacing">
                                         <div class="brand-txt">Stoles</div>
                                     </div>-->
                    </div>
                  </a>
                </li>
                <li class="st-col-md-3 st-col-sm-3 st-col-xs-6">
                  <!-- Collection image -->
                  <a href="/collections/casual-suits-dress-material">
                    <div class="image">
                      <div class="inner">
                        <img
                          loading="lazy"
                          src="//cdn.shopify.com/s/files/1/0637/4834/1981/files/Banner-12_12da5dda-1508-43e4-915a-11f64d740b2d.jpg?v=1655475211"
                          alt=""
                          srcset="
                            //cdn.shopify.com/s/files/1/0637/4834/1981/files/Banner-12_12da5dda-1508-43e4-915a-11f64d740b2d.jpg?v=1655475211
                          "
                          sizes="auto"
                        />
                      </div>
                      <!--                                     <div class="brand-spacing">
                                         <div class="brand-txt">Sarees</div>
                                     </div>-->
                    </div>
                  </a>
                </li>
              </ul>
            </div>
            <div class="somethingWentWrong" v-show="someError">
              <div>Oops !!! Something Went Wrong.</div>
              <h3>
                <span
                  >Please try
                  <span
                    class="high-light text-main"
                    onclick="window.location.reload()"
                    >again</span
                  >
                  or visit our
                  <a class="high-light text-main" v-bind:href="base_url"
                    >Home Page.</a
                  ></span
                >
              </h3>
            </div>
          </div>

          <div id="stMainContent" v-show="!loader && totalHits && !someError">
            <div class="st-row">
              <div
                id="left"
                class="st-hidden-sm st-col-md-3 st-hidden-xs scrollbar"
              >
                <div class="filter-inner">
                  <div class="filter-top-head">
                    <span class="top-head-title">Filters</span>
                    <span
                      class="reset"
                      v-show="filterCount > 0"
                      v-on:click="clearFilters()"
                      >Reset All</span
                    >
                    <!--                                 <span class="desktop-filter-cross" @click="showDesktopFilters = false"><svg focusable="false" width="14" height="14" viewBox="0 0 14 14">
        <path d="M13 13L1 1M13 1L1 13" stroke="currentColor" stroke-width="2" fill="none"></path>
      </svg></span>-->
                  </div>

                  <div class="filter-bottom-body scrollbar">
                    <div id="selected-filter-desktop">
                      <div class="st-filter-tags">
                        <div class="st-filter-inner" v-show="filterCount>0">
                          <div class="selected-tags">
                            <div
                              class="tag-item"
                              v-for="i in selectedFilterValues"
                              :key="i"
                            >
                              <div
                                class="tag-close"
                                @click="removeFilterValue(i.filter_val)"
                              >
                                ✕
                              </div>
                              <div class="tag-content">${i.filter_val}$</div>
                            </div>
                          </div>
                          <!--                                        <div class="tag-item st-last-clear-tag" style="margin-right: 0px !important;">
                                                                                         <div class="tag-content" style="max-width: 100% !important; color: rgb(255, 255, 255) !important;" @click="clearFilters()">Clear All</div>
                                                                                     </div>-->
                        </div>
                      </div>
                    </div>

                    <div
                      class="filter-wrapper"
                      v-for="f in filters"
                      v-show="(f.values.length>0 || f.selected.length>0 || f.field==='excludeOutOfStock') && !f.onTop"
                    >
                      <span
                        class="clear"
                        v-show="f.selected.length > 0"
                        v-on:click="clearFilters(f.field)"
                        >Clear</span
                      >
                      <div
                        class="filter-head"
                        v-on:click="f.isOpen = !f.isOpen"
                      >
                        <span class="st-filter-title">${ f.title }$</span>
                        <span class="arrow down-arrow" v-show="!f.isOpen"
                          ><svg
                            viewBox="0 0 12 8"
                            class="icon icon--chevron icon--inline"
                            height="8"
                            width="12"
                            focusable="false"
                          >
                            <path
                              fill="none"
                              d="M1 1l5 5 5-5"
                              stroke="currentColor"
                              stroke-width="2"
                            ></path></svg
                        ></span>
                        <span class="arrow up-arrow" v-show="f.isOpen"
                          ><svg
                            viewBox="0 0 12 8"
                            class="icon icon--chevron icon--inline st-icon--arrow-up"
                            height="8"
                            width="12"
                            focusable="false"
                          >
                            <path
                              fill="none"
                              d="M1 1l5 5 5-5"
                              stroke="currentColor"
                              stroke-width="2"
                            ></path></svg
                        ></span>
                      </div>
                      <div class="filter-body" v-show="f.isOpen">
                        <div
                          class="filter-list scrollTop scrollbar"
                          v-if="f.type==='multiple' && f.title!=='Price' && f.title!=='Discount' && f.title !=='Customer Ratings'"
                        >
                          <div
                            class="filter-item selected"
                            v-for="i in f.selected"
                            v-bind:key="i"
                          >
                            <label>
                              <input
                                type="checkbox"
                                v-bind:value="i"
                                v-model="f.selected"
                                v-on:change="pushFilter(), goToTop()"
                              />
                              <span class="checkbox"
                                ><svg
                                  focusable="false"
                                  width="12px"
                                  viewBox="0 0 24 24"
                                  role="presentation"
                                  class="icon st-icon--check"
                                >
                                  <path
                                    fill="currentColor"
                                    d="M9 20l-7-7 3-3 4 4L19 4l3 3z"
                                  ></path></svg
                              ></span>
                              <span class="filter-label"
                                >${ i }$ (${ getSelectedCount(i, f.field)
                                }$)</span
                              >
                              <span class="filter-count"
                                >[${ getSelectedCount(i, f.field) }$]</span
                              >
                            </label>
                          </div>
                          <div
                            class="filter-item"
                            v-for="i in getNotSelectedFilters(f.field)"
                            v-bind:key="i.name"
                          >
                            <label>
                              <input
                                type="checkbox"
                                v-bind:value="i.name"
                                v-model="f.selected"
                                v-on:change="pushFilter(),filterAnalytics('left',f.title,i.name), goToTop()"
                              />
                              <span class="checkbox"></span>
                              <span class="filter-label"
                                >${ i.name }$ (${ i.count }$)</span
                              >
                              <span class="filter-count">[${ i.count }$]</span>
                            </label>
                          </div>
                        </div>

                        <div
                          class="filter-list scrollTop scrollbar"
                          v-if="f.title==='Price' || f.title==='Discount' || f.title==='Customer Ratings'"
                        >
                          <div
                            class="filter-item selected"
                            v-for="i in f.selected"
                            v-bind:key="i[0]"
                          >
                            <label>
                              <input
                                type="checkbox"
                                v-bind:value="i"
                                v-model="f.selected"
                                v-on:change="pushFilter(), goToTop()"
                              />
                              <span class="checkbox"
                                ><svg
                                  focusable="false"
                                  width="12px"
                                  viewBox="0 0 24 24"
                                  role="presentation"
                                  class="icon st-icon--check"
                                >
                                  <path
                                    fill="currentColor"
                                    d="M9 20l-7-7 3-3 4 4L19 4l3 3z"
                                  ></path></svg
                              ></span>
                              <span
                                class="filter-label"
                                v-if="f.title==='Discount'"
                                v-bind:title="i[0] + '% - ' + i[1] + '%'"
                                >${ i[0] }$% - ${ i[1] }$% (${
                                getSelectedCount(i, f.field) }$)</span
                              >
                              <span
                                class="filter-label"
                                v-if="f.title==='Price'"
                                ><span class="st-money"
                                  >${ currency }$ ${ numberWithComa(i[0])
                                  }$</span
                                >
                                -
                                <span class="st-money"
                                  >${ currency }$ ${ numberWithComa(i[1])
                                  }$</span
                                ></span
                              >
                              <span
                                class="filter-label"
                                v-if="f.title==='Customer Ratings'"
                                v-bind:title="i[0] + '+ Rating'"
                              >
                                <span class="full-star" v-for="a in i[0]">
                                  <i class="fa fa-star"></i> </span
                                ><span>${ i[0] }$+ Rating</span>
                              </span>
                              <span class="filter-count"
                                >[${ getSelectedCount(i, f.field) }$]</span
                              >
                            </label>
                          </div>

                          <div
                            class="filter-item"
                            v-for="i in getNotSelectedFilters(f.field)"
                            v-bind:key="i.min"
                          >
                            <label>
                              <input
                                type="checkbox"
                                v-bind:value="[i.min,i.max]"
                                v-model="f.selected"
                                v-on:change="pushFilter(),filterAnalytics('left',f.title,[i.min,i.max]), goToTop()"
                              />
                              <span class="checkbox"></span>
                              <span
                                class="filter-label"
                                v-if="f.title==='Discount'"
                                v-bind:title="i.min + '% -' +i.max + '%'"
                                >${ i.min }$% - ${ i.max }$% (${ i.count
                                }$)</span
                              >
                              <span
                                class="filter-label"
                                v-if="f.title==='Price'"
                                ><span class="st-money"
                                  >${ currency }$ ${ numberWithComa(i.min)
                                  }$</span
                                >
                                -
                                <span class="st-money"
                                  >${ currency }$ ${ numberWithComa(i.max)
                                  }$</span
                                ></span
                              >
                              <span
                                class="filter-label"
                                v-if="f.title==='Customer Ratings'"
                                v-bind:title="i.min + '+ Rating'"
                              >
                                <span class="full-star" v-for="a in i.min">
                                  <i class="fa fa-star"></i> </span
                                ><span>${ i.min }$+ Rating</span>
                              </span>
                              <span class="filter-count">[${ i.count }$]</span>
                            </label>
                          </div>
                        </div>
                        <div
                          class="filter-list scrollTop scrollbar"
                          v-if="f.type==='single'"
                        >
                          <div
                            class="filter-item"
                            v-for="i in f.values"
                            v-bind:key="i"
                            v-bind:class="{'selected':f.selected.length > 0}"
                          >
                            <label>
                              <input
                                type="checkbox"
                                v-bind:value="i"
                                v-model="f.selected"
                                v-on:change="pushFilter(), goToTop()"
                              />
                              <span class="checkbox"
                                ><svg
                                  focusable="false"
                                  width="12px"
                                  viewBox="0 0 24 24"
                                  role="presentation"
                                  class="icon st-icon--check"
                                >
                                  <path
                                    fill="currentColor"
                                    d="M9 20l-7-7 3-3 4 4L19 4l3 3z"
                                  ></path></svg
                              ></span>
                              <span class="filter-label">${ i }$</span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--                             <div class="filter-bottom-apply" @click="showDesktopFilters = false">
                                 <span class="desktop-apply-btn">View Results</span>
                             </div>-->
                </div>
              </div>
              <div id="right" class="st-col-xs-12 st-col-sm-12 st-col-md-9">
                <div
                  class="st-row st-hidden-md st-hidden-lg"
                  id="mobile-filter-sort"
                >
                  <div class="st-col-xs-6" v-on:click="showMobileFilter= true">
                    <div class="st-filter-tab tab position-relative">
                      <span>
                        <svg
                          focusable="false"
                          width="14px"
                          class="icon icon--filter"
                          viewBox="0 0 19 20"
                          role="presentation"
                        >
                          <path
                            d="M17.0288086 4.01391602L11 9v7.0072021l-4 2.008545V9L1.01306152 4.01391602V1H17.0288086z"
                            stroke="currentColor"
                            stroke-width="2"
                            fill="none"
                            stroke-linecap="square"
                          ></path>
                        </svg>
                      </span>
                      <span class="filter-tab-label"
                        >Filter By<span v-show="filterCount > 0">
                          (${filterCount}$)</span
                        ></span
                      >
                      <!--                                      <span class="filter-cue cue" v-show="filterCount > 0"></span>-->
                    </div>
                  </div>
                  <div class="st-col-xs-6 mobile-filter-sort-open">
                    <div class="sort-tab tab" @click="sortDisplay=true">
                      <span>
                        <svg
                          version="1.1"
                          id="Layer_1"
                          width="14px"
                          xmlns="http://www.w3.org/2000/svg"
                          xmlns:xlink="http://www.w3.org/1999/xlink"
                          x="0px"
                          y="0px"
                          viewBox="0 0 460.088 460.088"
                          style="enable-background: new 0 0 460.088 460.088"
                          xml:space="preserve"
                        >
                          <g>
                            <g>
                              <g>
                                <path
                                  d="M25.555,139.872h257.526V88.761H25.555C11.442,88.761,0,100.203,0,114.316C0,128.429,11.442,139.872,25.555,139.872z"
                                />
                                <path
                                  d="M25.555,242.429h257.526v-51.111H25.555C11.442,191.318,0,202.76,0,216.874C0,230.988,11.442,242.429,25.555,242.429z"
                                />
                                <path
                                  d="M25.555,293.874v0.001C11.442,293.875,0,305.316,0,319.43s11.442,25.555,25.555,25.555h178.91
				c-2.021-6.224-3.088-12.789-3.088-19.523c0-11.277,2.957-22.094,8.48-31.588H25.555z"
                                />
                                <path
                                  d="M450.623,302.611c-12.62-12.621-33.083-12.621-45.704,0l-26.535,26.535V52.926c0-17.849-14.469-32.317-32.318-32.317
				s-32.318,14.469-32.318,32.317v276.22l-26.535-26.535c-12.621-12.62-33.083-12.621-45.704,0
				c-12.621,12.621-12.621,33.083,0,45.704l81.7,81.699c12.596,12.6,33.084,12.643,45.714,0l81.7-81.699
				C463.243,335.694,463.244,315.232,450.623,302.611z"
                                />
                              </g>
                            </g>
                          </g>
                          <g></g>
                          <g></g>
                          <g></g>
                          <g></g>
                          <g></g>
                          <g></g>
                          <g></g>
                          <g></g>
                          <g></g>
                          <g></g>
                          <g></g>
                          <g></g>
                          <g></g>
                          <g></g>
                          <g></g>
                        </svg>
                      </span>
                      <span class="sort-tab-label">Sort By</span>
                      <span
                        class="sort-cue cue"
                        v-show="sortLabel !== 'Relevance'"
                      ></span>
                    </div>
                  </div>
                </div>

                <div id="result-info-brand-sort" class="st-row">
                  <div class="st-col-xs-12 st-col-md-7">
                    <span class="result-info">
                      <!--                                     <span class="">Showing </span>-->
                      ${ totalHits }$
                      <span v-show="totalHits !== 1"> products</span>
                      <span v-show="totalHits === 1"> product</span>
                      <span class="st-hidden-xs st-hidden-sm" v-if="query">
                        for
                        <span class="text-main"
                          >'${ query | truncate(15) }$'</span
                        >
                      </span>
                    </span>
                    <span class="separator st-hidden-xs st-hidden-sm"></span>
                    <span class="brand">
                      <a
                        href="https://www.searchtap.io?utm_source=peachmode&utm_medium=website"
                        target="_blank"
                        class="st-brand-link"
                      >
                        <span>Powered by SearchTap</span>
                        <img
                          loading="lazy"
                          src="https://www.searchtap.io/img/st-gray-icon.svg"
                          alt="grey-logo"
                          class="st-logo grey-logo lazyautosizes lazyload"
                        />
                        <img
                          loading="lazy"
                          src="https://www.searchtap.io/img/st-icon.svg"
                          alt="green-logo"
                          class="st-logo green-logo lazyautosizes lazyload"
                        />
                      </a>
                    </span>
                  </div>
                  <div
                    class="st-hidden-xs st-hidden-sm st-col-md-5 st-col-lg-5"
                  >
                    <div class="st-sort-desktop xx">
                      <span class="sort-text">Sort By:</span>
                      <div
                        class="sort-wrapper"
                        @click="sortDesktopDisplay = !sortDesktopDisplay"
                      >
                        <div class="sort-tab">
                          <span class="st-sort-title">${ sortLabel }$</span>
                          <span class="st-down-arrow">
                            <svg
                              focusable="false"
                              width="14px"
                              class="icon st-icon--arrow-bottom"
                              viewBox="0 0 12 8"
                              role="presentation"
                            >
                              <path
                                stroke="currentColor"
                                stroke-width="2"
                                d="M10 2L6 6 2 2"
                                fill="none"
                                stroke-linecap="square"
                              ></path>
                            </svg>
                          </span>
                        </div>

                        <div class="sort-body" v-show="sortDesktopDisplay">
                          <div class="sort-list">
                            <div
                              class="sort-item"
                              v-bind:class="{'selected':sortLabel === sort.label}"
                              v-for="sort in sorts"
                              v-bind:key="sort.label"
                              v-on:click="sorting(sort.label), goToTop()"
                            >
                              <span>${ sort.label }$</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="st-row" id="products-listing">
                  <div
                    class="st-product st-col-xs-6 st-col-sm-3 st-col-md-3"
                    v-bind:key="item.id"
                    v-for="item in results"
                  >
                    <!-- <Products inline-template v-bind:item="item"> -->

                    <div class="product-inner" :class="`product_${item.id}`">
                      <!--                                      <a :href="getUrl(item.handle)" @click="prodUrl(item.title)">-->

                      <div class="product-top">
                        <div
                          class="product-tags"
                          :class="{ 'sale': item.discount > 0 }"
                        >
                          <!--                                                    <span class="tag new" v-show="item.tags.indexOf('new')> -1">New</span>-->
                          <span class="tag sold-out" v-show="!item.isActive"
                            >Sold Out</span
                          >
                          <span
                            class="tag sale"
                            v-show="item.isActive && item.discount > 0"
                            >SAVE ${item.discount}$%</span
                          >
                          <!--                                                    <span class="tag sale_banner" v-show="item.product_type">${item.product_type}$</span>-->
                        </div>
                        <a
                          :href="getUrl(item.handle)"
                          @click="prodUrl(item.title)"
                        >
                          <div class="product-images" :id="`img_id_${item.id}`">
                            <!--                                                <div class="hover-effect"></div>-->
                            <img
                              loading="lazy"
                              class="img main-img lazyautosizes lazyload"
                              :src="imgResizer(item.image ,'_large')"
                            />
                            <img
                              loading="lazy"
                              v-if="item.images[1]"
                              class="img hover-img lazyautosizes lazyload"
                              :src="imgResizer(item.images[1], '_large')"
                            />
                            <img
                              loading="lazy"
                              v-else
                              class="img hover-img lazyautosizes lazyload"
                              :src="imgResizer(item.image ,'_large')"
                            />
                          </div>
                        </a>
                      </div>
                      <div class="product-bottom">
                        <div class="product-title">
                          <a
                            :href="getUrl(item.handle)"
                            @click="prodUrl(item.title)"
                          >
                            <span>${ item.title }$</span>
                          </a>
                        </div>
                        <div class="st-product-prices">
                          <div
                            class="product-prices"
                            v-show="item.discount > 0"
                          >
                            <span
                              class="multiple-prices"
                              v-if="item.hasMultiplePrice"
                              >From
                            </span>
                            <span class="discounted_price st-money"
                              >${currency }$${
                              numberWithComa(item.activeDiscountedPrice)
                              }$</span
                            >
                            <span class="price st-money"
                              >${ currency }$${numberWithComa(item.activePrice)
                              }$</span
                            >
                            <!--                                                  <span class="discount">(Save ${ item.discount }$%)</span>-->
                          </div>

                          <div
                            class="product-prices no-sale"
                            v-show="item.discount <= 0"
                          >
                            <!--                                                        <span class="multiple-prices" v-if="item.hasMultiplePrice">from </span>-->
                            <span class="price.no_sale st-money"
                              >${currency }$${
                              numberWithComa(item.activeDiscountedPrice)
                              }$</span
                            >
                          </div>
                          <div class="st-instock-quant">
                            ${getTotalQuantity(item.variants)}$ in Stock
                          </div>
                        </div>
                        <!--                                        </a>-->
                        <!--                                            </div>-->
                        <!--                                        </a>-->
                      </div>
                      <!--                                      </a>-->
                    </div>
                    <!-- </Products> -->
                  </div>
                </div>

                <div class="st-results-end" id="products-footer">
                  ${setCurrency()}$
                  <div class="st-results-loader">
                    <!--                                        <div class="result-load-more" v-show="!resultsEnd" @click="loadMore">
                                                                             <span>Show More</span>
                                                                         </div>-->
                    <div class="result-loading" v-show="!resultsEnd">
                      <span class="st-spinner">
                        <svg
                          version="1.1"
                          id="L5"
                          width="90px"
                          height="60px"
                          xmlns="http://www.w3.org/2000/svg"
                          xmlns:xlink="http://www.w3.org/1999/xlink"
                          x="0px"
                          y="0px"
                          viewBox="0 0 100 100"
                          enable-background="new 0 0 0 0"
                          xml:space="preserve"
                        >
                          <circle
                            fill="#f7921c"
                            stroke="none"
                            cx="6"
                            cy="50"
                            r="6"
                          >
                            <animateTransform
                              attributeName="transform"
                              dur="1s"
                              type="translate"
                              values="0 15 ; 0 -15; 0 15"
                              repeatCount="indefinite"
                              begin="0.1"
                            />
                          </circle>
                          <circle
                            fill="#f7921c"
                            stroke="none"
                            cx="30"
                            cy="50"
                            r="6"
                          >
                            <animateTransform
                              attributeName="transform"
                              dur="1s"
                              type="translate"
                              values="0 10 ; 0 -10; 0 10"
                              repeatCount="indefinite"
                              begin="0.2"
                            />
                          </circle>
                          <circle
                            fill="#f7921c"
                            stroke="none"
                            cx="54"
                            cy="50"
                            r="6"
                          >
                            <animateTransform
                              attributeName="transform"
                              dur="1s"
                              type="translate"
                              values="0 5 ; 0 -5; 0 5"
                              repeatCount="indefinite"
                              begin="0.3"
                            />
                          </circle>
                        </svg>
                      </span>
                    </div>
                  </div>

                  <div class="result-ends" v-show="resultsEnd">
                    <span>Result Ends Here</span>
                  </div>
                </div>
              </div>
            </div>

            <!--                 <div class="st-row">
                    <div id="pagination" class="st-col-xs-12 st-col-sm-12 st-col-md-12 st-pagination" v-if="!loader && results.length > 0">
                     &lt;!&ndash;                          <span class="pagination-text">Showing items ${ currOffset + 1 }$ - ${ currOffset + results.length }$ of ${ totalHits }$.</span>&ndash;&gt;
                     <Paginate :page-count="pageCount" :page-range="1" v-model="currPage"
                               prev-text="Load Previous" next-text="Load More"
                               :container-class="'pagination-custom text-center'"
                               :page-class="'page-item st-hide-page'" :next-class="'page-item st-next'"
                               :prev-class="'page-item st-prev'" :click-handler="loadMore" :hide-prev-next="false"
                               :break-view-class="'st-break-view'" v-show="pageCount>1">
                     </Paginate>

                 </div>
                 </div>-->

            <div class="st-hidden-md st-hidden-lg" id="mobile-filter-container">
              <div class="filter-wrapper" v-show="showMobileFilter">
                <div
                  class="filter-head align-items-center position-absolute st-row"
                >
                  <div class="st-col-xs-5 st-text-left">
                    <span class="filter-head-label">Filter By</span>
                  </div>
                  <div class="st-col-xs-7 st-text-right">
                    <span
                      class="clear-all"
                      v-on:click="clearFilters()"
                      v-show="filterCount > 0"
                      >Reset All</span
                    >
                    <span
                      class="filter-close"
                      v-on:click="showMobileFilter =false"
                      >Close</span
                    >
                    <span
                      class="filter-head-cross"
                      v-on:click="showMobileFilter =false"
                    >
                      <svg
                        height="10px"
                        style="enable-background: new 0 0 512.001 512.001"
                        viewBox="0 0 512.001 512.001"
                        width="10px"
                        x="0px"
                        xml:space="preserve"
                        y="0px"
                      >
                        <path
                          class="active-path"
                          d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717    L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859    c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287    l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285    L284.286,256.002z"
                          data-old_color="#000000"
                          data-original="#000000"
                          fill="#4E3830"
                        />
                      </svg>
                    </span>
                  </div>
                </div>
                <div class="filter-content">
                  <div class="filter-titles">
                    <div
                      class="filter-items"
                      v-bind:key="f.title"
                      v-for="f in filters"
                      :class="{'active' : filterValue === f.title}"
                      v-show="(f.values.length>0 || f.selected.length>0 || f.field==='excludeOutOfStock') && !f.onTop"
                    >
                      <div
                        class="filter-item-head"
                        @click="filterValue = f.title"
                      >
                        <span
                          class="filter-item-head-label"
                          v-on:click="f.isMobileOpen = !f.isMobileOpen"
                          >${ f.title }$</span
                        >
                        <span
                          class="filter-clear"
                          v-on:click="clearFilters(f.field)"
                          v-show="f.selected.length > 0"
                          >Clear</span
                        >
                        <span
                          class="filter-arrows arrows"
                          v-show="!f.isMobileOpen"
                          v-on:click="f.isMobileOpen = !f.isMobileOpen"
                          ><i aria-hidden="true" class="fa fa-chevron-down"></i
                        ></span>
                        <span
                          class="filter-arrows arrows"
                          v-show="f.isMobileOpen"
                          v-on:click="f.isMobileOpen = !f.isMobileOpen"
                          ><i aria-hidden="true" class="fa fa-chevron-up"></i
                        ></span>
                      </div>
                    </div>
                  </div>

                  <div class="mobile-filter-body">
                    <div
                      class="filter-item-body"
                      v-bind:key="f.title"
                      v-for="f in filters"
                      v-show="f.title === filterValue"
                    >
                      <!--                                     <div class="filter-search" v-if="f.hasSearchBox">
                                         <input type="text" :placeholder="`Search ${f.title}...`"
                                                v-model.trim="f.searchProp"
                                                @keyup="filterSearch(f)">
                                     </div>-->
                      <div class="filter-values-list scrollTop scrollbar">
                        <div v-if="f.textType==='text'">
                          <div
                            class="filter-item selected"
                            v-bind:key="i"
                            v-for="i in f.selected"
                          >
                            <label>
                              <input
                                type="checkbox"
                                v-bind:value="i"
                                v-model="f.selected"
                                v-on:change="pushFilter(), goToTop()"
                              />
                              <span class="checkbox">
                                <svg
                                  focusable="false"
                                  class="icon st-icon--check"
                                  width="12px"
                                  viewBox="0 0 24 24"
                                  role="presentation"
                                >
                                  <path
                                    fill="currentColor"
                                    d="M9 20l-7-7 3-3 4 4L19 4l3 3z"
                                  ></path></svg
                              ></span>
                              <span class="filter-label">${ i }$</span>
                              <span class="filter-count"
                                >(${ getSelectedCount(i, f.field) }$)</span
                              >
                            </label>
                          </div>
                          <div
                            class="filter-item"
                            v-bind:key="i.name"
                            v-for="i in getNotSelectedFilters(f.field)"
                          >
                            <label>
                              <input
                                type="checkbox"
                                v-bind:value="i.name"
                                v-model="f.selected"
                                v-on:change="pushFilter(),filterAnalytics('left',f.title,i.name), goToTop()"
                              />
                              <span class="checkbox"
                                ><i aria-hidden="true" class="fa fa-check"></i
                              ></span>
                              <span class="filter-label">${ i.name }$</span>
                              <span class="filter-count">(${ i.count }$)</span>
                            </label>
                          </div>
                        </div>
                        <div v-if="f.textType==='numeric'">
                          <div
                            class="filter-item selected"
                            v-bind:key="i"
                            v-for="i in f.selected"
                          >
                            <label>
                              <input
                                type="checkbox"
                                v-bind:value="i"
                                v-model="f.selected"
                                v-on:change="pushFilter(), goToTop()"
                              />
                              <span class="checkbox">
                                <svg
                                  focusable="false"
                                  class="icon st-icon--check"
                                  width="12px"
                                  viewBox="0 0 24 24"
                                  role="presentation"
                                >
                                  <path
                                    fill="currentColor"
                                    d="M9 20l-7-7 3-3 4 4L19 4l3 3z"
                                  ></path></svg
                              ></span>
                              <span
                                class="filter-label"
                                v-if="f.title==='Discount'"
                                >${ i[0] }$% & Above</span
                              >
                              <span
                                class="filter-label"
                                v-if="f.title==='Customer Ratings'"
                              >
                                <span class="full-star" v-for="a in i[0]">
                                  <i class="fa fa-star"></i> </span
                                ><span>${i[0]}$+ Rating</span>
                              </span>
                              <!--                                                     <span class="filter-label" v-if="f.title==='Price' && i[1] === 10000000">${ currency }$${ numberWithComa(i[0]) }$ - Above</span>-->
                              <span
                                class="filter-label"
                                v-if="f.title==='Price'"
                                ><span class="st-money"
                                  >${ currency }$ ${ numberWithComa(i[0])
                                  }$</span
                                >
                                -
                                <span class="st-money"
                                  >${ currency }$ ${ numberWithComa(i[1])
                                  }$</span
                                ></span
                              >

                              <span class="filter-count"
                                >(${ getSelectedCount(i, f.field) }$)</span
                              >
                            </label>
                          </div>
                          <div
                            class="filter-item"
                            v-bind:key="i.min"
                            v-for="i in getNotSelectedFilters(f.field)"
                          >
                            <label>
                              <input
                                type="checkbox"
                                v-bind:value="[i.min,i.max]"
                                v-model="f.selected"
                                v-on:change="pushFilter(),filterAnalytics('left',f.title,[i.min,i.max]), goToTop()"
                              />
                              <span class="checkbox"
                                ><i aria-hidden="true" class="fa fa-check"></i
                              ></span>
                              <span
                                class="filter-label"
                                v-if="f.title==='Discount'"
                                >${ i.min }$% & Above</span
                              >

                              <span
                                class="filter-label"
                                v-if="f.title==='Customer Ratings'"
                              >
                                <span class="full-star" v-for="a in i.min">
                                  <i class="fa fa-star"></i> </span
                                ><span>${i.min}$+ Rating</span>
                              </span>
                              <!--                                                     <span class="filter-label money"  v-if="f.title==='Price' && i.max === 10000000">${ currency }$${ numberWithComa(i.min) }$ - Above</span>-->
                              <span
                                class="filter-label"
                                v-if="f.title==='Price'"
                                ><span class="st-money"
                                  >${ currency }$ ${ numberWithComa(i.min)
                                  }$</span
                                >
                                -
                                <span class="st-money"
                                  >${ currency }$ ${ numberWithComa(i.max)
                                  }$</span
                                ></span
                              >

                              <span class="filter-count">(${ i.count }$)</span>
                            </label>
                          </div>
                        </div>
                        <div v-if="f.type==='single'">
                          <div
                            class="filter-item"
                            v-bind:class="{'selected':f.selected.length > 0}"
                            v-bind:key="i"
                            v-for="i in f.values"
                          >
                            <label>
                              <input
                                type="checkbox"
                                v-bind:value="i"
                                v-model="f.selected"
                                v-on:change="pushFilter(), goToTop()"
                              />
                              <span class="checkbox">
                                <svg
                                  focusable="false"
                                  class="icon st-icon--check"
                                  width="12px"
                                  viewBox="0 0 24 24"
                                  role="presentation"
                                >
                                  <path
                                    fill="currentColor"
                                    d="M9 20l-7-7 3-3 4 4L19 4l3 3z"
                                  ></path></svg
                              ></span>
                              <span class="filter-label">${ i }$</span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <span class="filter-apply" v-on:click="showMobileFilter =false"
                  >Apply Filter</span
                >
              </div>
            </div>

            <div class="st-hidden-md st-hidden-lg" id="mobile-sort-container">
              <div
                class="sort-wrapper"
                v-show="sortDisplay"
                @click="sortDisplay = !sortDisplay"
              >
                <div class="sort-inner">
                  <div class="sort-head">
                    <span
                      >Sort By: <span class="text-main">${ sortLabel }$</span
                      ><span class="st-sort-cross"
                        ><svg
                          height="15px"
                          viewBox="0 0 512.001 512.001"
                          width="15px"
                          x="0px"
                          xml:space="preserve"
                          y="0px"
                        >
                          <path
                            d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717    L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859    c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287    l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285    L284.286,256.002z"
                            data-old_color="#000000"
                            data-original="#000000"
                            fill="#4E3830"
                            class="active-path"
                          ></path></svg></span
                    ></span>
                  </div>
                  <div class="sort-items">
                    <div
                      class="sort-item"
                      v-bind:key="sort.label"
                      v-for="sort in sorts"
                      v-on:click="sorting(sort.label), goToTop()"
                    >
                      <span :class="{'selected' : sort.label === sortLabel}"
                        >${ sort.label }$</span
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <span id="scroll-to-top" v-show="backToTop" @click="goToTop()">
            <svg
              focusable="false"
              width="14px"
              class="icon st-icon--arrow-up"
              viewBox="0 0 12 8"
              role="presentation"
            >
              <path
                stroke="currentColor"
                stroke-width="2"
                d="M10 2L6 6 2 2"
                fill="none"
                stroke-linecap="square"
              ></path>
            </svg>
          </span>
        </div>
      </div>
    </div>
    <div id="st-trending-search" style="display: none" v-cloak>
      <div
        class="autocomplete-body"
        v-show="!mobile_loader && trending_results.length"
      >
        <div class="autocomplete-head">
          <div id="trend_left">
            <svg
              viewBox="0 0 500 500"
              width="18"
              height="18"
              fill="#f57f7f"
              class="st-icon"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                height="500"
                viewBox="0 0 48 48"
                width="500"
              >
                <path
                  d="M32 12l4.59 4.59-9.76 9.75-8-8-14.83 14.83 2.83 2.83 12-12 8 8 12.58-12.59 4.59 4.59v-12z"
                ></path>
              </svg>
            </svg>
            <span>Trending Searches</span>
          </div>
        </div>
        <div class="st-autocomplete-content">
          <ul class="st-trending-elements">
            <li v-for="item in trending_results" :key="item.id">
              <a
                class="st-element"
                :href="redirectPage(item)"
                v-if="item.showInSuggestion"
              >
                <svg
                  viewBox="0 0 500 500"
                  width="16"
                  height="16"
                  fill="#393939"
                  class="st-icon"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="500"
                    viewBox="0 0 48 48"
                    width="500"
                  >
                    <path
                      d="M32 12l4.59 4.59-9.76 9.75-8-8-14.83 14.83 2.83 2.83 12-12 8 8 12.58-12.59 4.59 4.59v-12z"
                    ></path>
                  </svg>
                </svg>
                <span>${ item.displayLabel }$</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- ADMITAD CODE START -->

    <script
      src="https://www.artfut.com/static/tagtag.min.js?campaign_code=70d1213226"
      async
      onerror='var self =this;window.ADMITAD=window.ADMITAD||{},ADMITAD.Helpers=ADMITAD.Helpers||{},ADMITAD.Helpers.generateDomains=function(){for(var e=new Date,n=Math.floor(new Date(2020,e.getMonth(),e.getDate()).setUTCHours(0,0,0,0)/1e3),t=parseInt(1e12*(Math.sin(n)+1)).toString(30),i=["de"],o=[],a=0;a<i.length;++a)o.push({domain:t+"."+i[a],name:t});return o},ADMITAD.Helpers.findTodaysDomain=function(e){function n(){var o=newXMLHttpRequest,a=i[t].domain,D="https://"+a+"/";o.open("HEAD",D,!0),o.onload=function(){setTimeout(e,0,i[t])},o.onerror=function(){++t<i.length?setTimeout(n,0):setTimeout(e,0,void 0)},o.send()}var t=0,i=ADMITAD.Helpers.generateDomains();n()},window.ADMITAD=window.ADMITAD||{},ADMITAD.Helpers.findTodaysDomain(function(e){if(window.ADMITAD.dynamic=e,window.ADMITAD.dynamic){var n=function(){return function(){return self.src?self:""}}(),t=n(),i=(/campaign_code=([^&]+)/.exec(t.src)||[])[1]||"";t.parentNode.removeChild(t);var o=document.getElementsByTagName("head")[0],a=document.createElement("script");a.src="https://www."+window.ADMITAD.dynamic.domain+"/static/"+window.ADMITAD.dynamic.name.slice(1)+window.ADMITAD.dynamic.name.slice(0,1)+".min.js?campaign_code="+i,o.appendChild(a)}});'
    ></script>

    <script type="text/javascript">
      // name of the cookie that stores the source
      // change if you have another name
      var cookie_name = "deduplication_cookie";
      // cookie lifetime
      var days_to_store = 30;
      // expected deduplication_cookie value for Admitad
      var deduplication_cookie_value = "admitad";
      // name of GET parameter for deduplication
      // change if you have another name
      var channel_name = "utm_source";
      // a function to get the source from the GET parameter
      getSourceParamFromUri = function () {
        var pattern = channel_name + "=([^&]+)";
        var re = new RegExp(pattern);
        return (re.exec(document.location.search) || [])[1] || "";
      };

      // a function to get the source from the cookie named cookie_name
      getSourceCookie = function () {
        var matches = document.cookie.match(
          new RegExp(
            "(?:^|; )" +
              cookie_name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") +
              "=([^;]*)"
          )
        );
        return matches ? decodeURIComponent(matches[1]) : undefined;
      };
      // a function to set the source in the cookie named cookie_name
      setSourceCookie = function () {
        var param = getSourceParamFromUri();
        var params = new URL(document.location).searchParams;
        if (!params.get(channel_name) && params.get("gclid")) {
          param = "google";
        } else if (!params.get(channel_name) && params.get("fbclid")) {
          param = "facebook";
        } else if (!params.get(channel_name) && params.get("cjevent")) {
          param = "cj";
        } else if (!param) {
          return;
        }
        var period = days_to_store * 60 * 60 * 24 * 1000; // in seconds
        var expiresDate = new Date(period + +new Date());
        var cookieString =
          cookie_name +
          "=" +
          param +
          "; path=/; expires=" +
          expiresDate.toGMTString();
        document.cookie = cookieString;
        document.cookie = cookieString + "; domain=." + location.host;
      };
      // set cookie
      setSourceCookie();
    </script>

    <!-- END -->

    <div
      id="shopify-block-6048552914641687618"
      class="shopify-block shopify-app-block"
    ></div>
  </body>
</html>
