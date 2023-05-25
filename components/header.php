<?php 
include("connection.php");
?>

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
      ></cart-notification>