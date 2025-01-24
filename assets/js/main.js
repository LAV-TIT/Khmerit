
// ====== Animation =====


AOS.init({
    startEvent: 'DOMContentLoaded',
    initClassName: 'aos-init', // class applied after initialization
    animatedClassName: 'aos-animate', // class applied on animation
    useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
    duration: 400, // values from 0 to 3000, with step 50ms
    easing: 'ease', // default easing for AOS animations
    once: false, // whether animation should happen only once - while scrolling down
});


const swiper = new Swiper('.banner_slider', {
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    loop: true,
    spaceBetween: 0,
    autoplay: {
        delay: 6000,
        disableOnInteraction: false
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    },
    parallax: true,
    speed: 900, // Adjust transition speed
    mousewheel: {
        invert: false, // Keep natural scrolling direction
        forceToAxis: true, // Limit scrolling to one axis
    },
    hashNavigation: {
        watchState: true,
    },
});

var swiper2 = new Swiper(".get_id_slide", {
    spaceBetween: 10,
    freeMode: true,
    loop: true,
    grid: 2,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    },
    // autoplay: {
    //     delay: 2500,
    //     disableOnInteraction: false
    // },
    breakpoints: {
        // when window width is >= 320px
        320: {
            slidesPerView: 1,
            spaceBetween: 10
        },
        // when window width is >= 480px
        575.98: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        // when window width is >= 640px
        767.98: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        780: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        991.98: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        1199.98: {
            slidesPerView: 4,
            spaceBetween: 15
        }

    }
});


var swiper2 = new Swiper(".our_teams", {
    spaceBetween: 10,
    freeMode: true,
    loop: true,
    mousewheel: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false
    },
    breakpoints: {
        // when window width is >= 320px
        320: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        // when window width is >= 480px
        575.98: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        // when window width is >= 640px
        767.98: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        780: {
            slidesPerView: 5,
            spaceBetween: 10
        },
        991.98: {
            slidesPerView: 5,
            spaceBetween: 10
        },
        1199.98: {
            slidesPerView: 5,
            spaceBetween: 15
        }

    }
});

var swiper2 = new Swiper("#slide_gallery", {
    spaceBetween: 5,
    freeMode: true,
    loop: true,
    mousewheel: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false
    },
    breakpoints: {
        // when window width is >= 320px
        320: {
            slidesPerView: 3,
            spaceBetween: 5
        },
        // when window width is >= 480px
        575.98: {
            slidesPerView: 3,
            spaceBetween: 5
        },
        // when window width is >= 640px
        767.98: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        780: {
            slidesPerView: 4,
            spaceBetween: 10
        },

    }
});

// ----------swiper-slider---------
$(window).on('load', function () {
    var swiper = new Swiper('#catgory-slider', {
        loop: false,
        slidesPerView: "auto",
        allowTouchMove: true,
        spaceBetween: 0,
        mousewheel: true,
        slideToClickedSlide: true,
        centeredSlides: false,
        navigation: {
            nextEl: '.slider-next',
            prevEl: '.slider-prev',
        }
    });

    $(".category-button").click(function () {
        $(".category-button").removeClass("active");
        $(this).addClass('active');
        var getid = $(this).data('id');
        $(".data-text").removeClass('active');
        $("#" + getid).addClass("active");
    });
});


// const navbar = document.querySelector('nav');

// window.addEventListener('scroll', () => {
//     if (window.scrollY > 40) {
//         navbar.classList.add('fixed_navbar');
//     } else {
//         navbar.classList.remove('fixed_navbar');
//     }
// });

$(document).ready(function () {
    $(window).bind("mousewheel", function (event) {
        if (event.originalEvent.wheelDelta >= 0) {
            $(".navbar").removeClass("fixed_navbar");
        } else {
            $(".navbar").addClass("fixed_navbar");
        }
    });

    // =========== seach form ===========


    $(document).ready(function () {
        $('#btn-submit').click(function (e) {
            e.preventDefault();
            // Get the form and its data
            var form = $(this).closest('form');
            var data = form.serialize();
            // Fix the URL and remove 'amp;'
            var url = form.prop('action') + '&showtemplate=false';
            url = url.replace(/amp;/g, '');
            // Send AJAX request
            $.post(url, data, function (html) {
                $('#search-results').html(html);
                console.log(html)
            }).fail(function () {
                $('#search-results').html('<p class="text-danger">Error fetching search results.</p>');
            });
        });

        // Clear search results when the modal is closed
        $('#modal_search').on('hide.bs.modal', function () {
            $('#search-results').html("");
        });

        // Focus on the input field when the modal is shown
        $('#modal_search').on('shown.bs.modal', function () {
            $('#m0ab9esearchinput').trigger('focus');
        });
    });


});

document.addEventListener("DOMContentLoaded", () => {
    // Select all map-link elements
    const mapLinks = document.querySelectorAll(".map-link");
    const mapContainer = document.querySelector(".map.wrapp_map");
    const titleContainer = document.querySelector(".data_title");
    const linkToPage = document.querySelector(".link_to_page");

    // Add click event listeners to each map-link
    mapLinks.forEach(link => {
        link.addEventListener("click", (event) => {
            event.preventDefault(); // Prevent default behavior of the anchor tag
            // Get the data attributes
            const mapSrc = link.getAttribute("data-map");
            const title = link.getAttribute("data-title");
            const url = link.getAttribute("data-url");
            // Update the iframe source in the map container
            if (mapContainer && mapSrc) {
                mapContainer.innerHTML = mapSrc;
            }
            // Update the title in the data_title element
            if (titleContainer && title) {
                titleContainer.textContent = title;
            }
            if (linkToPage && url) {
                linkToPage.href = url;
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');
    const btn_submit = document.querySelector('.btn_submit');

    form.addEventListener('submit', async (event) => {
        event.preventDefault(); // Prevent the default form submission

        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        const formData = new FormData(form);
        // console.log(formData)
        // const object = {};
        // formData.forEach((value, key) => {
        //     object[key] = value;
        // });
        // const json = JSON.stringify(object);
        // console.table(json)
        btn_submit.disabled = true;
        let timerInterval; // Declare timer interval variable
        Swal.fire({
            title: "Sending...",
            html: "Please wait, your message is being sent.<br>Auto close in <b></b> milliseconds.",
            timer: 8000, // Auto close after 5 seconds
            timerProgressBar: true,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
                timerInterval = setInterval(() => {
                    timer.textContent = `${Swal.getTimerLeft()}`;
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        });

        try {
            const response = await fetch('contact-get-intouch.php', {
                method: 'POST',
                body: formData,
            });

            const result = await response.json();
            Swal.close(); // Close the loading alert
            if (result.status) {
                Swal.fire({
                    title: "Thank you",
                    text: `${result.message}`,
                    icon: "success",
                    draggable: true,
                    allowOutsideClick: false,
                });
                form.reset();
                form.classList.remove('was-validated');
            } else {

                Swal.fire({
                    icon: "error",
                    title: "Something went wrong!",
                    text: `${result.message}`,
                    allowOutsideClick: false,
                });
            }
        } catch (error) {
            // Close the loading alert in case of an error
            console.error('Error:', error);
            Swal.fire({
                icon: "error",
                title: `${error}`,
                allowOutsideClick: false,
                text: `There was an error sending your message. Please try again later.`,
            });
            Swal.close();
        }
        finally {
            btn_submit.disabled = false;
        }
    });
});



$(document).ready(function () {
    // $('#load-more').on('click', function () {
    //     let button = $(this);
    //     let nextUrl = button.data('nexturl');
    //     // Show loading state
    //     button.text('Loading...').prop('disabled', true);

    //     // Fetch the next page
    //     $.ajax({
    //         url: nextUrl,
    //         type: 'GET',
    //         success: function (response) {
    //             // Append the new content to the container
    //             $('#content-list').append(response);
    //             console.log("response"+response)
    //             // Update the next URL
    //             let newNextUrl = $(response).find('#load-more').data('nexturl');
    //             if (newNextUrl) {
    //                 button.data('nexturl', newNextUrl).text('Load More').prop('disabled', false);
    //             } else {
    //                 // Hide the button if no more pages
    //                 button.hide();
    //             }
    //         },
    //         error: function () {
    //             button.text('Load More').prop('disabled', false);
    //             alert('Failed to load more content. Please try again.');
    //         }
    //     });

    // });

    // $(window).on('scroll', function () {
    //     if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
    //         $('#load-more').trigger('click');
    //     }
    // });


    $(".go_to_top").on("click", function (event) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });

    $(window).bind("mousewheel", function (event) {
        if (event.originalEvent.wheelDelta >= 0) {
            $(".warrp_go_to_top").removeClass("show");
        } else {
            $(".warrp_go_to_top").addClass("show");
        }
    });


    // ===================new code =======


    // Clear districtValue if the 'district' parameter is not in the URL

    const urlParams = new URLSearchParams(window.location.search);
    if (!urlParams.has("district")) {
        $("#default_district li").html("Select...").attr("data-value", "");
    }

    // Handle Type Dropdown
    $("#default_types").click(function () {
        $(this).parent().toggleClass("active");
    });

    $("#select_ul_types li").click(function (e) {
        e.preventDefault();
        var selectedText = $(this).text();        // Get the displayed name
        var selectedValue = $(this).data("value"); // Get the alias (data-value)

        // Update the default option with the selected item
        $("#default_types li")
            .html(selectedText)
            .attr("data-value", selectedValue); // Update the visible text and data-value attribute

        console.log("Selected Type:", selectedText);
        console.log("Selected Value:", selectedValue);

        $(this).parents(".select_wrap").removeClass("active");

        // Trigger URL change for filtering
        var districtValue = $("#default_district li").attr("data-value");
        window.location.href = `${window.location.pathname}?types=${selectedValue}&district=${districtValue}`;
    });

    // Handle District Dropdown
    $("#default_district").click(function () {
        $(this).parent().toggleClass("active");
    });

    $("#select_ul_district li").click(function (e) {
        e.preventDefault();
        var selectedText = $(this).text();        // Get the displayed name
        var selectedValue = $(this).data("value"); // Get the alias (data-value)

        // Update the default option with the selected item
        $("#default_district li")
            .html(selectedText)
            .attr("data-value", selectedValue); // Update the visible text and data-value attribute

        console.log("Selected District:", selectedText);
        console.log("Selected Value:", selectedValue);

        $(this).parents(".select_wrap").removeClass("active");

        // Trigger URL change for filtering
        var typeValue = $("#default_types li").attr("data-value");
        window.location.href = `${window.location.pathname}?types=${typeValue}&district=${selectedValue}`;
    });

});

// ============= share option1===============


function Share(data) {
    const url = data.getAttribute('data-url');
    const title = data.getAttribute('data-title');
    Swal.fire({
        html: `
          <div class="share_wrapper">
              <h4 class="share_title">Share with</h4>
              <ul class="share_list">
                  <li class="share_item" title="Facebook">
                      <button onclick="getData(this)" class="share_link share_link_facebook" data-platform="facebook"
                          data-url="${url}" data-title="${title}">
                          <i class="fa-brands fa-facebook"></i>
                      </button>
                  </li>
                  <li class="share_item" title="Twitter">
                      <button onclick="getData(this)" class="share_link share_link_twitter" data-platform="twitter"
                          data-url="${url}" data-title="${title}">
                          <i class="fa-brands fa-x-twitter"></i>
                      </button>
                  </li>
                  <li class="share_item" title="Linkedin">
                      <button onclick="getData(this)" class="share_link share_link_linkedin"
                       data-platform="linkedin"
                          data-url="${url}" data-title="${title}">
                          <i class="fa-brands fa-linkedin-in"></i>
                      </button>
                  </li>
                  <li class="share_item" title="Mail">
                      <button onclick="getData(this)" class="share_link share_link_mail"
                      data-platform="mail"
                          data-url="${url}" data-title="${title}">
                          <i class="fa-solid fa-envelope"></i>
                      </button>
                  </li>
                  <li class="share_item" title="Whatsapp">
                      <button onclick="getData(this)" class="share_link share_link_whatsapp"
                      data-platform="whatsapp"
                          data-url="${url}" data-title="${title}">
                          <i class="fa-brands fa-whatsapp"></i>
                      </button>
                  </li>
              </ul>
          </div>
        `,
        showCloseButton: true,
        showConfirmButton: false, // Excludes the OK button
        showCancelButton: false, // Ensures the Cancel button isn't shown
        focusConfirm: false,
        allowOutsideClick: false,
    });
}
// Function to extract and log data attributes
function getData(data) {
    const url = data.getAttribute('data-url');
    const title = data.getAttribute('data-title');
    let shareUrl = null;
    var platform = data.getAttribute('data-platform');
    switch (platform) {
        case 'facebook':
            shareUrl = `https://www.facebook.com/sharer.php?u=${url}`;
            break;
        case 'twitter':
            shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${encodeURIComponent(title)}`;
            break;
        case 'linkedin':
            shareUrl = `https://www.linkedin.com/shareArticle?mini=true&url=${url}`;
            break;
        case 'whatsapp':
            shareUrl = `whatsapp://send?text=${encodeURIComponent(title)}%20${url}`;
            break;
        case 'mail':
            shareUrl = `mailto:?subject=${encodeURIComponent(title)}&body=Check out this link: ${url}`;
            break;
        default:
            console.error('Unsupported platform:', platform);
            return;
    }

    socialWindow(shareUrl, 570, 300);
}

// Function to open a popup window for sharing
function socialWindow(url, width, height) {
    const left = (screen.width - width) / 2;
    const top = (screen.height - height) / 2;
    const params = `menubar=no,toolbar=no,status=no,width=${width},height=${height},top=${top},left=${left}`;
    window.open(url, "", params);

    params = "menubar=no,toolbar=no,status=no,width=" + width + ",height=" + height + ",top=" + top + ",left=" + left;
}


// ============= share option2===============
// // Initialize share links and set event listeners
// window.onload = function () {
//     setShareLinks();
// };
// // Function to attach share functionality to buttons
// function setShareLinks() {
//     const shareButtons = document.querySelectorAll(".share_link");
//     shareButtons.forEach(button => {
//         button.addEventListener("click", function () {
//             const platform = getSharePlatform(this);
//             const url = this.getAttribute("data-url");
//             const title = this.getAttribute("data-title");
//             let shareUrl = null;

//             switch (platform) {
//                 case 'facebook':
//                     shareUrl = `https://www.facebook.com/sharer.php?u=${url}`;
//                     break;
//                 case 'twitter':
//                     shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${encodeURIComponent(title)}`;
//                     break;
//                 case 'linkedin':
//                     shareUrl = `https://www.linkedin.com/shareArticle?mini=true&url=${url}`;
//                     break;
//                 case 'whatsapp':
//                     shareUrl = `whatsapp://send?text=${encodeURIComponent(title)}%20${url}`;
//                     break;
//                 case 'mail':
//                     shareUrl = `mailto:?subject=${encodeURIComponent(title)}&body=Check out this link: ${url}`;
//                     break;
//                 default:
//                     console.error('Unsupported platform:', platform);
//                     return;
//             }

//             socialWindow(shareUrl, 570, 300);
//         });
//     });
// }

// // Helper function to determine share platform
// function getSharePlatform(element) {
//     if (element.classList.contains("share_link_facebook")) return 'facebook';
//     if (element.classList.contains("share_link_twitter")) return 'twitter';
//     if (element.classList.contains("share_link_linkedin")) return 'linkedin';
//     if (element.classList.contains("share_link_whatsapp")) return 'whatsapp';
//     if (element.classList.contains("share_link_mail")) return 'mail';
//     return null;
// }

// // Function to open a popup window for sharing
// function socialWindow(url, width, height) {
//     const left = (screen.width - width) / 2;
//     const top = (screen.height - height) / 2;
//     const params = `menubar=no,toolbar=no,status=no,width=${width},height=${height},top=${top},left=${left}`;
//     window.open(url, "", params);
// }
