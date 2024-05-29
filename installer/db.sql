-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2024 at 07:55 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saas_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` int(11) NOT NULL,
  `app` enum('driver','parent','employee') NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT 'uploads/img/product_placeholder.png',
  `status` varchar(2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `builder_blocks`
--

CREATE TABLE `builder_blocks` (
  `id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `template` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `builder_blocks`
--

INSERT INTO `builder_blocks` (`id`, `content`, `category`, `template`, `created_by`, `created_at`, `updated_at`) VALUES
(2, '\r\n\r\n<section id=\"home-slide\" style=\"max-height: 600px;\"class=\"pt-2 lg:pb-10 lg:mb-20 w-full\">\r\n    <div  class=\"overflow-hidden lg:flex xl:flex hidden w-full absolute top-0\"><div class=\"w-full \"></div><div class=\"w-full h-screen red-gradient\"></div></div>\r\n\r\n    <div  class=\"relative w-full\">\r\n\r\n    \r\n        <div class=\"container mx-auto lg:flex xl:flex gap-4 pt-10\">\r\n            <div class=\"lg:w-[46%] w-full lg:py-20 py-4 lg:px-0 px-4 text-start \">\r\n                <h1 class=\"lg:text-6xl text-4xl\">Crafted for <span>Comfort</span>, Designed for <span>You</span></h1>\r\n                <p class=\"pt-4 lg:pr-20 \">From timeless classics to contemporary marvels, find the perfect balance of form and function to suit your unique taste and lifestyle.</p>\r\n            </div>\r\n            <div class=\"lg:w-[60%] w-full lg:px-0 px-4\">\r\n                <h1 class=\"text-6xl\"><img src=\"/src/front_assets/img/slide1.png\" /></h1>\r\n            </div>\r\n        </div>\r\n\r\n        <div class=\"absolute w-full bottom-0 hidden lg:block\">\r\n            <div class=\"container mx-auto flex gap-4 pt-10\">\r\n                <div class=\"rounded-full shadow-xl w-full bg-white flex px-10 py-4 gap-10\">\r\n                    <div class=\"\">\r\n                        <span>Comfort</span>\r\n                        <div class=\"pt-2 flex gap-2\"> <img src=\"/src/front_assets/svg/comfort.svg\" /><span class=\"text-gray-600 text-md\">Cozy Seating</span></div>\r\n                    </div>\r\n                    <div class=\"\"> \r\n                        <span>Quality Assurance</span>\r\n                        <div class=\"pt-2 flex gap-2\"> <img src=\"/src/front_assets/svg/like.svg\" /><span class=\"text-gray-600 text-sm\">Cozy Seating</span></div>\r\n                    </div>\r\n                    <div class=\"\">\r\n                        <span>Free Shipping</span>\r\n                        <div class=\"pt-2 flex gap-2\"> <img src=\"/src/front_assets/svg/package.svg\" /><span class=\"text-gray-600 text-sm\">No-Cost Delivery</span></div>\r\n                    </div>\r\n                    <div class=\"\">\r\n                        <span>Secure Checkout</span>\r\n                        <div class=\"pt-2 flex gap-2\"> <img src=\"/src/front_assets/svg/secure.svg\" /><span class=\"text-gray-600 text-sm\">Secure Payments</span></div>\r\n                    </div>\r\n                    <div class=\" pt-4\">\r\n                        <a href=\"#\" class=\"border border-1 rounded-full px-6 py-2 border-gray-600\">Comfort</a>\r\n                    </div>\r\n                </div>\r\n                <div class=\"lg:w-[15%]\"></div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>\r\n\r\n', 'Components', NULL, 0, '2024-03-06 06:01:09', '2024-03-09 11:32:26'),
(3, '\r\n\r\n    <section id=\"section-gallery\" class=\"w-full relative\">\r\n        <div  class=\"w-full absolute lg:block hidden left-0\">\r\n            <div class=\"w-[30%] cyan-gradient text-right p-10 h-full absolute left-0 top-o\"></div>\r\n            <div class=\"container mx-auto py-4 \">\r\n                <p class=\"text-xl text-gray-800 \">On Sale</p>\r\n                <p class=\"text-4xl text-gray-800 font-bold\">Up To</p>\r\n                <p class=\"text-4xl text-black font-bold\">20% OFF</p>\r\n                <hr class=\"w-40 border-red-600 absolute bottom-[-15px]\" />\r\n            </div>\r\n        </div>\r\n        <div class=\"container mx-auto flex gap-4    \">\r\n            <div class=\"w-96 lg:block hidden\"></div>\r\n            <div class=\"w-full rtl px-4 lg:px-0 py-10\">\r\n                <div class=\" mb-6 relative  \">\r\n                    <img class=\"\" src=\"/src/front_assets/img/gallery-item-1.png\" /> \r\n                    <span class=\"bg-white px-6 py-4 absolute bottom-0 right-0 text-xl\">Accessories</span>\r\n                </div>\r\n                <div class=\" mb-6 relative\">\r\n                    <img class=\"\" src=\"/src/front_assets/img/gallery-item-3.png\" /> \r\n                    <span class=\"bg-white px-6 py-4 absolute top-0 left-0 text-xl\">Accessories</span>\r\n                </div>\r\n                <div class=\" mb-6 relative\">\r\n                    <img class=\"\" src=\"/src/front_assets/img/gallery-item-5.png\" /> \r\n                    <span class=\"bg-white px-6 py-4 absolute top-0 right-0 text-xl\">Accessories</span>\r\n                </div>\r\n            </div>\r\n            <div class=\"w-full\">\r\n                <div class=\"pt-[50%] mb-6 relative\">\r\n                    <img  src=\"/src/front_assets/img/gallery-item-2.png\" /> \r\n                    <span class=\"bg-white px-6 py-4 absolute bottom-0 left-0 text-xl\">Accessories</span>\r\n                </div>\r\n                <div class=\" mb-6 relative\">\r\n                    <img class=\"\" src=\"/src/front_assets/img/gallery-item-4.png\" /> \r\n                    <span class=\"bg-white px-6 py-4 absolute bottom-0 left-0 text-xl\">Accessories</span>\r\n                </div>\r\n                <div class=\" mb-6 relative\">\r\n                    <img class=\"\" src=\"/src/front_assets/img/gallery-item-6.png\" /> \r\n                    <span class=\"bg-white px-6 py-4 absolute bottom-0 left-0 text-xl\">Accessories</span>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </section>\r\n\r\n', 'Components', NULL, 0, '2024-03-06 06:01:45', '2024-03-06 06:01:45'),
(4, '\n\n    <section id=\"main-benifits\" class=\"pt-20 lg:px-0 px-4\">\n        <div class=\"container mx-auto\">\n            <div class=\"lg:flex w-full text-center lg:text-left\">\n                <div class=\"lg:w-64\">\n                    <span class=\"text-red-400\">Benifits</span>\n                    <h3 class=\"text-2xl py-2 \">Benefits when using our services</h3>\n                </div>\n                <div class=\"w-[50%]\"></div>\n                <div class=\"lg:w-96 text-gray-600\">\n                    <p>Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non purus parturient.</p>\n                </div>\n            </div>\n            <div class=\"lg:flex gap-20 py-10\">\n                <div class=\"mb-20 shadow-lg hover:text-red-600 bg-white px-8 py-10 rounded-2xl\">\n                    <img src=\"/src/front_assets//svg/choices.svg\" class=\"p-3 bg-gray-200 rounded-full my-1\" />\n                    <h4 class=\"text-lg mb-2 mt-4\">Many Choices</h4>\n                    <p class=\"text-gray-600\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non.</p>\n                </div>\n                <div class=\"mb-20 shadow-lg hover:text-red-600 bg-white px-8 py-10 rounded-2xl\">\n                    <img src=\"/src/front_assets//svg/choices.svg\" class=\"p-3 bg-gray-200 rounded-full my-1\" />\n                    <h4 class=\"text-lg mb-2 mt-4\">Fast and On Time</h4>\n                    <p class=\"text-gray-600\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non.</p>\n                </div>\n                <div class=\"mb-20 shadow-lg hover:text-red-600 bg-white px-8 py-10 rounded-2xl\">\n                    <img src=\"/src/front_assets//svg/choices.svg\" class=\"p-3 bg-gray-200 rounded-full my-1\" />\n                    <h4 class=\"mb-2 mt-4\">Affordable Price</h4>\n                    <p class=\"text-gray-600\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non.</p>\n                </div>\n            </div>\n\n        </div>\n    </section>\n    ', 'Components', NULL, 0, '2024-03-06 06:01:58', '2024-05-13 04:03:52'),
(9, '<div id=\"main-center1\" class=\"relative lg:py-10\">\r\n        <div style=\"max-height: 500px;\" class=\"hidden lg:block w-1/2 absolute overflow-hidden\"><img class=\"w-full\" src=\"/src/front_assets/img/center-1.png\" /></div>\r\n        <div class=\"container mx-auto lg:flex \">\r\n            <div class=\"w-full\"></div>\r\n            <div class=\"w-full pt-4 pb-10 px-10\">\r\n                <div class=\"flex w-full pb-6\">\r\n                    <h3 class=\"text-2xl w-full\"><span class=\"\">Home</span> Most-popular</h3>\r\n                    <a class=\"flex-end bg-gray-200 py-2 w-40 text-center hover:bg-red-200\" href=\"#\">View more</a>\r\n                </div>\r\n                <div class=\"flex gap-4\">\r\n                    <div class=\"text-center\">\r\n                        <img src=\"/src/front_assets/img/section-product-1.png\" />\r\n                        <div class=\"text-center py-2\">\r\n                            <h4><a class=\"text-xl\" href=\"#\">Body Spray</a></h4>\r\n                            <p><del>120$</del><span>99$</span></p>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"text-center\">\r\n                        <img src=\"/src/front_assets/img/section-product-2.png\" />\r\n                        <div class=\"text-center py-2\">\r\n                            <h4><a class=\"text-xl\" href=\"#\">Body Spray</a></h4>\r\n                            <p><del>120$</del><span>99$</span></p>\r\n                        </div>\r\n                    </div>\r\n\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>', 'Components', NULL, 0, '2024-03-06 06:06:04', '2024-03-06 06:06:04'),
(10, '<div id=\"main-center2\" class=\"relative lg:py-10\">\r\n        <div style=\"max-height: 500px;\" class=\"hidden lg:block w-1/2 absolute overflow-hidden right-0\"><img class=\"w-full\" src=\"/src/front_assets/img/center-2.png\" /></div>\r\n        <div class=\"container mx-auto lg:flex \">\r\n            <div class=\"w-full pt-4 pb-10 px-10\">\r\n                <div class=\"flex w-full pb-6\">\r\n                    <h3 class=\"text-2xl w-full\"><span class=\"\">Office</span> Most-popular</h3>\r\n                    <a class=\"flex-end bg-gray-200 py-2 w-40 text-center hover:bg-red-200\" href=\"#\">View more</a>\r\n                </div>\r\n                <div class=\"flex gap-4\">\r\n                    <div class=\"text-center\">\r\n                        <img src=\"/src/front_assets/img/section2-product-1.png\" />\r\n                        <div class=\"text-center py-2\">\r\n                            <h4><a class=\"text-xl\" href=\"#\">Body Spray</a></h4>\r\n                            <p><del>120$</del><span>99$</span></p>\r\n                        </div>\r\n                    </div>\r\n                    <div class=\"text-center\">\r\n                        <img src=\"/src/front_assets/img/section2-product-2.png\" />\r\n                        <div class=\"text-center py-2\">\r\n                            <h4><a class=\"text-xl\" href=\"#\">Body Spray</a></h4>\r\n                            <p><del>120$</del><span>99$</span></p>\r\n                        </div>\r\n                    </div>\r\n\r\n                </div>\r\n            </div>\r\n            <div class=\"w-full\"></div>\r\n        </div>\r\n    </div>', 'Components', NULL, 0, '2024-03-06 06:06:13', '2024-03-06 06:06:13'),
(11, '<div id=\"main-testimonials\" class=\"overflow-hidden\">\r\n        <div class=\"text-center pt-10\">\r\n            <span class=\"text-red-400\">Testimonials</span>\r\n            <h4 class=\"text-2xl py-2\">What our customer say</h4>\r\n            <p class=\"max-w-lg mx-auto\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non purus parturient.</p>\r\n        </div>\r\n\r\n        <div class=\"pb-20 pt-10 lg:flex lg:mx-[-40px] gap-12 lg:px-0 px-4\">\r\n            \r\n            <div class=\"shadow-lg bg-white px-8 py-10 rounded-2xl mb-10\">\r\n                <img src=\"/src/front_assets//svg/testimonial.svg\" class=\"rounded-full my-1 w-10\" />\r\n                <p class=\"py-4\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non.</p>\r\n                <div class=\"flex w-full\">\r\n                    <div class=\"flex gap-4 w-full\">\r\n                        <img src=\"/src/front_assets/img/profile-1.png\" class=\"w-12 h-12 rounded-full\" />\r\n                        <span class=\"py-4\">Janne Cooper</span>\r\n                    </div>\r\n                    <div class=\"flex-end  w-full text-end\">\r\n                        <div class=\"flex gap-4 float-right\">\r\n                            <img src=\"/src/front_assets/svg/rating.svg\" />\r\n                            <span class=\"py-4\">4.3</span>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            \r\n            <div class=\"shadow-lg bg-white px-8 py-10 rounded-2xl mb-10\">\r\n                <img src=\"/src/front_assets//svg/testimonial.svg\" class=\"rounded-full my-1 w-10\" />\r\n                <p class=\"py-4\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non.</p>\r\n                <div class=\"flex w-full\">\r\n                    <div class=\"flex gap-4 w-full\">\r\n                        <img src=\"/src/front_assets/img/profile-1.png\" class=\"w-12 h-12 rounded-full\" />\r\n                        <span class=\"py-4\">Janne Cooper</span>\r\n                    </div>\r\n                    <div class=\"flex-end  w-full text-end\">\r\n                        <div class=\"flex gap-4 float-right\">\r\n                            <img src=\"/src/front_assets/svg/rating.svg\" />\r\n                            <span class=\"py-4\">4.3</span>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            \r\n            <div class=\"shadow-lg bg-white px-8 py-10 rounded-2xl mb-10\">\r\n                <img src=\"/src/front_assets//svg/testimonial.svg\" class=\"rounded-full my-1 w-10\" />\r\n                <p class=\"py-4\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non.</p>\r\n                <div class=\"flex w-full\">\r\n                    <div class=\"flex gap-4 w-full\">\r\n                        <img src=\"/src/front_assets/img/profile-1.png\" class=\"w-12 h-12 rounded-full\" />\r\n                        <span class=\"py-4\">Janne Cooper</span>\r\n                    </div>\r\n                    <div class=\"flex-end  w-full text-end\">\r\n                        <div class=\"flex gap-4 float-right\">\r\n                            <img src=\"/src/front_assets/svg/rating.svg\" />\r\n                            <span class=\"py-4\">4.3</span>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n', 'Components', NULL, 0, '2024-03-06 06:06:22', '2024-03-06 06:06:22'),
(12, '<div id=\"main-newsletter\" class=\"relative overflow-hidden mb-2\">\r\n        <img src=\"/src/front_assets/img/newsletter-bg.png\" class=\"w-full absolute\" />\r\n        <div class=\"lg:flex w-full relative\">\r\n            <div class=\"w-1/2\"></div>\r\n            <div class=\"lg:w-1/2 w-full text-white px-2 lg:px-0\">\r\n                <h5 class=\"text-xl lg:text-4xl lg:w-96 lg:pt-20 pt-2\">Get more discount  Off your order</h5>\r\n                <p class=\"pt-2\">Join our mailing list</p>\r\n                <div class=\"flex gap-4 lg:py-10 py-2\">\r\n                    <input class=\"bg-white rounded-lg lg:py-4 py-2 px-4 lg:px-6\" placeholder=\"Your email address\" />\r\n                    <button type=\"submit\" class=\" bg-red-600 text-white rounded-lg px-4 lg:px-6 lg:py-4 py-2  border-0\" value=\"send\" >Send now</button>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>', 'Components', NULL, 0, '2024-03-06 06:06:33', '2024-03-06 06:06:33'),
(13, '<section class=\"tc-popular-cat-style1 pt-30 pb-50\">\n    <div class=\"container\">\n        <div class=\"search-cat d-block d-lg-none\">\n            <div class=\"input-group\">\n                <select name=\"name\"  class=\"form-select\">\n                    <option value=\"\"> All Categories </option>\n                    <option value=\"\"> Categories 1 </option>\n                    <option value=\"\"> Categories 2 </option>\n                </select>\n                <input type=\"text\" class=\"form-control\" placeholder=\"Search anything...\">\n                <a href=\"#\" class=\"search-btn\"> <i class=\"fal fa-search\"></i> </a>\n            </div>\n        </div>\n        <div class=\"sec-title\">\n            <div class=\"row align-items-center\">\n                <div class=\"col-lg-6\">\n                    <h3 class=\"fsz-24 text-capitalize\"> Popular Categories </h3>\n                </div>\n                <div class=\"col-lg-6 text-lg-end mt-4 mt-lg-0\">\n                    <a href=\"#0\" class=\"more-link text-capitalize\"> View All <i class=\"la la-angle-right ms-1\"></i> </a>\n                </div>\n            </div>\n        </div>\n        <div class=\"cat-content\">\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat1.png\" alt=\"\">\n                </span>\n                <strong class=\"block fsz-13 fw-bold mt-15\"> Gaming </strong>\n            </a></div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat2.png\" alt=\"\">\n                </span>\n                <strong class=\"block fsz-13 fw-bold mt-15\"> Sport Equip </strong>\n            </a></div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat3.png\" alt=\"\">\n                </span>\n                <strong class=\"block fsz-13 fw-bold mt-15\"> Kitchen </strong>\n            </a></div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat4.png\" alt=\"\">\n                </span>\n                <strong class=\"block fsz-13 fw-bold mt-15\"> Robot Cleaner </strong>\n            </a></div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat5.png\" alt=\"\">\n                </span>\n                <strong class=\"block fsz-13 fw-bold mt-15\"> Mobiles </strong>\n            </a></div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat6.png\" alt=\"\">\n                </span>\n                <strong class=\"block fsz-13 fw-bold mt-15\"> Office </strong>\n            </a></div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat7.png\" alt=\"\">\n                </span>\n                <strong class=\"block fsz-13 fw-bold mt-15\"> Cameras </strong>\n            </a></div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat8.png\" alt=\"\">\n                </span>\n                <strong class=\"block fsz-13 fw-bold mt-15\"> Computers </strong>\n            </a></div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat9.png\" alt=\"\">\n                </span>\n                <strong class=\"block fsz-13 fw-bold mt-15\"> Televisions </strong>\n            </a></div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat10.png\" alt=\"\">\n                </span>\n                <strong class=\"block fsz-13 fw-bold mt-15\"> Audios </strong>\n            </a></div>\n        </div>\n    </div>\n</section>\n<!--  End popular cat  -->\n', 'Widgets', NULL, 0, '2024-05-13 01:32:07', '2024-05-13 04:04:03'),
(14, '<section class=\"tc-header-style1\">                  <div class=\"container\">                      <div class=\"content\">                          <div class=\"row\">                              <div class=\"col-lg-8\">                                  <div class=\"main-slider\">                                      <div class=\"swiper-wrapper\">                                          <div class=\"swiper-slide\">                                              <div class=\"slide-card\">                                                  <div class=\"img th-450\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/head/head_1.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <div class=\"info text-white\">                                                      <div class=\"cont\">                                                          <h2 class=\"fsz-35 fw-200\"> EKO 40\" <br> Android TV </h2>                                                          <p class=\"fsz-12 mt-15 text-uppercase\"> Smart Full HD Android TV  with Google Assistant  </p>                                                          <a href=\"../inner_pages/single_product.html\" class=\"butn px-5 py-3 bg-blue1 text-white rounded-pill mt-60 fw-600\"> <span> Shop Now </span> </a>                                                      </div>                                                  </div>                                              </div>                                          </div>                                          <div class=\"swiper-slide\">                                              <div class=\"slide-card\">                                                  <div class=\"img th-450\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/head/head_1.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <div class=\"info text-white\">                                                      <div class=\"cont\">                                                          <h2 class=\"fsz-35 fw-200\"> EKO 40\" <br> Android TV </h2>                                                          <p class=\"fsz-12 mt-15 text-uppercase\"> Smart Full HD Android TV  with Google Assistant  </p>                                                          <a href=\"../inner_pages/single_product.html\" class=\"butn px-5 py-3 bg-blue1 text-white rounded-pill mt-60 fw-600\"> <span> Shop Now </span> </a>                                                      </div>                                                  </div>                                              </div>                                          </div>                                      </div>                                      <div class=\"slider-controls\">                                          <div class=\"swiper-button-prev\"></div>                                          <div class=\"swiper-pagination\"></div>                                          <div class=\"swiper-button-next\"></div>                                      </div>                                  </div>                              </div>                              <div class=\"col-lg-4\">                                  <div class=\"card-overlay card-center\">                                      <div class=\"img th-450\">                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/head/head_2.png\" alt=\"\" class=\"img-cover\">                                      </div>                                      <div class=\"info text-white p-50\">                                          <div class=\"cont\">                                              <h3 class=\"fsz-30\"> Humidifying Fan </h3>                                              <p class=\"fsz-13 mt-1\"> From $299  </p>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"butn px-5 py-3 bg-white color-000 rounded-pill fw-600\"> <span> Discover Now </span> </a>                                      </div>                                  </div>                              </div>                              <div class=\"col-lg-6\">                                  <div class=\"card-overlay wow fadeInUp slow\" data-wow-delay=\"0.2s\">                                      <div class=\"img th-230\">                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/head/head_3.png\" alt=\"\" class=\"img-cover\">                                      </div>                                      <div class=\"info color-000 p-30\">                                          <div class=\"cont\">                                              <h3 class=\"fsz-30\"> iPad mini <br> 2022 </h3>                                              <p class=\"fsz-13 mt-1 color-666\"> Mega Power in mini size  </p>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"butn px-4 py-2 bg-dark text-white rounded-pill fw-600 fsz-12 mt-30\"> <span> Shop Now </span> </a>                                      </div>                                  </div>                              </div>                              <div class=\"col-lg-3\">                                  <div class=\"card-overlay wow fadeInUp slow\" data-wow-delay=\"0.4s\">                                      <div class=\"img th-230\">                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/head/head_4.png\" alt=\"\" class=\"img-cover\">                                      </div>                                      <div class=\"info text-white p-30\">                                          <div class=\"cont\">                                              <h6 class=\"fsz-20\"> Air <br> Purifier </h6>                                              <small class=\"fsz-10 color-999 d-block text-uppercase mt-2\"> from </small>                                              <p class=\"fsz-20 color-lightGreen\"> $169  </p>                                          </div>                                      </div>                                  </div>                              </div>                              <div class=\"col-lg-3\">                                  <div class=\"card-overlay wow fadeInUp slow\" data-wow-delay=\"0.6s\">                                      <div class=\"img th-230\">                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/head/head_5.png\" alt=\"\" class=\"img-cover\">                                      </div>                                      <div class=\"info text-white p-30\">                                          <div class=\"cont\">                                              <small class=\"fsz-10 d-block text-uppercase mb-2\"> washing machine </small>                                              <h6 class=\"fsz-20\"> Anatico <br> Max 2 </h6>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"butn px-4 py-2 bg-white color-000 rounded-pill fw-600 fsz-12 mt-50\"> <span> Shop Now </span> </a>                                      </div>                                  </div>                              </div>                          </div>                      </div>                  </div>              </section>', 'Widgets', NULL, 0, '2024-05-13 01:32:07', '2024-05-13 01:32:07');
INSERT INTO `builder_blocks` (`id`, `content`, `category`, `template`, `created_by`, `created_at`, `updated_at`) VALUES
(15, '<section class=\"tc-weekly-deals-style1 wow fadeInUp slow\" data-wow-delay=\"0.2s\">              <div class=\"container\">                  <div class=\"content\">                      <div class=\"title mb-40\">                          <h3 class=\"fsz-30 me-lg-5\"> Best Weekly Deals </h3>                          <div class=\"countdown bg-red1 text-white\">                              <span class=\"icon me-2\"> <i class=\"las la-hourglass-half\"></i> </span>                               <p class=\"me-2\"> Expires in: </p>                              <div class=\"item\">                                  <span id=\"days\"></span>                                  <span> d </span>                              </div>                              <span> : </span>                              <div class=\"item\">                                  <span id=\"hours\"></span>                                  <span> h </span>                              </div>                              <span> : </span>                              <div class=\"item\">                                  <span id=\"minutes\"></span>                                  <span> m </span>                              </div>                              <span> : </span>                              <div class=\"item\">                                  <span id=\"seconds\"></span>                                  <span> s </span>                              </div>                          </div>                          <!-- <div class=\"arrows ms-auto\">                               <a href=\"#0\" class=\"swiper-prev\"> <i class=\"fal fa-chevron-left\"></i> </a>                                  <a href=\"#0\" class=\"swiper-next ms-lg-1\"> <i class=\"fal fa-chevron-right\"></i> </a>                              </div> -->                      </div>                      <div class=\"deals-cards\">                          <div class=\"column-sm\">                              <div class=\"deal-card\">                                  <div class=\"top\">                                      <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav active\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod1.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-140 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod1.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 15% OFF </span>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Air Purifier with <br> True HEPA H14 Filter </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star\"></i>                                          <span> (5) </span>                                      </div>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $489.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $619.00 </span> </p>                                      <div class=\"progress mt-20\">                                          <div class=\"progress-bar bg-blue1\" role=\"progressbar\" style=\"width: 25%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>                                      </div>                                      <p class=\"fsz-12 mt-3\"> Sold: 24 / 80 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"deal-card\">                                  <div class=\"top\">                                      <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav active\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod2.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-140 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod2.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white\"> 5% OFF </span>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Shaork Robot Vacuum with Self-Empty Base </a>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $325.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $428.00 </span> </p>                                      <div class=\"progress mt-20\">                                          <div class=\"progress-bar bg-blue1\" role=\"progressbar\" style=\"width: 5%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>                                      </div>                                      <p class=\"fsz-12 mt-3\"> Sold: 1 / 19 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                          </div>                          <div class=\"column-lg\">                              <div class=\"deal-card\">                                  <div class=\"top\">                                      <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav active\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod3.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-600 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod3.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 15% OFF </span>                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Durotan Manual Espresso Machine, Latte, Cappuccino Maker & Espresso Machine. </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <span> (34) </span>                                      </div>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $489.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $619.00 </span> </p>                                      <div class=\"progress mt-20\">                                          <div class=\"progress-bar bg-blue1\" role=\"progressbar\" style=\"width: 90%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>                                      </div>                                      <p class=\"fsz-12 mt-3\"> Sold: 82 / 100 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                          </div>                          <div class=\"column-sm\">                              <div class=\"deal-card\">                                  <div class=\"top\">                                      <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav active\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod4.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-140 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod4.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 15% OFF </span>                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-green1 text-white text-uppercase\"> top rated </span>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Sona QLED Ultra HD 4k Smart Android TV 59’ </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <span> (2) </span>                                      </div>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $1,759.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $2,069.00 </span> </p>                                      <div class=\"progress mt-20\">                                          <div class=\"progress-bar bg-blue1\" role=\"progressbar\" style=\"width: 8%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>                                      </div>                                      <p class=\"fsz-12 mt-3\"> Sold: 7 / 85 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"deal-card\">                                  <div class=\"top\">                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav active\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod5.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-140 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod5.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white\"> pre-order </span>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Shaork Robot Vacuum with Self-Empty Base </a>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $325.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $428.00 </span> </p>                                      <div class=\"progress mt-20\">                                          <div class=\"progress-bar bg-blue1\" role=\"progressbar\" style=\"width: 5%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>                                      </div>                                      <p class=\"fsz-12 mt-3\"> Sold: 1 / 19 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                          </div>                          <div class=\"column-sm\">                              <div class=\"deal-card\">                                  <div class=\"top\">                                      <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav active\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod6.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-140 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod6.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 15% OFF </span>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Air Purifier with <br> True HEPA H14 Filter </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star\"></i>                                          <span> (5) </span>                                      </div>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $489.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $619.00 </span> </p>                                      <div class=\"progress mt-20\">                                          <div class=\"progress-bar bg-blue1\" role=\"progressbar\" style=\"width: 25%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>                                      </div>                                      <p class=\"fsz-12 mt-3\"> Sold: 24 / 80 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"deal-card\">                                  <div class=\"top\">                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav active\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod7.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-140 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod7.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white\"> 5% OFF </span>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Shaork Robot Vacuum with Self-Empty Base </a>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $325.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $428.00 </span> </p>                                      <div class=\"progress mt-20\">                                          <div class=\"progress-bar bg-blue1\" role=\"progressbar\" style=\"width: 5%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>                                      </div>                                      <p class=\"fsz-12 mt-3\"> Sold: 1 / 19 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                          </div>                      </div>                      <div class=\"text-center mt-30\">                          <a href=\"../inner_pages/products.html\" class=\"butn px-5 py-3 bg-white color-000 rounded-pill fw-600\"> <span> See All Products (63) </span> </a>                      </div>                  </div>              </div>          </section>', 'Widgets', NULL, 0, '2024-05-13 01:32:07', '2024-05-13 01:32:07'),
(16, '<section class=\"tc-trend-search-style1 wow fadeInUp slow\" data-wow-delay=\"0.2s\">              <div class=\"container\">                  <h3 class=\"fsz-30 mb-30\"> Trending Search </h3>                  <div class=\"links\">                      <a href=\"../inner_pages/products.html\" class=\"link\"> Vacuum Robot </a>                      <a href=\"../inner_pages/products.html\" class=\"link\"> Bluetooth Speaker </a>                      <a href=\"../inner_pages/products.html\" class=\"link\"> Oled TV </a>                      <a href=\"../inner_pages/products.html\" class=\"link\"> Security Camera </a>                      <a href=\"../inner_pages/products.html\" class=\"link\"> Macbook M1 </a>                      <a href=\"../inner_pages/products.html\" class=\"link\"> Smart Washing Machine </a>                      <a href=\"../inner_pages/products.html\" class=\"link\"> iPad Mini 2023 </a>                      <a href=\"../inner_pages/products.html\" class=\"link\"> PS5 </a>                      <a href=\"../inner_pages/products.html\" class=\"link\"> Earbuds </a>                      <a href=\"../inner_pages/products.html\" class=\"link\"> Air Condition Inverter </a>                      <a href=\"../inner_pages/products.html\" class=\"link\"> Flycam </a>                      <a href=\"../inner_pages/products.html\" class=\"link\"> Electric Bike </a>                      <a href=\"../inner_pages/products.html\" class=\"link\"> Gaming Computer </a>                      <a href=\"../inner_pages/products.html\" class=\"link\"> Smart Air Purifier </a>                      <a href=\"../inner_pages/products.html\" class=\"link\"> Apple Watch </a>                  </div>              </div>          </section>', 'Widgets', NULL, 0, '2024-05-13 01:32:07', '2024-05-13 01:32:07'),
(17, '<section class=\"tc-main-banner-style1 wow fadeInUp slow\" data-wow-delay=\"0.2s\">              <div class=\"container\">                  <div class=\"banner\">                      <div class=\"row align-items-center\">                          <div class=\"col-lg-2\">                              <h6 class=\"fsz-24 text-uppercase color-cyan1 lh-1\"> Pre Order </h6>                              <small class=\"fsz-10 color-999 text-uppercase\"> be the first to own </small>                              <p class=\"fsz-14 mt-2 text-white\"> From $399 </p>                          </div>                          <div class=\"col-lg-4 order-last order-lg-0\">                              <div class=\"img\">                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/banner.png\" alt=\"\">                              </div>                          </div>                          <div class=\"col-lg-4 mt-3 mt-lg-0\">                              <small class=\"fsz-12 color-cyan1\"> Opplo Watch Sport <br> Series 8 </small>                              <h3 class=\"fsz-30 mt-10 fw-300 text-white\"> A healthy leap ahead </h3>                          </div>                          <div class=\"col-lg-2 mt-4 mt-lg-0\">                              <div class=\"text-lg-end\">                                  <a href=\"../inner_pages/single_product.html\" class=\"butn px-4 pt-10 pb-10 bg-white color-000 rounded-pill fw-600\"> <span> Discover Now </span> </a>                              </div>                          </div>                      </div>                  </div>              </div>          </section>', 'Widgets', NULL, 0, '2024-05-13 01:32:07', '2024-05-13 01:32:07');
INSERT INTO `builder_blocks` (`id`, `content`, `category`, `template`, `created_by`, `created_at`, `updated_at`) VALUES
(18, '<section class=\"tc-best-seller-style1 wow fadeInUp slow\" data-wow-delay=\"0.2s\">              <div class=\"container\">                  <div class=\"title mb-40\">                      <div class=\"row align-items-center\">                          <div class=\"col-lg-8\">                              <h3 class=\"fsz-30\"> Best Seller </h3>                          </div>                          <div class=\"col-lg-4 text-lg-end mt-4 mt-lg-0\">                              <a href=\"../inner_pages/products.html\" class=\"more-btn fsz-14 text-uppercase fw-500\"> View All <i class=\"fal fa-angle-right ms-1\"></i> </a>                          </div>                      </div>                  </div>                  <ul class=\"nav nav-pills mb-40\" id=\"pills-tabs\" role=\"tablist\">                      <li class=\"nav-item\" role=\"presentation\">                        <button class=\"nav-link active\" id=\"pills-tab1-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab1\" type=\"button\" role=\"tab\" aria-selected=\"true\">Top 30</button>                      </li>                      <li class=\"nav-item\" role=\"presentation\">                        <button class=\"nav-link\" id=\"pills-tab2-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab2\" type=\"button\" role=\"tab\" aria-selected=\"false\">Televisions</button>                      </li>                      <li class=\"nav-item\" role=\"presentation\">                        <button class=\"nav-link\" id=\"pills-tab3-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab1\" type=\"button\" role=\"tab\" aria-selected=\"false\">PC Gaming</button>                      </li>                      <li class=\"nav-item\" role=\"presentation\">                          <button class=\"nav-link\" id=\"pills-tab4-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab2\" type=\"button\" role=\"tab\" aria-selected=\"false\">Computers</button>                        </li>                        <li class=\"nav-item\" role=\"presentation\">                          <button class=\"nav-link\" id=\"pills-tab5-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab1\" type=\"button\" role=\"tab\" aria-selected=\"false\">Cameras</button>                        </li>                        <li class=\"nav-item\" role=\"presentation\">                          <button class=\"nav-link\" id=\"pills-tab6-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab2\" type=\"button\" role=\"tab\" aria-selected=\"false\">Gadgets</button>                        </li>                        <li class=\"nav-item\" role=\"presentation\">                          <button class=\"nav-link\" id=\"pills-tab7-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab1\" type=\"button\" role=\"tab\" aria-selected=\"false\">Smart Home</button>                        </li>                        <li class=\"nav-item\" role=\"presentation\">                          <button class=\"nav-link\" id=\"pills-tab8-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab2\" type=\"button\" role=\"tab\" aria-selected=\"false\">Sport Equipments</button>                        </li>                    </ul>                    <div class=\"tab-content\" id=\"pills-tabContent1\">                      <div class=\"tab-pane fade show active\" id=\"pills-tab1\" role=\"tabpanel\" aria-labelledby=\"pills-tab1-tab\">                          <div class=\"products-slider\">                              <div class=\"swiper-wrapper\">                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod3.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod3.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 15% OFF </span>                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Durotan Manual Espresso Machine, Coffe Maker </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <span> (34) </span>                                              </div>                                              <p class=\"price color-red1 mt-2 fsz-20\"> $489.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $619.00 </span> </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod7.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod7.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 15% OFF </span>                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Conar DSLR Camera EOS II, Only Body </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star\"></i>                                                  <span> (5) </span>                                              </div>                                              <p class=\"price color-red1 mt-2 fsz-20\"> $579.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $819.00 </span> </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod8.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod8.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-cyan1 text-white text-uppercase\"> new </span>                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Shorp 49” Class FHD (1080p) Android Led TV </a>                                              <p class=\"price mt-2 fsz-20\"> $3,029.50 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod9.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod9.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Gigabyte PC Gaming Case, Core i7, 32GB Ram </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <span> (2) </span>                                              </div>                                              <p class=\"price mt-2 fsz-20\"> $1,279.00 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod10.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod10.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-green1 text-white text-uppercase\"> top  rated </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Sceptre 32” Internet TV </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <span> (12) </span>                                              </div>                                              <p class=\"price mt-2 fsz-20\"> $610.00 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod8.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod8.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-cyan1 text-white text-uppercase\"> new </span>                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Shorp 49” Class FHD (1080p) Android Led TV </a>                                              <p class=\"price mt-2 fsz-20\"> $3,029.50 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                              </div>                              <div class=\"slider-controls\">                                  <div class=\"swiper-button-prev\"></div>                                  <div class=\"swiper-pagination\"></div>                                  <div class=\"swiper-button-next\"></div>                              </div>                          </div>                      </div>                      <div class=\"tab-pane fade\" id=\"pills-tab2\" role=\"tabpanel\" aria-labelledby=\"pills-tab2-tab\">                          <div class=\"products-slider\">                              <div class=\"swiper-wrapper\">                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod3.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod3.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 15% OFF </span>                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Durotan Manual Espresso Machine, Coffe Maker </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <span> (34) </span>                                              </div>                                              <p class=\"price color-red1 mt-2 fsz-20\"> $489.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $619.00 </span> </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod7.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod7.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 15% OFF </span>                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Conar DSLR Camera EOS II, Only Body </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star\"></i>                                                  <span> (5) </span>                                              </div>                                              <p class=\"price color-red1 mt-2 fsz-20\"> $579.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $819.00 </span> </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod8.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod8.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-cyan1 text-white text-uppercase\"> new </span>                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Shorp 49” Class FHD (1080p) Android Led TV </a>                                              <p class=\"price mt-2 fsz-20\"> $3,029.50 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod9.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod9.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Gigabyte PC Gaming Case, Core i7, 32GB Ram </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <span> (2) </span>                                              </div>                                              <p class=\"price mt-2 fsz-20\"> $1,279.00 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod10.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod10.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-green1 text-white text-uppercase\"> top  rated </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Sceptre 32” Internet TV </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <span> (12) </span>                                              </div>                                              <p class=\"price mt-2 fsz-20\"> $610.00 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod8.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod8.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-cyan1 text-white text-uppercase\"> new </span>                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Shorp 49” Class FHD (1080p) Android Led TV </a>                                              <p class=\"price mt-2 fsz-20\"> $3,029.50 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                              </div>                              <div class=\"slider-controls\">                                  <div class=\"swiper-button-prev\"></div>                                  <div class=\"swiper-pagination\"></div>                                  <div class=\"swiper-button-next\"></div>                              </div>                          </div>                      </div>                    </div>              </div>          </section>', 'Widgets', NULL, 0, '2024-05-13 01:32:07', '2024-05-13 01:32:07'),
(19, '<section class=\"tc-pupolar-brands-style1 wow fadeInUp slow\" data-wow-delay=\"0.2s\">              <div class=\"container overflow-hidden\">                  <div class=\"content\">                      <div class=\"title mb-40\">                          <div class=\"row align-items-center\">                              <div class=\"col-lg-8\">                                  <h3 class=\"fsz-30\"> Popular Brands </h3>                              </div>                              <div class=\"col-lg-4 text-lg-end mt-4 mt-lg-0\">                                  <a href=\"../inner_pages/products.html\" class=\"more-btn fsz-14 text-uppercase fw-500\"> View All <i class=\"fal fa-angle-right ms-1\"></i> </a>                              </div>                          </div>                      </div>                      <div class=\"pupolar-slider\">                          <div class=\"swiper-wrapper\">                              <div class=\"swiper-slide\">                                  <div class=\"card-overlay\">                                      <div class=\"img th-250\">                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/pup_1.png\" alt=\"\" class=\"img-cover\">                                      </div>                                      <div class=\"info text-white p-30\">                                          <div class=\"cont d-flex align-content-between flex-wrap h-100\">                                              <h6 class=\"fsz-24 fw-300 w-100\"> <strong class=\"fw-600\"> OKODo </strong> <br> hero 11+ <br> black </h6>                                              <div class=\"price\">                                                  <small class=\"fsz-10 color-999 d-block text-uppercase\"> from </small>                                                  <p class=\"fsz-20\"> $169  </p>                                              </div>                                          </div>                                      </div>                                  </div>                              </div>                              <div class=\"swiper-slide\">                                  <div class=\"card-overlay\">                                      <div class=\"img th-250\">                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/pup_2.png\" alt=\"\" class=\"img-cover\">                                      </div>                                      <div class=\"info p-30\">                                          <div class=\"cont d-flex align-content-between flex-wrap h-100\">                                              <div class=\"top\">                                                  <small class=\"fsz-11 ltspc-2 text-uppercase color-666 mb-10\"> Acelos 3d </small>                                                  <h6 class=\"fsz-20 fw-500 w-100\"> VR Headset and <br> Controllers </h6>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"butn px-4 py-2 bg-dark text-white rounded-pill fw-600 fsz-12 mt-30\"> <span> Shop Now </span> </a>                                          </div>                                      </div>                                  </div>                              </div>                              <div class=\"swiper-slide\">                                  <div class=\"card-overlay\">                                      <div class=\"img th-250\">                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/pup_3.png\" alt=\"\" class=\"img-cover\">                                      </div>                                      <div class=\"info text-white p-30\">                                          <div class=\"cont d-flex align-content-between flex-wrap h-100\">                                              <div class=\"top\">                                                  <h6 class=\"fsz-18 fw-500 w-100 text-uppercase\"> massage chair <br> Luxury  </h6>                                                  <small class=\"fsz-12 mt-10\"> Fuka Relax Full Body <br> Massage Chair </small>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"butn px-4 py-2 bg-white color-000 rounded-pill fw-600 fsz-12 mt-30\"> <span> Shop Now </span> </a>                                          </div>                                      </div>                                  </div>                              </div>                          </div>                          <div class=\"swiper-button-next\"></div>                          <div class=\"swiper-button-prev\"></div>                      </div>                  </div>              </div>          </section>', 'Widgets', NULL, 0, '2024-05-13 01:32:07', '2024-05-13 01:32:07');
INSERT INTO `builder_blocks` (`id`, `content`, `category`, `template`, `created_by`, `created_at`, `updated_at`) VALUES
(20, '<section class=\"tc-suggest-today-style1\">              <div class=\"container\">                  <div class=\"title mb-40 wow fadeInUp slow\" data-wow-delay=\"0.2s\">                      <div class=\"row align-items-center\">                          <div class=\"col-lg-8\">                              <h3 class=\"fsz-30\"> Suggest Today </h3>                          </div>                          <div class=\"col-lg-4 text-lg-end mt-4 mt-lg-0\">                              <a href=\"../inner_pages/products.html\" class=\"more-btn fsz-14 text-uppercase fw-500\"> View All <i class=\"fal fa-angle-right ms-1\"></i> </a>                          </div>                      </div>                  </div>                  <ul class=\"nav nav-pills mb-40\" id=\"pills-tabs1\" role=\"tablist\">                      <li class=\"nav-item\" role=\"presentation\">                        <button class=\"nav-link active\" id=\"pills-tab10-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab3\" type=\"button\" role=\"tab\" aria-selected=\"true\"> <i class=\"fal fa-fire me-2\"></i> Recommend For You</button>                      </li>                      <li class=\"nav-item\" role=\"presentation\">                        <button class=\"nav-link\" id=\"pills-tab11-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab4\" type=\"button\" role=\"tab\" aria-selected=\"false\"> <i class=\"fal fa-bolt me-2\"></i> Top Best Seller</button>                      </li>                      <li class=\"nav-item\" role=\"presentation\">                        <button class=\"nav-link\" id=\"pills-tab12-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab3\" type=\"button\" role=\"tab\" aria-selected=\"false\"> <i class=\"fal fa-star me-2\"></i> Top Rated</button>                      </li>                      <li class=\"nav-item\" role=\"presentation\">                          <button class=\"nav-link\" id=\"pills-tab13-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab4\" type=\"button\" role=\"tab\" aria-selected=\"false\">70% OFF</button>                      </li>                      <li class=\"nav-item\" role=\"presentation\">                          <button class=\"nav-link\" id=\"pills-tab14-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab3\" type=\"button\" role=\"tab\" aria-selected=\"false\">50% OFF</button>                      </li>                      <li class=\"nav-item\" role=\"presentation\">                          <button class=\"nav-link\" id=\"pills-tab15-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab4\" type=\"button\" role=\"tab\" aria-selected=\"false\">30% OFF</button>                      </li>                  </ul>                  <div class=\"tab-content wow fadeInUp slow\" data-wow-delay=\"0.2s \" id=\"pills-tabContent2\">                      <div class=\"tab-pane fade show active\" id=\"pills-tab3\" role=\"tabpanel\" aria-labelledby=\"pills-tab3-tab\">                          <div class=\"product-row\">                              <div class=\"product-card\">                                  <div class=\"top\">                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod11.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod11.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> SORE Simply Brew Compact Filter Drip Coffee Maker </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <span> (1) </span>                                      </div>                                      <p class=\"price mt-2 fsz-20\"> $159.00 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"product-card\">                                  <div class=\"top\">                                      <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod12.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod12.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <div class=\"tags\">                                          <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 15% OFF </span>                                          <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                      </div>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Toshubi 2-Door Inveter 1200L Refrigerator </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <span> (2) </span>                                      </div>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $1,259.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $1,469.00 </span> </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"product-card\">                                  <div class=\"top\">                                      <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod13.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod13.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <div class=\"tags\">                                          <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-cyan1 text-white text-uppercase\"> new </span>                                      </div>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Epson Mini Portable Projector Wireless </a>                                      <p class=\"price mt-2 fsz-20\"> $205.00 - $410.00 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"product-card\">                                  <div class=\"top\">                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod14.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod14.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Brone 2021 iMac All-in-one Desktop Computer with M1 </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <span> (2) </span>                                      </div>                                      <p class=\"price mt-2 fsz-20\"> $2,725.00 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"product-card\">                                  <div class=\"top\">                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod15.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod15.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <div class=\"tags\">                                          <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-green1 text-white text-uppercase\"> top  rated </span>                                      </div>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Durotan Manual Espresso Machine, Coffe Maker </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <span> (12) </span>                                      </div>                                      <p class=\"price mt-2 fsz-20\"> $449.00 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"product-card\">                                  <div class=\"top\">                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod16.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod16.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <div class=\"tags\">                                          <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 10% OFF </span>                                      </div>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Name of Product with Lore </a>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $79.50 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $69.00 </span> </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"product-card\">                                  <div class=\"top\">                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod17.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod17.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> aPod LTE+GPS Sliver Grey </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star\"></i>                                          <i class=\"fas fa-star\"></i>                                          <span> (1) </span>                                      </div>                                      <p class=\"price mt-2 fsz-20\"> $524.00 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"product-card\">                                  <div class=\"top\">                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod18.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod18.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Oloxtralic Smart Inveter Washing Machine </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <span> (2) </span>                                      </div>                                      <p class=\"price mt-2 fsz-20\"> $725.00 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"product-card\">                                  <div class=\"top\">                                      <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod19.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod19.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <div class=\"tags\">                                          <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-dark text-white text-uppercase\"> out of stock </span>                                      </div>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> TCL OLed 4K Ultra HD, 47” Smart TV  </a>                                      <p class=\"price mt-2 fsz-20\"> $1,205.00 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"product-card\">                                  <div class=\"top\">                                      <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod20.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod20.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <div class=\"tags\">                                          <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-cyan1 text-white text-uppercase\"> new </span>                                      </div>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> BE Home Security Camera </a>                                      <p class=\"price mt-2 fsz-20\"> $69.00 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                          </div>                      </div>                      <div class=\"tab-pane fade\" id=\"pills-tab4\" role=\"tabpanel\" aria-labelledby=\"pills-tab4-tab\">                          <div class=\"product-row\">                              <div class=\"product-card\">                                  <div class=\"top\">                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod11.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod11.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> SORE Simply Brew Compact Filter Drip Coffee Maker </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <span> (1) </span>                                      </div>                                      <p class=\"price mt-2 fsz-20\"> $159.00 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"product-card\">                                  <div class=\"top\">                                      <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod12.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod12.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <div class=\"tags\">                                          <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 15% OFF </span>                                          <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                      </div>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Toshubi 2-Door Inveter 1200L Refrigerator </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <span> (2) </span>                                      </div>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $1,259.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $1,469.00 </span> </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"product-card\">                                  <div class=\"top\">                                      <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod13.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod13.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <div class=\"tags\">                                          <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-cyan1 text-white text-uppercase\"> new </span>                                      </div>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Epson Mini Portable Projector Wireless </a>                                      <p class=\"price mt-2 fsz-20\"> $205.00 - $410.00 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"product-card\">                                  <div class=\"top\">                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod14.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod14.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Brone 2021 iMac All-in-one Desktop Computer with M1 </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <span> (2) </span>                                      </div>                                      <p class=\"price mt-2 fsz-20\"> $2,725.00 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"product-card\">                                  <div class=\"top\">                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod15.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod15.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <div class=\"tags\">                                          <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-green1 text-white text-uppercase\"> top  rated </span>                                      </div>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Durotan Manual Espresso Machine, Coffe Maker </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <span> (12) </span>                                      </div>                                      <p class=\"price mt-2 fsz-20\"> $449.00 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"product-card\">                                  <div class=\"top\">                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod16.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod16.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <div class=\"tags\">                                          <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 10% OFF </span>                                      </div>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Name of Product with Lore </a>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $79.50 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $69.00 </span> </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"product-card\">                                  <div class=\"top\">                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod17.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod17.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> aPod LTE+GPS Sliver Grey </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star\"></i>                                          <i class=\"fas fa-star\"></i>                                          <span> (1) </span>                                      </div>                                      <p class=\"price mt-2 fsz-20\"> $524.00 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"product-card\">                                  <div class=\"top\">                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod18.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod18.png\" alt=\"\" class=\"img-contain\">                                  </a>                                  <div class=\"info\">                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Oloxtralic Smart Inveter Washing Machine </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <span> (2) </span>                                      </div>                                      <p class=\"price mt-2 fsz-20\"> $725.00 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                          </div>                      </div>                  </div>              </div>          </section>', 'Widgets', NULL, 0, '2024-05-13 01:32:07', '2024-05-13 01:32:07');
INSERT INTO `builder_blocks` (`id`, `content`, `category`, `template`, `created_by`, `created_at`, `updated_at`) VALUES
(21, '<section class=\"tc-best-single-style1\">              <div class=\"container\">                  <div class=\"row\">                      <div class=\"col-lg-5\">                          <div class=\"info wow fadeInUp slow\" data-wow-delay=\"0.2s\">                              <small class=\"fsz-12 text-uppercase color-666 mb-10\"> amazon award-winning speaker </small>                              <h3 class=\"fsz-35 fw-bold\"> Devialet Phantom <br> II <span class=\"fw-300\"> Speaker </span> </h3>                              <div class=\"price mt-40\">                                  <small class=\"fsz-10 color-666 text-uppercase me-4\"> Starting at <br> Price </small>                                  <span class=\"fsz-26 color-green1 lh-1\"> $1,590 </span>                              </div>                              <div class=\"main-img th-280\">                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod21.png\" alt=\"\" class=\"img-contain\">                              </div>                          </div>                      </div>                      <div class=\"col-lg-7 wow fadeInUp slow\" data-wow-delay=\"0.4s\">                          <div class=\"title mb-40\">                              <div class=\"row align-items-center\">                                  <div class=\"col-lg-8\">                                      <h3 class=\"fsz-30\"> Best Selling Speakers </h3>                                  </div>                                  <div class=\"col-lg-4 text-lg-end mt-4 mt-lg-0\">                                      <div class=\"arrows\">                                          <a href=\"#0\" class=\"swiper-prev\"> <i class=\"fal fa-chevron-left\"></i> </a>                                          <a href=\"#0\" class=\"swiper-next\"> <i class=\"fal fa-chevron-right\"></i> </a>                                      </div>                                  </div>                              </div>                          </div>                          <div class=\"best-single-slider\">                              <div class=\"swiper-wrapper\">                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod22.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod22.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-cyan1 text-white text-uppercase\"> new </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> B&O Beolit 20 Powerful Portable Wireless Bluetooth </a>                                              <p class=\"price mt-2 fsz-20\"> $159.00 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod23.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod23.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Marshall Stanmore II Wireless  Bluetooth Speaker </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <span> (2) </span>                                              </div>                                              <p class=\"price mt-2 fsz-20\"> $325.00 - $410.00 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod24.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod24.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-green1 text-white text-uppercase\"> top  rated </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Bose SoundLink III Speaker </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <span> (12) </span>                                              </div>                                              <p class=\"price mt-2 fsz-20\"> $149.00 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                              </div>                          </div>                      </div>                  </div>              </div>          </section>', 'Widgets', NULL, 0, '2024-05-13 01:32:07', '2024-05-13 01:32:07'),
(22, '<section class=\"tc-best-seller-style1 wow fadeInUp slow\" data-wow-delay=\"0.2s\">              <div class=\"container\">                  <div class=\"title mb-40\">                      <div class=\"row align-items-center\">                          <div class=\"col-lg-8\">                              <h3 class=\"fsz-30\"> Just Landing </h3>                          </div>                          <div class=\"col-lg-4 text-lg-end mt-4 mt-lg-0\">                              <a href=\"#\" class=\"more-btn fsz-14 text-uppercase fw-500\"> View All <i class=\"fal fa-angle-right ms-1\"></i> </a>                          </div>                      </div>                  </div>                  <ul class=\"nav nav-pills mb-40\" id=\"pills-tabs2\" role=\"tablist\">                      <li class=\"nav-item\" role=\"presentation\">                        <button class=\"nav-link active\" id=\"pills-tab20-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab5\" type=\"button\" role=\"tab\" aria-selected=\"true\">TV/Televisions</button>                      </li>                      <li class=\"nav-item\" role=\"presentation\">                        <button class=\"nav-link\" id=\"pills-tab21-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab6\" type=\"button\" role=\"tab\" aria-selected=\"false\">PC Gaming</button>                      </li>                      <li class=\"nav-item\" role=\"presentation\">                        <button class=\"nav-link\" id=\"pills-tab22-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab5\" type=\"button\" role=\"tab\" aria-selected=\"false\">Computers</button>                      </li>                      <li class=\"nav-item\" role=\"presentation\">                          <button class=\"nav-link\" id=\"pills-tab23-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab6\" type=\"button\" role=\"tab\" aria-selected=\"false\">Cameras</button>                        </li>                        <li class=\"nav-item\" role=\"presentation\">                          <button class=\"nav-link\" id=\"pills-tab25-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab6\" type=\"button\" role=\"tab\" aria-selected=\"false\">Gadgets</button>                        </li>                        <li class=\"nav-item\" role=\"presentation\">                          <button class=\"nav-link\" id=\"pills-tab26-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab5\" type=\"button\" role=\"tab\" aria-selected=\"false\">Smart Home</button>                        </li>                        <li class=\"nav-item\" role=\"presentation\">                          <button class=\"nav-link\" id=\"pills-tab27-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-tab6\" type=\"button\" role=\"tab\" aria-selected=\"false\">Sport Equipments</button>                        </li>                    </ul>                    <div class=\"tab-content\" id=\"pills-tabContent\">                      <div class=\"tab-pane fade show active\" id=\"pills-tab5\" role=\"tabpanel\" aria-labelledby=\"pills-tab5-tab\">                          <div class=\"products-slider\">                              <div class=\"swiper-wrapper\">                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod25.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod25.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-cyan1 text-white text-uppercase\"> new </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> uClever Boost Cube Mini 12V Charge </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star\"></i>                                                  <i class=\"fas fa-star\"></i>                                                  <i class=\"fas fa-star\"></i>                                                  <span> (9) </span>                                              </div>                                              <p class=\"price mt-2 fsz-20\"> $209.00 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod26.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod26.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-cyan1 text-white text-uppercase\"> new </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Devialet PHantom II Wireless Speaker 108db </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <span> (4) </span>                                              </div>                                              <p class=\"price color-red1 mt-2 fsz-20\"> $1,589.00 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod27.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod27.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-cyan1 text-white text-uppercase\"> new </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> TOSHIRO Smart Inveter 12L Washing Machine </a>                                              <p class=\"price mt-2 fsz-20\"> $1,029.50 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod28.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod28.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-cyan1 text-white text-uppercase\"> new </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> TORO Smart Self Balancing Transporter Scooter </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <span> (2) </span>                                              </div>                                              <p class=\"price mt-2 fsz-20\"> $1,512.90 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod29.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod29.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-cyan1 text-white text-uppercase\"> new </span>                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-green1 text-white text-uppercase\"> top  rated </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Onyx HK Studio 2 Speaker </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <span> (12) </span>                                              </div>                                              <p class=\"price mt-2 fsz-20\"> $205.00 - $410.00 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod8.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod8.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-cyan1 text-white text-uppercase\"> new </span>                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Shorp 49” Class FHD (1080p) Android Led TV </a>                                              <p class=\"price mt-2 fsz-20\"> $3,029.50 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                              </div>                              <div class=\"slider-controls\">                                  <div class=\"swiper-button-prev\"></div>                                  <div class=\"swiper-pagination\"></div>                                  <div class=\"swiper-button-next\"></div>                              </div>                          </div>                      </div>                      <div class=\"tab-pane fade\" id=\"pills-tab6\" role=\"tabpanel\" aria-labelledby=\"pills-tab6-tab\">                          <div class=\"products-slider\">                              <div class=\"swiper-wrapper\">                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod3.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod3.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 15% OFF </span>                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Durotan Manual Espresso Machine, Coffe Maker </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <span> (34) </span>                                              </div>                                              <p class=\"price color-red1 mt-2 fsz-20\"> $489.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $619.00 </span> </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod7.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod7.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 15% OFF </span>                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Conar DSLR Camera EOS II, Only Body </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star\"></i>                                                  <span> (5) </span>                                              </div>                                              <p class=\"price color-red1 mt-2 fsz-20\"> $579.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $819.00 </span> </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod8.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod8.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-cyan1 text-white text-uppercase\"> new </span>                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Shorp 49” Class FHD (1080p) Android Led TV </a>                                              <p class=\"price mt-2 fsz-20\"> $3,029.50 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod9.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod9.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Gigabyte PC Gaming Case, Core i7, 32GB Ram </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <span> (2) </span>                                              </div>                                              <p class=\"price mt-2 fsz-20\"> $1,279.00 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod10.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod10.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-green1 text-white text-uppercase\"> top  rated </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Sceptre 32” Internet TV </a>                                              <div class=\"stars fsz-13 mt-2\">                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <i class=\"fas fa-star active\"></i>                                                  <span> (12) </span>                                              </div>                                              <p class=\"price mt-2 fsz-20\"> $610.00 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                                  <div class=\"swiper-slide\">                                      <div class=\"product-card\">                                          <div class=\"top\">                                              <div class=\"icons\">                                                  <a href=\"#0\" class=\"icon fav\"> <i class=\"fal fa-heart\"></i> </a>                                                  <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                                  <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod8.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                              </div>                                          </div>                                          <a href=\"../inner_pages/single_product.html\" class=\"img th-160 mb-20 d-block\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod8.png\" alt=\"\" class=\"img-contain\">                                          </a>                                          <div class=\"info\">                                              <div class=\"tags\">                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-cyan1 text-white text-uppercase\"> new </span>                                                  <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                              </div>                                              <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Shorp 49” Class FHD (1080p) Android Led TV </a>                                              <p class=\"price mt-2 fsz-20\"> $3,029.50 </p>                                          </div>                                          <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                                      </div>                                  </div>                              </div>                              <div class=\"slider-controls\">                                  <div class=\"swiper-button-prev\"></div>                                  <div class=\"swiper-pagination\"></div>                                  <div class=\"swiper-button-next\"></div>                              </div>                          </div>                      </div>                    </div>              </div>          </section>', 'Widgets', NULL, 0, '2024-05-13 01:32:07', '2024-05-13 01:32:07');
INSERT INTO `builder_blocks` (`id`, `content`, `category`, `template`, `created_by`, `created_at`, `updated_at`) VALUES
(23, '<section class=\"tc-testimonials-style1 pb-60\">              <div class=\"container\">                  <div class=\"row\">                      <div class=\"col-lg-6\">                          <div class=\"advc-card card-gray overflow-hidden wow fadeInUp slow\" data-wow-delay=\"0.2s\">                              <div class=\"title mb-40\">                                  <div class=\"row align-items-center\">                                      <div class=\"col-lg-8\">                                          <h3 class=\"fsz-30\"> Just Landing </h3>                                      </div>                                      <div class=\"col-lg-4 text-lg-end mt-4 mt-lg-0\">                                          <a href=\"#\" class=\"more-btn fsz-14 text-uppercase fw-500\"> View All <i class=\"fal fa-angle-right ms-1\"></i> </a>                                      </div>                                  </div>                              </div>                              <div class=\"blog-slider\">                                  <div class=\"swiper-wrapper\">                                      <div class=\"swiper-slide\">                                          <div class=\"advc-item\">                                              <div class=\"img\">                                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/blog_1.jpg\" alt=\"\" class=\"img-cover\">                                              </div>                                              <div class=\"info\">                                                  <h6> <a href=\"#\" class=\"fsz-18 fw-bold hover-blue1\"> How to choose size of Television fit to your living room </a> </h6>                                                  <small class=\"fsz-12 color-666 float-text\"> 45 Minutes ago in <a href=\"#\" class=\"color-000 text-uppercase\"> Experience </a> </small>                                              </div>                                          </div>                                          <div class=\"advc-item\">                                              <div class=\"img\">                                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/blog_2.jpg\" alt=\"\" class=\"img-cover\">                                              </div>                                              <div class=\"info\">                                                  <h6> <a href=\"#\" class=\"fsz-18 fw-bold hover-blue1\"> Introduce New Generation of Eluxtro Washing Machine 2023 </a> </h6>                                                  <small class=\"fsz-12 color-666 float-text\"> 2 Days ago in <a href=\"#\" class=\"color-000 text-uppercase\"> Technology </a> </small>                                              </div>                                          </div>                                      </div>                                  </div>                                  <div class=\"swiper-button-next\"></div>                                  <div class=\"swiper-button-prev\"></div>                              </div>                          </div>                      </div>                      <div class=\"col-lg-6\">                          <div class=\"testimonials-box card-gray overflow-hidden wow fadeInUp slow\" data-wow-delay=\"0.4s\">                              <div class=\"title mb-40\">                                  <div class=\"row align-items-center\">                                      <div class=\"col-lg-8\">                                          <h3 class=\"fsz-30\"> Best Selling Speakers </h3>                                      </div>                                      <div class=\"col-lg-4 text-lg-end mt-4 mt-lg-0\">                                          <div class=\"arrows\">                                              <a href=\"#0\" class=\"swiper-prev\"> <i class=\"fal fa-chevron-left\"></i> </a>                                              <a href=\"#0\" class=\"swiper-next\"> <i class=\"fal fa-chevron-right\"></i> </a>                                          </div>                                      </div>                                  </div>                              </div>                              <div class=\"testi-card\">                                  <div class=\"rate mb-20\">                                      <div class=\"stars\">                                          <i class=\"fas fa-star\"></i>                                          <i class=\"fas fa-star\"></i>                                          <i class=\"fas fa-star\"></i>                                          <i class=\"fas fa-star\"></i>                                          <i class=\"fas fa-star\"></i>                                      </div>                                      <h6 class=\"fsz-18 fw-bold\"> Fast shipping and flexiable price! </h6>                                  </div>                                  <div class=\"text fsz-14 mb-50\">                                      I used to have experience shopping on much platform as Amozon, Eboy, Esto, etc. And see that Swoo Market really great. It’ll be my 1st choice for any shopping experience. Competitive price, fast shipping and support 24/7. Extremely recommended!                                  </div>                                  <div class=\"btm-items\">                                      <div class=\"user-info\">                                          <div class=\"img\">                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/user.jpg \" alt=\"\">                                              <span class=\"icon\"> <i class=\"fas fa-check\"></i> </span>                                          </div>                                          <div class=\"inf\">                                              <h6 class=\"fsz-18 fw-bold\"> Drake N. <small class=\"fsz-10 color-green1 ms-1 text-uppercase\"> Verified Buyer </small> </h6>                                              <p class=\"fsz-12 color-666\"> Brooklyn, Los Angeles </p>                                          </div>                                      </div>                                      <a href=\"#\" class=\"text-capitalize color-blue1 text-decoration-underline fsz-11 fw-600\"> Marshall Standmore Speaker / Black </a>                                  </div>                              </div>                          </div>                      </div>                  </div>              </div>          </section>', 'Widgets', NULL, 0, '2024-05-13 01:32:07', '2024-05-13 01:32:07'),
(24, '<section class=\"tc-subscribe-style1\">              <div class=\"container\">                  <div class=\"row align-items-center justify-content-between\">                      <div class=\"col-lg-6\">                          <h3 class=\"fsz-30 fw-400\"> <strong class=\"fw-700\"> Subscribe </strong> & Get <span class=\"color-cyan1\"> 10% OFF </span> for first order </h3>                      </div>                      <div class=\"col-lg-4 mt-4 mt-lg-0\">                          <div class=\"form-group\">                              <span class=\"icon\"> <i class=\"far fa-envelope\"></i> </span>                              <input type=\"text\" placeholder=\"Enter your email address\">                              <button> Subscibe </button>                          </div>                      </div>                  </div>              </div>              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/plane.png\" alt=\"\" class=\"plane\">          </section>', 'Widgets', NULL, 0, '2024-05-13 01:32:07', '2024-05-13 01:32:07'),
(34, '<section class=\"tc-categories-style4 pt-60 pb-60\">              <div class=\"container\">                  <div class=\"section-title-style4 text-center mb-40\">                      <h4 class=\"fsz-30 fw-400\"> <b class=\"color-cyan2\"> Most popular categories </b> for baby products </h4>                  </div>                  <div class=\"categories-slider4 wow fadeInUp slow\">                      <div class=\"swiper-wrapper\">                          <div class=\"swiper-slide\">                              <a href=\"#\" class=\"cat-card new-card\">                                  <div class=\"icon-circle\">                                      <h4 class=\"fsz-30\"> new </h4>                                  </div>                                  <b class=\"fsz-14\"> New <br> Arrivals </b>                              </a>                          </div>                          <div class=\"swiper-slide\">                              <a href=\"#\" class=\"cat-card sale-card\">                                  <div class=\"icon-circle\">                                      <h4 class=\"fsz-30\"> sale </h4>                                  </div>                                  <b class=\"fsz-14\"> Clearance </b>                              </a>                          </div>                          <div class=\"swiper-slide\">                              <a href=\"#\" class=\"cat-card\">                                  <div class=\"icon-circle\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/icons/cat1.png\" alt=\"\">                                  </div>                                  <b class=\"fsz-14\"> Pregnancy & Postpartum </b>                              </a>                          </div>                          <div class=\"swiper-slide\">                              <a href=\"#\" class=\"cat-card\">                                  <div class=\"icon-circle\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/icons/cat2.png\" alt=\"\">                                  </div>                                  <b class=\"fsz-14\"> Milks and Foods </b>                              </a>                          </div>                          <div class=\"swiper-slide\">                              <a href=\"#\" class=\"cat-card\">                                  <div class=\"icon-circle\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/icons/cat3.png\" alt=\"\">                                  </div>                                  <b class=\"fsz-14\"> Diapers and Wipes </b>                              </a>                          </div>                          <div class=\"swiper-slide\">                              <a href=\"#\" class=\"cat-card\">                                  <div class=\"icon-circle\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/icons/cat4.png\" alt=\"\">                                  </div>                                  <b class=\"fsz-14\"> Infant </b>                              </a>                          </div>                          <div class=\"swiper-slide\">                              <a href=\"#\" class=\"cat-card\">                                  <div class=\"icon-circle\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/icons/cat5.png\" alt=\"\">                                  </div>                                  <b class=\"fsz-14\"> Eat & Drink Supplies </b>                              </a>                          </div>                          <div class=\"swiper-slide\">                              <a href=\"#\" class=\"cat-card\">                                  <div class=\"icon-circle\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/icons/cat6.png\" alt=\"\">                                  </div>                                  <b class=\"fsz-14\"> Stroller, Crib, Chair </b>                              </a>                          </div>                          <div class=\"swiper-slide\">                              <a href=\"#\" class=\"cat-card\">                                  <div class=\"icon-circle\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/icons/cat7.png\" alt=\"\">                                  </div>                                  <b class=\"fsz-14\"> Washes & Bath </b>                              </a>                          </div>                          <div class=\"swiper-slide\">                              <a href=\"#\" class=\"cat-card\">                                  <div class=\"icon-circle\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/icons/cat8.png\" alt=\"\">                                  </div>                                  <b class=\"fsz-14\"> Baby Fashion </b>                              </a>                          </div>                      </div>                  </div>                  <div class=\"cat-banner\">                      <div class=\"row gx-3\">                          <div class=\"col-lg-6\">                              <div class=\"banner-item mt-20 wow fadeInUp slow\" data-wow-delay=\"0.2s\">                                  <div class=\"img\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/banners/banner1.png\" alt=\"\" class=\"main-img img-cover\">                                  </div>                                  <div class=\"info text-white\">                                      <div class=\"price-content d-flex align-items-center mb-10\">                                          <h6 class=\"fsz-18 text-uppercase me-30\"> best <br> price </h6>                                          <h2 class=\"fsz-45\"> $69 </h2>                                      </div>                                      <p class=\"fsz-13 w-100\"> 3-Pack Cotton Rib </p>                                      <p class=\"fsz-13 w-100\"> Bodysuits </p>                                      <a href=\"../inner_pages/products.html\" class=\"butn md-butn bg-white color-000 radius-3 fw-600 fsz-12 text-capitalize mt-20\"> <span> Shop Now </span> </a>                                  </div>                              </div>                          </div>                          <div class=\"col-lg-6\">                              <div class=\"banner-item item-rtl mt-20 wow fadeInUp slow\" data-wow-delay=\"0.4s\">                                  <div class=\"img\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/banners/banner2.png\" alt=\"\" class=\"main-img img-cover\">                                  </div>                                  <div class=\"info\">                                      <h3 class=\"fsz-35 mb-20\"> <span class=\"px-2 lh-3 d-inline-block radius-4 bg-white\"> 10% OFF </span> <br>  for Diapers  </h3>                                      <p class=\"fsz-14 color-666\"> Earn 10% Cash back on <br> Swatbabymall. <a href=\"../inner_pages/products.html\" class=\"color-000 text-decoration-underline color-000\"> Expore Now! </a> </p>                                  </div>                              </div>                          </div>                      </div>                  </div>              </div>          </section>', 'Carousel', NULL, 0, '2024-05-13 01:50:56', '2024-05-13 01:50:56');
INSERT INTO `builder_blocks` (`id`, `content`, `category`, `template`, `created_by`, `created_at`, `updated_at`) VALUES
(35, '<section class=\"tc-recommended-style4 wow fadeInUp slow\" data-wow-delay=\"0.2s\">              <div class=\"container\">                  <div class=\"section-title-style4 text-center mb-40\">                      <h4 class=\"fsz-30 fw-400\"> <b class=\"color-cyan2\"> Recommended </b> by Swatbabymall </h4>                  </div>                  <div class=\"recommended-content\">                      <ul class=\"nav nav-pills\" role=\"tablist\">                          <li class=\"nav-item\" role=\"presentation\">                              <button class=\"nav-link active\" id=\"pills-rec1-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-rec1\"> Best Seller </button>                          </li>                          <li class=\"nav-item\" role=\"presentation\">                              <button class=\"nav-link\" id=\"pills-rec2-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-rec2\"> Top Rated </button>                          </li>                          <li class=\"nav-item\" role=\"presentation\">                              <button class=\"nav-link\" id=\"pills-rec3-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-rec1\"> Pregnancy & Postpartum </button>                          </li>                          <li class=\"nav-item\" role=\"presentation\">                              <button class=\"nav-link\" id=\"pills-rec4-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-rec2\"> Milks & Foods </button>                          </li>                          <li class=\"nav-item\" role=\"presentation\">                              <button class=\"nav-link\" id=\"pills-rec5-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-rec1\"> Diapers & Wipes </button>                          </li>                          <li class=\"nav-item\" role=\"presentation\">                              <button class=\"nav-link\" id=\"pills-rec6-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-rec2\"> Infant </button>                          </li>                          <li class=\"nav-item\" role=\"presentation\">                              <button class=\"nav-link\" id=\"pills-rec7-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-rec1\"> Strollers </button>                          </li>                          <li class=\"nav-item\" role=\"presentation\">                              <button class=\"nav-link\" id=\"pills-rec8-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-rec2\"> Baby Out </button>                          </li>                      </ul>                      <div class=\"tab-content\">                          <div class=\"tab-pane fade show active\" id=\"pills-rec1\">                               <div class=\"recommended-slider-content\">                                  <div class=\"recommended-slider\">                                      <div class=\"swiper-wrapper\">                                          <div class=\"swiper-slide\">                                              <div class=\"product-card\">                                                  <div class=\"top-info\">                                                      <a href=\"../inner_pages/single_product.html\" class=\"title\"> Choco Baby Bouncer Balloon up to a weight of 18 kg </a>                                                      <div class=\"rate\">                                                          <div class=\"stars\">                                                              <i class=\"fas fa-star\"></i>                                                              <i class=\"fas fa-star\"></i>                                                              <i class=\"fas fa-star\"></i>                                                              <i class=\"fas fa-star\"></i>                                                              <i class=\"fas fa-star\"></i>                                                          </div>                                                          <small> (2) </small>                                                      </div>                                                  </div>                                                  <div class=\"prod-img-slider\">                                                      <div class=\"img-slider img-slider1\">                                                          <div class=\"swiper-wrapper\">                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod1_1.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod1_2.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod1_3.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                          </div>                                                          <div class=\"swiper-pagination\"></div>                                                      </div>                                                      <div class=\"float-icons\">                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                      </div>                                                  </div>                                                  <div class=\"price\"> <span class=\"color-red2 me-2 fw-600\"> $129.00 </span> <small class=\"last-price\"> $159.00 </small> <small class=\"dis\"> 15% OFF </small> </div>                                                  <div class=\"btm-fav\"> <span> 1.286 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                  <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                              </div>                                          </div>                                          <div class=\"swiper-slide\">                                              <div class=\"product-card\">                                                  <div class=\"top-info\">                                                      <a href=\"../inner_pages/single_product.html\" class=\"title\"> Genber Lil Crunchies, Ounce Canister </a>                                                      <div class=\"rate\">                                                          <div class=\"stars\">                                                              <i class=\"fas fa-star\"></i>                                                              <i class=\"fas fa-star\"></i>                                                              <i class=\"fas fa-star\"></i>                                                              <i class=\"fas fa-star\"></i>                                                              <i class=\"fas fa-star color-999\"></i>                                                          </div>                                                          <small> (7) </small>                                                      </div>                                                  </div>                                                  <div class=\"prod-img-slider\">                                                      <div class=\"img-slider\">                                                          <div class=\"swiper-wrapper\">                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod2_1.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                          </div>                                                          <div class=\"swiper-pagination\"></div>                                                      </div>                                                      <div class=\"float-icons\">                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                      </div>                                                  </div>                                                  <div class=\"price\"> $1,259.00 </div>                                                  <div class=\"btm-fav\"> <span> 93 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn active\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                  <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                              </div>                                          </div>                                          <div class=\"swiper-slide\">                                              <div class=\"product-card\">                                                  <div class=\"top-info\">                                                      <a href=\"../inner_pages/single_product.html\" class=\"title\"> Gancho Slim Snacker High Chair Grey </a>                                                  </div>                                                  <div class=\"prod-img-slider\">                                                      <div class=\"float-tags\">                                                          <span class=\"new\"> new </span>                                                      </div>                                                      <div class=\"img-slider\">                                                          <div class=\"swiper-wrapper\">                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod3_1.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                          </div>                                                          <div class=\"swiper-pagination\"></div>                                                      </div>                                                      <div class=\"float-icons\">                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                      </div>                                                  </div>                                                  <div class=\"price\"> <span class=\"color-red2 me-2 fw-600\"> $29.00 </span> <small class=\"last-price\"> $59.00 </small> <small class=\"dis\"> 45% OFF </small> </div>                                                  <div class=\"btm-fav\"> <span> 256 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                  <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                              </div>                                          </div>                                          <div class=\"swiper-slide\">                                              <div class=\"product-card\">                                                  <div class=\"top-info\">                                                      <a href=\"../inner_pages/single_product.html\" class=\"title\"> Emno Breeze baby carrier </a>                                                  </div>                                                  <div class=\"prod-img-slider\">                                                      <div class=\"float-tags\">                                                          <span class=\"new\"> new </span>                                                      </div>                                                      <div class=\"img-slider img-slider2\">                                                          <div class=\"swiper-wrapper\">                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod4_1.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod4_2.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                          </div>                                                          <div class=\"swiper-pagination\"></div>                                                      </div>                                                      <div class=\"float-icons\">                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                      </div>                                                  </div>                                                  <div class=\"price\"> <span class=\"color-red2 me-2 fw-600\"> $79.00 </span> <small class=\"last-price\"> $99.00 </small> <small class=\"dis\"> 20% OFF </small> </div>                                                  <div class=\"btm-fav\"> <span> 562 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                  <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                              </div>                                          </div>                                          <div class=\"swiper-slide\">                                              <div class=\"product-card\">                                                  <div class=\"top-info\">                                                      <a href=\"../inner_pages/single_product.html\" class=\"title\"> Shorp 49” Class FHD 1080 </a>                                                  </div>                                                  <div class=\"prod-img-slider\">                                                      <div class=\"img-slider\">                                                          <div class=\"swiper-wrapper\">                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod5_1.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                          </div>                                                          <div class=\"swiper-pagination\"></div>                                                      </div>                                                      <div class=\"float-icons\">                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                      </div>                                                  </div>                                                  <div class=\"price\"> $49.00 - $99.00 </div>                                                  <div class=\"btm-fav\"> <span> 1.2 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                  <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                              </div>                                          </div>                                          <div class=\"swiper-slide\">                                              <div class=\"product-card\">                                                  <div class=\"top-info\">                                                      <a href=\"../inner_pages/single_product.html\" class=\"title\"> Emno Breeze baby carrier </a>                                                  </div>                                                  <div class=\"prod-img-slider\">                                                      <div class=\"float-tags\">                                                          <span class=\"new\"> new </span>                                                      </div>                                                      <div class=\"img-slider img-slider2\">                                                          <div class=\"swiper-wrapper\">                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod4_1.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod4_2.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                          </div>                                                          <div class=\"swiper-pagination\"></div>                                                      </div>                                                      <div class=\"float-icons\">                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                      </div>                                                  </div>                                                  <div class=\"price\"> <span class=\"color-red2 me-2 fw-600\"> $79.00 </span> <small class=\"last-price\"> $99.00 </small> <small class=\"dis\"> 20% OFF </small> </div>                                                  <div class=\"btm-fav\"> <span> 562 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                  <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                              </div>                                          </div>                                      </div>                                  </div>                                  <div class=\"swiper-button-next\"></div>                                  <div class=\"swiper-button-prev\"></div>                              </div>                          </div>                          <div class=\"tab-pane fade\" id=\"pills-rec2\">                               <div class=\"recommended-slider-content\">                                  <div class=\"recommended-slider\">                                      <div class=\"swiper-wrapper\">                                          <div class=\"swiper-slide\">                                              <div class=\"product-card\">                                                  <div class=\"top-info\">                                                      <a href=\"../inner_pages/single_product.html\" class=\"title\"> Choco Baby Bouncer Balloon up to a weight of 18 kg </a>                                                      <div class=\"rate\">                                                          <div class=\"stars\">                                                              <i class=\"fas fa-star\"></i>                                                              <i class=\"fas fa-star\"></i>                                                              <i class=\"fas fa-star\"></i>                                                              <i class=\"fas fa-star\"></i>                                                              <i class=\"fas fa-star\"></i>                                                          </div>                                                          <small> (2) </small>                                                      </div>                                                  </div>                                                  <div class=\"prod-img-slider\">                                                      <div class=\"img-slider img-slider1\">                                                          <div class=\"swiper-wrapper\">                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod1_1.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod1_2.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod1_3.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                          </div>                                                          <div class=\"swiper-pagination\"></div>                                                      </div>                                                      <div class=\"float-icons\">                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                      </div>                                                  </div>                                                  <div class=\"price\"> <span class=\"color-red2 me-2 fw-600\"> $129.00 </span> <small class=\"last-price\"> $159.00 </small> <small class=\"dis\"> 15% OFF </small> </div>                                                  <div class=\"btm-fav\"> <span> 1.286 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                  <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                              </div>                                          </div>                                          <div class=\"swiper-slide\">                                              <div class=\"product-card\">                                                  <div class=\"top-info\">                                                      <a href=\"../inner_pages/single_product.html\" class=\"title\"> Genber Lil Crunchies, Ounce Canister </a>                                                      <div class=\"rate\">                                                          <div class=\"stars\">                                                              <i class=\"fas fa-star\"></i>                                                              <i class=\"fas fa-star\"></i>                                                              <i class=\"fas fa-star\"></i>                                                              <i class=\"fas fa-star\"></i>                                                              <i class=\"fas fa-star color-999\"></i>                                                          </div>                                                          <small> (7) </small>                                                      </div>                                                  </div>                                                  <div class=\"prod-img-slider\">                                                      <div class=\"img-slider\">                                                          <div class=\"swiper-wrapper\">                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod2_1.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                          </div>                                                          <div class=\"swiper-pagination\"></div>                                                      </div>                                                      <div class=\"float-icons\">                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                      </div>                                                  </div>                                                  <div class=\"price\"> $1,259.00 </div>                                                  <div class=\"btm-fav\"> <span> 93 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn active\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                  <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                              </div>                                          </div>                                          <div class=\"swiper-slide\">                                              <div class=\"product-card\">                                                  <div class=\"top-info\">                                                      <a href=\"../inner_pages/single_product.html\" class=\"title\"> Gancho Slim Snacker High Chair Grey </a>                                                  </div>                                                  <div class=\"prod-img-slider\">                                                      <div class=\"float-tags\">                                                          <span class=\"new\"> new </span>                                                      </div>                                                      <div class=\"img-slider\">                                                          <div class=\"swiper-wrapper\">                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod3_1.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                          </div>                                                          <div class=\"swiper-pagination\"></div>                                                      </div>                                                      <div class=\"float-icons\">                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                      </div>                                                  </div>                                                  <div class=\"price\"> <span class=\"color-red2 me-2 fw-600\"> $29.00 </span> <small class=\"last-price\"> $59.00 </small> <small class=\"dis\"> 45% OFF </small> </div>                                                  <div class=\"btm-fav\"> <span> 256 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                  <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                              </div>                                          </div>                                          <div class=\"swiper-slide\">                                              <div class=\"product-card\">                                                  <div class=\"top-info\">                                                      <a href=\"../inner_pages/single_product.html\" class=\"title\"> Emno Breeze baby carrier </a>                                                  </div>                                                  <div class=\"prod-img-slider\">                                                      <div class=\"float-tags\">                                                          <span class=\"new\"> new </span>                                                      </div>                                                      <div class=\"img-slider img-slider2\">                                                          <div class=\"swiper-wrapper\">                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod4_1.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod4_2.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                          </div>                                                          <div class=\"swiper-pagination\"></div>                                                      </div>                                                      <div class=\"float-icons\">                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                      </div>                                                  </div>                                                  <div class=\"price\"> <span class=\"color-red2 me-2 fw-600\"> $79.00 </span> <small class=\"last-price\"> $99.00 </small> <small class=\"dis\"> 20% OFF </small> </div>                                                  <div class=\"btm-fav\"> <span> 562 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                  <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                              </div>                                          </div>                                          <div class=\"swiper-slide\">                                              <div class=\"product-card\">                                                  <div class=\"top-info\">                                                      <a href=\"../inner_pages/single_product.html\" class=\"title\"> Shorp 49” Class FHD 1080 </a>                                                  </div>                                                  <div class=\"prod-img-slider\">                                                      <div class=\"img-slider\">                                                          <div class=\"swiper-wrapper\">                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod5_1.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                          </div>                                                          <div class=\"swiper-pagination\"></div>                                                      </div>                                                      <div class=\"float-icons\">                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                      </div>                                                  </div>                                                  <div class=\"price\"> $49.00 - $99.00 </div>                                                  <div class=\"btm-fav\"> <span> 1.2 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                  <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                              </div>                                          </div>                                          <div class=\"swiper-slide\">                                              <div class=\"product-card\">                                                  <div class=\"top-info\">                                                      <a href=\"../inner_pages/single_product.html\" class=\"title\"> Emno Breeze baby carrier </a>                                                  </div>                                                  <div class=\"prod-img-slider\">                                                      <div class=\"float-tags\">                                                          <span class=\"new\"> new </span>                                                      </div>                                                      <div class=\"img-slider img-slider2\">                                                          <div class=\"swiper-wrapper\">                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod4_1.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                              <div class=\"swiper-slide\">                                                                  <div class=\"img\">                                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod4_2.jpg\" alt=\"\" class=\"img-contain\">                                                                  </div>                                                              </div>                                                          </div>                                                          <div class=\"swiper-pagination\"></div>                                                      </div>                                                      <div class=\"float-icons\">                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                          <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                      </div>                                                  </div>                                                  <div class=\"price\"> <span class=\"color-red2 me-2 fw-600\"> $79.00 </span> <small class=\"last-price\"> $99.00 </small> <small class=\"dis\"> 20% OFF </small> </div>                                                  <div class=\"btm-fav\"> <span> 562 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                  <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                              </div>                                          </div>                                      </div>                                  </div>                              </div>                              </div>                      </div>                  </div>              </div>          </section>', 'Carousel', NULL, 0, '2024-05-13 01:50:56', '2024-05-13 01:50:56'),
(36, '<section class=\"tc-milestones-style4\">              <div class=\"container\">                  <div class=\"milestones-box\">                      <div class=\"section-title-style4 text-center\">                          <h4 class=\"fsz-30 fw-400\"> Prepare for <b class=\"color-cyan2\"> baby milestones </b> </h4>                      </div>                      <div class=\"row gx-4\">                          <div class=\"col-lg-3\">                              <div class=\"miles-card wow fadeInUp slow\" data-wow-delay=\"0.2s\">                                  <div class=\"img\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/m1.png\" alt=\"\" class=\"img-cover\">                                  </div>                                  <div class=\"info\">                                      <a href=\"../inner_pages/products.html\" class=\"title fsz-20\"> Sleep Training </a>                                      <small class=\"fsz-13 color-666\"> 0-6 months </small>                                  </div>                              </div>                          </div>                          <div class=\"col-lg-3\">                              <div class=\"miles-card wow fadeInUp slow\" data-wow-delay=\"0.4s\">                                  <div class=\"img\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/m2.png\" alt=\"\" class=\"img-cover\">                                  </div>                                  <div class=\"info\">                                      <a href=\"../inner_pages/products.html\" class=\"title fsz-20\"> Starting Solids </a>                                      <small class=\"fsz-13 color-666\"> 6-12 months </small>                                  </div>                              </div>                          </div>                          <div class=\"col-lg-3\">                              <div class=\"miles-card wow fadeInUp slow\" data-wow-delay=\"0.6s\">                                  <div class=\"img\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/m3.png\" alt=\"\" class=\"img-cover\">                                  </div>                                  <div class=\"info\">                                      <a href=\"../inner_pages/products.html\" class=\"title fsz-20\"> On The Move </a>                                      <small class=\"fsz-13 color-666\"> 12-24 months </small>                                  </div>                              </div>                          </div>                          <div class=\"col-lg-3\">                              <div class=\"miles-card wow fadeInUp slow\" data-wow-delay=\"0.8s\">                                  <div class=\"img\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/m4.png\" alt=\"\" class=\"img-cover\">                                  </div>                                  <div class=\"info\">                                      <a href=\"../inner_pages/products.html\" class=\"title fsz-20\"> Potty Training </a>                                      <small class=\"fsz-13 color-666\"> 2-4 years </small>                                  </div>                              </div>                          </div>                      </div>                  </div>              </div>          </section>', 'Carousel', NULL, 0, '2024-05-13 01:50:56', '2024-05-13 01:50:56');
INSERT INTO `builder_blocks` (`id`, `content`, `category`, `template`, `created_by`, `created_at`, `updated_at`) VALUES
(37, '<section class=\"tc-banner-style4 pt-60 wow fadeInUp slow\" data-wow-delay=\"0.2s\">              <div class=\"container\">                  <div class=\"banner-card\">                      <div class=\"row align-items-center gx-5\">                          <div class=\"col-lg-2 mt-4 mt-lg-0\">                              <div class=\"bn-logo\">                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/bn_logo.png\" alt=\"\">                              </div>                          </div>                          <div class=\"col-lg-4 order-last order-lg-0 mt-4 mt-lg-0\">                              <div class=\"img\">                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/bn_img.png\" alt=\"\">                              </div>                          </div>                          <div class=\"col-lg-4 mt-4 mt-lg-0\">                              <div class=\"inf\">                                  <small class=\"fsz-13 d-block mb-2\"> Pay with 4 installment, 0% interest </small>                                  <h4 class=\"fsz-30 fw-bold\"> Buy Now, <span class=\"fw-300\"> Pay Later </span> </h4>                              </div>                          </div>                          <div class=\"col-lg-2 mt-4 mt-lg-0\">                              <a href=\"#\" class=\"butn md-butn color-000 bg-white radius-2 fw-600 fsz-12 text-uppercase\"> <span> Discover Now </span> </a>                          </div>                      </div>                  </div>              </div>          </section>', 'Carousel', NULL, 0, '2024-05-13 01:50:56', '2024-05-13 01:50:56'),
(38, '<section class=\"tc-sale-style4 pt-60 wow fadeInUp slow\" data-wow-delay=\"0.2s\">              <div class=\"container\">                  <div class=\"section-title-style4 mb-40\">                      <div class=\"row\">                          <div class=\"col-lg-8\">                              <h4 class=\"fsz-30 fw-400\"> <b class=\"color-cyan2\"> Clearance </b> Sale | Up to 70% OFF </h4>                          </div>                          <div class=\"col-lg-4 text-lg-end mt-3 mt-lg-0\">                              <a href=\"#\" class=\"more text-capitalize color-666 fsz-13 hover-cyan2\"> View All <i class=\"la la-angle-right ms-1\"></i> </a>                          </div>                      </div>                  </div>                  <div class=\"sale-slider-content\">                      <div class=\"sale-slider\">                          <div class=\"swiper-wrapper\">                              <div class=\"swiper-slide\">                                  <div class=\"product-card\">                                      <div class=\"top-info\">                                          <a href=\"../inner_pages/products.html\" class=\"title\"> INFONS Folding Hair Chair for Babiers & Toodles </a>                                          <div class=\"rate\">                                              <div class=\"stars\">                                                  <i class=\"fas fa-star\"></i>                                                  <i class=\"fas fa-star\"></i>                                                  <i class=\"fas fa-star\"></i>                                                  <i class=\"fas fa-star\"></i>                                                  <i class=\"fas fa-star\"></i>                                              </div>                                              <small> (2) </small>                                          </div>                                      </div>                                      <div class=\"prod-img-slider\">                                          <div class=\"img-slider img-slider1\">                                              <div class=\"swiper-wrapper\">                                                  <div class=\"swiper-slide\">                                                      <div class=\"img\">                                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod6.jpg\" alt=\"\" class=\"img-contain\">                                                      </div>                                                  </div>                                              </div>                                              <div class=\"swiper-pagination\"></div>                                          </div>                                          <div class=\"float-icons\">                                              <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                              <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                          </div>                                      </div>                                      <div class=\"price\"> <span class=\"color-red2 me-2 fw-600\"> $59.000 </span> <small class=\"last-price\"> $159.00 </small> <small class=\"dis\"> 15% OFF </small> </div>                                      <div class=\"btm-fav\"> <span> 1.286 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                      <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                  </div>                              </div>                              <div class=\"swiper-slide\">                                  <div class=\"product-card\">                                      <div class=\"top-info\">                                          <a href=\"../inner_pages/products.html\" class=\"title\"> Toddler Infant Walker Harness Assistant Belt </a>                                      </div>                                      <div class=\"prod-img-slider\">                                          <div class=\"img-slider\">                                              <div class=\"swiper-wrapper\">                                                  <div class=\"swiper-slide\">                                                      <div class=\"img\">                                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod7.jpg\" alt=\"\" class=\"img-contain\">                                                      </div>                                                  </div>                                              </div>                                              <div class=\"swiper-pagination\"></div>                                          </div>                                          <div class=\"float-icons\">                                              <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                              <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                          </div>                                      </div>                                      <div class=\"price\"> <span class=\"color-red2 me-2 fw-600\"> $9.000 </span> <small class=\"last-price\"> $15.00 </small> <small class=\"dis\"> 45% OFF </small> </div>                                      <div class=\"btm-fav\"> <span> 2,256 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn active\"> <i class=\"fas fa-heart\"></i> </a> </div>                                      <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                  </div>                              </div>                              <div class=\"swiper-slide\">                                  <div class=\"product-card\">                                      <div class=\"top-info\">                                          <a href=\"../inner_pages/products.html\" class=\"title\"> HOGGIES Nouris & Care for Baby Wipes (4in1) </a>                                      </div>                                      <div class=\"prod-img-slider\">                                          <div class=\"float-tags\">                                              <span class=\"new\"> out of stock </span>                                          </div>                                          <div class=\"img-slider\">                                              <div class=\"swiper-wrapper\">                                                  <div class=\"swiper-slide\">                                                      <div class=\"img\">                                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod8.jpg\" alt=\"\" class=\"img-contain\">                                                      </div>                                                  </div>                                              </div>                                              <div class=\"swiper-pagination\"></div>                                          </div>                                          <div class=\"float-icons\">                                              <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                              <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                          </div>                                      </div>                                      <div class=\"price\"> <span class=\"color-red2 me-2 fw-600\"> $29.00 </span> <small class=\"last-price\"> $59.00 </small> <small class=\"dis\"> 45% OFF </small> </div>                                      <div class=\"btm-fav\"> <span> 8,256 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                      <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                  </div>                              </div>                              <div class=\"swiper-slide\">                                  <div class=\"product-card\">                                      <div class=\"top-info\">                                          <a href=\"../inner_pages/products.html\" class=\"title\"> ONO Diaper Handbags </a>                                          <div class=\"rate\">                                              <div class=\"stars\">                                                  <i class=\"fas fa-star\"></i>                                                  <i class=\"fas fa-star\"></i>                                                  <i class=\"fas fa-star\"></i>                                                  <i class=\"fas fa-star\"></i>                                                  <i class=\"fas fa-star\"></i>                                              </div>                                              <small> (9) </small>                                          </div>                                      </div>                                      <div class=\"prod-img-slider\">                                          <div class=\"img-slider img-slider2\">                                              <div class=\"swiper-wrapper\">                                                  <div class=\"swiper-slide\">                                                      <div class=\"img\">                                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod9.jpg\" alt=\"\" class=\"img-contain\">                                                      </div>                                                  </div>                                              </div>                                              <div class=\"swiper-pagination\"></div>                                          </div>                                          <div class=\"float-icons\">                                              <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                              <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                          </div>                                      </div>                                      <div class=\"price\"> <span class=\"color-red2 me-2 fw-600\"> $79.00 </span> <small class=\"last-price\"> $99.00 </small> <small class=\"dis\"> 20% OFF </small> </div>                                      <div class=\"btm-fav\"> <span> 902 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                      <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                  </div>                              </div>                              <div class=\"swiper-slide\">                                  <div class=\"product-card\">                                      <div class=\"top-info\">                                          <a href=\"../inner_pages/products.html\" class=\"title\"> Food Pocket for Infat </a>                                          <div class=\"rate\">                                              <div class=\"stars\">                                                  <i class=\"fas fa-star\"></i>                                                  <i class=\"fas fa-star\"></i>                                                  <i class=\"fas fa-star\"></i>                                                  <i class=\"fas fa-star\"></i>                                                  <i class=\"fas fa-star\"></i>                                              </div>                                              <small> (9) </small>                                          </div>                                      </div>                                      <div class=\"prod-img-slider\">                                          <div class=\"img-slider\">                                              <div class=\"swiper-wrapper\">                                                  <div class=\"swiper-slide\">                                                      <div class=\"img\">                                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod10.jpg\" alt=\"\" class=\"img-contain\">                                                      </div>                                                  </div>                                              </div>                                              <div class=\"swiper-pagination\"></div>                                          </div>                                          <div class=\"float-icons\">                                              <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                              <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                          </div>                                      </div>                                      <div class=\"price\"> <span class=\"color-red2 me-2 fw-600\"> $29.00 </span> <small class=\"last-price\"> $99.00 </small> <small class=\"dis\"> 70% OFF </small> </div>                                      <div class=\"btm-fav\"> <span> 902 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                      <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                  </div>                              </div>                              <div class=\"swiper-slide\">                                  <div class=\"product-card\">                                      <div class=\"top-info\">                                          <a href=\"../inner_pages/products.html\" class=\"title\"> Emno Breeze baby carrier </a>                                      </div>                                      <div class=\"prod-img-slider\">                                          <div class=\"float-tags\">                                              <span class=\"new\"> new </span>                                          </div>                                          <div class=\"img-slider img-slider2\">                                              <div class=\"swiper-wrapper\">                                                  <div class=\"swiper-slide\">                                                      <div class=\"img\">                                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod4_1.jpg\" alt=\"\" class=\"img-contain\">                                                      </div>                                                  </div>                                                  <div class=\"swiper-slide\">                                                      <div class=\"img\">                                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod4_2.jpg\" alt=\"\" class=\"img-contain\">                                                      </div>                                                  </div>                                              </div>                                              <div class=\"swiper-pagination\"></div>                                          </div>                                          <div class=\"float-icons\">                                              <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                              <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                          </div>                                      </div>                                      <div class=\"price\"> <span class=\"color-red2 me-2 fw-600\"> $79.00 </span> <small class=\"last-price\"> $99.00 </small> <small class=\"dis\"> 20% OFF </small> </div>                                      <div class=\"btm-fav\"> <span> 562 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                      <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                  </div>                              </div>                          </div>                      </div>                      <div class=\"swiper-button-prev\"></div>                      <div class=\"swiper-button-next\"></div>                  </div>              </div>          </section>', 'Carousel', NULL, 0, '2024-05-13 01:50:56', '2024-05-13 01:50:56'),
(39, '<section class=\"tc-brands-style4\">              <div class=\"container\">                  <div class=\"section-title-style4 text-center mb-40\">                      <h4 class=\"fsz-30 fw-400\"> <b class=\"color-cyan2\"> Most loved </b> brands on Swatbabymall </h4>                  </div>                  <div class=\"brands\">                      <a href=\"#\" class=\"logo wow fadeInUp slow\" data-wow-delay=\"0.2s\">                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/brands/br1.png\" alt=\"\">                      </a>                      <a href=\"#\" class=\"logo wow fadeInUp slow\" data-wow-delay=\"0.4s\">                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/brands/br2.png\" alt=\"\">                      </a>                      <a href=\"#\" class=\"logo wow fadeInUp slow\" data-wow-delay=\"0.6s\">                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/brands/br3.png\" alt=\"\">                      </a>                      <a href=\"#\" class=\"logo wow fadeInUp slow\" data-wow-delay=\"0.8s\">                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/brands/br4.png\" alt=\"\">                      </a>                      <a href=\"#\" class=\"logo wow fadeInUp slow\" data-wow-delay=\"1s\">                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/brands/br5.png\" alt=\"\">                      </a>                      <a href=\"#\" class=\"logo wow fadeInUp slow\" data-wow-delay=\"1.2s\">                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/brands/br6.png\" alt=\"\">                      </a>                      <a href=\"#\" class=\"logo wow fadeInUp slow\" data-wow-delay=\"1.4s\">                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/brands/br7.png\" alt=\"\">                      </a>                      <a href=\"#\" class=\"logo wow fadeInUp slow\" data-wow-delay=\"0.3s\">                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/brands/br8.png\" alt=\"\">                      </a>                      <a href=\"#\" class=\"logo wow fadeInUp slow\" data-wow-delay=\"0.5s\">                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/brands/br9.png\" alt=\"\">                      </a>                      <a href=\"#\" class=\"logo wow fadeInUp slow\" data-wow-delay=\"0.7s\">                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/brands/br10.png\" alt=\"\">                      </a>                      <a href=\"#\" class=\"logo wow fadeInUp slow\" data-wow-delay=\"0.9s\">                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/brands/br11.png\" alt=\"\">                      </a>                      <a href=\"#\" class=\"logo wow fadeInUp slow\" data-wow-delay=\"1.1s\">                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/brands/br12.png\" alt=\"\">                      </a>                      <a href=\"#\" class=\"logo wow fadeInUp slow\" data-wow-delay=\"1.3s\">                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/brands/br13.png\" alt=\"\">                      </a>                      <a href=\"#\" class=\"logo wow fadeInUp slow\" data-wow-delay=\"1.5s\">                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/brands/br14.png\" alt=\"\">                      </a>                  </div>              </div>          </section>', 'Carousel', NULL, 0, '2024-05-13 01:50:56', '2024-05-13 01:50:56');
INSERT INTO `builder_blocks` (`id`, `content`, `category`, `template`, `created_by`, `created_at`, `updated_at`) VALUES
(40, '<section class=\"tc-arrival-style4 pt-60 wow fadeInUp slow\" data-wow-delay=\"0.2s\">              <div class=\"container\">                  <div class=\"section-title-style4 mb-40\">                      <div class=\"row\">                          <div class=\"col-lg-8\">                              <h4 class=\"fsz-30 fw-400\"> <b class=\"color-cyan2\"> New </b> Arrival </h4>                          </div>                          <div class=\"col-lg-4 text-lg-end mt-3 mt-lg-0\">                              <a href=\"#\" class=\"more text-capitalize color-666 fsz-13 hover-cyan2\"> View All <i class=\"la la-angle-right ms-1\"></i> </a>                          </div>                      </div>                  </div>                  <div class=\"arrival-content\">                      <ul class=\"nav nav-pills\" role=\"tablist\">                          <li class=\"nav-item\" role=\"presentation\">                              <button class=\"nav-link active\" id=\"pills-new1-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-new1\"> Featured </button>                          </li>                          <li class=\"nav-item\" role=\"presentation\">                              <button class=\"nav-link\" id=\"pills-new2-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-new2\"> Pregnancy & Postpartum </button>                          </li>                          <li class=\"nav-item\" role=\"presentation\">                              <button class=\"nav-link\" id=\"pills-new3-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-new1\"> Milks & Foods </button>                          </li>                          <li class=\"nav-item\" role=\"presentation\">                              <button class=\"nav-link\" id=\"pills-new4-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-new2\"> Diapers & Wipes </button>                          </li>                          <li class=\"nav-item\" role=\"presentation\">                              <button class=\"nav-link\" id=\"pills-new5-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-new1\"> Infant </button>                          </li>                          <li class=\"nav-item\" role=\"presentation\">                              <button class=\"nav-link\" id=\"pills-new6-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-new2\"> Strollers </button>                          </li>                          <li class=\"nav-item\" role=\"presentation\">                              <button class=\"nav-link\" id=\"pills-new7-tab\" data-bs-toggle=\"pill\" data-bs-target=\"#pills-new1\"> Baby Out </button>                          </li>                      </ul>                      <div class=\"tab-content\">                          <div class=\"tab-pane fade show active\" id=\"pills-new1\">                               <div class=\"arrival-tab-content\">                                  <div class=\"row gx-4\">                                      <div class=\"col-lg-5\">                                          <div class=\"main-product-card\">                                              <div class=\"prod-card\">                                                  <div class=\"row\">                                                      <div class=\"col-5\">                                                          <div class=\"prod-img\">                                                              <div class=\"float-tags\">                                                                  <span class=\"new\"> new </span>                                                                  <span class=\"new\"> gift </span>                                                              </div>                                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod11.jpg\" alt=\"\" class=\"main-img img-cover\">                                                          </div>                                                      </div>                                                      <div class=\"col-7\">                                                          <div class=\"inf\">                                                              <div class=\"top-cont w-100\">                                                                  <a href=\"../inner_pages/products.html\" class=\"title\"> KOBOO Stroller 3 In 1 Madrid Dark Grey Melange 2022 </a>                                                                  <div class=\"rate\">                                                                      <div class=\"stars\">                                                                          <i class=\"fas fa-star\"></i>                                                                          <i class=\"fas fa-star\"></i>                                                                          <i class=\"fas fa-star\"></i>                                                                          <i class=\"fas fa-star\"></i>                                                                          <i class=\"fas fa-star\"></i>                                                                      </div>                                                                      <small> (25) </small>                                                                  </div>                                                              </div>                                                              <div class=\"btm-cont w-100\">                                                                  <div class=\"price\"> $559.00 </div>                                                                  <div class=\"btm-fav\"> <span> 902 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                              </div>                                                          </div>                                                      </div>                                                  </div>                                              </div>                                              <div class=\"gift-card\">                                                  <div class=\"gift-img\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/gift.png\" alt=\"\">                                                  </div>                                                  <div class=\"gift-info\">                                                      <ul>                                                          <li class=\"fsz-14\"> <i class=\"icon-3 bg-000 me-1\"></i> Buy <span class=\"color-red2 fw-bold\"> 02 </span> boxes get a <strong> Snack Tray </strong> </li>                                                          <li class=\"fsz-14\"> <i class=\"icon-3 bg-000 me-1\"></i> Buy <span class=\"color-red2 fw-bold\"> 04 </span> boxes get a <strong> free Block Toys </strong> </li>                                                      </ul>                                                      <p class=\"fsz-12 color-666 mt-20\"> Promotion will expires in: 9h00pm, 25/5/2024 </p>                                                  </div>                                              </div>                                          </div>                                          <div class=\"main-product-card\">                                              <div class=\"prod-card\">                                                  <div class=\"row\">                                                      <div class=\"col-5\">                                                          <div class=\"prod-img\">                                                              <div class=\"float-tags\">                                                                  <span class=\"new\"> new </span>                                                                  <span class=\"new\"> gift </span>                                                              </div>                                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod12.jpg\" alt=\"\" class=\"main-img img-cover\">                                                          </div>                                                      </div>                                                      <div class=\"col-7\">                                                          <div class=\"inf\">                                                              <div class=\"top-cont w-100\">                                                                  <a href=\"../inner_pages/products.html\" class=\"title\"> POPPER Baby Dry, 1-month Supply (4pc/pack) </a>                                                                  <div class=\"rate\">                                                                      <div class=\"stars\">                                                                          <i class=\"fas fa-star\"></i>                                                                          <i class=\"fas fa-star\"></i>                                                                          <i class=\"fas fa-star\"></i>                                                                          <i class=\"fas fa-star\"></i>                                                                          <i class=\"fas fa-star\"></i>                                                                      </div>                                                                      <small> (12) </small>                                                                  </div>                                                              </div>                                                              <div class=\"btm-cont w-100\">                                                                  <div class=\"price\"> $159.00 </div>                                                                  <div class=\"btm-fav\"> <span> 245 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                              </div>                                                          </div>                                                      </div>                                                  </div>                                              </div>                                              <div class=\"gift-card\">                                                  <div class=\"gift-img\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/gift.png\" alt=\"\">                                                  </div>                                                  <div class=\"gift-info\">                                                      <ul>                                                          <li class=\"fsz-14\"> <i class=\"icon-3 bg-000 me-1\"></i> Buy <span class=\"color-red2 fw-bold\"> 02 </span> boxes get a <strong> Free Shipping </strong> </li>                                                          <li class=\"fsz-14\"> <i class=\"icon-3 bg-000 me-1\"></i> Pay with <strong> Klarna, </strong> Price just <span class=\"color-red2 fw-bold\"> $39.00 </span> </li>                                                      </ul>                                                      <p class=\"fsz-12 color-666 mt-20\"> Promotion will expires in: 9h00pm, 25/5/2024 </p>                                                  </div>                                              </div>                                          </div>                                      </div>                                      <div class=\"col-lg-7\">                                          <div class=\"products\">                                              <div class=\"row gx-4\">                                                  <div class=\"col-lg-4\">                                                      <div class=\"product-card\">                                                          <div class=\"top-info\">                                                              <a href=\"../inner_pages/products.html\" class=\"title\"> DYNAMIC SPORTS 650ET Electric Scooter - Yellow </a>                                                          </div>                                                          <div class=\"prod-img-slider\">                                                              <div class=\"img-slider img-slider1\">                                                                  <div class=\"float-tags\">                                                                      <span class=\"new\"> new </span>                                                                      <span class=\"new\"> pre order </span>                                                                  </div>                                                                  <div class=\"swiper-wrapper\">                                                                      <div class=\"swiper-slide\">                                                                          <div class=\"img\">                                                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod13.jpg\" alt=\"\" class=\"img-contain\">                                                                          </div>                                                                      </div>                                                                  </div>                                                                  <div class=\"swiper-pagination\"></div>                                                              </div>                                                              <div class=\"float-icons\">                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                              </div>                                                          </div>                                                          <div class=\"price\"> $109.00 </div>                                                          <div class=\"btm-fav\"> <span> 75 <small class=\"color-666\"> Pre-order </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                          <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                                      </div>                                                  </div>                                                  <div class=\"col-lg-4\">                                                      <div class=\"product-card\">                                                          <div class=\"top-info\">                                                              <a href=\"../inner_pages/products.html\" class=\"title\"> COSME Bottle Feeding </a>                                                              <div class=\"rate\">                                                                  <div class=\"stars\">                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                  </div>                                                                  <small> (2) </small>                                                              </div>                                                          </div>                                                          <div class=\"prod-img-slider\">                                                              <div class=\"img-slider img-slider1\">                                                                  <div class=\"float-tags\">                                                                      <span class=\"new\"> new </span>                                                                  </div>                                                                  <div class=\"swiper-wrapper\">                                                                      <div class=\"swiper-slide\">                                                                          <div class=\"img\">                                                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod14.jpg\" alt=\"\" class=\"img-contain\">                                                                          </div>                                                                      </div>                                                                  </div>                                                                  <div class=\"swiper-pagination\"></div>                                                              </div>                                                              <div class=\"float-icons\">                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                              </div>                                                          </div>                                                          <div class=\"price\"> $129.00 </div>                                                          <div class=\"btm-fav\"> <span> 3 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                          <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                                      </div>                                                  </div>                                                  <div class=\"col-lg-4\">                                                      <div class=\"product-card\">                                                          <div class=\"top-info\">                                                              <a href=\"../inner_pages/products.html\" class=\"title\"> Toddler Travel Light Stroller </a>                                                              <div class=\"rate\">                                                                  <div class=\"stars\">                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                  </div>                                                                  <small> (9) </small>                                                              </div>                                                          </div>                                                          <div class=\"prod-img-slider\">                                                              <div class=\"img-slider img-slider1\">                                                                  <div class=\"float-tags\">                                                                      <span class=\"new\"> new </span>                                                                  </div>                                                                  <div class=\"swiper-wrapper\">                                                                      <div class=\"swiper-slide\">                                                                          <div class=\"img\">                                                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod15.jpg\" alt=\"\" class=\"img-contain\">                                                                          </div>                                                                      </div>                                                                  </div>                                                                  <div class=\"swiper-pagination\"></div>                                                              </div>                                                              <div class=\"float-icons\">                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                              </div>                                                          </div>                                                          <div class=\"price\"> $39.00 </div>                                                          <div class=\"btm-fav\"> <span> 50 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                          <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                                      </div>                                                  </div>                                                  <div class=\"col-lg-4\">                                                      <div class=\"product-card\">                                                          <div class=\"top-info\">                                                              <a href=\"../inner_pages/products.html\" class=\"title\"> BABYBJORN Cotton Baby Carrier Mini </a>                                                              <div class=\"rate\">                                                                  <div class=\"stars\">                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                  </div>                                                                  <small> (1) </small>                                                              </div>                                                          </div>                                                          <div class=\"prod-img-slider\">                                                              <div class=\"img-slider img-slider1\">                                                                  <div class=\"float-tags\">                                                                      <span class=\"new\"> new </span>                                                                  </div>                                                                  <div class=\"swiper-wrapper\">                                                                      <div class=\"swiper-slide\">                                                                          <div class=\"img\">                                                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod16.jpg\" alt=\"\" class=\"img-contain\">                                                                          </div>                                                                      </div>                                                                  </div>                                                                  <div class=\"swiper-pagination\"></div>                                                              </div>                                                              <div class=\"float-icons\">                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                              </div>                                                          </div>                                                          <div class=\"price\"> $109.00 </div>                                                          <div class=\"btm-fav\"> <span> 25 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                          <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                                      </div>                                                  </div>                                                  <div class=\"col-lg-4\">                                                      <div class=\"product-card\">                                                          <div class=\"top-info\">                                                              <a href=\"../inner_pages/products.html\" class=\"title\"> BOOBAY BAR Oatmeatra Chocolate Chip </a>                                                          </div>                                                          <div class=\"prod-img-slider\">                                                              <div class=\"img-slider img-slider1\">                                                                  <div class=\"float-tags\">                                                                      <span class=\"new\"> new </span>                                                                  </div>                                                                  <div class=\"swiper-wrapper\">                                                                      <div class=\"swiper-slide\">                                                                          <div class=\"img\">                                                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod17.jpg\" alt=\"\" class=\"img-contain\">                                                                          </div>                                                                      </div>                                                                  </div>                                                                  <div class=\"swiper-pagination\"></div>                                                              </div>                                                              <div class=\"float-icons\">                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                              </div>                                                          </div>                                                          <div class=\"price\"> $49.00 </div>                                                          <div class=\"btm-fav\"> <span> 57 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                          <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                                      </div>                                                  </div>                                                  <div class=\"col-lg-4\">                                                      <div class=\"product-card\">                                                          <div class=\"top-info\">                                                              <a href=\"../inner_pages/products.html\" class=\"title\"> NOUS Infant Bodysuit </a>                                                          </div>                                                          <div class=\"prod-img-slider\">                                                              <div class=\"img-slider img-slider1\">                                                                  <div class=\"float-tags\">                                                                      <span class=\"new\"> new </span>                                                                  </div>                                                                  <div class=\"swiper-wrapper\">                                                                      <div class=\"swiper-slide\">                                                                          <div class=\"img\">                                                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod18.jpg\" alt=\"\" class=\"img-contain\">                                                                          </div>                                                                      </div>                                                                  </div>                                                                  <div class=\"swiper-pagination\"></div>                                                              </div>                                                              <div class=\"float-icons\">                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                              </div>                                                          </div>                                                          <div class=\"price\"> $19.00 - $39.00 </div>                                                          <div class=\"btm-fav\"> <span> 3 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                          <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                                      </div>                                                  </div>                                              </div>                                          </div>                                      </div>                                  </div>                              </div>                          </div>                          <div class=\"tab-pane fade\" id=\"pills-new2\">                               <div class=\"arrival-tab-content\">                                  <div class=\"row gx-4\">                                      <div class=\"col-lg-5\">                                          <div class=\"main-product-card\">                                              <div class=\"prod-card\">                                                  <div class=\"row\">                                                      <div class=\"col-5\">                                                          <div class=\"prod-img\">                                                              <div class=\"float-tags\">                                                                  <span class=\"new\"> new </span>                                                                  <span class=\"new\"> gift </span>                                                              </div>                                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod12.jpg\" alt=\"\" class=\"main-img img-cover\">                                                          </div>                                                      </div>                                                      <div class=\"col-7\">                                                          <div class=\"inf\">                                                              <div class=\"top-cont w-100\">                                                                  <a href=\"../inner_pages/products.html\" class=\"title\"> POPPER Baby Dry, 1-month Supply (4pc/pack) </a>                                                                  <div class=\"rate\">                                                                      <div class=\"stars\">                                                                          <i class=\"fas fa-star\"></i>                                                                          <i class=\"fas fa-star\"></i>                                                                          <i class=\"fas fa-star\"></i>                                                                          <i class=\"fas fa-star\"></i>                                                                          <i class=\"fas fa-star\"></i>                                                                      </div>                                                                      <small> (12) </small>                                                                  </div>                                                              </div>                                                              <div class=\"btm-cont w-100\">                                                                  <div class=\"price\"> $159.00 </div>                                                                  <div class=\"btm-fav\"> <span> 245 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                              </div>                                                          </div>                                                      </div>                                                  </div>                                              </div>                                              <div class=\"gift-card\">                                                  <div class=\"gift-img\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/gift.png\" alt=\"\">                                                  </div>                                                  <div class=\"gift-info\">                                                      <ul>                                                          <li class=\"fsz-14\"> <i class=\"icon-3 bg-000 me-1\"></i> Buy <span class=\"color-red2 fw-bold\"> 02 </span> boxes get a <strong> Free Shipping </strong> </li>                                                          <li class=\"fsz-14\"> <i class=\"icon-3 bg-000 me-1\"></i> Pay with <strong> Klarna, </strong> Price just <span class=\"color-red2 fw-bold\"> $39.00 </span> </li>                                                      </ul>                                                      <p class=\"fsz-12 color-666 mt-20\"> Promotion will expires in: 9h00pm, 25/5/2024 </p>                                                  </div>                                              </div>                                          </div>                                          <div class=\"main-product-card\">                                              <div class=\"prod-card\">                                                  <div class=\"row\">                                                      <div class=\"col-5\">                                                          <div class=\"prod-img\">                                                              <div class=\"float-tags\">                                                                  <span class=\"new\"> new </span>                                                                  <span class=\"new\"> gift </span>                                                              </div>                                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod11.jpg\" alt=\"\" class=\"main-img img-cover\">                                                          </div>                                                      </div>                                                      <div class=\"col-7\">                                                          <div class=\"inf\">                                                              <div class=\"top-cont w-100\">                                                                  <a href=\"../inner_pages/products.html\" class=\"title\"> KOBOO Stroller 3 In 1 Madrid Dark Grey Melange 2022 </a>                                                                  <div class=\"rate\">                                                                      <div class=\"stars\">                                                                          <i class=\"fas fa-star\"></i>                                                                          <i class=\"fas fa-star\"></i>                                                                          <i class=\"fas fa-star\"></i>                                                                          <i class=\"fas fa-star\"></i>                                                                          <i class=\"fas fa-star\"></i>                                                                      </div>                                                                      <small> (25) </small>                                                                  </div>                                                              </div>                                                              <div class=\"btm-cont w-100\">                                                                  <div class=\"price\"> $559.00 </div>                                                                  <div class=\"btm-fav\"> <span> 902 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                              </div>                                                          </div>                                                      </div>                                                  </div>                                              </div>                                              <div class=\"gift-card\">                                                  <div class=\"gift-img\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/gift.png\" alt=\"\">                                                  </div>                                                  <div class=\"gift-info\">                                                      <ul>                                                          <li class=\"fsz-14\"> <i class=\"icon-3 bg-000 me-1\"></i> Buy <span class=\"color-red2 fw-bold\"> 02 </span> boxes get a <strong> Snack Tray </strong> </li>                                                          <li class=\"fsz-14\"> <i class=\"icon-3 bg-000 me-1\"></i> Buy <span class=\"color-red2 fw-bold\"> 04 </span> boxes get a <strong> free Block Toys </strong> </li>                                                      </ul>                                                      <p class=\"fsz-12 color-666 mt-20\"> Promotion will expires in: 9h00pm, 25/5/2024 </p>                                                  </div>                                              </div>                                          </div>                                      </div>                                      <div class=\"col-lg-7\">                                          <div class=\"products\">                                              <div class=\"row gx-4\">                                                  <div class=\"col-lg-4\">                                                      <div class=\"product-card\">                                                          <div class=\"top-info\">                                                              <a href=\"../inner_pages/products.html\" class=\"title\"> BABYBJORN Cotton Baby Carrier Mini </a>                                                              <div class=\"rate\">                                                                  <div class=\"stars\">                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                  </div>                                                                  <small> (1) </small>                                                              </div>                                                          </div>                                                          <div class=\"prod-img-slider\">                                                              <div class=\"img-slider img-slider1\">                                                                  <div class=\"float-tags\">                                                                      <span class=\"new\"> new </span>                                                                  </div>                                                                  <div class=\"swiper-wrapper\">                                                                      <div class=\"swiper-slide\">                                                                          <div class=\"img\">                                                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod16.jpg\" alt=\"\" class=\"img-contain\">                                                                          </div>                                                                      </div>                                                                  </div>                                                                  <div class=\"swiper-pagination\"></div>                                                              </div>                                                              <div class=\"float-icons\">                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                              </div>                                                          </div>                                                          <div class=\"price\"> $109.00 </div>                                                          <div class=\"btm-fav\"> <span> 25 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                          <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                                      </div>                                                  </div>                                                  <div class=\"col-lg-4\">                                                      <div class=\"product-card\">                                                          <div class=\"top-info\">                                                              <a href=\"../inner_pages/products.html\" class=\"title\"> BOOBAY BAR Oatmeatra Chocolate Chip </a>                                                          </div>                                                          <div class=\"prod-img-slider\">                                                              <div class=\"img-slider img-slider1\">                                                                  <div class=\"float-tags\">                                                                      <span class=\"new\"> new </span>                                                                  </div>                                                                  <div class=\"swiper-wrapper\">                                                                      <div class=\"swiper-slide\">                                                                          <div class=\"img\">                                                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod17.jpg\" alt=\"\" class=\"img-contain\">                                                                          </div>                                                                      </div>                                                                  </div>                                                                  <div class=\"swiper-pagination\"></div>                                                              </div>                                                              <div class=\"float-icons\">                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                              </div>                                                          </div>                                                          <div class=\"price\"> $49.00 </div>                                                          <div class=\"btm-fav\"> <span> 57 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                          <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                                      </div>                                                  </div>                                                  <div class=\"col-lg-4\">                                                      <div class=\"product-card\">                                                          <div class=\"top-info\">                                                              <a href=\"../inner_pages/products.html\" class=\"title\"> NOUS Infant Bodysuit </a>                                                          </div>                                                          <div class=\"prod-img-slider\">                                                              <div class=\"img-slider img-slider1\">                                                                  <div class=\"float-tags\">                                                                      <span class=\"new\"> new </span>                                                                  </div>                                                                  <div class=\"swiper-wrapper\">                                                                      <div class=\"swiper-slide\">                                                                          <div class=\"img\">                                                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod18.jpg\" alt=\"\" class=\"img-contain\">                                                                          </div>                                                                      </div>                                                                  </div>                                                                  <div class=\"swiper-pagination\"></div>                                                              </div>                                                              <div class=\"float-icons\">                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                              </div>                                                          </div>                                                          <div class=\"price\"> $19.00 - $39.00 </div>                                                          <div class=\"btm-fav\"> <span> 3 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                          <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                                      </div>                                                  </div>                                                  <div class=\"col-lg-4\">                                                      <div class=\"product-card\">                                                          <div class=\"top-info\">                                                              <a href=\"../inner_pages/products.html\" class=\"title\"> DYNAMIC SPORTS 650ET Electric Scooter - Yellow </a>                                                          </div>                                                          <div class=\"prod-img-slider\">                                                              <div class=\"img-slider img-slider1\">                                                                  <div class=\"float-tags\">                                                                      <span class=\"new\"> new </span>                                                                      <span class=\"new\"> pre order </span>                                                                  </div>                                                                  <div class=\"swiper-wrapper\">                                                                      <div class=\"swiper-slide\">                                                                          <div class=\"img\">                                                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod13.jpg\" alt=\"\" class=\"img-contain\">                                                                          </div>                                                                      </div>                                                                  </div>                                                                  <div class=\"swiper-pagination\"></div>                                                              </div>                                                              <div class=\"float-icons\">                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                              </div>                                                          </div>                                                          <div class=\"price\"> $109.00 </div>                                                          <div class=\"btm-fav\"> <span> 75 <small class=\"color-666\"> Pre-order </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                          <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                                      </div>                                                  </div>                                                  <div class=\"col-lg-4\">                                                      <div class=\"product-card\">                                                          <div class=\"top-info\">                                                              <a href=\"../inner_pages/products.html\" class=\"title\"> COSME Bottle Feeding </a>                                                              <div class=\"rate\">                                                                  <div class=\"stars\">                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                  </div>                                                                  <small> (2) </small>                                                              </div>                                                          </div>                                                          <div class=\"prod-img-slider\">                                                              <div class=\"img-slider img-slider1\">                                                                  <div class=\"float-tags\">                                                                      <span class=\"new\"> new </span>                                                                  </div>                                                                  <div class=\"swiper-wrapper\">                                                                      <div class=\"swiper-slide\">                                                                          <div class=\"img\">                                                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod14.jpg\" alt=\"\" class=\"img-contain\">                                                                          </div>                                                                      </div>                                                                  </div>                                                                  <div class=\"swiper-pagination\"></div>                                                              </div>                                                              <div class=\"float-icons\">                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                              </div>                                                          </div>                                                          <div class=\"price\"> $129.00 </div>                                                          <div class=\"btm-fav\"> <span> 3 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                          <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                                      </div>                                                  </div>                                                  <div class=\"col-lg-4\">                                                      <div class=\"product-card\">                                                          <div class=\"top-info\">                                                              <a href=\"../inner_pages/products.html\" class=\"title\"> Toddler Travel Light Stroller </a>                                                              <div class=\"rate\">                                                                  <div class=\"stars\">                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                      <i class=\"fas fa-star\"></i>                                                                  </div>                                                                  <small> (9) </small>                                                              </div>                                                          </div>                                                          <div class=\"prod-img-slider\">                                                              <div class=\"img-slider img-slider1\">                                                                  <div class=\"float-tags\">                                                                      <span class=\"new\"> new </span>                                                                  </div>                                                                  <div class=\"swiper-wrapper\">                                                                      <div class=\"swiper-slide\">                                                                          <div class=\"img\">                                                                              <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod15.jpg\" alt=\"\" class=\"img-contain\">                                                                          </div>                                                                      </div>                                                                  </div>                                                                  <div class=\"swiper-pagination\"></div>                                                              </div>                                                              <div class=\"float-icons\">                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Quick view\"> <i class=\"far fa-eye\"></i> </a>                                                                  <a href=\"#\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Comparison\"> <i class=\"far fa-sync\"></i> </a>                                                              </div>                                                          </div>                                                          <div class=\"price\"> $39.00 </div>                                                          <div class=\"btm-fav\"> <span> 50 <small class=\"color-666\"> Purchases </small> </span> <a href=\"#0\" class=\"fav-btn\"> <i class=\"fas fa-heart\"></i> </a> </div>                                                          <a href=\"#0\" class=\"butn bg-cyan2 text-white radius-2 fw-600 fsz-12 text-uppercase addCart\"> <span> add to cart </span> </a>                                                      </div>                                                  </div>                                              </div>                                          </div>                                      </div>                                  </div>                              </div>                          </div>                      </div>                  </div>              </div>          </section>', 'Carousel', NULL, 0, '2024-05-13 01:50:56', '2024-05-13 01:50:56');
INSERT INTO `builder_blocks` (`id`, `content`, `category`, `template`, `created_by`, `created_at`, `updated_at`) VALUES
(41, '<section class=\"tc-category-cards-style4\">              <div class=\"container\">                  <div class=\"row\">                      <div class=\"col-lg-6\">                          <div class=\"category-card lightBlue mt-60 wow fadeInUp slow\" data-wow-delay=\"0.2s\">                              <div class=\"cat-products\">                                  <div class=\"section-title-style4 mb-30\">                                      <div class=\"row\">                                          <div class=\"col-lg-8\">                                              <h4 class=\"fsz-30 fw-400\"> <b class=\"color-cyan2\"> Bedroom </b> Essentials </h4>                                          </div>                                          <div class=\"col-lg-4 text-lg-end mt-3 mt-lg-0\">                                              <a href=\"#\" class=\"more text-capitalize color-666 fsz-13 hover-cyan2\"> View All <i class=\"la la-angle-right ms-1\"></i> </a>                                          </div>                                      </div>                                  </div>                                  <div class=\"products\">                                      <div class=\"row\">                                          <div class=\"col-lg-3 col-6\">                                              <div class=\"prod-card text-center mb-30\">                                                  <div class=\"img th-140\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod19.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <a href=\"#\" class=\"fsz-14 fw-bold hover-underline mt-10\"> Beach & Water </a>                                              </div>                                          </div>                                          <div class=\"col-lg-3 col-6\">                                              <div class=\"prod-card text-center mb-30\">                                                  <div class=\"img th-140\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod20.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <a href=\"#\" class=\"fsz-14 fw-bold hover-underline mt-10\"> Trampolines </a>                                              </div>                                          </div>                                          <div class=\"col-lg-3 col-6\">                                              <div class=\"prod-card text-center mb-30\">                                                  <div class=\"img th-140\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod21.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <a href=\"#\" class=\"fsz-14 fw-bold hover-underline mt-10\"> Ride ons </a>                                              </div>                                          </div>                                          <div class=\"col-lg-3 col-6\">                                              <div class=\"prod-card text-center mb-30\">                                                  <div class=\"img th-140\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod22.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <a href=\"#\" class=\"fsz-14 fw-bold hover-underline mt-10\"> Outdoor Games </a>                                              </div>                                          </div>                                      </div>                                  </div>                                  <div class=\"banners\">                                      <div class=\"row gx-2\">                                          <div class=\"col-lg-6\">                                              <a href=\"#\" class=\"adbanner\">                                                  <div class=\"img\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/banners/c_ban1.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <div class=\"info text-white\">                                                      <h6 class=\"fsz-18 w-100 fw-300\"> <span class=\"fw-bold\"> OKO </span> Beeze <br> Baby Carrier </h6>                                                      <div class=\"price\">                                                          <small class=\"fsz-10 text-uppercase lh-2 me-2\"> price <br> just </small>                                                          <strong class=\"fsz-24\"> $169 </strong>                                                      </div>                                                  </div>                                              </a>                                          </div>                                          <div class=\"col-lg-6\">                                              <a href=\"#\" class=\"adbanner r-info mt-3 mt-lg-0\">                                                  <div class=\"img\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/banners/c_ban2.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <div class=\"info text-white w-50\">                                                      <h6 class=\"fsz-16 w-100 fw-600\"> Kindergo Uniq Balance Bike </h6>                                                      <small class=\"fsz-10 text-uppercase text-decoration-underline\"> Shop Now </small>                                                  </div>                                              </a>                                          </div>                                      </div>                                  </div>                              </div>                          </div>                      </div>                      <div class=\"col-lg-6\">                          <div class=\"category-card lightBrown mt-60 wow fadeInUp slow\" data-wow-delay=\"0.4s\">                              <div class=\"cat-products\">                                  <div class=\"section-title-style4 mb-30\">                                      <div class=\"row\">                                          <div class=\"col-lg-8\">                                              <h4 class=\"fsz-30 fw-400\"> <b class=\"color-cyan2\"> Feeding </b> Essentials </h4>                                          </div>                                          <div class=\"col-lg-4 text-lg-end mt-3 mt-lg-0\">                                              <a href=\"#\" class=\"more text-capitalize color-666 fsz-13 hover-cyan2\"> View All <i class=\"la la-angle-right ms-1\"></i> </a>                                          </div>                                      </div>                                  </div>                                  <div class=\"products\">                                      <div class=\"row\">                                          <div class=\"col-lg-3 col-6\">                                              <div class=\"prod-card text-center mb-30\">                                                  <div class=\"img th-140\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod27.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <a href=\"#\" class=\"fsz-14 fw-bold hover-underline mt-10\"> Breast Feeding </a>                                              </div>                                          </div>                                          <div class=\"col-lg-3 col-6\">                                              <div class=\"prod-card text-center mb-30\">                                                  <div class=\"img th-140\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod28.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <a href=\"#\" class=\"fsz-14 fw-bold hover-underline mt-10\"> Bottle Feeding </a>                                              </div>                                          </div>                                          <div class=\"col-lg-3 col-6\">                                              <div class=\"prod-card text-center mb-30\">                                                  <div class=\"img th-140\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod29.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <a href=\"#\" class=\"fsz-14 fw-bold hover-underline mt-10\"> Pacifiers </a>                                              </div>                                          </div>                                          <div class=\"col-lg-3 col-6\">                                              <div class=\"prod-card text-center mb-30\">                                                  <div class=\"img th-140\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod30.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <a href=\"#\" class=\"fsz-14 fw-bold hover-underline mt-10\"> Bibs </a>                                              </div>                                          </div>                                      </div>                                  </div>                                  <div class=\"banners\">                                      <div class=\"row gx-2\">                                          <div class=\"col-lg-6\">                                              <a href=\"#\" class=\"adbanner r-info\">                                                  <div class=\"img\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/banners/c_ban3.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <div class=\"info text-white w-50\">                                                      <div class=\"sm-logo w-50\">                                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/brands/br15.png\" alt=\"\">                                                      </div>                                                      <h6 class=\"fsz-18\"> Baby High <br> Chair </h6>                                                  </div>                                              </a>                                          </div>                                          <div class=\"col-lg-6\">                                              <a href=\"#\" class=\"adbanner r-info mt-3 mt-lg-0\">                                                  <div class=\"img\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/banners/c_ban4.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <div class=\"info text-white w-100 text-center\">                                                      <h6 class=\"fsz-14 ltspc-3 w-100 fw-600 text-uppercase\"> mealtime <span class=\"fw-300\"> essentials </span> </h6>                                                  </div>                                              </a>                                          </div>                                      </div>                                  </div>                              </div>                          </div>                      </div>                      <div class=\"col-lg-6\">                          <div class=\"category-card lightBrown mt-60 wow fadeInUp slow\" data-wow-delay=\"0.2s\">                              <div class=\"cat-products\">                                  <div class=\"section-title-style4 mb-30\">                                      <div class=\"row\">                                          <div class=\"col-lg-8\">                                              <h4 class=\"fsz-30 fw-400\"> <b class=\"color-cyan2\"> Bedroom </b> Essentials </h4>                                          </div>                                          <div class=\"col-lg-4 text-lg-end mt-3 mt-lg-0\">                                              <a href=\"#\" class=\"more text-capitalize color-666 fsz-13 hover-cyan2\"> View All <i class=\"la la-angle-right ms-1\"></i> </a>                                          </div>                                      </div>                                  </div>                                  <div class=\"products\">                                      <div class=\"row\">                                          <div class=\"col-lg-3 col-6\">                                              <div class=\"prod-card text-center mb-30\">                                                  <div class=\"img th-140\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod31.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <a href=\"#\" class=\"fsz-14 fw-bold hover-underline mt-10\"> Bassinets & cribs </a>                                              </div>                                          </div>                                          <div class=\"col-lg-3 col-6\">                                              <div class=\"prod-card text-center mb-30\">                                                  <div class=\"img th-140\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod32.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <a href=\"#\" class=\"fsz-14 fw-bold hover-underline mt-10\"> Sleeping Pods </a>                                              </div>                                          </div>                                          <div class=\"col-lg-3 col-6\">                                              <div class=\"prod-card text-center mb-30\">                                                  <div class=\"img th-140\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod33.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <a href=\"#\" class=\"fsz-14 fw-bold hover-underline mt-10\"> Kid Furnitures </a>                                              </div>                                          </div>                                          <div class=\"col-lg-3 col-6\">                                              <div class=\"prod-card text-center mb-30\">                                                  <div class=\"img th-140\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod34.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <a href=\"#\" class=\"fsz-14 fw-bold hover-underline mt-10\"> Accesories </a>                                              </div>                                          </div>                                      </div>                                  </div>                                  <div class=\"banners\">                                      <div class=\"row gx-2\">                                          <div class=\"col-lg-6\">                                              <a href=\"#\" class=\"adbanner\">                                                  <div class=\"img\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/banners/c_ban5.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <div class=\"info text-white\">                                                      <h6 class=\"fsz-14 text-uppercase\"> donut nursing <br> pillow </h6>                                                      <h3 class=\"fsz-35 text-uppercase\"> 20% <span class=\"fsz-12\"> sale <br> off </span> </h3>                                                  </div>                                              </a>                                          </div>                                          <div class=\"col-lg-6\">                                              <a href=\"#\" class=\"adbanner mt-3 mt-lg-0\">                                                  <div class=\"img\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/banners/c_ban6.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <div class=\"info text-white\">                                                      <h6 class=\"fsz-14 text-uppercase\"> Convertible <br> Cribs </h6>                                                      <div class=\"butn md-butn bg-white color-000 radius-3 fsz-10 text-uppercase d-inline-block fw-600 py-2 px-3\"> <span> Shop Now </span> </div>                                                  </div>                                              </a>                                          </div>                                      </div>                                  </div>                              </div>                          </div>                      </div>                      <div class=\"col-lg-6\">                          <div class=\"category-card lightBlue mt-60 wow fadeInUp slow\" data-wow-delay=\"0.4s\">                              <div class=\"cat-products\">                                  <div class=\"section-title-style4 mb-30\">                                      <div class=\"row\">                                          <div class=\"col-lg-8\">                                              <h4 class=\"fsz-30 fw-400\"> <b class=\"color-cyan2\"> Moms </b> Essentials </h4>                                          </div>                                          <div class=\"col-lg-4 text-lg-end mt-3 mt-lg-0\">                                              <a href=\"#\" class=\"more text-capitalize color-666 fsz-13 hover-cyan2\"> View All <i class=\"la la-angle-right ms-1\"></i> </a>                                          </div>                                      </div>                                  </div>                                  <div class=\"products\">                                      <div class=\"row\">                                          <div class=\"col-lg-3 col-6\">                                              <div class=\"prod-card text-center mb-30\">                                                  <div class=\"img th-140\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod23.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <a href=\"#\" class=\"fsz-14 fw-bold hover-underline mt-10\"> Pregnancy </a>                                              </div>                                          </div>                                          <div class=\"col-lg-3 col-6\">                                              <div class=\"prod-card text-center mb-30\">                                                  <div class=\"img th-140\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod24.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <a href=\"#\" class=\"fsz-14 fw-bold hover-underline mt-10\"> Maternity Cloths </a>                                              </div>                                          </div>                                          <div class=\"col-lg-3 col-6\">                                              <div class=\"prod-card text-center mb-30\">                                                  <div class=\"img th-140\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod25.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <a href=\"#\" class=\"fsz-14 fw-bold hover-underline mt-10\"> Shapewears </a>                                              </div>                                          </div>                                          <div class=\"col-lg-3 col-6\">                                              <div class=\"prod-card text-center mb-30\">                                                  <div class=\"img th-140\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod26.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <a href=\"#\" class=\"fsz-14 fw-bold hover-underline mt-10\"> Personal Care </a>                                              </div>                                          </div>                                      </div>                                  </div>                                  <div class=\"banners\">                                      <div class=\"row gx-2\">                                          <div class=\"col-lg-6\">                                              <a href=\"#\" class=\"adbanner\">                                                  <div class=\"img\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/banners/c_ban7.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <div class=\"info\">                                                      <div class=\"sm-logo w-25\">                                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/brands/br10.png\" alt=\"\">                                                      </div>                                                      <h6 class=\"fsz-18 w-100 fw-600\"> Diaper Bags </h6>                                                  </div>                                              </a>                                          </div>                                          <div class=\"col-lg-6\">                                              <a href=\"#\" class=\"adbanner mt-3 mt-lg-0\">                                                  <div class=\"img\">                                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/banners/c_ban8.png\" alt=\"\" class=\"img-cover\">                                                  </div>                                                  <div class=\"info text-white w-50\">                                                      <h6 class=\"fsz-13 w-100 fw-500 text-uppercase mt-15\"> BodySense <br> Smart Scale </h6>                                                  </div>                                              </a>                                          </div>                                      </div>                                  </div>                              </div>                          </div>                      </div>                  </div>              </div>          </section>', 'Carousel', NULL, 0, '2024-05-13 01:50:56', '2024-05-13 01:50:56'),
(42, '<section class=\"tc-blog-style4 pt-60 pb-60 wow fadeInUp slow\" data-wow-delay=\"0.2s\">              <div class=\"container\">                  <div class=\"section-title-style4 mb-40\">                      <div class=\"row\">                          <div class=\"col-lg-8\">                              <h4 class=\"fsz-30 fw-400\"> <b class=\"color-cyan2\"> What’s New </b> Today </h4>                          </div>                          <div class=\"col-lg-4 text-lg-end mt-3 mt-lg-0\">                              <a href=\"#\" class=\"more text-capitalize color-666 fsz-13 hover-cyan2\"> see More articles <i class=\"la la-angle-right ms-1\"></i> </a>                          </div>                      </div>                  </div>                  <div class=\"blog-content\">                      <div class=\"row\">                          <div class=\"col-lg-4\">                              <div class=\"overlay-card mb-4 mb-lg-0\">                                  <div class=\"img\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/blog1.jpg\" alt=\"\" class=\"main-img img-cover\">                                  </div>                                  <div class=\"info text-white\">                                      <a href=\"#\" class=\"title fsz-18 fw-600 d-block lh-3 hover-underline\"> Babies in Winter: How to protect your newborn in cold weather </a>                                      <small class=\"fsz-12 mt-15\"> 45 Minutes ago in Experience </small>                                  </div>                              </div>                          </div>                          <div class=\"col-lg-8\">                              <div class=\"sub-blog\">                                  <div class=\"row\">                                      <div class=\"col-lg-6\">                                          <div class=\"blog-card pt-0\">                                              <div class=\"row gx-4\">                                                  <div class=\"col-5\">                                                      <div class=\"img th-100 radius-4 overflow-hidden\">                                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/blog2.jpg\" alt=\"\" class=\"img-cover\">                                                      </div>                                                  </div>                                                  <div class=\"col-7\">                                                      <div class=\"info\">                                                          <a href=\"#\" class=\"title\"> Omicron in Kids: Here’s what parents should know </a>                                                          <small class=\"fsz-12 color-666 d-block w-100\"> 45 Minutes ago in <span class=\"color-000\"> Experience </span> </small>                                                      </div>                                                  </div>                                              </div>                                          </div>                                      </div>                                      <div class=\"col-lg-6\">                                          <div class=\"blog-card pt-0\">                                              <div class=\"row gx-4\">                                                  <div class=\"col-5\">                                                      <div class=\"img th-100 radius-4 overflow-hidden\">                                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/blog3.jpg\" alt=\"\" class=\"img-cover\">                                                      </div>                                                  </div>                                                  <div class=\"col-7\">                                                      <div class=\"info\">                                                          <a href=\"#\" class=\"title\"> Insight into dadliness </a>                                                          <small class=\"fsz-12 color-666 d-block w-100\"> 2 Days ago in <span class=\"color-000\"> Infant </span> </small>                                                      </div>                                                  </div>                                              </div>                                          </div>                                      </div>                                      <div class=\"col-lg-6\">                                          <div class=\"blog-card pb-0 border-0\">                                              <div class=\"row gx-4\">                                                  <div class=\"col-5\">                                                      <div class=\"img th-100 radius-4 overflow-hidden\">                                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/blog4.jpg\" alt=\"\" class=\"img-cover\">                                                      </div>                                                  </div>                                                  <div class=\"col-7\">                                                      <div class=\"info\">                                                          <a href=\"#\" class=\"title\"> Fun facts about January Babies </a>                                                          <small class=\"fsz-12 color-666 d-block w-100\"> 1 Day ago in <span class=\"color-000\"> Life Style </span> </small>                                                      </div>                                                  </div>                                              </div>                                          </div>                                      </div>                                      <div class=\"col-lg-6\">                                          <div class=\"blog-card pb-0 border-0\">                                              <div class=\"row gx-4\">                                                  <div class=\"col-5\">                                                      <div class=\"img th-100 radius-4 overflow-hidden\">                                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/blog5.jpg\" alt=\"\" class=\"img-cover\">                                                      </div>                                                  </div>                                                  <div class=\"col-7\">                                                      <div class=\"info\">                                                          <a href=\"#\" class=\"title\"> Your handy guide to revamp the nursery </a>                                                          <small class=\"fsz-12 color-666 d-block w-100\"> 2 Days ago in <span class=\"color-000\"> Pregnancy & Postpartum </span> </small>                                                      </div>                                                  </div>                                              </div>                                          </div>                                      </div>                                  </div>                              </div>                          </div>                      </div>                  </div>              </div>          </section>', 'Carousel', NULL, 0, '2024-05-13 01:50:56', '2024-05-13 01:50:56'),
(43, '<section class=\"tc-breadcrumb-style6 p-30 radius-4 bg-white mt-3 wow fadeInUp\">                      <nav aria-label=\"breadcrumb\">                          <ol class=\"breadcrumb fw-bold mb-0\">                            <li class=\"breadcrumb-item color-999\"><a href=\"#\">Home</a></li>                            <li class=\"breadcrumb-item color-999\"><a href=\"#\">Shop</a></li>                            <li class=\"breadcrumb-item active color-000\" aria-current=\"page\"> Contact </li>                          </ol>                        </nav>                  </section>', 'Contact', NULL, 0, '2024-05-13 02:48:13', '2024-05-13 02:48:13'),
(44, '<section class=\"contact p-30 radius-4 bg-white mt-3 wow fadeInUp\">                      <h6 class=\"fsz-18 fw-bold text-uppercase mb-30\"> ready to work with us </h6>                      <div class=\"checkout-form mt-50\">                          <div class=\"row\">                              <div class=\"col-lg-7\">                                  <p class=\"fsz-16 color-666 mb-30\"> Contact us for all your questions and opinions </p>                                  <form class=\"form\">                                      <div class=\"form-content\">                                          <div class=\"row gx-3\">                                              <div class=\"col-lg-6\">                                                  <div class=\"form-group mb-4\">                                                      <label for=\"\"> First Name <span class=\"color-red1\"> * </span> </label>                                                      <input type=\"text\" class=\"form-control\" placeholder=\"\">                                                  </div>                                              </div>                                              <div class=\"col-lg-6\">                                                  <div class=\"form-group mb-4\">                                                      <label for=\"\"> Last Name <span class=\"color-red1\"> * </span> </label>                                                      <input type=\"text\" class=\"form-control\" placeholder=\"\">                                                  </div>                                              </div>                                              <div class=\"col-lg-12\">                                                  <div class=\"form-group mb-4\">                                                      <label for=\"\"> Email Address <span class=\"color-red1\"> * </span> </label>                                                      <input type=\"text\" class=\"form-control\" placeholder=\"\">                                                  </div>                                              </div>                                              <div class=\"col-lg-12\">                                                  <div class=\"form-group mb-4\">                                                      <label for=\"\"> Phone Number <span class=\"color-666\"> (Optional) </span> </label>                                                      <input type=\"text\" class=\"form-control\" placeholder=\"\">                                                  </div>                                              </div>                                              <div class=\"col-lg-12\">                                                  <div class=\"form-group mb-4\">                                                      <label for=\"\"> Country / Region <span class=\"color-red1\"> * </span> </label>                                                      <select name=\"\" id=\"\" class=\"form-control form-select\">                                                          <option value=\"\"> United States (US) </option>                                                          <option value=\"\"> United States (US) </option>                                                      </select>                                                  </div>                                              </div>                                              <div class=\"col-lg-12\">                                                  <div class=\"form-group mb-4\">                                                      <label for=\"\"> Subject <span class=\"color-666\"> (Optional) </span> </label>                                                      <input type=\"text\" class=\"form-control\" placeholder=\"\">                                                  </div>                                              </div>                                              <div class=\"col-lg-12\">                                                  <div class=\"form-group mb-4\">                                                      <label for=\"\"> Message </label>                                                      <textarea name=\"\" rows=\"5\" class=\"form-control\" placeholder=\"Note about your order, e.g. special note for delivery \"></textarea>                                                  </div>                                              </div>                                              <div class=\"col-lg-12\">                                                  <div class=\"form-check\">                                                      <input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"account\">                                                      <label class=\"form-check-label\" for=\"account\">                                                          I want to receive news and updates once in a while. By submitting, I’m agreed to the <a href=\"#\" class=\"color-green2 text-decoration-underline\"> Terms & Conditons </a>                                                      </label>                                                  </div>                                              </div>                                              <div class=\"col-lg-12\">                                                  <a href=\"#\" class=\"butn bg-green2 text-white radius-4 fw-500 fsz-12 text-uppercase text-center mt-50 py-3\"> <span> send message </span> </a>                                              </div>                                          </div>                                      </div>                                  </form>                              </div>                              <div class=\"col-lg-5\">                                  <div class=\"contact-info mt-5 mt-lg-0\">                                      <div class=\"contact-info-card\">                                          <small class=\"fsz-12 color-666 text-uppercase mb-20\"> united states (head quater) </small>                                          <ul class=\"fsz-16 lh-lg\">                                              <li>                                                  <a href=\"#\"> 152 Thatcher Road St, Mahattan, 10463, US </a>                                              </li>                                              <li>                                                  <a href=\"#\"> (+025) 3886 25 16 </a>                                              </li>                                              <li>                                                  <a href=\"#\" class=\"color-green2 text-decoration-underline\"> hello@swattechmart.com </a>                                              </li>                                          </ul>                                          <small class=\"fsz-12 color-666 text-uppercase mb-20 mt-50\"> united kingdom (branch) </small>                                          <ul class=\"fsz-16 lh-lg\">                                              <li>                                                  <a href=\"#\"> 12 Buckingham Rd, Thornthwaite, HG3 4TY, UK </a>                                              </li>                                              <li>                                                  <a href=\"#\"> (+718) 895-5350 </a>                                              </li>                                              <li>                                                  <a href=\"#\" class=\"color-green2 text-decoration-underline\"> contact@swattechmart.co.uk </a>                                              </li>                                          </ul>                                          <div class=\"social-icons mt-50\">                                              <a href=\"#\"> <i class=\"fab fa-twitter\"></i> </a>                                              <a href=\"#\"> <i class=\"fab fa-facebook-f\"></i> </a>                                              <a href=\"#\"> <i class=\"fab fa-instagram\"></i> </a>                                              <a href=\"#\"> <i class=\"fab fa-youtube\"></i> </a>                                              <a href=\"#\"> <i class=\"fab fa-pinterest\"></i> </a>                                          </div>                                      </div>                                      <div class=\"img th-380 mt-10\">                                          <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/contact.png\" alt=\"\" class=\"img-cover radius-4\">                                      </div>                                  </div>                              </div>                          </div>                      </div>                  </section>', 'Contact', NULL, 0, '2024-05-13 02:48:13', '2024-05-13 02:48:13'),
(45, '<section class=\"map p-30 radius-4 bg-white mt-3 wow fadeInUp mb-3\">                      <h6 class=\"fsz-18 fw-bold text-uppercase mb-30\"> find us on google map </h6>                      <div class=\"map-content\">                          <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2877.501184049855!2d10.508400375579958!3d43.845439739977!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12d583f3cf413995%3A0x39c36090e2825e12!2sChurch%20of%20Saint%20Francis!5e0!3m2!1sen!2seg!4v1694912173628!5m2!1sen!2seg\" width=\"100%\" height=\"300\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>                      </div>                  </section>', 'Contact', NULL, 0, '2024-05-13 02:48:13', '2024-05-13 02:48:13'),
(46, '<section class=\"tc-breadcrumb-style6 p-30 radius-4 bg-white mt-3 wow fadeInUp\">                      <nav aria-label=\"breadcrumb\">                          <ol class=\"breadcrumb fw-bold mb-0\">                            <li class=\"breadcrumb-item color-999\"><a href=\"#\">Home</a></li>                            <li class=\"breadcrumb-item color-999\"><a href=\"#\">Shop</a></li>                            <li class=\"breadcrumb-item active color-000\" aria-current=\"page\">Top Cell Phones & Tablets</li>                          </ol>                        </nav>                  </section>', 'Carousel', NULL, 0, '2024-05-13 04:11:36', '2024-05-13 04:11:36');
INSERT INTO `builder_blocks` (`id`, `content`, `category`, `template`, `created_by`, `created_at`, `updated_at`) VALUES
(47, '<section class=\"tc-header-style6 p-30 radius-4 bg-white mt-3 wow fadeInUp\">                      <h6 class=\"fsz-18 fw-bold text-uppercase mb-30\"> top cell phones & tablets </h6>                      <div class=\"row gx-2\">                          <div class=\"col-lg-8\">                              <div class=\"header-slider6\">                                  <div class=\"swiper-wrapper\">                                      <div class=\"swiper-slide\">                                          <div class=\"slider-card\">                                              <div class=\"img\">                                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/header/slider1.png\" alt=\"\" class=\"img-cover\">                                              </div>                                              <div class=\"info text-white\">                                                  <h2 class=\"fsz-30 fw-500\"> <span class=\"color-green2 d-block\"> aPodOs </span> Work wonders <br> with easy </h2>                                                  <p class=\"fsz-12 mt-2\"> Experience aPod 2023 with new <br> technology from $769 </p>                                                  <a href=\"../inner_pages/single_product.html\" class=\"butn px-3 py-2 bg-green2 text-white radius-4 mt-30 fw-500 fsz-12 text-uppercase\"> <span> discover now </span> </a>                                              </div>                                          </div>                                      </div>                                      <div class=\"swiper-slide\">                                          <div class=\"slider-card\">                                              <div class=\"img\">                                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/header/slider2.png\" alt=\"\" class=\"img-cover\">                                              </div>                                              <div class=\"info\">                                                  <p class=\"fsz-13 text-uppercase mb-3\"> pc gaming <br> cases </p>                                                  <h2 class=\"fsz-30 fw-400 text-uppercase\"> SAle up to <br> <strong class=\"color-green2\"> 50% </strong> <strong> off </strong> </h2>                                                  <a href=\"../inner_pages/single_product.html\" class=\"butn px-3 py-2 bg-000 text-white radius-4 mt-50 fw-500 fsz-12 text-uppercase hover-bg-green2\"> <span> buy now </span> </a>                                              </div>                                          </div>                                      </div>                                      <div class=\"swiper-slide\">                                          <div class=\"slider-card text-white\">                                              <div class=\"img\">                                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/header/slider3.png\" alt=\"\" class=\"img-cover\">                                              </div>                                              <div class=\"info\">                                                  <h2 class=\"fsz-30\"> Noise Cancelling <br> <span class=\"fw-300\"> Headphone </span> </h2>                                                  <ul class=\"fsz-12 text-capitalize mt-20\">                                                      <li> <i class=\"la la-dot-circle me-2\"></i> <span> Boso Over-Ear Headphone  </span> </li>                                                      <li> <i class=\"la la-dot-circle me-2\"></i> <span> Wifi, Voice Assistant,  </span> </li>                                                      <li> <i class=\"la la-dot-circle me-2\"></i> <span> Low latency game mde  </span> </li>                                                  </ul>                                                  <a href=\"../inner_pages/single_product.html\" class=\"butn px-3 py-2 bg-white color-000 radius-4 mt-40 fw-500 fsz-12 text-uppercase hover-bg-green2\"> <span> buy now </span> </a>                                              </div>                                          </div>                                      </div>                                  </div>                                  <div class=\"slider-controls\">                                      <div class=\"swiper-button-prev\"></div>                                      <div class=\"swiper-pagination\"></div>                                      <div class=\"swiper-button-next\"></div>                                  </div>                              </div>                          </div>                          <div class=\"col-lg-4 mt-3 mt-lg-0\">                              <div class=\"sub-banner\">                                  <div class=\"img\">                                      <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/banner1.png\" alt=\"\" class=\"img-cover\">                                  </div>                                  <div class=\"info\">                                      <div class=\"row\">                                          <div class=\"col-7\">                                              <h6 class=\"fsz-24\"> redmi note 12 Pro+ 5g </h6>                                              <small class=\"fsz-12 color-666 mt-10\"> Rise to the challenge </small>                                          </div>                                          <div class=\"col-5 text-end\">                                              <a href=\"../inner_pages/single_product.html\" class=\"butn px-3 py-2 bg-000 text-white radius-4 fw-500 fsz-12 text-uppercase hover-bg-green2\"> <span> Shop Now </span> </a>                                          </div>                                      </div>                                  </div>                              </div>                          </div>                      </div>                  </section>', 'Carousel', NULL, 0, '2024-05-13 04:11:36', '2024-05-13 04:11:36'),
(48, '<section class=\"tc-categories-style6 p-30 radius-4 bg-white mt-3 wow fadeInUp\">                      <h6 class=\"fsz-18 fw-bold text-uppercase mb-30\"> popular categories </h6>                      <div class=\"content\">                          <a href=\"../inner_pages/products.html\" class=\"number-item\">                              <div class=\"inf\">                                  <h6 class=\"fsz-14 fw-bold mb-0 sm-title\"> iPhone (iOS) </h6>                                  <small class=\"fsz-12 color-666\"> 74 Items </small>                              </div>                              <div class=\"img\">                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod20.png\" alt=\"\" class=\"img-contain\">                              </div>                          </a>                          <a href=\"../inner_pages/products.html\" class=\"number-item\">                              <div class=\"inf\">                                  <h6 class=\"fsz-14 fw-bold mb-0 sm-title\"> Android </h6>                                  <small class=\"fsz-12 color-666\"> 35 Items </small>                              </div>                              <div class=\"img\">                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod21.png\" alt=\"\" class=\"img-contain\">                              </div>                          </a>                          <a href=\"../inner_pages/products.html\" class=\"number-item\">                              <div class=\"inf\">                                  <h6 class=\"fsz-14 fw-bold mb-0 sm-title\"> 5G Support </h6>                                  <small class=\"fsz-12 color-666\"> 12 Items </small>                              </div>                              <div class=\"img\">                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod22.png\" alt=\"\" class=\"img-contain\">                              </div>                          </a>                          <a href=\"../inner_pages/products.html\" class=\"number-item\">                              <div class=\"inf\">                                  <h6 class=\"fsz-14 fw-bold mb-0 sm-title\"> Apple Tablets </h6>                                  <small class=\"fsz-12 color-666\"> 22 Items </small>                              </div>                              <div class=\"img\">                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod62.png\" alt=\"\" class=\"img-contain\">                              </div>                          </a>                          <a href=\"../inner_pages/products.html\" class=\"number-item\">                              <div class=\"inf\">                                  <h6 class=\"fsz-14 fw-bold mb-0 sm-title\"> Smartphone <br> Chargers </h6>                                  <small class=\"fsz-12 color-666\"> 33 Items </small>                              </div>                              <div class=\"img\">                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod63.png\" alt=\"\" class=\"img-contain\">                              </div>                          </a>                          <a href=\"../inner_pages/products.html\" class=\"number-item\">                              <div class=\"inf\">                                  <h6 class=\"fsz-14 fw-bold mb-0 sm-title\"> Gaming </h6>                                  <small class=\"fsz-12 color-666\"> 9 Items </small>                              </div>                              <div class=\"img\">                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod23.png\" alt=\"\" class=\"img-contain\">                              </div>                          </a>                          <a href=\"../inner_pages/products.html\" class=\"number-item\">                              <div class=\"inf\">                                  <h6 class=\"fsz-14 fw-bold mb-0 sm-title\"> Xiaomi </h6>                                  <small class=\"fsz-12 color-666\"> 52 Items </small>                              </div>                              <div class=\"img\">                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod24.png\" alt=\"\" class=\"img-contain\">                              </div>                          </a>                          <a href=\"../inner_pages/products.html\" class=\"number-item\">                              <div class=\"inf\">                                  <h6 class=\"fsz-14 fw-bold mb-0 sm-title\"> Accessories </h6>                                  <small class=\"fsz-12 color-666\"> 29 Items </small>                              </div>                              <div class=\"img\">                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod25.png\" alt=\"\" class=\"img-contain\">                              </div>                          </a>                          <a href=\"../inner_pages/products.html\" class=\"number-item\">                              <div class=\"inf\">                                  <h6 class=\"fsz-14 fw-bold mb-0 sm-title\"> Samsung Tablets </h6>                                  <small class=\"fsz-12 color-666\"> 26 Items </small>                              </div>                              <div class=\"img\">                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod27.png\" alt=\"\" class=\"img-contain\">                              </div>                          </a>                          <a href=\"../inner_pages/products.html\" class=\"number-item\">                              <div class=\"inf\">                                  <h6 class=\"fsz-14 fw-bold mb-0 sm-title\"> eReader </h6>                                  <small class=\"fsz-12 color-666\"> 5 Items </small>                              </div>                              <div class=\"img\">                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod64.png\" alt=\"\" class=\"img-contain\">                              </div>                          </a>                      </div>                  </section>', 'Carousel', NULL, 0, '2024-05-13 04:11:36', '2024-05-13 04:11:36'),
(50, '<section class=\"tc-recently-viewed-style6 p-30 radius-4 bg-white mt-3 wow fadeInUp mb-3\">                      <div class=\"title mb-30\">                          <div class=\"row align-items-center\">                              <div class=\"col-lg-8\">                                  <h6 class=\"fsz-18 fw-bold text-uppercase d-inline-block\"> your recently viewed </h6>                                  <a href=\"#\" class=\"more text-capitalize color-666 fsz-13 ms-lg-4 mt-4 mt-lg-0\"> View All <i class=\"la la-angle-right ms-1\"></i> </a>                              </div>                              <div class=\"col-lg-4 text-lg-end mt-3 mt-lg-0\">                                  <div class=\"arrows\">                                      <div class=\"swiper-button-next\"></div>                                      <div class=\"swiper-button-prev\"></div>                                  </div>                              </div>                          </div>                      </div>                      <div class=\"products-slider\">                          <div class=\"swiper-wrapper\">                              <div class=\"swiper-slide\">                                  <div class=\"product-card\">                                      <div class=\"top-inf\">                                          <small class=\"fsz-10 py-1 px-2 radius-2 bg-222 text-white text-uppercase\"> new </small>                                          <a href=\"#0\" class=\"fav-btn\"> <i class=\"las la-heart\"></i> </a>                                      </div>                                      <div class=\"row gx-0\">                                          <div class=\"col-5\">                                              <a href=\"#\" class=\"img\">                                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod58.png\" alt=\"\" class=\"img-contain\">                                              </a>                                          </div>                                          <div class=\"col-7\">                                              <div class=\"info\">                                                  <div class=\"rating\">                                                      <div class=\"stars\">                                                          <i class=\"la la-star\"></i>                                                          <i class=\"la la-star\"></i>                                                          <i class=\"la la-star\"></i>                                                          <i class=\"la la-star\"></i>                                                          <i class=\"la la-star color-999\"></i>                                                      </div>                                                      <span class=\"num\"> (152) </span>                                                  </div>                                                  <a href=\"#\" class=\"title fsz-13 fw-bold mb-15 hover-green2 pe-3\"> Xomie Remid 8 Sport Water Resitance Watch </a>                                                  <h6 class=\"fsz-16 fw-bold\"> $579.00 </h6>                                              </div>                                          </div>                                      </div>                                  </div>                              </div>                              <div class=\"swiper-slide\">                                  <div class=\"product-card\">                                      <div class=\"top-inf\">                                          <small class=\"fsz-10 py-1 px-2 radius-2 bg-222 text-white text-uppercase\"> new </small>                                          <a href=\"#0\" class=\"fav-btn\"> <i class=\"las la-heart\"></i> </a>                                      </div>                                      <div class=\"row gx-0\">                                          <div class=\"col-5\">                                              <a href=\"#\" class=\"img\">                                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod59.png\" alt=\"\" class=\"img-contain\">                                              </a>                                          </div>                                          <div class=\"col-7\">                                              <div class=\"info\">                                                  <a href=\"#\" class=\"title fsz-13 fw-bold mb-15 hover-green2 pe-3\"> Microte Surface 2.0 Laptop </a>                                                  <h6 class=\"fsz-16 fw-bold\"> $979.00 </h6>                                              </div>                                          </div>                                      </div>                                  </div>                              </div>                              <div class=\"swiper-slide\">                                  <div class=\"product-card\">                                      <div class=\"top-inf\">                                          <a href=\"#0\" class=\"fav-btn\"> <i class=\"las la-heart\"></i> </a>                                      </div>                                      <div class=\"row gx-0\">                                          <div class=\"col-5\">                                              <a href=\"#\" class=\"img\">                                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod60.png\" alt=\"\" class=\"img-contain\">                                              </a>                                          </div>                                          <div class=\"col-7\">                                              <div class=\"info\">                                                  <a href=\"#\" class=\"title fsz-13 fw-bold mb-15 hover-green2 pe-3\"> aPod Pro Tablet 2023 LTE + Wifi, GPS Cellular 12.9 Inch, 512GB </a>                                                  <h6 class=\"fsz-16 fw-bold\"> $979.00 - $1,259.00 </h6>                                              </div>                                          </div>                                      </div>                                  </div>                              </div>                              <div class=\"swiper-slide\">                                  <div class=\"product-card\">                                      <div class=\"top-inf\">                                          <div class=\"dis-card\">                                              <small class=\"fsz-10 d-block text-uppercase\"> save </small>                                              <h6 class=\"fsz-10\"> $192.00 </h6>                                          </div>                                          <a href=\"#0\" class=\"fav-btn\"> <i class=\"las la-heart\"></i> </a>                                      </div>                                      <div class=\"row gx-0\">                                          <div class=\"col-5\">                                              <a href=\"#\" class=\"img\">                                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod61.png\" alt=\"\" class=\"img-contain\">                                              </a>                                          </div>                                          <div class=\"col-7\">                                              <div class=\"info\">                                                  <div class=\"rating\">                                                      <div class=\"stars\">                                                          <i class=\"la la-star\"></i>                                                          <i class=\"la la-star\"></i>                                                          <i class=\"la la-star\"></i>                                                          <i class=\"la la-star\"></i>                                                          <i class=\"la la-star color-999\"></i>                                                      </div>                                                      <span class=\"num\"> (152) </span>                                                  </div>                                                  <a href=\"#\" class=\"title fsz-13 fw-bold mb-15 hover-green2 pe-3\"> SROK Smart Phone 128GB, Oled Retina </a>                                                  <h6 class=\"fsz-16 fw-bold\"> <span class=\"color-red1 fw-600\"> $579.00  </span> <span class=\"old fsz-14 color-666 text-decoration-line-through ms-2\"> $779.00 </span> </h6>                                              </div>                                          </div>                                      </div>                                  </div>                              </div>                              <div class=\"swiper-slide\">                                  <div class=\"product-card\">                                      <div class=\"top-inf\">                                          <a href=\"#0\" class=\"fav-btn\"> <i class=\"las la-heart\"></i> </a>                                      </div>                                      <div class=\"row gx-0\">                                          <div class=\"col-5\">                                              <a href=\"#\" class=\"img\">                                                  <img src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/products/prod60.png\" alt=\"\" class=\"img-contain\">                                              </a>                                          </div>                                          <div class=\"col-7\">                                              <div class=\"info\">                                                  <a href=\"#\" class=\"title fsz-13 fw-bold mb-15 hover-green2 pe-3\"> aPod Pro Tablet 2023 LTE + Wifi, GPS Cellular 12.9 Inch, 512GB </a>                                                  <h6 class=\"fsz-16 fw-bold\"> $979.00 - $1,259.00 </h6>                                              </div>                                          </div>                                      </div>                                  </div>                              </div>                          </div>                      </div>                  </section>', 'Carousel', NULL, 0, '2024-05-13 04:11:36', '2024-05-13 04:11:36');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT 'uploads/img/product_placeholder.png',
  `model` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `template` varchar(255) DEFAULT 'default',
  `status` varchar(2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(2) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_content`
--

CREATE TABLE `cms_content` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `lang` varchar(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `short` text DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_desc` text DEFAULT NULL,
  `seo_keywords` text DEFAULT NULL,
  `inserted_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cms_content`
--

INSERT INTO `cms_content` (`id`, `item_id`, `item_type`, `prefix`, `lang`, `title`, `content`, `short`, `seo_title`, `seo_desc`, `seo_keywords`, `inserted_by`, `created_at`, `updated_at`) VALUES
(47, 1, 'Medians\\Pages\\Domain\\Page', 'homepage', 'english', 'Homepage', '<section id=\"kedit_71ewi0jg2\" class=\"kedit\">\n    <section id=\"kedit_73lqhoejj\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_pzsi009ya\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_ofiqyg9gc\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_sllcvhh50\" class=\"kedit\" style=\"\">\n    <section id=\"kpg_962934\" class=\"kedit\" style=\"\"><div class=\"keditable keditable-auto\"><div class=\"w-full\">\n\n<section id=\"home-slide\" style=\"max-height: 600px;\" class=\"pt-2 lg:pb-10 lg:mb-20 w-full\">\n    <div class=\"overflow-hidden lg:flex xl:flex hidden w-full absolute top-0\"><div class=\"w-full \"></div><div class=\"w-full h-screen red-gradient\"></div></div>\n\n    <div class=\"relative w-full\">\n\n    \n        <div class=\"container mx-auto lg:flex xl:flex gap-4 pt-10\">\n            <div class=\"lg:w-[46%] w-full lg:py-20 py-4 lg:px-0 px-4 text-start \">\n                <h1 class=\"lg:text-6xl text-4xl\">Crafted for <span>Comfort</span>, Designed for <span>You</span></h1>\n                <p class=\"pt-4 lg:pr-20 \">From timeless classics to contemporary marvels, find the perfect balance of form and function to suit your unique taste and lifestyle.</p>\n            </div>\n            <div class=\"lg:w-[60%] w-full lg:px-0 px-4\">\n                <h1 class=\"text-6xl\"><img class=\"lazy\" src=\"/src/front_assets/img/slide1.png\"></h1>\n            </div>\n        </div>\n\n        <div class=\"absolute w-full bottom-0 hidden lg:block\">\n            <div class=\"container mx-auto flex gap-4 pt-10\">\n                <div class=\"rounded-full shadow-xl w-full bg-white flex px-10 py-4 gap-10\">\n                    <div class=\"\">\n                        <span>Comfort</span>\n                        <div class=\"pt-2 flex gap-2\"> <img class=\"lazy\" src=\"/src/front_assets/svg/comfort.svg\"><span class=\"text-gray-600 text-md\">Cozy Seating</span></div>\n                    </div>\n                    <div class=\"\"> \n                        <span>Quality Assurance</span>\n                        <div class=\"pt-2 flex gap-2\"> <img class=\"lazy\" src=\"/src/front_assets/svg/like.svg\"><span class=\"text-gray-600 text-sm\">Cozy Seating</span></div>\n                    </div>\n                    <div class=\"\">\n                        <span>Free Shipping</span>\n                        <div class=\"pt-2 flex gap-2\"> <img class=\"lazy\" src=\"/src/front_assets/svg/package.svg\"><span class=\"text-gray-600 text-sm\">No-Cost Delivery</span></div>\n                    </div>\n                    <div class=\"\">\n                        <span>Secure Checkout</span>\n                        <div class=\"pt-2 flex gap-2\"> <img class=\"lazy\" src=\"/src/front_assets/svg/secure.svg\"><span class=\"text-gray-600 text-sm\">Secure Payments</span></div>\n                    </div>\n                    <div class=\" pt-4\">\n                        <a href=\"#\" class=\"border border-1 rounded-full px-6 py-2 border-gray-600\">Comfort</a>\n                    </div>\n                </div>\n                <div class=\"lg:w-[15%]\"></div>\n            </div>\n        </div>\n    </div>\n</section>\n\n</div></div></section><section id=\"kpg_128556\" class=\"kedit\" style=\"\"><div class=\"keditable keditable-auto\"><div class=\"w-full\">\n\n    <section id=\"section-gallery\" class=\"w-full relative\">\n        <div class=\"w-full absolute lg:block hidden left-0\">\n            <div class=\"w-[30%] cyan-gradient text-right p-10 h-full absolute left-0 top-o\"></div>\n            <div class=\"container mx-auto py-4 \">\n                <p class=\"text-xl text-gray-800 \">On Sale</p>\n                <p class=\"text-4xl text-gray-800 font-bold\">Up To</p>\n                <p class=\"text-4xl text-black font-bold\">20% OFF</p>\n                <hr class=\"w-40 border-red-600 absolute bottom-[-15px]\">\n            </div>\n        </div>\n        <div class=\"container mx-auto flex gap-4    \">\n            <div class=\"w-96 lg:block hidden\"></div>\n            <div class=\"w-full rtl px-4 lg:px-0 py-10\">\n                <div class=\" mb-6 relative  \">\n                    <img class=\"lazy\" src=\"/src/front_assets/img/gallery-item-1.png\"> \n                    <a href=\"#\" class=\"bg-white px-6 py-4 absolute bottom-0 right-0 text-xl\">Accessories</a>\n                </div>\n                <div class=\" mb-6 relative\" style=\" width: fit-content; \">\n                    <img class=\"lazy\" src=\"/src/front_assets/img/gallery-item-3.png\"> \n                    <a href=\"#\" class=\"bg-white px-6 py-4 absolute bottom-0 left-0 text-xl\">Accessories</a>\n                </div>\n                <div class=\" mb-6 relative\">\n                    <img class=\"lazy\" src=\"/src/front_assets/img/gallery-item-5.png\"> \n                    <a href=\"#\" class=\"bg-white px-6 py-4 absolute top-0 right-0 text-xl\">Accessories</a>\n                </div>\n            </div>\n            <div class=\"w-full\">\n                <div class=\"pt-[50%] mb-6 relative\">\n                    <img class=\"lazy\" src=\"/src/front_assets/img/gallery-item-2.png\"> \n                    <div class=\"absolute bottom-0 left-0 text-xl\"><a class=\"bg-white px-6 py-4 \" href=\"#\">Accessories</a></div>\n                </div>\n                <div class=\" mb-6 relative\">\n                    <img class=\"lazy\" src=\"/src/front_assets/img/gallery-item-4.png\"> \n                    <a href=\"#\" class=\"bg-white px-6 py-4 absolute bottom-0 left-0 text-xl\">Accessories</a>\n                </div>\n                <div class=\" mb-6 relative\">\n                    <img class=\"lazy\" src=\"/src/front_assets/img/gallery-item-6.png\"> \n                    <a href=\"#\" class=\"bg-white px-6 py-4 absolute bottom-0 left-0 text-xl\">Accessories</a>\n                </div>\n            </div>\n        </div>\n    </section>\n\n</div></div></section>\n    \n\n    <section id=\"kedit_bfyjsczgo\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_aixcctrdu\" class=\"kedit\" style=\"\">\n    <section id=\"kpg_283286\" class=\"kedit\" style=\"\"><div class=\"keditable keditable-auto\"><div class=\"w-full\">\n\n    <section id=\"main-benifits\" class=\"pt-20 lg:px-0 px-4\">\n        <div class=\"container mx-auto\">\n            <div class=\"lg:flex w-full text-center lg:text-left\">\n                <div class=\"lg:w-64\">\n                    <span class=\"text-red-400\">Benifits</span>\n                    <h3 class=\"text-2xl py-2 \">Benefits when using our services</h3>\n                </div>\n                <div class=\"w-[50%]\"></div>\n                <div class=\"lg:w-96 text-gray-600\">\n                    <p>Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non purus parturient.</p>\n                </div>\n            </div>\n            <div class=\"lg:flex gap-20 py-10\">\n                <div class=\"mb-20 shadow-lg hover:text-red-600 bg-white px-8 py-10 rounded-2xl\">\n                    <img class=\"p-3 bg-gray-200 rounded-full my-1 lazy\" src=\"/src/front_assets//svg/choices.svg\">\n                    <h4 class=\"text-lg mb-2 mt-4\">Many Choices</h4>\n                    <p class=\"text-gray-600\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non.</p>\n                </div>\n                <div class=\"mb-20 shadow-lg hover:text-red-600 bg-white px-8 py-10 rounded-2xl\">\n                    <img class=\"p-3 bg-gray-200 rounded-full my-1 lazy\" src=\"/src/front_assets//svg/choices.svg\">\n                    <h4 class=\"text-lg mb-2 mt-4\">Fast and On Time</h4>\n                    <p class=\"text-gray-600\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non.</p>\n                </div>\n                <div class=\"mb-20 shadow-lg hover:text-red-600 bg-white px-8 py-10 rounded-2xl\">\n                    <img class=\"p-3 bg-gray-200 rounded-full my-1 lazy\" src=\"/src/front_assets//svg/choices.svg\">\n                    <h4 class=\"mb-2 mt-4\">Affordable Price</h4>\n                    <p class=\"text-gray-600\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non.</p>\n                </div>\n            </div>\n\n        </div>\n    </section>\n    </div></div></section><section id=\"kpg_726691\" class=\"kedit\" style=\"\"><div class=\"keditable keditable-auto\"><div class=\"w-full\"><div id=\"main-center1\" class=\"relative lg:py-10\">\n        <div style=\"max-height: 500px;\" class=\"hidden lg:block w-1/2 absolute overflow-hidden\"><img class=\"w-full lazy\" src=\"/src/front_assets/img/center-1.png\"></div>\n        <div class=\"container mx-auto lg:flex \">\n            <div class=\"w-full\"></div>\n            <div class=\"w-full pt-4 pb-10 px-10\">\n                <div class=\"flex w-full pb-6\">\n                    <h3 class=\"text-2xl w-full\"><span class=\"\">Home</span> Most-popular</h3>\n                    <a class=\"flex-end bg-gray-200 py-2 w-40 text-center hover:bg-red-200\" href=\"#\">View more</a>\n                </div>\n                <div class=\"flex gap-4\">\n                    <div class=\"text-center\">\n                        <img class=\"lazy\" src=\"/src/front_assets/img/section-product-1.png\">\n                        <div class=\"text-center py-2\">\n                            <h4><a class=\"text-xl\" href=\"#\">Body Spray</a></h4>\n                            <p><del>120$</del><span>99$</span></p>\n                        </div>\n                    </div>\n                    <div class=\"text-center\">\n                        <img class=\"lazy\" src=\"/src/front_assets/img/section-product-2.png\">\n                        <div class=\"text-center py-2\">\n                            <h4><a class=\"text-xl\" href=\"#\">Body Spray</a></h4>\n                            <p><del>120$</del><span>99$</span></p>\n                        </div>\n                    </div>\n\n                </div>\n            </div>\n        </div>\n    </div></div></div></section><section id=\"kpg_631055\" class=\"kedit\" style=\"\"><div class=\"keditable keditable-auto\"><div class=\"w-full\"><div id=\"main-center2\" class=\"relative lg:py-10\">\n        <div style=\"max-height: 500px;\" class=\"hidden lg:block w-1/2 absolute overflow-hidden right-0\"><img class=\"w-full lazy\" src=\"/src/front_assets/img/center-2.png\"></div>\n        <div class=\"container mx-auto lg:flex \">\n            <div class=\"w-full pt-4 pb-10 px-10\">\n                <div class=\"flex w-full pb-6\">\n                    <h3 class=\"text-2xl w-full\"><span class=\"\">Office</span> Most-popular</h3>\n                    <a class=\"flex-end bg-gray-200 py-2 w-40 text-center hover:bg-red-200\" href=\"#\">View more</a>\n                </div>\n                <div class=\"flex gap-4\">\n                    <div class=\"text-center\">\n                        <img class=\"lazy\" src=\"/src/front_assets/img/section2-product-1.png\">\n                        <div class=\"text-center py-2\">\n                            <h4><a class=\"text-xl\" href=\"#\">Body Spray</a></h4>\n                            <p><del>120$</del><span>99$</span></p>\n                        </div>\n                    </div>\n                    <div class=\"text-center\">\n                        <img class=\"lazy\" src=\"/src/front_assets/img/section2-product-2.png\">\n                        <div class=\"text-center py-2\">\n                            <h4><a class=\"text-xl\" href=\"#\">Body Spray</a></h4>\n                            <p><del>120$</del><span>99$</span></p>\n                        </div>\n                    </div>\n\n                </div>\n            </div>\n            <div class=\"w-full\"></div>\n        </div>\n    </div></div></div></section><section id=\"kpg_881832\" class=\"kedit\" style=\"\"><div class=\"keditable keditable-auto\"><div class=\"w-full\"><div id=\"main-testimonials\" class=\"overflow-hidden\">\n        <div class=\"text-center pt-10\">\n            <span class=\"text-red-400\">Testimonials</span>\n            <h4 class=\"text-2xl py-2\">What our customer say</h4>\n            <p class=\"max-w-lg mx-auto\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non purus parturient.</p>\n        </div>\n\n        <div class=\"pb-20 pt-10 lg:flex lg:mx-[-40px] gap-12 lg:px-0 px-4\">\n            \n            <div class=\"shadow-lg bg-white px-8 py-10 rounded-2xl mb-10\">\n                <img class=\"rounded-full my-1 w-10 lazy\" src=\"/src/front_assets//svg/testimonial.svg\">\n                <p class=\"py-4\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non.</p>\n                <div class=\"flex w-full\">\n                    <div class=\"flex gap-4 w-full\">\n                        <img class=\"w-12 h-12 rounded-full lazy\" src=\"/src/front_assets/img/profile-1.png\">\n                        <span class=\"py-4\">Janne Cooper</span>\n                    </div>\n                    <div class=\"flex-end  w-full text-end\">\n                        <div class=\"flex gap-4 float-right\">\n                            <img class=\"lazy\" src=\"/src/front_assets/svg/rating.svg\">\n                            <span class=\"py-4\">4.3</span>\n                        </div>\n                    </div>\n                </div>\n            </div>\n            \n            <div class=\"shadow-lg bg-white px-8 py-10 rounded-2xl mb-10\">\n                <img class=\"rounded-full my-1 w-10 lazy\" src=\"/src/front_assets//svg/testimonial.svg\">\n                <p class=\"py-4\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non.</p>\n                <div class=\"flex w-full\">\n                    <div class=\"flex gap-4 w-full\">\n                        <img class=\"w-12 h-12 rounded-full lazy\" src=\"/src/front_assets/img/profile-1.png\">\n                        <span class=\"py-4\">Janne Cooper</span>\n                    </div>\n                    <div class=\"flex-end  w-full text-end\">\n                        <div class=\"flex gap-4 float-right\">\n                            <img class=\"lazy\" src=\"/src/front_assets/svg/rating.svg\">\n                            <span class=\"py-4\">4.3</span>\n                        </div>\n                    </div>\n                </div>\n            </div>\n            \n            <div class=\"shadow-lg bg-white px-8 py-10 rounded-2xl mb-10\">\n                <img class=\"rounded-full my-1 w-10 lazy\" src=\"/src/front_assets//svg/testimonial.svg\">\n                <p class=\"py-4\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non.</p>\n                <div class=\"flex w-full\">\n                    <div class=\"flex gap-4 w-full\">\n                        <img class=\"w-12 h-12 rounded-full lazy\" src=\"/src/front_assets/img/profile-1.png\">\n                        <span class=\"py-4\">Janne Cooper</span>\n                    </div>\n                    <div class=\"flex-end  w-full text-end\">\n                        <div class=\"flex gap-4 float-right\">\n                            <img class=\"lazy\" src=\"/src/front_assets/svg/rating.svg\">\n                            <span class=\"py-4\">4.3</span>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </div>\n    </div>\n</div></div></section><section id=\"kpg_816\" class=\"kedit\" style=\"\"><div class=\"keditable keditable-auto\"><div class=\"w-full\"><div id=\"main-newsletter\" class=\"relative overflow-hidden mb-2\">\n        <img class=\"w-full absolute lazy\" src=\"/src/front_assets/img/newsletter-bg.png\">\n        <div class=\"lg:flex w-full relative\">\n            <div class=\"w-1/2\"></div>\n            <div class=\"lg:w-1/2 w-full text-white px-2 lg:px-0\">\n                <h5 class=\"text-xl lg:text-4xl lg:w-96 lg:pt-20 pt-2\">Get more discount  Off your order</h5>\n                <p class=\"pt-2\">Join our mailing list</p>\n                <div class=\"flex gap-4 lg:py-10 py-2\">\n                    <input class=\"bg-white rounded-lg lg:py-4 py-2 px-4 lg:px-6\" placeholder=\"Your email address\">\n                    <button type=\"submit\" class=\" bg-red-600 text-white rounded-lg px-4 lg:px-6 lg:py-4 py-2  border-0\" value=\"send\">Send now</button>\n                </div>\n            </div>\n        </div>\n    </div></div></div></section>\n    \n\n    <section id=\"kedit_6dk7f9x0k\" class=\"kedit\" style=\"\"><div class=\"keditable keditable-auto\">\n    \n    </div></section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>', NULL, NULL, NULL, NULL, NULL, '2024-05-11 21:54:59', '2024-05-12 18:58:55'),
(48, 1, 'Medians\\Pages\\Domain\\Page', 'homepage20240511', 'arabic', 'الرئيسية', NULL, NULL, '', '', '', NULL, '2024-05-11 21:54:59', '2024-05-15 20:14:42'),
(51, 9, 'Medians\\Categories\\Domain\\Category', 'office', 'english', 'office', 'office', NULL, NULL, NULL, NULL, NULL, '2024-05-12 03:54:41', NULL),
(52, 9, 'Medians\\Categories\\Domain\\Category', 'المكاتب', 'arabic', 'المكاتب', 'المكاتب', NULL, NULL, NULL, NULL, NULL, '2024-05-12 03:54:41', NULL),
(61, 2, 'Medians\\Pages\\Domain\\Page', 'about', 'english', 'About', '<section id=\"kpg_528067\" class=\"kedit\"><div class=\"keditable keditable-auto\"><div class=\"w-full\"><div id=\"main-testimonials\" class=\"overflow-hidden\">\n        <div class=\"text-center pt-10\">\n            <span class=\"text-red-400\">Testimonials</span>\n            <h4 class=\"text-2xl py-2\">What our customer say</h4>\n            <p class=\"max-w-lg mx-auto\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non purus parturient.</p>\n        </div>\n\n        <div class=\"pb-20 pt-10 lg:flex lg:mx-[-40px] gap-12 lg:px-0 px-4\">\n            \n            <div class=\"shadow-lg bg-white px-8 py-10 rounded-2xl mb-10\">\n                <img class=\"rounded-full my-1 w-10 lazy\" src=\"/src/front_assets//svg/testimonial.svg\">\n                <p class=\"py-4\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non.</p>\n                <div class=\"flex w-full\">\n                    <div class=\"flex gap-4 w-full\">\n                        <img class=\"w-12 h-12 rounded-full lazy\" src=\"/src/front_assets/img/profile-1.png\">\n                        <span class=\"py-4\">Janne Cooper</span>\n                    </div>\n                    <div class=\"flex-end  w-full text-end\">\n                        <div class=\"flex gap-4 float-right\">\n                            <img class=\"lazy\" src=\"/src/front_assets/svg/rating.svg\">\n                            <span class=\"py-4\">4.3</span>\n                        </div>\n                    </div>\n                </div>\n            </div>\n            \n            <div class=\"shadow-lg bg-white px-8 py-10 rounded-2xl mb-10\">\n                <img class=\"rounded-full my-1 w-10 lazy\" src=\"/src/front_assets//svg/testimonial.svg\">\n                <p class=\"py-4\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non.</p>\n                <div class=\"flex w-full\">\n                    <div class=\"flex gap-4 w-full\">\n                        <img class=\"w-12 h-12 rounded-full lazy\" src=\"/src/front_assets/img/profile-1.png\">\n                        <span class=\"py-4\">Janne Cooper</span>\n                    </div>\n                    <div class=\"flex-end  w-full text-end\">\n                        <div class=\"flex gap-4 float-right\">\n                            <img class=\"lazy\" src=\"/src/front_assets/svg/rating.svg\">\n                            <span class=\"py-4\">4.3</span>\n                        </div>\n                    </div>\n                </div>\n            </div>\n            \n            <div class=\"shadow-lg bg-white px-8 py-10 rounded-2xl mb-10\">\n                <img class=\"rounded-full my-1 w-10 lazy\" src=\"/src/front_assets//svg/testimonial.svg\">\n                <p class=\"py-4\">Pellentesque etiam blandit in tincidunt at donec. Eget ipsum dignissim placerat nisi, adipiscing mauris non.</p>\n                <div class=\"flex w-full\">\n                    <div class=\"flex gap-4 w-full\">\n                        <img class=\"w-12 h-12 rounded-full lazy\" src=\"/src/front_assets/img/profile-1.png\">\n                        <span class=\"py-4\">Janne Cooper</span>\n                    </div>\n                    <div class=\"flex-end  w-full text-end\">\n                        <div class=\"flex gap-4 float-right\">\n                            <img class=\"lazy\" src=\"/src/front_assets/svg/rating.svg\">\n                            <span class=\"py-4\">4.3</span>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </div>\n    </div>\n</div></div></section>\n    \n\n    <section id=\"kedit_imkvo45rd\" class=\"kedit\" style=\"\"><div class=\"keditable keditable-auto\">\n    \n    </div></section>', NULL, NULL, NULL, NULL, NULL, '2024-05-12 18:10:43', '2024-05-12 18:11:32'),
(62, 2, 'Medians\\Pages\\Domain\\Page', 'about20240512', 'arabic', 'من نحن', NULL, NULL, 'من نحن', '', '', NULL, '2024-05-12 18:10:43', '2024-05-15 20:06:45'),
(93, 12, 'Medians\\Categories\\Domain\\Category', 'meeting-tables', 'english', 'Meeting tables', 'Meeting tables', NULL, NULL, NULL, NULL, NULL, '2024-05-12 18:37:30', NULL),
(94, 12, 'Medians\\Categories\\Domain\\Category', 'ترابيزات-اجتماعات', 'arabic', 'ترابيزات اجتماعات', 'ترابيزات اجتماعات', NULL, NULL, NULL, NULL, NULL, '2024-05-12 18:37:30', NULL),
(99, 11, 'Medians\\Categories\\Domain\\Category', 'accessories', 'english', 'Accessories', 'Classic blue jeans', NULL, NULL, NULL, NULL, NULL, '2024-05-12 18:43:28', NULL),
(100, 11, 'Medians\\Categories\\Domain\\Category', 'اكسسوارات', 'arabic', 'اكسسوارات', 'Classic blue jeans', NULL, NULL, NULL, NULL, NULL, '2024-05-12 18:43:28', NULL),
(103, 10, 'Medians\\Categories\\Domain\\Category', 'manager_chairs', 'english', 'Manager chairs', 'Manager chairs', NULL, NULL, NULL, NULL, NULL, '2024-05-12 18:44:25', NULL),
(104, 10, 'Medians\\Categories\\Domain\\Category', 'مكاتب_مديرين', 'arabic', 'مكاتب مديرين', 'مكاتب مديرين', NULL, NULL, NULL, NULL, NULL, '2024-05-12 18:44:25', NULL),
(105, 8, 'Medians\\Categories\\Domain\\Category', 'chairs', 'english', 'Chairs', 'Chairs', NULL, 'a', 'b', 'v', NULL, '2024-05-12 18:44:41', NULL),
(106, 8, 'Medians\\Categories\\Domain\\Category', 'كراسي', 'arabic', 'كراسي', 'كراسي', NULL, NULL, NULL, NULL, NULL, '2024-05-12 18:44:41', NULL);
INSERT INTO `cms_content` (`id`, `item_id`, `item_type`, `prefix`, `lang`, `title`, `content`, `short`, `seo_title`, `seo_desc`, `seo_keywords`, `inserted_by`, `created_at`, `updated_at`) VALUES
(113, 3, 'Medians\\Pages\\Domain\\Page', 'shop', 'english', 'Shop', '<section id=\"kedit_mzaa86uh5\" class=\"kedit\">\n    <section id=\"kedit_k77svawof\" class=\"kedit\" style=\"\">\n    <section id=\"kpg_676308\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_opkzwbvld\" class=\"kedit\" style=\"\">\n    <section id=\"kpg_214049\" class=\"kedit\" style=\"\"><div class=\"keditable keditable-auto\"><div class=\"w-full\"><section class=\"tc-banner-style4 pt-60 wow fadeInUp slow\" data-wow-delay=\"0.2s\">              <div class=\"container\">                  <div class=\"banner-card\">                      <div class=\"row align-items-center gx-5\">                          <div class=\"col-lg-2 mt-4 mt-lg-0\">                              <div class=\"bn-logo\">                                  <img alt=\"\" class=\"lazy\" title=\"\" src=\"/uploads/img/medians-logo.png\">                              </div>                          </div>                          <div class=\"col-lg-4 order-last order-lg-0 mt-4 mt-lg-0\">                              <div class=\"img\">                                  <img alt=\"\" class=\"lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/bn_img.png\">                              </div>                          </div>                          <div class=\"col-lg-4 mt-4 mt-lg-0\">                              <div class=\"inf\">                                  <small class=\"fsz-13 d-block mb-2\"> Pay with 4 installment, 0% interest </small>                                  <h4 class=\"fsz-30 fw-bold\"> Buy Now, <span class=\"fw-300\"> Pay Later </span> </h4>                              </div>                          </div>                          <div class=\"col-lg-2 mt-4 mt-lg-0\">                              <a href=\"#\" class=\"butn md-butn color-000 bg-white radius-2 fw-600 fsz-12 text-uppercase\"> <span> Discover Now </span> </a>                          </div>                      </div>                  </div>              </div>          </section></div></div></section>\n    \n\n    <section id=\"kedit_fnbpce08g\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_kb2fqqhyl\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_l80mf22dw\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_yqrkk1nde\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_uxta2tzqw\" class=\"kedit\" style=\"\">\n    <section id=\"kpg_435625\" class=\"kedit\" style=\"\"><div class=\"keditable keditable-auto\"><div class=\"w-full\"><section class=\"tc-popular-cat-style1 pt-30 pb-50\">\n    <div class=\"container\">\n        <div class=\"search-cat d-block d-lg-none\">\n            <div class=\"input-group\">\n                <select name=\"name\" class=\"form-select\">\n                    <option value=\"\"> All Categories </option>\n                    <option value=\"\"> Categories 1 </option>\n                    <option value=\"\"> Categories 2 </option>\n                </select>\n                <input type=\"text\" class=\"form-control\" placeholder=\"Search anything...\">\n                <a href=\"#\" class=\"search-btn\"> <i class=\"fal fa-search\"></i> </a>\n            </div>\n        </div>\n        <div class=\"sec-title\">\n            <div class=\"row align-items-center\">\n                <div class=\"col-lg-6\">\n                    <h3 class=\"fsz-24 text-capitalize\"> Popular Categories </h3>\n                </div>\n                <div class=\"col-lg-6 text-lg-end mt-4 mt-lg-0\">\n                    <a href=\"#0\" class=\"more-link text-capitalize\"> View All <i class=\"la la-angle-right ms-1\"></i> </a>\n                </div>\n            </div>\n        </div>\n        <div class=\"cat-content\">\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img alt=\"\" class=\"lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat1.png\"></span></a>\n                \n                <strong class=\"block fsz-13 fw-bold mt-15\"> Gaming </strong>\n            </div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img alt=\"\" class=\"lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat2.png\"></span></a>\n                \n                <strong class=\"block fsz-13 fw-bold mt-15\"> Sport Equip </strong>\n            </div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img alt=\"\" class=\"lazy\" title=\"\" src=\"/uploads/images/1-6640de92df1a7.jpg\"></span></a>\n                \n                <strong class=\"block fsz-13 fw-bold mt-15\"> Kitchen </strong>\n            </div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img alt=\"\" class=\"lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat4.png\"></span></a>\n                \n                <strong class=\"block fsz-13 fw-bold mt-15\"> Robot Cleaner </strong>\n            </div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img alt=\"\" class=\"lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat5.png\"></span></a>\n                \n                <strong class=\"block fsz-13 fw-bold mt-15\"> Mobiles </strong>\n            </div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img alt=\"\" class=\"lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat6.png\"></span></a>\n                \n                <strong class=\"block fsz-13 fw-bold mt-15\"> Office </strong>\n            </div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img alt=\"\" class=\"lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat7.png\"></span></a>\n                \n                <strong class=\"block fsz-13 fw-bold mt-15\"> Cameras </strong>\n            </div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img alt=\"\" class=\"lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat8.png\"></span></a>\n                \n                <strong class=\"block fsz-13 fw-bold mt-15\"> Computers </strong>\n            </div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img alt=\"\" class=\"lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat9.png\"></span></a>\n                \n                <strong class=\"block fsz-13 fw-bold mt-15\"> Televisions </strong>\n            </div>\n            <div><a href=\"../inner_pages/products.html\" class=\"cat-card\"> \n                <span class=\"img\">\n                    <img alt=\"\" class=\"lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/cat/cat10.png\"></span></a>\n                \n                <strong class=\"block fsz-13 fw-bold mt-15\"> Audios </strong>\n            </div>\n        </div>\n    </div>\n</section>\n<!--  End popular cat  -->\n</div></div></section>\n    \n\n    <section id=\"kedit_dfh9gf58e\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_qdwn0rw2x\" class=\"kedit\" style=\"\">\n    \n    \n\n    <section id=\"kedit_3xyo31bxk\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_ypntqwcba\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_6obvw1kpj\" class=\"kedit\" style=\"\">\n    \n    \n\n    <section id=\"kedit_g3rw545cv\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_vd0k0elo7\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_lujt1br7x\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_k1ywubxbl\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_j237npjnp\" class=\"kedit\" style=\"\">\n    \n    \n\n    <section id=\"kedit_qhm7ld9mm\" class=\"kedit\" style=\"\">\n    \n    \n\n    <section id=\"kedit_a9aklygmk\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_r831eg0xs\" class=\"kedit\" style=\"\">\n    <section id=\"kpg_502251\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_urcyy0vmn\" class=\"kedit\" style=\"\">\n    <section id=\"kpg_435204\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_fl8qwkvtu\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_1fejy7ykc\" class=\"kedit\" style=\"\">\n    <section id=\"kedit_p1zofqvga\" class=\"kedit\" style=\"\">\n    <section id=\"kpg_647149\" class=\"kedit\" style=\"\"><div class=\"keditable keditable-auto\">\n	<div class=\"w-full\">\n		<section class=\"tc-blog-style4 pt-60 pb-60 wow fadeInUp slow\" data-wow-delay=\"0.2s\" style=\"animation-delay: 0.2s; animation-name: none;\">\n			<div class=\"container\">\n				<div class=\"section-title-style4 mb-40\">\n					<div class=\"row\">\n						<div class=\"col-lg-8\">\n							<h4 class=\"fsz-30 fw-400\">\n								<b class=\"color-cyan2\">\n									What’s New\n								</b>\n								Today\n							</h4>\n						</div>\n						<div class=\"col-lg-4 text-lg-end mt-3 mt-lg-0\">\n							<a href=\"#\" class=\"more text-capitalize color-666 fsz-13 hover-cyan2\">\n								see More articles\n								<i class=\"la la-angle-right ms-1\"></i>\n							</a>\n						</div>\n					</div>\n				</div>\n				<div class=\"blog-content\">\n					<div class=\"row\">\n						<div class=\"col-lg-4\">\n							<div class=\"overlay-card mb-4 mb-lg-0\">\n								<div class=\"img\">\n									<img alt=\"\" class=\"main-img img-cover lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/blog1.jpg\">\n								</div>\n								<div class=\"info text-white\">\n									<a href=\"#\" class=\"title fsz-18 fw-600 d-block lh-3 hover-underline\">\n										Babies in Winter: How to protect your newborn in cold weather</a>\n									<small class=\"fsz-12 mt-15\">\n										45 Minutes ago in Experience\n									</small>\n								</div>\n							</div>\n						</div>\n						<div class=\"col-lg-8\">\n							<div class=\"sub-blog\">\n								<div class=\"row\">\n									<div class=\"col-lg-6\">\n										<div class=\"blog-card pt-0\">\n											<div class=\"row gx-4\">\n												<div class=\"col-5\">\n													<div class=\"img th-100 radius-4 overflow-hidden\">\n														<img alt=\"\" class=\"img-cover lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/blog2.jpg\">\n													</div>\n												</div>\n												<div class=\"col-7\">\n													<div class=\"info\">\n														<a href=\"#\" class=\"title\">\n															Omicron in Kids: Here’s what parents should know</a>\n														<small class=\"fsz-12 color-666 d-block w-100\">\n															45 Minutes ago in\n															<span class=\"color-000\">\n																Experience\n															</span>\n														</small>\n													</div>\n												</div>\n											</div>\n										</div>\n									</div>\n									<div class=\"col-lg-6\">\n										<div class=\"blog-card pt-0\">\n											<div class=\"row gx-4\">\n												<div class=\"col-5\">\n													<div class=\"img th-100 radius-4 overflow-hidden\">\n														<img alt=\"\" class=\"img-cover lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/blog3.jpg\">\n													</div>\n												</div>\n												<div class=\"col-7\">\n													<div class=\"info\">\n														<a href=\"#\" class=\"title\">\n															Insight into dadliness</a>\n														<small class=\"fsz-12 color-666 d-block w-100\">\n															2 Days ago in\n															<span class=\"color-000\">\n																Infant\n															</span>\n														</small>\n													</div>\n												</div>\n											</div>\n										</div>\n									</div>\n									<div class=\"col-lg-6\">\n										<div class=\"blog-card pb-0 border-0\">\n											<div class=\"row gx-4\">\n												<div class=\"col-5\">\n													<div class=\"img th-100 radius-4 overflow-hidden\">\n														<img alt=\"\" class=\"img-cover lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/blog4.jpg\">\n													</div>\n												</div>\n												<div class=\"col-7\">\n													<div class=\"info\">\n														<a href=\"#\" class=\"title\">\n															Fun facts about January Babies</a>\n														<small class=\"fsz-12 color-666 d-block w-100\">\n															1 Day ago in\n															<span class=\"color-000\">\n																Life Style\n															</span>\n														</small>\n													</div>\n												</div>\n											</div>\n										</div>\n									</div>\n									<div class=\"col-lg-6\">\n										<div class=\"blog-card pb-0 border-0\">\n											<div class=\"row gx-4\">\n												<div class=\"col-5\">\n													<div class=\"img th-100 radius-4 overflow-hidden\">\n														<img alt=\"\" class=\"img-cover lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/blog5.jpg\">\n													</div>\n												</div>\n												<div class=\"col-7\">\n													<div class=\"info\">\n														<a href=\"#\" class=\"title\">\n															Your handy guide to revamp the nursery</a>\n														<small class=\"fsz-12 color-666 d-block w-100\">\n															2 Days ago in\n															<span class=\"color-000\">\n																Pregnancy &amp; Postpartum\n															</span>\n														</small>\n													</div>\n												</div>\n											</div>\n										</div>\n									</div>\n								</div>\n							</div>\n						</div>\n					</div>\n				</div>\n			</div>\n		</section>\n	</div>\n</div>\n</section>\n    \n\n    <section id=\"kedit_2wkk6161v\" class=\"kedit\" style=\"\">\n    \n    \n\n    <section id=\"kedit_23iuuskr9\" class=\"kedit\" style=\"\">\n    \n    \n\n    <section id=\"kedit_3t0tj6dls\" class=\"kedit\" style=\"\">\n    <section id=\"kpg_556521\" class=\"kedit\" data-padding=\"0-80\" style=\";padding-top:0px;padding-bottom:80px\"><div class=\"keditable keditable-auto\"><div class=\"w-full\"><section class=\"tc-main-banner-style1 wow fadeInUp slow  animated\" data-wow-delay=\"0.2s\" style=\"visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;\">              <div class=\"container\">                  <div class=\"banner\">                      <div class=\"row align-items-center\">                          <div class=\"col-lg-2\">                              <h6 class=\"fsz-24 text-uppercase color-cyan1 lh-1\"> Pre Order </h6>                              <small class=\"fsz-10 color-999 text-uppercase\"> be the first to own </small>                              <p class=\"fsz-14 mt-2 text-white\"> From $399 </p>                          </div>                          <div class=\"col-lg-4 order-last order-lg-0\">                              <div class=\"img\">                                  <img alt=\"\" class=\"lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/banner.png\">                              </div>                          </div>                          <div class=\"col-lg-4 mt-3 mt-lg-0\">                              <small class=\"fsz-12 color-cyan1\"> Opplo Watch Sport <br> Series 8 </small>                              <h3 class=\"fsz-30 mt-10 fw-300 text-white\"> A healthy leap ahead </h3>                          </div>                          <div class=\"col-lg-2 mt-4 mt-lg-0\">                              <div class=\"text-lg-end\">                                  <a href=\"../inner_pages/single_product.html\" class=\"butn px-4 pt-10 pb-10 bg-white color-000 rounded-pill fw-600\"> <span> Discover Now </span> </a>                              </div>                          </div>                      </div>                  </div>              </div>          </section></div></div></section>\n    \n\n    \n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n<section id=\"kedit_hxlllbw8a\" class=\"kedit\" style=\"\"><div class=\"keditable keditable-auto\"><div class=\"w-full\"><section class=\"tc-weekly-deals-style1 wow fadeInUp slow\" data-wow-delay=\"0.2s\" style=\"visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;\">              <div class=\"container\">                  <div class=\"content\">                      <div class=\"title mb-40\">                          <h3 class=\"fsz-30 me-lg-5\"> Best Weekly Deals </h3>                          <div class=\"countdown bg-red1 text-white\">                              <span class=\"icon me-2\"> <i class=\"las la-hourglass-half\"></i> </span>                               <p class=\"me-2\"> Expires in: </p>                              <div class=\"item\">                                  <span id=\"days\">-7</span>                                  <span> d </span>                              </div>                              <span> : </span>                              <div class=\"item\">                                  <span id=\"hours\">-05</span>                                  <span> h </span>                              </div>                              <span> : </span>                              <div class=\"item\">                                  <span id=\"minutes\">-16</span>                                  <span> m </span>                              </div>                              <span> : </span>                              <div class=\"item\">                                  <span id=\"seconds\">-09</span>                                  <span> s </span>                              </div>                          </div>                          <!-- <div class=\"arrows ms-auto\">                               <a href=\"#0\" class=\"swiper-prev\"> <i class=\"fal fa-chevron-left\"></i> </a>                                  <a href=\"#0\" class=\"swiper-next ms-lg-1\"> <i class=\"fal fa-chevron-right\"></i> </a>                              </div> -->                      </div>                      <div class=\"deals-cards\">                          <div class=\"column-sm\">                              <div class=\"deal-card\">                                  <div class=\"top\">                                      <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav active\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod1.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-140 mb-20 d-block\">                                      <img alt=\"\" class=\"img-contain lazy\" title=\"\" src=\"/uploads/images/1-6640de92df1a7.jpg\"></a>                                                                    <div class=\"info\">                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 15% OFF </span>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Air Purifier with <br> True HEPA H14 Filter </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star\"></i>                                          <span> (5) </span>                                      </div>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $489.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $619.00 </span> </p>                                      <div class=\"progress mt-20\">                                          <div class=\"progress-bar bg-blue1\" role=\"progressbar\" style=\"width: 25%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>                                      </div>                                      <p class=\"fsz-12 mt-3\"> Sold: 24 / 80 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"deal-card\">                                  <div class=\"top\">                                      <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav active\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod2.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-140 mb-20 d-block\">                                      <img alt=\"\" class=\"img-contain lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod2.png\"></a>                                                                    <div class=\"info\">                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white\"> 5% OFF </span>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Shaork Robot Vacuum with Self-Empty Base </a>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $325.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $428.00 </span> </p>                                      <div class=\"progress mt-20\">                                          <div class=\"progress-bar bg-blue1\" role=\"progressbar\" style=\"width: 5%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>                                      </div>                                      <p class=\"fsz-12 mt-3\"> Sold: 1 / 19 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                          </div>                          <div class=\"column-lg\">                              <div class=\"deal-card\">                                  <div class=\"top\">                                      <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav active\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod3.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-600 mb-20 d-block\">                                      <img alt=\"\" class=\"img-contain lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod3.png\"></a>                                                                    <div class=\"info\">                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 15% OFF </span>                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-blue1 text-white text-uppercase\"> best seller </span>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Durotan Manual Espresso Machine, Latte, Cappuccino Maker &amp; Espresso Machine. </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <span> (34) </span>                                      </div>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $489.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $619.00 </span> </p>                                      <div class=\"progress mt-20\">                                          <div class=\"progress-bar bg-blue1\" role=\"progressbar\" style=\"width: 90%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>                                      </div>                                      <p class=\"fsz-12 mt-3\"> Sold: 82 / 100 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                          </div>                          <div class=\"column-sm\">                              <div class=\"deal-card\">                                  <div class=\"top\">                                      <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav active\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod4.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-140 mb-20 d-block\">                                      <img alt=\"\" class=\"img-contain lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod4.png\"></a>                                                                    <div class=\"info\">                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 15% OFF </span>                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-green1 text-white text-uppercase\"> top rated </span>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Sona QLED Ultra HD 4k Smart Android TV 59’ </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <span> (2) </span>                                      </div>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $1,759.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $2,069.00 </span> </p>                                      <div class=\"progress mt-20\">                                          <div class=\"progress-bar bg-blue1\" role=\"progressbar\" style=\"width: 8%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>                                      </div>                                      <p class=\"fsz-12 mt-3\"> Sold: 7 / 85 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"deal-card\">                                  <div class=\"top\">                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav active\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod5.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-140 mb-20 d-block\">                                      <img alt=\"\" class=\"img-contain lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod5.png\"></a>                                                                    <div class=\"info\">                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white\"> pre-order </span>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Shaork Robot Vacuum with Self-Empty Base </a>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $325.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $428.00 </span> </p>                                      <div class=\"progress mt-20\">                                          <div class=\"progress-bar bg-blue1\" role=\"progressbar\" style=\"width: 5%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>                                      </div>                                      <p class=\"fsz-12 mt-3\"> Sold: 1 / 19 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                          </div>                          <div class=\"column-sm\">                              <div class=\"deal-card\">                                  <div class=\"top\">                                      <small class=\"fsz-11 py-1 px-3 rounded-pill color-red1 border-red1 border\"> 0% Installment </small>                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav active\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod6.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-140 mb-20 d-block\">                                      <img alt=\"\" class=\"img-contain lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod6.png\"></a>                                                                    <div class=\"info\">                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white text-uppercase\"> 15% OFF </span>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Air Purifier with <br> True HEPA H14 Filter </a>                                      <div class=\"stars fsz-13 mt-2\">                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star active\"></i>                                          <i class=\"fas fa-star\"></i>                                          <span> (5) </span>                                      </div>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $489.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $619.00 </span> </p>                                      <div class=\"progress mt-20\">                                          <div class=\"progress-bar bg-blue1\" role=\"progressbar\" style=\"width: 25%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>                                      </div>                                      <p class=\"fsz-12 mt-3\"> Sold: 24 / 80 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                              <div class=\"deal-card\">                                  <div class=\"top\">                                      <div class=\"icons\">                                          <a href=\"#0\" class=\"icon fav active\"> <i class=\"fal fa-heart\"></i> </a>                                          <a href=\"#0\" class=\"icon\"> <i class=\"fal fa-sync\"></i> </a>                                          <a href=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod7.png\" class=\"icon\" data-fancybox=\"deal\"> <i class=\"fal fa-eye\"></i> </a>                                      </div>                                  </div>                                  <a href=\"../inner_pages/single_product.html\" class=\"img th-140 mb-20 d-block\">                                      <img alt=\"\" class=\"img-contain lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_electronic/assets/img/products/prod7.png\"></a>                                                                    <div class=\"info\">                                      <span class=\"label fsz-11 py-1 px-3 rounded-pill bg-red1 text-white\"> 5% OFF </span>                                      <a href=\"../inner_pages/single_product.html\" class=\"title fsz-14 mt-15 fw-600 hover-blue1\"> Shaork Robot Vacuum with Self-Empty Base </a>                                      <p class=\"price color-red1 mt-2 fsz-20\"> $325.00 <span class=\"old-price color-999 text-decoration-line-through ms-2 fsz-16\"> $428.00 </span> </p>                                      <div class=\"progress mt-20\">                                          <div class=\"progress-bar bg-blue1\" role=\"progressbar\" style=\"width: 5%\" aria-valuenow=\"25\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>                                      </div>                                      <p class=\"fsz-12 mt-3\"> Sold: 1 / 19 </p>                                  </div>                                  <a href=\"#0\" class=\"cart-btn addCart\"> <i class=\"la la-cart-plus me-1\"></i> Add To Cart </a>                              </div>                          </div>                      </div>                      <div class=\"text-center mt-30\">                          <a href=\"../inner_pages/products.html\" class=\"butn px-5 py-3 bg-white color-000 rounded-pill fw-600\"> <span> See All Products (63) </span> </a>                      </div>                  </div>              </div>          </section></div></div></section>\n    </section>\n<section id=\"kpg_993226\" class=\"kedit\" data-padding=\"40-40\" style=\";padding-top:40px;padding-bottom:40px\"><div class=\"keditable keditable-auto\"><div class=\"w-full\"><div id=\"main-center2\" class=\"relative lg:py-10\">\n        <div style=\"max-height: 500px;\" class=\"hidden lg:block w-1/2 absolute overflow-hidden right-0\"><img class=\"w-full lazy\" src=\"/src/front_assets/img/center-2.png\"></div>\n        <div class=\"container mx-auto lg:flex \">\n            <div class=\"w-full pt-4 pb-10 px-10\">\n                <div class=\"flex w-full pb-6\">\n                    <h3 class=\"text-2xl w-full\"><span class=\"\">Office</span> Most-popular</h3>\n                    <a class=\"flex-end bg-gray-200 py-2 w-40 text-center hover:bg-red-200\" href=\"#\">View more</a>\n                </div>\n                <div class=\"flex gap-4\">\n                    <div class=\"text-center\">\n                        <img class=\"lazy\" src=\"/src/front_assets/img/section2-product-1.png\">\n                        <div class=\"text-center py-2\">\n                            <h4><a class=\"text-xl\" href=\"#\">Body Spray</a></h4>\n                            <p><del>120$</del><span>99$</span></p>\n                        </div>\n                    </div>\n                    <div class=\"text-center\">\n                        <img class=\"lazy\" src=\"/src/front_assets/img/section2-product-2.png\">\n                        <div class=\"text-center py-2\">\n                            <h4><a class=\"text-xl\" href=\"#\">Body Spray</a></h4>\n                            <p><del>120$</del><span>99$</span></p>\n                        </div>\n                    </div>\n\n                </div>\n            </div>\n            <div class=\"w-full\"></div>\n        </div>\n    </div></div></div></section></section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section>\n    </section><section id=\"kpg_693213\" class=\"kedit\" style=\"\"><div class=\"keditable keditable-auto\"><div class=\"w-full\"><section class=\"tc-banner-style4 pt-60 wow fadeInUp slow\" data-wow-delay=\"0.2s\">              <div class=\"container\">                  <div class=\"banner-card\">                      <div class=\"row align-items-center gx-5\">                          <div class=\"col-lg-2 mt-4 mt-lg-0\">                              <div class=\"bn-logo\">                                  <img alt=\"\" class=\"lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/bn_logo.png\">                              </div>                          </div>                          <div class=\"col-lg-4 order-last order-lg-0 mt-4 mt-lg-0\">                              <div class=\"img\">                                  <img alt=\"\" class=\"lazy\" src=\"https://ui-themez.smartinnovates.net/items/swoo_html/home_baby/assets/img/bn_img.png\">                              </div>                          </div>                          <div class=\"col-lg-4 mt-4 mt-lg-0\">                              <div class=\"inf\">                                  <small class=\"fsz-13 d-block mb-2\"> Pay with 4 installment, 0% interest </small>                                  <h4 class=\"fsz-30 fw-bold\"> Buy Now, <span class=\"fw-300\"> Pay Later </span> </h4>                              </div>                          </div>                          <div class=\"col-lg-2 mt-4 mt-lg-0\">                              <a href=\"#\" class=\"butn md-butn color-000 bg-white radius-2 fw-600 fsz-12 text-uppercase\"> <span> Discover Now </span> </a>                          </div>                      </div>                  </div>              </div>          </section></div></div></section>\n    </section>\n\n    </section>\n    </section>', NULL, '', '', '', NULL, '2024-05-12 22:42:46', '2024-05-13 22:47:50'),
(114, 3, 'Medians\\Pages\\Domain\\Page', 'اتصل_بنا', 'arabic', 'إتصل بنا', NULL, NULL, 'إتصل بنا', '', '', NULL, '2024-05-12 22:42:46', '2024-05-15 20:01:37'),
(117, 1, 'Medians\\Templates\\Domain\\WebTemplate', 'default', 'english', 'Default', NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-13 01:55:16', '2024-05-13 01:55:16'),
(118, 1, 'Medians\\Templates\\Domain\\WebTemplate', 'default20240513', 'arabic', 'Default', NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-13 01:55:16', '2024-05-13 01:55:16'),
(119, 2, 'Medians\\Templates\\Domain\\WebTemplate', 'ecommerce', 'english', 'Ecommerce', NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-13 02:23:41', '2024-05-13 02:23:41'),
(120, 2, 'Medians\\Templates\\Domain\\WebTemplate', 'ecommerce20240513', 'arabic', 'Ecommerce', NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-13 02:23:41', '2024-05-13 02:23:41'),
(153, 21, 'Medians\\Products\\Domain\\Product', '10', 'english', 'product for testing', '10', 'product for testing', NULL, NULL, NULL, NULL, '2024-05-14 21:00:36', NULL),
(154, 21, 'Medians\\Products\\Domain\\Product', '11', 'arabic', '11', '11', NULL, NULL, NULL, NULL, NULL, '2024-05-14 21:00:36', NULL),
(157, 23, 'Medians\\Products\\Domain\\Product', 'test120240512', 'english', 'test1', 'test1', NULL, NULL, NULL, NULL, NULL, '2024-05-14 21:17:08', NULL),
(158, 23, 'Medians\\Products\\Domain\\Product', 'تجربة120240512', 'arabic', 'تجربة1', 'تجربة1', NULL, NULL, NULL, NULL, NULL, '2024-05-14 21:17:08', NULL),
(167, 22, 'Medians\\Products\\Domain\\Product', 'test1', 'english', 'test product item', 'test1', 'test product item short description', NULL, NULL, NULL, NULL, '2024-05-14 21:18:52', NULL),
(168, 22, 'Medians\\Products\\Domain\\Product', 'تجربة1', 'arabic', 'تجربة1', 'تجربة1', NULL, NULL, NULL, NULL, NULL, '2024-05-14 21:18:52', NULL),
(171, 20, 'Medians\\Products\\Domain\\Product', 'prod1', 'english', 'prod', 'prod1', 'Short description of the product', '1', '2', '3', NULL, '2024-05-14 21:24:21', NULL),
(172, 20, 'Medians\\Products\\Domain\\Product', 'منتج1', 'arabic', 'منتج1', 'منتج1', 'Short description of the product', '4', '25', '66', NULL, '2024-05-14 21:24:21', NULL),
(191, 13, 'Medians\\Categories\\Domain\\Category', 'sofa', 'english', 'Sofa', 'Sofa', '', '', '', '', 0, '2024-05-16 04:25:27', NULL),
(192, 13, 'Medians\\Categories\\Domain\\Category', 'كنب', 'arabic', 'كنب', 'كنب', '', '', '', '', 0, '2024-05-16 04:25:27', NULL),
(193, 15, 'Medians\\Categories\\Domain\\Category', 'warehouses', 'english', 'Warehouses', 'Warehouses', NULL, NULL, NULL, NULL, NULL, '2024-05-16 04:27:20', NULL),
(194, 15, 'Medians\\Categories\\Domain\\Category', 'خزانات', 'arabic', 'خزانات', 'خزانات', NULL, NULL, NULL, NULL, NULL, '2024-05-16 04:27:20', NULL),
(209, 25, 'Medians\\Products\\Domain\\Product', 'opod_pro_12.9_inch_m1_2023,_64gb___wifi,_gps', 'english', 'OPod Pro 12.9 Inch M1 2023, 64GB + Wifi, GPS', '', 'OPod Pro 12.9 Inch M1 2023, 64GB + Wifi, GPS', '', '', '', 0, '2024-05-16 04:45:38', NULL),
(210, 25, 'Medians\\Products\\Domain\\Product', 'opod_pro_12.9_inch_m1_2023,_64gb___wifi,_gps20240516', 'arabic', 'OPod Pro 12.9 Inch M1 2023, 64GB + Wifi, GPS', '', 'OPod Pro 12.9 Inch M1 2023, 64GB + Wifi, GPS', '', '', '', 0, '2024-05-16 04:45:38', NULL),
(211, 24, 'Medians\\Products\\Domain\\Product', 'srok_smart_phone_128gb,_oled_retina', 'english', 'SROK Smart Phone 128GB, Oled Retina', '', 'SROK Smart Phone 128GB, Oled Retina SROK Smart Phone 128GB, Oled Retina', '', '', '', 0, '2024-05-16 04:46:26', NULL),
(212, 24, 'Medians\\Products\\Domain\\Product', '-2024051620240516', 'arabic', 'Retina -SROK Smart Phone 128GB, Oled ', '', 'Retina -SROK Smart Phone 128GB, Oled ', '', '', '', 0, '2024-05-16 04:46:26', NULL),
(213, 26, 'Medians\\Products\\Domain\\Product', 'counters', 'english', 'Counters', '', 'Counters', '', '', '', 0, '2024-05-16 04:47:32', NULL),
(214, 26, 'Medians\\Products\\Domain\\Product', 'كونترات', 'arabic', 'كونترات', '', 'كونترات', '', '', '', 0, '2024-05-16 04:47:32', NULL),
(217, 28, 'Medians\\Products\\Domain\\Product', 'samsung_galaxy_x6_ultra_lte_4g_128_gb,_black_smartphone', 'english', '-Samsung Galaxy X6 Ultra LTE 4G/128 Gb, Black Smartphone', '', 'Samsung Galaxy X6 Ultra LTE 4G/128 Gb, Black Smartphone', '', '', '', 0, '2024-05-16 04:49:07', NULL),
(218, 28, 'Medians\\Products\\Domain\\Product', 'samsung_galaxy', 'arabic', '-Samsung Galaxy X6 Ultra LTE 4G/128 Gb, Black Smartphone', '', 'Samsung Galaxy X6 Ultra LTE 4G/128 Gb, Black Smartphone', '', '', '', 0, '2024-05-16 04:49:07', NULL),
(221, 30, 'Medians\\Products\\Domain\\Product', 'srok_smart_phone_128gb,_oled_retina20240516', 'english', 'SROK Smart Phone 128GB, Oled Retina', 'prod1', 'SROK Smart Phone 128GB, Oled Retina SROK Smart Phone 128GB, Oled Retina', '1', '2', '3', 0, '2024-05-16 05:17:11', NULL),
(222, 30, 'Medians\\Products\\Domain\\Product', 'srok_smart_phone_128gb,_oled_retina20240516', 'arabic', 'SROK Smart Phone 128GB, Oled Retina', 'منتج1', 'SROK Smart Phone 128GB, Oled Retina', '4', '25', '66', 0, '2024-05-16 05:17:11', NULL),
(223, 31, 'Medians\\Products\\Domain\\Product', 'srok_smart_phone_128gb,_oled_retina20240516', 'english', 'SROK Smart Phone 128GB, Oled Retina', 'prod1', 'SROK Smart Phone 128GB, Oled Retina SROK Smart Phone 128GB, Oled Retina', '1', '2', '3', 0, '2024-05-16 05:17:17', NULL),
(224, 31, 'Medians\\Products\\Domain\\Product', 'srok_smart_phone_128gb,_oled_retina20240516', 'arabic', 'SROK Smart Phone 128GB, Oled Retina', 'منتج1', 'SROK Smart Phone 128GB, Oled Retina', '4', '25', '66', 0, '2024-05-16 05:17:17', NULL),
(229, 27, 'Medians\\Products\\Domain\\Product', 'lenovo_redmi_note_5,_64gb', 'english', 'Lenovo Redmi Note 5, 64GB', '', 'Lenovo Redmi Note 5, 64GB', '', '', '', 0, '2024-05-17 05:45:11', NULL),
(230, 27, 'Medians\\Products\\Domain\\Product', '-202405162024051620240517', 'arabic', '-Lenovo Redmi Note 5, 64GB', '', 'Lenovo Redmi Note 5, 64GB', '', '', '', 0, '2024-05-17 05:45:11', NULL),
(231, 29, 'Medians\\Products\\Domain\\Product', 'srok_smart_phone_128gb,_oled_retina2024051620240517', 'english', 'SROK Smart Phone 128GB, Oled Retina', 'prod1', 'SROK Smart Phone 128GB, Oled Retina SROK Smart Phone 128GB, Oled Retina', '1', '2', '3', 0, '2024-05-17 07:44:45', NULL),
(232, 29, 'Medians\\Products\\Domain\\Product', 'srok_smart_phone_128gb,_oled_retina2024051620240517', 'arabic', 'SROK Smart Phone 128GB, Oled Retina', 'منتج1', 'SROK Smart Phone 128GB, Oled Retina', '4', '25', '66', 0, '2024-05-17 07:44:45', NULL),
(237, 32, 'Medians\\Products\\Domain\\Product', 'srok_smart_phone_128gb,_oled_retina2024051620240520', 'english', 'SROK Smart Phone 128GB, Oled Retina', 'prod1', 'SROK Smart Phone 128GB, Oled Retina SROK Smart Phone 128GB, Oled Retina', '1', '2', '3', 0, '2024-05-20 03:59:36', NULL),
(238, 32, 'Medians\\Products\\Domain\\Product', 'srok_smart_phone_128gb,_oled_retina202405162024052020240520', 'arabic', 'SROK Smart Phone 128GB, Oled Retina', 'منتج1', 'SROK Smart Phone 128GB, Oled Retina', '4', '25', '66', 0, '2024-05-20 03:59:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `compare`
--

CREATE TABLE `compare` (
  `compare_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `message_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(2) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `name`, `status`, `code`, `created_by`) VALUES
(1, 'Egypt', 'on', '', 1),
(2, 'United states', 'on', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `currency_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `main` int(11) DEFAULT NULL,
  `ratio` float NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `last_check` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`currency_id`, `name`, `code`, `symbol`, `main`, `ratio`, `created_at`, `updated_at`, `last_check`) VALUES
(1, 'US Dollar', 'USD', '$', 1, 1, '2024-04-25 03:13:54', '2024-05-18 00:59:10', '2024-05-18'),
(2, 'EG Pound', 'EGP', 'EGP', 0, 46.9064, '2024-04-25 03:13:54', '2024-05-18 00:51:30', '2024-05-18'),
(3, 'Euro', 'EUR', '€', 0, 0.9192, '2024-04-25 03:13:54', '2024-05-18 04:17:35', '2024-05-18'),
(4, 'Nigerian Naira', 'NGN', 'NGN', 0, 1520.4, '2024-04-25 03:13:54', '2024-05-18 00:59:09', '2024-05-18');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') NOT NULL,
  `birth_date` date DEFAULT NULL,
  `generated_password` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE `custom_fields` (
  `field_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_blocks`
--

CREATE TABLE `email_blocks` (
  `id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `email_blocks`
--

INSERT INTO `email_blocks` (`id`, `content`, `category`, `created_by`, `created_at`, `updated_at`) VALUES
(2, '<section>\n    <div class=\"scroll-y flex-column-fluid px-10 py-10\" data-kt-scroll=\"true\" data-kt-scroll-activate=\"true\" data-kt-scroll-height=\"auto\" data-kt-scroll-dependencies=\"#kt_app_header_nav\" data-kt-scroll-offset=\"5px\" data-kt-scroll-save-state=\"true\" style=\"background-color: rgb(213, 217, 226); --kt-scrollbar-color: #d9d0cc; --kt-scrollbar-hover-color: #d9d0cc; min-height: 414px;\">\n    \n            <!--begin::Email template-->      \n            <style>\n                html,body {\n                    padding:0;\n                    margin:0;\n                    font-family: Inter, Helvetica, \"sans-serif\";                                       \n                }            \n    \n                a:hover {\n                    color: #009ef7;\n                }\n            </style>\n            \n            <div id=\"#kt_app_body_content\" style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n                <div style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:40px auto; max-width: 600px;\">\n                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\" style=\"border-collapse:collapse\">\n                        <tbody>                      \n                            <tr>\n                                <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n                                    \n        <!--begin:Email content-->\n        <div style=\"text-align:center; margin:0 60px 34px 60px\"><br></div><div style=\"text-align:center; margin:0 60px 34px 60px\">\n            <!--begin:Logo-->\n            <div style=\"margin-bottom: 10px\">\n                <a href=\"https://newtrip.medianssolutions.com\" rel=\"noopener\" target=\"_blank\">\n                    <img alt=\"Logo\" style=\"height: 35px\" class=\"\" src=\"http://localhost:83/uploads/img/logo.png\"></a>\n                \n            </div>\n            <!--end:Logo-->\n    \n            <!--begin:Media-->\n            <div style=\"margin-bottom: 15px\">\n                <img alt=\"Logo\" class=\"\" src=\"http://localhost:83/uploads/img/icon-prize.svg\"> \n            </div> \n            <!--end:Media-->                            \n    \n            <!--begin:Text-->\n            <div style=\"font-size: 14px; font-weight: 500; margin-bottom: 42px; font-family:Arial,Helvetica,sans-serif\">\n                <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hey {{model.name}},Your account is set!</p></div><!--StartFragment--> You have new account with name {{model.name}}\n    <br> Use your email and password to login \n    \n           </a>\n            <!--begin:Action-->         \n        </div>\n        <!--end:Email content-->    \n                                </td>\n                            </tr>  \n                            \n                            \n                             \n                            <tr>\n                                <td align=\"center\" valign=\"center\" style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                                    <p style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">It’s all about customers!</p>\n                                    <p style=\"margin-bottom:2px\">Call our customer care number: +20 109 686 9285</p>\n                                    <p style=\"margin-bottom:4px\">You may reach us at <a href=\"{https://newtrip.medianssolutions.com}\" rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">Medians SaaS Trips.com</a>.</p>\n                                    <p>We serve Mon-Fri, 9AM-18AM</p>                                \n                                </td>\n                            </tr>   \n                            \n                            <tr>\n                                <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 20px;\">                                \n                                    <a href=\"#\" style=\"margin-right:10px\"><img alt=\"Logo\" class=\"\" src=\"http://localhost:83/uploads/img/icon-linkedin.svg\"></a>    \n                                    <a href=\"#\" style=\"margin-right:10px\"><img alt=\"Logo\" class=\"\" src=\"http://localhost:83/uploads/img/icon-dribbble.svg\"></a>    \n                                    <a href=\"#\" style=\"margin-right:10px\"><img alt=\"Logo\" class=\"\" src=\"http://localhost:83/uploads/img/icon-facebook.svg\"></a>   \n                                    <a href=\"#\"><img alt=\"Logo\" class=\"\" src=\"http://localhost:83/uploads/img/icon-twitter.svg\"></a>                           \n                                </td>\n                            </tr>\n                            \n                            <tr>\n                                <td align=\"center\" valign=\"center\" style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">                            \n                                    <p> © Copyright Medians SaaS Trips.\n                                        <a href=\"https://newtrip.medianssolutions.com\" rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a> \n                                        from newsletter.\n                                    </p>                         \n                                </td>\n                            </tr>      \n                        </tbody>   \n                    </table> \n                </div>\n            </div>\n            <!--end::Email template-->\n    \n            </div>\n    </section>', 'Alert', 1, '2024-05-07 13:20:33', '2024-05-08 13:12:18'),
(3, '<section>\n    <div class=\"scroll-y flex-column-fluid px-10 py-10\" data-kt-scroll=\"true\" data-kt-scroll-activate=\"true\" data-kt-scroll-height=\"auto\" data-kt-scroll-dependencies=\"#kt_app_header_nav\" data-kt-scroll-offset=\"5px\" data-kt-scroll-save-state=\"true\" style=\"background-color: rgb(213, 217, 226); --kt-scrollbar-color: #d9d0cc; --kt-scrollbar-hover-color: #d9d0cc; min-height: 414px;\">\n    \n            <!--begin::Email template-->      \n            <style>\n                html,body {\n                    padding:0;\n                    margin:0;\n                    font-family: Inter, Helvetica, \"sans-serif\";                                       \n                }            \n    \n                a:hover {\n                    color: #009ef7;\n                }\n            </style>\n            \n            <div id=\"#kt_app_body_content\" style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n                <div style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:40px auto; max-width: 600px;\">\n                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\" style=\"border-collapse:collapse\">\n                        <tbody>                      \n                            <tr>\n                                <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n                                    \n        <!--begin:Email content-->\n        <div style=\"text-align:center; margin:0 60px 34px 60px\">\n            <!--begin:Logo-->\n            <div style=\"margin-bottom: 10px\">\n                <a href=\"https://newtrip.medianssolutions.com\" rel=\"noopener\" target=\"_blank\">\n                    <img alt=\"Logo\" style=\"height: 35px\" class=\"\" src=\"http://localhost:83/uploads/img/logo.png\"></a>\n                \n            </div>\n            <!--end:Logo-->\n    \n            <!--begin:Media-->\n            <div style=\"margin-bottom: 15px\">\n                <img alt=\"Logo\" class=\"\" src=\"http://localhost:83/uploads/img/icon-prize.svg\"> \n            </div> \n            <!--end:Media-->                            \n    \n            <!--begin:Text-->\n            <div style=\"font-size: 14px; font-weight: 500; margin-bottom: 42px; font-family:Arial,Helvetica,sans-serif\">\n                <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">أهلا {{model.name}}, تم إنشاء حساب عملك بنجاح!<br></p>\n            </div>  \n            <!--end:Text-->\n             \n            <!--begin:Action-->\n            <!--StartFragment-->تم إنشاء حسابك بإسم {{model.name}}<br style=\"letter-spacing: -0.352px;\"> يمكنك إستخدام بريدك الإلكتروني <br style=\"letter-spacing: -0.352px;\">وقم باستخدام كلمة المرور <!--EndFragment--> </div><div style=\"text-align:center; margin:0 60px 34px 60px\"> <a href=\"https://newtrip.medianssolutions.com/login\" style=\"background-color:#50cd89; border-radius:6px;display:inline-block; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500;\">إبدأ الان</a>\n            <!--begin:Action-->         \n        </div>\n        <!--end:Email content-->    \n                                </td>\n                            </tr>  \n                            <tr style=\"display: flex; justify-content: center; margin:0 60px 35px 60px\">\n                                <td align=\"start\" valign=\"start\" style=\"padding-bottom: 10px;\">\n                                    <p style=\"color:#181C32; font-size: 18px; font-weight: 600; margin-bottom:13px\">ماذا بعد ؟</p>\n    \n                                    <!--begin::Wrapper-->\n                                    <div style=\"background: #F9F9F9; border-radius: 12px; padding:35px 30px\">\n                                                                                    <!--begin::Item-->\n                                            <div style=\"display:flex\">                    \n                                                <!--begin::Media-->\n                                                <div style=\"display: flex; justify-content: center; align-items: center; width:40px; height:40px; margin-right:13px\">\n                                                    <img alt=\"Logo\" class=\"\" src=\"/metronic8/demo1/assets/media/email/icon-polygon.svg\">  \n                                                    \n                                                     \n                                                        <span style=\"position: absolute; color:#50CD89; font-size: 16px; font-weight: 600;\">\n                                                            1                                                        </span> \n                                                                                                 \n                                                </div>\n                                                <!--end::Media-->                   \n    \n                                                <!--begin::Block-->\n                                                <div>\n                                                    <!--begin::Content-->\n                                                    <div>\n                                                        <!--begin::Title-->\n                                                        <a href=\"/admin/get_started\" style=\"color:#181C32; font-size: 14px; font-weight: 600;font-family:Arial,Helvetica,sans-serif\">اختر الخطة المناسبة</a>\n                                                        <!--end::Title-->\n    \n                                                        <!--begin::Desc-->\n                                                        <p style=\"color:#5E6278; font-size: 13px; font-weight: 500; padding-top:3px; margin:0;font-family:Arial,Helvetica,sans-serif\">قم بتسجيل الدخول و ابدا في اختيار الخطة المناسبة</p>   \n                                                        <!--end::Desc-->                                     \n                                                    </div>\n                                                    <!--end::Content-->  \n                                                    \n                                                                                                            <!--begin::Separator-->\n                                                        <div class=\"separator separator-dashed\" style=\"margin:17px 0 15px 0\"></div>\n                                                        <!--end::Separator-->\n                                                                                       \n                                                </div>\n                                                <!--end::Block-->  \n                                            </div>                                           \n                                            <!--end::Item-->                                          \n                                                                                    <!--begin::Item-->\n                                            <div style=\"display:flex\">                    \n                                                <!--begin::Media-->\n                                                <div style=\"display: flex; justify-content: center; align-items: center; width:40px; height:40px; margin-right:13px\">\n                                                    <img alt=\"Logo\" class=\"\" src=\"/metronic8/demo1/assets/media/email/icon-polygon.svg\">  \n                                                    \n                                                     \n                                                        <span style=\"position: absolute; color:#50CD89; font-size: 16px; font-weight: 600;\">\n                                                            2                                                        </span> \n                                                                                                 \n                                                </div>\n                                                <!--end::Media-->                   \n    \n                                                <!--begin::Block-->\n                                                <div>\n                                                    <!--begin::Content-->\n                                                    <div>\n                                                        <!--begin::Title-->\n                                                        <a href=\"#\" style=\"color:#181C32; font-size: 14px; font-weight: 600;font-family:Arial,Helvetica,sans-serif\">اكمل اعدادات حسابك</a>\n                                                        <!--end::Title-->\n    \n                                                        <!--begin::Desc-->\n                                                        <p style=\"color:#5E6278; font-size: 13px; font-weight: 500; padding-top:3px; margin:0;font-family:Arial,Helvetica,sans-serif\">تأكد من إتمام كافة الإعدادات المطلوبة</p>   \n                                                        <!--end::Desc-->                                     \n                                                    </div>\n                                                    <!--end::Content-->  \n                                                    \n                                                                                                            <!--begin::Separator-->\n                                                        <div class=\"separator separator-dashed\" style=\"margin:17px 0 15px 0\"></div>\n                                                        <!--end::Separator-->\n                                                                                       \n                                                </div>\n                                                <!--end::Block-->  \n                                            </div>                                           \n                                            <!--end::Item-->                                          \n                                                                                    <!--begin::Item-->\n                                            <div style=\"display:flex\">                    \n                                                <!--begin::Media-->\n                                                <div style=\"display: flex; justify-content: center; align-items: center; width:40px; height:40px; margin-right:13px\">\n                                                    <img alt=\"Logo\" class=\"\" src=\"/metronic8/demo1/assets/media/email/icon-polygon.svg\">  \n                                                    \n                                                     \n                                                        <span style=\"position: absolute; color:#50CD89; font-size: 16px; font-weight: 600;\">\n                                                            3                                                        </span> \n                                                                                                 \n                                                </div>\n                                                <!--end::Media-->                   \n    \n                                                <!--begin::Block-->\n                                                <div>\n                                                    <!--begin::Content-->\n                                                    <div>\n                                                        <!--begin::Title-->\n                                                        <a href=\"#\" style=\"color:#181C32; font-size: 14px; font-weight: 600;font-family:Arial,Helvetica,sans-serif\">إبدا رحلتك الأولي</a>\n                                                        <!--end::Title-->\n    \n                                                        <!--begin::Desc-->\n                                                        <p style=\"color:#5E6278; font-size: 13px; font-weight: 500; padding-top:3px; margin:0;font-family:Arial,Helvetica,sans-serif\">إبدأ الان في متابعة رحلاتك وخطوط السير الخاصة بك</p>   \n                                                        <!--end::Desc-->                                     \n                                                    </div>\n                                                    <!--end::Content-->  \n                                                    \n                                                                                       \n                                                </div>\n                                                <!--end::Block-->  \n                                            </div>                                           \n                                            <!--end::Item-->                                          \n                                         \n                                    </div> \n                                    <!--end::Wrapper-->\n                                </td>\n                            </tr>\n                                                    \n                             \n                            <tr>\n                                <td align=\"center\" valign=\"center\" style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                                    <p style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">العميل دائم علي حق!</p>\n                                    <p style=\"margin-bottom:2px\">لخدمة العملاء يرجي التواصل علي هذا الرقم: +20 109 686 9285</p>\n                                    <p style=\"margin-bottom:4px\">يمكتك متابعتنا من خلال الموقع <a href=\"{https://newtrip.medianssolutions.com}\" rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">Medians SaaS Trips.com</a>.</p>\n                                    <p>مواعيد العميل الاثنين -الجمعة, 9ص - 6م</p>                                \n                                </td>\n                            </tr>   \n                            \n                            <tr>\n                                <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 20px;\">                                \n                                    <a href=\"#\" style=\"margin-right:10px\"><img alt=\"Logo\" class=\"\" src=\"http://localhost:83/uploads/img/icon-linkedin.svg\"></a>    \n                                    <a href=\"#\" style=\"margin-right:10px\"><img alt=\"Logo\" class=\"\" src=\"http://localhost:83/uploads/img/icon-dribbble.svg\"></a>    \n                                    <a href=\"#\" style=\"margin-right:10px\"><img alt=\"Logo\" class=\"\" src=\"http://localhost:83/uploads/img/icon-facebook.svg\"></a>   \n                                    <a href=\"#\"><img alt=\"Logo\" class=\"\" src=\"http://localhost:83/uploads/img/icon-twitter.svg\"></a>                           \n                                </td>\n                            </tr>\n                            \n                            <tr>\n                                <td align=\"center\" valign=\"center\" style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">                            \n                                    <p> © جميع الحقوق محفوظة Medians SaaS Trips.\n                                        <a href=\"https://newtrip.medianssolutions.com\" rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">إلغاء الإشتراك</a> \n                                        من الرسائل.\n                                    </p>                         \n                                </td>\n                            </tr>      \n                        </tbody>   \n                    </table> \n                </div>\n            </div>\n            <!--end::Email template-->\n    \n            </div>\n    </section>', 'Profile', 1, '2024-05-07 13:20:33', '2024-05-08 13:10:19'),
(4, '<div class=\"col-lg-12\">\r\n    <table class=\"body-wrap\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f2f5f7; margin: 0;\" bgcolor=\"#f2f5f7\">\r\n        <tbody>\r\n            <tr>\r\n                <td class=\"container\" width=\"600\" style=\"display: block !important; max-width: 600px !important; clear: both !important;\" valign=\"top\">\r\n                    <div class=\"content\" style=\"padding: 20px;\">\r\n                        <table class=\"main\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px solid #e9e9e9;\" bgcolor=\"#fff\">\r\n                            <tbody>\r\n                                <tr>\r\n                                    <td class=\"alert alert-primary border-0 bg-primary\" style=\"padding: 20px; border-radius: 0;\" align=\"center\" valign=\"top\"><img alt=\"\" style=\"margin-left: auto; margin-right: auto; display:block;width: 60px;\" title=\"\" class=\"\" src=\"https://newtrip.medianssolutions.com/uploads/img/logo.png\"></td>\r\n                                </tr>\r\n                                <tr>\r\n                                    <td class=\"alert alert-dark border-0 bg-dark\" style=\"color:#ffffff; padding: 20px; border-radius: 0;\" align=\"center\" valign=\"top\">Warning: You\'re approaching your limit. Please upgrade.</td>\r\n                                </tr>\r\n                                <tr>\r\n                                    <td class=\"content-wrap\" style=\"padding: 20px;\" valign=\"top\">\r\n                                        <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">\r\n                                            <tbody>\r\n                                                <tr>\r\n                                                    <td class=\"content-block\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; font-size: 14px; padding: 10px\" valign=\"top\">Your subscription ends in <strong style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">{{model.subscription.end_date}}</strong> .</td>\r\n                                                </tr>\r\n                                                <tr>\r\n                                                    <td class=\"content-block\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; font-size: 14px; padding: 10px 10px 20px;\" valign=\"top\">Add your credit card now to upgrade your account to\r\n                                                        a premium plan to ensure you don\'t miss out on any reports.</td>\r\n                                                </tr>\r\n                                                <tr>\r\n                                                    <td class=\"content-block\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; font-size: 14px; padding: 0 0 20px;\" valign=\"top\"><a href=\"#\" class=\"btn-primary\" style=\"font-size: 14px; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: block; border-radius: 5px; text-transform: capitalize; background-color: #5766da; border-color: #5766da; padding: 8px 0;\">Upgrade\r\n                                                            my account</a></td>\r\n                                                </tr>\r\n                                                <tr>\r\n                                                    <td class=\"content-block\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; font-size: 14px; text-align: center;\" valign=\"top\">Thanks for choosing <b>Medians</b>.</td>\r\n                                                </tr>\r\n                                            </tbody>\r\n                                        </table>\r\n                                    </td>\r\n                                </tr>\r\n                            </tbody>\r\n                        </table>\r\n                    </div>\r\n                </td>\r\n                <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;\" valign=\"top\"></td>\r\n            </tr>\r\n        </tbody>\r\n    </table><!--end table-->\r\n</div>', 'Alert', 1, '2024-05-07 13:20:33', '2024-05-07 18:51:23'),
(5, '<section>\n<div class=\"scroll-y flex-column-fluid px-10 py-10\" data-kt-scroll=\"true\" data-kt-scroll-activate=\"true\" data-kt-scroll-height=\"auto\" data-kt-scroll-dependencies=\"#kt_app_header_nav\" data-kt-scroll-offset=\"5px\" data-kt-scroll-save-state=\"true\" style=\"background-color: rgb(213, 217, 226); --kt-scrollbar-color: #d9d0cc; --kt-scrollbar-hover-color: #d9d0cc; min-height: 414px;\">\n\n        <!--begin::Email template-->      \n		<style>\n            html,body {\n                padding:0;\n                margin:0;\n                font-family: Inter, Helvetica, \"sans-serif\";                                       \n            }            \n\n			a:hover {\n                color: #009ef7;\n            }\n        </style>\n        \n        <div id=\"#kt_app_body_content\" style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n            <div style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:40px auto; max-width: 600px;\">\n                <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\" style=\"border-collapse:collapse\">\n                    <tbody>                      \n                        <tr>\n                            <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n                                \n    <!--begin:Email content-->\n    <div style=\"text-align:center; margin:0 60px 34px 60px\"><br></div><div style=\"text-align:center; margin:0 60px 34px 60px\">\n        <!--begin:Logo-->\n        <div style=\"margin-bottom: 10px\">\n            <a href=\"https://newtrip.medianssolutions.com\" rel=\"noopener\" target=\"_blank\">\n                <img alt=\"Logo\" style=\"height: 35px\" class=\"\" src=\"http://localhost:83/uploads/img/logo.png\"></a>\n            \n        </div>\n        <!--end:Logo-->\n\n        <!--begin:Media-->\n        <div style=\"margin-bottom: 15px\">\n            <img alt=\"Logo\" class=\"\" src=\"http://localhost:83/uploads/img/icon-prize.svg\"> \n        </div> \n        <!--end:Media-->                            \n\n        <!--begin:Text-->\n        <div style=\"font-size: 14px; font-weight: 500; margin-bottom: 42px; font-family:Arial,Helvetica,sans-serif\">\n            <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">Hey {{model.name}},Your account is set!</p></div><!--StartFragment--> You have new account with name {{model.name}}\n<br> Use your email and  password to login \n\n       </a>\n        <!--begin:Action-->         \n    </div>\n    <!--end:Email content-->    \n                            </td>\n                        </tr>  \n                        <tr style=\"display: flex; justify-content: center; margin:0 60px 35px 60px\">\n                            <td align=\"start\" valign=\"start\" style=\"padding-bottom: 10px;\">\n                                <p style=\"color:#181C32; font-size: 18px; font-weight: 600; margin-bottom:13px\">What’s next?</p>\n\n                                <!--begin::Wrapper-->\n                                <div style=\"background: #F9F9F9; border-radius: 12px; padding:35px 30px\">\n                                                                                <!--begin::Item-->\n                                        <div style=\"display:flex\">                    \n                                            <!--begin::Media-->\n                                            <div style=\"display: flex; justify-content: center; align-items: center; width:40px; height:40px; margin-right:13px\">\n                                                <img alt=\"Logo\" class=\"\" src=\"/metronic8/demo1/assets/media/email/icon-polygon.svg\">  \n                                                \n                                                 \n                                                    <span style=\"position: absolute; color:#50CD89; font-size: 16px; font-weight: 600;\">\n                                                        1                                                        </span> \n                                                                                             \n                                            </div>\n                                            <!--end::Media-->                   \n\n                                            <!--begin::Block-->\n                                            <div>\n                                                <!--begin::Content-->\n                                                <div>\n                                                    <!--begin::Title-->\n                                                    <a href=\"http://localhost:83/admin/get_started\" style=\"color:#181C32; font-size: 14px; font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Complete your account</a>\n                                                    <!--end::Title-->\n\n                                                    <!--begin::Desc-->\n                                                    <p style=\"color:#5E6278; font-size: 13px; font-weight: 500; padding-top:3px; margin:0;font-family:Arial,Helvetica,sans-serif\">Lots of people make mistakes while creating paragraphs Some writers just put whitespace in their text</p>   \n                                                    <!--end::Desc-->                                     \n                                                </div>\n                                                <!--end::Content-->  \n                                                \n                                                                                                        <!--begin::Separator-->\n                                                    <div class=\"separator separator-dashed\" style=\"margin:17px 0 15px 0\"></div>\n                                                    <!--end::Separator-->\n                                                                                   \n                                            </div>\n                                            <!--end::Block-->  \n                                        </div>                                           \n                                        <!--end::Item-->                                          \n                                                                                <!--begin::Item-->\n                                        <div style=\"display:flex\">                    \n                                            <!--begin::Media-->\n                                            <div style=\"display: flex; justify-content: center; align-items: center; width:40px; height:40px; margin-right:13px\">\n                                                <img alt=\"Logo\" class=\"\" src=\"/metronic8/demo1/assets/media/email/icon-polygon.svg\">  \n                                                \n                                                 \n                                                    <span style=\"position: absolute; color:#50CD89; font-size: 16px; font-weight: 600;\">\n                                                        2                                                        </span> \n                                                                                             \n                                            </div>\n                                            <!--end::Media-->                   \n\n                                            <!--begin::Block-->\n                                            <div>\n                                                <!--begin::Content-->\n                                                <div>\n                                                    <!--begin::Title-->\n                                                    <a href=\"#\" style=\"color:#181C32; font-size: 14px; font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Communication Tool</a>\n                                                    <!--end::Title-->\n\n                                                    <!--begin::Desc-->\n                                                    <p style=\"color:#5E6278; font-size: 13px; font-weight: 500; padding-top:3px; margin:0;font-family:Arial,Helvetica,sans-serif\">Craft a headline that is both informative and will capture readers’ improtant attentions</p>   \n                                                    <!--end::Desc-->                                     \n                                                </div>\n                                                <!--end::Content-->  \n                                                \n                                                                                                        <!--begin::Separator-->\n                                                    <div class=\"separator separator-dashed\" style=\"margin:17px 0 15px 0\"></div>\n                                                    <!--end::Separator-->\n                                                                                   \n                                            </div>\n                                            <!--end::Block-->  \n                                        </div>                                           \n                                        <!--end::Item-->                                          \n                                                                                <!--begin::Item-->\n                                        <div style=\"display:flex\">                    \n                                            <!--begin::Media-->\n                                            <div style=\"display: flex; justify-content: center; align-items: center; width:40px; height:40px; margin-right:13px\">\n                                                <img alt=\"Logo\" class=\"\" src=\"/metronic8/demo1/assets/media/email/icon-polygon.svg\">  \n                                                \n                                                 \n                                                    <span style=\"position: absolute; color:#50CD89; font-size: 16px; font-weight: 600;\">\n                                                        3                                                        </span> \n                                                                                             \n                                            </div>\n                                            <!--end::Media-->                   \n\n                                            <!--begin::Block-->\n                                            <div>\n                                                <!--begin::Content-->\n                                                <div>\n                                                    <!--begin::Title-->\n                                                    <a href=\"#\" style=\"color:#181C32; font-size: 14px; font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Task Planner</a>\n                                                    <!--end::Title-->\n\n                                                    <!--begin::Desc-->\n                                                    <p style=\"color:#5E6278; font-size: 13px; font-weight: 500; padding-top:3px; margin:0;font-family:Arial,Helvetica,sans-serif\">Use images to enhance your post, improve its flow, add humor, and explain complex topics</p>   \n                                                    <!--end::Desc-->                                     \n                                                </div>\n                                                <!--end::Content-->  \n                                                \n                                                                                   \n                                            </div>\n                                            <!--end::Block-->  \n                                        </div>                                           \n                                        <!--end::Item-->                                          \n                                     \n                                </div> \n                                <!--end::Wrapper-->\n                            </td>\n                        </tr>\n                                                \n                         \n                        <tr>\n                            <td align=\"center\" valign=\"center\" style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                                <p style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">It’s all about customers!</p>\n                                <p style=\"margin-bottom:2px\">Call our customer care number: +20 109 686 9285</p>\n                                <p style=\"margin-bottom:4px\">You may reach us at <a href=\"{https://newtrip.medianssolutions.com}\" rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">Medians SaaS Trips.com</a>.</p>\n                                <p>We serve Mon-Fri, 9AM-18AM</p>                                \n                            </td>\n                        </tr>   \n                        \n                        <tr>\n                            <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 20px;\">                                \n                                <a href=\"#\" style=\"margin-right:10px\"><img alt=\"Logo\" class=\"\" src=\"http://localhost:83/uploads/img/icon-linkedin.svg\"></a>    \n                                <a href=\"#\" style=\"margin-right:10px\"><img alt=\"Logo\" class=\"\" src=\"http://localhost:83/uploads/img/icon-dribbble.svg\"></a>    \n                                <a href=\"#\" style=\"margin-right:10px\"><img alt=\"Logo\" class=\"\" src=\"http://localhost:83/uploads/img/icon-facebook.svg\"></a>   \n                                <a href=\"#\"><img alt=\"Logo\" class=\"\" src=\"http://localhost:83/uploads/img/icon-twitter.svg\"></a>                           \n                            </td>\n                        </tr>\n                        \n                        <tr>\n                            <td align=\"center\" valign=\"center\" style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">                            \n                                <p> © Copyright Medians SaaS Trips.\n                                    <a href=\"https://newtrip.medianssolutions.com\" rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a> \n                                    from newsletter.\n                                </p>                         \n                            </td>\n                        </tr>      \n                    </tbody>   \n                </table> \n            </div>\n        </div>\n        <!--end::Email template-->\n\n        </div>\n</section>', 'Profile', 1, '2024-05-07 13:20:33', '2024-05-08 13:09:10');
INSERT INTO `email_blocks` (`id`, `content`, `category`, `created_by`, `created_at`, `updated_at`) VALUES
(6, '<div class=\"scroll-y flex-column-fluid px-10 py-10\" data-kt-scroll=\"true\" data-kt-scroll-activate=\"true\" data-kt-scroll-height=\"auto\" data-kt-scroll-dependencies=\"#kt_app_header_nav\" data-kt-scroll-offset=\"5px\" data-kt-scroll-save-state=\"true\" style=\"background-color: rgb(213, 217, 226); --kt-scrollbar-color: #d9d0cc; --kt-scrollbar-hover-color: #d9d0cc; min-height: 414px;\">\n\n    <!--begin::Email template-->\n    <style>\n        html,\n        body {\n            padding: 0;\n            margin: 0;\n            font-family: Inter, Helvetica, \"sans-serif\";\n        }\n\n        a:hover {\n            color: #009ef7;\n        }\n    </style>\n\n    <div id=\"#kt_app_body_content\" style=\"background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;\">\n        <div style=\"background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:40px auto; max-width: 600px;\">\n            <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"auto\" style=\"border-collapse:collapse\">\n                <tbody>\n                    <tr>\n                        <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 10px\">\n\n                            <!--begin:Email content-->\n                            <div style=\"text-align:center; margin:0 60px 34px 60px\">\n                                <!--begin:Logo-->\n                                <div style=\"margin-bottom: 10px\">\n                                    <a href=\"https://keenthemes.com\" rel=\"noopener\" target=\"_blank\">\n                                        <img alt=\"Logo\" src=\"https://newtrip.medianssolutions.com/uploads/img/logo.png\" style=\"height: 35px\" title=\"\"></a>\n\n                                </div>\n                                <!--end:Logo-->\n\n                                <!--begin:Media-->\n                                <div style=\"margin-bottom: 15px\">\n                                    <img alt=\"Logo\" src=\"https://newtrip.medianssolutions.com/uploads/img/icon-email-3.svg\" title=\"\">\n                                </div>\n                                <!--end:Media-->\n\n                                <!--begin:Text-->\n                                <div style=\"font-size: 14px; font-weight: 500; margin-bottom: 42px; font-family:Arial,Helvetica,sans-serif\">\n                                    <p style=\"margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700\">New\n                                        driver want to join your team!</p>\n                                    <p style=\"margin-bottom:2px; color:#7E8299\">You have new driver request to join your\n                                        team and you can review his information and approve or reject the request</p>\n                                </div>\n                                <!--end:Text-->\n\n                                <!--begin:Order-->\n                                <div style=\"margin-bottom: 15px\">\n                                    <!--begin:Title-->\n                                    <h3 style=\"text-align:left; color:#181C32; font-size: 18px; font-weight:600; margin-bottom: 22px\">\n                                        Driver info</h3>\n                                    <!--end:Title-->\n\n                                    <!--begin:Items-->\n                                    <div style=\"padding-bottom:9px\">\n                                        \n                                        <!--begin:Item-->\n                                        <div style=\"display:flex; justify-content: space-between; color:#7E8299; font-size: 14px; font-weight:500;\">\n                                            <!--begin:Description-->\n                                            <div style=\"font-family:Arial,Helvetica,sans-serif;width: 100%;text-align: left;\">First name</div>\n                                            <!--end:Description-->\n\n                                            <!--begin:Total-->\n                                            <div style=\"font-family:Arial,Helvetica,sans-serif;width: 50%;text-align: right;\"><!--StartFragment-->{{model.driver.first_name}}<!--EndFragment--><br></div>\n                                            <!--end:Total-->\n                                        </div>\n                                        <!--end:Item-->\n\n                                        <!--begin:Item-->\n                                        <div style=\"display:flex; justify-content: space-between; color:#7E8299; font-size: 14px; font-weight:500; margin-bottom:8px\">\n                                            <!--begin:Description-->\n                                            <div style=\"font-family:Arial,Helvetica,sans-serif;width: 100%;text-align: left;\">Last Name</div>\n                                            <!--end:Description-->\n\n                                            <!--begin:Total-->\n                                            <div style=\"font-family:Arial,Helvetica,sans-serif;width: 50%;text-align: right;\">{{model.driver.last_name}}</div>\n                                            <!--end:Total-->\n                                        </div>\n                                        <!--end:Item-->\n\n                                        <!--begin::Separator-->\n                                        <div class=\"separator separator-dashed\" style=\"margin:15px 0\"></div>\n                                        <!--end::Separator-->\n\n                                        <!--begin:Item-->\n                                        <div style=\"display:flex; justify-content: space-between; color:#7E8299; font-size: 14px; font-weight:500;\">\n                                            <!--begin:Description-->\n                                            <div style=\"font-family:Arial,Helvetica,sans-serif;width: 100%;text-align: left;\">Email</div>\n                                            <!--end:Description-->\n\n                                            <!--begin:Total-->\n                                            <div style=\"font-family:Arial,Helvetica,sans-serif;width: 50%;text-align: right;\"><!--StartFragment-->{{model.driver.email}}<!--EndFragment--><br></div>\n                                            <!--end:Total-->\n                                        </div>\n                                        <!--end:Item-->\n\n                                        <!--begin::Separator-->\n                                        <div class=\"separator separator-dashed\" style=\"margin:15px 0\"></div>\n                                        <!--end::Separator-->\n\n                                        <!--begin:Item-->\n                                        <div style=\"display:flex; justify-content: space-between; color:#7E8299; font-size: 14px; font-weight:500;\">\n                                            <!--begin:Description-->\n                                            <div style=\"font-family:Arial,Helvetica,sans-serif;width: 100%;text-align: left;\">Mobile</div>\n                                            <!--end:Description-->\n\n                                            <!--begin:Total-->\n                                            <div style=\"font-family:Arial,Helvetica,sans-serif;width: 50%;text-align: right;\"><!--StartFragment-->{{model.driver.mobile}}<!--EndFragment--><br></div>\n                                            <!--end:Total-->\n                                        </div>\n                                        <!--end:Item-->\n\n                                        <!--begin::Separator-->\n                                        <div class=\"separator separator-dashed\" style=\"margin:15px 0\"></div>\n                                        <!--end::Separator-->\n                                        <!--begin:Item-->\n                                        <div style=\"display:flex; justify-content: space-between; color:#7E8299; font-size: 14px; font-weight:500;\">\n                                            <!--begin:Description-->\n                                            <div style=\"font-family:Arial,Helvetica,sans-serif;width: 100%;text-align: left;\">Birthdate</div>\n                                            <!--end:Description-->\n\n                                            <!--begin:Total-->\n                                            <div style=\"font-family:Arial,Helvetica,sans-serif;width: 50%;text-align: right;\"><!--StartFragment-->{{model.driver.birth_date}}<!--EndFragment--><br></div>\n                                            <!--end:Total-->\n                                        </div>\n                                        <!--end:Item-->\n\n                                        <!--begin::Separator-->\n                                        <div class=\"separator separator-dashed\" style=\"margin:15px 0\"></div>\n                                        <!--end::Separator-->\n\n                                    </div>\n                                    <!--end:Items-->\n                                </div>\n                                <!--end:Order-->\n\n                                <!--begin:Action-->\n                                <a href=\"https://newtrip.medianssolutions.com/admin/driver_applicants\" target=\"_blank\" style=\"background-color:#50cd89; border-radius:6px;display:inline-block; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500;\">\n                                    Review request\n                               </a>\n                                <!--begin:Action-->\n                            </div>\n                            <!--end:Email content-->\n                        </td>\n                    </tr>\n\n\n\n                    <tr>\n                        <td align=\"center\" valign=\"center\" style=\"font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif\">\n                            <p style=\"color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               \">\n                                It’s all about customers!</p>\n                            <p style=\"margin-bottom:2px\">Call our customer care number: +20 0109 6869 285</p>\n                            <p style=\"margin-bottom:4px\">You may reach us at <a href=\"https://newtrip.medianssolutions.com/\" rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600\">Medians SaaS trips</a>.</p>\n                            <p>We serve Mon-Fri, 9AM-18AM</p>\n                        </td>\n                    </tr>\n\n                    <tr>\n                        <td align=\"center\" valign=\"center\" style=\"text-align:center; padding-bottom: 20px;\">\n                            <a href=\"#\" style=\"margin-right:10px\"><img alt=\"Logo\" src=\"https://newtrip.medianssolutions.com/uploads/img/icon-linkedin.svg\"></a>\n                            <a href=\"#\" style=\"margin-right:10px\"><img alt=\"Logo\" src=\"https://newtrip.medianssolutions.com/uploads/img/icon-dribbble.svg\"></a>\n                            <a href=\"#\" style=\"margin-right:10px\"><img alt=\"Logo\" src=\"https://newtrip.medianssolutions.com/uploads/img/icon-facebook.svg\"></a>\n                            <a href=\"#\"><img alt=\"Logo\" src=\"https://newtrip.medianssolutions.com/uploads/img/icon-twitter.svg\"></a>\n                        </td>\n                    </tr>\n\n                    <tr>\n                        <td align=\"center\" valign=\"center\" style=\"font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif\">\n                            <p> © Copyright Medians.\n                                <a href=\"https://newtrip.medianssolutions.com\" rel=\"noopener\" target=\"_blank\" style=\"font-weight: 600;font-family:Arial,Helvetica,sans-serif\">Unsubscribe</a> \n                                from newsletter.\n                            </p>\n                        </td>\n                    </tr>\n                </tbody>\n            </table>\n        </div>\n    </div>\n    <!--end::Email template-->\n\n</div>', 'Applicant', 1, '2024-05-07 13:20:33', '2024-05-07 20:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `template_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` varchar(2) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`template_id`, `title`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Default', 'on', 1, '2024-05-13 00:53:21', '2024-05-13 00:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) NOT NULL,
  `status` varchar(2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `status` varchar(2) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `help_messages`
--

CREATE TABLE `help_messages` (
  `message_id` int(11) NOT NULL,
  `business_id` int(11) DEFAULT 0,
  `title` varchar(255) NOT NULL,
  `subject` varchar(244) NOT NULL,
  `message` text DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `help_message_comments`
--

CREATE TABLE `help_message_comments` (
  `comment_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `subtotal` float NOT NULL DEFAULT 0,
  `discount_amount` float NOT NULL DEFAULT 0,
  `shipping_amount` float DEFAULT NULL,
  `total_amount` float NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `tax_amount` float DEFAULT NULL,
  `currency_code` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `invoice_item_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `tax_amount` float NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `subtotal` float NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL,
  `discount_amount` float NOT NULL DEFAULT 0,
  `total_amount` float NOT NULL DEFAULT 0,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `language_code` varchar(20) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `status` varchar(2) DEFAULT NULL,
  `created_by` int(11) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`language_id`, `name`, `language_code`, `icon`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'English', 'english', '/uploads/img/flags/united-states.svg', 'on', 1, '2024-04-29 10:36:26', '2024-05-11 21:05:13'),
(2, 'Arabic', 'arabic', '/uploads/img/flags/egypt.svg', 'on', 1, '2024-04-29 10:36:50', '2024-05-11 21:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `page_id` int(11) NOT NULL,
  `page_type` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT 0,
  `position` int(11) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `type`, `name`, `page_id`, `page_type`, `parent_id`, `position`, `created_at`, `updated_at`) VALUES
(26, 'header', 'Homepage', 1, 'Medians\\Pages\\Domain\\Page', 0, 0, '2024-05-13 11:10:29', '2024-05-13 11:10:29'),
(27, 'header', 'office', 9, 'Medians\\Categories\\Domain\\Category', 0, 1, '2024-05-13 11:10:29', '2024-05-13 11:10:29'),
(28, 'header', 'Shop', 3, 'Medians\\Pages\\Domain\\Page', 0, 2, '2024-05-13 11:10:29', '2024-05-13 11:10:29'),
(29, 'header', 'Sofa', 13, 'Medians\\Categories\\Domain\\Category', 0, 3, '2024-05-13 11:10:29', '2024-05-13 11:10:29'),
(30, 'header', 'About', 2, 'Medians\\Pages\\Domain\\Page', 0, 4, '2024-05-13 11:10:29', '2024-05-13 11:10:29'),
(43, 'footer1', 'About', 2, 'Medians\\Pages\\Domain\\Page', 0, 0, '2024-05-15 04:46:05', '2024-05-15 04:46:05'),
(44, 'footer1', 'Shop', 3, 'Medians\\Pages\\Domain\\Page', 0, 1, '2024-05-15 04:46:05', '2024-05-15 04:46:05'),
(46, 'footer2', 'Shop', 3, 'Medians\\Pages\\Domain\\Page', 0, 0, '2024-05-15 04:46:14', '2024-05-15 04:46:14'),
(47, 'footer2', 'Manager chairs', 10, 'Medians\\Categories\\Domain\\Category', 0, 1, '2024-05-15 04:46:14', '2024-05-15 04:46:14');

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `newsletter_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `subscriber_id` int(11) NOT NULL,
  `newsletter_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `receiver_type` varchar(255) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` int(11) NOT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `body` varchar(191) DEFAULT NULL,
  `body_text` varchar(255) NOT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications_events`
--

CREATE TABLE `notifications_events` (
  `id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `action` varchar(191) NOT NULL,
  `model` varchar(191) NOT NULL,
  `receiver_model` varchar(255) NOT NULL,
  `action_field` varchar(255) DEFAULT NULL,
  `action_value` varchar(255) DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `body_text` varchar(255) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `customer_type` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tax_amount` float DEFAULT 0,
  `shipping_amount` float NOT NULL DEFAULT 0,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `notes` text DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `tax_amount` float DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `subtotal` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` varchar(25) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item_options`
--

CREATE TABLE `order_item_options` (
  `order_option_id` int(11) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `prefix` varchar(255) NOT NULL,
  `homepage` varchar(2) DEFAULT NULL,
  `status` varchar(2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `title`, `prefix`, `homepage`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Homepage', 'home', 'on', 'on', 1, '2024-05-11 20:54:59', '2024-05-11 21:00:59'),
(2, 'About', 'about', NULL, 'on', 1, '2024-05-12 17:10:43', '2024-05-12 17:10:43'),
(3, 'contact us', '', NULL, 'on', 1, '2024-05-12 21:42:46', '2024-05-12 21:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `model_id` int(11) NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `business_id` int(11) NOT NULL,
  `payment_code` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `payment_method_id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`payment_method_id`, `code`, `name`, `description`, `picture`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'bank', 'Bank', 'Bank Transfer payment', '', 'on', 1, '2024-05-11 20:22:54', '2024-05-11 20:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method_fields`
--

CREATE TABLE `payment_method_fields` (
  `field_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `payment_method_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `access` int(11) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `role_id`, `model`, `action`, `access`, `created_at`, `updated_at`) VALUES
(1, 3, 'Dashboard', 'Dashboard.index', 1, '2023-11-03 01:14:01', '2023-11-17 22:10:29'),
(5, 3, 'HelpMessage', 'HelpMessage.index', 1, '2023-11-03 01:14:01', '2023-11-16 19:29:42'),
(6, 3, 'User', 'User.index', NULL, '2023-11-03 01:14:01', '2024-01-17 03:39:07'),
(7, 3, 'Notification', 'Notification.index', 1, '2023-11-03 01:14:01', '2023-11-16 19:29:42'),
(8, 1, 'NotificationEvent', 'NotificationEvent.index', 1, '2023-11-03 01:14:01', '2023-11-16 19:29:42'),
(9, 1, 'SystemSettings', 'SystemSettings.index', 1, '2023-11-03 01:14:01', '2023-11-16 19:29:42'),
(14, 1, 'Dashboard', 'Dashboard.index', 1, '2023-11-03 01:14:01', '2023-11-16 19:29:42'),
(18, 1, 'HelpMessage', 'HelpMessage.index', NULL, '2023-11-03 01:14:01', '2024-01-11 19:24:10'),
(19, 1, 'User', 'User.index', 1, '2023-11-03 01:14:01', '2023-11-16 19:29:42'),
(20, 1, 'Notification', 'Notification.index', 1, '2023-11-03 01:14:01', '2023-11-16 19:29:42'),
(25, 1, 'Event', 'Event.index', 1, '2023-11-03 01:14:01', '2023-11-16 19:29:59'),
(28, 1, 'Roles management', 'Roles.index', 1, '2023-11-03 01:14:01', '2023-11-23 13:01:40'),
(30, 3, 'Setting', 'Settings.index', 1, '2023-11-03 01:14:01', '2024-01-26 21:04:57'),
(33, 3, 'PaymentMethod', 'PaymentMethods.index', 1, '2023-11-03 01:14:01', '2024-01-26 21:04:50'),
(38, 3, 'Transaction', 'Transaction.index', 1, '2023-11-03 01:14:01', '2024-04-08 19:21:26'),
(39, 3, 'Invoice', 'Invoice.index', 1, '2023-11-03 01:14:01', '2024-04-08 19:21:26'),
(42, 3, 'Withdrawals', 'Withdrawals.index', 1, '2023-11-03 01:14:01', '2024-04-08 19:21:26'),
(44, 3, 'Gallery', 'Gallery.index', 1, '2023-11-03 01:14:01', '2024-04-08 19:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `old_price` decimal(10,2) DEFAULT 0.00,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `picture` varchar(255) DEFAULT 'uploads/img/product_placeholder.png',
  `user_type` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(2) DEFAULT 'on',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `product_category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `color_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `value` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_fields`
--

CREATE TABLE `product_fields` (
  `product_field_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `min_purchase_qty` int(11) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `dimensions` varchar(255) DEFAULT NULL,
  `refundable` varchar(255) DEFAULT 'on',
  `featured` varchar(255) DEFAULT 'on',
  `vat_amount` decimal(10,2) DEFAULT 0.00,
  `vat_type` enum('fixed','percent') DEFAULT 'percent',
  `tax_amount` decimal(10,2) DEFAULT 0.00,
  `tax_type` enum('fixed','percent') DEFAULT 'percent',
  `low_stock_alert` int(11) DEFAULT 0,
  `template` varchar(255) DEFAULT 'default',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `media_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_prices`
--

CREATE TABLE `product_prices` (
  `price_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_shipping`
--

CREATE TABLE `product_shipping` (
  `product_shipping_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `size_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `value` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_stock`
--

CREATE TABLE `product_stock` (
  `stock_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `start_qty` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `purchase_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE `product_tags` (
  `tag_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Super Administrator'),
(3, 'Moderators');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `business_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shipping_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `days` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` varchar(2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(2) NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status_list`
--

CREATE TABLE `status_list` (
  `status_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 1,
  `model` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `code`, `value`, `created_by`, `created_at`, `updated_at`) VALUES
(12, 'onesignal_app_id', '', 1, '2024-01-28 14:21:51', '2024-01-28 14:21:51'),
(13, 'onesignal_app_key_token', '', 1, '2024-01-28 14:21:51', '2024-01-28 14:21:51'),
(16, 'mode', 'sandbox', 1, '2024-01-28 14:22:02', '2024-01-28 14:22:02'),
(27, 'smtp_sender', '', 1, '2024-02-18 10:26:09', '2024-02-18 10:26:09'),
(28, 'smtp_user', '', 1, '2024-02-18 10:26:09', '2024-02-18 10:26:09'),
(29, 'smtp_password', '', 1, '2024-02-18 10:26:09', '2024-02-18 10:26:09'),
(30, 'smtp_host', '', 1, '2024-02-18 10:26:09', '2024-02-18 10:26:09'),
(31, 'smtp_port', '465', 1, '2024-02-18 10:26:09', '2024-02-18 10:26:09'),
(32, 'smtp_auth', '1', 1, '2024-02-18 10:26:09', '2024-02-18 10:26:09'),
(42, 'stripe_publish_key', '', 1, '2024-04-12 05:29:59', '2024-04-12 05:29:59'),
(43, 'stripe_live_key', '', 1, '2024-04-12 05:29:59', '2024-04-12 05:29:59'),
(44, 'stripe_mode', 'sandbox', 1, '2024-04-12 05:29:59', '2024-04-12 05:29:59'),
(49, 'comission_free_plan', '10', 1, '2024-04-20 09:07:30', '2024-04-20 09:07:30'),
(50, 'comission_paid_plan', '1', 1, '2024-04-20 09:07:30', '2024-04-20 09:07:30'),
(63, 'allow_google_login', 'on', 1, '2024-04-27 17:13:59', '2024-04-27 17:13:59'),
(64, 'google_client_id', '', 1, '2024-04-27 17:13:59', '2024-04-27 17:13:59'),
(65, 'google_client_secret', '', 1, '2024-04-27 17:13:59', '2024-04-27 17:13:59'),
(66, 'google_map_api', '', 1, '2024-04-27 17:13:59', '2024-04-27 17:13:59'),
(72, 'logo', '/uploads/img/logo.png', 1, '2024-04-28 10:16:49', '2024-04-28 10:16:49'),
(77, 'paystack_mode', 'sandbox', 1, '2024-04-29 20:50:49', '2024-04-29 20:50:49'),
(87, 'allow_twitter_login', 'on', 1, '2024-05-03 22:21:33', '2024-05-03 22:21:33'),
(88, 'twitter_api_key', '', 1, '2024-05-03 22:21:33', '2024-05-03 22:21:33'),
(89, 'twitter_client_secret', '', 1, '2024-05-03 22:21:33', '2024-05-03 22:21:33'),
(90, 'twitter_redirect_link', 'mediansparents://callback', 1, '2024-05-03 22:21:33', '2024-05-03 22:21:33'),
(94, 'header', 'header2', 1, '2024-05-11 13:08:16', '2024-05-11 13:08:16'),
(95, 'footer', 'footer1', 1, '2024-05-11 13:08:16', '2024-05-11 13:08:16'),
(100, 'facebook_link', 'http://fb.com/', 1, '2024-05-12 18:37:08', '2024-05-12 18:37:08'),
(101, 'twitter_link', '', 1, '2024-05-12 18:37:08', '2024-05-12 18:37:08'),
(102, 'youtube_link', '', 1, '2024-05-12 18:37:08', '2024-05-12 18:37:08'),
(103, 'instagram_link', '', 1, '2024-05-12 18:37:08', '2024-05-12 18:37:08'),
(113, 'sitename', 'Medians', 1, '2024-05-13 18:48:30', '2024-05-13 18:48:30'),
(114, 'lang', 'english', 1, '2024-05-13 18:48:30', '2024-05-13 18:48:30'),
(115, 'template', 'ecommerce', 1, '2024-05-13 18:48:30', '2024-05-13 18:48:30'),
(117, 'head_font', 'Cairo', 1, '2024-05-15 16:38:00', '2024-05-15 16:38:00'),
(118, 'text_font', 'Tajawal', 1, '2024-05-15 16:38:00', '2024-05-15 16:38:00'),
(119, 'default_dashboard_start_date', '01-01', 1, '2024-05-15 19:53:25', '2024-05-15 19:53:25'),
(122, 'currency', 'USD', 1, '2024-05-15 19:57:22', '2024-05-15 19:57:22'),
(129, 'show_newsletter_form', 'on', 1, '2024-05-16 01:56:42', '2024-05-16 01:56:42'),
(130, 'category_products_count', '4', 1, '2024-05-16 01:56:42', '2024-05-16 01:56:42'),
(131, 'allow_guest_checkout', 'on', 1, '2024-05-16 01:59:51', '2024-05-16 01:59:51'),
(142, 'paystack_payment', '', 1, '2024-05-17 02:13:45', '2024-05-17 02:13:45'),
(143, 'paystack_public_key', 'pk_test_da4cce388fdbb963132a0b9f552bfc06b6ff7654', 1, '2024-05-17 02:13:45', '2024-05-17 02:13:45'),
(144, 'paystack_secret_key', 'sk_test_82eb9bad45ad0d54fed4b1144dbaeeb217eef4d9', 1, '2024-05-17 02:13:45', '2024-05-17 02:13:45'),
(145, 'currency_converter_api', 'cur_live_NSmaeb5jJMM32llRAYSxtkmOIqgdWZ9Vpgo4bTzr', 1, '2024-05-17 02:13:45', '2024-05-17 02:13:45'),
(146, 'footer_email', 'amrelngm6@gmail.com', 1, '2024-05-17 17:46:04', '2024-05-17 17:46:04'),
(147, 'footer_address', 'Zayed city', 1, '2024-05-17 17:46:04', '2024-05-17 17:46:04'),
(148, 'footer_phone', '0109686928', 1, '2024-05-17 17:46:04', '2024-05-17 17:46:04'),
(149, 'paypal_payment', 'on', 1, '2024-05-18 01:27:58', '2024-05-18 01:27:58'),
(150, 'paypal_api_key', 'AWUCfAscLBoB7BKCucyRck6S2W7z-g2pc_ZHiel1s09uGdU50YdnpdaxT8otmNN049oBnltEpDZlWBOU', 1, '2024-05-18 01:27:58', '2024-05-18 01:27:58'),
(151, 'paypal_api_secret', 'EPN9pWGo284U1xJPsxeZiwoC9jjWT9f38evakTew8RHaaRRJj5qh2Xw0Xe8qpOJUqaJFmSnC458ULSN7', 1, '2024-05-18 01:27:58', '2024-05-18 01:27:58'),
(152, 'paypal_mode', 'sandbox', 1, '2024-05-18 01:27:58', '2024-05-18 01:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `template_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `folder_name` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`template_id`, `title`, `picture`, `status`, `folder_name`, `created_at`, `updated_at`) VALUES
(1, 'Default', '/uploads/images/3-6640de9251005.jpg', 'on', 'default', '2024-05-13 00:55:16', '2024-05-13 00:55:16'),
(2, 'Ecommerce', '/uploads/images/1-6640de92df1a7.jpg', 'on', 'ecommerce', '2024-05-13 01:23:41', '2024-05-13 01:23:41');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `translation_id` int(11) NOT NULL,
  `language_code` varchar(20) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`translation_id`, `language_code`, `code`, `value`, `created_at`, `updated_at`) VALUES
(1, 'english', 'lang', 'english', '2024-04-29 11:57:24', '2024-05-01 09:10:47'),
(2, 'arabic', 'lang', 'arabic', '2024-04-29 11:57:24', '2024-04-30 19:04:25'),
(3, 'english', 'ar', 'Arabic', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(4, 'arabic', 'ar', 'المحتوي العربي', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(5, 'english', 'en', 'English', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(6, 'arabic', 'en', 'English content', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(7, 'english', 'dir', 'Ltr', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(8, 'arabic', 'dir', 'rtl', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(9, 'english', 'homepage', 'Home', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(10, 'arabic', 'homepage', 'الرئيسية', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(11, 'english', 'homepage_title', 'Homepage', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(12, 'arabic', 'homepage_title', 'الصفحة الرئيسية', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(13, 'english', 'mainpage', 'Main page', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(14, 'arabic', 'mainpage', 'الرئيسية', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(15, 'english', 'account_page', 'Account page', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(16, 'arabic', 'account_page', 'الصفحة الشخصية', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(17, 'english', 'login', 'Login', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(18, 'arabic', 'login', 'دخول', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(19, 'english', 'register', 'Register', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(20, 'arabic', 'register', 'تسجيل', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(21, 'english', 'cur_customers', 'Registered customers', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(22, 'arabic', 'cur_customers', 'الاعضاء المسجلين', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(23, 'english', 'name', 'Name', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(24, 'arabic', 'name', 'الاسم', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(25, 'english', 'first_name', 'First name', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(26, 'arabic', 'first_name', 'الاسم الأول', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(27, 'english', 'last_name', 'Last name', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(28, 'arabic', 'last_name', 'الإسم الاخير', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(29, 'english', 'enter_mail', 'Email', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(30, 'arabic', 'enter_mail', 'البريد الالكتروني', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(31, 'english', 'enter_pass', 'Password', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(32, 'arabic', 'enter_pass', 'كلمة المرور', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(33, 'english', 'password', 'Password', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(34, 'arabic', 'password', 'كلمة المرور', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(35, 'english', 'password_error', 'Password is not right', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(36, 'arabic', 'password_error', 'كلمة المرور غير صحيحة', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(37, 'english', 'old_password', 'Old password', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(38, 'arabic', 'old_password', 'كلمة المرور الحالية', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(39, 'english', 'new_password', 'New password', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(40, 'arabic', 'new_password', 'كلمة المرور الجديدة', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(41, 'english', 'enter_pass_ag', 'Password confirmation', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(42, 'arabic', 'enter_pass_ag', 'كلمة المرور مرة اخرى', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(43, 'english', 'new_customers', 'New customers', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(44, 'arabic', 'new_customers', 'الاعضاء الجدد', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(45, 'english', 'create_account', 'Create your account', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(46, 'arabic', 'create_account', 'انشاء حساب', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(47, 'english', 'already_have_account', 'Already have account', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(48, 'arabic', 'already_have_account', 'لديك حساب بالفعل', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(49, 'english', 'enter_fullname', 'Full name', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(50, 'arabic', 'enter_fullname', 'الاسم بالكامل', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(51, 'english', 'fullname', 'Fullname', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(52, 'arabic', 'fullname', 'الاسم بالكامل', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(53, 'english', 'username', 'Username', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(54, 'arabic', 'username', 'اسم المستخدم', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(55, 'english', 'email', 'Email', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(56, 'arabic', 'email', 'البريد الالكتروني', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(57, 'english', 'no_space', 'Without spaces', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(58, 'arabic', 'no_space', 'بدون مسافات', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(59, 'english', 'enter_gender', 'Choose your gender', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(60, 'arabic', 'enter_gender', 'النوع', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(61, 'english', 'male', 'Male', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(62, 'arabic', 'male', 'ذكر', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(63, 'english', 'female', 'Female', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(64, 'arabic', 'female', 'انثي', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(65, 'english', 'remember', 'Remember me', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(66, 'arabic', 'remember', 'تذكرني', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(67, 'english', 'profile_info', 'Profile information', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(68, 'arabic', 'profile_info', 'الصفحة الشخصية', '2024-04-29 11:57:24', '2024-04-29 11:57:24'),
(75, 'english', 'post', 'Post', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(76, 'arabic', 'post', 'Post', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(77, 'english', 'comment_here', 'Comment here', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(78, 'arabic', 'comment_here', 'اترك تعليقك هنا', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(79, 'english', 'comments_posted', 'Comments posted', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(80, 'arabic', 'comments_posted', 'تم إرسال التعليق', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(81, 'english', 'write_comment', 'Write your comment', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(82, 'arabic', 'write_comment', 'اكتب تعليقك', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(83, 'english', 'my_account', 'My account', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(84, 'arabic', 'my_account', 'حسابي', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(87, 'english', 'checkout', 'Checkout ', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(88, 'arabic', 'checkout', 'إرسال الطلب', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(95, 'english', 'total', 'Total', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(96, 'arabic', 'total', 'الاجمالى', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(97, 'english', 'sub_total', 'Subtotal', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(98, 'arabic', 'sub_total', 'التكلفة', '2024-04-29 11:57:25', '2024-05-17 05:17:32'),
(99, 'english', 'product', 'Product', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(100, 'arabic', 'product', 'المنتج', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(101, 'english', 'products', 'Products', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(102, 'arabic', 'products', 'المنتجات', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(103, 'english', 'place_order', 'Place order', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(104, 'arabic', 'place_order', 'إرسال الطلب', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(107, 'english', 'bill_info', 'Billing details', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(108, 'arabic', 'bill_info', 'بيانات الدفع', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(109, 'english', 'proceed_checkout', 'Proceed to checkout', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(110, 'arabic', 'proceed_checkout', 'الانتقال الى الدفع', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(111, 'english', 'payment', 'Payment', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(112, 'arabic', 'payment', 'الدفع', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(113, 'english', 'price', 'Price', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(114, 'arabic', 'price', 'السعر', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(115, 'english', 'print', 'Print', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(116, 'arabic', 'print', 'طباعة', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(117, 'english', 'options', 'Options', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(118, 'arabic', 'options', 'الخيارات', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(129, 'english', 'more', 'More', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(130, 'arabic', 'more', 'المزيد', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(137, 'english', 'users', 'Users', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(138, 'arabic', 'users', 'المستخدمين', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(155, 'english', 'pages', 'Pages', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(156, 'arabic', 'pages', 'صفحات الموقع', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(163, 'english', 'done', 'Done', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(164, 'arabic', 'done', 'تم بنجاح', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(165, 'english', 'confirmation', 'Confirmation', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(166, 'arabic', 'confirmation', 'يرجى التأكيد', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(167, 'english', 'cancel', 'Cancel', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(168, 'arabic', 'cancel', 'إلغاء', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(169, 'english', 'save', 'Save', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(170, 'arabic', 'save', 'حفظ', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(171, 'english', 'del', 'Delete', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(172, 'arabic', 'del', 'حذف', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(173, 'english', 'yes', 'Yes', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(174, 'arabic', 'yes', 'نعم', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(175, 'english', 'no', 'No', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(176, 'arabic', 'no', 'لا', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(177, 'english', 'no_here', 'Non', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(178, 'arabic', 'no_here', 'Non', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(179, 'english', 'yet', 'Yet', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(180, 'arabic', 'yet', 'بعد', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(181, 'english', 'messages_list', 'Messages list', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(182, 'arabic', 'messages_list', 'قائمة الرسائل', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(183, 'english', 'send', 'Send', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(184, 'arabic', 'send', 'إرسال', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(185, 'english', 'update', 'Update', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(186, 'arabic', 'update', 'تعديل', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(187, 'english', 'edit', 'Edit', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(188, 'arabic', 'edit', 'تعديل', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(203, 'english', 'info', 'Info', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(204, 'arabic', 'info', 'البيانات', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(217, 'english', 'payment_method', 'Payment method', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(218, 'arabic', 'payment_method', 'طريقة  الدفع', '2024-04-29 11:57:25', '2024-04-29 11:57:25'),
(229, 'english', 'item', 'Item', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(230, 'arabic', 'item', 'عنصر', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(231, 'english', 'title', 'Title', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(232, 'arabic', 'title', 'العنوان', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(233, 'english', 'desc', 'Description', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(234, 'arabic', 'desc', 'الوصف', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(235, 'english', 'length', 'Length', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(236, 'arabic', 'length', 'المدة', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(239, 'english', 'plays', 'Views', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(240, 'arabic', 'plays', 'المشاهدات', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(241, 'english', 'views', 'Views', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(242, 'arabic', 'views', 'المشاهدات', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(243, 'english', 'category', 'Category', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(244, 'arabic', 'category', 'القسم', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(245, 'english', 'share_sm', 'Share on social media', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(246, 'arabic', 'share_sm', 'نشر على مواقع التواصل ', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(249, 'english', 'choose_cat', 'Please choose category', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(250, 'arabic', 'choose_cat', 'يرجي إختيار القسم', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(251, 'english', 'comments', 'Comments', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(252, 'arabic', 'comments', 'التعليقات', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(253, 'english', 'search', 'Search', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(254, 'arabic', 'search', 'بحث', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(255, 'english', 'tags', 'Tags', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(256, 'arabic', 'tags', 'الأوسمة', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(257, 'english', 'subscription', 'Subscription', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(258, 'arabic', 'subscription', 'الإشتراك', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(259, 'english', 'old_subscription', 'Old subscriptions', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(260, 'arabic', 'old_subscription', 'سجل الإشتراكات ', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(261, 'english', 'amount', 'Amount', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(262, 'arabic', 'amount', 'القيمة', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(263, 'english', 'method', 'Method', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(264, 'arabic', 'method', 'طريقة', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(265, 'english', 'status', 'Status', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(266, 'arabic', 'status', 'الحالة', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(267, 'english', 'date', 'Date', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(268, 'arabic', 'date', 'التاريخ', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(269, 'english', 'id', 'Id', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(270, 'arabic', 'id', 'ID', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(271, 'english', 'cats_list', 'Categories list', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(272, 'arabic', 'cats_list', 'الأقسام', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(273, 'english', 'items_list', 'Items list', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(274, 'arabic', 'items_list', 'قائمة العناصر', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(275, 'english', 'signup', 'Sign up', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(276, 'arabic', 'signup', 'تسجيل', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(277, 'english', 'new_member', 'Not a member ?', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(278, 'arabic', 'new_member', 'عميل جديد ؟', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(279, 'english', 'login_with', 'Login with', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(280, 'arabic', 'login_with', 'الدخول بواسطة', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(281, 'english', 'signup_with', 'Sign in with', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(282, 'arabic', 'signup_with', 'التسجيل بإستخدام ', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(283, 'english', 'pers_info', 'Personal information', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(284, 'arabic', 'pers_info', 'البيانات الشخصية', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(285, 'english', 'information', 'Information', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(286, 'arabic', 'information', 'معلومات', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(287, 'english', 'extra_time_is', 'Extra time is', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(288, 'arabic', 'extra_time_is', 'الوقت الإضافي  ', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(289, 'english', 'confirm_complete_booking', 'Confirm complete booking', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(290, 'arabic', 'confirm_complete_booking', 'تأكيد إنهاء الحجز  و الإنتقال إلى الدفع', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(295, 'english', 'cha_pic', 'Profile picture', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(296, 'arabic', 'cha_pic', 'Profile picture', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(297, 'english', 'no_more', ' no items here', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(298, 'arabic', 'no_more', 'لا يوجد اى محتوى', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(301, 'english', 'thanks_for_purchase', 'Thanks for purchase', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(302, 'arabic', 'thanks_for_purchase', 'شكرا لإتمام عملية الدفع', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(303, 'english', 'payment_canceled', 'Payment canceled', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(304, 'arabic', 'payment_canceled', 'تم إلغاء عملية الدفع', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(305, 'english', 'succ_purchase', 'You have successfully confirmed the booking, and the transaction is successfully proceed.', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(306, 'arabic', 'succ_purchase', 'تم الدفع بنجاح. تم التاكيد على طلبك.', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(307, 'english', 'log_first', 'Please login first', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(308, 'arabic', 'log_first', 'يرجى تسجيل الدخول اولا', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(311, 'english', 'bought_before', 'You have bought this item before', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(312, 'arabic', 'bought_before', 'تم شراء هذه الخدمة من  بالفعل', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(313, 'english', '404', 'We are sorry we can not find that page', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(314, 'arabic', '404', 'We are sorry we can not find that page', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(315, 'english', '404_title', 'You\'re lost in the 404 world!', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(316, 'arabic', '404_title', 'الصفحة غير موجودة', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(317, 'english', '404_subtitle', 'The page you are looking for doesn\'t exist', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(318, 'arabic', '404_subtitle', 'الصفحة التى تحاول الوصول اليها حاليا تم او نقلها او تم حذفها ', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(319, 'english', '404_paragraph', 'You may have miss typed the address of the page has been moved', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(320, 'arabic', '404_paragraph', 'من الممكن  ان تكون وصلت هنا عن طريق الخطا ', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(323, 'english', 'msgs', 'Messages', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(324, 'arabic', 'msgs', 'الرسائل', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(325, 'english', 'message', 'Message', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(326, 'arabic', 'message', 'الرسالة', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(327, 'english', 'notifications', 'Notifications', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(328, 'arabic', 'notifications', 'التنبيهات', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(329, 'english', 'all_notifications', 'All notifications', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(330, 'arabic', 'all_notifications', 'جميع التنبيهات', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(331, 'english', 'notifications_log', 'Notifications log', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(332, 'arabic', 'notifications_log', 'سجل التنبيهات', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(333, 'english', 'profile', 'Profile', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(334, 'arabic', 'profile', 'الملف الشخصي', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(342, 'arabic', 'settings', 'الاعدادات', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(343, 'english', 'system_settings', 'System settings', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(344, 'arabic', 'system_settings', 'اعدادات النظام', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(345, 'english', 'events', 'Events', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(346, 'arabic', 'events', 'أحداث و أخبار', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(347, 'english', 'logout', 'Logout', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(348, 'arabic', 'logout', 'تسجيل الخروج', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(349, 'english', 'join', 'Join', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(350, 'arabic', 'join', 'الانضمام', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(351, 'english', 'renew', 'Renew', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(352, 'arabic', 'renew', 'تجديد الإشتراك', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(353, 'english', 'subscribe', 'Subscribe', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(354, 'arabic', 'subscribe', 'اشتراك', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(355, 'english', 'subscribed_successfully', 'Subscribed successfully', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(356, 'arabic', 'subscribed_successfully', 'تم الإشتراك بنجاح', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(357, 'english', 'plan', 'Plan', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(358, 'arabic', 'plan', 'الخطة', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(359, 'english', 'plans', 'Plans', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(360, 'arabic', 'plans', 'خطط الإشتراكات', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(361, 'english', 'subscribe_to_plan', 'Subscribe to plan', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(362, 'arabic', 'subscribe_to_plan', 'اختر  الخطة المناسبة  لك', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(363, 'english', 'time', 'Time', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(364, 'arabic', 'time', 'الوقت', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(368, 'arabic', 'subscription_msg', 'Make sure you have enough credit to subscribe to any plan', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(369, 'english', 'forgot_password', 'Forgot password', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(370, 'arabic', 'forgot_password', 'نسيت كلمة المرور', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(371, 'english', 'enter_country', 'Your country', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(372, 'arabic', 'enter_country', 'ادخل الدولة', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(373, 'english', 'enter_city', 'Your city', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(374, 'arabic', 'enter_city', 'ادخل المدينة', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(375, 'english', 'city', 'City', '2024-04-29 11:57:26', '2024-04-29 11:57:26'),
(376, 'arabic', 'city', 'المدينة', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(377, 'english', 'upgrade_msg', 'Enjoy with your new plan features.', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(378, 'arabic', 'upgrade_msg', 'Enjoy with your new plan features.', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(385, 'english', 'company', 'Company', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(386, 'arabic', 'company', 'شركة', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(393, 'english', 'website', 'Website', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(394, 'arabic', 'website', 'الموقع الالكتروني', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(399, 'english', 'public_profile_details', 'Public profile details', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(400, 'arabic', 'public_profile_details', 'Public profile details', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(401, 'english', 'order_by', 'Order by', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(402, 'arabic', 'order_by', 'عرض حسب ', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(403, 'english', 'user_type', 'User type', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(404, 'arabic', 'user_type', 'نوع الحساب', '2024-04-29 11:57:27', '2024-05-01 13:36:43'),
(425, 'english', 'browse', 'Browse', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(426, 'arabic', 'browse', 'تصفح', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(427, 'english', 'browse_filter', 'Browse filters', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(428, 'arabic', 'browse_filter', 'تصفح الملفات', '2024-04-29 11:57:27', '2024-05-01 13:37:02'),
(429, 'english', 'select', '-- select --', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(430, 'arabic', 'select', '-- إختر --', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(431, 'english', 'select_cats', 'Category', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(432, 'arabic', 'select_cats', 'القسم', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(445, 'english', 'today', 'Today', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(446, 'arabic', 'today', 'اليوم', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(447, 'english', 'this_week', 'This week', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(448, 'arabic', 'this_week', 'هذا الإسبوع', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(449, 'english', 'this_month', 'This month', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(450, 'arabic', 'this_month', 'هذا الشهر', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(451, 'english', 'this_year', 'This year', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(452, 'arabic', 'this_year', 'هذا العام', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(453, 'english', 'all_time', 'All time', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(454, 'arabic', 'all_time', 'كل الأوقات', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(465, 'english', 'discount_code', 'Discount code', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(466, 'arabic', 'discount_code', 'كود الخصم', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(467, 'english', 'discount', 'Discount', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(468, 'arabic', 'discount', 'الخصم', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(469, 'english', 'discounts', 'Discounts', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(470, 'arabic', 'discounts', 'الخصومات', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(471, 'english', 'new_discount', 'New discount', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(472, 'arabic', 'new_discount', 'خصم جديد', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(473, 'english', 'percentage', 'Percentage', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(474, 'arabic', 'percentage', 'النسبة', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(475, 'english', 'code', 'Code', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(476, 'arabic', 'code', 'الكود', '2024-04-29 11:57:27', '2024-04-29 11:57:27'),
(525, 'english', 'login_page', 'Login page', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(526, 'arabic', 'login_page', 'الدخول للوحة الادارة', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(527, 'english', 'login_fail', 'Credentials not valid, please try again.', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(528, 'arabic', 'login_fail', 'البيانات غير صحيحة يرجى المحاولة مرة اخري.', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(529, 'english', 'valid_input', 'Please enter valid data.', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(530, 'arabic', 'valid_input', 'يرجي التأكد من البيانات التي تم ادخالها', '2024-04-29 11:57:28', '2024-05-01 13:38:37'),
(531, 'english', 'loggedin', 'Thanks for login', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(532, 'arabic', 'loggedin', 'تم تسجيل الدخول', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(533, 'english', 'setting_page', 'Setting page', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(534, 'arabic', 'setting_page', 'صفحة الاعدادات', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(537, 'english', 'administrators', 'Administrators', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(538, 'arabic', 'administrators', 'المديرين', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(539, 'english', 'sitename', 'Site name', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(540, 'arabic', 'sitename', 'اسم الموقع', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(541, 'english', 'deny_access', 'Access denied.', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(542, 'arabic', 'deny_access', 'ممنوع الوصول', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(543, 'english', 'saved', 'Done.', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(544, 'arabic', 'saved', 'تم', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(545, 'english', 'failed', 'Failed.', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(546, 'arabic', 'failed', 'فشلت العملية', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(547, 'english', 'dashboard', 'Dashboard', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(548, 'arabic', 'dashboard', 'لوحة الإدارة', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(549, 'english', 'setting', 'Setting', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(550, 'arabic', 'setting', 'الاعدادات', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(551, 'english', 'add_new', 'Add new', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(552, 'arabic', 'add_new', 'أضف جديد', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(553, 'english', 'add_new_category', 'Add new category', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(554, 'arabic', 'add_new_category', 'إضافة قسم جديد', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(555, 'english', 'add_new_game', 'Add new game', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(556, 'arabic', 'add_new_game', 'إضافة  لعبة  جديد', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(557, 'english', 'fullname_empty', 'Name field is required', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(558, 'arabic', 'fullname_empty', 'يرجى ادخال الاسم', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(559, 'english', 'email_found', 'Email address already found', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(560, 'arabic', 'email_found', 'هذا البريد موجود بالفعل ', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(561, 'english', 'email_empty', 'Email field is required', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(562, 'arabic', 'email_empty', 'البريد الالكتروني مطلوب', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(563, 'english', 'name_found', 'Name field already found', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(564, 'arabic', 'name_found', 'الإسم موجود بالفعل', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(565, 'english', 'name_empty', 'Name field is required', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(566, 'arabic', 'name_empty', 'الإسم مطلوب', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(567, 'english', 'password_short', 'Password is too short, min characters ', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(568, 'arabic', 'password_short', 'كلمة المرور قصيرة, الحد الأدني  ', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(569, 'english', 'password_empty', 'Password missed, min characters ', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(570, 'arabic', 'password_empty', 'يرجي التأكد من كلمة المرور', '2024-04-29 11:57:28', '2024-05-01 13:39:13'),
(571, 'english', 'publish', 'Publish', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(572, 'arabic', 'publish', 'نشط', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(573, 'english', 'action', 'Action', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(574, 'arabic', 'action', 'إجراءات', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(575, 'english', 'teachers', 'Teachers', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(576, 'arabic', 'teachers', 'Teachers', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(577, 'english', 'teacher', 'Teacher', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(578, 'arabic', 'teacher', 'Teacher', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(579, 'english', 'birthday', 'Birthday', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(580, 'arabic', 'birthday', 'تاريخ الميلاد', '2024-04-29 11:57:28', '2024-05-01 18:09:57'),
(581, 'english', 'birthday_date', 'Date of birth', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(582, 'arabic', 'birthday_date', 'تاريخ الميلاد', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(583, 'english', 'adrs', 'Address', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(584, 'arabic', 'adrs', 'العنوان', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(585, 'english', 'phone', 'Phone', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(586, 'arabic', 'phone', 'الهاتف', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(587, 'english', 'role', 'Role', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(588, 'arabic', 'role', 'Role', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(589, 'english', 'classes', 'Classes', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(590, 'arabic', 'classes', 'Classes', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(591, 'english', 'number', 'Number', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(592, 'arabic', 'number', 'رقم', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(593, 'english', 'gender', 'Gender', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(594, 'arabic', 'gender', 'النوع', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(595, 'english', 'provider', 'Branch', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(596, 'arabic', 'provider', 'مزود الخدمة', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(597, 'english', 'providers', 'Branches', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(598, 'arabic', 'providers', 'مزودي الخدمة', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(599, 'english', 'our_providers', 'Our branches', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(600, 'arabic', 'our_providers', 'مزودي الخدمة ', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(601, 'english', 'start_date', 'Start date', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(602, 'arabic', 'start_date', 'تاريخ البدء', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(603, 'english', 'mobile', 'Mobile', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(604, 'arabic', 'mobile', 'الموبايل', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(607, 'english', 'check', 'Check', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(608, 'arabic', 'check', 'مراجعة', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(611, 'english', 'submit', 'Submit', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(612, 'arabic', 'submit', 'تنفيذ', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(613, 'english', 'choose', 'Choose', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(614, 'arabic', 'choose', 'اختر', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(617, 'english', 'news', 'News', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(618, 'arabic', 'news', 'الأخبار', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(619, 'english', 'view', 'View', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(620, 'arabic', 'view', 'عرض', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(623, 'english', 'working_hours', 'Working hours', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(624, 'arabic', 'working_hours', 'ساعات العمل', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(625, 'english', 'working_days', 'Working days', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(626, 'arabic', 'working_days', 'ايام العمل', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(635, 'english', 'next', 'Next', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(636, 'arabic', 'next', 'التالى', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(637, 'english', 'prev', 'Prev', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(638, 'arabic', 'prev', 'السابق', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(639, 'english', 'nextpage', 'Next page', '2024-04-29 11:57:28', '2024-04-29 11:57:28'),
(640, 'arabic', 'nextpage', 'الصفحة التالية', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(641, 'english', 'prevpage', 'Prev page', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(642, 'arabic', 'prevpage', 'الصفحة السابقة', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(643, 'english', 'golden', 'Golden !', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(644, 'arabic', 'golden', 'Golden !', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(645, 'english', 'joinus', 'Join us', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(646, 'arabic', 'joinus', 'انضم الينا', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(647, 'english', 'welcome', 'Welcome ', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(648, 'arabic', 'welcome', 'اهلا', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(649, 'english', 'login_msg', 'Welcome, use your information to login or create new account.', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(650, 'arabic', 'login_msg', 'اهلا بك, يرجى استخدام البيانات الخاصة بك للدخول الى  الى هذه الصفحة', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(651, 'english', 'forms_msgs', 'Forms messages', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(652, 'arabic', 'forms_msgs', 'رسائل التواصل', '2024-04-29 11:57:29', '2024-05-01 13:40:29'),
(653, 'english', 'thnks_msg', 'Thanks for your message we will get in contact with you.', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(654, 'arabic', 'thnks_msg', 'شكرا على رسالتك. سيتم التواصل معك فى اقرب وقت ممكن', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(655, 'english', 'msg', 'Message', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(656, 'arabic', 'msg', 'الرسالة', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(661, 'english', 'readmore', 'Read more', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(662, 'arabic', 'readmore', 'المزيد', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(667, 'english', 'rel_items', 'Related items', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(668, 'arabic', 'rel_items', 'العناصر المرتبطة', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(669, 'english', 'branch', 'Branch', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(670, 'arabic', 'branch', 'الفرع ', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(671, 'english', 'branch_name', 'Branch name', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(672, 'arabic', 'branch_name', 'اسم الفرع', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(673, 'english', 'branches', 'Branches', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(674, 'arabic', 'branches', 'الفروع', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(679, 'english', 'comments_allow', 'Allow comments', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(680, 'arabic', 'comments_allow', 'السماح بالتعليقات', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(681, 'english', 'comments_count', 'Comments count', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(682, 'arabic', 'comments_count', 'عدد التعليقات', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(687, 'english', 'langs', 'Languages', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(688, 'arabic', 'langs', 'اللغات', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(689, 'english', 'con_trans', 'Content translation', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(690, 'arabic', 'con_trans', 'Content translation', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(691, 'english', 'tag_title', 'Tag title', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(692, 'arabic', 'tag_title', 'Tag title', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(693, 'english', 'tag_desc', 'Tag describtion', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(694, 'arabic', 'tag_desc', 'Tag describtion', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(695, 'english', 'tag_keywords', 'Tag keywords', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(696, 'arabic', 'tag_keywords', 'Tag keywords', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(697, 'english', 'content', 'Content', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(698, 'arabic', 'content', 'المحتوى', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(699, 'english', 'short', 'Short brief', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(700, 'arabic', 'short', 'الملخص', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(703, 'english', 'go_back', 'Go back', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(704, 'arabic', 'go_back', 'العودة', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(705, 'english', 'err_input_title', 'Please add title first.', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(706, 'arabic', 'err_input_title', 'يرجى اضافة العنوان اولا.', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(707, 'english', 'err_input_pages', 'Please select page first.', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(708, 'arabic', 'err_input_pages', 'يرجى اختيار الصفحة.', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(709, 'english', 'err_input_langs', 'Please select language first.', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(710, 'arabic', 'err_input_langs', 'يرجى اختيار اللغة.', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(711, 'english', 'signup_done_msg', 'You can login after reviewing your profile.', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(712, 'arabic', 'signup_done_msg', 'يمكنك الدخول بعد مراجعة حسابك.', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(713, 'english', 'about', 'About', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(714, 'arabic', 'about', 'من نحن', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(715, 'english', 'contact', 'Contact', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(716, 'arabic', 'contact', 'اتصل بنا', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(717, 'english', 'arabic', 'Arabic', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(718, 'arabic', 'arabic', 'العربية', '2024-04-29 11:57:29', '2024-05-02 04:13:37'),
(719, 'english', 'english', 'English', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(720, 'arabic', 'english', 'English', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(721, 'english', 'change_lang', 'Change language', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(722, 'arabic', 'change_lang', 'تغيير اللغة', '2024-04-29 11:57:29', '2024-05-01 13:41:57'),
(725, 'english', 'customers', 'Customers', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(726, 'arabic', 'customers', 'العملاء', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(733, 'english', 'customer', 'Customer', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(734, 'arabic', 'customer', 'العميل', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(735, 'english', 'notes', 'Notes', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(736, 'arabic', 'notes', 'ملاحظات', '2024-04-29 11:57:29', '2024-04-29 11:57:29'),
(747, 'english', 'level', 'Level', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(748, 'arabic', 'level', 'المستوي', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(749, 'english', 'type', 'Type', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(750, 'arabic', 'type', 'النوع', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(751, 'english', 'pending', 'Pending', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(752, 'arabic', 'pending', 'قيد الإنتظار', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(753, 'english', 'invoice', 'Invoice', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(754, 'arabic', 'invoice', 'فاتورة', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(755, 'english', 'invoices_list', 'Invoices list', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(756, 'arabic', 'invoices_list', 'قائمة الفواتير', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(757, 'english', 'terms_conds', 'Terms & conditions', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(758, 'arabic', 'terms_conds', 'شروط الإستخدام', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(759, 'english', 'customer_info', 'Customer info', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(760, 'arabic', 'customer_info', 'بيانات العميل', '2024-04-29 11:57:30', '2024-05-01 13:42:28'),
(761, 'english', 'order', 'Order', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(762, 'arabic', 'order', 'الطلب', '2024-04-29 11:57:30', '2024-05-18 04:52:22'),
(763, 'english', 'cost', 'Cost', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(764, 'arabic', 'cost', 'التكلفة', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(765, 'english', 'total_cost', 'Total cost', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(766, 'arabic', 'total_cost', 'التكلفة الاجمالية', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(769, 'english', 'mobile_api', 'Api management', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(770, 'arabic', 'mobile_api', 'API management', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(783, 'english', 'password_matching_error', 'Password not matched', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(784, 'arabic', 'password_matching_error', 'كلمة المرور غير متطابقة', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(785, 'english', 'wrong_info', 'Invalid information', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(786, 'arabic', 'wrong_info', 'البيانات غير سليمة', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(787, 'english', 'err', 'Error', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(788, 'arabic', 'err', 'خطأ', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(789, 'english', 'err_ext', 'Error file extension not allowed', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(790, 'arabic', 'err_ext', 'هذه الصيغة غير مسموح بها', '2024-04-29 11:57:30', '2024-05-01 13:43:56'),
(803, 'english', 'def_lang', 'Default language', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(804, 'arabic', 'def_lang', 'Default language', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(809, 'english', 'oops', 'Oops, something is wrong...', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(810, 'arabic', 'oops', 'Oops, Something is wrong...', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(811, 'english', 'filter', 'Filter', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(812, 'arabic', 'filter', 'ترتيب حسب', '2024-04-29 11:57:30', '2024-04-29 11:57:30'),
(813, 'english', 'day', 'Day', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(814, 'arabic', 'day', 'اليوم', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(815, 'english', 'month', 'Month', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(816, 'arabic', 'month', 'شهر', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(817, 'english', 'orders_hist', 'Orders history', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(819, 'english', 'roles_manaegment', 'Roles manaegment', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(820, 'arabic', 'roles_manaegment', 'إدارة الصلاخيات', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(821, 'english', 'all', 'All', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(822, 'arabic', 'all', 'الكل', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(823, 'english', 'select_all', 'Select all', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(824, 'arabic', 'select_all', 'اختر الكل', '2024-04-29 11:57:31', '2024-05-01 13:44:33'),
(825, 'english', 'err_files', 'Error: some files are unreadable ', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(826, 'arabic', 'err_files', 'Error: Some files are unreadable ', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(827, 'english', 'details', 'Details', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(828, 'arabic', 'details', 'التفاصيل', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(835, 'english', 'parent_category', 'Parent category', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(836, 'arabic', 'parent_category', 'القسم الرئيسي', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(837, 'english', 'parent_name', 'Parent name', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(838, 'arabic', 'parent_name', 'إسم ولي الأمر', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(845, 'english', 'seo_desc', 'Seo desc', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(846, 'arabic', 'seo_desc', 'SEO Desc', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(847, 'english', 'seo_title', 'Seo title', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(848, 'arabic', 'seo_title', 'SEO Title', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(849, 'english', 'ext', 'Extension', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(850, 'arabic', 'ext', 'Extension', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(851, 'english', 'exts', 'Extensions', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(852, 'arabic', 'exts', 'Extensions', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(859, 'english', 'logo', 'Logo', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(860, 'arabic', 'logo', 'اللوجو', '2024-04-29 11:57:31', '2024-04-29 11:57:31'),
(863, 'english', 'create_your_own_account', 'Create your own account', '2024-04-29 11:57:32', '2024-04-29 11:57:32'),
(864, 'arabic', 'create_your_own_account', 'يمكنك إنشاء حسابك الان', '2024-04-29 11:57:32', '2024-04-29 11:57:32'),
(865, 'english', 'registration', 'Registration', '2024-04-29 11:57:32', '2024-04-29 11:57:32'),
(866, 'arabic', 'registration', 'التسجيل', '2024-04-29 11:57:32', '2024-04-29 11:57:32'),
(867, 'english', 'registration_step2', 'Complete registration', '2024-04-29 11:57:32', '2024-04-29 11:57:32'),
(868, 'arabic', 'registration_step2', 'Complete Registration', '2024-04-29 11:57:32', '2024-04-29 11:57:32'),
(869, 'english', 'agree_terms', 'I accept the terms and conditions of the website', '2024-04-29 11:57:32', '2024-04-29 11:57:32'),
(870, 'arabic', 'agree_terms', 'تمت القراءة والموافقة على الشروط لاستخدام هذه الخدمة', '2024-04-29 11:57:32', '2024-04-29 11:57:32'),
(871, 'english', 'menu', 'Menu', '2024-04-29 11:57:32', '2024-04-29 11:57:32'),
(872, 'arabic', 'menu', 'القائمة', '2024-04-29 11:57:32', '2024-05-01 13:45:34'),
(873, 'english', 'customer_menu', 'Customer menu', '2024-04-29 11:57:32', '2024-04-29 11:57:32'),
(874, 'arabic', 'customer_menu', 'قائمة العميل', '2024-04-29 11:57:32', '2024-05-01 13:45:40'),
(875, 'english', 'profile_setting', 'Profile setting', '2024-04-29 11:57:32', '2024-04-29 11:57:32'),
(876, 'arabic', 'profile_setting', 'اعدادات الحساب', '2024-04-29 11:57:32', '2024-05-01 13:45:48'),
(883, 'english', 'turn_on_notes', 'Turn on notifications', '2024-04-29 11:57:32', '2024-04-29 11:57:32');
INSERT INTO `translations` (`translation_id`, `language_code`, `code`, `value`, `created_at`, `updated_at`) VALUES
(884, 'arabic', 'turn_on_notes', 'Turn on notifications', '2024-04-29 11:57:32', '2024-04-29 11:57:32'),
(885, 'english', 'turn_off_notes', 'Turn off notifications', '2024-04-29 11:57:32', '2024-04-29 11:57:32'),
(886, 'arabic', 'turn_off_notes', 'Turn off notifications', '2024-04-29 11:57:32', '2024-04-29 11:57:32'),
(911, 'english', 'view_all', 'View all', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(912, 'arabic', 'view_all', 'عرض الكل', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(917, 'english', 'close', 'Close', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(918, 'arabic', 'close', 'Close', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(929, 'english', 'create_page', 'Create an page', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(930, 'arabic', 'create_page', 'Create an Page', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(933, 'english', 'complete_acc', 'Complete account', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(934, 'arabic', 'complete_acc', 'Complete account', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(935, 'english', 'com_deleted', 'Comment deleted', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(936, 'arabic', 'com_deleted', 'Comment deleted', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(937, 'english', 'deleted', 'Deleted', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(938, 'arabic', 'deleted', 'تم الحذف بنجاح', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(939, 'english', 'add_ur_comment', 'Add your comment...', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(940, 'arabic', 'add_ur_comment', 'أضف تعليقك...', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(941, 'english', 'add_user', 'Add user', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(942, 'arabic', 'add_user', 'إضافة مستخدم ', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(943, 'english', 'reply', 'Reply', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(944, 'arabic', 'reply', 'رد', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(945, 'english', 'commented_ur', ' commented on your ', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(946, 'arabic', 'commented_ur', ' commented on your ', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(947, 'english', 'liked_ur', ' liked your ', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(948, 'arabic', 'liked_ur', ' liked your ', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(949, 'english', 'mentioned_ur', ' mentioned you at ', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(950, 'arabic', 'mentioned_ur', ' mentioned you at ', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(951, 'english', 'tagged_ur', ' tagged you at ', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(952, 'arabic', 'tagged_ur', ' tagged you at ', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(953, 'english', 'shared_ur', ' shared your ', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(954, 'arabic', 'shared_ur', ' shared your ', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(955, 'english', 'want_join_ur', ' want to join your ', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(956, 'arabic', 'want_join_ur', ' want to join your ', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(957, 'english', 'report', 'Report', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(958, 'arabic', 'report', 'تقرير', '2024-04-29 11:57:33', '2024-04-29 11:57:33'),
(969, 'english', 'confirm', 'Confirm', '2024-04-29 11:57:34', '2024-04-29 11:57:34'),
(970, 'arabic', 'confirm', 'تأكيد الحجز', '2024-04-29 11:57:34', '2024-04-29 11:57:34'),
(971, 'english', 'add', 'Add', '2024-04-29 11:57:34', '2024-04-29 11:57:34'),
(972, 'arabic', 'add', 'إضافة', '2024-04-29 11:57:34', '2024-04-29 11:57:34'),
(977, 'english', 'create_pages', 'Create page', '2024-04-29 11:57:34', '2024-04-29 11:57:34'),
(978, 'arabic', 'create_pages', 'Create page', '2024-04-29 11:57:34', '2024-04-29 11:57:34'),
(1007, 'english', 'view_on_map', 'View on map', '2024-04-29 11:57:34', '2024-04-29 11:57:34'),
(1008, 'arabic', 'view_on_map', 'عرض على الخريطة', '2024-04-29 11:57:34', '2024-04-29 11:57:34'),
(1009, 'english', 'google_analytics', 'Google analytics', '2024-04-29 11:57:34', '2024-04-29 11:57:34'),
(1010, 'arabic', 'google_analytics', 'Google Analytics', '2024-04-29 11:57:34', '2024-04-29 11:57:34'),
(1014, 'arabic', 'type_insert', 'Insert type', '2024-04-29 11:57:34', '2024-04-29 11:57:34'),
(1015, 'english', 'shop', 'Shop', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1016, 'arabic', 'shop', 'Shop', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1027, 'english', 'currency_tag', 'Default currency symbol', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1028, 'arabic', 'currency_tag', 'Default Currency symbol', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1033, 'english', 'coupons', 'Coupons', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1034, 'arabic', 'coupons', 'كوبونات الخصم', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1035, 'english', 'coupon', 'Coupon', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1036, 'arabic', 'coupon', 'الكوبون', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1037, 'english', 'coupon_duplicated', 'This code already found', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1038, 'arabic', 'coupon_duplicated', 'هذا الكود موجود من قبل', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1039, 'english', 'min_order_cost', 'Order minimum cost', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1040, 'arabic', 'min_order_cost', 'الحد الأدني لتطبيق الخصم', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1041, 'english', 'err_min_order', 'Error! order minimum cost is ', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1042, 'arabic', 'err_min_order', 'حطأ! الحد الأدني لتطبيق الخصم هو  ', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1043, 'english', 'err_expired', 'Error! not avaialbe anymore ', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1044, 'arabic', 'err_expired', 'خطأ! لم يعد متاح ', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1045, 'english', 'value', 'Value', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1046, 'arabic', 'value', 'القيمة', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1047, 'english', 'customer_usage_limit', 'Usage limit (per user)', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1048, 'arabic', 'customer_usage_limit', 'Usage limit (Per User)', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1049, 'english', 'usage_limit', 'Usage limit (orders max number)', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1050, 'arabic', 'usage_limit', 'Usage limit (Orders max number)', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1051, 'english', 'commission', 'Commission', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1052, 'arabic', 'commission', 'نسبة الخصم', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1053, 'english', 'end_date', 'End date', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1054, 'arabic', 'end_date', 'تاريخ الإنتهاء', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1061, 'english', 'sender_email', 'Default send email', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1062, 'arabic', 'sender_email', 'Default send email', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1063, 'english', 'forgot_pass_msg', 'Enter your email and follow the steps at the sent message', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1064, 'arabic', 'forgot_pass_msg', 'Enter your email and follow the steps at the sent message', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1065, 'english', 'reset_your_password', 'Reset your password', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1066, 'arabic', 'reset_your_password', 'نسيت كلمة المرور', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1067, 'english', 'reset_pass_msg', 'Enter your password and confirm it. please make sure you have choosed strong and rememberable one.', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1068, 'arabic', 'reset_pass_msg', 'Enter your password and confirm it. Please make sure you have choosed strong and rememberable one.', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1069, 'english', 'reset_pass_sent', 'Check your email to recover your password', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1070, 'arabic', 'reset_pass_sent', 'Check your email to recover your password', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1071, 'english', 'reset_pass_success', 'Your password has been reset successfully.', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1072, 'arabic', 'reset_pass_success', 'Your password has been reset successfully.', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1073, 'english', 'search_msg', 'What are<br>you looking for ?', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1074, 'arabic', 'search_msg', 'what are<br>you looking for ?', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1075, 'english', 'showing', 'Showing ', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1076, 'arabic', 'showing', 'Showing ', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1077, 'english', 'welcome_profile', 'You can manage your profile through this page and check the menu links', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1078, 'arabic', 'welcome_profile', 'يمكنك مراجعة بياناتك الشخصية والتحكم بصفحتك الشخصية من خلال  القائمة', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1079, 'english', 'group', 'Group ', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1080, 'arabic', 'group', 'Group ', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1081, 'english', 'groups', 'Groups ', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1082, 'arabic', 'groups', 'Groups ', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1083, 'english', 'sort', 'Sort ', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1084, 'arabic', 'sort', 'Sort ', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1085, 'english', 'buss_info', 'Business info', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1086, 'arabic', 'buss_info', 'Business info', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1087, 'english', 'direction', 'ltr', '2024-04-29 11:57:35', '2024-05-15 17:17:59'),
(1088, 'arabic', 'direction', 'rtl', '2024-04-29 11:57:35', '2024-05-15 17:17:59'),
(1089, 'english', 'directions', 'Directions', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1090, 'arabic', 'directions', 'Directions', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1091, 'english', 'book', 'Book', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1092, 'arabic', 'book', 'حجز', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1093, 'english', 'booking_id', 'Booking id ', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1094, 'arabic', 'booking_id', 'رقم الحجز ', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1095, 'english', 'booking_info', 'Booking information', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1096, 'arabic', 'booking_info', 'بيانات الحجز', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1097, 'english', 'booking_thanks', 'Thanks for booking offer from ', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1098, 'arabic', 'booking_thanks', 'شكرا لاختيارك  خدمات بداية', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1099, 'english', 'bookings', 'Bookings', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1100, 'arabic', 'bookings', 'الحجوزات', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1101, 'english', 'booking_page', 'Booking page', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1102, 'arabic', 'booking_page', 'صفحة الحجز', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1103, 'english', 'booking_date', 'Booking date', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1104, 'arabic', 'booking_date', 'موعد الحجز', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1105, 'english', 'change_picture', 'Change picture', '2024-04-29 11:57:35', '2024-04-29 11:57:35'),
(1106, 'arabic', 'change_picture', 'تغيير الصورة ', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1107, 'english', 'location', 'Location', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1108, 'arabic', 'location', 'Location', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1109, 'english', 'locations', 'Locations', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1110, 'arabic', 'locations', 'أماكن التوقف', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1111, 'english', 'share', 'Share', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1112, 'arabic', 'share', 'نشر', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1113, 'english', 'look_for', 'Look for', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1114, 'arabic', 'look_for', 'البحث عن', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1115, 'english', 'looking_for', 'Looking for', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1116, 'arabic', 'looking_for', 'البحث عن ', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1117, 'english', 'field_required', 'Fields is required', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1118, 'arabic', 'field_required', 'هذا الحقل مطلوب', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1119, 'english', 'reviews', 'Reviews', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1120, 'arabic', 'reviews', 'القتييمات', '2024-04-29 11:57:36', '2024-05-15 19:41:17'),
(1121, 'english', 'reviews_list', 'Reviews list', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1122, 'arabic', 'reviews_list', 'Reviews list', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1123, 'english', 'enabled', 'Enabled', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1124, 'arabic', 'enabled', 'Enabled', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1125, 'english', 'disabled', 'Disabled', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1126, 'arabic', 'disabled', 'Disabled', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1127, 'english', 'signup_status', 'Auto activate after signup', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1128, 'arabic', 'signup_status', 'Auto activate after signup', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1129, 'english', 'reviews_status', 'Reviews for customers', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1130, 'arabic', 'reviews_status', 'Reviews for customers', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1131, 'english', 'tip', 'Tip', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1132, 'arabic', 'tip', 'Tip', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1133, 'english', 'tips', 'Tips', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1134, 'arabic', 'tips', 'Tips', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1135, 'english', 'note', 'Note', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1136, 'arabic', 'note', 'Note', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1137, 'english', 'gmap_api', 'Google map api', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1138, 'arabic', 'gmap_api', 'Google Map API', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1147, 'english', 'please_add_your_devices_first', 'Please add your devices first', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1148, 'arabic', 'please_add_your_devices_first', 'يجب إضافة الجهاز أولا', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1154, 'arabic', 'apply_coupon', 'تطبيق الخصم', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1155, 'english', 'coupon_form_title', 'Enter your coupon code if you have one', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1156, 'arabic', 'coupon_form_title', 'يرجى ادخال كود الخصم', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1157, 'english', 'new', 'New', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1158, 'arabic', 'new', 'جديد', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1159, 'english', 'specializations', 'Services', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1160, 'arabic', 'specializations', 'الخدمات', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1161, 'english', 'specialization', 'Service', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1162, 'arabic', 'specialization', 'الخدمة', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1163, 'english', 'speciality', 'Speciality', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1164, 'arabic', 'speciality', 'التخصص', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1165, 'english', 'clone', 'Clone', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1166, 'arabic', 'clone', 'نسخ', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1167, 'english', 'success_stories', 'Success stories', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1168, 'arabic', 'success_stories', 'قصص النجاح', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1169, 'english', 'watch_video', 'Watch video', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1170, 'arabic', 'watch_video', 'مشاهدة  الفيديو', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1171, 'english', 'media_press', 'Media and press', '2024-04-29 11:57:36', '2024-04-29 11:57:36'),
(1172, 'arabic', 'media_press', 'الوسائط', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1173, 'english', 'businesses', 'Businesses', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1174, 'arabic', 'businesses', 'الأعمال', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1175, 'english', 'business', 'Business', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1176, 'arabic', 'business', 'العمل', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1177, 'english', 'business_name', 'Business name', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1178, 'arabic', 'business_name', 'إسم العمل', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1179, 'english', 'owner', 'Owner', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1180, 'arabic', 'owner', 'المالك', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1181, 'english', 'delete', 'Delete', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1182, 'arabic', 'delete', 'حذف', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1183, 'english', 'business_information', 'Business information', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1184, 'arabic', 'business_information', 'معلومات العمل', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1185, 'english', 'schools', 'Schools', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1186, 'arabic', 'schools', 'المدارس', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1187, 'english', 'companies', 'Companies', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1188, 'arabic', 'companies', 'الشركات', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1189, 'english', 'finance', 'Finance', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1190, 'arabic', 'finance', 'المالية', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1191, 'english', 'plan_payments', 'Plan payments', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1192, 'arabic', 'plan_payments', 'مدفوعات الاشتراكات', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1193, 'english', 'invoices', 'Invoices', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1194, 'arabic', 'invoices', 'الفواتير', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1195, 'english', 'business_wallets', 'Business wallets', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1196, 'arabic', 'business_wallets', 'المحافظ الالكترونية', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1197, 'english', 'wallets', 'Wallets', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1198, 'arabic', 'wallets', 'المحافظ الالكترونية', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1199, 'english', 'credit_balance', 'Credit balance', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1200, 'arabic', 'credit_balance', 'رصيد الدائن', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1201, 'english', 'debit_balance', 'Debit balance', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1202, 'arabic', 'debit_balance', 'رصيد المدين', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1203, 'english', 'business_withdrawals', 'Business withdrawals', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1204, 'arabic', 'business_withdrawals', 'طلبات السحب', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1205, 'english', 'total_credit_balance', 'Total credit balance', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1206, 'arabic', 'total_credit_balance', 'إجمالي رصيد الدائن', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1207, 'english', 'total_pending_amount', 'Total pending amount', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1208, 'arabic', 'total_pending_amount', 'إجمالي القيمة قيد الإنتظار', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1209, 'english', 'total_completed_amount', 'Total completed amount', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1210, 'arabic', 'total_completed_amount', 'إجمالي القيمة المكتملة', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1211, 'english', 'due_date', 'Due date', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1212, 'arabic', 'due_date', 'تاريخ الإستحقاق', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1213, 'english', 'total_debit_balance', 'Total debit balance', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1214, 'arabic', 'total_debit_balance', 'إجمالي رصيد المدين', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1215, 'english', 'withdrawals', 'Withdrawals', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1216, 'arabic', 'withdrawals', 'طلبات السحب', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1217, 'english', 'withdrawal', 'Withdrawal', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1218, 'arabic', 'withdrawal', 'طلبات السحب', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1219, 'english', 'front_pages', 'Front pages', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1220, 'arabic', 'front_pages', 'صفحات الموقع', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1221, 'english', 'driver_app_settings', 'Driver app settings', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1222, 'arabic', 'driver_app_settings', 'إعدادات تطبيق السائقين', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1223, 'english', 'parent_app_settings', 'Parent app settings', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1224, 'arabic', 'parent_app_settings', 'إعدادات تطبيق اولياء الأمور', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1225, 'english', 'customer_app_settings', 'Customer app settings', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1226, 'arabic', 'customer_app_settings', 'إعدادات تطبيق العملاء', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1227, 'english', 'total_invoices_amount', 'Total invoices amount', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1228, 'arabic', 'total_invoices_amount', 'إجمالي قيمة الفواتير', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1229, 'english', 'routes_trips', 'Routes trips', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1230, 'arabic', 'routes_trips', 'رحلات خطوط السير', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1231, 'english', 'private_trips', 'Private trips', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1232, 'arabic', 'private_trips', 'الرحلات الخاصة', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1233, 'english', 'top_businesses', 'Top businesses', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1234, 'arabic', 'top_businesses', 'أفضل الشركات', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1235, 'english', 'latest_invoices', 'Latest invoices', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1236, 'arabic', 'latest_invoices', 'أحدث الفواتير', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1237, 'english', 'new_subscriptions', 'New subscriptions', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1238, 'arabic', 'new_subscriptions', 'أحدث الإشتراكات', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1239, 'english', 'latest_help_messages', 'Latest help messages', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1240, 'arabic', 'latest_help_messages', 'احدث رسائل الدعم', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1241, 'english', 'top_businesses_who_have_most_route_locations', 'Top businesses who have most route locations', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1242, 'arabic', 'top_businesses_who_have_most_route_locations', 'أفضل الشركات حسب عدد نقاط التوقف', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1243, 'english', 'latest_subscriptions_request_has_been_sent', 'Latest subscriptions request has been sent', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1244, 'arabic', 'latest_subscriptions_request_has_been_sent', 'احدث طلبات الإشتراكات التي تم إرسالها', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1245, 'english', 'latest_plan_subscriptions', 'Latest plan subscriptions', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1246, 'arabic', 'latest_plan_subscriptions', 'احدث الإشتراكات للشركات', '2024-04-29 11:57:37', '2024-04-29 11:57:37'),
(1247, 'english', 'latest_tickets___help_messages_sent_by_users', 'Latest tickets   help messages sent by users', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1248, 'arabic', 'latest_tickets___help_messages_sent_by_users', 'احدث التذاكر و رسائل الدعم الفني', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1249, 'english', 'intro', 'Intro', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1250, 'arabic', 'intro', 'Intro', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1251, 'english', 'heading', 'Heading', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1252, 'arabic', 'heading', 'Heading', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1253, 'english', 'full_bio', 'Full biography', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1254, 'arabic', 'full_bio', 'السيرة الذاتية', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1255, 'english', 'count', 'Count', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1256, 'arabic', 'count', 'العدد', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1257, 'english', 'all_cases', 'All cases', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1258, 'arabic', 'all_cases', 'جميع الحالات', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1259, 'english', 'back', 'Back', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1260, 'arabic', 'back', 'عودة', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1261, 'english', 'appointments', 'Appointments', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1262, 'arabic', 'appointments', 'مواعيد الحجز', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1263, 'english', 'files_extensions', 'Files extensions', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1264, 'arabic', 'files_extensions', 'Files extensions', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1265, 'english', 'add_new_document', 'Add new document', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1266, 'arabic', 'add_new_document', 'اضافة ملف  جديد ', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1267, 'english', 'booking_note', 'Thanks for booking with us, we\'ll contact you asap.', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1268, 'arabic', 'booking_note', 'تم الحجز بنجاح, وسيتم التواصل معكم فى اقرب وقت', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1269, 'english', 'with', 'With', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1270, 'arabic', 'with', 'مع', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1271, 'english', 'for', 'For', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1272, 'arabic', 'for', 'من اجل', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1273, 'english', 'of', 'Of', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1274, 'arabic', 'of', 'من', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1275, 'english', 'at', 'At', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1276, 'arabic', 'at', 'فى', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1277, 'english', 'appointment_info', 'Appointment info', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1278, 'arabic', 'appointment_info', 'معلومات الحجز', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1279, 'english', 'fees', 'Fees', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1280, 'arabic', 'fees', 'التكلفة', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1281, 'english', 'color', 'Color', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1282, 'arabic', 'color', 'اللون', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1283, 'english', 'recent_articles', 'Recent articles', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1284, 'arabic', 'recent_articles', 'احدث المقالات', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1285, 'english', 'related_articles', 'Related articles', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1286, 'arabic', 'related_articles', 'صفحات ذات صلة', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1287, 'english', 'hot_topics', 'Hot topics', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1288, 'arabic', 'hot_topics', 'مواضيع هامة', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1289, 'english', 'posted', 'Posted', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1290, 'arabic', 'posted', 'تم النشر', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1291, 'english', 'select_platform', 'Select one or more platforms to reach you out', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1292, 'arabic', 'select_platform', 'يرجى اختيار الوسيلة المناسبة لك للتواصل', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1293, 'english', 'platform_id', 'Platform id', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1294, 'arabic', 'platform_id', 'اسم الحساب', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1295, 'english', 'platform', 'Platform', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1296, 'arabic', 'platform', 'البرنامج', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1297, 'english', 'default_platform', 'Default communication platform', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1298, 'arabic', 'default_platform', 'طريقة التواصل الافتراضية', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1299, 'english', 'select_session', 'Select one available slot for each session', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1300, 'arabic', 'select_session', 'يرجى  اختيار الفترة المناسبة للتواصل', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1301, 'english', 'session_info', 'Sessions info', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1302, 'arabic', 'session_info', 'معلومات الجلسة', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1303, 'english', 'sessions_count', 'Sessions', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1304, 'arabic', 'sessions_count', 'جلسات', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1305, 'english', 'sessions', 'Sessions', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1306, 'arabic', 'sessions', 'الجلسات', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1307, 'english', 'session', 'Session', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1308, 'arabic', 'session', 'الجلسة', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1309, 'english', 'other', 'Other', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1310, 'arabic', 'other', 'اخر', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1311, 'english', 'ur_msg', 'Your message', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1312, 'arabic', 'ur_msg', 'محتوى الرسالة', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1313, 'english', 'written_by', 'Written by', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1314, 'arabic', 'written_by', 'الكاتب ', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1315, 'english', 'wanted_service', 'Service type', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1316, 'arabic', 'wanted_service', 'نوع الخدمة المطلوبة', '2024-04-29 11:57:38', '2024-04-29 11:57:38'),
(1319, 'english', 'booking_offer_note', 'We will get in contact with you asap', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1320, 'arabic', 'booking_offer_note', 'سيتم التواصل معك باقرب وقت ممكن', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1321, 'english', 'thanks_for_sending', 'Thanks for choosing our services', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1322, 'arabic', 'thanks_for_sending', 'شكرا لاختيار خدماتنا . سيتم التواصل معك فى اقرب وقت ممكن', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1323, 'english', 'view_all_stories', 'View all success stories', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1324, 'arabic', 'view_all_stories', 'عرض جميع القصص الناجحة', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1325, 'english', 'make_appointment', 'Make an appointment', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1326, 'arabic', 'make_appointment', 'تحديد موعد', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1327, 'english', 'new_topics', 'New topics', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1328, 'arabic', 'new_topics', 'مواضيع جديدة', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1329, 'english', 'looking_for_something', 'Looking for something', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1330, 'arabic', 'looking_for_something', 'هل تبحث عن شىء ما', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1331, 'english', 'empty_result', 'No data here', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1332, 'arabic', 'empty_result', 'لا يوجد بيانات ', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1333, 'english', 'search_result', 'Search result', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1334, 'arabic', 'search_result', 'نتيجة البحث', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1335, 'english', 'search_results', 'Search results', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1336, 'arabic', 'search_results', 'نتائج البحث', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1337, 'english', 'empty_txt_before', 'We couldn’t find any results for your search word', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1338, 'arabic', 'empty_txt_before', 'لا يمكن ايجاد ما تبحق عنه', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1339, 'english', 'empty_txt_after', 'Please try type another word or check word spelling', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1340, 'arabic', 'empty_txt_after', 'يرجى المحاولة مع كلمة اخري او قم بمراجعة  ما تم كتابته', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1341, 'english', 'search_placeholder', 'Type a key word, fertility, period problems, etc.', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1342, 'arabic', 'search_placeholder', 'البحث عن ..', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1343, 'english', 'nationality', 'Nationality', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1344, 'arabic', 'nationality', 'الجنسية', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1345, 'english', 'longitude', 'Longitude', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1346, 'arabic', 'longitude', 'Longitude', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1347, 'english', 'latitude', 'Latitude', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1348, 'arabic', 'latitude', 'Latitude', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1349, 'english', 'offers', 'Offers', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1350, 'arabic', 'offers', 'العروض', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1351, 'english', 'talk_to_experts_intro', 'Have a question? talk to our experts now and we will answer all your questions', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1352, 'arabic', 'talk_to_experts_intro', 'لديك سؤال ؟  يمكنك التحدث   مباشرة الى احد المتخصصين', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1353, 'english', 'chat_with_us', 'Chat with us', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1354, 'arabic', 'chat_with_us', 'التواصل معنا', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1355, 'english', 'library', 'Library', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1356, 'arabic', 'library', 'المكتبة', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1357, 'english', 'width', 'Width', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1358, 'arabic', 'width', 'العرض', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1359, 'english', 'height', 'Height', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1360, 'arabic', 'height', 'الارتفاع', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1363, 'english', 'book_later', 'Book later', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1364, 'arabic', 'book_later', 'الحجز لاحقا', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1365, 'english', 'skip_step', 'Skip this step', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1366, 'arabic', 'skip_step', 'الخطوة التالية', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1367, 'english', 'step', 'Step', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1368, 'arabic', 'step', 'الخطوة', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1369, 'english', 'view_map', 'View location in maps', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1370, 'arabic', 'view_map', 'عرض الموقع على الخريطة', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1371, 'english', 'select_near_branch', 'Please select your nearest branch', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1372, 'arabic', 'select_near_branch', 'يرجى تحديد الفرع الاقرب اليك', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1373, 'english', 'select_slot', 'Select one of the available slots', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1374, 'arabic', 'select_slot', 'يرجى تحديد الموعد المناسب', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1375, 'english', 'select_payment', 'Select a payment method', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1376, 'arabic', 'select_payment', 'يرجى اختيار طريقة الدفع', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1377, 'english', 'afternoon', 'Afternoon', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1378, 'arabic', 'afternoon', 'ظهرا', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1379, 'english', 'evening', 'Evening', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1380, 'arabic', 'evening', 'مساءا', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1381, 'english', 'times_auto_set', 'All times are set automatically upon current location', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1382, 'arabic', 'times_auto_set', 'جميع المواعيد تم تحديدها بناءا على حسب   الموقع الجغرافي', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1383, 'english', 'cur_zone', 'Current time zone', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1384, 'arabic', 'cur_zone', 'التوقيت', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1385, 'english', 'apply_discount_code', 'Apply a coupon to get discount', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1386, 'arabic', 'apply_discount_code', 'قم باضافة كود الخصم', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1387, 'english', 'new_articles', 'New articles', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1388, 'arabic', 'new_articles', 'مواضيع جديدة', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1389, 'english', 'history', 'Log history', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1390, 'arabic', 'history', 'السجل السابق', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1391, 'english', 'upcoming_appointments', 'Upcoming appointments', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1392, 'arabic', 'upcoming_appointments', 'المواعيد القادمة', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1393, 'english', 'our_doctors', 'Our doctors', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1394, 'arabic', 'our_doctors', 'فريق العمل', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1395, 'english', 'media', 'Media', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1396, 'arabic', 'media', 'Media', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1397, 'english', 'upcoming_events', 'Upcoming events', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1398, 'arabic', 'upcoming_events', 'الاحداث القادمة', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1399, 'english', 'more_new', 'More of our news…', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1400, 'arabic', 'more_new', 'المزيد من الاخبار', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1401, 'english', 'page_url', 'Page url', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1402, 'arabic', 'page_url', 'Page URL', '2024-04-29 11:57:39', '2024-04-29 11:57:39'),
(1403, 'english', 'similar_items', 'Similar to what you read', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1404, 'arabic', 'similar_items', 'موضوعات قد تهمك', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1405, 'english', 'calculate', 'Calculate', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1406, 'arabic', 'calculate', 'حساب', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1407, 'english', 'days', 'Days', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1408, 'arabic', 'days', 'ايام', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1409, 'english', 'customize_package', 'Customize package now', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1410, 'arabic', 'customize_package', 'تخصيص العرض المناسب', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1411, 'english', 'go_home', 'Go to homepage', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1412, 'arabic', 'go_home', 'الذهاب للصفحة الرئيسية', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1413, 'english', 'back_home', 'Back home', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1414, 'arabic', 'back_home', 'العودة للرئيسية', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1415, 'english', 'all_times_set', 'All times are set automatically upon current location', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1416, 'arabic', 'all_times_set', 'جميع الاوقات تم تحديدها  حسب الموقع', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1417, 'english', 'current_zone', 'Current time zone', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1418, 'arabic', 'current_zone', 'المنطقة الحالية', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1419, 'english', 'order_unpaid', 'This booking not paid yet', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1420, 'arabic', 'order_unpaid', 'هذا الحجز لم يتم دفعه بعد', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1421, 'english', 'pay_now', 'Pay now', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1422, 'arabic', 'pay_now', 'الدفع الان', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1423, 'english', 'please_wait', 'Please wait', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1424, 'arabic', 'please_wait', 'يرجى الانتظار', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1425, 'english', 'phone_call', 'I prefer an audio call', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1426, 'arabic', 'phone_call', 'افضل الاتصال الهاتفى', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1427, 'english', 'payment_made_seccuess', 'Payment made successfully', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1428, 'arabic', 'payment_made_seccuess', 'عملية الدفع تمت بنجاح', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1429, 'english', 'to_get_prices', 'To get prices', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1430, 'arabic', 'to_get_prices', ' لعرض الاسعار', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1431, 'english', 'other_reasons', 'Other reason', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1432, 'arabic', 'other_reasons', 'اسباب اخري', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1433, 'english', 'continue', 'Continue', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1434, 'arabic', 'continue', 'استمرار', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1435, 'english', 'continue_payment', 'Continue to payment', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1436, 'arabic', 'continue_payment', 'المتابعة للدفع', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1437, 'english', 'fild_id', 'File number', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1438, 'arabic', 'fild_id', 'رقم الملف', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1441, 'english', 'subscribed_offer_note', 'You have booked one of our offers: ', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1442, 'arabic', 'subscribed_offer_note', 'تم الاشتراك فى  العرض', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1443, 'english', 'table_contents', 'Table of contents', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1444, 'arabic', 'table_contents', 'جدول المحتوى', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1449, 'english', 'min_ses', 'Min/session', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1450, 'arabic', 'min_ses', 'دقيقة /جلسة', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1451, 'english', 'results', 'Results', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1452, 'arabic', 'results', 'النتائج', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1453, 'english', 'booking_days', 'Booking days', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1454, 'arabic', 'booking_days', 'ايام الحجز', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1455, 'english', 'soon', 'Soon', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1456, 'arabic', 'soon', 'قريبا', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1457, 'english', 'contact_info', 'Please add your information to communicate with you', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1458, 'arabic', 'contact_info', 'رجاء اضافة بياناتك لكي يتم التواصل  معك', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1459, 'english', 'booking_with', 'Booking with ', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1460, 'arabic', 'booking_with', 'احجز مع ', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1461, 'english', 'not_valid', 'Not valid', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1462, 'arabic', 'not_valid', 'البيانات غير صحيحة', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1463, 'english', 'mobile_err', 'Mobile number not valid', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1464, 'arabic', 'mobile_err', 'رقم الموبايل غير صحيح', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1465, 'english', 'field', 'Field', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1466, 'arabic', 'field', 'الحقل ', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1467, 'english', 'empty', 'Empty', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1468, 'arabic', 'empty', 'فارغ', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1469, 'english', 'order_paid', 'This booking has been paid successfully', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1470, 'arabic', 'order_paid', 'تم سداد قيمة هذا الحجز بنجاح', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1471, 'english', 'order_failed', 'This booking payment is failed ', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1472, 'arabic', 'order_failed', 'لم يتم سداد قيمة هذا الحجز  ', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1473, 'english', 'thanks', 'Thanks ', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1474, 'arabic', 'thanks', 'شكرا لك ', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1475, 'english', 'choose_date_label', 'Please choose the booking date from this calendar ', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1476, 'arabic', 'choose_date_label', 'يرجى تحديد التاريخ المناسب للحجز', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1477, 'english', 'select_time_and_date', 'Please select day and time for the booking.', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1478, 'arabic', 'select_time_and_date', 'يجب اختيار التاريخ والوقت  لاكتمال الحجز', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1479, 'english', 'select_date', 'Please select day of the booking.', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1480, 'arabic', 'select_date', 'يجب اختيار التاريخ لاكتمال الحجز', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1481, 'english', 'service', 'Service', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1482, 'arabic', 'service', 'الخدمة', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1483, 'english', 'payments', 'Payments', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1484, 'arabic', 'payments', 'المدفوعات', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1485, 'english', 'payment_id', 'Payment id', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1486, 'arabic', 'payment_id', 'رقم العملية', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1487, 'english', 'calendar', 'Calendar', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1488, 'arabic', 'calendar', 'تقويم الحجوزات', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1489, 'english', 'all_bookings', 'All bookings', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1490, 'arabic', 'all_bookings', 'جميع الحجوزات', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1491, 'english', 'active_bookings', 'Active bookings', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1492, 'arabic', 'active_bookings', 'حجوزات نشطة', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1493, 'english', 'completed_bookings', 'Completed bookings', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1494, 'arabic', 'completed_bookings', 'حجوزات مكتملة', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1495, 'english', 'paid_bookings', 'Paid bookings', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1496, 'arabic', 'paid_bookings', 'حجوزات مدفوعة', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1497, 'english', 'management', 'Management', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1498, 'arabic', 'management', 'الإدارة', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1499, 'english', 'paid_orders', 'Paid orders', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1500, 'arabic', 'paid_orders', 'فواتير مدفوعة', '2024-04-29 11:57:40', '2024-04-29 11:57:40'),
(1501, 'english', 'refund_orders', 'Refund orders', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1502, 'arabic', 'refund_orders', 'فواتير مرتجعة', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1503, 'english', 'managers', 'Managers', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1504, 'arabic', 'managers', 'المديرين', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1505, 'english', 'products_list', 'Products list', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1506, 'arabic', 'products_list', 'قائمة المنتجات', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1507, 'english', 'today_revenue', 'Today revenue', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1508, 'arabic', 'today_revenue', 'أرباح اليوم', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1509, 'english', 'revenue', 'Revenue', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1510, 'arabic', 'revenue', 'صافي  الأرباح', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1511, 'english', 'today_expenses', 'Today expenses', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1512, 'arabic', 'today_expenses', 'مصروفات اليوم', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1513, 'english', 'today_bookings', 'Today bookings', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1514, 'arabic', 'today_bookings', 'حجوزات اليوم', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1515, 'english', 'bookings_income', 'Bookings income', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1516, 'arabic', 'bookings_income', 'أرباح الحجوزات', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1517, 'english', 'latest_unpaid_bookings', 'Latest unpaid bookings', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1518, 'arabic', 'latest_unpaid_bookings', 'احدث الحجوزات الغير مدفوعة', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1519, 'english', 'latest_paid_bookings', 'Latest paid bookings', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1520, 'arabic', 'latest_paid_bookings', 'احدث الحجوزات مدفوعة', '2024-04-29 11:57:41', '2024-04-29 11:57:41');
INSERT INTO `translations` (`translation_id`, `language_code`, `code`, `value`, `created_at`, `updated_at`) VALUES
(1521, 'english', 'duration', 'Duration', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1522, 'arabic', 'duration', 'المدة', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1523, 'english', 'by', 'By', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1524, 'arabic', 'by', 'بواسطة', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1525, 'english', 'invoice_number', 'Invoice number', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1526, 'arabic', 'invoice_number', 'رقم الفاتورة', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1527, 'english', 'invoice_from', 'Invoice from', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1528, 'arabic', 'invoice_from', 'فاتورة من', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1529, 'english', 'payment_details', 'Payment details', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1530, 'arabic', 'payment_details', 'تفاصيل الدفع', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1531, 'english', 'billed_to', 'Billed to', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1532, 'arabic', 'billed_to', 'الفاتورة الى', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1533, 'english', 'issue_date', 'Issue date', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1534, 'arabic', 'issue_date', 'تاريخ الإنشاء', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1535, 'english', 'subtotal', 'Subtotal', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1536, 'arabic', 'subtotal', 'التكلفة', '2024-04-29 11:57:41', '2024-05-17 05:17:08'),
(1537, 'english', 'rate', 'Rate', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1538, 'arabic', 'rate', 'القيمة', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1539, 'english', 'terms_and_conditions', 'Terms and conditions', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1540, 'arabic', 'terms_and_conditions', 'شروط الاستخدام', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1541, 'english', 'total_amount', 'Total amount', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1542, 'arabic', 'total_amount', 'القيمة الإجمالية', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1543, 'english', 'tax', 'Tax', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1544, 'arabic', 'tax', 'الضريبة', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1545, 'english', 'start_time', 'Start time', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1546, 'arabic', 'start_time', 'تاريخ البدء', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1547, 'english', 'start', 'Start', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1548, 'arabic', 'start', 'وقت البداية', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1549, 'english', 'end', 'End', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1550, 'arabic', 'end', 'وقت الإنتهاء', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1551, 'english', 'orders_list', 'Orders list', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1552, 'arabic', 'orders_list', 'قائمة الفواتير', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1553, 'english', 'actions', 'Actions', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1554, 'arabic', 'actions', 'تفاصيل', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1555, 'english', 'add_product', 'Add product', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1556, 'arabic', 'add_product', 'إضافة منتج', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1557, 'english', 'purchase_amount', 'Purchase amount', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1558, 'arabic', 'purchase_amount', 'تكلفة العملية', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1559, 'english', 'paid_amount', 'Paid amount', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1560, 'arabic', 'paid_amount', 'القيمة المدفوعة', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1561, 'english', 'payments_list', 'Payments list', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1562, 'arabic', 'payments_list', 'قائمة المدفوعات', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1563, 'english', 'edit_device', 'Edit device', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1564, 'arabic', 'edit_device', 'تعديل بيانات الجهاز', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1565, 'english', 'description', 'Description', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1566, 'arabic', 'description', 'الوصف', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1567, 'english', 'basic_details', 'Basic details', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1568, 'arabic', 'basic_details', 'البيانات الأساسية', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1569, 'english', 'address_details', 'Address details', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1570, 'arabic', 'address_details', 'بيانات العنوان', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1571, 'english', 'address', 'Address', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1572, 'arabic', 'address', 'العنوان', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1573, 'english', 'country', 'Country', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1574, 'arabic', 'country', 'الدولة', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1575, 'english', 'invoice_info', 'Invoice info', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1576, 'arabic', 'invoice_info', 'بيانات الفاتورة', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1577, 'english', 'invoice_notes', 'Invoice notes', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1578, 'arabic', 'invoice_notes', 'ملاحظات على الفواتير', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1579, 'english', 'invoice_terms___conditions', 'Invoice terms & conditions', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1580, 'arabic', 'invoice_terms___conditions', 'شروط الاستخدام على الفواتير', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1581, 'english', 'currency', 'Currency', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1582, 'arabic', 'currency', 'العملة', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1583, 'english', 'language', 'Language', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1584, 'arabic', 'language', 'اللغة', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1585, 'english', 'updated', 'Updated successfully', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1586, 'arabic', 'updated', 'تم التعديل بنجاح', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1587, 'english', 'added', 'Completed Successfully', '2024-04-29 11:57:41', '2024-05-02 10:43:09'),
(1588, 'arabic', 'added', 'تم الإضافة بنجاح', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1589, 'english', 'password_required', 'Password required', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1590, 'arabic', 'password_required', 'كلمة المور مطلوبة', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1591, 'english', 'email_required', 'Email required', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1592, 'arabic', 'email_required', 'البريد الإلكتروني مطلوب', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1593, 'english', 'name_required', 'Name required', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1594, 'arabic', 'name_required', 'الإسم مطلوب', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1595, 'english', 'end_time', 'End time', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1596, 'arabic', 'end_time', 'تاريخ الانتهاء', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1597, 'english', 'remove', 'Remove', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1598, 'arabic', 'remove', 'حذف', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1599, 'english', 'promo_code', 'Promo code', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1600, 'arabic', 'promo_code', 'كود الخصم', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1601, 'english', 'apply', 'Apply', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1602, 'arabic', 'apply', 'تطبيق', '2024-04-29 11:57:41', '2024-04-29 11:57:41'),
(1603, 'english', 'finish', 'Finish', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1604, 'arabic', 'finish', 'إنهاء', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1605, 'english', 'start_playing', 'Start playing', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1606, 'arabic', 'start_playing', 'بدء التشغيل', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1607, 'english', 'order_summary', 'Order summary', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1608, 'arabic', 'order_summary', 'ملخص الطلب', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1609, 'english', 'order_price', 'Order price', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1610, 'arabic', 'order_price', 'التكلفة والمدفوعات', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1611, 'english', 'user_credentials_not_valid', 'User credentials not valid', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1612, 'arabic', 'user_credentials_not_valid', 'بيانات الدخول غير صحيحة', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1613, 'english', 'user_account_is_not_active', 'User account is not active', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1614, 'arabic', 'user_account_is_not_active', 'هذا الحساب غير نشط', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1615, 'english', 'email_already_found', 'Email already found', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1616, 'arabic', 'email_already_found', 'هذا البريد موجود بالفعل', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1617, 'english', 'logged_in', 'Logged in', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1618, 'arabic', 'logged_in', 'تم تسجيل الدخول', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1619, 'english', 'purchased_products', 'Purchased products', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1620, 'arabic', 'purchased_products', 'المنتجات التي تم شرائها', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1621, 'english', 'last_30_days', 'Last 30 days', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1622, 'arabic', 'last_30_days', 'اخر 30 يوم', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1623, 'english', 'last_week_orders', 'Last week orders', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1624, 'arabic', 'last_week_orders', 'فواتير اخر إسبوع', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1625, 'english', 'today_orders', 'Today orders', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1626, 'arabic', 'today_orders', 'فواتير اليوم', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1627, 'english', 'products_stock', 'Products stock', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1628, 'arabic', 'products_stock', 'سجل مخزون المنتجات', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1629, 'english', 'add_device', 'Add device', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1630, 'arabic', 'add_device', 'إضافة جهاز', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1631, 'english', 'first_step', 'First step', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1632, 'arabic', 'first_step', 'الخطوة الأولي', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1633, 'english', 'second_step', 'Second step', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1634, 'arabic', 'second_step', 'الخطوة الثانية', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1635, 'english', 'third_step', 'Third step', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1636, 'arabic', 'third_step', 'الخطوة  الثالثة', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1637, 'english', 'alert', 'Alert', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1638, 'arabic', 'alert', 'تنبيه', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1639, 'english', 'order_status_is', 'Order status is', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1640, 'arabic', 'order_status_is', 'حالة هذا الطلب', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1641, 'english', 'are_your_sure_you_want_to_finish_this_booking', 'Are your sure you want to finish this booking', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1642, 'arabic', 'are_your_sure_you_want_to_finish_this_booking', 'هل أنت متاكد من إكتمال الحجز', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1643, 'english', 'order_created', 'Order created', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1644, 'arabic', 'order_created', 'تم تأكيد الطلب', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1645, 'english', 'show_orders', 'Show orders', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1646, 'arabic', 'show_orders', 'عرض الفواتير', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1647, 'english', 'show_invoice', 'Show invoice', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1648, 'arabic', 'show_invoice', 'عرض الفاتورة', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1649, 'english', 'paid', 'Paid', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1650, 'arabic', 'paid', 'مدفوع', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1651, 'english', 'completed', 'Completed', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1652, 'arabic', 'completed', 'مكتمل', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1653, 'english', 'active', 'Active', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1654, 'arabic', 'active', 'نشط', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1655, 'english', 'unpaid', 'Unpaid', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1656, 'arabic', 'unpaid', 'غير مدفوع', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1657, 'english', 'created', 'Created', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1658, 'arabic', 'created', 'تم الإنشاء بنجاح', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1659, 'english', 'created_at', 'Created at', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1660, 'arabic', 'created_at', 'تاريخ الإنشاء', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1661, 'english', 'last_update', 'Last update', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1662, 'arabic', 'last_update', 'اخر تحديث', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1663, 'english', 'stock_alert_products', 'Stock alert products', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1664, 'arabic', 'stock_alert_products', 'منتجات  أوشكت على النفاذ', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1665, 'english', 'stock_out_products', 'Stock out products', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1666, 'arabic', 'stock_out_products', 'منتجات   نفذت من المخزون', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1667, 'english', 'invoice_id', 'Invoice id', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1668, 'arabic', 'invoice_id', 'رقم  فاتورة الشراء', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1669, 'english', 'new_payment', 'New payment', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1670, 'arabic', 'new_payment', 'مدفوعات جديدة', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1673, 'english', 'edit_category', 'Edit category', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1674, 'arabic', 'edit_category', 'تعديل القسم', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1675, 'english', 'edit_game', 'Edit game', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1676, 'arabic', 'edit_game', 'تعديل  اللعبة', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1677, 'english', 'edit_product', 'Edit product', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1678, 'arabic', 'edit_product', 'تعديل   المنتج', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1679, 'english', 'remove_this_category', 'Remove this category', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1680, 'arabic', 'remove_this_category', 'حذف هذا القسم', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1683, 'english', 'model_required', 'Model required', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1684, 'arabic', 'model_required', 'الموديل مطلوب', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1687, 'english', 'categories', 'Categories', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1688, 'arabic', 'categories', 'الأقسام', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1691, 'english', 'related_items', 'Related items', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1692, 'arabic', 'related_items', 'الأجهزة  المرتبطة', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1693, 'english', 'check_database_connection', 'Check database connection', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1694, 'arabic', 'check_database_connection', 'تأكد من بيانات قاعدة البيانات', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1695, 'english', 'latest_articles', 'Latest articles', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1696, 'arabic', 'latest_articles', 'أحدث المقالات', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1697, 'english', 'profile_cv', 'Profile cv', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1698, 'arabic', 'profile_cv', 'الصفحة الشخصية', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1699, 'english', 'summary', 'Summary', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1700, 'arabic', 'summary', 'نبذة  مختصرة ', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1701, 'english', 'i_have_notes', 'I have notes', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1702, 'arabic', 'i_have_notes', 'لدي ملاحظات', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1703, 'english', 'sub_categories', 'Sub categories', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1704, 'arabic', 'sub_categories', 'الأقسام الفرعية', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1705, 'english', 'book_with', 'Book with', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1706, 'arabic', 'book_with', 'احجز مع ', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1707, 'english', 'book_now', 'Book now', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1708, 'arabic', 'book_now', 'حجز موعد ', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1709, 'english', 'more_details', 'More details', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1710, 'arabic', 'more_details', 'تفاضيل اكثر ', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1711, 'english', 'offer_content', 'Offer content', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1712, 'arabic', 'offer_content', 'محتويات الباكدج ', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1713, 'english', 'released_at', 'Released at', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1714, 'arabic', 'released_at', 'تم النشر في ', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1715, 'english', 'search_result_for', 'Search result for', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1716, 'arabic', 'search_result_for', 'نتيجة البحث عن : ', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1717, 'english', 'in', 'In', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1718, 'arabic', 'in', 'في', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1719, 'english', 'home', 'Home', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1720, 'arabic', 'home', 'الرئيسية', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1721, 'english', 'important_links', 'Important links', '2024-04-29 11:57:42', '2024-04-29 11:57:42'),
(1722, 'arabic', 'important_links', 'روابط هامة', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1723, 'english', 'story_dates', 'Story dates', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1724, 'arabic', 'story_dates', 'تواريخ هامة', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1725, 'english', 'year', 'Year', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1726, 'arabic', 'year', 'العام', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1733, 'english', 'today_income', 'Today income', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1734, 'arabic', 'today_income', 'دخل اليوم', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1735, 'english', 'income', 'Income', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1736, 'arabic', 'income', 'صافي الدخل', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1737, 'english', 'upcoming_bookings', 'Upcoming bookings', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1738, 'arabic', 'upcoming_bookings', 'الحجوزات القادمة', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1739, 'english', 'canceled_bookings', 'Canceled bookings', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1740, 'arabic', 'canceled_bookings', 'الحجوزات الملغاة', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1741, 'english', 'expenses', 'Expenses', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1742, 'arabic', 'expenses', 'المصروفات', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1743, 'english', 'check_email_for_activation', 'Check email for activation', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1744, 'arabic', 'check_email_for_activation', ' يرجي تفعيل حسابك عبر البريد الإلكتروني ', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1745, 'english', 'message_could_not_be_sent._mailer_error', 'Message could not be sent. mailer error', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1746, 'arabic', 'message_could_not_be_sent._mailer_error', 'لم يتم إرسال الرسالة - السبب : ', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1747, 'english', 'activate_your_account', 'Activate your account', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1748, 'arabic', 'activate_your_account', 'بيانات تفعيل حسابك ', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1749, 'english', 'thanks_for_activating_account', 'Thanks for activating account', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1750, 'arabic', 'thanks_for_activating_account', ', يمكنك الان الاستمتاع بالخدمة', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1751, 'english', 'activated_your_account_successfully', 'Activated your account successfully', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1752, 'arabic', 'activated_your_account_successfully', 'تم تفعيل حسابك بنجاح ', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1753, 'english', 'login_to_app', 'Login to app', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1754, 'arabic', 'login_to_app', 'الدخول إلى التطبيق', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1755, 'english', 'invoices_tax', 'Invoices tax', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1756, 'arabic', 'invoices_tax', 'الضريبة على الفواتير', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1757, 'english', 'review_and_confirm', 'Review and confirm', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1758, 'arabic', 'review_and_confirm', 'المراجعة و التأكيد', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1759, 'english', 'complete_this_settings_to_start', 'Complete this settings to start', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1760, 'arabic', 'complete_this_settings_to_start', 'أكمل البيانات التالية للبدء ', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1761, 'english', 'get_started_setting', 'Get started setting', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1762, 'arabic', 'get_started_setting', 'إعداد البرنامج', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1763, 'english', 'information_about_the_branch', 'Information about the branch', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1764, 'arabic', 'information_about_the_branch', 'معلومات عن الفرع ', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1765, 'english', 'review_your_information_and_confirm', 'Review your information and confirm', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1766, 'arabic', 'review_your_information_and_confirm', 'راجع بيانات وقم بالتأكيد ', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1767, 'english', 'important_required_settings', 'Important required settings', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1768, 'arabic', 'important_required_settings', 'معلومات مطلوبة لإعداد البرنامج', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1769, 'english', 'smtp_sender', 'Smtp sender', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1770, 'arabic', 'smtp_sender', 'بريد إرسال الإشعارات', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1771, 'english', 'smtp_host', 'Smtp host', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1772, 'arabic', 'smtp_host', 'سيرفر ارسال SMTP', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1773, 'english', 'smtp_user', 'Smtp user', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1774, 'arabic', 'smtp_user', 'حساب  ارسال SMTP', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1775, 'english', 'smtp_password', 'Smtp password', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1776, 'arabic', 'smtp_password', 'كلمة مرور   SMTP', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1777, 'english', 'smtp_auth', 'Smtp auth', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1778, 'arabic', 'smtp_auth', 'توثيق الارسال عبر SMTP', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1779, 'english', 'smtp_port', 'Smtp port', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1780, 'arabic', 'smtp_port', 'منفذ ارسال خلال  SMTP', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1781, 'english', 'google_auth', 'Google auth', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1782, 'arabic', 'google_auth', 'بيانات  الدخول عبر Google', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1783, 'english', 'paypal_api', 'Paypal api', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1784, 'arabic', 'paypal_api', 'بيانات حساب PAYPAL', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1785, 'english', 'payment_methods', 'Payment methods', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1786, 'arabic', 'payment_methods', 'طرق الدفع', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1787, 'english', 'smtp_info', 'Smtp info', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1788, 'arabic', 'smtp_info', 'بيانات حساب SMTP', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1789, 'english', 'includes_free_updates_and_technical_support', 'Includes free updates and technical support', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1790, 'arabic', 'includes_free_updates_and_technical_support', 'تحديثات مجانية ودعم فني ', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1791, 'english', 'will_be_redirected_to_payment_page', 'Will be redirected to payment page', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1792, 'arabic', 'will_be_redirected_to_payment_page', 'سيتم تحويلك إلى صفحة الدفع', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1793, 'english', 'payment_made_successfully,_enjoy_with_the_service', 'Payment made successfully, enjoy with the service', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1794, 'arabic', 'payment_made_successfully,_enjoy_with_the_service', 'تمت عملية الدفع بنجاح , يمكنك الان الاستمتاع بالخدمة', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1795, 'english', 'payment_failed,_please_try_again', 'Payment failed, please try again', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1796, 'arabic', 'payment_failed,_please_try_again', 'عملية الدفع لم تتم بنجاح , يرجي المحاولة ثانية', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1797, 'english', 'monthly_payment', 'Monthly payment', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1798, 'arabic', 'monthly_payment', 'دفع قيمة الاشتراك  شهريا', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1799, 'english', 'monthly', 'Monthly', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1800, 'arabic', 'monthly', 'شهريا', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1801, 'english', 'annually', 'Annually', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1802, 'arabic', 'annually', 'سنويا', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1803, 'english', 'yearly', 'Yearly', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1804, 'arabic', 'yearly', 'سنويا', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1805, 'english', 'yearly_payment', 'Yearly payment', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1806, 'arabic', 'yearly_payment', 'دفع قيمة الاشتراك  سنويا', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1807, 'english', 'include_local_taxes', 'Include local taxes', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1808, 'arabic', 'include_local_taxes', 'شامل سعر الضريبة', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1809, 'english', 'plan_features', 'Plan features', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1810, 'arabic', 'plan_features', 'خصائص الخطط', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1811, 'english', 'subscribe_for_month', 'Subscribe for month', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1812, 'arabic', 'subscribe_for_month', 'الاشتراك لمدة شهر', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1813, 'english', 'subscribe_for_quarter', 'Subscribe for quarter', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1814, 'arabic', 'subscribe_for_quarter', 'الاشتراك لمدة ربع عام', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1815, 'english', 'subscribe_for_year', 'Subscribe for year', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1816, 'arabic', 'subscribe_for_year', 'الاشتراك لمدة عام', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1817, 'english', 'cost_per_month', 'Cost per month', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1818, 'arabic', 'cost_per_month', 'التكلفة الشهرية', '2024-04-29 11:57:43', '2024-04-29 11:57:43'),
(1819, 'english', 'cost_per_quarter', 'Cost per quarter', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1820, 'arabic', 'cost_per_quarter', 'التكلفة لربع عام', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1821, 'english', 'cost_per_year', 'Cost per year', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1822, 'arabic', 'cost_per_year', 'التكلفة السنوية', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1823, 'english', 'is_paid', 'Is paid', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1824, 'arabic', 'is_paid', 'مدفوعة', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1825, 'english', 'branch_name_required', 'Branch name required', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1826, 'arabic', 'branch_name_required', 'اسم الفرع مطلوب', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1827, 'english', 'open_editor', 'Open editor', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1828, 'arabic', 'open_editor', 'فتح المحرر', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1829, 'english', 'plan_subscriptions', 'Plan subscriptions', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1830, 'arabic', 'plan_subscriptions', 'الإشتراكات', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1831, 'english', 'thanks_for_payment', 'Thanks for payment', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1832, 'arabic', 'thanks_for_payment', 'شكرا لإتمام عملية الدفع', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1833, 'english', 'expenses_list', 'Expenses list', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1834, 'arabic', 'expenses_list', 'قائمة المصروفات', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1835, 'english', 'account', 'Account', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1836, 'arabic', 'account', 'الحساب', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1837, 'english', 'site_content', 'Site content', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1838, 'arabic', 'site_content', 'محتوي الموقع', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1839, 'english', 'dashboard_menu', 'Dashboard menu', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1840, 'arabic', 'dashboard_menu', 'قائمة لوحة الإدارة', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1847, 'english', 'new_cusomter', 'New cusomter', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1848, 'arabic', 'new_cusomter', 'عميل جديد', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1849, 'english', 'create_booking', 'Create booking', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1850, 'arabic', 'create_booking', 'حجز فقط', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1851, 'english', 'cancel_booking', 'Cancel booking', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1852, 'arabic', 'cancel_booking', 'إلغاء الحجز', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1853, 'english', 'pay', 'Pay', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1854, 'arabic', 'pay', 'دفع الحجز', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1855, 'english', 'booking_type', 'Booking type', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1856, 'arabic', 'booking_type', 'نوع الحجز', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1857, 'english', 'subject', 'Subject', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1858, 'arabic', 'subject', 'العنوان', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1859, 'english', 'receiver_name', 'Receiver name', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1860, 'arabic', 'receiver_name', 'المستلم', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1861, 'english', 'model', 'Model', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1862, 'arabic', 'model', 'الموديل', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1863, 'english', 'bookings_count', 'Bookings count', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1864, 'arabic', 'bookings_count', 'عدد الحجوزات', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1865, 'english', 'last_invoice', 'Last invoice', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1866, 'arabic', 'last_invoice', 'اخر فاتورة', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1867, 'english', 'some_important_stats_about_the_performance', 'Some important stats about the performance', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1868, 'arabic', 'some_important_stats_about_the_performance', 'بعض الإحصائيات الهامة حول اداء العمل', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1869, 'english', 'some_important_stats', 'Some important stats', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1870, 'arabic', 'some_important_stats', 'إحصائيات  هامة', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1871, 'english', 'sales_average', 'Sales average', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1872, 'arabic', 'sales_average', ' متوسط  المبيعات', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1873, 'english', 'bookings_average', 'Bookings average', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1874, 'arabic', 'bookings_average', 'متوسط  ارباح الحجوزات', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1875, 'english', 'avg_daily_bookings_count', 'Avg daily bookings count', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1876, 'arabic', 'avg_daily_bookings_count', 'معدل عدد  الحجوزات اليومية', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1877, 'english', 'avg_daily_products_sales', 'Avg daily products sales', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1878, 'arabic', 'avg_daily_products_sales', 'متوسط عدد  بيع  المنتجات اليومية', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1879, 'english', 'notifications_events', 'Notifications events', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1880, 'arabic', 'notifications_events', 'أحداث الإشعارات', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1881, 'english', 'dashboard_reports', 'Dashboard reports', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1882, 'arabic', 'dashboard_reports', 'تقارير لوحة الإدارة', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1883, 'english', 'yesterday', 'Yesterday', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1884, 'arabic', 'yesterday', 'أمس', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1885, 'english', 'last_week', 'Last week', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1886, 'arabic', 'last_week', 'اخر اسبوع', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1887, 'english', 'last_month', 'Last month', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1888, 'arabic', 'last_month', 'اخر  شهر', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1889, 'english', 'last_year', 'Last year', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1890, 'arabic', 'last_year', 'اخر  سنة', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1891, 'english', 'editor_help', 'At the top left of each section click on edit button and after editing click on save', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1892, 'arabic', 'editor_help', 'من أعلي كل قسم  على اليسار  إضط على كلمة Edit  وبعد الإنتهاء من التعديل إضغط علي كلمة SAVE', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1893, 'english', 'editor_notes', 'To edit links or images ( <a> / <img> ) tags use right-click at your mouse', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1894, 'arabic', 'editor_notes', 'لتعديل الروابط و الصور يجب الضغط علي  Right-click على الماوس', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1895, 'english', 'enable_notifications', 'Enable notifications', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1896, 'arabic', 'enable_notifications', 'تفعيل التنبيهات', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1897, 'english', 'welcome_message_subject', 'Welcome message subject', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1898, 'arabic', 'welcome_message_subject', 'عنوان رسالة الترحيب عند قبول التنبيهات', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1899, 'english', 'welcome_message_icon', 'Welcome message icon', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1900, 'arabic', 'welcome_message_icon', 'ايقونة رسالة الترحيب ', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1901, 'english', 'welcome_message', 'Welcome message', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1902, 'arabic', 'welcome_message', 'محتوى رسالة الترحيب', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1903, 'english', 'add_products', 'Add products', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1904, 'arabic', 'add_products', 'إضافة منتجات', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1905, 'english', 'cashier', 'Cashier', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1906, 'arabic', 'cashier', 'الكاشير', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1907, 'english', 'order_date', 'Order date', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1908, 'arabic', 'order_date', 'تاريخ  الفاتورة', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1909, 'english', 'open_time', 'Open time', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1910, 'arabic', 'open_time', 'وقت مفتوح', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1911, 'english', 'limited_time', 'Limited time', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1912, 'arabic', 'limited_time', 'وقت  محدود', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1913, 'english', 'one_hour', 'One hour', '2024-04-29 11:57:44', '2024-04-29 11:57:44'),
(1914, 'arabic', 'one_hour', 'ساعة واحدة', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1915, 'english', '2_hours', '2 hours', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1916, 'arabic', '2_hours', 'ساعتين', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1917, 'english', '3_hours', '3 hours', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1918, 'arabic', '3_hours', '3 ساعات', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1923, 'english', 'unpaid_bookings', 'Unpaid bookings', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1924, 'arabic', 'unpaid_bookings', 'حجوزات غير مدفوعة', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1925, 'english', 'add_new_booking', 'Add new booking', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1926, 'arabic', 'add_new_booking', 'إضافة وقت جديد', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1927, 'english', 'sideboard', 'Sideboard', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1928, 'arabic', 'sideboard', 'البوفيه', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1929, 'english', 'bookings_follow', 'Bookings follow', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1930, 'arabic', 'bookings_follow', 'متابعة احجوزات', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1931, 'english', 'single', 'Single', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1932, 'arabic', 'single', 'فردي', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1933, 'english', 'multi', 'Multi', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1934, 'arabic', 'multi', 'زوجي', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1935, 'english', 'booking_time_ended', 'Booking time ended', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1936, 'arabic', 'booking_time_ended', 'إنتهت مدة الحجز ', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1937, 'english', 'booking_time_ended_and_requires_an_action', 'Booking time ended and requires an action', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1938, 'arabic', 'booking_time_ended_and_requires_an_action', 'انتهت مدة الحجز  ولم يتم اتخاذ اي إجراء ', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1939, 'english', 'confirm_end_booking', 'Confirm end booking', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1940, 'arabic', 'confirm_end_booking', 'تأكيد إنهاء الحجو ', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1941, 'english', 'quick_links', 'Quick links', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1942, 'arabic', 'quick_links', 'روابط سريعة', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1943, 'english', 'terms_and_policy', 'Terms and policy', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1944, 'arabic', 'terms_and_policy', 'سياسة الاستخدام', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1945, 'english', 'how_it_works', 'How it works', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1946, 'arabic', 'how_it_works', 'طريقة العمل', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1947, 'english', 'go_to_app', 'Go to app', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1948, 'arabic', 'go_to_app', 'اذهب الى التطبيق', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1949, 'english', 'pickup_locations', 'Pickup locations', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1950, 'arabic', 'pickup_locations', 'أماكن التوقف', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1951, 'english', 'pickup_location', 'Pickup location', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1952, 'arabic', 'pickup_location', 'مكان الالتقاء', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1953, 'english', 'pickup', 'Pickup', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1954, 'arabic', 'pickup', 'مكان الالتقاء', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1955, 'english', 'routelocations', 'Pickup locations', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1956, 'arabic', 'routelocations', 'أماكن التوقف', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1957, 'english', 'routes', 'Routes', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1958, 'arabic', 'routes', 'خطوط السير', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1959, 'english', 'route', 'Route', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1960, 'arabic', 'route', 'خط السير', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1961, 'english', 'students', 'Students', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1962, 'arabic', 'students', 'الطلاب', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1963, 'english', 'students_list', 'Students list', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1964, 'arabic', 'students_list', 'قائمة الطلاب', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1965, 'english', 'student', 'Student', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1966, 'arabic', 'student', 'طالب', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1967, 'english', 'vehicles', 'Vehicles', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1968, 'arabic', 'vehicles', 'السيارات', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1969, 'english', 'drivers', 'Drivers', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1970, 'arabic', 'drivers', 'السائقين', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1971, 'english', 'driver', 'Driver', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1972, 'arabic', 'driver', 'السائق', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1973, 'english', 'cars', 'Cars', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1974, 'arabic', 'cars', 'السيارات', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1975, 'english', 'trips', 'Trips', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1976, 'arabic', 'trips', 'الرحلات', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1977, 'english', 'trip_date', 'Trip date', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1978, 'arabic', 'trip_date', 'تاريخ الرحلة', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1979, 'english', 'trip_status', 'Trip status', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1980, 'arabic', 'trip_status', 'حالة الرحلة', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1981, 'english', 'vehicle_name', 'Vehicle name', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1982, 'arabic', 'vehicle_name', 'اسم السيارة', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1983, 'english', 'plate_number', 'Plate number', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1984, 'arabic', 'plate_number', 'لوحة السيارة', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1985, 'english', 'help_messages', 'Help messages', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1986, 'arabic', 'help_messages', 'رسائل الدعم الفني', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1987, 'english', 'completed_tickets', 'Completed tickets', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1988, 'arabic', 'completed_tickets', 'التذاكر المكتملة', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1989, 'english', 'tickets_needs_customer_reply', 'Tickets needs customer reply', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1990, 'arabic', 'tickets_needs_customer_reply', 'تذاكر في إنتظار رد العميل', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1991, 'english', 'new_tickets_those_not_opened_yet', 'New tickets those not opened yet', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1992, 'arabic', 'new_tickets_those_not_opened_yet', 'تذاكر جديدة لم يتم مشاهدتها', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1993, 'english', 'maintenance_status', 'Maintenance status', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1994, 'arabic', 'maintenance_status', 'حالة الصيانة', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1995, 'english', 'parents', 'Parents', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1996, 'arabic', 'parents', 'أولياء الأمور', '2024-04-29 11:57:45', '2024-04-29 11:57:45'),
(1997, 'english', 'parents_list', 'Parents list', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(1998, 'arabic', 'parents_list', 'قائمة أولياء الأمور', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(1999, 'english', 'parent', 'Parent', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2000, 'arabic', 'parent', 'ولي الأمر', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2001, 'english', 'parent_guardian_name', 'Parent guardian name', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2002, 'arabic', 'parent_guardian_name', 'إسم ولي الأمر', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2003, 'english', 'parent_required', 'Parent required', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2004, 'arabic', 'parent_required', 'ولي الأمر مطلوب', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2005, 'english', 'contact_number', 'Contact number', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2006, 'arabic', 'contact_number', 'رقم التواصل', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2007, 'english', 'license_number', 'License number', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2008, 'arabic', 'license_number', 'رقم الرخصة', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2009, 'english', 'waiting_pickups', 'Waiting pickups', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2010, 'arabic', 'waiting_pickups', 'مواقع قيد الإنتظار', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2011, 'english', 'active_pickups', 'Active pickups', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2012, 'arabic', 'active_pickups', 'مواقع مكتملة', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2013, 'english', 'transfer_status', 'Transfer status', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2014, 'arabic', 'transfer_status', 'حالة الإشتراك', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2015, 'english', 'trips_description', 'List of the active trips list.', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2016, 'arabic', 'trips_description', 'قائمة بالرحلات النشطة حاليا', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2017, 'english', 'private_trips_description', 'Private trips description', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2018, 'arabic', 'private_trips_description', 'قائمة بالرحلات الخاصة التم تم حجزها مباشرة', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2019, 'english', 'find_by_name_and_address', 'Find by name and address', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2020, 'arabic', 'find_by_name_and_address', 'ابحث عن طريق الإسم او التفاصيل', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2021, 'english', 'routes_description', 'List of routes with its pickup locations', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2022, 'arabic', 'routes_description', 'هذه القائمة تشمل خطوط السير وأماكن التوقف الخاصة بهم', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2023, 'english', 'pickup_locations_description', 'This list includes all pickup locations', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2024, 'arabic', 'pickup_locations_description', 'هذه القائمة تشمل جميع نقاط التوقف ', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2025, 'english', 'ticket_discripation', 'Ticket discripation', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2026, 'arabic', 'ticket_discripation', 'تفاصيل الرسالة ', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2027, 'english', 'ticket_details', 'Ticket details', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2028, 'arabic', 'ticket_details', 'بيانات الرسالة ', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2029, 'english', 'user', 'User', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2030, 'arabic', 'user', 'المستخدم', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2031, 'english', 'top_drivers_who_have_most_trips', 'Top drivers who have most trips', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2032, 'arabic', 'top_drivers_who_have_most_trips', 'أفضل السائقين حسب الاكثر رحلات', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2033, 'english', 'latest_students_has_been_added', 'Latest students has been added', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2034, 'arabic', 'latest_students_has_been_added', 'أحدث الطلاب الذين تم إضافتهم', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2035, 'english', 'before_create_driver_note', 'When you create new driver you should make sure that you have the right <b>email</b>. <br />because the generated password will be sent to him', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2036, 'arabic', 'before_create_driver_note', 'عند إنشاء حساب جديد, يرجى التأكد من  <b>البريد الإلكتروني</b>. <br /> حيث أن كلمة المرور التي سيتم إنشاؤها سيتم إرسالها الي البريد الإلكتروني الذي يتم إدخاله', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2037, 'english', 'drivers_applicants_note', 'You can enable or disable your business from receiving <b>applcants as drivers</b>. <br />you can manage it from business setting', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2038, 'arabic', 'drivers_applicants_note', 'يمكنك تفعيل او إلغاء عملك من استلام طلبات عمل من  <b>السائقين</b>. <br /> يمكنك تغيير ذلك من صفحة إدارة العمل', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2039, 'english', 'before_create_account', 'Before create account', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2040, 'arabic', 'before_create_account', 'قبل إنشاء حساب جديد', '2024-04-29 11:57:46', '2024-04-29 11:57:46');
INSERT INTO `translations` (`translation_id`, `language_code`, `code`, `value`, `created_at`, `updated_at`) VALUES
(2041, 'english', 'important', 'Important', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2042, 'arabic', 'important', 'هام', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2043, 'english', 'loadmore', 'Load more', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2044, 'arabic', 'loadmore', 'عرض المزيد', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2045, 'english', 'load_more', 'Load more', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2046, 'arabic', 'load_more', 'عرض المزيد', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2047, 'english', 'vehicle', 'Vehicle', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2048, 'arabic', 'vehicle', 'السيارة', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2049, 'english', 'theese_users_can_manage_your_account_only', 'Theese users can manage your account only', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2050, 'arabic', 'theese_users_can_manage_your_account_only', 'يمكنهم إدارة حسابهم الشخصي فقط', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2051, 'english', 'expand', 'Expand', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2052, 'arabic', 'expand', 'سحب لأسفل', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2053, 'english', 'collapse', 'Collapse', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2054, 'arabic', 'collapse', 'رفع لأعلى', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2055, 'english', 'user_not_found', 'User not found', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2056, 'arabic', 'user_not_found', 'هذا الحساب غير موجود', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2057, 'english', 'confirmation_code_sent_through_email', 'Confirmation code sent through email', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2058, 'arabic', 'confirmation_code_sent_through_email', 'سيتم إرسال كود التأكيد عبر البريد الإلكتروني', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2059, 'english', 'users_count', 'Users count', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2060, 'arabic', 'users_count', 'عدد المستخدمين', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2061, 'english', 'destinations', 'Destinations', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2062, 'arabic', 'destinations', 'أماكن التوصيل', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2063, 'english', 'destination', 'Destination', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2064, 'arabic', 'destination', 'مكان التوصيل', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2065, 'english', 'upgrade_notification_note', 'We will send you a notification upon subscription expiration ', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2066, 'arabic', 'upgrade_notification_note', 'سيتم إرسال رسالة تنبيهية قبل إنتهاء مدة الإشتراك', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2067, 'english', 'remaining_plan_days', 'Days remaining until your plan requires update', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2068, 'arabic', 'remaining_plan_days', 'الأيام المتبقية لتجديد الباقةالخاصة بك', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2069, 'english', 'your_current_plan', 'Your current plan', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2070, 'arabic', 'your_current_plan', 'خطتك الحالية', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2071, 'english', 'payment_code', 'Payment code', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2072, 'arabic', 'payment_code', 'كود الدفع', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2073, 'english', 'gateway', 'Gateway', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2074, 'arabic', 'gateway', 'بوابة الدفع', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2075, 'english', 'allow_private_trips', 'Allow private trips', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2076, 'arabic', 'allow_private_trips', 'السماح بالرحلات الخاصة', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2077, 'english', 'plan_name', 'Plan name', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2078, 'arabic', 'plan_name', 'إسم الخطة', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2079, 'english', 'limit', 'Limit', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2080, 'arabic', 'limit', 'الحد الاقصي', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2081, 'english', 'from', 'From', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2082, 'arabic', 'from', 'من', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2083, 'english', 'to', 'To', '2024-04-29 11:57:46', '2024-04-29 11:57:46'),
(2084, 'arabic', 'to', 'إلي', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2085, 'english', 'link', 'Link', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2086, 'arabic', 'link', 'الرابط', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2087, 'english', 'basic', 'Basic', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2088, 'arabic', 'basic', 'الاساسيات', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2089, 'english', 'languange', 'Languange', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2090, 'arabic', 'languange', 'اللغة', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2091, 'english', 'the_default_language_for_new_sessions', 'The default language for new sessions', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2092, 'arabic', 'the_default_language_for_new_sessions', 'اللغة الإفتراضية للجلسات الجديدة', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2093, 'english', 'is_homepage', 'Is homepage', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2094, 'arabic', 'is_homepage', 'الرئيسية', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2095, 'english', 'receiver_model', 'Receiver model', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2096, 'arabic', 'receiver_model', 'نوع المستلم', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2097, 'english', 'login_with_google', 'Login with google', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2098, 'arabic', 'login_with_google', 'الدخول بواسطة جوجل', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2099, 'english', 'allow_users_to_signup_with_gmail', 'Allow users to signup with gmail', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2100, 'arabic', 'allow_users_to_signup_with_gmail', 'السماح للمستخدمين للدخول باستخدام ال Gmail', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2101, 'english', 'used_for_maps', 'Used for maps', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2102, 'arabic', 'used_for_maps', 'يستخدم لعرض خرائط جوجل', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2103, 'english', 'commission_for_free_plan_subscribers', 'Commission for free plan subscribers', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2104, 'arabic', 'commission_for_free_plan_subscribers', 'العمولة علي حسابات الإشتراكات المجانية', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2105, 'english', 'commission_for_paid_subscribers', 'Commission for paid subscribers', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2106, 'arabic', 'commission_for_paid_subscribers', 'العمولة علي حسابات الإشتراكات المدفوعة', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2107, 'english', 'setting_commission_note', 'Comission at online payment when consumer pay to business for private trips and subscriptions', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2108, 'arabic', 'setting_commission_note', 'العمولة علي المدفوعات أونلاين عندما يقوم مستخدم بالدفع الي الشركة ثمن الإشتراكات او الرحلات الخاصة', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2109, 'english', 'app_name', 'App name', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2110, 'arabic', 'app_name', 'عنوان التطبيق', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2111, 'english', 'header_style', 'Header style', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2112, 'arabic', 'header_style', 'شكل الهيدر', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2113, 'english', 'header_bg_color', 'Header bg color', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2114, 'arabic', 'header_bg_color', 'لون خلفية الهيدر', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2115, 'english', 'header_background', 'Header background', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2116, 'arabic', 'header_background', 'صورة خلفية الهيدر', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2117, 'english', 'cash_payment', 'Cash payment', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2118, 'arabic', 'cash_payment', 'الدفع نقدا', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2119, 'english', 'paypal_payment', 'Paypal payment', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2120, 'arabic', 'paypal_payment', 'الدفع عن طرق PayPal', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2121, 'english', 'paystack_payment', 'Paystack payment', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2122, 'arabic', 'paystack_payment', 'الدفع عن طرق PayStack', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2123, 'english', 'allow_the_users_to_pay_for_the_private_trips_and_subscriptions_in_cash,_the_balance_would_be_added_to_the_driver_debit_balance', 'Allow the users to pay for the private trips and subscriptions in cash, the balance would be added to the driver debit balance', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2124, 'arabic', 'allow_the_users_to_pay_for_the_private_trips_and_subscriptions_in_cash,_the_balance_would_be_added_to_the_driver_debit_balance', 'السماح للمستخدمين بالدفع للرحلات الخاصة نقدا ويتم اضافة المبلغ الي محفظة السائق', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2125, 'english', 'allow_the_users_to_pay_for_the_private_trips_and_subscriptions_in_paypal', 'Allow the users to pay for the private trips and subscriptions in paypal', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2126, 'arabic', 'allow_the_users_to_pay_for_the_private_trips_and_subscriptions_in_paypal', 'السماح للمستخدمين بالدفع للرحلات الخاصة عن طريق PayPal', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2127, 'english', 'allow_the_users_to_pay_for_the_private_trips_and_subscriptions_in_paystack', 'Allow the users to pay for the private trips and subscriptions in paystack', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2128, 'arabic', 'allow_the_users_to_pay_for_the_private_trips_and_subscriptions_in_paystack', 'السماح للمستخدمين بالدفع للرحلات الخاصة عن طريق PayStack', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2129, 'english', 'site_info', 'Site info', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2130, 'arabic', 'site_info', 'بيانات الموقع', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2131, 'english', 'reset_password_msg', 'Type your email, and we will send you confirmation code', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2132, 'arabic', 'reset_password_msg', 'أكتب بريدك الالكتروني, وسيتم إرسال كود التفعيل غليك', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2133, 'english', 'transactions', 'Transactions', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2134, 'arabic', 'transactions', 'عمليات الدفع', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2135, 'english', 'subscriptions', 'Subscriptions', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2136, 'arabic', 'subscriptions', 'الإشتراكات', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2137, 'english', 'business_applicants', 'Business applicants', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2138, 'arabic', 'business_applicants', 'طلبات الإشتراكات', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2139, 'english', 'route_locations', 'Route locations', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2140, 'arabic', 'route_locations', 'مواقع خطوط السير', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2141, 'english', 'route_trips', 'Route trips', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2142, 'arabic', 'route_trips', 'رحلات خطوط السير', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2143, 'english', 'top_drivers', 'Top drivers', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2144, 'arabic', 'top_drivers', 'أفضل السائقين', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2145, 'english', 'new_driver_applicants', 'New driver applicants', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2146, 'arabic', 'new_driver_applicants', 'طلبات عمل السائقين', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2147, 'english', 'latest_drivers_request_has_been_sent', 'Latest drivers request has been sent', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2148, 'arabic', 'latest_drivers_request_has_been_sent', 'أحدث طلبات عمل السائقين التي تم إرسالها', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2149, 'english', 'latest_transactions', 'Latest transactions', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2150, 'arabic', 'latest_transactions', 'أحدث عمليات الدفع', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2151, 'english', 'renewal_date', 'Renewal date', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2152, 'arabic', 'renewal_date', 'تاريخ التجديد', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2153, 'english', 'supervisor', 'Supervisor', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2154, 'arabic', 'supervisor', 'مشرف', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2155, 'english', 'supervisors', 'Supervisors', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2156, 'arabic', 'supervisors', 'المشرفين', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2157, 'english', 'supervisors_list', 'Supervisors list', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2158, 'arabic', 'supervisors_list', 'قائمة المشرفين', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2159, 'english', 'employees', 'Employees', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2160, 'arabic', 'employees', 'الموظفين', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2161, 'english', 'employees_list', 'Employees list', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2162, 'arabic', 'employees_list', 'قائمة الموظفين', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2163, 'english', 'employee', 'Employee', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2164, 'arabic', 'employee', 'موظف', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2165, 'english', 'vacations', 'Vacations', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2166, 'arabic', 'vacations', 'الاجازات', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2167, 'english', 'picture', 'Picture', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2168, 'arabic', 'picture', 'الصورة', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2169, 'english', 'birth_date', 'Birth date', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2170, 'arabic', 'birth_date', 'تاريخ الميلاد', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2171, 'english', 'need_private_trip', 'Need private trip', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2172, 'arabic', 'need_private_trip', 'بحاجة الي رحلة خاصة', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2173, 'english', 'search_by_name', 'Search by name', '2024-04-29 11:57:47', '2024-04-29 11:57:47'),
(2174, 'arabic', 'search_by_name', 'بحث عن طريق الإسم', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2175, 'english', 'search_by_name_or_description', 'Search by name or description', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2176, 'arabic', 'search_by_name_or_description', 'بحث عن طريق الإسم او الوصف', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2177, 'english', 'search_by_name_email_or_mobile', 'Search by name email or mobile', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2178, 'arabic', 'search_by_name_email_or_mobile', 'بحث عن طريق الإسم او البريد الالكتروني او الموبايل', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2179, 'english', 'find', 'Find', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2180, 'arabic', 'find', 'البحث عن', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2181, 'english', 'search_by_name_or_mobile', 'Search by name or mobile', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2182, 'arabic', 'search_by_name_or_mobile', 'البحث عن طريق الإسم او رقم الموبايل', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2183, 'english', 'location_address', 'Location address', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2184, 'arabic', 'location_address', 'عنوان الموقع', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2185, 'english', 'change', 'Change', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2186, 'arabic', 'change', 'تغيير', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2187, 'english', 'find_driver', 'Find driver', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2188, 'arabic', 'find_driver', 'البحث عن سائق', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2189, 'english', 'find_vehicle', 'Find vehicle', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2190, 'arabic', 'find_vehicle', 'البحث عن سيارة', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2191, 'english', 'search_by_name_or_plate_number', 'Search by name or plate number', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2192, 'arabic', 'search_by_name_or_plate_number', 'البحث عن طريق الإسم او رقم السيارة', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2193, 'english', 'find_location', 'Find location', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2194, 'arabic', 'find_location', 'البحث عن مكان', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2195, 'english', 'payment_status', 'Payment status', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2196, 'arabic', 'payment_status', 'حالة الدفع', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2197, 'english', 'pickup_time', 'Pickup time', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2198, 'arabic', 'pickup_time', 'وقت الالتقاء', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2199, 'english', 'vehicle_types', 'Vehicle types', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2200, 'arabic', 'vehicle_types', 'انواع السيارات', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2201, 'english', 'driver_license_number', 'Driver license number', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2202, 'arabic', 'driver_license_number', 'رقم رخصة القيادة', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2203, 'english', 'account_information', 'Account information', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2204, 'arabic', 'account_information', 'معلومات الحساب', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2205, 'english', 'latest_trips', 'Latest trips', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2206, 'arabic', 'latest_trips', 'أحدث الرحلات', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2207, 'english', 'latest_private_trips', 'Latest private trips', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2208, 'arabic', 'latest_private_trips', 'أحدث الرحلات الخاصة', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2209, 'english', 'drivers_applicants', 'Drivers applicants', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2210, 'arabic', 'drivers_applicants', 'طلبات عمل السائقين', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2211, 'english', 'driver_applicants', 'Driver applicants', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2212, 'arabic', 'driver_applicants', 'طلبات عمل السائقين', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2213, 'english', 'application_info', 'Application info', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2214, 'arabic', 'application_info', 'بيانات الطلب', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2215, 'english', 'driver_info', 'Driver info', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2216, 'arabic', 'driver_info', 'معلومات السائق', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2217, 'english', 'approve', 'Approve', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2218, 'arabic', 'approve', 'موافقة', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2219, 'english', 'reject', 'Reject', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2220, 'arabic', 'reject', 'رفض', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2221, 'english', 'earnings', 'Earnings', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2222, 'arabic', 'earnings', 'الأرباح', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2223, 'english', 'withdrawal_requests', 'Withdrawal requests', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2224, 'arabic', 'withdrawal_requests', 'طلبات السحب', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2225, 'english', 'here_is_the_wallet_debit_and_credit_balance', 'Here is the wallet debit and credit balance', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2226, 'arabic', 'here_is_the_wallet_debit_and_credit_balance', 'بيانات المحفظة الالكترونية وتشمل رصيد الدائن و المدين', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2227, 'english', 'wallet', 'Wallet', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2228, 'arabic', 'wallet', 'المحفظة الالكترونية', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2229, 'english', 'wallet_balance', 'Wallet balance', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2230, 'arabic', 'wallet_balance', 'رصيد المحفظة', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2231, 'english', 'business_commisiion', 'Business commisiion', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2232, 'arabic', 'business_commisiion', 'عمولة العمل', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2233, 'english', 'collected_cash', 'Collected cash', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2234, 'arabic', 'collected_cash', 'المبالغ المسحوبة', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2235, 'english', 'route_name', 'Route name', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2236, 'arabic', 'route_name', 'اسم خط السير', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2237, 'english', 'driver_name', 'Driver name', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2238, 'arabic', 'driver_name', 'اسم السائق', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2239, 'english', 'morning_trip', 'Morning trip', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2240, 'arabic', 'morning_trip', 'الرحلة الصباحية', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2241, 'english', 'afternoon_trip', 'Afternoon trip', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2242, 'arabic', 'afternoon_trip', 'الرحلة المسائية', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2243, 'english', 'morning_trip_time', 'Morning trip time', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2244, 'arabic', 'morning_trip_time', 'موعد الرحلة الصباحية', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2245, 'english', 'afternoon_trip_time', 'Afternoon trip time', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2246, 'arabic', 'afternoon_trip_time', 'موعد الرحلة المسائية', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2247, 'english', 'start_location', 'Start location', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2248, 'arabic', 'start_location', 'نقطة البداية', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2249, 'english', 'end_location', 'End location', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2250, 'arabic', 'end_location', 'نقطة النهاية', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2251, 'english', 'crew', 'Crew', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2252, 'arabic', 'crew', 'الطاقم', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2253, 'english', 'business_settings', 'Business settings', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2254, 'arabic', 'business_settings', 'إعدادات العمل', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2255, 'english', 'transaction_code', 'Transaction code', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2256, 'arabic', 'transaction_code', 'كود العملية', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2257, 'english', 'transaction_number', 'Transaction number', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2258, 'arabic', 'transaction_number', 'رقم العملية', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2259, 'english', 'discount_amount', 'Discount amount', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2260, 'arabic', 'discount_amount', 'قيمة الخصم', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2261, 'english', 'issue_for', 'Issue for', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2262, 'arabic', 'issue_for', 'تم الإصدار الي', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2263, 'english', 'issued_by', 'Issued by', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2264, 'arabic', 'issued_by', 'تم الإصدار من', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2265, 'english', 'billing_info', 'Billing info', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2266, 'arabic', 'billing_info', 'بيانات الدفع', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2267, 'english', 'payer_name', 'Payer name', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2268, 'arabic', 'payer_name', 'الاسم', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2269, 'english', 'payer_email', 'Payer email', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2270, 'arabic', 'payer_email', 'البريد الالكتروني', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2271, 'english', 'order_id', 'Order id', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2272, 'arabic', 'order_id', 'رقم عملية الدفع', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2273, 'english', 'allow_notifications', 'Allow notifications', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2274, 'arabic', 'allow_notifications', 'السماح بالتنبيهات', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2275, 'english', 'confirm_delete', 'Please confirm to delete this item', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2276, 'arabic', 'confirm_delete', 'هل أنت متأكد من حذف هذا العنصر ؟', '2024-04-29 11:57:48', '2024-04-29 11:57:48'),
(2277, 'english', 'plan_payment', 'Plan payment', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2278, 'arabic', 'plan_payment', 'الدفع', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2279, 'english', 'super_administrator', 'Super administrator', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2280, 'arabic', 'super_administrator', 'المسؤول العام', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2281, 'english', 'permissions_list', 'Permissions list', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2282, 'arabic', 'permissions_list', 'قائمة الصلاحيات', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2283, 'english', 'click_on_the_permission_to_update', 'Click on the permission to update', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2284, 'arabic', 'click_on_the_permission_to_update', 'إضغط علي التصريح لتحديث حالته', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2285, 'english', 'TaxiTrip', 'TaxiTrip', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2286, 'arabic', 'TaxiTrip', 'الرحلات الخاصة', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2287, 'english', 'package', 'Package', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2288, 'arabic', 'package', 'الباقات', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2289, 'english', 'paymentmethod', 'Paymentmethod', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2290, 'arabic', 'paymentmethod', 'طرق الدفع', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2291, 'english', 'packagesubscription', 'Packagesubscription', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2292, 'arabic', 'packagesubscription', 'اشتراكات الباقات', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2293, 'english', 'vehicletype', 'Vehicletype', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2294, 'arabic', 'vehicletype', 'انواع السيارات', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2295, 'english', 'transaction', 'Transaction', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2296, 'arabic', 'transaction', 'التحويلات المالية', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2297, 'english', 'helpmessage', 'Helpmessage', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2298, 'arabic', 'helpmessage', 'رسائل الدعم الفني', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2299, 'english', 'businessapplicant', 'Businessapplicant', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2300, 'arabic', 'businessapplicant', 'طلبات الإشتراكات', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2301, 'english', 'driverapplicant', 'Driverapplicant', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2302, 'arabic', 'driverapplicant', 'طلبات السائقين', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2303, 'english', 'vacation', 'Vacation', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2304, 'arabic', 'vacation', 'الإجازات', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2305, 'english', 'roles', 'Roles management', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2306, 'arabic', 'roles', 'الصلاحيات', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2307, 'english', 'pickup_address', 'Pickup address', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2308, 'arabic', 'pickup_address', 'عنوان الالتقاء', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2309, 'english', 'choose_user_type', 'Choose user type', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2310, 'arabic', 'choose_user_type', 'اختر نوع الحساب', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2311, 'english', 'define_the_required_user_type_to_complete_information', 'Define the required user type to complete information', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2312, 'arabic', 'define_the_required_user_type_to_complete_information', 'اختر نوع الحساب المطلوب لإستكمال البيانات', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2313, 'english', 'manage_packages', 'Manage packages', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2314, 'arabic', 'manage_packages', 'إدارة الباقات', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2315, 'english', 'packages', 'Packages', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2316, 'arabic', 'packages', 'الباقات', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2317, 'english', 'package_name', 'Package name', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2318, 'arabic', 'package_name', 'إسم الباقة', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2319, 'english', 'package_subscriptions', 'Package subscriptions', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2320, 'arabic', 'package_subscriptions', 'إشتراكات الباقات', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2321, 'english', 'businesss_applicants', 'Businesss applicants', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2322, 'arabic', 'businesss_applicants', 'طلبات الاشتراكات', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2323, 'english', 'users_applicants_note', 'This list of the users who requested to join our routes. once you review their info and approve the request, they would be able to pay for the subscribed package', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2324, 'arabic', 'users_applicants_note', 'قائمة بالعملاء الذين أرسلوا طلبات إشتراكات للإنضمام لإحدى خطوط السير لديك, بمجرد مراجعة البيانات و الموافقة علي الطلب, سيتم ارسال رسالة لهم لكي يتمكنو من دفع قيمة الباقة', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2325, 'english', 'transaction_list', 'Transaction list', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2326, 'arabic', 'transaction_list', 'عمليات الدفع', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2327, 'english', 'driver_speed_limit', 'Driver speed limit', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2328, 'arabic', 'driver_speed_limit', 'الحد الأقصي لسرعة القيادة', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2329, 'english', 'allow_driver_applicants', 'Allow driver applicants', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2330, 'arabic', 'allow_driver_applicants', 'السماح بطلبات السائقين للعمل معك', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2331, 'english', 'once_the_driver_cross_this_speed_limit,_he_will_get_alarm_to_slow_down', 'Once the driver cross this speed limit, he will get alarm to slow down', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2332, 'arabic', 'once_the_driver_cross_this_speed_limit,_he_will_get_alarm_to_slow_down', 'اذا تعدى السائق السرعة المحددة له سيتم ارسال تنبيه له لتقليل السرعة', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2333, 'english', 'allow_the_drivers_to_apply_at_your_profile_to_join_your_team', 'Allow the drivers to apply at your profile to join your team', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2334, 'arabic', 'allow_the_drivers_to_apply_at_your_profile_to_join_your_team', 'السماح للسائقين بتقديم طلب للانضمام الي فريق العمل لديك', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2335, 'english', 'this_email_used_for_view_at_your_profile,_but_for_notifications_we_use_your_login_email', 'This email used for view at your profile, but for notifications we use your login email', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2336, 'arabic', 'this_email_used_for_view_at_your_profile,_but_for_notifications_we_use_your_login_email', 'هذا البريد يستخدم للعرض علي صفحتك الشخصية, اما التنبيهات يتم ارسالها الي البريد المستخدم للدخول للموقع', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2337, 'english', 'allow_users_to_send_you_a_private_trip_request', 'Allow users to send you a private trip request', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2338, 'arabic', 'allow_users_to_send_you_a_private_trip_request', 'السماح للعملاء بإرسال طلب لرحلة خاصة', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2339, 'english', 'subscription_info', 'Subscription info', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2340, 'arabic', 'subscription_info', 'بيانات الإشتراك', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2341, 'english', 'payment_type', 'Payment type', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2342, 'arabic', 'payment_type', 'نوع الدفع', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2343, 'english', 'empty_data', 'There is no data available to display', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2344, 'arabic', 'empty_data', 'لا يوجد بيانات متاحة ليتم عرضها', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2345, 'english', 'plan_subscription_days', 'Plan subscription days', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2346, 'arabic', 'plan_subscription_days', 'فترة الاشتراك', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2347, 'english', 'upgrade_plan', 'Upgrade plan', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2348, 'arabic', 'upgrade_plan', 'تحديث الخطة', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2349, 'english', 'cancel_subscription', 'Cancel subscription', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2350, 'arabic', 'cancel_subscription', 'إلغاء الإشتراك', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2351, 'english', 'business_info', 'Business info', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2352, 'arabic', 'business_info', 'بيانات العمل', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2353, 'english', 'business_type', 'Business type', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2354, 'arabic', 'business_type', 'نوع العمل', '2024-04-29 11:57:49', '2024-04-29 11:57:49'),
(2355, 'english', 'active_until', 'Active until', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2356, 'arabic', 'active_until', 'نشط حتى', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2357, 'english', 'withdraw_earnings', 'Withdraw earnings', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2358, 'arabic', 'withdraw_earnings', 'طلب سحب الأرباح', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2359, 'english', 'current_balance', 'Current balance', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2360, 'arabic', 'current_balance', 'الرصيد المتاح', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2361, 'english', 'withdraw_amount', 'Withdraw amount', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2362, 'arabic', 'withdraw_amount', 'القيمة المطلوب سحبها', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2363, 'english', 'add_notes', 'Add notes', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2364, 'arabic', 'add_notes', 'إضافة ملاحظات', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2365, 'english', 'discard', 'Discard', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2366, 'arabic', 'discard', 'الغاء', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2367, 'english', 'withdraw_from_balance', 'Withdraw from balance', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2368, 'arabic', 'withdraw_from_balance', 'طلب سحب من الرصيد المتاح', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2369, 'english', 'information_about_the_business', 'Information about the business', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2370, 'arabic', 'information_about_the_business', 'معلومات عن طبيعة العمل', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2371, 'english', 'school', 'School', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2372, 'arabic', 'school', 'مدرسة', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2373, 'english', 'some_features_are_available_only_for_paid_plans', 'Some features are available only for paid plans', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2374, 'arabic', 'some_features_are_available_only_for_paid_plans', 'بعض المميزات متاحة للخطط المدفوعة فقط', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2375, 'english', 'collect_cash_from_driver_debit_balance', 'Collect cash from driver debit balance', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2376, 'arabic', 'collect_cash_from_driver_debit_balance', 'سحب مبلغ مالي من مديونات السائق', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2377, 'english', 'collected_amount', 'Collected amount', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2378, 'arabic', 'collected_amount', 'القيمة المسحوبة', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2379, 'english', 'collect_cash', 'Collect cash', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2380, 'arabic', 'collect_cash', 'سحب المديونات', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2381, 'english', 'confirm_to_submit', 'Confirm to submit', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2382, 'arabic', 'confirm_to_submit', 'هل أنت متأكد من الاستمرار', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2383, 'english', 'debit_balance_used_for_collected_amount_from_cash_trips', 'Debit balance used for collected amount from cash trips', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2384, 'arabic', 'debit_balance_used_for_collected_amount_from_cash_trips', 'رصيد المدين يحتوي المبالغ المستلمة من الرحلات المدفوعة نقدا', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2385, 'english', 'credit_balance_used_for_commissions', 'Credit balance used for commissions', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2386, 'arabic', 'credit_balance_used_for_commissions', 'رصيد الدائن يحتوي عمولة السائق من الرحلات', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2387, 'english', 'pickup_days', 'Pickup days', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2388, 'arabic', 'pickup_days', 'ايام العمل', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2389, 'english', 'saturday', 'Saturday', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2390, 'arabic', 'saturday', 'السبت', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2391, 'english', 'sunday', 'Sunday', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2392, 'arabic', 'sunday', 'لأحد', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2393, 'english', 'monday', 'Monday', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2394, 'arabic', 'monday', 'الاثنين', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2395, 'english', 'tuesday', 'Tuesday', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2396, 'arabic', 'tuesday', 'الثلاثاء', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2397, 'english', 'wednesday', 'Wednesday', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2398, 'arabic', 'wednesday', 'الأربعاء', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2399, 'english', 'thursday', 'Thursday', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2400, 'arabic', 'thursday', 'الخميس', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2401, 'english', 'friday', 'Friday', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2402, 'arabic', 'friday', 'الجمعة', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2403, 'english', 'set_route', 'Set route', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2404, 'arabic', 'set_route', 'تحديد خط السير', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2405, 'english', 'find_route', 'Find route', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2406, 'arabic', 'find_route', 'البحث عن خط سير', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2407, 'english', 'find_package', 'Find package', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2408, 'arabic', 'find_package', 'البحث عن باقة', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2409, 'english', 'vehicle_type', 'Vehicle type', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2410, 'arabic', 'vehicle_type', 'نوع السيارة', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2411, 'english', 'capacity', 'Capacity', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2412, 'arabic', 'capacity', 'عدد المقاعد', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2413, 'english', 'you_do_not_have_any_media_yet_you_can_upload_some_media_above_to_get_started', 'You do not have any media yet you can upload some media above to get started', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2414, 'arabic', 'you_do_not_have_any_media_yet_you_can_upload_some_media_above_to_get_started', 'ليس لديك أي ملفات بعد, يمكنك رفع بعض الملفات لتبدأ في استخدامها', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2415, 'english', 'double_daily_trips_cost', 'Double daily trips cost', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2416, 'arabic', 'double_daily_trips_cost', 'تكلفة رحلتين يوميا', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2417, 'english', 'double_trips_cost', 'Double trips cost', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2418, 'arabic', 'double_trips_cost', 'تكلفة رحلتين يوميا', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2419, 'english', 'cost_for_two_trips_daily_morning_and_afternoon', 'Cost for two trips daily morning and afternoon', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2420, 'arabic', 'cost_for_two_trips_daily_morning_and_afternoon', 'التكلفة مقابل رحلتين يوميا صباحا و مساءا', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2421, 'english', 'subscribe_to_package', 'Subscribe to package', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2422, 'arabic', 'subscribe_to_package', 'الإشتراك في باقة', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2423, 'english', 'subscription_duration', 'Subscription duration', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2424, 'arabic', 'subscription_duration', 'مدة الإشتراك', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2425, 'english', 'choose_the_duration_of_the_subscription_to_set_the_end_date', 'Choose the duration of the subscription to set the end date', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2426, 'arabic', 'choose_the_duration_of_the_subscription_to_set_the_end_date', 'قم باختيار المدة المحددة للإشتراك وتحديد تاريخ البداية', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2427, 'english', 'quarter', 'Quarter', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2428, 'arabic', 'quarter', 'ربع عام', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2429, 'english', 'route_type', 'Route type', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2430, 'arabic', 'route_type', 'نوع خط السير', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2431, 'english', 'double_trips', 'Double trips', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2432, 'arabic', 'double_trips', 'رحلتين', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2433, 'english', 'single_trip', 'Single trip', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2434, 'arabic', 'single_trip', 'رحلة واحدة', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2435, 'english', 'two_trips_per_day_going_and_return', 'Two trips per day going and return', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2436, 'arabic', 'two_trips_per_day_going_and_return', 'رحلتين يوميا ذهاب و عودة', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2437, 'english', 'one_trip_per_day', 'One trip per day', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2438, 'arabic', 'one_trip_per_day', 'رحلة واحدة يوميا', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2439, 'english', 'wallet_details', 'Wallet details', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2440, 'arabic', 'wallet_details', 'بيانات المحفظة الإلكترونية', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2441, 'english', 'request_details', 'Request details', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2442, 'arabic', 'request_details', 'بيانات الطلب', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2443, 'english', 'set_as_done', 'Set as done', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2444, 'arabic', 'set_as_done', 'مكتمل', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2445, 'english', 'approved', 'Approved', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2446, 'arabic', 'approved', 'تم الموافقة', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2447, 'english', 'withdrawal_request', 'Withdrawal request', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2448, 'arabic', 'withdrawal_request', 'رقم طلب السحب', '2024-04-29 11:57:50', '2024-04-29 11:57:50'),
(2449, 'english', 'total_collected_amount', 'Total collected amount', '2024-04-29 11:57:51', '2024-04-29 11:57:51'),
(2450, 'arabic', 'total_collected_amount', 'إجمالي القيمة المسحوبة', '2024-04-29 11:57:51', '2024-04-29 11:57:51'),
(2451, 'english', 'credit_balance_not_enough', 'Credit balance not enough', '2024-04-29 11:57:51', '2024-04-29 11:57:51'),
(2452, 'arabic', 'credit_balance_not_enough', 'رصيد المحفظة غير كافي', '2024-04-29 11:57:51', '2024-04-29 11:57:51'),
(2455, 'english', 'copyrights', 'Copyrights are reserved', '2024-04-29 11:57:51', '2024-04-29 11:57:51'),
(2456, 'arabic', 'copyrights', 'جميع الحقوق محفوظة', '2024-04-29 11:57:51', '2024-04-29 12:08:05'),
(2457, 'english', 'translations', 'Translations', '2024-04-29 12:54:56', '2024-04-29 12:54:56'),
(2458, 'arabic', 'translations', 'الترجمة', '2024-04-29 12:54:56', '2024-04-29 12:54:56'),
(2459, 'english', 'languages', 'Languages', '2024-04-29 12:58:12', '2024-04-29 12:58:12'),
(2460, 'arabic', 'languages', 'اللغات', '2024-04-29 12:58:12', '2024-04-29 12:58:12'),
(2461, 'english', 'translate_the_code', 'Translate the code', '2024-04-29 12:58:33', '2024-04-29 12:58:33'),
(2462, 'arabic', 'translate_the_code', 'ترجمة الرموز و الكلمات', '2024-04-29 12:58:33', '2024-04-29 12:58:33'),
(2463, 'english', 'translate_the_word_into_the_available_languages', 'Translate the word into the available languages', '2024-04-29 12:58:59', '2024-04-29 12:58:59'),
(2464, 'arabic', 'translate_the_word_into_the_available_languages', 'قم بترجمة الكلمات حسب اللغات المتاحة', '2024-04-29 12:58:59', '2024-04-29 12:58:59'),
(2465, 'english', 'language_code', 'Language code', '2024-04-29 13:22:01', '2024-04-29 13:22:01'),
(2466, 'arabic', 'language_code', 'كود اللغة', '2024-04-29 13:22:01', '2024-04-29 13:22:01'),
(2467, 'english', 'find_user', 'Find user', '2024-04-29 13:23:07', '2024-04-29 13:23:07'),
(2468, 'arabic', 'find_user', 'البحث عن مستخدم', '2024-04-29 13:23:07', '2024-04-29 13:23:07'),
(2469, 'english', 'search_by_name,_contact_number', 'Search by name, contact number', '2024-04-29 13:23:46', '2024-04-29 13:23:46'),
(2470, 'arabic', 'search_by_name,_contact_number', 'البحث عن طريق الإسم او رقم الموبايل', '2024-04-29 13:23:46', '2024-04-29 13:23:46'),
(2471, 'english', 'find_plan', 'Find Plan', '2024-04-29 13:24:28', '2024-04-29 13:24:28'),
(2472, 'arabic', 'find_plan', 'البحث عن خطة', '2024-04-29 13:24:28', '2024-04-29 13:24:28'),
(2473, 'english', 'feature_code', 'Feature code', '2024-04-29 13:25:31', '2024-04-29 13:25:31'),
(2474, 'arabic', 'feature_code', 'كود الخاصية', '2024-04-29 13:25:31', '2024-04-29 13:25:31'),
(2475, 'english', 'access', 'Access', '2024-04-29 13:26:06', '2024-04-29 13:26:06'),
(2476, 'arabic', 'access', 'حد الوصول', '2024-04-29 13:26:06', '2024-04-29 13:26:06'),
(2477, 'english', 'ticket', 'Ticket', '2024-04-29 13:26:52', '2024-04-29 13:26:52'),
(2478, 'arabic', 'ticket', 'التذكرة', '2024-04-29 13:26:52', '2024-04-29 13:26:52'),
(2479, 'english', 'priority', 'Priority', '2024-04-29 13:27:06', '2024-04-29 13:27:06'),
(2480, 'arabic', 'priority', 'الاولوية', '2024-04-29 13:27:06', '2024-04-29 13:27:06'),
(2481, 'english', 'close_ticket', 'Close ticket', '2024-04-29 13:27:21', '2024-04-29 13:27:21'),
(2482, 'arabic', 'close_ticket', 'إنهاء التذكرة', '2024-04-29 13:27:21', '2024-04-29 13:27:21'),
(2483, 'english', 'confirm_close_ticket', 'Confirm close ticket', '2024-04-29 13:28:09', '2024-04-29 13:28:09'),
(2484, 'arabic', 'confirm_close_ticket', 'هل أنت متأكد من إنهاء التذكرة', '2024-04-29 13:28:09', '2024-04-29 13:28:09'),
(2485, 'english', 'amount_is_required', 'Amount is required', '2024-04-29 16:26:15', '2024-04-29 16:26:15'),
(2486, 'arabic', 'amount_is_required', 'القيمة مطلوبة', '2024-04-29 16:26:15', '2024-04-29 16:26:15'),
(2487, 'english', 'balance_is_not_enough', 'Balance is not enough', '2024-04-29 16:27:31', '2024-04-29 16:27:31'),
(2488, 'arabic', 'balance_is_not_enough', 'الرصيد غير كافي', '2024-04-29 16:27:31', '2024-04-29 16:27:31'),
(2489, 'english', 'subscription_details', 'Subscription details', '2024-04-29 16:28:59', '2024-04-29 16:28:59'),
(2490, 'arabic', 'subscription_details', 'بيانات الإشتراك', '2024-04-29 16:28:59', '2024-04-29 16:28:59'),
(2491, 'english', 'upcoming_renewal', 'Upcoming renewal', '2024-04-29 16:29:30', '2024-04-29 16:29:30'),
(2492, 'arabic', 'upcoming_renewal', 'موعد التجديد', '2024-04-29 16:29:30', '2024-04-29 16:29:30'),
(2493, 'english', 'subscription_id', 'Subscription ID', '2024-04-29 16:30:08', '2024-04-29 16:30:08'),
(2494, 'arabic', 'subscription_id', 'رقم الإشتراك', '2024-04-29 16:30:08', '2024-04-29 16:30:08'),
(2495, 'english', 'started', 'Started', '2024-04-29 16:36:43', '2024-04-29 16:36:43'),
(2496, 'arabic', 'started', 'بدأت', '2024-04-29 16:36:43', '2024-04-29 16:36:43'),
(2497, 'english', 'cancelled', 'Cancelled', '2024-04-29 16:37:20', '2024-04-29 16:37:20'),
(2498, 'arabic', 'cancelled', 'تم الغاؤها', '2024-04-29 16:37:20', '2024-04-29 16:37:20'),
(2499, 'english', 'scheduled', 'Scheduled', '2024-04-29 16:37:47', '2024-04-29 16:37:47'),
(2500, 'arabic', 'scheduled', 'تم الحجز', '2024-04-29 16:37:47', '2024-04-29 16:37:47'),
(2501, 'english', 'distance_km', 'Distance-KM', '2024-04-29 16:42:52', '2024-04-29 16:42:52'),
(2502, 'arabic', 'distance_km', 'المسافة كم', '2024-04-29 16:42:52', '2024-04-29 16:42:52'),
(2503, 'english', 'distance', 'Distance', '2024-04-29 16:43:47', '2024-04-29 16:43:47'),
(2504, 'arabic', 'distance', 'المسافة التقريبية', '2024-04-29 16:43:47', '2024-04-29 16:43:47'),
(2505, 'english', 'driver_commission_for_private_trips', 'Driver commission for Private trips', '2024-04-29 16:45:37', '2024-04-29 16:45:37'),
(2506, 'arabic', 'driver_commission_for_private_trips', 'عمولة السائق علي الرحلات الخاصة', '2024-04-29 16:45:37', '2024-04-29 16:45:37');
INSERT INTO `translations` (`translation_id`, `language_code`, `code`, `value`, `created_at`, `updated_at`) VALUES
(2507, 'english', 'the_drivers_commission_when_they_complete_paid_private_trip._the_commission_amount_will_be_added_to_driver_wallet_balance', 'The drivers commission when they complete paid private trip. The commission amount will be added to driver wallet balance', '2024-04-29 16:48:43', '2024-04-29 16:48:43'),
(2508, 'arabic', 'the_drivers_commission_when_they_complete_paid_private_trip._the_commission_amount_will_be_added_to_driver_wallet_balance', 'عمولة السائق يتم احتسابها عن انهاء الرحلة واتمام الدفع , ويتم إضافة قيمة العمولة الى  رصيد محفظة السائق ', '2024-04-29 16:48:43', '2024-04-29 16:48:43'),
(2509, 'english', 'total_route_trips', 'Total route trips', '2024-04-29 16:52:09', '2024-04-29 16:52:09'),
(2510, 'arabic', 'total_route_trips', 'اجمالي رحلات خطوط السير', '2024-04-29 16:52:09', '2024-04-29 16:52:09'),
(2511, 'english', 'here_you_will_se_the_list_of_the_newsletter_subscriptions', 'Here you will se the list of the newsletter subscriptions', '2024-04-30 17:11:23', '2024-04-30 17:11:23'),
(2512, 'arabic', 'here_you_will_se_the_list_of_the_newsletter_subscriptions', 'قائمة بالايميلات التي تم ارسالها للاشتراك في النشرة البريدية', '2024-04-30 17:11:23', '2024-04-30 17:11:23'),
(2513, 'english', 'newsletter_subscribers', 'Newsletter subscribers', '2024-04-30 17:11:55', '2024-04-30 17:11:55'),
(2514, 'arabic', 'newsletter_subscribers', 'مشتركين النشرة البريدية', '2024-04-30 17:11:55', '2024-04-30 17:11:55'),
(2515, 'english', 'yes_delete', 'Yes, delete!', '2024-04-30 18:21:12', '2024-04-30 18:21:53'),
(2516, 'arabic', 'yes_delete', 'نعم, احذف!', '2024-04-30 18:21:12', '2024-04-30 18:21:53'),
(2517, 'english', 'no_cancel', 'No, cancel', '2024-04-30 18:22:53', '2024-04-30 18:23:20'),
(2518, 'arabic', 'no_cancel', 'الغاء الحثف', '2024-04-30 18:22:53', '2024-04-30 18:22:53'),
(2519, 'english', 'sign_up_to_our_newsletter', 'Sign up to our newsletter', '2024-04-30 18:32:17', '2024-04-30 18:32:17'),
(2520, 'arabic', 'sign_up_to_our_newsletter', 'قم بالإشتراك في النشرة البريدية', '2024-04-30 18:32:17', '2024-04-30 18:32:17'),
(2521, 'english', 'localization', 'Localization', '2024-04-30 18:44:33', '2024-04-30 18:44:33'),
(2522, 'arabic', 'localization', 'اللغات و الترجمة', '2024-04-30 18:44:33', '2024-04-30 18:45:28'),
(2523, 'english', 'is_rtl', 'ltr', '2024-04-30 19:08:48', '2024-04-30 19:09:02'),
(2524, 'arabic', 'is_rtl', 'rtl', '2024-04-30 19:08:48', '2024-04-30 19:08:48'),
(2525, 'spain', 'is_rtl', 'ltr', '2024-05-01 16:06:13', '2024-05-01 16:16:55'),
(2526, 'spain', 'find_transportation', 'Encontrar transporte', '2024-05-01 17:16:27', '2024-05-01 17:16:27'),
(2527, 'english', 'find_transportation', 'Find transportation', '2024-05-01 17:16:27', '2024-05-01 17:16:27'),
(2528, 'arabic', 'find_transportation', 'البحث عن وسيلة نقل', '2024-05-01 17:16:27', '2024-05-01 17:16:27'),
(2529, 'spain', 'no_data_here', 'No data here', '2024-05-01 17:18:11', '2024-05-01 17:18:11'),
(2530, 'english', 'no_data_here', 'No data here', '2024-05-01 17:18:11', '2024-05-01 17:18:11'),
(2531, 'arabic', 'no_data_here', 'لا يوجد بيانات هنا', '2024-05-01 17:18:11', '2024-05-01 17:18:11'),
(2532, 'english', 'help', 'Help', '2024-05-01 17:26:15', '2024-05-01 17:26:15'),
(2533, 'arabic', 'help', 'المساعدة', '2024-05-01 17:26:15', '2024-05-01 17:26:15'),
(2534, 'spain', 'help', 'help', '2024-05-01 17:26:15', '2024-05-01 17:26:15'),
(2535, 'english', 'error', 'Error', '2024-05-01 17:27:00', '2024-05-01 17:27:00'),
(2536, 'arabic', 'error', 'حذث خطأ', '2024-05-01 17:27:00', '2024-05-01 17:27:00'),
(2537, 'spain', 'error', 'Error', '2024-05-01 17:27:00', '2024-05-01 17:27:00'),
(2538, 'english', 'your_active_trip', 'Your active trip', '2024-05-01 17:27:38', '2024-05-01 17:27:38'),
(2539, 'arabic', 'your_active_trip', 'رحلتك الحالية', '2024-05-01 17:27:38', '2024-05-01 17:27:38'),
(2540, 'spain', 'your_active_trip', 'Your active trip', '2024-05-01 17:27:38', '2024-05-01 17:27:38'),
(2541, 'english', 'continue_trip', 'Continue trip', '2024-05-01 17:28:36', '2024-05-01 17:28:36'),
(2542, 'arabic', 'continue_trip', 'إستكمال الرحلة', '2024-05-01 17:28:36', '2024-05-01 17:28:36'),
(2543, 'spain', 'continue_trip', 'Continue trip', '2024-05-01 17:28:36', '2024-05-01 17:28:36'),
(2544, 'english', 'start_trip', 'start trip', '2024-05-01 17:29:35', '2024-05-01 17:29:35'),
(2545, 'arabic', 'start_trip', 'بدء الرحلة', '2024-05-01 17:29:35', '2024-05-01 17:29:35'),
(2546, 'spain', 'start_trip', 'start trip', '2024-05-01 17:29:35', '2024-05-01 17:29:35'),
(2547, 'english', 'start_morning_trip', 'Start morning trip', '2024-05-01 17:30:00', '2024-05-01 17:30:00'),
(2548, 'arabic', 'start_morning_trip', 'بدء الرحلة الصباحية', '2024-05-01 17:30:00', '2024-05-01 17:30:00'),
(2549, 'spain', 'start_morning_trip', 'Start morning trip', '2024-05-01 17:30:00', '2024-05-01 17:30:00'),
(2550, 'english', 'start_afternoon_trip', 'Start afternoon trip', '2024-05-01 17:30:17', '2024-05-01 17:30:17'),
(2551, 'arabic', 'start_afternoon_trip', 'بدء الرحلة المسائية', '2024-05-01 17:30:17', '2024-05-01 17:30:17'),
(2552, 'spain', 'start_afternoon_trip', 'Start afternoon trip', '2024-05-01 17:30:17', '2024-05-01 17:30:17'),
(2553, 'english', 'morning', 'Morning', '2024-05-01 17:30:43', '2024-05-01 17:30:43'),
(2554, 'spain', 'morning', 'Morning', '2024-05-01 17:30:43', '2024-05-01 17:30:43'),
(2555, 'arabic', 'morning', 'صباحا', '2024-05-01 17:30:43', '2024-05-01 17:30:43'),
(2556, 'english', 'send_message', 'Send message', '2024-05-01 17:31:32', '2024-05-01 17:31:32'),
(2557, 'spain', 'send_message', 'Send message', '2024-05-01 17:31:32', '2024-05-01 17:31:32'),
(2558, 'arabic', 'send_message', 'ارسال رسالة', '2024-05-01 17:31:32', '2024-05-01 17:31:32'),
(2559, 'english', 'have_a_problem', 'Have a problem', '2024-05-01 17:31:49', '2024-05-01 17:31:49'),
(2560, 'spain', 'have_a_problem', 'Have a problem', '2024-05-01 17:31:49', '2024-05-01 17:31:49'),
(2561, 'arabic', 'have_a_problem', 'هل لديك مشكلة ؟', '2024-05-01 17:31:49', '2024-05-01 17:31:49'),
(2562, 'english', 'follow_your_upcoming_trips_from_this_list', 'Follow your upcoming trips from this list', '2024-05-01 17:32:09', '2024-05-01 17:32:09'),
(2563, 'spain', 'follow_your_upcoming_trips_from_this_list', 'Follow your upcoming trips from this list', '2024-05-01 17:32:09', '2024-05-01 17:32:09'),
(2564, 'arabic', 'follow_your_upcoming_trips_from_this_list', 'يمكنك متابعة رحلاتك القادمة و الحالية من هنا', '2024-05-01 17:32:09', '2024-05-01 17:32:09'),
(2565, 'english', 'trips_history', 'Trips history', '2024-05-01 17:32:24', '2024-05-01 17:32:24'),
(2566, 'spain', 'trips_history', 'Trips history', '2024-05-01 17:32:24', '2024-05-01 17:32:24'),
(2567, 'arabic', 'trips_history', 'سجل الرحلات السابقة', '2024-05-01 17:32:24', '2024-05-01 17:32:24'),
(2568, 'english', 'your_route', 'Your route', '2024-05-01 17:32:39', '2024-05-01 17:32:39'),
(2569, 'spain', 'your_route', 'Your route', '2024-05-01 17:32:39', '2024-05-01 17:32:39'),
(2570, 'arabic', 'your_route', 'خط السير الخاص بك', '2024-05-01 17:32:39', '2024-05-01 17:32:39'),
(2571, 'english', 'current_trip', 'Current trip', '2024-05-01 17:32:50', '2024-05-01 17:32:50'),
(2572, 'spain', 'current_trip', 'Current trip', '2024-05-01 17:32:50', '2024-05-01 17:32:50'),
(2573, 'arabic', 'current_trip', 'الرحلة الحالية', '2024-05-01 17:32:50', '2024-05-01 17:32:50'),
(2574, 'english', 'send_message_if_you_need_any_help', 'Send message if you need any help', '2024-05-01 17:33:22', '2024-05-01 17:33:22'),
(2575, 'spain', 'send_message_if_you_need_any_help', 'Send message if you need any help', '2024-05-01 17:33:22', '2024-05-01 17:33:22'),
(2576, 'arabic', 'send_message_if_you_need_any_help', 'يمكنك إرسال رسالة الى الدعم الفني للمساعدة', '2024-05-01 17:33:22', '2024-05-01 17:33:22'),
(2577, 'english', 'trip', 'Trip', '2024-05-01 17:33:36', '2024-05-01 17:33:36'),
(2578, 'spain', 'trip', 'Trip', '2024-05-01 17:33:36', '2024-05-01 17:33:36'),
(2579, 'arabic', 'trip', 'الرحلة', '2024-05-01 17:33:36', '2024-05-01 17:33:36'),
(2580, 'english', 'view_trip', 'View trip', '2024-05-01 17:33:53', '2024-05-01 17:33:53'),
(2581, 'spain', 'view_trip', 'View trip', '2024-05-01 17:33:53', '2024-05-01 17:33:53'),
(2582, 'arabic', 'view_trip', 'عرض الرحلة', '2024-05-01 17:33:53', '2024-05-01 17:33:53'),
(2583, 'english', 'view_more', 'View more', '2024-05-01 17:34:03', '2024-05-01 17:34:34'),
(2584, 'spain', 'view_more', 'View more', '2024-05-01 17:34:03', '2024-05-01 17:34:34'),
(2585, 'arabic', 'view_more', 'عرض المزيد', '2024-05-01 17:34:03', '2024-05-01 17:34:34'),
(2586, 'english', 'end_trip', 'End trip', '2024-05-01 17:34:52', '2024-05-01 17:34:52'),
(2587, 'spain', 'end_trip', 'End trip', '2024-05-01 17:34:52', '2024-05-01 17:34:52'),
(2588, 'arabic', 'end_trip', 'إنهاء الرحلة', '2024-05-01 17:34:52', '2024-05-01 17:34:52'),
(2589, 'english', 'we_can_help', 'We can help', '2024-05-01 17:35:06', '2024-05-01 17:35:06'),
(2590, 'spain', 'we_can_help', 'We can help', '2024-05-01 17:35:06', '2024-05-01 17:35:06'),
(2591, 'arabic', 'we_can_help', 'يمكننا المساعدة', '2024-05-01 17:35:06', '2024-05-01 17:35:06'),
(2592, 'english', 'pickup_done', 'Pickup done', '2024-05-01 17:35:20', '2024-05-01 17:35:20'),
(2593, 'spain', 'pickup_done', 'Pickup done', '2024-05-01 17:35:20', '2024-05-01 17:35:20'),
(2594, 'arabic', 'pickup_done', 'تم الإنهاء', '2024-05-01 17:35:20', '2024-05-01 17:35:20'),
(2595, 'english', 'delivered', 'Delivered', '2024-05-01 17:35:43', '2024-05-01 17:35:43'),
(2596, 'spain', 'delivered', 'Delivered', '2024-05-01 17:35:43', '2024-05-01 17:35:43'),
(2597, 'arabic', 'delivered', 'تم التوصيل', '2024-05-01 17:35:43', '2024-05-01 17:35:43'),
(2598, 'english', 'welcome_back', 'Welcome back', '2024-05-01 17:35:57', '2024-05-01 17:35:57'),
(2599, 'spain', 'welcome_back', 'Welcome back', '2024-05-01 17:35:57', '2024-05-01 17:35:57'),
(2600, 'arabic', 'welcome_back', 'أهلا بعودتك', '2024-05-01 17:35:57', '2024-05-01 17:35:57'),
(2601, 'english', 'create_new_account', 'Create new account', '2024-05-01 17:36:24', '2024-05-01 17:36:24'),
(2602, 'spain', 'create_new_account', 'Create new account', '2024-05-01 17:36:24', '2024-05-01 17:36:24'),
(2603, 'arabic', 'create_new_account', 'إنشاء حساب جديد', '2024-05-01 17:36:24', '2024-05-01 17:36:24'),
(2604, 'english', 'route_pickup_locations', 'Route pickup locations', '2024-05-01 17:36:38', '2024-05-01 17:36:38'),
(2605, 'spain', 'route_pickup_locations', 'Route pickup locations', '2024-05-01 17:36:38', '2024-05-01 17:36:38'),
(2606, 'arabic', 'route_pickup_locations', 'نقاط توقف خط السير', '2024-05-01 17:36:38', '2024-05-01 17:36:38'),
(2607, 'english', 'destination_location', 'Destination location', '2024-05-01 17:37:23', '2024-05-01 17:37:23'),
(2608, 'spain', 'destination_location', 'Destination location', '2024-05-01 17:37:23', '2024-05-01 17:37:23'),
(2609, 'arabic', 'destination_location', 'مكان التوصيل', '2024-05-01 17:37:23', '2024-05-01 17:37:23'),
(2610, 'english', 'call', 'Call', '2024-05-01 17:37:34', '2024-05-01 17:37:34'),
(2611, 'spain', 'call', 'Call', '2024-05-01 17:37:34', '2024-05-01 17:37:34'),
(2612, 'arabic', 'call', 'إتصال', '2024-05-01 17:37:34', '2024-05-01 17:37:34'),
(2613, 'english', 'show_map', 'Show map', '2024-05-01 17:37:51', '2024-05-01 17:37:51'),
(2614, 'spain', 'show_map', 'Show map', '2024-05-01 17:37:51', '2024-05-01 17:37:51'),
(2615, 'arabic', 'show_map', 'عرض علي الخريطة', '2024-05-01 17:37:51', '2024-05-01 17:37:51'),
(2616, 'english', 'get_in_contact', 'Get in contact', '2024-05-01 17:38:04', '2024-05-01 17:38:04'),
(2617, 'spain', 'get_in_contact', 'Get in contact', '2024-05-01 17:38:04', '2024-05-01 17:38:04'),
(2618, 'arabic', 'get_in_contact', 'تواصل بشكل مباشر', '2024-05-01 17:38:04', '2024-05-01 17:38:04'),
(2619, 'english', 'login_intro_message', 'Login intro message', '2024-05-01 17:38:45', '2024-05-01 17:38:45'),
(2620, 'spain', 'login_intro_message', 'Login intro message', '2024-05-01 17:38:45', '2024-05-01 17:38:45'),
(2621, 'arabic', 'login_intro_message', 'تابع عملك بكل أمان. \\nيرجي تسجيل الدخول إلي حسابك', '2024-05-01 17:38:45', '2024-05-01 17:38:45'),
(2622, 'english', 'signup_intro_message', 'Create your account now and start using our services', '2024-05-01 17:39:07', '2024-05-02 14:51:36'),
(2623, 'spain', 'signup_intro_message', 'Signup intro message', '2024-05-01 17:39:07', '2024-05-01 17:39:07'),
(2624, 'arabic', 'signup_intro_message', 'إبدأ عملك فورا. يمكنك إنشاء حسابك.', '2024-05-01 17:39:07', '2024-05-02 14:51:36'),
(2625, 'english', 'distance_to_pickup_location', 'Distance to pickup location', '2024-05-01 17:39:21', '2024-05-01 17:39:21'),
(2626, 'spain', 'distance_to_pickup_location', 'Distance to pickup location', '2024-05-01 17:39:21', '2024-05-01 17:39:21'),
(2627, 'arabic', 'distance_to_pickup_location', 'المسافة بينك وبين نفطة التوقف', '2024-05-01 17:39:21', '2024-05-01 17:39:21'),
(2628, 'english', 'list_of_route_pickup_locations', 'List of route pickup locations', '2024-05-01 17:39:37', '2024-05-01 17:39:37'),
(2629, 'spain', 'list_of_route_pickup_locations', 'List of route pickup locations', '2024-05-01 17:39:37', '2024-05-01 17:39:37'),
(2630, 'arabic', 'list_of_route_pickup_locations', 'عرض سجل جميع الرحلات السابقة', '2024-05-01 17:39:37', '2024-05-01 17:39:37'),
(2631, 'english', 'view_all_trips_history', 'View all trips history', '2024-05-01 17:40:14', '2024-05-01 17:40:14'),
(2632, 'spain', 'view_all_trips_history', 'View all trips history', '2024-05-01 17:40:14', '2024-05-01 17:40:14'),
(2633, 'arabic', 'view_all_trips_history', 'عرض سجل جميع الرحلات السابقة', '2024-05-01 17:40:14', '2024-05-01 17:40:14'),
(2634, 'english', 'send_your_message_below', 'Send your message below', '2024-05-01 17:40:29', '2024-05-01 17:40:29'),
(2635, 'spain', 'send_your_message_below', 'Send your message below', '2024-05-01 17:40:29', '2024-05-01 17:40:29'),
(2636, 'arabic', 'send_your_message_below', 'إذا كان لديك أي مشكلة أو بحاجة الى المساعدة, \\n أرسل رسالتك هنا', '2024-05-01 17:40:29', '2024-05-01 17:40:29'),
(2637, 'english', 'your_message_here', 'Your message here', '2024-05-01 17:41:03', '2024-05-01 17:41:03'),
(2638, 'spain', 'your_message_here', 'Your message here', '2024-05-01 17:41:03', '2024-05-01 17:41:03'),
(2639, 'arabic', 'your_message_here', 'إكتب رسالتك هنا ...', '2024-05-01 17:41:03', '2024-05-01 17:41:03'),
(2640, 'english', 'allow_receive_notifications', 'Allow receive notifications', '2024-05-01 17:41:26', '2024-05-01 17:41:26'),
(2641, 'spain', 'allow_receive_notifications', 'Allow receive notifications', '2024-05-01 17:41:26', '2024-05-01 17:41:26'),
(2642, 'arabic', 'allow_receive_notifications', 'السماح بإستلام التنبيهات', '2024-05-01 17:41:26', '2024-05-01 17:41:26'),
(2643, 'english', 'help_page', 'Help page', '2024-05-01 17:41:51', '2024-05-01 17:41:51'),
(2644, 'spain', 'help_page', 'Help page', '2024-05-01 17:41:51', '2024-05-01 17:41:51'),
(2645, 'arabic', 'help_page', 'صفحة المساعدة', '2024-05-01 17:41:51', '2024-05-01 17:41:51'),
(2646, 'english', 'select_your_language', 'Select your language', '2024-05-01 17:42:04', '2024-05-01 17:42:04'),
(2647, 'spain', 'select_your_language', 'Select your language', '2024-05-01 17:42:04', '2024-05-01 17:42:04'),
(2648, 'arabic', 'select_your_language', 'إختر لغتك المفضلة', '2024-05-01 17:42:04', '2024-05-01 17:42:04'),
(2649, 'arabic', 'trip_duration', 'مدة الرحلة', '2024-05-01 18:07:52', '2024-05-01 18:07:52'),
(2650, 'english', 'trip_duration', 'Trip duration', '2024-05-01 18:07:52', '2024-05-01 18:07:52'),
(2651, 'arabic', 'trip_number', 'رقم الرحلة', '2024-05-01 18:07:52', '2024-05-01 18:07:52'),
(2652, 'english', 'trip_number', 'Trip number', '2024-05-01 18:07:52', '2024-05-01 18:07:52'),
(2653, 'arabic', 'completed', 'إنتهت', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2654, 'arabic', 'pickups', 'نقاط التوقف', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2655, 'english', 'pickups', 'Pickups', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2656, 'arabic', 'you_have_no_route_yet', 'ليس لديك أى خطوط سير مرتبطة بحسابك', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2657, 'english', 'you_have_no_route_yet', 'You have no route yet', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2658, 'arabic', 'no_data_here', 'لا يوجد بيانات', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2659, 'arabic', 'no_data_available', 'لا يوجد بيانات متاحة حاليا', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2660, 'english', 'no_data_available', 'No data available', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2661, 'arabic', 'no_pickup_locations_at_this_trip', 'لا يوجد نقاط توقف في هذه الرحلة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2662, 'english', 'no_pickup_locations_at_this_trip', 'No pickup locations at this trip', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2663, 'arabic', 'no_pickup_locations_at_this_route', 'لا يوجد نقاط توقف في خط السير', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2664, 'english', 'no_pickup_locations_at_this_route', 'No pickup locations at this route', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2665, 'arabic', 'no_pickup_locations_here', 'لا يوجد نقاط توقف هنا', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2666, 'english', 'no_pickup_locations_here', 'No pickup locations here', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2667, 'arabic', 'your_help_messages', 'رسائل المساعدة التي ارسلتها', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2668, 'english', 'your_help_messages', 'Your help messages', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2669, 'arabic', 'ticket_number', 'رقم المتابعة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2670, 'english', 'ticket_number', 'Ticket number', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2671, 'arabic', 'department', 'القسم', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2672, 'english', 'department', 'Department', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2673, 'arabic', 'priority', 'الأولوية', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2674, 'arabic', 'support_comments', 'تعليقات الدعم الفني', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2675, 'english', 'support_comments', 'Support comments', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2676, 'arabic', 'comment', 'التعليق', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2677, 'english', 'comment', 'Comment', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2678, 'arabic', 'view_ticket', 'عرض الرسالة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2679, 'english', 'view_ticket', 'View ticket', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2680, 'arabic', 'notifications_list', 'قائمة التنبيهات', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2681, 'english', 'notifications_list', 'Notifications list', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2682, 'arabic', 'list_of_your_notifications', 'قائمة لأحدث التنبيهات و الإشعارات الخاصة بك', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2683, 'english', 'list_of_your_notifications', 'List of your notifications', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2684, 'arabic', 'your_old_sent_messages_list', 'الرسائل المرسلة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2685, 'english', 'your_old_sent_messages_list', 'Your old sent messages list', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2686, 'arabic', 'click_here_to_view_your_previous_sent_messages', 'قائمة بالرسائل التي تم إرسالها من قبل', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2687, 'english', 'click_here_to_view_your_previous_sent_messages', 'Click here to view your previous sent messages', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2688, 'arabic', 'new', 'جديدة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2689, 'arabic', 'all', 'الجميع', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2690, 'arabic', 'closed', 'مغلقة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2691, 'english', 'closed', 'Closed', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2692, 'arabic', 'app_preferences', 'إعدادات التطبيق', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2693, 'english', 'app_preferences', 'App preferences', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2694, 'arabic', 'get_permission', 'عرض الصلاحيات', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2695, 'english', 'get_permission', 'Get permission', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2696, 'arabic', 'get_permissions', 'عرض الصلاحيات', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2697, 'english', 'get_permissions', 'Get permissions', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2698, 'arabic', 'dark_mode', 'النظام الليلي', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2699, 'english', 'dark_mode', 'Dark mode', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2700, 'arabic', 'show_template_in_darkmode', 'عرض التصميم بألوان داكنة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2701, 'english', 'show_template_in_darkmode', 'Show template in darkmode', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2702, 'arabic', 'next', 'التالي', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2703, 'arabic', 'set_your_custom_configuration', 'قم بضبط إعداداتك الخاصة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2704, 'english', 'set_your_custom_configuration', 'Set your custom configuration', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2705, 'arabic', 'start_now', 'إبدأ الان', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2706, 'english', 'start_now', 'Start now', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2707, 'arabic', 'start_with_your_account', 'إبدأ الان بحسابك الشخصي', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2708, 'english', 'start_with_your_account', 'Start with your account', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2709, 'arabic', 'some_permissions_are_required_to_use_the_app', 'بعض الصلاحيات مطلوبة لإستخدام التطبيق', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2710, 'english', 'some_permissions_are_required_to_use_the_app', 'Some permissions are required to use the app', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2711, 'arabic', 'create_your_account', 'انشيْ حسابك الان', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2712, 'english', 'create_your_account', 'Create your account', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2713, 'arabic', 'forgot_password', 'نسيت كلمة المرور ؟', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2714, 'arabic', 'confirm', 'تأكيد', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2715, 'arabic', 'updated', 'تم التحديث', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2716, 'english', 'updated', 'Updated', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2717, 'arabic', 'updated_successfully', 'تم التحديث بنجاح', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2718, 'english', 'updated_successfully', 'Updated successfully', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2719, 'arabic', 'available_routes', 'خطوط السير المتاحة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2720, 'english', 'available_routes', 'Available routes', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2721, 'arabic', 'list_of_your_added_children', 'قائمة بالأطفال الذين تم إضافتهم', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2722, 'english', 'list_of_your_added_children', 'List of your added children', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2723, 'arabic', 'view_details', 'عرض التفاصيل', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2724, 'english', 'view_details', 'View details', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2725, 'arabic', 'add_student', 'إضافة طالب', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2726, 'english', 'add_student', 'Add student', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2727, 'arabic', 'add_new_student_now', 'إضافة طالب جديد الان', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2728, 'english', 'add_new_student_now', 'Add new student now', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2729, 'arabic', 'start_now_with_filling_new_student_information', 'إبدأ الان باضافة بيانات الطالب وسيتم المراجعة والرد عليك بأقرب وقت', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2730, 'english', 'start_now_with_filling_new_student_information', 'Start now with filling new student information', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2731, 'arabic', 'student_info_updated', 'سيتم مراجعة البيانات و سيتم التواصل معك في أقرب وقت', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2732, 'english', 'student_info_updated', 'Student info updated', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2733, 'arabic', 'forgot_password_message', 'سيتم إرسال رقم التأكيد علي البريد الإلكتروني', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2734, 'english', 'forgot_password_message', 'Forgot password message', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2735, 'arabic', 'scheduled', 'تم الاعداد', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2736, 'arabic', 'working_days', 'أيام الدراسة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2737, 'arabic', 'week_days_that_you_need_to_pickup', 'أيام الأسبوع التي يتم الالتقاء فيها', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2738, 'english', 'week_days_that_you_need_to_pickup', 'Week days that you need to pickup', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2739, 'arabic', 'vacations', 'الأجازات', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2740, 'arabic', 'vacations_days_subtitle', 'أيام الأجازات او الغياب', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2741, 'english', 'vacations_days_subtitle', 'Vacations days subtitle', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2742, 'arabic', 'pickup_and_destinations', 'أماكن اللقاء و التوصيل', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2743, 'english', 'pickup_and_destinations', 'Pickup and destinations', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2744, 'arabic', 'locations', 'المواقع', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2745, 'arabic', 'go_home', 'الذهاب للرئيسية', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2746, 'english', 'go_home', 'Go home', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2747, 'arabic', 'approved', 'مفعل', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2748, 'arabic', 'pending', 'تحت المراجعة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2749, 'arabic', 'change_password', 'تغيير كلمة المرور', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2750, 'english', 'change_password', 'Change password', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2751, 'arabic', 'current_password', 'كلمة المرور الحالية', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2752, 'english', 'current_password', 'Current password', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2753, 'arabic', 'confirm_password', 'تأكيد كلمة المرور', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2754, 'english', 'confirm_password', 'Confirm password', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2755, 'arabic', 'change_password_message', 'يمكنك تغيير كلمة المرور من هنا, ويجب ان لا تقل عن 6 حروف او ارقام', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2756, 'english', 'change_password_message', 'Change password message', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2757, 'arabic', 'required_information', 'البيانات المطلوبة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2758, 'english', 'required_information', 'Required information', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2759, 'arabic', 'you_need_to_complete_some_required_information', 'هناك بعض البيانات المطلوبة يجب استكمالها', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2760, 'english', 'you_need_to_complete_some_required_information', 'You need to complete some required information', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2761, 'arabic', 'complete_information', 'استكمال البيانات', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2762, 'english', 'complete_information', 'Complete information', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2763, 'arabic', 'thanks_for_submitting', 'شكرا علي الإرسال', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2764, 'english', 'thanks_for_submitting', 'Thanks for submitting', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2765, 'arabic', 'distance', 'المسافة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2766, 'arabic', 'students_list', 'قائمة الأطفال', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2767, 'arabic', 'find_school_transportation', 'البحث عن المدارس', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2768, 'english', 'find_school_transportation', 'Find school transportation', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2769, 'arabic', 'choose_from_our_business_providers', 'اختر من مزودي الخدمات المشتركين لدينا', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2770, 'english', 'choose_from_our_business_providers', 'Choose from our business providers', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2771, 'arabic', 'choose_from_our_schools_transportation_providers', 'اختر من شركات مزودي الخدمات المشتركين لدينا', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2772, 'english', 'choose_from_our_schools_transportation_providers', 'Choose from our schools transportation providers', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2773, 'arabic', 'choose_from_our_corporate_and_employees_transportation_providers', 'اختر من المدارس مزودي الخدمات المشتركين لدينا', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2774, 'english', 'choose_from_our_corporate_and_employees_transportation_providers', 'Choose from our corporate and employees transportation providers', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2775, 'arabic', 'mobile', 'رقم التواصل', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2776, 'arabic', 'routes_list', 'خطوط السير', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2777, 'english', 'routes_list', 'Routes list', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2778, 'arabic', 'apply_now', 'التقدم الان', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2779, 'english', 'apply_now', 'Apply now', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2780, 'arabic', 'events_and_news', 'الاحداث و الاخبار', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2781, 'english', 'events_and_news', 'Events and news', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2782, 'arabic', 'route_locations', 'نقاط التوقف', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2783, 'arabic', 'end_date', 'تاريخ الانتهاء', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2784, 'arabic', 'subscription_type', 'نوع الإشتراك', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2785, 'english', 'subscription_type', 'Subscription type', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2786, 'arabic', 'total_cost', 'التكلفة الإجمالية', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2787, 'arabic', 'business_info', 'جهة العمل', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2788, 'arabic', 'active_business', 'جهة العمل الحالية', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2789, 'english', 'active_business', 'Active business', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2790, 'arabic', 'current_applied_business', 'جهة العمل المشترك بها حاليا', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2791, 'english', 'current_applied_business', 'Current applied business', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2792, 'arabic', 'find_transportation', 'البحث عن خدمة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2793, 'arabic', 'profile', 'الصفحة الشخصية', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2794, 'arabic', 'parent_profile', 'البينات الشخصية', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2795, 'english', 'parent_profile', 'Parent profile', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2796, 'arabic', 'update_info', 'تحديث البيانات', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2797, 'english', 'update_info', 'Update info', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2798, 'arabic', 'update_your_information', 'تحديث البيانات الشخصية', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2799, 'english', 'update_your_information', 'Update your information', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2800, 'arabic', 'change_picture', 'تغيير الصورة الشخصية', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2801, 'arabic', 'canceled', 'تم الغاؤها', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2802, 'english', 'canceled', 'Canceled', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2803, 'arabic', 'complete', 'إكمال', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2804, 'english', 'complete', 'Complete', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2805, 'arabic', 'pending_invoice', 'فاتورة غير مدفوعة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2806, 'english', 'pending_invoice', 'Pending invoice', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2807, 'arabic', 'country', 'البلد', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2808, 'arabic', 'estimated_time_to_start', 'الوقت المتبقي لبدء الرحلة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2809, 'english', 'estimated_time_to_start', 'Estimated time to start', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2810, 'arabic', 'estimated_time', 'الوقت المتبقي', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2811, 'english', 'estimated_time', 'Estimated time', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2812, 'arabic', 'payment_method', 'طريقة الدفع', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2813, 'arabic', 'business', 'جهة العمل', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2814, 'arabic', 'subtotal', 'التكلفة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2815, 'arabic', 'cancel_trip', 'إلغاء الرحلة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2816, 'english', 'cancel_trip', 'Cancel trip', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2817, 'arabic', 'paid', 'مدفوعة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2818, 'arabic', 'unpaid', 'غير مدفوعة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2819, 'arabic', 'pay_in_cash', 'الدفع نقدا', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2820, 'english', 'pay_in_cash', 'Pay in cash', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2821, 'arabic', 'notification_details', 'تفاصيل الرسالة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2822, 'english', 'notification_details', 'Notification details', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2823, 'arabic', 'active_subscription', 'الاشتراك الحالي', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2824, 'english', 'active_subscription', 'Active subscription', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2825, 'arabic', 'sent_applications', 'الطلبات المرسلة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2826, 'english', 'sent_applications', 'Sent applications', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2827, 'arabic', 'student_applications', 'الطلبات المرسلة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2828, 'english', 'student_applications', 'Student applications', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2829, 'arabic', 'previously_sent_applications', 'الطلبات المرسلة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2830, 'english', 'previously_sent_applications', 'Previously sent applications', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2831, 'arabic', 'previously_sent_applications_to_business_providers', 'الطلبات المرسلة للشركات ومقدمي الخدمة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2832, 'english', 'previously_sent_applications_to_business_providers', 'Previously sent applications to business providers', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2833, 'arabic', 'update_student', 'تحديث بيانات الطالب', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2834, 'english', 'update_student', 'Update student', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2835, 'arabic', 'school', 'المدرسة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2836, 'arabic', 'apply_to_this_business', 'التقديم لهذه الشركة', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2837, 'english', 'apply_to_this_business', 'Apply to this business', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2838, 'arabic', 'current_route', 'خط السير الحالي', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2839, 'english', 'current_route', 'Current route', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2840, 'arabic', 'currently_subscribed_business', 'جهة العمل المشترك بها حاليا', '2024-05-01 18:07:53', '2024-05-01 18:07:53'),
(2841, 'english', 'currently_subscribed_business', 'Currently subscribed business', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2842, 'arabic', 'student_location', 'مكان الطالب', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2843, 'english', 'student_location', 'Student location', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2844, 'arabic', 'define_the_pickup_destination_for_the_student', 'يجب تحديد مواقع الالتقاء و التوصيل للطالب', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2845, 'english', 'define_the_pickup_destination_for_the_student', 'Define the pickup destination for the student', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2846, 'arabic', 'sunday', 'الاحد', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2847, 'arabic', 'add_new_vacation', 'اجازة جديدة', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2848, 'english', 'add_new_vacation', 'Add new vacation', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2849, 'arabic', 'previously_sent_vacations_for_the_student', 'أيام الإجازات التي تم تحديدها للطالب', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2850, 'english', 'previously_sent_vacations_for_the_student', 'Previously sent vacations for the student', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2851, 'arabic', 'update_vacation', 'تحديث الإجازة', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2852, 'english', 'update_vacation', 'Update vacation', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2853, 'arabic', 'vacations_list', 'ثائمة الإجازات', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2854, 'english', 'vacations_list', 'Vacations list', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2855, 'arabic', 'edit_page', 'صفحة التعديل', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2856, 'english', 'edit_page', 'Edit page', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2857, 'arabic', 'find_by_business_name', 'البحث عن طريق الإسم', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2858, 'english', 'find_by_business_name', 'Find by business name', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2859, 'arabic', 'business_list', 'قائمة مزودي الخدمة', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2860, 'english', 'business_list', 'Business list', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2861, 'arabic', 'schools', 'مدارس', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2862, 'arabic', 'companies', 'شركات', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2863, 'arabic', 'need_private_trip', 'تحتاج رحلة خاصة', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2864, 'arabic', 'apply_for_students', 'الاشتراك لطالب', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2865, 'english', 'apply_for_students', 'Apply for students', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2866, 'arabic', 'start_time', 'وقد البدء', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2867, 'arabic', 'set_destination', 'تحديد مكان الوصول', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2868, 'english', 'set_destination', 'Set destination', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2869, 'arabic', 'send_trip_request', 'إرسال طلب الرحلة', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2870, 'english', 'send_trip_request', 'Send trip request', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2871, 'arabic', 'find_address', 'البحث عن عنوان', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2872, 'english', 'find_address', 'Find address', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2873, 'arabic', 'birthday', 'تاريخ الميلادة', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2874, 'arabic', 'change_information', 'تغيير البيانات', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2875, 'english', 'change_information', 'Change information', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2876, 'arabic', 'your_students_are_safe', 'أبنائك بأمان معنا', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2877, 'english', 'your_students_are_safe', 'Your students are safe', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2878, 'arabic', 'fill_this_information_and_we_will_contact_you_once_we_review_it', 'يرجى إدخال بيانات الطالب وسيتم التواصل معاك مباشرة بمجرد مراجعة البينات', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2879, 'english', 'fill_this_information_and_we_will_contact_you_once_we_review_it', 'Fill this information and we will contact you once we review it', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2880, 'arabic', 'add_student_name_first', 'يجب إدخال اسم الطالب أولا', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2881, 'english', 'add_student_name_first', 'Add student name first', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2882, 'arabic', 'add_locations_first', 'يجب تحديد المواقع أولا', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2883, 'english', 'add_locations_first', 'Add locations first', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2884, 'arabic', 'student_name', 'اسم الطالب', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2885, 'english', 'student_name', 'Student name', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2886, 'arabic', 'to', 'إلى', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2887, 'arabic', 'sent_successfully', 'تم إرسال الطلب بنجاح', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2888, 'english', 'sent_successfully', 'Sent successfully', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2889, 'arabic', 'no_more_data_available', 'لا يوجد بيانات اخرى لعرضها', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2890, 'english', 'no_more_data_available', 'No more data available', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2891, 'arabic', 'find_schools_providers', 'البحث عن مدارس', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2892, 'english', 'find_schools_providers', 'Find schools providers', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2893, 'arabic', 'find_companies', 'البحث عن شركات', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2894, 'english', 'find_companies', 'Find companies', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2895, 'arabic', 'there_is_no_subscription_yet', 'لا يوجد إشتراكات لهذا الطالب بعد', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2896, 'english', 'there_is_no_subscription_yet', 'There is no subscription yet', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2897, 'arabic', 'there_is_no_data_yet', 'لم يتم إضافة بيانات بعد', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2898, 'english', 'there_is_no_data_yet', 'There is no data yet', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2899, 'arabic', 'empty', 'لا يوجد بيانات', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2900, 'arabic', 'empty_data', 'لا يوجد بيانات', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2901, 'english', 'empty_data', 'Empty data', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2902, 'arabic', 'boy', 'بنت', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2903, 'english', 'boy', 'Boy', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2904, 'arabic', 'girl', 'ولد', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2905, 'english', 'girl', 'Girl', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2906, 'arabic', 'choose_student', 'أختر الطالب', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2907, 'english', 'choose_student', 'Choose student', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2908, 'arabic', 'choose_one_from_your_added_students', 'إختر من الطلاب الذين تم إضافتهم', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2909, 'english', 'choose_one_from_your_added_students', 'Choose one from your added students', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2910, 'arabic', 'select_student_first', 'اختر الطالب اولا', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2911, 'english', 'select_student_first', 'Select student first', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2912, 'arabic', 'choose_package', 'أختر الباقة', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2913, 'english', 'choose_package', 'Choose package', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2914, 'arabic', 'choose_one_from_business_packages', 'إختر من الباقات المتاحة ', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2915, 'english', 'choose_one_from_business_packages', 'Choose one from business packages', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2916, 'arabic', 'select_package_first', 'قم بتحديد الباقة', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2917, 'english', 'select_package_first', 'Select package first', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2918, 'arabic', 'your_title', 'العنوان الذي تختاره', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2919, 'english', 'your_title', 'Your title', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2920, 'arabic', 'support', 'الدعم الفني', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2921, 'english', 'support', 'Support', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2922, 'arabic', 'other', 'أخرى', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2923, 'arabic', 'human_resources', 'الموارد البشرية', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2924, 'english', 'human_resources', 'Human resources', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2925, 'arabic', 'normal', 'عادي', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2926, 'english', 'normal', 'Normal', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2927, 'arabic', 'high', 'عالي', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2928, 'english', 'high', 'High', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2929, 'arabic', 'low', 'ضعيف', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2930, 'english', 'low', 'Low', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2931, 'arabic', 'need_help', 'رسائل الدعم الفني', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2932, 'english', 'need_help', 'Need help', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2933, 'arabic', 'enable', 'تفعيل', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2934, 'english', 'enable', 'Enable', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2935, 'arabic', 'disable', 'تعطيل', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2936, 'english', 'disable', 'Disable', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2937, 'arabic', 'change_notifications', 'تغيير التنبيهات', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2938, 'english', 'change_notifications', 'Change notifications', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2939, 'arabic', 'change_language', 'تغيير اللغة', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2940, 'english', 'change_language', 'Change language', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2941, 'arabic', 'year', 'عام كامل', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2942, 'arabic', 'quarterly', 'فصل دراسي', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2943, 'english', 'quarterly', 'Quarterly', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2944, 'arabic', 'quarter', 'فصل دراسي', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2945, 'arabic', 'show_details', 'عرض التفاصيل', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2946, 'english', 'show_details', 'Show details', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2947, 'arabic', 'rejected', 'مرفوض', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2948, 'english', 'rejected', 'Rejected', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2949, 'arabic', 'this_request_has_been_rejected_so_you_can_choose_another_provider', 'هذا الطلب تم رفضه يمكنك اختيار شركة اخرى', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2950, 'english', 'this_request_has_been_rejected_so_you_can_choose_another_provider', 'This request has been rejected so you can choose another provider', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2951, 'arabic', 'this_request_has_not_been_approved_yet_by_the_business', 'هذا الطلب لم يتم الموافقة عليه بعد', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2952, 'english', 'this_request_has_not_been_approved_yet_by_the_business', 'This request has not been approved yet by the business', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2953, 'arabic', 'request_status', 'حالة الطلب', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2954, 'english', 'request_status', 'Request status', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2955, 'arabic', 'private_trips_history', 'سجل الرحلات الخاصة', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2956, 'english', 'private_trips_history', 'Private trips history', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2957, 'arabic', 'active_route', 'خط السير الحالي', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2958, 'english', 'active_route', 'Active route', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2959, 'arabic', 'currently_assigned_route', 'خط السير الذي تم تحديده', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2960, 'english', 'currently_assigned_route', 'Currently assigned route', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2961, 'arabic', 'trip_is_already_paid', 'الرحلة مدفوعة بالفعل ولا يمكن إلغاؤها', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2962, 'english', 'trip_is_already_paid', 'Trip is already paid', '2024-05-01 18:07:54', '2024-05-01 18:07:54'),
(2963, 'spain', 'birthday', '', '2024-05-01 18:09:57', '2024-05-01 18:09:57'),
(2964, 'arabic', 'direction', 'rtl', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2965, 'arabic', 'sitename', 'Medians Trips', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2966, 'english', 'sitename', 'Sitename', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2967, 'arabic', 'error', 'خطأ', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2968, 'arabic', 'first_name', 'الإسم الأول', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2969, 'arabic', 'afternoon', 'مساءا', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2970, 'arabic', 'welcome', 'مرحبا بك', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2971, 'arabic', 'send_message', 'إرسال رسالة', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2972, 'arabic', 'trip', 'رحلة', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2973, 'arabic', 'email', 'البريد الإلكتروني', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2974, 'arabic', 'sign_in', 'تسجيل الدخول', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2975, 'english', 'sign_in', 'Sign in', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2976, 'arabic', 'close', 'إغلاق', '2024-05-01 18:12:06', '2024-05-01 18:12:06');
INSERT INTO `translations` (`translation_id`, `language_code`, `code`, `value`, `created_at`, `updated_at`) VALUES
(2977, 'arabic', 'search_by_name', 'البحث عن طريق الإسم أو العنوان', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2978, 'arabic', 'login_intro_message', 'تابع عملك بكل أمان. \nيرجي تسجيل الدخول إلي حسابك.', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2979, 'arabic', 'signup_intro_message', 'إبدأ عملك فورا. \nيمكنك إنشاء حسابك.', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2980, 'arabic', 'send_your_message_below', 'إذا كان لديك أي مشكلة أو بحاجة الى المساعدة, \n أرسل رسالتك هنا', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2981, 'arabic', 'subject', 'الموضوع', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2982, 'arabic', 'send_now', 'إرسل الان', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2983, 'english', 'send_now', 'Send now', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2984, 'arabic', 'your_message', 'رسالتك', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2985, 'english', 'your_message', 'Your message', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2986, 'arabic', 'allow_recieve_notifications', 'السماح بإستلام التنبيهات', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2987, 'english', 'allow_recieve_notifications', 'Allow recieve notifications', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2988, 'arabic', 'trip_sueccessfully_ended', 'تم إنهاء الرحلة بنجاح', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2989, 'english', 'trip_sueccessfully_ended', 'Trip sueccessfully ended', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2990, 'arabic', 'going', 'ذهاب', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2991, 'english', 'going', 'Going', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2992, 'arabic', 'approved', 'تم التأكيد', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2993, 'arabic', 'pending', 'قيد الانتظار', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2994, 'arabic', 'estimated_time', 'الوقت التقريبي', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2995, 'arabic', 'no_data_available', 'لا يوجد بيانات اخرى لعرضها', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2996, 'arabic', 'balance', 'الرصيد', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2997, 'english', 'balance', 'Balance', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2998, 'arabic', 'driver_profile', 'البيانات الشخصية', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(2999, 'english', 'driver_profile', 'Driver profile', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3000, 'arabic', 'companies_looking_for_drivers', 'شركات تبحث عن سائقين', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3001, 'english', 'companies_looking_for_drivers', 'Companies looking for drivers', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3002, 'arabic', 'schools_looking_for_drivers', 'مدارس تبحث عن سائقين', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3003, 'english', 'schools_looking_for_drivers', 'Schools looking for drivers', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3004, 'arabic', 'new_withdrawal_request', 'طلب سحب جديد', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3005, 'english', 'new_withdrawal_request', 'New withdrawal request', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3006, 'arabic', 'done', 'انتهى', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3007, 'arabic', 'this_is_the_balance_that_you_have', 'اجمالي الرصيد المتاح في محفظتك', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3008, 'english', 'this_is_the_balance_that_you_have', 'This is the balance that you have', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3009, 'arabic', 'create_wallet', 'إنشاء محفظة', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3010, 'english', 'create_wallet', 'Create wallet', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3011, 'arabic', 'withdrawal_list', 'طلبات السحب', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3012, 'english', 'withdrawal_list', 'Withdrawal list', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3013, 'arabic', 'withdrawal_request', 'طلب سحب جديد', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3014, 'arabic', 'withdraw_request', 'طلب سحب جديد', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3015, 'english', 'withdraw_request', 'Withdraw request', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3016, 'arabic', 'make_request_to_convert_your_balance_into_cash', 'إنشاء طلب لسحب رصيدك نقدا', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3017, 'english', 'make_request_to_convert_your_balance_into_cash', 'Make request to convert your balance into cash', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3018, 'arabic', 'fullname', 'الإسم بالكامل', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3019, 'arabic', 'your_upcoming_trip', 'رحلتك القادمة', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3020, 'english', 'your_upcoming_trip', 'Your upcoming trip', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3021, 'arabic', 'your_current_trip', 'الرحلة الحالية', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3022, 'english', 'your_current_trip', 'Your current trip', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3023, 'arabic', 'the_trip', 'الرحلة', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3024, 'english', 'the_trip', 'The trip', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3025, 'arabic', 'trip_payment', 'دفع قيمة الرحلة', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3026, 'english', 'trip_payment', 'Trip payment', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3027, 'arabic', 'you_should_get_this_amount_in_cash', 'يجب ان تحصل على هذا المبلغ نقدا من العميل', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3028, 'english', 'you_should_get_this_amount_in_cash', 'You should get this amount in cash', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3029, 'arabic', 'collected_cash_list', 'قائمة المبالغ المسحوبة من المديونية', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3030, 'english', 'collected_cash_list', 'Collected cash list', '2024-05-01 18:12:06', '2024-05-01 18:12:06'),
(3031, 'spain', 'direction', 'Direction', '2024-05-01 18:17:35', '2024-05-01 18:17:35'),
(3032, 'spain', 'trip_duration', 'Trip duration', '2024-05-01 18:22:09', '2024-05-01 18:22:09'),
(3033, 'english', 'translate_into', 'Translate into', '2024-05-02 04:11:42', '2024-05-02 04:11:42'),
(3034, 'spain', 'translate_into', 'Traducir en', '2024-05-02 04:11:42', '2024-05-02 04:11:42'),
(3035, 'arabic', 'translate_into', 'الترجمة الى  ', '2024-05-02 04:11:42', '2024-05-02 04:12:32'),
(3036, 'spain', 'arabic', 'Arábica', '2024-05-02 04:13:37', '2024-05-02 04:13:37'),
(3037, 'english', 'main_bg_color', 'APP background color', '2024-05-02 10:40:55', '2024-05-02 10:41:35'),
(3038, 'spain', 'main_bg_color', 'APP background color', '2024-05-02 10:40:55', '2024-05-02 10:41:35'),
(3039, 'arabic', 'main_bg_color', 'لون خلفية التطبيق', '2024-05-02 10:40:55', '2024-05-02 10:41:35'),
(3040, 'english', 'section_bg_color', 'Sections background', '2024-05-02 10:42:39', '2024-05-02 10:45:17'),
(3041, 'spain', 'section_bg_color', 'Section BG Color', '2024-05-02 10:42:39', '2024-05-02 10:42:39'),
(3042, 'arabic', 'section_bg_color', 'Section BG Color', '2024-05-02 10:42:39', '2024-05-02 10:42:39'),
(3043, 'spain', 'added', '', '2024-05-02 10:43:09', '2024-05-02 10:43:09'),
(3044, 'english', 'continue_with_social_media', 'Continue with social media', '2024-05-02 12:23:03', '2024-05-02 12:23:03'),
(3045, 'spain', 'continue_with_social_media', 'Continue with social media', '2024-05-02 12:23:03', '2024-05-02 12:23:03'),
(3046, 'arabic', 'continue_with_social_media', 'تابع من حسابات السوشيال ميديا', '2024-05-02 12:23:03', '2024-05-02 12:23:03'),
(3047, 'english', 'confirmation_code', 'Confirmation code', '2024-05-02 14:48:58', '2024-05-02 14:48:58'),
(3048, 'spain', 'confirmation_code', 'Confirmation code', '2024-05-02 14:48:58', '2024-05-02 14:48:58'),
(3049, 'arabic', 'confirmation_code', 'كود التفعيل', '2024-05-02 14:48:58', '2024-05-02 14:48:58'),
(3050, 'english', 'contact_forms', 'Contact forms', '2024-05-03 20:11:40', '2024-05-03 20:11:40'),
(3051, 'spain', 'contact_forms', '', '2024-05-03 20:11:40', '2024-05-03 20:11:40'),
(3052, 'arabic', 'contact_forms', 'رسائل الموقع', '2024-05-03 20:11:40', '2024-05-03 20:11:40'),
(3053, 'english', 'business_gallery', 'Business gallery', '2024-05-03 20:12:46', '2024-05-03 20:12:46'),
(3054, 'spain', 'business_gallery', '', '2024-05-03 20:12:46', '2024-05-03 20:12:46'),
(3055, 'arabic', 'business_gallery', 'معرض الصور', '2024-05-03 20:12:46', '2024-05-03 20:12:46'),
(3056, 'english', 'gallery', 'Gallery', '2024-05-03 20:13:11', '2024-05-03 20:13:11'),
(3057, 'spain', 'gallery', '', '2024-05-03 20:13:11', '2024-05-03 20:13:11'),
(3058, 'arabic', 'gallery', 'معرض الصور', '2024-05-03 20:13:11', '2024-05-03 20:13:11'),
(3059, 'spain', 'lang', 'spain', '2024-05-08 00:19:19', '2024-05-08 00:19:19'),
(3060, 'english', 'shipping', 'Shipping', '2024-05-15 17:15:07', '2024-05-15 17:15:07'),
(3061, 'arabic', 'shipping', 'الشحن', '2024-05-15 17:15:07', '2024-05-15 17:15:07'),
(3062, 'english', 'total_price', 'Total price', '2024-05-15 17:15:34', '2024-05-15 17:15:34'),
(3063, 'arabic', 'total_price', 'اجمالي التكلفة', '2024-05-15 17:15:34', '2024-05-15 17:15:34'),
(3064, 'english', 'quantity', 'quantity', '2024-05-15 17:15:52', '2024-05-15 17:15:52'),
(3065, 'arabic', 'quantity', 'الكمية', '2024-05-15 17:15:52', '2024-05-15 17:15:52'),
(3066, 'english', 'shipping_to', 'SHIPPING TO', '2024-05-15 17:16:12', '2024-05-15 17:16:12'),
(3067, 'arabic', 'shipping_to', 'الشحن الى', '2024-05-15 17:16:12', '2024-05-15 17:16:12'),
(3068, 'english', 'brands', 'Brands', '2024-05-15 17:26:42', '2024-05-15 17:26:42'),
(3069, 'arabic', 'brands', 'العلامات التجارية', '2024-05-15 17:26:42', '2024-05-15 17:26:42'),
(3070, 'english', 'prices', 'Prices', '2024-05-15 17:26:58', '2024-05-15 17:26:58'),
(3071, 'arabic', 'prices', 'الأسعار', '2024-05-15 17:26:58', '2024-05-15 17:26:58'),
(3072, 'english', 'sizes', 'Sizes', '2024-05-15 17:28:12', '2024-05-15 17:28:12'),
(3073, 'arabic', 'sizes', 'المقاسات', '2024-05-15 17:28:12', '2024-05-15 17:28:12'),
(3074, 'english', 'colors', 'Colors', '2024-05-15 17:28:24', '2024-05-15 17:28:24'),
(3075, 'arabic', 'colors', 'الالوان', '2024-05-15 17:28:24', '2024-05-15 17:28:24'),
(3076, 'english', 'account_info', 'Account Info', '2024-05-15 19:15:20', '2024-05-15 19:15:20'),
(3077, 'arabic', 'account_info', 'معلومات الحساب', '2024-05-15 19:15:20', '2024-05-15 19:15:20'),
(3078, 'english', 'my_orders', 'My orders', '2024-05-15 19:15:36', '2024-05-15 19:15:36'),
(3079, 'arabic', 'my_orders', 'الطلبات', '2024-05-15 19:15:36', '2024-05-15 19:15:36'),
(3080, 'english', 'my_address', 'My address', '2024-05-15 19:15:49', '2024-05-15 19:15:49'),
(3081, 'arabic', 'my_address', 'العناوين', '2024-05-15 19:15:49', '2024-05-15 19:15:49'),
(3082, 'english', 'optional', 'Optional', '2024-05-15 19:17:34', '2024-05-15 19:17:34'),
(3083, 'arabic', 'optional', 'اختياري', '2024-05-15 19:17:34', '2024-05-15 19:17:34'),
(3084, 'english', 'orders_history', 'Orders History', '2024-05-15 19:17:52', '2024-05-15 19:17:52'),
(3085, 'arabic', 'orders_history', 'سجل الطلبات', '2024-05-15 19:17:52', '2024-05-15 19:17:52'),
(3086, 'english', 'order_number', 'Order number', '2024-05-15 19:18:08', '2024-05-15 19:18:08'),
(3087, 'arabic', 'order_number', 'رقم الطلب', '2024-05-15 19:18:08', '2024-05-15 19:18:08'),
(3088, 'english', 'state', 'State', '2024-05-15 19:18:37', '2024-05-15 19:18:37'),
(3089, 'arabic', 'state', 'المحافظة', '2024-05-15 19:18:37', '2024-05-15 19:18:55'),
(3090, 'english', 'zip_code', 'Zip Code', '2024-05-15 19:19:17', '2024-05-15 19:19:17'),
(3091, 'arabic', 'zip_code', 'الرقم البريدي', '2024-05-15 19:19:17', '2024-05-15 19:19:17'),
(3092, 'english', 'proceed_to_checkout', 'Proceed to checkout', '2024-05-15 19:20:07', '2024-05-15 19:20:07'),
(3093, 'arabic', 'proceed_to_checkout', 'تاكيد الطلب', '2024-05-15 19:20:07', '2024-05-15 19:20:07'),
(3094, 'english', 'best_sales', 'Best sales', '2024-05-15 19:25:38', '2024-05-15 19:25:38'),
(3095, 'arabic', 'best_sales', 'الأكثر مبيعا', '2024-05-15 19:25:38', '2024-05-15 19:25:38'),
(3096, 'english', 'add_to_wishlist', 'Add to Wishlist', '2024-05-15 19:39:21', '2024-05-15 19:39:21'),
(3097, 'arabic', 'add_to_wishlist', 'أضف الي المفضلة', '2024-05-15 19:39:21', '2024-05-15 19:39:21'),
(3098, 'english', 'add_to_cart', 'Add to cart', '2024-05-15 19:39:37', '2024-05-15 19:39:37'),
(3099, 'arabic', 'add_to_cart', 'أضف الى السلة', '2024-05-15 19:39:37', '2024-05-15 19:39:37'),
(3100, 'english', 'compare', 'Compare', '2024-05-15 19:39:49', '2024-05-15 19:39:49'),
(3101, 'arabic', 'compare', 'مقارنة', '2024-05-15 19:39:49', '2024-05-15 19:39:49'),
(3102, 'english', 'in_stock', 'in stock', '2024-05-15 19:40:10', '2024-05-15 19:40:10'),
(3103, 'arabic', 'in_stock', 'متاح في المخزن', '2024-05-15 19:40:10', '2024-05-15 19:40:10'),
(3104, 'english', 'related_products', 'RELATED PRODUCTS', '2024-05-15 19:40:37', '2024-05-15 19:40:37'),
(3105, 'arabic', 'related_products', 'منتجات ذات صلة', '2024-05-15 19:40:37', '2024-05-15 19:40:37'),
(3106, 'english', 'additional_information', 'additional information', '2024-05-15 19:41:33', '2024-05-15 19:41:33'),
(3107, 'arabic', 'additional_information', 'معلومات إضافية', '2024-05-15 19:41:33', '2024-05-15 19:41:33'),
(3108, 'english', 'add_a_review', 'Add A Review', '2024-05-15 19:41:50', '2024-05-15 19:41:50'),
(3109, 'arabic', 'add_a_review', 'إضافة تقييم', '2024-05-15 19:41:50', '2024-05-15 19:41:50'),
(3110, 'english', 'your_rating', 'YOUR RATING', '2024-05-15 19:42:01', '2024-05-15 19:42:01'),
(3111, 'arabic', 'your_rating', 'تقييمك', '2024-05-15 19:42:01', '2024-05-15 19:42:01'),
(3112, 'english', 'save_my_name_and_email_in_this_browser_for_next_time_i_comment', 'Save my name and email in this browser for next time I comment', '2024-05-15 19:42:36', '2024-05-15 19:42:36'),
(3113, 'arabic', 'save_my_name_and_email_in_this_browser_for_next_time_i_comment', 'احفظ بياناتي  وإنشاء حساب جديد بها', '2024-05-15 19:42:36', '2024-05-15 19:42:36'),
(3114, 'english', 'your_name', 'your name', '2024-05-15 19:42:56', '2024-05-15 19:42:56'),
(3115, 'arabic', 'your_name', 'إسمك', '2024-05-15 19:42:56', '2024-05-15 19:42:56'),
(3116, 'english', 'view_as', 'View As', '2024-05-17 04:43:15', '2024-05-17 04:43:15'),
(3117, 'arabic', 'view_as', 'طريقة العرض', '2024-05-17 04:43:15', '2024-05-17 04:43:15'),
(3118, 'english', 'cart', 'Cart', '2024-05-17 04:43:44', '2024-05-17 04:43:44'),
(3119, 'arabic', 'cart', 'سلة التسوق', '2024-05-17 04:43:44', '2024-05-17 04:43:44'),
(3120, 'english', 'view_cart', 'View Cart', '2024-05-17 04:44:01', '2024-05-17 04:44:01'),
(3121, 'arabic', 'view_cart', 'عرض السلة', '2024-05-17 04:44:01', '2024-05-17 04:44:01'),
(3122, 'english', 'order_page', 'Order page', '2024-05-18 04:53:58', '2024-05-18 04:53:58'),
(3123, 'arabic', 'order_page', 'صفحة الطلب', '2024-05-18 04:53:58', '2024-05-18 04:53:58'),
(3124, 'english', 'paid_through', 'Paid through', '2024-05-18 04:54:21', '2024-05-18 04:54:21'),
(3125, 'arabic', 'paid_through', 'تمت عملية الدفع من خلال', '2024-05-18 04:54:21', '2024-05-18 04:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `upload_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'image',
  `business_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usage_log`
--

CREATE TABLE `usage_log` (
  `log_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `action` varchar(10) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `picture` varchar(191) DEFAULT NULL,
  `role_id` int(11) DEFAULT 3,
  `active` varchar(10) DEFAULT '1',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `wallet_id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `credit_balance` float NOT NULL,
  `debit_balance` float NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `builder_blocks`
--
ALTER TABLE `builder_blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `cms_content`
--
ALTER TABLE `cms_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itemid` (`item_id`),
  ADD KEY `itemtype` (`item_type`),
  ADD KEY `lang` (`lang`),
  ADD KEY `prefix` (`prefix`);
ALTER TABLE `cms_content` ADD FULLTEXT KEY `title` (`title`);
ALTER TABLE `cms_content` ADD FULLTEXT KEY `content` (`content`);
ALTER TABLE `cms_content` ADD FULLTEXT KEY `seo_title` (`seo_title`);
ALTER TABLE `cms_content` ADD FULLTEXT KEY `short` (`short`);

--
-- Indexes for table `compare`
--
ALTER TABLE `compare`
  ADD PRIMARY KEY (`compare_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`field_id`),
  ADD KEY `itemid` (`model_id`),
  ADD KEY `fieldid` (`field_id`),
  ADD KEY `value` (`value`),
  ADD KEY `class` (`model_type`);

--
-- Indexes for table `email_blocks`
--
ALTER TABLE `email_blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `help_messages`
--
ALTER TABLE `help_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `help_message_comments`
--
ALTER TABLE `help_message_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`invoice_item_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`newsletter_id`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`subscriber_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications_events`
--
ALTER TABLE `notifications_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `order_item_options`
--
ALTER TABLE `order_item_options`
  ADD PRIMARY KEY (`order_option_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`payment_method_id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `payment_method_fields`
--
ALTER TABLE `payment_method_fields`
  ADD PRIMARY KEY (`field_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`product_category_id`);

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `product_fields`
--
ALTER TABLE `product_fields`
  ADD PRIMARY KEY (`product_field_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`media_id`);

--
-- Indexes for table `product_prices`
--
ALTER TABLE `product_prices`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `product_shipping`
--
ALTER TABLE `product_shipping`
  ADD PRIMARY KEY (`product_shipping_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `product_stock`
--
ALTER TABLE `product_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `status_list`
--
ALTER TABLE `status_list`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`translation_id`),
  ADD KEY `code` (`code`),
  ADD KEY `language_code` (`language_code`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`upload_id`);

--
-- Indexes for table `usage_log`
--
ALTER TABLE `usage_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `firstname` (`first_name`),
  ADD KEY `lastname` (`last_name`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`wallet_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `builder_blocks`
--
ALTER TABLE `builder_blocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_content`
--
ALTER TABLE `cms_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `compare`
--
ALTER TABLE `compare`
  MODIFY `compare_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_blocks`
--
ALTER TABLE `email_blocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `help_messages`
--
ALTER TABLE `help_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `help_message_comments`
--
ALTER TABLE `help_message_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `invoice_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `newsletter_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `subscriber_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications_events`
--
ALTER TABLE `notifications_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_item_options`
--
ALTER TABLE `order_item_options`
  MODIFY `order_option_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_method_fields`
--
ALTER TABLE `payment_method_fields`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `product_category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_fields`
--
ALTER TABLE `product_fields`
  MODIFY `product_field_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_prices`
--
ALTER TABLE `product_prices`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_shipping`
--
ALTER TABLE `product_shipping`
  MODIFY `product_shipping_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stock`
--
ALTER TABLE `product_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_tags`
--
ALTER TABLE `product_tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_list`
--
ALTER TABLE `status_list`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `translation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3126;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usage_log`
--
ALTER TABLE `usage_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `wallet_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
