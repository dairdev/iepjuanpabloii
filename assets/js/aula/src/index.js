function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	vars[key] = value;
    });
    return vars;
}

var urlVars = getUrlVars();
console.log(urlVars['g']);

if(!urlVars['g']){
    window.location = "/index.html";
}

var grade=urlVars['g'];

if(grade.indexOf('i') > -1){
    document.querySelector("#inicial").classList.remove('hidden');
}
if(grade.indexOf('p') > -1){
    document.querySelector("#primaria").classList.remove('hidden');
}

/*Toggle dropdown list*/
function toggleDD(myDropMenu)
{
    document.getElementById(myDropMenu).classList.toggle("invisible")
}
/*Filter dropdown options*/
function filterDD(myDropMenu, myDropMenuSearch)
{
    var input, filter, ul, li, a, i
    input = document.getElementById(myDropMenuSearch)
    filter = input.value.toUpperCase()
    div = document.getElementById(myDropMenu)
    a = div.getElementsByTagName("a")
    for (i = 0; i < a.length; i++)
    {
	if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1)
	{
	    a[i].style.display = ""
	}
	else
	{
	    a[i].style.display = "none"
	}
    }
}

function hideContent(){
    var contents = document.querySelectorAll(".content-class");
    contents.forEach(function(e){
	e.classList.add("hidden");
    });

}
// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event)
{
    if (!event.target.matches(".drop-button") &&
	!event.target.matches(".drop-search")
    )
    {
	var dropdowns = document.getElementsByClassName(
	    "dropdownlist")
	for (var i = 0; i < dropdowns.length; i++)
	{
	    var openDropdown = dropdowns[i]
	    if (!openDropdown.classList.contains("invisible"))
	    {
		openDropdown.classList.add("invisible")
	    }
	}
    }
    if (event.target.matches(".js-exit-app"))
    {
	window.location = "/index.html";
    }

    var lnk = event.target;
    if(event.target.tagName === "SPAN") {
	lnk = lnk.parentNode;
    }
    if(lnk.id === "lnkClases") {
	document.querySelector("#comunicados").classList.add("hidden");
	document.querySelector("#clases").classList.remove("hidden");
    }
    if(lnk.id === "lnkComunicados") {
	document.querySelector("#comunicados").classList.remove("hidden");
	document.querySelector("#clases").classList.add("hidden");
    }

    if(lnk.className.indexOf("grade") >= 0){
	hideContent();
	if(document.querySelector(".shadow-2xl")){
	    document.querySelector(".shadow-2xl").classList.remove("shadow-2xl");
	}
	lnk.classList.add("shadow-2xl");
	lnk.classList.add("border-solid");
	if(grade.indexOf('i') >= 0){
	    var age = lnk.getAttribute("data-age");
	    document.querySelector("#i" + age).classList.remove("hidden");
	}

	if(grade.indexOf('p') >= 0){
	    var age = lnk.getAttribute("data-age");
	    document.querySelector("#p" + age).classList.remove("hidden");
	}
    }

}

