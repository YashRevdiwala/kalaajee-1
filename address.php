<?php
include("components/connection.php");

if(!isset($_SESSION)){
  session_start();
  if(isset($_SESSION['client_email'])){
    $client_email = $_SESSION['client_email'];
    $login_display = '<li class="header__linklist-item">
                  <a href="account.php">My Account </a>
                </li>';
    $query = mysqli_query($conn,"SELECT * FROM tbl_client where email = '$client_email'");
    $row = mysqli_fetch_array($query);
    $display_data = '<div class="account__address-details">
                          <p>
                            '.$row['name'].' '.$row['last_name'].'<br />'.$row['telephone'].'<br />'.$row['address'].'<br />'.$row['city'].'<br />'.$row['state'].' '.$row['postal_code'].'
                          </p>
                        </div>

                        <div class="account__address-actions">
                          <button
                            class="link text--subdued"
                            is="toggle-button"
                            aria-controls="drawer-address-8302380974301"
                            aria-expanded="false"
                          >
                            Edit
                          </button>
                        </div>
                      </div>';
  }else{
    $login_display = '<li class="header__linklist-item">
                  <a href="login.php">Login </a>
                </li>
                <li class="header__linklist-item">
                  <a href="register.php">Register </a>
                </li>';
    $display_data = '<div class="account__address-details">
                          <p>
                            You are not currently logged in.<br />
                            Please <a href = "login.php">Login</a> to continue.
                          </p>
                      </div>';
  }
}
?>

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
      var __wzrk_customer_name = "Yash Sabhaya";
      var __wzrk_customer_identity = "6713034932445";
      var __wzrk_customer_email = "yashsabhaya964@gmail.com";
      var __wzrk_customer_phone = "";

      window.clevertapApp = {
        config: {
          currency: "INR",
          meta: {
            title: "Addresses",
            template: "customers/addresses",
            url: "https://peachmode.com/account/addresses",
            type: "customers/addresses",
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

      var tags = [];

      clevertapApp.customer = {
        phone: "",
        email: "yashsabhaya964@gmail.com",
        name: "Yash Sabhaya",
        id: parseInt("6713034932445"),
        lastName: "Sabhaya",
        firstName: "Yash",
        city: "Surat",
        acceptsMarketing: "true",
        hasAccount: "true",
        ordersCount: parseInt("0"),
        taxExempt: "false",
        totalSpent: (parseFloat("0") / 100).toFixed(2),
        tags: tags,
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

    <title>Addresses</title>
    <link rel="canonical" href="https://peachmode.com/account/addresses" />
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
    <meta property="og:title" content="Addresses" />
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
    <meta property="og:url" content="https://peachmode.com/account/addresses" />
    <meta property="og:site_name" content="Peachmode" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Addresses" />
    <meta name="twitter:description" content="Addresses" />
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
          pageType: "customers\/addresses",
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
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/runtime.latest.en.04492a71077e352f2957.js",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/checkout-web-packages-packages_checkout-react-html_src_hooks_title_ts.latest.en.3457953d3abd1b694aa5.js",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/vendors-node_modules_shopify_verdict_build_esm_runtimes_browser_index_mts_js.latest.en.f6f2083a5fb187836a1f.js",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/app_components_AddressForm_AddressForm_tsx-app_components_Step_Step_tsx-app_utilities_receipt-224401.latest.en.4102af967c2318ba421f.js",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/Information.latest.en.8e68c4e4246b64be3ba3.js",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/checkout-web-ui-packages_checkout-web-ui_src_styles_global_css_ts-packages_checkout-web-ui_sr-da3b38.latest.en.7eadcddb7755a08c8d6d.js",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/vendors-node_modules_bugsnag_js_browser_notifier_js-node_modules_vanilla-extract_sprinkles_cr-077d89.latest.en.0ca662c669b41a356f6a.js",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/checkout-web-packages-packages_card-fields-react_src_hook_ts-packages_checkout-graphql_src_in-92a386.latest.en.b39452fcc8039fc140d1.js",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/app.latest.en.34c13c3036294a9b3b6d.js",
        ];
        var styles = [
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/checkout-web-ui-packages_checkout-web-ui_src_styles_global_css_ts-packages_checkout-web-ui_sr-da3b38.latest.en.5196d587d3de2d2fbc8a.css",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/vendors-node_modules_bugsnag_js_browser_notifier_js-node_modules_vanilla-extract_sprinkles_cr-077d89.latest.en.4e93eb2ccac793a61d40.css",
          "https://cdn.shopify.com/shopifycloud/checkout-web/assets/app.latest.en.b7ed98bf011cf2a4887c.css",
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
        reqid: "9a7fd838-eb02-44b8-9aa6-12b5442af857",
        pageurl: "peachmode.com\/account\/addresses",
        u: "00132fc920a8",
        cid: 6713034932445,
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

    <script>
      window.performance &&
        window.performance.mark &&
        window.performance.mark("shopify.content_for_header.end");
    </script>

    <script>
      var loox_global_hash = "1681351419703";
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
      window.baCurr = window.baCurr || {};
      window.baCurr.config = {};
      window.baCurr.rePeat = function () {};
      Object.assign(
        window.baCurr.config,
        {
          enabled: true,
          manual_placement: "",
          night_time: false,
          round_by_default: false,
          display_position: "bottom_left",
          display_position_type: "floating",
          custom_code: { css: "" },
          flag_type: "countryandmoney",
          flag_design: "modern",
          round_style: "none",
          round_dec: "0.99",
          chosen_cur: [
            { USD: "US Dollar (USD)" },
            { EUR: "Euro (EUR)" },
            { GBP: "British Pound (GBP)" },
            { CAD: "Canadian Dollar (CAD)" },
            { AED: "United Arab Emirates Dirham (AED)" },
            { ALL: "Albanian Lek (ALL)" },
            { AFN: "Afghan Afghani (AFN)" },
            { AMD: "Armenian Dram (AMD)" },
            { AOA: "Angolan Kwanza (AOA)" },
            { ARS: "Argentine Peso (ARS)" },
            { AUD: "Australian Dollar (AUD)" },
            { AWG: "Aruban Florin (AWG)" },
            { AZN: "Azerbaijani Manat (AZN)" },
            { BIF: "Burundian Franc (BIF)" },
            { BBD: "Barbadian Dollar (BBD)" },
            { BDT: "Bangladeshi Taka (BDT)" },
            { BSD: "Bahamian Dollar (BSD)" },
            { BHD: "Bahraini Dinar (BHD)" },
            { BMD: "Bermudan Dollar (BMD)" },
            { BYN: "Belarusian Ruble (BYN)" },
            { BZD: "Belize Dollar (BZD)" },
            { BTN: "Bhutanese Ngultrum (BTN)" },
            { BAM: "Bosnia-Herzegovina Convertible Mark (BAM)" },
            { BRL: "Brazilian Real (BRL)" },
            { BOB: "Bolivian Boliviano (BOB)" },
            { BWP: "Botswanan Pula (BWP)" },
            { BND: "Brunei Dollar (BND)" },
            { BGN: "Bulgarian Lev (BGN)" },
            { CDF: "Congolese Franc (CDF)" },
            { CHF: "Swiss Franc (CHF)" },
            { CLP: "Chilean Peso (CLP)" },
            { CNY: "Chinese Yuan (CNY)" },
            { COP: "Colombian Peso (COP)" },
            { CRC: "Costa Rican Colon (CRC)" },
            { CZK: "Czech Republic Koruna (CZK)" },
            { DJF: "Djiboutian Franc (DJF)" },
            { DKK: "Danish Krone (DKK)" },
            { DOP: "Dominican Peso (DOP)" },
            { DZD: "Algerian Dinar (DZD)" },
            { EGP: "Egyptian Pound (EGP)" },
            { ETB: "Ethiopian Birr (ETB)" },
            { FJD: "Fijian Dollar (FJD)" },
            { FKP: "Falkland Islands Pound (FKP)" },
            { GIP: "Gibraltar Pound (GIP)" },
            { GHS: "Ghanaian Cedi (GHS)" },
            { GMD: "Gambian Dalasi (GMD)" },
            { GNF: "Guinean Franc (GNF)" },
            { GTQ: "Guatemalan Quetzal (GTQ)" },
            { GEL: "Georgian Lari (GEL)" },
            { HRK: "Croatian Kuna (HRK)" },
            { HNL: "Honduran Lempira (HNL)" },
            { HKD: "Hong Kong Dollar (HKD)" },
            { HTG: "Haitian Gourde (HTG)" },
            { HUF: "Hungarian Forint (HUF)" },
            { IDR: "Indonesian Rupiah (IDR)" },
            { ILS: "Israeli New Shekel (ILS)" },
            { ISK: "Icelandic Krona (ISK)" },
            { INR: "Indian Rupee (INR)" },
            { IQD: "Iraqi Dinar (IQD)" },
            { IRR: "Iranian Rial (IRR)" },
            { JMD: "Jamaican Dollar (JMD)" },
            { JPY: "Japanese Yen (JPY)" },
            { JOD: "Jordanian Dinar (JOD)" },
            { KES: "Kenyan Shilling (KES)" },
            { KGS: "Kyrgystani Som (KGS)" },
            { KHR: "Cambodian Riel (KHR)" },
            { KMF: "Comorian Franc (KMF)" },
            { KRW: "South Korean Won (KRW)" },
            { KWD: "Kuwaiti Dinar (KWD)" },
            { KYD: "Cayman Islands Dollar (KYD)" },
            { KZT: "Kazakhstani Tenge (KZT)" },
            { LBP: "Lebanese Pound (LBP)" },
            { LKR: "Sri Lankan Rupee (LKR)" },
            { LRD: "Liberian Dollar (LRD)" },
            { LSL: "Lesotho Loti (LSL)" },
            { LYD: "Libyan Dinar (LYD)" },
            { MAD: "Moroccan Dirham (MAD)" },
            { MDL: "Moldovan Leu (MDL)" },
            { MGA: "Malagasy Ariary (MGA)" },
            { MMK: "Myanmar Kyat (MMK)" },
            { MKD: "Macedonian Denar (MKD)" },
            { MOP: "Macanese Pataca (MOP)" },
            { MUR: "Mauritian Rupee (MUR)" },
            { MVR: "Maldivian Rufiyaa (MVR)" },
            { MWK: "Malawian Kwacha (MWK)" },
            { MXN: "Mexican Peso (MXN)" },
            { MYR: "Malaysian Ringgit (MYR)" },
            { MZN: "Mozambican Metical (MZN)" },
            { NAD: "Namibian Dollar (NAD)" },
            { NPR: "Nepalese Rupee (NPR)" },
            { NZD: "New Zealand Dollar (NZD)" },
            { NIO: "Nicaraguan Cordoba (NIO)" },
            { NOK: "Norwegian Krone (NOK)" },
            { OMR: "Omani Rial (OMR)" },
            { PAB: "Panamanian Balboa (PAB)" },
            { PKR: "Pakistani Rupee (PKR)" },
            { PGK: "Papua New Guinean Kina (PGK)" },
            { PEN: "Peruvian Nuevo Sol (PEN)" },
            { PHP: "Philippine Peso (PHP)" },
            { PLN: "Polish Zloty (PLN)" },
            { QAR: "Qatari Rial (QAR)" },
            { RON: "Romanian Leu (RON)" },
            { RUB: "Russian Ruble (RUB)" },
            { RWF: "Rwandan Franc (RWF)" },
            { SAR: "Saudi Riyal (SAR)" },
            { STD: "Sao Tome and Principe Dobra (STD)" },
            { RSD: "Serbian Dinar (RSD)" },
            { SCR: "Seychellois Rupee (SCR)" },
            { SGD: "Singapore Dollar (SGD)" },
            { SYP: "Syrian Pound (SYP)" },
            { SEK: "Swedish Krona (SEK)" },
            { TWD: "New Taiwan Dollar (TWD)" },
            { THB: "Thai Baht (THB)" },
            { TZS: "Tanzanian Shilling (TZS)" },
            { TTD: "Trinidad and Tobago Dollar (TTD)" },
            { TND: "Tunisian Dinar (TND)" },
            { TRY: "Turkish Lira (TRY)" },
            { SBD: "Solomon Islands Dollar (SBD)" },
            { SDG: "Sudanese Pound (SDG)" },
            { SLL: "Sierra Leonean Leone (SLL)" },
            { SRD: "Surinamese Dollar (SRD)" },
            { SZL: "Swazi Lilangeni (SZL)" },
            { TJS: "Tajikistani Somoni (TJS)" },
            { TOP: "Tongan Paʻanga (TOP)" },
            { TMT: "Turkmenistani Manat (TMT)" },
            { UAH: "Ukrainian Hryvnia (UAH)" },
            { UGX: "Ugandan Shilling (UGX)" },
            { UYU: "Uruguayan Peso (UYU)" },
            { UZS: "Uzbekistan Som (UZS)" },
            { VEF: "Venezuelan Bolivar (VEF)" },
            { VND: "Vietnamese Dong (VND)" },
            { VUV: "Vanuatu Vatu (VUV)" },
            { WST: "Samoan Tala (WST)" },
            { XAF: "Central African CFA Franc (XAF)" },
            { XPF: "CFP Franc (XPF)" },
            { YER: "Yemeni Rial (YER)" },
            { ZAR: "South African Rand (ZAR)" },
          ],
          desktop_visible: true,
          mob_visible: true,
          money_mouse_show: false,
          textColor: "#1e1e1e",
          flag_theme: "default",
          selector_hover_hex: "#ffffff",
          lightning: true,
          mob_manual_placement: "",
          mob_placement: "bottom_left",
          mob_placement_type: "floating",
          moneyWithCurrencyFormat: false,
          ui_style: "default",
          user_curr: "",
          auto_loc: true,
          auto_pref: false,
          selector_bg_hex: "#ffffff",
          selector_border_type: "boxShadow",
          cart_alert_bg_hex: "#fbf5f5",
          cart_alert_note:
            "All orders are processed in [checkout_currency], using the latest exchange rates.",
          cart_alert_state: true,
          cart_alert_font_hex: "#1e1e1e",
        },
        {
          money_format:
            '\u003cspan class="money"\u003e₹{{amount}}\u003c\/span\u003e',
          money_with_currency_format:
            '\u003cspan class="money"\u003e₹{{amount}}\u003c\/span\u003e',
          user_curr: "INR",
        }
      );
      window.baCurr.config.multi_curr = [];

      window.baCurr.config.final_currency = "INR" || "";
      window.baCurr.config.multi_curr = "INR".split(",") || "";

      (function (window, document) {
        "use strict";
        function onload() {
          function insertPopupMessageJs() {
            var head = document.getElementsByTagName("head")[0];
            var script = document.createElement("script");
            script.src =
              ("https:" == document.location.protocol
                ? "https://"
                : "http://") + "currency.boosterapps.com/preview_curr.js";
            script.type = "text/javascript";
            head.appendChild(script);
          }

          if (document.location.search.indexOf("preview_cur=1") > -1) {
            setTimeout(function () {
              window.currency_preview_result =
                document.getElementById("baCurrSelector").length > 0
                  ? "success"
                  : "error";
              insertPopupMessageJs();
            }, 1000);
          }
        }

        var head = document.getElementsByTagName("head")[0];
        var script = document.createElement("script");
        script.src =
          ("https:" == document.location.protocol ? "https://" : "http://") +
          "";
        script.type = "text/javascript";
        script.onload = script.onreadystatechange = function () {
          if (script.readyState) {
            if (
              script.readyState === "complete" ||
              script.readyState === "loaded"
            ) {
              script.onreadystatechange = null;
              onload();
            }
          } else {
            onload();
          }
        };
        head.appendChild(script);
      })(window, document);
    </script>

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

      fbq("init", "795748567170435", {
        em: "yashsabhaya964@gmail.com",
      });

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
      src="https://cdn.shopify.com/extensions/c4e8e215-0970-4d3a-ac7b-2e25bea3398b/2.0.0/assets/ws-currencyconverter.js"
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
                page_type: "customers/addresses",
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
    <script id="evids-setup">
      (function () {
        let t, e;
        function n() {
          (t = {
            page_viewed: {},
            collection_viewed: {},
            product_viewed: {},
            product_variant_viewed: {},
            search_submitted: {},
            product_added_to_cart: {},
            checkout_started: {},
            checkout_completed: {},
            payment_info_submitted: {},
          }),
            (e = { wpm: {}, trekkie: {} });
        }
        function o(t) {
          return `${t || "sh"}-${(function () {
            const t = "xxxx-4xxx-xxxx-xxxxxxxxxxxx";
            let e = "";
            try {
              const n = window.crypto,
                o = new Uint16Array(31);
              n.getRandomValues(o);
              let r = 0;
              e = t
                .replace(/[x]/g, (t) => {
                  const e = o[r] % 16;
                  return r++, ("x" === t ? e : (3 & e) | 8).toString(16);
                })
                .toUpperCase();
            } catch (n) {
              e = t
                .replace(/[x]/g, (t) => {
                  const e = (16 * Math.random()) | 0;
                  return ("x" === t ? e : (3 & e) | 8).toString(16);
                })
                .toUpperCase();
            }
            return `${(function () {
              let t = 0,
                e = 0;
              t = new Date().getTime() >>> 0;
              try {
                e = performance.now() >>> 0;
              } catch (t) {
                e = 0;
              }
              const n = Math.abs(t + e)
                .toString(16)
                .toLowerCase();
              return "00000000".substr(0, 8 - n.length) + n;
            })()}-${e}`;
          })()}`;
        }
        function r(n, r) {
          if (
            !t[n] ||
            ("trekkie" !== (null == r ? void 0 : r.analyticsFramework) &&
              "wpm" !== (null == r ? void 0 : r.analyticsFramework))
          )
            return o("shu");
          const i = "string" == typeof (c = r.cacheKey) && c ? c : "default";
          var c;
          const a = (function (t, n, o) {
            const r = e[n];
            return (
              void 0 === r[t] && (r[t] = {}),
              void 0 === r[t][o] ? (r[t][o] = 0) : (r[t][o] += 1),
              r[t][o]
            );
          })(n, r.analyticsFramework, i);
          return (function (e, n, r) {
            const i = t[e];
            if (void 0 === i[r]) {
              const t = o();
              i[r] = [t];
            } else if (void 0 === i[r][n]) {
              const t = o();
              i[r].push(t);
            }
            return i[r][n];
          })(n, a, i);
        }
        function i() {
          (window.Shopify = window.Shopify || {}),
            n(),
            (window.Shopify.evids = (t, e) => r(t, e));
        }
        i();
      })();
    </script>
    <script>
      window.ShopifyAnalytics = window.ShopifyAnalytics || {};
      window.ShopifyAnalytics.meta = window.ShopifyAnalytics.meta || {};
      window.ShopifyAnalytics.meta.currency = "INR";
      var meta = { page: { customerId: 6713034932445 } };
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
                    "https://cdn.shopify.com/s/trekkie.storefront.32dc1f4fe8f576a6d20c0db4541aff3dd4b06687.min.js",
                }
              );
            };
            scriptFallback.async = true;
            scriptFallback.src =
              "https://cdn.shopify.com/s/trekkie.storefront.32dc1f4fe8f576a6d20c0db4541aff3dd4b06687.min.js";
            first.parentNode.insertBefore(scriptFallback, first);
          };
          script.async = true;
          script.src =
            "https://cdn.shopify.com/s/trekkie.storefront.32dc1f4fe8f576a6d20c0db4541aff3dd4b06687.min.js";
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
            customerId: 6713034932445,
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

          window.ShopifyAnalytics.lib.page(null, { customerId: 6713034932445 });

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
        window.BOOMR.renderRegion = "gcp-us-east1";
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
            customer: {
              email: "yashsabhaya964@gmail.com",
              firstName: "Yash",
              id: "6713034932445",
              lastName: "Sabhaya",
              phone: null,
            },
            productVariants: [],
          },
        },
        function pageEvents(webPixelsManagerAPI) {
          webPixelsManagerAPI.publish("page_viewed");
        },
        "https://cdn.shopify.com",
        "browser",
        "0.0.285",
        "da3bd5a4w8ea8a283p30eb74b3mf7ed84c9"
      );
    </script>
  </head>
  <body
    class="no-focus-outline features--image-zoom template-addresses"
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
        <stop offset="50%" stop-color="rgb(var(--product-star-rating))" />
        <stop
          offset="50%"
          stop-color="rgb(var(--product-star-rating))"
          stop-opacity="0.4"
        />
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

      <store-header sticky class="header header--bordered" role="banner">
        <div
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
                    <?php
                      $productType = "";
                      echo '<a
                        class="header__linklist-link link--animated"
                        href="product.php?id='.$productType.'"
                        aria-controls="desktop-menu-1"
                        aria-expanded="false"
                        >Collections</a
                      >';
                    ?>
                    <ul
                      hidden
                      id="desktop-menu-1"
                      class="nav-dropdown list--unstyled"
                      role="list"
                    >
                      <li class="nav-dropdown__item">
                        <?php
                          $productType = "New Arrivals";
                          echo '<a
                            class="nav-dropdown__link link--faded"
                            href="product.php?id='.$productType.'"
                            >New Arrivals</a
                          >';
                        ?>
                      </li>
                      <li class="nav-dropdown__item">
                        <?php
                          $productType = "Handbags";
                          echo '<a
                            class="nav-dropdown__link link--faded"
                            href="product.php?id='.$productType.'"
                            >Handbags</a
                          >';
                        ?>
                      </li>
                      <li class="nav-dropdown__item has-dropdown">
                        <?php
                          $productType = "Jewellery";
                          echo '<a
                            class="nav-dropdown__link link--faded"
                            href="product.php?id='.$productType.'"
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
                          >';
                          $productType = "Earrings";
                            echo '<li class="nav-dropdown__item">
                              <a
                                class="nav-dropdown__link link--faded"
                                href="product.php?id='.$productType.'"
                                >Earrings</a
                              >
                            </li>';
                            $productType = "Necklace";
                            echo '<li class="nav-dropdown__item">
                              <a
                                class="nav-dropdown__link link--faded"
                                href="product.php?id='.$productType.'"
                                >Necklace</a
                              >
                            </li>';
                            $productType = "Rings";
                            echo '<li class="nav-dropdown__item">
                              <a
                                class="nav-dropdown__link link--faded"
                                href="product.php?id='.$productType.'"
                                >Rings</a
                              >
                            </li>';
                            $productType = "Bracelet";
                            echo '<li class="nav-dropdown__item">
                              <a
                                class="nav-dropdown__link link--faded"
                                href="product.php?id='.$productType.'"
                                >Bracelet</a
                              >
                            </li>';
                            $productType = "Maang Tika";
                            echo '<li class="nav-dropdown__item">
                              <a
                                class="nav-dropdown__link link--faded"
                                href="product.php?id='.$productType.'"
                                >Maang Tika</a
                              >
                            </li>
                          </ul>';
                        ?>
                      </li>
                      <li class="nav-dropdown__item">
                        <?php
                          $productType = "Bedsheets";
                          echo '<a
                            class="nav-dropdown__link link--faded"
                            href="product.php?id='.$productType.'"
                            >Bedsheets</a
                          >';
                        ?>
                      </li>
                      <li class="nav-dropdown__item">
                        <?php
                          $productType = "Exclusive";
                          echo '<a
                            class="nav-dropdown__link link--faded"
                            href="product.php?id='.$productType.'"
                            >Exclusive</a
                          >';
                        ?>
                      </li>
                      <li class="nav-dropdown__item">
                        <?php
                          $productType = "Combo Packs";
                          echo '<a
                            class="nav-dropdown__link link--faded"
                            href="product.php?id='.$productType.'"
                            >Combo Packs</a
                          >';
                        ?>
                      </li>
                      <li class="nav-dropdown__item">
                        <?php
                          $productType = "Mens Kurta Pyjama";
                          echo '<a
                            class="nav-dropdown__link link--faded"
                            href="product.php?id='.$productType.'"
                            >Mens Kurta Pyjama</a
                          >';
                        ?>
                      </li>
                    </ul>
                  </li>
                  <li
                    class="header__linklist-item has-dropdown"
                    data-item-title="Sarees"
                  >
                    <?php
                      $productType = "Sarees";
                      echo '<a
                        class="header__linklist-link link--animated"
                        href="product.php?id='.$productType.'"
                        aria-controls="desktop-menu-2"
                        aria-expanded="false"
                        >Sarees</a
                      >';
                    ?>
                    <div hidden id="desktop-menu-2" class="mega-menu">
                      <div class="container">
                        <div class="mega-menu__inner">
                          <div class="mega-menu__columns-wrapper">
                            <div class="mega-menu__column">
                              <?php
                                $fabricType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&fabric='.$fabricType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Fabric</a
                                >
                                <ul class="linklist list--unstyled" role="list">';
                                  $fabricType = "Chiffon";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Cotton Sarees</a
                                    >
                                  </li>';
                                  $fabricType = "silk";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Art Silk Sarees</a
                                    >
                                  </li>';
                                  $fabricType = "Chiffon";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Chiffon Sarees</a
                                    >
                                  </li>';
                                  $fabricType = "GEORGETTE";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Georgette Sarees</a
                                    >
                                  </li>';
                                  $fabricType = "cracker silk";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Crepe Sarees</a
                                    >
                                  </li>';
                                  $fabricType = "Organza";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Organza Sarees</a
                                    >
                                  </li>';
                                  $fabricType = "Bandhej silk";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Chanderi Silk</a
                                    >
                                  </li>';
                                  $fabricType = "Soft sattin";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Bhagalpuri Silk</a
                                    >
                                  </li>';
                                  $fabricType = "satin";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Satin Sarees</a
                                    >
                                  </li>';
                                  $fabricType = "Lichi Silk.";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Linen Sarees</a
                                    >
                                  </li>';
                                  $fabricType = "Butterfly Net";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Net Sarees</a
                                    >
                                  </li>';
                                  $fabricType = "Kanjeevaram Silk";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Kanjivaram</a
                                    >
                                  </li>';
                                  $fabricType = "Soft silk";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Banarasi Silk</a
                                    >
                                  </li>';
                                ?>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $patternType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&pattern="
                                  class="mega-menu__title heading heading--small"
                                  >Print/Pattern</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                  $patternType = "Floral";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Floral Print</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                  $patternType = "Bandhani Style";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Bandhani Sarees</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                  $patternType = "Embroiedry";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Embroidered</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                  $patternType = "wiving print";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Paithani</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                  $patternType = "Lucknowi";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Lucknowi / Chickankari</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                  $patternType = "HEAVY WEAVING RICH PALLU";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Patola</a
                                    >
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $patternType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&pattern='.$patternType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Collection</a
                                >';
                                $patternType = "Half N Half Saree";
                                echo '<ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Half N Half Saree</a
                                    >
                                  </li>';
                                  $patternType = "Authentic Drapes";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Authentic Drapes</a
                                    >
                                  </li>';
                                  $patternType = "Bollywood";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Bollywood</a
                                    >
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $minPrice = "";
                                $maxPrice = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'"
                                  class="mega-menu__title heading heading--small"
                                  >Price</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $minPrice = "0";
                                    $maxPrice = "999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >0-999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "1000";
                                    $maxPrice = "1999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >1000-1999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "2000";
                                    $maxPrice = "2999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >2000-2999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "3000";
                                    $maxPrice = "3999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >3000-3999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "4000";
                                    $maxPrice = "4999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >4000-4999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "5000";
                                    $maxPrice = "5999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >5000 & above</a
                                    >
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $occasionType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&occasion='.$occasionType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Occasion</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $occasionType = "Bridestmaid";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Bridal</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Georgette saree";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Casual / Daily</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Engagement";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Engagement</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Festive Wear";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Festive</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Haldi saree";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Haldi</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Mahendi";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Mehendi</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Trendy Saree";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Office wear</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Party Wear";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Party
                                    </a>
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Wedding ,Reception";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Reception</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Party, Reception ,Wedding";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Sangeet</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Wedding Wear";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Wedding
                                    </a>
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                              $color = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&color='.$color.'"
                                  class="mega-menu__title heading heading--small"
                                  >Color</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $color = "Red";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Red</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Pink";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Pink</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "White";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >White</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Black";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Black</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Orange";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Orange</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Blue";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Blue</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Purple";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Purple</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Yellow";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Yellow</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Brown";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Brown</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Grey";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Grey</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Green";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Green</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Multicolor";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Multicolor</a
                                    >
                                  </li>
                                </ul>';
                              ?>
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
                  <?php
                    $productType = "Salwar Suits";
                    echo '<a
                      class="header__linklist-link link--animated"
                      href="product.php?id='.$productType.'"
                      aria-controls="desktop-menu-3"
                      aria-expanded="false"
                      >Salwar Suits</a
                    >';
                  ?>
                    <div hidden id="desktop-menu-3" class="mega-menu">
                      <div class="container">
                        <div class="mega-menu__inner">
                          <div class="mega-menu__columns-wrapper">
                            <div class="mega-menu__column">
                              <?php
                                $fabricType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&fabric='.$fabricType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Fabric</a
                                >
                                <ul class="linklist list--unstyled" role="list">';
                                  $fabricType = "Rayon";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Rayon</a
                                    >
                                  </li>';
                                  $fabricType = "Cotton";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Cotton</a
                                    >
                                  </li>';
                                  $fabricType = "GEORGETTE";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Georgette</a
                                    >
                                  </li>';
                                  $fabricType = "cracker silk";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Crepe</a
                                    >
                                  </li>';
                                  $fabricType = "Chiffon";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Chiffon</a
                                    >
                                  </li>';
                                  $fabricType = "Organza";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Organza</a
                                    >
                                  </li>';
                                  $fabricType = "Bhagalpuri silk";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Bhagalpuri Silk</a
                                    >
                                  </li>';
                                  $fabricType = "Banarasi";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Banarasi</a
                                    >
                                  </li>';
                                  $fabricType = "Chanderi";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Chanderi</a
                                    >
                                  </li>';
                                  $fabricType = "jacquard";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Jacquard</a
                                    >
                                  </li>';
                                  $fabricType = "Kanjeevaram Silk";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Tapetta Silk</a
                                    >
                                  </li>';
                                  $fabricType = "Soft silk";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Tussar Silk</a
                                    >
                                  </li>';
                                  $fabricType = "Butterfly Net";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Net</a
                                    >
                                  </li>';
                                ?>
                              </ul>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $styleType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&style='.$styleType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Style</a
                                >
                                <ul class="linklist list--unstyled" role="list">';
                                  $styleType = "Sharara Suits";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&style='.$styleType.'" class="link--faded"
                                      >Sharara Suits</a
                                    >
                                  </li>';
                                  $styleType = "Anarkali Suits";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&style='.$styleType.'" class="link--faded"
                                      >Anarkali Suits</a
                                    >
                                  </li>';
                                  $styleType = "Palazzo Suits";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&style='.$styleType.'" class="link--faded"
                                      >Palazzo Suits</a
                                    >
                                  </li>';
                                  $styleType = "Patiala Suits";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&style='.$styleType.'" class="link--faded"
                                      >Patiala Suits</a
                                    >
                                  </li>';
                                  $styleType = "Pakistani Suits";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&style='.$styleType.'" class="link--faded"
                                      >Pakistani Suits</a
                                    >
                                  </li>';
                                  $styleType = "Straight Cut Suits";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&style='.$styleType.'" class="link--faded"
                                      >Straight Cut Suits</a
                                    >
                                  </li>';
                                  $styleType = "Indo western";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&style='.$styleType.'" class="link--faded"
                                      >Indo western</a
                                    >
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $stitchType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&occasion='.$stitchType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Stitch Type</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $stitchType = "Unstiched";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$stitchType.'" class="link--faded"
                                      >Unstitched Salwar suits</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $stitchType = "Banglory Silk Sequin";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$stitchType.'" class="link--faded"
                                      >Readymade Salwar suits</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $stitchType = "Unstiched Banglori";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$stitchType.'" class="link--faded"
                                      >Semi Stitched</a
                                    >
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $minPrice = "";
                                $maxPrice = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'"
                                  class="mega-menu__title heading heading--small"
                                  >Price</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $minPrice = "0";
                                    $maxPrice = "999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >0-999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "1000";
                                    $maxPrice = "1999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >1000-1999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "2000";
                                    $maxPrice = "2999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >2000-2999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "3000";
                                    $maxPrice = "3999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >3000 & above</a
                                    >
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $occasionType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&occasion='.$occasionType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Occasion</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $occasionType = "Bridestmaid";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Bridal</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Georgette saree";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Casual / Daily</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Engagement";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Engagement</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Festive Wear";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Festive</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Haldi saree";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Haldi</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Mahendi";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Mehendi</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Trendy Saree";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Office wear</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Party Wear";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Party
                                    </a>
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Wedding ,Reception";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Reception</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Party, Reception ,Wedding";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Sangeet</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Wedding Wear";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Wedding
                                    </a>
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                              $color = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&color='.$color.'"
                                  class="mega-menu__title heading heading--small"
                                  >Color</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $color = "Red";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Red</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Pink";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Pink</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "White";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >White</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Black";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Black</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Orange";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Orange</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Blue";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Blue</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Purple";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Purple</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Yellow";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Yellow</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Brown";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Brown</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Grey";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Grey</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Green";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Green</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Multicolor";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Multicolor</a
                                    >
                                  </li>
                                </ul>';
                              ?>
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
                  <?php
                    $productType = "Kurtis";
                    echo '<a
                      class="header__linklist-link link--animated"
                      href="product.php?id='.$productType.'"
                      aria-controls="desktop-menu-4"
                      aria-expanded="false"
                      >Kurtis</a
                    >';
                  ?>
                    <div hidden id="desktop-menu-4" class="mega-menu">
                      <div class="container">
                        <div class="mega-menu__inner">
                          <div class="mega-menu__columns-wrapper">
                            <div class="mega-menu__column">
                              <?php
                                $fabricType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&fabric='.$fabricType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Fabric</a
                                >
                                <ul class="linklist list--unstyled" role="list">';
                                  $fabricType = "silk";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Silk</a
                                    >
                                  </li>';
                                  $fabricType = "Rayon";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Rayon</a
                                    >
                                  </li>';
                                  $fabricType = "Cotton";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Cotton</a
                                    >
                                  </li>';
                                  $fabricType = "GEORGETTE";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Georgette</a
                                    >
                                  </li>';
                                  $fabricType = "cracker silk";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Crepe</a
                                    >
                                  </li>';
                                  $fabricType = "Chiffon";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Chiffon</a
                                    >
                                  </li>';
                                  $fabricType = "Chanderi";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Chanderi Cotton</a
                                    >
                                  </li>';
                                  $fabricType = "jacquard";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Jacquard</a
                                    >
                                  </li>';
                                  $fabricType = "Linen";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Linen</a
                                    >
                                  </li>';
                                  $fabricType = "Muslin";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Muslin</a
                                    >
                                  </li>';
                                ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $patternType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&pattern='.$patternType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Print/Pattern</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                  $patternType = "Floral";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Floral Print</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                  $patternType = "Solid";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Solid</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                  $patternType = "Bandhani Style";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Bandhani</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                  $patternType = "Printed";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Printed</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                  $patternType = "Embroiedry";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Embroidered</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                  $patternType = "Anarkali";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Anarkali</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                  $patternType = "A-Line";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >A-Line</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                  $patternType = "Straight";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Straight</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                  $patternType = "Short";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Short</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                  $patternType = "Long";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Long</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                  $patternType = "High Low";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >High Low</a
                                    >
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $sub_productType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&pattern='.$sub_productType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Product Type</a
                                >
                                <ul class="linklist list--unstyled" role="list">';
                                  $sub_productType = "Kurti Pant Set";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&pattern='.$sub_productType.'" class="link--faded"
                                      >Kurti Pant Set</a
                                    >
                                  </li>';
                                  $sub_productType = "Kurti Palazzo Set";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&pattern='.$sub_productType.'" class="link--faded"
                                      >Kurti Palazzo Set</a
                                    >
                                  </li>';
                                  $sub_productType = "Kurti Dhoti Set";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&pattern='.$sub_productType.'" class="link--faded"
                                      >Kurti Dhoti Set</a
                                    >
                                  </li>';
                                  $sub_productType = "Kurti Skirt Set";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&pattern='.$sub_productType.'" class="link--faded"
                                      >Kurti Skirt Set</a
                                    >
                                  </li>';
                                  $sub_productType = "Palazzo Suit";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&pattern='.$sub_productType.'" class="link--faded"
                                      >Palazzo Suit</a
                                    >
                                  </li>';
                                  $sub_productType = "Top Bottom Set";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&pattern='.$sub_productType.'" class="link--faded"
                                      >Top Bottom Set</a
                                    >
                                  </li>';
                                  $sub_productType = "Kurti";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&pattern='.$sub_productType.'" class="link--faded"
                                      >Kurti</a
                                    >
                                  </li>';
                                  $sub_productType = "Kaftan";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&pattern='.$sub_productType.'" class="link--faded"
                                      >Kaftan</a
                                    >
                                  </li>';
                                  $sub_productType = "Kaftan Set";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&pattern='.$sub_productType.'" class="link--faded"
                                      >Kaftan Set</a
                                    >
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $occasionType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&occasion='.$occasionType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Occasion</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $occasionType = "Georgette saree";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Casual / Daily</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Festive Wear";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Festive</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Trendy Saree";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Office wear</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Party Wear";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Party
                                    </a>
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $minPrice = "";
                                $maxPrice = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'"
                                  class="mega-menu__title heading heading--small"
                                  >Price</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $minPrice = "0";
                                    $maxPrice = "999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >0-999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "1000";
                                    $maxPrice = "1999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >1000-1999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "2000";
                                    $maxPrice = "2999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >2000 & above</a
                                    >
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                              $color = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&color='.$color.'"
                                  class="mega-menu__title heading heading--small"
                                  >Color</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $color = "Red";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Red</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Pink";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Pink</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "White";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >White</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Black";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Black</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Orange";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Orange</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Blue";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Blue</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Purple";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Purple</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Yellow";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Yellow</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Brown";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Brown</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Grey";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Grey</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Green";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Green</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Multicolor";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Multicolor</a
                                    >
                                  </li>
                                </ul>';
                              ?>
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
                  <?php
                    $productType = "Lehengas";
                    echo '<a
                      class="header__linklist-link link--animated"
                      href="product.php"
                      aria-controls="desktop-menu-5"
                      aria-expanded="false"
                      >Lehengas</a
                    >';
                  ?>
                    <div hidden id="desktop-menu-5" class="mega-menu">
                      <div class="container">
                        <div class="mega-menu__inner">
                          <div class="mega-menu__columns-wrapper">
                            <div class="mega-menu__column">
                              <?php
                                $fabricType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&fabric='.$fabricType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Fabric</a
                                >
                                <ul class="linklist list--unstyled" role="list">';
                                  $fabricType = "silk";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Art Silk</a
                                    >
                                  </li>';
                                  $fabricType = "Chiffon";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Banarasi Silk</a
                                    >
                                  </li>';
                                  $fabricType = "cotton";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Cotton</a
                                    >
                                  </li>';
                                  $fabricType = "GEORGETTE";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Georgette</a
                                    >
                                  </li>';
                                  $fabricType = "jacquard";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Jacquard</a
                                    >
                                  </li>';
                                  $fabricType = "Organza";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Organza Sarees</a
                                    >
                                  </li>';
                                  $fabricType = "satin";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Satin Sarees</a
                                    >
                                  </li>';
                                  $fabricType = "silk";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Silk</a
                                    >
                                  </li>';
                                  $fabricType = "velvet";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Velvet</a
                                    >
                                  </li>';
                                ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $patternType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&pattern='.$patternType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Print/Pattern</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                  $patternType = "Designer work pattern";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Designer</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                  $patternType = "Digital";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Digital</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                  $patternType = "floral";
                                    echo '<a href="product.php?id='.$productType.'&pattern='.$patternType.'" class="link--faded"
                                      >Floral</a
                                    >
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $minPrice = "";
                                $maxPrice = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'"
                                  class="mega-menu__title heading heading--small"
                                  >Price</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $minPrice = "0";
                                    $maxPrice = "999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >0-999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "1000";
                                    $maxPrice = "1999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >1000-1999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "2000";
                                    $maxPrice = "2999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >2000-2999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "3000";
                                    $maxPrice = "3999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >3000-3999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "4000";
                                    $maxPrice = "4999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >4000-4999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "5000";
                                    $maxPrice = "5999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >5000 & above</a
                                    >
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $occasionType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&occasion='.$occasionType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Occasion</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $occasionType = "Bridestmaid";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Bridal</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Engagement";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Engagement</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Festive Wear";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Festive</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Haldi saree";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Haldi</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Mahendi";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Mehendi</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Party Wear";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Party
                                    </a>
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Wedding ,Reception";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Reception</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Party, Reception ,Wedding";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Sangeet</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Wedding Wear";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Wedding
                                    </a>
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                              $color = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&color='.$color.'"
                                  class="mega-menu__title heading heading--small"
                                  >Color</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $color = "Red";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Red</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Pink";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Pink</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "White";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >White</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Black";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Black</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Orange";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Orange</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Blue";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Blue</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Purple";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Purple</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Yellow";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Yellow</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Brown";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Brown</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Grey";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Grey</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Green";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Green</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Multicolor";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Multicolor</a
                                    >
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $stitchType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&occasion='.$stitchType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Stitch Type</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $stitchType = "Banglory Silk Sequin";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$stitchType.'" class="link--faded"
                                      >Ready to wear</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $stitchType = "Unstiched";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$stitchType.'" class="link--faded"
                                      >Unstitched</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $stitchType = "Unstiched Banglori";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$stitchType.'" class="link--faded"
                                      >Semi Stitched</a
                                    >
                                  </li>
                                </ul>';
                              ?>
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
                  <?php
                    $productType = "Gowns";
                    echo '<a
                      class="header__linklist-link link--animated"
                      href="product.php?id='.$productType.'"
                      aria-controls="desktop-menu-6"
                      aria-expanded="false"
                      >Gowns</a
                    >';
                  ?>
                    <div hidden id="desktop-menu-6" class="mega-menu">
                      <div class="container">
                        <div class="mega-menu__inner">
                          <div class="mega-menu__columns-wrapper">
                            <div class="mega-menu__column">
                              <?php
                                $fabricType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&fabric='.$fabricType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Fabric</a
                                >
                                <ul class="linklist list--unstyled" role="list">';
                                  $fabricType = "Cotton";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Cotton</a
                                    >
                                  </li>';
                                  $fabricType = "satin";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Satin</a
                                    >
                                  </li>';
                                  $fabricType = "Chanderi";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Chanderi</a
                                    >
                                  </li>';
                                  $fabricType = "GEORGETTE";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Georgette</a
                                    >
                                  </li>';
                                  $fabricType = "jacquard";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Jacquard</a
                                    >
                                  </li>';
                                  $fabricType = "Butterfly Net";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Net</a
                                    >
                                  </li>';
                                  $fabricType = "Rayon";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Rayon</a
                                    >
                                  </li>';
                                  $fabricType = "silk";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Silk</a
                                    >
                                  </li>';
                                  $fabricType = "Kanjeevaram Silk";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Tapetta Silk</a
                                    >
                                  </li>';
                                ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $occasionType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&occasion='.$occasionType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Occasion</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $occasionType = "Bridestmaid";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Bridal</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Engagement";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Engagement</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Festive Wear";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Festive</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Haldi saree";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Haldi</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Mahendi";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Mehendi</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Party Wear";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Party
                                    </a>
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Wedding ,Reception";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Reception</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Party, Reception ,Wedding";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Sangeet</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Wedding Wear";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Wedding
                                    </a>
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $minPrice = "";
                                $maxPrice = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'"
                                  class="mega-menu__title heading heading--small"
                                  >Price</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $minPrice = "0";
                                    $maxPrice = "999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >0-999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "1000";
                                    $maxPrice = "1999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >1000-1999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "2000";
                                    $maxPrice = "2999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >2000-2999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "3000";
                                    $maxPrice = "3999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >3000-3999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "4000";
                                    $maxPrice = "4999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >4000-4999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "5000";
                                    $maxPrice = "5999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >5000 & above</a
                                    >
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                              $color = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&color='.$color.'"
                                  class="mega-menu__title heading heading--small"
                                  >Color</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $color = "Red";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Red</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Pink";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Pink</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "White";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >White</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Black";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Black</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Orange";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Orange</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Blue";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Blue</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Purple";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Purple</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Yellow";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Yellow</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Brown";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Brown</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Grey";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Grey</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Green";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Green</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Multicolor";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Multicolor</a
                                    >
                                  </li>
                                </ul>';
                              ?>
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
                  <?php
                    $productType = "Western";
                    echo '<a
                      class="header__linklist-link link--animated"
                      href="product.php?id='.$productType.'"
                      aria-controls="desktop-menu-7"
                      aria-expanded="false"
                      >Western</a
                    >';
                  ?>
                    <div hidden id="desktop-menu-7" class="mega-menu">
                      <div class="container">
                        <div class="mega-menu__inner">
                          <div class="mega-menu__columns-wrapper">
                            <div class="mega-menu__column">
                              <?php
                                $fabricType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&fabric='.$fabricType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Fabric</a
                                >
                                <ul class="linklist list--unstyled" role="list">';
                                  $fabricType = "Rayon";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Rayon</a
                                    >
                                  </li>';
                                  $fabricType = "Cotton";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Cotton</a
                                    >
                                  </li>';
                                  $fabricType = "GEORGETTE";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Georgette</a
                                    >
                                  </li>';
                                  $fabricType = "Chiffon";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Chiffon</a
                                    >
                                  </li>';
                                  $fabricType = "cracker silk";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&fabric='.$fabricType.'" class="link--faded"
                                      >Crepe</a
                                    >
                                  </li>';
                                ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                              $sub_productType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&pattern='.$sub_productType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Type</a
                                >';
                                $sub_productType = "Tops";
                                echo '<ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&pattern='.$sub_productType.'" class="link--faded"
                                      >Tops</a
                                    >
                                  </li>';
                                  $sub_productType = "Tunics";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&pattern='.$sub_productType.'" class="link--faded"
                                      >Tunics</a
                                    >
                                  </li>';
                                  $sub_productType = "Dresses";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&pattern='.$sub_productType.'" class="link--faded"
                                      >Dresses</a
                                    >
                                  </li>';
                                  $sub_productType = "Jumpsuit";
                                  echo '<li class="linklist__item">
                                    <a href="product.php?id='.$productType.'&pattern='.$sub_productType.'" class="link--faded"
                                      >Jumpsuit</a
                                    >
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $occasionType = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&occasion='.$occasionType.'"
                                  class="mega-menu__title heading heading--small"
                                  >Occasion</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $occasionType = "Georgette saree";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Casual / Daily</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Festive Wear";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Festive</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Trendy Saree";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Office wear</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $occasionType = "Party Wear";
                                    echo '<a href="product.php?id='.$productType.'&occasion='.$occasionType.'" class="link--faded"
                                      >Party
                                    </a>
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                                $minPrice = "";
                                $maxPrice = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'"
                                  class="mega-menu__title heading heading--small"
                                  >Price</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $minPrice = "0";
                                    $maxPrice = "999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >0-999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "1000";
                                    $maxPrice = "1999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >1000-1999</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $minPrice = "2000";
                                    $maxPrice = "2999";
                                    echo '<a href="product.php?id='.$productType.'&minPrice='.$minPrice.'&maxPrice='.$maxPrice.'" class="link--faded"
                                      >2000 & above</a
                                    >
                                  </li>
                                </ul>';
                              ?>
                            </div>
                            <div class="mega-menu__column">
                              <?php
                              $color = "";
                                echo '<a
                                  href="product.php?id='.$productType.'&color='.$color.'"
                                  class="mega-menu__title heading heading--small"
                                  >Color</a
                                >
                                <ul class="linklist list--unstyled" role="list">
                                  <li class="linklist__item">';
                                    $color = "Red";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Red</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Pink";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Pink</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "White";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >White</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Black";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Black</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Orange";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Orange</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Blue";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Blue</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Purple";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Purple</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Yellow";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Yellow</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Brown";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Brown</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Grey";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Grey</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Green";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Green</a
                                    >
                                  </li>
                                  <li class="linklist__item">';
                                    $color = "Multicolor";
                                    echo '<a href="product.php?id='.$productType.'&color='.$color.'" class="link--faded"
                                      >Multicolor</a
                                    >
                                  </li>
                                </ul>';
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="header__linklist-item" data-item-title="Live">
                  <?php
                    $productType = "Live";
                    echo '<a
                      class="header__linklist-link link--animated"
                      href="product.php?id='.$productType.'"
                      >Live</a
                    >';
                  ?>
                  </li>
                  <li class="header__linklist-item" data-item-title="Sale">
                  <?php
                    $productType = "Sale";
                    echo '<a
                      class="header__linklist-link link--animated"
                      href="product.php?id='.$productType.'"
                      >Sale</a
                    >';
                  ?>
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
                <?php echo $login_display; ?>
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
        </style> 
      </store-header>
      <cart-notification
        global
        hidden
        class="cart-notification"
      ></cart-notification>
      <mobile-navigation
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
            <a class="icon-text" href="/account"
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
        id="shopify-section-template--15880464924893__main"
        class="shopify-section shopify-section--main-customers-addresses"
      >
        <section>
          <div class="link-bar hidden-phone">
            <div class="container">
              <div class="link-bar__wrapper">
                <ul class="link-bar__linklist list--unstyled" role="list">
                  <li class="link-bar__link-item">
                    <a href="profile.php" class="link-bar__link link--animated"
                      >My Profile</a
                    >
                  </li>
                  <li class="link-bar__link-item">
                    <a
                      href="account.php"
                      class="link-bar__link link--animated"
                      >Orders</a
                    >
                  </li>

                  <li class="link-bar__link-item">
                    <a
                      href="address.php"
                      class="link-bar__link link--animated text--underlined"
                      >Addresses</a
                    >
                  </li>
                  <li class="link-bar__link-item">
                    <a
                      href="track-order.php"
                      class="link-bar__link link--animated"
                      >Track Order</a
                    >
                  </li>

                  <li class="link-bar__link-item">
                    <a
                      href="logout.php"
                      class="link-bar__link link--animated text--subdued"
                      data-no-instant
                      >Logout</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="mobile-toolbar hidden-tablet-and-up">
            <button
              is="toggle-button"
              class="mobile-toolbar__item"
              aria-expanded="false"
              aria-controls="account-links-popover"
            >
              Addresses<svg
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
                ></path>
              </svg>
            </button>
          </div>

          <popover-content id="account-links-popover" class="popover">
            <span class="popover__overlay"></span>

            <header class="popover__header">
              <span class="popover__title heading h6">My account</span>

              <button
                type="button"
                class="popover__close-button tap-area tap-area--large"
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

            <div class="popover__content">
              <div class="popover__choice-list">
                <a href="profile.php" class="popover__choice-item">
                  <span class="popover__choice-label">My Profile</span>
                </a>
                <a href="account.php" class="popover__choice-item">
                  <span class="popover__choice-label">Orders</span>
                </a>

                <a href="address.php" class="popover__choice-item">
                  <span class="popover__choice-label" aria-current="true"
                    >Addresses</span
                  >
                </a>

                <a
                  href="logout.php"
                  class="popover__choice-item text--subdued"
                  data-no-instant
                >
                  <span class="popover__choice-label">Logout</span>
                </a>
              </div>
            </div>
          </popover-content>

          <div class="account account--addresses">
            <div class="container container--small">
              <div class="page-header page-header--small">
                <div class="page-header__text-wrapper text-container">
                  <h1 class="heading h4">
                    Address
                  </h1>
                </div>
              </div>

              <div class="page-content">
                <div class="account__block-list">
                  <div class="account__block-item">
                    <div class="account__addresses-list">
                      <div class="account__address">
                        <span
                          class="account__address-title heading heading--small"
                          >Default address</span
                        >
                        <?php echo $display_data; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <drawer-content
            id="drawer-new-address"
            class="drawer drawer--large"
            initial-focus-selector="[type='text']:first-child"
          >
            <span class="drawer__overlay"></span>

            <header class="drawer__header">
              <h3 class="drawer__title heading h6">Add a new address</h3>

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

            <div class="drawer__content drawer__content--padded-start">
              <form
                method="post"
                action="/account/addresses"
                id="address_form_new"
                accept-charset="UTF-8"
                class="form"
              >
                <input
                  type="hidden"
                  name="form_type"
                  value="customer_address"
                /><input type="hidden" name="utf8" value="✓" />
                <p class="form__info">Please fill in the fields below:</p>
                <div class="input-row">
                  <div class="input">
                    <input
                      id="address-new[first_name]"
                      type="text"
                      class="input__field input__field--text"
                      name="address[first_name]"
                      value=""
                    />
                    <label for="address-new[first_name]" class="input__label"
                      >First name</label
                    >
                  </div>

                  <div class="input">
                    <input
                      id="address-new[last_name]"
                      type="text"
                      class="input__field input__field--text"
                      name="address[last_name]"
                      value=""
                    />
                    <label for="address-new[last_name]" class="input__label"
                      >Last name</label
                    >
                  </div>
                </div>

                <div class="input">
                  <input
                    id="address-new[company]"
                    type="text"
                    class="input__field input__field--text"
                    name="address[company]"
                    value=""
                  />
                  <label for="address-new[company]" class="input__label"
                    >Company</label
                  >
                </div>

                <div class="input">
                  <input
                    id="address-new[phone]"
                    type="text"
                    class="input__field input__field--text"
                    name="address[phone]"
                    value=""
                  />
                  <label for="address-new[phone]" class="input__label"
                    >Phone number</label
                  >
                </div>

                <div class="input">
                  <input
                    id="address-new[address1]"
                    type="text"
                    class="input__field input__field--text"
                    name="address[address1]"
                    value=""
                  />
                  <label for="address-new[address1]" class="input__label"
                    >Address 1</label
                  >
                </div>

                <div class="input">
                  <input
                    id="address-new[address2]"
                    type="text"
                    class="input__field input__field--text"
                    name="address[address2]"
                    value=""
                  />
                  <label for="address-new[address2]" class="input__label"
                    >Address 2</label
                  >
                </div>

                <div class="input-row">
                  <div class="input">
                    <input
                      id="address-new[city]"
                      type="text"
                      class="input__field input__field--text"
                      name="address[city]"
                      value=""
                    />
                    <label for="address-new[city]" class="input__label"
                      >City</label
                    >
                  </div>

                  <div class="input">
                    <input
                      id="address-new[zip]"
                      type="text"
                      class="input__field input__field--text"
                      name="address[zip]"
                      value=""
                    />
                    <label for="address-new[zip]" class="input__label"
                      >Zip code</label
                    >
                  </div>
                </div>

                <div class="input">
                  <div class="select-wrapper is-filled">
                    <select
                      is="country-selector"
                      class="select"
                      name="address[country]"
                      id="address-new[country]"
                      aria-owns="address-new-province-container"
                    >
                      <option
                        value="India"
                        data-provinces='[["Andaman and Nicobar Islands","Andaman and Nicobar Islands"],["Andhra Pradesh","Andhra Pradesh"],["Arunachal Pradesh","Arunachal Pradesh"],["Assam","Assam"],["Bihar","Bihar"],["Chandigarh","Chandigarh"],["Chhattisgarh","Chhattisgarh"],["Dadra and Nagar Haveli","Dadra and Nagar Haveli"],["Daman and Diu","Daman and Diu"],["Delhi","Delhi"],["Goa","Goa"],["Gujarat","Gujarat"],["Haryana","Haryana"],["Himachal Pradesh","Himachal Pradesh"],["Jammu and Kashmir","Jammu and Kashmir"],["Jharkhand","Jharkhand"],["Karnataka","Karnataka"],["Kerala","Kerala"],["Ladakh","Ladakh"],["Lakshadweep","Lakshadweep"],["Madhya Pradesh","Madhya Pradesh"],["Maharashtra","Maharashtra"],["Manipur","Manipur"],["Meghalaya","Meghalaya"],["Mizoram","Mizoram"],["Nagaland","Nagaland"],["Odisha","Odisha"],["Puducherry","Puducherry"],["Punjab","Punjab"],["Rajasthan","Rajasthan"],["Sikkim","Sikkim"],["Tamil Nadu","Tamil Nadu"],["Telangana","Telangana"],["Tripura","Tripura"],["Uttar Pradesh","Uttar Pradesh"],["Uttarakhand","Uttarakhand"],["West Bengal","West Bengal"]]'
                      >
                        India
                      </option>
                      <option
                        value="Australia"
                        data-provinces='[["Australian Capital Territory","Australian Capital Territory"],["New South Wales","New South Wales"],["Northern Territory","Northern Territory"],["Queensland","Queensland"],["South Australia","South Australia"],["Tasmania","Tasmania"],["Victoria","Victoria"],["Western Australia","Western Australia"]]'
                      >
                        Australia
                      </option>
                      <option
                        value="United States"
                        data-provinces='[["Alabama","Alabama"],["Alaska","Alaska"],["American Samoa","American Samoa"],["Arizona","Arizona"],["Arkansas","Arkansas"],["Armed Forces Americas","Armed Forces Americas"],["Armed Forces Europe","Armed Forces Europe"],["Armed Forces Pacific","Armed Forces Pacific"],["California","California"],["Colorado","Colorado"],["Connecticut","Connecticut"],["Delaware","Delaware"],["District of Columbia","Washington DC"],["Federated States of Micronesia","Micronesia"],["Florida","Florida"],["Georgia","Georgia"],["Guam","Guam"],["Hawaii","Hawaii"],["Idaho","Idaho"],["Illinois","Illinois"],["Indiana","Indiana"],["Iowa","Iowa"],["Kansas","Kansas"],["Kentucky","Kentucky"],["Louisiana","Louisiana"],["Maine","Maine"],["Marshall Islands","Marshall Islands"],["Maryland","Maryland"],["Massachusetts","Massachusetts"],["Michigan","Michigan"],["Minnesota","Minnesota"],["Mississippi","Mississippi"],["Missouri","Missouri"],["Montana","Montana"],["Nebraska","Nebraska"],["Nevada","Nevada"],["New Hampshire","New Hampshire"],["New Jersey","New Jersey"],["New Mexico","New Mexico"],["New York","New York"],["North Carolina","North Carolina"],["North Dakota","North Dakota"],["Northern Mariana Islands","Northern Mariana Islands"],["Ohio","Ohio"],["Oklahoma","Oklahoma"],["Oregon","Oregon"],["Palau","Palau"],["Pennsylvania","Pennsylvania"],["Puerto Rico","Puerto Rico"],["Rhode Island","Rhode Island"],["South Carolina","South Carolina"],["South Dakota","South Dakota"],["Tennessee","Tennessee"],["Texas","Texas"],["Utah","Utah"],["Vermont","Vermont"],["Virgin Islands","U.S. Virgin Islands"],["Virginia","Virginia"],["Washington","Washington"],["West Virginia","West Virginia"],["Wisconsin","Wisconsin"],["Wyoming","Wyoming"]]'
                      >
                        United States
                      </option>
                      <option
                        value="United Kingdom"
                        data-provinces='[["British Forces","British Forces"],["England","England"],["Northern Ireland","Northern Ireland"],["Scotland","Scotland"],["Wales","Wales"]]'
                      >
                        United Kingdom
                      </option>
                      <option value="---" data-provinces="[]">---</option>
                      <option value="Afghanistan" data-provinces="[]">
                        Afghanistan
                      </option>
                      <option value="Aland Islands" data-provinces="[]">
                        Åland Islands
                      </option>
                      <option value="Albania" data-provinces="[]">
                        Albania
                      </option>
                      <option value="Algeria" data-provinces="[]">
                        Algeria
                      </option>
                      <option value="Andorra" data-provinces="[]">
                        Andorra
                      </option>
                      <option value="Angola" data-provinces="[]">Angola</option>
                      <option value="Anguilla" data-provinces="[]">
                        Anguilla
                      </option>
                      <option value="Antigua And Barbuda" data-provinces="[]">
                        Antigua & Barbuda
                      </option>
                      <option
                        value="Argentina"
                        data-provinces='[["Buenos Aires","Buenos Aires Province"],["Catamarca","Catamarca"],["Chaco","Chaco"],["Chubut","Chubut"],["Ciudad Autónoma de Buenos Aires","Buenos Aires (Autonomous City)"],["Corrientes","Corrientes"],["Córdoba","Córdoba"],["Entre Ríos","Entre Ríos"],["Formosa","Formosa"],["Jujuy","Jujuy"],["La Pampa","La Pampa"],["La Rioja","La Rioja"],["Mendoza","Mendoza"],["Misiones","Misiones"],["Neuquén","Neuquén"],["Río Negro","Río Negro"],["Salta","Salta"],["San Juan","San Juan"],["San Luis","San Luis"],["Santa Cruz","Santa Cruz"],["Santa Fe","Santa Fe"],["Santiago Del Estero","Santiago del Estero"],["Tierra Del Fuego","Tierra del Fuego"],["Tucumán","Tucumán"]]'
                      >
                        Argentina
                      </option>
                      <option value="Armenia" data-provinces="[]">
                        Armenia
                      </option>
                      <option value="Aruba" data-provinces="[]">Aruba</option>
                      <option value="Ascension Island" data-provinces="[]">
                        Ascension Island
                      </option>
                      <option
                        value="Australia"
                        data-provinces='[["Australian Capital Territory","Australian Capital Territory"],["New South Wales","New South Wales"],["Northern Territory","Northern Territory"],["Queensland","Queensland"],["South Australia","South Australia"],["Tasmania","Tasmania"],["Victoria","Victoria"],["Western Australia","Western Australia"]]'
                      >
                        Australia
                      </option>
                      <option value="Austria" data-provinces="[]">
                        Austria
                      </option>
                      <option value="Azerbaijan" data-provinces="[]">
                        Azerbaijan
                      </option>
                      <option value="Bahamas" data-provinces="[]">
                        Bahamas
                      </option>
                      <option value="Bahrain" data-provinces="[]">
                        Bahrain
                      </option>
                      <option value="Bangladesh" data-provinces="[]">
                        Bangladesh
                      </option>
                      <option value="Barbados" data-provinces="[]">
                        Barbados
                      </option>
                      <option value="Belarus" data-provinces="[]">
                        Belarus
                      </option>
                      <option value="Belgium" data-provinces="[]">
                        Belgium
                      </option>
                      <option value="Belize" data-provinces="[]">Belize</option>
                      <option value="Benin" data-provinces="[]">Benin</option>
                      <option value="Bermuda" data-provinces="[]">
                        Bermuda
                      </option>
                      <option value="Bhutan" data-provinces="[]">Bhutan</option>
                      <option value="Bolivia" data-provinces="[]">
                        Bolivia
                      </option>
                      <option
                        value="Bosnia And Herzegovina"
                        data-provinces="[]"
                      >
                        Bosnia & Herzegovina
                      </option>
                      <option value="Botswana" data-provinces="[]">
                        Botswana
                      </option>
                      <option
                        value="Brazil"
                        data-provinces='[["Acre","Acre"],["Alagoas","Alagoas"],["Amapá","Amapá"],["Amazonas","Amazonas"],["Bahia","Bahia"],["Ceará","Ceará"],["Distrito Federal","Federal District"],["Espírito Santo","Espírito Santo"],["Goiás","Goiás"],["Maranhão","Maranhão"],["Mato Grosso","Mato Grosso"],["Mato Grosso do Sul","Mato Grosso do Sul"],["Minas Gerais","Minas Gerais"],["Paraná","Paraná"],["Paraíba","Paraíba"],["Pará","Pará"],["Pernambuco","Pernambuco"],["Piauí","Piauí"],["Rio Grande do Norte","Rio Grande do Norte"],["Rio Grande do Sul","Rio Grande do Sul"],["Rio de Janeiro","Rio de Janeiro"],["Rondônia","Rondônia"],["Roraima","Roraima"],["Santa Catarina","Santa Catarina"],["Sergipe","Sergipe"],["São Paulo","São Paulo"],["Tocantins","Tocantins"]]'
                      >
                        Brazil
                      </option>
                      <option
                        value="British Indian Ocean Territory"
                        data-provinces="[]"
                      >
                        British Indian Ocean Territory
                      </option>
                      <option
                        value="Virgin Islands, British"
                        data-provinces="[]"
                      >
                        British Virgin Islands
                      </option>
                      <option value="Brunei" data-provinces="[]">Brunei</option>
                      <option value="Bulgaria" data-provinces="[]">
                        Bulgaria
                      </option>
                      <option value="Burkina Faso" data-provinces="[]">
                        Burkina Faso
                      </option>
                      <option value="Burundi" data-provinces="[]">
                        Burundi
                      </option>
                      <option value="Cambodia" data-provinces="[]">
                        Cambodia
                      </option>
                      <option value="Republic of Cameroon" data-provinces="[]">
                        Cameroon
                      </option>
                      <option
                        value="Canada"
                        data-provinces='[["Alberta","Alberta"],["British Columbia","British Columbia"],["Manitoba","Manitoba"],["New Brunswick","New Brunswick"],["Newfoundland and Labrador","Newfoundland and Labrador"],["Northwest Territories","Northwest Territories"],["Nova Scotia","Nova Scotia"],["Nunavut","Nunavut"],["Ontario","Ontario"],["Prince Edward Island","Prince Edward Island"],["Quebec","Quebec"],["Saskatchewan","Saskatchewan"],["Yukon","Yukon"]]'
                      >
                        Canada
                      </option>
                      <option value="Cape Verde" data-provinces="[]">
                        Cape Verde
                      </option>
                      <option value="Caribbean Netherlands" data-provinces="[]">
                        Caribbean Netherlands
                      </option>
                      <option value="Cayman Islands" data-provinces="[]">
                        Cayman Islands
                      </option>
                      <option
                        value="Central African Republic"
                        data-provinces="[]"
                      >
                        Central African Republic
                      </option>
                      <option value="Chad" data-provinces="[]">Chad</option>
                      <option
                        value="Chile"
                        data-provinces='[["Antofagasta","Antofagasta"],["Araucanía","Araucanía"],["Arica and Parinacota","Arica y Parinacota"],["Atacama","Atacama"],["Aysén","Aysén"],["Biobío","Bío Bío"],["Coquimbo","Coquimbo"],["Los Lagos","Los Lagos"],["Los Ríos","Los Ríos"],["Magallanes","Magallanes Region"],["Maule","Maule"],["O&#39;Higgins","Libertador General Bernardo O’Higgins"],["Santiago","Santiago Metropolitan"],["Tarapacá","Tarapacá"],["Valparaíso","Valparaíso"],["Ñuble","Ñuble"]]'
                      >
                        Chile
                      </option>
                      <option
                        value="China"
                        data-provinces='[["Anhui","Anhui"],["Beijing","Beijing"],["Chongqing","Chongqing"],["Fujian","Fujian"],["Gansu","Gansu"],["Guangdong","Guangdong"],["Guangxi","Guangxi"],["Guizhou","Guizhou"],["Hainan","Hainan"],["Hebei","Hebei"],["Heilongjiang","Heilongjiang"],["Henan","Henan"],["Hubei","Hubei"],["Hunan","Hunan"],["Inner Mongolia","Inner Mongolia"],["Jiangsu","Jiangsu"],["Jiangxi","Jiangxi"],["Jilin","Jilin"],["Liaoning","Liaoning"],["Ningxia","Ningxia"],["Qinghai","Qinghai"],["Shaanxi","Shaanxi"],["Shandong","Shandong"],["Shanghai","Shanghai"],["Shanxi","Shanxi"],["Sichuan","Sichuan"],["Tianjin","Tianjin"],["Xinjiang","Xinjiang"],["Xizang","Tibet"],["Yunnan","Yunnan"],["Zhejiang","Zhejiang"]]'
                      >
                        China
                      </option>
                      <option value="Christmas Island" data-provinces="[]">
                        Christmas Island
                      </option>
                      <option
                        value="Cocos (Keeling) Islands"
                        data-provinces="[]"
                      >
                        Cocos (Keeling) Islands
                      </option>
                      <option
                        value="Colombia"
                        data-provinces='[["Amazonas","Amazonas"],["Antioquia","Antioquia"],["Arauca","Arauca"],["Atlántico","Atlántico"],["Bogotá, D.C.","Capital District"],["Bolívar","Bolívar"],["Boyacá","Boyacá"],["Caldas","Caldas"],["Caquetá","Caquetá"],["Casanare","Casanare"],["Cauca","Cauca"],["Cesar","Cesar"],["Chocó","Chocó"],["Cundinamarca","Cundinamarca"],["Córdoba","Córdoba"],["Guainía","Guainía"],["Guaviare","Guaviare"],["Huila","Huila"],["La Guajira","La Guajira"],["Magdalena","Magdalena"],["Meta","Meta"],["Nariño","Nariño"],["Norte de Santander","Norte de Santander"],["Putumayo","Putumayo"],["Quindío","Quindío"],["Risaralda","Risaralda"],["San Andrés, Providencia y Santa Catalina","San Andrés \u0026 Providencia"],["Santander","Santander"],["Sucre","Sucre"],["Tolima","Tolima"],["Valle del Cauca","Valle del Cauca"],["Vaupés","Vaupés"],["Vichada","Vichada"]]'
                      >
                        Colombia
                      </option>
                      <option value="Comoros" data-provinces="[]">
                        Comoros
                      </option>
                      <option value="Congo" data-provinces="[]">
                        Congo - Brazzaville
                      </option>
                      <option
                        value="Congo, The Democratic Republic Of The"
                        data-provinces="[]"
                      >
                        Congo - Kinshasa
                      </option>
                      <option value="Cook Islands" data-provinces="[]">
                        Cook Islands
                      </option>
                      <option
                        value="Costa Rica"
                        data-provinces='[["Alajuela","Alajuela"],["Cartago","Cartago"],["Guanacaste","Guanacaste"],["Heredia","Heredia"],["Limón","Limón"],["Puntarenas","Puntarenas"],["San José","San José"]]'
                      >
                        Costa Rica
                      </option>
                      <option value="Croatia" data-provinces="[]">
                        Croatia
                      </option>
                      <option value="Curaçao" data-provinces="[]">
                        Curaçao
                      </option>
                      <option value="Cyprus" data-provinces="[]">Cyprus</option>
                      <option value="Czech Republic" data-provinces="[]">
                        Czechia
                      </option>
                      <option value="Côte d'Ivoire" data-provinces="[]">
                        Côte d’Ivoire
                      </option>
                      <option value="Denmark" data-provinces="[]">
                        Denmark
                      </option>
                      <option value="Djibouti" data-provinces="[]">
                        Djibouti
                      </option>
                      <option value="Dominica" data-provinces="[]">
                        Dominica
                      </option>
                      <option value="Dominican Republic" data-provinces="[]">
                        Dominican Republic
                      </option>
                      <option value="Ecuador" data-provinces="[]">
                        Ecuador
                      </option>
                      <option
                        value="Egypt"
                        data-provinces='[["6th of October","6th of October"],["Al Sharqia","Al Sharqia"],["Alexandria","Alexandria"],["Aswan","Aswan"],["Asyut","Asyut"],["Beheira","Beheira"],["Beni Suef","Beni Suef"],["Cairo","Cairo"],["Dakahlia","Dakahlia"],["Damietta","Damietta"],["Faiyum","Faiyum"],["Gharbia","Gharbia"],["Giza","Giza"],["Helwan","Helwan"],["Ismailia","Ismailia"],["Kafr el-Sheikh","Kafr el-Sheikh"],["Luxor","Luxor"],["Matrouh","Matrouh"],["Minya","Minya"],["Monufia","Monufia"],["New Valley","New Valley"],["North Sinai","North Sinai"],["Port Said","Port Said"],["Qalyubia","Qalyubia"],["Qena","Qena"],["Red Sea","Red Sea"],["Sohag","Sohag"],["South Sinai","South Sinai"],["Suez","Suez"]]'
                      >
                        Egypt
                      </option>
                      <option
                        value="El Salvador"
                        data-provinces='[["Ahuachapán","Ahuachapán"],["Cabañas","Cabañas"],["Chalatenango","Chalatenango"],["Cuscatlán","Cuscatlán"],["La Libertad","La Libertad"],["La Paz","La Paz"],["La Unión","La Unión"],["Morazán","Morazán"],["San Miguel","San Miguel"],["San Salvador","San Salvador"],["San Vicente","San Vicente"],["Santa Ana","Santa Ana"],["Sonsonate","Sonsonate"],["Usulután","Usulután"]]'
                      >
                        El Salvador
                      </option>
                      <option value="Equatorial Guinea" data-provinces="[]">
                        Equatorial Guinea
                      </option>
                      <option value="Eritrea" data-provinces="[]">
                        Eritrea
                      </option>
                      <option value="Estonia" data-provinces="[]">
                        Estonia
                      </option>
                      <option value="Eswatini" data-provinces="[]">
                        Eswatini
                      </option>
                      <option value="Ethiopia" data-provinces="[]">
                        Ethiopia
                      </option>
                      <option
                        value="Falkland Islands (Malvinas)"
                        data-provinces="[]"
                      >
                        Falkland Islands
                      </option>
                      <option value="Faroe Islands" data-provinces="[]">
                        Faroe Islands
                      </option>
                      <option value="Fiji" data-provinces="[]">Fiji</option>
                      <option value="Finland" data-provinces="[]">
                        Finland
                      </option>
                      <option value="France" data-provinces="[]">France</option>
                      <option value="French Guiana" data-provinces="[]">
                        French Guiana
                      </option>
                      <option value="French Polynesia" data-provinces="[]">
                        French Polynesia
                      </option>
                      <option
                        value="French Southern Territories"
                        data-provinces="[]"
                      >
                        French Southern Territories
                      </option>
                      <option value="Gabon" data-provinces="[]">Gabon</option>
                      <option value="Gambia" data-provinces="[]">Gambia</option>
                      <option value="Georgia" data-provinces="[]">
                        Georgia
                      </option>
                      <option value="Germany" data-provinces="[]">
                        Germany
                      </option>
                      <option value="Ghana" data-provinces="[]">Ghana</option>
                      <option value="Gibraltar" data-provinces="[]">
                        Gibraltar
                      </option>
                      <option value="Greece" data-provinces="[]">Greece</option>
                      <option value="Greenland" data-provinces="[]">
                        Greenland
                      </option>
                      <option value="Grenada" data-provinces="[]">
                        Grenada
                      </option>
                      <option value="Guadeloupe" data-provinces="[]">
                        Guadeloupe
                      </option>
                      <option
                        value="Guatemala"
                        data-provinces='[["Alta Verapaz","Alta Verapaz"],["Baja Verapaz","Baja Verapaz"],["Chimaltenango","Chimaltenango"],["Chiquimula","Chiquimula"],["El Progreso","El Progreso"],["Escuintla","Escuintla"],["Guatemala","Guatemala"],["Huehuetenango","Huehuetenango"],["Izabal","Izabal"],["Jalapa","Jalapa"],["Jutiapa","Jutiapa"],["Petén","Petén"],["Quetzaltenango","Quetzaltenango"],["Quiché","Quiché"],["Retalhuleu","Retalhuleu"],["Sacatepéquez","Sacatepéquez"],["San Marcos","San Marcos"],["Santa Rosa","Santa Rosa"],["Sololá","Sololá"],["Suchitepéquez","Suchitepéquez"],["Totonicapán","Totonicapán"],["Zacapa","Zacapa"]]'
                      >
                        Guatemala
                      </option>
                      <option value="Guernsey" data-provinces="[]">
                        Guernsey
                      </option>
                      <option value="Guinea" data-provinces="[]">Guinea</option>
                      <option value="Guinea Bissau" data-provinces="[]">
                        Guinea-Bissau
                      </option>
                      <option value="Guyana" data-provinces="[]">Guyana</option>
                      <option value="Haiti" data-provinces="[]">Haiti</option>
                      <option value="Honduras" data-provinces="[]">
                        Honduras
                      </option>
                      <option
                        value="Hong Kong"
                        data-provinces='[["Hong Kong Island","Hong Kong Island"],["Kowloon","Kowloon"],["New Territories","New Territories"]]'
                      >
                        Hong Kong SAR
                      </option>
                      <option value="Hungary" data-provinces="[]">
                        Hungary
                      </option>
                      <option value="Iceland" data-provinces="[]">
                        Iceland
                      </option>
                      <option
                        value="India"
                        data-provinces='[["Andaman and Nicobar Islands","Andaman and Nicobar Islands"],["Andhra Pradesh","Andhra Pradesh"],["Arunachal Pradesh","Arunachal Pradesh"],["Assam","Assam"],["Bihar","Bihar"],["Chandigarh","Chandigarh"],["Chhattisgarh","Chhattisgarh"],["Dadra and Nagar Haveli","Dadra and Nagar Haveli"],["Daman and Diu","Daman and Diu"],["Delhi","Delhi"],["Goa","Goa"],["Gujarat","Gujarat"],["Haryana","Haryana"],["Himachal Pradesh","Himachal Pradesh"],["Jammu and Kashmir","Jammu and Kashmir"],["Jharkhand","Jharkhand"],["Karnataka","Karnataka"],["Kerala","Kerala"],["Ladakh","Ladakh"],["Lakshadweep","Lakshadweep"],["Madhya Pradesh","Madhya Pradesh"],["Maharashtra","Maharashtra"],["Manipur","Manipur"],["Meghalaya","Meghalaya"],["Mizoram","Mizoram"],["Nagaland","Nagaland"],["Odisha","Odisha"],["Puducherry","Puducherry"],["Punjab","Punjab"],["Rajasthan","Rajasthan"],["Sikkim","Sikkim"],["Tamil Nadu","Tamil Nadu"],["Telangana","Telangana"],["Tripura","Tripura"],["Uttar Pradesh","Uttar Pradesh"],["Uttarakhand","Uttarakhand"],["West Bengal","West Bengal"]]'
                      >
                        India
                      </option>
                      <option
                        value="Indonesia"
                        data-provinces='[["Aceh","Aceh"],["Bali","Bali"],["Bangka Belitung","Bangka–Belitung Islands"],["Banten","Banten"],["Bengkulu","Bengkulu"],["Gorontalo","Gorontalo"],["Jakarta","Jakarta"],["Jambi","Jambi"],["Jawa Barat","West Java"],["Jawa Tengah","Central Java"],["Jawa Timur","East Java"],["Kalimantan Barat","West Kalimantan"],["Kalimantan Selatan","South Kalimantan"],["Kalimantan Tengah","Central Kalimantan"],["Kalimantan Timur","East Kalimantan"],["Kalimantan Utara","North Kalimantan"],["Kepulauan Riau","Riau Islands"],["Lampung","Lampung"],["Maluku","Maluku"],["Maluku Utara","North Maluku"],["North Sumatra","North Sumatra"],["Nusa Tenggara Barat","West Nusa Tenggara"],["Nusa Tenggara Timur","East Nusa Tenggara"],["Papua","Papua"],["Papua Barat","West Papua"],["Riau","Riau"],["South Sumatra","South Sumatra"],["Sulawesi Barat","West Sulawesi"],["Sulawesi Selatan","South Sulawesi"],["Sulawesi Tengah","Central Sulawesi"],["Sulawesi Tenggara","Southeast Sulawesi"],["Sulawesi Utara","North Sulawesi"],["West Sumatra","West Sumatra"],["Yogyakarta","Yogyakarta"]]'
                      >
                        Indonesia
                      </option>
                      <option value="Iraq" data-provinces="[]">Iraq</option>
                      <option
                        value="Ireland"
                        data-provinces='[["Carlow","Carlow"],["Cavan","Cavan"],["Clare","Clare"],["Cork","Cork"],["Donegal","Donegal"],["Dublin","Dublin"],["Galway","Galway"],["Kerry","Kerry"],["Kildare","Kildare"],["Kilkenny","Kilkenny"],["Laois","Laois"],["Leitrim","Leitrim"],["Limerick","Limerick"],["Longford","Longford"],["Louth","Louth"],["Mayo","Mayo"],["Meath","Meath"],["Monaghan","Monaghan"],["Offaly","Offaly"],["Roscommon","Roscommon"],["Sligo","Sligo"],["Tipperary","Tipperary"],["Waterford","Waterford"],["Westmeath","Westmeath"],["Wexford","Wexford"],["Wicklow","Wicklow"]]'
                      >
                        Ireland
                      </option>
                      <option value="Isle Of Man" data-provinces="[]">
                        Isle of Man
                      </option>
                      <option value="Israel" data-provinces="[]">Israel</option>
                      <option
                        value="Italy"
                        data-provinces='[["Agrigento","Agrigento"],["Alessandria","Alessandria"],["Ancona","Ancona"],["Aosta","Aosta Valley"],["Arezzo","Arezzo"],["Ascoli Piceno","Ascoli Piceno"],["Asti","Asti"],["Avellino","Avellino"],["Bari","Bari"],["Barletta-Andria-Trani","Barletta-Andria-Trani"],["Belluno","Belluno"],["Benevento","Benevento"],["Bergamo","Bergamo"],["Biella","Biella"],["Bologna","Bologna"],["Bolzano","South Tyrol"],["Brescia","Brescia"],["Brindisi","Brindisi"],["Cagliari","Cagliari"],["Caltanissetta","Caltanissetta"],["Campobasso","Campobasso"],["Carbonia-Iglesias","Carbonia-Iglesias"],["Caserta","Caserta"],["Catania","Catania"],["Catanzaro","Catanzaro"],["Chieti","Chieti"],["Como","Como"],["Cosenza","Cosenza"],["Cremona","Cremona"],["Crotone","Crotone"],["Cuneo","Cuneo"],["Enna","Enna"],["Fermo","Fermo"],["Ferrara","Ferrara"],["Firenze","Florence"],["Foggia","Foggia"],["Forlì-Cesena","Forlì-Cesena"],["Frosinone","Frosinone"],["Genova","Genoa"],["Gorizia","Gorizia"],["Grosseto","Grosseto"],["Imperia","Imperia"],["Isernia","Isernia"],["L&#39;Aquila","L’Aquila"],["La Spezia","La Spezia"],["Latina","Latina"],["Lecce","Lecce"],["Lecco","Lecco"],["Livorno","Livorno"],["Lodi","Lodi"],["Lucca","Lucca"],["Macerata","Macerata"],["Mantova","Mantua"],["Massa-Carrara","Massa and Carrara"],["Matera","Matera"],["Medio Campidano","Medio Campidano"],["Messina","Messina"],["Milano","Milan"],["Modena","Modena"],["Monza e Brianza","Monza and Brianza"],["Napoli","Naples"],["Novara","Novara"],["Nuoro","Nuoro"],["Ogliastra","Ogliastra"],["Olbia-Tempio","Olbia-Tempio"],["Oristano","Oristano"],["Padova","Padua"],["Palermo","Palermo"],["Parma","Parma"],["Pavia","Pavia"],["Perugia","Perugia"],["Pesaro e Urbino","Pesaro and Urbino"],["Pescara","Pescara"],["Piacenza","Piacenza"],["Pisa","Pisa"],["Pistoia","Pistoia"],["Pordenone","Pordenone"],["Potenza","Potenza"],["Prato","Prato"],["Ragusa","Ragusa"],["Ravenna","Ravenna"],["Reggio Calabria","Reggio Calabria"],["Reggio Emilia","Reggio Emilia"],["Rieti","Rieti"],["Rimini","Rimini"],["Roma","Rome"],["Rovigo","Rovigo"],["Salerno","Salerno"],["Sassari","Sassari"],["Savona","Savona"],["Siena","Siena"],["Siracusa","Syracuse"],["Sondrio","Sondrio"],["Taranto","Taranto"],["Teramo","Teramo"],["Terni","Terni"],["Torino","Turin"],["Trapani","Trapani"],["Trento","Trentino"],["Treviso","Treviso"],["Trieste","Trieste"],["Udine","Udine"],["Varese","Varese"],["Venezia","Venice"],["Verbano-Cusio-Ossola","Verbano-Cusio-Ossola"],["Vercelli","Vercelli"],["Verona","Verona"],["Vibo Valentia","Vibo Valentia"],["Vicenza","Vicenza"],["Viterbo","Viterbo"]]'
                      >
                        Italy
                      </option>
                      <option value="Jamaica" data-provinces="[]">
                        Jamaica
                      </option>
                      <option
                        value="Japan"
                        data-provinces='[["Aichi","Aichi"],["Akita","Akita"],["Aomori","Aomori"],["Chiba","Chiba"],["Ehime","Ehime"],["Fukui","Fukui"],["Fukuoka","Fukuoka"],["Fukushima","Fukushima"],["Gifu","Gifu"],["Gunma","Gunma"],["Hiroshima","Hiroshima"],["Hokkaidō","Hokkaido"],["Hyōgo","Hyogo"],["Ibaraki","Ibaraki"],["Ishikawa","Ishikawa"],["Iwate","Iwate"],["Kagawa","Kagawa"],["Kagoshima","Kagoshima"],["Kanagawa","Kanagawa"],["Kumamoto","Kumamoto"],["Kyōto","Kyoto"],["Kōchi","Kochi"],["Mie","Mie"],["Miyagi","Miyagi"],["Miyazaki","Miyazaki"],["Nagano","Nagano"],["Nagasaki","Nagasaki"],["Nara","Nara"],["Niigata","Niigata"],["Okayama","Okayama"],["Okinawa","Okinawa"],["Saga","Saga"],["Saitama","Saitama"],["Shiga","Shiga"],["Shimane","Shimane"],["Shizuoka","Shizuoka"],["Tochigi","Tochigi"],["Tokushima","Tokushima"],["Tottori","Tottori"],["Toyama","Toyama"],["Tōkyō","Tokyo"],["Wakayama","Wakayama"],["Yamagata","Yamagata"],["Yamaguchi","Yamaguchi"],["Yamanashi","Yamanashi"],["Ōita","Oita"],["Ōsaka","Osaka"]]'
                      >
                        Japan
                      </option>
                      <option value="Jersey" data-provinces="[]">Jersey</option>
                      <option value="Jordan" data-provinces="[]">Jordan</option>
                      <option value="Kazakhstan" data-provinces="[]">
                        Kazakhstan
                      </option>
                      <option value="Kenya" data-provinces="[]">Kenya</option>
                      <option value="Kiribati" data-provinces="[]">
                        Kiribati
                      </option>
                      <option value="Kosovo" data-provinces="[]">Kosovo</option>
                      <option
                        value="Kuwait"
                        data-provinces='[["Al Ahmadi","Al Ahmadi"],["Al Asimah","Al Asimah"],["Al Farwaniyah","Al Farwaniyah"],["Al Jahra","Al Jahra"],["Hawalli","Hawalli"],["Mubarak Al-Kabeer","Mubarak Al-Kabeer"]]'
                      >
                        Kuwait
                      </option>
                      <option value="Kyrgyzstan" data-provinces="[]">
                        Kyrgyzstan
                      </option>
                      <option
                        value="Lao People's Democratic Republic"
                        data-provinces="[]"
                      >
                        Laos
                      </option>
                      <option value="Latvia" data-provinces="[]">Latvia</option>
                      <option value="Lebanon" data-provinces="[]">
                        Lebanon
                      </option>
                      <option value="Lesotho" data-provinces="[]">
                        Lesotho
                      </option>
                      <option value="Liberia" data-provinces="[]">
                        Liberia
                      </option>
                      <option
                        value="Libyan Arab Jamahiriya"
                        data-provinces="[]"
                      >
                        Libya
                      </option>
                      <option value="Liechtenstein" data-provinces="[]">
                        Liechtenstein
                      </option>
                      <option value="Lithuania" data-provinces="[]">
                        Lithuania
                      </option>
                      <option value="Luxembourg" data-provinces="[]">
                        Luxembourg
                      </option>
                      <option value="Macao" data-provinces="[]">
                        Macao SAR
                      </option>
                      <option value="Madagascar" data-provinces="[]">
                        Madagascar
                      </option>
                      <option value="Malawi" data-provinces="[]">Malawi</option>
                      <option
                        value="Malaysia"
                        data-provinces='[["Johor","Johor"],["Kedah","Kedah"],["Kelantan","Kelantan"],["Kuala Lumpur","Kuala Lumpur"],["Labuan","Labuan"],["Melaka","Malacca"],["Negeri Sembilan","Negeri Sembilan"],["Pahang","Pahang"],["Penang","Penang"],["Perak","Perak"],["Perlis","Perlis"],["Putrajaya","Putrajaya"],["Sabah","Sabah"],["Sarawak","Sarawak"],["Selangor","Selangor"],["Terengganu","Terengganu"]]'
                      >
                        Malaysia
                      </option>
                      <option value="Maldives" data-provinces="[]">
                        Maldives
                      </option>
                      <option value="Mali" data-provinces="[]">Mali</option>
                      <option value="Malta" data-provinces="[]">Malta</option>
                      <option value="Martinique" data-provinces="[]">
                        Martinique
                      </option>
                      <option value="Mauritania" data-provinces="[]">
                        Mauritania
                      </option>
                      <option value="Mauritius" data-provinces="[]">
                        Mauritius
                      </option>
                      <option value="Mayotte" data-provinces="[]">
                        Mayotte
                      </option>
                      <option
                        value="Mexico"
                        data-provinces='[["Aguascalientes","Aguascalientes"],["Baja California","Baja California"],["Baja California Sur","Baja California Sur"],["Campeche","Campeche"],["Chiapas","Chiapas"],["Chihuahua","Chihuahua"],["Ciudad de México","Ciudad de Mexico"],["Coahuila","Coahuila"],["Colima","Colima"],["Durango","Durango"],["Guanajuato","Guanajuato"],["Guerrero","Guerrero"],["Hidalgo","Hidalgo"],["Jalisco","Jalisco"],["Michoacán","Michoacán"],["Morelos","Morelos"],["México","Mexico State"],["Nayarit","Nayarit"],["Nuevo León","Nuevo León"],["Oaxaca","Oaxaca"],["Puebla","Puebla"],["Querétaro","Querétaro"],["Quintana Roo","Quintana Roo"],["San Luis Potosí","San Luis Potosí"],["Sinaloa","Sinaloa"],["Sonora","Sonora"],["Tabasco","Tabasco"],["Tamaulipas","Tamaulipas"],["Tlaxcala","Tlaxcala"],["Veracruz","Veracruz"],["Yucatán","Yucatán"],["Zacatecas","Zacatecas"]]'
                      >
                        Mexico
                      </option>
                      <option value="Moldova, Republic of" data-provinces="[]">
                        Moldova
                      </option>
                      <option value="Monaco" data-provinces="[]">Monaco</option>
                      <option value="Mongolia" data-provinces="[]">
                        Mongolia
                      </option>
                      <option value="Montenegro" data-provinces="[]">
                        Montenegro
                      </option>
                      <option value="Montserrat" data-provinces="[]">
                        Montserrat
                      </option>
                      <option value="Morocco" data-provinces="[]">
                        Morocco
                      </option>
                      <option value="Mozambique" data-provinces="[]">
                        Mozambique
                      </option>
                      <option value="Myanmar" data-provinces="[]">
                        Myanmar (Burma)
                      </option>
                      <option value="Namibia" data-provinces="[]">
                        Namibia
                      </option>
                      <option value="Nauru" data-provinces="[]">Nauru</option>
                      <option value="Nepal" data-provinces="[]">Nepal</option>
                      <option value="Netherlands" data-provinces="[]">
                        Netherlands
                      </option>
                      <option value="New Caledonia" data-provinces="[]">
                        New Caledonia
                      </option>
                      <option
                        value="New Zealand"
                        data-provinces='[["Auckland","Auckland"],["Bay of Plenty","Bay of Plenty"],["Canterbury","Canterbury"],["Chatham Islands","Chatham Islands"],["Gisborne","Gisborne"],["Hawke&#39;s Bay","Hawke’s Bay"],["Manawatu-Wanganui","Manawatū-Whanganui"],["Marlborough","Marlborough"],["Nelson","Nelson"],["Northland","Northland"],["Otago","Otago"],["Southland","Southland"],["Taranaki","Taranaki"],["Tasman","Tasman"],["Waikato","Waikato"],["Wellington","Wellington"],["West Coast","West Coast"]]'
                      >
                        New Zealand
                      </option>
                      <option value="Nicaragua" data-provinces="[]">
                        Nicaragua
                      </option>
                      <option value="Niger" data-provinces="[]">Niger</option>
                      <option
                        value="Nigeria"
                        data-provinces='[["Abia","Abia"],["Abuja Federal Capital Territory","Federal Capital Territory"],["Adamawa","Adamawa"],["Akwa Ibom","Akwa Ibom"],["Anambra","Anambra"],["Bauchi","Bauchi"],["Bayelsa","Bayelsa"],["Benue","Benue"],["Borno","Borno"],["Cross River","Cross River"],["Delta","Delta"],["Ebonyi","Ebonyi"],["Edo","Edo"],["Ekiti","Ekiti"],["Enugu","Enugu"],["Gombe","Gombe"],["Imo","Imo"],["Jigawa","Jigawa"],["Kaduna","Kaduna"],["Kano","Kano"],["Katsina","Katsina"],["Kebbi","Kebbi"],["Kogi","Kogi"],["Kwara","Kwara"],["Lagos","Lagos"],["Nasarawa","Nasarawa"],["Niger","Niger"],["Ogun","Ogun"],["Ondo","Ondo"],["Osun","Osun"],["Oyo","Oyo"],["Plateau","Plateau"],["Rivers","Rivers"],["Sokoto","Sokoto"],["Taraba","Taraba"],["Yobe","Yobe"],["Zamfara","Zamfara"]]'
                      >
                        Nigeria
                      </option>
                      <option value="Niue" data-provinces="[]">Niue</option>
                      <option value="Norfolk Island" data-provinces="[]">
                        Norfolk Island
                      </option>
                      <option value="North Macedonia" data-provinces="[]">
                        North Macedonia
                      </option>
                      <option value="Norway" data-provinces="[]">Norway</option>
                      <option value="Oman" data-provinces="[]">Oman</option>
                      <option value="Pakistan" data-provinces="[]">
                        Pakistan
                      </option>
                      <option
                        value="Palestinian Territory, Occupied"
                        data-provinces="[]"
                      >
                        Palestinian Territories
                      </option>
                      <option
                        value="Panama"
                        data-provinces='[["Bocas del Toro","Bocas del Toro"],["Chiriquí","Chiriquí"],["Coclé","Coclé"],["Colón","Colón"],["Darién","Darién"],["Emberá","Emberá"],["Herrera","Herrera"],["Kuna Yala","Guna Yala"],["Los Santos","Los Santos"],["Ngöbe-Buglé","Ngöbe-Buglé"],["Panamá","Panamá"],["Panamá Oeste","West Panamá"],["Veraguas","Veraguas"]]'
                      >
                        Panama
                      </option>
                      <option value="Papua New Guinea" data-provinces="[]">
                        Papua New Guinea
                      </option>
                      <option value="Paraguay" data-provinces="[]">
                        Paraguay
                      </option>
                      <option
                        value="Peru"
                        data-provinces='[["Amazonas","Amazonas"],["Apurímac","Apurímac"],["Arequipa","Arequipa"],["Ayacucho","Ayacucho"],["Cajamarca","Cajamarca"],["Callao","El Callao"],["Cuzco","Cusco"],["Huancavelica","Huancavelica"],["Huánuco","Huánuco"],["Ica","Ica"],["Junín","Junín"],["La Libertad","La Libertad"],["Lambayeque","Lambayeque"],["Lima (departamento)","Lima (Department)"],["Lima (provincia)","Lima (Metropolitan)"],["Loreto","Loreto"],["Madre de Dios","Madre de Dios"],["Moquegua","Moquegua"],["Pasco","Pasco"],["Piura","Piura"],["Puno","Puno"],["San Martín","San Martín"],["Tacna","Tacna"],["Tumbes","Tumbes"],["Ucayali","Ucayali"],["Áncash","Ancash"]]'
                      >
                        Peru
                      </option>
                      <option
                        value="Philippines"
                        data-provinces='[["Abra","Abra"],["Agusan del Norte","Agusan del Norte"],["Agusan del Sur","Agusan del Sur"],["Aklan","Aklan"],["Albay","Albay"],["Antique","Antique"],["Apayao","Apayao"],["Aurora","Aurora"],["Basilan","Basilan"],["Bataan","Bataan"],["Batanes","Batanes"],["Batangas","Batangas"],["Benguet","Benguet"],["Biliran","Biliran"],["Bohol","Bohol"],["Bukidnon","Bukidnon"],["Bulacan","Bulacan"],["Cagayan","Cagayan"],["Camarines Norte","Camarines Norte"],["Camarines Sur","Camarines Sur"],["Camiguin","Camiguin"],["Capiz","Capiz"],["Catanduanes","Catanduanes"],["Cavite","Cavite"],["Cebu","Cebu"],["Cotabato","Cotabato"],["Davao Occidental","Davao Occidental"],["Davao Oriental","Davao Oriental"],["Davao de Oro","Compostela Valley"],["Davao del Norte","Davao del Norte"],["Davao del Sur","Davao del Sur"],["Dinagat Islands","Dinagat Islands"],["Eastern Samar","Eastern Samar"],["Guimaras","Guimaras"],["Ifugao","Ifugao"],["Ilocos Norte","Ilocos Norte"],["Ilocos Sur","Ilocos Sur"],["Iloilo","Iloilo"],["Isabela","Isabela"],["Kalinga","Kalinga"],["La Union","La Union"],["Laguna","Laguna"],["Lanao del Norte","Lanao del Norte"],["Lanao del Sur","Lanao del Sur"],["Leyte","Leyte"],["Maguindanao","Maguindanao"],["Marinduque","Marinduque"],["Masbate","Masbate"],["Metro Manila","Metro Manila"],["Misamis Occidental","Misamis Occidental"],["Misamis Oriental","Misamis Oriental"],["Mountain Province","Mountain"],["Negros Occidental","Negros Occidental"],["Negros Oriental","Negros Oriental"],["Northern Samar","Northern Samar"],["Nueva Ecija","Nueva Ecija"],["Nueva Vizcaya","Nueva Vizcaya"],["Occidental Mindoro","Occidental Mindoro"],["Oriental Mindoro","Oriental Mindoro"],["Palawan","Palawan"],["Pampanga","Pampanga"],["Pangasinan","Pangasinan"],["Quezon","Quezon"],["Quirino","Quirino"],["Rizal","Rizal"],["Romblon","Romblon"],["Samar","Samar"],["Sarangani","Sarangani"],["Siquijor","Siquijor"],["Sorsogon","Sorsogon"],["South Cotabato","South Cotabato"],["Southern Leyte","Southern Leyte"],["Sultan Kudarat","Sultan Kudarat"],["Sulu","Sulu"],["Surigao del Norte","Surigao del Norte"],["Surigao del Sur","Surigao del Sur"],["Tarlac","Tarlac"],["Tawi-Tawi","Tawi-Tawi"],["Zambales","Zambales"],["Zamboanga Sibugay","Zamboanga Sibugay"],["Zamboanga del Norte","Zamboanga del Norte"],["Zamboanga del Sur","Zamboanga del Sur"]]'
                      >
                        Philippines
                      </option>
                      <option value="Pitcairn" data-provinces="[]">
                        Pitcairn Islands
                      </option>
                      <option value="Poland" data-provinces="[]">Poland</option>
                      <option
                        value="Portugal"
                        data-provinces='[["Aveiro","Aveiro"],["Açores","Azores"],["Beja","Beja"],["Braga","Braga"],["Bragança","Bragança"],["Castelo Branco","Castelo Branco"],["Coimbra","Coimbra"],["Faro","Faro"],["Guarda","Guarda"],["Leiria","Leiria"],["Lisboa","Lisbon"],["Madeira","Madeira"],["Portalegre","Portalegre"],["Porto","Porto"],["Santarém","Santarém"],["Setúbal","Setúbal"],["Viana do Castelo","Viana do Castelo"],["Vila Real","Vila Real"],["Viseu","Viseu"],["Évora","Évora"]]'
                      >
                        Portugal
                      </option>
                      <option value="Qatar" data-provinces="[]">Qatar</option>
                      <option value="Reunion" data-provinces="[]">
                        Réunion
                      </option>
                      <option
                        value="Romania"
                        data-provinces='[["Alba","Alba"],["Arad","Arad"],["Argeș","Argeș"],["Bacău","Bacău"],["Bihor","Bihor"],["Bistrița-Năsăud","Bistriţa-Năsăud"],["Botoșani","Botoşani"],["Brașov","Braşov"],["Brăila","Brăila"],["București","Bucharest"],["Buzău","Buzău"],["Caraș-Severin","Caraș-Severin"],["Cluj","Cluj"],["Constanța","Constanța"],["Covasna","Covasna"],["Călărași","Călărași"],["Dolj","Dolj"],["Dâmbovița","Dâmbovița"],["Galați","Galați"],["Giurgiu","Giurgiu"],["Gorj","Gorj"],["Harghita","Harghita"],["Hunedoara","Hunedoara"],["Ialomița","Ialomița"],["Iași","Iași"],["Ilfov","Ilfov"],["Maramureș","Maramureş"],["Mehedinți","Mehedinți"],["Mureș","Mureş"],["Neamț","Neamţ"],["Olt","Olt"],["Prahova","Prahova"],["Satu Mare","Satu Mare"],["Sibiu","Sibiu"],["Suceava","Suceava"],["Sălaj","Sălaj"],["Teleorman","Teleorman"],["Timiș","Timiș"],["Tulcea","Tulcea"],["Vaslui","Vaslui"],["Vrancea","Vrancea"],["Vâlcea","Vâlcea"]]'
                      >
                        Romania
                      </option>
                      <option
                        value="Russia"
                        data-provinces='[["Altai Krai","Altai Krai"],["Altai Republic","Altai"],["Amur Oblast","Amur"],["Arkhangelsk Oblast","Arkhangelsk"],["Astrakhan Oblast","Astrakhan"],["Belgorod Oblast","Belgorod"],["Bryansk Oblast","Bryansk"],["Chechen Republic","Chechen"],["Chelyabinsk Oblast","Chelyabinsk"],["Chukotka Autonomous Okrug","Chukotka Okrug"],["Chuvash Republic","Chuvash"],["Irkutsk Oblast","Irkutsk"],["Ivanovo Oblast","Ivanovo"],["Jewish Autonomous Oblast","Jewish"],["Kabardino-Balkarian Republic","Kabardino-Balkar"],["Kaliningrad Oblast","Kaliningrad"],["Kaluga Oblast","Kaluga"],["Kamchatka Krai","Kamchatka Krai"],["Karachay–Cherkess Republic","Karachay-Cherkess"],["Kemerovo Oblast","Kemerovo"],["Khabarovsk Krai","Khabarovsk Krai"],["Khanty-Mansi Autonomous Okrug","Khanty-Mansi"],["Kirov Oblast","Kirov"],["Komi Republic","Komi"],["Kostroma Oblast","Kostroma"],["Krasnodar Krai","Krasnodar Krai"],["Krasnoyarsk Krai","Krasnoyarsk Krai"],["Kurgan Oblast","Kurgan"],["Kursk Oblast","Kursk"],["Leningrad Oblast","Leningrad"],["Lipetsk Oblast","Lipetsk"],["Magadan Oblast","Magadan"],["Mari El Republic","Mari El"],["Moscow","Moscow"],["Moscow Oblast","Moscow Province"],["Murmansk Oblast","Murmansk"],["Nizhny Novgorod Oblast","Nizhny Novgorod"],["Novgorod Oblast","Novgorod"],["Novosibirsk Oblast","Novosibirsk"],["Omsk Oblast","Omsk"],["Orenburg Oblast","Orenburg"],["Oryol Oblast","Oryol"],["Penza Oblast","Penza"],["Perm Krai","Perm Krai"],["Primorsky Krai","Primorsky Krai"],["Pskov Oblast","Pskov"],["Republic of Adygeya","Adygea"],["Republic of Bashkortostan","Bashkortostan"],["Republic of Buryatia","Buryat"],["Republic of Dagestan","Dagestan"],["Republic of Ingushetia","Ingushetia"],["Republic of Kalmykia","Kalmykia"],["Republic of Karelia","Karelia"],["Republic of Khakassia","Khakassia"],["Republic of Mordovia","Mordovia"],["Republic of North Ossetia–Alania","North Ossetia-Alania"],["Republic of Tatarstan","Tatarstan"],["Rostov Oblast","Rostov"],["Ryazan Oblast","Ryazan"],["Saint Petersburg","Saint Petersburg"],["Sakha Republic (Yakutia)","Sakha"],["Sakhalin Oblast","Sakhalin"],["Samara Oblast","Samara"],["Saratov Oblast","Saratov"],["Smolensk Oblast","Smolensk"],["Stavropol Krai","Stavropol Krai"],["Sverdlovsk Oblast","Sverdlovsk"],["Tambov Oblast","Tambov"],["Tomsk Oblast","Tomsk"],["Tula Oblast","Tula"],["Tver Oblast","Tver"],["Tyumen Oblast","Tyumen"],["Tyva Republic","Tuva"],["Udmurtia","Udmurt"],["Ulyanovsk Oblast","Ulyanovsk"],["Vladimir Oblast","Vladimir"],["Volgograd Oblast","Volgograd"],["Vologda Oblast","Vologda"],["Voronezh Oblast","Voronezh"],["Yamalo-Nenets Autonomous Okrug","Yamalo-Nenets Okrug"],["Yaroslavl Oblast","Yaroslavl"],["Zabaykalsky Krai","Zabaykalsky Krai"]]'
                      >
                        Russia
                      </option>
                      <option value="Rwanda" data-provinces="[]">Rwanda</option>
                      <option value="Samoa" data-provinces="[]">Samoa</option>
                      <option value="San Marino" data-provinces="[]">
                        San Marino
                      </option>
                      <option value="Sao Tome And Principe" data-provinces="[]">
                        São Tomé & Príncipe
                      </option>
                      <option value="Saudi Arabia" data-provinces="[]">
                        Saudi Arabia
                      </option>
                      <option value="Senegal" data-provinces="[]">
                        Senegal
                      </option>
                      <option value="Serbia" data-provinces="[]">Serbia</option>
                      <option value="Seychelles" data-provinces="[]">
                        Seychelles
                      </option>
                      <option value="Sierra Leone" data-provinces="[]">
                        Sierra Leone
                      </option>
                      <option value="Singapore" data-provinces="[]">
                        Singapore
                      </option>
                      <option value="Sint Maarten" data-provinces="[]">
                        Sint Maarten
                      </option>
                      <option value="Slovakia" data-provinces="[]">
                        Slovakia
                      </option>
                      <option value="Slovenia" data-provinces="[]">
                        Slovenia
                      </option>
                      <option value="Solomon Islands" data-provinces="[]">
                        Solomon Islands
                      </option>
                      <option value="Somalia" data-provinces="[]">
                        Somalia
                      </option>
                      <option
                        value="South Africa"
                        data-provinces='[["Eastern Cape","Eastern Cape"],["Free State","Free State"],["Gauteng","Gauteng"],["KwaZulu-Natal","KwaZulu-Natal"],["Limpopo","Limpopo"],["Mpumalanga","Mpumalanga"],["North West","North West"],["Northern Cape","Northern Cape"],["Western Cape","Western Cape"]]'
                      >
                        South Africa
                      </option>
                      <option
                        value="South Georgia And The South Sandwich Islands"
                        data-provinces="[]"
                      >
                        South Georgia & South Sandwich Islands
                      </option>
                      <option
                        value="South Korea"
                        data-provinces='[["Busan","Busan"],["Chungbuk","North Chungcheong"],["Chungnam","South Chungcheong"],["Daegu","Daegu"],["Daejeon","Daejeon"],["Gangwon","Gangwon"],["Gwangju","Gwangju City"],["Gyeongbuk","North Gyeongsang"],["Gyeonggi","Gyeonggi"],["Gyeongnam","South Gyeongsang"],["Incheon","Incheon"],["Jeju","Jeju"],["Jeonbuk","North Jeolla"],["Jeonnam","South Jeolla"],["Sejong","Sejong"],["Seoul","Seoul"],["Ulsan","Ulsan"]]'
                      >
                        South Korea
                      </option>
                      <option value="South Sudan" data-provinces="[]">
                        South Sudan
                      </option>
                      <option
                        value="Spain"
                        data-provinces='[["A Coruña","A Coruña"],["Albacete","Albacete"],["Alicante","Alicante"],["Almería","Almería"],["Asturias","Asturias Province"],["Badajoz","Badajoz"],["Balears","Balears Province"],["Barcelona","Barcelona"],["Burgos","Burgos"],["Cantabria","Cantabria Province"],["Castellón","Castellón"],["Ceuta","Ceuta"],["Ciudad Real","Ciudad Real"],["Cuenca","Cuenca"],["Cáceres","Cáceres"],["Cádiz","Cádiz"],["Córdoba","Córdoba"],["Girona","Girona"],["Granada","Granada"],["Guadalajara","Guadalajara"],["Guipúzcoa","Gipuzkoa"],["Huelva","Huelva"],["Huesca","Huesca"],["Jaén","Jaén"],["La Rioja","La Rioja Province"],["Las Palmas","Las Palmas"],["León","León"],["Lleida","Lleida"],["Lugo","Lugo"],["Madrid","Madrid Province"],["Melilla","Melilla"],["Murcia","Murcia"],["Málaga","Málaga"],["Navarra","Navarra"],["Ourense","Ourense"],["Palencia","Palencia"],["Pontevedra","Pontevedra"],["Salamanca","Salamanca"],["Santa Cruz de Tenerife","Santa Cruz de Tenerife"],["Segovia","Segovia"],["Sevilla","Seville"],["Soria","Soria"],["Tarragona","Tarragona"],["Teruel","Teruel"],["Toledo","Toledo"],["Valencia","Valencia"],["Valladolid","Valladolid"],["Vizcaya","Biscay"],["Zamora","Zamora"],["Zaragoza","Zaragoza"],["Álava","Álava"],["Ávila","Ávila"]]'
                      >
                        Spain
                      </option>
                      <option value="Sri Lanka" data-provinces="[]">
                        Sri Lanka
                      </option>
                      <option value="Saint Barthélemy" data-provinces="[]">
                        St. Barthélemy
                      </option>
                      <option value="Saint Helena" data-provinces="[]">
                        St. Helena
                      </option>
                      <option value="Saint Kitts And Nevis" data-provinces="[]">
                        St. Kitts & Nevis
                      </option>
                      <option value="Saint Lucia" data-provinces="[]">
                        St. Lucia
                      </option>
                      <option value="Saint Martin" data-provinces="[]">
                        St. Martin
                      </option>
                      <option
                        value="Saint Pierre And Miquelon"
                        data-provinces="[]"
                      >
                        St. Pierre & Miquelon
                      </option>
                      <option value="St. Vincent" data-provinces="[]">
                        St. Vincent & Grenadines
                      </option>
                      <option value="Sudan" data-provinces="[]">Sudan</option>
                      <option value="Suriname" data-provinces="[]">
                        Suriname
                      </option>
                      <option
                        value="Svalbard And Jan Mayen"
                        data-provinces="[]"
                      >
                        Svalbard & Jan Mayen
                      </option>
                      <option value="Sweden" data-provinces="[]">Sweden</option>
                      <option value="Switzerland" data-provinces="[]">
                        Switzerland
                      </option>
                      <option value="Taiwan" data-provinces="[]">Taiwan</option>
                      <option value="Tajikistan" data-provinces="[]">
                        Tajikistan
                      </option>
                      <option
                        value="Tanzania, United Republic Of"
                        data-provinces="[]"
                      >
                        Tanzania
                      </option>
                      <option
                        value="Thailand"
                        data-provinces='[["Amnat Charoen","Amnat Charoen"],["Ang Thong","Ang Thong"],["Bangkok","Bangkok"],["Bueng Kan","Bueng Kan"],["Buriram","Buri Ram"],["Chachoengsao","Chachoengsao"],["Chai Nat","Chai Nat"],["Chaiyaphum","Chaiyaphum"],["Chanthaburi","Chanthaburi"],["Chiang Mai","Chiang Mai"],["Chiang Rai","Chiang Rai"],["Chon Buri","Chon Buri"],["Chumphon","Chumphon"],["Kalasin","Kalasin"],["Kamphaeng Phet","Kamphaeng Phet"],["Kanchanaburi","Kanchanaburi"],["Khon Kaen","Khon Kaen"],["Krabi","Krabi"],["Lampang","Lampang"],["Lamphun","Lamphun"],["Loei","Loei"],["Lopburi","Lopburi"],["Mae Hong Son","Mae Hong Son"],["Maha Sarakham","Maha Sarakham"],["Mukdahan","Mukdahan"],["Nakhon Nayok","Nakhon Nayok"],["Nakhon Pathom","Nakhon Pathom"],["Nakhon Phanom","Nakhon Phanom"],["Nakhon Ratchasima","Nakhon Ratchasima"],["Nakhon Sawan","Nakhon Sawan"],["Nakhon Si Thammarat","Nakhon Si Thammarat"],["Nan","Nan"],["Narathiwat","Narathiwat"],["Nong Bua Lam Phu","Nong Bua Lam Phu"],["Nong Khai","Nong Khai"],["Nonthaburi","Nonthaburi"],["Pathum Thani","Pathum Thani"],["Pattani","Pattani"],["Pattaya","Pattaya"],["Phangnga","Phang Nga"],["Phatthalung","Phatthalung"],["Phayao","Phayao"],["Phetchabun","Phetchabun"],["Phetchaburi","Phetchaburi"],["Phichit","Phichit"],["Phitsanulok","Phitsanulok"],["Phra Nakhon Si Ayutthaya","Phra Nakhon Si Ayutthaya"],["Phrae","Phrae"],["Phuket","Phuket"],["Prachin Buri","Prachin Buri"],["Prachuap Khiri Khan","Prachuap Khiri Khan"],["Ranong","Ranong"],["Ratchaburi","Ratchaburi"],["Rayong","Rayong"],["Roi Et","Roi Et"],["Sa Kaeo","Sa Kaeo"],["Sakon Nakhon","Sakon Nakhon"],["Samut Prakan","Samut Prakan"],["Samut Sakhon","Samut Sakhon"],["Samut Songkhram","Samut Songkhram"],["Saraburi","Saraburi"],["Satun","Satun"],["Sing Buri","Sing Buri"],["Sisaket","Si Sa Ket"],["Songkhla","Songkhla"],["Sukhothai","Sukhothai"],["Suphan Buri","Suphanburi"],["Surat Thani","Surat Thani"],["Surin","Surin"],["Tak","Tak"],["Trang","Trang"],["Trat","Trat"],["Ubon Ratchathani","Ubon Ratchathani"],["Udon Thani","Udon Thani"],["Uthai Thani","Uthai Thani"],["Uttaradit","Uttaradit"],["Yala","Yala"],["Yasothon","Yasothon"]]'
                      >
                        Thailand
                      </option>
                      <option value="Timor Leste" data-provinces="[]">
                        Timor-Leste
                      </option>
                      <option value="Togo" data-provinces="[]">Togo</option>
                      <option value="Tokelau" data-provinces="[]">
                        Tokelau
                      </option>
                      <option value="Tonga" data-provinces="[]">Tonga</option>
                      <option value="Trinidad and Tobago" data-provinces="[]">
                        Trinidad & Tobago
                      </option>
                      <option value="Tristan da Cunha" data-provinces="[]">
                        Tristan da Cunha
                      </option>
                      <option value="Tunisia" data-provinces="[]">
                        Tunisia
                      </option>
                      <option value="Turkey" data-provinces="[]">Turkey</option>
                      <option value="Turkmenistan" data-provinces="[]">
                        Turkmenistan
                      </option>
                      <option
                        value="Turks and Caicos Islands"
                        data-provinces="[]"
                      >
                        Turks & Caicos Islands
                      </option>
                      <option value="Tuvalu" data-provinces="[]">Tuvalu</option>
                      <option
                        value="United States Minor Outlying Islands"
                        data-provinces="[]"
                      >
                        U.S. Outlying Islands
                      </option>
                      <option value="Uganda" data-provinces="[]">Uganda</option>
                      <option value="Ukraine" data-provinces="[]">
                        Ukraine
                      </option>
                      <option
                        value="United Arab Emirates"
                        data-provinces='[["Abu Dhabi","Abu Dhabi"],["Ajman","Ajman"],["Dubai","Dubai"],["Fujairah","Fujairah"],["Ras al-Khaimah","Ras al-Khaimah"],["Sharjah","Sharjah"],["Umm al-Quwain","Umm al-Quwain"]]'
                      >
                        United Arab Emirates
                      </option>
                      <option
                        value="United Kingdom"
                        data-provinces='[["British Forces","British Forces"],["England","England"],["Northern Ireland","Northern Ireland"],["Scotland","Scotland"],["Wales","Wales"]]'
                      >
                        United Kingdom
                      </option>
                      <option
                        value="United States"
                        data-provinces='[["Alabama","Alabama"],["Alaska","Alaska"],["American Samoa","American Samoa"],["Arizona","Arizona"],["Arkansas","Arkansas"],["Armed Forces Americas","Armed Forces Americas"],["Armed Forces Europe","Armed Forces Europe"],["Armed Forces Pacific","Armed Forces Pacific"],["California","California"],["Colorado","Colorado"],["Connecticut","Connecticut"],["Delaware","Delaware"],["District of Columbia","Washington DC"],["Federated States of Micronesia","Micronesia"],["Florida","Florida"],["Georgia","Georgia"],["Guam","Guam"],["Hawaii","Hawaii"],["Idaho","Idaho"],["Illinois","Illinois"],["Indiana","Indiana"],["Iowa","Iowa"],["Kansas","Kansas"],["Kentucky","Kentucky"],["Louisiana","Louisiana"],["Maine","Maine"],["Marshall Islands","Marshall Islands"],["Maryland","Maryland"],["Massachusetts","Massachusetts"],["Michigan","Michigan"],["Minnesota","Minnesota"],["Mississippi","Mississippi"],["Missouri","Missouri"],["Montana","Montana"],["Nebraska","Nebraska"],["Nevada","Nevada"],["New Hampshire","New Hampshire"],["New Jersey","New Jersey"],["New Mexico","New Mexico"],["New York","New York"],["North Carolina","North Carolina"],["North Dakota","North Dakota"],["Northern Mariana Islands","Northern Mariana Islands"],["Ohio","Ohio"],["Oklahoma","Oklahoma"],["Oregon","Oregon"],["Palau","Palau"],["Pennsylvania","Pennsylvania"],["Puerto Rico","Puerto Rico"],["Rhode Island","Rhode Island"],["South Carolina","South Carolina"],["South Dakota","South Dakota"],["Tennessee","Tennessee"],["Texas","Texas"],["Utah","Utah"],["Vermont","Vermont"],["Virgin Islands","U.S. Virgin Islands"],["Virginia","Virginia"],["Washington","Washington"],["West Virginia","West Virginia"],["Wisconsin","Wisconsin"],["Wyoming","Wyoming"]]'
                      >
                        United States
                      </option>
                      <option
                        value="Uruguay"
                        data-provinces='[["Artigas","Artigas"],["Canelones","Canelones"],["Cerro Largo","Cerro Largo"],["Colonia","Colonia"],["Durazno","Durazno"],["Flores","Flores"],["Florida","Florida"],["Lavalleja","Lavalleja"],["Maldonado","Maldonado"],["Montevideo","Montevideo"],["Paysandú","Paysandú"],["Rivera","Rivera"],["Rocha","Rocha"],["Río Negro","Río Negro"],["Salto","Salto"],["San José","San José"],["Soriano","Soriano"],["Tacuarembó","Tacuarembó"],["Treinta y Tres","Treinta y Tres"]]'
                      >
                        Uruguay
                      </option>
                      <option value="Uzbekistan" data-provinces="[]">
                        Uzbekistan
                      </option>
                      <option value="Vanuatu" data-provinces="[]">
                        Vanuatu
                      </option>
                      <option
                        value="Holy See (Vatican City State)"
                        data-provinces="[]"
                      >
                        Vatican City
                      </option>
                      <option
                        value="Venezuela"
                        data-provinces='[["Amazonas","Amazonas"],["Anzoátegui","Anzoátegui"],["Apure","Apure"],["Aragua","Aragua"],["Barinas","Barinas"],["Bolívar","Bolívar"],["Carabobo","Carabobo"],["Cojedes","Cojedes"],["Delta Amacuro","Delta Amacuro"],["Dependencias Federales","Federal Dependencies"],["Distrito Capital","Capital"],["Falcón","Falcón"],["Guárico","Guárico"],["La Guaira","Vargas"],["Lara","Lara"],["Miranda","Miranda"],["Monagas","Monagas"],["Mérida","Mérida"],["Nueva Esparta","Nueva Esparta"],["Portuguesa","Portuguesa"],["Sucre","Sucre"],["Trujillo","Trujillo"],["Táchira","Táchira"],["Yaracuy","Yaracuy"],["Zulia","Zulia"]]'
                      >
                        Venezuela
                      </option>
                      <option value="Vietnam" data-provinces="[]">
                        Vietnam
                      </option>
                      <option value="Wallis And Futuna" data-provinces="[]">
                        Wallis & Futuna
                      </option>
                      <option value="Western Sahara" data-provinces="[]">
                        Western Sahara
                      </option>
                      <option value="Yemen" data-provinces="[]">Yemen</option>
                      <option value="Zambia" data-provinces="[]">Zambia</option>
                      <option value="Zimbabwe" data-provinces="[]">
                        Zimbabwe
                      </option></select
                    ><svg
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
                      ></path>
                    </svg>
                  </div>

                  <label for="address-new[country]" class="input__label"
                    >Country</label
                  >
                </div>

                <div id="address-new-province-container" class="input" hidden>
                  <div class="select-wrapper is-filled">
                    <select
                      class="select"
                      name="address[province]"
                      id="address-new[province]"
                    ></select
                    ><svg
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
                      ></path>
                    </svg>
                  </div>

                  <label for="address-new[province]" class="input__label"
                    >Province</label
                  >
                </div>
                <div class="input input--checkbox">
                  <div class="checkbox-container">
                    <input
                      type="checkbox"
                      class="checkbox"
                      name="address[default]"
                      id="address-new[default]"
                      value="0"
                    />
                    <label for="address-new[default]" class="text--subdued"
                      >Set as default</label
                    >
                  </div>
                </div>

                <button
                  type="submit"
                  is="loader-button"
                  class="form__submit button button--primary button--full"
                >
                  Add a new address
                </button>
              </form>
            </div> </drawer-content
          ><drawer-content
            id="drawer-address-8302380974301"
            class="drawer drawer--large"
          >
            <span class="drawer__overlay"></span>

            <header class="drawer__header">
              <h3 class="drawer__title heading h6">Edit</h3>

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

            <div class="drawer__content drawer__content--padded-start">
              <form
                method="post"
                action="address-updation.php"
                id="address_form_8302380974301"
                accept-charset="UTF-8"
                class="form"
              >
                <input
                  type="hidden"
                  name="form_type"
                  value="customer_address"
                /><input type="hidden" name="utf8" value="✓" />
                <p class="form__info">Please fill in the fields below:</p>
                <div class="input-row">
                  <div class="input">
                    <input
                      id="address-8302380974301[first_name]"
                      type="text"
                      class="input__field input__field--text is-filled"
                      name="update_first_name"
                      value="<?php echo $row['name']; ?>"
                    />
                    <label
                      for="address-8302380974301[first_name]"
                      class="input__label"
                      >First name</label
                    >
                  </div>

                  <div class="input">
                    <input
                      id="address-8302380974301[last_name]"
                      type="text"
                      class="input__field input__field--text is-filled"
                      name="update_last_name"
                      value="<?php echo $row['last_name']; ?>"
                    />
                    <label
                      for="address-8302380974301[last_name]"
                      class="input__label"
                      >Last name</label
                    >
                  </div>
                </div>

                <div class="input">
                  <input
                    id="address-8302380974301[company]"
                    type="text"
                    class="input__field input__field--text"
                    name="address[company]"
                    value=""
                  />
                  <label
                    for="address-8302380974301[company]"
                    class="input__label"
                    >Company</label
                  >
                </div>

                <div class="input">
                  <input
                    id="address-8302380974301[phone]"
                    type="text"
                    class="input__field input__field--text is-filled"
                    name="update_phone"
                    value="<?php echo $row['telephone']; ?>"
                  />
                  <label for="address-8302380974301[phone]" class="input__label"
                    >Phone number</label
                  >
                </div>

                <div class="input">
                  <input
                    id="address-8302380974301[address1]"
                    type="text"
                    class="input__field input__field--text is-filled"
                    name="update_address"
                    value="<?php echo $row['address']; ?>"
                  />
                  <label
                    for="address-8302380974301[address1]"
                    class="input__label"
                    >Address</label
                  >
                </div>

                <div class="input-row">
                  <div class="input">
                    <input
                      id="address-8302380974301[city]"
                      type="text"
                      class="input__field input__field--text is-filled"
                      name="update_city"
                      value="<?php echo $row['city']; ?>"
                    />
                    <label
                      for="address-8302380974301[city]"
                      class="input__label"
                      >City</label
                    >
                  </div>

                  <div class="input">
                    <input
                      id="address-8302380974301[zip]"
                      type="text"
                      class="input__field input__field--text is-filled"
                      name="update_zip"
                      value="<?php echo $row['postal_code']; ?>"
                    />
                    <label for="address-8302380974301[zip]" class="input__label"
                      >Zip code</label
                    >
                  </div>
                </div>

                <div class="input">
                  <div class="select-wrapper is-filled">
                    <select
                      is="country-selector"
                      class="select"
                      name="address[country]"
                      id="address-8302380974301[country]"
                      data-default="India"
                      aria-owns="address-8302380974301-province-container"
                    >
                      <option
                        value="India"
                        data-provinces='[["Andaman and Nicobar Islands","Andaman and Nicobar Islands"],["Andhra Pradesh","Andhra Pradesh"],["Arunachal Pradesh","Arunachal Pradesh"],["Assam","Assam"],["Bihar","Bihar"],["Chandigarh","Chandigarh"],["Chhattisgarh","Chhattisgarh"],["Dadra and Nagar Haveli","Dadra and Nagar Haveli"],["Daman and Diu","Daman and Diu"],["Delhi","Delhi"],["Goa","Goa"],["Gujarat","Gujarat"],["Haryana","Haryana"],["Himachal Pradesh","Himachal Pradesh"],["Jammu and Kashmir","Jammu and Kashmir"],["Jharkhand","Jharkhand"],["Karnataka","Karnataka"],["Kerala","Kerala"],["Ladakh","Ladakh"],["Lakshadweep","Lakshadweep"],["Madhya Pradesh","Madhya Pradesh"],["Maharashtra","Maharashtra"],["Manipur","Manipur"],["Meghalaya","Meghalaya"],["Mizoram","Mizoram"],["Nagaland","Nagaland"],["Odisha","Odisha"],["Puducherry","Puducherry"],["Punjab","Punjab"],["Rajasthan","Rajasthan"],["Sikkim","Sikkim"],["Tamil Nadu","Tamil Nadu"],["Telangana","Telangana"],["Tripura","Tripura"],["Uttar Pradesh","Uttar Pradesh"],["Uttarakhand","Uttarakhand"],["West Bengal","West Bengal"]]'
                      >
                        India
                      </option>
                      <option
                        value="Australia"
                        data-provinces='[["Australian Capital Territory","Australian Capital Territory"],["New South Wales","New South Wales"],["Northern Territory","Northern Territory"],["Queensland","Queensland"],["South Australia","South Australia"],["Tasmania","Tasmania"],["Victoria","Victoria"],["Western Australia","Western Australia"]]'
                      >
                        Australia
                      </option>
                      <option
                        value="United States"
                        data-provinces='[["Alabama","Alabama"],["Alaska","Alaska"],["American Samoa","American Samoa"],["Arizona","Arizona"],["Arkansas","Arkansas"],["Armed Forces Americas","Armed Forces Americas"],["Armed Forces Europe","Armed Forces Europe"],["Armed Forces Pacific","Armed Forces Pacific"],["California","California"],["Colorado","Colorado"],["Connecticut","Connecticut"],["Delaware","Delaware"],["District of Columbia","Washington DC"],["Federated States of Micronesia","Micronesia"],["Florida","Florida"],["Georgia","Georgia"],["Guam","Guam"],["Hawaii","Hawaii"],["Idaho","Idaho"],["Illinois","Illinois"],["Indiana","Indiana"],["Iowa","Iowa"],["Kansas","Kansas"],["Kentucky","Kentucky"],["Louisiana","Louisiana"],["Maine","Maine"],["Marshall Islands","Marshall Islands"],["Maryland","Maryland"],["Massachusetts","Massachusetts"],["Michigan","Michigan"],["Minnesota","Minnesota"],["Mississippi","Mississippi"],["Missouri","Missouri"],["Montana","Montana"],["Nebraska","Nebraska"],["Nevada","Nevada"],["New Hampshire","New Hampshire"],["New Jersey","New Jersey"],["New Mexico","New Mexico"],["New York","New York"],["North Carolina","North Carolina"],["North Dakota","North Dakota"],["Northern Mariana Islands","Northern Mariana Islands"],["Ohio","Ohio"],["Oklahoma","Oklahoma"],["Oregon","Oregon"],["Palau","Palau"],["Pennsylvania","Pennsylvania"],["Puerto Rico","Puerto Rico"],["Rhode Island","Rhode Island"],["South Carolina","South Carolina"],["South Dakota","South Dakota"],["Tennessee","Tennessee"],["Texas","Texas"],["Utah","Utah"],["Vermont","Vermont"],["Virgin Islands","U.S. Virgin Islands"],["Virginia","Virginia"],["Washington","Washington"],["West Virginia","West Virginia"],["Wisconsin","Wisconsin"],["Wyoming","Wyoming"]]'
                      >
                        United States
                      </option>
                      <option
                        value="United Kingdom"
                        data-provinces='[["British Forces","British Forces"],["England","England"],["Northern Ireland","Northern Ireland"],["Scotland","Scotland"],["Wales","Wales"]]'
                      >
                        United Kingdom
                      </option>
                      <option value="---" data-provinces="[]">---</option>
                      <option value="Afghanistan" data-provinces="[]">
                        Afghanistan
                      </option>
                      <option value="Aland Islands" data-provinces="[]">
                        Åland Islands
                      </option>
                      <option value="Albania" data-provinces="[]">
                        Albania
                      </option>
                      <option value="Algeria" data-provinces="[]">
                        Algeria
                      </option>
                      <option value="Andorra" data-provinces="[]">
                        Andorra
                      </option>
                      <option value="Angola" data-provinces="[]">Angola</option>
                      <option value="Anguilla" data-provinces="[]">
                        Anguilla
                      </option>
                      <option value="Antigua And Barbuda" data-provinces="[]">
                        Antigua & Barbuda
                      </option>
                      <option
                        value="Argentina"
                        data-provinces='[["Buenos Aires","Buenos Aires Province"],["Catamarca","Catamarca"],["Chaco","Chaco"],["Chubut","Chubut"],["Ciudad Autónoma de Buenos Aires","Buenos Aires (Autonomous City)"],["Corrientes","Corrientes"],["Córdoba","Córdoba"],["Entre Ríos","Entre Ríos"],["Formosa","Formosa"],["Jujuy","Jujuy"],["La Pampa","La Pampa"],["La Rioja","La Rioja"],["Mendoza","Mendoza"],["Misiones","Misiones"],["Neuquén","Neuquén"],["Río Negro","Río Negro"],["Salta","Salta"],["San Juan","San Juan"],["San Luis","San Luis"],["Santa Cruz","Santa Cruz"],["Santa Fe","Santa Fe"],["Santiago Del Estero","Santiago del Estero"],["Tierra Del Fuego","Tierra del Fuego"],["Tucumán","Tucumán"]]'
                      >
                        Argentina
                      </option>
                      <option value="Armenia" data-provinces="[]">
                        Armenia
                      </option>
                      <option value="Aruba" data-provinces="[]">Aruba</option>
                      <option value="Ascension Island" data-provinces="[]">
                        Ascension Island
                      </option>
                      <option
                        value="Australia"
                        data-provinces='[["Australian Capital Territory","Australian Capital Territory"],["New South Wales","New South Wales"],["Northern Territory","Northern Territory"],["Queensland","Queensland"],["South Australia","South Australia"],["Tasmania","Tasmania"],["Victoria","Victoria"],["Western Australia","Western Australia"]]'
                      >
                        Australia
                      </option>
                      <option value="Austria" data-provinces="[]">
                        Austria
                      </option>
                      <option value="Azerbaijan" data-provinces="[]">
                        Azerbaijan
                      </option>
                      <option value="Bahamas" data-provinces="[]">
                        Bahamas
                      </option>
                      <option value="Bahrain" data-provinces="[]">
                        Bahrain
                      </option>
                      <option value="Bangladesh" data-provinces="[]">
                        Bangladesh
                      </option>
                      <option value="Barbados" data-provinces="[]">
                        Barbados
                      </option>
                      <option value="Belarus" data-provinces="[]">
                        Belarus
                      </option>
                      <option value="Belgium" data-provinces="[]">
                        Belgium
                      </option>
                      <option value="Belize" data-provinces="[]">Belize</option>
                      <option value="Benin" data-provinces="[]">Benin</option>
                      <option value="Bermuda" data-provinces="[]">
                        Bermuda
                      </option>
                      <option value="Bhutan" data-provinces="[]">Bhutan</option>
                      <option value="Bolivia" data-provinces="[]">
                        Bolivia
                      </option>
                      <option
                        value="Bosnia And Herzegovina"
                        data-provinces="[]"
                      >
                        Bosnia & Herzegovina
                      </option>
                      <option value="Botswana" data-provinces="[]">
                        Botswana
                      </option>
                      <option
                        value="Brazil"
                        data-provinces='[["Acre","Acre"],["Alagoas","Alagoas"],["Amapá","Amapá"],["Amazonas","Amazonas"],["Bahia","Bahia"],["Ceará","Ceará"],["Distrito Federal","Federal District"],["Espírito Santo","Espírito Santo"],["Goiás","Goiás"],["Maranhão","Maranhão"],["Mato Grosso","Mato Grosso"],["Mato Grosso do Sul","Mato Grosso do Sul"],["Minas Gerais","Minas Gerais"],["Paraná","Paraná"],["Paraíba","Paraíba"],["Pará","Pará"],["Pernambuco","Pernambuco"],["Piauí","Piauí"],["Rio Grande do Norte","Rio Grande do Norte"],["Rio Grande do Sul","Rio Grande do Sul"],["Rio de Janeiro","Rio de Janeiro"],["Rondônia","Rondônia"],["Roraima","Roraima"],["Santa Catarina","Santa Catarina"],["Sergipe","Sergipe"],["São Paulo","São Paulo"],["Tocantins","Tocantins"]]'
                      >
                        Brazil
                      </option>
                      <option
                        value="British Indian Ocean Territory"
                        data-provinces="[]"
                      >
                        British Indian Ocean Territory
                      </option>
                      <option
                        value="Virgin Islands, British"
                        data-provinces="[]"
                      >
                        British Virgin Islands
                      </option>
                      <option value="Brunei" data-provinces="[]">Brunei</option>
                      <option value="Bulgaria" data-provinces="[]">
                        Bulgaria
                      </option>
                      <option value="Burkina Faso" data-provinces="[]">
                        Burkina Faso
                      </option>
                      <option value="Burundi" data-provinces="[]">
                        Burundi
                      </option>
                      <option value="Cambodia" data-provinces="[]">
                        Cambodia
                      </option>
                      <option value="Republic of Cameroon" data-provinces="[]">
                        Cameroon
                      </option>
                      <option
                        value="Canada"
                        data-provinces='[["Alberta","Alberta"],["British Columbia","British Columbia"],["Manitoba","Manitoba"],["New Brunswick","New Brunswick"],["Newfoundland and Labrador","Newfoundland and Labrador"],["Northwest Territories","Northwest Territories"],["Nova Scotia","Nova Scotia"],["Nunavut","Nunavut"],["Ontario","Ontario"],["Prince Edward Island","Prince Edward Island"],["Quebec","Quebec"],["Saskatchewan","Saskatchewan"],["Yukon","Yukon"]]'
                      >
                        Canada
                      </option>
                      <option value="Cape Verde" data-provinces="[]">
                        Cape Verde
                      </option>
                      <option value="Caribbean Netherlands" data-provinces="[]">
                        Caribbean Netherlands
                      </option>
                      <option value="Cayman Islands" data-provinces="[]">
                        Cayman Islands
                      </option>
                      <option
                        value="Central African Republic"
                        data-provinces="[]"
                      >
                        Central African Republic
                      </option>
                      <option value="Chad" data-provinces="[]">Chad</option>
                      <option
                        value="Chile"
                        data-provinces='[["Antofagasta","Antofagasta"],["Araucanía","Araucanía"],["Arica and Parinacota","Arica y Parinacota"],["Atacama","Atacama"],["Aysén","Aysén"],["Biobío","Bío Bío"],["Coquimbo","Coquimbo"],["Los Lagos","Los Lagos"],["Los Ríos","Los Ríos"],["Magallanes","Magallanes Region"],["Maule","Maule"],["O&#39;Higgins","Libertador General Bernardo O’Higgins"],["Santiago","Santiago Metropolitan"],["Tarapacá","Tarapacá"],["Valparaíso","Valparaíso"],["Ñuble","Ñuble"]]'
                      >
                        Chile
                      </option>
                      <option
                        value="China"
                        data-provinces='[["Anhui","Anhui"],["Beijing","Beijing"],["Chongqing","Chongqing"],["Fujian","Fujian"],["Gansu","Gansu"],["Guangdong","Guangdong"],["Guangxi","Guangxi"],["Guizhou","Guizhou"],["Hainan","Hainan"],["Hebei","Hebei"],["Heilongjiang","Heilongjiang"],["Henan","Henan"],["Hubei","Hubei"],["Hunan","Hunan"],["Inner Mongolia","Inner Mongolia"],["Jiangsu","Jiangsu"],["Jiangxi","Jiangxi"],["Jilin","Jilin"],["Liaoning","Liaoning"],["Ningxia","Ningxia"],["Qinghai","Qinghai"],["Shaanxi","Shaanxi"],["Shandong","Shandong"],["Shanghai","Shanghai"],["Shanxi","Shanxi"],["Sichuan","Sichuan"],["Tianjin","Tianjin"],["Xinjiang","Xinjiang"],["Xizang","Tibet"],["Yunnan","Yunnan"],["Zhejiang","Zhejiang"]]'
                      >
                        China
                      </option>
                      <option value="Christmas Island" data-provinces="[]">
                        Christmas Island
                      </option>
                      <option
                        value="Cocos (Keeling) Islands"
                        data-provinces="[]"
                      >
                        Cocos (Keeling) Islands
                      </option>
                      <option
                        value="Colombia"
                        data-provinces='[["Amazonas","Amazonas"],["Antioquia","Antioquia"],["Arauca","Arauca"],["Atlántico","Atlántico"],["Bogotá, D.C.","Capital District"],["Bolívar","Bolívar"],["Boyacá","Boyacá"],["Caldas","Caldas"],["Caquetá","Caquetá"],["Casanare","Casanare"],["Cauca","Cauca"],["Cesar","Cesar"],["Chocó","Chocó"],["Cundinamarca","Cundinamarca"],["Córdoba","Córdoba"],["Guainía","Guainía"],["Guaviare","Guaviare"],["Huila","Huila"],["La Guajira","La Guajira"],["Magdalena","Magdalena"],["Meta","Meta"],["Nariño","Nariño"],["Norte de Santander","Norte de Santander"],["Putumayo","Putumayo"],["Quindío","Quindío"],["Risaralda","Risaralda"],["San Andrés, Providencia y Santa Catalina","San Andrés \u0026 Providencia"],["Santander","Santander"],["Sucre","Sucre"],["Tolima","Tolima"],["Valle del Cauca","Valle del Cauca"],["Vaupés","Vaupés"],["Vichada","Vichada"]]'
                      >
                        Colombia
                      </option>
                      <option value="Comoros" data-provinces="[]">
                        Comoros
                      </option>
                      <option value="Congo" data-provinces="[]">
                        Congo - Brazzaville
                      </option>
                      <option
                        value="Congo, The Democratic Republic Of The"
                        data-provinces="[]"
                      >
                        Congo - Kinshasa
                      </option>
                      <option value="Cook Islands" data-provinces="[]">
                        Cook Islands
                      </option>
                      <option
                        value="Costa Rica"
                        data-provinces='[["Alajuela","Alajuela"],["Cartago","Cartago"],["Guanacaste","Guanacaste"],["Heredia","Heredia"],["Limón","Limón"],["Puntarenas","Puntarenas"],["San José","San José"]]'
                      >
                        Costa Rica
                      </option>
                      <option value="Croatia" data-provinces="[]">
                        Croatia
                      </option>
                      <option value="Curaçao" data-provinces="[]">
                        Curaçao
                      </option>
                      <option value="Cyprus" data-provinces="[]">Cyprus</option>
                      <option value="Czech Republic" data-provinces="[]">
                        Czechia
                      </option>
                      <option value="Côte d'Ivoire" data-provinces="[]">
                        Côte d’Ivoire
                      </option>
                      <option value="Denmark" data-provinces="[]">
                        Denmark
                      </option>
                      <option value="Djibouti" data-provinces="[]">
                        Djibouti
                      </option>
                      <option value="Dominica" data-provinces="[]">
                        Dominica
                      </option>
                      <option value="Dominican Republic" data-provinces="[]">
                        Dominican Republic
                      </option>
                      <option value="Ecuador" data-provinces="[]">
                        Ecuador
                      </option>
                      <option
                        value="Egypt"
                        data-provinces='[["6th of October","6th of October"],["Al Sharqia","Al Sharqia"],["Alexandria","Alexandria"],["Aswan","Aswan"],["Asyut","Asyut"],["Beheira","Beheira"],["Beni Suef","Beni Suef"],["Cairo","Cairo"],["Dakahlia","Dakahlia"],["Damietta","Damietta"],["Faiyum","Faiyum"],["Gharbia","Gharbia"],["Giza","Giza"],["Helwan","Helwan"],["Ismailia","Ismailia"],["Kafr el-Sheikh","Kafr el-Sheikh"],["Luxor","Luxor"],["Matrouh","Matrouh"],["Minya","Minya"],["Monufia","Monufia"],["New Valley","New Valley"],["North Sinai","North Sinai"],["Port Said","Port Said"],["Qalyubia","Qalyubia"],["Qena","Qena"],["Red Sea","Red Sea"],["Sohag","Sohag"],["South Sinai","South Sinai"],["Suez","Suez"]]'
                      >
                        Egypt
                      </option>
                      <option
                        value="El Salvador"
                        data-provinces='[["Ahuachapán","Ahuachapán"],["Cabañas","Cabañas"],["Chalatenango","Chalatenango"],["Cuscatlán","Cuscatlán"],["La Libertad","La Libertad"],["La Paz","La Paz"],["La Unión","La Unión"],["Morazán","Morazán"],["San Miguel","San Miguel"],["San Salvador","San Salvador"],["San Vicente","San Vicente"],["Santa Ana","Santa Ana"],["Sonsonate","Sonsonate"],["Usulután","Usulután"]]'
                      >
                        El Salvador
                      </option>
                      <option value="Equatorial Guinea" data-provinces="[]">
                        Equatorial Guinea
                      </option>
                      <option value="Eritrea" data-provinces="[]">
                        Eritrea
                      </option>
                      <option value="Estonia" data-provinces="[]">
                        Estonia
                      </option>
                      <option value="Eswatini" data-provinces="[]">
                        Eswatini
                      </option>
                      <option value="Ethiopia" data-provinces="[]">
                        Ethiopia
                      </option>
                      <option
                        value="Falkland Islands (Malvinas)"
                        data-provinces="[]"
                      >
                        Falkland Islands
                      </option>
                      <option value="Faroe Islands" data-provinces="[]">
                        Faroe Islands
                      </option>
                      <option value="Fiji" data-provinces="[]">Fiji</option>
                      <option value="Finland" data-provinces="[]">
                        Finland
                      </option>
                      <option value="France" data-provinces="[]">France</option>
                      <option value="French Guiana" data-provinces="[]">
                        French Guiana
                      </option>
                      <option value="French Polynesia" data-provinces="[]">
                        French Polynesia
                      </option>
                      <option
                        value="French Southern Territories"
                        data-provinces="[]"
                      >
                        French Southern Territories
                      </option>
                      <option value="Gabon" data-provinces="[]">Gabon</option>
                      <option value="Gambia" data-provinces="[]">Gambia</option>
                      <option value="Georgia" data-provinces="[]">
                        Georgia
                      </option>
                      <option value="Germany" data-provinces="[]">
                        Germany
                      </option>
                      <option value="Ghana" data-provinces="[]">Ghana</option>
                      <option value="Gibraltar" data-provinces="[]">
                        Gibraltar
                      </option>
                      <option value="Greece" data-provinces="[]">Greece</option>
                      <option value="Greenland" data-provinces="[]">
                        Greenland
                      </option>
                      <option value="Grenada" data-provinces="[]">
                        Grenada
                      </option>
                      <option value="Guadeloupe" data-provinces="[]">
                        Guadeloupe
                      </option>
                      <option
                        value="Guatemala"
                        data-provinces='[["Alta Verapaz","Alta Verapaz"],["Baja Verapaz","Baja Verapaz"],["Chimaltenango","Chimaltenango"],["Chiquimula","Chiquimula"],["El Progreso","El Progreso"],["Escuintla","Escuintla"],["Guatemala","Guatemala"],["Huehuetenango","Huehuetenango"],["Izabal","Izabal"],["Jalapa","Jalapa"],["Jutiapa","Jutiapa"],["Petén","Petén"],["Quetzaltenango","Quetzaltenango"],["Quiché","Quiché"],["Retalhuleu","Retalhuleu"],["Sacatepéquez","Sacatepéquez"],["San Marcos","San Marcos"],["Santa Rosa","Santa Rosa"],["Sololá","Sololá"],["Suchitepéquez","Suchitepéquez"],["Totonicapán","Totonicapán"],["Zacapa","Zacapa"]]'
                      >
                        Guatemala
                      </option>
                      <option value="Guernsey" data-provinces="[]">
                        Guernsey
                      </option>
                      <option value="Guinea" data-provinces="[]">Guinea</option>
                      <option value="Guinea Bissau" data-provinces="[]">
                        Guinea-Bissau
                      </option>
                      <option value="Guyana" data-provinces="[]">Guyana</option>
                      <option value="Haiti" data-provinces="[]">Haiti</option>
                      <option value="Honduras" data-provinces="[]">
                        Honduras
                      </option>
                      <option
                        value="Hong Kong"
                        data-provinces='[["Hong Kong Island","Hong Kong Island"],["Kowloon","Kowloon"],["New Territories","New Territories"]]'
                      >
                        Hong Kong SAR
                      </option>
                      <option value="Hungary" data-provinces="[]">
                        Hungary
                      </option>
                      <option value="Iceland" data-provinces="[]">
                        Iceland
                      </option>
                      <option
                        value="India"
                        data-provinces='[["Andaman and Nicobar Islands","Andaman and Nicobar Islands"],["Andhra Pradesh","Andhra Pradesh"],["Arunachal Pradesh","Arunachal Pradesh"],["Assam","Assam"],["Bihar","Bihar"],["Chandigarh","Chandigarh"],["Chhattisgarh","Chhattisgarh"],["Dadra and Nagar Haveli","Dadra and Nagar Haveli"],["Daman and Diu","Daman and Diu"],["Delhi","Delhi"],["Goa","Goa"],["Gujarat","Gujarat"],["Haryana","Haryana"],["Himachal Pradesh","Himachal Pradesh"],["Jammu and Kashmir","Jammu and Kashmir"],["Jharkhand","Jharkhand"],["Karnataka","Karnataka"],["Kerala","Kerala"],["Ladakh","Ladakh"],["Lakshadweep","Lakshadweep"],["Madhya Pradesh","Madhya Pradesh"],["Maharashtra","Maharashtra"],["Manipur","Manipur"],["Meghalaya","Meghalaya"],["Mizoram","Mizoram"],["Nagaland","Nagaland"],["Odisha","Odisha"],["Puducherry","Puducherry"],["Punjab","Punjab"],["Rajasthan","Rajasthan"],["Sikkim","Sikkim"],["Tamil Nadu","Tamil Nadu"],["Telangana","Telangana"],["Tripura","Tripura"],["Uttar Pradesh","Uttar Pradesh"],["Uttarakhand","Uttarakhand"],["West Bengal","West Bengal"]]'
                      >
                        India
                      </option>
                      <option
                        value="Indonesia"
                        data-provinces='[["Aceh","Aceh"],["Bali","Bali"],["Bangka Belitung","Bangka–Belitung Islands"],["Banten","Banten"],["Bengkulu","Bengkulu"],["Gorontalo","Gorontalo"],["Jakarta","Jakarta"],["Jambi","Jambi"],["Jawa Barat","West Java"],["Jawa Tengah","Central Java"],["Jawa Timur","East Java"],["Kalimantan Barat","West Kalimantan"],["Kalimantan Selatan","South Kalimantan"],["Kalimantan Tengah","Central Kalimantan"],["Kalimantan Timur","East Kalimantan"],["Kalimantan Utara","North Kalimantan"],["Kepulauan Riau","Riau Islands"],["Lampung","Lampung"],["Maluku","Maluku"],["Maluku Utara","North Maluku"],["North Sumatra","North Sumatra"],["Nusa Tenggara Barat","West Nusa Tenggara"],["Nusa Tenggara Timur","East Nusa Tenggara"],["Papua","Papua"],["Papua Barat","West Papua"],["Riau","Riau"],["South Sumatra","South Sumatra"],["Sulawesi Barat","West Sulawesi"],["Sulawesi Selatan","South Sulawesi"],["Sulawesi Tengah","Central Sulawesi"],["Sulawesi Tenggara","Southeast Sulawesi"],["Sulawesi Utara","North Sulawesi"],["West Sumatra","West Sumatra"],["Yogyakarta","Yogyakarta"]]'
                      >
                        Indonesia
                      </option>
                      <option value="Iraq" data-provinces="[]">Iraq</option>
                      <option
                        value="Ireland"
                        data-provinces='[["Carlow","Carlow"],["Cavan","Cavan"],["Clare","Clare"],["Cork","Cork"],["Donegal","Donegal"],["Dublin","Dublin"],["Galway","Galway"],["Kerry","Kerry"],["Kildare","Kildare"],["Kilkenny","Kilkenny"],["Laois","Laois"],["Leitrim","Leitrim"],["Limerick","Limerick"],["Longford","Longford"],["Louth","Louth"],["Mayo","Mayo"],["Meath","Meath"],["Monaghan","Monaghan"],["Offaly","Offaly"],["Roscommon","Roscommon"],["Sligo","Sligo"],["Tipperary","Tipperary"],["Waterford","Waterford"],["Westmeath","Westmeath"],["Wexford","Wexford"],["Wicklow","Wicklow"]]'
                      >
                        Ireland
                      </option>
                      <option value="Isle Of Man" data-provinces="[]">
                        Isle of Man
                      </option>
                      <option value="Israel" data-provinces="[]">Israel</option>
                      <option
                        value="Italy"
                        data-provinces='[["Agrigento","Agrigento"],["Alessandria","Alessandria"],["Ancona","Ancona"],["Aosta","Aosta Valley"],["Arezzo","Arezzo"],["Ascoli Piceno","Ascoli Piceno"],["Asti","Asti"],["Avellino","Avellino"],["Bari","Bari"],["Barletta-Andria-Trani","Barletta-Andria-Trani"],["Belluno","Belluno"],["Benevento","Benevento"],["Bergamo","Bergamo"],["Biella","Biella"],["Bologna","Bologna"],["Bolzano","South Tyrol"],["Brescia","Brescia"],["Brindisi","Brindisi"],["Cagliari","Cagliari"],["Caltanissetta","Caltanissetta"],["Campobasso","Campobasso"],["Carbonia-Iglesias","Carbonia-Iglesias"],["Caserta","Caserta"],["Catania","Catania"],["Catanzaro","Catanzaro"],["Chieti","Chieti"],["Como","Como"],["Cosenza","Cosenza"],["Cremona","Cremona"],["Crotone","Crotone"],["Cuneo","Cuneo"],["Enna","Enna"],["Fermo","Fermo"],["Ferrara","Ferrara"],["Firenze","Florence"],["Foggia","Foggia"],["Forlì-Cesena","Forlì-Cesena"],["Frosinone","Frosinone"],["Genova","Genoa"],["Gorizia","Gorizia"],["Grosseto","Grosseto"],["Imperia","Imperia"],["Isernia","Isernia"],["L&#39;Aquila","L’Aquila"],["La Spezia","La Spezia"],["Latina","Latina"],["Lecce","Lecce"],["Lecco","Lecco"],["Livorno","Livorno"],["Lodi","Lodi"],["Lucca","Lucca"],["Macerata","Macerata"],["Mantova","Mantua"],["Massa-Carrara","Massa and Carrara"],["Matera","Matera"],["Medio Campidano","Medio Campidano"],["Messina","Messina"],["Milano","Milan"],["Modena","Modena"],["Monza e Brianza","Monza and Brianza"],["Napoli","Naples"],["Novara","Novara"],["Nuoro","Nuoro"],["Ogliastra","Ogliastra"],["Olbia-Tempio","Olbia-Tempio"],["Oristano","Oristano"],["Padova","Padua"],["Palermo","Palermo"],["Parma","Parma"],["Pavia","Pavia"],["Perugia","Perugia"],["Pesaro e Urbino","Pesaro and Urbino"],["Pescara","Pescara"],["Piacenza","Piacenza"],["Pisa","Pisa"],["Pistoia","Pistoia"],["Pordenone","Pordenone"],["Potenza","Potenza"],["Prato","Prato"],["Ragusa","Ragusa"],["Ravenna","Ravenna"],["Reggio Calabria","Reggio Calabria"],["Reggio Emilia","Reggio Emilia"],["Rieti","Rieti"],["Rimini","Rimini"],["Roma","Rome"],["Rovigo","Rovigo"],["Salerno","Salerno"],["Sassari","Sassari"],["Savona","Savona"],["Siena","Siena"],["Siracusa","Syracuse"],["Sondrio","Sondrio"],["Taranto","Taranto"],["Teramo","Teramo"],["Terni","Terni"],["Torino","Turin"],["Trapani","Trapani"],["Trento","Trentino"],["Treviso","Treviso"],["Trieste","Trieste"],["Udine","Udine"],["Varese","Varese"],["Venezia","Venice"],["Verbano-Cusio-Ossola","Verbano-Cusio-Ossola"],["Vercelli","Vercelli"],["Verona","Verona"],["Vibo Valentia","Vibo Valentia"],["Vicenza","Vicenza"],["Viterbo","Viterbo"]]'
                      >
                        Italy
                      </option>
                      <option value="Jamaica" data-provinces="[]">
                        Jamaica
                      </option>
                      <option
                        value="Japan"
                        data-provinces='[["Aichi","Aichi"],["Akita","Akita"],["Aomori","Aomori"],["Chiba","Chiba"],["Ehime","Ehime"],["Fukui","Fukui"],["Fukuoka","Fukuoka"],["Fukushima","Fukushima"],["Gifu","Gifu"],["Gunma","Gunma"],["Hiroshima","Hiroshima"],["Hokkaidō","Hokkaido"],["Hyōgo","Hyogo"],["Ibaraki","Ibaraki"],["Ishikawa","Ishikawa"],["Iwate","Iwate"],["Kagawa","Kagawa"],["Kagoshima","Kagoshima"],["Kanagawa","Kanagawa"],["Kumamoto","Kumamoto"],["Kyōto","Kyoto"],["Kōchi","Kochi"],["Mie","Mie"],["Miyagi","Miyagi"],["Miyazaki","Miyazaki"],["Nagano","Nagano"],["Nagasaki","Nagasaki"],["Nara","Nara"],["Niigata","Niigata"],["Okayama","Okayama"],["Okinawa","Okinawa"],["Saga","Saga"],["Saitama","Saitama"],["Shiga","Shiga"],["Shimane","Shimane"],["Shizuoka","Shizuoka"],["Tochigi","Tochigi"],["Tokushima","Tokushima"],["Tottori","Tottori"],["Toyama","Toyama"],["Tōkyō","Tokyo"],["Wakayama","Wakayama"],["Yamagata","Yamagata"],["Yamaguchi","Yamaguchi"],["Yamanashi","Yamanashi"],["Ōita","Oita"],["Ōsaka","Osaka"]]'
                      >
                        Japan
                      </option>
                      <option value="Jersey" data-provinces="[]">Jersey</option>
                      <option value="Jordan" data-provinces="[]">Jordan</option>
                      <option value="Kazakhstan" data-provinces="[]">
                        Kazakhstan
                      </option>
                      <option value="Kenya" data-provinces="[]">Kenya</option>
                      <option value="Kiribati" data-provinces="[]">
                        Kiribati
                      </option>
                      <option value="Kosovo" data-provinces="[]">Kosovo</option>
                      <option
                        value="Kuwait"
                        data-provinces='[["Al Ahmadi","Al Ahmadi"],["Al Asimah","Al Asimah"],["Al Farwaniyah","Al Farwaniyah"],["Al Jahra","Al Jahra"],["Hawalli","Hawalli"],["Mubarak Al-Kabeer","Mubarak Al-Kabeer"]]'
                      >
                        Kuwait
                      </option>
                      <option value="Kyrgyzstan" data-provinces="[]">
                        Kyrgyzstan
                      </option>
                      <option
                        value="Lao People's Democratic Republic"
                        data-provinces="[]"
                      >
                        Laos
                      </option>
                      <option value="Latvia" data-provinces="[]">Latvia</option>
                      <option value="Lebanon" data-provinces="[]">
                        Lebanon
                      </option>
                      <option value="Lesotho" data-provinces="[]">
                        Lesotho
                      </option>
                      <option value="Liberia" data-provinces="[]">
                        Liberia
                      </option>
                      <option
                        value="Libyan Arab Jamahiriya"
                        data-provinces="[]"
                      >
                        Libya
                      </option>
                      <option value="Liechtenstein" data-provinces="[]">
                        Liechtenstein
                      </option>
                      <option value="Lithuania" data-provinces="[]">
                        Lithuania
                      </option>
                      <option value="Luxembourg" data-provinces="[]">
                        Luxembourg
                      </option>
                      <option value="Macao" data-provinces="[]">
                        Macao SAR
                      </option>
                      <option value="Madagascar" data-provinces="[]">
                        Madagascar
                      </option>
                      <option value="Malawi" data-provinces="[]">Malawi</option>
                      <option
                        value="Malaysia"
                        data-provinces='[["Johor","Johor"],["Kedah","Kedah"],["Kelantan","Kelantan"],["Kuala Lumpur","Kuala Lumpur"],["Labuan","Labuan"],["Melaka","Malacca"],["Negeri Sembilan","Negeri Sembilan"],["Pahang","Pahang"],["Penang","Penang"],["Perak","Perak"],["Perlis","Perlis"],["Putrajaya","Putrajaya"],["Sabah","Sabah"],["Sarawak","Sarawak"],["Selangor","Selangor"],["Terengganu","Terengganu"]]'
                      >
                        Malaysia
                      </option>
                      <option value="Maldives" data-provinces="[]">
                        Maldives
                      </option>
                      <option value="Mali" data-provinces="[]">Mali</option>
                      <option value="Malta" data-provinces="[]">Malta</option>
                      <option value="Martinique" data-provinces="[]">
                        Martinique
                      </option>
                      <option value="Mauritania" data-provinces="[]">
                        Mauritania
                      </option>
                      <option value="Mauritius" data-provinces="[]">
                        Mauritius
                      </option>
                      <option value="Mayotte" data-provinces="[]">
                        Mayotte
                      </option>
                      <option
                        value="Mexico"
                        data-provinces='[["Aguascalientes","Aguascalientes"],["Baja California","Baja California"],["Baja California Sur","Baja California Sur"],["Campeche","Campeche"],["Chiapas","Chiapas"],["Chihuahua","Chihuahua"],["Ciudad de México","Ciudad de Mexico"],["Coahuila","Coahuila"],["Colima","Colima"],["Durango","Durango"],["Guanajuato","Guanajuato"],["Guerrero","Guerrero"],["Hidalgo","Hidalgo"],["Jalisco","Jalisco"],["Michoacán","Michoacán"],["Morelos","Morelos"],["México","Mexico State"],["Nayarit","Nayarit"],["Nuevo León","Nuevo León"],["Oaxaca","Oaxaca"],["Puebla","Puebla"],["Querétaro","Querétaro"],["Quintana Roo","Quintana Roo"],["San Luis Potosí","San Luis Potosí"],["Sinaloa","Sinaloa"],["Sonora","Sonora"],["Tabasco","Tabasco"],["Tamaulipas","Tamaulipas"],["Tlaxcala","Tlaxcala"],["Veracruz","Veracruz"],["Yucatán","Yucatán"],["Zacatecas","Zacatecas"]]'
                      >
                        Mexico
                      </option>
                      <option value="Moldova, Republic of" data-provinces="[]">
                        Moldova
                      </option>
                      <option value="Monaco" data-provinces="[]">Monaco</option>
                      <option value="Mongolia" data-provinces="[]">
                        Mongolia
                      </option>
                      <option value="Montenegro" data-provinces="[]">
                        Montenegro
                      </option>
                      <option value="Montserrat" data-provinces="[]">
                        Montserrat
                      </option>
                      <option value="Morocco" data-provinces="[]">
                        Morocco
                      </option>
                      <option value="Mozambique" data-provinces="[]">
                        Mozambique
                      </option>
                      <option value="Myanmar" data-provinces="[]">
                        Myanmar (Burma)
                      </option>
                      <option value="Namibia" data-provinces="[]">
                        Namibia
                      </option>
                      <option value="Nauru" data-provinces="[]">Nauru</option>
                      <option value="Nepal" data-provinces="[]">Nepal</option>
                      <option value="Netherlands" data-provinces="[]">
                        Netherlands
                      </option>
                      <option value="New Caledonia" data-provinces="[]">
                        New Caledonia
                      </option>
                      <option
                        value="New Zealand"
                        data-provinces='[["Auckland","Auckland"],["Bay of Plenty","Bay of Plenty"],["Canterbury","Canterbury"],["Chatham Islands","Chatham Islands"],["Gisborne","Gisborne"],["Hawke&#39;s Bay","Hawke’s Bay"],["Manawatu-Wanganui","Manawatū-Whanganui"],["Marlborough","Marlborough"],["Nelson","Nelson"],["Northland","Northland"],["Otago","Otago"],["Southland","Southland"],["Taranaki","Taranaki"],["Tasman","Tasman"],["Waikato","Waikato"],["Wellington","Wellington"],["West Coast","West Coast"]]'
                      >
                        New Zealand
                      </option>
                      <option value="Nicaragua" data-provinces="[]">
                        Nicaragua
                      </option>
                      <option value="Niger" data-provinces="[]">Niger</option>
                      <option
                        value="Nigeria"
                        data-provinces='[["Abia","Abia"],["Abuja Federal Capital Territory","Federal Capital Territory"],["Adamawa","Adamawa"],["Akwa Ibom","Akwa Ibom"],["Anambra","Anambra"],["Bauchi","Bauchi"],["Bayelsa","Bayelsa"],["Benue","Benue"],["Borno","Borno"],["Cross River","Cross River"],["Delta","Delta"],["Ebonyi","Ebonyi"],["Edo","Edo"],["Ekiti","Ekiti"],["Enugu","Enugu"],["Gombe","Gombe"],["Imo","Imo"],["Jigawa","Jigawa"],["Kaduna","Kaduna"],["Kano","Kano"],["Katsina","Katsina"],["Kebbi","Kebbi"],["Kogi","Kogi"],["Kwara","Kwara"],["Lagos","Lagos"],["Nasarawa","Nasarawa"],["Niger","Niger"],["Ogun","Ogun"],["Ondo","Ondo"],["Osun","Osun"],["Oyo","Oyo"],["Plateau","Plateau"],["Rivers","Rivers"],["Sokoto","Sokoto"],["Taraba","Taraba"],["Yobe","Yobe"],["Zamfara","Zamfara"]]'
                      >
                        Nigeria
                      </option>
                      <option value="Niue" data-provinces="[]">Niue</option>
                      <option value="Norfolk Island" data-provinces="[]">
                        Norfolk Island
                      </option>
                      <option value="North Macedonia" data-provinces="[]">
                        North Macedonia
                      </option>
                      <option value="Norway" data-provinces="[]">Norway</option>
                      <option value="Oman" data-provinces="[]">Oman</option>
                      <option
                        value="Palestinian Territory, Occupied"
                        data-provinces="[]"
                      >
                        Palestinian Territories
                      </option>
                      <option
                        value="Panama"
                        data-provinces='[["Bocas del Toro","Bocas del Toro"],["Chiriquí","Chiriquí"],["Coclé","Coclé"],["Colón","Colón"],["Darién","Darién"],["Emberá","Emberá"],["Herrera","Herrera"],["Kuna Yala","Guna Yala"],["Los Santos","Los Santos"],["Ngöbe-Buglé","Ngöbe-Buglé"],["Panamá","Panamá"],["Panamá Oeste","West Panamá"],["Veraguas","Veraguas"]]'
                      >
                        Panama
                      </option>
                      <option value="Papua New Guinea" data-provinces="[]">
                        Papua New Guinea
                      </option>
                      <option value="Paraguay" data-provinces="[]">
                        Paraguay
                      </option>
                      <option
                        value="Peru"
                        data-provinces='[["Amazonas","Amazonas"],["Apurímac","Apurímac"],["Arequipa","Arequipa"],["Ayacucho","Ayacucho"],["Cajamarca","Cajamarca"],["Callao","El Callao"],["Cuzco","Cusco"],["Huancavelica","Huancavelica"],["Huánuco","Huánuco"],["Ica","Ica"],["Junín","Junín"],["La Libertad","La Libertad"],["Lambayeque","Lambayeque"],["Lima (departamento)","Lima (Department)"],["Lima (provincia)","Lima (Metropolitan)"],["Loreto","Loreto"],["Madre de Dios","Madre de Dios"],["Moquegua","Moquegua"],["Pasco","Pasco"],["Piura","Piura"],["Puno","Puno"],["San Martín","San Martín"],["Tacna","Tacna"],["Tumbes","Tumbes"],["Ucayali","Ucayali"],["Áncash","Ancash"]]'
                      >
                        Peru
                      </option>
                      <option
                        value="Philippines"
                        data-provinces='[["Abra","Abra"],["Agusan del Norte","Agusan del Norte"],["Agusan del Sur","Agusan del Sur"],["Aklan","Aklan"],["Albay","Albay"],["Antique","Antique"],["Apayao","Apayao"],["Aurora","Aurora"],["Basilan","Basilan"],["Bataan","Bataan"],["Batanes","Batanes"],["Batangas","Batangas"],["Benguet","Benguet"],["Biliran","Biliran"],["Bohol","Bohol"],["Bukidnon","Bukidnon"],["Bulacan","Bulacan"],["Cagayan","Cagayan"],["Camarines Norte","Camarines Norte"],["Camarines Sur","Camarines Sur"],["Camiguin","Camiguin"],["Capiz","Capiz"],["Catanduanes","Catanduanes"],["Cavite","Cavite"],["Cebu","Cebu"],["Cotabato","Cotabato"],["Davao Occidental","Davao Occidental"],["Davao Oriental","Davao Oriental"],["Davao de Oro","Compostela Valley"],["Davao del Norte","Davao del Norte"],["Davao del Sur","Davao del Sur"],["Dinagat Islands","Dinagat Islands"],["Eastern Samar","Eastern Samar"],["Guimaras","Guimaras"],["Ifugao","Ifugao"],["Ilocos Norte","Ilocos Norte"],["Ilocos Sur","Ilocos Sur"],["Iloilo","Iloilo"],["Isabela","Isabela"],["Kalinga","Kalinga"],["La Union","La Union"],["Laguna","Laguna"],["Lanao del Norte","Lanao del Norte"],["Lanao del Sur","Lanao del Sur"],["Leyte","Leyte"],["Maguindanao","Maguindanao"],["Marinduque","Marinduque"],["Masbate","Masbate"],["Metro Manila","Metro Manila"],["Misamis Occidental","Misamis Occidental"],["Misamis Oriental","Misamis Oriental"],["Mountain Province","Mountain"],["Negros Occidental","Negros Occidental"],["Negros Oriental","Negros Oriental"],["Northern Samar","Northern Samar"],["Nueva Ecija","Nueva Ecija"],["Nueva Vizcaya","Nueva Vizcaya"],["Occidental Mindoro","Occidental Mindoro"],["Oriental Mindoro","Oriental Mindoro"],["Palawan","Palawan"],["Pampanga","Pampanga"],["Pangasinan","Pangasinan"],["Quezon","Quezon"],["Quirino","Quirino"],["Rizal","Rizal"],["Romblon","Romblon"],["Samar","Samar"],["Sarangani","Sarangani"],["Siquijor","Siquijor"],["Sorsogon","Sorsogon"],["South Cotabato","South Cotabato"],["Southern Leyte","Southern Leyte"],["Sultan Kudarat","Sultan Kudarat"],["Sulu","Sulu"],["Surigao del Norte","Surigao del Norte"],["Surigao del Sur","Surigao del Sur"],["Tarlac","Tarlac"],["Tawi-Tawi","Tawi-Tawi"],["Zambales","Zambales"],["Zamboanga Sibugay","Zamboanga Sibugay"],["Zamboanga del Norte","Zamboanga del Norte"],["Zamboanga del Sur","Zamboanga del Sur"]]'
                      >
                        Philippines
                      </option>
                      <option value="Pitcairn" data-provinces="[]">
                        Pitcairn Islands
                      </option>
                      <option value="Poland" data-provinces="[]">Poland</option>
                      <option
                        value="Portugal"
                        data-provinces='[["Aveiro","Aveiro"],["Açores","Azores"],["Beja","Beja"],["Braga","Braga"],["Bragança","Bragança"],["Castelo Branco","Castelo Branco"],["Coimbra","Coimbra"],["Faro","Faro"],["Guarda","Guarda"],["Leiria","Leiria"],["Lisboa","Lisbon"],["Madeira","Madeira"],["Portalegre","Portalegre"],["Porto","Porto"],["Santarém","Santarém"],["Setúbal","Setúbal"],["Viana do Castelo","Viana do Castelo"],["Vila Real","Vila Real"],["Viseu","Viseu"],["Évora","Évora"]]'
                      >
                        Portugal
                      </option>
                      <option value="Qatar" data-provinces="[]">Qatar</option>
                      <option value="Reunion" data-provinces="[]">
                        Réunion
                      </option>
                      <option
                        value="Romania"
                        data-provinces='[["Alba","Alba"],["Arad","Arad"],["Argeș","Argeș"],["Bacău","Bacău"],["Bihor","Bihor"],["Bistrița-Năsăud","Bistriţa-Năsăud"],["Botoșani","Botoşani"],["Brașov","Braşov"],["Brăila","Brăila"],["București","Bucharest"],["Buzău","Buzău"],["Caraș-Severin","Caraș-Severin"],["Cluj","Cluj"],["Constanța","Constanța"],["Covasna","Covasna"],["Călărași","Călărași"],["Dolj","Dolj"],["Dâmbovița","Dâmbovița"],["Galați","Galați"],["Giurgiu","Giurgiu"],["Gorj","Gorj"],["Harghita","Harghita"],["Hunedoara","Hunedoara"],["Ialomița","Ialomița"],["Iași","Iași"],["Ilfov","Ilfov"],["Maramureș","Maramureş"],["Mehedinți","Mehedinți"],["Mureș","Mureş"],["Neamț","Neamţ"],["Olt","Olt"],["Prahova","Prahova"],["Satu Mare","Satu Mare"],["Sibiu","Sibiu"],["Suceava","Suceava"],["Sălaj","Sălaj"],["Teleorman","Teleorman"],["Timiș","Timiș"],["Tulcea","Tulcea"],["Vaslui","Vaslui"],["Vrancea","Vrancea"],["Vâlcea","Vâlcea"]]'
                      >
                        Romania
                      </option>
                      <option
                        value="Russia"
                        data-provinces='[["Altai Krai","Altai Krai"],["Altai Republic","Altai"],["Amur Oblast","Amur"],["Arkhangelsk Oblast","Arkhangelsk"],["Astrakhan Oblast","Astrakhan"],["Belgorod Oblast","Belgorod"],["Bryansk Oblast","Bryansk"],["Chechen Republic","Chechen"],["Chelyabinsk Oblast","Chelyabinsk"],["Chukotka Autonomous Okrug","Chukotka Okrug"],["Chuvash Republic","Chuvash"],["Irkutsk Oblast","Irkutsk"],["Ivanovo Oblast","Ivanovo"],["Jewish Autonomous Oblast","Jewish"],["Kabardino-Balkarian Republic","Kabardino-Balkar"],["Kaliningrad Oblast","Kaliningrad"],["Kaluga Oblast","Kaluga"],["Kamchatka Krai","Kamchatka Krai"],["Karachay–Cherkess Republic","Karachay-Cherkess"],["Kemerovo Oblast","Kemerovo"],["Khabarovsk Krai","Khabarovsk Krai"],["Khanty-Mansi Autonomous Okrug","Khanty-Mansi"],["Kirov Oblast","Kirov"],["Komi Republic","Komi"],["Kostroma Oblast","Kostroma"],["Krasnodar Krai","Krasnodar Krai"],["Krasnoyarsk Krai","Krasnoyarsk Krai"],["Kurgan Oblast","Kurgan"],["Kursk Oblast","Kursk"],["Leningrad Oblast","Leningrad"],["Lipetsk Oblast","Lipetsk"],["Magadan Oblast","Magadan"],["Mari El Republic","Mari El"],["Moscow","Moscow"],["Moscow Oblast","Moscow Province"],["Murmansk Oblast","Murmansk"],["Nizhny Novgorod Oblast","Nizhny Novgorod"],["Novgorod Oblast","Novgorod"],["Novosibirsk Oblast","Novosibirsk"],["Omsk Oblast","Omsk"],["Orenburg Oblast","Orenburg"],["Oryol Oblast","Oryol"],["Penza Oblast","Penza"],["Perm Krai","Perm Krai"],["Primorsky Krai","Primorsky Krai"],["Pskov Oblast","Pskov"],["Republic of Adygeya","Adygea"],["Republic of Bashkortostan","Bashkortostan"],["Republic of Buryatia","Buryat"],["Republic of Dagestan","Dagestan"],["Republic of Ingushetia","Ingushetia"],["Republic of Kalmykia","Kalmykia"],["Republic of Karelia","Karelia"],["Republic of Khakassia","Khakassia"],["Republic of Mordovia","Mordovia"],["Republic of North Ossetia–Alania","North Ossetia-Alania"],["Republic of Tatarstan","Tatarstan"],["Rostov Oblast","Rostov"],["Ryazan Oblast","Ryazan"],["Saint Petersburg","Saint Petersburg"],["Sakha Republic (Yakutia)","Sakha"],["Sakhalin Oblast","Sakhalin"],["Samara Oblast","Samara"],["Saratov Oblast","Saratov"],["Smolensk Oblast","Smolensk"],["Stavropol Krai","Stavropol Krai"],["Sverdlovsk Oblast","Sverdlovsk"],["Tambov Oblast","Tambov"],["Tomsk Oblast","Tomsk"],["Tula Oblast","Tula"],["Tver Oblast","Tver"],["Tyumen Oblast","Tyumen"],["Tyva Republic","Tuva"],["Udmurtia","Udmurt"],["Ulyanovsk Oblast","Ulyanovsk"],["Vladimir Oblast","Vladimir"],["Volgograd Oblast","Volgograd"],["Vologda Oblast","Vologda"],["Voronezh Oblast","Voronezh"],["Yamalo-Nenets Autonomous Okrug","Yamalo-Nenets Okrug"],["Yaroslavl Oblast","Yaroslavl"],["Zabaykalsky Krai","Zabaykalsky Krai"]]'
                      >
                        Russia
                      </option>
                      <option value="Rwanda" data-provinces="[]">Rwanda</option>
                      <option value="Samoa" data-provinces="[]">Samoa</option>
                      <option value="San Marino" data-provinces="[]">
                        San Marino
                      </option>
                      <option value="Sao Tome And Principe" data-provinces="[]">
                        São Tomé & Príncipe
                      </option>
                      <option value="Saudi Arabia" data-provinces="[]">
                        Saudi Arabia
                      </option>
                      <option value="Senegal" data-provinces="[]">
                        Senegal
                      </option>
                      <option value="Serbia" data-provinces="[]">Serbia</option>
                      <option value="Seychelles" data-provinces="[]">
                        Seychelles
                      </option>
                      <option value="Sierra Leone" data-provinces="[]">
                        Sierra Leone
                      </option>
                      <option value="Singapore" data-provinces="[]">
                        Singapore
                      </option>
                      <option value="Sint Maarten" data-provinces="[]">
                        Sint Maarten
                      </option>
                      <option value="Slovakia" data-provinces="[]">
                        Slovakia
                      </option>
                      <option value="Slovenia" data-provinces="[]">
                        Slovenia
                      </option>
                      <option value="Solomon Islands" data-provinces="[]">
                        Solomon Islands
                      </option>
                      <option value="Somalia" data-provinces="[]">
                        Somalia
                      </option>
                      <option
                        value="South Africa"
                        data-provinces='[["Eastern Cape","Eastern Cape"],["Free State","Free State"],["Gauteng","Gauteng"],["KwaZulu-Natal","KwaZulu-Natal"],["Limpopo","Limpopo"],["Mpumalanga","Mpumalanga"],["North West","North West"],["Northern Cape","Northern Cape"],["Western Cape","Western Cape"]]'
                      >
                        South Africa
                      </option>
                      <option
                        value="South Georgia And The South Sandwich Islands"
                        data-provinces="[]"
                      >
                        South Georgia & South Sandwich Islands
                      </option>
                      <option
                        value="South Korea"
                        data-provinces='[["Busan","Busan"],["Chungbuk","North Chungcheong"],["Chungnam","South Chungcheong"],["Daegu","Daegu"],["Daejeon","Daejeon"],["Gangwon","Gangwon"],["Gwangju","Gwangju City"],["Gyeongbuk","North Gyeongsang"],["Gyeonggi","Gyeonggi"],["Gyeongnam","South Gyeongsang"],["Incheon","Incheon"],["Jeju","Jeju"],["Jeonbuk","North Jeolla"],["Jeonnam","South Jeolla"],["Sejong","Sejong"],["Seoul","Seoul"],["Ulsan","Ulsan"]]'
                      >
                        South Korea
                      </option>
                      <option value="South Sudan" data-provinces="[]">
                        South Sudan
                      </option>
                      <option
                        value="Spain"
                        data-provinces='[["A Coruña","A Coruña"],["Albacete","Albacete"],["Alicante","Alicante"],["Almería","Almería"],["Asturias","Asturias Province"],["Badajoz","Badajoz"],["Balears","Balears Province"],["Barcelona","Barcelona"],["Burgos","Burgos"],["Cantabria","Cantabria Province"],["Castellón","Castellón"],["Ceuta","Ceuta"],["Ciudad Real","Ciudad Real"],["Cuenca","Cuenca"],["Cáceres","Cáceres"],["Cádiz","Cádiz"],["Córdoba","Córdoba"],["Girona","Girona"],["Granada","Granada"],["Guadalajara","Guadalajara"],["Guipúzcoa","Gipuzkoa"],["Huelva","Huelva"],["Huesca","Huesca"],["Jaén","Jaén"],["La Rioja","La Rioja Province"],["Las Palmas","Las Palmas"],["León","León"],["Lleida","Lleida"],["Lugo","Lugo"],["Madrid","Madrid Province"],["Melilla","Melilla"],["Murcia","Murcia"],["Málaga","Málaga"],["Navarra","Navarra"],["Ourense","Ourense"],["Palencia","Palencia"],["Pontevedra","Pontevedra"],["Salamanca","Salamanca"],["Santa Cruz de Tenerife","Santa Cruz de Tenerife"],["Segovia","Segovia"],["Sevilla","Seville"],["Soria","Soria"],["Tarragona","Tarragona"],["Teruel","Teruel"],["Toledo","Toledo"],["Valencia","Valencia"],["Valladolid","Valladolid"],["Vizcaya","Biscay"],["Zamora","Zamora"],["Zaragoza","Zaragoza"],["Álava","Álava"],["Ávila","Ávila"]]'
                      >
                        Spain
                      </option>
                      <option value="Sri Lanka" data-provinces="[]">
                        Sri Lanka
                      </option>
                      <option value="Saint Barthélemy" data-provinces="[]">
                        St. Barthélemy
                      </option>
                      <option value="Saint Helena" data-provinces="[]">
                        St. Helena
                      </option>
                      <option value="Saint Kitts And Nevis" data-provinces="[]">
                        St. Kitts & Nevis
                      </option>
                      <option value="Saint Lucia" data-provinces="[]">
                        St. Lucia
                      </option>
                      <option value="Saint Martin" data-provinces="[]">
                        St. Martin
                      </option>
                      <option
                        value="Saint Pierre And Miquelon"
                        data-provinces="[]"
                      >
                        St. Pierre & Miquelon
                      </option>
                      <option value="St. Vincent" data-provinces="[]">
                        St. Vincent & Grenadines
                      </option>
                      <option value="Sudan" data-provinces="[]">Sudan</option>
                      <option value="Suriname" data-provinces="[]">
                        Suriname
                      </option>
                      <option
                        value="Svalbard And Jan Mayen"
                        data-provinces="[]"
                      >
                        Svalbard & Jan Mayen
                      </option>
                      <option value="Sweden" data-provinces="[]">Sweden</option>
                      <option value="Switzerland" data-provinces="[]">
                        Switzerland
                      </option>
                      <option value="Taiwan" data-provinces="[]">Taiwan</option>
                      <option value="Tajikistan" data-provinces="[]">
                        Tajikistan
                      </option>
                      <option
                        value="Tanzania, United Republic Of"
                        data-provinces="[]"
                      >
                        Tanzania
                      </option>
                      <option
                        value="Thailand"
                        data-provinces='[["Amnat Charoen","Amnat Charoen"],["Ang Thong","Ang Thong"],["Bangkok","Bangkok"],["Bueng Kan","Bueng Kan"],["Buriram","Buri Ram"],["Chachoengsao","Chachoengsao"],["Chai Nat","Chai Nat"],["Chaiyaphum","Chaiyaphum"],["Chanthaburi","Chanthaburi"],["Chiang Mai","Chiang Mai"],["Chiang Rai","Chiang Rai"],["Chon Buri","Chon Buri"],["Chumphon","Chumphon"],["Kalasin","Kalasin"],["Kamphaeng Phet","Kamphaeng Phet"],["Kanchanaburi","Kanchanaburi"],["Khon Kaen","Khon Kaen"],["Krabi","Krabi"],["Lampang","Lampang"],["Lamphun","Lamphun"],["Loei","Loei"],["Lopburi","Lopburi"],["Mae Hong Son","Mae Hong Son"],["Maha Sarakham","Maha Sarakham"],["Mukdahan","Mukdahan"],["Nakhon Nayok","Nakhon Nayok"],["Nakhon Pathom","Nakhon Pathom"],["Nakhon Phanom","Nakhon Phanom"],["Nakhon Ratchasima","Nakhon Ratchasima"],["Nakhon Sawan","Nakhon Sawan"],["Nakhon Si Thammarat","Nakhon Si Thammarat"],["Nan","Nan"],["Narathiwat","Narathiwat"],["Nong Bua Lam Phu","Nong Bua Lam Phu"],["Nong Khai","Nong Khai"],["Nonthaburi","Nonthaburi"],["Pathum Thani","Pathum Thani"],["Pattani","Pattani"],["Pattaya","Pattaya"],["Phangnga","Phang Nga"],["Phatthalung","Phatthalung"],["Phayao","Phayao"],["Phetchabun","Phetchabun"],["Phetchaburi","Phetchaburi"],["Phichit","Phichit"],["Phitsanulok","Phitsanulok"],["Phra Nakhon Si Ayutthaya","Phra Nakhon Si Ayutthaya"],["Phrae","Phrae"],["Phuket","Phuket"],["Prachin Buri","Prachin Buri"],["Prachuap Khiri Khan","Prachuap Khiri Khan"],["Ranong","Ranong"],["Ratchaburi","Ratchaburi"],["Rayong","Rayong"],["Roi Et","Roi Et"],["Sa Kaeo","Sa Kaeo"],["Sakon Nakhon","Sakon Nakhon"],["Samut Prakan","Samut Prakan"],["Samut Sakhon","Samut Sakhon"],["Samut Songkhram","Samut Songkhram"],["Saraburi","Saraburi"],["Satun","Satun"],["Sing Buri","Sing Buri"],["Sisaket","Si Sa Ket"],["Songkhla","Songkhla"],["Sukhothai","Sukhothai"],["Suphan Buri","Suphanburi"],["Surat Thani","Surat Thani"],["Surin","Surin"],["Tak","Tak"],["Trang","Trang"],["Trat","Trat"],["Ubon Ratchathani","Ubon Ratchathani"],["Udon Thani","Udon Thani"],["Uthai Thani","Uthai Thani"],["Uttaradit","Uttaradit"],["Yala","Yala"],["Yasothon","Yasothon"]]'
                      >
                        Thailand
                      </option>
                      <option value="Timor Leste" data-provinces="[]">
                        Timor-Leste
                      </option>
                      <option value="Togo" data-provinces="[]">Togo</option>
                      <option value="Tokelau" data-provinces="[]">
                        Tokelau
                      </option>
                      <option value="Tonga" data-provinces="[]">Tonga</option>
                      <option value="Trinidad and Tobago" data-provinces="[]">
                        Trinidad & Tobago
                      </option>
                      <option value="Tristan da Cunha" data-provinces="[]">
                        Tristan da Cunha
                      </option>
                      <option value="Tunisia" data-provinces="[]">
                        Tunisia
                      </option>
                      <option value="Turkey" data-provinces="[]">Turkey</option>
                      <option value="Turkmenistan" data-provinces="[]">
                        Turkmenistan
                      </option>
                      <option
                        value="Turks and Caicos Islands"
                        data-provinces="[]"
                      >
                        Turks & Caicos Islands
                      </option>
                      <option value="Tuvalu" data-provinces="[]">Tuvalu</option>
                      <option
                        value="United States Minor Outlying Islands"
                        data-provinces="[]"
                      >
                        U.S. Outlying Islands
                      </option>
                      <option value="Uganda" data-provinces="[]">Uganda</option>
                      <option value="Ukraine" data-provinces="[]">
                        Ukraine
                      </option>
                      <option
                        value="United Arab Emirates"
                        data-provinces='[["Abu Dhabi","Abu Dhabi"],["Ajman","Ajman"],["Dubai","Dubai"],["Fujairah","Fujairah"],["Ras al-Khaimah","Ras al-Khaimah"],["Sharjah","Sharjah"],["Umm al-Quwain","Umm al-Quwain"]]'
                      >
                        United Arab Emirates
                      </option>
                      <option
                        value="United Kingdom"
                        data-provinces='[["British Forces","British Forces"],["England","England"],["Northern Ireland","Northern Ireland"],["Scotland","Scotland"],["Wales","Wales"]]'
                      >
                        United Kingdom
                      </option>
                      <option
                        value="United States"
                        data-provinces='[["Alabama","Alabama"],["Alaska","Alaska"],["American Samoa","American Samoa"],["Arizona","Arizona"],["Arkansas","Arkansas"],["Armed Forces Americas","Armed Forces Americas"],["Armed Forces Europe","Armed Forces Europe"],["Armed Forces Pacific","Armed Forces Pacific"],["California","California"],["Colorado","Colorado"],["Connecticut","Connecticut"],["Delaware","Delaware"],["District of Columbia","Washington DC"],["Federated States of Micronesia","Micronesia"],["Florida","Florida"],["Georgia","Georgia"],["Guam","Guam"],["Hawaii","Hawaii"],["Idaho","Idaho"],["Illinois","Illinois"],["Indiana","Indiana"],["Iowa","Iowa"],["Kansas","Kansas"],["Kentucky","Kentucky"],["Louisiana","Louisiana"],["Maine","Maine"],["Marshall Islands","Marshall Islands"],["Maryland","Maryland"],["Massachusetts","Massachusetts"],["Michigan","Michigan"],["Minnesota","Minnesota"],["Mississippi","Mississippi"],["Missouri","Missouri"],["Montana","Montana"],["Nebraska","Nebraska"],["Nevada","Nevada"],["New Hampshire","New Hampshire"],["New Jersey","New Jersey"],["New Mexico","New Mexico"],["New York","New York"],["North Carolina","North Carolina"],["North Dakota","North Dakota"],["Northern Mariana Islands","Northern Mariana Islands"],["Ohio","Ohio"],["Oklahoma","Oklahoma"],["Oregon","Oregon"],["Palau","Palau"],["Pennsylvania","Pennsylvania"],["Puerto Rico","Puerto Rico"],["Rhode Island","Rhode Island"],["South Carolina","South Carolina"],["South Dakota","South Dakota"],["Tennessee","Tennessee"],["Texas","Texas"],["Utah","Utah"],["Vermont","Vermont"],["Virgin Islands","U.S. Virgin Islands"],["Virginia","Virginia"],["Washington","Washington"],["West Virginia","West Virginia"],["Wisconsin","Wisconsin"],["Wyoming","Wyoming"]]'
                      >
                        United States
                      </option>
                      <option
                        value="Uruguay"
                        data-provinces='[["Artigas","Artigas"],["Canelones","Canelones"],["Cerro Largo","Cerro Largo"],["Colonia","Colonia"],["Durazno","Durazno"],["Flores","Flores"],["Florida","Florida"],["Lavalleja","Lavalleja"],["Maldonado","Maldonado"],["Montevideo","Montevideo"],["Paysandú","Paysandú"],["Rivera","Rivera"],["Rocha","Rocha"],["Río Negro","Río Negro"],["Salto","Salto"],["San José","San José"],["Soriano","Soriano"],["Tacuarembó","Tacuarembó"],["Treinta y Tres","Treinta y Tres"]]'
                      >
                        Uruguay
                      </option>
                      <option value="Uzbekistan" data-provinces="[]">
                        Uzbekistan
                      </option>
                      <option value="Vanuatu" data-provinces="[]">
                        Vanuatu
                      </option>
                      <option
                        value="Holy See (Vatican City State)"
                        data-provinces="[]"
                      >
                        Vatican City
                      </option>
                      <option
                        value="Venezuela"
                        data-provinces='[["Amazonas","Amazonas"],["Anzoátegui","Anzoátegui"],["Apure","Apure"],["Aragua","Aragua"],["Barinas","Barinas"],["Bolívar","Bolívar"],["Carabobo","Carabobo"],["Cojedes","Cojedes"],["Delta Amacuro","Delta Amacuro"],["Dependencias Federales","Federal Dependencies"],["Distrito Capital","Capital"],["Falcón","Falcón"],["Guárico","Guárico"],["La Guaira","Vargas"],["Lara","Lara"],["Miranda","Miranda"],["Monagas","Monagas"],["Mérida","Mérida"],["Nueva Esparta","Nueva Esparta"],["Portuguesa","Portuguesa"],["Sucre","Sucre"],["Trujillo","Trujillo"],["Táchira","Táchira"],["Yaracuy","Yaracuy"],["Zulia","Zulia"]]'
                      >
                        Venezuela
                      </option>
                      <option value="Vietnam" data-provinces="[]">
                        Vietnam
                      </option>
                      <option value="Wallis And Futuna" data-provinces="[]">
                        Wallis & Futuna
                      </option>
                      <option value="Western Sahara" data-provinces="[]">
                        Western Sahara
                      </option>
                      <option value="Yemen" data-provinces="[]">Yemen</option>
                      <option value="Zambia" data-provinces="[]">Zambia</option>
                      <option value="Zimbabwe" data-provinces="[]">
                        Zimbabwe
                      </option></select
                    ><svg
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
                      ></path>
                    </svg>
                  </div>

                  <label
                    for="address-8302380974301[country]"
                    class="input__label"
                    >Country</label
                  >
                </div>

                <div
                  id="address-8302380974301-province-container"
                  class="input"
                  hidden
                >
                  <div class="select-wrapper is-filled">
                    <select
                      class="select"
                      name="update_province"
                      id="address-8302380974301[province]"
                      data-default="<?php echo $row['state']; ?>"
                    ></select
                    ><svg
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
                      ></path>
                    </svg>
                  </div>

                  <label
                    for="address-8302380974301[province]"
                    class="input__label"
                    >Province</label
                  >
                </div>
                <div class="input input--checkbox">
                  <div class="checkbox-container">
                    <input
                      type="checkbox"
                      class="checkbox"
                      id="address-8302380974301[default]"
                      name="address[default]"
                      value="1"
                      checked
                    />
                    <label
                      for="address-8302380974301[default]"
                      class="text--subdued"
                      >Set as default</label
                    >
                  </div>
                </div>

                <button
                  type="submit"
                  name="edit_address"
                  is="loader-button"
                  class="form__submit button button--primary button--full"
                >
                  Save
                </button>
                <input type="hidden" name="_method" value="put" />
              </form>
            </div>
          </drawer-content>
        </section>
      </div>
      <div
        id="shopify-section-static-newsletter"
        class="shopify-section shopify-section--newsletter"
      ></div>
      <div
        id="shopify-section-static-text-with-icons"
        class="shopify-section shopify-section--text-with-icons"
      >
        <style>
          #shopify-section-static-text-with-icons {
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
                            fill="#ee3d63"
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
                            fill="#ee3d63"
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
                            fill="#ee3d63"
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
    >
      <script>
        var wsShop = "peachm.myshopify.com";
        window.wscc_markets = [];

        window.wscc_markets = [];

        window.wscc_markets.push({
          country_code: "AU",
          country: "Australia",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "AT",
          country: "Austria",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "BE",
          country: "Belgium",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "CA",
          country: "Canada",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "CZ",
          country: "Czechia",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "DK",
          country: "Denmark",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "FJ",
          country: "Fiji",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "FI",
          country: "Finland",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "FR",
          country: "France",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "DE",
          country: "Germany",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "HK",
          country: "Hong Kong SAR",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "IN",
          country: "India",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "IE",
          country: "Ireland",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "IL",
          country: "Israel",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "IT",
          country: "Italy",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "JP",
          country: "Japan",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "KW",
          country: "Kuwait",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "MY",
          country: "Malaysia",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "MU",
          country: "Mauritius",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "NL",
          country: "Netherlands",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "NZ",
          country: "New Zealand",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "NO",
          country: "Norway",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "PL",
          country: "Poland",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "PT",
          country: "Portugal",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "SA",
          country: "Saudi Arabia",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "SG",
          country: "Singapore",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "ZA",
          country: "South Africa",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "KR",
          country: "South Korea",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "ES",
          country: "Spain",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "LK",
          country: "Sri Lanka",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "SE",
          country: "Sweden",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "CH",
          country: "Switzerland",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "AE",
          country: "United Arab Emirates",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "GB",
          country: "United Kingdom",
          currency_code: "INR",
          symbol: "₹",
        });

        window.wscc_markets.push({
          country_code: "US",
          country: "United States",
          currency_code: "INR",
          symbol: "₹",
        });
      </script>
    </div>
  </body>
</html>
