window.onload = () => {

    let myDiv = document.querySelector('div.menu-entrance')
    let icons = document.getElementById('up')
    icons.style.display = "none"
    myDiv.style.display = "none"
    setupListeners()
}
$(function() {
    $("img").on("error", function() {
        $(this).attr("src", "/_assets/images/articles/default.jpg")
    })
})