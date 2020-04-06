/*Toggle dropdown list*/
/*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

var navMenuDiv = document.getElementById("nav-content")
var navMenu = document.getElementById("nav-toggle")

document.onclick = check

function check(e) {
    var target = (e && e.target) || (event && event.srcElement)

    //Nav Menu
    if (!checkParent(target, navMenuDiv)) {
        // click NOT on the menu
        if (checkParent(target, navMenu)) {
            // click on the link
            if (navMenuDiv.classList.contains("hidden")) {
                navMenuDiv.classList.remove("hidden")
            } else {
                navMenuDiv.classList.add("hidden")
            }
        } else {
            // click both outside link and outside menu, hide menu
            navMenuDiv.classList.add("hidden")
        }
    }
}

function checkParent(t, elm) {
    while (t.parentNode) {
        if (t == elm) {
            return true
        }
        t = t.parentNode
    }
    return false
}

//AOS Initialization
AOS.init()

//SmoothScroll Initialization
var scroll = new SmoothScroll('a[href*="#"]')

function enterAula(e) {
    e.preventDefault()
    var key = document.querySelector("#key").value
    if (key === "1528124" || key === "1698323") {
	var g = (key === "1528124") ? 'i' : 'p';
	window.location = "/aulavirtual.html?g=" + g
    } else {
        document.querySelector("#form-message").classList.remove("hidden")
    }
    return false
}

document.querySelector("form").addEventListener("submit", enterAula)
